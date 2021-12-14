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
        $keywords = ['$sql', '$stmt', '$query', '$result'];

        // start the code analysis
        $timer_start = microtime(true);
        $filepath = './storage/user-upload/' . $filename;
        $codes = file($filepath);
        $i = 0;
        $errors = 0;
        $data = [];

        // extract full code as line and current line content
        foreach ($codes as $lines => $content) {

            $flag = true;

            // loop through each rule for query keyword
            foreach ($keywords as $index => $keyword) {

                if (strpos($content, $keyword . ' =') !== false) {

                    // condition for different in single or double qoute usage
                    if (strpos($content, '"') !== false) {
                        $extracted_query = explode('"', $content);
                    } else if (strpos($content, "'") !== false) {
                        $extracted_query = explode("'", $content);
                    } else {
                        // false for none query statement found with qoutes
                        $flag = false;
                    }

                    if ($flag !== false) {
                        // compare SQL flaw code
                        if (
                            strpos($extracted_query[1], "=$") !== false ||
                            strpos($extracted_query[1], "= $") !== false ||
                            strpos($extracted_query[1], "='$") !== false ||
                            strpos($extracted_query[1], "= '$") !== false
                        ) {
                            $data[$i]['line'] = $lines + 1;
                            $data[$i]['content'] = trim($content);
                            $data[$i]['desc'] = 'Use PDO to prepare SQL query.';
                            $data[$i]['code'] = $keyword . ' = $con->prepare("SELECT * FROM example WHERE id = ?");<br>' .
                                $keyword . '->bind_param("s", $exampleid);';
                            $errors++;
                            $i++;
                        }
                    } else {
                        // else get connection flaw code
                        if (
                            strpos($content, "mysqli_query") !== false ||
                            strpos($content, "mysql_query") !== false
                        ) {
                            $data[$i]['line'] = $lines + 1;
                            $data[$i]['content'] = trim($content);
                            $data[$i]['desc'] = 'Use PDO to execute SQL query.';
                            $data[$i]['code'] = $keyword . '->execute();';
                            $errors++;
                            $i++;
                        }
                    }
                }
            }

            if (strpos($content, $keyword . ' =') === false) {
                // if connection flaw code does not satified above rules
                if (
                    strpos($content, "mysqli_query") !== false ||
                    strpos($content, "mysql_query") !== false
                ) {
                    $data[$i]['line'] = $lines + 1;
                    $data[$i]['content'] = trim($content);
                    $data[$i]['desc'] = 'Use PDO to execute SQL query.';
                    $data[$i]['code'] = $keyword . '->execute();';
                    $errors++;
                    $i++;
                }
            }
        }

        $timer_end = microtime(true);

        $result = array(
            'data' => $data,
            'time' => number_format((float)($timer_end - $timer_start), 5, '.', ''),
            'file' => $filename,
            'errors' => $errors,
            'date' => date(DATE_RFC850)
        );

        return $result;
    }

    public function deleteResult($file_id)
    {
        if ($this->AnalyticModel->deleteResultModel($file_id) === TRUE) {
            $this->session->set_tempdata('notice', 'Result has been deleted successfully.', 1);
            redirect(base_url() . 'history');
        } else {
            $this->session->set_tempdata('error', 'Error occurred while deleting the result.', 1);
            redirect(base_url() . 'history');
        }
    }
}
