<?php

class AnalyticController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('AnalyticInterface');
        $this->load->view('templates/Footer');
    }
}
