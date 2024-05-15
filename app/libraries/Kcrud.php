<?php

/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/7/2019
 * Time: 2:38 PM
 */

/*
 *
 * KCrud Developed by VKC De-mel
 * Earrow (Pvt) Ltd.
 * kasun@earrow.net
 * 0719330984
 *
 * */

class Kcrud extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //data save
    public function save($table,$data){
        $this->db->insert($table,$data);
        return $this->db->insert_id();
    }

    //data update
    public function update($table,$data,$where){
        $this->db->update($table,$data,$where);
        return true;
    }

    //data delete
    public function delete($table,$where){
        $this->db->delete($table,$where);
        return true;
    }

    public function getDatatableInfo($select,$table,$where,$join,$action,$unset_column,$action_id){

        $this->load->library('datatables');

        $this->datatables->select($select,FALSE);

        $this->datatables->from($table);
        if($where){
            $this->datatables->where($where);
        }
        if($join){
            $this->datatables->join($join);
        }
        if($action){
            $this->datatables->add_column("Actions",$action,$action_id);
        }
        $this->datatables->unset_column($unset_column);
        echo $this->datatables->generate();

    }

    public function getValueOne($table,$select,$where,$like,$join,$group,$order){

        $query=$this->db->query("SELECT $select FROM $table $join WHERE $where $like $group $order");
        return $query->row();
    }

    public function getValueAll($table,$select,$where,$like,$join,$group,$order){

        $query=$this->db->query("SELECT $select FROM $table $join WHERE $where $like $group $order");
        return $query->result();
    }

}