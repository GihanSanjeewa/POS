<?php


class Dropout_students_mod extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function check_alredy_custom_save_plans($program_enrollment_id,$program_id,$payment_plan,$batch_id,$intake){
        $this->db->select('*');
        // this is associative array.we need to check 3 multiple where clauses
        $check = array('program_enrollment_id' => $program_enrollment_id, 'program_id' => $program_id, 'batch_id' => $batch_id, 'payment_plan_id' => $payment_plan,'status' => "1");
        //$check = array('student_id' => $student_id, 'program_id' => $program_id, 'program_fee_id' => $program_fee_id);
        $this->db->where($check);
        $this->db->from('asms_program_fees');
        $query=$this->db->get();
        return $query->row();
//        return $query->num_rows();
    }
    public function check_already_in_custom_plan($new_program_fee_id,$student_id){
        $this->db->select('*');
        // this is associative array.we need to check 3 multiple where clauses
        $check = array('program_fee_id' => $new_program_fee_id, 'custom_student_id' => $student_id,'status' => "1");
        //$check = array('student_id' => $student_id, 'program_id' => $program_id, 'program_fee_id' => $program_fee_id);
        $this->db->where($check);
        $this->db->from('asms_program_fee_details');
        $query=$this->db->get();
        return $query->row();
//        return $query->num_rows();
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
}