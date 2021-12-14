<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProfileModel');
    }

    public function index()
    {
        $data['profiles'] = $this->getUserProfile();
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('ProfileInterface', $data);
        $this->load->view('templates/Footer');
    }

    public function getUserProfile()
    {
        return $this->ProfileModel->getUserProfileModel();
    }
}
