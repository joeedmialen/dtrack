<?php

namespace App\Models;

use CodeIgniter\Model;

class ReleaselogModel extends Model
{
    protected $table = 'releaselog';
    protected $primaryKey = 'releaselog_id';
    protected $allowedFields = ['releaselog_remark', 'user_id', 'document_id', 'releaselog_timestamp','receivelog_id'];
    // Function to insert a new record into the database
    public function add($data)
    {
        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }
    public function count_by_userid($user_id)
    {
        return count($this->where('user_id', $user_id)->findAll());
    }


    public function get_by_code($tracking_code)
    {
        $sql = 'SELECT  
            releaselog.releaselog_id, 
            releaselog.releaselog_remark, 
            releaselog.user_id, 
            releaselog.document_id, 
            releaselog.releaselog_timestamp,
            document.document_name, 
            document.document_date, 
            document.document_code,  
            document.document_remark, 
            document.document_office_name,
            user_log.user_username AS user_username,
            user_log.user_pic_filename,
            user_log.user_office,
            owner.user_username AS owner
        FROM releaselog
        LEFT JOIN document ON releaselog.document_id = document.document_id
        LEFT JOIN user owner ON owner.user_id =  document.user_id
        LEFT JOIN user user_log ON user_log.user_id = releaselog.user_id 
        WHERE document.document_code = ?
        ORDER BY releaselog_timestamp DESC
    ';

        $query = $this->db->query($sql, [$tracking_code]);
        return $query->getResultArray();
    }

    public function getby_userid_docid($user_id, $document_id)
    {
        $sql = 'SELECT  
            releaselog.releaselog_id, 
            releaselog.releaselog_remark, 
            releaselog.user_id, 
            releaselog.document_id, 
            releaselog.releaselog_timestamp,
            document.document_name, 
            document.document_date, 
            document.document_code, 
            document.document_remark, 
            document.document_office_name
        FROM releaselog
        LEFT JOIN document ON releaselog.document_id = document.document_id
        WHERE document.document_id = ?
        AND  document.user_id = ?
        ORDER BY releaselog_timestamp DESC
    ';
        $query = $this->db->query($sql, [$user_id, $document_id]);
        return $query->getResultArray();
    }
    public function get_by_documnent_id($document_id)
    {
        $criteria = [
            'document_id' => $document_id
        ];

        // print_r($this->where($criteria)->findAll());
        // print_r($this->db->getLastQuery());
        return $this->where($criteria)->orderBy('auditlog_timestamp', 'DESC')->findAll();
    }
}
