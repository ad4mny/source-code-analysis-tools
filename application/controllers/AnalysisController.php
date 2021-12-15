<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AnalysisController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AnalysisModel');
        $this->load->library('upload');
    }

    public function index()
    {
        $this->load->view('templates/Header');
        $this->load->view('templates/Navigation');
        $this->load->view('UploadInterface');
        $this->load->view('templates/Footer');
    }

    public function uploadFile()
    {
        $upload_path = './storage/user-upload/' . hashin($_SESSION['uid']);

        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'php';
        $config['max_size']     = '0';

        $this->upload->initialize($config);

        if (!isset($_SESSION['uid'])) {

            $this->session->set_tempdata('error', 'Please login first to begin code analysis.', 1);
            redirect(base_url() . 'analysis');
        } else {

            if (!$this->upload->do_upload('source_code')) {

                $this->session->set_tempdata('error', $this->upload->display_errors('', ''), 1);
                redirect(base_url() . 'analysis');
            } else {

                $file_name = $this->upload->data('file_name');
                $file_id = $this->AnalysisModel->uploadFileModel($file_name);

                if ($file_id !== NULL) {
                    $data['scan'] = $this->doSQLCodeAnalysis($file_name, $file_id);

                    // add analysis data to database
                    $this->AnalysisModel->insertAnalysisDataModel($file_id, $data['scan']['time'], $data['scan']['errors'], $data['scan']['date']);

                    $this->session->set_tempdata('notice', 'Your source code has been scanned and the result stated as below.', 1);
                    redirect(base_url() . 'result/' . hashin($file_id));
                } else {
                    $this->session->set_tempdata('error', 'Failed to upload your source code, internal server error.', 1);
                    redirect(base_url() . 'analysis');
                }
            }
        }
    }

    public function getResult($file_id)
    {
        $file_id = hashout($file_id);
        $return = $this->AnalysisModel->getFileModel($file_id);

        if ($return !== false) {

            $data['scan'] = $this->doSQLCodeAnalysis($return['fd_name'], $file_id);

            $this->session->set_tempdata('notice', 'Your source code has been scanned and the result stated as below.', 1);

            $this->load->view('templates/Header');
            $this->load->view('templates/Navigation');
            $this->load->view('AnalysisInterface', $data);
            $this->load->view('templates/Footer');
        } else {
            $this->session->set_tempdata('error', 'Failed to get your source code, internal server error.', 1);
            redirect(base_url() . 'analysis');
        }
    }

    public function doSQLCodeAnalysis($file_name, $file_id)
    {
        // define keyword
        $keywords = ['$sql', '$stmt', '$query', '$result'];

        // start the code analysis
        $timer_start = microtime(true);
        $code_file = file('./storage/user-upload/' . hashin($_SESSION['uid']) . '/' . $file_name);
        $i = 0;
        $total_error = 0;
        $data = [];

        // extract full code as line and current line content
        foreach ($code_file as $lines => $content) {

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
                            $total_error++;
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
                            $total_error++;
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
                    $total_error++;
                    $i++;
                }
            }
        }

        $timer_end = microtime(true);
        $time_taken = number_format((float)($timer_end - $timer_start), 5, '.', '');

        $history = $this->AnalysisModel->getAnalysisHistoryModel($file_id);

        $analysis_data = array(
            'data' => $data,
            'time' => $time_taken,
            'file' => $file_name,
            'errors' => $total_error,
            'date' => date(DATE_RFC850),
            'history' => $history
        );

        return $analysis_data;
    }

    public function updateFile()
    {
        $file_id = hashout($this->input->post('file_id'));

        if ($this->AnalysisModel->deleteUploadedFile($file_id) !== false) {

            $config['upload_path'] =  './storage/user-upload/' . hashin($_SESSION['uid']);
            $config['allowed_types'] = 'php';
            $config['max_size']     = '0';

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('source_code')) {
                $this->session->set_tempdata('error', $this->upload->display_errors('', ''), 1);
            } else {

                $file_name = $this->upload->data('file_name');

                if ($this->AnalysisModel->updateFileModel($file_name, $file_id) !== false) {
                    $data['scan'] = $this->doSQLCodeAnalysis($file_name, $file_id);

                    // add analysis data to database
                    $this->AnalysisModel->insertAnalysisDataModel($file_id, $data['scan']['time'], $data['scan']['errors'], $data['scan']['date']);

                    $this->session->set_tempdata('notice', 'Your source code has been scanned and the result stated as below.', 1);
                    redirect(base_url() . 'result/' . hashin($file_id));
                } else {
                    $this->session->set_tempdata('error', 'Failed to upload your source code, internal server error.', 1);
                    redirect(base_url() . 'analysis');
                }
            }
        } else {
            $this->session->set_tempdata('error', 'Failed to delete existing file, internal server error.', 1);
            redirect(base_url() . 'history');
        }
    }

    public function deleteResult($file_id)
    {
        $file_id = hashout($file_id);
        if ($this->AnalysisModel->deleteResultModel($file_id) === TRUE) {
            $this->session->set_tempdata('notice', 'Result has been deleted successfully.', 1);
            redirect(base_url() . 'history');
        } else {
            $this->session->set_tempdata('error', 'Error occurred while deleting the result.', 1);
            redirect(base_url() . 'history');
        }
    }
}
