<?php

class Students_con extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->library('ion_auth');
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }
        $this->load->model('students_mod','students');
        $this->load->library('permissions');
        $this->load->library('system_log');

        date_default_timezone_set("Asia/Colombo");
        $this->currentTime = date('Y-m-d H:i:s');
        $this->currentDate = date('Y-m-d');

        ini_set('display_errors', 0);
    }

    public function index()
    {

        $this->permissions->check_permission('access');

        $this->load->helper('url');

//        $data['batches']=$this->students->get_batches();
        $data['programs']=$this->students->get_programs();
        $data['acdemic_uni']=$this->students->get_acdemic_uni();

        $meta['title']='Students Management';

        $this->load->view('common/header',$meta);
        $this->load->view('students_index',$data);
        $this->load->view('common/footer');
    }

    public function registrar_index()
    {

        $this->permissions->check_permission('access');

        $this->load->helper('url');

        $data['batches']=$this->students->get_batches();
        $data['programs']=$this->students->get_programs();

        $meta['title']='Students Management';

        $this->load->view('common/header',$meta);
        $this->load->view('registrar_index',$data);
        $this->load->view('common/footer');
    }

    public function get_last_student_number(){

        $count=count($this->students->get_last_student_number());

        if($count > 0){
            $student_id='AG/'.date("y").'/'.strtoupper(date("M")).'/'.(sprintf('%05d',(int)$count+1));
        }
        else{
            $student_id='AG/'.date("y").'/'.strtoupper(date("M")).'/00001';
        }

        echo json_encode(array('student_id'=>$student_id));

    }

    public function get_all_reject_students()
    {
        $this->load->library('datatables');

        $this->datatables->select("
            asms_students_register.id,
            CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
            asms_m_programs.name AS program_name,
            asms_students_register.student_id,
            asms_students_register.st_title,
            asms_students_register.st_full_name,          
            asms_students_register.st_current_address,
            asms_students_register.st_phone_no,
            UPPER(asms_students_register.st_nic_num) AS nic,
            asms_students_register.st_qualified_status_note,
            asms_students_register.id as std_id,
            ", FALSE);

        $this->datatables->from('asms_students_register');
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
        $this->datatables->where('asms_students_register.st_qualified_status="REJECTED"');
        $this->datatables->where('asms_students_register.stu_status=0');
        $this->datatables->add_column("Actions",
            "<a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='View' onclick='view_student(".'$1'.");'>
                <i class='fa fa-list'></i> View
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Status' onclick='add_student_status(".'$1'.");'>
                <i class='fa fa-check-square-o'></i> Status
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Edit' onclick='edit_student(".'$1'.");'>
                <i class='fa fa-edit'></i> Edit
            </a>", "std_id");
        $this->datatables->unset_column('std_id');
        echo $this->datatables->generate();
    }

    public function get_all_pending_students()
    {
        $this->load->library('datatables');

        $this->datatables->select("
            asms_students_register.id,
            CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
            asms_m_programs.name AS program_name,
            asms_students_register.student_id,
            asms_students_register.st_title,
            asms_students_register.st_full_name,          
            asms_students_register.st_current_address,
            asms_students_register.st_phone_no,
            UPPER(asms_students_register.st_nic_num) AS nic,
            asms_students_register.id as std_id,
            ", FALSE);

        $this->datatables->from('asms_students_register');
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
        $this->datatables->where('asms_students_register.st_qualified_status="PENDING"');
        $this->datatables->where('asms_students_register.stu_status=0');
        $this->datatables->add_column("Actions",
            "<a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='View' onclick='view_student(".'$1'.");'>
                <i class='fa fa-list'></i> View
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Status' onclick='add_student_status(".'$1'.");'>
                <i class='fa fa-check-square-o'></i> Status
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Edit' onclick='edit_student(".'$1'.");'>
                <i class='fa fa-edit'></i> Edit
            </a>", "std_id");
        $this->datatables->unset_column('std_id');
        echo $this->datatables->generate();
    }


    public function registrar_get_all_students()
    {
        $this->load->library('datatables');

        $this->datatables->select("
            asms_students_register.id,
            asms_m_batches.name AS batch_name,
            asms_students_register.student_id,
            asms_students_register.st_title,
            asms_students_register.st_full_name,          
            asms_students_register.st_current_address,
            asms_students_register.st_phone_no,
            UPPER(asms_students_register.st_nic_num) AS nic,
            asms_students_register.id as std_id,
            ", FALSE);

        $this->datatables->from('asms_students_register');
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->where('asms_students_register.stu_status=2');
        $this->datatables->add_column("Actions",
            "<a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='View' onclick='view_student(".'$1'.");'>
            <i class='fa fa-list'></i> View
            </a>
            <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Edit' onclick='edit_student(".'$1'.");'>
            <i class='fa fa-edit'></i> Edit
            </a>
           <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='Validate' onclick='save_discount(".'$1'.");'>
                <i class='fa fa-check'></i> Validate
            </a>", "std_id");
        $this->datatables->unset_column('std_id');
        echo $this->datatables->generate();
    }

    public function check_nic_valid()
    {
        $this->form_validation->set_rules('st_nic_num', 'NIC Number', 'trim|required|is_unique[asms_students_register.st_nic_num]');

        if ($this->form_validation->run() === FALSE) {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            $data['error'] = "validation_error";
            if (form_error('st_nic_num')) {
                $data['inputerror'][] = 'st_nic_num';
                $data['error_string'][] = form_error('st_nic_num');
            }
            echo json_encode($data);
            exit;
        }else {
            echo json_encode(array('status'=>TRUE));
        }
    }

    public function get_countries()
    {
        $query = $this->input->get('query');
        $this->db->like('name', $query);
        $data = $this->db->get("asms_m_countries")->result();
        echo json_encode( $data);
    }
    public function get_citizenship()
    {
        $query = $this->input->get('query');
        $this->db->like('name', $query);
        $data = $this->db->get("asms_m_citizenships_list")->result();
        echo json_encode( $data);
    }
    

    public function insert()
    {
        //$this->form_validation->set_rules('st_nic_num', 'NIC Number', 'trim|required');
        $this->form_validation->set_rules('st_nic_num', 'NIC Number', 'trim');

        if($this->form_validation->run()===FALSE)
        {
            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            $data['error'] = "validation_error";
            if (form_error('st_nic_num'))
            {
                $data['inputerror'][] = 'st_nic_num';
                $data['error_string'][] = form_error('st_nic_num');
            }
            echo json_encode($data);
            exit;
        }
        else{


            $count=count($this->students->get_last_student_number());

            if($count > 0){
                $student_id='TEMP/'.date("y").'/'.strtoupper(date("M")).'/'.(sprintf('%05d',(int)$count+1));
            }
            else{
                $student_id='TEMP/'.date("y").'/'.strtoupper(date("M")).'/00001';
            }

            $val=$this->input->post();
            if (isset($val['st_ol_subject'])) {
                foreach ($val['st_ol_subject'] as $key => $value) {
                    if (!empty($val['st_ol_subject'][$key])) {
                        $st_ol_data[] = array(
                            'st_ol_school' => $val['st_ol_school'][$key],
                            'st_ol_year' => $val['st_ol_year'][$key],
                            'st_ol_type' => $val['st_ol_type'][$key],
                            'st_ol_subject' => $val['st_ol_subject'][$key],
                            'st_ol_grade' => $val['st_ol_grade'][$key],
                        );
                    }
                }
            }

            if (isset($val['st_al_subject'])) {
                foreach ($val['st_al_subject'] as $key => $value) {
                    if (!empty($val['st_al_subject'][$key])) {
                        $st_al_data[] = array(
                            'st_al_school' => $val['st_al_school'][$key],
                            'st_al_year' => $val['st_al_year'][$key],
                            'st_al_type' => $val['st_al_type'][$key],
                            'st_al_subject' => $val['st_al_subject'][$key],
                            'st_al_grade' => $val['st_al_grade'][$key],
                        );
                    }
                }
            }

            if (isset($val['st_hepq_uni'])) {
                foreach ($val['st_hepq_uni'] as $key => $value) {
                    if (!empty($val['st_hepq_uni'][$key])) {

                        if($val['st_hepq_from'][$key]<= $val['st_hepq_to'][$key]){
                            $st_hepq_data[] = array(
                                'st_hepq_uni' => $val['st_hepq_uni'][$key],
                                'st_hepq_type' => $val['st_hepq_type'][$key],
                                'st_hepq_from' => $val['st_hepq_from'][$key],
                                'st_hepq_to' => $val['st_hepq_to'][$key],
                            );
                        }else{
                            echo json_encode(array(
                                'status'=>FALSE,
                                'message'=>'Please set HIGHER EDUCATION / PROFESSIONAL QUALIFICATIONS "to" year value greater than "from" year value ',
                                'step'=>4
                            ));
                            exit();
                        }

                        
                    }
                }
            }

            if (isset($val['st_ceq_uni'])) {
                foreach ($val['st_ceq_uni'] as $key => $value) {
                    if (!empty($val['st_ceq_uni'][$key])) {


                        if($val['st_ceq_from'][$key]<= $val['st_ceq_to'][$key]){
                            $st_ceq_data[] = array(
                                'st_ceq_uni' => $val['st_ceq_uni'][$key],
                                'st_ceq_type' => $val['st_ceq_type'][$key],
                                'st_ceq_from' => $val['st_ceq_from'][$key],
                                'st_ceq_to' => $val['st_ceq_to'][$key],
                            );
                        }else{
                            echo json_encode(array(
                                'status'=>FALSE,
                                'message'=>'Please set CURRENT EDUCATIONAL QUALIFICATION "to" year value greater than "from" year value ',
                                'step'=>4
                            ));
                            exit();
                        }
                        
                    }
                }
            }

            if (isset($val['st_vac_name'])) {
                foreach ($val['st_vac_name'] as $key => $value) {
                    if (!empty($val['st_vac_name'][$key])) {
                        $st_vac_data[] = array(
                            'st_vac_name' => $val['st_vac_name'][$key],
                            'st_vac_country' => $val['st_vac_country'][$key],
                            'st_vac_year' => $val['st_vac_year'][$key],
                            'st_vac_type' => $val['st_vac_type'][$key],
                            'st_vac_status' => $val['st_vac_status'][$key],
                        );
                    }
                }
            }

            $programe_data = explode(',',$this->input->post('batch'));


            $data = array(
                'programe'=>$this->input->post('program'),
                'batch'=>$programe_data[0],
                'intake'=>$programe_data[1],
                'university'=>$this->input->post('university'),
                'st_min_years_local'=>$this->input->post('st_min_years_local'),
                'student_id'=>$student_id,
                'st_title'=>$this->input->post('st_title'),
                'st_full_name'=>$this->input->post('st_full_name'),
                'st_f_name'=>$this->input->post('st_f_name'),
                'st_m_name'=>$this->input->post('st_m_name'),
                'st_l_name'=>$this->input->post('st_l_name'),
                'st_gender'=>$this->input->post('st_gender'),
                'st_age'=>$this->input->post('st_age'),
                'st_nic_num'=>$this->input->post('st_nic_num'),
                'st_passport_num'=>$this->input->post('st_passport_num'),
                'st_birthday'=>$this->input->post('st_birthday'),
                'st_marital_status'=>$this->input->post('st_marital_status'),
                'st_current_address'=>$this->input->post('st_current_address'),
                'st_phone_no'=>$this->input->post('st_phone_no'),
                'st_home_no'=>$this->input->post('st_home_no'),
                'st_email'=>$this->input->post('st_email'),
                'st_email_school'=>$this->input->post('st_email_school'),
                'st_country_of_birth'=>$this->input->post('st_country_of_birth'),
                'st_citizenship'=>$this->input->post('st_citizenship'),
                'st_valid_sl_visa'=>$this->input->post('st_valid_sl_visa'),
                'st_visa_type'=>$this->input->post('st_visa_type'),
                'st_visa_exp_date'=>$this->input->post('st_visa_exp_date'),
                'st_emp_company_name'=>$this->input->post('st_emp_company_name'),
                'st_emp_designation'=>$this->input->post('st_emp_designation'),
                'st_emp_office_address'=>$this->input->post('st_emp_office_address'),
                'st_emp_office_phone'=>$this->input->post('st_emp_office_phone'),
                'st_emp_office_email'=>$this->input->post('st_emp_office_email'),
                'st_attended_school'=>$this->input->post('st_attended_school'),
//                'st_ol_year'=>$this->input->post('st_ol_year'),
//                'st_ol_type'=>$this->input->post('st_ol_type'),
                'st_ol_data'=>json_encode($st_ol_data),
//                'st_al_year'=>$this->input->post('st_al_year'),
//                'st_al_type'=>$this->input->post('st_al_type'),
                'st_al_data'=>json_encode($st_al_data),
                'st_hepq_data'=>json_encode($st_hepq_data),
                'st_ceq_data'=>json_encode($st_ceq_data),
                'st_emergency_r_name'=>$this->input->post('st_emergency_r_name'),
                'st_emergency_r_relation'=>$this->input->post('st_emergency_r_relation'),
                'st_emergency_r_other_details'=>$this->input->post('st_emergency_r_other_details'),
                'st_emergency_r_occupation'=>$this->input->post('st_emergency_r_occupation'),
                'st_emergency_r_no'=>$this->input->post('st_emergency_r_no'),
                'st_emergency_r_off_no'=>$this->input->post('st_emergency_r_off_no'),
                'st_emergency_r_email'=>$this->input->post('st_emergency_r_email'),
                'st_know_programmes'=>$this->input->post('st_know_programmes'),
                'st_know_programme_other'=>$this->input->post('st_know_programme_other'),
                'st_type_visa_another_country'=>$this->input->post('st_type_visa_another_country'),
                'st_vac_data'=>json_encode($st_vac_data),
                'st_visa_r_reason'=>$this->input->post('st_visa_r_reason'),
                'st_fs_aware'=>$this->input->post('st_fs_aware'),
                'st_fs_name'=>$this->input->post('st_fs_name'),
                'st_fs_summary_pathway'=>$this->input->post('st_fs_summary_pathway'),
                'st_fs_remarks'=>$this->input->post('st_fs_remarks'),
//                'intake'=>$programe_data[0],
                'user'=>USER_ID,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
                'status'=>1
            );

            if($insert_id=$this->students->save('asms_students_register',$data)){
                
                $this->load->library('upload');
                $ab_path = $this->config->item('ab_path');

                mkdir($ab_path."/uploads/student_documents/".$insert_id."/",0755,TRUE);

                //ST_Photo upload
                if (!empty($_FILES["st_photo"]['name'])) {
                    $org_name = explode('.',$_FILES["st_photo"]['name']);
                    $org_name = $org_name[0];
                    $file_name = $insert_id."_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_photos/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $file_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_photo")) {
                        $ext = explode(".", $_FILES["st_photo"]['name']);
                        $data_st_photo = array(
                            "student" => $insert_id,
                            "photo" => $file_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_photos',$data_st_photo);
                }

                //documents upload and save
                //OL file
                // if (!empty($_FILES["st_file_ol"]['name'])) {
                //     $st_file_ol = explode('.',$_FILES["st_file_ol"]['name']);
                //     $st_file_ol = $st_file_ol[0];
                //     $st_file_ol_name = $insert_id."_ol_".date('_Y-m-d_h-i-s');
                //     $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                //     $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                //     $config['file_name'] = $st_file_ol_name;
                //     $this->upload->initialize($config);
                //     if ($this->upload->do_upload("st_file_ol")) {
                //         $ext = explode(".", $_FILES["st_file_ol"]['name']);
                //         $data_st_file_ol = array(
                //             "student" => $insert_id,
                //             "document_type" => "st_file_ol",
                //             "document_name" => $st_file_ol_name.".".$ext[1],
                //             'user'=>USER_ID,
                //             "created_at" => date('Y-m-d h:i:s')
                //         );
                //     }
                //     $this->db->insert('asms_students_documents',$data_st_file_ol);
                // }

                $count_uploaded_files = count( $_FILES['st_file_ols']['name'] );
            if($count_uploaded_files>0){
                // Count total st_file_ols
                $countfiles = count($_FILES['st_file_ols']['name']);
                // Looping all st_file_ols
                for($i=0;$i<$countfiles;$i++){

                    if(!empty($_FILES['st_file_ols']['name'][$i])){

                        // Define new $_FILES array - $_FILES['file']
                        $_FILES['file']['name'] = $_FILES['st_file_ols']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['st_file_ols']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['st_file_ols']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['st_file_ols']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['st_file_ols']['size'][$i];

                        // Set preference

                        //CI upload
                        $st_file_ols = explode('.',$_FILES['st_file_ols']['name'][$i]);
                        $st_file_ols = $st_file_ols[0];
                        $st_file_ols_name = $insert_id."_rpq_".date('_Y-m-d_h-i-s');
                        $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                        $config['max_size'] = '5000'; // max_size in kb
                        $config['file_name'] = $st_file_ols_name;

                        //Load upload library
                        $this->upload->initialize($config);

                        // File upload
                        if($this->upload->do_upload('file')){
                            // Get data about the file
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];
                            $data_st_file_ols = array(
                                "student" => $insert_id,
                                "document_type" => "st_file_ol",
                                "document_name" => $filename,
                                'user'=>USER_ID,
                                "created_at" => date('Y-m-d h:i:s')
                            );
                            $this->db->insert('asms_students_documents',$data_st_file_ols);
                        }
                    }
                }
            }

                //AL file
                // if (!empty($_FILES["st_file_al"]['name'])) {
                //     $st_file_al = explode('.',$_FILES["st_file_al"]['name']);
                //     $st_file_al = $st_file_al[0];
                //     $st_file_al_name = $insert_id."_al_".date('_Y-m-d_h-i-s');
                //     $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                //     $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                //     $config['file_name'] = $st_file_al_name;
                //     $this->upload->initialize($config);
                //     if ($this->upload->do_upload("st_file_al")) {
                //         $ext = explode(".", $_FILES["st_file_al"]['name']);
                //         $data_st_file_al = array(
                //             "student" => $insert_id,
                //             "document_type" => "st_file_al",
                //             "document_name" => $st_file_al_name.".".$ext[1],
                //             'user'=>USER_ID,
                //             "created_at" => date('Y-m-d h:i:s')
                //         );
                //     }
                //     $this->db->insert('asms_students_documents',$data_st_file_al);
                // }


                $count_uploaded_files = count( $_FILES['st_file_als']['name'] );
            if($count_uploaded_files>0){
                // Count total st_file_als
                $countfiles = count($_FILES['st_file_als']['name']);
                // Looping all st_file_als
                for($i=0;$i<$countfiles;$i++){

                    if(!empty($_FILES['st_file_als']['name'][$i])){

                        // Define new $_FILES array - $_FILES['file']
                        $_FILES['file']['name'] = $_FILES['st_file_als']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['st_file_als']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['st_file_als']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['st_file_als']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['st_file_als']['size'][$i];

                        // Set preference

                        //CI upload
                        $st_file_als = explode('.',$_FILES['st_file_als']['name'][$i]);
                        $st_file_als = $st_file_als[0];
                        $st_file_als_name = $insert_id."_rpq_".date('_Y-m-d_h-i-s');
                        $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                        $config['max_size'] = '5000'; // max_size in kb
                        $config['file_name'] = $st_file_als_name;

                        //Load upload library
                        $this->upload->initialize($config);

                        // File upload
                        if($this->upload->do_upload('file')){
                            // Get data about the file
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];
                            $data_st_file_als = array(
                                "student" => $insert_id,
                                "document_type" => "st_file_al",
                                "document_name" => $filename,
                                'user'=>USER_ID,
                                "created_at" => date('Y-m-d h:i:s')
                            );
                            $this->db->insert('asms_students_documents',$data_st_file_als);
                        }
                    }
                }
            }


                //nic_pp file
                if (!empty($_FILES["st_file_nic_pp"]['name'])) {
                    $st_file_nic_pp = explode('.',$_FILES["st_file_nic_pp"]['name']);
                    $st_file_nic_pp = $st_file_nic_pp[0];
                    $st_file_nic_pp_name = $insert_id."_nic_pp_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                    $config['file_name'] = $st_file_nic_pp_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_nic_pp")) {
                        $ext = explode(".", $_FILES["st_file_nic_pp"]['name']);
                        $data_st_file_nic_pp = array(
                            "student" => $insert_id,
                            "document_type" => "st_file_nic_pp",
                            "document_name" => $st_file_nic_pp_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_nic_pp);
                }

                //st_file_visa file
                if (!empty($_FILES["st_file_visa"]['name'])) {
                    $st_file_visa = explode('.',$_FILES["st_file_visa"]['name']);
                    $st_file_visa = $st_file_visa[0];
                    $st_file_visa_name = $insert_id."_visa_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                    $config['file_name'] = $st_file_visa_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_visa")) {
                        $ext = explode(".", $_FILES["st_file_visa"]['name']);
                        $data_st_file_visa = array(
                            "student" => $insert_id,
                            "document_type" => "st_file_visa",
                            "document_name" => $st_file_visa_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_visa);
                }

                //st_file_bc file
                if (!empty($_FILES["st_file_bc"]['name'])) {
                    $st_file_bc = explode('.',$_FILES["st_file_bc"]['name']);
                    $st_file_bc = $st_file_bc[0];
                    $st_file_bc_name = $insert_id."_bc_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                    $config['file_name'] = $st_file_bc_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_bc")) {
                        $ext = explode(".", $_FILES["st_file_bc"]['name']);
                        $data_st_file_bc = array(
                            "student" => $insert_id,
                            "document_type" => "st_file_bc",
                            "document_name" => $st_file_bc_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_bc);
                }

                //st_rpq_file files
                $count_uploaded_files = count( $_FILES['st_rpq_files']['name'] );

               
                if($count_uploaded_files>0){
                    // Count total st_rpq_files
                    $countfiles = count($_FILES['st_rpq_files']['name']);
                    // Looping all st_rpq_files
                    for($i=0;$i<$countfiles;$i++){

                        if(!empty($_FILES['st_rpq_files']['name'][$i])){

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['st_rpq_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['st_rpq_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['st_rpq_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['st_rpq_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['st_rpq_files']['size'][$i];

                            // Set preference

                            //CI upload
                            $st_rpq_files = explode('.',$_FILES['st_rpq_files']['name'][$i]);
                            $st_rpq_files = $st_rpq_files[0];
                            $st_rpq_files_name = $insert_id."_rpq_".date('_Y-m-d_h-i-s');
                            $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                            $config['max_size'] = '5000'; // max_size in kb
                            $config['file_name'] = $st_rpq_files_name;

                            //Load upload library
                            $this->upload->initialize($config);

                            // File upload
                            if($this->upload->do_upload('file')){
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $data_st_file_rpq = array(
                                    "student" => $insert_id,
                                    "document_type" => "st_rpq_file",
                                    "document_name" => $filename,
                                    'user'=>USER_ID,
                                    "created_at" => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('asms_students_documents',$data_st_file_rpq);
                            }
                        }
                    }
                }

                //st_hepq_file files
                $count_uploaded_hepq_files = count( $_FILES['st_hepq_files']['name'] );
               
                if($count_uploaded_hepq_files>0){
                    // Count total st_hepq_files
                    $countfiles = count($_FILES['st_hepq_files']['name']);
                    // Looping all st_hepq_files
                    for($i=0;$i<$countfiles;$i++){

                        if(!empty($_FILES['st_hepq_files']['name'][$i])){

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['st_hepq_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['st_hepq_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['st_hepq_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['st_hepq_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['st_hepq_files']['size'][$i];

                            // Set preference

                            //CI upload
                            $st_hepq_files = explode('.',$_FILES['st_hepq_files']['name'][$i]);
                            $st_hepq_files = $st_hepq_files[0];
                            $st_hepq_files_name = $insert_id."_hepq_".date('_Y-m-d_h-i-s');
                            $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                            $config['max_size'] = '5000'; // max_size in kb
                            $config['file_name'] = $st_hepq_files_name;

                            //Load upload library
                            $this->upload->initialize($config);

                            // File upload
                            if($this->upload->do_upload('file')){
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $data_st_file_hepq = array(
                                    "student" => $insert_id,
                                    "document_type" => "st_hepq_file",
                                    "document_name" => $filename,
                                    'user'=>USER_ID,
                                    "created_at" => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('asms_students_documents',$data_st_file_hepq);
                            }
                        }
                    }
                }

                //st_ceq_file files
                $count_uploaded_files = count( $_FILES['st_ceq_files']['name'] );
                if($count_uploaded_files>0){
                    // Count total st_ceq_files
                    $countfiles = count($_FILES['st_ceq_files']['name']);
                    // Looping all st_ceq_files
                    for($i=0;$i<$countfiles;$i++){

                        if(!empty($_FILES['st_ceq_files']['name'][$i])){

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['st_ceq_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['st_ceq_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['st_ceq_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['st_ceq_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['st_ceq_files']['size'][$i];

                            // Set preference

                            //CI upload
                            $st_ceq_files = explode('.',$_FILES['st_ceq_files']['name'][$i]);
                            $st_ceq_files = $st_ceq_files[0];
                            $st_ceq_files_name = $insert_id."_ceq_".date('_Y-m-d_h-i-s');
                            $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc|xlsx';
                            $config['max_size'] = '5000'; // max_size in kb
                            $config['file_name'] = $st_ceq_files_name;

                            //Load upload library
                            $this->upload->initialize($config);

                            // File upload
                            if($this->upload->do_upload('file')){
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $data_st_file_ceq = array(
                                    "student" => $insert_id,
                                    "document_type" => "st_ceq_file",
                                    "document_name" => $filename,
                                    'user'=>USER_ID,
                                    "created_at" => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('asms_students_documents',$data_st_file_ceq);
                            }
                        }
                    }
                }

//                $data2=array(
//                    'batch'=>$this->input->post('batch'),
//                    'student_id'=>$insert_id,
//                    'status'=>0
//                );
//                $this->students->save('asms_students_register',$data2);

// test nipun
                echo json_encode(array('status'=>TRUE,'message'=>'Student Register successfully !','std_id'=>$insert_id));
                $this->system_log->create_system_log("Student Register", "Success", "Student added successfully. Student ID #".$student_id);
            }
            else{
                echo json_encode(array('status'=>FALSE,'message'=>'Student Register Failed !'));
            }
        }

    }


    public function update()
    {

        $this->form_validation->set_rules('st_nic_num', 'NIC Number', 'trim');

        if($this->form_validation->run()===FALSE)
        {
            $data = array();            

            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = FALSE;
            $data['error'] = "validation_error";
            if (form_error('st_nic_num'))
            {
                $data['inputerror'][] = 'st_st_nic_num AS nic_number';
                $data['error_string'][] = form_error('st_nic_num');
            }
            echo json_encode($data);
            exit;
        } else{
           
            $val=$this->input->post();
            if (isset($val['st_ol_subject'])) {
                foreach ($val['st_ol_subject'] as $key => $value) {
                    if (!empty($val['st_ol_subject'][$key])) {
                        $st_ol_data[] = array(
                            'st_ol_school' => $val['st_ol_school'][$key],
                            'st_ol_year' => $val['st_ol_year'][$key],
                            'st_ol_type' => $val['st_ol_type'][$key],
                            'st_ol_subject' => $val['st_ol_subject'][$key],
                            'st_ol_grade' => $val['st_ol_grade'][$key],
                        );
                    }
                }
            }

            if (isset($val['st_al_subject'])) {
                foreach ($val['st_al_subject'] as $key => $value) {
                    if (!empty($val['st_al_subject'][$key])) {
                        $st_al_data[] = array(
                            'st_al_school' => $val['st_al_school'][$key],
                            'st_al_year' => $val['st_al_year'][$key],
                            'st_al_type' => $val['st_al_type'][$key],
                            'st_al_subject' => $val['st_al_subject'][$key],
                            'st_al_grade' => $val['st_al_grade'][$key],
                        );
                    }
                }
            }

            if (isset($val['st_hepq_uni'])) {
                foreach ($val['st_hepq_uni'] as $key => $value) {
                    if (!empty($val['st_hepq_uni'][$key])) {
                        $st_hepq_data[] = array(
                            'st_hepq_uni' => $val['st_hepq_uni'][$key],
                            'st_hepq_type' => $val['st_hepq_type'][$key],
                            'st_hepq_from' => $val['st_hepq_from'][$key],
                            'st_hepq_to' => $val['st_hepq_to'][$key],
                        );
                    }
                }
            }

            if (isset($val['st_ceq_uni'])) {
                foreach ($val['st_ceq_uni'] as $key => $value) {
                    if (!empty($val['st_ceq_uni'][$key])) {
                        $st_ceq_data[] = array(
                            'st_ceq_uni' => $val['st_ceq_uni'][$key],
                            'st_ceq_type' => $val['st_ceq_type'][$key],
                            'st_ceq_from' => $val['st_ceq_from'][$key],
                            'st_ceq_to' => $val['st_ceq_to'][$key],
                        );
                    }
                }
            }

            if (isset($val['st_vac_name'])) {
                foreach ($val['st_vac_name'] as $key => $value) {
                    if (!empty($val['st_vac_name'][$key])) {
                        $st_vac_data[] = array(
                            'st_vac_name' => $val['st_vac_name'][$key],
                            'st_vac_country' => $val['st_vac_country'][$key],
                            'st_vac_year' => $val['st_vac_year'][$key],
                            'st_vac_type' => $val['st_vac_type'][$key],
                            'st_vac_status' => $val['st_vac_status'][$key],
                        );
                    }
                }
            }


            $programe_data = explode(',',$this->input->post('batch'));
            $data = array(
                'programe'=>$this->input->post('program'),
                'batch'=>$programe_data[0],
                'intake'=>$programe_data[1],
                'university'=>$this->input->post('university'),
                'st_min_years_local'=>$this->input->post('st_min_years_local'),
                'st_title'=>$this->input->post('st_title'),
                'st_full_name'=>$this->input->post('st_full_name'),
                'st_f_name'=>$this->input->post('st_f_name'),
                'st_m_name'=>$this->input->post('st_m_name'),
                'st_l_name'=>$this->input->post('st_l_name'),
                'st_gender'=>$this->input->post('st_gender'),
                'st_age'=>$this->input->post('st_age'),
                'st_nic_num'=>$this->input->post('st_nic_num'),
                'st_passport_num'=>$this->input->post('st_passport_num'),
                'st_birthday'=>$this->input->post('st_birthday'),
                'st_marital_status'=>$this->input->post('st_marital_status'),
                'st_current_address'=>$this->input->post('st_current_address'),
                'st_phone_no'=>$this->input->post('st_phone_no'),
                'st_home_no'=>$this->input->post('st_home_no'),
                'st_email'=>$this->input->post('st_email'),
                'st_country_of_birth'=>$this->input->post('st_country_of_birth'),
                'st_citizenship'=>$this->input->post('st_citizenship'),
                'st_valid_sl_visa'=>$this->input->post('st_valid_sl_visa'),
                'st_visa_type'=>$this->input->post('st_visa_type'),
                'st_visa_exp_date'=>$this->input->post('st_visa_exp_date'),
                'st_emp_designation'=>$this->input->post('st_emp_designation'),
                'st_emp_office_address'=>$this->input->post('st_emp_office_address'),
                'st_emp_office_phone'=>$this->input->post('st_emp_office_phone'),
                'st_emp_office_email'=>$this->input->post('st_emp_office_email'),
                'st_attended_school'=>$this->input->post('st_attended_school'),
//                'st_ol_year'=>$this->input->post('st_ol_year'),
//                'st_ol_type'=>$this->input->post('st_ol_type'),
                'st_ol_data'=>json_encode($st_ol_data),
//                'st_al_year'=>$this->input->post('st_al_year'),
//                'st_al_type'=>$this->input->post('st_al_type'),
                'st_al_data'=>json_encode($st_al_data),
                'st_hepq_data'=>json_encode($st_hepq_data),
                'st_ceq_data'=>json_encode($st_ceq_data),
                'st_emergency_r_name'=>$this->input->post('st_emergency_r_name'),
                'st_emergency_r_relation'=>$this->input->post('st_emergency_r_relation'),
                'st_emergency_r_occupation'=>$this->input->post('st_emergency_r_occupation'),
                'st_emergency_r_no'=>$this->input->post('st_emergency_r_no'),
                'st_emergency_r_off_no'=>$this->input->post('st_emergency_r_off_no'),
                'st_emergency_r_email'=>$this->input->post('st_emergency_r_email'),
                'st_know_programmes'=>$this->input->post('st_know_programmes'),
                'st_know_programme_other'=>$this->input->post('st_know_programme_other'),
                'st_type_visa_another_country'=>$this->input->post('st_type_visa_another_country'),
                'st_vac_data'=>json_encode($st_vac_data),
                'st_visa_r_reason'=>$this->input->post('st_visa_r_reason'),
                'st_fs_aware'=>$this->input->post('st_fs_aware'),
                'st_fs_name'=>$this->input->post('st_fs_name'),
                'st_fs_summary_pathway'=>$this->input->post('st_fs_summary_pathway'),
                'st_fs_remarks'=>$this->input->post('st_fs_remarks'),
                'user'=>USER_ID,
                'created_at'=>date("Y-m-d H:i:s"),
                'updated_at'=>date("Y-m-d H:i:s"),
                'status'=>1,
            );

            if($updated_id=$this->students->update('asms_students_register',$data,array('id'=>$this->input->post('std_id')))){

                $student_id = $this->input->post('std_id');
                $this->load->library('upload');
                $ab_path = $this->config->item('ab_path');
                $path_img = $ab_path . "uploads/student_photos/";
                $path_docs = $ab_path . "uploads/student_documents/";

                $st_photo_check = $this->input->post('st_photo_check');
                $st_file_nic_pp_check = $this->input->post('st_file_nic_pp_check');
                $st_file_visa_check = $this->input->post('st_file_visa_check');
                $st_file_bc_check = $this->input->post('st_file_bc_check');
                $st_file_al_check = $this->input->post('st_file_al_check');
                $st_file_ol_check = $this->input->post('st_file_ol_check');

                if($st_photo_check!="") {
                    $qt0 = $this->db->query("SELECT * FROM  asms_students_photos WHERE student = '$student_id' AND id='$st_photo_check'");
                    if ($qt0->num_rows() > 0) {
                        $st_photo_remove_file = $path_img . $qt0->photo;
                        unlink($st_photo_remove_file);
                        $this->db->query("DELETE FROM asms_students_photos WHERE student='$student_id' AND id='$st_photo_check'");
                    }
                }

                if($st_file_nic_pp_check!="") {
                    $qt1 = $this->db->query("SELECT * FROM  asms_students_documents WHERE student='$student_id' AND document_type='st_file_nic_pp' AND  id = '$st_file_nic_pp_check'");
                    if ($qt1->num_rows() > 0) {
                        $st_file_nic_pp_remove_file = $path_docs . $student_id . '/' . $qt1->document_name;
                        unlink($st_file_nic_pp_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE student='$student_id' AND document_type='st_file_nic_pp' AND id='$st_file_nic_pp_check'");
                    }
                }

                if($st_file_visa_check!="") {
                    $qt2 = $this->db->query("SELECT * FROM  asms_students_documents WHERE student='$student_id' AND document_type='st_file_visa' AND  id = '$st_file_visa_check'");
                    if ($qt2->num_rows() > 0) {
                        $st_file_visa_remove_file = $path_docs . $student_id . '/' . $qt2->document_name;
                        unlink($st_file_visa_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE student='$student_id' AND document_type='st_file_visa' AND id='$st_file_visa_check'");
                    }
                }

                if($st_file_bc_check!="") {
                    $qt3 = $this->db->query("SELECT * FROM  asms_students_documents WHERE student='$student_id' AND document_type='st_file_bc' AND  id = '$st_file_bc_check'");
                    if ($qt3->num_rows() > 0) {
                        $st_file_bc_remove_file = $path_docs . $student_id . '/' . $qt3->document_name;
                        unlink($st_file_bc_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE student='$student_id' AND document_type='st_file_bc' AND id='$st_file_bc_check'");
                    }
                }

                if($st_file_al_check!="") {
                    $qt4 = $this->db->query("SELECT * FROM  asms_students_documents WHERE student='$student_id' AND document_type='st_file_al' AND  id = '$st_file_al_check'");
                    if ($qt4->num_rows() > 0) {
                        $st_file_al_remove_file = $path_docs . $student_id . '/' . $qt4->document_name;
                        unlink($st_file_al_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE student='$student_id' AND document_type='st_file_al' AND id='$st_file_al_check'");
                    }
                }

                if($st_file_ol_check!="") {
                    $qt5 = $this->db->query("SELECT * FROM  asms_students_documents WHERE student='$student_id' AND document_type='st_file_ol' AND  id = '$st_file_ol_check'");
                    if ($qt5->num_rows() > 0) {
                        $st_file_ol_remove_file = $path_docs . $student_id . '/' . $qt5->document_name;
                        unlink($st_file_ol_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE student='$student_id' AND document_type='st_file_ol' AND id='$st_file_ol_check'");
                    }
                }

                //ST_Photo upload
                if (!empty($_FILES["st_photo"]['name'])) {

                    $q0 = $this->db->query("SELECT * FROM  asms_students_photos WHERE student = '$student_id'");
                    if ($q0->num_rows() > 0) {
                        $st_photo_remove_file = $path_img . $q0->photo;
                        unlink($st_photo_remove_file);
                        $this->db->query("DELETE FROM asms_students_photos WHERE student='$student_id'");
                    }

                    $org_name = explode('.',$_FILES["st_photo"]['name']);
                    $org_name = $org_name[0];
                    $file_name = $student_id."_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_photos/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['file_name'] = $file_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_photo")) {
                        $ext = explode(".", $_FILES["st_photo"]['name']);
                        $data_st_photo = array(
                            "student" => $student_id,
                            "photo" => $file_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_photos',$data_st_photo);
                }

                //documents upload and save
                //OL file
                if (!empty($_FILES["st_file_ol"]['name'])) {

                    $q1 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_file_ol' AND  student = '$student_id'");
                    if ($q1->num_rows() > 0) {
                        $st_file_ol_remove_file = $path_docs . $student_id .'/'. $q1->document_name;
                        unlink($st_file_ol_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_file_ol' AND student='$student_id'");
                    }

                    $st_file_ol = explode('.',$_FILES["st_file_ol"]['name']);
                    $st_file_ol = $st_file_ol[0];
                    $st_file_ol_name = $student_id."_ol_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                    $config['file_name'] = $st_file_ol_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_ol")) {
                        $ext = explode(".", $_FILES["st_file_ol"]['name']);
                        $data_st_file_ol = array(
                            "student" => $student_id,
                            "document_type" => "st_file_ol",
                            "document_name" => $st_file_ol_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_ol);
                }

                //AL file
                if (!empty($_FILES["st_file_al"]['name'])) {

                    $q2 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_file_al' AND  student = '$student_id'");
                    if ($q2->num_rows() > 0) {
                        $st_file_al_remove_file = $path_docs . $student_id .'/'. $q2->document_name;
                        unlink($st_file_al_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_file_al' AND student='$student_id'");
                    }

                    $st_file_al = explode('.',$_FILES["st_file_al"]['name']);
                    $st_file_al = $st_file_al[0];
                    $st_file_al_name = $student_id."_al_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                    $config['file_name'] = $st_file_al_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_al")) {
                        $ext = explode(".", $_FILES["st_file_al"]['name']);
                        $data_st_file_al = array(
                            "student" => $student_id,
                            "document_type" => "st_file_al",
                            "document_name" => $st_file_al_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_al);
                }

                //nic_pp file
                if (!empty($_FILES["st_file_nic_pp"]['name'])) {

                    $q3 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_file_nic_pp' AND  student = '$student_id'");
                    if ($q3->num_rows() > 0) {
                        $st_file_nic_pp_remove_file = $path_docs . $student_id .'/'. $q3->document_name;
                        unlink($st_file_nic_pp_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_file_nic_pp' AND student='$student_id'");
                    }

                    $st_file_nic_pp = explode('.',$_FILES["st_file_nic_pp"]['name']);
                    $st_file_nic_pp = $st_file_nic_pp[0];
                    $st_file_nic_pp_name = $student_id."_nic_pp_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                    $config['file_name'] = $st_file_nic_pp_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_nic_pp")) {
                        $ext = explode(".", $_FILES["st_file_nic_pp"]['name']);
                        $data_st_file_nic_pp = array(
                            "student" => $student_id,
                            "document_type" => "st_file_nic_pp",
                            "document_name" => $st_file_nic_pp_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_nic_pp);
                }

                //st_file_visa file
                if (!empty($_FILES["st_file_visa"]['name'])) {

                    $q4 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_file_visa' AND  student = '$student_id'");
                    if ($q4->num_rows() > 0) {
                        $st_file_visa_remove_file = $path_docs . $student_id .'/'. $q4->document_name;
                        unlink($st_file_visa_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_file_visa' AND student='$student_id'");
                    }

                    $st_file_visa = explode('.',$_FILES["st_file_visa"]['name']);
                    $st_file_visa = $st_file_visa[0];
                    $st_file_visa_name = $student_id."_visa_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                    $config['file_name'] = $st_file_visa_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_visa")) {
                        $ext = explode(".", $_FILES["st_file_visa"]['name']);
                        $data_st_file_visa = array(
                            "student" => $student_id,
                            "document_type" => "st_file_visa",
                            "document_name" => $st_file_visa_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_visa);
                }

                //st_file_bc file
                if (!empty($_FILES["st_file_bc"]['name'])) {

                    $q5 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_file_bc' AND  student = '$student_id'");
                    if ($q5->num_rows() > 0) {
                        $st_file_bc_remove_file = $path_docs . $student_id .'/'. $q5->document_name;
                        unlink($st_file_bc_remove_file);
                        $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_file_bc' AND student='$student_id'");
                    }

                    $st_file_bc = explode('.',$_FILES["st_file_bc"]['name']);
                    $st_file_bc = $st_file_bc[0];
                    $st_file_bc_name = $student_id."_bc_".date('_Y-m-d_h-i-s');
                    $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                    $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                    $config['file_name'] = $st_file_bc_name;
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload("st_file_bc")) {
                        $ext = explode(".", $_FILES["st_file_bc"]['name']);
                        $data_st_file_bc = array(
                            "student" => $student_id,
                            "document_type" => "st_file_bc",
                            "document_name" => $st_file_bc_name.".".$ext[1],
                            'user'=>USER_ID,
                            "created_at" => date('Y-m-d h:i:s')
                        );
                    }
                    $this->db->insert('asms_students_documents',$data_st_file_bc);
                }

                //st_rpq_file files
                $st_file_rpq_r_arry = $this->input->post('st_file_rpq_check');
                if (!empty($st_file_rpq_r_arry)) {
                    foreach ($st_file_rpq_r_arry as $st_file_rpq) {
                        $q6 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_rpq_file' AND  id = '$st_file_rpq'");
                        if ($q6->num_rows() > 0) {
                            $st_file_rpq_remove_file = $path_docs . $student_id . '/' . $q6->document_name;
                            unlink($st_file_rpq_remove_file);
                            $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_rpq_file' AND id='$st_file_rpq'");
                        }
                    }
                }

                $count_uploaded_files = count( $_FILES['st_rpq_files']['name'] );
                if($count_uploaded_files>0){
                    // Count total st_rpq_files
                    $countfiles = count($_FILES['st_rpq_files']['name']);
                    // Looping all st_rpq_files
                    for($i=0;$i<$countfiles;$i++){

                        if(!empty($_FILES['st_rpq_files']['name'][$i])){

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['st_rpq_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['st_rpq_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['st_rpq_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['st_rpq_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['st_rpq_files']['size'][$i];
                            // Set preference

                            //CI upload
                            $st_rpq_files = explode('.',$_FILES['st_rpq_files']['name'][$i]);
                            $st_rpq_files = $st_rpq_files[0];
                            $st_rpq_files_name = $student_id."_rpq_".date('_Y-m-d_h-i-s');
                            $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                            $config['max_size'] = '5000'; // max_size in kb
                            $config['file_name'] = $st_rpq_files_name;

                            //Load upload library
                            $this->upload->initialize($config);

                            // File upload
                            if($this->upload->do_upload('file')){
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $data_st_file_rpq = array(
                                    "student" => $student_id,
                                    "document_type" => "st_rpq_file",
                                    "document_name" => $filename,
                                    'user'=>USER_ID,
                                    "created_at" => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('asms_students_documents',$data_st_file_rpq);
                            }
                        }
                    }
                }

                //st_hepq_file files
                $st_file_hepq_r_arry = $this->input->post('st_file_hepq_check');
                if (!empty($st_file_hepq_r_arry)) {
                    foreach ($st_file_hepq_r_arry as $st_file_hepq) {
                        $q6 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_hepq_file' AND  id = '$st_file_hepq'");
                        if ($q6->num_rows() > 0) {
                            $st_file_hepq_remove_file = $path_docs . $student_id . '/' . $q6->document_name;
                            unlink($st_file_hepq_remove_file);
                            $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_hepq_file' AND id='$st_file_hepq'");
                        }
                    }
                }

                $count_uploaded_files = count( $_FILES['st_hepq_files']['name'] );
                if($count_uploaded_files>0){
                    // Count total st_hepq_files
                    $countfiles = count($_FILES['st_hepq_files']['name']);
                    // Looping all st_hepq_files
                    for($i=0;$i<$countfiles;$i++){

                        if(!empty($_FILES['st_hepq_files']['name'][$i])){

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['st_hepq_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['st_hepq_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['st_hepq_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['st_hepq_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['st_hepq_files']['size'][$i];
                            // Set preference

                            //CI upload
                            $st_hepq_files = explode('.',$_FILES['st_hepq_files']['name'][$i]);
                            $st_hepq_files = $st_hepq_files[0];
                            $st_hepq_files_name = $student_id."_hepq_".date('_Y-m-d_h-i-s');
                            $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                            $config['max_size'] = '5000'; // max_size in kb
                            $config['file_name'] = $st_hepq_files_name;

                            //Load upload library
                            $this->upload->initialize($config);

                            // File upload
                            if($this->upload->do_upload('file')){
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $data_st_file_hepq = array(
                                    "student" => $student_id,
                                    "document_type" => "st_hepq_file",
                                    "document_name" => $filename,
                                    'user'=>USER_ID,
                                    "created_at" => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('asms_students_documents',$data_st_file_hepq);
                            }
                        }
                    }
                }

                //st_ceq_file files
                $st_file_ceq_r_arry = $this->input->post('st_file_ceq_check');
                if (!empty($st_file_ceq_r_arry)) {
                    foreach ($st_file_ceq_r_arry as $st_file_ceq) {
                        $q6 = $this->db->query("SELECT * FROM  asms_students_documents WHERE document_type='st_ceq_file' AND  id = '$st_file_ceq'");
                        if ($q6->num_rows() > 0) {
                            $st_file_ceq_remove_file = $path_docs . $student_id . '/' . $q6->document_name;
                            unlink($st_file_ceq_remove_file);
                            $this->db->query("DELETE FROM asms_students_documents WHERE document_type='st_ceq_file' AND id='$st_file_ceq'");
                        }
                    }
                }

                $count_uploaded_files = count( $_FILES['st_ceq_files']['name'] );
                if($count_uploaded_files>0){
                    // Count total st_ceq_files
                    $countfiles = count($_FILES['st_ceq_files']['name']);
                    // Looping all st_ceq_files
                    for($i=0;$i<$countfiles;$i++){

                        if(!empty($_FILES['st_ceq_files']['name'][$i])){

                            // Define new $_FILES array - $_FILES['file']
                            $_FILES['file']['name'] = $_FILES['st_ceq_files']['name'][$i];
                            $_FILES['file']['type'] = $_FILES['st_ceq_files']['type'][$i];
                            $_FILES['file']['tmp_name'] = $_FILES['st_ceq_files']['tmp_name'][$i];
                            $_FILES['file']['error'] = $_FILES['st_ceq_files']['error'][$i];
                            $_FILES['file']['size'] = $_FILES['st_ceq_files']['size'][$i];
                            // Set preference

                            //CI upload
                            $st_ceq_files = explode('.',$_FILES['st_ceq_files']['name'][$i]);
                            $st_ceq_files = $st_ceq_files[0];
                            $st_ceq_files_name = $student_id."_ceq_".date('_Y-m-d_h-i-s');
                            $config['upload_path'] = $ab_path."/uploads/student_documents/".$student_id."/";
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
                            $config['max_size'] = '5000'; // max_size in kb
                            $config['file_name'] = $st_ceq_files_name;

                            //Load upload library
                            $this->upload->initialize($config);

                            // File upload
                            if($this->upload->do_upload('file')){
                                // Get data about the file
                                $uploadData = $this->upload->data();
                                $filename = $uploadData['file_name'];
                                $data_st_file_ceq = array(
                                    "student" => $student_id,
                                    "document_type" => "st_ceq_file",
                                    "document_name" => $filename,
                                    'user'=>USER_ID,
                                    "created_at" => date('Y-m-d h:i:s')
                                );
                                $this->db->insert('asms_students_documents',$data_st_file_ceq);
                            }
                        }
                    }
                }

                echo json_encode(array('status'=>TRUE,'message'=>'Student Updated successfully !','std_id'=>$this->input->post('std_id')));
                $this->system_log->create_system_log("Student Register", "Success", "Student updated successfully. Student ID #".$this->input->post('std_id'));
            }
            else{
                echo json_encode(array('status'=>FALSE,'message'=>'Student Register Failed !'));
            }
        }

    }


    public function save_student_status()
    {
        $val=$this->input->post();

        if(empty($this->input->post('mak_disc_status'))){
            $mak_disc_status = 0;
        } else {
            $mak_disc_status = 1;
        }

        if($this->input->post('st_qualified_status')=="YES"){
            $stu_status = 1;
            $st="REJECTED";
        } else {
            $stu_status = 0;
            $st="REJECTED";
        }

        $data = array(
            'stu_status'=>$stu_status,
            'mak_disc_status'=>$mak_disc_status,
            'mak_disc'=>$this->input->post('mak_disc_status'),
            'st_qualified_status'=>$st,
            'st_qualified_status_note'=>$this->input->post('st_qualified_status_note')
        );

        if($updated_id=$this->students->update('asms_students_register',$data,array('id'=>$this->input->post('status_student_id')))){

            echo json_encode(array('status'=>TRUE,'message'=>'Student Status Updated successfully !','std_id'=>$this->input->post('status_student_id')));
            $this->system_log->create_system_log("Student Register", "Success", "Student Status updated successfully. Student ID #".$this->input->post('status_student_id'));
        }
        else{
            echo json_encode(array('status'=>FALSE,'message'=>'Student Status Update Failed !'));
        }
    }



    private function _make_null($input)
    {
        $var = empty($input) ? NULL : $input;
        return $var;
    }

    public function edit_student($id)
    {

        $students = $this->students->get_by_id($id);
        $st_ol_data = json_decode($students->st_ol_data);
        $st_al_data = json_decode($students->st_al_data);
        $st_hepq_data = json_decode($students->st_hepq_data);
        $st_ceq_data = json_decode($students->st_ceq_data);
        $st_vac_data = json_decode($students->st_vac_data);

        $application_res = $this->students->get_programe_id($students->programe)->application_type;
        $student_photo_data = $this->students->get_student_photo_by_id($id);
        $student_documents_data = $this->students->get_student_documents_by_student_id($id);

        if($application_res){
            $application = $application_res;
        }else{
            $application = 0;
        }

        echo json_encode(
            array(
                'students_info'=>$students,
                'st_ol_data'=>$st_ol_data,
                'st_al_data'=>$st_al_data,
                'st_hepq_data'=>$st_hepq_data,
                'st_ceq_data'=>$st_ceq_data,
                'st_vac_data'=>$st_vac_data,
                'student_photo_data'=>$student_photo_data,
                'student_documents_data'=>$student_documents_data,
                'application'=>$application
                ));
    }


    public function view_student($id)
    {
        $students = $this->students->get_by_id($id);
        $st_ol_data = json_decode($students->st_ol_data);
        $st_al_data = json_decode($students->st_al_data);
        $st_hepq_data = json_decode($students->st_hepq_data);
        $st_ceq_data = json_decode($students->st_ceq_data);
        $st_vac_data = json_decode($students->st_vac_data);

        $application_res = $this->students->get_programe_id($students->programe)->application_type;
        $student_photo_data = $this->students->get_student_photo_by_id($id);
        $student_documents_data = $this->students->get_student_documents_by_student_id($id);

        if($application_res){
            $application = $application_res;
        }else{
            $application = 0;
        }

        echo json_encode(
            array(
                'students_info'=>$students,
                'st_ol_data'=>$st_ol_data,
                'st_al_data'=>$st_al_data,
                'st_hepq_data'=>$st_hepq_data,
                'st_ceq_data'=>$st_ceq_data,
                'st_vac_data'=>$st_vac_data,
                'student_photo_data'=>$student_photo_data,
                'student_documents_data'=>$student_documents_data,
                'application'=>$application
            ));

    }

    public function get_employee_id(){
        $output=$this->students->get_last_employee_id();
        echo json_encode($output);
    }
    public function get_academic_types(){
        $output=$this->students->get_academic_types();
        echo json_encode(array('academic_types'=>$output));
    }

    public function add_photo($id)
    {

        $baseURL = base_url();
        $ab_path =  $this->config->item('ab_path');

        $target_path = $ab_path."uploads/student_photos/";

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
                        'student' => $id,
                        'photo' => $imageName . "." . $extension,
                        'created_at' => $this->currentTime,
                        'updated_at' => $this->currentTime,
                        'user' => USER_ID
                    );
                    $query = $this->students->get_student_photo_by_id_ajax($id);

                    if($query->num_rows() == 0)
                    {
                        $this->students->save('asms_students_photos',$std_photo_details);
                        echo json_encode(array("status" => TRUE, "message" => "Photo uploaded successfully.", "photo" => $imageName . "." . $extension));
                        $this->system_log->create_system_log("Student Photo", "Success", "Student Photo uploaded successfully Student ID #".$id);
                    }
                    else
                    {
                        $this->students->update('asms_students_photos',$std_photo_details,array('student' => $id));
                        echo json_encode(array("status" => TRUE, "message" => "Photo uploaded successfully.", "photo" => $imageName . "." . $extension));
                        $this->system_log->create_system_log("Student Photo", "Success", "Student Photo Updated successfully Student ID #".$id);
                    }

                }
                else
                {
                    $this->system_log->create_system_log("Student Photo", "Failed", "Failed to save the Student  photo Student ID #".$id);
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
        $photo = $this->students->check_image_availability($std_id);
        echo json_encode($photo->row());

    }


    public function get_programe_id()
    {
        $program_id = $this->input->post('program_id');
        $program_details = $this->students->get_programe_id($program_id);
        $batch_details = $this->students->get_batches_program_wise($program_id);
        $uni_data_pathway = $this->students->uni_data_pathway($program_id);
        $uni_data_foreign = $this->students->uni_data_foreign($program_id);
       // var_dump(count($uni_data_foreign));

        if (count($uni_data_foreign)==1){
            echo json_encode(array('program_details'=>$program_details,'batch_details'=>$batch_details,'program_uni_data'=>$uni_data_foreign));
        }else{
            echo json_encode(array('program_details'=>$program_details,'batch_details'=>$batch_details,'program_uni_data'=>$uni_data_pathway));
        }
        //$program_uni_data = $this->students->get_uni_data_by_prog_id($program_id);

       // echo json_encode(array('program_details'=>$program_details,'program_uni_data'=>$program_uni_data));
    }

    public function get_university_data_by_uni_id()
    {
        $university_id = $this->input->post('university');
        $program_id = $this->input->post('program');
        $uni_details = $this->students->get_uni_data_by_uni_id($university_id,$program_id);

        echo json_encode(array('uni_details'=>$uni_details));
    }

    //get intakes
    public function get_intakes()
    {
        $intake_id = $this->input->post('intake_id');
        $data = $this->students->get_intakes($intake_id);
        echo json_encode($data);
    }

    public function get_view_programe()
    {
        $program_id = $this->input->post('programe_id');
        $program_details = $this->students->get_view_programe($program_id)->name;
        echo json_encode($program_details);
    }

    public function get_view_university()
    {
        $university_id = $this->input->post('university_id');
        $university_details = $this->students->get_view_university($university_id)->name;
        echo json_encode($university_details);
    }

    public function get_view_batch()
    {
        $intake_id = $this->input->post('intake');
        $pro_details = $this->students->get_view_batch($intake_id);
        $batch_details = 'Batch '.$pro_details->batch_id.' '.$pro_details->intake_name.' '.$pro_details->year;
        echo json_encode($batch_details);
    }

//    public function get_view_intake()
//    {
//        $intake_id = $this->input->post('intake_id');
//        $intake_details = $this->students->get_view_intake($intake_id)->name;
//        echo json_encode($intake_details);
//    }

    public function get_max_discount(){

        $student_id = $this->input->post('student_id');
        $stu_details = $this->students->get_by_id($student_id);
        $max_disc_amount = $this->students->get_mark_max_disc($stu_details->programe,$stu_details->batch,$stu_details->intake);

        echo json_encode(array('disc_data'=>$max_disc_amount,'stu_details'=>$stu_details));
    }

    public function validate_student(){

        $record= $this->input->post();

        $this->db->where('id',$record['record_id']);
        $this->db->update('asms_students_register',array('mak_disc'=>$record['disc_amount']));

        $new_dis_to_be_paid_amount = $record['new_dis_to_be_paid_amount'];

        $data = array(
            'paid_total_marketing_discount'=> $new_dis_to_be_paid_amount
        );


        $stu_details = $this->students->get_by_id($record['record_id']);
        if($this->students->update_mark_max_disc($stu_details->programe,$stu_details->batch,$stu_details->intake,$data)){
            echo json_encode(array('message'=>'Successfully Updated the Student Discount'));
        } else {
            echo json_encode(array('message'=>'Student Discount Update Failed'));
        }
    }

    public function regist_validate_student(){

        $record= $this->input->post();
      

        //insert Attendance ID
        $get_last_att_id=$this->students->get_last_att_id()->another_student_id;
        $new=$get_last_att_id+1;
        $new_att_id=(sprintf('%09d',(int)$new));
         
        // insert Student new ID
        $program_id=$this->students->get_by_id($record['record_id'])->programe;
        
        $get_last_program_id=$this->students->get_last_program_id_data($program_id)->student_id;
        $get_program_code_data=$this->clean($get_last_program_id);
        $get_id_data=$this->get_numerics($get_last_program_id);
        $student_id=$get_id_data[0]+1;
        $new_id=(sprintf('%05d',(int)$student_id));
        $new_student_id=$get_program_code_data.''.$new_id;
        // var_dump($new_student_id);
        // var_dump($get_last_program_id);
        // die();
        $this->db->where('id',$record['record_id']);
        $this->db->update('asms_students_register',array('stu_status'=>3,'another_student_id'=>$new_att_id,'student_id'=>$new_student_id,'qualified_date'=> date("Y-m-d H:i:s")));

        echo json_encode(array('message'=>'Successfully Validate the Student'));

    }
    function get_numerics ($str) {
        preg_match_all('/\d+/', $str, $matches);
        return $matches[0];
    }
    function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
     
        return preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.
    }

}