<?php

namespace App\Models;

use CodeIgniter\Model;

class EnrolledgroupModel extends Model
{
    protected $table = 'enrolledgroup';
    protected $primaryKey = 'enrolledgroup_id';
    protected $allowedFields = ['dtgroup_id', 'user_id', 'enrolledgroup_role', 'enrolledgroup_as_doc_verifier']; // Added 'remember_token' field
    // Function to insert a new record into the database
    public function add_enrollment($data)
    {
        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }

    public function get_enrolledgroup_by_user_id($user_id)
    {
        $sql = "SELECT  
            enrolledgroup.enrolledgroup_id, 
            enrolledgroup.user_id, 
            enrolledgroup.dtgroup_id, 
            enrolledgroup.enrolledgroup_role,
            enrolledgroup.enrolledgroup_as_doc_verifier,
            dtgroup.dtgroup_name,
            dtgroup.dtgroup_pic
        FROM enrolledgroup
        LEFT JOIN dtgroup ON dtgroup.dtgroup_id = enrolledgroup.dtgroup_id 
        WHERE enrolledgroup.user_id = ?

    ";

        $query = $this->db->query($sql, [$user_id]);
        return $query->getResultArray();
    }

    public function get_group_members($groupid)
    {
        $sql = " SELECT  
                    enrolledgroup.enrolledgroup_id, 
                    enrolledgroup.user_id, 
                    enrolledgroup.dtgroup_id, 
                    enrolledgroup.enrolledgroup_role,
                    enrolledgroup.enrolledgroup_timestamp,
                    enrolledgroup.enrolledgroup_as_doc_verifier,
                    user.user_username,
                    user.user_firstname,
                    user.user_lastname,
                    user.user_position,
                    user.user_access_role,
                    user.user_pic_filename,
                    dtgroup.dtgroup_name
                FROM enrolledgroup
                LEFT JOIN dtgroup ON dtgroup.dtgroup_id = enrolledgroup.dtgroup_id 
                LEFT JOIN user ON user.user_id = enrolledgroup.user_id
                WHERE dtgroup.dtgroup_id = ?";

        $query = $this->db->query($sql, [$groupid]);
        return $query->getResultArray();
    }

    public function get_user_groupmates($user_id) //get user all groupmates in all groups
    {
        $sql = "SELECT                
                    enrolledgroup.enrolledgroup_id, 
                    enrolledgroup.user_id, 
                    enrolledgroup.dtgroup_id, 
                    enrolledgroup.enrolledgroup_role,
                    enrolledgroup.enrolledgroup_timestamp,
                    enrolledgroup.enrolledgroup_as_doc_verifier,
                    user.user_username,
                    user.user_firstname,
                    user.user_lastname,
                    user.user_position,
                    user.user_access_role,
                    user.user_pic_filename,
                    user.user_office,
                    dtgroup.dtgroup_name
                FROM enrolledgroup
                LEFT JOIN dtgroup ON dtgroup.dtgroup_id = enrolledgroup.dtgroup_id 
                LEFT JOIN user ON user.user_id = enrolledgroup.user_id
                WHERE  enrolledgroup.dtgroup_id IN (SELECT dtgroup_id  FROM enrolledgroup WHERE enrolledgroup.user_id = ? )
                GROUP BY user.user_username;";

        $query = $this->db->query($sql, [$user_id]);
        return $query->getResultArray();
    }

    public function get_by_group_id($groupid)
    {
        return $this->where('dtgroup_id', $groupid)->findAll();
    }

    public function get_all_where($array_data)
    {
        return $this->where($array_data)->findAll();
    }
    public function get_first_where($array_data)
    {
        return $this->where($array_data)->first();
    }

    public function delete_by_enrolledgroup_id($enrolledgroup_id)
    {
        return $this->delete($enrolledgroup_id);
    }



    public function update_by_enrolledgroup_id($enrolledgroup_id, $data)
    {
        return $this->where('enrolledgroup_id', $enrolledgroup_id)->set($data)->update();
    }





    public function delete_by_groupid_user_id($groupid, $user_id)
    {
        $sql = "DELETE    
        FROM enrolledgroup
        WHERE enrolledgroup.dtgroup_id = ?
        AND  enrolledgroup.user_id = ?

    ";

        $query = $this->db->query($sql, [$groupid, $user_id]);
        return $query; //->getResultArray();
    }

    public function get_user_ids($groupid) // get the user ids of enrolled members in the group
    {
        $sql = " SELECT  user_id
                FROM enrolledgroup
                WHERE dtgroup_id = ?
    ";
        $query = $this->db->query($sql, [$groupid]);
        return $query->getResultArray();
    }
}
