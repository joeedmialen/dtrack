<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_username', 'user_firstname', 'user_lastname', 'user_position', 'user_password', 'user_remember_token', 'user_timestamp', 'user_pic_filename', 'user_education', 'user_office', 'user_notes','user_dark_mode', 'user_header_fixed', 'user_sidebar_collapsed', 'user_sidebar_fixed', 'user_footer_fixed']; // Added 'remember_token' field

    // Add a method to update remember token
    public function updateRememberToken($userId, $rememberToken)
    {
        return $this->where('user_id', $userId)->set('user_remember_token', $rememberToken)->update();
    }

    public function update_picture_filename($user_id, $new_fileneme)
    {

        return $this->where('user_id', $user_id)->set('user_pic_filename', $new_fileneme)->update();
    }
    // Add a method to update remember token
    public function get_user_by_id($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    // Add a method to find user by remember token
    public function findByRememberToken($rememberToken)
    {
        return $this->where('user_remember_token', $rememberToken)->first();
    }

    public function update_by_user_id($user_id, $data)
    {
        return $this->where('user_id', $user_id)->set($data)->update();
    }

    
    public function update_user_setting($user_id, $data)
    {
        return $this->where('user_id', $user_id)->set($data)->update();
    }

    public function get_user_by_username($user_username)
    {
        return $this->where('user_username', $user_username)->findAll();
    }

    public function add_user($data)
    {

        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }
    public function update_password($user_username, $new_passwordn)
    {
        return $this->where('user_username', $user_username)->set('user_password', $new_passwordn)->update();
    }

    public function search_user_keyword($searchKey,$groupid)
    {
        $srchWord = "%$searchKey%";
        $sql = "SELECT
         user.user_id,
         user.user_username,
         user.user_firstname,
         user.user_lastname,
         user.user_pic_filename,
         user.user_office,
         enrolledgroup.dtgroup_id
        FROM user
        LEFT JOIN (
            SELECT dtgroup_id , user_id
            FROM enrolledgroup
            WHERE dtgroup_id = ?
        ) enrolledgroup on enrolledgroup.user_id = user.user_id
        WHERE user.user_username LIKE ?
        OR user.user_firstname LIKE ?
        OR user.user_lastname LIKE ?
        GROUP BY user.user_username
        LIMIT 100
        ";
        $query = $this->db->query($sql, [$groupid,$srchWord, $srchWord, $srchWord]);
        return $query->getResultArray();
    }
}
