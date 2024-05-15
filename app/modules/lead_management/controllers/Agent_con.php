<?php

class Agent_con extends CI_Controller{
    var $table;
    public function __construct(){

        parent::__construct();
        
       
        // $this->load->model('students','students_mod');
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->library('grocery_CRUD');
        $this->load->library('excel');

        $this->load->library('kcrud');
        // if(!$this->ion_auth->logged_in()){
        $this->load->model('Lead_mod','class_mod');
        $this->load->model('Agent_mod','agent_mod');
            $this->load->library('system_log');
        //     // redirect them to the login page
        //     redirect('auth/login', 'refresh');

        // }
         //   ini_set('display_errors', 1);

        $this->table="lead_agent_detail_list";

    }



    public function index(){
        $user = USER_ID;
        
        $meta['title']="Lead Agent Management";
        // // $data['scl_list']=$this->class_mod->get_scl_list();
        $data['countries']=$this->agent_mod->getCountries();
        $data['agents']=$this->agent_mod->getAgents();
        // $data['al_stream']=$this->class_mod->get_al_stream();
        $data['province'] = $this->agent_mod->get_province();
        // $data['lead_agents'] = $this->class_mod->get_agents();
        // $data['other_program']=$this->class_mod->get_other_programes();
        // $data['program']=$this->class_mod->get_programes();
        // $data['contact']=$this->class_mod->get_contact_methods();
        // $data['source']=$this->class_mod->get_master_lead_source();
        // $data['lead_title']=$this->class_mod->get_master_lead_title();
        // $data['lead_meetupe']=$this->class_mod->get_master_lead_meetup();
        // $data['source']=$this->class_mod->get_master_lead_source();
        // $data['meetup_lo']=$this->class_mod->get_master_meetup();
        // $data['Counselor']=$this->class_mod->get_Counselor();
        // $data['log_user']=$this->class_mod->get_logUser($user);
        // // $data['log_user_com']=$this->class_mod->get_logUser($user);
        $data['interest']=$this->agent_mod->get_interest_level();
        $data['follow']=$this->agent_mod->get_follow_up();
        // $data['programs_data']=$this->class_mod->get_programes();

        // $data['pre_lead_transfer']=$this->class_mod->get_pre_lead_data();

        // $data['past_students_data']=$this->class_mod->get_past_students_data();


        $this->load->view('common/header',$meta);
        $this->load->view('agent_index',$data); 
        $this->load->view('common/footer');
    }

    
public function send_mail()
{
    $val=$this->input->post();
    $id=$val['id'];

    $explode=explode("/",$id);
     $new_id=$explode[0]."_".$explode[1]."_".$explode[2];
   // send email

   $std_Data = $this->class_mod->get_email_sending_data($id);
   $data_email = array(
       'baseurl'	=> base_url(),
       'std_Data'	=> $std_Data,
       'inq_id'	=> $new_id,
   );

    $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('student_reg_alert_mail', 'ion_auth'), $data_email, true);
  
   $this->email->clear();
   $this->email->from('nipun@earrow.net', 'International Institute of Health Sciences (IIHS)');
   $this->email->to('rajeew@earrow.net');
   $this->email->subject("IIHS - Registration Link");
   $this->email->set_mailtype("html");
   $this->email->message($message);

