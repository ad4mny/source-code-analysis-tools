<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AccountModel');
    }

    public function index()
    {
        $data['profiles'] = $this->getUserProfile();
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('AccountInterface', $data);
        $this->load->view('templates/Footer');
    }

    public function getUserProfile()
    {
        return $this->AccountModel->getUserProfileModel();
    }
}
