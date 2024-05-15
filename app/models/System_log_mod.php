<?php
/**
 * Created by PhpStorm.
 * User: S.Priyadarshan
 * Date: 07-Jul-16
 * Time: 12:26 PM
 */

class System_log_mod extends CI_Model
{
    private $system_log_table = 'auth_system_log';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function create_system_log($data)
    {
        $this->db->insert($this->system_log_table, $data);
        return $this->db->insert_id();
    }
}