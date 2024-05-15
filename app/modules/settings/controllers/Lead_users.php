<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/16/2019
 * Time: 4:22 PM
 */

class Lead_users extends CI_Controller
{
    var $teacher_table;
    var $teacher_table2;

    public function __construct()
    {

        parent::__construct();
        $this->teacher_table="asms_m_teacher_modules";
        $this->teacher_table2="asms_m_teacher_modules_data";
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }
        $this->load->model('Lead_users_mod','lead');
        $this->load->library('datatables');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('permissions');
        $this->load->library('system_log');
        $this->load->library('kcrud');

        date_default_timezone_set("Asia/Colombo");
        $this->currentTime = date('Y-m-d H:i:s');
        $this->currentDate = date('Y-m-d');

        //ini_set('display_errors', 1);
        //ini_set('display_startup_errors', 1);
        //error_reporting(E_ALL);
    }

    public function index()
    {

        $this->permissions->check_permission('access');

        $this->load->helper('url');

        $data['batches']=$this->lead->get_batches();
        $data['branches']=$this->lead->get_branches();
        $data['religions']=$this->lead->get_religions();
        $data['races']=$this->lead->get_races();
        $data['AllGroups']=$this->lead->getAllGroups();
        $data['company']=$this->lead->getCompany();

        $meta['title']='User Lead Management';

        $this->load->view('common/header',$meta);
        $this->load->view('lead_users/lead_users',$data);
        $this->load->view('common/footer');
    }

    public function get_last_user_number(){

        $count=count($this->lead->get_last_user_number());

        if($count > 0){
            $user_id='SYS'.date("y").''.(sprintf('%03d',(int)$count+1));
        }
        else{
            $user_id='SYS'.date("y").'002';
        }
        echo json_encode(array('user_id'=>$user_id));
    }

    public function get_all_users()
    {
        $this->load->library('datatables');

        $this->datatables->select("
            auth_users.id,
            auth_users.username,
            asms_users_info.user_id,
            asms_users_info.title,
            asms_users_info.name,          
            asms_users_info.phone,
            asms_users_info.nic_number,
            asms_users_info.id as std_id,
            ", FALSE);

        $this->datatables->from('auth_users');
        $this->datatables->join('asms_users_info','asms_users_info.id=auth_users.id');
        $this->datatables->where('asms_users_info.module_status','LEAD');
        $this->datatables->add_column("Actions",
            "
           <a class='btn btn-sm btn-default tbl-action' title='User Permissions' onclick='user_permissions(".'$1'.")'><i class='fa fa-gears'></i> </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Edit' onclick='edit_user(".'$1'.");'>
                <i class='fa fa-edit'></i> Edit
            </a>", "std_id");
//        $this->datatables->add_column("Actions",
//            "<a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='View' onclick='view_user(".'$1'.");'>
//                <i class='fa fa-list'></i> View
//            </a>
//            <a class='btn btn-sm btn-default tbl-action' title='User Permissions' onclick='user_permissions(".'$1'.")'><i class='fa fa-gears'></i> </a>
//            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Edit' onclick='edit_user(".'$1'.");'>
//                <i class='fa fa-edit'></i> Edit
//            </a>", "std_id");
        $this->datatables->unset_column('std_id');
        echo $this->datatables->generate();
    }


    private function _make_null($input)
    {
        $var = empty($input) ? NULL : $input;
        return $var;
    }

    public function edit_user($id)
    {
        $users=$this->lead->get_by_id_with_auth($id);
        $user_group = $this->lead->get_sys_user_group($id);

        if (in_array(4, $user_group))
        {
            $lec_data = $this->lead->get_lecturer_data($id);
//           $lec="yes";
        }
        else
        {
            $lec_data =NULL;
//            $lec="No";
        }

        //$user_branches = $this->users->get_sys_user_branches($id);
        echo json_encode(
            array(
                'std_info'=>$users,
                'user_group'=>$user_group,
                'lec_details'=>$lec_data
                //'user_branches'=>$user_branches
            ));
    }

    public function view_user($id)
    {
        $users=$this->lead->view_by_id($id);
        echo json_encode(array('std_info'=>$users));
    }

    public function get_employee_id(){
        $output=$this->lead->get_last_employee_id();
        echo json_encode($output);
    }

    public function save()
    {
        // $title=$this->input->post('title');
        // var_dump($title);
        // die();

        $module_state="LEAD";
        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('name', 'Name with initials', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
        $this->form_validation->set_rules('nic_number', 'NIC Number', 'trim|required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[auth_users.username]');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('password', 'Password','required|min_length[6]|max_length[15]|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm','Password Confirm', 'required');
        // $this->form_validation->set_rules('branch', 'Branch', 'trim|required');
        $this->form_validation->set_rules('user_company', 'Company', 'trim|required');
        

        if($this->form_validation->run()===FALSE)
        {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            $data['error'] = "validation_error";
            if (form_error('title'))
            {
                $data['inputerror'][] = 'title';
                $data['error_string'][] = form_error('title');
            }
            if (form_error('name'))
            {
                $data['inputerror'][] = 'name';
                $data['error_string'][] = form_error('name');
            }
            if (form_error('full_name'))
            {
                $data['inputerror'][] = 'full_name';
                $data['error_string'][] = form_error('full_name');
            }
            if (form_error('gender'))
            {
                $data['inputerror'][] = 'gender';
                $data['error_string'][] = form_error('gender');
            }
            if (form_error('phone'))
            {
                $data['inputerror'][] = 'phone';
                $data['error_string'][] = form_error('phone');
            }
            if (form_error('nic_number'))
            {
                $data['inputerror'][] = 'nic_number';
                $data['error_string'][] = form_error('nic_number');
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
            // if (form_error('branch'))
            // {
            //     $data['inputerror'][] = 'branch';
            //     $data['error_string'][] = form_error('branch');
            // }
            if (form_error('user_company'))
            {
                $data['inputerror'][] = 'user_company';
                $data['error_string'][] = form_error('user_company');
            }

            echo json_encode($data);
            exit;
        } else {

            $count=count($this->lead->get_last_user_number());
            if($count > 0){
                $user_id='SYS'.date("y").''.(sprintf('%03d',(int)$count+1));
            }
            else{
                $user_id='SYS'.date("y").'002';
            }

            $data = array(
                'title'=>$this->input->post('title'),
                'user_id'=>$user_id,
                // 'branch_id'=>$this->input->post('branch'),
                'name'=>$this->input->post('name'),
                'full_name'=>$this->input->post('full_name'),
                // 'address'=>$this->input->post('address'),
                'phone'=>$this->input->post('phone'),
                'occupation'=>$this->input->post('occupation'),
                // 'birthday'=>$this->input->post('birthday'),
                // 'religion'=>$this->input->post('religion'),
                'nic_number'=>$this->input->post('nic_number'),
                'gender'=>$this->input->post('gender'),
                'user'=>USER_ID,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
                'company_id'=>$this->input->post('user_company'),
                'module_status'=>$module_state,
                'status'=>1
                
            );

            if($insert_id=$this->lead->save('asms_users_info',$data)){

                $id = null;
                $message = null;
                $details = $this->input->post();
                $email    = strtolower($details['email']);
                $identity = $details['username'];
                $password = $details['password'];
                $user_group = $details['user_group'];

                $additional_data = array(
                    'id' => $insert_id,
                    'is_employee' => 1,
                    'first_name'  => $this->input->post('name'),
                    'otp'  => 1,
                );

                $group = array($user_group);

                if ($user_id = $this->ion_auth->register($identity, $password, $email,$additional_data,$group)) {

                    $data = array(
                        'baseurl'	=> base_url(),
                        'first_name'	=> $this->input->post('name'),
                        'last_name'	=> "",
                        'user_name'		=> $identity,
                        'password'		=> $password,
                    );
//                    $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('new_user_mail', 'ion_auth'), $data, true);
//                    $this->email->clear();
//                    $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
//                    $this->email->to($email);
//                    $this->email->subject("Login Details for System");
//                    $this->email->set_mailtype("html");
//                    $this->email->message($message);
                    /*echo $this->db->last_query();
                    var_dump($_POST);exit;*/
                    if ($this->email->send()) {
                        //$message = 'User Created -' . $identity;
                        $this->system_log->create_system_log("System Users", "Success", "New System User #" . $user_id . " added for User ID #" . $user_id);
                    }
                    //nipun

                    if (empty($details['programs_id'])){
                    }
                    else{
                        $module_names ='';
                        for($j=0; $j<count($details['programs_id']); $j++) {
                            $mod=$details['module_c_id'][$j];
                            $ins_val = explode(",",$mod);
                            for($x=0; $x<count($ins_val); $x++) {
                                $ins_val2 = explode(",",$mod);

                                $module_names = $module_names.', '.$this->lead->get_module_code($ins_val2[$x])->name;
                            }
                        }
                        $data=array(
                            'teacher_id'=>$insert_id,
                            'module'=>(ltrim($module_names,','))
                        );
                        $m_insert_id=$this->kcrud->save('asms_m_teacher_modules',$data);
                        $this->system_log->create_system_log("Master - Teacher Module", "Success", "New Teacher Module added #" . $insert_id);

                        for($j=0; $j<count($details['programs_id']); $j++) {
                            $mod=$details['module_c_id'][$j];
                            $ins_val = explode(",",$mod);
                            for($x=0; $x<count($ins_val); $x++) {
                                $ins_val2 = explode(",",$mod);
                                $data2=array(
                                    'teacher_mod_id'=>$m_insert_id,
                                    'modules'=>$ins_val2[$x]
                                );
                                $insert2_id=$this->kcrud->save('asms_m_teacher_modules_data',$data2);
                            }
                        }
                    }


                    //end nipun


                    $this->system_log->create_system_log("User Register", "Success", "New user successfully added. User ID #".$user_id);

                    echo json_encode(array('status'=>TRUE,'message'=>'New user successfully added!','std_id'=>$insert_id));
                    exit;
                }
                else {
                    echo json_encode(array(
                        'status' => false,
                        'message' => 'New User Add Failed ! Try Again.',
                    ));
                    exit;
                }

            }
            else{
                echo json_encode(array('status'=>FALSE,'message'=>'New User Add Failed !.Try Again.'));
            }
        }
    }



    public function update()
    {
        $details = $this->input->post();

        $module_state="LEAD";

        $message = null;
        $user_id = $details['std_id'];
        $q1 = $this->db->query("SELECT email FROM auth_users WHERE id = $user_id");
        $data = $q1->row();
        $original_value = $data->email;
        if($details['email'] != $original_value) {
            $is_unique =  '|is_unique[auth_users.email]';
        } else {
            $is_unique =  '';
        }


        $this->form_validation->set_rules('title','Title','trim|required');
        $this->form_validation->set_rules('name', 'Name with initials', 'trim|required');
        $this->form_validation->set_rules('full_name', 'Full Name', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
        $this->form_validation->set_rules('nic_number', 'NIC Number', 'trim|required');
        $this->form_validation->set_rules('user_company', 'Company', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email'.$is_unique);
        if($details['password']!="") {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[15]|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', 'Password Confirm', 'required');
        }
        // $this->form_validation->set_rules('branch', 'Branch', 'trim|required');


        if($this->form_validation->run()===FALSE)
        {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            $data['error'] = "validation_error";
            if (form_error('title'))
            {
                $data['inputerror'][] = 'title';
                $data['error_string'][] = form_error('title');
            }
            if (form_error('name'))
            {
                $data['inputerror'][] = 'name';
                $data['error_string'][] = form_error('name');
            }
            if (form_error('full_name'))
            {
                $data['inputerror'][] = 'full_name';
                $data['error_string'][] = form_error('full_name');
            }
            if (form_error('gender'))
            {
                $data['inputerror'][] = 'gender';
                $data['error_string'][] = form_error('gender');
            }
            if (form_error('phone'))
            {
                $data['inputerror'][] = 'phone';
                $data['error_string'][] = form_error('phone');
            }
            if (form_error('nic_number'))
            {
                $data['inputerror'][] = 'nic_number';
                $data['error_string'][] = form_error('nic_number');
            }
            if (form_error('email')) {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = form_error('email');
            }
            if($details['password']!="") {

                if (form_error('password')) {
                    $data['inputerror'][] = 'password';
                    $data['error_string'][] = form_error('password');
                }
                if (form_error('password_confirm')) {
                    $data['inputerror'][] = 'password_confirm';
                    $data['error_string'][] = form_error('password_confirm');
                }
            }
            if (form_error('user_company'))
            {
                $data['inputerror'][] = 'user_company';
                $data['error_string'][] = form_error('user_company');
            }

            echo json_encode($data);
            exit;
        }
        else{

            $data = array(
                'title'=>$this->input->post('title'),
                'name'=>$this->input->post('name'),
                'branch_id'=>$this->input->post('branch'),
                'full_name'=>$this->input->post('full_name'),
                'address'=>$this->input->post('address'),
                'phone'=>$this->input->post('phone'),
                'occupation'=>$this->input->post('occupation'),
                'birthday'=>$this->input->post('birthday'),
                'religion'=>$this->input->post('religion'),
                'nic_number'=>$this->input->post('nic_number'),
                'gender'=>$this->input->post('gender'),
                'user'=>USER_ID,
                'updated_at'=>date("Y-m-d H:i:s"),
                'module_status'=>$module_state,
                'company_id'=>$this->input->post('user_company'),
                'status'=>1
                
            );

            if($this->lead->update('asms_users_info',$data,array('id'=>$this->input->post('std_id')))){

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

                    //nipun

                    if (in_array(4, $groupData))
                    {
                        if (empty($details['programs_id'])){
//                    $this->db->where('asms_m_teacher_modules.teacher_id', $this->input->post('std_id'));
//                    $q1=$this->db->delete('asms_m_teacher_modules');
//
//                    $this->db->where('asms_m_teacher_modules_data.teacher_mod_id', $teacher_mod_id);
//                    $q2=$this->db->delete('asms_m_teacher_modules_data');
                        }
                        else{
                            $select="id";
                            $where=$this->teacher_table.".teacher_id=".$this->input->post('std_id');
                            $delete=$this->kcrud->getValueOne($this->teacher_table,$select,$where,null,null,null,null);
                            $teacher_mod_id=$delete->id;
                            if ($teacher_mod_id==NULL){
                                $module_names ='';
                                for($j=0; $j<count($details['programs_id']); $j++) {
                                    $mod=$details['module_c_id'][$j];
                                    $ins_val = explode(",",$mod);
                                    for($x=0; $x<count($ins_val); $x++) {
                                        $ins_val2 = explode(",",$mod);

                                        $module_names = $module_names.', '.$this->lead->get_module_code($ins_val2[$x])->name;
                                    }
                                }
                                $data=array(
                                    'teacher_id'=>$this->input->post('std_id'),
                                    'module'=>(ltrim($module_names,','))
                                );
                                $m_insert_id=$this->kcrud->save('asms_m_teacher_modules',$data);
                                $this->system_log->create_system_log("Master - Teacher Module", "Success", "New Teacher Module added #" . $this->input->post('std_id'));
                                $mod_id=$m_insert_id;
                            }else{
                                $mod_id=$teacher_mod_id;
                            }

                            $this->db->where('asms_m_teacher_modules_data.teacher_mod_id', $mod_id);
                            $queary=$this->db->delete('asms_m_teacher_modules_data');

                            $module_names ='';
                            for($j=0; $j<count($details['programs_id']); $j++) {
                                $mod=$details['module_c_id'][$j];
                                $ins_val = explode(",",$mod);
                                for($x=0; $x<count($ins_val); $x++) {
                                    $ins_val2 = explode(",",$mod);

                                    $module_names = $module_names.', '.$this->lead->get_module_code($ins_val2[$x])->name;
                                }
                            }
                            $data=array(
                                'module'=>(ltrim($module_names,','))
                            );
                            $this->lead->update('asms_m_teacher_modules',$data,array('id'=>$mod_id));

                            $this->system_log->create_system_log("Master - Teacher Module", "Success", "New Teacher Module added #" . $mod_id);

                            for($j=0; $j<count($details['programs_id']); $j++) {
                                $mod=$details['module_c_id'][$j];
                                $ins_val = explode(",",$mod);
                                for($x=0; $x<count($ins_val); $x++) {
                                    $ins_val2 = explode(",",$mod);
                                    $data2=array(
                                        'teacher_mod_id'=>$mod_id,
                                        'modules'=>$ins_val2[$x]
                                    );
                                    $insert2_id=$this->kcrud->save('asms_m_teacher_modules_data',$data2);
                                }
                            }
                        }
                    }
                    else
                    {
                        $select="id";
                        $where=$this->teacher_table.".teacher_id=".$this->input->post('std_id');
                        $delete=$this->kcrud->getValueOne($this->teacher_table,$select,$where,null,null,null,null);
                        $teacher_mod_id=$delete->id;
                        if ($teacher_mod_id==NULL){

                        }else{
                            $this->db->where('asms_m_teacher_modules_data.teacher_mod_id', $teacher_mod_id);
                            $q2=$this->db->delete('asms_m_teacher_modules_data');
                            $this->db->where('asms_m_teacher_modules.teacher_id', $this->input->post('std_id'));
                            $q1=$this->db->delete('asms_m_teacher_modules');
                        }

                    }





                    //end nipun


//                    $message = 'User Updated with new PW -'.$user_id;
//                    $this->system_log->create_system_log("System Users", "Success", "User Updated with new PW #".$user_id);
//                    echo json_encode(array(
//                        'status' => true,
//                        'message' => $message
//                    ));
//                    exit;
                }
                else{

                }

                if ($is_unique !=''){
                    $email    = strtolower($details['email']);
                    $data= array(
                        'email' => $email
                    );
                    if ($this->ion_auth_model->update($user_id, $data)) {

                    }
                    else {

                        echo json_encode(array(
                            'status' => false,
                            'message' => 'Unable to update! Try again.',
                        ));
                        exit;
                    }

//                    if ($this->ion_auth_model->update($user_id, $data)) {
//                        //Update the groups user belongs to
//                        $groupData = $this->input->post('user_group');
//                        if (isset($groupData) && !empty($groupData)) {
//
//                            $this->ion_auth->remove_from_group('', $user_id);
//                            foreach ($groupData as $grp) {
//                                $this->ion_auth->add_to_group($grp, $user_id);
//                                $m_id_1 = 68;
//                                $m_id_2 = 11;
//                                $m_id_3 = 105;
//                            }
//                        }
//                    }

                }


                if($details['password']!=""){

                    $password = $details['password'];
                    $data= array(
                        'password' => $password
                    );
                    if ($this->ion_auth_model->update($user_id, $data)) {
                        //Update the groups user belongs to
                        $groupData = $this->input->post('user_group');
                        if (isset($groupData) && !empty($groupData)) {

                            $this->ion_auth->remove_from_group('', $user_id);
                            foreach ($groupData as $grp) {
                                $this->ion_auth->add_to_group($grp, $user_id);
                            }
                        }
                    }
                }





                echo json_encode(array('status'=>TRUE,'message'=>'User Updated successfully !','std_id'=>$this->input->post('std_id')));
                $this->system_log->create_system_log("User Register", "Success", "User updated successfully. User ID #".$this->input->post('std_id'));
            }
            else{
                echo json_encode(array('status'=>FALSE,'message'=>'User Register Failed !'));
            }
        }

    }

    public function add_photo($id)
    {

        $baseURL = base_url();
        $ab_path =  $this->config->item('ab_path');

        $target_path = $ab_path."uploads/user_photos/";

        $allowedExtensions = array("gif", "jpeg", "jpg", "png", "bmp");
        $allowedSizeMaximum = 2097152;
        $temp = explode(".", $_FILES["photo"]["name"]);
        $extension = end($temp);
        $imageName = "ag_" . $id;

        if (($_FILES["photo"]["size"] < $allowedSizeMaximum) && in_array(strtolower($extension), array_map('strtolower', $allowedExtensions)))
        {
            if ($_FILES["photo"]["error"] > 0)
            {
                echo json_encode(array("status" => FALSE, "message" => "Return Code: " . $_FILES["photo"]["error"] . " \n"));
            }
            else
            {
                foreach($allowedExtensions as $allowedType)
                {
                    if (file_exists($target_path . $imageName . "." . $allowedType))
                    {
                        rename($target_path . $imageName . "." . $allowedType, $target_path . $imageName . "." . $extension);
                    }
                }

                if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_path . $imageName . "." . $extension))
                {
                    $std_photo_details = array(
                        'user_id' => $id,
                        'photo' => $imageName . "." . $extension,
                        'path' => $target_path . $imageName . "." . $extension,
                        'created_at' => $this->currentTime,
                        'updated_at' => $this->currentTime,
                        'user' => USER_ID
                    );
                    $query = $this->lead->get_user_photo_by_id($id);

                    if($query->num_rows() == 0)
                    {
                        $this->lead->save('asms_users_photos',$std_photo_details);
                        echo json_encode(array("status" => TRUE, "message" => "Photo uploaded successfully.", "photo" => $imageName . "." . $extension));
                        $this->system_log->create_system_log("User Photo", "Success", "User Photo uploaded successfully User ID #".$id);
                    }
                    else
                    {
                        $this->lead->update('asms_users_photos',$std_photo_details,array('user' => $id));
                        echo json_encode(array("status" => TRUE, "message" => "Photo uploaded successfully.", "photo" => $imageName . "." . $extension));
                        $this->system_log->create_system_log("User Photo", "Success", "User Photo Updated successfully User ID #".$id);
                    }

                }
                else
                {
                    $this->system_log->create_system_log("User Photo", "Failed", "Failed to save the User  photo User ID #".$id);
                    echo json_encode(array("status" => FALSE, "message" => "Sorry! Failed to save the photo."));
                }
            }
        }
        else
        {
            echo json_encode(array("status" => FALSE, "message" => "Invalid image type or image size. \nOnly " . join(", ", $allowedExtensions) . " image types are allowed. Also, maximum image size allowed is " . $allowedSizeMaximum / 1024 / 1024 . " MB."));
        }
    }

    public function image_available(){
        $std_id=$this->input->post('id');
        $photo = $this->lead->check_image_availability($std_id);
        echo json_encode($photo->row());
    }


    public function ajax_get_system_permissions_details_by_id(){
        $id = $this->input->post('sys_u_p_id');
        /*if (empty($id)) {
            echo json_encode(array(
                'status' => false,
                'message' => "Unable to get data. ID invalid."
            ));
            exit;
        }*/

        $list_modules = $this->lead->getModules();
        $list_sections = $this->lead->getModuleSections();
        $sys_u_p_data = $this->lead->get_sys_permission_data_by_userid($id);

        echo json_encode(array(
            'status' => true,
            'list_modules' => $list_modules,
            'list_sections' => $list_sections,
            'sys_u_p_data' => $sys_u_p_data
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
            if ($this->lead->delete_user_permissions($data_main['sys_u_p_id'])) {
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
            if ($this->lead->delete_user_permissions($data_main['sys_u_p_id'])) {
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

    //nipun

    public function load_programs(){

        $program=$this->lead->load_programs();
        echo json_encode(array('program'=>$program));
    }
    public function load_programs_module(){
        $details = $this->input->post();
        $module=$this->lead->load_programs_module($details['program_id']);
        echo json_encode(array('module'=>$module));
    }
    //end nipun
}