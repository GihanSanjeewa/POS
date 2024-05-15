<?php

class Batch_logs_mod extends CI_Model
{
    public function __construct()
{
        $this->load->database();
        $this->load->library('datatables');

}
    public function get_branches()
    {
        $this->db->select('*');
        $this->db->from('asms_m_branches');

        $query = $this->db->get();
        return $query->result();
    }
    public function get_programs()
    {
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_batches(){
        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $this->db->order_by("asms_m_batches.id", "ASC");
        $query=$this->db->get();
        return $query->result();
    }
    public function get_batch_by_branch($branch_id,$program_id){
        $this->db->select('asms_m_batches.id,asms_m_batches.name,asms_m_batches.batch_code');
        $this->db->from('asms_m_batches');
        $this->db->join('asms_m_batch_intakes','asms_m_batches.id=asms_m_batch_intakes.batch_id','left');
        $this->db->where(array('asms_m_batch_intakes.branch_id'=> $branch_id,'asms_m_batches.program_id'=>$program_id));
        $this->db->order_by('asms_m_batches.id', 'DESC');
        $query=$this->db->get();
        return $query->result();
    }
    public function checkpaymentInfo($batch,$branch,$course){

        if ($branch == "") {
           echo("Please Input at least Branch");
            die();
       }

        if ($batch!=""){
            $qery_data = "  AND asms_m_batches.id='$batch' ";
        }
        if ($course!=""){
            $qery_data = " AND asms_m_programs.id= '$course' ";
        }

            $query = $this->db->query("SELECT asms_m_batches.batch_code AS CODE,asms_m_branches.name AS NAME,asms_m_programs.name AS PRG,asms_m_batches.created_at AS START
                                FROM asms_m_batches
                                LEFT JOIN  asms_m_programs ON asms_m_batches.program_id=asms_m_programs.id
                                LEFT JOIN asms_m_batch_intakes ON asms_m_batches.id=asms_m_batch_intakes.batch_id
                                LEFT JOIN asms_m_branches ON asms_m_batch_intakes.branch_id=asms_m_branches.id
                                WHERE asms_m_branches.id= '$branch'".$qery_data);
            return $query->result();
        }


}
