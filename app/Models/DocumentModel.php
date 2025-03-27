<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentModel extends Model
{
    protected $table = 'document';
    protected $primaryKey = 'document_id';
    protected $allowedFields = ['document_name','document_delete_allowed', 'document_date', 'document_code', 'document_qrcode', 'user_id', 'document_remark', 'document_office_name', 'document_type', 'document_date_ca', 'document_date_ada', 'document_date_liquidation'];

    // Function to insert a new record into the database
    public function add_document($data)
    {
        // Insert the data into the 'document' table
        $this->insert($data);

        // Return the ID of the inserted record
        return $this->db->insertID();
    }

    public function delete_document_by_code($doc_code)
    {
        {
            $sql = "DELETE    
            FROM document
            WHERE document.document_code = ?
           
    
        ";
    
            $query = $this->db->query($sql, [$doc_code]);
            return $query; //->getResultArray();
        }
    
    }

    public function get_document_by_code($tracking_code)
    {
        return $this->where('document_code', $tracking_code)->first();
    }
    public function count_by_userid($user_id)
    {
        return count($this->where('user_id', $user_id)->findAll());
    }

    public function get_documents_by_userid($user_id)
    {
        return $this->where('user_id', $user_id)->findAll();
    }


    public function update_by_document_id($document_id, $data)
    {
        return $this->where('document_id', $document_id)->set($data)->update();
    }



    public function search_document_keyword($searchKey)
    {
        $srchWord = "%$searchKey%";
        $sql = "
        SELECT 
        document.document_name, 
        document.document_date, 
        document.document_code, 
        document.document_remark, 
        document.document_office_name,
        document.document_date_liquidation,
        user.user_username
    FROM document
    LEFT JOIN user ON user.user_id = document.user_id
    WHERE document.document_code LIKE ?
    OR user.user_username LIKE ?
    OR document.document_remark LIKE  ?
    OR document.document_office_name LIKE ?
    OR document.document_name LIKE ?
    ORDER BY  document.document_date DESC
    ";
        $query = $this->db->query($sql, [$srchWord, $srchWord, $srchWord, $srchWord, $srchWord]);


        return $query->getResultArray();
    }

    public function get_enrolledgroup_document($group_id)
    {

        $sql = "SELECT 
                    document.document_id, 
                    document.document_name, 
                    document.document_date, 
                    document.document_type, 
                    document.document_date_ca, 
                    document.document_date_ada,
                    document.document_date_liquidation,
                    document.document_code, 
                    document.document_remark, 
                    document.document_office_name,
                    user.user_username,
                    user.user_firstname,
                    user.user_lastname,
                    user.user_pic_filename
                FROM document
                LEFT JOIN user ON user.user_id = document.user_id
                LEFT JOIN enrolledgroup ON enrolledgroup.user_id = document.user_id
                WHERE enrolledgroup.dtgroup_id  = ?
                GROUP BY document.document_code
                ORDER BY  document.document_date DESC
            ";
        $query = $this->db->query($sql, [$group_id]);


        return $query->getResultArray();
    }
}
