<?php

namespace App\Controllers;

use DateTime;
use App\Models\UserModel;
use App\Models\DocumentModel;
use App\Models\ReceivelogModel;
use App\Models\ReleaselogModel;

class Message extends BaseController
{

    public function messages(): string //ok
    {
        helper(['my_helper', 'form']);
        $data = [
            'name' => '',
            'testData' => "hello world",
            'tracking_code' => '',
            'active_tab' => 'My Profile',
            'date' => date_format(new DateTime(), 'Y-m-d')
        ];
        $session = session();
        $user_id = $session->get('userData')['user_id'];

        $user_model = new UserModel();
        $receiveLogModel = new ReceivelogModel();
        $documentModel = new DocumentModel();
        $releaselogModel = new ReleaselogModel();


        $user = $user_model->get_user_by_id($user_id);
        $user_pending_docs_count = count($receiveLogModel->get_user_pending_documents($user_id));

        $user_docs_count = $documentModel->count_by_userid($user_id);
        $user_release_count = $releaselogModel->count_by_userid($user_id);
        $user_receive_count = $receiveLogModel->count_by_userid($user_id);

        $data['user'] = $user;
        $data['doc_count'] = $user_docs_count;
        $data['user_release_count'] = $user_release_count;
        $data['user_receive_count'] = $user_receive_count;
        $data['user_pending_docs_count'] = $user_pending_docs_count;




        return view('messages', $data);
    }



    public function submit_profile_settings(): string
    {
        $user_id = session()->get('userData')['user_id'];
        $firstname =  $this->request->getVar('firstname');
        $lastname  = $this->request->getVar('lastname');
        $position = $this->request->getVar('position');
        $office = $this->request->getVar('office');

        $userModel = new UserModel();
        $data = [
            'user_firstname'=>strtoupper($firstname),
            'user_lastname'=>strtoupper($lastname),
            'user_office'=>strtoupper($office),
            'user_position'=>strtoupper($position)
        ];

        $result = $userModel->update_by_user_id($user_id, $data);

        $response = [
            'result'=>$result,
            'data'=> $data,
            'request'=>$this->request->getVar('firstname')
        ];

        return json_encode( $response);

    }
}
