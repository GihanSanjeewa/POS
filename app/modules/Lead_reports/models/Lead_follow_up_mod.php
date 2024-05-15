<?php

class Lead_follow_up_mod extends CI_Model
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
   
    public function get_Coun_Data($from,$to,$counsellor,$counsellor_id)
    {


        $company = COMPANY_ID;

        
        $groups_1=array('lead_manager','admin'); 
        $groups_2=array('student_counsellors'); 
        if ($this->ion_auth->in_group($groups_1)) {
        
        if($company == "1")
        {
        
         
        if ($from=="" && $to=="" && $counsellor == "" && $counsellor_id == "") {
            echo("Invalid Input");
            die();
        }
        
        if ($counsellor!="" && ($from=="" && $to=="") && $counsellor_id == "") {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE lead_management.lead_owner = '$counsellor'
            GROUP BY lead_management.lead_owner");
    
        //    GROUP BY lead_management.lead_owner".$qery_data);
            //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
            return $query->result();
            // $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
        }
        else if($counsellor=="" && ($from!="" && $to!="") && $counsellor_id == "")
        {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to')
            GROUP BY lead_management.lead_owner");
    
        //    GROUP BY lead_management.lead_owner".$qery_data);
            //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
            return $query->result();

        }
        else if($counsellor!="" && ($from!="" && $to!="") && $counsellor_id == "")
        {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND lead_management.lead_owner = '$counsellor'
            GROUP BY lead_management.lead_owner");
            return $query->result();
        }


        ////////////////////////////////////////////////lead_owner///////////////////////////////////////////////

        else if ($counsellor=="" && ($from=="" && $to=="") && $counsellor_id != "") {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE lead_management.lead_owner = '$counsellor_id'
            GROUP BY lead_management.lead_owner");
    
        //    GROUP BY lead_management.lead_owner".$qery_data);
            //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
            return $query->result();
            // $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
        }
        
        else if($counsellor=="" && ($from!="" && $to!="") && $counsellor_id != "")
        {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND lead_management.lead_owner = '$counsellor_id'
            GROUP BY lead_management.lead_owner");
            return $query->result();
        }

    }else{




        if ($from=="" && $to=="" && $counsellor == "" && $counsellor_id == "") {
            echo("Invalid Input");
            die();
        }
        
        if ($counsellor!="" && ($from=="" && $to=="") && $counsellor_id == "") {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE lead_management.lead_owner = '$counsellor' AND asms_users_info.company_id = '$company'
            GROUP BY lead_management.lead_owner");
    
        //    GROUP BY lead_management.lead_owner".$qery_data);
            //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
            return $query->result();
            // $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
        }
        else if($counsellor=="" && ($from!="" && $to!="") && $counsellor_id == "")
        {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND asms_users_info.company_id = '$company'
            GROUP BY lead_management.lead_owner");
    
        //    GROUP BY lead_management.lead_owner".$qery_data);
            //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
            return $query->result();

        }
        else if($counsellor!="" && ($from!="" && $to!="") && $counsellor_id == "")
        {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND lead_management.lead_owner = '$counsellor' AND asms_users_info.company_id = '$company'
            GROUP BY lead_management.lead_owner");
            return $query->result();
        }


        ////////////////////////////////////////////////lead_owner///////////////////////////////////////////////

        else if ($counsellor=="" && ($from=="" && $to=="") && $counsellor_id != "") {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE lead_management.lead_owner = '$counsellor_id' AND asms_users_info.company_id = '$company'
            GROUP BY lead_management.lead_owner");
    
        //    GROUP BY lead_management.lead_owner".$qery_data);
            //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
            return $query->result();
            // $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
        }
        
        else if($counsellor=="" && ($from!="" && $to!="") && $counsellor_id != "")
        {
            $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
            FROM lead_management
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
            LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
            WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND lead_management.lead_owner = '$counsellor_id' AND asms_users_info.company_id = '$company'
            GROUP BY lead_management.lead_owner");
            return $query->result();
        }
    }
}elseif ($this->ion_auth->in_group($groups_2))
{
     
    if ($from=="" && $to=="" && $counsellor == "" && $counsellor_id == "") {
        echo("Invalid Input");
        die();
    }
    
    if ($counsellor!="" && ($from=="" && $to=="") && $counsellor_id == "") {
        $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE lead_management.lead_owner = '$counsellor'
        GROUP BY lead_management.lead_owner");

    //    GROUP BY lead_management.lead_owner".$qery_data);
        //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
        return $query->result();
        // $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
    }
    else if($counsellor=="" && ($from!="" && $to!="") && $counsellor_id == "")
    {
        $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to')
        GROUP BY lead_management.lead_owner");

    //    GROUP BY lead_management.lead_owner".$qery_data);
        //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
        return $query->result();

    }
    else if($counsellor!="" && ($from!="" && $to!="") && $counsellor_id == "")
    {
        $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND lead_management.lead_owner = '$counsellor'
        GROUP BY lead_management.lead_owner");
        return $query->result();
    }


    ////////////////////////////////////////////////lead_owner///////////////////////////////////////////////

    else if ($counsellor=="" && ($from=="" && $to=="") && $counsellor_id != "") {
        $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE lead_management.lead_owner = '$counsellor_id'
        GROUP BY lead_management.lead_owner");

    //    GROUP BY lead_management.lead_owner".$qery_data);
        //  WHERE (lead_management.lead_created_date BETWEEN '$from' AND '$to') AND lead_management.id IS NOT NULL".$qery_data);
        return $query->result();
        // $qery_data .= " AND lead_management.lead_owner = '$counsellor' ";
    }
    
    else if($counsellor=="" && ($from!="" && $to!="") && $counsellor_id != "")
    {
        $query =$this->db->query("SELECT asms_users_info.name as l_coun,lead_management.lead_owner
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from' AND '$to') AND lead_management.lead_owner = '$counsellor_id'
        GROUP BY lead_management.lead_owner");
        return $query->result();
    }
}
        
    }
 


    public function all_leads_by_owner($lead_owner)
    {
        $query =$this->db->query("SELECT lead_management.lead_id_code
        FROM lead_management
        WHERE lead_management.lead_owner = '$lead_owner'
        GROUP BY lead_management.lead_id_code");
        return $query->result();
    }
    public function course_data($lead_owner)
    {
         
        $query =$this->db->query("SELECT asms_m_programs.id as cid,asms_m_programs.code as ccode,lead_management.id as ld_tb_id
        FROM lead_management
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        WHERE lead_management.lead_owner = '$lead_owner'
        GROUP BY lead_management.programe");
         return $query->result();
    }

    public function lead_data($lead_owner,$cid)
    {

        
        $query =$this->db->query("SELECT lead_management.lead_id_code,lead_management.id
        FROM lead_management
        WHERE lead_management.lead_owner = '$lead_owner' AND lead_management.programe='$cid'
        GROUP BY lead_management.lead_id_code");
         return $query->result();
    }


    public function get_int_level()
    {
        $this->db->select('asms_lead_interest_level.id as int_id,asms_lead_interest_level.name');
        $this->db->from('asms_lead_interest_level');
        $query=$this->db->get();
        return $query->result();
    }


    public function sep_contact_count($l_id,$from_date,$to_date)
    {
 
       
        $query =$this->db->query("SELECT lead_management.lead_id_code,asms_lead_changes_histories.id
        FROM lead_management
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE lead_management.id = '$l_id' AND (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from_date' AND '$to_date')");
        return $query->num_rows();

    }

    public function sep_not_contact_count($l_id,$from_date,$to_date)
    {
        $query =$this->db->query("SELECT lead_management.lead_id_code,lead_management.feedback
        FROM lead_management
        WHERE lead_management.id 
        NOT IN (SELECT asms_lead_changes_histories.lead_id
                FROM asms_lead_changes_histories
                WHERE 
                asms_lead_changes_histories.lead_id='$l_id' AND (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from_date' AND '$to_date'))
                AND lead_management.id='$l_id'  ");
       
       
       return $query->num_rows();
        // return $query->result();
    }

    public function int_contact_count($lead_owner,$cid,$from_date,$to_date,$int_id)
    {
       
        
        $query =$this->db->query("SELECT lead_management.lead_id_code,asms_users_info.name as l_coun,
        lead_management.lead_owner,lead_management.feedback,lead_management.int_level
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_changes_histories ON asms_lead_changes_histories.lead_id = lead_management.id
        WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from_date' AND '$to_date') AND lead_management.int_level='$int_id' AND lead_management.lead_owner='$lead_owner' AND lead_management.programe='$cid' 
        GROUP BY lead_management.lead_id_code");
       
       
       return $query->num_rows();
    }


    public function int_not_contact_count($lead_owner,$cid,$from_date,$to_date,$int_id)
    {
        $query =$this->db->query("SELECT lead_management.lead_id_code,asms_users_info.name as l_coun,
        lead_management.lead_owner,lead_management.feedback,lead_management.int_level
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        WHERE lead_management.id 
        NOT IN (SELECT asms_lead_changes_histories.lead_id
                FROM asms_lead_changes_histories
                WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from_date' AND '$to_date'))
                AND lead_management.int_level='$int_id' AND lead_management.lead_owner='$lead_owner' AND lead_management.programe='$cid'
                GROUP BY lead_management.lead_id_code");
        // WHERE (DATE_FORMAT(asms_lead_changes_histories.created_at,'%Y-%m-%d') BETWEEN '$from_date' AND '$to_date') 
        // GROUP BY lead_management.lead_id_code");
       
       
       return $query->num_rows();
    }

  
    
    

    

    
}