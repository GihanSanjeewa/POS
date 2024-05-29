<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        $this->load->model('dash_mod');
        $this->load->library('permissions');
        $this->load->library('kcrud');
    }


    public function index()
    {

        $this->load->view('common/header');
        $this->load->view('dashboard_index');
        $this->load->view('common/footer');
    }

    // public function user_details($id){
    //       $this->db->select("group_id");
    //       $this->db->from("auth_users_groups");
    //       $this->db->where("auth_users_groups.user_id",$id);
    //       $query=$this->db->get();

    //       return $query->row();
    //   }

    // public function enrolled_details($id){

    //         $group_id=$this->user_details(USER_ID)->group_id;


    public function get_agent_data($id)
    {

        $this->db->select('*');
        $this->db->from('lead_agent_detail_list');
        $this->db->where('lead_agent_detail_list.system_id', $id);
        $q = $this->db->get();
        return $q->row();
    }


    public function view_course_details()
    {


        $val = $this->input->post();
        $agId = $val['id'];

        $data['course_details'] = $this->dash_mod->get_course_details($agId);

        $this->load->view('agent_course_details', $data);
    }



    public function get_achivement_list()
    {

        $id = $this->input->post('id');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $target_lead = array();
        $proramm_data = array();
        $target_counselor = array();

        $today_year = date('Y');

        $proramm_list = $this->dash_mod->get_lead_course_details($from_date, $to_date);

        foreach ($proramm_list as $programm_data) {

            $table0 = "asms_lead_target";
            $select0 = "SUM(asms_lead_target_intakes.target) AS tot_count";
            $join0 = "JOIN asms_lead_target_intakes ON asms_lead_target.id=asms_lead_target_intakes.lead_target_tb_id";
            $where0 = "asms_lead_target.program='$programm_data->program' and (from_date>='$from_date' and to_date<='$to_date')";
            $group0 = "GROUP BY asms_lead_target.program";

            $table1 = "lead_management";
            $select1 = "count(lead_management.id) AS tot_counselor_count";
            $where1 = "lead_management.programe='$programm_data->program' and (lead_created_date>='$from_date' and lead_created_date<='$to_date') and lead_owner='$id'";
            // $group1="GROUP BY asms_lead_target.program";

            $target_lead[] = $this->kcrud->getValueOne($table0, $select0, $where0, null, $join0, $group0, null)->tot_count;
            $programm_name[] = $this->kcrud->getValueOne("asms_m_programs", "code,name", "id='$programm_data->program'", null, null, null, null)->code;
            $target_counselor[] = $this->kcrud->getValueOne($table1, $select1, $where1, null, null, null, null)->tot_counselor_count;
        }

        echo json_encode(array('target' => $target_lead, 'programm' => $programm_name, 'target_counselor' => $target_counselor));
    }


    public function get_total_inquiry_list()
    {


        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        $target_counselor = array();
        $counselor_name = array();

        $counselor_list = $this->dash_mod->get_counselor_details_lead($from_date, $to_date);

        foreach ($counselor_list as $counselor_data) {

            $table1 = "lead_management";
            $select1 = "count(lead_management.id) AS tot_counselor_count";
            $where1 = "lead_management.lead_owner='$counselor_data->id' and (lead_created_date>='$from_date' and lead_created_date<='$to_date')";
            $target_counselor[] = $this->kcrud->getValueOne($table1, $select1, $where1, null, null, null, null)->tot_counselor_count;
            $counselor_name[] = $counselor_data->name;
        }

        echo json_encode(array('counselor_name' => $counselor_name, 'target_counselor' => $target_counselor));
    }
}
