<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Target_repo_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Target_repo_mod','target');

        $this->load->library('system_log');
        $this->load->library('kcrud');
        $this->load->library('form_validation');

        date_default_timezone_set("Asia/Colombo");
        $this->currentTime = date('Y-m-d H:i:s');
        $this->currentDate = date('Y-m-d');
        ini_set('display_errors', 0);
    }

    public function index()
    {      
        
        $user = USER_ID;
        

        $meta['title']='Lead Target Report';
        $data['program']=$this->target->get_programes();
       
        $data['log_user']=$this->target->get_logUser($user);
        $this->load->view('common/header',$meta);
        
        $this->load->view('target_repo_index',$data);
        
        $this->load->view('common/footer');
    }


    public function view_target_table()
    {
        $val=$this->input->post();
       
        $program=$this->input->post('program');
        $year1 = $this->input->post('year1');
        $year2 = $this->input->post('year2');

        $data['yr1_start'] = $year1.'-04-01';
        $data['yr2_end'] = $year2.'-03-31';
        $data['programs_targets']=$this->target->get_programs_targets($program);


        

        // $data['lead_inq_Data'] = $this->inq->get_lead_inq_Data($from,$to,$course,$counsellor,$contact,$interest,$counsellor_id);
        $this->load->view('target_repo_tb',$data);
        $this->load->view('target_repo_excel',$data);
         
    }
    

    

    
 

 


   
    
   
}