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
}
