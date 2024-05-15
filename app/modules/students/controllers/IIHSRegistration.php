<?php

class IIHSRegistration extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();

        $this->load->model('IIHSRegistration_mod','registration');

        $this->load->library('system_log');

        date_default_timezone_set("Asia/Colombo");
        $this->currentTime = date('Y-m-d H:i:s');
        $this->currentDate = date('Y-m-d');
        ini_set('display_errors', 0);
    }

    public function index()
    {
        $segment= $this->uri->segment(4);
        $explode=explode('_',$segment);
        $ID=$explode[0]."/".$explode[1]."/".$explode[2];
        
        $check=$this->registration->check_inq($ID);
        if(count($check)>0){
            
            $this->load->helper('url');
        $data['registration_id']=$ID;
        $data['registration_data']=$check;
        $data['batches']=$this->registration->get_batches();
        $data['programs']=$this->registration->get_programs();
        $data['acdemic_uni']=$this->registration->get_acdemic_uni();

        $data['countries']=$this->registration->get_countries();
        $data['citizenships']=$this->registration->get_citizenship();
        
        $meta['title']='Online Student Application';

        $this->load->view('common/header_public',$meta);
        $this->load->view('lead_registration_index',$data);
        $this->load->view('common/footer_public');

        }else{
            echo "<script>alert('Invalid Registration Details'); document.location='https://iihsciences.edu.lk/'</script>";
        }
       
        
    }

    public function get_programs_data(){
        $courses_list = $this->registration->get_programs();
        echo json_encode(array(
            'courses_list'=>$courses_list 
        ));
    }

    

    

    public function get_last_student_number(){

        $count=count($this->registration->get_last_student_number());

        if($count > 0){
            $student_id='IIHS/'.date("y").'/'.strtoupper(date("M")).'/'.(sprintf('%05d',(int)$count+1));
        }
        else{
            $student_id='IIHS/'.date("y").'/'.strtoupper(date("M")).'/00001';
        }

        echo json_encode(array('student_id'=>$student_id));

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

    public function insert()
    {

        $count=count($this->registration->get_last_student_number());

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

        $count_uploaded_files = count( $_FILES['st_file_nic_pp']['name'] );
            if($count_uploaded_files>0){

            }else{
                echo json_encode(array(
                    'status'=>FALSE,
                    'message'=>'NIC Document is Required !',
                    'step'=>9
                ));
                exit();
            }

        $count_uploaded_files = count( $_FILES['st_file_ols']['name'] );
            if($count_uploaded_files>0){

            }else{
                echo json_encode(array(
                    'status'=>FALSE,
                    'message'=>'O/L Results Document is Required !',
                    'step'=>9
                ));
                exit();
            }

            





         

        $programe_data = explode('-',$this->input->post('batch'));
        $data = array(
            'programe'=>$this->input->post('program'),
            'batch'=>0,
            'university'=>0,
            'intake'=>0,
            //'st_min_years_local'=>$this->input->post('st_min_years_local'),
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
            'st_ol_year'=>$this->input->post('st_ol_year'),
            'st_ol_type'=>$this->input->post('st_ol_type'),
            'st_ol_data'=>json_encode($st_ol_data),
            'st_al_year'=>$this->input->post('st_al_year'),
            'st_al_type'=>$this->input->post('st_al_type'),
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
            'user'=>0,
            'created_at'=>date("Y-m-d H:i:s"),
            'updated_at'=>date("Y-m-d H:i:s"),
            'status'=>1,
            'registration_id'=>$this->input->post('registration_id')
        );

        

        if($insert_id=$this->registration->save('asms_students_register',$data)){

            $lead_management = array(
                'registration_id'=>$insert_id,
                'status_option'=>"Register",
                'register_date'=>date("Y-m-d H:i:s")
            );

            $this->registration->update('lead_management',$lead_management,array('lead_id_code'=>$this->input->post('registration_id')));

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
            //     $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
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
            //     $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
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
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
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
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
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
                $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
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
            // $count_uploaded_files = count( $_FILES['st_rpq_files']['name'] );
            // if($count_uploaded_files>0){
            //     // Count total st_rpq_files
            //     $countfiles = count($_FILES['st_rpq_files']['name']);
            //     // Looping all st_rpq_files
            //     for($i=0;$i<$countfiles;$i++){

            //         if(!empty($_FILES['st_rpq_files']['name'][$i])){

            //             // Define new $_FILES array - $_FILES['file']
            //             $_FILES['file']['name'] = $_FILES['st_rpq_files']['name'][$i];
            //             $_FILES['file']['type'] = $_FILES['st_rpq_files']['type'][$i];
            //             $_FILES['file']['tmp_name'] = $_FILES['st_rpq_files']['tmp_name'][$i];
            //             $_FILES['file']['error'] = $_FILES['st_rpq_files']['error'][$i];
            //             $_FILES['file']['size'] = $_FILES['st_rpq_files']['size'][$i];

            //             // Set preference

            //             //CI upload
            //             $st_rpq_files = explode('.',$_FILES['st_rpq_files']['name'][$i]);
            //             $st_rpq_files = $st_rpq_files[0];
            //             $st_rpq_files_name = $insert_id."_rpq_".date('_Y-m-d_h-i-s');
            //             $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
            //             $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf|docx|doc';
            //             $config['max_size'] = '5000'; // max_size in kb
            //             $config['file_name'] = $st_rpq_files_name;

            //             //Load upload library
            //             $this->upload->initialize($config);

            //             // File upload
            //             if($this->upload->do_upload('file')){
            //                 // Get data about the file
            //                 $uploadData = $this->upload->data();
            //                 $filename = $uploadData['file_name'];
            //                 $data_st_file_rpq = array(
            //                     "student" => $insert_id,
            //                     "document_type" => "st_rpq_file",
            //                     "document_name" => $filename,
            //                     'user'=>USER_ID,
            //                     "created_at" => date('Y-m-d h:i:s')
            //                 );
            //                 $this->db->insert('asms_students_documents',$data_st_file_rpq);
            //             }
            //         }
            //     }
            // }

            //st_hepq_file files
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
                        $st_hepq_files_name = $insert_id."_hepq_".date('_Y-m-d_h-i-s');
                        $config['upload_path'] = $ab_path."/uploads/student_documents/".$insert_id."/";
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

            echo json_encode(array('status'=>TRUE,'message'=>'Successfully Registered!','std_id'=>$insert_id));
            $this->system_log->create_system_log("Student Register Online", "Success", "Online Student added successfully -. Student ID #".$student_id);
        }
        else{
            echo json_encode(array('status'=>FALSE,'message'=>'Registration Failed, Try Again !'));
        }
    }

    private function _make_null($input)
    {
        $var = empty($input) ? NULL : $input;
        return $var;
    }
}