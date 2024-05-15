<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/16/2019
 * Time: 4:23 PM
 */

class Lead_users_mod extends CI_Model
{

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

    //nipun
    public function get_lecturer_data($id){
        $this->db->select('
        asms_m_teacher_modules_data.modules,
        asms_m_program_modules.name,
        asms_m_programs.name AS program_name,
        asms_m_programs.id AS program_id
         ');
        $this->db->from('asms_m_teacher_modules');
        $this->db->join('asms_m_teacher_modules_data','asms_m_teacher_modules_data.teacher_mod_id=asms_m_teacher_modules.id', 'left');
        $this->db->join('asms_m_program_modules','asms_m_program_modules.id=asms_m_teacher_modules_data.modules', 'left');
        $this->db->join('asms_m_program_m_c','asms_m_program_m_c.module_id=asms_m_program_modules.id', 'left');
        $this->db->join('asms_m_programs','asms_m_program_m_c.program_id=asms_m_programs.id', 'left');
        $this->db->where('asms_m_teacher_modules.teacher_id', $id);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }
    // end nipun

    public function get_batches()
    {
        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $query = $this->db->get();

        return $query->result();
    }
    public function get_branches()
    {
        $this->db->select('*');
        $this->db->from('asms_m_branches');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_religions()
    {
        $this->db->select('*');
        $this->db->from('asms_m_religions');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_races()
    {
        $this->db->select('*');
        $this->db->from('asms_m_races');
        $query = $this->db->get();

        return $query->result();
    }

    function get_last_user_number()
    {
        $this->db->select('id');
        $this->db->from('asms_users_info');
        $query=$this->db->get();

        return $query->result();
    }

    public function get_user_photo_by_id($id)
    {
        $this->db->from('asms_users_photos');
        $this->db->where('user',$id);
        $query = $this->db->get();
        return $query;
    }

    public function get_by_id($id)
    {
        $this->db->select('id,user_id,title,full_name,name,address,phone,occupation,birthday,nic_number,gender,religion,user,created_at,updated_at,status');
        $this->db->from('asms_users_info');
        $this->db->where('asms_users_info.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_by_id_with_auth($id)
    {
        $this->db->select('std.company_id,std.id,std.user_id,std.branch_id,std.title,std.full_name,std.name,std.address,std.phone,std.occupation,std.birthday,std.nic_number,std.gender,std.religion,auth_users.first_name,auth_users.username,auth_users.email,std.created_at,std.updated_at,std.status');
        $this->db->from('asms_users_info std');
        $this->db->join('auth_users','auth_users.id=std.id','left');
        $this->db->where('std.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function view_by_id($id)
    {
        $this->db->select('std.id,std.user_id,std.title,std.full_name,std.name,std.address,std.phone,std.occupation,std.birthday,std.nic_number,std.gender,std.religion,auth_users.first_name,std.created_at,std.updated_at,std.status');
        $this->db->from('asms_users_info std');
        $this->db->join('auth_users','auth_users.id=std.user','left');
        $this->db->where('std.id',$id);
        $query = $this->db->get();

        return $query->row();
    }

    public function check_image_availability($std_id){

        $this->db->from('asms_users_photos');
        $this->db->where('user_id',$std_id);
        $query = $this->db->get();

        return $query;

    }

    //From System users
    public function get_by_id_sys_users($id)
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
        $this->db->from('asms_m_branches ');
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

    public function getModules()
    {
        $this->db->select('id,name,section');
        $this->db->from('auth_system_modules');
        $query = $this->db->get();

        return $query->result();
    }

    public function getModuleSections()
    {
        $this->db->select('id,title,status');
        $this->db->from('auth_system_module_sections');
        $this->db->where(array('status'=>1,'id'=>11));
        $query = $this->db->get();

        return $query->result();
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

    public function get_sys_user_branches($id)
    {

        $this->db->select('*');
        $this->db->from('auth_users_branches');
        $this->db->where('user_id', $id);

        $q = $this->db->get();

        $data=array();

        foreach($q->result() as $row){
            $data[] = $row->branch_id;
        }
        return ($data);

    }

    public function getAllGroups()
    {
        $this->db->select('*');
        $this->db->from('auth_groups');
        $this->db->where('auth_groups.lead_status=','1');
        $q = $this->db->get();
        if($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }

            return $data;
        }
    }


    public function getCompany()
    {
        $this->db->select('*');
        $this->db->from('asms_education_agent_company');
        $query = $this->db->get();
        return $query->result();
    }

    public function user_validate($u_id,$m_id)
    {
        $this->db->select('*');
        $this->db->from('auth_system_permissions');
        $this->db->where(array('user_id'=>$u_id,'module_id'=>$m_id));
        $q = $this->db->get();
        return $q->row();
    }

    public function load_programs()
    {
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();
    }
    public function load_programs_module($id)
    {
        $this->db->select('asms_m_program_modules.id,asms_m_program_modules.code,asms_m_program_modules.name');
        $this->db->from('asms_m_program_m_c');
        $this->db->join('asms_m_program_modules','asms_m_program_modules.id=asms_m_program_m_c.module_id','join');
        $this->db->where('asms_m_program_m_c.program_id',$id);
        $query = $this->db->get();

        return $query->result();
    }
    public function get_module_code($id)
    {
        $this->db->where('id',$id);
        $q = $this->db->get('asms_m_program_modules');

        if($q->num_rows() > 0) {
            return $q->row();
        }
    }

}