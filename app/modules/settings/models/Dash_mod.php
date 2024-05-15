<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dash_mod extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }



    function GetSystemDetails($start_date,$end_date)
    {
           
        $sql = "SELECT auth_system_log.*,auth_users.first_name from auth_system_log left outer join auth_users on auth_system_log.user_id=auth_users.id where DATE_FORMAT(date_time,'%Y-%m-%d')>='$start_date' and  DATE_FORMAT(date_time,'%Y-%m-%d')<='$end_date' order by auth_system_log.id DESC";

        $res = $this->db->query($sql);

        if ($res->num_rows() > 0) {
            foreach (($res->result()) as $row) {
                $data[] = array(
                    "id" => $row->id,
                    "username" => $row->first_name,
                    "ip_address" => $row->ip_address,
                    "date_time" => $row->date_time,
                    "action" => $row->action,
                    "status" => $row->status,
                    "log_message" => $row->log_message          
                );
            }
            return $data;
        }
  
    }


}