<?php

class Lead_inquiry_mod extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
       
    }

    public function get_logUser($user)
    {
        $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
         FROM asms_users_info
         WHERE asms_users_info.id = '$user'");
        return $query->row();
    }
     
    
    public function get_Counselor(){
        

        $company = COMPANY_ID;

        
$groups_1=array('lead_manager','admin'); 
if ($this->ion_auth->in_group($groups_1)) {

    if($company == "1")
    {
        $query=$this->db->query("SELECT asms_users_info.name,asms_users_info.id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE auth_groups.id='12'
        GROUP BY asms_users_info.id");

        return $query->result();
    }else{
        $query=$this->db->query("SELECT asms_users_info.name,asms_users_info.id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE auth_groups.id='12' AND asms_users_info.company_id='$company'
        GROUP BY asms_users_info.id");

        return $query->result();

    }
}
 
        

    }

    public function get_programes(){

        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query=$this->db->get();
        return $query->result();

    }
    public function get_lead_sources(){

        $this->db->select('*');
        $this->db->from('asms_m_lead_source');
        $query=$this->db->get();
        return $query->result();

    }
    public function get_contact_methods()
    {
        $this->db->select('*');
        $this->db->from('lead_contact_methods');
        $query=$this->db->get();
        return $query->result();
    }

    public function get_interest_level()
    {
        $this->db->select('*');
        $this->db->from('asms_lead_interest_level');
        $query=$this->db->get();
        return $query->result();
    }
   
    public function get_lead_inq_Data($from,$to,$course,$counsellor,$contact,$interest,$counsellor_id,$lead_source)
    {

        $company = COMPANY_ID;
               
$groups_1=array('lead_manager','admin'); 
$groups_2=array('student_counsellors'); 
if ($this->ion_auth->in_group($groups_1)) {

    if($company == "1")
    {
         
        if ($from=="" && $to=="" && $course == "" && $counsellor == "" && $contact == "" && $interest == "" && $counsellor_id=="") {
            echo("Invalid Input");
            die();
        }
        if ($course!=""){
            $qery_data = " AND asms_m_programs.id = '$course' ";
        }

        if ($counsellor!="") {
            $qery_data .= " AND asms_users_info.id = '$counsellor' ";
        }
        if ($counsellor_id!="") {
            $qery_data .= " AND asms_users_info.id = '$counsellor_id' ";
        }
        
        if ($contact!="") {
            $qery_data .= " AND lead_contact_methods.id = '$contact' ";
        }
        if ($interest!="") {
            $qery_data .= " AND asms_lead_interest_level.id = '$interest' ";
        }

        if ($lead_source!="") {
            $qery_data .= " AND lead_inserted_lead_source.l_source = '$lead_source' ";
        }
        
        

        // if($from!="" && $to!=""){
        //     $qery_data = " AND lead_management.lead_created_date BETWEEN '$from' AND '$to' ";
        // }
       
        // if($course!=""){
        //     $qery_data .= " AND lead_management.programe = '$course' ";
        // }

        // if($counsellor!=""){
        //     $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
        // }
        // if($contact!=""){
        //     $qery_data .= " AND lead_management.contact_method = '$contact' ";
        // }
        // if($interest!=""){
        //     $qery_data .= " AND lead_management.int_level = '$interest' ";
        // }
        $query =$this->db->query("SELECT lead_management.id as lead_tb,lead_management.lead_id_code,lead_management.lead_created_date,
        lead_management.f_name,lead_management.l_name,
        lead_management.contact_method,lead_management.l_email,lead_management.l_phone,lead_management.ol_res,
        lead_management.ol_year,lead_management.al_school,lead_management.al_stream,lead_management.al_year,
        lead_management.other_edu,lead_management.remarks,asms_m_programs.name as c_name,asms_m_programs.code as ccode,
        lead_contact_methods.contact_name,asms_lead_interest_level.name as interest_level,asms_users_info.name as l_coun,
        asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_lead_school_list.name as skl,lead_al_streams.name as stream,
        lead_work_experience_skls_hos.name as hos,lead_management.ex_years,lead_management.ex_months,lead_management.inq_by,lead_management.parent_name,p_title.name as p_title,
        s_title.name as s_title,lead_management.l_phone_2,lead_management.nic_div,lead_management.passport_div,lead_management.address1,lead_management.address2,lead_management.city,lead_province.name as pro,
        lead_management.zip_pos,asms_m_countries.name as country,lead_management.reffered,lead_management.refferal_type,lead_management.agent_name,lead_management.ref_nic,lead_management.ref_remarks,
        lead_management.study_method,pre_con.contact_name,lead_management.con_box,lead_management.loan_info
        FROM lead_management
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management.salutation 
        LEFT OUTER JOIN lead_contact_methods ON lead_contact_methods.id = lead_management.contact_method
        LEFT OUTER JOIN lead_contact_methods as pre_con ON pre_con.id = lead_management.pref_contact_method
        LEFT OUTER JOIN asms_lead_interest_level ON asms_lead_interest_level.id = lead_management.int_level 
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id =lead_management.id
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_lead_school_list ON asms_lead_school_list.id = lead_management.al_school
        LEFT OUTER JOIN lead_al_streams ON lead_al_streams.id = lead_management.al_stream
        LEFT OUTER JOIN lead_province ON lead_province.id = lead_management.state_pro
        LEFT OUTER JOIN asms_m_countries ON asms_m_countries.id = lead_management.country
        LEFT OUTER JOIN lead_work_experience_skls_hos ON lead_work_experience_skls_hos.id = lead_management.ex_type
        LEFT OUTER JOIN lead_inserted_lead_source ON lead_inserted_lead_source.lead_management_tb_id = lead_management.id
        WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
        //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
        return $query->result();

        
    }else{

        if ($from=="" && $to=="" && $course == "" && $counsellor == "" && $contact == "" && $interest == "" && $counsellor_id=="") {
            echo("Invalid Input");
            die();
        }
        if ($course!=""){
            $qery_data = " AND asms_m_programs.id = '$course' ";
        }

        if ($counsellor!="") {
            $qery_data .= " AND asms_users_info.id = '$counsellor' ";
        }
        if ($counsellor_id!="") {
            $qery_data .= " AND asms_users_info.id = '$counsellor_id' ";
        }
        
        if ($contact!="") {
            $qery_data .= " AND lead_contact_methods.id = '$contact' ";
        }
        if ($interest!="") {
            $qery_data .= " AND asms_lead_interest_level.id = '$interest' ";
        }
        if ($lead_source!="") {
            $qery_data .= " AND lead_inserted_lead_source.l_source = '$lead_source' ";
        }

        // if($from!="" && $to!=""){
        //     $qery_data = " AND lead_management.lead_created_date BETWEEN '$from' AND '$to' ";
        // }
       
        // if($course!=""){
        //     $qery_data .= " AND lead_management.programe = '$course' ";
        // }

        // if($counsellor!=""){
        //     $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
        // }
        // if($contact!=""){
        //     $qery_data .= " AND lead_management.contact_method = '$contact' ";
        // }
        // if($interest!=""){
        //     $qery_data .= " AND lead_management.int_level = '$interest' ";
        // }
        $query =$this->db->query("SELECT lead_management.lead_id_code,lead_management.lead_created_date,
        lead_management.f_name,lead_management.l_name,
        lead_management.contact_method,lead_management.l_email,lead_management.l_phone,lead_management.ol_res,
        lead_management.ol_year,lead_management.al_school,lead_management.al_stream,lead_management.al_year,
        lead_management.other_edu,lead_management.remarks,asms_m_programs.name as c_name,asms_m_programs.code as ccode,
        lead_contact_methods.contact_name,asms_lead_interest_level.name as interest_level,asms_users_info.name as l_coun,
        asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_lead_school_list.name as skl,lead_al_streams.name as stream,
        lead_work_experience_skls_hos.name as hos,lead_management.ex_years,lead_management.ex_months,lead_management.inq_by,lead_management.parent_name,p_title.name as p_title,
        s_title.name as s_title,lead_management.l_phone_2,lead_management.nic_div,lead_management.passport_div,lead_management.address1,lead_management.address2,lead_management.city,lead_province.name as pro,
        lead_management.zip_pos,asms_m_countries.name as country,lead_management.reffered,lead_management.refferal_type,lead_management.agent_name,lead_management.ref_nic,lead_management.ref_remarks,
        lead_management.study_method,pre_con.contact_name,lead_management.con_box,lead_management.loan_info
        FROM lead_management
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management.salutation 
        LEFT OUTER JOIN lead_contact_methods ON lead_contact_methods.id = lead_management.contact_method
        LEFT OUTER JOIN lead_contact_methods as pre_con ON pre_con.id = lead_management.pref_contact_method
        LEFT OUTER JOIN asms_lead_interest_level ON asms_lead_interest_level.id = lead_management.int_level 
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id =lead_management.id
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_lead_school_list ON asms_lead_school_list.id = lead_management.al_school
        LEFT OUTER JOIN lead_al_streams ON lead_al_streams.id = lead_management.al_stream
        LEFT OUTER JOIN lead_province ON lead_province.id = lead_management.state_pro
        LEFT OUTER JOIN asms_m_countries ON asms_m_countries.id = lead_management.country
        LEFT OUTER JOIN lead_work_experience_skls_hos ON lead_work_experience_skls_hos.id = lead_management.ex_type
        LEFT OUTER JOIN lead_inserted_lead_source ON lead_inserted_lead_source.lead_management_tb_id = lead_management.id
        WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND asms_users_info.company_id='$company' AND lead_management.id IS NOT NULL".$qery_data);
        //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
        return $query->result();

    }


}else if ($this->ion_auth->in_group($groups_2)) 
{

    if ($from=="" && $to=="" && $course == "" && $counsellor == "" && $contact == "" && $interest == "" && $counsellor_id=="") {
        echo("Invalid Input");
        die();
    }
           
    if ($course!=""){
        $qery_data = " AND asms_m_programs.id = '$course' ";
    }

    if ($counsellor!="") {
        $qery_data .= " AND asms_users_info.id = '$counsellor' ";
    }
    if ($counsellor_id!="") {
        $qery_data .= " AND asms_users_info.id = '$counsellor_id' ";
    }
    
    if ($contact!="") {
        $qery_data .= " AND lead_contact_methods.id = '$contact' ";
    }
    if ($interest!="") {
        $qery_data .= " AND asms_lead_interest_level.id = '$interest' ";
    }
    
    $query =$this->db->query("SELECT lead_management.lead_id_code,lead_management.lead_created_date,
    lead_management.f_name,lead_management.l_name,
    lead_management.contact_method,lead_management.l_email,lead_management.l_phone,lead_management.ol_res,
    lead_management.ol_year,lead_management.al_school,lead_management.al_stream,lead_management.al_year,
    lead_management.other_edu,lead_management.remarks,asms_m_programs.name as c_name,asms_m_programs.code as ccode,
    lead_contact_methods.contact_name,asms_lead_interest_level.name as interest_level,asms_users_info.name as l_coun,
    asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_lead_school_list.name as skl,lead_al_streams.name as stream,
    lead_work_experience_skls_hos.name as hos,lead_management.ex_years,lead_management.ex_months,lead_management.inq_by,lead_management.parent_name,p_title.name as p_title,
        s_title.name as s_title,lead_management.l_phone_2,lead_management.nic_div,lead_management.passport_div,lead_management.address1,lead_management.address2,lead_management.city,lead_province.name as pro,
        lead_management.zip_pos,asms_m_countries.name as country,lead_management.reffered,lead_management.refferal_type,lead_management.agent_name,
        lead_management.ref_nic,lead_management.ref_remarks,lead_management.study_method,pre_con.contact_name,lead_management.con_box,lead_management.loan_info
        FROM lead_management
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management.salutation 
        LEFT OUTER JOIN lead_contact_methods ON lead_contact_methods.id = lead_management.contact_method
        LEFT OUTER JOIN lead_contact_methods as pre_con ON pre_con.id = lead_management.pref_contact_method
        LEFT OUTER JOIN asms_lead_interest_level ON asms_lead_interest_level.id = lead_management.int_level 
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id =lead_management.id
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_lead_school_list ON asms_lead_school_list.id = lead_management.al_school
        LEFT OUTER JOIN lead_al_streams ON lead_al_streams.id = lead_management.al_stream
        LEFT OUTER JOIN lead_province ON lead_province.id = lead_management.state_pro
        LEFT OUTER JOIN asms_m_countries ON asms_m_countries.id = lead_management.country
        LEFT OUTER JOIN lead_work_experience_skls_hos ON lead_work_experience_skls_hos.id = lead_management.ex_type
    WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
    //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
    return $query->result();













}
    }




    public function get_lead_source($lead_tb)
    {
         
        $query=$this->db->query("SELECT asms_m_lead_source.source_title
        FROM lead_inserted_lead_source
        LEFT OUTER JOIN asms_m_lead_source ON asms_m_lead_source.id = lead_inserted_lead_source.l_source
        WHERE lead_inserted_lead_source.lead_management_tb_id='$lead_tb'");

        return $query->result();
    }

    public function get_lead_pro($lead_tb)
    {
         
        $query=$this->db->query("SELECT asms_m_programs.name as cname,asms_m_programs.code
        FROM lead_inserted_other_inter_programs
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_inserted_other_inter_programs.other_program
        WHERE lead_inserted_other_inter_programs.lead_management_tb_id='$lead_tb'");

        return $query->result();
    }
    

  
    
    

    

    
}