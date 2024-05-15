<?php
/**
 * Created by PhpStorm.
 * User: Earrow_PC03
 * Date: 8/3/2017
 * Time: 10:15 AM
 */

class System_users_model extends CI_Model
{
    var $table = 'hr_pay_employees';
    var $column = array('employee_id', 'name', 'job_title', 'department', 'section');
    var $order = array('employee_id' => 'asc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_by_id($id)
    {
        $this->db->select('hr_pay_employees.*');
        $this->db->from($this->table);
        $this->db->where('hr_pay_employees.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function getEmployees()
    {
        $this->db->select('id,username');
        $this->db->from('auth_users');
        $this->db->where(array('is_employee'=>1,'active'=>1));
        $query=$this->db->get();
        return $query->result();
    }

    public function getEmployeesFullData()
    {
        $this->db->select('
        auth_users.id,
        auth_users.username,
        hr_pay_employees.first_name,
        hr_pay_employees.last_name,
        hr_pay_employees.employee_id');
        $this->db->from('auth_users');
        $this->db->join('hr_pay_employees','hr_pay_employees.id=auth_users.id');
        $this->db->where(array('auth_users.is_employee'=>1,'auth_users.active'=>1));
        $query=$this->db->get();
        return $query->result();
    }

    public function getAllEmployees()
    {
        $this->db->select('*');
        $this->db->from('hr_pay_employees');
        $this->db->where(array('system_user'=>0,'Status'=>'Active'));
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function getBranchSubStores()
    {
        $this->db->select('m_org_branches.id as bid, m_org_branches.name as bname, m_org_branch_stores.name as bst_name,m_org_branch_stores.code as bst_code,  m_org_branch_stores.id as bst_id');
        $this->db->from('m_org_branches');
        $this->db->join('m_org_branch_stores','m_org_branches.id=m_org_branch_stores.b_id');
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getAllBranchesbyUser($user_id)
    {
        $this->db->select('m_org_branches.id as bid, m_org_branches.name as bname');
        $this->db->from('m_org_branches');
        $this->db->join('hr_pay_system_users','hr_pay_system_users.branch_id=m_org_branches.id');
        $this->db->where(array('hr_pay_system_users.employee_id'=>$user_id));
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getBranchCount()
    {
        $this->db->select('*');
        $this->db->from('m_org_branches');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function view_checked_values(){
        $this->db->select('*');
        $this->db->from('hr_pay_system_users');
        $this->db->where('employee_id !=',1);
        $query=$this->db->get();

        return $query->result();
    }

    public function getBranches()
    {
        $this->db->select('*');
        $this->db->from('m_org_branches');
        $query = $this->db->get();

        return $query->result();
    }

    public function load_system_users(){
        $this->db->select('*');
        $this->db->from('auth_users');
        $this->db->where('is_employee =',1);
        $this->db->where('active =',1);
        $query=$this->db->get();

        return $query->result();
    }
    public function b_u_matrix_data(){
        $this->db->select('*');
        $this->db->from('hr_pay_system_users');
        $query=$this->db->get();

        return $query->result();
    }

    public function view_branches($userId){
        $this->db->select('hr_pay_system_users.branch_id,m_org_branches.code,m_org_branches.name');
        $this->db->from('hr_pay_system_users');
        $this->db->where(array('employee_id'=>$userId));
        $this->db->join('m_org_branches','m_org_branches.id=hr_pay_system_users.branch_id');
        $query=$this->db->get();

        return $query->result();
    }

    public function insert_data($data){
        $this->db->insert('hr_pay_system_users',$data);
        return $this->db->insert_id();
    }

    public function delete_data($where){
        $this->db->where($where);
        $this->db->delete('hr_pay_system_users');
        return true;
    }
    public function delete_stores_data($user,$branch){
        $this->db->where('user_id',$user);
        $this->db->where('branch_id',$branch);
        $this->db->delete('hr_pay_system_user_branch_stores');
    }

    public function session_change_branch($branch_id)
    {
        $this->db->select('id,name,code');
        $this->db->from('m_org_branches');
        $this->db->where(array('id'=>$branch_id));
        $query = $this->db->get();

        return $query->result();
    }

    public function get_branchid_by_storeid($store_id)
    {
        $q = $this->db->get_where('m_org_branch_stores', array('id' => $store_id));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    public function getModules()
    {
        $this->db->select('id,name,section');
        $this->db->from('auth_system_modules');
        $query = $this->db->get();

        return $query->result();
        /*$q = $this->db->get('auth_system_modules');
        $dts = array();
        if ($q->result()) {
            foreach ($q->result() as $dt) {
                $dts[$dt->id][0] = $dt->name;
                $dts[$dt->id][1] = $dt->section;
            }
            return $dts;
        }*/
    }
    public function getModuleSections()
    {
        $this->db->select('id,title,status');
        $this->db->from('auth_system_module_sections');
        $this->db->where(array('status'=>1));
        $query = $this->db->get();

        return $query->result();
        /*$q = $this->db->get('auth_system_module_sections');

        $dts = array();
        if ($q->result()) {
            foreach ($q->result() as $dt) {
                $dts[$dt->id] = $dt->title;
            }
            return $dts;
        }*/
    }

    public function get_sys_permission_data_by_userid($id)
    {
        $this->db->where(array('user_id'=>$id));
        $q = $this->db->get('auth_system_permissions');
        $dts = array();
        if ($q->result()) {
            foreach ($q->result() as $dt) {
                $dts[$dt->id] = $dt->module_id;
            }
            return $dts;
        }
        /*if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }*/
    }

    public function get_sys_user_branch_stores_by_userid($id)
    {
        $this->db->where(array('user_id'=>$id));
        $q = $this->db->get('hr_pay_system_user_branch_stores');
        $dts = array();
        if ($q->result()) {
            foreach ($q->result() as $dt) {
                $dts[$dt->id] = $dt->store_id;
            }
            return $dts;
        }
        /*if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }*/
    }

    public function delete_user_permissions($where)
    {
        $this->db->where('user_id', $where);
        $this->db->delete('auth_system_permissions');
        return true;
    }

    public function delete_user_stores($where)
    {
        $this->db->where('user_id', $where);
        $this->db->delete('hr_pay_system_user_branch_stores');
        return true;
    }


    public function get_sys_user_data_by_userid($id)
    {
        $this->db->select('id,username,email');
        $q = $this->db->get_where('auth_users', array('id'=>$id));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    public function get_sys_user_group($id)
    {

        $this->db->select('*');
        $this->db->from('auth_users_groups');
        $this->db->where('user_id', $id);

        $q = $this->db->get();

        $data=array();

        foreach($q->result() as $row){
            $data[] = $row->group_id;
        }
        return ($data);

    }

    public function getAllGroups()
    {
        $this->db->select('*');
        $this->db->from('auth_groups');
        $this->db->where('auth_groups.id!=','1');
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }

    public function user_validate($u_id,$m_id)
    {
        $this->db->select('*');
        $this->db->from('auth_system_permissions');
        $this->db->where(array('user_id'=>$u_id,'module_id'=>$m_id));
        $q = $this->db->get();
        return $q->row();
    }
}