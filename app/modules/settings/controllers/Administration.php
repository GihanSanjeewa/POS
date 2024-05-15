<?php

class Administration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login');
        }
        $this->load->model('administration_mod');
        $this->load->library('permissions');
        $this->load->library('datatables');
        $this->load->library('grocery_CRUD');
        $this->load->library('system_log');

        date_default_timezone_set("Asia/Colombo");
        $this->currentTime = date('Y-m-d H:i:s');
        $this->currentDate = date('Y-m-d');

        $this->administration_mod->load_settings();

    }

    public function _master_output($output = null)
    {
        $this->load->view('administration/index.php',$output);
    }

    public function events()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('hr_pay_events');
        $crud->set_subject('Events');
        $crud->set_relation('event_type','hr_pay_m_event_types','{type}');
        $crud->required_fields('datetime','event_type','event_title');
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $crud->callback_after_insert(array($this, 'log_events_after_insert'));
        $crud->callback_after_update(array($this, 'log_events_after_update'));

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');

    }

    function log_events_after_insert($post_array,$primary_key)
    {
        $this->system_log->create_system_log("Master Events", "Success", "New Event Added ID #".$primary_key);
        return true;
    }
    function log_events_after_update($post_array,$primary_key)
    {
        $this->system_log->create_system_log("Master Events", "Success", "Event Updated ID #".$primary_key);
        return true;
    }

    public function system_settings()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_admin_settings');
        $crud->set_subject('System Settings');
        $crud->set_rules('setting_key','Settings','alpha_dash');
        $crud->display_as('setting_key','Settings');
        $crud->display_as('setting_value','Value');
        $crud->display_as('setting_value_2','Value 2');
        $crud->required_fields('setting_key','setting_value');
        $crud->where('t_id','2');
        $crud->field_type('t_id', 'hidden');
        $crud->unset_columns(array('t_id'));
        $crud->unset_add();
        $crud->unset_delete();

        $state = $crud->getState();
        if($state == "edit")
        {
            $crud->field_type('setting_key','readonly');
        }

        $crud->callback_after_insert(array($this, 'log_settings_after_insert'));
        $crud->callback_after_update(array($this, 'log_settings_after_update'));

        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');

    }

    function log_settings_after_insert($post_array,$primary_key)
    {
        $this->system_log->create_system_log("Master Settings", "Success", "New System Setting Added ID #".$primary_key);
        return true;
    }
    function log_settings_after_update($post_array,$primary_key)
    {
        $this->system_log->create_system_log("Master Settings", "Success", "System Setting Updated ID #".$primary_key);
        return true;
    }


    public function admin_settings()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('asms_admin_settings');
        $crud->set_subject('Admin Settings');
        $crud->set_rules('setting_key','Settings','alpha_dash');
        $crud->display_as('setting_key','Settings');
        $crud->display_as('setting_value','Value');
        $crud->display_as('setting_value_2','Value 2');
        $crud->required_fields('setting_key','setting_value');
        $crud->where('t_id','1');
        $crud->field_type('t_id', 'hidden');
        $crud->unset_columns(array('t_id'));
        $crud->unset_add();
        $crud->unset_delete();

        $state = $crud->getState();
        if($state == "edit")
        {
            $crud->field_type('setting_key','readonly');
        }

        $crud->callback_after_insert(array($this, 'log_admin_settings_after_insert'));
        $crud->callback_after_update(array($this, 'log_admin_settings_after_update'));

        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');

    }

    function log_admin_settings_after_insert($post_array,$primary_key)
    {
        $this->system_log->create_system_log("Master Settings", "Success", "New Admin Setting Added ID #".$primary_key);
        return true;
    }
    function log_admin_settings_after_update($post_array,$primary_key)
    {
        $this->system_log->create_system_log("Master Settings", "Success", "Admin Setting Updated ID #".$primary_key);
        return true;
    }



    public function system_log()
    {
        $crud = new grocery_CRUD();

        $crud->set_table('auth_system_log');
        $crud->set_subject('System Log');
        $crud->display_as('ip_address','IP address');
        $crud->display_as('date_time','Timestamp');
        $crud->display_as('action','Module');
        $crud->display_as('log_message','Details');
        $crud->set_relation('user_id','auth_users','{username}');
        $crud->callback_column('log_message', array($this, '_full_text'));
        $crud->unset_add();
        $crud->unset_read();
        $crud->unset_edit();
        $crud->unset_delete();
        $crud->unset_jquery();
        $crud->unset_bootstrap();

        $output = $crud->render();
        $this->load->view('common/header');
        $this->_master_output($output);
        $this->load->view('common/footer');

    }
    function _full_text($value, $row)
    {
        return $value = wordwrap($row->log_message, 200, "<br>", true);
    }


    public function test_pay()
    {
        $this->load->model('payroll_process_mod','payroll');
        /*$ffields = $this->db->field_data('hr_pay_payroll_monthly_payments');
        $mpcolumns = explode(',', $ffields);
        foreach($mpcolumns as $column)
        {
            $regex='/^$/';
            preg_match($regex, $column, $match);
            print $match[1]; // field stored in $match[1]

        }*/

        $fields = $this->db->field_data('hr_pay_payroll_monthly_payments');
        foreach ($fields as $field)
        {
            //echo $field->name;
            $regex='/^\$/';
            if(preg_match($regex,$field->name)) {
                echo '\''.$field->name.'\'';
            }
        }
    }



    public function hr_admin_settings()
    {
        $this->permissions->check_permission('access');

        $data['admin_setting'] = $this->administration_mod->get_admin_settings();
        $this->load->view('common/header');
        $this->load->view('administration/admin_settings',$data);
        $this->load->view('common/footer');
    }

    public function save_admin_settings()
    {
        $settings = $this->input->post('settings');
        // Save the submitted settings
        foreach ($settings as $key => $value) {
            $this->administration_mod->save($key, $value);
        }

        $upload_config_bg = array(
            'upload_path' => './uploads/bg/',
            'allowed_types' => 'gif|jpg|png|svg',
            'max_size' => '9999',
            'max_width' => '9999',
            'max_height' => '9999'
        );

        if (isset($_FILES['background_logo']['name'])) {
            $this->load->library('upload', $upload_config_bg);

            if (!$this->upload->do_upload('background_logo')) {
                //$this->session->set_flashdata('alert_error', $this->upload->display_errors());
                echo json_encode(array("status" => FALSE));
            }

            $upload_data = $this->upload->data();

            $this->administration_mod->save('background_logo', $upload_data['file_name']);
        }


        $this->system_log->create_system_log("Master Settings", "Success", "Admin Setting Updated");
        echo json_encode(array("status" => TRUE));
    }

    public function hr_att_settings()
    {
        $this->permissions->check_permission('access');

        $data['admin_setting'] = $this->administration_mod->get_admin_settings();
        $this->load->view('common/header');
        $this->load->view('administration/att_settings',$data);
        $this->load->view('common/footer');
    }

    public function save_att_settings()
    {
        $settings = $this->input->post('settings');
        // Save the submitted settings
        foreach ($settings as $key => $value) {
            $this->administration_mod->save($key, $value);
        }
        $this->system_log->create_system_log("Master Settings", "Success", "Attendance Setting Updated");
        echo json_encode(array("status" => TRUE));
    }

    public function remove_logo($type)
    {
        unlink('./uploads/logo/' . $this->administration_mod->setting($type . '_logo'));

        $this->administration_mod->save($type . '_logo', '');

        $this->session->set_flashdata('alert_success', lang($type . '_logo_removed'));

        redirect('/hr_payroll/administration/hr_admin_settings');
    }

    public function remove_bg($type)
    {
        unlink('./uploads/bg/' . $this->administration_mod->setting($type . '_logo'));

        $this->administration_mod->save($type . '_logo', '');

        $this->session->set_flashdata('alert_success', lang($type . '_logo_removed'));

        redirect('/hr_payroll/administration/hr_admin_settings');
    }

    public function hr_payroll_settings()
    {
        $this->permissions->check_permission('access');

        $data['admin_setting'] = $this->administration_mod->get_admin_settings();
        $this->load->view('common/header');
        $this->load->view('administration/payroll_settings',$data);
        $this->load->view('common/footer');
    }

    public function save_payroll_settings()
    {
        $settings = $this->input->post('settings');
        // Save the submitted settings
        foreach ($settings as $key => $value) {
            $this->administration_mod->save($key, $value);
        }
        $this->system_log->create_system_log("Master Settings", "Success", "Payroll Setting Updated");
        echo json_encode(array("status" => TRUE));
    }

    public function save_leave_settings()
    {
        $settings = $this->input->post('settings');
        // Save the submitted settings
        foreach ($settings as $key => $value) {
            $this->administration_mod->save($key, $value);
        }
        $this->system_log->create_system_log("Master Settings", "Success", "Leave Setting Updated");
        echo json_encode(array("status" => TRUE,"message" => "Successfully Saved"));
    }

