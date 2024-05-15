<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Lead_follow_up_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Lead_follow_up_mod','follow');

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

        

        $meta['title']='Lead Follow up Report';
        $data['program']=$this->follow->get_programes();
        $data['Counselor']=$this->follow->get_Counselor();
        $data['contact']=$this->follow->get_contact_methods();
        $data['interest']=$this->follow->get_interest_level();
        $data['log_user']=$this->follow->get_logUser($user);
        $this->load->view('common/header',$meta);
        
        $this->load->view('Lead_follow_up_index',$data);
        
        $this->load->view('common/footer');
    }


    public function view_follow_up_table()
    {
        $val=$this->input->post();
        $from = $val['from'];
        $to = $val['to'];
      
        $counsellor=$val['counsellor'];
        $counsellor_id = $val['counsellor_id'];
       
         
 
        $data['from_date']= $from;
        $data['to_date']= $to;

        $data['coun_Data'] = $this->follow->get_Coun_Data($from,$to,$counsellor,$counsellor_id);
        $data['interest_level']= $this->follow->get_int_level();
        

        $this->load->view('Lead_follow_up_tb',$data);
        $this->load->view('Lead_follow_up_excel',$data);
         
    }
    

    

    
 

 


   
    
   
}