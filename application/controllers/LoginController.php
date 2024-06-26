<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModel');
    }

    public function index()
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('LoginInterface');
        $this->load->view('templates/Footer');
    }

    public function loginUser()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $return = $this->LoginModel->loginUserModel($username, $password);

        if ($return !== NULL) {
            $this->session->set_userdata('uid', $return['ud_id']);
            $this->session->set_tempdata('notice', 'Login successful.', 1);
            redirect(base_url() . 'analysis');
        } else {
            $this->session->set_tempdata('error', 'Wrong username or password entered.', 1);
            redirect(base_url() . 'login');
        }
    }

    public function registerUser()
    {
        $name = $this->input->post('name');
        $institute = $this->input->post('institute');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $c_password = $this->input->post('c_password');

        if ($password !== $c_password) {
            $this->session->set_tempdata('error', 'Password does not match, please register again.', 1);
            redirect(base_url() . 'login');
        } else if ($this->checkUsernameAvailibility($username) !== null) {
            $this->session->set_tempdata('error', 'Username has been taken, please choose another username.', 1);
            redirect(base_url() . 'login');
        } else {
            if ($this->LoginModel->registerUserModel($name, $institute, $username, md5($password)) === true) {
                $this->loginUser($username, $password);
            } else {
                $this->session->set_tempdata('error', 'Registration failed, please register again.', 1);
                redirect(base_url() . 'login');
            }
        }
    }

    public function checkUsernameAvailibility($username)
    {
        return $this->LoginModel->checkUsernameAvailibilityModel($username);
    }

    public function logoutUser()
    {
        $session_data = array(
            'uid',
        );

        $this->session->set_tempdata('notice', 'You have logout successfully.', 1);
        $this->session->unset_userdata($session_data);

        redirect();
    }

    // Ajax Request
    public function loginUserAjax()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        echo json_encode($this->LoginModel->loginUserModel($username, $password));
        exit;
    }

    public function registerUserAjax()
    {
        $name = $this->input->post('name');
        $institute = $this->input->post('institute');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $c_password = $this->input->post('c_password');

        if ($password !== $c_password) {
            echo json_encode('Password does not match, please re-enter password again.');
            exit;
        } else if ($this->checkUsernameAvailibility($username) !== null) {
            echo json_encode('Username has been taken, please choose another username.');
            exit;
        } else {
            if ($this->LoginModel->registerUserModel($name, $institute, $username, md5($password)) === true) {
                $this->loginUserAjax($username, $password);
            } else {
                echo json_encode('Registration failed, please register again.');
                exit;
            }
        }
    }
}