//    public function getDepartment()
//    {
//
//        $data = array();
//        $parent_key = 0;
//
//        $row = $this->db->query('SELECT `id`,`desc` AS name from hr_pay_m_departments');
//
//        if($row->num_rows() > 0)
//        {
//            if($this->departmentTree($parent_key)){
//                $data = $this->departmentTree($parent_key);
//            }
//        }
//
//        print_r(json_encode(array_values($data)));
//        die();
//
//        echo json_encode(array_values($data));
//
//    }
//
//    public function departmentTree($parent_key)
//    {
//
//        $row1 = array();
//        $row = $this->db->query('SELECT `id`,`desc` AS name from hr_pay_m_departments WHERE parent="'.$parent_key.'"')->result_array();
//
//        foreach($row as $key => $value)
//        {
//            $row1[$key]['title'] = $value['name'];
//            $row1[$key]['children'] = array_values($this->departmentTree($value['id']));
//
//        }
//
//        return $row1;
//
//    }

    //ORG Settings
    public function view_hr_org_details()
    {
        $this->permissions->check_permission('access');

        $data['admin_setting'] = $this->administration_mod->get_admin_settings();
        //$data['departments'] = $this->administration_mod->getDepartments();
        $this->load->view('common/header');
        $this->load->view('administration/organization_info',$data);
        $this->load->view('common/footer');
    }

    /*public function view_hr_org_chart()
    {
        $this->permissions->check_permission('access');

        $data['admin_setting'] = $this->administration_mod->get_admin_settings();
        $data['departments'] = $this->administration_mod->getDepartments();
        $this->load->view('common/header');
        $this->load->view('administration/organization_info_chart',$data);
        $this->load->view('common/footer');
    }*/

    public function hr_org_settings()
    {
        $this->permissions->check_permission('access');

        $data['admin_setting'] = $this->administration_mod->get_admin_settings();
        $this->load->view('common/header');
        $this->load->view('administration/organization_info_settings',$data);
        $this->load->view('common/footer');
    }

    public function save_org_settings()
    {
        $settings = $this->input->post('settings');
        // Save the submitted settings
        foreach ($settings as $key => $value) {
            $this->administration_mod->save($key, $value);
        }

        $upload_config = array(
            'upload_path' => './uploads/logo/',
            'allowed_types' => 'gif|jpg|png|svg',
            'max_size' => '9999',
            'max_width' => '9999',
            'max_height' => '9999'
        );

        if (isset($_FILES['company_logo']['name'])) {
            $this->load->library('upload', $upload_config);

            if (!$this->upload->do_upload('company_logo')) {
                //$this->session->set_flashdata('alert_error', $this->upload->display_errors());
                echo json_encode(array("status" => FALSE));
            }

            $upload_data = $this->upload->data();

            $this->administration_mod->save('company_logo', $upload_data['file_name']);
        }


        $this->system_log->create_system_log("Master Organization Info Settings", "Success", "Organization Info Updated");
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_get_departments()
    {
        $data = $this->employees->getDepartments();
        echo json_encode($data);
    }






}








