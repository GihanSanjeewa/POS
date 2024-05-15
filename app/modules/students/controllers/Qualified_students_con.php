<?php


class Qualified_students_con extends CI_Controller{

    public function __construct(){

        parent::__construct();
        $this->load->model('Qualified_students_mod','qualified');
        $this->load->library('form_validation');

        if(!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
    }

    public function index(){

        $meta['title']="Registered Student";

        $data['batches']=$this->qualified->get_batches();
        $this->load->view('common/header',$meta);
        $this->load->view('students/qualified_student_index',$data);
        $this->load->view('common/footer');

    }
    public function index_two(){

        $meta['title']="Non Qualified Students";

        $data['batches']=$this->qualified->get_batches();
        $this->load->view('common/header',$meta);
        $this->load->view('students/non_qualified_student_index',$data);
        $this->load->view('common/footer');

    }
    public function qualified_list(){

        $this->load->library('datatables');

        $this->datatables->select("
        asms_students_register.id,
        asms_students_register.another_student_id,
        asms_students_register.student_id,
        CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
        asms_m_programs.name AS program_name,
        CONCAT(asms_students_register.st_title, '.',asms_students_register.st_full_name) AS student,
        IF(asms_students_register.st_nic_num !='',UPPER(asms_students_register.st_nic_num),asms_students_register.st_passport_num) AS nic_num_details,
        asms_students_register.qualified_date,
        asms_students_register.id AS q_id,
        ",FALSE);

        $this->datatables->from('asms_students_register');
        $this->datatables->where('asms_students_register.status',1);
        $this->datatables->where('qualified_date !=', null);
        $this->datatables->where('asms_students_register.stu_status',3);
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
//        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
        $this->datatables->add_column("Actions","
       
        <a class='btn btn-sm btn-default tbl-action' href='javascript:;' title='View' onclick='view_student(".'$1'.");'>
            <i class='fa fa-list'></i> View
        </a>&nbsp;
        ","q_id");
        $this->datatables->unset_column('q_id');
        echo $this->datatables->generate();
    
    }
    // <a href='javascript:;' onclick='view_program(".'$1'.")' title='Enrolled Programs'><i class='fa fa-eye'></i></i></a>&nbsp;
    public function non_qualified_list(){

        $this->load->library('datatables');

        $this->datatables->select("
        asms_students_register.id,
        asms_students_register.student_id,
        IF(asms_students_register.st_nic_num !='',UPPER(asms_students_register.st_nic_num),asms_students_register.st_passport_num) AS nic_num_details,
        CONCAT(asms_students_register.st_title, ' ',asms_students_register.st_full_name) AS student,
        CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
        asms_m_programs.name AS program_name, 
        CONCAT(asms_students_register.mak_disc,'%')AS dis, 
        asms_students_register.created_at,
        asms_students_register.updated_at,
        asms_students_register.id AS q_id,
        ",FALSE);
        $this->datatables->from('asms_students_register');
        $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left'); 
        $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
        $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
        $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
        $this->datatables->where('asms_students_register.status',1);
        $this->datatables->where('asms_students_register.stu_status',1);
        $this->datatables->where('qualified_date', null);
        $this->datatables->add_column("Actions","
        <a href='javascript:;' onclick='enroll_program(".'$1'.")' title='Enrolled Programs'><i class='fa fa-plus'></i></i></a>&nbsp;
        ","q_id");
        $this->datatables->unset_column('q_id');
        echo $this->datatables->generate();

    }



    public function get_master(){

        $batches=$this->qualified->get_batch();
        $hall=$this->qualified->get_halls();
        echo json_encode(array('batch'=>$batches,'hall'=>$hall));

    }
    public function get_semester($id){

        $semester=$this->qualified->get_semester($id);
        echo json_encode(array('semester'=>$semester));

    }
    public function get_subject($id){

        $subject=$this->qualified->get_subject($id);
        echo json_encode(array('subject'=>$subject));

    }
    public function get_classes($id){

        $class=$this->qualified->get_classes($id);
        echo json_encode(array('class'=>$class));

    }

    public function save(){

        $this->form_validation->set_rules("batch","Batch","trim|required");
        $this->form_validation->set_rules("semester","Semester","trim|required");
        $this->form_validation->set_rules("subject","Subject","trim|required");
        $this->form_validation->set_rules("hall","Hall","trim|required");
        $this->form_validation->set_rules("class","Class","trim|required");
        $this->form_validation->set_rules("seat_capacity","Seat Capacity","trim|required");

        if($this->form_validation->run() == false){

            $data=array();
            $data["error"]=array();
            $data["input_error"]=array();
            $data["status"]=FALSE;

            if(form_error("batch")){

                $data["input_error"][] ="batch";
                $data["error_string"][]=form_error("batch");
            }
            if(form_error("semester")){

                $data["input_error"][] ="semester";
                $data["error_string"][]=form_error("semester");
            }
            if(form_error("subject")){

                $data["input_error"][] ="subject";
                $data["error_string"][]=form_error("subject");
            }
            if(form_error("hall")){

                $data["input_error"][] ="hall";
                $data["error_string"][]=form_error("hall");
            }
            if(form_error("class")){

                $data["input_error"][] ="class";
                $data["error_string"][]=form_error("class");

            }
            if(form_error("seat_capacity")){

                $data["input_error"][] ="seat_capacity";
                $data["error_string"][]=form_error("seat_capacity");

            }

            echo json_encode($data);
            exit();
        }
        else{

            $val=$this->input->post();

            $data=array(

                'batch'=>$val['batch'],
                'semester'=>$val['semester'],
                'subject'=>$val['subject'],
                'hall'=>$val['hall'],
                'class'=>$val['class'],
                'actual_capacity'=>$val['seat_capacity'],
                'available_capacity'=>$val['seat_capacity'],
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'user'=>USER_ID
            );

            if($insert_id=$this->qualified->save('asms_class_arrangement',$data)){
                echo json_encode(array('status'=>TRUE,'message'=>'Class Arrangement successfully !'));
            }
            else{
                echo json_encode(array('status'=>FALSE,'message'=>'Class Arrangement successfully !'));
            }
        }
    }

    public function view_program($id){

        $program=$this->qualified->view_program($id);
        echo json_encode(array('program'=>$program));

    }

    public function delete_class($id){

        if($this->qualified->get_list_by_id('asms_class_arrangement','*',array('id'=>$id,'status'=>0))){

            $this->qualified->delete('asms_class_arrangement',array('id'=>$id,'status'=>0));
            echo json_encode(array('status'=>TRUE));

        }
        else{

            echo json_encode(array('status'=>FALSE));

        }

    }


    public function get_search(){

        $this->form_validation->set_rules("filter_batch","Batch","trim|required");

        if($this->form_validation->run() == false) {

            $data = array();
            $data["error"] = array();
            $data["input_error"] = array();
            $data["status"] = FALSE;

            if(form_error("filter_batch")) {

                $data["input_error"][] = "filter_batch";
                $data["error_string"][] = form_error("filter_batch");

            }

            echo json_encode($data);
            exit();

        }
        else{

            $val=$this->input->post();

            if($installment=$this->qualified->get_batch_first_installment(array('batch'=>$val['filter_batch'],'semester'=>1))->installment){

                if($students=$this->qualified->get_qualified_students($val['filter_batch'],$installment,1)){

                    echo json_encode(array('status'=>TRUE,'students'=>$students));

                }
                else{

                    echo json_encode(array('status'=>FALSE,'message'=>'No Students Found!'));

                }
            }
            else{

                echo json_encode(array('status'=>FALSE,'message'=>'Please Enter Installments'));
            }
        }
    }

    public function process(){

        $val=$this->input->post();

        if($val['std_id']){

            foreach($val['std_id'] as $key => $val1){

                $data1=array(
                    'status'=>1,
                    'qualified_date'=>date('Y-m-d h:i:s')
                );

                $data2=array(
                    'status'=>1
                );

                if($this->qualified->update('asms_students_register',$data1,array('id'=>$val1))){

                    $this->qualified->update('asms_student_payments',$data2,array('std_ref_id'=>$val1));

                }
            }

            echo json_encode(array('status'=>TRUE,'message'=>'Assigned Successfully !'));
        }
        else{

            echo json_encode(array('status'=>FALSE,'message'=>'Error Qualified Students'));
        }

    }

    public function school_email_update(){

        $val=$this->input->post();
        $this->form_validation->set_rules("change_school_email","School Email","trim|required");

        if($this->form_validation->run() == false) {

            $data = array();
            $data["error"] = array();
            $data["input_error"] = array();
            $data["status"] = FALSE;

            if(form_error("change_school_email")) {

                $data["input_error"][] = "change_school_email";
                $data["error_string"][] = form_error("change_school_email");

            }

            echo json_encode($data);
            exit();

        }
        else{

            $val=$this->input->post();

             
            $data1=array(
                'st_email_school'=>$val['change_school_email'],
                'qualified_date'=>date('Y-m-d h:i:s')
            );
            $data2=array(
                'id'=>$val['change_email_student_id']
            );
            
            if($this->qualified->update('asms_students_register',$data1,$data2)){

                     
                echo json_encode(array('status'=>TRUE,'message'=>'School Email Updated Successfully !'));
            }else{
                echo json_encode(array('status'=>FALSE,'message'=>'School Email update failed.'));
            }
        }
               
    }



}