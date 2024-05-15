<?php


class Annual_enrollment_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('Annual_enrollment_mod');
        $this->load->library('permissions');

        error_reporting(1);
        ini_set('display_errors', 01);
    }


    public function annual_enrollments()
    {

        $meta['title'] = "Annual Enrollments Report";

        $data['batches'] = $this->Annual_enrollment_mod->get_batches();
        $data['branches'] = $this->Annual_enrollment_mod->get_branch();
        $data['courses'] = $this->Annual_enrollment_mod->get_programs();
        $this->load->view('common/header', $meta);
        $this->load->view('annual_enrollment_index', $data);
        $this->load->view('common/footer');

    }
    public function check_enrollments(){
        $val=$this->input->post();
        $batch=$val['batch'];
        $branch=$val['branch'];
        $course=$val['course'];
        $year=$val['year'];
        $intakes=$val['intakes'];


        $data['annual_data'] = $this->Annual_enrollment_mod->EnrollmentsResults($batch,$branch,$course,$year,$intakes);
        $this->load->view('students/annual_enrollment_result',$data);
    }
}