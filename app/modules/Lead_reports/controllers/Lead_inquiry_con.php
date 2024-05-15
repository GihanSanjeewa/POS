<?php if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Lead_inquiry_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Lead_inquiry_mod','inq');

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
        

        $meta['title']='Lead Inquriy Report';
        $data['lead_sources']=$this->inq->get_lead_sources();
        $data['program']=$this->inq->get_programes();
        $data['Counselor']=$this->inq->get_Counselor();
        $data['contact']=$this->inq->get_contact_methods();
        $data['interest']=$this->inq->get_interest_level();
        $data['log_user']=$this->inq->get_logUser($user);
        $this->load->view('common/header',$meta);
        
        $this->load->view('Lead_inquiry_index',$data);
        
        $this->load->view('common/footer');
    }


    public function view_inq_table()
    {
        $val=$this->input->post();
        $from = $val['from'];
        $to = $val['to'];
        $course=$val['course'];
        $counsellor=$val['counsellor'];
        $counsellor_id = $val['counsellor_id'];
        $contact =$val['contact'];
        $interest =$val['interest'];
        $lead_source =$val['lead_source'];
        
 
        $data['from_date']= $from;
        $data['to_date']= $to;
        $data['lead_inq_Data'] = $this->inq->get_lead_inq_Data($from,$to,$course,$counsellor,$contact,$interest,$counsellor_id,$lead_source);
        // var_dump( $data ['lead_inq_Data']);
        
        
        $this->load->view('Lead_inquiry_tb',$data);
        $this->load->view('Lead_inquiry_excel',$data);
         
    }
    

    

    
 

 


   
    
   
}