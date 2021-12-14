<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HistoryController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('HistoryModel');
    }

    public function index()
    {
        $data['history'] = $this->getUploadedFile();
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('HistoryInterface', $data);
        $this->load->view('templates/Footer');
    }


    public function getUploadedFile()
    {
        return $this->HistoryModel->getUploadedFileModel();
    }
}