   if ($this->email->send()) {
    echo json_encode(array('status'=>TRUE,'message'=>'Successfully URL Sent!'));
   }else{
    echo json_encode(array('status'=>FALSE,'message'=>'Email Send Failed!'));
   }
   

//end email


    
}

    function insertintake_data(){

        
        $data_arr =  $this->index_2();
 
        foreach($data_arr as $d_arr){
            
         $pr_id = $this->lead_history_data($d_arr->id);
             
         if (isset($pr_id)) {
            $feedback = '';
            foreach ($pr_id as $key => $value) {
                if (!empty($pr_id[$key])) {

                   //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                   echo $feedback = $feedback.' '.$pr_id[$key]->d_data.' '.$pr_id[$key]->follow_up_remarks;
                }
            }
            $data_val = array(
                'feedback'=>$feedback 
             );
             $this->db->where('id',$d_arr->id);
             $this->db->update('lead_management', $data_val);

        }
         
         

 //->id
       
        


        }
     }
     public function lead_history_data($id){
        $this->db->select('follow_up_remarks,DATE_FORMAT(created_at,"%Y-%m-%d %H:%i")AS d_data');
        $this->db->from('asms_agent_lead_changes_histories');
        $this->db->where('lead_id', $id);
        $q = $this->db->get();
        return $q->result();      
        // $data=array();
        // foreach($q->result() as $row){
        //     $data[] = $row->follow_up_remarks;
        // }
        // return ($data);
  
         
     }
     public function index_2(){
         $query=$this->db->query('SELECT * FROM lead_management');
         return $query->result();      
  
         
     }


     public function show(){

        $data['pre_lead_transfer']=$this->class_mod->get_pre_lead_data();
        $this->load->view('common/header',$meta);
        $this->load->view('test',$data); 
        $this->load->view('common/footer');
       
 

     }

     public function set_commission(){
        $data['past_students_data']=$this->class_mod->get_past_students_data();
        $data['edu_ag_company']=$this->class_mod->get_edu_ag_company();
        $data['agent']=$this->class_mod->get_agent();
        $this->load->view('common/header',$meta);
        $this->load->view('set_counsellor_enrolled_commission',$data); 
        $this->load->view('common/footer');
       
 

     }
    


    public function agent_applicaion(){
        $user = USER_ID;
        
        $meta['title']="Agent Application";
        // $data['scl_list']=$this->class_mod->get_scl_list();
        $data['countries']=$this->class_mod->getCountries();
         if($ageId=$this->agent_mod->get_maxId()){

            $agenId = (float)$ageId->temp_code_number+1;

        } else{

            $agenId = 1;

        }     

        // $num_padded = sprintf("%05d", $agenId);

        $data['agenId'] = $agenId;
        $data['num_padded'] = 'TEMP/AGN/'.str_pad($agenId, 5, "0", STR_PAD_LEFT);

        // var_dump($agenId);
        // die();
        
        // $data['al_stream']=$this->class_mod->get_al_stream();
         $data['province'] = $this->class_mod->get_province();
        // $data['lead_agents'] = $this->class_mod->get_agents();
        // $data['other_program']=$this->class_mod->get_other_programes();
        // $data['program']=$this->class_mod->get_programes();
        // $data['contact']=$this->class_mod->get_contact_methods();
        // $data['source']=$this->class_mod->get_master_lead_source();
        // $data['lead_title']=$this->class_mod->get_master_lead_title();
        // $data['lead_meetupe']=$this->class_mod->get_master_lead_meetup();
        // $data['source']=$this->class_mod->get_master_lead_source();
        // $data['meetup_lo']=$this->class_mod->get_master_meetup();
        // $data['Counselor']=$this->class_mod->get_Counselor();
        // $data['log_user']=$this->class_mod->get_logUser($user);
        // // $data['log_user_com']=$this->class_mod->get_logUser($user);
        // $data['interest']=$this->class_mod->get_interest_level();
        // $data['follow']=$this->class_mod->get_follow_up();
        // $data['programs_data']=$this->class_mod->get_programes();

        // $data['pre_lead_transfer']=$this->class_mod->get_pre_lead_data();

        // $data['past_students_data']=$this->class_mod->get_past_students_data();


        $this->load->view('common/header_1',$meta);
        $this->load->view('agent_application',$data); 
        $this->load->view('common/footer');
    }


    public function agent_applicaion_2(){
        $user = USER_ID;
        
        $meta['title']="Agent Application";
        // $data['scl_list']=$this->class_mod->get_scl_list();
        $data['countries']=$this->class_mod->getCountries();
         if($ageId=$this->agent_mod->get_maxId()){

            $agenId = (float)$ageId->temp_code_number+1;

        } else{

            $agenId = 1;

        }     

        // $num_padded = sprintf("%05d", $agenId);

        $data['agenId'] = $agenId;
        $data['num_padded'] = 'TEMP/AGN/'.str_pad($agenId, 5, "0", STR_PAD_LEFT);

        // var_dump($agenId);
        // die();
        
        // $data['al_stream']=$this->class_mod->get_al_stream();
         $data['province'] = $this->class_mod->get_province();
        // $data['lead_agents'] = $this->class_mod->get_agents();
        // $data['other_program']=$this->class_mod->get_other_programes();
        // $data['program']=$this->class_mod->get_programes();
        // $data['contact']=$this->class_mod->get_contact_methods();
        // $data['source']=$this->class_mod->get_master_lead_source();
        // $data['lead_title']=$this->class_mod->get_master_lead_title();
        // $data['lead_meetupe']=$this->class_mod->get_master_lead_meetup();
        // $data['source']=$this->class_mod->get_master_lead_source();
        // $data['meetup_lo']=$this->class_mod->get_master_meetup();
        // $data['Counselor']=$this->class_mod->get_Counselor();
        // $data['log_user']=$this->class_mod->get_logUser($user);
        // // $data['log_user_com']=$this->class_mod->get_logUser($user);
        // $data['interest']=$this->class_mod->get_interest_level();
        // $data['follow']=$this->class_mod->get_follow_up();
        // $data['programs_data']=$this->class_mod->get_programes();

        // $data['pre_lead_transfer']=$this->class_mod->get_pre_lead_data();

        // $data['past_students_data']=$this->class_mod->get_past_students_data();
      
        $this->load->view('agent_application',$data); 
    
    }



     public function target_lead()
     {
        $meta['title']="Lead Management";
        $data['program']=$this->class_mod->get_programes();

        $this->load->view('common/header',$meta);
        $this->load->view('target_lead',$data); 
        $this->load->view('common/footer');
     }


     public function agent_create()
     {
        $meta['title']="Lead Management";
        // $data['course_types']=$this->class_mod->get_course_types();
        $data['countries']=$this->class_mod->getCountries();
        $data['province'] = $this->class_mod->get_province();
        $data['currencies'] = $this->class_mod->get_currencies();
        $this->load->view('common/header',$meta);
        $this->load->view('Agent_with_Commission_for_agents',$data); 
        $this->load->view('common/footer');
     }


     public function agent_company_create()
     {
        $meta['title']="Lead Management";
        // $data['course_types']=$this->class_mod->get_course_types();
        $data['countries']=$this->class_mod->getCountries();
        $data['province'] = $this->class_mod->get_province();
        $data['currencies'] = $this->class_mod->get_currencies();
        $this->load->view('common/header',$meta);
        $this->load->view('edu_agent_company_com',$data); 
        $this->load->view('common/footer');
     }

     public function stu_comm_create()
     {
        $meta['title']="Lead Management";
        $data['course_types']=$this->class_mod->get_course_types();
        $data['countries']=$this->class_mod->getCountries();
        $data['province'] = $this->class_mod->get_province();
        $data['currencies'] = $this->class_mod->get_currencies();
        $this->load->view('common/header',$meta);
        $this->load->view('student_commission_setting',$data); 
        $this->load->view('common/footer');
     }



    public function al_scl()
    {
        $AL_skl = $this->class_mod->get_scl_list();
        echo json_encode(array('al_skl'=>$AL_skl));
    }

    public function hos()
    {
        $Hos = $this->class_mod->get_hos_list();
        echo json_encode(array('hos'=>$Hos));

    }

    public function get_course_types_commision()
    {
        $course_types = $this->agent_mod->get_course_types();
        echo json_encode(array('course_types'=>$course_types));
    }

     public function get_course_types_commision_2()
    {

        $id=$this->input->post('id');
        $course_types = $this->agent_mod->get_course_commision_data($id);
        echo json_encode(array('course_types'=>$course_types));
    }

    
    public function loan_assis(){

        $meta['title']="Lead Management";
        $data['scl_list']=$this->class_mod->get_scl_list();
        $data['countries']=$this->class_mod->getCountries();
        $data['al_stream']=$this->class_mod->get_al_stream();
        $data['province'] = $this->class_mod->get_province();
        $data['lead_agents'] = $this->class_mod->get_agents();
        $data['other_program']=$this->class_mod->get_other_programes();
        $data['program']=$this->class_mod->get_programes();
        $data['contact']=$this->class_mod->get_contact_methods();
        $data['source']=$this->class_mod->get_master_lead_source();
        $data['lead_title']=$this->class_mod->get_master_lead_title();
        $data['lead_meetupe']=$this->class_mod->get_master_lead_meetup();
        $data['source']=$this->class_mod->get_master_lead_source();
        $data['meetup_lo']=$this->class_mod->get_master_meetup();
        $data['Counselor']=$this->class_mod->get_Counselor();
        $data['interest']=$this->class_mod->get_interest_level();
        $data['follow']=$this->class_mod->get_follow_up();
   
        $this->load->view('common/header',$meta);
        $this->load->view('education_req_lead',$data); 
        $this->load->view('common/footer');
    }


    public function all_loan_assis(){
        $user = USER_ID;
        $meta['title']="Lead Management";
        $data['scl_list']=$this->class_mod->get_scl_list();
        $data['countries']=$this->class_mod->getCountries();
        $data['al_stream']=$this->class_mod->get_al_stream();
        $data['province'] = $this->class_mod->get_province();
        $data['lead_agents'] = $this->class_mod->get_agents();
         
        // $data['program']=$this->class_mod->get_programes();
        $data['contact']=$this->class_mod->get_contact_methods();
        $data['source']=$this->class_mod->get_master_lead_source();
        $data['lead_title']=$this->class_mod->get_master_lead_title();
        $data['lead_meetupe']=$this->class_mod->get_master_lead_meetup();
        $data['source']=$this->class_mod->get_master_lead_source();
        $data['meetup_lo']=$this->class_mod->get_master_meetup();
        $data['lead_id1']=$this->class_mod->get_lead_id_code1($user);
        $data['lead_id2']=$this->class_mod->get_lead_id_code2();
        $data['Loan_assis_data']=$this->class_mod->get_Loan_assistance_data();
        $data['log_user']=$this->class_mod->get_logUser($user);
        $data['interest']=$this->class_mod->get_interest_level();
        $data['follow']=$this->class_mod->get_follow_up();
   
        $this->load->view('common/header',$meta);
        $this->load->view('all_loan_assistance',$data); 
        $this->load->view('common/footer');
    }



    public function all_loan_app_rejec_leads()
    {
        $this->load->view('common/header',$meta);
        $this->load->view('Loan_approved_rejected_leads',$data); 
        $this->load->view('common/footer');

    }
    public function trans_loan()
    {
        
        $this->load->library('datatables');
        $groups=array('loan_assis_manager','admin'); 
        $groups_2=array('loan_assistance'); 
        
        if ($this->ion_auth->in_group($groups)) {
        $this->datatables->select("
        asms_loan_transfer.id as trns_id,
         lead_management.lead_id_code as lead_nid,

         CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
         emp_1.name as from_emp, 
         emp_2.name as to_emp,
         asms_loan_transfer.reason,
         asms_loan_transfer.date as l_date   
        ",FALSE);

        $this->datatables->from('asms_loan_transfer');
        $this->datatables->join('lead_management','lead_management.id=asms_loan_transfer.lead_id');
        $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_loan_transfer.from_person');
        $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_loan_transfer.to_person');
        // $this->datatables->join('asms_users_info as emp_3','emp_3.id=asms_loan_transfer.to_person');
        // $this->datatables->join('asms_m_lead_trans_reason','asms_m_lead_trans_reason.id=asms_lead_transfer.res_id');
       
        // $this->datatables->unset_column('trns_id');
    }else if($this->ion_auth->in_group($groups_2))
    {
        $user = USER_ID;

$this->datatables->select("
        asms_loan_transfer.id as trns_id,
         lead_management.lead_id_code as lead_nid,

         CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
         emp_1.name as from_emp, 
         emp_2.name as to_emp,
         asms_loan_transfer.reason,
         asms_loan_transfer.date as l_date   
        ",FALSE);

        $this->datatables->from('asms_loan_transfer');
        $where = "asms_loan_transfer.from_person ='$user' OR asms_loan_transfer.to_person ='$user'";
        $this->datatables->where($where);
        // $this->datatables->from('asms_loan_transfer');
        $this->datatables->join('lead_management','lead_management.id=asms_loan_transfer.lead_id');
        $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_loan_transfer.from_person');
        $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_loan_transfer.to_person');
    }
        echo $this->datatables->generate();
      
    }

    public function save_scl()
    {
        $val=$this->input->post();
            
            $this->form_validation->set_rules("scl_name","School Name","trim|required");
            $this->form_validation->set_rules("sl_code","Code","trim|required");

             

            if($this->form_validation->run() == false){

                $data=array();
                $data["error"]=array();
                $data["input_error"]=array();
                $data["status"]=FALSE;

                if(form_error("scl_name")){

                    $data["input_error"][] ="scl_name";
                    $data["error_string"][]=form_error("scl_name");
                }
                if(form_error("sl_code")){

                    $data["input_error"][] ="sl_code";
                    $data["error_string"][]=form_error("sl_code");
                }
                

                echo json_encode($data);
                exit();

            }
            else{



                

                $data=array(

                    'name'=>$val['scl_name'],
                    'code'=>$val['sl_code'],
                     
                     
                );


                if($this->db->insert('asms_lead_school_list',$data)){

                    
                    echo json_encode(array('status'=>TRUE,'message'=>'School Successfully !'));
                }else{

                    echo json_encode(array('status'=>FALSE,'message'=>'Sorry, School Inserted Was Not Successfully !'));
                }

            }



    }

    public function save_hos()
    {
        $val=$this->input->post();
            
            $this->form_validation->set_rules("hos_name","Hospital/NTS Name","trim|required");
            // $this->form_validation->set_rules("sl_code","Code","trim|required");

             

            if($this->form_validation->run() == false){

                $data=array();
                $data["error"]=array();
                $data["input_error"]=array();
                $data["status"]=FALSE;

                if(form_error("hos_name")){

                    $data["input_error"][] ="hos_name";
                    $data["error_string"][]=form_error("hos_name");
                }
                // if(form_error("sl_code")){

                //     $data["input_error"][] ="sl_code";
                //     $data["error_string"][]=form_error("sl_code");
                // }
                

                echo json_encode($data);
                exit();

            }
            else{



                

                $data=array(

                    'name'=>$val['hos_name'],
                  
                     
                     
                );


                if($this->db->insert('lead_work_experience_skls_hos',$data)){

                    
                    echo json_encode(array('status'=>TRUE,'message'=>'Hospital/NTS Successfully Inserted !'));
                }else{

                    echo json_encode(array('status'=>FALSE,'message'=>'Sorry, School Inserted Was Not Successfully !'));
                }

            }
    }
    public function trns_lead(){

        $meta['title']="Transfer Lead";
        $data['lead']=$this->class_mod->get_Lead();

        $data['Counselor']=$this->class_mod->get_Counselor();
        $data['program']=$this->class_mod->get_programes();
        $data['source']=$this->class_mod->get_master_lead_source();
         $data['transfer_res']=$this->class_mod->get_master_transfer_res();

        $this->load->view('common/header',$meta);
        $this->load->view('transfer_lead',$data); 
        $this->load->view('common/footer');
    }

    public function trns_his(){

        $meta['title']="Transfer Details";

        $this->load->view('common/header',$meta);
        $this->load->view('lead_history');
        $this->load->view('common/footer');
    }


     public function ass_submit(){

        $meta['title']="Submitted Assignmnet";

        $this->load->view('common/header',$meta);
        $this->load->view('ass_submit');
        $this->load->view('common/footer');
    }

       public function ass_view(){

        $meta['title']="View Assignment";


        $data['all_assign'] = $this->class_mod->get_all_ass_view();

        $this->load->view('common/header',$meta);
        $this->load->view('ass_view',$data);
        $this->load->view('common/footer');
    }


    public function get_email_mobile()
    {
        $stu_email_mobile = $this->input->post('email_mobile');
        $data=$this->class_mod->getstudent_data($stu_email_mobile);
        echo json_encode($data);

    }
    public function classes_list(){


    }




    public function pre_classes_list()
    {

        $company =COMPANY_ID;
        $groups_1=array('lead_manager','admin');
        $this->load->library('datatables');


        if($this->ion_auth->in_group($groups_1))
        {

            if($company == "1")
            {
               

                $this->datatables->select("
                lead_management_pre.id as table_id,
                lead_management_pre.lead_temp_id,
                lead_management_pre.inq_by,
                p_title.name as p_title,
                lead_management_pre.parent_name,
                s_title.name as s_title,
                lead_management_pre.f_name,
                lead_management_pre.l_name,
                lead_management_pre.l_phone,
                lead_management_pre.l_phone_2,
                lead_management_pre.nic_div,
                lead_management_pre.passport_div,
                lead_management_pre.l_email,
                asms_m_programs.name as cname,
                CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
                lead_management_pre.lead_status,
                lead_management_pre.created_date
                  
                ",FALSE);
        
                $this->datatables->from('lead_management_pre');
                $where = "lead_management_pre.lead_status='Pre Lead'";
                $this->datatables->where($where);
                $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
                $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
                $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
                $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
                $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
                // $this->datatables->unset_column('table_id');
                $this->datatables->add_column("Actions","
                &nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick='delete_pre_lead(" . '$1' . ")'><i class='fa fa-trash' title='Delete Pre Lead'></i></a>&nbsp;

              
                ","table_id");
                echo $this->datatables->generate();


            }else{


                $this->datatables->select("
                lead_management_pre.id as table_id,
                lead_management_pre.lead_temp_id,
                lead_management_pre.inq_by,
                p_title.name as p_title,
                lead_management_pre.parent_name,
                s_title.name as s_title,
                lead_management_pre.f_name,
                lead_management_pre.l_name,
                lead_management_pre.l_phone,
                lead_management_pre.l_phone_2,
                lead_management_pre.nic_div,
                lead_management_pre.passport_div,
                lead_management_pre.l_email,
                asms_m_programs.name as cname,
                CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
                lead_management_pre.lead_status,
                lead_management_pre.created_date
                  
                ",FALSE);
        
                $this->datatables->from('lead_management_pre');
                $where = "lead_management_pre.lead_status='Pre Lead' AND lead_management_pre.company_id='$company'";
                $this->datatables->where($where);
                $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
                $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
                $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
                $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
                $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
                // $this->datatables->unset_column('table_id');
                $this->datatables->add_column("Actions","
                &nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick='delete_pre_lead(" . '$1' . ")'><i class='fa fa-trash' title='Delete Pre Lead'></i></a>&nbsp;
                ","table_id");
                echo $this->datatables->generate();


            }
        
        
        }else{

            $this->datatables->select("
                lead_management_pre.id as table_id,
                lead_management_pre.lead_temp_id,
                lead_management_pre.inq_by,
                p_title.name as p_title,
                lead_management_pre.parent_name,
                s_title.name as s_title,
                lead_management_pre.f_name,
                lead_management_pre.l_name,
                lead_management_pre.l_phone,
                lead_management_pre.l_phone_2,
                lead_management_pre.nic_div,
                lead_management_pre.passport_div,
                lead_management_pre.l_email,
                asms_m_programs.name as cname,
                CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
                lead_management_pre.lead_status,
                lead_management_pre.created_date
                  
                ",FALSE);
        
                $this->datatables->from('lead_management_pre');
                $where = "lead_management_pre.lead_status='Pre Lead'";
                $this->datatables->where($where);
                $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
                $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
                $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
                $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
                $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
                // $this->datatables->unset_column('table_id');
                $this->datatables->add_column("Actions","
                &nbsp;&nbsp;&nbsp;<a href='javascript:;' onclick='delete_pre_lead(" . '$1' . ")'><i class='fa fa-trash' title='Delete Pre Lead'></i></a>&nbsp;


                ","table_id");
                echo $this->datatables->generate();

        }


    }


    public function assign_pre_classes_list()
    {
        $company =COMPANY_ID;
        $user = USER_ID;
        
        $this->load->library('datatables');


        $groups_2=array('student_counsellors'); 

        $groups=array('student_counsellors','lead_manager','admin'); if ($this->ion_auth->in_group($groups)) {

            $groups_1=array('lead_manager','admin'); if ($this->ion_auth->in_group($groups_1)) {

                if($company == "1")
                {

                    $this->datatables->select("
        lead_management_pre.id as table_id,
        lead_management_pre.lead_temp_id,
        lead_management_pre.inq_by,
        p_title.name as p_title,
        lead_management_pre.parent_name,
        s_title.name as s_title,
        lead_management_pre.f_name,
        lead_management_pre.l_name,
        lead_management_pre.l_phone,
        lead_management_pre.l_phone_2,
        lead_management_pre.nic_div,
        lead_management_pre.passport_div,
        lead_management_pre.l_email,
        asms_m_programs.name as cname,
        CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
        lead_management_pre.lead_status,
        lead_management_pre.created_date,
        asms_users_info.name as lead_owner,
        lead_management_pre.bulk_assign_date,
          
        ",FALSE);

        $this->datatables->from('lead_management_pre');
        $where = "lead_management_pre.lead_status='Assigned'";
        $this->datatables->where($where);
        $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
        $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_users_info','asms_users_info.id=lead_management_pre.lead_owner','left');
        // $this->datatables->unset_column('table_id');

        $this->datatables->add_column("Actions","
        <a href='javascript:;' onclick='edit_arrangement_bulk(" . '$1' . ")'><i class='fa fa-pencil' title='Edit bulk Customer Details'></i></a>&nbsp;
        ","table_id");
        echo $this->datatables->generate();

                }else{

                    $this->datatables->select("
        lead_management_pre.id as table_id,
        lead_management_pre.lead_temp_id,
        lead_management_pre.inq_by,
        p_title.name as p_title,
        lead_management_pre.parent_name,
        s_title.name as s_title,
        lead_management_pre.f_name,
        lead_management_pre.l_name,
        lead_management_pre.l_phone,
        lead_management_pre.l_phone_2,
        lead_management_pre.nic_div,
        lead_management_pre.passport_div,
        lead_management_pre.l_email,
        asms_m_programs.name as cname,
        CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
        lead_management_pre.lead_status,
        lead_management_pre.created_date,
        asms_users_info.name as lead_owner,
        lead_management_pre.bulk_assign_date,
          
        ",FALSE);

        $this->datatables->from('lead_management_pre');
        $where = "lead_management_pre.lead_status='Assigned' AND lead_management_pre.company_id='$company'";
        $this->datatables->where($where);
        $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
        $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_users_info','asms_users_info.id=lead_management_pre.lead_owner','left');
        // $this->datatables->unset_column('table_id');

        $this->datatables->add_column("Actions","
        <a href='javascript:;' onclick='edit_arrangement_bulk(" . '$1' . ")'><i class='fa fa-pencil' title='Edit bulk Customer Details'></i></a>&nbsp;
        ","table_id");
        echo $this->datatables->generate();

                }


        


            } elseif($this->ion_auth->in_group($groups_2)) {


 $this->datatables->select("
        lead_management_pre.id as table_id,
        lead_management_pre.lead_temp_id,
        lead_management_pre.inq_by,
        p_title.name as p_title,
        lead_management_pre.parent_name,
        s_title.name as s_title,
        lead_management_pre.f_name,
        lead_management_pre.l_name,
        lead_management_pre.l_phone,
        lead_management_pre.l_phone_2,
        lead_management_pre.nic_div,
        lead_management_pre.passport_div,
        lead_management_pre.l_email,
        asms_m_programs.name as cname,
        CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
        lead_management_pre.lead_status,
        lead_management_pre.created_date,
        asms_users_info.name as lead_owner,
        lead_management_pre.bulk_assign_date,
          
        ",FALSE);

        $this->datatables->from('lead_management_pre');
        $where = "lead_management_pre.lead_status='Assigned' AND lead_management_pre.lead_owner='$user'";
        $this->datatables->where($where);
        $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
        $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_users_info','asms_users_info.id=lead_management_pre.lead_owner','left');
        // $this->datatables->unset_column('table_id');

        $this->datatables->add_column("Actions","
        <a href='javascript:;' onclick='edit_arrangement_bulk(" . '$1' . ")'><i class='fa fa-pencil' title='Edit bulk Customer Details'></i></a>&nbsp;
        ","table_id");
        echo $this->datatables->generate();


            }


        }else{
            $this->datatables->select("
            lead_management_pre.id as table_id,
            lead_management_pre.lead_temp_id,
            lead_management_pre.inq_by,
            p_title.name as p_title,
            lead_management_pre.parent_name,
            s_title.name as s_title,
            lead_management_pre.f_name,
            lead_management_pre.l_name,
            lead_management_pre.l_phone,
            lead_management_pre.l_phone_2,
            lead_management_pre.nic_div,
            lead_management_pre.passport_div,
            lead_management_pre.l_email,
            asms_m_programs.name as cname,
            CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
            lead_management_pre.lead_status,
            lead_management_pre.created_date,
            asms_users_info.name as lead_owner,
            lead_management_pre.bulk_assign_date,
              
            ",FALSE);
    
            $this->datatables->from('lead_management_pre');
            $where = "lead_management_pre.lead_status='Assigned'";
            $this->datatables->where($where);
            $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
            $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
            $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
            $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=lead_management_pre.batch','left');
            $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
            $this->datatables->join('asms_users_info','asms_users_info.id=lead_management_pre.lead_owner','left');
            // $this->datatables->unset_column('table_id');
    
            $this->datatables->add_column("Actions","","table_id");
            echo $this->datatables->generate();
        }
    }

    public function all_approved_leads()
    {
        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        lead.name as lead_name,
        loan.name as loan_name,
        asms_loan_changes_histories_data.loan_approved_rejected_date,
          
        ",FALSE);

        $this->datatables->from('asms_loan_changes_histories_data');
        $where = "asms_loan_changes_histories_data.loan_status='approved' AND lead_management.status_option='Open'";
        $this->datatables->where($where);
        $this->datatables->join('lead_management','lead_management.id=asms_loan_changes_histories_data.lead_id','left');
        $this->datatables->join('asms_users_info as lead','lead_management.lead_owner=lead.id','left');
        $this->datatables->join('asms_users_info as loan','lead_management.loan_assistance_id=loan.id','left');
      

         

       
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }

    public function loan_rejected_leads()
    {
        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        lead.name as lead_name,
        loan.name as loan_name,
        asms_loan_changes_histories_data.loan_rejected_reason,
        asms_loan_changes_histories_data.loan_approved_rejected_date,
          
        ",FALSE);

        $this->datatables->from('asms_loan_changes_histories_data');
        $where = "asms_loan_changes_histories_data.loan_status='rejected' AND lead_management.status_option='Open'";
        $this->datatables->where($where);
        $this->datatables->join('lead_management','lead_management.id=asms_loan_changes_histories_data.lead_id','left');
        $this->datatables->join('asms_users_info as lead','lead_management.lead_owner=lead.id','left');
        $this->datatables->join('asms_users_info as loan','lead_management.loan_assistance_id=loan.id','left');
      

         

       
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();
    }
    public function loan_required_list(){
    
        // $groups_2=array('student_counsellors'); 

        $company = COMPANY_ID;

           
        $this->load->library('datatables');

        $groups_2=array('loan_assis_manager','admin');

      

        // $groups_2=array('student_counsellors'); 
        
        $groups=array('loan_assistance','loan_assis_manager','admin'); if ($this->ion_auth->in_group($groups)) {
        
        $groups_1=array('loan_assistance'); if ($this->ion_auth->in_group($groups_1)) {
       

        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        asms_users_info.name,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
        lead_management.lead_created_date,
        asms_m_programs.name as p_name,
        lead_management.l_phone,  
        lead_management.l_phone_2,
        lead_management.l_email,
        lead_management.status_option,
        asms_lead_interest_level.name as interest_name,
        lead_management.education_loan_status,
          
        ",FALSE);

        $this->datatables->from('lead_management');
        $where = "education_loan_status='pending' AND lead_management.status_option='Loan Assistance'";
        $this->datatables->where($where);
        $this->datatables->join('asms_users_info','lead_management.lead_owner=asms_users_info.id','left');
        $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
        $this->datatables->join('asms_lead_interest_level','lead_management.int_level=asms_lead_interest_level.id','left');
            

        $this->datatables->add_column("Actions","
         <a href='javascript:;' onclick='Add_to_loan_assistance(" . '$1' . ")'><i class='fa fa-plus' title='Add'></i></a>&nbsp;
        ","table_id");
        }else if($this->ion_auth->in_group($groups_2))
        {


            if($company == "1")
            {
                $this->datatables->select("
                lead_management.id as table_id,
                lead_management.lead_id_code,
                asms_users_info.name,
                CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
                lead_management.lead_created_date,
                asms_m_programs.name as p_name,
                lead_management.l_phone,  
                lead_management.l_phone_2,
                lead_management.l_email,
                lead_management.status_option,
                asms_lead_interest_level.name as interest_name,
                lead_management.education_loan_status,
                  
                ",FALSE);
        
                $this->datatables->from('lead_management');
                $where = "education_loan_status='pending' AND lead_management.status_option='Loan Assistance'";
                $this->datatables->where($where);
                $this->datatables->join('asms_users_info','lead_management.lead_owner=asms_users_info.id','left');
                $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
                $this->datatables->join('asms_lead_interest_level','lead_management.int_level=asms_lead_interest_level.id','left');
                    
        
                $this->datatables->add_column("Actions","","table_id");
            }
            else{



                $this->datatables->select("
                lead_management.id as table_id,
                lead_management.lead_id_code,
                asms_users_info.name,
                CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
                lead_management.lead_created_date,
                asms_m_programs.name as p_name,
                lead_management.l_phone,  
                lead_management.l_phone_2,
                 lead_management.l_email,
                lead_management.status_option,
                asms_lead_interest_level.name as interest_name,
                lead_management.education_loan_status,
                  
                ",FALSE);
        
                $this->datatables->from('lead_management');
                $where = "education_loan_status='pending' AND lead_management.status_option='Loan Assistance' AND asms_users_info.company_id='$company'";
                $this->datatables->where($where);
                $this->datatables->join('asms_users_info','lead_management.lead_owner=asms_users_info.id','left');
                $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
                $this->datatables->join('asms_lead_interest_level','lead_management.int_level=asms_lead_interest_level.id','left');
                    
        
                $this->datatables->add_column("Actions","","table_id");

            }


           

        }
    }
       
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();


    }
    
    //all loans
    public function all_loan_required_list()
    {

        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        lead.name as lead_name,
        loan.name as loan_name,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
        lead_management.lead_created_date,
        asms_m_programs.name as p_name,
        lead_management.l_phone,  
        lead_management.l_phone_2,
        lead_management.l_email,
        lead_management.status_option,
        asms_lead_interest_level.name as interest_name,
        lead_management.education_loan_status,
        lead_management.loan_last_call_date,
        lead_management.loan_next_contact_date, 
        lead_management.loan_feedback       
        ",FALSE);

        $this->datatables->from('lead_management');
        $where = "(education_loan_status ='approved' AND lead_management.status_option ='Open') OR (education_loan_status ='rejected' AND lead_management.status_option ='Open') OR (education_loan_status ='pending' AND lead_management.status_option ='Loan Assistance') OR (education_loan_status ='processing' AND lead_management.status_option ='Loan Assistance')";
        $this->datatables->where($where);
        $this->datatables->join('asms_users_info as lead','lead_management.lead_owner=lead.id','left');
        $this->datatables->join('asms_users_info as loan','lead_management.loan_assistance_id=loan.id','left');
        $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
        $this->datatables->join('asms_lead_interest_level','lead_management.int_level=asms_lead_interest_level.id','left');
            

        $this->datatables->add_column("Actions","
         <a href='javascript:;' onclick='Add_to_loan_assistance(" . '$1' . ")'><i class='fa fa-plus' title='Add'></i></a>&nbsp;
        ","table_id");

       
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }


    public function approved_leads()
    {
        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        lead.name as lead_name,
        loan.name as loan_name,
        lead_management.education_loan_status,
        asms_loan_changes_histories_data.loan_approved_rejected_date
              
        ",FALSE);

        $this->datatables->from('asms_loan_changes_histories_data');
        $where = "lead_management.education_loan_status ='approved' AND lead_management.status_option ='Open'";
        $this->datatables->where($where);
        $this->datatables->join('lead_management','lead_management.id=asms_loan_changes_histories_data.lead_id','left');
        $this->datatables->join('asms_users_info as lead','lead_management.lead_owner=lead.id','left');
        $this->datatables->join('asms_users_info as loan','lead_management.loan_assistance_id=loan.id','left');
  
            

        

       
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }


    public function rejected_leads(){

        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        asms_users_info.name,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
        lead_management.lead_created_date,
        asms_m_programs.name as p_name,
        IF(lead_management.l_phone_2 IS NULL,lead_management.l_phone,CONCAT(lead_management.l_phone,'/',lead_management.l_phone_2))AS PHONE,  
        lead_management.l_email,
        lead_management.status_option,
        asms_lead_interest_level.name as interest_name,
        lead_management.education_loan_status,
              
        ",FALSE);

        $this->datatables->from('lead_management');
        $where = "lead_management.education_loan_status ='rejected' AND lead_management.status_option ='Open'";
        $this->datatables->where($where);
        $this->datatables->join('asms_users_info','lead_management.lead_owner=asms_users_info.id','left');
        $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
        $this->datatables->join('asms_lead_interest_level','lead_management.int_level=asms_lead_interest_level.id','left');
            

        $this->datatables->add_column("Actions","
         <a href='javascript:;' onclick='Add_to_loan_assistance(" . '$1' . ")'><i class='fa fa-plus' title='Add'></i></a>&nbsp;
        ","table_id");

       
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }


    public function my_loan_list(){
        $user = USER_ID;

        $this->load->library('datatables');


        
        $groups=array('loan_assistance'); if ($this->ion_auth->in_group($groups)) {
        $this->datatables->select("
        lead_management.id as table_id,
        lead_management.lead_id_code,
        lead.name as lead_name,
        loan.name as loan_name,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
        lead_management.lead_created_date,
        asms_m_programs.name as p_name,
        lead_management.l_phone,
        lead_management.l_phone_2,
        lead_management.l_email,
        lead_management.status_option,
        asms_lead_interest_level.name as interest_name,
        lead_management.education_loan_status,
         lead_management.loan_last_call_date,
        lead_management.loan_next_contact_date, 
        lead_management.loan_feedback     
        ",FALSE);

        $this->datatables->from('lead_management');
        $where = "lead_management.loan_assistance_id='$user' AND (education_loan_status='processing' AND lead_management.status_option='Loan Assistance') OR (education_loan_status='rejected' AND lead_management.status_option='Open') OR (education_loan_status='approved' AND lead_management.status_option='Open')";
        $this->datatables->where($where);
        $this->datatables->join('asms_users_info as lead','lead_management.lead_owner=lead.id','left');
        $this->datatables->join('asms_users_info as loan','lead_management.loan_assistance_id=loan.id','left');
        $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
        $this->datatables->join('asms_lead_interest_level','lead_management.int_level=asms_lead_interest_level.id','left');
            

        $this->datatables->add_column("Actions","
         <a href='javascript:;' onclick='edit_status(" . '$1' . ")'><i class='fa fa-eye' title='View'></i></a>&nbsp;
         
        ","table_id");
        }
 

        

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }


     public function classes_list_2(){

        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        asms_users_info.name,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
        lead_management.date as l_date,
        lead_management.l_email,
        asms_m_programs.name as p_name,            
        lead_management.status_option,
         lead_management.last_call_date,
         lead_management.feedback    
        ",FALSE);

        $this->datatables->from('lead_management');
        $this->datatables->where('lead_management.User_id',USER_ID);
         $this->datatables->join('asms_users_info','lead_management.lead_owner=asms_users_info.id','left');
        $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
        $this->datatables->join('asms_m_lead_source','lead_management.lead_source=asms_m_lead_source.id','left');
        $this->datatables->add_column("Actions","
        <a href='javascript:;' onclick='add_arrangement(" . '$1' . ")'><i class='fa fa-exchange' title='Edit Customer Details'></i></a>&nbsp;
        ","table_id");

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }


     




     public function registered_leads(){

        $this->load->library('datatables');

        $this->datatables->select("
        lead_management.id as table_id,
        asms_users_info.name,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
        lead_management.date as l_date,
        lead_management.l_email,
        asms_m_programs.name as p_name,            
        lead_management.status_option,
         lead_management.last_call_date,
         lead_management.feedback     
        ",FALSE);

        $this->datatables->from('lead_management');
         $this->datatables->join('asms_users_info','lead_management.lead_owner=asms_users_info.id','left');
        $this->datatables->join('asms_m_programs','lead_management.programe=asms_m_programs.id','left');
        $this->datatables->join('asms_m_lead_source','lead_management.lead_source=asms_m_lead_source.id','left');
        $this->datatables->where('status_option',"Registered");
//        $this->datatables->add_column("Actions","
//        <a href='javascript:;' onclick='add_arrangement(" . '$1' . ")'><i class='fa fa-exchange' title='Edit Customer Details'></i></a>&nbsp;
//        ","table_id");

        // $this->datatables->unset_column('table_id');
        echo $this->datatables->generate();

    }


      public function trns_details(){

        $this->load->library('datatables');

        $company=COMPANY_ID;
        $groups=array('lead_manager','admin');
        $groups_2=array('student_counsellors');
        
        if ($this->ion_auth->in_group($groups)) {

             if($company == "1")
             {
                $this->datatables->select("
                asms_lead_transfer.id as trns_id,
                lead_management.lead_id_code as lead_nid,
                CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
                emp_1.name as from_emp, 
                emp_2.name as to_emp,
                asms_m_lead_trans_reason.name as reason_name,
                asms_lead_transfer.date as l_date   
               ",FALSE);
       
               $this->datatables->from('asms_lead_transfer');
               $this->datatables->join('lead_management','lead_management.id=asms_lead_transfer.lead_id');
               $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_lead_transfer.from_person');
               $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_lead_transfer.to_person');
               $this->datatables->join('asms_m_lead_trans_reason','asms_m_lead_trans_reason.id=asms_lead_transfer.res_id');
       
             }else{
                $this->datatables->select("
                asms_lead_transfer.id as trns_id,
                lead_management.lead_id_code as lead_nid,
                CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
                emp_1.name as from_emp, 
                emp_2.name as to_emp,
                asms_m_lead_trans_reason.name as reason_name,
                asms_lead_transfer.date as l_date   
               ",FALSE);
       
               $this->datatables->from('asms_lead_transfer');
               $where = "emp_1.company_id ='$company'";
               $this->datatables->where($where);
               $this->datatables->join('lead_management','lead_management.id=asms_lead_transfer.lead_id');
               $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_lead_transfer.from_person');
               $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_lead_transfer.to_person');
               $this->datatables->join('asms_m_lead_trans_reason','asms_m_lead_trans_reason.id=asms_lead_transfer.res_id');
       
             }
       

        }else if($this->ion_auth->in_group($groups_2))
        {
            $user = USER_ID;
            $this->datatables->select("
         asms_lead_transfer.id as trns_id,
         lead_management.lead_id_code as lead_nid,
         CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
         emp_1.name as from_emp, 
         emp_2.name as to_emp,
         asms_m_lead_trans_reason.name as reason_name,
         asms_lead_transfer.date as l_date   
        ",FALSE);

        $this->datatables->from('asms_lead_transfer');
        $where = "asms_lead_transfer.from_person ='$user' OR asms_lead_transfer.to_person ='$user'";
        $this->datatables->where($where);
        $this->datatables->join('lead_management','lead_management.id=asms_lead_transfer.lead_id');
        $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_lead_transfer.from_person');
        $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_lead_transfer.to_person');
        $this->datatables->join('asms_m_lead_trans_reason','asms_m_lead_trans_reason.id=asms_lead_transfer.res_id');
        }

        // $this->datatables->unset_column('trns_id');
        echo $this->datatables->generate();

    }
    public function user_trns_details(){

        $this->load->library('datatables');

        $this->datatables->select("
         asms_lead_transfer.id as trns_id,
         lead_management.id as lead_nid,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
         emp_1.name as from_emp, 
         emp_2.name as to_emp,
         asms_lead_transfer.reason,
         asms_lead_transfer.date as l_date   
        ",FALSE);

        $this->datatables->from('asms_lead_transfer');
        $this->datatables->where('emp_1.id',USER_ID);
        $this->datatables->join('lead_management','lead_management.id=asms_lead_transfer.lead_id');
        $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_lead_transfer.from_person');
        $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_lead_transfer.to_person');

        // $this->datatables->unset_column('trns_id');
        echo $this->datatables->generate();

    }
    public function received_leads(){

        $this->load->library('datatables');

        $this->datatables->select("
         asms_lead_transfer.id as trns_id,
         lead_management.id as lead_nid,
        CONCAT(lead_management.f_name,' ',lead_management.l_name) as f_name,
         emp_1.name as from_emp, 
         emp_2.name as to_emp,
         asms_lead_transfer.reason,
         asms_lead_transfer.date as l_date   
        ",FALSE);

        $this->datatables->from('asms_lead_transfer');
        $this->datatables->where('emp_2.id',USER_ID);
        $this->datatables->join('lead_management','lead_management.id=asms_lead_transfer.lead_id');
        $this->datatables->join('asms_users_info as emp_1','emp_1.id=asms_lead_transfer.from_person');
        $this->datatables->join('asms_users_info as emp_2','emp_2.id=asms_lead_transfer.to_person');
                $this->datatables->add_column("Actions","
         <a href='javascript:;' onclick='view_lead_history(" . '$1' . ")'><i class='fa fa-eye' title='View History'></i></a>&nbsp;
        ","lead_nid");

         $this->datatables->unset_column('table_id');

        echo $this->datatables->generate();

    }

    public function meeting_details(){

        $this->load->library('datatables');

        $this->datatables->select("
        ldl.id,
        ldl.lead_id,
        emp.name,
        CONCAT(lmg.f_name,' ',lmg.l_name) as inq_name,
        lmg.date,
        ldl.last_contacted_date,
        ldl.next_contact_date,
        ldl.lead_status,
        ldl.follow_up_remarks,
        lmg.l_phone  
        ",FALSE);

        $this->datatables->from('lead_date_log as ldl');
        $this->datatables->join('lead_management as lmg','lmg.id=ldl.lead_id');
        $this->datatables->join('employees as emp','emp.id = lmg.lead_owner');
       
        // $this->datatables->unset_column('trns_id');
        echo $this->datatables->generate();

    }


    public function pre_bulk_list_transfer()
    {
        $this->load->library('datatables');

        $this->datatables->select("
        lead_management_pre.id as tb_id,
        lead_management_pre.lead_temp_id,
        lead_management_pre.inq_by,
        p_title.name as parent_title,
        lead_management_pre.parent_name,
        s_title.name as student_title,
        lead_management_pre.f_name,
        lead_management_pre.l_name,
        lead_management_pre.l_phone,
        lead_management_pre.l_phone_2,
        lead_management_pre.nic_div,
        lead_management_pre.passport_div,
        lead_management_pre.l_email,
        asms_m_programs.name as cname,
        CONCAT('(',pro.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
        lead_management_pre.created_date
        ",FALSE);

        $this->datatables->from('lead_management_pre');
        $where = "lead_management_pre.lead_status='Pre Lead'";
        $this->datatables->where($where);
        $this->datatables->join('asms_m_lead_title as p_title','p_title.id=lead_management_pre.parent_salutation','left');
        $this->datatables->join('asms_m_lead_title as s_title','s_title.id=lead_management_pre.salutation','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=lead_management_pre.programe','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id = lead_management_pre.batch','left');
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_m_batch_intakes.batch_id','left');
        $this->datatables->join('asms_m_programs as pro','pro.id=asms_m_batches.program_id','left');
        $this->datatables->join('asms_m_intakes_list ','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');

        
       
        $this->datatables->add_column("Actions","
        <input type='checkbox' class='std-check'  value=". '$1' ." name='std_check[]'>&nbsp;
        <input type='hidden' value=". '$1' ." name='Lead_management_pre_id[]'>&nbsp;
        ","tb_id");
        // $this->datatables->unset_column('trns_id');
        echo $this->datatables->generate();
    }


    public function save_followup_upates(){

            $val=$this->input->post();
            $lead_status = $val['lead_status'];
            $follow_up_ac = $val['follow_up'];
            $call_status=$val['call_status'];

           
            $this->form_validation->set_rules("lead_status","Lead Status","trim|required");

            if($lead_status == "Open" || $lead_status == "Lost" || $lead_status == "Abandoned"){

            $this->form_validation->set_rules("follow_up","Follow Up Activity","trim|required");
              if($follow_up_ac == "1"){

             $this->form_validation->set_rules("call_status","Call Status","trim|required");
              }
            // $this->form_validation->set_rules("inter_level","Interest Level","trim|required");
            $this->form_validation->set_rules("next_date","Next Contact Date","trim|required");
            $this->form_validation->set_rules("next_time","Next Contact Time","trim|required");
            $this->form_validation->set_rules("remarks","Follow-Up Remarks","trim|required");

            }else if($lead_status == "Loan Assistance"){
                $this->form_validation->set_rules("follow_up","Follow Up Activity","trim|required");
                if($follow_up_ac == "1"){

                    $this->form_validation->set_rules("call_status","Call Status","trim|required");
                                  }   

            }
         if($this->form_validation->run() == false){ 
              
  
                $data=array();
                $data["error"]=array();
                $data["input_error"]=array();
                $data["status"]=FALSE;
  
                if(form_error("lead_status")){
  
                    $data["input_error"][] ="lead_status";
                    $data["error_string"][]=form_error("lead_status");
                }
               
                if(form_error("follow_up")){
  
                  $data["input_error"][] ="follow_up";
                  $data["error_string"][]=form_error("follow_up");
              }
       
                if(form_error("next_date")){
  
                    $data["input_error"][] ="next_date";
                    $data["error_string"][]=form_error("next_date");
                }
                if(form_error("next_time")){
  
                    $data["input_error"][] ="next_time";
                    $data["error_string"][]=form_error("next_time");
                }
                if(form_error("remarks")){
  
                    $data["input_error"][] ="remarks";
                    $data["error_string"][]=form_error("remarks");
                }
                if(form_error("call_status")){
  
                    $data["input_error"][] ="call_status";
                    $data["error_string"][]=form_error("call_status");
                }
              
                echo json_encode($data);
                exit();
  
            }else {        

                $last_details=$this->agent_mod->get_relevant_lead($val['update_id']);                  

                $date_log=array(

                    'lead_status'=>$val['lead_status'],
                    'inter_level'=>$val['inter_level'],
                    'follow_up'=>$val['follow_up'],
                    'call_status'=>$val['call_status'],
                    'follow_up_remarks'=>$val['remarks'],  
                    'last_contacted_date'=>$last_details->next_contact_date,   
                    'last_contacted_time'=>$last_details->next_contact_time,
                    'next_contact_date'=>$val['next_date'],
                    'next_time'=>$val['next_time'],
                    'user'=>USER_ID,
                    'lead_id'=>$val['update_id'],
                   
                    'updated_date'=>date('Y-m-d H:i:s')
                ); 
                if($this->db->insert('agent_lead_date_log',$date_log)){
                
                    $pr_id = $this->lead_history_data($val['update_id']);   
                    
                    if (isset($pr_id)) {
                        $feedback = '';
                        foreach ($pr_id as $key => $value) {
                            if (!empty($pr_id[$key])) {
            
                               //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                                //$feedback = $feedback.' '.$pr_id[$key];
                                $feedback = $feedback.' '.$pr_id[$key]->d_data.' '.$pr_id[$key]->follow_up_remarks;
                            }
                        }
                        $dddd=date('Y-m-d H:i');
                        $feedback = $feedback.' '.$dddd.' '.$val['remarks'];                         
            
                    }
                    $data=array(

                        'lead_status'=>$val['lead_status'],
                        'int_level'=>$val['inter_level'],

                        'last_call_date'=>$last_details->next_contact_date,  
                        'last_call_time'=>$last_details->next_contact_time, 
                        'next_contact_date'=>$val['next_date'],
                        'next_contact_time'=>$val['next_time'],
                        'feedback'=>$feedback,                         
                        'update_person'=>USER_ID
                    );

                    $date_log_history=array(
                        'lead_status'=>$val['lead_status'],
                        'inter_level'=>$val['inter_level'],
                        'follow_up'=>$val['follow_up'],
                        'call_status'=>$val['call_status'],
                        'follow_up_remarks'=>$val['remarks'],
                        'last_contacted_date'=>$last_details->next_contact_date,
                        'last_contacted_time'=>$last_details->next_contact_time,
                        'next_contact_date'=>$val['next_date'],
                        'next_time'=>$val['next_time'],
                        'user'=>USER_ID,
                         
                        'lead_id'=>$val['update_id']
                    );

                    $this->db->insert('asms_agent_lead_changes_histories',$date_log_history);
    
                    $this->db->where('id',$val['update_id']);
                    if($this->db->update('lead_agent_detail_list',$data)){            
                        echo json_encode(array('status'=>TRUE,'message'=>'Updated Successfully !')); 
                    }else{
                        echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Update Failed !')); 
                    }
                }else{
                    echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Log Update Failed !')); 
                }      
           
            }
       
    }


    public function loan_status_update(){


        $val=$this->input->post();
        $loan_status = $val['lead_loan_final_status'];

        if($loan_status == "processing")
        {
            $this->form_validation->set_rules("next_date","Next Contact Date","trim|required");
            $this->form_validation->set_rules("next_time","Next Contact Time","trim|required");
            $this->form_validation->set_rules("loan_follow_up","Follow-Up Remarks","trim|required");

        }
        else if($loan_status == "approved")
        {
            
            $this->form_validation->set_rules("app_remark","Remark","trim|required");
            $this->form_validation->set_rules("loan_approv_reject_date","Approved Date","trim|required");
        }else if($loan_status == "rejected")
        {
            $this->form_validation->set_rules("reg_reason","Rejected Reason","trim|required");
            $this->form_validation->set_rules("loan_approv_reject_date","Rejected Date","trim|required");
        }

        $this->form_validation->set_rules("lead_loan_final_status","Lead Status","trim|required");



        
        // $this->form_validation->set_rules("inter_level","Interest Level","trim|required");
     
     



        if($this->form_validation->run() == false){

          

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("next_date")){

                $data["input_error"][] ="next_date";
                $data["error_string"][]=form_error("next_date");
            }
           
            if(form_error("next_time")){

              $data["input_error"][] ="next_time";
              $data["error_string"][]=form_error("next_time");
          }
            if(form_error("loan_follow_up")){

                $data["input_error"][] ="loan_follow_up";
                $data["error_string"][]=form_error("loan_follow_up");
            }
            if(form_error("loan_approv_reject_date")){

                $data["input_error"][] ="loan_approv_reject_date";
                $data["error_string"][]=form_error("loan_approv_reject_date");
            }
            if(form_error("reg_reason")){

                $data["input_error"][] ="reg_reason";
                $data["error_string"][]=form_error("reg_reason");
            }
            if(form_error("lead_loan_final_status")){

                $data["input_error"][] ="lead_loan_final_status";
                $data["error_string"][]=form_error("lead_loan_final_status");
            }
            if(form_error("app_remark")){

                $data["input_error"][] ="app_remark";
                $data["error_string"][]=form_error("app_remark");
            }
            
          
            echo json_encode($data);
            exit();

        }else {


        $last_details=$this->class_mod->get_lead_data_of_loan($val['update_id']); 
        
       
        //  var_dump($last_details->loan_next_contact_date);
        //  die();

                   if($loan_status == "processing"){
       
        
            $date_log=array(

                'loan_status'=>$val['lead_loan_final_status'],
                'follow_up'=>$val['loan_follow_up'],  
                'last_contacted_date'=>$last_details->loan_next_contact_date, 
                'next_contact_date'=>$val['next_date'],
                'next_time'=>$val['next_time'],
                'loan_approved_rejected_date'=>$val['loan_approv_reject_date'],
                'loan_rejected_reason'=>$val['reg_reason'],
                'loan_approved_remark'=>$val['app_remark'],
                'user'=>USER_ID,
                'lead_id'=>$val['update_id'],
                'updated_date'=>date('Y-m-d H:i:s')
            ); 
            if($this->db->insert('loan_date_log',$date_log)){

            
                $pr_id = $this->loan_history_data($val['update_id']);
         


                
                if (isset($pr_id)) {
                    $feedback = '';
                    foreach ($pr_id as $key => $value) {
                        if (!empty($pr_id[$key])) {
        
                           //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                            //$feedback = $feedback.' '.$pr_id[$key];
                            $feedback = $feedback.' '.$pr_id[$key]->d_data.' '.$pr_id[$key]->follow_up_remarks;
                        }
                    }
                    $dddd=date('Y-m-d H:i');
                    $feedback = $feedback.' '.$dddd.' '.$val['loan_follow_up'];
                     
        
                }
                $data=array(

                    'education_loan_status'=>$val['lead_loan_final_status'],
                    
                    'loan_last_call_date'=>$last_details->loan_next_contact_date, 
                    'loan_next_contact_date'=>$val['next_date'],
                    'loan_feedback'=>$feedback,
                    'loan_update_person'=>USER_ID
                );
                $date_log_history=array(
                    'loan_status'=>$val['lead_loan_final_status'],
                    
                    'follow_up_remarks'=>$val['loan_follow_up'],
                    'last_contacted_date'=>$last_details->loan_next_contact_date, 
                    'next_contact_date'=>$val['next_date'],
                    'next_time'=>$val['next_time'],
                    'loan_approved_rejected_date'=>$val['loan_approv_reject_date'],
                    'loan_rejected_reason'=>$val['reg_reason'],
                    'loan_approved_remark'=>$val['app_remark'],
                    'user'=>USER_ID,
                    'lead_id'=>$val['update_id']
                );

                $this->db->insert('asms_loan_changes_histories_data',$date_log_history);

                $this->db->where('id',$val['update_id']);
                if($this->db->update('lead_management',$data)){            
                    echo json_encode(array('status'=>TRUE,'message'=>'Updated Successfully !')); 
                }else{
                    echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Update Failed !')); 
                }
            }else{
                echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Log Update Failed !')); 
            }
            

            
            // if($this->db->update('lead_management',$data)){            
            // echo json_encode(array('status'=>TRUE,'message'=>'Update Successfully !')); 
            // }else{

            //     echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Updated Was Not Successfully !')); 
            // }
                   }

                   else if($loan_status == "approved" || $loan_status == "rejected"  ){

                    $date_log=array(

                        'loan_status'=>$val['lead_loan_final_status'],
                        'follow_up'=>$val['loan_follow_up'],  
                        'last_contacted_date'=>$last_details->loan_next_contact_date, 
                        'next_contact_date'=>$val['next_date'],
                        'next_time'=>$val['next_time'],
                        'loan_approved_rejected_date'=>$val['loan_approv_reject_date'],
                        'loan_rejected_reason'=>$val['reg_reason'],
                        'loan_approved_remark'=>$val['app_remark'],
                        'user'=>USER_ID,
                        'lead_id'=>$val['update_id'],
                        'updated_date'=>date('Y-m-d H:i:s')
                    ); 
                    if($this->db->insert('loan_date_log',$date_log)){
        
                    
                        $pr_id = $this->loan_history_data($val['update_id']);
                 
        
        
                        
                        if (isset($pr_id)) {
                            $feedback = '';
                            foreach ($pr_id as $key => $value) {
                                if (!empty($pr_id[$key])) {
                
                                   //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                                    //$feedback = $feedback.' '.$pr_id[$key];
                                    $feedback = $feedback.' '.$pr_id[$key]->d_data.' '.$pr_id[$key]->follow_up_remarks;
                                }
                            }
                            $dddd=date('Y-m-d H:i');
                            $feedback = $feedback.' '.$dddd.' '.$val['loan_follow_up'];
                             
                
                        }
                        $data=array(
        
                            'education_loan_status'=>$val['lead_loan_final_status'],
                            
                            'loan_last_call_date'=>$last_details->loan_next_contact_date, 
                            'loan_next_contact_date'=>$val['next_date'],
                            'status_option'=>'Open',
                            'loan_feedback'=>$feedback,
                            'loan_update_person'=>USER_ID
                        );
                        $date_log_history=array(
                            'loan_status'=>$val['lead_loan_final_status'],
                            
                            'follow_up_remarks'=>$val['loan_follow_up'],
                            'last_contacted_date'=>$last_details->loan_next_contact_date, 
                            'next_contact_date'=>$val['next_date'],
                            'next_time'=>$val['next_time'],
                            'loan_approved_rejected_date'=>$val['loan_approv_reject_date'],
                            'loan_rejected_reason'=>$val['reg_reason'],
                            'loan_approved_remark'=>$val['app_remark'],
                            'user'=>USER_ID,
                            'lead_id'=>$val['update_id']
                        );
        
                        $this->db->insert('asms_loan_changes_histories_data',$date_log_history);
        
                        $this->db->where('id',$val['update_id']);
                        if($this->db->update('lead_management',$data)){            
                            echo json_encode(array('status'=>TRUE,'message'=>'Updated Successfully !')); 
                        }else{
                            echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Update Failed !')); 
                        }
                    }else{
                        echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Log Update Failed !')); 
                    }

                   }









        
        }

    }

    public function loan_history_data($id){
        $this->db->select('follow_up_remarks,DATE_FORMAT(created_at,"%Y-%m-%d %H:%i")AS d_data');
        $this->db->from('asms_loan_changes_histories_data');
        $this->db->where('lead_id', $id);
        $q = $this->db->get();
        return $q->result();      
        // $data=array();
        // foreach($q->result() as $row){
        //     $data[] = $row->follow_up_remarks;
        // }
        // return ($data);
  
         
     }
    public function add_loan_assis(){

        $val=$this->input->post();
        $lead_table_id = $val['id'];
        $user_assis_id=USER_ID;

        // loan_assistance_id
        // education_loan_status

        $data_loan=array(

             
            'loan_assistance_id'=>$user_assis_id,
            'education_loan_status'=>processing,

             
        );


        $this->db->where('id',$lead_table_id);
        // $this->db->update('lead_management', $data_loan);
        if($this->db->update('lead_management', $data_loan)){     
            echo json_encode (array('message' => 'Lead Added successfully!'));              
         }else{
             echo json_encode (array('message' => 'Fail to Add Lead!'));
         } 
        // echo json_encode(array('status' => TRUE, 'message' => 'Continue This Process By')); 


    }
        public function save_nw(){
            $val=$this->input->post();
            $this->form_validation->set_rules("l_name","Transfer Person","trim|required");
            $this->form_validation->set_rules("l_reason","Reason","trim|required");
            $this->form_validation->set_rules("l_date","Class","trim|required");

            if ($val['l_reason']==4){
                $this->form_validation->set_rules("l_reason_others","Reason","trim|required");
            }else{

            }

            if($this->form_validation->run() == false){

                $data=array();
                $data["error"]=array();
                $data["input_error"]=array();
                $data["status"]=FALSE;

                if(form_error("l_name")){

                    $data["input_error"][] ="l_name";
                    $data["error_string"][]=form_error("l_name");
                }
                if(form_error("l_reason")){

                    $data["input_error"][] ="l_reason";
                    $data["error_string"][]=form_error("l_reason");
                }
                if(form_error("l_date")){

                    $data["input_error"][] ="l_date";
                    $data["error_string"][]=form_error("l_date");
                }

                if ($val['l_reason']==4){
                    if(form_error("l_reason_others")){

                        $data["input_error"][] ="l_reason_others";
                        $data["error_string"][]=form_error("l_reason_others");
                    }
                }else{

                }

                echo json_encode($data);
                exit();

            }
            else{



                $lead_owner=$this->class_mod->get_lead_details($val['update_nw_id'])->lead_owner;



                if ($val['l_reason']==4){
                    $lead_reason=$val['l_reason_others'];
                }else{
                    $lead_reason=$this->class_mod->get_lead_reasons($val['l_reason'])->name;
                }

                $data=array(

                    'lead_id'=>$val['update_nw_id'],
                    'reason'=>$lead_reason,
                    'res_id'=>$val['l_reason'],
                    'from_person'=> $lead_owner,
                    'to_person'=>$val['l_name'],
                    'date'=>$val['l_date'],
                    'user'=>USER_ID
                );


                if($this->db->insert('asms_lead_transfer',$data)){

                    $this->db->where('id',$val['update_nw_id']);
                    $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));

                    echo json_encode(array('status'=>TRUE,'message'=>'Transfer Successfully !'));
                }else{

                    echo json_encode(array('status'=>FALSE,'message'=>'Sorry, Transfer Was Not Successfully !'));
                }

            }



       
    }
    public function check_lead(){
        $val=$this->input->post();
        $program=$val['select_course'];
        $batch=$val['batch_id_select'];
        $email=$val['l_email'];
        $phone=$val['l_phone'];

         if($email == "noemail@nomail.com" && $phone == "1234567890")
        {
 

        echo json_encode(array('status'=>true));
        }
        else if(($email != "noemail@nomail.com" && $phone == "1234567890") ||  ($email == "noemail@nomail.com" && $phone != "1234567890") )
        {
            if($email == "noemail@nomail.com"){
                $count1=$this->class_mod->check_lead1($program,$batch,$phone);
                $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);


                if($count1==0){
                    echo json_encode(array('status'=>true));
                    
                }else{
                    echo json_encode(array('status'=>false,'message'=>'already there is a Lead under '.$lead_data1->l_phone,'message2'=>'Lead ID is : '.$lead_data1->lead_id_code));
                
                }

            }else{
                $count2=$this->class_mod->check_lead2($program,$batch,$email);
                $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);
                if($count2==0){
                    echo json_encode(array('status'=>true));
                    
                }else{
                    echo json_encode(array('status'=>false,'message'=>'already there is a Lead under  '.$lead_data2->l_email,'message2'=>'Lead ID is : '.$lead_data2->lead_id_code));
         
                }

            }
        }
      
        else{
            // var_dump($program,$batch,$email,$phone);
            // die();

            $count1=$this->class_mod->check_lead1($program,$batch,$phone);
            $count2=$this->class_mod->check_lead2($program,$batch,$email);
            $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
            $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);
             
            if($count1==0 && $count2==0){
                // echo json_encode(array('lead_data1'=>$lead_data1));
                echo json_encode(array('status'=>true));

                
                // echo json_encode(array('status'=>true,'message'=>'already there is a Lead under'));
                
            }else if($count1!=0 && $count2!=0){
                if($lead_data1->lead_id_code == $lead_data2->lead_id_code)
                {
                          echo json_encode(array('status'=>false,'message'=>'already there is a Lead under  '.$lead_data1->l_phone.' & '.$lead_data2->l_email,'message2'=>'Lead ID is : '.$lead_data2->lead_id_code));
                }
                else{
                    echo json_encode(array('status'=>false,'message'=>'already there are Leads under  '.$lead_data1->l_phone.' & '.$lead_data2->l_email,'message2'=>'Lead IDs are : '.$lead_data1->lead_id_code.' , '.$lead_data2->lead_id_code));

                }

                
                    
                    
                
            }else if($count1==0 && $count2!=0)
            {
                echo json_encode(array('status'=>false,'message'=>'already there is a Leads under  '.$lead_data2->l_email,'message2'=>'Lead IDs are : '.$lead_data2->lead_id_code));

            }else if($count1!=0 && $count2==0)
            {
                echo json_encode(array('status'=>false,'message'=>'already there is a Leads under  '.$lead_data1->l_phone,'message2'=>'Lead IDs are : '.$lead_data1->lead_id_code));

            }

        }

        
       
    }

    public function get_lead_id_code_increment()
    {
        $query=$this->db->query("SELECT lead_management.lead_id_code
        FROM lead_management
        ORDER BY lead_management.id DESC limit 1");

        return $query->row();
    }



 

      public function save_lead($method){

       
            $val=$this->input->post();
            
            
            $bulk_tb_id=$val['bulk_id'];


            $current_yr = date('Y');

            $currentDateTime = date('Y-m-d H:i:s');

            $current_date = date('Y-m-d');
            $current_time = date('H:i:s');

           
            $get_lead_id_code_increment =$this->get_lead_id_code_increment();

            
            
             
               

            // var_dump($current_date,$current_yr);
            // die();


              
            


            



            
            
        //    $company =COMPANY_ID;
        //    var_dump($company);
        //    die();
             $program = $val['al_att_skl'];
             
            $batch = $val['al_stream'];
            // $study_method=$val['country'];
            // var_dump($study_method);
            // die();
            // $like_pro = $val['select_course'];
            $parernt_name = $val['parent_name'];
            $f_name = $val['f_name'];
            $mid_name = $val['mid_name'];
            $l_name = $val['l_name'];

          

            $nic_pass_info=$val['nic_pass_info'];
            $reffered = $val['reffered'];
            $refferal_type = $val['refferal_type'];
            $pre_contact_method=$val['pref_contact_method'];
            $inq_by=$val['inq_by'];
            $nic=$val['nic_num'];

            
           //// if($nic_pass_info =="NIC Number")
           //// {
                // $this->form_validation->set_message('checkNIC', 'The NIC is not valid');

    // return $nic === '' || (bool) preg_match('/^\d{9}[xXvV]$/', $nic);

                ////$this->form_validation->set_rules("nic_num","Nic Number","trim|required|min_length[10]|max_length[12]");

                // $this->form_validation->set_rules("nic_num","Nic Number","trim|required|regex_match[/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/]");
                // $this->form_validation->set_rules("nic_num","Nic Number","trim|required|regex_match[/^([0-9]{9}[xXvV])$/]");


            //// }
            // else if($nic_pass_info =="Passport Number")
            // {
            //     $this->form_validation->set_rules("pass_num","Passport Number","trim|required|min_length[9]|max_length[9]");
            // }

            // if($reffered == "Yes")
            // {
            //     $this->form_validation->set_rules("refferal_type","Refferal Type","trim|required");
            //     if($refferal_type == "Past Student" || $refferal_type == "Other")
            //     {
            //         $this->form_validation->set_rules("ref_nic","Reffered NIC Number","trim|required");
            //         $this->form_validation->set_rules("ref_remarks","Remarks","trim|required");
            //     }
            //     else if($refferal_type == "Agent")
            //     {
            //         $this->form_validation->set_rules("det_agent","Agent Name","trim|required");
            //         $this->form_validation->set_rules("ref_remarks","Remarks","trim|required");   
            //     }
            // }

            // if($pre_contact_method !='3' && $pre_contact_method !='4')
            // {
            //     $this->form_validation->set_rules("con_box","Preffered Contact ID/Number","trim|required");   
            // }
            // if($inq_by == "Parent")
            // {
            //     $this->form_validation->set_rules("salutation_parent","Parent Title","trim|required"); 
            //     $this->form_validation->set_rules("parent_name","Parent Full Name","trim|required");
            // }
            
          //   $this->form_validation->set_rules("pref_contact_method","Preffered Contact Method","trim|required");
          //   $this->form_validation->set_rules("email_select","Select Email ID","trim|required");
          //   $this->form_validation->set_rules("phone_select","Select Phone Number","trim|required");
          // $this->form_validation->set_rules("inq_by","Inquired","trim|required");
          $this->form_validation->set_rules("salutation","Student's Title","trim|required");
          $this->form_validation->set_rules("f_name","Student's First Name","trim|required");
          // $this->form_validation->set_rules("l_name","Student's Last Name","trim|required");
          // $this->form_validation->set_rules("l_email","Student's Email ID","required|valid_email");
          // $this->form_validation->set_rules("reffered","Reffered","trim|required");
          // $this->form_validation->set_rules("next_date","Next Contact Date","trim|required");
          // $this->form_validation->set_rules("next_contact_time","Next Contact Time","trim|required");
          $this->form_validation->set_rules("select_course","Program","trim|required");
          // $this->form_validation->set_rules("batch_id_select","Batch","trim|required");
          // $this->form_validation->set_rules("pref_study_method","Study Method","trim|required");
          // $this->form_validation->set_rules("loan_info","Education Loan","trim|required");
          // $this->form_validation->set_rules("ex_years","Expereience Years","trim|numeric");
          // $this->form_validation->set_rules("ex_months","Expereience Months","trim|numeric");
          $this->form_validation->set_rules("contacted_method","Contacted Method","trim|required");
          // $this->form_validation->set_rules("dead_line_date","Dead Line Date","trim|required");
          // $this->form_validation->set_rules("l_coun", "Student's Counsellor", "trim|required");

          $this->form_validation->set_rules("l_phone", "Student's Mobile Number", "trim|required");
          $this->form_validation->set_rules("l_phone_2", "Student's Mobile Number", "trim|required");

//           \+(9[976]\d|8[987530]\d|6[987]\d|5[90]\d|42\d|3[875]\d|
// 2[98654321]\d|9[8543210]|8[6421]|6[6543210]|5[87654321]|
// 4[987654310]|3[9643210]|2[70]|7|1)\d{1,14}$
          $this->form_validation->set_rules("int_level", "Interest Level", "trim|required");
          
        //   $this->form_validation->set_rules("l_phone", "Student's Mobile Number", 'required|regex_match[/^[0-9]{10}$/]');



          if($this->form_validation->run() == false){

            

              $data=array();
              $data["error"]=array();
              $data["input_error"]=array();
              $data["status"]=FALSE;

            //   if(form_error("inq_by")){

            //       $data["input_error"][] ="inq_by";
            //       $data["error_string"][]=form_error("inq_by");
            //   }
            //   if(form_error("email_select")){

            //       $data["input_error"][] ="email_select";
            //       $data["error_string"][]=form_error("email_select");
            //   }
            //   if(form_error("phone_select")){

            //     $data["input_error"][] ="phone_select";
            //     $data["error_string"][]=form_error("phone_select");
            // }
              
              if(form_error("salutation")){

                $data["input_error"][] ="salutation";
                $data["error_string"][]=form_error("salutation");
            }
            // if(form_error("l_coun")){

            //     $data["input_error"][] ="l_coun";
            //     $data["error_string"][]=form_error("l_coun");
            // }
            
              if(form_error("f_name")){

                  $data["input_error"][] ="f_name";
                  $data["error_string"][]=form_error("f_name");
              }
            //   if(form_error("l_name")){

            //       $data["input_error"][] ="l_name";
            //       $data["error_string"][]=form_error("l_name");
            //   }
              if(form_error("l_phone")){

                  $data["input_error"][] ="l_phone";
                  $data["error_string"][]=form_error("l_phone");
              }
               if(form_error("l_phone_2")){

                  $data["input_error"][] ="l_phone_2";
                  $data["error_string"][]=form_error("l_phone_2");
              }
            //   if(form_error("l_email")){

            //       $data["input_error"][] ="l_email";
            //       $data["error_string"][]=form_error("l_email");
            //   }
            //   if(form_error("reffered")){

            //       $data["input_error"][] ="reffered";
            //       $data["error_string"][]=form_error("reffered");
            //   }
            //   if(form_error("end_date_a")){

            //       $data["input_error"][] ="end_date_a";
            //       $data["error_string"][]=form_error("end_date_a");
            //   }
              if(form_error("select_course")){

                  $data["input_error"][] ="select_course";
                  $data["error_string"][]=form_error("select_course");
              }

            //   if(form_error("batch_id_select")){

            //     $data["input_error"][] ="batch_id_select";
            //     $data["error_string"][]=form_error("batch_id_select");
            // }

            //   if(form_error("dead_line_date")){

            //     $data["input_error"][] ="dead_line_date";
            //     $data["error_string"][]=form_error("dead_line_date");
            // }
            if(form_error("contacted_method")){

                $data["input_error"][] ="contacted_method";
                $data["error_string"][]=form_error("contacted_method");
            }
            // if(form_error("next_contact")){

            //     $data["input_error"][] ="next_contact";
            //     $data["error_string"][]=form_error("next_contact");
            // }
            
            // if(form_error("nic_num")){

            //     $data["input_error"][] ="nic_num";
            //     $data["error_string"][]=form_error("nic_num");
            // }
            // if(form_error("pass_num")){

            //     $data["input_error"][] ="pass_num";
            //     $data["error_string"][]=form_error("pass_num");
            // }
            // if(form_error("refferal_type")){

            //     $data["input_error"][] ="refferal_type";
            //     $data["error_string"][]=form_error("refferal_type");
            // }

            // if(form_error("ref_nic")){

            //     $data["input_error"][] ="ref_nic";
            //     $data["error_string"][]=form_error("ref_nic");
            // }
            // if(form_error("ref_remarks")){

            //     $data["input_error"][] ="ref_remarks";
            //     $data["error_string"][]=form_error("ref_remarks");
            // }
            // if(form_error("det_agent")){

            //     $data["input_error"][] ="det_agent";
            //     $data["error_string"][]=form_error("det_agent");
            // }
            // if(form_error("pref_study_method")){

            //     $data["input_error"][] ="pref_study_method";
            //     $data["error_string"][]=form_error("pref_study_method");
            // }
            // if(form_error("con_box")){

            //     $data["input_error"][] ="con_box";
            //     $data["error_string"][]=form_error("con_box");
            // }
            // if(form_error("loan_info")){

            //     $data["input_error"][] ="loan_info";
            //     $data["error_string"][]=form_error("loan_info");
            // }


            // if(form_error("ex_years")){

            //     $data["input_error"][] ="ex_years";
            //     $data["error_string"][]=form_error("ex_years");
            // }
            // if(form_error("ex_months")){

            //     $data["input_error"][] ="ex_months";
            //     $data["error_string"][]=form_error("ex_months");
            // }


            // if(form_error("salutation_parent")){

            //     $data["input_error"][] ="salutation_parent";
            //     $data["error_string"][]=form_error("salutation_parent");
            // }
            // if(form_error("parent_name")){

            //     $data["input_error"][] ="parent_name";
            //     $data["error_string"][]=form_error("parent_name");
            // }

            // if(form_error("int_level")){

            //     $data["input_error"][] ="int_level";
            //     $data["error_string"][]=form_error("int_level");
            // }

            // if(form_error("next_contact_time")){

            //     $data["input_error"][] ="next_contact_time";
            //     $data["error_string"][]=form_error("next_contact_time");
            // }
            // if(form_error("next_date")){

            //     $data["input_error"][] ="next_date";
            //     $data["error_string"][]=form_error("next_date");
            // }
            // if(form_error("pref_contact_method")){

            //     $data["input_error"][] ="pref_contact_method";
            //     $data["error_string"][]=form_error("pref_contact_method");
            // }
            
            
            
            
              echo json_encode($data);
              exit();

          }else {
            $loan = $val['loan_info'];


              if ($method == 'add') {


                

 ////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////
            ////Check Lead//////////////////////////////////////////////
     


            $program=$val['select_course'];
            $batch=$val['batch_id_select'];
            $current_date = date('Y-m-d');

            $email=$val['l_email'];
            $phone=$val['l_phone'];
           


    
            // $count1=$this->class_mod->check_lead1($program,$batch,$phone);
            // $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
            // $count2=$this->class_mod->check_lead2($program,$batch,$email);
            // $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);

            $count1=$this->class_mod->check_lead1($program,$current_date,$phone);
            $lead_data1=$this->class_mod->check_lead_data1($program,$current_date,$phone);
            $count2=$this->class_mod->check_lead2($program,$current_date,$email);
            $lead_data2=$this->class_mod->check_lead_data2($program,$current_date,$email);

             if($email == "noemail@nomail.com" && $phone == "1234567890")
            {
     
    
            // echo json_encode(array('status1'=>true));
            if($loan == "No"){
           

                $data = array(

                    'inq_by' => $val['inq_by'],
                    'parent_salutation' => $val['salutation_parent'],
                    'parent_name' => $val['parent_name'],
                  'salutation' => $val['salutation'],
                  'f_name' => $val['f_name'],
                  'mid_name' => $val['mid_name'],
                  'l_name' => $val['l_name'],
                  'l_phone' => $val['l_phone'],
                  'l_phone_2' => $val['l_phone_2'],
                  'nic_pass_info' => $val['nic_pass_info'],
                  'nic_div' => $val['nic_num'],
                  'passport_div' => $val['pass_num'],
                  'l_email' => $val['l_email'],
                  'address1' => $val['address1'],
                  'address2' => $val['address2'],
                  'city' => $val['city'],
                  'state_pro' => $val['province'],
                  'zip_pos' => $val['zip_pos'],
                  'country' => $val['country'],
                  'email_select' => $val['email_select'],
                  'phone_select' =>$val['phone_select'],
                  'reffered' => $val['reffered'],
                  'refferal_type' => $val['refferal_type'],
                  'ref_nic' => $val['ref_nic'],
                  'agent_name' => $val['det_agent'],
                  'ref_remarks' => $val['ref_remarks'],
                  'programe' => $val['select_course'],
                  'batch_id' => $val['batch_id_select'],
                  'study_method' => $val['pref_study_method'],
                  'ex_type' => $val['ex_type'],
                  'ex_years' => $val['ex_years'],
                  'ex_months' => $val['ex_months'],
                  'ol_res' => $val['ol_res'],
                  'ol_year' => $val['ol_year'],
                  'al_res' => $val['al_res'],
                  'al_year' => $val['al_year'],
                  'other_edu' => $val['other_edu'],
                  'loan_info' => $val['loan_info'],
                  'contact_method' => $val['contacted_method'],
                  'con_box'=> $val['con_box'],
                  'int_level' => $val['int_level'],
                  'dead_line_date' => $val['dead_line_date'],
                  'next_contact' => $val['next_contact'],
                  'pref_contact_method' => $val['pref_contact_method'],
                  'al_school'=>$val['al_att_skl'],
                  'al_stream'=>$val['al_stream'],
                  'day'=>$val['day'],
                  'next_contact_date'=>$val['next_date'],
                  'next_contact_time'=>$val['next_contact_time'],
                  'remarks'=>$val['next_remarks'],
                  'd_state' => 0,
                    'User_id'=> USER_ID,
                    'lead_created_date_time'=>$currentDateTime,
                  'lead_created_date'=>$current_date,
                  'education_loan_status'=>'no',
                  'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                    'lead_owner' =>$val['l_coun']
                    
                    
                );
            }else if($loan == "Yes"){

                $data = array(

                    'inq_by' => $val['inq_by'],
                    'parent_salutation' => $val['salutation_parent'],
                    'parent_name' => $val['parent_name'],
                  'salutation' => $val['salutation'],
                  'f_name' => $val['f_name'],
                  'mid_name' => $val['mid_name'],
                  'l_name' => $val['l_name'],
                  'l_phone' => $val['l_phone'],
                  'l_phone_2' => $val['l_phone_2'],
                  'nic_pass_info' => $val['nic_pass_info'],
                  'nic_div' => $val['nic_num'],
                  'passport_div' => $val['pass_num'],
                  'l_email' => $val['l_email'],
                  'address1' => $val['address1'],
                  'address2' => $val['address2'],
                  'city' => $val['city'],
                  'state_pro' => $val['province'],
                  'zip_pos' => $val['zip_pos'],
                  'country' => $val['country'],
                  'email_select' => $val['email_select'],
                  'phone_select' =>$val['phone_select'],
                  'reffered' => $val['reffered'],
                  'refferal_type' => $val['refferal_type'],
                  'ref_nic' => $val['ref_nic'],
                  'agent_name' => $val['det_agent'],
                  'ref_remarks' => $val['ref_remarks'],
                  'programe' => $val['select_course'],
                  'batch_id' => $val['batch_id_select'],
                  'study_method' => $val['pref_study_method'],
                  'ex_type' => $val['ex_type'],
                  'ex_years' => $val['ex_years'],
                  'ex_months' => $val['ex_months'],
                  'ol_res' => $val['ol_res'],
                  'ol_year' => $val['ol_year'],
                  'al_res' => $val['al_res'],
                  'al_year' => $val['al_year'],
                  'other_edu' => $val['other_edu'],
                  'loan_info' => $val['loan_info'],
                  'contact_method' => $val['contacted_method'],
                  'con_box'=> $val['con_box'],
                  'int_level' => $val['int_level'],
                  'dead_line_date' => $val['dead_line_date'],
                  'next_contact' => $val['next_contact'],
                  'pref_contact_method' => $val['pref_contact_method'],
                  'al_school'=>$val['al_att_skl'],
                  'al_stream'=>$val['al_stream'],
                  'day'=>$val['day'],
                  'next_contact_date'=>$val['next_date'],
                  'next_contact_time'=>$val['next_contact_time'],
                  'remarks'=>$val['next_remarks'],
                  'd_state' => 0,
                    'User_id'=> USER_ID,
                    'lead_created_date_time'=>$currentDateTime,
                  'lead_created_date'=>$current_date,
                  'education_loan_status'=>'pending',
                  'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                    'lead_owner' =>$val['l_coun']
                    
                    
                );





            }

            


              if ($this->db->insert('lead_management',$data)) {
                // $insert_id = $this->db->insert_id();
                $insert_id = $this->db->insert_id(); 
            
            
                $get_end_date =$this->class_mod->get_end_date();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab;
                $end_date;


                if($get_end_date != NULL)
                {
                       $end_date=$get_end_date->to_date;
                       $datediff = strtotime($end_date)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab=$get_lead_id_code_increment->lead_id_code;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id = explode("/",$lead_id_ab);
  

                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = $explode_lead_id[2];
                       

                        $number =$number+1;
                        if($number <10){
                            $lead_id_ab = $inq.'/'.$yr.'/0'.$number;

                        }else{
                            $lead_id_ab = $inq.'/'.$yr.'/'.$number;

                        }
                       
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);




                       }else{
                         
                        $explode_lead_id = explode("/",$lead_id_ab);
                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = 01;

                        $yr=$yr+1;

                       
                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);


                        $explode_end_date = explode("-",$end_date);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];

                        $selected_end_date_update = array(
                        
                            'to_date' =>$new_end_year,
                             
                        );
                        $this->db->where('id', $get_end_date->finance_tb_id);
                        $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab = "INQ/21/01";
                    $end_date = "2022-03-31";

                    $selected = array(
                        
                        'lead_id_code' =>$lead_id_ab,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management', $selected);


                    $selected_end_date = array(
                        
                        'to_date' =>$end_date,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb', $selected_end_date);

                }            
                // foreach($marks['m_new_id'] as $key =>$value)
                // {                   
                 
                //      $exam_module = array(
                //          'exam_id' =>$insert_id,
                //          'batch_id'=>$bact_data[0],
                //          'module_id'=>$marks['m_new_id'][$key],
                //          'marks'=>$marks['m_marks'][$key],
                //          'mod_grade'=>$marks['mod_grade'][$key],
                //          // 'total'=>$marks['total'],
                //          // 'avg'=>$marks['avg'],
                //          // 'grade'=>$marks['grade'],
 
                //      );
 
                //      $this->db->insert("exam_module",$exam_module);
                
                

                if($insert_id){
                    // $selected = array(
                        
                    //     'lead_id_code' =>$lead_id,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management', $selected);

                  
                   
                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    
                        
    
    
                }
                  // $this->db->where('id',$val['update_nw_id']);
                  // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));

                  echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
               }else{

                  echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
              }
            }
            else if(($email != "noemail@nomail.com" && $phone == "1234567890") ||  ($email == "noemail@nomail.com" && $phone != "1234567890") )
            {
                if($email == "noemail@nomail.com"){
                    // $count1=$this->class_mod->check_lead1($program,$batch,$phone);
                    // $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
    
    
                    if($count1==0){
                        // echo json_encode(array('status1'=>true));
                        
        
                        if($loan == "No"){
           

                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'no',
                              'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
                        }else if($loan == "Yes"){
            
                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'pending',
                              'last_call_date'=>$current_date,
                              'last_call_time'=>$current_time,
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
            
            
            
            
            
                        }
                      
        
        
                          if ($this->db->insert('lead_management',$data)) {
                            $insert_id = $this->db->insert_id();
                          
                $get_end_date =$this->class_mod->get_end_date();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab;
                $end_date;


                if($get_end_date != NULL)
                {
                       $end_date=$get_end_date->to_date;
                       $datediff = strtotime($end_date)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab=$get_lead_id_code_increment->lead_id_code;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id = explode("/",$lead_id_ab);
  

                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = $explode_lead_id[2];
                       

                        $number =$number+1;
                        if($number <10){
                            $lead_id_ab = $inq.'/'.$yr.'/0'.$number;

                        }else{
                            $lead_id_ab = $inq.'/'.$yr.'/'.$number;

                        }
                       
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);




                       }else{
                         
                        $explode_lead_id = explode("/",$lead_id_ab);
                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = 01;

                        $yr=$yr+1;

                       
                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);


                        $explode_end_date = explode("-",$end_date);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];

                        $selected_end_date_update = array(
                        
                            'to_date' =>$new_end_year,
                             
                        );
                        $this->db->where('id', $get_end_date->finance_tb_id);
                        $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab = "INQ/21/01";
                    $end_date = "2022-03-31";

                    $selected = array(
                        
                        'lead_id_code' =>$lead_id_ab,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management', $selected);


                    $selected_end_date = array(
                        
                        'to_date' =>$end_date,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb', $selected_end_date);

                }         
                // foreach($marks['m_new_id'] as $key =>$value)
                // {                   
                 
                //      $exam_module = array(
                //          'exam_id' =>$insert_id,
                //          'batch_id'=>$bact_data[0],
                //          'module_id'=>$marks['m_new_id'][$key],
                //          'marks'=>$marks['m_marks'][$key],
                //          'mod_grade'=>$marks['mod_grade'][$key],
                //          // 'total'=>$marks['total'],
                //          // 'avg'=>$marks['avg'],
                //          // 'grade'=>$marks['grade'],
 
                //      );
 
                //      $this->db->insert("exam_module",$exam_module);
                
                

                if($insert_id){
                    // $selected = array(
                        
                    //     'lead_id_code' =>$lead_id,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management', $selected);

                    // $selected_end_date = array(
                        
                    //     'to_date' =>$end_date,
                         
                    // );
                 
                    // $this->db->insert('finance_inq_num_code_tb', $selected_end_date);
                   
                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    
                        
    
    
                }
                            
                        
                            // foreach($marks['m_new_id'] as $key =>$value)
                            // {                   
                             
                            //      $exam_module = array(
                            //          'exam_id' =>$insert_id,
                            //          'batch_id'=>$bact_data[0],
                            //          'module_id'=>$marks['m_new_id'][$key],
                            //          'marks'=>$marks['m_marks'][$key],
                            //          'mod_grade'=>$marks['mod_grade'][$key],
                            //          // 'total'=>$marks['total'],
                            //          // 'avg'=>$marks['avg'],
                            //          // 'grade'=>$marks['grade'],
             
                            //      );
             
                            //      $this->db->insert("exam_module",$exam_module);
                                            
                             
                //             //  }
                                             
                //  $current_yr = date("y");
                //  //  }
                //  if($insert_id <= 9){
                //  $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                //  }
                //  else{
                //      $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                //  }
                //             // if($insert_id){
                //             //     $selected = array(
                //             //         'lead_management_id' =>$insert_id,
                //             //         'lead_id_code' =>$new_code_id,
                                     
                //             //     );
                
                //             //     $this->db->insert("lead_id_table",$selected);
                              
                                
                                    
                
                
                //             // }
                            
        
                //             if($insert_id){
                //                 $selected = array(
                                    
                //                     'lead_id_code' =>$new_code_id,
                                     
                //                 );
                //                 $this->db->where('id', $insert_id);
                //                 $this->db->update('lead_management', $selected);
                               
                //                 for($j=0; $j<count($val['l_source']); $j++){
                //                     $this->db->insert('lead_inserted_lead_source',
                //                      array('l_source' =>$val['l_source'][$j] ,
                //                            'lead_management_tb_id' =>$insert_id));
                //                 }
        
                //                 for($k=0; $k<count($val['l_interest_co']); $k++){
                //                     $this->db->insert('lead_inserted_other_inter_programs',
                //                      array('other_program' =>$val['l_interest_co'][$k] ,
                //                            'lead_management_tb_id' =>$insert_id));
                //                 }
            
                                
                                    
                
                
                //             }
                              // $this->db->where('id',$val['update_nw_id']);
                              // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));
        
                              echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
                           }else{
        
                              echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                          }
                    }else{
                        echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under '.$lead_data1->l_phone,'message2'=>'Lead ID is : '.$lead_data1->lead_id_code));
                    
                    }
    
                }else{
                    // $count2=$this->class_mod->check_lead2($program,$batch,$email);
                    // $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);
                    if($count2==0){
                        // echo json_encode(array('status1'=>true));

                        
        
                        if($loan == "No"){
           

                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'no',
                              'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
                        }else if($loan == "Yes"){
            
                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'pending',
                              'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
            
            
            
            
            
                        }
        
                       
        
        
                          if ($this->db->insert('lead_management',$data)) {
                            $insert_id = $this->db->insert_id();
                          
                            
                            
                            
               
                            $get_end_date =$this->class_mod->get_end_date();

                




                            // var_dump($get_end_date);
                            // die();
                            
                           
                            $lead_id_ab;
                            $end_date;
            
            
                            if($get_end_date != NULL)
                            {
                                   $end_date=$get_end_date->to_date;
                                   $datediff = strtotime($end_date)-strtotime($current_date);
            
                                 
                                   
                                
                                  
                                   $lead_id_ab=$get_lead_id_code_increment->lead_id_code;
            
            
                                //    var_dump($lead_id_ab);
                                //    die();
                                   if($datediff / (60 * 60 * 24) > 1){
            
            
                                       
            
                                    $explode_lead_id = explode("/",$lead_id_ab);
              
            
                                    $inq= $explode_lead_id[0];
                                    $yr=$explode_lead_id[1];
                                    $number = $explode_lead_id[2];
                                   
            
                                    $number =$number+1;
                                    if($number <10){
                                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
            
                                    }else{
                                        $lead_id_ab = $inq.'/'.$yr.'/'.$number;
            
                                    }
                                   
                                    
                                    $selected = array(
                                    
                                        'lead_id_code' =>$lead_id_ab,
                                         
                                    );
                                    $this->db->where('id', $insert_id);
                                    $this->db->update('lead_management', $selected);
            
            
            
            
                                   }else{
                                     
                                    $explode_lead_id = explode("/",$lead_id_ab);
                                    $inq= $explode_lead_id[0];
                                    $yr=$explode_lead_id[1];
                                    $number = 01;
            
                                    $yr=$yr+1;
            
                                   
                                    $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                                    
                                    $selected = array(
                                    
                                        'lead_id_code' =>$lead_id_ab,
                                         
                                    );
                                    $this->db->where('id', $insert_id);
                                    $this->db->update('lead_management', $selected);
            
            
                                    $explode_end_date = explode("-",$end_date);
                                    // $end_year=$explode_end_date[0]+1;
            
                                    $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];
            
                                    $selected_end_date_update = array(
                                    
                                        'to_date' =>$new_end_year,
                                         
                                    );
                                    $this->db->where('id', $get_end_date->finance_tb_id);
                                    $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);
            
            
                                   
            
            
                                    
            
                                   }
            
                                   
            
            
            
            
                            }else{
                                $lead_id_ab = "INQ/21/01";
                                $end_date = "2022-03-31";
            
                                $selected = array(
                                    
                                    'lead_id_code' =>$lead_id_ab,
                                     
                                );
                                $this->db->where('id', $insert_id);
                                $this->db->update('lead_management', $selected);
            
            
                                $selected_end_date = array(
                                    
                                    'to_date' =>$end_date,
                                     
                                );
                             
                                $this->db->insert('finance_inq_num_code_tb', $selected_end_date);
            
                            }          
                            // foreach($marks['m_new_id'] as $key =>$value)
                            // {                   
                             
                            //      $exam_module = array(
                            //          'exam_id' =>$insert_id,
                            //          'batch_id'=>$bact_data[0],
                            //          'module_id'=>$marks['m_new_id'][$key],
                            //          'marks'=>$marks['m_marks'][$key],
                            //          'mod_grade'=>$marks['mod_grade'][$key],
                            //          // 'total'=>$marks['total'],
                            //          // 'avg'=>$marks['avg'],
                            //          // 'grade'=>$marks['grade'],
             
                            //      );
             
                            //      $this->db->insert("exam_module",$exam_module);
                            
                            
            
                            if($insert_id){
                                // $selected = array(
                                    
                                //     'lead_id_code' =>$lead_id,
                                     
                                // );
                                // $this->db->where('id', $insert_id);
                                // $this->db->update('lead_management', $selected);
            
                                // $selected_end_date = array(
                                    
                                //     'to_date' =>$end_date,
                                     
                                // );
                             
                                // $this->db->insert('finance_inq_num_code_tb', $selected_end_date);
                               
                                for($j=0; $j<count($val['l_source']); $j++){
                                    $this->db->insert('lead_inserted_lead_source',
                                     array('l_source' =>$val['l_source'][$j] ,
                                           'lead_management_tb_id' =>$insert_id));
                                }
            
                                for($k=0; $k<count($val['l_interest_co']); $k++){
                                    $this->db->insert('lead_inserted_other_inter_programs',
                                     array('other_program' =>$val['l_interest_co'][$k] ,
                                           'lead_management_tb_id' =>$insert_id));
                                }
            
                                
                                    
                
                
                            }
                            // foreach($marks['m_new_id'] as $key =>$value)
                            // {                   
                             
                            //      $exam_module = array(
                            //          'exam_id' =>$insert_id,
                            //          'batch_id'=>$bact_data[0],
                            //          'module_id'=>$marks['m_new_id'][$key],
                            //          'marks'=>$marks['m_marks'][$key],
                            //          'mod_grade'=>$marks['mod_grade'][$key],
                            //          // 'total'=>$marks['total'],
                            //          // 'avg'=>$marks['avg'],
                            //          // 'grade'=>$marks['grade'],
             
                            //      );
             
                            //      $this->db->insert("exam_module",$exam_module);
                                            
                             
                            //  }
                                             
                //  $current_yr = date("y");
                //  //  }
                //  if($insert_id <= 9){
                //  $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                //  }
                //  else{
                //      $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                //  }
                            // if($insert_id){
                            //     $selected = array(
                            //         'lead_management_id' =>$insert_id,
                            //         'lead_id_code' =>$new_code_id,
                                     
                            //     );
                
                            //     $this->db->insert("lead_id_table",$selected);
                              
                                
                                    
                
                
                            // }
                            
        
                            // if($insert_id){
                            //     $selected = array(
                                    
                            //         'lead_id_code' =>$new_code_id,
                                     
                            //     );
                            //     $this->db->where('id', $insert_id);
                            //     $this->db->update('lead_management', $selected);
                               
                            //     for($j=0; $j<count($val['l_source']); $j++){
                            //         $this->db->insert('lead_inserted_lead_source',
                            //          array('l_source' =>$val['l_source'][$j] ,
                            //                'lead_management_tb_id' =>$insert_id));
                            //     }
        
                            //     for($k=0; $k<count($val['l_interest_co']); $k++){
                            //         $this->db->insert('lead_inserted_other_inter_programs',
                            //          array('other_program' =>$val['l_interest_co'][$k] ,
                            //                'lead_management_tb_id' =>$insert_id));
                            //     }
            
                                
                                    
                
                
                            // }
                              // $this->db->where('id',$val['update_nw_id']);
                              // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));
        
                              echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
                           }else{
        
                              echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                          }
                        
                    }else{
                        echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under  '.$lead_data2->l_email,'message2'=>'Lead ID is : '.$lead_data2->lead_id_code));
             
                    }
    
                }
            }
          
            else if($email != "noemail@nomail.com" && $phone != "1234567890"){
                // var_dump($program,$batch,$email,$phone);
                // die();
    
                // $count1=$this->class_mod->check_lead1($program,$batch,$phone);
                // $count2=$this->class_mod->check_lead2($program,$batch,$email);
                // $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
                // $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);
                 
                if($count1==0 && $count2==0){
                    
                    if($loan == "No"){
           

                        $data = array(
        
                            'inq_by' => $val['inq_by'],
                            'parent_salutation' => $val['salutation_parent'],
                            'parent_name' => $val['parent_name'],
                          'salutation' => $val['salutation'],
                          'f_name' => $val['f_name'],
                          'mid_name' => $val['mid_name'],
                          'l_name' => $val['l_name'],
                          'l_phone' => $val['l_phone'],
                          'l_phone_2' => $val['l_phone_2'],
                          'nic_pass_info' => $val['nic_pass_info'],
                          'nic_div' => $val['nic_num'],
                          'passport_div' => $val['pass_num'],
                          'l_email' => $val['l_email'],
                          'address1' => $val['address1'],
                          'address2' => $val['address2'],
                          'city' => $val['city'],
                          'state_pro' => $val['province'],
                          'zip_pos' => $val['zip_pos'],
                          'country' => $val['country'],
                          'email_select' => $val['email_select'],
                          'phone_select' =>$val['phone_select'],
                          'reffered' => $val['reffered'],
                          'refferal_type' => $val['refferal_type'],
                          'ref_nic' => $val['ref_nic'],
                          'agent_name' => $val['det_agent'],
                          'ref_remarks' => $val['ref_remarks'],
                          'programe' => $val['select_course'],
                          'batch_id' => $val['batch_id_select'],
                          'study_method' => $val['pref_study_method'],
                          'ex_type' => $val['ex_type'],
                          'ex_years' => $val['ex_years'],
                          'ex_months' => $val['ex_months'],
                          'ol_res' => $val['ol_res'],
                          'ol_year' => $val['ol_year'],
                          'al_res' => $val['al_res'],
                          'al_year' => $val['al_year'],
                          'other_edu' => $val['other_edu'],
                          'loan_info' => $val['loan_info'],
                          'contact_method' => $val['contacted_method'],
                          'con_box'=> $val['con_box'],
                          'int_level' => $val['int_level'],
                          'dead_line_date' => $val['dead_line_date'],
                          'next_contact' => $val['next_contact'],
                          'pref_contact_method' => $val['pref_contact_method'],
                          'al_school'=>$val['al_att_skl'],
                          'al_stream'=>$val['al_stream'],
                          'day'=>$val['day'],
                          'next_contact_date'=>$val['next_date'],
                          'next_contact_time'=>$val['next_contact_time'],
                          'remarks'=>$val['next_remarks'],
                          'd_state' => 0,
                            'User_id'=> USER_ID,
                            'lead_created_date_time'=>$currentDateTime,
                          'lead_created_date'=>$current_date,
                          'education_loan_status'=>'no',
                          'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                            'lead_owner' =>$val['l_coun']
                            
                            
                        );
                    }else if($loan == "Yes"){
        
                        $data = array(
        
                            'inq_by' => $val['inq_by'],
                            'parent_salutation' => $val['salutation_parent'],
                            'parent_name' => $val['parent_name'],
                          'salutation' => $val['salutation'],
                          'f_name' => $val['f_name'],
                          'mid_name' => $val['mid_name'],
                          'l_name' => $val['l_name'],
                          'l_phone' => $val['l_phone'],
                          'l_phone_2' => $val['l_phone_2'],
                          'nic_pass_info' => $val['nic_pass_info'],
                          'nic_div' => $val['nic_num'],
                          'passport_div' => $val['pass_num'],
                          'l_email' => $val['l_email'],
                          'address1' => $val['address1'],
                          'address2' => $val['address2'],
                          'city' => $val['city'],
                          'state_pro' => $val['province'],
                          'zip_pos' => $val['zip_pos'],
                          'country' => $val['country'],
                          'email_select' => $val['email_select'],
                          'phone_select' =>$val['phone_select'],
                          'reffered' => $val['reffered'],
                          'refferal_type' => $val['refferal_type'],
                          'ref_nic' => $val['ref_nic'],
                          'agent_name' => $val['det_agent'],
                          'ref_remarks' => $val['ref_remarks'],
                          'programe' => $val['select_course'],
                          'batch_id' => $val['batch_id_select'],
                          'study_method' => $val['pref_study_method'],
                          'ex_type' => $val['ex_type'],
                          'ex_years' => $val['ex_years'],
                          'ex_months' => $val['ex_months'],
                          'ol_res' => $val['ol_res'],
                          'ol_year' => $val['ol_year'],
                          'al_res' => $val['al_res'],
                          'al_year' => $val['al_year'],
                          'other_edu' => $val['other_edu'],
                          'loan_info' => $val['loan_info'],
                          'contact_method' => $val['contacted_method'],
                          'con_box'=> $val['con_box'],
                          'int_level' => $val['int_level'],
                          'dead_line_date' => $val['dead_line_date'],
                          'next_contact' => $val['next_contact'],
                          'pref_contact_method' => $val['pref_contact_method'],
                          'al_school'=>$val['al_att_skl'],
                          'al_stream'=>$val['al_stream'],
                          'day'=>$val['day'],
                          'next_contact_date'=>$val['next_date'],
                          'next_contact_time'=>$val['next_contact_time'],
                          'remarks'=>$val['next_remarks'],
                          'd_state' => 0,
                            'User_id'=> USER_ID,
                            'lead_created_date_time'=>$currentDateTime,
                          'lead_created_date'=>$current_date,
                          'education_loan_status'=>'pending',
                          'last_call_date'=>$current_date,
                          'last_call_time'=>$current_time,
                            'lead_owner' =>$val['l_coun']
                            
                            
                        );
        
        
        
        
        
                    }
    
                    
    
    
                      if ($this->db->insert('lead_management',$data)) {
                        // $insert_id = $this->db->insert_id();
                        $insert_id = $this->db->insert_id(); 
                        
                        
             
                        $get_end_date =$this->class_mod->get_end_date();

                




                        // var_dump($get_end_date);
                        // die();
                        
                       
                        $lead_id_ab;
                        $end_date;
        
        
                        if($get_end_date != NULL)
                        {
                               $end_date=$get_end_date->to_date;
                               $datediff = strtotime($end_date)-strtotime($current_date);
        
                             
                               
                            
                              
                               $lead_id_ab=$get_lead_id_code_increment->lead_id_code;
        
        
                            //    var_dump($lead_id_ab);
                            //    die();
                               if($datediff / (60 * 60 * 24) > 1){
        
        
                                   
        
                                $explode_lead_id = explode("/",$lead_id_ab);
          
        
                                $inq= $explode_lead_id[0];
                                $yr=$explode_lead_id[1];
                                $number = $explode_lead_id[2];
                               
        
                                $number =$number+1;
                                if($number <10){
                                    $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
        
                                }else{
                                    $lead_id_ab = $inq.'/'.$yr.'/'.$number;
        
                                }
                               
                                
                                $selected = array(
                                
                                    'lead_id_code' =>$lead_id_ab,
                                     
                                );
                                $this->db->where('id', $insert_id);
                                $this->db->update('lead_management', $selected);
        
        
        
        
                               }else{
                                 
                                $explode_lead_id = explode("/",$lead_id_ab);
                                $inq= $explode_lead_id[0];
                                $yr=$explode_lead_id[1];
                                $number = 01;
        
                                $yr=$yr+1;
        
                               
                                $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                                
                                $selected = array(
                                
                                    'lead_id_code' =>$lead_id_ab,
                                     
                                );
                                $this->db->where('id', $insert_id);
                                $this->db->update('lead_management', $selected);
        
        
                                $explode_end_date = explode("-",$end_date);
                                // $end_year=$explode_end_date[0]+1;
        
                                $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];
        
                                $selected_end_date_update = array(
                                
                                    'to_date' =>$new_end_year,
                                     
                                );
                                $this->db->where('id', $get_end_date->finance_tb_id);
                                $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);
        
        
                               
        
        
                                
        
                               }
        
                               
        
        
        
        
                        }else{
                            $lead_id_ab = "INQ/21/01";
                            $end_date = "2022-03-31";
        
                            $selected = array(
                                
                                'lead_id_code' =>$lead_id_ab,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management', $selected);
        
        
                            $selected_end_date = array(
                                
                                'to_date' =>$end_date,
                                 
                            );
                         
                            $this->db->insert('finance_inq_num_code_tb', $selected_end_date);
        
                        }             
                // foreach($marks['m_new_id'] as $key =>$value)
                // {                   
                 
                //      $exam_module = array(
                //          'exam_id' =>$insert_id,
                //          'batch_id'=>$bact_data[0],
                //          'module_id'=>$marks['m_new_id'][$key],
                //          'marks'=>$marks['m_marks'][$key],
                //          'mod_grade'=>$marks['mod_grade'][$key],
                //          // 'total'=>$marks['total'],
                //          // 'avg'=>$marks['avg'],
                //          // 'grade'=>$marks['grade'],
 
                //      );
 
                //      $this->db->insert("exam_module",$exam_module);
                
                

                if($insert_id){
                    // $selected = array(
                        
                    //     'lead_id_code' =>$lead_id,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management', $selected);

                    // $selected_end_date = array(
                        
                    //     'to_date' =>$end_date,
                         
                    // );
                 
                    // $this->db->insert('finance_inq_num_code_tb', $selected_end_date);
                   
                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    
                        
    
    
                }
                    
                        // foreach($marks['m_new_id'] as $key =>$value)
                        // {                   
                         
                        //      $exam_module = array(
                        //          'exam_id' =>$insert_id,
                        //          'batch_id'=>$bact_data[0],
                        //          'module_id'=>$marks['m_new_id'][$key],
                        //          'marks'=>$marks['m_marks'][$key],
                        //          'mod_grade'=>$marks['mod_grade'][$key],
                        //          // 'total'=>$marks['total'],
                        //          // 'avg'=>$marks['avg'],
                        //          // 'grade'=>$marks['grade'],
         
                        //      );
         
                        //      $this->db->insert("exam_module",$exam_module);
                                        
                         
                        //  }
                                         
                //  $current_yr = date("y");
                //  //  }
                //  if($insert_id <= 9){
                //  $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                //  }
                //  else{
                //      $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                //  }
                        // if($insert_id){
                        //     $selected = array(
                        //         'lead_management_id' =>$insert_id,
                        //         'lead_id_code' =>$new_code_id,
                                 
                        //     );
            
                        //     $this->db->insert("lead_id_table",$selected);
                          
                            
                                
            
            
                        // }
                        
    
                        // if($insert_id){
                        //     $selected = array(
                                
                        //         'lead_id_code' =>$new_code_id,
                                 
                        //     );
                        //     $this->db->where('id', $insert_id);
                        //     $this->db->update('lead_management', $selected);
                           
                        //     for($j=0; $j<count($val['l_source']); $j++){
                        //         $this->db->insert('lead_inserted_lead_source',
                        //          array('l_source' =>$val['l_source'][$j] ,
                        //                'lead_management_tb_id' =>$insert_id));
                        //     }
    
                        //     for($k=0; $k<count($val['l_interest_co']); $k++){
                        //         $this->db->insert('lead_inserted_other_inter_programs',
                        //          array('other_program' =>$val['l_interest_co'][$k] ,
                        //                'lead_management_tb_id' =>$insert_id));
                        //     }
        
                            
                                
            
            
                        // }
                          // $this->db->where('id',$val['update_nw_id']);
                          // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));
    
                          echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
                       }else{
    
                          echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                      }
    
                    
                    // echo json_encode(array('status'=>true,'message'=>'already there is a Lead under'));
                    
                }else if($count1!=0 && $count2!=0){
                    if($lead_data1->lead_id_code == $lead_data2->lead_id_code)
                    {
                              echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under  '.$lead_data1->l_phone.' & '.$lead_data2->l_email,'message2'=>'Lead ID is : '.$lead_data2->lead_id_code));
                    }
                    else{
                        echo json_encode(array('status1'=>false,'message1'=>'already there are Leads under  '.$lead_data1->l_phone.' & '.$lead_data2->l_email,'message2'=>'Lead IDs are : '.$lead_data1->lead_id_code.' , '.$lead_data2->lead_id_code));
    
                    }
    
                    
                        
                        
                    
                }else if($count1==0 && $count2!=0)
                {
                    echo json_encode(array('status1'=>false,'message1'=>'already there is a Leads under  '.$lead_data2->l_email,'message2'=>'Lead IDs are : '.$lead_data2->lead_id_code));
    
                }else if($count1!=0 && $count2==0)
                {
                    echo json_encode(array('status1'=>false,'message1'=>'already there is a Leads under  '.$lead_data1->l_phone,'message2'=>'Lead IDs are : '.$lead_data1->lead_id_code));
    
                }
    
            }
            
            // else{



            //////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////
            

                
                // $l_coun = $val['l_coun'];
                
                // if($l_coun == NULL){
                //   $data = array(

                //       'inq_by' => $val['inq_by'],
                //       'parent_salutation' => $val['salutation_parent'],
                //       'parent_name' => $val['parent_name'],
                //       'salutation' => $val['salutation'],
                //       'f_name' => $val['f_name'],
                //       'mid_name' => $val['mid_name'],
                //       'l_name' => $val['l_name'],
                //       'l_phone' => $val['l_phone'],
                //       'l_phone_2' => $val['l_phone_2'],
                //       'nic_pass_info' => $val['nic_pass_info'],
                //       'nic_div' => $val['nic_num'],
                //       'passport_div' => $val['pass_num'],
                //       'l_email' => $val['l_email'],
                //       'address1' => $val['address1'],
                //       'address2' => $val['address2'],
                //       'city' => $val['city'],
                //       'state_pro' => $val['province'],
                //       'zip_pos' => $val['zip_pos'],
                //       'country' => $val['country'],
                //     //   'l_coun' => $val['l_coun'],
                //       'reffered' => $val['reffered'],
                //       'refferal_type' => $val['refferal_type'],
                //       'ref_nic' => $val['ref_nic'],
                //       'agent_name' => $val['det_agent'],
                //       'ref_remarks' => $val['ref_remarks'],
                //       'programe' => $val['select_course'],
                //       'batch_id' => $val['sel_batch_id'],
                //       'study_method' => $val['pref_study_method'],
                //       'ex_type' => $val['ex_type'],
                //       'ex_years' => $val['ex_years'],
                //       'ex_months' => $val['ex_months'],
                //       'ol_res' => $val['ol_res'],
                //       'ol_year' => $val['ol_year'],
                //       'al_res' => $val['al_res'],
                //       'al_year' => $val['al_year'],
                //       'other_edu' => $val['other_edu'],
                //       'loan_info' => $val['loan_info'],
                //       'contact_method' => $val['contacted_method'],
                //       'con_box'=> $val['con_box'],
                //       'int_level' => $val['int_level'],
                //       'dead_line_date' => $val['dead_line_date'],
                //       'next_contact' => $val['next_contact'],
                //       'pref_contact_method' => $val['pref_contact_method'],
                //       'al_school'=>$val['al_att_skl'],
                //       'al_stream'=>$val['al_stream'],
                //       'day'=>$val['day'],
                //       'next_contact_date'=>$val['next_date'],
                //       'next_contact_time'=>$val['next_contact_time'],
                //       'remarks'=>$val['next_remarks'],
                //       'd_state' => 0,
                //       'User_id'=> USER_ID,
                //       'lead_created_date_time'=>$currentDateTime,
                //       'lead_created_date'=>$current_date,
                //         'lead_owner' => USER_ID   
                //   );
                // }else{

                //     $data = array(

                //         'inq_by' => $val['inq_by'],
                //         'parent_salutation' => $val['salutation_parent'],
                //         'parent_name' => $val['parent_name'],
                //       'salutation' => $val['salutation'],
                //       'f_name' => $val['f_name'],
                //       'mid_name' => $val['mid_name'],
                //       'l_name' => $val['l_name'],
                //       'l_phone' => $val['l_phone'],
                //       'l_phone_2' => $val['l_phone_2'],
                //       'nic_pass_info' => $val['nic_pass_info'],
                //       'nic_div' => $val['nic_num'],
                //       'passport_div' => $val['pass_num'],
                //       'l_email' => $val['l_email'],
                //       'address1' => $val['address1'],
                //       'address2' => $val['address2'],
                //       'city' => $val['city'],
                //       'state_pro' => $val['province'],
                //       'zip_pos' => $val['zip_pos'],
                //       'country' => $val['country'],
                //     //   'l_coun' => $val['l_coun'],
                //       'reffered' => $val['reffered'],
                //       'refferal_type' => $val['refferal_type'],
                //       'ref_nic' => $val['ref_nic'],
                //       'agent_name' => $val['det_agent'],
                //       'ref_remarks' => $val['ref_remarks'],
                //       'programe' => $val['select_course'],
                //       'batch_id' => $val['sel_batch_id'],
                //       'study_method' => $val['pref_study_method'],
                //       'ex_type' => $val['ex_type'],
                //       'ex_years' => $val['ex_years'],
                //       'ex_months' => $val['ex_months'],
                //       'ol_res' => $val['ol_res'],
                //       'ol_year' => $val['ol_year'],
                //       'al_res' => $val['al_res'],
                //       'al_year' => $val['al_year'],
                //       'other_edu' => $val['other_edu'],
                //       'loan_info' => $val['loan_info'],
                //       'contact_method' => $val['contacted_method'],
                //       'con_box'=> $val['con_box'],
                //       'int_level' => $val['int_level'],
                //       'dead_line_date' => $val['dead_line_date'],
                //       'next_contact' => $val['next_contact'],
                //       'pref_contact_method' => $val['pref_contact_method'],
                //       'al_school'=>$val['al_att_skl'],
                //       'al_stream'=>$val['al_stream'],
                //       'day'=>$val['day'],
                //       'next_contact_date'=>$val['next_date'],
                //       'next_contact_time'=>$val['next_contact_time'],
                //       'remarks'=>$val['next_remarks'],
                //       'd_state' => 0,
                //         'User_id'=> USER_ID,
                //         'lead_created_date_time'=>$currentDateTime,
                //       'lead_created_date'=>$current_date,
                //         'lead_owner' =>$val['l_coun']
                        
                        
                //     );

                // }


                //   if ($this->db->insert('lead_management',$data)) {
                //     // $insert_id = $this->db->insert_id();
                //     $insert_id = $this->db->insert_id(); 
                    
                    
                
                //     // foreach($marks['m_new_id'] as $key =>$value)
                //     // {                   
                     
                //     //      $exam_module = array(
                //     //          'exam_id' =>$insert_id,
                //     //          'batch_id'=>$bact_data[0],
                //     //          'module_id'=>$marks['m_new_id'][$key],
                //     //          'marks'=>$marks['m_marks'][$key],
                //     //          'mod_grade'=>$marks['mod_grade'][$key],
                //     //          // 'total'=>$marks['total'],
                //     //          // 'avg'=>$marks['avg'],
                //     //          // 'grade'=>$marks['grade'],
     
                //     //      );
     
                //     //      $this->db->insert("exam_module",$exam_module);
                                    
                     
                //     //  }
                //     if($insert_id <= 9){
                //     $new_code_id = "IIHS/LD/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id = "IIHS/LD/".$insert_id;  
                //     }
                //     // if($insert_id){
                //     //     $selected = array(
                //     //         'lead_management_id' =>$insert_id,
                //     //         'lead_id_code' =>$new_code_id,
                             
                //     //     );
        
                //     //     $this->db->insert("lead_id_table",$selected);
                      
                        
                            
        
        
                //     // }
                    

                //     if($insert_id){
                //         $selected = array(
                            
                //             'lead_id_code' =>$new_code_id,
                             
                //         );
                //         $this->db->where('id', $insert_id);
                //         $this->db->update('lead_management', $selected);
                       
                //         for($j=0; $j<count($val['l_source']); $j++){
                //             $this->db->insert('lead_inserted_lead_source',
                //              array('l_source' =>$val['l_source'][$j] ,
                //                    'lead_management_tb_id' =>$insert_id));
                //         }

                //         for($k=0; $k<count($val['l_interest_co']); $k++){
                //             $this->db->insert('lead_inserted_other_inter_programs',
                //              array('other_program' =>$val['l_interest_co'][$k] ,
                //                    'lead_management_tb_id' =>$insert_id));
                //         }
    
                        
                            
        
        
                //     }
                //       // $this->db->where('id',$val['update_nw_id']);
                //       // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));

                //       echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$new_code_id.' ]'));
                //    }else{

                //       echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                //   }
                // }









          ////////////////////////////////////////////.............edit..................../////////////////////////

              }else if ($method == 'bulk_add'){
//////////////////////////////////////////////////bulk add//////////////////////////////////////////////////////////////







$program=$val['select_course'];
            $batch=$val['batch_id_select'];
            $current_date = date('Y-m-d');

            $email=$val['l_email'];
            $phone=$val['l_phone'];
            $loan = $val['loan_info'];


    
            // $count1=$this->class_mod->check_lead1($program,$batch,$phone);
            // $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
            // $count2=$this->class_mod->check_lead2($program,$batch,$email);
            // $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);

            $count1=$this->class_mod->check_lead1($program,$current_date,$phone);
            $lead_data1=$this->class_mod->check_lead_data1($program,$current_date,$phone);
            $count2=$this->class_mod->check_lead2($program,$current_date,$email);
            $lead_data2=$this->class_mod->check_lead_data2($program,$current_date,$email);

             if($email == "noemail@nomail.com" && $phone == "1234567890")
            {
     
    
            // echo json_encode(array('status1'=>true));
            if($loan == "No"){
           

                $data = array(

                    'inq_by' => $val['inq_by'],
                    'parent_salutation' => $val['salutation_parent'],
                    'parent_name' => $val['parent_name'],
                  'salutation' => $val['salutation'],
                  'f_name' => $val['f_name'],
                  'mid_name' => $val['mid_name'],
                  'l_name' => $val['l_name'],
                  'l_phone' => $val['l_phone'],
                  'l_phone_2' => $val['l_phone_2'],
                  'nic_pass_info' => $val['nic_pass_info'],
                  'nic_div' => $val['nic_num'],
                  'passport_div' => $val['pass_num'],
                  'l_email' => $val['l_email'],
                  'address1' => $val['address1'],
                  'address2' => $val['address2'],
                  'city' => $val['city'],
                  'state_pro' => $val['province'],
                  'zip_pos' => $val['zip_pos'],
                  'country' => $val['country'],
                  'email_select' => $val['email_select'],
                  'phone_select' =>$val['phone_select'],
                  'reffered' => $val['reffered'],
                  'refferal_type' => $val['refferal_type'],
                  'ref_nic' => $val['ref_nic'],
                  'agent_name' => $val['det_agent'],
                  'ref_remarks' => $val['ref_remarks'],
                  'programe' => $val['select_course'],
                  'batch_id' => $val['batch_id_select'],
                  'study_method' => $val['pref_study_method'],
                  'ex_type' => $val['ex_type'],
                  'ex_years' => $val['ex_years'],
                  'ex_months' => $val['ex_months'],
                  'ol_res' => $val['ol_res'],
                  'ol_year' => $val['ol_year'],
                  'al_res' => $val['al_res'],
                  'al_year' => $val['al_year'],
                  'other_edu' => $val['other_edu'],
                  'loan_info' => $val['loan_info'],
                  'contact_method' => $val['contacted_method'],
                  'con_box'=> $val['con_box'],
                  'int_level' => $val['int_level'],
                  'dead_line_date' => $val['dead_line_date'],
                  'next_contact' => $val['next_contact'],
                  'pref_contact_method' => $val['pref_contact_method'],
                  'al_school'=>$val['al_att_skl'],
                  'al_stream'=>$val['al_stream'],
                  'day'=>$val['day'],
                  'next_contact_date'=>$val['next_date'],
                  'next_contact_time'=>$val['next_contact_time'],
                  'remarks'=>$val['next_remarks'],
                  'd_state' => 0,
                    'User_id'=> USER_ID,
                    'lead_created_date_time'=>$currentDateTime,
                  'lead_created_date'=>$current_date,
                  'education_loan_status'=>'no',
                  'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                  'pre_lead_came_date'=>$current_date,
                  'pre_lead_status'=>'Pre Lead',
                    'lead_owner' =>$val['l_coun']
                    
                    
                );
            }else if($loan == "Yes"){

                $data = array(

                    'inq_by' => $val['inq_by'],
                    'parent_salutation' => $val['salutation_parent'],
                    'parent_name' => $val['parent_name'],
                  'salutation' => $val['salutation'],
                  'f_name' => $val['f_name'],
                  'mid_name' => $val['mid_name'],
                  'l_name' => $val['l_name'],
                  'l_phone' => $val['l_phone'],
                  'l_phone_2' => $val['l_phone_2'],
                  'nic_pass_info' => $val['nic_pass_info'],
                  'nic_div' => $val['nic_num'],
                  'passport_div' => $val['pass_num'],
                  'l_email' => $val['l_email'],
                  'address1' => $val['address1'],
                  'address2' => $val['address2'],
                  'city' => $val['city'],
                  'state_pro' => $val['province'],
                  'zip_pos' => $val['zip_pos'],
                  'country' => $val['country'],
                  'email_select' => $val['email_select'],
                  'phone_select' =>$val['phone_select'],
                  'reffered' => $val['reffered'],
                  'refferal_type' => $val['refferal_type'],
                  'ref_nic' => $val['ref_nic'],
                  'agent_name' => $val['det_agent'],
                  'ref_remarks' => $val['ref_remarks'],
                  'programe' => $val['select_course'],
                  'batch_id' => $val['batch_id_select'],
                  'study_method' => $val['pref_study_method'],
                  'ex_type' => $val['ex_type'],
                  'ex_years' => $val['ex_years'],
                  'ex_months' => $val['ex_months'],
                  'ol_res' => $val['ol_res'],
                  'ol_year' => $val['ol_year'],
                  'al_res' => $val['al_res'],
                  'al_year' => $val['al_year'],
                  'other_edu' => $val['other_edu'],
                  'loan_info' => $val['loan_info'],
                  'contact_method' => $val['contacted_method'],
                  'con_box'=> $val['con_box'],
                  'int_level' => $val['int_level'],
                  'dead_line_date' => $val['dead_line_date'],
                  'next_contact' => $val['next_contact'],
                  'pref_contact_method' => $val['pref_contact_method'],
                  'al_school'=>$val['al_att_skl'],
                  'al_stream'=>$val['al_stream'],
                  'day'=>$val['day'],
                  'next_contact_date'=>$val['next_date'],
                  'next_contact_time'=>$val['next_contact_time'],
                  'remarks'=>$val['next_remarks'],
                  'd_state' => 0,
                    'User_id'=> USER_ID,
                    'lead_created_date_time'=>$currentDateTime,
                  'lead_created_date'=>$current_date,
                  'education_loan_status'=>'pending',
                  'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                  'pre_lead_came_date'=>$current_date,
                  'pre_lead_status'=>'Pre Lead',
                    'lead_owner' =>$val['l_coun']
                    
                    
                );





            }

            


              if ($this->db->insert('lead_management',$data)) {


                
                // $insert_id = $this->db->insert_id();
                $insert_id = $this->db->insert_id(); 
                
                $get_end_date =$this->class_mod->get_end_date();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab;
                $end_date;


                if($get_end_date != NULL)
                {
                       $end_date=$get_end_date->to_date;
                       $datediff = strtotime($end_date)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab=$get_lead_id_code_increment->lead_id_code;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id = explode("/",$lead_id_ab);
  

                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = $explode_lead_id[2];
                       

                        $number =$number+1;
                        if($number <10){
                            $lead_id_ab = $inq.'/'.$yr.'/0'.$number;

                        }else{
                            $lead_id_ab = $inq.'/'.$yr.'/'.$number;

                        }
                       
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);




                       }else{
                         
                        $explode_lead_id = explode("/",$lead_id_ab);
                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = 01;

                        $yr=$yr+1;

                       
                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);


                        $explode_end_date = explode("-",$end_date);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];

                        $selected_end_date_update = array(
                        
                            'to_date' =>$new_end_year,
                             
                        );
                        $this->db->where('id', $get_end_date->finance_tb_id);
                        $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab = "INQ/21/01";
                    $end_date = "2022-03-31";

                    $selected = array(
                        
                        'lead_id_code' =>$lead_id_ab,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management', $selected);


                    $selected_end_date = array(
                        
                        'to_date' =>$end_date,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb', $selected_end_date);

                }         
                
            
                // foreach($marks['m_new_id'] as $key =>$value)
                // {                   
                 
                //      $exam_module = array(
                //          'exam_id' =>$insert_id,
                //          'batch_id'=>$bact_data[0],
                //          'module_id'=>$marks['m_new_id'][$key],
                //          'marks'=>$marks['m_marks'][$key],
                //          'mod_grade'=>$marks['mod_grade'][$key],
                //          // 'total'=>$marks['total'],
                //          // 'avg'=>$marks['avg'],
                //          // 'grade'=>$marks['grade'],
 
                //      );
 
                //      $this->db->insert("exam_module",$exam_module);
                                
                 
                //  }
                                
                // $current_yr = date("y");
                // //  }
                // if($insert_id <= 9){
                // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // }
                // else{
                //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // }
                // if($insert_id){
                //     $selected = array(
                //         'lead_management_id' =>$insert_id,
                //         'lead_id_code' =>$new_code_id,
                         
                //     );
    
                //     $this->db->insert("lead_id_table",$selected);
                  
                    
                        
    
    
                // }
                

                if($insert_id){
                    // $selected = array(
                        
                    //     'lead_id_code' =>$new_code_id,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management', $selected);
                   
                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$insert_id));
                    }

                    
                        
    
    
                }
                  // $this->db->where('id',$val['update_nw_id']);
                  // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));


                  $selected_pre = array(
                        
                    'lead_status' =>'Real Lead',
                    'pass_date_as_real_lead'=>$current_date,
                     
                );
                $this->db->where('id', $bulk_tb_id);
                $this->db->update('lead_management_pre', $selected_pre);




                  

                  echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
               }else{

                  echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
              }
            }
            else if(($email != "noemail@nomail.com" && $phone == "1234567890") ||  ($email == "noemail@nomail.com" && $phone != "1234567890") )
            {
                if($email == "noemail@nomail.com"){
                    // $count1=$this->class_mod->check_lead1($program,$batch,$phone);
                    // $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
    
    
                    if($count1==0){
                        // echo json_encode(array('status1'=>true));
                        
        
                        if($loan == "No"){
           

                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'no',
                              'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                  'pre_lead_came_date'=>$current_date,
                  'pre_lead_status'=>'Pre Lead',
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
                        }else if($loan == "Yes"){
            
                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'pending',
                              'last_call_date'=>$current_date,
                              'last_call_time'=>$current_time,
                              'pre_lead_came_date'=>$current_date,
                              'pre_lead_status'=>'Pre Lead',
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
            
            
            
            
            
                        }
                      
        
        
                          if ($this->db->insert('lead_management',$data)) {
                            // $insert_id = $this->db->insert_id();
                            $insert_id = $this->db->insert_id(); 
                            
                            
                $get_end_date =$this->class_mod->get_end_date();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab;
                $end_date;


                if($get_end_date != NULL)
                {
                       $end_date=$get_end_date->to_date;
                       $datediff = strtotime($end_date)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab=$get_lead_id_code_increment->lead_id_code;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id = explode("/",$lead_id_ab);
  

                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = $explode_lead_id[2];
                       

                        $number =$number+1;
                        if($number <10){
                            $lead_id_ab = $inq.'/'.$yr.'/0'.$number;

                        }else{
                            $lead_id_ab = $inq.'/'.$yr.'/'.$number;

                        }
                       
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);




                       }else{
                         
                        $explode_lead_id = explode("/",$lead_id_ab);
                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = 01;

                        $yr=$yr+1;

                       
                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);


                        $explode_end_date = explode("-",$end_date);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];

                        $selected_end_date_update = array(
                        
                            'to_date' =>$new_end_year,
                             
                        );
                        $this->db->where('id', $get_end_date->finance_tb_id);
                        $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab = "INQ/21/01";
                    $end_date = "2022-03-31";

                    $selected = array(
                        
                        'lead_id_code' =>$lead_id_ab,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management', $selected);


                    $selected_end_date = array(
                        
                        'to_date' =>$end_date,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb', $selected_end_date);

                }         
                        
                            // foreach($marks['m_new_id'] as $key =>$value)
                            // {                   
                             
                            //      $exam_module = array(
                            //          'exam_id' =>$insert_id,
                            //          'batch_id'=>$bact_data[0],
                            //          'module_id'=>$marks['m_new_id'][$key],
                            //          'marks'=>$marks['m_marks'][$key],
                            //          'mod_grade'=>$marks['mod_grade'][$key],
                            //          // 'total'=>$marks['total'],
                            //          // 'avg'=>$marks['avg'],
                            //          // 'grade'=>$marks['grade'],
             
                            //      );
             
                            //      $this->db->insert("exam_module",$exam_module);
                                            
                             
                            //  }
                                             
                //  $current_yr = date("y");
                //  //  }
                //  if($insert_id <= 9){
                //  $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                //  }
                //  else{
                //      $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                //  }
                            // if($insert_id){
                            //     $selected = array(
                            //         'lead_management_id' =>$insert_id,
                            //         'lead_id_code' =>$new_code_id,
                                     
                            //     );
                
                            //     $this->db->insert("lead_id_table",$selected);
                              
                                
                                    
                
                
                            // }
                            
        
                            if($insert_id){
                                // $selected = array(
                                    
                                //     'lead_id_code' =>$new_code_id,
                                     
                                // );
                                // $this->db->where('id', $insert_id);
                                // $this->db->update('lead_management', $selected);
                               
                                for($j=0; $j<count($val['l_source']); $j++){
                                    $this->db->insert('lead_inserted_lead_source',
                                     array('l_source' =>$val['l_source'][$j] ,
                                           'lead_management_tb_id' =>$insert_id));
                                }
        
                                for($k=0; $k<count($val['l_interest_co']); $k++){
                                    $this->db->insert('lead_inserted_other_inter_programs',
                                     array('other_program' =>$val['l_interest_co'][$k] ,
                                           'lead_management_tb_id' =>$insert_id));
                                }
            
                                
                                    
                
                
                            }
                              // $this->db->where('id',$val['update_nw_id']);
                              // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));

                              $selected_pre = array(
                        
                                'lead_status' =>'Real Lead',
                                'pass_date_as_real_lead'=>$current_date,
                                 
                            );
                            $this->db->where('id', $bulk_tb_id);
                            $this->db->update('lead_management_pre', $selected_pre);
            
        
                              echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
                           }else{
        
                              echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                          }
                    }else{
                        echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under '.$lead_data1->l_phone,'message2'=>'Lead ID is : '.$lead_data1->lead_id_code));
                    
                    }
    
                }else{
                    // $count2=$this->class_mod->check_lead2($program,$batch,$email);
                    // $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);
                    if($count2==0){
                        // echo json_encode(array('status1'=>true));

                        
        
                        if($loan == "No"){
           

                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'no',
                              'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                  'pre_lead_came_date'=>$current_date,
                  'pre_lead_status'=>'Pre Lead',
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
                        }else if($loan == "Yes"){
            
                            $data = array(
            
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                                'User_id'=> USER_ID,
                                'lead_created_date_time'=>$currentDateTime,
                              'lead_created_date'=>$current_date,
                              'education_loan_status'=>'pending',
                              'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                  'pre_lead_came_date'=>$current_date,
                  'pre_lead_status'=>'Pre Lead',
                                'lead_owner' =>$val['l_coun']
                                
                                
                            );
            
            
            
            
            
                        }
        
                       
        
        
                          if ($this->db->insert('lead_management',$data)) {
                            // $insert_id = $this->db->insert_id();
                            $insert_id = $this->db->insert_id(); 
                            
                            
                $get_end_date =$this->class_mod->get_end_date();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab;
                $end_date;


                if($get_end_date != NULL)
                {
                       $end_date=$get_end_date->to_date;
                       $datediff = strtotime($end_date)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab=$get_lead_id_code_increment->lead_id_code;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id = explode("/",$lead_id_ab);
  

                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = $explode_lead_id[2];
                       

                        $number =$number+1;
                        if($number <10){
                            $lead_id_ab = $inq.'/'.$yr.'/0'.$number;

                        }else{
                            $lead_id_ab = $inq.'/'.$yr.'/'.$number;

                        }
                       
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);




                       }else{
                         
                        $explode_lead_id = explode("/",$lead_id_ab);
                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = 01;

                        $yr=$yr+1;

                       
                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);


                        $explode_end_date = explode("-",$end_date);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];

                        $selected_end_date_update = array(
                        
                            'to_date' =>$new_end_year,
                             
                        );
                        $this->db->where('id', $get_end_date->finance_tb_id);
                        $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab = "INQ/21/01";
                    $end_date = "2022-03-31";

                    $selected = array(
                        
                        'lead_id_code' =>$lead_id_ab,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management', $selected);


                    $selected_end_date = array(
                        
                        'to_date' =>$end_date,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb', $selected_end_date);

                }         
                        
                            // foreach($marks['m_new_id'] as $key =>$value)
                            // {                   
                             
                            //      $exam_module = array(
                            //          'exam_id' =>$insert_id,
                            //          'batch_id'=>$bact_data[0],
                            //          'module_id'=>$marks['m_new_id'][$key],
                            //          'marks'=>$marks['m_marks'][$key],
                            //          'mod_grade'=>$marks['mod_grade'][$key],
                            //          // 'total'=>$marks['total'],
                            //          // 'avg'=>$marks['avg'],
                            //          // 'grade'=>$marks['grade'],
             
                            //      );
             
                            //      $this->db->insert("exam_module",$exam_module);
                                            
                             
                            //  }
                                           
                //  $current_yr = date("y");
                //  //  }
                //  if($insert_id <= 9){
                //  $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                //  }
                //  else{
                //      $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                //  }
                            // if($insert_id){
                            //     $selected = array(
                            //         'lead_management_id' =>$insert_id,
                            //         'lead_id_code' =>$new_code_id,
                                     
                            //     );
                
                            //     $this->db->insert("lead_id_table",$selected);
                              
                                
                                    
                
                
                            // }
                            
        
                            if($insert_id){
                                // $selected = array(
                                    
                                //     'lead_id_code' =>$new_code_id,
                                     
                                // );
                                // $this->db->where('id', $insert_id);
                                // $this->db->update('lead_management', $selected);
                               
                                for($j=0; $j<count($val['l_source']); $j++){
                                    $this->db->insert('lead_inserted_lead_source',
                                     array('l_source' =>$val['l_source'][$j] ,
                                           'lead_management_tb_id' =>$insert_id));
                                }
        
                                for($k=0; $k<count($val['l_interest_co']); $k++){
                                    $this->db->insert('lead_inserted_other_inter_programs',
                                     array('other_program' =>$val['l_interest_co'][$k] ,
                                           'lead_management_tb_id' =>$insert_id));
                                }
            
                                
                                    
                
                
                            }
                              // $this->db->where('id',$val['update_nw_id']);
                              // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));
                              $selected_pre = array(
                        
                                'lead_status' =>'Real Lead',
                                'pass_date_as_real_lead'=>$current_date,
                                 
                            );
                            $this->db->where('id', $bulk_tb_id);
                            $this->db->update('lead_management_pre', $selected_pre);
            
                              echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
                           }else{
        
                              echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                          }
                        
                    }else{
                        echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under  '.$lead_data2->l_email,'message2'=>'Lead ID is : '.$lead_data2->lead_id_code));
             
                    }
    
                }
            }
          
            else if($email != "noemail@nomail.com" && $phone != "1234567890"){
                // var_dump($program,$batch,$email,$phone);
                // die();
    
                // $count1=$this->class_mod->check_lead1($program,$batch,$phone);
                // $count2=$this->class_mod->check_lead2($program,$batch,$email);
                // $lead_data1=$this->class_mod->check_lead_data1($program,$batch,$phone);
                // $lead_data2=$this->class_mod->check_lead_data2($program,$batch,$email);
                 
                if($count1==0 && $count2==0){
                    
                    if($loan == "No"){
           

                        $data = array(
        
                            'inq_by' => $val['inq_by'],
                            'parent_salutation' => $val['salutation_parent'],
                            'parent_name' => $val['parent_name'],
                          'salutation' => $val['salutation'],
                          'f_name' => $val['f_name'],
                          'mid_name' => $val['mid_name'],
                          'l_name' => $val['l_name'],
                          'l_phone' => $val['l_phone'],
                          'l_phone_2' => $val['l_phone_2'],
                          'nic_pass_info' => $val['nic_pass_info'],
                          'nic_div' => $val['nic_num'],
                          'passport_div' => $val['pass_num'],
                          'l_email' => $val['l_email'],
                          'address1' => $val['address1'],
                          'address2' => $val['address2'],
                          'city' => $val['city'],
                          'state_pro' => $val['province'],
                          'zip_pos' => $val['zip_pos'],
                          'country' => $val['country'],
                          'email_select' => $val['email_select'],
                          'phone_select' =>$val['phone_select'],
                          'reffered' => $val['reffered'],
                          'refferal_type' => $val['refferal_type'],
                          'ref_nic' => $val['ref_nic'],
                          'agent_name' => $val['det_agent'],
                          'ref_remarks' => $val['ref_remarks'],
                          'programe' => $val['select_course'],
                          'batch_id' => $val['batch_id_select'],
                          'study_method' => $val['pref_study_method'],
                          'ex_type' => $val['ex_type'],
                          'ex_years' => $val['ex_years'],
                          'ex_months' => $val['ex_months'],
                          'ol_res' => $val['ol_res'],
                          'ol_year' => $val['ol_year'],
                          'al_res' => $val['al_res'],
                          'al_year' => $val['al_year'],
                          'other_edu' => $val['other_edu'],
                          'loan_info' => $val['loan_info'],
                          'contact_method' => $val['contacted_method'],
                          'con_box'=> $val['con_box'],
                          'int_level' => $val['int_level'],
                          'dead_line_date' => $val['dead_line_date'],
                          'next_contact' => $val['next_contact'],
                          'pref_contact_method' => $val['pref_contact_method'],
                          'al_school'=>$val['al_att_skl'],
                          'al_stream'=>$val['al_stream'],
                          'day'=>$val['day'],
                          'next_contact_date'=>$val['next_date'],
                          'next_contact_time'=>$val['next_contact_time'],
                          'remarks'=>$val['next_remarks'],
                          'd_state' => 0,
                            'User_id'=> USER_ID,
                            'lead_created_date_time'=>$currentDateTime,
                          'lead_created_date'=>$current_date,
                          'education_loan_status'=>'no',
                          'last_call_date'=>$current_date,
                  'last_call_time'=>$current_time,
                  'pre_lead_came_date'=>$current_date,
                  'pre_lead_status'=>'Pre Lead',
                            'lead_owner' =>$val['l_coun']
                            
                            
                        );
                    }else if($loan == "Yes"){
        
                        $data = array(
        
                            'inq_by' => $val['inq_by'],
                            'parent_salutation' => $val['salutation_parent'],
                            'parent_name' => $val['parent_name'],
                          'salutation' => $val['salutation'],
                          'f_name' => $val['f_name'],
                          'mid_name' => $val['mid_name'],
                          'l_name' => $val['l_name'],
                          'l_phone' => $val['l_phone'],
                          'l_phone_2' => $val['l_phone_2'],
                          'nic_pass_info' => $val['nic_pass_info'],
                          'nic_div' => $val['nic_num'],
                          'passport_div' => $val['pass_num'],
                          'l_email' => $val['l_email'],
                          'address1' => $val['address1'],
                          'address2' => $val['address2'],
                          'city' => $val['city'],
                          'state_pro' => $val['province'],
                          'zip_pos' => $val['zip_pos'],
                          'country' => $val['country'],
                          'email_select' => $val['email_select'],
                          'phone_select' =>$val['phone_select'],
                          'reffered' => $val['reffered'],
                          'refferal_type' => $val['refferal_type'],
                          'ref_nic' => $val['ref_nic'],
                          'agent_name' => $val['det_agent'],
                          'ref_remarks' => $val['ref_remarks'],
                          'programe' => $val['select_course'],
                          'batch_id' => $val['batch_id_select'],
                          'study_method' => $val['pref_study_method'],
                          'ex_type' => $val['ex_type'],
                          'ex_years' => $val['ex_years'],
                          'ex_months' => $val['ex_months'],
                          'ol_res' => $val['ol_res'],
                          'ol_year' => $val['ol_year'],
                          'al_res' => $val['al_res'],
                          'al_year' => $val['al_year'],
                          'other_edu' => $val['other_edu'],
                          'loan_info' => $val['loan_info'],
                          'contact_method' => $val['contacted_method'],
                          'con_box'=> $val['con_box'],
                          'int_level' => $val['int_level'],
                          'dead_line_date' => $val['dead_line_date'],
                          'next_contact' => $val['next_contact'],
                          'pref_contact_method' => $val['pref_contact_method'],
                          'al_school'=>$val['al_att_skl'],
                          'al_stream'=>$val['al_stream'],
                          'day'=>$val['day'],
                          'next_contact_date'=>$val['next_date'],
                          'next_contact_time'=>$val['next_contact_time'],
                          'remarks'=>$val['next_remarks'],
                          'd_state' => 0,
                            'User_id'=> USER_ID,
                            'lead_created_date_time'=>$currentDateTime,
                          'lead_created_date'=>$current_date,
                          'education_loan_status'=>'pending',
                          'last_call_date'=>$current_date,
                          'last_call_time'=>$current_time,
                          'pre_lead_came_date'=>$current_date,
                          'pre_lead_status'=>'Pre Lead',
                            'lead_owner' =>$val['l_coun']
                            
                            
                        );
        
        
        
        
        
                    }
    
                    
    
    
                      if ($this->db->insert('lead_management',$data)) {
                        // $insert_id = $this->db->insert_id();
                        $insert_id = $this->db->insert_id(); 
                        
                        
                $get_end_date =$this->class_mod->get_end_date();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab;
                $end_date;


                if($get_end_date != NULL)
                {
                       $end_date=$get_end_date->to_date;
                       $datediff = strtotime($end_date)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab=$get_lead_id_code_increment->lead_id_code;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id = explode("/",$lead_id_ab);
  

                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = $explode_lead_id[2];
                       

                        $number =$number+1;
                        if($number <10){
                            $lead_id_ab = $inq.'/'.$yr.'/0'.$number;

                        }else{
                            $lead_id_ab = $inq.'/'.$yr.'/'.$number;

                        }
                       
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);




                       }else{
                         
                        $explode_lead_id = explode("/",$lead_id_ab);
                        $inq= $explode_lead_id[0];
                        $yr=$explode_lead_id[1];
                        $number = 01;

                        $yr=$yr+1;

                       
                        $lead_id_ab = $inq.'/'.$yr.'/0'.$number;
                        
                        $selected = array(
                        
                            'lead_id_code' =>$lead_id_ab,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management', $selected);


                        $explode_end_date = explode("-",$end_date);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year = $explode_end_date[0]+1 .'-'.$explode_end_date[1].'-'.$explode_end_date[2];

                        $selected_end_date_update = array(
                        
                            'to_date' =>$new_end_year,
                             
                        );
                        $this->db->where('id', $get_end_date->finance_tb_id);
                        $this->db->update('finance_inq_num_code_tb', $selected_end_date_update);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab = "INQ/21/01";
                    $end_date = "2022-03-31";

                    $selected = array(
                        
                        'lead_id_code' =>$lead_id_ab,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management', $selected);


                    $selected_end_date = array(
                        
                        'to_date' =>$end_date,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb', $selected_end_date);

                }         
                    
                        // foreach($marks['m_new_id'] as $key =>$value)
                        // {                   
                         
                        //      $exam_module = array(
                        //          'exam_id' =>$insert_id,
                        //          'batch_id'=>$bact_data[0],
                        //          'module_id'=>$marks['m_new_id'][$key],
                        //          'marks'=>$marks['m_marks'][$key],
                        //          'mod_grade'=>$marks['mod_grade'][$key],
                        //          // 'total'=>$marks['total'],
                        //          // 'avg'=>$marks['avg'],
                        //          // 'grade'=>$marks['grade'],
         
                        //      );
         
                        //      $this->db->insert("exam_module",$exam_module);
                                        
                         
                        //  }
                                        
                //  $current_yr = date("y");
                //  //  }
                //  if($insert_id <= 9){
                //  $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                //  }
                //  else{
                //      $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                //  }
                        // if($insert_id){
                        //     $selected = array(
                        //         'lead_management_id' =>$insert_id,
                        //         'lead_id_code' =>$new_code_id,
                                 
                        //     );
            
                        //     $this->db->insert("lead_id_table",$selected);
                          
                            
                                
            
            
                        // }
                        
    
                        if($insert_id){
                            // $selected = array(
                                
                            //     'lead_id_code' =>$new_code_id,
                                 
                            // );
                            // $this->db->where('id', $insert_id);
                            // $this->db->update('lead_management', $selected);
                           
                            for($j=0; $j<count($val['l_source']); $j++){
                                $this->db->insert('lead_inserted_lead_source',
                                 array('l_source' =>$val['l_source'][$j] ,
                                       'lead_management_tb_id' =>$insert_id));
                            }
    
                            for($k=0; $k<count($val['l_interest_co']); $k++){
                                $this->db->insert('lead_inserted_other_inter_programs',
                                 array('other_program' =>$val['l_interest_co'][$k] ,
                                       'lead_management_tb_id' =>$insert_id));
                            }
        
                            
                                
            
            
                        }
                          // $this->db->where('id',$val['update_nw_id']);
                          // $this->db->update('lead_management',array('lead_owner' =>$val['l_name']));

                          $selected_pre = array(
                        
                            'lead_status' =>'Real Lead',
                            'pass_date_as_real_lead'=>$current_date,
                             
                        );
                        $this->db->where('id', $bulk_tb_id);
                        $this->db->update('lead_management_pre', $selected_pre);
        
    
                          echo json_encode(array('status' => TRUE, 'message' => 'Inserted Successfully [ Your ID is => '.$lead_id_ab.' ]'));
                       }else{
    
                          echo json_encode(array('status' => FALSE, 'message' => 'Sorry, lead Insert Was Not Successfully !'));
                      }
    
                    
                    // echo json_encode(array('status'=>true,'message'=>'already there is a Lead under'));
                    
                }else if($count1!=0 && $count2!=0){
                    if($lead_data1->lead_id_code == $lead_data2->lead_id_code)
                    {
                              echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under  '.$lead_data1->l_phone.' & '.$lead_data2->l_email,'message2'=>'Lead ID is : '.$lead_data2->lead_id_code));
                    }
                    else{
                        echo json_encode(array('status1'=>false,'message1'=>'already there are Leads under  '.$lead_data1->l_phone.' & '.$lead_data2->l_email,'message2'=>'Lead IDs are : '.$lead_data1->lead_id_code.' , '.$lead_data2->lead_id_code));
    
                    }
    
                    
                        
                        
                    
                }else if($count1==0 && $count2!=0)
                {
                    echo json_encode(array('status1'=>false,'message1'=>'already there is a Leads under  '.$lead_data2->l_email,'message2'=>'Lead IDs are : '.$lead_data2->lead_id_code));
    
                }else if($count1!=0 && $count2==0)
                {
                    echo json_encode(array('status1'=>false,'message1'=>'already there is a Leads under  '.$lead_data1->l_phone,'message2'=>'Lead IDs are : '.$lead_data1->lead_id_code));
    
                }
    
            }









//////////////////////////////////////////////////end bulk add//////////////////////////////////////////////////////////////            
              }else {

                $tb_id=$val['update_nw_id'];
                $program=$val['select_course'];
                $batch=$val['batch_id_select'];
                $current_date = date('Y-m-d');
                $email=$val['l_email'];
                $phone=$val['l_phone'];
        
                // $count_edit1=$this->class_mod->check_lead_edit1($program,$batch,$phone,$tb_id);
                // $lead_edit_data1=$this->class_mod->check_lead_edit_data1($program,$batch,$phone,$tb_id);
                // $count_edit2=$this->class_mod->check_lead_edit2($program,$batch,$email,$tb_id);
                // $lead_edit_data2=$this->class_mod->check_lead_edit_data2($program,$batch,$email,$tb_id);


                $count_edit1=$this->class_mod->check_lead_edit1($program,$current_date,$phone,$tb_id);
                $lead_edit_data1=$this->class_mod->check_lead_edit_data1($program,$current_date,$phone,$tb_id);
                $count_edit2=$this->class_mod->check_lead_edit2($program,$current_date,$email,$tb_id);
                $lead_edit_data2=$this->class_mod->check_lead_edit_data2($program,$current_date,$email,$tb_id);

            //    var_dump($loan);
            //    die();
                if($email == "noemail@nomail.com" && $phone == "1234567890")
                {
                    if($loan == "No"){
            
                    $data_up = array(

                        'inq_by' => $val['inq_by'],
                        'parent_salutation' => $val['salutation_parent'],
                        'parent_name' => $val['parent_name'],
                      'salutation' => $val['salutation'],
                      'f_name' => $val['f_name'],
                      'mid_name' => $val['mid_name'],
                      'l_name' => $val['l_name'],
                      'l_phone' => $val['l_phone'],
                      'l_phone_2' => $val['l_phone_2'],
                      'nic_pass_info' => $val['nic_pass_info'],
                      'nic_div' => $val['nic_num'],
                      'passport_div' => $val['pass_num'],
                      'l_email' => $val['l_email'],
                      'address1' => $val['address1'],
                      'address2' => $val['address2'],
                      'city' => $val['city'],
                      'state_pro' => $val['province'],
                      'zip_pos' => $val['zip_pos'],
                      'country' => $val['country'],
                      'email_select' => $val['email_select'],
                      'phone_select' =>$val['phone_select'],
                      'reffered' => $val['reffered'],
                      'refferal_type' => $val['refferal_type'],
                      'ref_nic' => $val['ref_nic'],
                      'agent_name' => $val['det_agent'],
                      'ref_remarks' => $val['ref_remarks'],
                      'programe' => $val['select_course'],
                      'batch_id' => $val['batch_id_select'],
                      'study_method' => $val['pref_study_method'],
                      'ex_type' => $val['ex_type'],
                      'ex_years' => $val['ex_years'],
                      'ex_months' => $val['ex_months'],
                      'ol_res' => $val['ol_res'],
                      'ol_year' => $val['ol_year'],
                      'al_res' => $val['al_res'],
                      'al_year' => $val['al_year'],
                      'other_edu' => $val['other_edu'],
                      'loan_info' => $val['loan_info'],
                      'contact_method' => $val['contacted_method'],
                      'con_box'=> $val['con_box'],
                      'int_level' => $val['int_level'],
                      'dead_line_date' => $val['dead_line_date'],
                      'next_contact' => $val['next_contact'],
                      'pref_contact_method' => $val['pref_contact_method'],
                      'al_school'=>$val['al_att_skl'],
                      'al_stream'=>$val['al_stream'],
                      'day'=>$val['day'],
                      'next_contact_date'=>$val['next_date'],
                      'next_contact_time'=>$val['next_contact_time'],
                      'remarks'=>$val['next_remarks'],
                      'd_state' => 0,
                      'education_loan_status'=>'no',
                      'updated_User_id'=> USER_ID,
                      'lead_updated_date_time'=>$currentDateTime,
                    'lead_updated_date'=>$current_date,
                        'lead_owner' =>$val['l_coun']
                    );
                }else if($loan == "Yes"){

                    

                    $data_up = array(

                        'inq_by' => $val['inq_by'],
                        'parent_salutation' => $val['salutation_parent'],
                        'parent_name' => $val['parent_name'],
                      'salutation' => $val['salutation'],
                      'f_name' => $val['f_name'],
                      'mid_name' => $val['mid_name'],
                      'l_name' => $val['l_name'],
                      'l_phone' => $val['l_phone'],
                      'l_phone_2' => $val['l_phone_2'],
                      'nic_pass_info' => $val['nic_pass_info'],
                      'nic_div' => $val['nic_num'],
                      'passport_div' => $val['pass_num'],
                      'l_email' => $val['l_email'],
                      'address1' => $val['address1'],
                      'address2' => $val['address2'],
                      'city' => $val['city'],
                      'state_pro' => $val['province'],
                      'zip_pos' => $val['zip_pos'],
                      'country' => $val['country'],
                      'email_select' => $val['email_select'],
                      'phone_select' =>$val['phone_select'],
                      'reffered' => $val['reffered'],
                      'refferal_type' => $val['refferal_type'],
                      'ref_nic' => $val['ref_nic'],
                      'agent_name' => $val['det_agent'],
                      'ref_remarks' => $val['ref_remarks'],
                      'programe' => $val['select_course'],
                      'batch_id' => $val['batch_id_select'],
                      'study_method' => $val['pref_study_method'],
                      'ex_type' => $val['ex_type'],
                      'ex_years' => $val['ex_years'],
                      'ex_months' => $val['ex_months'],
                      'ol_res' => $val['ol_res'],
                      'ol_year' => $val['ol_year'],
                      'al_res' => $val['al_res'],
                      'al_year' => $val['al_year'],
                      'other_edu' => $val['other_edu'],
                      'loan_info' => $val['loan_info'],
                      'contact_method' => $val['contacted_method'],
                      'con_box'=> $val['con_box'],
                      'int_level' => $val['int_level'],
                      'dead_line_date' => $val['dead_line_date'],
                      'next_contact' => $val['next_contact'],
                      'pref_contact_method' => $val['pref_contact_method'],
                      'al_school'=>$val['al_att_skl'],
                      'al_stream'=>$val['al_stream'],
                      'day'=>$val['day'],
                      'next_contact_date'=>$val['next_date'],
                      'next_contact_time'=>$val['next_contact_time'],
                      'remarks'=>$val['next_remarks'],
                      'd_state' => 0,
                      'education_loan_status'=>'pending',
                      'updated_User_id'=> USER_ID,
                      'lead_updated_date_time'=>$currentDateTime,
                    'lead_updated_date'=>$current_date,
                        'lead_owner' =>$val['l_coun']
                    );

                }

                    $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                              $this->db->delete('lead_inserted_lead_source');

                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }

                    $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                    $this->db->delete('lead_inserted_other_inter_programs');

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }


                
                  $this->db->where('id', $val['update_nw_id']);
                  $this->db->update('lead_management', $data_up);
                  echo json_encode(array('status' => TRUE, 'message' => 'lead Updated Successfully !'));
                }
                else if(($email != "noemail@nomail.com" && $phone == "1234567890") ||  ($email == "noemail@nomail.com" && $phone != "1234567890") )
                {
                    if($email == "noemail@nomail.com"){
                       
        
        
                        if($count_edit1==0){
                            if($loan == "No")
                            {
                                $data_up = array(
              
                                    'inq_by' => $val['inq_by'],
                                    'parent_salutation' => $val['salutation_parent'],
                                    'parent_name' => $val['parent_name'],
                                  'salutation' => $val['salutation'],
                                  'f_name' => $val['f_name'],
                                  'mid_name' => $val['mid_name'],
                                  'l_name' => $val['l_name'],
                                  'l_phone' => $val['l_phone'],
                                  'l_phone_2' => $val['l_phone_2'],
                                  'nic_pass_info' => $val['nic_pass_info'],
                                  'nic_div' => $val['nic_num'],
                                  'passport_div' => $val['pass_num'],
                                  'l_email' => $val['l_email'],
                                  'address1' => $val['address1'],
                                  'address2' => $val['address2'],
                                  'city' => $val['city'],
                                  'state_pro' => $val['province'],
                                  'zip_pos' => $val['zip_pos'],
                                  'country' => $val['country'],
                                  'email_select' => $val['email_select'],
                                  'phone_select' =>$val['phone_select'],
                                  'reffered' => $val['reffered'],
                                  'refferal_type' => $val['refferal_type'],
                                  'ref_nic' => $val['ref_nic'],
                                  'agent_name' => $val['det_agent'],
                                  'ref_remarks' => $val['ref_remarks'],
                                  'programe' => $val['select_course'],
                                  'batch_id' => $val['batch_id_select'],
                                  'study_method' => $val['pref_study_method'],
                                  'ex_type' => $val['ex_type'],
                                  'ex_years' => $val['ex_years'],
                                  'ex_months' => $val['ex_months'],
                                  'ol_res' => $val['ol_res'],
                                  'ol_year' => $val['ol_year'],
                                  'al_res' => $val['al_res'],
                                  'al_year' => $val['al_year'],
                                  'other_edu' => $val['other_edu'],
                                  'loan_info' => $val['loan_info'],
                                  'contact_method' => $val['contacted_method'],
                                  'con_box'=> $val['con_box'],
                                  'int_level' => $val['int_level'],
                                  'dead_line_date' => $val['dead_line_date'],
                                  'next_contact' => $val['next_contact'],
                                  'pref_contact_method' => $val['pref_contact_method'],
                                  'al_school'=>$val['al_att_skl'],
                                  'al_stream'=>$val['al_stream'],
                                  'day'=>$val['day'],
                                  'next_contact_date'=>$val['next_date'],
                                  'next_contact_time'=>$val['next_contact_time'],
                                  'remarks'=>$val['next_remarks'],
                                  'd_state' => 0,
                                  'education_loan_status'=>'no',
                                  'updated_User_id'=> USER_ID,
                                'lead_updated_date_time'=>$currentDateTime,
                              'lead_updated_date'=>$current_date,
                                    'lead_owner' =>$val['l_coun']
                                );
                            }else if($loan == "Yes")
                            {
                                $data_up = array(
              
                                    'inq_by' => $val['inq_by'],
                                    'parent_salutation' => $val['salutation_parent'],
                                    'parent_name' => $val['parent_name'],
                                  'salutation' => $val['salutation'],
                                  'f_name' => $val['f_name'],
                                  'mid_name' => $val['mid_name'],
                                  'l_name' => $val['l_name'],
                                  'l_phone' => $val['l_phone'],
                                  'l_phone_2' => $val['l_phone_2'],
                                  'nic_pass_info' => $val['nic_pass_info'],
                                  'nic_div' => $val['nic_num'],
                                  'passport_div' => $val['pass_num'],
                                  'l_email' => $val['l_email'],
                                  'address1' => $val['address1'],
                                  'address2' => $val['address2'],
                                  'city' => $val['city'],
                                  'state_pro' => $val['province'],
                                  'zip_pos' => $val['zip_pos'],
                                  'country' => $val['country'],
                                  'email_select' => $val['email_select'],
                                  'phone_select' =>$val['phone_select'],
                                  'reffered' => $val['reffered'],
                                  'refferal_type' => $val['refferal_type'],
                                  'ref_nic' => $val['ref_nic'],
                                  'agent_name' => $val['det_agent'],
                                  'ref_remarks' => $val['ref_remarks'],
                                  'programe' => $val['select_course'],
                                  'batch_id' => $val['batch_id_select'],
                                  'study_method' => $val['pref_study_method'],
                                  'ex_type' => $val['ex_type'],
                                  'ex_years' => $val['ex_years'],
                                  'ex_months' => $val['ex_months'],
                                  'ol_res' => $val['ol_res'],
                                  'ol_year' => $val['ol_year'],
                                  'al_res' => $val['al_res'],
                                  'al_year' => $val['al_year'],
                                  'other_edu' => $val['other_edu'],
                                  'loan_info' => $val['loan_info'],
                                  'contact_method' => $val['contacted_method'],
                                  'con_box'=> $val['con_box'],
                                  'int_level' => $val['int_level'],
                                  'dead_line_date' => $val['dead_line_date'],
                                  'next_contact' => $val['next_contact'],
                                  'pref_contact_method' => $val['pref_contact_method'],
                                  'al_school'=>$val['al_att_skl'],
                                  'al_stream'=>$val['al_stream'],
                                  'day'=>$val['day'],
                                  'next_contact_date'=>$val['next_date'],
                                  'next_contact_time'=>$val['next_contact_time'],
                                  'remarks'=>$val['next_remarks'],
                                  'd_state' => 0,
                                  'education_loan_status'=>'pending',
                                  'updated_User_id'=> USER_ID,
                                'lead_updated_date_time'=>$currentDateTime,
                              'lead_updated_date'=>$current_date,
                                    'lead_owner' =>$val['l_coun']
                                );

                            }
                             
                                 

                                  $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                              $this->db->delete('lead_inserted_lead_source');

                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }

                    $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                    $this->db->delete('lead_inserted_other_inter_programs');

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }
                              
                                $this->db->where('id', $val['update_nw_id']);
                                $this->db->update('lead_management', $data_up);
                                echo json_encode(array('status' => TRUE, 'message' => 'lead Updated Successfully !'));
                            
                        }else{
                            echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under '.$lead_edit_data1->l_phone,'message2'=>'Lead ID is : '.$lead_edit_data1->lead_id_code));
                        
                        }
        
                    }else{
                         
                        if($count_edit2==0){

                            if($loan == "No")
                            {
                                $data_up = array(
              
                                    'inq_by' => $val['inq_by'],
                                    'parent_salutation' => $val['salutation_parent'],
                                    'parent_name' => $val['parent_name'],
                                  'salutation' => $val['salutation'],
                                  'f_name' => $val['f_name'],
                                  'mid_name' => $val['mid_name'],
                                  'l_name' => $val['l_name'],
                                  'l_phone' => $val['l_phone'],
                                  'l_phone_2' => $val['l_phone_2'],
                                  'nic_pass_info' => $val['nic_pass_info'],
                                  'nic_div' => $val['nic_num'],
                                  'passport_div' => $val['pass_num'],
                                  'l_email' => $val['l_email'],
                                  'address1' => $val['address1'],
                                  'address2' => $val['address2'],
                                  'city' => $val['city'],
                                  'state_pro' => $val['province'],
                                  'zip_pos' => $val['zip_pos'],
                                  'country' => $val['country'],
                                  'email_select' => $val['email_select'],
                                  'phone_select' =>$val['phone_select'],
                                  'reffered' => $val['reffered'],
                                  'refferal_type' => $val['refferal_type'],
                                  'ref_nic' => $val['ref_nic'],
                                  'agent_name' => $val['det_agent'],
                                  'ref_remarks' => $val['ref_remarks'],
                                  'programe' => $val['select_course'],
                                  'batch_id' => $val['batch_id_select'],
                                  'study_method' => $val['pref_study_method'],
                                  'ex_type' => $val['ex_type'],
                                  'ex_years' => $val['ex_years'],
                                  'ex_months' => $val['ex_months'],
                                  'ol_res' => $val['ol_res'],
                                  'ol_year' => $val['ol_year'],
                                  'al_res' => $val['al_res'],
                                  'al_year' => $val['al_year'],
                                  'other_edu' => $val['other_edu'],
                                  'loan_info' => $val['loan_info'],
                                  'contact_method' => $val['contacted_method'],
                                  'con_box'=> $val['con_box'],
                                  'int_level' => $val['int_level'],
                                  'dead_line_date' => $val['dead_line_date'],
                                  'next_contact' => $val['next_contact'],
                                  'pref_contact_method' => $val['pref_contact_method'],
                                  'al_school'=>$val['al_att_skl'],
                                  'al_stream'=>$val['al_stream'],
                                  'day'=>$val['day'],
                                  'next_contact_date'=>$val['next_date'],
                                  'next_contact_time'=>$val['next_contact_time'],
                                  'remarks'=>$val['next_remarks'],
                                  'd_state' => 0,
                                  'education_loan_status'=>'no',
                                  'updated_User_id'=> USER_ID,
                                  'lead_updated_date_time'=>$currentDateTime,
                                'lead_updated_date'=>$current_date,
                                    'lead_owner' =>$val['l_coun']
                                );
                            }else if($loan == "Yes")
                            {
                                $data_up = array(
              
                                    'inq_by' => $val['inq_by'],
                                    'parent_salutation' => $val['salutation_parent'],
                                    'parent_name' => $val['parent_name'],
                                  'salutation' => $val['salutation'],
                                  'f_name' => $val['f_name'],
                                  'mid_name' => $val['mid_name'],
                                  'l_name' => $val['l_name'],
                                  'l_phone' => $val['l_phone'],
                                  'l_phone_2' => $val['l_phone_2'],
                                  'nic_pass_info' => $val['nic_pass_info'],
                                  'nic_div' => $val['nic_num'],
                                  'passport_div' => $val['pass_num'],
                                  'l_email' => $val['l_email'],
                                  'address1' => $val['address1'],
                                  'address2' => $val['address2'],
                                  'city' => $val['city'],
                                  'state_pro' => $val['province'],
                                  'zip_pos' => $val['zip_pos'],
                                  'country' => $val['country'],
                                  'email_select' => $val['email_select'],
                                  'phone_select' =>$val['phone_select'],
                                  'reffered' => $val['reffered'],
                                  'refferal_type' => $val['refferal_type'],
                                  'ref_nic' => $val['ref_nic'],
                                  'agent_name' => $val['det_agent'],
                                  'ref_remarks' => $val['ref_remarks'],
                                  'programe' => $val['select_course'],
                                  'batch_id' => $val['batch_id_select'],
                                  'study_method' => $val['pref_study_method'],
                                  'ex_type' => $val['ex_type'],
                                  'ex_years' => $val['ex_years'],
                                  'ex_months' => $val['ex_months'],
                                  'ol_res' => $val['ol_res'],
                                  'ol_year' => $val['ol_year'],
                                  'al_res' => $val['al_res'],
                                  'al_year' => $val['al_year'],
                                  'other_edu' => $val['other_edu'],
                                  'loan_info' => $val['loan_info'],
                                  'contact_method' => $val['contacted_method'],
                                  'con_box'=> $val['con_box'],
                                  'int_level' => $val['int_level'],
                                  'dead_line_date' => $val['dead_line_date'],
                                  'next_contact' => $val['next_contact'],
                                  'pref_contact_method' => $val['pref_contact_method'],
                                  'al_school'=>$val['al_att_skl'],
                                  'al_stream'=>$val['al_stream'],
                                  'day'=>$val['day'],
                                  'next_contact_date'=>$val['next_date'],
                                  'next_contact_time'=>$val['next_contact_time'],
                                  'remarks'=>$val['next_remarks'],
                                  'd_state' => 0,
                                  'education_loan_status'=>'pending',
                                  'updated_User_id'=> USER_ID,
                                  'lead_updated_date_time'=>$currentDateTime,
                                'lead_updated_date'=>$current_date,
                                    'lead_owner' =>$val['l_coun']
                                );
                            }
                             
                                  
                                  $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                              $this->db->delete('lead_inserted_lead_source');

                    for($j=0; $j<count($val['l_source']); $j++){
                        $this->db->insert('lead_inserted_lead_source',
                         array('l_source' =>$val['l_source'][$j] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }

                    $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                    $this->db->delete('lead_inserted_other_inter_programs');

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }
                                $this->db->where('id', $val['update_nw_id']);
                                $this->db->update('lead_management', $data_up);
                                echo json_encode(array('status' => TRUE, 'message' => 'lead Updated Successfully !'));
                            
                        }else{
                            echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under  '.$lead_edit_data2->l_email,'message2'=>'Lead ID is : '.$lead_edit_data2->lead_id_code));
                 
                        }
        
                    }
                }
              
                else{
                    // var_dump($program,$batch,$email,$phone);
                    // die();
        
     
                     
                    if($count_edit1==0 && $count_edit2==0){
                       
                        if($loan == "No")
                        {
                            $data_up = array(
          
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                              'education_loan_status'=>'no',
                                'updated_User_id'=> USER_ID,
                                'lead_updated_date_time'=>$currentDateTime,
                              'lead_updated_date'=>$current_date,
                                'lead_owner' =>$val['l_coun']
                            );
                           
                        }else if($loan == "Yes")
                        {
                            $data_up = array(
          
                                'inq_by' => $val['inq_by'],
                                'parent_salutation' => $val['salutation_parent'],
                                'parent_name' => $val['parent_name'],
                              'salutation' => $val['salutation'],
                              'f_name' => $val['f_name'],
                              'mid_name' => $val['mid_name'],
                              'l_name' => $val['l_name'],
                              'l_phone' => $val['l_phone'],
                              'l_phone_2' => $val['l_phone_2'],
                              'nic_pass_info' => $val['nic_pass_info'],
                              'nic_div' => $val['nic_num'],
                              'passport_div' => $val['pass_num'],
                              'l_email' => $val['l_email'],
                              'address1' => $val['address1'],
                              'address2' => $val['address2'],
                              'city' => $val['city'],
                              'state_pro' => $val['province'],
                              'zip_pos' => $val['zip_pos'],
                              'country' => $val['country'],
                              'email_select' => $val['email_select'],
                              'phone_select' =>$val['phone_select'],
                              'reffered' => $val['reffered'],
                              'refferal_type' => $val['refferal_type'],
                              'ref_nic' => $val['ref_nic'],
                              'agent_name' => $val['det_agent'],
                              'ref_remarks' => $val['ref_remarks'],
                              'programe' => $val['select_course'],
                              'batch_id' => $val['batch_id_select'],
                              'study_method' => $val['pref_study_method'],
                              'ex_type' => $val['ex_type'],
                              'ex_years' => $val['ex_years'],
                              'ex_months' => $val['ex_months'],
                              'ol_res' => $val['ol_res'],
                              'ol_year' => $val['ol_year'],
                              'al_res' => $val['al_res'],
                              'al_year' => $val['al_year'],
                              'other_edu' => $val['other_edu'],
                              'loan_info' => $val['loan_info'],
                              'contact_method' => $val['contacted_method'],
                              'con_box'=> $val['con_box'],
                              'int_level' => $val['int_level'],
                              'dead_line_date' => $val['dead_line_date'],
                              'next_contact' => $val['next_contact'],
                              'pref_contact_method' => $val['pref_contact_method'],
                              'al_school'=>$val['al_att_skl'],
                              'al_stream'=>$val['al_stream'],
                              'day'=>$val['day'],
                              'next_contact_date'=>$val['next_date'],
                              'next_contact_time'=>$val['next_contact_time'],
                              'remarks'=>$val['next_remarks'],
                              'd_state' => 0,
                              'education_loan_status'=>'pending',
                                'updated_User_id'=> USER_ID,
                                'lead_updated_date_time'=>$currentDateTime,
                              'lead_updated_date'=>$current_date,
                                'lead_owner' =>$val['l_coun']
                            );
                           
                        }
                         
                              
                              
   
                              $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                              $this->db->delete('lead_inserted_lead_source');

                              for($j=0; $j<count($val['l_source']); $j++){
                                  $this->db->insert('lead_inserted_lead_source',
                                   array('l_source' =>$val['l_source'][$j] ,
                                         'lead_management_tb_id' =>$val['update_nw_id']));
                              }

                              $this->db->where('lead_management_tb_id', $val['update_nw_id']);
                    $this->db->delete('lead_inserted_other_inter_programs');

                    for($k=0; $k<count($val['l_interest_co']); $k++){
                        $this->db->insert('lead_inserted_other_inter_programs',
                         array('other_program' =>$val['l_interest_co'][$k] ,
                               'lead_management_tb_id' =>$val['update_nw_id']));
                    }
                    
                            $this->db->where('id', $val['update_nw_id']);
                            $this->db->update('lead_management', $data_up);
                            echo json_encode(array('status' => TRUE, 'message' => 'lead Updated Successfully !'));
                        
                    }else if($count_edit1!=0 && $count_edit2!=0){
                        if($lead_edit_data1->lead_id_code == $lead_edit_data2->lead_id_code)
                        {
                                  echo json_encode(array('status1'=>false,'message1'=>'already there is a Lead under  '.$lead_edit_data1->l_phone.' & '.$lead_edit_data2->l_email,'message2'=>'Lead ID is : '.$lead_edit_data2->lead_id_code));
                        }
                        else{
                            echo json_encode(array('status1'=>false,'message1'=>'already there are Leads under  '.$lead_edit_data1->l_phone.' & '.$lead_edit_data2->l_email,'message2'=>'Lead IDs are : '.$lead_edit_data1->lead_id_code.' , '.$lead_edit_data2->lead_id_code));
        
                        }
        
                        
                            
                            
                        
                    }else if($count_edit1==0 && $count_edit2!=0)
                    {
                        echo json_encode(array('status1'=>false,'message1'=>'already there is a Leads under  '.$lead_edit_data2->l_email,'message2'=>'Lead IDs are : '.$lead_edit_data2->lead_id_code));
        
                    }else if($count_edit1!=0 && $count_edit2==0)
                    {
                        echo json_encode(array('status1'=>false,'message1'=>'already there is a Leads under  '.$lead_edit_data1->l_phone,'message2'=>'Lead IDs are : '.$lead_edit_data1->lead_id_code));
        
                    }
        
                }

                
              
///////////////////////////////////////////




 
                
                //   if($l_owner == NULL){

                //   $data_up = array(

                //     'inq_by' => $val['inq_by'],
                //     'parent_salutation' => $val['salutation_parent'],
                //     'parent_name' => $val['parent_name'],
                //     'salutation' => $val['salutation'],
                //     'f_name' => $val['f_name'],
                //     'mid_name' => $val['mid_name'],
                //     'l_name' => $val['l_name'],
                //     'l_phone' => $val['l_phone'],
                //     'l_phone_2' => $val['l_phone_2'],
                //     'nic_pass_info' => $val['nic_pass_info'],
                //     'nic_div' => $val['nic_num'],
                //     'passport_div' => $val['pass_num'],
                //     'l_email' => $val['l_email'],
                //     'address1' => $val['address1'],
                //     'address2' => $val['address2'],
                //     'city' => $val['city'],
                //     'state_pro' => $val['province'],
                //     'zip_pos' => $val['zip_pos'],
                //     'country' => $val['country'],
                //   //   'l_coun' => $val['l_coun'],
                //     'reffered' => $val['reffered'],
                //     'refferal_type' => $val['refferal_type'],
                //     'ref_nic' => $val['ref_nic'],
                //     'agent_name' => $val['det_agent'],
                //     'ref_remarks' => $val['ref_remarks'],
                //     'programe' => $val['select_course'],
                //     'batch_id' => $val['sel_batch_id'],
                //     'study_method' => $val['pref_study_method'],
                //     'ex_type' => $val['ex_type'],
                //     'ex_years' => $val['ex_years'],
                //     'ex_months' => $val['ex_months'],
                //     'ol_res' => $val['ol_res'],
                //     'ol_year' => $val['ol_year'],
                //     'al_res' => $val['al_res'],
                //     'al_year' => $val['al_year'],
                //     'other_edu' => $val['other_edu'],
                //     'loan_info' => $val['loan_info'],
                //     'contact_method' => $val['contacted_method'],
                //     'con_box'=> $val['con_box'],
                //     'int_level' => $val['int_level'],
                //     'dead_line_date' => $val['dead_line_date'],
                //     'next_contact' => $val['next_contact'],
                //     'pref_contact_method' => $val['pref_contact_method'],
                //     'al_school'=>$val['al_att_skl'],
                //     'al_stream'=>$val['al_stream'],
                //     'day'=>$val['day'],
                //     'next_contact_date'=>$val['next_date'],
                //     'next_contact_time'=>$val['next_contact_time'],
                //     'remarks'=>$val['next_remarks'],
                //     'd_state' => 0,
                //     'User_id'=> USER_ID,
                //     'lead_created_date_time'=>$currentDateTime,
                //     'lead_created_date'=>$current_date,
                //       'lead_owner' => USER_ID
                //   );
                // }
                // else{
                //     $data_up = array(

                //         'inq_by' => $val['inq_by'],
                //         'parent_salutation' => $val['salutation_parent'],
                //         'parent_name' => $val['parent_name'],
                //       'salutation' => $val['salutation'],
                //       'f_name' => $val['f_name'],
                //       'mid_name' => $val['mid_name'],
                //       'l_name' => $val['l_name'],
                //       'l_phone' => $val['l_phone'],
                //       'l_phone_2' => $val['l_phone_2'],
                //       'nic_pass_info' => $val['nic_pass_info'],
                //       'nic_div' => $val['nic_num'],
                //       'passport_div' => $val['pass_num'],
                //       'l_email' => $val['l_email'],
                //       'address1' => $val['address1'],
                //       'address2' => $val['address2'],
                //       'city' => $val['city'],
                //       'state_pro' => $val['province'],
                //       'zip_pos' => $val['zip_pos'],
                //       'country' => $val['country'],
                //     //   'l_coun' => $val['l_coun'],
                //       'reffered' => $val['reffered'],
                //       'refferal_type' => $val['refferal_type'],
                //       'ref_nic' => $val['ref_nic'],
                //       'agent_name' => $val['det_agent'],
                //       'ref_remarks' => $val['ref_remarks'],
                //       'programe' => $val['select_course'],
                //       'batch_id' => $val['sel_batch_id'],
                //       'study_method' => $val['pref_study_method'],
                //       'ex_type' => $val['ex_type'],
                //       'ex_years' => $val['ex_years'],
                //       'ex_months' => $val['ex_months'],
                //       'ol_res' => $val['ol_res'],
                //       'ol_year' => $val['ol_year'],
                //       'al_res' => $val['al_res'],
                //       'al_year' => $val['al_year'],
                //       'other_edu' => $val['other_edu'],
                //       'loan_info' => $val['loan_info'],
                //       'contact_method' => $val['contacted_method'],
                //       'con_box'=> $val['con_box'],
                //       'int_level' => $val['int_level'],
                //       'dead_line_date' => $val['dead_line_date'],
                //       'next_contact' => $val['next_contact'],
                //       'pref_contact_method' => $val['pref_contact_method'],
                //       'al_school'=>$val['al_att_skl'],
                //       'al_stream'=>$val['al_stream'],
                //       'day'=>$val['day'],
                //       'next_contact_date'=>$val['next_date'],
                //       'next_contact_time'=>$val['next_contact_time'],
                //       'remarks'=>$val['next_remarks'],
                //       'd_state' => 0,
                //         'User_id'=> USER_ID,
                //         'lead_created_date_time'=>$currentDateTime,
                //       'lead_created_date'=>$current_date,
                //         'lead_owner' =>$val['l_coun']
                //     );
                // }
                //   $this->db->where('id', $val['update_nw_id']);
                //   $this->db->update('lead_management', $data_up);
                //   echo json_encode(array('status' => TRUE, 'message' => 'lead Updated Successfully !'));
              }
            
            
            
           }
    }

    public function save_student(){

        $this->form_validation->set_rules("std_batch","Batch","trim|required");
        $this->form_validation->set_rules("student","Student","trim|required");
        $this->form_validation->set_rules("std_class","Class","trim|required");

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("std_batch")){

                $data["input_error"][] ="std_batch";
                $data["error_string"][]=form_error("std_batch");
            }
            if(form_error("student")){

                $data["input_error"][] ="student";
                $data["error_string"][]=form_error("student");
            }
            if(form_error("std_class")){

                $data["input_error"][] ="std_class";
                $data["error_string"][]=form_error("std_class");
            }

            echo json_encode($data);
            exit();

        }
        else{

            $val=$this->input->post();

            $where="batch=".$val['std_batch']." AND class=".$val['std_class'];

            $ref_id=$this->kcrud->getValueOne('asms_class_arrangement','id',$where,null,null,null,null)->id;
            $index_id=$this->kcrud->getValueOne('asms_class_allocation','id','arrange_ref_id='.$ref_id." AND status=0",null,null,null,null)->id;

            $data=array(

                'student'=>$val['student'],
                'status'=>1,
                'updated_at'=>date('Y-m-d H:i:s'),
                'user'=>USER_ID
            );

            $data1=array(
                'allocation_status'=>1,
                'allocated_date'=>date('Y-m-d h:i:s')
            );

            $data2=array(
                'status'=>1,
            );

            $this->kcrud->update('asms_class_allocation',$data,array('id'=>$index_id));
            $this->kcrud->update('asms_students_register',$data1,array('id'=>$val['student']));
            $this->kcrud->update('asms_class_arrangement',$data2,array('id'=>$ref_id));


            echo json_encode(array('status'=>TRUE,'message'=>'Class Arrangement successfully !'));
        }
    }



    public function add_new_lead(){

        $this->form_validation->set_rules("std_batch","Batch","trim|required");
        $this->form_validation->set_rules("student","Student","trim|required");
        $this->form_validation->set_rules("std_class","Class","trim|required");

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("std_batch")){

                $data["input_error"][] ="std_batch";
                $data["error_string"][]=form_error("std_batch");
            }
            if(form_error("student")){

                $data["input_error"][] ="student";
                $data["error_string"][]=form_error("student");
            }
            if(form_error("std_class")){

                $data["input_error"][] ="std_class";
                $data["error_string"][]=form_error("std_class");
            }

            echo json_encode($data);
            exit();

        }
        else{

            $val=$this->input->post();

            $where="batch=".$val['std_batch']." AND class=".$val['std_class'];

            $ref_id=$this->kcrud->getValueOne('asms_class_arrangement','id',$where,null,null,null,null)->id;
            $index_id=$this->kcrud->getValueOne('asms_class_allocation','id','arrange_ref_id='.$ref_id." AND status=0",null,null,null,null)->id;

            $data=array(

                'student'=>$val['student'],
                'status'=>1,
                'updated_at'=>date('Y-m-d H:i:s'),
                'user'=>USER_ID
            );

            $data1=array(
                'allocation_status'=>1,
                'allocated_date'=>date('Y-m-d h:i:s')
            );

            $data2=array(
                'status'=>1,
            );

            $this->kcrud->update('asms_class_allocation',$data,array('id'=>$index_id));
            $this->kcrud->update('asms_students_register',$data1,array('id'=>$val['student']));
            $this->kcrud->update('asms_class_arrangement',$data2,array('id'=>$ref_id));


            echo json_encode(array('status'=>TRUE,'message'=>'Class Arrangement successfully !'));
        }
    }

    

    public function view_class($id){

        $class=$this->class_mod->view_class($id);
        echo json_encode(array('class'=>$class));

    }
    public function view_data_info($id){
//        $val = $this->input->post();
//        $id=$val['id'];
        // $u_id=USER_ID;
        $data=$this->agent_mod->agent_view_data_info($id);
        // $loan_infoData=$this->class_mod->view_loan_info($id);
        echo json_encode(array('histories'=>$data));

    }
    public function view_history($id){
        $data=$this->class_mod->view_history($id);
        echo json_encode(array('histories'=>$data));

    }


    public function view_loan_status_history($id){
        $data=$this->class_mod->view_history_loan($id);
        echo json_encode(array('loan_histories'=>$data));

    }

    public function delete_class($id){

        if($this->class_mod->get_list_by_id('asms_class_arrangement','*',array('id'=>$id,'status'=>0))){

            $this->class_mod->delete('asms_class_arrangement',array('id'=>$id,'status'=>0));
            $this->class_mod->delete('asms_class_allocation',array('arrange_ref_id'=>$id,'status'=>0));
            echo json_encode(array('status'=>TRUE));

        }
        else{

            echo json_encode(array('status'=>FALSE));

        }

    }

    public function get_close_date_by_batch()
    {
        $batch_id=$this->input->post('batch');
        
        $dead_line_date=$this->class_mod->get_batch_by_close_date($batch_id);
        echo json_encode($dead_line_date);
    }

    public function get_past_stu_details_by_ref_nic()
    {
        $ref_nic=$this->input->post('ref_nic');
        
        $past_stu_det=$this->class_mod->get_past_stu_by_ref_nic($ref_nic);
        echo json_encode($past_stu_det);

    }


    public function get_targets_data_by_batch()
    {
        $batch_id=$this->input->post('batch');
        
        $dead_line_date=$this->class_mod->get_targets($batch_id);
        
        echo json_encode($dead_line_date);
    }


    public function get_scl_by_drop_down()
    {
        $scl=$this->input->post('scl');
        
        $scl_name=$this->class_mod->get_scl_by_drop_down($scl);
        echo json_encode($scl_name);
    }

    public function delete_student($id){

        $where="id=".$id;

        $student=$this->kcrud->getValueOne('asms_class_allocation','student',$where,null,null,null,null)->student;

        $data=array(

            'student'=>0,
            'status'=>0
        );

        $data1=array(
            'allocation_status'=>0,
        );

        $this->kcrud->update('asms_class_allocation',$data,array('id'=>$id));
        $this->kcrud->update('asms_students_register',$data1,array('id'=>$student));
        echo json_encode(array('status'=>TRUE,'message'=>'Class Arrangement Deleted !'));
    }

    public function allocation_save()
    {
        $val = $this->input->post();

        $where0="batch=".$val['allocation_batch']." AND status=1 AND allocation_status=0";
        $where1="batch=".$val['allocation_batch']." AND student=0 AND status=0";

        $students=$this->kcrud->getValueAll("asms_students_register","id,st_gender AS gender,status",$where0,null,null,null,null);
        $classes=$this->kcrud->getValueAll("asms_class_allocation","id",$where1,null,null,null,null);

        $male_count=1;
        $female_count=2;

        $big_array=array();

        foreach($students as $std){

            if($std->gender == "Male"){

                $big_array[$male_count]=$std->id;
                $male_count=$male_count+2;

            }
            else if($std->gender == "Female"){
                $big_array[$female_count]=$std->id;
                $female_count=$female_count+2;
            }
        }

        ksort($big_array);

        $class_array=array();

        foreach ($classes as $cls){
            $class_array[]=$cls->id;
        }

        $x=0;
        foreach($big_array as $key1 => $arr1){

            if($arr1){

                $data1=array(
                    'status'=>1,
                    'student'=>$arr1,
                    'updated_at'=>date('Y-m-d h:i:s'),
                    'user'=>USER_ID
                );

                if($this->kcrud->update('asms_class_allocation',$data1,array('id'=>$class_array[$x]))){

                    $data2=array(
                        'allocation_status'=>1,
                        'allocated_date'=>date('Y-m-d h:i:s')
                    );

                   // $this->kcrud->update('asms_students_register',$data2,array('id'=>$arr1));

                }
            }

            $x++;
        }

        $where2="batch=".$val['allocation_batch']." AND status=1";
        $group2="GROUP BY arrange_ref_id";
        $arrangements=$this->kcrud->getValueAll("asms_class_allocation","arrange_ref_id",$where2,null,null,$group2,null);

        foreach ($arrangements as $arrange1){

            $data3=array(
                'status'=>1,
            );
            $this->kcrud->update('asms_class_arrangement',$data3,array('id'=>$arrange1->arrange_ref_id));
        }

        echo json_encode(array('status'=>TRUE,'message'=>'Class Allocation successfully !'));

    }


    public function reset_save()
    {
        $val = $this->input->post();

        $where1="batch=".$val['reset_batch']." AND status=1";
        $where2="batch=".$val['reset_batch']." AND status=1";
        $group2="GROUP BY arrange_ref_id";

        $classes=$this->kcrud->getValueAll("asms_class_allocation","id,student",$where1,null,null,null,null);
        $arrangements=$this->kcrud->getValueAll("asms_class_allocation","arrange_ref_id",$where2,null,null,$group2,null);

        foreach ($classes as $cls){

            $data2=array(
                'allocation_status'=>0
            );

            $data3=array(
                'status'=>0,
                'student'=>0
            );

            $this->kcrud->update('asms_students_register',$data2,array('id'=>$cls->student));
            $this->kcrud->update('asms_class_allocation',$data3,array('id'=>$cls->id));
        }

        foreach ($arrangements as $arrange1){

            $data3=array(
                'status'=>0,
            );
            $this->kcrud->update('asms_class_arrangement',$data3,array('id'=>$arrange1->arrange_ref_id));
        }

        echo json_encode(array('status'=>TRUE,'message'=>'Class Allocation successfully !'));

    }


    public function _master_output($output = null)
    {
        $this->load->view('master/master.php',$output);
    }

    public function create_edu_agent_company()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_education_agent_company');
        $crud->set_subject('Master Education Agent Company');
        $crud->required_fields('company_name','company_address','company_contact_number','company_email_id');
        
         
        // $crud->add_fields('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit','office_id');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function create_contact_method()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_contact_methods');
        $crud->set_subject('Master Contact Methods');
        $crud->required_fields('contact_name','code');
        
         
        // $crud->add_fields('customerName','contactLastName','phone','city','country','salesRepEmployeeNumber','creditLimit','office_id');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function create_al_schools()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_lead_school_list');
        $crud->set_subject('Master A/L Schools');
        $crud->required_fields('name','code');
       
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }


    public function create_work_hospitals()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_work_experience_skls_hos');
        $crud->set_subject('Work Place');
        $crud->required_fields('name');
       
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }


    public function create_al_stream()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_al_streams');
        $crud->set_subject('Master A/L Stream');
        $crud->required_fields('name','code');
       
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function create_int_level()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_lead_interest_level');
        $crud->set_subject('Master Interest');
        $crud->required_fields('name','code');
       
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

   public function create_lead_source()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_m_lead_source');
        $crud->set_subject('Master Lead Source');
        $crud->required_fields('source_title','code');
       
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function lead_trans_reason()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_m_lead_trans_reason');
        $crud->set_subject('Master Lead Transfer Reasons');
        $crud->required_fields('name');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function lead_titles()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_m_lead_title');
        $crud->set_subject('Master Lead Titles');
        $crud->required_fields('name');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function lead_user_groups()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('auth_groups');
        $crud->where("auth_groups.lead_status = '1'");
        $crud->set_subject('Master Lead User Groups');
        $crud->display_as('name','Group Name');
        $crud->unset_columns(array('lead_status'));
        // $crud->in_where('lead_status','1');
        $crud->required_fields('name','description');
        
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }


    public function create_agent_list()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_agents_list');
        $crud->set_subject('Master Agent List');
        $crud->required_fields('agent_code','name','nic','phone');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function create_follow_up_activity()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_follow_up_activities');
        $crud->set_subject('Master Follow Up Activities');
        $crud->required_fields('name');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }

    public function meetup()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_m_lead_meetup');
        $crud->set_subject('Master Lead Meet up Locations');
        $crud->required_fields('name');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }


    public function called_status()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_called_stutus');
        $crud->set_subject('Master Called Status');
        $crud->required_fields('name');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }


    public function follow_up_ac_call_status()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('lead_follow_up_called_status');
        $crud->set_subject('Master Follow Up Activity Called Status');
        $crud->display_as('name','Group Name');
        $crud->set_relation('follow_up_activity','lead_follow_up_activities','name');
        $crud->set_relation('called_status','lead_called_stutus','name');
        // $crud->display_as('');
        $crud->required_fields('follow_up_activity','called_status');
        // $crud->display_as('componentType','Salary Component Type');
        // $crud->set_relation('program','asms_m_programs','name');
        // $crud->set_relation('batch','asms_m_batches','name');
        // $crud->set_relation('intake','asms_m_intakes_list','intake_name');
        // $crud->set_relation('componentType','pay_salary_component_types','{name}');
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');
    }



       public function get_pre_data($id){   
       
        //$where1="id=".$id;
           
        $pre_data = $this->class_mod->get_prev_data($id);  
                 
        //$pre_data=$this->kcrud->getValueOne("lead_management","*",$where1,null,null,null,null);
        $programs = $this->class_mod->get_programs($id);

        $get_inserted_other_pro = $this->class_mod->get_inserted_other_pro($id);
        $get_inserted_l_source = $this->class_mod->get_inserted_l_source($id);
        // var_dump($get_inserted_other_pro);
        // die();
        echo json_encode(array('pre_data'=>$pre_data,'programs'=>$programs,'get_inserted_other_pro'=>$get_inserted_other_pro,'get_inserted_l_source'=>$get_inserted_l_source));

    }



    public function get_bI_by_course(){
        $program_id=$this->input->post('select_course');
        $batch_intake=$this->class_mod->get_bI_by_course($program_id);
       

        echo json_encode(array('batch_intake'=>$batch_intake));
    }


    public function get_transfer_details()
    {
        $program_id=$this->input->post('select_course');
        $batch_id=$this->input->post('batch');
       
        $transfer_details_tb = $this->class_mod->get_transfer_details($program_id,$batch_id);

        echo json_encode(array('transfer_details_tb'=>$transfer_details_tb));
    }

    public function get_batch_by_course_yr()
    {
        $program_id=$this->input->post('select_course');
        $yr1 = $this->input->post('year1');
        $yr2 = $this->input->post('year2');

        $yr1_start = $yr1.'-04-01';
        $yr2_end = $yr2.'-03-31';

        $target_intake_data = $this->class_mod->get_traget_tb_id($program_id,$yr1,$yr2); 
      
         

        $batch_yr=$this->class_mod->get_batch_by_course_yr($program_id,$yr1_start,$yr2_end);
        
        echo json_encode(array('batch_yr'=>$batch_yr,'target_intake_data'=>$target_intake_data));
    }

    public function get_follow_up_activity(){
        $follow_up=$this->input->post('follow_up');
        $call_status=$this->class_mod->get_follow_up_activity($follow_up);
        echo json_encode(array('call_status'=>$call_status));
    }
 

    public function view_course_email_mobile()
    {
        
        $val=$this->input->post();
       
       
        // $programe = $val['programe'];
        // $batch_search  = $val['batch_search'];
        $email=$val['email'];
        $mobile=$val['mobile'];

        // if($email=="noName@gmail.com")
        // {
        //     $student_data=$this->class_mod->getnomail_data($email,$mobile);
        // }
        // else if($mobile=="0123456789")
        // {

        //     $student_data=$this->class_mod->getnonumber_data($email,$mobile);
        // }

        
        $student_data=$this->class_mod->getstudent_data(trim($email),trim($mobile));
       
        echo json_encode(array('student_data'=>$student_data));

        // $data['student_data'] = $this->class_mod->getstudent_data($email,$mobile);
        
    // $this->load->view('pop_up_lead_details_view',$data);
       

// foreach($data as $d)
// {
    // var_dump($d['l_email']);
    // die();
    // if($d->l_email)
    // {
    //     echo "have email";

    // }
    // else if($d->l_phone)
    // {
    //     echo "have mobile";
    // }
    // else if($d->l_email && $d->l_phone){

    //     echo "both have";

    // }
// }

        // if($data)
        // {
        //     echo "<script>
        //     bootbox.alert({
        //         message: '<b>Data Available...............</b>'
        //     });
        //     </script>";
        // }
        
        // $this->load->view('class_index_search',$data); 
      
      
    }



    /////////////////////////////////////transfer lead code////////////////////////////////////////////////////////////


public function view_lead_tranfer_table()
{
    $val=$this->input->post();
       
       
    $lead_owner = $val['lead_owner'];
    $course=$val['course'];
    $trans_l_status=$val['trans_l_status'];
    $trans_in_level = $val['trans_in_level'];
    $counsellor_id = $val['counsellor_id'];
    $data['transfer_res']=$this->class_mod->get_master_transfer_res();
    $data['Counselor']=$this->class_mod->get_Counselor();
    $data['transLead_data'] = $this->class_mod->get_TransLead_data($lead_owner,$course,$trans_l_status,$trans_in_level,$counsellor_id);
    

    
    
    
    // $data['transLead_data']=$this->class_mod->get_TransLead_data($lead_owner,$course,$trans_l_status);
    $this->load->view('lead_transfer_table',$data);
        // $this->load->view('validated_stu_excel',$data);
    
}


public function transfer_update_lead_owner(){         

    $val=$this->input->post();

    $check_box = $val['#std_check'];
    

     

    $this->form_validation->set_rules("to_trans_name","Transfer Person","trim|required");
    $this->form_validation->set_rules("l_reason","Transfer Reason","trim|required");
    $this->form_validation->set_rules("l_date","Transfer Date","trim|required");
    // $this->form_validation->set_rules("std_check","Select One More Leads","trim|required");
 



  if($this->form_validation->run() == false){

    

      $data=array();
      $data["error"]=array();
      $data["input_error"]=array();
      $data["status"]=FALSE;

    //   if(form_error("std_check")){

    //       $data["input_error"][] ="std_check";
    //       $data["error_string"][]=form_error("std_check");
    //   }
      if(form_error("to_trans_name")){

          $data["input_error"][] ="to_trans_name";
          $data["error_string"][]=form_error("to_trans_name");
      }
      if(form_error("l_reason")){

        $data["input_error"][] ="l_reason";
        $data["error_string"][]=form_error("l_reason");
    }
      
      if(form_error("l_date")){

        $data["input_error"][] ="l_date";
        $data["error_string"][]=form_error("l_date");
    }
   
    
    
      echo json_encode($data);
      exit();
}else{





    foreach($val['Lead_management_main_id'] as $key => $val1){

        if (in_array($val['Lead_management_main_id'][$key], $val['std_check'])) {


             $lead = array(
                    
                'lead_owner'=>$val['to_trans_name'],

            );
        $this->db->where('id',$val['Lead_management_main_id'][$key]);  
        
        if($this->db->update('lead_management',$lead)){
            $updated_status = $this->db->affected_rows();
            if($updated_status){
                $transfer = array(
                    'lead_id' =>$val['Lead_management_main_id'][$key],
                    'res_id' =>$val['l_reason'],
                    'from_person' =>$val['from_lead_owner'][$key],
                    'to_person' =>$val['to_trans_name'],
                    'date' =>$val['l_date'],
                    'user' =>$val['user_id'][$key],   
                );
    
                $this->db->insert("asms_lead_transfer",$transfer);   
            }
        }
        else{
            echo "Faild";
        }               
        }    
    } 
    echo json_encode(array('status'=>TRUE,'message'=>'Transfered Successfully!!'));
   
                // echo json_encode(array('status'=>TRUE,'message'=>'Selected Successfully!!'));
    
}
    
     
} 


public function transfer_update_loan_assis()
{


    // $this->form_validation->set_rules("std_check","Transfer one or more option","trim|required");
        $this->form_validation->set_rules("to_trans_loan_name","Transfer Person","trim|required");
        $this->form_validation->set_rules("loan_reason","Transfer Reason","trim|required");
        $this->form_validation->set_rules("loan_transfer_date","Transfer Date","trim|required");

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            // if(form_error("std_check")){

            //     $data["input_error"][] ="std_check";
            //     $data["error_string"][]=form_error("std_check");
            // }
            if(form_error("to_trans_loan_name")){

                $data["input_error"][] ="to_trans_loan_name";
                $data["error_string"][]=form_error("to_trans_loan_name");
            }
            if(form_error("loan_reason")){

                $data["input_error"][] ="loan_reason";
                $data["error_string"][]=form_error("loan_reason");
            }
            if(form_error("loan_transfer_date")){

                $data["input_error"][] ="loan_transfer_date";
                $data["error_string"][]=form_error("loan_transfer_date");
            }

            echo json_encode($data);
            exit();

        }
        else{

    $val=$this->input->post();

    foreach($val['Lead_management_main_id'] as $key => $val1){

        if (in_array($val['Lead_management_main_id'][$key], $val['std_check'])) {


             $loan = array(
                    
                'loan_assistance_id'=>$val['to_trans_loan_name'],

            );
        $this->db->where('id',$val['Lead_management_main_id'][$key]);  
        
        if($this->db->update('lead_management',$loan)){
            $updated_status = $this->db->affected_rows();
            if($updated_status){
                $transfer = array(
                    'lead_id' =>$val['Lead_management_main_id'][$key],
                    'reason' =>$val['loan_reason'],
                    'from_person' =>$val['from_loan_owner'][$key],
                    'to_person' =>$val['to_trans_loan_name'],
                    'date' =>$val['loan_transfer_date'],
                    'created_at'=>date('Y-m-d h:i:s')

                      
                );
    
                $this->db->insert("asms_loan_transfer",$transfer);   
            }
        }
        else{
            echo "Faild";
        }               
        }    
    } 
    echo json_encode(array('status'=>TRUE,'message'=>'Transfered Successfully!!'));
}
                // echo json_encode(array('status'=>TRUE,'message'=>'Selected Successfully!!'));
    
}




public function view_full_profile()
{

    $val=$this->input->post();
       
       
    $id = $val['id'];

 $data['view_full']=$this->class_mod->view_full_profile($id);
 $data['lead_source']=$this->class_mod->view_lead_source($id);
 $data['int_other_pro']=$this->class_mod->view_int_other_pro($id);
 $data['pref_contact_method']=$this->class_mod->view_pref_con($id);
 $data['lead_changes_history']=$this->class_mod->view_lead_changes_history($id);
 $this->load->view('pop_up_lead_details_view',$data);
}

 



public function view_loan_tranfer_table()
{
    $val=$this->input->post();
       
       
    $loan_assistance_id = $val['l_assis'];
    $lead_id=$val['l_id'];
    $assis_id = $val['assis_id'];
    $lead_id_1 = $val['lead_id_1'];
     

    // $data['transfer_res']=$this->class_mod->get_master_transfer_res();
    // $data['transfer_res']=$this->class_mod->get_master_transfer_res();
    // $data['Counselor']=$this->class_mod->get_Counselor();
    $data['Loan_assis_data']=$this->class_mod->get_Loan_assistance_data();
    $data['transLoan_data'] = $this->class_mod->get_TransLoan_data($loan_assistance_id,$lead_id,$assis_id,$lead_id_1);

     

    
    
    
    // $data['transLead_data']=$this->class_mod->get_TransLead_data($lead_owner,$course,$trans_l_status);
    $this->load->view('loan_transfer_table',$data);
        // $this->load->view('validated_stu_excel',$data);
}




public function get_lead_id_code_increment_pre()
{
    $query=$this->db->query("SELECT lead_management_pre.lead_temp_id
    FROM lead_management_pre
    ORDER BY lead_management_pre.id DESC limit 1");

    return $query->row();
}



//bulk lead-------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------//////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function recruit_list_import()
  {
   
    $this->db->empty_table('lead_management_pre_duplicate');

    if(isset($_FILES["file"]["name"]))
    {
      $path = $_FILES["file"]["tmp_name"];
      $object = PHPExcel_IOFactory::load($path);
      $i=0;
      foreach($object->getWorksheetIterator() as $worksheet)
      {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        for($row=2; $row<=$highestRow; $row++)
        {         


            $user = USER_ID;
            $company_id = COMPANY_ID;


            $get_lead_id_code_increment_pre =$this->get_lead_id_code_increment_pre();


            $p_title = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
              $title = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
              $country = $worksheet->getCellByColumnAndRow(14, $row)->getValue(); 
              $province = $worksheet->getCellByColumnAndRow(15, $row)->getValue(); 
             
              $lead_source = explode(',',$worksheet->getCellByColumnAndRow(18, $row)->getValue());

              
            
              $contacted_method = $worksheet->getCellByColumnAndRow(19, $row)->getValue(); 
              $program = $worksheet->getCellByColumnAndRow(20, $row)->getValue(); 
              $batch = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
              $intake = $worksheet->getCellByColumnAndRow(22, $row)->getValue();  
              $pref_contact_method = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
            
              

             $p_title_n = $this->class_mod->get_title(trim($p_title))->id;
             $title_n = $this->class_mod->get_title(trim($title))->id;
             $country_n = $this->class_mod->get_country(trim($country))->id;
             $province_n = $this->class_mod->get_province_pre(trim($province))->id;

            //  var_dump(count($lead_source));
            //  die();

            //  for($j=0; $j<count($lead_source); $j++){
            //     $lead_source_n = $this->class_mod->get_l_source(trim($lead_source[$j]))->id;

               
              
            // }

             $j=0;
            while($j<count($lead_source)){
                $lead_source_n[$j] = $this->class_mod->get_l_source(trim($lead_source[$j]))->id;

                $j++;
              
            }
           
            


             $contacted_method_n = $this->class_mod->get_contacted_method(trim($contacted_method))->id;      
           
             $program_n =$this->class_mod->get_program(trim($program))->id;

             $batch_intake_n = $this->class_mod->get_batch_intake(trim($batch),trim($intake))->id;
             $pref_contact_method_n = $this->class_mod->get_contacted_method(trim($pref_contact_method))->id; 



//////////////////////////////////check lead////////////////////////////////////////////////////////

$stu_f_name = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
$stu_mid_name = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
$stu_l_name = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
$stu_parent_name = $worksheet->getCellByColumnAndRow(2, $row)->getValue();

$stu_phone = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
$stu_phone_2 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
$stu_nic = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
$stu_passport = $worksheet->getCellByColumnAndRow(10, $row)->getValue();

$stu_email = $worksheet->getCellByColumnAndRow(11, $row)->getValue();










if($stu_phone != "" || $stu_phone_2 != "" || $stu_nic != "" || $stu_passport != "" || $stu_email !="")
{
    if($stu_phone != "")
    {
        //phone
        $phone_count_pre =  $this->class_mod->get_phone_count_pre(trim($stu_phone));

 
         
        if($phone_count_pre == 0 )
        {
             if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){

              $data_1 = array(
                'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                'parent_salutation'=>$p_title_n,//1
                'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'salutation'=>$title_n,//3
                'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'country'=>$country_n,//14
                'state_pro'=>$province_n,//15
                'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                'contact_method'=>$contacted_method_n,//19
                'programe'=>$program_n,//20
                'batch'=>$batch_intake_n,//21,22   
                'pref_contact_method'=>$pref_contact_method_n,///23
                'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                'user_id'=>$user,
                'company_id'=>$company_id,
                'created_date'=>date("Y-m-d H:i:s")
                
              );

            if($this->db->insert('lead_management_pre',$data_1)){

                $insert_id = $this->db->insert_id(); 


                $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                }         

                // var_dump($insert_id);
                // die();

                                 
                // $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                // $new_code_id_pre = "TEM/INQ/0".$insert_id;
                // }
                // else{
                //     $new_code_id_pre = "TEM/INQ/".$insert_id; 
                // }
        
        
        
                if($insert_id){
                    // $selected_pre = array(
                        
                    //     'lead_temp_id' =>$new_code_id_pre,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management_pre', $selected_pre);
                
                    




                for($k=0; $k<count($lead_source); $k++){
                    $this->db->insert('lead_inserted_lead_source_pre',
                     array('l_source' =>$lead_source_n[$k] ,
                           'lead_management_pre_tb_id' =>$insert_id));
                }

            }


                
            }

            
                 
           
 
             
          }
        }
        else{
           ///////duplicate entries/////////////////////////////////////////////
           ////////////////////////////////////////////////////////////////////////
           //////////////////////////////////////////////////////////////////////
          



           $data_duplicate = array(
            'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
            'parent_salutation'=>$p_title_n,//1
            'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
            'salutation'=>$title_n,//3
            'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
            'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
            'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
            'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
            'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
            'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
            'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
            'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
            'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
            'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
            'country'=>$country_n,//14
            'state_pro'=>$province_n,//15
            'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
            'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
            'contact_method'=>$contacted_method_n,//19
            'programe'=>$program_n,//20
            'batch'=>$batch_intake_n,//21,22   
            'pref_contact_method'=>$pref_contact_method_n,///23
            'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
            'user_id'=>$user,
            'company_id'=>$company_id,
            'created_date'=>date("Y-m-d H:i:s")
            
          );

          $this->db->insert('lead_management_pre_duplicate',$data_duplicate);


 

           
               
         

        


 ///////end duplicate entries/////////////////////////////////////////////
           ////////////////////////////////////////////////////////////////////////
           //////////////////////////////////////////////////////////////////////


        }


    }else if($stu_phone_2 != "")
    {
                    //phone_2
            $phone2_count_pre =  $this->class_mod->get_phone2_count_pre(trim($stu_phone_2));
            


            if($phone2_count_pre == 0 )
        {
            if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){

                $data_1 = array(
                  'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                  'parent_salutation'=>$p_title_n,//1
                  'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                  'salutation'=>$title_n,//3
                  'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                  'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                  'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                  'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                  'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                  'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                  'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                  'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                  'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                  'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                  'country'=>$country_n,//14
                  'state_pro'=>$province_n,//15
                  'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                  'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                  'contact_method'=>$contacted_method_n,//19
                  'programe'=>$program_n,//20
                  'batch'=>$batch_intake_n,//21,22   
                  'pref_contact_method'=>$pref_contact_method_n,///23
                  'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                  'user_id'=>$user,
                  'company_id'=>$company_id,
                  'created_date'=>date("Y-m-d H:i:s")
                  
                );
  
            //   $this->db->insert('lead_management_pre',$data_1);
                   
            // if($this->db->insert('lead_management_pre',$data_1)){

            //     $insert_id = $this->db->insert_id(); 

            //     for($k=0; $k<count($lead_source); $k++){
            //         $this->db->insert('lead_inserted_lead_source_pre',
            //          array('l_source' =>$lead_source_n[$k] ,
            //                'lead_management_pre_tb_id' =>$insert_id));
            //     }


                
            // }


            if($this->db->insert('lead_management_pre',$data_1)){

                $insert_id = $this->db->insert_id(); 
                $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                 
                // $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
        
        
        
                if($insert_id){
                    // $selected_pre = array(
                        
                    //     'lead_temp_id' =>$new_code_id_pre,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management_pre', $selected_pre);
                
                    




                for($k=0; $k<count($lead_source); $k++){
                    $this->db->insert('lead_inserted_lead_source_pre',
                     array('l_source' =>$lead_source_n[$k] ,
                           'lead_management_pre_tb_id' =>$insert_id));
                }

            }


                
            }
  
               
            }
        }

        else{
            ///////duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
 
 
  
 
            $data_duplicate = array(
                'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                'parent_salutation'=>$p_title_n,//1
                'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'salutation'=>$title_n,//3
                'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'country'=>$country_n,//14
                'state_pro'=>$province_n,//15
                'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                'contact_method'=>$contacted_method_n,//19
                'programe'=>$program_n,//20
                'batch'=>$batch_intake_n,//21,22   
                'pref_contact_method'=>$pref_contact_method_n,///23
                'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                'user_id'=>$user,
                'company_id'=>$company_id,
                'created_date'=>date("Y-m-d H:i:s")
                
              );
    
              $this->db->insert('lead_management_pre_duplicate',$data_duplicate);

            //  var_dump($data_1a);
            //  die();
  
 
           
                
          
 
         
 
 
  ///////end duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
         }



    }else if($stu_nic != "")
    {
            //nic
            $nic_count_pre =  $this->class_mod->get_nic_count_pre(trim($stu_nic));
           


            if($nic_count_pre == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }     


                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                     
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }


    }
    else if($stu_passport != "")
    {

            //passport
            $pass_count_pre =  $this->class_mod->get_pass_count_pre(trim($stu_passport));
          

            if($pass_count_pre == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }


                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    
                //     $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }

    }else if($stu_email !="")
    {

            //email
            $email_count_pre =  $this->class_mod->get_email_count_pre(trim($stu_email));
            


            if($email_count_pre == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }


    }else if($stu_phone != "" && $stu_phone_2 != "" )
    {
        $count1 =  $this->class_mod->get_count1(trim($stu_phone),trim($stu_phone_2));
        // $phone2_count_pre =  $this->class_mod->get_phone2_count_pre(trim($stu_phone_2));


        if($count1 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }  
                
                

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
      
                   
                }
            }else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }


    }else if($stu_phone != "" && $stu_email != "")
    {
        $count2 =  $this->class_mod->get_count2(trim($stu_phone),trim($stu_email));


        if($count2 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }
    else if($stu_phone != "" && $stu_nic != "")
    {
        $count3 =  $this->class_mod->get_count3(trim($stu_phone),trim($stu_nic));

        if($count3 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }  
                
                
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                   
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
      
                   
                }
            }else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }
    else if($stu_phone != "" && $stu_passport != "")
    {
        $count4 =  $this->class_mod->get_count4(trim($stu_phone),trim($stu_passport));

        if($count4 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }   
                
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
      
     
               
                    
              
     
                 $this->load->view('duplicate_bulk_data',$data);
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone_2 != "" && $stu_email != "")
    {
        $count5 =  $this->class_mod->get_count5(trim($stu_phone_2),trim($stu_email));


        if($count5 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }    
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                   
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
      
     
               
                    
              
                 $this->load->view('duplicate_bulk_data',$data);
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone_2 != "" && $stu_nic != "")
    {
        $count6 =  $this->class_mod->get_count6(trim($stu_phone_2),trim($stu_nic));


        if($count6 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }     
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone_2 != "" && $stu_passport != "")
    {
        $count7 =  $this->class_mod->get_count7(trim($stu_phone_2),trim($stu_passport));

        if($count7 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }  


                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                     
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }

    }else if($stu_email != "" && $stu_nic != "")
    {
        $count9 =  $this->class_mod->get_count9(trim($stu_email),trim($stu_nic));

        if($count9 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_email != "" && $stu_passport != "")
    {
        $count10 =  $this->class_mod->get_count10(trim($stu_email),trim($stu_passport));

        if($count10 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    // $new_code_id_pre = "TEM/INQ/".$current_yr."/0".$insert_id;
                    // }
                    // else{
                    //     $new_code_id_pre = "TEM/INQ/".$current_yr."/".$insert_id; 
                    // }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone !="" && $stu_phone_2 != "" && $stu_email != "")
    {
        $count11 =  $this->class_mod->get_count11(trim($stu_phone),trim($stu_phone_2),trim($stu_email));
        if($count11 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone !="" && $stu_phone_2 != "" && $stu_nic != "")
    {
        $count12 =  $this->class_mod->get_count12(trim($stu_phone),trim($stu_phone_2),trim($stu_nic));
        if($count12 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }    
      

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    

                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                   
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }

    }else if($stu_phone !="" && $stu_phone_2 != "" && $stu_passport != "")
    {

        $count13 =  $this->class_mod->get_count13(trim($stu_phone),trim($stu_phone_2),trim($stu_passport));
        if($count13 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }     
      

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone !="" && $stu_email != "" && $stu_nic != "")
    {
        $count14 =  $this->class_mod->get_count14(trim($stu_phone),trim($stu_email),trim($stu_nic));
        if($count14 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                       
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }
      

                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                    // var_dump($get_end_date);
                    // die();
                    
                   
                    $lead_id_ab_pre;
                    $end_date_pre;
    
    
                    if($get_end_date_pre != NULL)
                    {
                           $end_date_pre=$get_end_date_pre->to_date;
                           $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);
    
                         
                           
                        
                          
                           $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;
    
    
                        //    var_dump($lead_id_ab);
                        //    die();
                           if($datediff_pre / (60 * 60 * 24) > 1){
    
    
                               
    
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
      
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = $explode_lead_id_pre[3];
                           
    
                            $number_pre =$number_pre+1;
                            if($number_pre <10){
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
    
                            }else{
                                $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;
    
                            }
                           
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
    
    
                           }else{
                             
                            $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                            $temp_pre=$explode_lead_id_pre[0];
                            $inq_pre= $explode_lead_id_pre[1];
                            $yr_pre=$explode_lead_id_pre[2];
                            $number_pre = 01;
    
                            $yr_pre=$yr_pre+1;
    
                           
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                            
                            $selected_pre = array(
                            
                                'lead_temp_id' =>$lead_id_ab_pre,
                                 
                            );
                            $this->db->where('id', $insert_id);
                            $this->db->update('lead_management_pre', $selected_pre);
    
    
                            $explode_end_date_pre = explode("-",$end_date_pre);
                            // $end_year=$explode_end_date[0]+1;
    
                            $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];
    
                            $selected_end_date_update_pre = array(
                            
                                'to_date' =>$new_end_year_pre,
                                 
                            );
                            $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                            $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);
    
    
                           
    
    
                            
    
                           }
    
                           
    
    
    
    
                    }else{
                        $lead_id_ab_pre = "TEM/INQ/21/01";
                        $end_date_pre = "2022-03-31";
    
                        $selected_pre = array(
                            
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);
    
    
                        $selected_end_date_pre = array(
                            
                            'to_date' =>$end_date_pre,
                             
                        );
                     
                        $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);
    
                    } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }

    }else if($stu_phone !="" && $stu_email != "" && $stu_passport != "")
    {
        $count15 =  $this->class_mod->get_count15(trim($stu_phone),trim($stu_email),trim($stu_passport));
        if($count15 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }    
      
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone_2 !="" && $stu_email != "" && $stu_nic != "")
    {
        $count16 =  $this->class_mod->get_count16(trim($stu_phone_2),trim($stu_email),trim($stu_nic));
        if($count16 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
     

                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone_2 !="" && $stu_email != "" && $stu_passport != "")
    {
        $count17 =  $this->class_mod->get_count17(trim($stu_phone_2),trim($stu_email),trim($stu_passport));
        if($count17 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }   
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
     

                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_email !="" && $stu_nic != "" && $stu_passport != "")
    {
        $count18 =  $this->class_mod->get_count18(trim($stu_email),trim($stu_nic),trim($stu_passport));
        if($count18 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }    
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
     

                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone !="" && $stu_phone_2 != "" && $stu_email != "" && $stu_nic !="")
    {
        $count19 =  $this->class_mod->get_count19(trim($stu_phone_2),trim($stu_phone),trim($stu_email),trim($stu_nic));
        if($coun19 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }    
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone !="" && $stu_phone_2 != "" && $stu_email != "" && $stu_passport != "")
    {
        $count20 =  $this->class_mod->get_count20(trim($stu_phone_2),trim($stu_phone),trim($stu_email),trim($stu_passport));
        if($count20 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }      
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
     

                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
     
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }

    }else if($stu_phone !="" && $stu_email != "" && $stu_nic != "" && $stu_passport != "")
    {
        $count21 =  $this->class_mod->get_count21(trim($stu_phone),trim($stu_email),trim($stu_nic),trim($stu_passport));
        if($count21 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }  
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
      


                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_phone_2 != "" && $stu_email != "" && $stu_nic != "" && $stu_passport != "")
    {
        $count22 =  $this->class_mod->get_count22(trim($stu_phone_2),trim($stu_email),trim($stu_nic),trim($stu_passport));
        if($count22 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }    
      
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 


                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                    // $current_yr = date("Y");
                    // //  }
                    // // if($insert_id <= 9){
                    // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                    // // }
                    // // else{
                    // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                    // // }
                    // if($insert_id <= 9){
                    //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                    //     }
                    //     else{
                    //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                    //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
                   
                }
            }
            else{
                ///////duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
     
     
      
     
                $data_duplicate = array(
                    'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                    'parent_salutation'=>$p_title_n,//1
                    'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                    'salutation'=>$title_n,//3
                    'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                    'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                    'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                    'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                    'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                    'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                    'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                    'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                    'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                    'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                    'country'=>$country_n,//14
                    'state_pro'=>$province_n,//15
                    'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                    'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                    'contact_method'=>$contacted_method_n,//19
                    'programe'=>$program_n,//20
                    'batch'=>$batch_intake_n,//21,22   
                    'pref_contact_method'=>$pref_contact_method_n,///23
                    'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                    'user_id'=>$user,
                    'company_id'=>$company_id,
                    'created_date'=>date("Y-m-d H:i:s")
                    
                  );
        
                  $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
               
                    
              
     
             
     
     
      ///////end duplicate entries/////////////////////////////////////////////
                ////////////////////////////////////////////////////////////////////////
                //////////////////////////////////////////////////////////////////////
     
     
             }
    }else if($stu_email !="" && $stu_nic != "" && $stu_passport != "" && $stu_phone != "" && $stu_phone_2 != "")
    {
        $count23 =  $this->class_mod->get_count23(trim($stu_phone_2),trim($stu_phone),trim($stu_email),trim($stu_nic),trim($stu_passport));

        if($count23 == 0 )
            {
                if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                    $data_1 = array(
                      'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                      'parent_salutation'=>$p_title_n,//1
                      'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                      'salutation'=>$title_n,//3
                      'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                      'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                      'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                      'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                      'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                      'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                      'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                      'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                      'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                      'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                      'country'=>$country_n,//14
                      'state_pro'=>$province_n,//15
                      'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                      'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                      'contact_method'=>$contacted_method_n,//19
                      'programe'=>$program_n,//20
                      'batch'=>$batch_intake_n,//21,22   
                      'pref_contact_method'=>$pref_contact_method_n,///23
                      'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                      'user_id'=>$user,
                      'company_id'=>$company_id,
                      'created_date'=>date("Y-m-d H:i:s")
                      
                    );
      
                //   $this->db->insert('lead_management_pre',$data_1);
                // if($this->db->insert('lead_management_pre',$data_1)){

                //     $insert_id = $this->db->insert_id(); 
    
                //     for($k=0; $k<count($lead_source); $k++){
                //         $this->db->insert('lead_inserted_lead_source_pre',
                //          array('l_source' =>$lead_source_n[$k] ,
                //                'lead_management_pre_tb_id' =>$insert_id));
                //     }
    
    
                    
                // }   
                if($this->db->insert('lead_management_pre',$data_1)){

                    $insert_id = $this->db->insert_id(); 
    
                    $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                //     $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
            
            
            
                    if($insert_id){
                        // $selected_pre = array(
                            
                        //     'lead_temp_id' =>$new_code_id_pre,
                             
                        // );
                        // $this->db->where('id', $insert_id);
                        // $this->db->update('lead_management_pre', $selected_pre);
                    
                        
    
    
    
    
                    for($k=0; $k<count($lead_source); $k++){
                        $this->db->insert('lead_inserted_lead_source_pre',
                         array('l_source' =>$lead_source_n[$k] ,
                               'lead_management_pre_tb_id' =>$insert_id));
                    }
    
                }
    
    
                    
                }
      
                   
                }
            }

    }
    else{
        ///////duplicate entries/////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////


        $data_duplicate = array(
            'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
            'parent_salutation'=>$p_title_n,//1
            'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
            'salutation'=>$title_n,//3
            'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
            'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
            'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
            'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
            'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
            'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
            'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
            'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
            'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
            'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
            'country'=>$country_n,//14
            'state_pro'=>$province_n,//15
            'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
            'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
            'contact_method'=>$contacted_method_n,//19
            'programe'=>$program_n,//20
            'batch'=>$batch_intake_n,//21,22   
            'pref_contact_method'=>$pref_contact_method_n,///23
            'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
            'user_id'=>$user,
            'company_id'=>$company_id,
            'created_date'=>date("Y-m-d H:i:s")
            
          );

          $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
      

     


///////end duplicate entries/////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////


     }
    
    // else if($phone_count_org == 0 )
    // {

    // }else if($phone2_count_pre == 0)
    // {

    // }else if($phone2_count_org == 0)
    // {

    // }else if($nic_count_pre == 0)
    // {

    // }else if($nic_count_org == 0)
    // {

    // }


}else if($stu_email =="" && $stu_nic == "" && $stu_passport == "" && $stu_phone == "" && $stu_phone_2 == "")
{

    if($stu_f_name != "")
    {

        $count_fname = $this->class_mod->get_fname(trim($stu_f_name));

        if($count_fname== 0)
        {
            if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                $data_1 = array(
                  'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                  'parent_salutation'=>$p_title_n,//1
                  'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                  'salutation'=>$title_n,//3
                  'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                  'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                  'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                  'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                  'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                  'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                  'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                  'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                  'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                  'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                  'country'=>$country_n,//14
                  'state_pro'=>$province_n,//15
                  'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                  'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                  'contact_method'=>$contacted_method_n,//19
                  'programe'=>$program_n,//20
                  'batch'=>$batch_intake_n,//21,22   
                  'pref_contact_method'=>$pref_contact_method_n,///23
                  'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                  'user_id'=>$user,
                  'company_id'=>$company_id,
                  'created_date'=>date("Y-m-d H:i:s")
                  
                );
        
            //   $this->db->insert('lead_management_pre',$data_1);
            // if($this->db->insert('lead_management_pre',$data_1)){
        
            //     $insert_id = $this->db->insert_id(); 
        
            //     for($k=0; $k<count($lead_source); $k++){
            //         $this->db->insert('lead_inserted_lead_source_pre',
            //          array('l_source' =>$lead_source_n[$k],
            //                'lead_management_pre_tb_id' =>$insert_id));
            //     }
        
        
                
            // }    
            if($this->db->insert('lead_management_pre',$data_1)){
        
                $insert_id = $this->db->insert_id(); 
        
                $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                // $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
        
        
        
                if($insert_id){
                    // $selected_pre = array(
                        
                    //     'lead_temp_id' =>$new_code_id_pre,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management_pre', $selected_pre);
                
                    
        
        
        
        
                for($k=0; $k<count($lead_source); $k++){
                    $this->db->insert('lead_inserted_lead_source_pre',
                     array('l_source' =>$lead_source_n[$k] ,
                           'lead_management_pre_tb_id' =>$insert_id));
                }
        
            }
        
        
                
            }
        
               
            } 
        }

        else{
            ///////duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
 
 
  
 
            $data_duplicate = array(
                'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                'parent_salutation'=>$p_title_n,//1
                'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'salutation'=>$title_n,//3
                'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'country'=>$country_n,//14
                'state_pro'=>$province_n,//15
                'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                'contact_method'=>$contacted_method_n,//19
                'programe'=>$program_n,//20
                'batch'=>$batch_intake_n,//21,22   
                'pref_contact_method'=>$pref_contact_method_n,///23
                'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                'user_id'=>$user,
                'company_id'=>$company_id,
                'created_date'=>date("Y-m-d H:i:s")
                
              );
    
              $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
                
          
 
         
 
 
  ///////end duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
         }

    }
    else if($stu_mid_name != "")
    {
        $count_midname = $this->class_mod->get_midname(trim($stu_mid_name));
        if($count_midname == 0)
        {
            if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                $data_1 = array(
                  'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                  'parent_salutation'=>$p_title_n,//1
                  'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                  'salutation'=>$title_n,//3
                  'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                  'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                  'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                  'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                  'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                  'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                  'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                  'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                  'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                  'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                  'country'=>$country_n,//14
                  'state_pro'=>$province_n,//15
                  'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                  'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                  'contact_method'=>$contacted_method_n,//19
                  'programe'=>$program_n,//20
                  'batch'=>$batch_intake_n,//21,22   
                  'pref_contact_method'=>$pref_contact_method_n,///23
                  'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                  'user_id'=>$user,
                  'company_id'=>$company_id,
                  'created_date'=>date("Y-m-d H:i:s")
                  
                );
        
            //   $this->db->insert('lead_management_pre',$data_1);
            // if($this->db->insert('lead_management_pre',$data_1)){
        
            //     $insert_id = $this->db->insert_id(); 
        
            //     for($k=0; $k<count($lead_source); $k++){
            //         $this->db->insert('lead_inserted_lead_source_pre',
            //          array('l_source' =>$lead_source_n[$k],
            //                'lead_management_pre_tb_id' =>$insert_id));
            //     }
        
        
                
            // }    
            if($this->db->insert('lead_management_pre',$data_1)){
        
                $insert_id = $this->db->insert_id(); 
        
                $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                // $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
        
        
        
                if($insert_id){
                    // $selected_pre = array(
                        
                    //     'lead_temp_id' =>$new_code_id_pre,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management_pre', $selected_pre);
                
                    
        
        
        
        
                for($k=0; $k<count($lead_source); $k++){
                    $this->db->insert('lead_inserted_lead_source_pre',
                     array('l_source' =>$lead_source_n[$k] ,
                           'lead_management_pre_tb_id' =>$insert_id));
                }
        
            }
        
        
                
            }
        
               
            } 
        }
        else{
            ///////duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
 
 
  
 
            $data_duplicate = array(
                'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                'parent_salutation'=>$p_title_n,//1
                'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'salutation'=>$title_n,//3
                'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'country'=>$country_n,//14
                'state_pro'=>$province_n,//15
                'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                'contact_method'=>$contacted_method_n,//19
                'programe'=>$program_n,//20
                'batch'=>$batch_intake_n,//21,22   
                'pref_contact_method'=>$pref_contact_method_n,///23
                'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                'user_id'=>$user,
                'company_id'=>$company_id,
                'created_date'=>date("Y-m-d H:i:s")
                
              );
    
              $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
           
                
          
 
         
 
 
  ///////end duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
         }
    }else if($stu_l_name != "")
    {
        $count_lname = $this->class_mod->get_lname(trim($stu_l_name));

        if($count_lname == 0)
        {
            if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                $data_1 = array(
                  'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                  'parent_salutation'=>$p_title_n,//1
                  'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                  'salutation'=>$title_n,//3
                  'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                  'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                  'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                  'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                  'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                  'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                  'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                  'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                  'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                  'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                  'country'=>$country_n,//14
                  'state_pro'=>$province_n,//15
                  'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                  'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                  'contact_method'=>$contacted_method_n,//19
                  'programe'=>$program_n,//20
                  'batch'=>$batch_intake_n,//21,22   
                  'pref_contact_method'=>$pref_contact_method_n,///23
                  'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                  'user_id'=>$user,
                  'company_id'=>$company_id,
                  'created_date'=>date("Y-m-d H:i:s")
                  
                );
        
            //   $this->db->insert('lead_management_pre',$data_1);
            // if($this->db->insert('lead_management_pre',$data_1)){
        
            //     $insert_id = $this->db->insert_id(); 
        
            //     for($k=0; $k<count($lead_source); $k++){
            //         $this->db->insert('lead_inserted_lead_source_pre',
            //          array('l_source' =>$lead_source_n[$k],
            //                'lead_management_pre_tb_id' =>$insert_id));
            //     }
        
        
                
            // }    
            if($this->db->insert('lead_management_pre',$data_1)){
        
                $insert_id = $this->db->insert_id(); 
        
                $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                // $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
        
        
                if($insert_id){
                    // $selected_pre = array(
                        
                    //     'lead_temp_id' =>$new_code_id_pre,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management_pre', $selected_pre);
                
                    
        
        
        
        
                for($k=0; $k<count($lead_source); $k++){
                    $this->db->insert('lead_inserted_lead_source_pre',
                     array('l_source' =>$lead_source_n[$k] ,
                           'lead_management_pre_tb_id' =>$insert_id));
                }
        
            }
        
        
                
            }
        
               
            } 
        }
        else{
            ///////duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
 
 
  
 
            $data_duplicate = array(
                'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                'parent_salutation'=>$p_title_n,//1
                'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'salutation'=>$title_n,//3
                'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'country'=>$country_n,//14
                'state_pro'=>$province_n,//15
                'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                'contact_method'=>$contacted_method_n,//19
                'programe'=>$program_n,//20
                'batch'=>$batch_intake_n,//21,22   
                'pref_contact_method'=>$pref_contact_method_n,///23
                'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                'user_id'=>$user,
                'company_id'=>$company_id,
                'created_date'=>date("Y-m-d H:i:s")
                
              );
    
              $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
           
                
          
 
         
 
 
  ///////end duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
         }
    }else if($stu_parent_name != "")
    {
        $count_parent_name = $this->class_mod->get_parent_name(trim($stu_parent_name));

        if($count_parent_name == 0)
        {
            if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
                $data_1 = array(
                  'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                  'parent_salutation'=>$p_title_n,//1
                  'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                  'salutation'=>$title_n,//3
                  'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                  'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                  'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                  'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                  'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                  'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                  'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                  'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                  'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                  'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                  'country'=>$country_n,//14
                  'state_pro'=>$province_n,//15
                  'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                  'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                  'contact_method'=>$contacted_method_n,//19
                  'programe'=>$program_n,//20
                  'batch'=>$batch_intake_n,//21,22   
                  'pref_contact_method'=>$pref_contact_method_n,///23
                  'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                  'user_id'=>$user,
                  'company_id'=>$company_id,
                  'created_date'=>date("Y-m-d H:i:s")
                  
                );
        
            //   $this->db->insert('lead_management_pre',$data_1);
            // if($this->db->insert('lead_management_pre',$data_1)){
        
            //     $insert_id = $this->db->insert_id(); 
        
            //     for($k=0; $k<count($lead_source); $k++){
            //         $this->db->insert('lead_inserted_lead_source_pre',
            //          array('l_source' =>$lead_source_n[$k],
            //                'lead_management_pre_tb_id' =>$insert_id));
            //     }
        
        
                
            // }    
            if($this->db->insert('lead_management_pre',$data_1)){
        
                $insert_id = $this->db->insert_id(); 
        
                $get_end_date_pre =$this->class_mod->get_end_date_pre();

                




                // var_dump($get_end_date);
                // die();
                
               
                $lead_id_ab_pre;
                $end_date_pre;


                if($get_end_date_pre != NULL)
                {
                       $end_date_pre=$get_end_date_pre->to_date;
                       $datediff_pre = strtotime($end_date_pre)-strtotime($current_date);

                     
                       
                    
                      
                       $lead_id_ab_pre=$get_lead_id_code_increment_pre->lead_temp_id;


                    //    var_dump($lead_id_ab);
                    //    die();
                       if($datediff_pre / (60 * 60 * 24) > 1){


                           

                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
  
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = $explode_lead_id_pre[3];
                       

                        $number_pre =$number_pre+1;
                        if($number_pre <10){
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;

                        }else{
                            $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/'.$number_pre;

                        }
                       
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);




                       }else{
                         
                        $explode_lead_id_pre = explode("/",$lead_id_ab_pre);
                        $temp_pre=$explode_lead_id_pre[0];
                        $inq_pre= $explode_lead_id_pre[1];
                        $yr_pre=$explode_lead_id_pre[2];
                        $number_pre = 01;

                        $yr_pre=$yr_pre+1;

                       
                        $lead_id_ab_pre = $temp_pre.'/'.$inq_pre.'/'.$yr_pre.'/0'.$number_pre;
                        
                        $selected_pre = array(
                        
                            'lead_temp_id' =>$lead_id_ab_pre,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('lead_management_pre', $selected_pre);


                        $explode_end_date_pre = explode("-",$end_date_pre);
                        // $end_year=$explode_end_date[0]+1;

                        $new_end_year_pre = $explode_end_date_pre[0]+1 .'-'.$explode_end_date_pre[1].'-'.$explode_end_date_pre[2];

                        $selected_end_date_update_pre = array(
                        
                            'to_date' =>$new_end_year_pre,
                             
                        );
                        $this->db->where('id', $get_end_date_pre->finance_tb_id_pre);
                        $this->db->update('finance_inq_num_code_tb_pre', $selected_end_date_update_pre);


                       


                        

                       }

                       




                }else{
                    $lead_id_ab_pre = "TEM/INQ/21/01";
                    $end_date_pre = "2022-03-31";

                    $selected_pre = array(
                        
                        'lead_temp_id' =>$lead_id_ab_pre,
                         
                    );
                    $this->db->where('id', $insert_id);
                    $this->db->update('lead_management_pre', $selected_pre);


                    $selected_end_date_pre = array(
                        
                        'to_date' =>$end_date_pre,
                         
                    );
                 
                    $this->db->insert('finance_inq_num_code_tb_pre', $selected_end_date_pre);

                } 
                // $current_yr = date("Y");
                // //  }
                // // if($insert_id <= 9){
                // // $new_code_id = "INQ/".$current_yr."/0".$insert_id;
                // // }
                // // else{
                // //     $new_code_id = "INQ/".$current_yr."/".$insert_id; 
                // // }
                // if($insert_id <= 9){
                //     $new_code_id_pre = "TEM/INQ/0".$insert_id;
                //     }
                //     else{
                //         $new_code_id_pre = "TEM/INQ/".$insert_id; 
                //     }
        
        
        
                if($insert_id){
                    // $selected_pre = array(
                        
                    //     'lead_temp_id' =>$new_code_id_pre,
                         
                    // );
                    // $this->db->where('id', $insert_id);
                    // $this->db->update('lead_management_pre', $selected_pre);
                
                    
        
        
        
        
                for($k=0; $k<count($lead_source); $k++){
                    $this->db->insert('lead_inserted_lead_source_pre',
                     array('l_source' =>$lead_source_n[$k] ,
                           'lead_management_pre_tb_id' =>$insert_id));
                }
        
            }
        
        
                
            }
        
               
            } 
        }
        else{
            ///////duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
 
 
  
 
            $data_duplicate = array(
                'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
                'parent_salutation'=>$p_title_n,//1
                'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                'salutation'=>$title_n,//3
                'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
                'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
                'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
                'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
                'country'=>$country_n,//14
                'state_pro'=>$province_n,//15
                'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
                'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
                'contact_method'=>$contacted_method_n,//19
                'programe'=>$program_n,//20
                'batch'=>$batch_intake_n,//21,22   
                'pref_contact_method'=>$pref_contact_method_n,///23
                'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
                'user_id'=>$user,
                'company_id'=>$company_id,
                'created_date'=>date("Y-m-d H:i:s")
                
              );
    
              $this->db->insert('lead_management_pre_duplicate',$data_duplicate);
                
          
 
         
 
 
  ///////end duplicate entries/////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////////
 
 
         }
    }
    // if()
    // if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){
    
    //     $data_1 = array(
    //       'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
    //       'parent_salutation'=>$p_title_n,//1
    //       'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
    //       'salutation'=>$title_n,//3
    //       'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
    //       'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
    //       'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
    //       'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
    //       'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
    //       'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
    //       'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
    //       'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
    //       'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
    //       'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
    //       'country'=>$country_n,//14
    //       'state_pro'=>$province_n,//15
    //       'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
    //       'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
    //       'contact_method'=>$contacted_method_n,//19
    //       'programe'=>$program_n,//20
    //       'batch'=>$batch_intake_n,//21,22   
    //       'pref_contact_method'=>$pref_contact_method_n,///23
    //       'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
    //       'user_id'=>$user,
    //       'company_id'=>$company_id,
    //       'created_date'=>date("Y-m-d H:i:s")
          
    //     );

    // //   $this->db->insert('lead_management_pre',$data_1);
    // // if($this->db->insert('lead_management_pre',$data_1)){

    // //     $insert_id = $this->db->insert_id(); 

    // //     for($k=0; $k<count($lead_source); $k++){
    // //         $this->db->insert('lead_inserted_lead_source_pre',
    // //          array('l_source' =>$lead_source_n[$k],
    // //                'lead_management_pre_tb_id' =>$insert_id));
    // //     }


        
    // // }    
    // if($this->db->insert('lead_management_pre',$data_1)){

    //     $insert_id = $this->db->insert_id(); 

       
    //     if($insert_id <= 9){
    //     $new_code_id_pre = "TEM/INQ0".$insert_id;
    //     }
    //     else{
    //         $new_code_id_pre = "TEM/INQ".$insert_id;  
    //     }



    //     if($insert_id){
    //         $selected_pre = array(
                
    //             'lead_temp_id' =>$new_code_id_pre,
                 
    //         );
    //         $this->db->where('id', $insert_id);
    //         $this->db->update('lead_management_pre', $selected_pre);
        
            




    //     for($k=0; $k<count($lead_source); $k++){
    //         $this->db->insert('lead_inserted_lead_source_pre',
    //          array('l_source' =>$lead_source_n[$k] ,
    //                'lead_management_pre_tb_id' =>$insert_id));
    //     }

    // }


        
    // }

       
    // }   
}





