<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/4/2019
 * Time: 3:46 PM
 */

class Qualified_students_mod extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function view_program($id){

        $this->db->select("asms_student_programs.id,asms_m_programs.name AS program_name,asms_m_batches.name AS batch_name,asms_payments_plan.name AS payment_plan,asms_student_programs.created_at,asms_student_programs.updated_at,IF(asms_student_programs.status=0, 'Inactive', 'Active') AS stats");
        $this->db->from('asms_student_programs');
        $this->db->join('asms_students_register','asms_students_register.id=asms_student_programs.student_id','left');
        $this->db->join('asms_m_batches','asms_m_batches.id=asms_student_programs.batch_id','left');
        $this->db->join('asms_m_programs','asms_m_programs.id=asms_student_programs.program_id','left');
        $this->db->join('asms_program_fees','asms_program_fees.id=asms_student_programs.program_fee_id','left');
        $this->db->join('asms_payments_plan','asms_payments_plan.id=asms_program_fees.payment_plan_id','left');
        $this->db->where(array('asms_student_programs.student_id'=>$id));
        $query=$this->db->get();

        return $query->result_array();

    }










    public function save($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    public function update($table,$data,$where){
        $this->db->update($table,$data,$where);
        return true;
    }

    public function delete($table,$where){
        $this->db->delete($table,$where);
        return true;
    }

    public function get_list_by_id($table,$select,$where){

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query=$this->db->get();

        return $query->row();

    }

    public function get_batches(){

        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $query=$this->db->get();

        return $query->result();

    }

    public function view_class($id){

        $this->db->select('asms_class_arrangement.id,asms_m_batches.name AS batch_name,asms_m_semesters.name AS semester_name,asms_m_halls.name AS hall_name,asms_m_class_rooms.name AS class_name,asms_m_course_topics.name AS subject_name,asms_class_arrangement.actual_capacity,asms_class_arrangement.available_capacity,auth_users.first_name,asms_class_arrangement.created_at,asms_class_arrangement.updated_at');
        $this->db->from('asms_class_arrangement');
        $this->db->join('asms_m_batches','asms_m_batches.id=asms_class_arrangement.batch','left');
        $this->db->join('asms_m_batch_semester','asms_m_batch_semester.id=asms_class_arrangement.semester','left');
        $this->db->join('asms_m_semesters','asms_m_semesters.id=asms_m_batch_semester.semester','left');
        $this->db->join('asms_m_halls','asms_m_halls.id=asms_class_arrangement.hall','left');
        $this->db->join('asms_m_class_rooms','asms_m_class_rooms.id=asms_class_arrangement.class','left');
        $this->db->join('asms_m_course_topics','asms_m_course_topics.id=asms_class_arrangement.subject','left');
        $this->db->join('auth_users','auth_users.id=asms_class_arrangement.user','left');
        $this->db->where(array('asms_class_arrangement.id'=>$id));
        $query=$this->db->get();

        return $query->result_array();

    }
    public function get_classes_semester($id){

        $this->db->select('*');
        $this->db->from('asms_m_batch_semester');
        $this->db->where(array('batch'=>$id));
        $query=$this->db->get();

        return $query->result();

    }
    public function get_batch(){

        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $query=$this->db->get();

        return $query->result();

    }

    public function get_halls(){

        $this->db->select('*');
        $this->db->from('asms_m_halls');
        $query=$this->db->get();

        return $query->result();

    }

    public function get_semester($id){

        $this->db->select('asms_m_semesters.id,asms_m_semesters.name');
        $this->db->from('asms_m_batch_semester');
        $this->db->join('asms_m_semesters','asms_m_semesters.id=asms_m_batch_semester.semester','left');
        $this->db->where('asms_m_batch_semester.batch',$id);
        $query=$this->db->get();

        return $query->result();

    }

    public function get_subject($id){

        $this->db->select('asms_m_course_topics.id,asms_m_course_topics.code,asms_m_course_topics.name');
        $this->db->from('asms_m_subject_allocation');
        $this->db->join('asms_m_course_topics','asms_m_course_topics.id=asms_m_subject_allocation.subject');
        $this->db->where('asms_m_subject_allocation.semester',$id);
        $query=$this->db->get();

        return $query->result();

    }

    public function get_classes($id){

        $this->db->select('*');
        $this->db->from('asms_m_class_rooms');
        $this->db->where('asms_m_class_rooms.hall',$id);
        $query=$this->db->get();

        return $query->result();

    }

    public function get_master_batch(){

        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $query=$this->db->get();

        return $query->result();

    }

    public function get_students_info_by_id($where){

        $this->db->select('id,student_id,st_nic_num AS nic_number');
        $this->db->from('asms_students_register');
        $this->db->where($where);
        $query=$this->db->get();

        return $query->row();

    }

    public function get_batch_first_installment($where){

        $this->db->select('installment');
        $this->db->from('asms_m_batch_semester');
        $this->db->where($where);
        $query=$this->db->get();

        return $query->row();
    }

    public function get_qualified_students($batch,$installment,$semester)
    {

        $query=$this->db->query("SELECT asms_students_register.id as std_id,asms_students_register.student_id,asms_students_register.st_nic_num AS nic_number,asms_students_register.name,asms_students_register.batch,asms_m_batches.name AS batch_name,sum(amount) AS total_amount FROM (asms_students_register)
JOIN asms_student_payments ON asms_student_payments.std_ref_id=asms_students_register.id
JOIN asms_m_batches ON asms_m_batches.id=asms_students_register.batch
WHERE asms_students_register.batch=$batch AND asms_student_payments.status=0 AND asms_students_register.status=0 AND asms_student_payments.semester=$semester
 GROUP BY asms_student_payments.std_ref_id HAVING total_amount >= '$installment' ORDER BY std_id ASC");

        return $query->result();

    }
}