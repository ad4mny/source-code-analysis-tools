<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountModel extends CI_Model
{
    public function getUserProfileModel()
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_id', $_SESSION['uid']);
        return $this->db->get()->row_array();
    }

}
