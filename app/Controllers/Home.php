<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\DocumentModel;
use App\Models\AuditlogModel;
use App\Models\ReceivelogModel;
use App\Models\ReleaselogModel;
use App\Models\EnrolledgroupModel;


class Home extends BaseController
{
    public function index(): string //ok
    {
        $data = ['testData' => "hello world", 'active_tab' => 'Home'];
        return view('home', $data);
    }
    public function register_doc(): string //ok
    {
        helper(['my_helper', 'form']);
        $data = [
            'name' => '',
            'testData' => "hello world",
            'tracking_code' => '',
            'active_tab' => 'Home',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'group_mates' => []
        ];
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $data['tracking_code'] = generateCustomCode($user_id);
        $enrolledgroupModel = new EnrolledgroupModel();
        $user_groupmates = $enrolledgroupModel->get_user_groupmates($user_id);
        $data['group_mates'] = $user_groupmates;
        // print_r($user_groupmates);

        return view('register_doc', $data);
    }

    public function update_user_setting() //ok
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];

        $setting_name = $this->request->getVar('setting_name');
        $setting_value = $this->request->getVar('setting_value');

        $data_model = [
            $setting_name => $setting_value,
            'user_id' => $user_id
        ];

        $userModel = new UserModel();
        $userModelUpdateRslt = $userModel->update_user_setting($user_id, $data_model);

        $response_data = [
            'status' => false
        ];
        $response_data['status'] = $userModelUpdateRslt;

        // update session values
        // $session->get('userData')[$setting_name]=$setting_value;
        $model = new UserModel();
        $user = $model->where('user_id', $user_id)->first();
        $session->set('userData', $user);
        echo json_encode($response_data);
    }




    public function receive_doc(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];

        return view('receive_doc', $data);
    }
    public function receive_doc_by_tracking_code(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];
        return view('receive_doc_by_tracking_code', $data);
    }

    public function release_doc_by_tracking_code(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];
        return view('release_doc_by_tracking_code', $data);
    }

    public function receive_doc_by_qrcode(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];
        return view('receive_doc_by_qrcode', $data);
    }

    public function qrcode($code)
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // $user_document_transact_status = $this->get_user_document_transact_status($user_id, $code);
        // create objects for all required models
        $docModel = new DocumentModel();
        $userModel = new UserModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();

        // 
        $document = $docModel->get_document_by_code($code);
        $receiveLog = $receiveLogModel->get_by_code($code);
        $releaseLog = $releaseLogModel->get_by_code($code);
        $user = $userModel->get_user_by_id($user_id);

        $data = [
            'is_doc_null' => false,
            'active_tab' => 'Home',
            'user_data' =>  $user,
            'lastuser_data' => [],
            'document' => $document,
            'receiveLog' => $receiveLog,
            'is_me_last_receive' => '',
            'is_last_user_released' => '',
            'code' => $code




        ];
        // check if the document exists
        if ($document == null) {
            $data['is_doc_null'] = true;
        } else {
            // if document has record in receive table
            $document_owner =  $userModel->get_user_by_id($document['user_id'])['user_username'];
            $data['document_owner'] = $document_owner;

            $data['lastuser_data'] =  $userModel->get_user_by_id($receiveLog[0]['user_id']);
            if (count($releaseLog) === 0) {
                if ($receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                }
            } else {

                if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = true;
                } else if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $releaseLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = true;
                }
            }
        }
        return view('qrcode', $data);
    }
    public function release_doc_by_qrcode(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];
        return view('release_doc_by_qrcode', $data);
    }

    public function search(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];
        return view('search', $data);
    }

    public function search_results(): string
    {
        $document = new DocumentModel();
        $input_keyword = $this->request->getVar('query');
        $result = $document->search_document_keyword($input_keyword);

        $data = [
            'active_tab' => 'Home',
            'result' => $result
        ];
        $data['result'] = $result;


        return view('search_results', $data);
    }

    public function timeline_view($code): string //ok
    {
        $data = [
            'active_tab' => 'Home',
            'code' => $code

        ];
        return view('timeline_view', $data);
    }

    public function timeline(): string //ok
    {
        $code = $this->request->getVar('code');
        $documentModel = new DocumentModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();
        $userModel = new UserModel();
            
        log_message('error',"code is ".$code);
        $receives = $receiveLogModel->get_by_code($code);
        $releases = $releaseLogModel->get_by_code($code);

        $document = $documentModel->get_document_by_code($code);
        $user = $userModel->get_user_by_id($document['user_id']);

        $data = [
            'active_tab' => 'Home',
            'code' => $code,
            'document' => $document,
            'receives' => $receives,
            'releases' => $releases,
            'user' => $user

        ];
        return view('timeline', $data);
    }

    public function document_details(): string //ok
    {
        $session = session();
        $user_id = $session->get('userData')['user_id']; 

        $code = $this->request->getVar('code');
        $documentModel = new DocumentModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();
        $userModel = new UserModel();


        $receives = $receiveLogModel->get_by_code($code);
        $releases = $releaseLogModel->get_by_code($code);

        $document = $documentModel->get_document_by_code($code);
        $user = $userModel->get_user_by_id($document['user_id']);

        $enrolledgroupModel = new EnrolledgroupModel(); //new instance of enrolledgroup   
        $userGroupdata = $enrolledgroupModel->get_enrolledgroup_by_user_id($user_id);
        $logged_user_enrolledgroup_as_doc_verifier = $userGroupdata[0]['enrolledgroup_as_doc_verifier'];

        // print_r($userGroupdata); 
        $data = [
            'active_tab' => 'Home',
            'code' => $code,
            'document' => $document,
            'receives' => $receives, 
            'releases' => $releases,
            'user' => $user, 
            'logged_user_enrolledgroup_as_doc_verifier'=>$logged_user_enrolledgroup_as_doc_verifier

        ];
        return view('document_details', $data);
    }

    

    public function onhand(): string
    {
        $data = [
            'active_tab' => 'Home',
            'user_pending_docs' => []
        ];
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $receiveLogModel = new ReceivelogModel();
        $user_pending_docs = $receiveLogModel->get_user_pending_documents($user_id);
        $data['user_pending_docs'] = $user_pending_docs;
        return view('onhand', $data);
    }

    public function my_docs(): string
    {
        $data = [
            'active_tab' => 'Home',
            'user_docs' => []
        ];
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $documentModel = new DocumentModel();
        $user_docs = $documentModel->get_documents_by_userid($user_id);
        $data['user_docs'] = $user_docs;
        return view('my_docs', $data);
    }

    public function get_loggeduser_pending_doc_count(): string
    {
        $data = [
            'pending_doc_count' => 0,
        ];
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $receiveLogModel = new ReceivelogModel();
        $user_pending_docs = $receiveLogModel->get_user_pending_documents($user_id);
        $data['pending_doc_count'] = count($user_pending_docs);
        return json_encode($data);
    }

    public function get_loggeduser_doc_count(): string
    {
        $data = [
            'pending_doc_count' => 0,
        ];
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $documentModel = new DocumentModel();
        $user_doc_count = $documentModel->get_documents_by_userid($user_id);
        $data['doc_count'] = count($user_doc_count);
        return json_encode($data);
    }


    public function release_doc(): string //ok
    {
        $data = [
            'active_tab' => 'Home'
        ];
        return view('release_doc', $data);
    }


    public function confirm_receive_qrcode_data($code): string
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // $user_document_transact_status = $this->get_user_document_transact_status($user_id, $code);
        // create objects for all required models
        $docModel = new DocumentModel();
        $userModel = new UserModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();

        // 
        $document = $docModel->get_document_by_code($code);
        $receiveLog = $receiveLogModel->get_by_code($code);
        $releaseLog = $releaseLogModel->get_by_code($code);
        $user = $userModel->get_user_by_id($user_id);

        $data = [
            'is_doc_null' => false,
            'active_tab' => 'Home',
            'user_data' =>  $user,
            'lastuser_data' => [],
            'document' => $document,
            'receiveLog' => $receiveLog,
            'is_me_last_receive' => '',
            'is_last_user_released' => '',
            'code' => $code




        ];
        // check if the document exists
        if ($document == null) {
            $data['is_doc_null'] = true;
        } else {
            // if document has record in receive table
            $document_owner =  $userModel->get_user_by_id($document['user_id'])['user_username'];
            $data['document_owner'] = $document_owner;

            $data['lastuser_data'] =  $userModel->get_user_by_id($receiveLog[0]['user_id']);
            if (count($releaseLog) === 0) {
                if ($receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                }
            } else {

                if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = true;
                } else if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $releaseLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = true;
                }
            }
        }

        return view('confirm_receive_qrcode_data', $data);
    }
    public function confirm_release_qrcode_data($code): string
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // $user_document_transact_status = $this->get_user_document_transact_status($user_id, $code);
        // create objects for all required models
        $docModel = new DocumentModel();
        $userModel = new UserModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();

        // 
        $document = $docModel->get_document_by_code($code);
        $receiveLog = $receiveLogModel->get_by_code($code);
        $releaseLog = $releaseLogModel->get_by_code($code);
        $user = $userModel->get_user_by_id($user_id);

        $data = [
            'is_doc_null' => false,
            'active_tab' => 'Home',
            'user_data' =>  $user,
            'lastuser_data' => [],
            'document' => $document,
            'receiveLog' => $receiveLog,
            'is_me_last_receive' => '',
            'is_last_user_released' => '',
            'code' => $code



        ];
        // check if the document exists
        if ($document == null) {
            $data['is_doc_null'] = true;
        } else {
            // if document has record in receive table
            $document_owner =  $userModel->get_user_by_id($document['user_id'])['user_username'];
            $data['document_owner'] = $document_owner;

            $data['lastuser_data'] =  $userModel->get_user_by_id($receiveLog[0]['user_id']);
            if (count($releaseLog) === 0) {
                if ($receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                }
            } else {

                if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = true;
                } else if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $releaseLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = true;
                }
            }
        }

        return view('confirm_release_qrcode_data', $data);
    }
    public function confirm_release_tracking_code_data($code): string
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // $user_document_transact_status = $this->get_user_document_transact_status($user_id, $code);
        // create objects for all required models
        $docModel = new DocumentModel();
        $userModel = new UserModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();

        // 
        $document = $docModel->get_document_by_code($code);
        $receiveLog = $receiveLogModel->get_by_code($code);
        $releaseLog = $releaseLogModel->get_by_code($code);
        $user = $userModel->get_user_by_id($user_id);

        $data = [
            'is_doc_null' => false,
            'active_tab' => 'Home',
            'user_data' =>  $user,
            'lastuser_data' => [],
            'document' => $document,
            'receiveLog' => $receiveLog,
            'is_me_last_receive' => '',
            'is_last_user_released' => '',
            'code' => $code



        ];
        // check if the document exists
        if ($document == null) {
            $data['is_doc_null'] = true;
        } else {
            // if document has record in receive table
            $document_owner =  $userModel->get_user_by_id($document['user_id'])['user_username'];
            $data['document_owner'] = $document_owner;

            $data['lastuser_data'] =  $userModel->get_user_by_id($receiveLog[0]['user_id']);
            if (count($releaseLog) === 0) {
                if ($receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                }
            } else {

                if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                    $data['is_me_last_receive'] = true;
                    $data['is_last_user_released'] = true;
                } else if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = false;
                } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $releaseLog[0]['user_id'] !== $user_id) {
                    $data['is_me_last_receive'] = false;
                    $data['is_last_user_released'] = true;
                }
            }
        }

        return view('confirm_release_tracking_code_data', $data);
    }


    public function confirm_receive_tracking_code_data($code): string //working on it now ------------------------------------------------
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // $user_document_transact_status = $this->get_user_document_transact_status($user_id, $code);
        // create objects for all required models
        $docModel = new DocumentModel();
        $userModel = new UserModel();
        $receiveLogModel = new ReceivelogModel();
        $releaseLogModel = new ReleaselogModel();

        // 
        $document = $docModel->get_document_by_code($code);
        $receiveLog = $receiveLogModel->get_by_code($code);
        $releaseLog = $releaseLogModel->get_by_code($code);
        $user = $userModel->get_user_by_id($user_id);

        $data = [
            'is_doc_null' => false,
            'active_tab' => 'Home',
            'user_data' =>  $user,
            'lastuser_data' => [],
            'document' => $document,
            'is_user_allow_receive' => true,
            'receiveLog' => $receiveLog,
            'last_user_confirm_release' => '',
            'already_received' => '',
            'code' => $code

        ];
        // check if the document exists
        if ($document == null) {
            $data['is_doc_null'] = true;
        } else {
            // if document has record in receive table
            $document_owner =  $userModel->get_user_by_id($document['user_id'])['user_username'];
            $data['document_owner'] = $document_owner;
            if (count($receiveLog) == 0) {
                $data['is_user_allow_receive'] = true;
            } else {
                $data['lastuser_data'] =  $userModel->get_user_by_id($receiveLog[0]['user_id']);
                if (count($releaseLog) == 0) {
                    $data['is_user_allow_receive'] = false;
                } else {


                    if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                        $data['is_user_allow_receive'] = false;
                        $data['already_received'] = true;
                        $data['last_user_confirm_release'] = false;
                    } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] == $user_id) {
                        $data['is_user_allow_receive'] = true;
                        $data['last_user_confirm_release'] = true;
                    } else if (($releaseLog[0]['releaselog_timestamp'] < $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] !== $user_id) {
                        $data['last_user_confirm_release'] = false;
                        $data['is_user_allow_receive'] = false;
                    } else if (($releaseLog[0]['releaselog_timestamp'] > $receiveLog[0]['receivelog_timestamp']) && $receiveLog[0]['user_id'] !== $user_id) {
                        $data['last_user_confirm_release'] = true;
                        $data['is_user_allow_receive'] = true;
                    }
                }
            }
        }

        return view('confirm_receive_tracking_code_data', $data);
    }


    public function submit_register_doc()
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // Create an instance of the DocumentModel
        $model = new DocumentModel();
        $receivelogModel = new ReceivelogModel();
        helper(['my_helper', 'form']);



        // Data to be inserted
        $modeldata = [
            'document_name' => $this->request->getVar('name'),
            'document_date' => $this->request->getVar('date'),
            'document_code' => $this->request->getVar('tracking_code'),
            'document_qrcode' => $this->request->getVar('qrcode'),
            'user_id' => $user_id,
            'document_remark' => $this->request->getVar('remark'),
            'document_office_name' => $this->request->getVar('office_name'),
            'document_type' => $this->request->getVar('document_type'),

        ];
        $res_data = [
            'active_tab' => 'Home',
            'name' => $this->request->getVar('name'),
            'remark' => $this->request->getVar('remark'),
            'office_name' => $this->request->getVar('office_name'),
            'tracking_code' => $this->request->getVar('tracking_code'),
            'message' => '',
            'is_success' => null,
            'date' => $this->request->getVar('date'),
            'document_type' => $this->request->getVar('document_type'),
        ];

        // Call the add_document method to insert the record
        $insertedId = $model->add_document($modeldata);
        $receivelogModelNewData = [
            'document_id' => $insertedId,
            'user_id' =>  $user_id,
            'receivelog_remark' => '(Initial log upon registration)'
        ];
        $insertedReceivetLogId = $receivelogModel->add($receivelogModelNewData);



        // Check if the record was successfully inserted
        if ($insertedReceivetLogId) {
            $res_data['message'] = 'Document added successfully.';
            $res_data['is_success'] = true;
            // return view('form_tracking_print_page', $res_data);
            return redirect()->to('/tracking_form_print_page/' . $this->request->getVar('tracking_code'));
        } else {
            $res_data['message'] = 'Failed to add document.';
            $res_data['is_success'] = false;
        }

        return view('register_doc', $res_data); 
    }

    public function submit_delete_doc()
    {
        $doc_code = $this->request->getVar('code');
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        // Create an instance of the DocumentModel
        $model = new DocumentModel();

        helper(['my_helper', 'form']);


        // execute deletion
        $res =  $model->delete_document_by_code($doc_code);

        $res_data = [
            'is_success'=>$res,
            'message'=>''
        ];


        // Check if the record was successfully inserted
        if ($res===true) {
            $res_data['message'] = 'Document deleted successfully.';
            $res_data['is_success'] = true;
        } else {
            $res_data['message'] = 'Something went wrong.';
            $res_data['is_success'] = false;
        }

        return json_encode($res_data); 
    }
    public function tracking_form_print_page($tracking_code) // done
    {
        $docModel = new DocumentModel();
        $userModel = new UserModel();


        $document = $docModel->get_document_by_code($tracking_code);
        $user = $userModel->get_user_by_id($document['user_id']);
        $data = [
            'active_tab' => 'Home',
            'name' => $document['document_name'],
            'remark' => $document['document_remark'],
            'office_name' => $document['document_office_name'],
            'tracking_code' => $document['document_code'],
            'message' =>  'This document is registered.',
            'is_success' => null,
            'date' =>  $document['document_date'],
            'qrcode' =>  $document['document_qrcode'],
            'user_username' =>   $user['user_username'],
            'document_type' => $document['document_type']
        ];
        return view('tracking_form_print_page', $data);
    }

    public function add_receivelog()
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $data = [
            'document_id' => $this->request->getVar('doc_id'),
            'user_id' => $user_id,
            'receivelog_remark' => $this->request->getVar('remark'),
        ];
        $receivelogModel = new ReceivelogModel();

        $lastId = $receivelogModel->add($data);

        $res_data = [
            'message' => 'Failed'
        ];
        if ($lastId >= 1) {
            $res_data['message'] = 'Transaction posted successfully.';
        }

        return json_encode($res_data);
    }
    public function add_releaselog()
    {
        $session = session();
        $user_id = $session->get('userData')['user_id'];
        $doc_id = $this->request->getVar('doc_id');
        $remark = $this->request->getVar('remark');
        $receivelogModel = new ReceivelogModel();
        $receivelogModelLastIdByUser = $receivelogModel->get_last_id_by_user_id($user_id, $doc_id)['receivelog_id'];

        $data = [
            'document_id' => $doc_id,
            'user_id' => $user_id,
            'releaselog_remark' =>  $remark,
            'receivelog_id' => $receivelogModelLastIdByUser,

        ];
        $releaselogModel = new ReleaselogModel();

        $lastId = $releaselogModel->add($data);
 
        $res_data = [
            'message' => 'Failed'
        ];
        if ($lastId >= 1) {
            
            // update document as non deletable
            $documentModel = new DocumentModel();
            $data['status'] = $documentModel->update_by_document_id($doc_id,['document_delete_allowed' => '1']); 

            $res_data['message'] = 'Transaction posted successfully.';
    
        }

        return json_encode($res_data);
    }
}
