<?php


class Student_dropout_mod extends CI_Model
{

    public function __construct()
{
    parent::__construct();
    $this->load->database();
    $this->load->library('datatables');
}

public function for_dropout_mockup(){
    $this->db->select('asms_students_register.id AS std_ref,asms_students_register.st_full_name AS name,asms_m_programs.name AS Programme,asms_students_register.st_qualified_status_note AS reason ');
    $this->db->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
    $this->db->from('asms_students_register');
    $this->db->limit(5,6);
    $query=$this->db->get();
    return $query->result();
}

    public function checkDropInfo(){

        $query=$this->db->query("SELECT COUNT(apfd.installment) AS cp,apfd.due_date AS due_date,pid.name AS Programme,apfd.installment AS installment,asr.student_id AS ID,asr.st_full_name AS Name,asr.id  AS std_ref,
            CASE 
            WHEN DATEDIFF(CURDATE(),apfd.due_date) > 0 
            THEN 'Past'
            ELSE 'Future'
            END status
            FROM asms_program_fee_details apfd
            JOIN asms_student_programs asp ON asp.program_fee_id=apfd.program_fee_id
            JOIN asms_m_programs pid ON asp.program_id=pid.id
            JOIN asms_students_register asr ON asr.id=asp.student_id
            WHERE apfd.id NOT IN (SELECT installment_id FROM asms_payments)");
        return $query->result();
    }

    public function view_drop_result($id){
        $query=$this->db->query("SELECT asms_dropouts_comments.student_id AS IDs,asms_dropouts_comments.f_comment AS f_c,asms_dropouts_comments.a_comment AS a_c,asms_dropouts_comments.m_comment AS m_c
FROM asms_dropouts_comments
WHERE asms_dropouts_comments.student_id='$id'");
        return $query->result();
    }

    public function drop_att(){

        $query=$this->db->query("SELECT asms_students_register.id AS s_id, asms_students_register.st_full_name AS name,asms_students_register.student_id AS reg_id,asms_m_programs.name AS sub, COUNT(asms_attendance_data.std_ref_id) AS att_c
FROM asms_attendance_data
JOIN asms_students_register ON asms_attendance_data.std_ref_id=asms_students_register.id
JOIN asms_m_programs ON asms_m_programs.id=asms_attendance_data.subject
WHERE asms_attendance_data.attendance_type='AB' AND asms_attendance_data.month BETWEEN '2020-05' AND '2020-06'
GROUP BY asms_attendance_data.std_ref_id
 ");
        return $query->result();
    }

    public function checkID($id){
        $query=$this->db->query("SELECT asms_students_register.id AS IDs
FROM asms_students_register
WHERE asms_students_register.id='$id'");
        return $query->result();
    }
}