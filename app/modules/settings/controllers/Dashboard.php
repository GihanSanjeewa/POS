<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller{

    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('dash_mod');
        $this->load->library('permissions');
        $this->load->library('system_log');
      //  $this->load->library('excel');

    }



      public function system_log()
    {

        // $data['country']=$this->dash_mod->get_country();
        // $data['city']=$this->dash_mod->get_city();
        // $data['trans_mod']=$this->dash_mod->get_trns_mod();
        // $data['agent_type']=$this->dash_mod->get_agent_type();
  
            $this->load->view('common/header');
            $this->load->view('settings/system_log');
            $this->load->view('common/footer');
     
        //$this->load->view('common/header');
        //$this->load->view('main',$data);
        //$this->load->view('common/footer');
    }



    public function system_log_details(){

            $details = $this->input->post(); 

            $start_date = $details['start_date'];
            $end_date = $details['end_date'];        
    

            if($start_date!=null || $end_date!=null){


            $data['AgentFullDetails']= $this->dash_mod->GetSystemDetails($start_date,$end_date);

            $this->system_log->create_system_log("Search - System Log Data", "Success", "System Log Data Search");

          }
            $this->load->view('load_system_info',$data);          

        // }
    }


}
