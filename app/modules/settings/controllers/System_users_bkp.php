<?php
/**
 * Created by PhpStorm.
 * User: Earrow_PC03
 * Date: 8/3/2017
 * Time: 10:15 AM
 */
class System_users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->model('system_users_model','system');
        $this->load->model('ion_auth_model');
        $this->load->library('datatables');
        $this->load->library('session');
        $this->load->library('system_log');

        date_default_timezone_set("Asia/Colombo");
        $this->currentTime = date('Y-m-d H:i:s');
        $this->currentDate = date('Y-m-d');
    }

    public function index()
    {
//        $this->permissions->check_permission('access');

        $data['branches']=$this->system->getBranches();
        $data['branch_count']=$this->system->getBranchCount();
        $data['all_list_pcv']=$this->system->getEmployeesFullData();
        $data['AllEmployees']=$this->system->getAllEmployees();
        $data['AllGroups']=$this->system->getAllGroups();

        /*var_dump($data['all_list_pcv']);
        die();*/
        $this->load->helper('url');

        $this->load->view('common/header');
        $this->load->view('employee_list/system_users/index',$data);
        $this->load->view('common/footer');

    }

    /*public function insert_data(){

        $value=$this->input->post('value');
        $comma=explode(',', $value);

        $data=array(
            'employee_id'=>$comma[0],
            'branch_id'=>$comma[1],
            //'position'=>$comma[2],
        );

        $this->system->insert_data($data);
        echo json_encode(array('status'=>TRUE));
    }

    public function delete_data(){

        $value=$this->input->post('value');
        $comma=explode(',', $value);

        $this->system->delete_data(array('employee_id'=>$comma[0],'branch_id'=>$comma[1]));
        $this->system->delete_stores_data($comma[0],$comma[1]);
        echo json_encode(array('status'=>TRUE));
    }

    public function view_checked_values(){
        $output=$this->system->view_checked_values();
        echo json_encode($output);
    }*/

    public function view_branches(){

        $userId = $this->ion_auth->get_user_id();
        $output=$this->system->view_branches($userId);
        echo json_encode($output);
    }

    public function session_change_branch($branch_id){

        $this->session->unset_userdata('BRANCH2');
        $this->session->unset_userdata('BRANCH2_ID');
        $this->session->unset_userdata('BRANCH2_CODE');
        $branch=$this->system->session_change_branch($branch_id);
        $value=array_shift($branch);
        $this->session->set_userdata('BRANCH2',$value->name);
        $this->session->set_userdata('BRANCH2_ID',$value->id);
        $this->session->set_userdata('BRANCH2_CODE',$value->code);

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ajax_get_system_permissions_details_by_id(){
        $id = $this->input->post('sys_u_p_id');
        if (empty($id)) {
            echo json_encode(array(
                'status' => false,
                'message' => "Unable to get data. ID invalid."
            ));
        }

        $list_modules = $this->system->getModules();
        $list_sections = $this->system->getModuleSections();
        $sys_u_p_data = $this->system->get_sys_permission_data_by_userid($id);

        echo json_encode(array(
            'status' => true,
            'list_modules' => $list_modules,
            'list_sections' => $list_sections,
            'sys_u_p_data' => $sys_u_p_data
        ));
        exit;
    }

    public function  ajax_get_system_user_branch_stores_details_by_id(){
        $id = $this->input->post('sys_u_bs_id');
        if (empty($id)) {
            echo json_encode(array(
                'status' => false,
                'message' => "Unable to get data. ID invalid."
            ));
        }

        $list_BranchSubStores = $this->system->getBranchSubStores();
        $list_Branches = $this->system->getAllBranchesbyUser($id);
        $sys_u_bs_data = $this->system->get_sys_user_branch_stores_by_userid($id);

        echo json_encode(array(
            'status' => true,
            'list_BranchSubStores' => $list_BranchSubStores,
            'list_Branches' => $list_Branches,
            'sys_u_bs_data' => $sys_u_bs_data
        ));
        exit;
    }

    public function save_user_permissions(){

            $id = null;
            $message = null;
            $details = $this->input->post();
            $sys_u_p_id = $details['sys_u_p_id'];
            $data_main['sys_u_p_id'] = $sys_u_p_id;
            if (isset($details['userpermissions'])) {
                if ($this->system->delete_user_permissions($data_main['sys_u_p_id'])) {
                    $datasize = sizeof($details['userpermissions']);

                    foreach ($details['userpermissions'] as $key => $value) {
                        if (!empty($details['userpermissions'][$key])) {
                            $insert_item_data = array(
                                'user_id' => $sys_u_p_id,
                                'module_id' => $details['userpermissions'][$key],
                                'access_permission ' => "YES"
                            );
                            $id = $this->db->insert('auth_system_permissions', $insert_item_data);
                            unset($insert_item_data);
                        }
                    }
                }
                $message = 'User Permissions Updated '.$data_main['sys_u_p_id'];
                $this->system_log->create_system_log("System Users", "Success", $message);
            } else{
                if ($this->system->delete_user_permissions($data_main['sys_u_p_id'])) {
                    $id = 1;
                }
                $message = 'All User Permissions Removed for User #'.$data_main['sys_u_p_id'];
                $this->system_log->create_system_log("System Users", "Success", $message);
            }
            if (!empty($id) && $id > 0) {
                echo json_encode(array(
                    'status' => true,
                    'message' => $message
                ));
                exit;
            } else {
                echo json_encode(array(
                    'status' => false,
                    'message' => 'Unable to save! Try again.',
                ));
                exit;
            }
    }

    public function save_user($method){

        if ($method == "add") {
            $this->form_validation->set_rules('employee', 'employee', 'required|is_unique[auth_users.id]');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[auth_users.username]');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('password', 'Password','required|min_length[6]|max_length[15]|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm','Password Confirm', 'required');

            if ($this->form_validation->run() === FALSE) {
                $data = array();
                $data['error_string'] = array();
                $data['inputerror'] = array();
                $data['status'] = FALSE;
                $data['error'] = "validation_error";
                if (form_error('employee')) {
                    $data['inputerror'][] = 'employee';
                    $data['error_string'][] = form_error('employee');
                }
                if (form_error('username')) {
                    $data['inputerror'][] = 'username';
                    $data['error_string'][] = form_error('username');
                }
                if (form_error('email')) {
                    $data['inputerror'][] = 'email';
                    $data['error_string'][] = form_error('email');
                }
                if (form_error('password')) {
                    $data['inputerror'][] = 'password';
                    $data['error_string'][] = form_error('password');
                }
                if (form_error('password_confirm')) {
                    $data['inputerror'][] = 'password_confirm';
                    $data['error_string'][] = form_error('password_confirm');
                }

                echo json_encode($data);
                exit;
            }


            $id = null;
            $message = null;
            $details = $this->input->post();
            /*print_r($details);
            die();*/

            $employee = $details['employee'];
            $data_main['sys_u_p_id'] = $employee;

            $email    = strtolower($details['email']);
            $identity = $details['username'];
            $password = $details['password'];
            $user_group = $details['user_group'];

            $empdata = $this->system->get_by_id($employee);

            $additional_data = array(
                'id' => $employee,
                'is_employee' => 1,
                'first_name'  => $empdata->first_name,
                'otp'  => 1,
            );


                    $mod_data = array(
                        'user_id' => $employee,
                        'module_id' => 68,
                        'access_permission'  => 'YES',
                    );
                    $this->db->insert('auth_system_permissions',$mod_data);

                    $mod_data_1 = array(
                        'user_id' => $employee,
                        'module_id' => 11,
                        'access_permission'  => 'YES',
                    );
                   $this->db->insert('auth_system_permissions',$mod_data_1);
                    $mod_data_2 = array(
                        'user_id' => $employee,
                        'module_id' => 105,
                        'access_permission'  => 'YES',
                    );
                    $this->db->insert('auth_system_permissions',$mod_data_2);

            $group = array($user_group);
            if ($user_id = $this->ion_auth->register($identity, $password, $email,$additional_data,$group)) {

                $data = array(
                    'baseurl'	=> base_url(),
                    'first_name'	=> $empdata->first_name,
                    'last_name'	=> $empdata->last_name,
                    'user_name'		=> $identity,
                    'password'		=> $password,
                );
                $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('new_user_mail', 'ion_auth'), $data, true);
                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->to($email);
                $this->email->subject("Login Details for System");
                $this->email->set_mailtype("html");
                $this->email->message($message);

                /*echo $this->db->last_query();
                var_dump($_POST);exit;*/
                if ($this->email->send()) {
                    $message = 'User Created -' . $identity;
                    $this->system_log->create_system_log("System Users", "Success", "New System User #" . $user_id . " added for Employee ID #" . $employee);
                }

                echo json_encode(array(
                    'status' => true,
                    'message' => $message
                ));
                exit;
            } else {

                echo json_encode(array(
                    'status' => false,
                    'message' => 'Unable to save! Try again.',
                ));
                exit;
            }
        } elseif($method == "update") {


            $id = null;
            $message = null;
            $details = $this->input->post();
            $user_id = $details['user_id'];
            $q1 = $this->db->query("SELECT email FROM auth_users WHERE id = $user_id");
            $data = $q1->row();
            $original_value = $data->email;
            if($details['email'] != $original_value) {
                $is_unique =  '|is_unique[auth_users.email]';
            } else {
                $is_unique =  '';
            }

            if($details['password']!=""){
                $this->form_validation->set_rules('email', 'Email', 'valid_email'.$is_unique);
                //$this->form_validation->set_rules('email', 'Email', 'required|valid_email'.$is_unique);
                $this->form_validation->set_rules('password', 'Password','required|min_length[6]|max_length[15]|matches[password_confirm]');
                $this->form_validation->set_rules('password_confirm','Password Confirm', 'required');

                if ($this->form_validation->run() === FALSE) {
                    $data = array();
                    $data['error_string'] = array();
                    $data['inputerror'] = array();
                    $data['status'] = FALSE;
                    $data['error'] = "validation_error";
                    if (form_error('email')) {
                        $data['inputerror'][] = 'email';
                        $data['error_string'][] = form_error('email');
                    }
                    if (form_error('password')) {
                        $data['inputerror'][] = 'password';
                        $data['error_string'][] = form_error('password');
                    }
                    if (form_error('password_confirm')) {
                        $data['inputerror'][] = 'password_confirm';
                        $data['error_string'][] = form_error('password_confirm');
                    }

                    echo json_encode($data);
                    exit;
                }

                $email    = strtolower($details['email']);
                $password = $details['password'];

                $data= array(
                    'email' => $email ,
                    'password' => $password,
                );


                if ($this->ion_auth_model->update($user_id, $data)) {

                    //Update the groups user belongs to
                    $groupData = $this->input->post('user_group');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $user_id);
                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $user_id);

                            $m_id_1 = 68;
                            $m_id_2 = 11;
                            $m_id_3 = 105;

                            if($grp==999){

                                if(!$this->system->user_validate($user_id,$m_id_1)) {
                                    $mod_data = array(
                                        'user_id' => $user_id,
                                        'module_id' => $m_id_1,
                                        'access_permission' => 'YES',
                                    );
                                    $this->db->insert('auth_system_permissions', $mod_data);

                                }
                            if(!$this->system->user_validate($user_id,$m_id_2)) {
                                $mod_data_1 = array(
                                    'user_id' => $user_id,
                                    'module_id' => $m_id_2,
                                    'access_permission' => 'YES',
                                );
                                $this->db->insert('auth_system_permissions', $mod_data_1);
                            }
                                if(!$this->system->user_validate($user_id,$m_id_3)) {
                                    $mod_data_2 = array(
                                        'user_id' => $user_id,
                                        'module_id' => $m_id_3,
                                        'access_permission' => 'YES',
                                    );
                                    $this->db->insert('auth_system_permissions', $mod_data_2);
                                }
                            }
                        }
                        $message = 'User Updated with new PW -'.$user_id;
                        $this->system_log->create_system_log("System Users", "Success", "User Updated with new PW #".$user_id);
                        echo json_encode(array(
                            'status' => true,
                            'message' => $message
                        ));
                        exit;
                    }

                } else {

                    echo json_encode(array(
                        'status' => false,
                        'message' => 'Unable to update! Try again.',
                    ));
                    exit;
                }
            } else {
                $this->form_validation->set_rules('email', 'Email', 'valid_email'.$is_unique);

                if ($this->form_validation->run() === FALSE) {
                    $data = array();
                    $data['error_string'] = array();
                    $data['inputerror'] = array();
                    $data['status'] = FALSE;
                    $data['error'] = "validation_error";
                    if (form_error('email')) {
                        $data['inputerror'][] = 'email';
                        $data['error_string'][] = form_error('email');
                    }
                    echo json_encode($data);
                    exit;
                }

                $email    = strtolower($details['email']);

                $data= array(
                    'email' => $email
                );

                if ($this->ion_auth_model->update($user_id, $data)) {


                    //Update the groups user belongs to
                    $groupData = $this->input->post('user_group');

                    if (isset($groupData) && !empty($groupData)) {

                        $this->ion_auth->remove_from_group('', $user_id);
                        foreach ($groupData as $grp) {
                            $this->ion_auth->add_to_group($grp, $user_id);
                        }
                        $message = 'User Email Updated -'.$user_id;
                        $this->system_log->create_system_log("System Users", "Success", "User Email Updated #".$user_id);
                        echo json_encode(array(
                            'status' => true,
                            'message' => $message
                        ));
                        exit;
                    }

                } else {

                    echo json_encode(array(
                        'status' => false,
                        'message' => 'Unable to update! Try again.',
                    ));
                    exit;
                }
            }
        }
    }

    function edit_unique($value, $params)  {
        $CI =& get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");

        list($table, $field, $current_id) = explode(".", $params);

        $query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row() && $query->row()->id != $current_id)
        {
            return FALSE;
        } else {
            return TRUE;
        }
    }


    //Edit & Save Sys Users
    public function  ajax_get_system_user_data_by_id(){
        $id = $this->input->post('sys_user_id');
        if (empty($id)) {
            echo json_encode(array(
                'status' => false,
                'message' => "Unable to get data. User ID invalid."
            ));
        }

        $user_data = $this->system->get_sys_user_data_by_userid($id);
        $user_group = $this->system->get_sys_user_group($id);
        echo json_encode(array(
            'status' => true,
            'user_data' => $user_data,
            'user_group' => $user_group
        ));
        exit;
    }



    //LOAD USER BRANCH MATRIX
    ///////~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

    public function ajax_get_user_branch_matrix()
    {

        $branches=$this->system->getBranches();
        $sys_users=$this->system->getEmployeesFullData();
        $matrix=$this->system->b_u_matrix_data();



        if(!empty($sys_users) && !empty($branches))
        {
            echo json_encode(array(
                'status' => true,
                'branches' => $branches,
                'sys_users' => $sys_users,
                'matrix' => $matrix
            ));exit;
        }
        else
        {
            echo json_encode(array(
                'status' => false,
                'message' => "Unable to retrieve data."
            ));exit;
        }
    }

    public function ajax_list_users()
    {
        $this->load->library('datatables');
        $this->datatables->select("
        auth_users.id,
        hr_pay_employees.employee_id,
        auth_users.username,
        CONCAT(hr_pay_employees.first_name,' ',hr_pay_employees.last_name) as namee
        ", FALSE);
        $this->datatables->from('auth_users');
        $this->datatables->join('hr_pay_employees','hr_pay_employees.id=auth_users.id');
        $this->datatables->where(array('auth_users.is_employee'=>1,'auth_users.active'=>1));
        $this->datatables->add_column("Actions",
            "<a class='btn btn-sm btn-success' title='User Permissions' onclick='user_permissions(".'$1'.")'><i class='fa fa-gears'></i></a> | <a class='btn btn-sm btn-success' title='Edit User' onclick='edit_user(".'$1'.")'><i class='fa fa-edit'></i></a>
           ", "id");

        echo $this->datatables->generate();
    }

    public function ajax_update_user_branch_matrix()
    {

        $pieces = explode(',', $this->input->post('matrix'));
        $user_id = $pieces[0];
        $branch_id = $pieces[1];
        $user_name = $this->input->post('user_name');
        $branch_name = $this->input->post('branch_name');

        // A box was checked
        if ($this->input->post('action') == 'true') {
            $insert_data = array(
                'employee_id' => $user_id,
                'branch_id' => $branch_id
            );
            if ($this->db->insert('hr_pay_system_users', $insert_data)) {
                $msg = "$user_name and $branch_name successfully linked.";
                $status = true;
            } else {
                $msg = "Sorry! Failed to link $user_name and $branch_name";
                $status = false;
            }
        } else {
            // A box was unchecked
            $update_data = array(
                'employee_id' => $user_id,
                'branch_id' => $branch_id
            );
            if ($this->system->delete_data($update_data)) {
                $msg = "$user_name and $branch_name link successfully removed.";
                $status = true;
            } else {
                $msg = "Sorry! Failed to remove the link between $user_name and $branch_name.";
                $status = false;
            }
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $msg
        ));exit;
    }

}








