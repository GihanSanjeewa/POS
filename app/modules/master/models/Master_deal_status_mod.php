<?php

class Master_deal_status_mod extends CI_Model 
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
        $this->db->from('asms_m_deal');
        $this->db->where(array('asms_m_deal.id'=>$id));
        $query=$this->db->get();
        return $query->result_array();   
    }
}