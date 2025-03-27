<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificationModel extends Model
{
    protected $table = 'notification';
    protected $primaryKey = 'notification_id';
    protected $allowedFields = ['notification_sender_user_id','notification_receiver_user_id','notification_type', 'notification_message', 'notification_link_data', 'notification_is_read', 'notification_timestamp']; // Added 'remember_token' field

    public function add($data)//add new notification
    {
        // Insert the data into the 'notification' table
        $this->insert($data);

        // Return the ID of the inserted record 
        return $this->db->insertID();
    }

    public function update_notification_is_read($notification_id, $notification_is_read)
    {

        return $this->where('notification_id', $notification_id)->set('notification_is_read', $notification_is_read)->update();
    }



    public function get_all_unread_notification($userId) // get user all unread notifications
    {
        return $this->where(['notification_is_read' => 0, 'notification_receiver_user_id' => $userId])->findAll();
    }
}