////////////////////////////end check lead/////////////////////////////////////////////////////////////////////////




















               
        //       $p_title = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
        //       $title = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        //       $country = $worksheet->getCellByColumnAndRow(14, $row)->getValue(); 
        //       $province = $worksheet->getCellByColumnAndRow(15, $row)->getValue(); 
             
        //       $lead_source = explode(',',($worksheet->getCellByColumnAndRow(18, $row)->getValue()));
            
        //       $contacted_method = $worksheet->getCellByColumnAndRow(19, $row)->getValue(); 
        //       $program = $worksheet->getCellByColumnAndRow(20, $row)->getValue(); 
        //       $batch = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
        //       $intake = $worksheet->getCellByColumnAndRow(22, $row)->getValue();  
        //       $pref_contact_method = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
            
              

        //      $p_title_n = $this->class_mod->get_title(trim($p_title))->id;
        //      $title_n = $this->class_mod->get_title(trim($title))->id;
        //      $country_n = $this->class_mod->get_country(trim($country))->id;
        //      $province_n = $this->class_mod->get_province_pre(trim($province))->id;

        //      $lead_source_n = $this->class_mod->get_l_source(trim($lead_source))->id;

        //      $contacted_method_n = $this->class_mod->get_contacted_method(trim($contacted_method))->id;      
           
        //      $program_n =$this->class_mod->get_program(trim($program))->id;

        //      $batch_intake_n = $this->class_mod->get_batch_intake(trim($batch),trim($intake))->id;
        //      $pref_contact_method_n = $this->class_mod->get_contacted_method(trim($pref_contact_method))->id; 
              
           
        //      if($worksheet->getCellByColumnAndRow(0, $row)->getValue()!=null){

        //       $data_1 = array(
        //         'inq_by'=>$worksheet->getCellByColumnAndRow(0, $row)->getValue(),
        //         'parent_salutation'=>$p_title_n,//1
        //         'parent_name' =>$worksheet->getCellByColumnAndRow(2, $row)->getValue(),
        //         'salutation'=>$title_n,//3
        //         'f_name'=> $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
        //         'mid_name'=>$worksheet->getCellByColumnAndRow(5, $row)->getValue(),
        //         'l_name'=>$worksheet->getCellByColumnAndRow(6, $row)->getValue(),
        //         'l_phone'=>$worksheet->getCellByColumnAndRow(7, $row)->getValue(),
        //         'l_phone_2'=>$worksheet->getCellByColumnAndRow(8, $row)->getValue(),
        //         'nic_div'=>$worksheet->getCellByColumnAndRow(9, $row)->getValue(),
        //         'passport_div'=>$worksheet->getCellByColumnAndRow(10, $row)->getValue(),
        //         'l_email'=>$worksheet->getCellByColumnAndRow(11, $row)->getValue(),
        //         'address1'=>$worksheet->getCellByColumnAndRow(12, $row)->getValue(),
        //         'address2'=>$worksheet->getCellByColumnAndRow(13, $row)->getValue(),
        //         'country'=>$country_n,//14
        //         'state_pro'=>$province_n,//15
        //         'city'=>$worksheet->getCellByColumnAndRow(16, $row)->getValue(),
        //         'zip_pos'=>$worksheet->getCellByColumnAndRow(17, $row)->getValue(),//lead_source-18
        //         'contact_method'=>$contacted_method_n,//19
        //         'programe'=>$program_n,//20
        //         'batch'=>$batch_intake_n,//21,22   
        //         'pref_contact_method'=>$pref_contact_method_n,///23
        //         'con_box'=>$worksheet->getCellByColumnAndRow(24, $row)->getValue(),
        //         'created_date'=>date("Y-m-d H:i:s")
                
        //       );

        //     $this->db->insert('lead_management_pre',$data_1);


                 


             
        //   }
        

        


          $i++; 
          
        }
      }
   
      echo ' Data Imported successfully';
    } 
  }


