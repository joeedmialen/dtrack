<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatroomModel extends Model
{
    protected $table = 'chatroom';
    protected $primaryKey = 'chatroom_id';
    protected $allowedFields = ['chatroom_text', 'chatroom_timestamp', 'dtgroup_id', 'user_id'];
    // Function to insert a new record into the database
    public function add_msg($data)
    {
        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }
    public function get_all_where($data_as_criteria)
    {
        return $this->where($data_as_criteria)->findAll();
    }
    public function get_first_where($data_as_criteria)
    {
        return $this->where($data_as_criteria)->first();
    }

    public function get_groupchats($dtgroup_id)
    {
        $sql = "
        SELECT 
        chatroom.chatroom_id,
        chatroom.chatroom_text,
        chatroom.chatroom_timestamp,
        chatroom.dtgroup_id,
        chatroom.user_id,
        user.user_username,
        user.user_firstname,
        user.user_lastame,
        user.user_position
        FROM chatroom
        LEFT JOIN user ON user.user_id = chatroom.user_id
        WHEREchatroom.dtgroup_id = ?
        ORDER BY  document.document_date DESC
        ";
        $query = $this->db->query($sql, [$dtgroup_id]);
        return $query->getResultArray();
    }

    public function get_new_msg($group_id, $last_chatroom_id, $limit = 50)
    {
        $sql = " SELECT * FROM 
                            (SELECT 
                            chatroom.chatroom_id,
                            chatroom.chatroom_text,
                            chatroom.chatroom_timestamp,
                            chatroom.dtgroup_id,
                            chatroom.user_id,
                            user.user_username,
                            user.user_firstname,
                            user.user_lastname,
                            user.user_pic_filename,
                            user.user_position
                            FROM chatroom
                            LEFT JOIN user ON user.user_id = chatroom.user_id
                            WHERE chatroom.dtgroup_id = ?
                            AND chatroom.chatroom_id > ?
                            ORDER BY  chatroom.chatroom_id DESC
                            LIMIT ?) subqery 
                            ORDER BY subqery.chatroom_id ASC
                        ";
        $query = $this->db->query($sql, [$group_id, $last_chatroom_id, $limit]);
        return $query->getResultArray();
    }
    public function get_older_msg($group_id, $last_chatroom_id, $limit = 50)
    {
        $sql = "SELECT * FROM 
                        (SELECT 
                        chatroom.chatroom_id,
                        chatroom.chatroom_text,
                        chatroom.chatroom_timestamp,
                        chatroom.dtgroup_id,
                        chatroom.user_id,
                        user.user_username,
                        user.user_firstname,
                        user.user_lastname,
                        user.user_pic_filename,
                        user.user_position
                        FROM chatroom
                        LEFT JOIN user ON user.user_id = chatroom.user_id
                        WHERE chatroom.dtgroup_id = ?
                        AND chatroom.chatroom_id < ?
                        ORDER BY  chatroom.chatroom_id DESC
                        LIMIT ?) subqery 
                    ORDER BY subqery.chatroom_id ASC
                    ";
        $query = $this->db->query($sql, [$group_id, $last_chatroom_id, $limit]);
        return $query->getResultArray();
    }

    public function get_first_record($group_id)
    {
        $sql = "SELECT *
        FROM chatroom
        WHERE chatroom.dtgroup_id = ?
        ORDER BY  chatroom.chatroom_id ASC
        LIMIT 1;
        ";
        $query = $this->db->query($sql, [$group_id]);
        return $query->getResultArray();
    }
}
