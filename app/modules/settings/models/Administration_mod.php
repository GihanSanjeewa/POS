<?php
class Administration_mod extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public $settings = array();
    public $modules = array();

    function get_admin_settings()
    {
        $this->db->where('t_id', 1);
        $q = $this->db->get('asms_admin_settings');
        if ($q->row()) {
            return $q->row()->setting_value;
        } else {
            return NULL;
        }
    }

    public function get($key)
    {
        $this->db->select('setting_value');
        $this->db->where('setting_key', $key);
        $query = $this->db->get('asms_admin_settings');

        if ($query->row()) {
            return $query->row()->setting_value;
        } else {
            return NULL;
        }
    }

    public function save($key, $value)
    {
        $db_array = array(
            'setting_key' => $key,
            'setting_value' => $value
        );

        if ($this->get($key) !== NULL) {
            $this->db->where('setting_key', $key);
            $this->db->update('asms_admin_settings', $db_array);
        } else {
            $this->db->insert('asms_admin_settings', $db_array);
        }
    }

    public function delete($key)
    {
        $this->db->where('setting_key', $key);
        $this->db->delete('asms_admin_settings');
    }

    public function load_settings()
    {
        $ip_settings = $this->db->get('asms_admin_settings')->result();
        foreach ($ip_settings as $data) {
            $this->settings[$data->setting_key] = $data->setting_value;
        }
    }

    public function setting($key)
    {
        return (isset($this->settings[$key])) ? $this->settings[$key] : '';
    }

    public function set_setting($key, $value)
    {
        $this->settings[$key] = $value;
    }



    public function load_modules()
    {
        $ip_settings = $this->db->get('auth_system_module_sections')->result();
        foreach ($ip_settings as $data) {
            $this->modules[$data->title] = $data->status;
        }
    }

    public function modules($key)
    {
        return (isset($this->modules[$key])) ? $this->modules[$key] : '';
    }

    public function set_modules($key, $value)
    {
        $this->modules[$key] = $value;
    }

//    public function getDepartmentGroup()
//    {
//        $this->db->select('id,parent,desc');
//        $this->db->from('hr_pay_m_departments');
//        $this->db->group_by('parent');
//        $this->db->order_by('parent','ASC');
//        $query = $this->db->get();
//        return $query->result();
//    }
//
//    public function getDepartments($where=null)
//    {
//        $this->db->select('id,desc as title,code,parent as parent_id');
//        $this->db->from('hr_pay_m_departments');
//        $this->db->order_by('parent','ASC');
//        if(!$where){
//            $this->db->where($where);
//        }
//        $query = $this->db->get();
//
//        return $query->result();
//    }
//
//    public function getEmployeeByDepartment($where)
//    {
//        $this->db->select('job_title,COUNT(id) AS counts');
//        $this->db->from('aq_users');
//        $this->db->where($where);
//        $this->db->group_by('job_title');
//        $query = $this->db->get();
//        return $query->result();
//    }
}