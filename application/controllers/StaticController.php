<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StaticController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($page)
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        switch ($page) {
            case 'solution':
                $this->load->view('SolutionInterface');
                break;
            case 'pricing':
                $this->load->view('PricingInterface');
                break;
            case 'about':
                $this->load->view('AboutInterface');
                break;
            default:
                $this->load->view('IndexInterface');
                break;
        }
        $this->load->view('templates/Footer');
    }
}
