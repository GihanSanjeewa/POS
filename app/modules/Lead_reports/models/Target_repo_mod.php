<?php

class Target_repo_mod extends CI_Model
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

    public function get_programes()
    {

        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();

    }

    public function get_programs_targets($program)
    {
        if ($program != "") {
            $query = $this->db->query("SELECT asms_m_programs.*
         FROM asms_m_programs
         WHERE asms_m_programs.id = '$program'");
            return $query->result();
        } else {
            $query = $this->db->query("SELECT asms_m_programs.*
            FROM asms_m_programs");
            return $query->result();
        }

    }

///////////monthly target//////////////////////
    public function get_monthly_targets($pro_id,$month)
    {
        // var_dump($pro_id,$month);
        // die();
        $query = $this->db->query("SELECT SUM(asms_lead_target_intakes_monthly.sub_target) as month_target_sum
        FROM asms_lead_target_monthly
        LEFT OUTER JOIN asms_lead_target_intakes_monthly ON asms_lead_target_intakes_monthly.lead_target_monthly_tb_id = asms_lead_target_monthly.id
        WHERE asms_lead_target_intakes_monthly.month='$month' AND asms_lead_target_monthly.program='$pro_id'");
        return $query->row();
        
    }

////////////actual monthly target/////////////////
    public function get_actual_monthly_targets($pro_id,$month_start_date,$month_end_date)
    {
       
        
        $query = $this->db->query("SELECT count(lead_management.id) as lead_count
        FROM lead_management
        WHERE lead_management.programe='$pro_id' AND lead_management.status_option='Enrolled' AND lead_management.enrolled_date BETWEEN '$month_start_date' AND '$month_end_date'");
         
        return $query->row();

    }

    public function get_intake_plan($yr1_start,$yr2_end)
    {
        $query=$this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date,asms_lead_target_intakes.target
        FROM  asms_lead_target
        LEFT OUTER JOIN asms_lead_target_intakes ON asms_lead_target.id=asms_lead_target_intakes.lead_target_tb_id
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id=asms_lead_target_intakes.batch_id
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
        LEFT OUTER JOIN asms_m_intakes_list
        ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_m_programs
        ON asms_m_programs.id = asms_m_batches.program_id
        WHERE asms_lead_target.from_date='$yr1_start' AND asms_lead_target.to_date='$yr2_end'"); 

       
        return $query->result();

    }


    public function get_intake_targets($pro_id,$bi_id,$yr1_start,$yr2_end)
    {
        $query=$this->db->query("SELECT asms_lead_target_intakes.target
        FROM asms_lead_target
        LEFT OUTER JOIN asms_lead_target_intakes ON asms_lead_target_intakes.lead_target_tb_id = asms_lead_target.id
        WHERE asms_lead_target.from_year='$yr1_start' AND asms_lead_target.to_year='$yr2_end' AND asms_lead_target.program='$pro_id' AND asms_lead_target_intakes.batch_id='$bi_id'"); 
        
               
        return $query->row();
    }


    public function get_weekly_actual_targets($pro_id,$date1,$date2)
    {
        $query = $this->db->query("SELECT count(lead_management.id) as lead_count_weekly
        FROM lead_management
        WHERE lead_management.programe='$pro_id' AND lead_management.status_option='Enrolled' AND lead_management.enrolled_date BETWEEN '$date1' AND '$date2'");
         
        return $query->row();
    }

}
