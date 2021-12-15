<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AnalysisModel extends CI_Model
{
    public function uploadFileModel($filename)
    {
        $data = array(
            'fd_ud_id' => $_SESSION['uid'],
            'fd_name' => $filename,
            'fd_log' => date('h:i:s A d/m/Y'),
        );

        $this->db->insert('file_data', $data);
        return $this->db->insert_id();
    }

    public function getFileModel($file_id)
    {
        $this->db->select('*');
        $this->db->from('file_data');
        $this->db->where('fd_id', $file_id);

        return $this->db->get()->row_array();
    }

    public function insertAnalysisDataModel($file_id, $time_taken, $total_error, $date)
    {
        $data = array(
            'ad_fd_id' => $file_id,
            'ad_time_taken' => $time_taken,
            'ad_total_error' => $total_error,
            'ad_datetime' => $date
        );

        return $this->db->insert('analysis_data', $data);
    }

    public function deleteResultModel($file_id)
    {
        $this->db->where('fd_id', $file_id);
        return $this->db->delete('file_data');
    }
}
