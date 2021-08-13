<?php

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page = 'login')
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        if ($page === 'login') {
            $this->load->view('LoginInterface');
        } else {
            $this->load->view('RegisterInterface');
        }
        $this->load->view('templates/Footer');
    }
}
