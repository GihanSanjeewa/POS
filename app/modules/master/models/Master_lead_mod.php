<?php

class Master_lead_mod extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save($data,$table)
    {
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    public function update($table,$data,$pr_id){
        $this->db->update($table,$data);
        $this->db->where($pr_id,$pr_id);
        return true;
    }

    public function view($id)
    {
        $this->db->select('*');
        $this->db->from('asms_m_lead_source');
        $this->db->where(array('asms_m_lead_source.ref_number'=>$id));
        $query=$this->db->get();
        return $query->result_array();   
    }
}