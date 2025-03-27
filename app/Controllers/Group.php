<?php

namespace App\Controllers;

use App\Models\ChatroomModel;
use App\Models\EnrolledgroupModel;
use DateTime;
use App\Models\UserModel;
use App\Models\GroupModel;
use App\Models\DocumentModel;
use App\Models\ReceivelogModel;
use App\Models\ReleaselogModel;





class Group extends BaseController
{


    // this function will only show the create page
    public function create(): string
    {
        helper(['my_helper', 'form']);
        $data = [
            'user' => [],
            'active_tab' => 'Group',
        ];
        $session = session();
        $data['user'] = $session->get('userData');
        return view('group_create', $data);
    }
    // this function will create or add new group
    public function add_group()
    {

        $creator_user_id = session()->get('userData')['user_id'];
        $new_groupname = $this->request->getVar('group_name');
        $res_data = [
            'dtgroup_name' => $new_groupname,
            'status' => false,
            'new_groupname' => $new_groupname
        ];


        $grpModel = new GroupModel(); // new instance of group model
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup

        $data = [
            'user_id' => $creator_user_id,
            'dtgroup_name' => $new_groupname
        ];

        $addGroupNewId = $grpModel->add_group($data);
        $addEnrolledGroupData = [
            'user_id' => $creator_user_id,
            'dtgroup_id' => $addGroupNewId,
            'enrolledgroup_role' => "admin"
        ];
        $addEnrolledGroupResult  = $enrolledgroupModel->add_enrollment($addEnrolledGroupData);


        if ($addGroupNewId >= 1 && $addEnrolledGroupResult >= 1) {
            $res_data['status'] = true;
        }
        return json_encode($res_data);
    }



    public function group(): string //ok
    {
        helper(['my_helper', 'form']);
        $data = [
            'name' => '',
            'testData' => "hello world",
            'tracking_code' => '',
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d')
        ];

        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $data['tracking_code'] = generateCustomCode($user_id);

        return view('group', $data);
    }

    public function user_group_list() //ok
    {

        $session = session();
        $user_id = $session->get('userData')['user_id'];

        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'user_groups_data' => []
        ];

        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup
        $userGroupdata = $enrolledgroupModel->get_enrolledgroup_by_user_id($user_id);

