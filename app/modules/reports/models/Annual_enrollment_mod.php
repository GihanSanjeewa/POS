<?php


class Annual_enrollment_mod extends CI_Model
{
public function __construct()
{
    $this->load->database();
    $this->load->library('datatables');

}
    public function get_branch(){
        $this->db->select('*');
        $this->db->from('asms_m_branches');
        $this->db->order_by("asms_m_branches.id", "ASC");
        $query=$this->db->get();
        return $query->result();
    }

    public function get_batches(){
        $this->db->select('asms_m_batches.batch_code');
        $this->db->from('asms_m_batches');
        $this->db->order_by("asms_m_batches.id", "ASC");
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

    public function EnrollmentsResults($batch,$branch,$course,$year,$intakes){
        $status= trim($year);
        if ($year == "") {
            echo("Please Input Details");
            die();
        }

        if ($course!="") {

            $qery_data .= " AND asms_m_programs.id = '$course' ";

        }

        if ($branch!="") {

            $qery_data .= " AND asms_students_register.pref_branch= '$branch' ";

        }

        if ($batch!="") {

            $qery_data .= " AND asms_students_register.batch = '$batch' ";

        }
        if ($intakes!="") {

            $qery_data .= " AND asms_students_register.intake = '$intakes' ";

        }
        $query=$this->db->query("SELECT asms_students_register.student_id AS ID, asms_students_register.st_full_name AS NAME,asms_m_batches.batch_code AS BATCH,asms_m_branches.name AS BRANCH,asms_m_programs.name AS PROGRAMME,asms_m_batch_intakes.year AS YEAR,asms_m_intakes_list.intake_name AS intake
FROM asms_students_register
JOIN asms_m_batch_intakes ON asms_students_register.intake=asms_m_batch_intakes.id
JOIN asms_m_intakes_list ON asms_m_batch_intakes.intake_list_id=asms_m_intakes_list.id
JOIN asms_m_branches ON asms_m_batch_intakes.branch_id=asms_m_branches.id
JOIN asms_m_batches ON asms_students_register.batch=asms_m_batches.id
JOIN asms_m_programs ON asms_m_batches.program_id=asms_m_programs.id
WHERE asms_m_batch_intakes.year='$status'".$qery_data);
        return $query->result();


    }
}