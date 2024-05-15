<?php  if (!defined('BASEPATH')) { exit('No direct script access allowed'); }

class Enrolled_students_ids_con extends CI_Controller{

    public function __construct(){
        parent::__construct();
        if(!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }

        $this->load->model('enrolled_students_ids_mod','students_ids');
        $this->load->library('form_validation');
        $this->load->library('system_log');
        $this->load->library('kcrud');
    }

    public function index(){
        $meta['title']="Students IDs";
        $this->load->view('common/header',$meta);
        $this->load->view('students/enrolled_students_ids_index');
        $this->load->view('common/footer');
    }

    public function qualified_list(){
        // if(USER_ID=="1"){
           
        // }else{
        //     $x=$this->user_details(USER_ID);
        //     $where = array('asms_students_register.st_qualified_status'=>"REG_PAYMENT_PAID",'asms_students_reg_pref_branches.branch_id'=>$x->branch_id,'asms_students_reg_pref_branches.pref_order'=>"1");
        // }
        $where = array('asms_students_register.st_qualified_status'=>"YES",'asms_students_register.status'=>1);
        $this->load->library('datatables');

        $this->datatables->select("
        asms_students_register.id,
        asms_students_register.student_id,
        CONCAT(asms_m_batches.batch_code,' ',asms_m_intakes_list.intake_name,' - ',asms_m_batch_intakes.year) AS batch_details,
        asms_m_programs.name AS program_name,
        CONCAT(asms_students_register.st_title, '',asms_students_register.st_full_name) AS student,
        IF(asms_students_register.st_nic_num !='',UPPER(asms_students_register.st_nic_num),asms_students_register.st_passport_num) AS nic_num_details,
        asms_students_register.qualified_date,
        asms_students_register.id AS q_id,
        ",FALSE);

        // if(USER_ID=="1"){
        //     $this->datatables->from('asms_students_register');
        //     $this->datatables->where($where);
        // }else{
            $this->datatables->from('asms_students_register');
           // $this->datatables->join('asms_students_reg_pref_branches','asms_students_register.id=asms_students_reg_pref_branches.student_ref_id','left');
           $this->datatables->join('asms_m_batches','asms_m_batches.id=asms_students_register.batch','left');
           $this->datatables->join('asms_m_batch_intakes','asms_m_batch_intakes.id=asms_students_register.intake','left');
           $this->datatables->join('asms_m_intakes_list','asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id','left');
           $this->datatables->join('asms_m_programs','asms_m_programs.id=asms_students_register.programe','left');
           $this->datatables->where('asms_students_register.status',1);
        $this->datatables->where('qualified_date !=', null);
        $this->datatables->where('asms_students_register.stu_status',3);
          //  $this->datatables->where($where);
       // }

        $this->datatables->add_column("Actions","
        <a class='btn btn-sm btn-default tbl-action' href='get_barcode_ids/".'$1'."' title='Print ID' target='blank' >
                <i class='fa fa-print'></i>
            </a>&nbsp;
        ","q_id");

        $this->datatables->unset_column('q_id');
        echo $this->datatables->generate();
    }

    public function get_barcode_ids($id){
        $student_data = $this->students_ids->get_all_book_ids($id);
        $course_data = $this->students_ids->get_course_data_by_id($student_data->programe);
      //  $discipline_data = $this->students_ids->get_disipline_data_by_id($student_data->pref_discipline);
        $output['course_data'] = $course_data;
      //  $output['discipline_data'] = $discipline_data;
        $output['student_data'] = $student_data;
        $output['photo_data'] =$this->students_ids->get_student_photo($id);
        $this->load->view('employee_list/student/print_ids/print_id_preview',$output);
     }

    public function user_details($id){
        $this->db->select("branch_id");
        $this->db->from("asms_users_info");
        $this->db->where("asms_users_info.id",$id);
        $query=$this->db->get();
        return $query->row();
    }
}