        $data['user_groups_data'] = $enrolledgroupModel->get_enrolledgroup_by_user_id($user_id);
        echo json_encode($data);
    }

    public function get_group_profile_data() //ok
    {

        $session = session();
        $groupid = $this->request->getVar('groupid');
        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_data' => [],
            'members' => [],
        ];
        $dtgroupModel = new GroupModel();
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup

        $data['group_data'] = $dtgroupModel->get_by_group_id($groupid);
        $data['members'] = $enrolledgroupModel->get_group_members($groupid);


        echo json_encode($data);
    }
    public function group_members() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        $groupid = $this->request->getVar('groupid');
        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_data' => [],
            'members' => [],
            'groupid' => $groupid,
            'logged_user_id' => $logged_user_id
        ];
        $dtgroupModel = new GroupModel();
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup


        $data['group_data'] = $dtgroupModel->get_by_group_id($groupid);
        $data['members'] = $enrolledgroupModel->get_group_members($groupid);


        $data['logged_user_enrolledgroup_role'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_role'];
        $data['logged_user_enrolledgroup_as_doc_verifier'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_as_doc_verifier'];





        return view('group_members', $data);
    }


    public function group_settings() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        $groupid = $this->request->getVar('groupid');
        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_data' => [],
            'members' => [],
            'groupid' => $groupid,
            'logged_user_id' => $logged_user_id
        ];
        $dtgroupModel = new GroupModel();
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup


        $data['group_data'] = $dtgroupModel->get_by_group_id($groupid);
        $data['members'] = $enrolledgroupModel->get_group_members($groupid);


        $data['logged_user_enrolledgroup_role'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_role'];



        return view('group_settings', $data);
    }
    public function group_add_member() //ok
    {

        return view('group_add_member');
    }

    public function  group_leave_group() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        $groupid = $this->request->getVar('groupid');
        $data = [
            'status' => false,
            'message' => ''
        ];
        $enrolledgroupModel = new EnrolledgroupModel();
        $data['members'] = $enrolledgroupModel->get_group_members($groupid);
        $data['admins'] = $enrolledgroupModel->get_all_where(['dtgroup_id' => $groupid, 'enrolledgroup_role' => 'admin']);
        $data['user_data'] = $enrolledgroupModel->get_first_where(['dtgroup_id' => $groupid, 'user_id ' => $logged_user_id]);

        //if the user is number of is 1 and he is also a an admin ad there still members, do not allow the user to leave
        if (count($data['admins']) == 1 && ($data['user_data']['enrolledgroup_role'] == 'admin') && (count($data['members']) >= 2)) {
            $data['status'] = false;
            $data['message'] = 'You are not allowed to leave the group if you are only the admin.';
        } else if (count($data['admins']) >= 2) {
            $data['status'] = $enrolledgroupModel->delete_by_groupid_user_id($groupid, $logged_user_id);
            $data['message'] = 'You leaved the group successfully.';
        } else if (count($data['members']) == 1) {
            // delete the group if the leaving user is the only member
            $groupModel = new GroupModel();
            $data['status'] = $groupModel->delete($groupid);
            $data['message'] = 'The group you leaved was also deleted.';
        }






        echo json_encode($data);
    }


    public function group_add_member_get_search_result() //ok
    {
        $keyword = $this->request->getVar('query');
        $groupid = $this->request->getVar('groupid');

        $userModel = new UserModel();
        $data = [
            'active_groupid' => $groupid,
            'result' => []
        ];

        $search_result = $userModel->search_user_keyword($keyword, $groupid);

        $data['result'] = $search_result;


        return view('group_add_member_get_search_result', $data);
    }
    public function group_add_member_get_search_result_add() //ok
    {
        $user_id = $this->request->getVar('user_id');
        $groupid = $this->request->getVar('groupid');

        $model_data = [
            'user_id' => $user_id,
            'dtgroup_id' => $groupid,
            'enrolledgroup_role' => 'member',
        ];
        $res_data = [
            'result' => 0, //$result //expected to return the last inserted id
            'message' => '',
            'err_code' => ''

        ];

        $enrolledgroupModel = new EnrolledgroupModel();
        // chec if the user is aleady enrolled

        $isenrolled =  count($enrolledgroupModel->get_all_where(['dtgroup_id' => $groupid, 'user_id' => $user_id])) >= 1;

        if (!$isenrolled) {
            $result = $enrolledgroupModel->add_enrollment($model_data);
            $res_data['result'] = $result;
            if ($result >= 1) {
                $res_data['messaage'] = 'Successfully added!';
            }else{
                $res_data['messaage'] = 'Cannot process your request.';
                $res_data['err_code'] = '0001';

            }
        } else {
            $res_data['result'] = 0;
            $res_data['messaage'] = 'Alread enrolled to this group.';
        }




        echo json_encode($res_data);
    }

    public function  group_member_documents() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        $userid = $this->request->getVar('userid');
        $data = [
            'user_docs' => [],
            'user_data' => [],
            'user_docs_count' => 0,
            'user_release_count' => 0,
            'user_receive_count' => 0,
            'logged_user_id' => $logged_user_id

        ];
        $documentModel = new DocumentModel();
        $user_docs = $documentModel->get_documents_by_userid($userid);
        $data['user_docs'] = $user_docs;

        $userModel = new UserModel();
        $data['user_data'] = $userModel->get_user_by_id($userid);

        $receiveLogModel = new ReceivelogModel();
        $documentModel = new DocumentModel();
        $releaselogModel = new ReleaselogModel();

        $user_pending_docs_count = count($receiveLogModel->get_user_pending_documents($userid));

        $user_docs_count = $documentModel->count_by_userid($userid);
        $user_release_count = $releaselogModel->count_by_userid($userid);
        $user_receive_count = $receiveLogModel->count_by_userid($userid);

        $data['user_docs_count'] = $user_docs_count;
        $data['user_release_count'] = $user_release_count;
        $data['user_receive_count'] = $user_receive_count;
        $data['user_pending_docs_count'] = $user_pending_docs_count;

        return view('group_member_documents', $data);
    }

    public function  group_member_remove() //ok
    {
        $enrol_id = $this->request->getVar('enrol_id');
        $data = [
            'removed' => false
        ];
        $enrolledgroupModel = new EnrolledgroupModel();
        $data['removed'] = $enrolledgroupModel->delete_by_enrolledgroup_id($enrol_id);

        json_encode($data);
    }



    public function  group_member_set_admin() //ok
    {
        $enrol_id = $this->request->getVar('enrol_id');
        $data = [
            'status' => false
        ];
        $enrolledgroupModel = new EnrolledgroupModel();
        $data['status'] = $enrolledgroupModel->update_by_enrolledgroup_id($enrol_id, ['enrolledgroup_role' => 'admin']);

        echo json_encode($data);
    }

    public function  group_member_set_doc_verifier() //ok
    {
        $enrol_id = $this->request->getVar('enrol_id');
        $data = [
            'status' => false
        ];
        $enrolledgroupModel = new EnrolledgroupModel();
        $data['status'] = $enrolledgroupModel->update_by_enrolledgroup_id($enrol_id, ['enrolledgroup_as_doc_verifier' => '1']);

        echo json_encode($data);
    }

    public function  group_update_groupname() //ok
    {
        $new_groupname = $this->request->getVar('new_groupname');
        $group_id = $this->request->getVar('group_id');

        $data = [
            'status' => false
        ];
        $groupModel = new GroupModel();
        $data['status'] = $groupModel->where('dtgroup_id', $group_id)->set(['dtgroup_name' => $new_groupname])->update();
        echo json_encode($data);
    }


    public function  group_update_document_ca_date() //ok
    {
        $enrol_id = $this->request->getVar('doc_id');
        $ca_date = $this->request->getVar('ca_date');
        if ($ca_date == '') {
            $ca_date = null;
        }



        $data = [ 
            'status' => false
        ];
        $documentModel = new DocumentModel();
        $data['status'] = $documentModel->update_by_document_id($enrol_id, ['document_date_ca' => $ca_date]);

        echo json_encode($data);
    }
    public function  group_update_document_liquidation_date() //ok
    {
        $enrol_id = $this->request->getVar('doc_id');
        $liquidation_date = $this->request->getVar('liquidation_date');
        if ($liquidation_date == '') {
            $liquidation_date = null;
        }



        $data = [
            'status' => false
        ];
        $documentModel = new DocumentModel();
        $data['status'] = $documentModel->update_by_document_id($enrol_id, ['document_date_liquidation' => $liquidation_date]);

        echo json_encode($data);
    }

    public function  group_update_document_ada_date() //ok
    {
        $enrol_id = $this->request->getVar('doc_id');
        $ada_date = $this->request->getVar('ada_date');
        if ($ada_date == '') {
            $ada_date = null;
        }



        $data = [
            'status' => false
        ];
        $documentModel = new DocumentModel();
        $data['status'] = $documentModel->update_by_document_id($enrol_id, ['document_date_ada' => $ada_date]);

        echo json_encode($data);
    }




    public function group_documents() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        $groupid = $this->request->getVar('groupid');
        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_data' => [],
            'documents' => [],
            'groupid' => $groupid,
            'logged_user_id' => $logged_user_id
        ];
        $dtgroupModel = new GroupModel();
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup
        $documentModel = new DocumentModel();


        $data['group_data'] = $dtgroupModel->get_by_group_id($groupid);
        $data['documents'] = $documentModel->get_enrolledgroup_document($groupid);


        $data['logged_user_enrolledgroup_role'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_role'];
        $data['logged_user_enrolledgroup_as_doc_verifier'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_as_doc_verifier'];


        return view('group_documents', $data);
    }

    public function group_chatroom() //ok
    {
        //simply load the view tempalte or the conatainer
        // get_group_members
        $groupid = $this->request->getVar('groupid');
        $enrolledgroupModel = new EnrolledgroupModel();
        $group_members = $enrolledgroupModel->get_group_members($groupid);

        $data = [
            'group_members' => $group_members
        ];
        return view('group_chatroom', $data);
    }
    public function get_chatroom_newest_msg() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        // get all requests paramaters
        $groupid = $this->request->getVar('groupid');
        $query_last_chatroom_id = $this->request->getVar('query_last_chatroom_id'); //for request of the newest messages


        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_data' => [],
            'messages' => [],
            'groupid' => $groupid,
            'logged_user_id' => $logged_user_id,
            'logged_user_enrolledgroup_role' => ''
        ];
        $dtgroupModel = new GroupModel();
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup
        $chatroomModel = new ChatroomModel();


        $data['group_data'] = $dtgroupModel->get_by_group_id($groupid);

        $data['messages'] = $chatroomModel->get_new_msg($groupid, $query_last_chatroom_id, 10);

        $data['logged_user_enrolledgroup_role'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_role'];

        $response_data = [
            'messages' => [],
            'query_last_chatroom_id' => $query_last_chatroom_id,
            'last_older_chatroom_id' => 0

        ];

        if (count($data['messages']) !== 0) {
            //if the messages is not zero then update the values of response data
            $query_last_chatroom_id = end($data['messages'])['chatroom_id']; // get the last id in the query
            $response_data['query_last_chatroom_id'] = $query_last_chatroom_id;

            $data['first_record_chatroom_id'] = $chatroomModel->get_first_record($groupid);
            $response_data['messages'] = view('group_get_chatroom_newest_msg', $data);
            $response_data['resultCount'] = count($data['messages']);
            $response_data['last_older_chatroom_id'] = reset($data['messages'])['chatroom_id']; // get the id in the first row of query

        }
        echo  json_encode($response_data);
    }

    public function get_chatroom_older_msg() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];

        // get all requests paramaters
        $groupid = $this->request->getVar('groupid');
        $last_older_chatroom_id = $this->request->getVar('last_older_chatroom_id'); //for request of the newest messages


        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_data' => [],
            'messages' => [],
            'groupid' => $groupid,
            'logged_user_id' => $logged_user_id,
            'logged_user_enrolledgroup_role' => '',
            'first_record_chatroom_id' => 0
        ];
        $dtgroupModel = new GroupModel();
        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup
        $chatroomModel = new ChatroomModel();


        $data['group_data'] = $dtgroupModel->get_by_group_id($groupid);

        $data['messages'] = $chatroomModel->get_older_msg($groupid, $last_older_chatroom_id, 5);

        $data['logged_user_enrolledgroup_role'] =  $enrolledgroupModel->get_first_where(['user_id' => $logged_user_id, 'dtgroup_id' => $groupid])['enrolledgroup_role'];

        $response_data = [
            'messages' => [],
            'last_older_chatroom_id' => $last_older_chatroom_id,

        ];

        if (count($data['messages']) !== 0) {
            //if the messages is not zero then update the values of response data
            $last_older_chatroom_id = reset($data['messages'])['chatroom_id']; // get the last id in the query
            $response_data['last_older_chatroom_id'] = $last_older_chatroom_id;

            $data['first_record_chatroom_id'] = $chatroomModel->get_first_record($groupid)[0]['chatroom_id'];
            $response_data['messages'] = view('group_get_chatroom_newest_msg', $data);
            $response_data['resultCount'] = count($data['messages']);
        }
        echo  json_encode($response_data);
    }

    public function group_send_msg() //ok
    {
        $session = session();
        $logged_user_id = $session->get('userData')['user_id'];
        $groupid = $this->request->getVar('groupid');
        $msg = $this->request->getVar('msg');

        $model_data = [
            'chatroom_text' =>  $msg,
            'user_id' => $logged_user_id,
            'dtgroup_id' => $groupid,

        ];
        $chatroomModel = new ChatroomModel();

        $data = [
            'status' => false
        ];

        $data['status'] = $chatroomModel->add_msg($model_data);

        json_encode($data);
    }
}
