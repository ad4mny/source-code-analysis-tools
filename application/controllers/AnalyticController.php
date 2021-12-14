<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AnalyticController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AnalyticModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('AnalyticInterface');
        $this->load->view('templates/Footer');
    }

    public function uploadFile()
    {
        $config['upload_path'] = './storage/user-upload';
        $config['allowed_types'] = 'php';
        $config['max_size']     = '0';

        $this->upload->initialize($config);

        if (!isset($_SESSION['uid'])) {
            $this->session->set_tempdata('error', 'Please login first to begin code analysis.', 1);
            redirect(base_url() . 'analytic');
        } else {
            if (!$this->upload->do_upload('source_code')) {
                $this->session->set_tempdata('error', $this->upload->display_errors('', ''), 1);
                redirect(base_url() . 'analytic');
            } else {
                $filename = $this->upload->data('file_name');
                if ($this->AnalyticModel->uploadFileModel($filename) !== false) {
                    $data['scan'] = $this->doSQLTest($filename);
                    $this->session->set_tempdata('notice', 'Your source code has been scanned and the result stated as below.', 1);
                    $this->load->view('templates/Header');
                    $this->load->view('templates/Navigation');
                    $this->load->view('AnalyticResultInterface', $data);
                    $this->load->view('templates/Footer');
                } else {
                    $this->session->set_tempdata('error', 'Failed to upload your source code, internal server error.', 1);
                    redirect(base_url() . 'analytic');
                }
            }
        }
    }

    public function getResult($file_id)
    {
        $return = $this->AnalyticModel->getFileModel($file_id);
        if ($return !== false) {
            $data['scan'] = $this->doSQLTest($return['fd_name']);
            $this->session->set_tempdata('notice', 'Your source code has been scanned and the result stated as below.', 1);
            $this->load->view('templates/Header');
            $this->load->view('templates/Navigation');
            $this->load->view('AnalyticResultInterface', $data);
            $this->load->view('templates/Footer');
        } else {
            $this->session->set_tempdata('error', 'Failed to get your source code, internal server error.', 1);
            redirect(base_url() . 'analytic');
        }
    }

    public function doSQLTest($filename)
    {
        // define keyword
        $keyword_connection = ['con', 'conn', 'dbcon', 'db', 'dbconn'];
        $keyword_query = ['sql', 'stmt', 'query'];
        $saviors = ['prepare', 'execute'];

        // start the code analysis
        $startcompute = microtime(true);
        $filepath = './storage/user-upload/' . $filename;
        $codes = file($filepath);
        $i = 0;
        $count_errors = 0;
        $data = [];
        $flag = true;

        foreach ($saviors as $key => $value) {
            foreach ($codes as $lines => $content) {
                if (preg_match("/\b" . $value . "\b/iu", $content) == 1) {
                    foreach ($keyword_query as $queries) {
                        if (preg_match("/\b" . $queries . "\b/iu", $content) == 1) {
                            $flag = false;
                        }
                    }
                }
            }
        }

        if ($flag === true) {
            // scan for code vulnerablities
            foreach ($codes as $lines => $content) {

                foreach ($keyword_query as $queries) {

                    if (preg_match("/\b" . $queries . "\b/iu", $content) == 1) {
                        $flag = false;

                        foreach ($keyword_connection as $connections) {
                            if (preg_match("/\b" . $connections . "\b/iu", $content) == 1) {
                                $flag = true;
                                break;
                            }
                        }

                        if ($flag == true) {
                            if (preg_match("/\b" . $queries . "->execute\b/iu", $content) !== 1) {
                                ++$i;

                                $data[$i]['line'] = $lines;
                                $data[$i]['content'] = trim($content);
                                $data[$i]['desc'] = 'Execute the statement.';
                                $data[$i]['code'] = '$' . $queries . '->execute();';
                                $count_errors++;
                            }
                        } else {
                            if (preg_match("/\b" . "con->prepare" . "\b/iu", $content) !== 1) {

                                $code_flaws = explode('"', $content);

                                if (!isset($code_flaws[1])) {
                                    $code_flaws[1] = '';
                                }
                                ++$i;

                                $data[$i]['line'] = $lines;
                                $data[$i]['content'] = trim($content);
                                $data[$i]['desc'] = 'Prepare the statement.';
                                $data[$i]['code'] = '$' . $queries . ' = $con->prepare("' . $code_flaws[1] . '");';
                                $count_errors++;
                            }
                        }
                    }
                }
            }
        } else {
            $data = false;
            $count_errors = 0;
        }

        $endcompute = microtime(true);

        $result = array(
            'data' => $data,
            'time' => number_format((float)($endcompute - $startcompute), 5, '.', ''),
            'file' => $filename,
            'errors' => $count_errors,
            'date' => date('H:i:s d/m/Y')
        );

        return $result;
    }
}
