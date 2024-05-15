<?php


class Intakes_logs_mod extends CI_Model
{
    public function __construct() {
        $this->load->database();
        $this->load->library('datatables');
    }

    public function get_intakes(){
        $this->db->select('asms_m_batch_intakes.id,asms_m_intakes_list.intake_name,asms_m_batch_intakes.year');
        $this->db->from('asms_m_batch_intakes');
        $this->db->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->db->order_by("asms_m_batch_intakes.id", "ASC");
        $query=$this->db->get();
        return $query->result();
    }

    public function get_batches(){
        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $this->db->order_by("asms_m_batches.id", "ASC");
        $query=$this->db->get();
        return $query->result();
    }

    public function get_branch(){
        $this->db->select('*');
        $this->db->from('asms_m_branches');
        $this->db->order_by("asms_m_branches.id", "ASC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_programs()
    {
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();
    }

    public function checkIntakeInfo($period1,$period2,$batch,$branch,$course){

        if ($period1 == "" && $period2 == "") {
            echo("Invalid Input");
            die();
        }

        if ($branch!=""){
            $qery_data = " AND asms_m_batch_intakes.branch_id='$branch' ";
        }
        if ($course!=""){
            $qery_data = " AND asms_m_programs.id ='$course'";
        }
        if ($batch!="") {
            $qery_data .= " AND asms_m_batches.id = '$batch' ";
        }

            $query=$this->db->query("SELECT asms_m_batch_intakes.year AS YEAR, asms_m_batch_intakes.start_date AS START_DATE,asms_m_intakes_list.intake_name AS INTAKE, asms_m_batch_intakes.end_date AS END_DATE, asms_m_branches.name AS BRANCHES,  asms_m_programs.name AS COURSE_NAME,asms_m_batches.batch_code AS BATCH_CODE,asms_m_batch_intakes.`status` AS ST
from asms_m_batch_intakes
LEFT JOIN asms_m_branches ON asms_m_batch_intakes.branch_id=asms_m_branches.id
LEFT JOIN  asms_m_batches ON asms_m_batch_intakes.batch_id=asms_m_batches.id
LEFT JOIN asms_m_intakes_list ON asms_m_batch_intakes.intake_list_id=asms_m_intakes_list.id
LEFT JOIN asms_m_programs ON asms_m_batches.program_id=asms_m_programs.id
WHERE asms_m_batch_intakes.year BETWEEN '$period1' AND '$period2' ". $qery_data ." 
GROUP BY asms_m_programs.id,asms_m_batch_intakes.branch_id
ORDER BY asms_m_batch_intakes.year DESC"  );
            return $query->result();

    }
}