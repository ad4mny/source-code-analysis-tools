<?php

class AnalyticModel extends CI_Model
{

    public function uploadFileModel($filename)
    {
        // $data = array(
        //     'fd_ud_id' => $_SESSION['id'],
        //     'fd_name' => $filename,
        //     'fd_log' => date('H:i:s Y/m/d'),
        // );

        // return $this->db->insert('file_data', $data);
        return true;
    }
}
