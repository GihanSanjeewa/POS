<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 9/27/2019
 * Time: 10:10 AM
 */

class Lead_mod extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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

    public function check_sdc_number($sdc){

        $this->db->select('*');
        $this->db->from('asms_pending_payments');
        $this->db->where('sdc_number',$sdc);
        $query=$this->db->get();

        if($query->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function view_class($id){

        $this->db->select('asms_class_arrangement.id,asms_class_arrangement.cls_name,asms_m_batches.name AS batch_name,asms_m_halls.name AS hall_name,asms_m_class_rooms.name AS class_name,asms_class_arrangement.actual_capacity,auth_users.first_name,asms_class_arrangement.created_at,asms_class_arrangement.updated_at');
        $this->db->from('asms_class_arrangement');
        $this->db->join('asms_m_batches','asms_m_batches.id=asms_class_arrangement.batch','left');
        $this->db->join('asms_m_halls','asms_m_halls.id=asms_class_arrangement.hall','left');
        $this->db->join('asms_m_class_rooms','asms_m_class_rooms.id=asms_class_arrangement.class','left');
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

        $this->db->select('id,student_id,nic_number');
        $this->db->from('asms_students_info');
        $this->db->where($where);
        $query=$this->db->get();

        return $query->row();

    }

    public function check_duplicate_allocation($where){

        $this->db->select('*');
        $this->db->from('asms_class_arrangement');
        $this->db->where($where);
        $query=$this->db->get();

        return $query->result();

    }

     public function get_all_ass_view(){

        $this->db->select('*');
        $this->db->from('assignmnet_view');
        $this->db->order_by('id','desc');

        $query=$this->db->get();

        return $query->result();

    }

        public function get_master_lead_source(){

        $this->db->select('*');
        $this->db->from('asms_m_lead_source');
        $query=$this->db->get();
        return $query->result();

    }

        public function get_programes(){

        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query=$this->db->get();
        return $query->result();

    }

}