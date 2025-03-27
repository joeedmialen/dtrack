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
use App\Models\NotificationModel;






class Notification extends BaseController
{



    public function add()
    {

        // $creator_user_id = session()->get('userData')['user_id'];

        $sender = $this->request->getVar('sender');
        $receiver = $this->request->getVar('receiver');
        $type = $this->request->getVar('type');
        $message = $this->request->getVar('message');
        $link_data = $this->request->getVar('link_data');

        $res_data = [
            'status' => false,
        ];

        $data = [
            'notification_sender_user_id' => $sender,
            'notification_receiver_user_id' => $receiver,
            'notification_type' => $type,
            'notification_message' => $message,
            'notification_link_data' => $link_data

        ];

        $notificationModel = new NotificationModel(); // new instance of group model
        $lastID = $notificationModel->add($data); //new instance of enrolledgroup


  

        if ($lastID  >= 1 ) {
            $res_data['status'] = true;
        }
        return json_encode($res_data);
    }



    public function get_all_unread_notification() //ok
    {

        $session = session();
        $user_id = $session->get('userData')['user_id'];

        $data = [
            'active_tab' => 'Group',
            'date' => date_format(new DateTime(), 'Y-m-d'),
            'unread_notifications' => []
        ];

        $notificationModel = new NotificationModel(); // new instance of group model
        $result = $notificationModel->get_all_unread_notification($user_id);

        $data['unread_notifications'] =  $result; 
        echo json_encode($data);
    }


    public function mark_read_notification() //ok
    {
        $notification_id =  $this->request->getVar('notification_id');
       log_message('error','mark_read_notification called');
        $data = [
            'active_tab' => 'Group',
            'unread_notifications' => [],
            'notification_id'=>$notification_id
        ];

        $notificationModel = new NotificationModel(); // new instance of group model
        $result = $notificationModel->update_notification_is_read($notification_id,1);

        $data['unread_notifications'] =  $result; 
        echo json_encode($data);
    }

    


}
