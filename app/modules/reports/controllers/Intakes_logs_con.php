<?php


class Intakes_logs_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('intakes_logs_mod');
        $this->load->library('permissions');

        error_reporting(1);
        ini_set('display_errors', 01);
    }


    public function IntakeReport()
    {

        $meta['title'] = "Inatke Logs Reports";
        $data['branchs'] = $this->intakes_logs_mod->get_branch();
        $data['batchs'] = $this->intakes_logs_mod->get_batches();
        $data['courses'] = $this->intakes_logs_mod->get_programs();

        $this->load->view('common/header', $meta);
        $this->load->view('intakes_logs',$data);
        $this->load->view('common/footer');

    }
    public function checkIntake(){
        $val=$this->input->post();
        $period1=$val['period1'];
        $period2=$val['period2'];
        $batch=$val['batch'];
        $branch=$val['branch'];
        $course=$val['course'];
      // var_dump($branch,$batch);
      // die();

        $data['intake_data'] = $this->intakes_logs_mod->checkIntakeInfo($period1,$period2,$batch,$branch,$course);
        $this->load->view('students/load_intake_log_results',$data);
    }
}