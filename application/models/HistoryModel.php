<?php

class HistoryModel extends CI_Model
{

    public function getUploadedFileModel()
    {
        $this->db->select('*');
        $this->db->from('file_data');
        $this->db->where('fd_ud_id', $_SESSION['uid']);
        return $this->db->get()->result_array();
    }
}
