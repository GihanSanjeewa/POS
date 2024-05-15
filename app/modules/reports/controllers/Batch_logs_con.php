<?php


class Batch_logs_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('Batch_logs_mod','batch');
        $this->load->library('permissions');

        error_reporting(1);
        ini_set('display_errors', 01);
    }


    public function batch_Report()
    {

        $meta['title'] = "Batch Logs Reports";

        $this->load->view('common/header', $meta);
        $this->load->view('Batch_log_report');
        $this->load->view('common/footer');

    }
    public function get_process_branch_course_filter_data(){
        $branches = $this->batch->get_branches();
        // $courses_list = $this->gender->get_programs();

        echo json_encode(array(
            'branches'=>$branches,
            // 'courses'=>$courses_list
        ));
    }
    public function get_batch_by_branch(){
        $branch_id=$this->input->post('branch');
        $program_id=$this->input->post('course');
        $batches=$this->batch->get_batch_by_branch($branch_id,$program_id);
        echo json_encode(array('batches'=>$batches));
    }
    public function get_process_course_filter_data(){
        // $branches = $this->gender->get_branches();
        $courses_list = $this->batch->get_programs();

        echo json_encode(array(
            // 'branches'=>$branches,
            'courses'=>$courses_list
        ));
    }
    public function checkPayemnt(){
        $val=$this->input->post();
        $batch=$val['batch'];
        $branch=$val['branch'];
        $course=$val['course'];



        $data['payment_data'] = $this->batch->checkpaymentInfo($batch,$branch,$course);
        $this->load->view('Batch_log_result',$data);
    }
}