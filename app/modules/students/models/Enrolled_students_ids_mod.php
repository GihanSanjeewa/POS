<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/4/2019
 * Time: 3:46 PM
 */

class Enrolled_students_ids_mod extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_book_ids($id){

        $this->db->select('*');
        $this->db->from('asms_students_register');
        $this->db->where(array('id'=>$id));
        $query=$this->db->get();
        return $query->row();
    }

    public function get_course_data_by_id($id){

        $this->db->select('*');
        $this->db->from('asms_m_programs_universities');
        $this->db->where(array('m_program_id'=>$id));
        $query=$this->db->get();
        return $query->row();
    }


    public function get_disipline_data_by_id($id){

        $this->db->select('*');
        $this->db->from('asms_discipline_list');
        $this->db->where(array('id'=>$id));
        $query=$this->db->get();
        return $query->row();
    }

    public function get_student_photo($id){

        $this->db->select('*');
        $this->db->from('asms_students_photos');
        $this->db->where(array('student'=>$id));
        $query=$this->db->get();
        return $query->row();
    }

    public function get_students_info_by_id($where){
        $this->db->select('id,student_id,nic_number');
        $this->db->from('asms_students_info');
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
}