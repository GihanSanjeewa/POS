<?php


class Reports_student_con extends CI_Controller{

    public function __construct()
    {

        parent::__construct();

        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('Reports_student_mod');
        $this->load->library('permissions');

        error_reporting(1);
        ini_set('display_errors', 01);
    }

    public function studentsDetails(){
        $meta['title']="Students Report";
        $data['batches']=$this->Reports_student_mod->get_batches();
        $data['intakes']=$this->Reports_student_mod->get_intakes();
        $data['programs']=$this->Reports_student_mod->get_programs();
        $data['universities']=$this->Reports_student_mod->get_universities();
        $this->load->view('common/header',$meta);
        $this->load->view('students',$data);
        $this->load->view('common/footer');
    }
    public function checkStudentInfo(){
        $val=$this->input->post();
        $batch=$val['batch'];
        $intake=$val['intake'];
        $program=$val['program'];
        $university=$val['university'];
        if (!empty($batch) && empty($intake) && empty($program)){
            $where="asms_students_register.batch='$batch' ORDER BY asms_students_register.id DESC";
        }elseif (!empty($batch) && !empty($intake) && empty($program)){
            $where="asms_students_register.batch='$batch' AND asms_students_register.intake='$intake' ORDER BY asms_students_register.id DESC";
        }elseif (!empty($batch) && empty($intake) && !empty($program)){
            $where="asms_students_register.batch='$batch' AND asms_students_register.programe='$program' ORDER BY asms_students_register.id DESC";
        }elseif (empty($batch) && !empty($intake) && !empty($program)){
            $where="asms_students_register.intake='$intake' AND asms_students_register.programe='$program' ORDER BY asms_students_register.id DESC";
        }elseif (empty($batch) && !empty($intake) && empty($program)){
            $where="asms_students_register.intake='$intake' ORDER BY asms_students_register.id DESC";
        }elseif (empty($batch) && empty($intake) && !empty($program)){
            $where="asms_students_register.programe='$program' ORDER BY asms_students_register.id DESC";
        }else{
            $where="asms_students_register.batch='$batch' AND asms_students_register.intake='$intake' AND asms_students_register.programe='$program' ORDER BY asms_students_register.id DESC";
        }
        $data['student_data'] = $this->Reports_student_mod->checkStudentInfo($where);
        $this->load->view('students/load_student_raw_result',$data);
//        $output=$this->Reports_student_mod->checkStudentInfo($where);
//        echo json_encode(array('studentData'=>$output));

    }
    public function studentsPayments(){
        $meta['title']="Students Payments";
        $data['students']=$this->Reports_student_mod->get_students();
        $data['programs']=$this->Reports_student_mod->get_programs();
        $data['paymentPlans']=$this->Reports_student_mod->get_paymentPlans();
        $this->load->view('common/header',$meta);
        $this->load->view('studentsPayments',$data);
        $this->load->view('common/footer');
    }
    public function checkStudentPayment(){
        $val=$this->input->post();
        $status=$val['status'];
        $student=$val['student'];
        $program=$val['program'];
        $installment_type=$val['installment_type'];
        if (!empty($status) && empty($student) && empty($program) && empty($installment_type)){
            $where=" asms_payments.payment_status='$status' ORDER BY asms_payments.id DESC";
        }elseif (!empty($status) && !empty($student) && empty($program) && empty($installment_type)){
            $where=" asms_payments.payment_status='$status' AND asms_payments.student_id='$student' ORDER BY asms_payments.id DESC";
        }elseif (!empty($status) && !empty($student) && !empty($program) && empty($installment_type)){
            $where=" asms_payments.payment_status='$status' AND asms_payments.student_id='$student' AND asms_payments.program_id='$program' ORDER BY asms_payments.id DESC";
        }elseif (!empty($status) && empty($student) && !empty($program) && empty($installment_type)){
            $where=" asms_payments.payment_status='$status' AND asms_payments.program_id='$program' ORDER BY asms_payments.id DESC";
        }elseif (empty($status) && !empty($student) && !empty($program) && empty($installment_type)){
            $where=" asms_payments.student_id='$student' AND asms_payments.program_id='$program' ORDER BY asms_payments.id DESC";
        }elseif (empty($status) && !empty($student) && empty($program) && empty($installment_type)){
            $where=" asms_payments.student_id='$student' ORDER BY asms_payments.id DESC";
        }elseif (empty($status) && empty($student) && !empty($program) && empty($installment_type)){
            $where=" asms_payments.program_id='$program' ORDER BY asms_payments.id DESC";
        }
        elseif (!empty($status) && empty($student) && empty($program) && !empty($installment_type)){
            if ($installment_type==1){
                $where=" asms_payments.payment_status='$status' AND asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_payments.payment_status='$status' AND asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }

        }
        elseif (!empty($status) && !empty($student) && empty($program) && !empty($installment_type)){
            if ($installment_type==1){
                $where=" asms_payments.payment_status='$status' AND asms_payments.student_id='$student' AND asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_payments.payment_status='$status' AND asms_payments.student_id='$student' AND asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }

        }
        elseif (!empty($status) && empty($student) && !empty($program) && !empty($installment_type)){
            if ($installment_type==1){
                $where=" asms_payments.payment_status='$status' AND asms_payments.program_id='$program' AND asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_payments.payment_status='$status' AND asms_payments.program_id='$program' AND asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }

        }
        elseif (empty($status) && !empty($student) && !empty($program) && !empty($installment_type)){
            if ($installment_type==1){
                $where=" asms_payments.student_id='$student' AND asms_payments.program_id='$program' AND asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_payments.student_id='$student' AND asms_payments.program_id='$program' AND asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }

        }
        elseif (empty($status) && empty($student) && !empty($program) && !empty($installment_type)){
            if ($installment_type==1){
                $where=" asms_payments.program_id='$program' AND asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_payments.program_id='$program' AND asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }

        }
        elseif (empty($status) && empty($student) && empty($program) && !empty($installment_type)){
            if ($installment_type==1){
                $where=" asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }

        }
        else{
            if ($installment_type==1){
                $where=" asms_payments.payment_status='$status' AND asms_payments.student_id='$student' AND asms_payments.program_id='$program' AND  asms_program_fee_details.installment_type='1' ORDER BY asms_payments.id DESC";
            }else{
                $where=" asms_payments.payment_status='$status' AND asms_payments.student_id='$student' AND asms_payments.program_id='$program' AND asms_program_fee_details.installment_type IS NULL ORDER BY asms_payments.id DESC";
            }
        }
        $data['student_data'] = $this->Reports_student_mod->checkStudentPayment($where);
        $this->load->view('students/load_student_Paymentraw_result',$data);
//        $output=$this->Reports_student_mod->checkStudentInfo($where);
//        echo json_encode(array('studentData'=>$output));

    }
}