function bulk_lead_tranfer_table()
{

    $val=$this->input->post();
       
       
    
    // $data['pre_lead_transfer']=$this->class_mod->get_pre_lead_data();
   
    
    
    // $data['transLead_data']=$this->class_mod->get_TransLead_data($lead_owner,$course,$trans_l_status);
    $this->load->view('pre_lead_transfer_tb',$data);
        // $this->load->view('validated_stu_excel',$data);
    
}




//bulk lead tranfer

function bulk_transfer(){


$val=$this->input->post();

$check_box = $val['std_check'];


// var_dump($check_box);
// die();
// $coun = $val['assign_coun'];
 


 

$this->form_validation->set_rules("assign_coun","Counsellor","trim|required");



// $this->form_validation->set_rules("std_check","Select One More Leads","trim|required");




    if($this->form_validation->run() == false){



        $data=array();
        $data["error"]=array();
        $data["input_error"]=array();
        $data["status"]=FALSE;


                if(form_error("assign_coun")){

                $data["input_error"][] ="assign_coun";
                $data["error_string"][]=form_error("assign_coun");
                }

                echo json_encode($data);
                exit();



    }else{





            foreach($val['Lead_management_pre_id'] as $key => $val1){

                if (in_array($val['Lead_management_pre_id'][$key], $val['std_check'])) {


                    $pre_lead = array(
                            
                        'lead_owner'=>$val['assign_coun'],
                        'bulk_assign_date'=>$val['assign_date'],
                        'lead_status'=>'Assigned',

                    );
                $this->db->where('id',$val['Lead_management_pre_id'][$key]);  
                
                            if($this->db->update('lead_management_pre',$pre_lead)){
                                
                                // echo json_encode(array('status'=>TRUE,'message'=>'Transfered Successfully!!'));
                            }
                            else{
                                echo "Faild";
                            }               
                }    
            } 


            echo json_encode(array('status'=>TRUE,'message'=>'Counsellor Assigned Successfully!!'));

    }
 }





 public function get_pre_data_bulk($id){   
       
    //$where1="id=".$id;
    // var_dump($id);
    // die();
       
    $pre_data_bulk = $this->class_mod->get_prev_data_bulk($id);  
             
    //$pre_data=$this->kcrud->getValueOne("lead_management","*",$where1,null,null,null,null);
    // $programs = $this->class_mod->get_programs($id);

    // $get_inserted_other_pro = $this->class_mod->get_inserted_other_pro($id);
    $get_inserted_l_source_pre = $this->class_mod->get_inserted_l_source_pre($id);
    // var_dump($get_inserted_other_pro);
    // die();
    echo json_encode(array('pre_data_bulk'=>$pre_data_bulk,'get_inserted_l_source_pre'=>$get_inserted_l_source_pre));

}


