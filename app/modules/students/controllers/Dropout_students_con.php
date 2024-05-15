<?php


class Dropout_students_con extends CI_Controller{
    var $table;
    var $program_data_table;
    var $student_register_table;
    var $student_transfer_details;
    public function __construct(){

        parent::__construct();
        $this->load->model('Dropout_students_mod','dropout_mod');
        $this->load->library('form_validation');
        $this->load->library('kcrud');
        $this->load->library('system_log');

        if(!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        $this->table="asms_students_register";
        $this->program_data_table="asms_student_programs";
        $this->student_register_table="asms_students_register";
        $this->student_transfer_details="asms_student_transfer_details";
    }

    public function index(){

        $meta['title']="Dropout Students";
        $this->load->view('common/header',$meta);
        $this->load->view('students/dropout_student_index');
        $this->load->view('common/footer');

    }
    public function index_two(){

        $meta['title']="Freeze Students";

        $this->load->view('common/header',$meta);
        $this->load->view('students/freeze_student_index');
        $this->load->view('common/footer');

    }
    public function dropout_list(){

        $this->load->library('datatables');

        $this->datatables->select("
        asms_students_register.id,
        asms_students_register.student_id,
        CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
        asms_m_programs.name AS program_name,
        CONCAT(asms_students_register.st_title, '',asms_students_register.st_full_name) AS student,
        IF(asms_students_register.st_nic_num !='',UPPER(asms_students_register.st_nic_num),asms_students_register.st_passport_num) AS nic_num_details,
        asms_students_register.dropout_date,
        asms_students_register.id AS q_id,
        ",FALSE);

        $this->datatables->from('asms_students_register');
        $this->datatables->where('asms_students_register.st_qualified_status',"Dropout");
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
//        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->add_column("Actions","
       <a href='javascript:;' onclick='student_freeze(".'$1'.")' title='Freeze Student'><i class='fa fa-eye'></i></i></a>&nbsp;
        ","q_id");
        $this->datatables->unset_column('q_id');
        echo $this->datatables->generate();

    }
    public function freeze_list(){

        $this->load->library('datatables');

        $this->datatables->select("
        asms_students_register.id,
        asms_students_register.student_id,
        CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
        asms_m_programs.name AS program_name,
        CONCAT(asms_students_register.st_title, '',asms_students_register.st_full_name) AS student,
        IF(asms_students_register.st_nic_num !='',UPPER(asms_students_register.st_nic_num),asms_students_register.st_passport_num) AS nic_num_details,
        asms_students_register.freeze_date,
        asms_students_register.id AS q_id,
        ",FALSE);

        $this->datatables->from('asms_students_register');
        $this->datatables->where('asms_students_register.freeze_date !=',null);
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
//        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->add_column("Actions","
        
        ","q_id");
        $this->datatables->unset_column('q_id');
        echo $this->datatables->generate();

    }

    public function student_data(){
        $val=$this->input->post();
        $select="id,batch,intake,programe";
        $where=$this->table.".id=".$val['id'];
        $acc=$this->kcrud->getValueOne($this->table,$select,$where,null,null,null,null);
        echo json_encode(array('student'=>$acc));
    }

    public function add_enrollment(){

        $val=$this->input->post();
        $this->db->trans_start();

//        $this->form_validation->set_rules("student","Student","trim|required");
        $this->form_validation->set_rules("program","Program","trim|required");
        $this->form_validation->set_rules("batch","Batch","trim|required");
        $this->form_validation->set_rules("new_number","New Number","trim|required");
        $this->form_validation->set_rules("reason_for_transfer","Reason ","trim|required");

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;


//            if(form_error("student")){
//
//                $data["input_error"][] ="student";
//                $data["error_string"][]=form_error("student");
//            }
            if(form_error("program")){

                $data["input_error"][] ="program";
                $data["error_string"][]=form_error("program");
            }
            if(form_error("batch")){

                $data["input_error"][] ="batch";
                $data["error_string"][]=form_error("batch");
            }
            if(form_error("new_number")){

                $data["input_error"][] ="new_number";
                $data["error_string"][]=form_error("new_number");
            }
            if(form_error("reason_for_transfer")){

                $data["input_error"][] ="reason_for_transfer";
                $data["error_string"][]=form_error("reason_for_transfer");
            }


            echo json_encode($data);
            exit();
        }
        else{
            //current_payment_plan
            if (empty($val['custom_amount'])){
                echo json_encode(array('status'=>FALSE,'message'=>'Please Add Custom Plans to the List!'));
            }else{
                $x = explode(',',$val['batch']);
                $program_enrollment_intake = $x[0] ;
                $program_enrollment_batch = $x[1] ;
                //check student already in program
                $student_id=$val['student_id_number'];
                $program_id=$val['program'];

                $current_payment_plan=$val['current_payment_plan_id'];

                $payment_plan_id=4;



                if (empty($val['already_saved_currency_id']) && empty($val['program_total_amount']) && empty($val['balance_installments'])){

                } elseif (empty($val['balance_installments'])){
                    echo json_encode(array('status'=>FALSE,'message'=>'Installment Balance Less then 0 !'));
                }else{
                    $sx = 0;
                    foreach ($val['custom_amount'] as $key => $value) {
                        if (!empty($val['custom_amount'][$key])) {
                            $sx += floatval($val['custom_amount'][$key]);
                        }
                    }
                    $cus_tot=$sx;
                    if ($val['balance_installments']==$cus_tot){

                        $check_save_plan=$this->dropout_mod->check_alredy_custom_save_plans($val['program_enrollment_id'],$program_id,$payment_plan_id,$program_enrollment_batch,$program_enrollment_intake);
                        if ($check_save_plan==null){
                            $new_program_fee=array(
                                'program_id'=>$program_id,
                                'batch_id'=>$program_enrollment_batch,
                                'program_enrollment_id'=>$val['program_enrollment_id'],
                                'total_program_fee'=>$val['program_total_amount'],
                                'payment_plan_id'=>$payment_plan_id,
                                'currency_id'=>$val['already_saved_currency_id'],
                                'user_id'=>USER_ID,
                                'created_at'=>date('Y-m-d H;i:s'),
                                'status'=>1
                            );
                            $this->db->insert("asms_program_fees",$new_program_fee);
                            $new_program_fee_id = $this->db->insert_id();
                            $this->system_log->create_system_log("Student Enrollment(New transfer)", "Success", "Student Created New Custom Plan Added ID #".$new_program_fee_id);

                        }
                        else{
                            $new_program_fee_id=$check_save_plan->id;

                        }

                        $update_student_program_data=array(
                            'status'=>0
                        );

                        $this->kcrud->update($this->program_data_table,$update_student_program_data,array('student_id'=>$student_id));
                        $student_programs=array(
                            'student_id'=>$student_id,
                            'program_id'=>$program_id,
                            'program_fee_id'=>$new_program_fee_id,
                            'batch_id'=>$program_enrollment_batch,
                            'intake_id'=>$program_enrollment_intake,
                            'created_at'=>date('Y-m-d H;i:s'),
                            'status'=>1
                        );
                        $student_register_data=array(
                            'programe'=>$program_id,
                            'batch'=>$program_enrollment_batch,
                            'intake'=>$program_enrollment_intake,
                            'updated_at'=>date('Y-m-d H;i:s'),
                            'freeze_date'=>date('Y-m-d H;i:s'),
                            'st_qualified_status'=>"YES"

                        );
                        $this->db->insert("asms_student_programs",$student_programs);
                        $student_program_id = $this->db->insert_id();
                        $this->system_log->create_system_log("Student Enrollment", "Success", "Student Enrolled To Program Added ID #".$student_program_id);

                        // check and update status already in custom plan
                        $check_already_in_custom_plan=$this->dropout_mod->check_already_in_custom_plan($new_program_fee_id,$student_id);
                        if ($check_already_in_custom_plan==null){

                        }else{
                            $change=array(
                                'status'=>0
                            );
                            $this->kcrud->update("asms_program_fee_details",$change,array('custom_student_id'=>$student_id));
                        }


                        foreach ($val['custom_amount'] as $key => $value) {
                            if(!empty($val['custom_amount'][$key])) {
                                $data3 = array(
                                    'program_fee_id'=>$new_program_fee_id,
                                    'installment'=>$val['custom_installment'][$key],
                                    'installment_type'=>null,
                                    'due_date'=>$val['custom_installment_date'][$key],
                                    'custom_student_id'=>$student_id,
                                    'amount'=>$val['custom_amount'][$key],
                                    'late_levy'=>$val['custom_late'][$key],
                                    'user_id'=>USER_ID,
                                    'created_at'=>date('Y-m-d H;i:s'),
                                    'status'=>1,
                                );
                                $this->db->insert("asms_program_fee_details",$data3);
                                $installment_id = $this->db->insert_id();
                                $this->system_log->create_system_log("Program Fee", "Success", "Program Installment Added ID #".$installment_id);

                            }
                        }
                        $history=array(
                            'student_id'=>$student_id,
                            'previous_payment_plan'=>$current_payment_plan,
                            'previous_balance'=>$val['total_amount'],
                            'current_payment_plan'=>"4",
                            'current_balance'=>$val['balance_installments'],
                            'new_number'=>$val['new_number'],
                            'reason_for_transfer'=>$val['reason_for_transfer'],
                        );
                        $this->db->insert("asms_student_transfer_details",$history);
                        $installment_id = $this->db->insert_id();
                        $this->system_log->create_system_log("Program Fee", "Success", "Program Installment Added ID #".$installment_id);

                        $this->kcrud->update($this->student_register_table,$student_register_data,array('id'=>$student_id));

                        $this->db->trans_complete();
                        if ($this->db->trans_status()=== FALSE){
                            echo json_encode(array('status'=>FALSE,'message'=>'Internal Server Error code  DBNTS001 !'));
                        }else{
                            echo json_encode(array('status'=>TRUE,'message'=>'Custom Plan Created successfully !'));
                        }


                    }
                    else{
                        echo json_encode(array('status'=>FALSE,'message'=>'Custom Installments Total and Installment Balance Not Matched !'));
                    }



                }
            }
        }
    }



}