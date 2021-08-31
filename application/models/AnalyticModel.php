<?php

class AnalyticModel extends CI_Model
{

    public function uploadFileModel($filename)
    {
        $data = array(
            'fd_ud_id' => $_SESSION['uid'],
            'fd_name' => $filename,
            'fd_log' => date('h:i:s A d/m/Y'),
        );

        return $this->db->insert('file_data', $data);
    }

    public function getFileModel($file_id)
    {
        $this->db->select('*');
        $this->db->from('file_data');
        $this->db->where('fd_id', $file_id);

        return $this->db->get()->row_array();
    }
}