public function get_lead_data($get_lead_tb_id){
    $lead_data = $this->class_mod->get_lead_data($get_lead_tb_id);  

    // var_dump($lead_data);
    // die();
    echo json_encode(array('lead_data'=>$lead_data));


}



public function get_course_data()
{
    $course_data = $this->class_mod->get_course_data(); 
    echo json_encode(array('course_data'=>$course_data));

}



public function save_target_inatake()
{

    
$val=$this->input->post();

 $user = USER_ID;
 $company = COMPANY_ID;
 $current_date = date('Y-m-d');
 $currentDateTime = date('Y-m-d H:i:s');

 $year1 = $val['targ_yr1'];
 $year2 = $val['targ_yr2'];
 $yr1_start = $year1.'-04-01';
 $yr2_end = $year2.'-03-31';
 
 
 $course = $val['targ_course'];

  


 $count=$this->class_mod->check_target_lead($year1,$year2,$course);

 if($year1 != "" && $year2 != "" && $course != "")
 {
        if($count ==0)
        {
                 
            
        $target = array(
            'from_year' =>$val['targ_yr1'],
            'to_year' =>$val['targ_yr2'],
            'from_date' =>$yr1_start,
            'to_date' =>$yr2_end,
            'program'=>$val['targ_course'],
            'user'=>$user,
            'company'=>$company,
            'create_at' =>$current_date,
            'create_at_dt_time' =>$currentDateTime
            
        );
      
        
            

            if($this->db->insert("asms_lead_target",$target))
            {
                $insert_id = $this->db->insert_id(); 

                foreach($val['m_new_id'] as $key =>$value)
               {                   
                
                    $target2 = array(
                        'lead_target_tb_id' =>$insert_id,
                        'batch_id'=>$val['m_new_id'][$key],
                        'target'=>$val['target'][$key],
                     
                        
                        // 'total'=>$marks['total'],
                        // 'avg'=>$marks['avg'],
                        // 'grade'=>$marks['grade'],

                    );

                    // $this->db->insert("asms_lead_target_intakes",$target2);
                    if( $this->db->insert("asms_lead_target_intakes",$target2))
                    {



                        $pr_id = $this->lead_target_intake($insert_id);
             


                    
                        if (isset($pr_id)) {
                            $feedback = '';
                            foreach ($pr_id as $key => $value) {
                                if (!empty($pr_id[$key])) {
                
                                   //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                                    //$feedback = $feedback.' '.$pr_id[$key];
                                    $feedback = $feedback.' ('.$pr_id[$key]->code.')'.$pr_id[$key]->year.'-'.$pr_id[$key]->intake_name.'=>'.$pr_id[$key]->target.'  ,  ';
                                }
                            }
                            $dddd=date('Y-m-d H:i');
                            $feedback = $feedback;
                             
                
                        }






                        $target3 = array(
                        
                            'history' =>$feedback,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('asms_lead_target', $target3);
                    }




                                 
                
                }
                
                


                echo json_encode(array('status' => true, 'message' => 'Inserted Successfully'));
            }




        }else{
            echo json_encode(array('status' => false, 'message' => 'Already Have Targets Under This Year & Program'));
        }
 }







            
 
    

}





public function edit_target_inatake()

{

        
$val=$this->input->post();

$user = USER_ID;
$company = COMPANY_ID;
$current_date = date('Y-m-d');
$currentDateTime = date('Y-m-d H:i:s');

$year1 = $val['edit_targ_yr1'];
$year2 = $val['edit_targ_yr2'];
$yr1_start = $year1.'-04-01';
$yr2_end = $year2.'-03-31';


$course = $val['edit_targ_course'];
$id_data= $val['edit_id_data'];

 

$this->db->where('lead_target_tb_id', $id_data);
// $this->db->delete('asms_lead_target_intakes');


if($this->db->delete('asms_lead_target_intakes'))
{
    


            foreach($val['edit_new_id'] as $key =>$value)
            {                   
            
                $target2 = array(
                    'lead_target_tb_id' =>$id_data,
                    'batch_id'=>$val['edit_new_id'][$key],
                    'target'=>$val['edit_target'][$key],
                
                    
                    // 'total'=>$marks['total'],
                    // 'avg'=>$marks['avg'],
                    // 'grade'=>$marks['grade'],

                );

                // $this->db->insert("asms_lead_target_intakes",$target2);
                if( $this->db->insert("asms_lead_target_intakes",$target2))
                {



                    $pr_id = $this->lead_target_intake($id_data);
        


                
                    if (isset($pr_id)) {
                        $feedback = '';
                        foreach ($pr_id as $key => $value) {
                            if (!empty($pr_id[$key])) {
            
                                //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                                //$feedback = $feedback.' '.$pr_id[$key];
                                $feedback = $feedback.' ('.$pr_id[$key]->code.')'.$pr_id[$key]->year.'-'.$pr_id[$key]->intake_name.'=>'.$pr_id[$key]->target.'  ,  ';
                            }
                        }
                        $dddd=date('Y-m-d H:i');
                        $feedback = $feedback;
                        
            
                    }






                    $target3 = array(
                    
                        'history' =>$feedback,
                        
                    );
                    $this->db->where('id', $id_data);
                    $this->db->update('asms_lead_target', $target3);
                }





        }


        echo json_encode(array('status' => true, 'message' => 'Updated Successfully'));

        }
else{
    echo json_encode(array('status' => false, 'message' => 'Update Fail'));
}

}



public function lead_target_intake($insert_id){
    $this->db->select('asms_m_batch_intakes.year,asms_m_programs.code,asms_m_intakes_list.intake_name,asms_lead_target_intakes.target,asms_lead_target_intakes.batch_id');
    $this->db->from('asms_lead_target_intakes');
    $this->db->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_lead_target_intakes.batch_id');
    $this->db->join('asms_m_batches','asms_m_batches.id=asms_m_batch_intakes.batch_id');
    $this->db->join('asms_m_programs','asms_m_programs.id=asms_m_batches.program_id');
    $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id');
    $this->db->where('asms_lead_target_intakes.lead_target_tb_id', $insert_id);
    $q = $this->db->get();
    return $q->result(); 
}


public function lead_target_intake_monthly($insert_id)
{

 
    $this->db->select('asms_lead_target_intakes_monthly.month,asms_lead_target_intakes_monthly.sub_target');
    $this->db->from('asms_lead_target_intakes_monthly');
    $this->db->where('asms_lead_target_intakes_monthly.lead_target_monthly_tb_id', $insert_id);
    $q = $this->db->get();
    return $q->result();
}
public function intake_target_tb()
{
    $this->load->library('datatables');   

    $this->datatables->select("
    asms_lead_target.id as target_tb_id,
    
    CONCAT( asms_lead_target.from_year,' (',asms_lead_target.from_date,')') as from_year,
    CONCAT( asms_lead_target.to_year,' (',asms_lead_target.to_date,')') as to_year,
    asms_m_programs.name as cname,
    asms_lead_target.history
    ",FALSE);

    $this->datatables->from('asms_lead_target');
    $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_lead_target.program');
    // $this->datatables->unset_column('target_tb_id');
   
    $this->datatables->add_column("Actions","
                    <a href='javascript:;' onclick='edit_Targets(" . '$1' . ")'><i class='fa fa-pencil' title='Edit targets'></i></a>&nbsp;
                    <a href='javascript:;' onclick='edit_monthly_Targets(" . '$1' . ")'><i class='fa fa-plus' title='Add monthly Targets'></i></a>&nbsp;","target_tb_id");
 
    echo $this->datatables->generate();

}

public function get_stu_commission()
{
    $this->load->library('datatables');   

    $this->datatables->select("
    lead_past_stu_commission.id as stu_com_tb_id,
    asms_m_program_type.name as c_type,
    lead_past_stu_commission.currency,
    lead_past_stu_commission.commission,
    lead_past_stu_commission.created_at
    ",FALSE);

    $this->datatables->from(' lead_past_stu_commission');
    $this->datatables->join('asms_m_program_type','asms_m_program_type.id=lead_past_stu_commission.course_type');
    // $this->datatables->unset_column('target_tb_id');
   
    $this->datatables->add_column("Actions","
                    <a href='javascript:;' onclick='edit_commission(" . '$1' . ")'><i class='fa fa-pencil' title='Edit'></i></a>&nbsp;
                    <a href='javascript:;' onclick='delete_commission(" . '$1' . ")'><i class='fa fa-trash' title='Delete'></i></a>&nbsp;","stu_com_tb_id");
 
    echo $this->datatables->generate();
}


public function intake_target_tb_monthly()
{
    $this->load->library('datatables');   

    $this->datatables->select("
    asms_lead_target_monthly.id as target_tb_id,
    
    CONCAT( asms_lead_target_monthly.finance_from,' (',asms_lead_target_monthly.finance_from_date,')') as from_year,
    CONCAT( asms_lead_target_monthly.finance_to,' (',asms_lead_target_monthly.finance_to_date,')') as to_year,
    asms_m_programs.name as cname,
    CONCAT('(',asms_m_programs.code,')',asms_m_batch_intakes.year,'-',asms_m_intakes_list.intake_name) as batch,
    asms_lead_target_monthly.history

    ",FALSE);

    $this->datatables->from('asms_lead_target_monthly');
    $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_lead_target_monthly.program');
    // $this->datatables->unset_column('target_tb_id');
    $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_lead_target_monthly.batch');
    $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_m_batch_intakes.batch_id');
    $this->datatables->join('asms_m_programs as bt_code','bt_code.id=asms_m_batches.program_id');
    $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id');
   
    $this->datatables->add_column("Actions","
                    <a href='javascript:;' onclick='edit_mon_Targets(" . '$1' . ")'><i class='fa fa-pencil' title='Edit Monthly Targets'></i></a>&nbsp;
                     ","target_tb_id");
 
    echo $this->datatables->generate();
}




public function get_traget_data_to_edit($id){   
       
    //$where1="id=".$id;
    
    $target_intake_data = $this->class_mod->get_traget_data_to_edit($id);  

    
    
             
   
    $yr_program = $this->get_yr_program($id);
     
    
    $get_all_batch_by_year_program = $this->class_mod->get_all_batch_by_year_program($yr_program->from_year,$yr_program->to_year,$yr_program->program);  



    
    echo json_encode(array('target_intake_data'=>$target_intake_data,'get_all_batch_by_year_program'=>$get_all_batch_by_year_program,'yr_program'=>$yr_program));

}


public function get_monthly_traget_data_to_edit($id)
{

   
    
    // $target_mon_intake_data = $this->class_mod->get_target_mon_intake_data($id);  

    
    
    // var_dump($target_mon_intake_data);
    // die();
   
    $monthly_target_data = $this->get_monthly_target_data($id);
    
    $target_data_mon=$this->class_mod->get_target_data_mon($id);
    
    // $get_all_batch_by_year_program = $this->class_mod->get_all_batch_by_year_program($yr_program->from_year,$yr_program->to_year,$yr_program->program);  



    
    echo json_encode(array('target_data_mon'=>$target_data_mon,'monthly_target_data'=>$monthly_target_data));

}


public function get_bulk_duplicate_data()
{
    $duplicate_bulk=$this->class_mod->get_duplicate_bulk();
    // $get_batches = $this->class_mod->get_batches($yr_program->year,$yr_program->program);
    echo json_encode(array('duplicate_bulk'=>$duplicate_bulk));
}
public function get_monthly_traget_data($id)
{
    $yr_program = $this->get_yr_program($id);
    // $get_batches = $this->class_mod->get_batches($yr_program->year,$yr_program->program);
    echo json_encode(array('yr_program'=>$yr_program,'get_batches'=>$get_batches));

}

public function get_batches_monthly()
{

    $val=$this->input->post();


 $year1 = $val['year1'];
 $year2 = $val['year2'];
 $course = $val['select_course'];

//  var_dump($year,$course);
//  die();
$yr1_start = $year1.'-04-01';
$yr2_end = $year2.'-03-31';
// $batch_yr=$this->class_mod->get_batch_by_course_yr($program_id,$yr1_start,$yr2_end);


    $get_batches = $this->class_mod->get_batches($year1,$year2,$course);

    echo json_encode(array('get_batches'=>$get_batches));   
}
























public function get_yr_program($id)
{

    $this->db->select('asms_lead_target.from_date,asms_lead_target.to_date,asms_lead_target.id,asms_lead_target.from_year,asms_lead_target.to_year,asms_lead_target.program,asms_m_programs.name as cname');
    $this->db->from('asms_lead_target');
    $this->db->join('asms_m_programs','asms_m_programs.id=asms_lead_target.program');
    $this->db->where('asms_lead_target.id', $id);
    $q = $this->db->get();
    return $q->row();
}


public function get_monthly_target_data($id)
{
    $this->db->select('asms_lead_target_monthly.*,asms_m_batch_intakes.close_date,asms_m_programs.name as cname,bat.code as ccode,asms_m_intakes_list.intake_name,asms_m_batch_intakes.year');
    $this->db->from('asms_lead_target_monthly');
    $this->db->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_lead_target_monthly.batch');
    $this->db->join('asms_m_programs','asms_m_programs.id=asms_lead_target_monthly.program');
    $this->db->join('asms_m_batches','asms_m_batches.id=asms_m_batch_intakes.batch_id');
    $this->db->join('asms_m_programs as bat','bat.id=asms_m_batches.program_id');
    $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id');
    $this->db->where('asms_lead_target_monthly.id', $id);

    $q = $this->db->get();
    return $q->row();
}
///////////////////////////////////delete pre lead-----------------------//////////////////////////////



public function delete_pre_lead()
    {
         $id=$this->input->post('id');
         $this->db->where('id', $id); 
         if($this->db->delete('lead_management_pre')){
             $this->db->where('lead_management_pre_tb_id', $id); 
             if($this->db->delete('lead_inserted_lead_source_pre')){
                //    echo json_encode (array('message' => 'Pre Lead Record Deleted successfully!'));
                   echo json_encode(array('status' => true, 'message' => 'Pre Lead Record Deleted successfully!'));
             }else{
                echo json_encode(array('status' => false, 'message' => 'Pre Lead Deletion Failed!'));
                //    echo json_encode (array('message' => 'Pre Lead Deletion Failed!'));
             }    
         }                  
    }
    


public function delete_org_lead()
{
    $id=$this->input->post('id');
    $this->db->where('id', $id); 
    if($this->db->delete('lead_management')){
        $this->db->where('lead_management_tb_id', $id); 
        if($this->db->delete('lead_inserted_lead_source')){
            $this->db->where('lead_management_tb_id', $id); 
            $this->db->delete('lead_inserted_other_inter_programs');
           //    echo json_encode (array('message' => 'Pre Lead Record Deleted successfully!'));
              echo json_encode(array('status' => true, 'message' => 'Lead Record Deleted successfully!'));
        }else{
           echo json_encode(array('status' => false, 'message' => 'Lead Deletion Failed!'));
           //    echo json_encode (array('message' => 'Pre Lead Deletion Failed!'));
        }    
    } 
    
}
    
public function save_monthly_target()
{
    $val=$this->input->post();


    $user = USER_ID;
    $company = COMPANY_ID;
    $current_date = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');

    $year1 = $val['monthly_targ_yr1'];
    $year2 = $val['monthly_targ_yr2'];
    $course_id = $val['program_id'];
    $batch = $val['monthly_targ_batch'];
    $tot_target = $val['total_targets'];
    $from_date = $val['from_date'];
    $to_date = $val['to_date'];
    

    $yr1_start = $year1.'-04-01';
$yr2_end = $year2.'-03-31';


$count_mon = $this->class_mod->check_monthly_target_lead($year1,$year2,$course_id,$batch);

 
    if($count_mon == 0)
    {



        $mon_target = array(
            'finance_from' =>$val['monthly_targ_yr1'],
            'finance_to' =>$val['monthly_targ_yr2'],
            'finance_from_date' =>$yr1_start,
            'finance_to_date' =>$yr2_end,
            'program'=>$val['program_id'],
            'batch'=>$val['monthly_targ_batch'],
            'total_target'=>$val['total_targets'],
            'tar_set_start_date'=>$val['from_date'],
            'tar_set_final_date'=>$val['to_date'],
            'user'=>$user,
            'company'=>$company,
            'create_at' =>$current_date,
            'create_at_dt_time' =>$currentDateTime
            
        );
        
        
            
        
            if($this->db->insert("asms_lead_target_monthly",$mon_target))
            {
                $insert_id = $this->db->insert_id(); 
        
                foreach($val['mon'] as $key =>$value)
               {                   
                
                    $mon_target2 = array(
                        'lead_target_monthly_tb_id' =>$insert_id,
                        'month'=>$val['mon'][$key],
                        'sub_target'=>$val['monthly_target'][$key],
                     
                        
                        // 'total'=>$marks['total'],
                        // 'avg'=>$marks['avg'],
                        // 'grade'=>$marks['grade'],
        
                    );
        
                    // $this->db->insert("asms_lead_target_intakes_monthly",$mon_target2);


                    if($this->db->insert("asms_lead_target_intakes_monthly",$mon_target2))
                    {
                        $pr_id_mon = $this->lead_target_intake_monthly($insert_id);
             


                    
                        if (isset($pr_id_mon)) {
                            $feedback = '';
                            foreach ($pr_id_mon as $key => $value) {
                                if (!empty($pr_id_mon[$key])) {
                
                                   //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                                    //$feedback = $feedback.' '.$pr_id[$key];
                                    $feedback = $feedback.' '.$pr_id_mon[$key]->month.'=>'.$pr_id_mon[$key]->sub_target.'  ,  ';
                                }
                            }
                            $dddd=date('Y-m-d H:i');
                            $feedback = $feedback;
                             
                
                        }






                        $target4 = array(
                        
                            'history' =>$feedback,
                             
                        );
                        $this->db->where('id', $insert_id);
                        $this->db->update('asms_lead_target_monthly', $target4);
                    }
 
                }
                
                
        
        
                echo json_encode(array('status' => true, 'message' => 'Inserted Successfully'));
            }
        
        



    }else{
        echo json_encode(array('status' => false, 'message' => 'Already Have Targets Under This Year,Program & Batch'));
    }
 




    
// $count1=$this->class_mod->check_monthly_target_lead($year1,$year2,$course_id);




    
    
}


public function update_monthly_target()
{
    $val=$this->input->post();


    $user = USER_ID;
    $company = COMPANY_ID;
    $current_date = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');

    $year1 = $val['monthly_targ_yr1'];
    $year2 = $val['monthly_targ_yr2'];
    $course_id = $val['program_id'];
    $batch = $val['monthly_targ_batch'];
    $tot_target = $val['total_targets'];
    $from_date = $val['from_date'];
    $to_date = $val['to_date'];
    

    $edit_id =$val['edit_mon_id'];

    $yr1_start = $year1.'-04-01';
$yr2_end = $year2.'-03-31';


// $count_mon = $this->class_mod->check_monthly_target_lead($year1,$year2,$course_id,$batch);

 
//     if($count_mon == 0)
//     {

    $this->db->where('lead_target_monthly_tb_id', $edit_id);
// $this->db->delete('asms_lead_target_intakes');


if($this->db->delete('asms_lead_target_intakes_monthly'))


{ 
        
        
            
        
        
            //     $insert_id = $this->db->insert_id(); 
        
                foreach($val['edit_mon'] as $key =>$value)
               {                   
                
                    $mon_target2 = array(
                        'lead_target_monthly_tb_id' =>$edit_id,
                        'month'=>$val['edit_mon'][$key],
                        'sub_target'=>$val['edit_monthly_target'][$key],
                     
                        
                        // 'total'=>$marks['total'],
                        // 'avg'=>$marks['avg'],
                        // 'grade'=>$marks['grade'],
        
                    );
        
                    // $this->db->insert("asms_lead_target_intakes_monthly",$mon_target2);


                    if($this->db->insert("asms_lead_target_intakes_monthly",$mon_target2))
                    {
                        $pr_id_mon = $this->lead_target_intake_monthly($edit_id);
             


                    
                        if (isset($pr_id_mon)) {
                            $feedback = '';
                            foreach ($pr_id_mon as $key => $value) {
                                if (!empty($pr_id_mon[$key])) {
                
                                   //echo $d_arr->id.' '.$pr_id[$key].'</br>';
                                    //$feedback = $feedback.' '.$pr_id[$key];
                                    $feedback = $feedback.' '.$pr_id_mon[$key]->month.'=>'.$pr_id_mon[$key]->sub_target.'  ,  ';
                                }
                            }
                            $dddd=date('Y-m-d H:i');
                            $feedback = $feedback;
                             
                
                        }






                        $target4 = array(
                        
                            'history' =>$feedback,
                            'tar_set_final_date'=>$val['edit_to_date'],
                             
                        );
                        $this->db->where('id', $edit_id);
                        $this->db->update('asms_lead_target_monthly', $target4);
                    }
 
                }
                
                
        
        
                echo json_encode(array('status' => true, 'message' => 'Inserted Successfully'));
            // }
        
        



    // }else{
    //     echo json_encode(array('status' => false, 'message' => 'Already Have Targets Under This Year,Program & Batch'));
    // }
 



    }
    
// $count1=$this->class_mod->check_monthly_target_lead($year1,$year2,$course_id);



}

public function add_lead_code()
{
    $val=$this->input->post();

 

    $lead_id = $val['lead_id'];
  
    
    $lead_id_code_update = $this->agent_mod->get_lead_id_code_update($lead_id); 
    
    // var_dump($lead_id_code_update);
    // die();
     
    echo json_encode(array('lead_id_code_update'=>$lead_id_code_update));  

}









/////////////////////////////////////////////insert commissionn--------///////////////////////////////////////


public function save_stu_commission($method_com)
{


    $val=$this->input->post();

    $stu_course_type = $val['stu_course_type'];
    $user = USER_ID;
    $company = COMPANY_ID;
    $current_date = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');

//    var_dump($method_com, $stu_course_type);
//    die();
     
    
    
if($method_com == "add"){

    
    $this->form_validation->set_rules("stu_course_type","Course Type","trim|required");
    $this->form_validation->set_rules("stu_currency","Currency","trim|required");
    $this->form_validation->set_rules("stu_comm","Commission","trim|required");
    
    
    // $this->form_validation->set_rules("std_check","Select One More Leads","trim|required");
    
    
    
    
        if($this->form_validation->run() == false){
    
    
    
            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;
    
    
                    if(form_error("stu_course_type")){
    
                    $data["input_error"][] ="stu_course_type";
                    $data["error_string"][]=form_error("stu_course_type");
                    }
                    if(form_error("stu_currency")){
    
                        $data["input_error"][] ="stu_currency";
                        $data["error_string"][]=form_error("stu_currency");
                    }
                    if(form_error("stu_comm")){
    
                        $data["input_error"][] ="stu_comm";
                        $data["error_string"][]=form_error("stu_comm");
                    }
    
                    echo json_encode($data);
                    exit();
    
    
    
        }else{



           


                
            $count =  $this->class_mod->get_course_count($stu_course_type); 

                        if($count == 0){


                            $stu_com = array(
                                'course_type' =>$val['stu_course_type'],
                                'currency' =>$val['stu_currency'],
                                'commission' =>$val['stu_comm'],
                                'user_id'=>$user,
                                'company_id'=>$company,
                                'created_at' =>$current_date,
                                'create_at_dt_time' =>$currentDateTime
                                
                            );
                            
                            
                                
                            
                                if($this->db->insert("lead_past_stu_commission",$stu_com)){
                                    echo json_encode(array('status' => true, 'message' => 'Inserted Successfully'));
                                }else{
                                    echo json_encode(array('status' => false, 'message' => 'Sorry, Commission Inserted Was Not Successfully'));
                                }




                        }else{
                            echo json_encode(array('status' => false, 'message' => 'Already Have Commissions under this Course Type'));
                        }
                    }
    
            }else{



                // $this->form_validation->set_rules("stu_course_type","Course Type","trim|required");
    $this->form_validation->set_rules("stu_currency","Currency","trim|required");
    $this->form_validation->set_rules("stu_comm","Commission","trim|required");
    
    
    // $this->form_validation->set_rules("std_check","Select One More Leads","trim|required");
    
    
    
    
        if($this->form_validation->run() == false){
    
    
    
            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;
    
    
                    // if(form_error("stu_course_type")){
    
                    // $data["input_error"][] ="stu_course_type";
                    // $data["error_string"][]=form_error("stu_course_type");
                    // }
                    if(form_error("stu_currency")){
    
                        $data["input_error"][] ="stu_currency";
                        $data["error_string"][]=form_error("stu_currency");
                    }
                    if(form_error("stu_comm")){
    
                        $data["input_error"][] ="stu_comm";
                        $data["error_string"][]=form_error("stu_comm");
                    }
    
                    echo json_encode($data);
                    exit();
    
    
    
        }else{





                // $count2 =  $this->class_mod->get_course_count($stu_course_type); 
                   
                // if($count2 == 0){


                    $stu_com_edit = array(
                        'currency' =>$val['stu_currency'],
                        'commission' =>$val['stu_comm'],
                        'user_id'=>$user,
                        'company_id'=>$company,
                        'created_at' =>$current_date,
                        'create_at_dt_time' =>$currentDateTime
                        
                    );
                    
                    
                        
                    $this->db->where("id",$val['update_stu_com_id']);
                        if($this->db->update("lead_past_stu_commission",$stu_com_edit)){
                            echo json_encode(array('status' => true, 'message' => 'Updated Successfully'));
                        }else{
                            echo json_encode(array('status' => false, 'message' => 'Sorry, Commission Updated Was Not Successfully'));
                        }




                // }else{
                //     echo json_encode(array('status' => false, 'message' => 'Already Have Commissions under this Course Type'));
                // }
                
            }



    
        }








}


//edit student commission//////////////////



public function get_pre_stu_comm_data($id){   
       
    //$where1="id=".$id;
       
    $stu_comission_data = $this->class_mod->get_stu_comission_data($id);  
             
    // //$pre_data=$this->kcrud->getValueOne("lead_management","*",$where1,null,null,null,null);
    // $programs = $this->class_mod->get_programs($id);

    // $get_inserted_other_pro = $this->class_mod->get_inserted_other_pro($id);
    // $get_inserted_l_source = $this->class_mod->get_inserted_l_source($id);
    // // var_dump($get_inserted_other_pro);
    // // die();
    echo json_encode(array('stu_comission_data'=>$stu_comission_data));

}


//////////////delete student commission//////////////////////



public function delete_stu_comm()
    {
         $id=$this->input->post('id');
         $this->db->where('id', $id); 
         if($this->db->delete('lead_past_stu_commission'))
        {
            
             
                //    echo json_encode (array('message' => 'Pre Lead Record Deleted successfully!'));
                   echo json_encode(array('status' => true, 'message' => 'Record Deleted successfully!'));
        }else{
                echo json_encode(array('status' => false, 'message' => 'Deletion Failed!'));
                //    echo json_encode (array('message' => 'Pre Lead Deletion Failed!'));
        }    
                          
    }



 //////////////////////////////////insert education agent company//////////////////////////////////////////////



 public function save_edu_agent_company($method_edu_com)
 {


    $val=$this->input->post();

    // $stu_course_type = $val['stu_course_type'];
    $edu_agent_com_email=$val['com_email'];
    $edu_agent_com_phone=$val['com_phone'];
    $country = $val['com_country'];
    $user = USER_ID;
    $company = COMPANY_ID;
    $current_date = date('Y-m-d');
    $currentDateTime = date('Y-m-d H:i:s');
    $current_yr = date('Y');

//    var_dump($method_com, $stu_course_type);
//    die();
     
    
    


    
    $this->form_validation->set_rules("com_name","Company Name","trim|required");
    $this->form_validation->set_rules("com_email","Company Email ID","required|valid_email");
    $this->form_validation->set_rules("com_phone","Company Contact Number","trim|required");
    $this->form_validation->set_rules("com_add1","Address1","trim|required");
    $this->form_validation->set_rules("com_country","Country","trim|required");
    if($country == '200'){
        $this->form_validation->set_rules("com_province","Province","trim|required");
    }

    
    $this->form_validation->set_rules("com_city","City","trim|required");
    $this->form_validation->set_rules("com_currency","Currency","trim|required");
    // $this->form_validation->set_rules("std_check","Select One More Leads","trim|required");
    
    
    
    if($this->form_validation->run() == false){
    
    
    
            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;
    
    
                    if(form_error("com_name")){
    
                    $data["input_error"][] ="com_name";
                    $data["error_string"][]=form_error("com_name");
                    }
                    if(form_error("com_email")){
    
                        $data["input_error"][] ="com_email";
                        $data["error_string"][]=form_error("com_email");
                    }
                    if(form_error("com_phone")){
    
                        $data["input_error"][] ="com_phone";
                        $data["error_string"][]=form_error("com_phone");
                    }

                    if(form_error("com_add1")){
    
                        $data["input_error"][] ="com_add1";
                        $data["error_string"][]=form_error("com_add1");
                        }
                        if(form_error("com_country")){
        
                            $data["input_error"][] ="com_country";
                            $data["error_string"][]=form_error("com_country");
                        }
                        if(form_error("com_province")){
        
                            $data["input_error"][] ="com_province";
                            $data["error_string"][]=form_error("com_province");
                        }
                        if(form_error("com_city")){
        
                            $data["input_error"][] ="com_city";
                            $data["error_string"][]=form_error("com_city");
                        }
                        if(form_error("com_currency")){
        
                            $data["input_error"][] ="com_currency";
                            $data["error_string"][]=form_error("com_currency");
                        }
                        
    
                    echo json_encode($data);
                    exit();
    
    
    
}else{



        if($method_edu_com == "add"){
            $count_agent2 =  $this->class_mod->get_count_agent2($edu_agent_com_email); 
            $count_agent3 =  $this->class_mod->get_count_agent3($edu_agent_com_phone); 

                        if($count_agent2 == 0 &&  $count_agent2==0){

                            $edu_agent_com = array(
                                'company_name' =>$val['com_name'],
                                'company_contact_number' =>$val['com_phone'],
                                'company_email_id' =>$val['com_email'],
                                'company_add1' =>$val['com_add1'],
                                'company_add2' =>$val['com_add2'],
                                'company_country' =>$val['com_country'],
                                'company_pro' =>$val['com_province'],
                                'company_city' =>$val['com_city'],
                                'company_curren' =>$val['com_currency'],    
                                'user_id'=>$user,
                                'company_id'=>$company,
                                'created_at' =>$current_date,
                                'create_at_dt_time' =>$currentDateTime
                                
                            );
                            


                            
                                
                            
                                $this->db->insert("asms_education_agent_company",$edu_agent_com);
                                    $insert_id_agent = $this->db->insert_id(); 

                                        if($insert_id_agent <= 9){
                                        $new_ag_con_id = "EAC/".$current_yr."/0".$insert_id_agent;
                                        }
                                        else{
                                            $new_ag_con_id = "EAC/".$current_yr."/".$insert_id_agent;
                                        }
                                        // if($insert_id){
                                        //     $selected = array(
                                        //         'lead_management_id' =>$insert_id,
                                        //         'lead_id_code' =>$new_code_id,
                                                 
                                        //     );
                            
                                        //     $this->db->insert("lead_id_table",$selected);
                                          
                                            
                                                
                            
                            
                                        // }
                                        
                         
                                            $selected_ag_com = array(
                                                
                                                'agent_com_code' =>$new_ag_con_id,
                                                 
                                            );
                                            $this->db->where('id', $insert_id_agent);
                                if($this->db->update('asms_education_agent_company', $selected_ag_com)){
                                           

                                    

                                    foreach($val['course_type_id'] as $key =>$value)
                                   {                   
                                    
                                        $edu_agent_com2 = array(
                                            'asms_education_agent_company_id' =>$insert_id_agent,
                                            'company_course_type'=>$val['course_type_id'][$key],
                                            'company_commission'=>$val['comm'][$key],
                                        );
                     
                                                      
                                        $this->db->insert("asms_education_agent_company_commission",$edu_agent_com2);

                                    }
                                   




                                    echo json_encode(array('status' => true, 'message' => 'Inserted Successfully'));
                                }else{
                                    echo json_encode(array('status' => false, 'message' => 'Sorry, Education Agent company Inserted Was Not Successfully'));
                                }

                            }else{

                                echo json_encode(array('status' => false, 'message' => 'Already Have This Education Agent company'));

                        }
                        
        }else{


                        $count_agent4 =  $this->class_mod->get_count_agent4($val['update_edu_agent_com_id'],$edu_agent_com_email); 
                        $count_agent5 =  $this->class_mod->get_count_agent5($val['update_edu_agent_com_id'],$edu_agent_com_phone); 
            
                                    if($count_agent4 == 0 &&  $count_agent5==0){
            
                                        $edu_agent_com = array(
                                            'company_name' =>$val['com_name'],
                                            'company_contact_number' =>$val['com_phone'],
                                            'company_email_id' =>$val['com_email'],
                                            'company_add1' =>$val['com_add1'],
                                            'company_add2' =>$val['com_add2'],
                                            'company_country' =>$val['com_country'],
                                            'company_pro' =>$val['com_province'],
                                            'company_city' =>$val['com_city'],
                                            'company_curren' =>$val['com_currency'], 
                                            
                                        );
                                        
            
            
                                        
                                        $this->db->where("id",$val['update_edu_agent_com_id']);
                                               
                                            if($this->db->update("asms_education_agent_company",$edu_agent_com)){


                                                $this->db->where("asms_education_agent_company_id",$val['update_edu_agent_com_id']);
            
                                                if($this->db->delete("asms_education_agent_company_commission")){
                                                
            
                                                foreach($val['course_type_id'] as $key =>$value)
                                               {                   
                                                
                                                    $edu_agent_com2 = array(
                                                        'asms_education_agent_company_id' =>$val['update_edu_agent_com_id'],
                                                        'company_course_type'=>$val['course_type_id'][$key],
                                                        'company_commission'=>$val['comm'][$key],
                                                    );
                                 
                                                   $this->db->insert("asms_education_agent_company_commission",$edu_agent_com2);               
                                                
                                                }


                                                echo json_encode(array('status' => true, 'message' => 'Updated Successfully'));
                                            }
            
            
            
            
            
            
                                                
                                            }else{
                                                echo json_encode(array('status' => false, 'message' => 'Sorry, Education Agent company Updated Was Not Successfully'));
                                            }
            
                                        }else{
            
                                            echo json_encode(array('status' => false, 'message' => 'Already Have This Education Agent company'));
            
                                    }
                                    
        }

    

}

 }

///////////////////////////education agent company list data table/////////////////
public function agent_company_tb()
{
   $this->load->library('datatables');   

    $this->datatables->select("
    asms_education_agent_company.id as edu_agent_com_tb,
    asms_education_agent_company.agent_com_code,
    asms_education_agent_company.company_name,
    asms_education_agent_company.company_email_id,
    asms_education_agent_company.company_contact_number
    ",FALSE);

    $this->datatables->from('asms_education_agent_company');
    $this->datatables->add_column("Actions","
    <a href='javascript:;' onclick='view_edu_agent_com(" . '$1' . ")'><i class='fa fa-eye' title='View'></i></a>&nbsp;
                    <a href='javascript:;' onclick='edit_edu_agent_com(" . '$1' . ")'><i class='fa fa-pencil' title='Edit'></i></a>&nbsp;
                    <a href='javascript:;' onclick='delete_edu_agent_com(" . '$1' . ")'><i class='fa fa-trash' title='Delete'></i></a>&nbsp;","edu_agent_com_tb");
//  $this->datatables->unset_column('edu_agent_com_tb');
    echo $this->datatables->generate();  
}

//////edit_edu_ag_company//////////////////////////////
public function get_pre_edu_agent_company($id)
{
    $edu_agent_company_data = $this->class_mod->get_edu_agent_company_data($id);  
    $edu_agent_company_data_com = $this->class_mod->get_edu_agent_company_data_com($id);  
    $additional_course_types = $this->class_mod->get_additional_course_type($id);
    echo json_encode(array('edu_agent_company_data'=>$edu_agent_company_data,'edu_agent_company_data_com'=>$edu_agent_company_data_com,'additional_course_types'=>$additional_course_types));
}



///////////////////////delete education agent company////////////////////////////////


public function delete_edu_agent_Company()
{
    $id=$this->input->post('id');
    $this->db->where('id', $id); 
    $this->db->delete('asms_education_agent_company');
   
    $this->db->where('asms_education_agent_company_id', $id); 
    
    if($this->db->delete('asms_education_agent_company_commission')){


        
    
           //    echo json_encode (array('message' => 'Pre Lead Record Deleted successfully!'));
              echo json_encode(array('status' => true, 'message' => 'Record Deleted successfully!'));
   }else{
           echo json_encode(array('status' => false, 'message' => 'Deletion Failed!'));
           //    echo json_encode (array('message' => 'Pre Lead Deletion Failed!'));
   }   
}


///////////////////////view education agent company/////////////////////////////////


public function get_view_company_data($id)
{
  
    $view_company_data = $this->class_mod->get_view_company_data($id);  
    $view_commission_data = $this->class_mod->get_view_commission_data($id); 
    echo json_encode(array('view_company_data'=>$view_company_data,'view_commission_data'=>$view_commission_data));
}



/////////////////////////////////insert agent///////////////////////////////////////


public function save_agent()
{
    $val=$this->input->post();

    foreach($val['course_type_id'] as $key =>$value)
        {                   
            $edu_agent_com2 = array(
     
               'agent_id' =>$val['agent_id'],
               'course_type'=>$val['course_type_id'][$key],
               'commission'=>$val['comm'][$key],
     
                );

            $this->db->insert("agent_lead_commission",$edu_agent_com2);

        }

    echo json_encode(array('status' => true, 'message' => 'Commision Data Inserted Successfully'));
 
}




////////////////////////////////////agent list data table//////////////////////

public function agent_list_tb()
{
    $this->load->library('datatables');   

    $this->datatables->select("
    lead_agents_list.id as agent_tb,
    lead_agents_list.agent_code,
    lead_agents_list.name,
    lead_agents_list.email,
    lead_agents_list.phone,
    lead_agents_list.nic,
    lead_agents_list.pass,
    ",FALSE);

    $this->datatables->from('lead_agents_list');
    $this->datatables->add_column("Actions","
    <a href='javascript:;' onclick='view_agent(" . '$1' . ")'><i class='fa fa-eye' title='View'></i></a>&nbsp;
                    <a href='javascript:;' onclick='edit_agent(" . '$1' . ")'><i class='fa fa-pencil' title='Edit'></i></a>&nbsp;
                    <a href='javascript:;' onclick='delete_agent(" . '$1' . ")'><i class='fa fa-trash' title='Delete'></i></a>&nbsp;","agent_tb");
//  $this->datatables->unset_column('agent_tb');
    echo $this->datatables->generate(); 
}

////////////////////////edit agent///////////////////


public function get_pre_agent($id)
{
    $agent_data = $this->class_mod->get_agent_data($id);  
    $additional_course_types_agent = $this->class_mod->get_additional_course_type_agent($id);
    $edu_agent_com = $this->class_mod->get_edu_agent_com($id);  
    echo json_encode(array('agent_data'=>$agent_data,'additional_course_types_agent'=>$additional_course_types_agent,'edu_agent_com'=>$edu_agent_com));
}


//////////////////////delete agent/////////////////



public function delete_agent()
{
    $id=$this->input->post('id');
    $this->db->where('id', $id); 
    $this->db->delete('lead_agents_list');
   
    $this->db->where('agent_id', $id); 
    
    if($this->db->delete('agent_commission')){


        
    
           //    echo json_encode (array('message' => 'Pre Lead Record Deleted successfully!'));
              echo json_encode(array('status' => true, 'message' => 'Record Deleted successfully!'));
   }else{
           echo json_encode(array('status' => false, 'message' => 'Deletion Failed!'));
           //    echo json_encode (array('message' => 'Pre Lead Deletion Failed!'));
   }   
}

 
////////////////////////////////seacrh Counsellor commission/////////////////////


public function view_eligible_counsellor()
{
    $val=$this->input->post();

    $from_yr=$val['yr1'];
    $to_yr=$val['yr2'];
    $agent_company = $val['agent_company'];

    $from_date=$from_yr.'-04-01';
    $to_date=$to_yr.'-03-31';


    $data['fin_from_date']=$from_date;
    $data['fin_to_date']=$to_date;
    // var_dump($from_yr,$to_yr,$agent_company);
    // die();

    // $data['commission_data'] = $this->class_mod->get_commission_data($from_yr,$to_yr,$agent_company);
    
     $data['company_data'] = $this->class_mod->get_company_data($from_date,$to_date,$agent_company);
    
    
    
    // $data['transLead_data']=$this->class_mod->get_TransLead_data($lead_owner,$course,$trans_l_status);
    $this->load->view('counsellor_commission_data_tb',$data);


    
}


////////////////////////////////////search agent commission////////////////////////////

public function view_eligible_agent()
{
    $val=$this->input->post();
    $from_ag_yr=$val['ag_yr1'];
    $to_ag_yr=$val['ag_yr2'];
    $agent = $val['agent'];

    $from_ag_date=$from_ag_yr.'-04-01';
    $to_ag_date=$to_ag_yr.'-03-31';

    $data['fin_from_date']=$from_ag_date;
    $data['fin_to_date']=$to_ag_date;
    $data['agent_details'] = $this->class_mod->get_agent_details($from_ag_date,$to_ag_date,$agent);
    
    $this->load->view('agent_commission_data_tb',$data);
    
}


/////////////////////////////////////search past student////////////////////////////////



public function view_eligible_past_student()
{
    $val=$this->input->post();
    $stu_yr1=$val['stu_yr1'];
    $stu_yr2=$val['stu_yr2'];
    $p_stu = $val['p_stu'];

    $from_st_date=$stu_yr1.'-04-01';
    $to_st_date=$stu_yr2.'-03-31';


     
    $data['fin_from_date']=$from_st_date;
    $data['fin_to_date']=$to_st_date;
    $data['past_stu_details'] = $this->class_mod->get_past_stu_details($from_st_date,$to_st_date,$p_stu);
    $this->load->view('past_stu_commission_data_tb',$data);
}



/////////////////////insert counsellor commission paid////////////////////////
public function save_counsellor_comm_paid()
{
    $val=$this->input->post();
    $current_date = date('Y-m-d');
    
    
    $check_box_coun = $val['std_check_coun'];

    // var_dump($check_box_coun);
    // die();

    if($check_box_coun != NULL){

    foreach($val['lead_id_com_coun'] as $key => $val1){

        if (in_array($val['lead_id_com_coun'][$key], $val['std_check_coun'])) {


            $lead_coun = array(
                    
                'lead_owner_commission_payment_status'=>'Paid',
                'lead_owner_commission_paid_date'=> $current_date,

            );
        $this->db->where('id',$val['lead_id_com_coun'][$key]);  
        
                    if($this->db->update('lead_management',$lead_coun)){
                        
                        // echo json_encode(array('status'=>TRUE,'message'=>'Transfered Successfully!!'));
                    }
                    else{
                        echo "Faild";
                    }               
        }    
    } 

    echo json_encode(array('status'=>TRUE,'message'=>'Commission Paid Successfully!!'));
    }else{
         echo json_encode(array('status'=>false,'message'=>'Paid check is required'));
        // echo "payment is reqqqqqq";
        // echo "<script>
        // bootbox.alert({
        //     message: '<b>Payment Status required</b>'
        // });
        // </script>";
    }
    
}

/////////////////////insert agent commission paid////////////////////////

public function save_agent_comm_paid()
{



    $val=$this->input->post();
    $current_date = date('Y-m-d');
    
    
    $check_box_agent = $val['std_check'];

    // var_dump($check_box_coun);
    // die();

    if($check_box_agent != NULL){

    foreach($val['lead_tb_id'] as $key => $val1){

        if (in_array($val['lead_tb_id'][$key], $val['std_check'])) {


            $lead_ag = array(
                    
                'agent_commission_payment_status'=>'Paid',
                'agent_commission_paid_date'=> $current_date,

            );
        $this->db->where('id',$val['lead_tb_id'][$key]);  
        
                    if($this->db->update('lead_management',$lead_ag)){
                        
                        // echo json_encode(array('status'=>TRUE,'message'=>'Transfered Successfully!!'));
                    }
                    else{
                        echo "Faild";
                    }               
        }    
    } 

    echo json_encode(array('status'=>TRUE,'message'=>'Commission Paid Successfully!!'));
    }else{
         echo json_encode(array('status'=>false,'message'=>'Commission Paid check is required'));
        // echo "payment is reqqqqqq";
        // echo "<script>
        // bootbox.alert({
        //     message: '<b>Payment Status required</b>'
        // });
        // </script>";
    }
}

////////////////////insert past student commission///////////////////////////


public function save_student_comm_paid()
{

    
    $val=$this->input->post();
    $current_date = date('Y-m-d');
    
    
    $check_box_stu = $val['std_check'];

     

    if($check_box_stu != NULL){

    foreach($val['lead_tb_id'] as $key => $val1){

        if (in_array($val['lead_tb_id'][$key], $val['std_check'])) {


            $lead_st = array(
                    
                'past_stu_commission_payment_status'=>'Paid',
                'past_stu_commission_paid_date'=> $current_date,

            );
        $this->db->where('id',$val['lead_tb_id'][$key]);  
        
                    if($this->db->update('lead_management',$lead_st)){
                        
                        // echo json_encode(array('status'=>TRUE,'message'=>'Transfered Successfully!!'));
                    }
                    else{
                        echo "Faild";
                    }               
        }    
    } 

    echo json_encode(array('status'=>TRUE,'message'=>'Commission Paid Successfully!!'));
    }else{
         echo json_encode(array('status'=>false,'message'=>'Commission Paid check is required'));
        // echo "payment is reqqqqqq";
        // echo "<script>
        // bootbox.alert({
        //     message: '<b>Payment Status required</b>'
        // });
        // </script>";
    }

}

public function save_agent_new($method){
    $val=$this->input->post();

    $this->form_validation->set_rules("com_name","Company Name","trim|required");
    $this->form_validation->set_rules("title","Title","trim|required");
    $this->form_validation->set_rules("princ_name","Managing principal’s Name","trim|required");
    $this->form_validation->set_rules("contact_email","Email","trim|required");

    $this->form_validation->set_rules("bank_ac_name","Bank Account Name","trim|required");
    $this->form_validation->set_rules("bank_name","Bank Name","trim|required");
    $this->form_validation->set_rules("bank_branch","Bank Branch","trim|required");
    $this->form_validation->set_rules("bank_num","Account Number","trim|required");

    // $this->form_validation->set_rules("radio_1","Preferred Contact Method","trim|required");contact_phone
    $this->form_validation->set_rules("com_phone","Phone Number","trim|required");

    if($this->form_validation->run() == false){
    
        $data=array();
        $data["error"]=array();
        $data["input_error"]=array();
        $data["status"]=FALSE;

        if(form_error("com_name")){
            $data["input_error"][] ="com_name";
            $data["error_string"][]=form_error("com_name");
        }
        if(form_error("title")){
            $data["input_error"][] ="title";
            $data["error_string"][]=form_error("title");
        }
        if(form_error("princ_name")){
            $data["input_error"][] ="princ_name";
            $data["error_string"][]=form_error("princ_name");
        }
        if(form_error("contact_email")){
            $data["input_error"][] ="contact_email";
            $data["error_string"][]=form_error("contact_email");
        }
        if(form_error("com_phone")){
            $data["input_error"][] ="com_phone";
            $data["error_string"][]=form_error("com_phone");
        }
         if(form_error("bank_ac_name")){
            $data["input_error"][] ="bank_ac_name";
            $data["error_string"][]=form_error("bank_ac_name");
        }
         if(form_error("bank_name")){
            $data["input_error"][] ="bank_name";
            $data["error_string"][]=form_error("bank_name");
        }
         if(form_error("bank_branch")){
            $data["input_error"][] ="bank_branch";
            $data["error_string"][]=form_error("bank_branch");
        }
         if(form_error("bank_num")){
            $data["input_error"][] ="bank_num";
            $data["error_string"][]=form_error("bank_num");
        }
        
        echo json_encode($data);
        exit();

    }else{

        if($ageId=$this->agent_mod->get_maxId()){

            $agenId = (float)$ageId->temp_code_number+1;

        } else{

            $agenId = 1;

        }     
        
        $temp_code = 'TEMP/AGN/'.str_pad($agenId, 5, "0", STR_PAD_LEFT);

        if(!$this->agent_mod->get_duplicate($val['contact_email'])){

            $dataDocu=array(
           
                'lead_temp_code'=>$temp_code, 
                'temp_code_number'=>$agenId,                   
                'copany_name'=>$val['com_name'],
                'title'=>$val['title'],
                'f_name'=>$val['princ_name'],
                'm_name'=>$val['middle_name'],
                'l_name'=>$val['last_name'],
                'email'=>$val['contact_email'],
                'phone'=>$val['contact_phone'],
                'address_1'=>$val['address1'],
                'address_2'=>$val['address2'],
                'address_3'=>$val['address3'],
                'city'=>$val['city'],
                's_r_p'=>$val['state'],
                'postal'=>$val['postal'],
                'country'=>$val['country'],
                'website'=>$val['web'],
                'phone_numebr'=>$val['com_phone'],
                'link_in'=>$val['com_linkedIn'],
                'facebook'=>$val['com_fb'],
                'bank_account_name'=>$val['bank_ac_name'],
                'bank_name'=>$val['bank_name'],
                'branch_address'=>$val['bank_branch'],
                'bsb'=>$val['bank_bsb'],
                'bank_acc'=>$val['bank_num'],
                'swift_code'=>$val['bank_swift'],
                'iban'=>$val['bank_iban'],
                'agnt_email_1'=>$val['email1'],
                'agnt_phone_1'=>$val['phone1'],
                'agnt_email_2'=>$val['email2'],
                'agnt_phone_2'=>$val['phone2'],
                'date_time'=>date('Y-m-d'),
                'agnt_title_1'=>$val['key_name_title1'],
                'agnt_title_2'=>$val['key_name_title2'],
                'agnt_name_1'=>$val['key_name1'],
                'agnt_name_2'=>$val['key_name2']
            );

            if($insert_id=$this->kcrud->save($this->table,$dataDocu)){

                $ab_path =  $this->config->item('ab_path');
                $img_path = "uploads/agent_doc/".$insert_id.'/';

                  // if (!empty($_FILES["st_file_nic_pp"]['name'])) {
                    $st_file_nic_pp = explode('.',$_FILES["com_logo"]['name']);
                    // $st_file_nic_pp = $st_file_nic_pp[0];
                    $file_name = $insert_id."_logo".date('_Y-m-d_H_i_s');
                    $target_path = $ab_path."/uploads/agent_doc/".$insert_id."/";
                    if(!is_dir($target_path)){
                        //Directory does not exist, so lets create it.
                        mkdir($target_path, 0775, true);
                    }
                    $config['upload_path'] = $target_path;
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                    $config['file_name'] = $file_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("com_logo")) {
                        $ext = explode(".", $_FILES["com_logo"]['name']);
                        $data_logo_file = array(
                            "main_id" => $insert_id,
                            "document_name" => 'logo_'.$insert_id,
                            "path" => $img_path . $file_name.".".$ext[1],
                            "type"=> 'LOGO',
                            "created_at" => date('Y-m-d h:i:s')
                        );
                        $this->db->insert('asms_lead_agent_data_att',$data_logo_file);
                    }


                echo json_encode(array('status'=>true,'message'=>'Successfully Submited!'));      

                 $data = array(
                        'baseurl'   => base_url(),
                        'first_name'    => $agent_details->f_name,
                        'last_name' => $agent_details->l_name,
                        'application_no'     => $temp_code,
                    );
                   $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('new_agent_received_mail', 'ion_auth'), $data, true);
                   $this->email->clear();
                   $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                   $this->email->to($val['contact_email']);
                   $this->email->subject("Application Received Mail");
                   $this->email->set_mailtype("html");
                   $this->email->message($message);                  
                   if($this->email->send()){

                         $data_reg = array(
                            'register_email'   => 1
                        );

                     $this->db->where('id',$insert_id);
                     $this->db->update('lead_agent_detail_list',$data_reg);
                   }

                   exit;               

                // }

                // $ab_path =  $this->config->item('ab_path');
                //     $target_path = $ab_path."uploads/agent_doc/";
                //     $img_path = "uploads/agent_doc/";

                //         if(empty($_FILES["com_logo"]["name"]))
                //         {
                //             $data = array();
                //             $data['inputerror'][] = 'com_logo';
                //             $data['error_string'][] = 'This is required';
                //             $data['status'] = FALSE;
                //             echo json_encode($data);
                //             exit;
                //         }

                //     $allowedExtensions = array("jpeg", "jpg", "png", "bmp", "pdf");
                //     $allowedSizeMaximum = 5242880;
                //     $temp = explode(".", $_FILES["com_logo"]["name"]);
                //     $extension = end($temp);

                //     // $fileName = $_FILES["com_logo"]["name"];
                //     $fileName =$temp[0].'_'.date('YmdH:i:s').'.'.$extension;
                //     $isOverride = $this->input->post('override_file') === 'true' ? true : false;

                //     //edit file ----------------

                //     if (($_FILES["com_logo"]["size"] < $allowedSizeMaximum) && in_array(strtolower($extension), array_map('strtolower', $allowedExtensions)))
                //     {
                //         if ($_FILES["com_logo"]["error"] > 0)
                //         {
                //             echo json_encode(array("status" => FALSE, "message" => "Return Code: " . $_FILES["com_logo"]["error"] . " \n"));
                //         }
                //         else
                //         {
                //             if (file_exists($target_path . $fileName) && !$isOverride)
                //             {
                //                 // $this->system_log->create_system_log("Work Job Documents", "Failed", "Insert - There is already a file existing with this file name for this Vehicle, Vehicle ID #".$val['job_id']);

                //                 echo json_encode(array(
                //                     "status" => FALSE,
                //                     "type" => "file_exist",
                //                     "existing_file_detail" => $this->return_existing_file_info($val['job_id'], $fileName),
                //                     "message" => "There is already a file existing with this file name for this Vehicle."
                //                 ));
                //                 exit;
                //             }
                //             else
                //             {
                //                 if(move_uploaded_file($_FILES["com_logo"]["tmp_name"], $target_path . $fileName))
                //                 {
                //                     $emp_file_details = array(
                //                         'document_name' => $fileName,
                //                         'path' => $img_path . $fileName,
                //                         'size_in_bytes' => $_FILES["com_logo"]["size"]
                //                     );
                     
                //                             // $this->system_log->create_system_log("Work Job Documents", "Success", "Work Job Document Added successfully WOJ ID #".$val['job_id_2']);
                //                             $emp_file_details['main_id'] = $insert_id;
                //                             $this->db->insert('asms_lead_agent_data_att', $emp_file_details);
                //                             // $this->item_mod->save_doc_file($emp_file_details);
                //                             // echo json_encode(array("status" => TRUE, "message" => "File uploaded successfully.", "file" => $fileName));
                //                             // exit;

                //                 }
                //                 else
                //                 {
                //                     // $this->system_log->create_system_log("Work Job Documents", "Failed", "Failed to save the file, WOJ ID #".$val['job_id']);

                //                     echo json_encode(array("status" => FALSE, "Message" => "Sorry! Failed to save the file."));
                //                     exit;
                //                 }
                //             }
                //         }
                //     }
                //     else
                //     {
                //         echo json_encode(array("status" => FALSE, "message" => "Invalid file type or file size. \nOnly ". " file types are allowed. Also, maximum file size allowed is " . $allowedSizeMaximum / 1024 / 1024 . " MB."));
                //     }

             
            }

             }else{

                    echo json_encode(array('status'=>false,'message'=>'Sorry! You have already registered with this email address'));  
                    exit;  


                   } 
            
            
        }
}


public function laod_pay_tbl(){

    $data['payDetails'] = $this->agent_mod->get_agent_details_all();
    // var_dump($data);
    // die();

    $this->load->view('load_agent_table', $data);

 }

 public function laod_pay_tbl_2(){

    $data['payDetails'] = $this->agent_mod->get_approved_agent_details();
    // var_dump($data);
    // die();

    $this->load->view('load_approved_agent_table', $data);

 }

 public function laod_pay_tbl_3(){

    $data['payDetails'] = $this->agent_mod->get_agent_details_all_internal();
    // var_dump($data);
    // die();

    $this->load->view('load_agent_table_internal', $data);

 }



 public function view_temp_agent(){

    $val=$this->input->post();
    $agId = $val['id'];   

    $data['countries']=$this->agent_mod->getCountries();
    $data['agId'] = $agId;
    $data['agentDetail'] = $this->agent_mod->get_temp_agent_details_view($agId);
    $data['atach_doc'] = $this->agent_mod->get_agent_attachments($agId);
    $data['course_types'] = $this->agent_mod->get_course_types();
    $data['app_id'] = $agId;
    
    $this->load->view('agent_application_view_temp',$data);

 }

  public function view_approved_agent(){

    $val=$this->input->post();
    $agId = $val['id'];   

    $data['countries']=$this->class_mod->getCountries();
    $data['agId'] = $agId;
    $data['agentDetail'] = $this->agent_mod->get_approved_agent_details_view($agId);
    $data['atach_doc'] = $this->agent_mod->get_agent_attachments($agId);
    
    $this->load->view('agent_application_view_approved',$data);

 }


 public function update_statsu()
    {


        $val=$this->input->post();
         $id=$val['app_hidden_id'];
         $satsu_data=$val['update_state'];
         $comment_data=$val['comment_state'];
       
        if($satsu_data=='Approved'){

            if($ageId=$this->agent_mod->get_agent_maxId()){

                $agenId = (float)$ageId->code_number+1;

            } else{

                $agenId = 1;

            }     

            $temp_code = 'AGN'.str_pad($agenId, 5, "0", STR_PAD_LEFT);
             
               $lead_ag = array(
                        
                    'lead_status'=>$satsu_data,
                    'lead_code'=>$temp_code,
                    'code_number'=>$agenId

                );

       }else{

         $lead_ag = array(
                    
                'lead_status'=>$satsu_data                

            );

       }

        $this->db->where('id', $id); 
         if($this->db->update('lead_agent_detail_list',$lead_ag)){


             $lead_comment = array(
                    
                'comment'=>$comment_data,
                'agent_id'=>$id                

            );

            $this->db->insert('lead_agent_approval_comment_history',$lead_comment);          


            if($satsu_data=='Approved'){

                $agent_details=$this->agent_mod->get_agent_detailss_one($id);

                function randomPassword() {
                    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    return implode($pass); //turn the array into a string
                }

                $rand_pass =  randomPassword();

            $sys_data = array(
                'title'=>$agent_details->title,
                'user_id'=>$temp_code,
                'name'=>$agent_details->f_name.' '.$agent_details->l_name,
                'full_name'=>$agent_details->f_name.' '.$agent_details->m_name.' '.$agent_details->l_name,                       
                'user'=>1,
                'plain_pw'=>$rand_pass,
                'created_at'=>date("Y-m-d H:i:s"),
                'status'=>1,
                'type'=>2,
                'agent_id'=>$id
            );
 
            if($this->db->insert('asms_users_info',$sys_data)){
                $insert_id=$this->db->insert_id();

                foreach($val['course_type_id'] as $key =>$value)
                    {                   
                        $edu_agent_com2 = array(
                 
                           'agent_id' =>$id,
                           'course_type'=>$val['course_type_id'][$key],
                           'commission'=>$val['commision'][$key],
                 
                            );

                        $this->db->insert("agent_lead_commission",$edu_agent_com2);

                    }                

                 $lead_ag_nw = array(
                    
                        'system_id'=>$insert_id                

                    );        

                $this->db->where('id', $id); 
                $this->db->update('lead_agent_detail_list',$lead_ag_nw);

                $group_data = array('0'=>'15');            

                $id = null;
                $message = null;
                $details = $this->input->post();
                $email    = strtolower($agent_details->email);
                $identity = $temp_code;
                $password = $rand_pass;
                $user_group = $group_data;

                $additional_data = array(
                    'id' => $insert_id,
                    'is_employee' => 1,
                    'first_name'  => $agent_details->f_name,
                    'otp'  => 1,
                );        

                $group = array($user_group);
                if ($user_id = $this->ion_auth->register($identity, $password, $email,$additional_data,$group)) {             

              
                                $mod_data_1 = array(
                                    'user_id' => $insert_id,
                                    'module_id' => 107,
                                    'access_permission' => 'YES',
                                );
                                $this->db->insert('auth_system_permissions', $mod_data_1);                 
                          
                                $mod_data_2 = array(
                                    'user_id' => $insert_id,
                                    'module_id' => 87,
                                    'access_permission' => 'YES',
                                );
                                $this->db->insert('auth_system_permissions', $mod_data_2);              
       
                                // $mod_data_3 = array(
                                //     'user_id' => $insert_id,
                                //     'module_id' => 78,
                                //     'access_permission' => 'YES',
                                // );
                                // $this->db->insert('auth_system_permissions', $mod_data_3);


                                 $mod_data_3 = array(
                                    'user_id' => $insert_id,
                                    'module_id' => 59,
                                    'access_permission' => 'YES',
                                );
                                $this->db->insert('auth_system_permissions', $mod_data_3);

                                 $mod_data_4 = array(
                                    'user_id' => $insert_id,
                                    'module_id' => 105,
                                    'access_permission' => 'YES',
                                );
                                $this->db->insert('auth_system_permissions', $mod_data_4);

                                 $mod_data_5 = array(
                                    'user_id' => $insert_id,
                                    'module_id' => 86,
                                    'access_permission' => 'YES',
                                );
                                $this->db->insert('auth_system_permissions', $mod_data_5);
                       
                 

                    $data = array(
                        'baseurl'   => base_url(),
                        'first_name'    => $agent_details->f_name,
                        'last_name' => $agent_details->l_name,
                        'user_name'     => $identity,
                        'password'      => $password,
                    );
                   $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('new_agent_user_mail', 'ion_auth'), $data, true);
                   $this->email->clear();
                   $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                   $this->email->to($agent_details->email);
                   $this->email->subject("Login Details for System");
                   $this->email->set_mailtype("html");
                   $this->email->message($message);
                  
                    if ($this->email->send()) {    
                        $this->system_log->create_system_log("System Users", "Success", "New System User #" . $user_id . " added for User ID #" . $user_id);

                        $lead_email_ag = array(
                    
                                    'account_creation_email'=>1                

                                );

                        $this->db->where('id', $id); 
                        $this->db->update('lead_agent_detail_list',$lead_email_ag);
                    }

                      echo json_encode(array('status' => true, 'message' => 'Agent Lead Approved And Portal Creation successfully!'));
                    
                } 

               
            }          

        }else{

                 echo json_encode(array('status' => true, 'message' => 'Agent Status Update successfully!'));
            }   
      
         }                  
    }



     public function save_img(){

         $val = $this->input->post();     
               
                    $ab_path =  $this->config->item('ab_path');
                    $target_path = $ab_path."uploads/agent_doc/";
                    $img_path = "uploads/agent_doc/";

                        if(empty($_FILES["file"]["name"]))
                        {
                            $data = array();
                            $data['inputerror'][] = 'file';
                            $data['error_string'][] = 'This is required';
                            $data['status'] = FALSE;
                            echo json_encode($data);
                            exit;
                        }

                    $allowedExtensions = array("jpeg", "jpg", "png", "bmp", "pdf");
                    $allowedSizeMaximum = 5242880;
                    $temp = explode(".", $_FILES["file"]["name"]);
                    $extension = end($temp);

                    $fileName = $_FILES["file"]["name"];
                    $isOverride = $this->input->post('override_file') === 'true' ? true : false;

                    //edit file ----------------

                    if (($_FILES["file"]["size"] < $allowedSizeMaximum) && in_array(strtolower($extension), array_map('strtolower', $allowedExtensions)))
                    {
                        if ($_FILES["file"]["error"] > 0)
                        {
                            echo json_encode(array("status" => FALSE, "message" => "Return Code: " . $_FILES["file"]["error"] . " \n"));
                        }
                        else
                        {
                            if (file_exists($target_path . $fileName) && !$isOverride)
                            {
                                // $this->system_log->create_system_log("Work Job Documents", "Failed", "Insert - There is already a file existing with this file name for this Vehicle, Vehicle ID #".$val['job_id']);

                                echo json_encode(array(
                                    "status" => FALSE,
                                    "type" => "file_exist",
                                    "existing_file_detail" => $this->return_existing_file_info($val['job_id'], $fileName),
                                    "message" => "There is already a file existing with this file name for this Vehicle."
                                ));
                                exit;
                            }
                            else
                            {
                                if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_path . $fileName))
                                {
                                    $emp_file_details = array(
                                        'document_name' => $fileName,
                                        'path' => $img_path . $fileName,
                                        'size_in_bytes' => $_FILES["file"]["size"]
                                    );
                     
                                            // $this->system_log->create_system_log("Work Job Documents", "Success", "Work Job Document Added successfully WOJ ID #".$val['job_id_2']);
                                            $emp_file_details['main_id'] = $val['job_id'];
                                            $this->db->insert('asms_lead_agent_data_att', $emp_file_details);
                                            // $this->item_mod->save_doc_file($emp_file_details);
                                            echo json_encode(array("status" => TRUE, "message" => "File uploaded successfully.", "file" => $fileName));
                                            exit;

                                }
                                else
                                {
                                    // $this->system_log->create_system_log("Work Job Documents", "Failed", "Failed to save the file, WOJ ID #".$val['job_id']);

                                    echo json_encode(array("status" => FALSE, "Message" => "Sorry! Failed to save the file."));
                                    exit;
                                }
                            }
                        }
                    }
                    else
                    {
                        echo json_encode(array("status" => FALSE, "message" => "Invalid file type or file size. \nOnly ". " file types are allowed. Also, maximum file size allowed is " . $allowedSizeMaximum / 1024 / 1024 . " MB."));
                    }
                    echo json_encode(array('status' => TRUE, 'message' => 'Document Uploaded successfully !'));                 
     
    }




 public function create_agent_portal()
    {
         $id=$this->input->post('id');
        
            $agent_details=$this->agent_mod->get_agent_detailss_one($id);

                function randomPassword() {
                    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 8; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    return implode($pass); //turn the array into a string
                }

                $rand_pass =  randomPassword();

            $sys_data = array(
                'title'=>$agent_details->title,
                'user_id'=>$agent_details->lead_code,
                'name'=>$agent_details->f_name.' '.$agent_details->l_name,
                'full_name'=>$agent_details->f_name.' '.$agent_details->m_name.' '.$agent_details->l_name,                       
                'user'=>1,
                'plain_pw'=>$rand_pass,
                'created_at'=>date("Y-m-d H:i:s"),
                'status'=>1,
                'type'=>2
            );
 
            if($this->db->insert('asms_users_info',$sys_data)){

                $insert_id=$this->db->insert_id();

                 $lead_ag_nw = array(
                    
                        'system_id'=>$insert_id,
                        'agent_portal'=>1                 

                    );        

                $this->db->where('id', $id); 
                $this->db->update('lead_agent_detail_list',$lead_ag_nw);

                $group_data = array('0'=>'17');            

                $id = null;
                $message = null;
                $details = $this->input->post();
                $email    = strtolower($agent_details->email);
                $identity = $agent_details->lead_code;
                $password = $rand_pass;
                $user_group = $group_data;

                $additional_data = array(
                    'id' => $insert_id,
                    'is_employee' => 1,
                    'first_name'  => $agent_details->f_name,
                    'otp'  => 1,
                );        

                $group = array($user_group);
                if ($user_id = $this->ion_auth->register($identity, $password, $email,$additional_data,$group)) {

                    $data = array(
                        'baseurl'   => base_url(),
                        'first_name'    => $agent_details->f_name,
                        'last_name' => $agent_details->l_name,
                        'user_name'     => $identity,
                        'password'      => $password,
                    );
                   $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('new_agent_user_mail', 'ion_auth'), $data, true);
                   $this->email->clear();
                   $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                   $this->email->to($agent_details->email);
                   $this->email->subject("Login Details for System");
                   $this->email->set_mailtype("html");
                   $this->email->message($message);
                  
                    if ($this->email->send()) {    
                        $this->system_log->create_system_log("System Users", "Success", "New System User #" . $user_id . " added for User ID #" . $user_id);
                    } 

                    echo json_encode(array('status' => true, 'message' => 'Agent Portal Creation Successfully!'));                   
                    
                }                  
                
            }else{

                echo json_encode(array('status' => true, 'message' => 'Sorry. Agent Portal Creation Fialed!'));

            }        
                     
    }


    

}
