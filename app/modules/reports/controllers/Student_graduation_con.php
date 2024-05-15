<?php


class Student_graduation_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Student_graduation_mod');

        $this->load->library('system_log');
        $this->load->library('kcrud');
        $this->load->library('form_validation');

        date_default_timezone_set("Asia/Colombo");
        ini_set('display_errors', 0);
    }

    public function index(){
        $meta['title']='Students Graduation';

        $data["programs"]=$this->Student_graduation_mod->load_programs();

        $this->load->view('common/header',$meta);

        $this->load->view('studentsgraduation',$data);

        $this->load->view('common/footer');
    }


    public function check_student_drop_Result(){

        $batch=$this->input->post('batch');
        $course=$this->input->post('course');

            
            $student_data=$this->Student_graduation_mod->for_dropout_mockup($batch,$course);
            
            $data['student_data']= $student_data;

        $this->load->view('graduation_results',$data); 

    }
    public function check_ref_id(){
        $ref_id=$this->input->post('id');
        $data_id = $this->Student_graduation_mod->checkID($ref_id);
        $this->load->view('droupout_results',$data_id);

    }


    public function view_dropout_result()
    {
        $ref_id=$this->input->post('id');
        $marketing=$this->input->post('marketing');
        $finance=$this->input->post('finance');
        $academic=$this->input->post('academic');



        $insert_b_data = array($finance,$marketing,$academic);

        if($ref_id!=""){
        $insert_b_data = array(
            'student_id' => $ref_id,
            'f_comment' => $insert_b_data[0],
            'm_comment' => $insert_b_data[1],
            'a_comment' => $insert_b_data[2],
        );
        $this->db->insert('asms_dropouts_comments', $insert_b_data);
        unset($insert_b_data);
        //$this->system_log->create_system_log("Master - Program Modules", "Success", "New Program Module added #" . $insert_id);
        echo json_encode(array('status'=>TRUE,'message'=>' Dropout Comments added successfully !'));

    }else{
echo json_encode(array('status'=>FALSE,'message'=>'Dropout Comment add Failed !'));
}
        //echo json_encode(array('dis_data'=>$data));

    }



}