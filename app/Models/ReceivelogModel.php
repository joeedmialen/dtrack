<?php

namespace App\Models;

use CodeIgniter\Model;

class ReceivelogModel extends Model
{
    protected $table = 'receivelog';
    protected $primaryKey = 'receivelog_id';
    protected $allowedFields = ['receivelog_remark', 'user_id', 'document_id', 'receivelog_timestamp'];

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
            receivelog.receivelog_id, 
            receivelog.receivelog_remark, 
            receivelog.user_id, 
            receivelog.document_id, 
            receivelog.receivelog_timestamp,
            document.document_name, 
            document.document_date, 
            document.document_code,  
            document.document_remark, 
            document.document_office_name,
            log_user.user_username AS user_username,
            log_user.user_pic_filename,
            log_user.user_office,
            owner.user_username AS owner
        FROM receivelog
        LEFT JOIN document ON receivelog.document_id = document.document_id
        LEFT JOIN user as owner ON owner.user_id = document.user_id
        LEFT JOIN user as log_user ON log_user.user_id = receivelog.user_id
        WHERE document.document_code = ?
        ORDER BY receivelog_timestamp DESC
    ';

        $query = $this->db->query($sql, [$tracking_code]);
        return $query->getResultArray();
    }

    public function getby_userid_docid($user_id, $document_id)
    {
        $sql = '
        SELECT  
            receivelog.receivelog_id, 
            receivelog.receivelog_remark, 
            receivelog.user_id, 
            receivelog.document_id, 
            receivelog.receivelog_timestamp,
            document.document_name, 
            document.document_date, 
            document.document_code, 
            document.document_remark, 
            document.document_office_name
        FROM receivelog
        LEFT JOIN document ON receivelog.document_id = document.document_id
        WHERE document.document_id = ?
        AND  document.user_id = ?
        ORDER BY receivelog_timestamp DESC
    ';
        $query = $this->db->query($sql, [$user_id, $document_id]);
        return $query->getResultArray();
    }
    public function get_user_pending_documents($user_id)
    {

        log_message('error',"user id is : $user_id");
        $sql = '
            SELECT  DISTINCT
                receivelog.receivelog_id, 
                receivelog.receivelog_remark, 
                receivelog.user_id, 
                receivelog.document_id, 
                receivelog.receivelog_timestamp,
                document.document_name, 
                document.document_date, 
                document.document_code, 
                document.document_remark, 
                document.document_office_name,
                document.document_delete_allowed,
                user.user_username
            FROM receivelog
            LEFT JOIN document ON receivelog.document_id = document.document_id
            LEFT JOIN user ON user.user_id = receivelog.user_id
            WHERE receivelog.receivelog_id NOT IN (
                    SELECT releaselog.receivelog_id FROM releaselog
                    WHERE releaselog.user_id = ?
                    )
            AND receivelog.user_id = ?
            GROUP BY receivelog.document_id
            ORDER BY  receivelog.receivelog_timestamp ASC;
            ';
        $query = $this->db->query($sql, [$user_id,$user_id]);
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

    public function get_last_id_by_user_id($user_id,$document_id)
    {
        $criteria = [
            'user_id' => $user_id,
            'document_id' => $document_id,

        ];
        return $this->where($criteria)->orderBy('receivelog_timestamp', 'DESC')->first();
    }

}
