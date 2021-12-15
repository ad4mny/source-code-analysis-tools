<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AnalysisModel extends CI_Model
{
    public function uploadFileModel($filename)
    {
        $data = array(
            'fd_ud_id' => $_SESSION['uid'],
            'fd_name' => $filename,
            'fd_log' => date(DATE_RFC850),
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

    public function getFileNameModel($file_id)
    {
        $this->db->select('fd_name');
        $this->db->from('file_data');
        $this->db->where('fd_id', $file_id);
        return $this->db->get()->row_array();
    }

    public function updateFileModel($filename, $file_id)
    {
        $data = array(
            'fd_name' => $filename,
        );
        
        $this->db->where('fd_id', $file_id);
        return $this->db->update('file_data', $data);
    }

    public function deleteResultModel($file_id)
    {
        $this->db->where('fd_id', $file_id);

        if ($this->db->delete('file_data') !== false) {

            $this->db->where('ad_fd_id', $file_id);
            return $this->db->delete('analysis_data');
        } else {
            return false;
        }
    }
}
