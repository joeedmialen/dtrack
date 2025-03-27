<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'message_id';
    protected $allowedFields = ['message_text','message_timestamp','user_id','message_recipient_user_id']; // Added 'remember_token' field
    // Function to insert a new record into the database
    public function add_message($data)
    {
        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }



    public function get_message($user_username)
    {
        return $this->where('user_username', $user_username)->findAll();
    }



}
