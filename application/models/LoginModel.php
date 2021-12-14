<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LoginModel extends CI_Model
{
    public function loginUserModel($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_username', $username);
        $this->db->where('ud_password', $password);
        return $this->db->get()->row_array();
    }

    public function registerUserModel($name, $institute, $username, $password)
    {
        $insert = array(
            'ud_fullname' => $name,
            'ud_institution' => $institute,
            'ud_username' => $username,
            'ud_password' => $password,
            'ud_log' => date('H:i:sA d/m/Y')
        );

        return $this->db->insert('user_data', $insert);
    }

    public function checkUsernameAvailibilityModel($username)
    {
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->where('ud_username', $username);
        return $this->db->get()->row_array();
    }
}
