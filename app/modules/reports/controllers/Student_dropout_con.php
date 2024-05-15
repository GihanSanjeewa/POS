<?php


class Student_dropout_con extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Student_dropout_mod');

        $this->load->library('system_log');
        $this->load->library('kcrud');
        $this->load->library('form_validation');

        date_default_timezone_set("Asia/Colombo");
        ini_set('display_errors', 0);
    }

    public function index(){
        $meta['title']='Students Dropouts';
        $this->load->view('common/header',$meta);

        $this->load->view('studentsDropouts');

        $this->load->view('common/footer');
    }


    public function check_student_drop_Result(){

        $type=$this->input->post('drop');

    //     if($type=="pay"){

    //     $data = $this->Student_dropout_mod->checkDropInfo();

    //     $monthly = array();
    //     $semester = array();
    //     $res_std = array();
    //     foreach ($data as $value) {
    //         if($value->status == "Past"){
    //             if (substr($value->installment,0,4) == "Mont") {
    //                 $monthly[] = array($value->cp,$value->Name,$value->Programme,$value->installment,$value->std_ref);
    //             }
    //             elseif (substr($value->installment,0,4) == "Seme") {
    //                 $semester[] = array($value->cp,$value->Name,$value->Programme,$value->installment,$value->std_ref);
    //             }
    //         }
    //     }
    //     foreach ($monthly as $key_m=>$m) {

    //         if ($m[0] <= 3){

    //             $res_std[] = array('name'=>$m[1],'Programme'=>$m[2],'reason'=>$m[3],'std_ref'=>$m[4],'ins'=>'Monthly');

    //         }
    //     }
    //     foreach ($semester as $key=>$m) {
    //         if ($m[0] < 2) {

    //             $res_std[] = array('name'=>$m[1],'Programme'=>$m[2],'reason'=>$m[3],'std_ref'=>$m[4],'ins'=>'Semester');
    //         }
    //     }

    //     $data_result['array_data']=$res_std;

    // }elseif ($type=="att"){
    //     $data = $this->Student_dropout_mod->drop_att();
    //     $att = array();
    //     $res_std = array();
    //     foreach ($data as $value) {
    //         if($value->att_c <= "3") {

    //             $att[] = array($value->name,$value->reg_id,$value->sub,$value->att_c,$value->s_id);

    //             }
    //          }

    //         foreach ($att as $key_m=>$m) {

    //             if ($m[3] > 2){

    //                 $res_std[] = array('name'=>$m[0],'Programme'=>$m[2],'reason'=>"Attendance less than $m[3]",'std_ref'=>$m[5]);

    //             }
    //         }

            
            

    //     }
            $student_data=$this->Student_dropout_mod->for_dropout_mockup();
            
            $data['student_data']= $student_data;

        $this->load->view('droupout_results',$data); 

    }
    public function check_ref_id(){
        $ref_id=$this->input->post('id');
        $data_id = $this->Student_dropout_mod->checkID($ref_id);
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