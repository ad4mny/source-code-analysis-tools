<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndexController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('IndexInterface');
        $this->load->view('templates/Footer');
    }
}
