<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dash_mod extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_emp_bday($day){

        $sql = "SELECT id,name,full_name,DATE_FORMAT(asms_users_info.birthday,'%m-%d') as bday,user_id FROM asms_users_info WHERE DATE_FORMAT(asms_users_info.birthday,'%m-%d') = '$day' AND status = 1 order by bday ASC";


        $result = $this->db->query($sql);

        if($result->num_rows() > 0){
            return $result->result();
        }
    }

    public function get_employee_photo_details_by_id($id)
    {
        $this->db->where('user_id',$id);
        $q = $this->db->get('asms_users_photos');
        if($q->num_rows() > 0){
            return $q->row();
        }
        return FALSE;
    }

      public function getCountries()
    {
        $this->db->select('*');
        $this->db->from('asms_m_countries');
        $query=$this->db->get();
        return $query->result();
    }


     public function get_approved_agent_details_view($id)
    {
        $this->db->select('*');
        $this->db->from('lead_agent_detail_list');
        $this->db->join('asms_m_countries','asms_m_countries.id=lead_agent_detail_list.country','left');
        $this->db->where("lead_agent_detail_list.system_id",$id);
        $query=$this->db->get();
        return $query->result();
    }


    public function get_agent_commision_details($id){
        $query = $this->db->query("SELECT agent_lead_commission.commission,agent_lead_commission.course_type,asms_m_program_type.name as pt_name FROM agent_lead_commission left outer join asms_m_program_type on agent_lead_commission.course_type=asms_m_program_type.id where agent_lead_commission.agent_id='$id'");
        return $query->result();
    }


      public function get_course_details($id){
        $query = $this->db->query("SELECT * FROM asms_m_programs where program_type_id='$id'");
        return $query->result();
    }

     public function get_lead_manager_count($id,$group_id){
        $query = $this->db->query("SELECT COUNT(*) AS ac_count FROM asms_users_info LEFT OUTER JOIN auth_users_groups ON asms_users_info.id=auth_users_groups.user_id  WHERE asms_users_info.agent_id='$id' AND auth_users_groups.group_id='$group_id'");
         if($query->num_rows() > 0){
            return $query->row();
        }else{

            return FALSE;

        }
    }



     public function get_lead_course_details($from_date,$to_date){        

        $query = $this->db->query("SELECT * FROM asms_lead_target where from_date>='$from_date' and to_date<='$to_date'  group by program");
         if($query->num_rows() > 0){
            return $query->result();
        }
    }



       public function get_counselor_details(){        

        $query = $this->db->query("SELECT asms_users_info.id,asms_users_info.name FROM asms_users_info left outer join auth_users_groups on asms_users_info.id=auth_users_groups.user_id where auth_users_groups.group_id='12'");
         if($query->num_rows() > 0){
            return $query->result();
        }
    }


       public function get_counselor_details_lead( $from_date,$to_date){        

        $query = $this->db->query("SELECT asms_users_info.id,asms_users_info.name FROM asms_users_info left outer join auth_users_groups on asms_users_info.id=auth_users_groups.user_id left outer join lead_management on asms_users_info.id=lead_management.lead_owner where auth_users_groups.group_id='12' and  lead_management.lead_created_date>='$from_date' and lead_management.lead_created_date<='$to_date' group by asms_users_info.id");
         if($query->num_rows() > 0){
            return $query->result();
        }
    }




}