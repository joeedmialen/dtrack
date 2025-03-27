<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
    protected $table = 'dtgroup';
    protected $primaryKey = 'dtgroup_id';
    protected $allowedFields = ['dtgroup_id','dtgroup_pic','user_id','dtgroup_name']; // Added 'remember_token' field
    // Function to insert a new record into the database
    public function add_group($data)
    {
        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }



    public function get_by_group_id($groupid)
    {
        return $this->where('dtgroup_id', $groupid)->first();
    }

    public function update_picture_filename($group_id, $new_fileneme)
    {

        return $this->where('dtgroup_id', $group_id)->set('dtgroup_pic', $new_fileneme)->update();
    }



}
