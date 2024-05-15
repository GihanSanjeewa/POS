<?php

/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 9/27/2019
 * Time: 10:10 AM
 */

class Lead_mod extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function save($table, $data)
    {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
        return true;
    }

    public function delete($table, $where)
    {
        $this->db->delete($table, $where);
        return true;
    }

    public function get_email_sending_data($id)
    {

        $this->db->select("*");
        $this->db->from("lead_management");
        $this->db->where("lead_management.lead_id_code", $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_list_by_id($table, $select, $where)
    {

        $this->db->select($select);
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_agents()
    {
        $this->db->select('*');
        $this->db->from('lead_agents_list');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_course_types()
    {
        $this->db->select('*');
        $this->db->from('asms_m_program_type');
        $query = $this->db->get();

        return $query->result();
    }


    public function get_currencies()
    {
        $this->db->select('*');
        $this->db->from('asms_currencies');
        $query = $this->db->get();

        return $query->result();
    }


    public function get_logUser($user)
    {
        $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
         FROM asms_users_info
         WHERE asms_users_info.id = '$user'");
        return $query->row();
    }
    // public function check_lead1($program,$batch,$phone){
    //     $query = $this->db->query("SELECT * FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_phone = '$phone'");
    //     return $query->num_rows();
    // }

    // public function check_lead_data1($program,$batch,$phone){
    //     $query = $this->db->query("SELECT lead_management.l_phone,lead_management.lead_id_code FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_phone = '$phone'");
    //     return $query->row();
    // }




    // public function check_lead2($program,$batch,$email){
    //     $query = $this->db->query("SELECT * FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_email = '$email'");
    //     return $query->num_rows();
    // }

    // public function check_lead_data2($program,$batch,$email){
    //     $query = $this->db->query("SELECT lead_management.l_email,lead_management.lead_id_code FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_email = '$email'");
    //     return $query->row();
    // }


    public function get_course_count($stu_course_type)
    {
        $query = $this->db->query("SELECT * FROM lead_past_stu_commission
         WHERE lead_past_stu_commission.course_type = '$stu_course_type'");
        return $query->num_rows();
    }

    public function check_lead1($program, $current_date, $phone)
    {
        $query = $this->db->query("SELECT * FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >= '$current_date' AND lead_management.l_phone = '$phone'");
        return $query->num_rows();
    }

    public function check_lead_data1($program, $current_date, $phone)
    {
        $query = $this->db->query("SELECT lead_management.l_phone,lead_management.lead_id_code FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >='$current_date' AND lead_management.l_phone = '$phone'");
        return $query->row();
    }




    public function check_lead2($program, $current_date, $email)
    {
        $query = $this->db->query("SELECT * FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >='$current_date' AND lead_management.l_email = '$email'");
        return $query->num_rows();
    }

    public function check_lead_data2($program, $current_date, $email)
    {
        $query = $this->db->query("SELECT lead_management.l_email,lead_management.lead_id_code FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >='$current_date' AND lead_management.l_email = '$email'");
        return $query->row();
    }


    // public function check_lead_edit1($program,$batch,$phone,$tb_id)
    // {
    //     $query = $this->db->query("SELECT * FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_phone = '$phone' AND lead_management.id !='$tb_id'");
    //     return $query->num_rows();

    // }
    // public function check_lead_edit_data1($program,$batch,$phone,$tb_id)
    // {
    //     $query = $this->db->query("SELECT lead_management.l_phone,lead_management.lead_id_code FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_phone = '$phone' AND lead_management.id !='$tb_id'");
    //     return $query->row();
    // }


    // public function check_lead_edit2($program,$batch,$email,$tb_id){
    //     $query = $this->db->query("SELECT * FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_email = '$email'AND lead_management.id !='$tb_id'");
    //     return $query->num_rows();
    // }

    // public function check_lead_edit_data2($program,$batch,$email,$tb_id){
    //     $query = $this->db->query("SELECT lead_management.l_email,lead_management.lead_id_code FROM lead_management
    //      WHERE lead_management.programe = '$program' AND lead_management.batch_id = '$batch' AND lead_management.l_email = '$email' AND lead_management.id !='$tb_id'");
    //     return $query->row();
    // }


    public function check_lead_edit1($program, $current_date, $phone, $tb_id)
    {
        $query = $this->db->query("SELECT * FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >= '$current_date' AND lead_management.l_phone = '$phone' AND lead_management.id !='$tb_id'");
        return $query->num_rows();
    }
    public function check_lead_edit_data1($program, $current_date, $phone, $tb_id)
    {
        $query = $this->db->query("SELECT lead_management.l_phone,lead_management.lead_id_code FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >= '$current_date' AND lead_management.l_phone = '$phone' AND lead_management.id !='$tb_id'");
        return $query->row();
    }


    public function check_lead_edit2($program, $current_date, $email, $tb_id)
    {
        $query = $this->db->query("SELECT * FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >= '$current_date' AND lead_management.l_email = '$email'AND lead_management.id !='$tb_id'");
        return $query->num_rows();
    }

    public function check_lead_edit_data2($program, $current_date, $email, $tb_id)
    {
        $query = $this->db->query("SELECT lead_management.l_email,lead_management.lead_id_code FROM lead_management
         WHERE lead_management.programe = '$program' AND lead_management.dead_line_date >= '$current_date' AND lead_management.l_email = '$email' AND lead_management.id !='$tb_id'");
        return $query->row();
    }


    public function check_sdc_number($sdc)
    {

        $this->db->select('*');
        $this->db->from('asms_pending_payments');
        $this->db->where('sdc_number', $sdc);
        $query = $this->db->get();

        if ($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    public function get_inserted_other_pro($id)
    {
        $this->db->select('*');
        $this->db->from('lead_inserted_other_inter_programs');
        $this->db->where(array('lead_management_tb_id' => $id));
        $q = $this->db->get();

        $data = array();

        foreach ($q->result() as $row) {
            $data[] = $row->other_program;
        }
        return ($data);
    }

    public function get_documents_data($id)
    {
        $this->db->select('*');
        $this->db->from('lead_management_upload_doc');
        $this->db->where(array('lead_id' => $id));
        $q = $this->db->get();
        return $q->result();
    }

    public function get_other_qulification($id)
    {
        $this->db->select('*');
        $this->db->from('lead_management_student_other_qualification');
        $this->db->where(array('lead_id' => $id));
        $q = $this->db->get();
        return $q->result();
    }

    public function get_inserted_education_details($id)
    {
        $this->db->select('*');
        $this->db->from('lead_management_student_qualification');
        $this->db->where(array('lead_id' => $id));
        $q = $this->db->get();
        return $q->result();
        // $data=array();

        // foreach($q->result() as $row){
        //     $data[] = $row->l_source;
        // }
        // return ($data);
    }

    public function get_inserted_l_source($id)
    {
        $this->db->select('*');
        $this->db->from('lead_inserted_lead_source');
        $this->db->where(array('lead_management_tb_id' => $id));
        $q = $this->db->get();

        $data = array();

        foreach ($q->result() as $row) {
            $data[] = $row->l_source;
        }
        return ($data);
    }
    public function view_class($id)
    {

        $this->db->select('asms_class_arrangement.id,asms_class_arrangement.cls_name,asms_m_batches.name AS batch_name,asms_m_halls.name AS hall_name,asms_m_class_rooms.name AS class_name,asms_class_arrangement.actual_capacity,auth_users.first_name,asms_class_arrangement.created_at,asms_class_arrangement.updated_at');
        $this->db->from('asms_class_arrangement');
        $this->db->join('asms_m_batches', 'asms_m_batches.id=asms_class_arrangement.batch', 'left');
        $this->db->join('asms_m_halls', 'asms_m_halls.id=asms_class_arrangement.hall', 'left');
        $this->db->join('asms_m_class_rooms', 'asms_m_class_rooms.id=asms_class_arrangement.class', 'left');
        $this->db->join('auth_users', 'auth_users.id=asms_class_arrangement.user', 'left');
        $this->db->where(array('asms_class_arrangement.id' => $id));
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_classes_semester($id)
    {

        $this->db->select('*');
        $this->db->from('asms_m_batch_semester');
        $this->db->where(array('batch' => $id));
        $query = $this->db->get();

        return $query->result();
    }
    public function view_data_info($id)
    {

        // $this->db->select('asms_lead_changes_histories.*,TIME_FORMAT(asms_lead_changes_histories.next_time, "%h:%i %p")AS convert_time');
        // $this->db->from('asms_lead_changes_histories');
        // $this->db->where(array('lead_id'=>$id,'user'=>$u_id));

        $query = $this->db->query("SELECT asms_lead_interest_level.name as interest_level,asms_lead_changes_histories.*,TIME_FORMAT(asms_lead_changes_histories.next_time, '%h:%i %p') AS convert_time,lead_follow_up_activities.name as follow_name,asms_users_info.name as username,lead_management.lead_id_code,lead_management.f_name,lead_management.l_name,lead_called_stutus.name as call_status_name,user.name as modified_by
FROM asms_lead_changes_histories
LEFT OUTER JOIN lead_follow_up_activities ON lead_follow_up_activities.id = asms_lead_changes_histories.follow_up

LEFT OUTER JOIN lead_management ON lead_management.id = asms_lead_changes_histories.lead_id
LEFT OUTER JOIN asms_users_info ON lead_management.lead_owner=asms_users_info.id
LEFT OUTER JOIN asms_users_info as user ON asms_lead_changes_histories.user=user.id
LEFT OUTER JOIN asms_lead_interest_level ON asms_lead_interest_level.id=asms_lead_changes_histories.inter_level
LEFT OUTER JOIN  lead_called_stutus ON  lead_called_stutus.id = asms_lead_changes_histories.call_status
WHERE asms_lead_changes_histories.lead_id='$id'");
        // $query=$this->db->get();

        return $query->result();
    }


    public function view_loan_info($id)
    {
        $query = $this->db->query("SELECT lead_management.loan_info
        FROM lead_management
        WHERE lead_management.id='$id'");
        // $query=$this->db->get();

        return $query->row();
    }
    public function view_history($id)
    {

        $this->db->select('asms_lead_changes_histories.*,TIME_FORMAT(asms_lead_changes_histories.next_time, "%h:%i %p")AS convert_time');
        $this->db->from('asms_lead_changes_histories');
        $this->db->where(array('lead_id' => $id));
        $query = $this->db->get();

        return $query->result();
    }

    public function view_history_loan($id)
    {

        // $this->db->select('asms_loan_changes_histories_data.*,TIME_FORMAT(asms_loan_changes_histories_data.next_time, "%h:%i %p")AS convert_time');
        // $this->db->from('asms_loan_changes_histories_data');
        // $this->db->where(array('lead_id'=>$id));
        // $query=$this->db->get();

        // return $query->result();


        $query = $this->db->query("SELECT asms_loan_changes_histories_data.*,TIME_FORMAT(asms_loan_changes_histories_data.next_time, '%h:%i %p')AS convert_time,lead_management.lead_id_code,lead.name as lead_owner,loan.name as assistance
FROM asms_loan_changes_histories_data


LEFT OUTER JOIN lead_management ON lead_management.id = asms_loan_changes_histories_data.lead_id
LEFT OUTER JOIN asms_users_info as lead ON lead_management.lead_owner=lead.id
LEFT OUTER JOIN asms_users_info as loan ON lead_management.loan_assistance_id=loan.id

WHERE asms_loan_changes_histories_data.lead_id='$id'");
        // $query=$this->db->get();

        return $query->result();
    }

    public function get_batch()
    {

        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_halls()
    {

        $this->db->select('*');
        $this->db->from('asms_m_halls');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_semester($id)
    {

        $this->db->select('asms_m_semesters.id,asms_m_semesters.name');
        $this->db->from('asms_m_batch_semester');
        $this->db->join('asms_m_semesters', 'asms_m_semesters.id=asms_m_batch_semester.semester', 'left');
        $this->db->where('asms_m_batch_semester.batch', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_subject($id)
    {

        $this->db->select('asms_m_course_topics.id,asms_m_course_topics.code,asms_m_course_topics.name');
        $this->db->from('asms_m_subject_allocation');
        $this->db->join('asms_m_course_topics', 'asms_m_course_topics.id=asms_m_subject_allocation.subject');
        $this->db->where('asms_m_subject_allocation.semester', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_classes($id)
    {

        $this->db->select('*');
        $this->db->from('asms_m_class_rooms');
        $this->db->where('asms_m_class_rooms.hall', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_master_batch()
    {

        $this->db->select('*');
        $this->db->from('asms_m_batches');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_students_info_by_id($where)
    {

        $this->db->select('id,student_id,nic_number');
        $this->db->from('asms_students_info');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->row();
    }

    public function check_duplicate_allocation($where)
    {

        $this->db->select('*');
        $this->db->from('asms_class_arrangement');
        $this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    public function get_all_ass_view()
    {

        $this->db->select('*');
        $this->db->from('assignmnet_view');
        $this->db->order_by('id', 'desc');

        $query = $this->db->get();

        return $query->result();
    }

    public function get_master_lead_source()
    {

        $this->db->select('*');
        $this->db->from('asms_m_lead_source');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_master_meetup()
    {

        $this->db->select('*');
        $this->db->from('asms_m_lead_meetup');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_master_transfer_res()
    {

        $this->db->select('*');
        $this->db->from('asms_m_lead_trans_reason');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_master_lead_title()
    {

        $this->db->select('*');
        $this->db->from('asms_m_lead_title');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_master_lead_meetup()
    {

        $this->db->select('*');
        $this->db->from('asms_m_lead_meetup');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_programes()
    {

        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_other_programes()
    {
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_employee()
    {

        $this->db->select('id,employee_id,initials,last_name');
        $this->db->from('employees');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_lead_persons()
    {
        $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE auth_groups.name='counsellor' AND auth_groups.name='lead_enter' AND auth_groups.name='lead_finance_assistant'
        GROUP BY asms_users_info.id");

        return $query->result();
    }
    public function get_users()
    {

        $this->db->select('id,name');
        $this->db->from('asms_users_info');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_relevant_lead($id)
    {

        $this->db->select('last_call_date,next_contact_date,lead_created_date,last_call_time,next_contact_time');
        $this->db->from('lead_management');
        $this->db->where('lead_management.id', $id);
        $query = $this->db->get();

        return $query->row();
    }


    public function get_relevant_lead_count_history($id)
    {
        $query = $this->db->query("SELECT * FROM asms_lead_changes_histories
         WHERE asms_lead_changes_histories.lead_id = '$id'");
        return $query->num_rows();
    }

    public function get_relevant_lead_count_date_log($id)
    {
        $query = $this->db->query("SELECT * FROM lead_date_log
         WHERE lead_date_log.lead_id = '$id'");
        return $query->num_rows();
    }

    public function get_relevant_loan_status($id)
    {
        $query = $this->db->query("SELECT loan_info FROM lead_management
         WHERE lead_management.id = '$id'");
        return $query->row();
    }
    public function get_lead_data_of_loan($id)
    {
        $this->db->select('loan_last_call_date,loan_next_contact_date,lead_created_date');
        $this->db->from('lead_management');
        $this->db->where('lead_management.id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    public function get_lead_details($id)
    {

        $this->db->select('lead_owner');
        $this->db->from('lead_management');
        $this->db->where('lead_management.id', $id);
        $query = $this->db->get();

        return $query->row();
    }


    public function get_lead_reasons($id)
    {

        $this->db->select('id,name');
        $this->db->from('asms_m_lead_trans_reason');
        $this->db->where('asms_m_lead_trans_reason.id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_programs($id = null)
    {
        $this->db->select('*');
        $this->db->from('lead_prefer_corse');
        $this->db->where('l_id', $id);
        $q = $this->db->get();
        $data = array();
        foreach ($q->result() as $row) {
            $data[] = $row->p_id;
        }
        return ($data);
    }

    public function get_prev_data($id)
    {

        $this->db->select('lead_management.*');
        $this->db->from('lead_management');
        $this->db->join('asms_m_lead_title', 'lead_management.salutation=asms_m_lead_title.id', 'left');
        $this->db->where('lead_management.id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    public function get_scl_by_drop_down($scl)
    {
        $this->db->select('*');
        $this->db->from('asms_lead_school_list');
        $this->db->where('asms_lead_school_list.id', $scl);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_al_stream()
    {
        $this->db->select('*');
        $this->db->from('lead_al_streams');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_discode($id)
    {

        $this->db->select('dis_code');
        $this->db->from('lead_management');
        $this->db->where('lead_management.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_Lead()
    {
        $query = $this->db->query("SELECT lead_management.lead_owner,asms_users_info.name
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        ");

        return $query->result();
    }


    public function get_Counselor()
    {


        $company = COMPANY_ID;

        $groups_1 = array('admin', 'lead_manager');
        $groups_2 = array('contact_centre_staff', 'student_counsellors', 'education_agents');
        if ($this->ion_auth->in_group($groups_1)) {
            if ($company == "1") {
                $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE auth_groups.id='12'
        GROUP BY asms_users_info.id");

                return $query->result();
            } else {

                $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE auth_groups.id='12' AND asms_users_info.company_id='$company'
        GROUP BY asms_users_info.id");

                return $query->result();
            }
        } elseif ($this->ion_auth->in_group($groups_2)) {

            $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
    FROM asms_users_info
    LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
    LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
    WHERE auth_groups.id='12' AND asms_users_info.company_id='$company'
    GROUP BY asms_users_info.id");

            return $query->result();
        }
    }

    public function get_Loan_assistance_data()
    {
        $query = $this->db->query("SELECT asms_users_info.name,asms_users_info.id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE auth_groups.id='13'
        GROUP BY asms_users_info.id");
        return $query->result();
    }

    public function get_lead_id_code1($user)
    {

        $query = $this->db->query("SELECT lead_management.lead_id_code,lead_management.id
        FROM lead_management
        WHERE lead_management.education_loan_status='processing' AND lead_management.loan_assistance_id='$user'");
        return $query->result();
    }

    public function get_lead_id_code2()
    {

        $query = $this->db->query("SELECT lead_management.lead_id_code,lead_management.id
        FROM lead_management
        WHERE lead_management.education_loan_status='processing'");
        return $query->result();
    }

    public function get_follow_up()
    {
        $this->db->select('*');
        $this->db->from('lead_follow_up_activities');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_contact_methods()
    {
        $this->db->select('*');
        $this->db->from('lead_contact_methods');
        $query = $this->db->get();
        return $query->result();
    }



    public function get_bI_by_course($program_id)
    {
        $current_date = date('Y-m-d');
        // $query=$this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date
        // FROM asms_m_batches
        // LEFT OUTER JOIN asms_m_programs
        // ON asms_m_programs.id = asms_m_batches.program_id
        // LEFT OUTER JOIN asms_m_batch_intakes
        // ON asms_m_batch_intakes.batch_id = asms_m_batches.id
        // LEFT OUTER JOIN asms_m_intakes_list
        // ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        // WHERE asms_m_programs.id='$program_id' AND asms_m_batch_intakes.close_date >= '$current_date'
        // ORDER BY asms_m_batch_intakes.id DESC "); 

        $query = $this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date
        FROM asms_m_batches
        LEFT OUTER JOIN asms_m_programs
        ON asms_m_programs.id = asms_m_batches.program_id
        LEFT OUTER JOIN asms_m_batch_intakes
        ON asms_m_batch_intakes.batch_id = asms_m_batches.id
        LEFT OUTER JOIN asms_m_intakes_list
        ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        WHERE asms_m_programs.id='$program_id' AND asms_m_batches.batch_status='OPEN'
        ORDER BY asms_m_batch_intakes.id DESC ");

        return $query->result();
    }


    public function get_lead_id_code_update($lead_id)
    {
        $query = $this->db->query("SELECT lead_management.lead_id_code,lead_management.id,lead_management.int_level
        FROM lead_management
        WHERE lead_management.id='$lead_id'");
        return $query->result();
    }



    public function get_batch_by_course_yr($program_id, $yr1_start, $yr2_end)
    {
        $current_date = date('Y-m-d');
        // $query=$this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date
        // FROM asms_m_batches
        // LEFT OUTER JOIN asms_m_programs
        // ON asms_m_programs.id = asms_m_batches.program_id
        // LEFT OUTER JOIN asms_m_batch_intakes
        // ON asms_m_batch_intakes.batch_id = asms_m_batches.id
        // LEFT OUTER JOIN asms_m_intakes_list
        // ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        // WHERE asms_m_programs.id='$program_id' AND asms_m_batch_intakes.start_date > '$current_date' AND (asms_m_batch_intakes.start_date BETWEEN '$yr1_start' AND '$yr2_end')
        // ORDER BY asms_m_batch_intakes.id DESC "); 


        //   $query=$this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date,asms_lead_target_intakes.target
        //         FROM asms_m_batches
        //         LEFT OUTER JOIN asms_m_programs
        //         ON asms_m_programs.id = asms_m_batches.program_id
        //         LEFT OUTER JOIN asms_m_batch_intakes
        //         ON asms_m_batch_intakes.batch_id = asms_m_batches.id
        //         LEFT OUTER JOIN asms_m_intakes_list
        //         ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        //         LEFT OUTER JOIN asms_lead_target_intakes ON asms_lead_target_intakes.batch_id = asms_m_batch_intakes.id
        //         WHERE asms_m_programs.id='$program_id' AND asms_m_batch_intakes.start_date > '$current_date' AND (asms_m_batch_intakes.start_date BETWEEN '$yr1_start' AND '$yr2_end')
        //         ORDER BY asms_m_batch_intakes.id DESC "); 


        $query = $this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date,asms_lead_target_intakes.target
FROM asms_m_batches
LEFT OUTER JOIN asms_m_programs
ON asms_m_programs.id = asms_m_batches.program_id
LEFT OUTER JOIN asms_m_batch_intakes
ON asms_m_batch_intakes.batch_id = asms_m_batches.id
LEFT OUTER JOIN asms_m_intakes_list
ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
LEFT OUTER JOIN asms_lead_target_intakes ON asms_lead_target_intakes.batch_id = asms_m_batch_intakes.id
WHERE asms_m_programs.id='$program_id' AND asms_m_batches.batch_status='OPEN' AND (asms_m_batch_intakes.start_date BETWEEN '$yr1_start' AND '$yr2_end')
ORDER BY asms_m_batch_intakes.id DESC ");


        return $query->result();
    }

    public function get_follow_up_activity($follow_up)
    {
        $query = $this->db->query("SELECT lead_called_stutus.name as call_st_name,lead_called_stutus.id as call_id
        FROM lead_follow_up_called_status
        LEFT OUTER JOIN lead_called_stutus ON lead_called_stutus.id = lead_follow_up_called_status.called_status
        WHERE lead_follow_up_called_status.follow_up_activity='$follow_up'");

        return $query->result();
    }

    public function get_province()
    {
        $this->db->select('*');
        $this->db->from('lead_province');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_interest_level()
    {
        $this->db->select('*');
        $this->db->from('asms_lead_interest_level');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_scl_list()
    {
        $this->db->select('*');
        $this->db->from('asms_lead_school_list');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_hos_list()
    {
        $this->db->select('*');
        $this->db->from('lead_work_experience_skls_hos');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_edu_ag_company()
    {
        $this->db->select('*');
        $this->db->from('asms_education_agent_company');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_agent()
    {
        $this->db->select('*');
        $this->db->from('lead_agents_list');
        $query = $this->db->get();
        return $query->result();
    }


    public function get_batch_by_close_date($batch_id)
    {
        $query = $this->db->query("SELECT close_date  FROM asms_m_batch_intakes WHERE id='$batch_id'");
        return $query->row();
    }


    public function get_past_stu_by_ref_nic($ref_nic)
    {
        $query = $this->db->query("SELECT asms_students_register.st_f_name,asms_students_register.st_l_name,asms_students_register.st_current_address,asms_students_register.st_phone_no  
        FROM asms_students_register 
        WHERE asms_students_register.id='$ref_nic'");
        return $query->row();
    }
    public function getCountries()
    {
        $this->db->select('*');
        $this->db->from('asms_m_countries');
        $query = $this->db->get();
        return $query->result();
    }

    public function getstudent_data($email, $mobile)
    {

        if ($email == "" && $mobile == "") {
            echo ("Invalid Input");
            die();
        }


        // if ($programe!=""){
        //     $qery_data = " AND lead_management.programe = '$programe' ";
        // }
        // if ($batch_search!=""){
        //     $qery_data = " AND lead_management.batch_id = '$batch_search' ";
        // }



        if ($email != "") {
            $qery_data .= " AND lead_management.l_email = '$email' ";
        }
        if ($mobile != "") {
            $qery_data .= " AND lead_management.l_phone = '$mobile' ";
        }



        $query = $this->db->query("SELECT asms_m_batches.batch_code,lead_management.next_call_date,lead_management.last_call_date,lead_management.feedback,lead_management.status_option,asms_m_programs.name as cname,lead_management.l_phone,lead_management.l_email,asms_users_info.name as lead_owner,lead_management.l_email,lead_management.l_phone,lead_management.lead_created_date,lead_management.lead_id_code,lead_management.f_name,lead_management.l_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,lead_management.id as ld_tb_id FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id =lead_management.lead_owner
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management.batch_id
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
        
         WHERE lead_management.status_option !='Register' AND lead_management.id IS NOT NULL" . $qery_data);
        return $query->result();
    }



    //transfer lead <codes class="


    public function get_all_lead_owners()
    {
        $query = $this->db->query("SELECT asms_users_info.name as lead_owner,asms_users_info.id
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON lead_management.lead_owner = asms_users_info.id
        GROUP BY asms_users_info.id");

        return $query->result();
    }


    public function get_TransLead_data($lead_owner, $course, $trans_l_status, $trans_in_level, $counsellor_id)
    {

        // var_dump($counsellor_id,$course);
        // die();
        if ($lead_owner == "" && $course == "" && $trans_l_status == "" && $trans_in_level == "" && $counsellor_id == "") {

            echo "<p style='color:red;'>Must Select One or More Input....</p>";
            die();
        }
        // if ($date!=""){
        //     $qery_data = " AND asms_students_register.created_at = '$date' ";
        // }
        if ($lead_owner != "") {
            $qery_data = " AND lead_management.lead_owner = '$lead_owner' ";
        }

        if ($course != "") {
            $qery_data .= " AND asms_m_programs.id = '$course' ";
        }
        if ($trans_l_status != "") {
            $qery_data .= " AND lead_management.status_option = '$trans_l_status' ";
        }
        if ($trans_in_level != "") {
            $qery_data .= " AND lead_management.int_level = '$trans_in_level' ";
        }
        if ($counsellor_id != "") {
            $qery_data .= " AND lead_management.lead_owner = '$counsellor_id' ";
        }


        $query = $this->db->query("SELECT lead_management.User_id,lead_management.id as lead_tb_id,lead_management.lead_id_code,lead_management.f_name,lead_management.l_name,lead_management.date,lead_management.l_email,lead_management.programe,lead_management.lead_owner,lead_management.status_option,lead_management.last_call_date,lead_management.feedback,asms_users_info.name,asms_m_programs.name as cname,lead_management.lead_created_date, asms_lead_interest_level.name as inter_level
        FROM lead_management
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id =lead_management.lead_owner
        LEFT OUTER JOIN  asms_lead_interest_level ON  asms_lead_interest_level.id =lead_management.int_level
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        WHERE lead_management.status_option !='Register' AND lead_management.status_option !='Loan Assistance' AND lead_management.id IS NOT NULL" . $qery_data);
        return $query->result();
    }

    public function get_TransLoan_data($loan_assistance_id, $lead_id, $assis_id, $lead_id_1)
    {


        if ($loan_assistance_id == "" && $lead_id == "" && $assis_id == "" && $lead_id_1 == "") {

            echo "<p style='color:red;'>Must Select One or More Input....</p>";
            die();
        }

        if ($loan_assistance_id != "") {
            $qery_data = " AND lead_management.loan_assistance_id = '$loan_assistance_id'";
        }

        if ($lead_id != "") {
            $qery_data .= " AND lead_management.id = '$lead_id'";
        }
        if ($assis_id != "") {
            $qery_data = " AND lead_management.loan_assistance_id = '$assis_id'";
        }
        if ($lead_id_1 != "") {
            $qery_data = " AND lead_management.id = '$lead_id_1'";
        }
        $query = $this->db->query("SELECT lead_management.User_id,lead_management.id as lead_tb_id,lead_management.lead_id_code,lead_management.f_name,lead_management.l_name,lead_management.date,lead_management.l_email,lead_management.programe,lead_management.lead_owner,lead_management.status_option,lead_management.last_call_date,lead_management.feedback,lead.name as Lead_name,loan.name as loan_name,asms_m_programs.name as cname,lead_management.lead_created_date,lead_management.education_loan_status,lead_management.loan_assistance_id
        FROM lead_management
        LEFT OUTER JOIN asms_users_info as loan ON loan.id =lead_management.loan_assistance_id
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe 
        LEFT OUTER JOIN asms_users_info as lead ON lead.id =lead_management.lead_owner 
        WHERE lead_management.education_loan_status = 'processing' AND lead_management.id IS NOT NULL" . $qery_data);
        return $query->result();
    }

    public function view_full_profile($id)
    {



        $query = $this->db->query("SELECT asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,asms_m_batches.batch_code,asms_m_programs.name as cname,lead_agents_list.name as agent,lead_contact_methods.contact_name,lead_management.parent_name,lead_management.l_phone,lead_management.l_phone_2,
            lead_management.inq_by,lead_management.f_name,lead_management.mid_name,lead_management.l_name,lead_management.nic_pass_info,lead_management.nic_div,lead_management.passport_div,asms_m_lead_title.name as title,
            lead_management.l_email,lead_management.address1,lead_management.address2,lead_management.country,lead_management.state_pro,lead_management.city,lead_management.zip_pos,lead_management.lead_owner,
            asms_users_info.name as l_owner,lead_province.name as province,lead_management.reffered,lead_management.refferal_type,lead_management.ref_nic,lead_management.ref_remarks,lead_management.dead_line_date,lead_management.study_method,lead_work_experience_skls_hos.name as ex_type,lead_management.ex_months,lead_management.ex_years,lead_management.ol_res,lead_management.ol_year,lead_management.al_school,lead_management.al_stream,lead_management.al_year,lead_management.other_edu
            ,lead_management.loan_info,asms_lead_interest_level.name as int_name,lead_management.con_box,asms_lead_school_list.name as scl,lead_al_streams.name as stream,lead_management.lead_id_code
            FROM lead_management
            LEFT OUTER JOIN asms_m_lead_title ON asms_m_lead_title.id = lead_management.salutation
            LEFT OUTER JOIN asms_users_info ON asms_users_info.id =lead_management.lead_owner
            LEFT OUTER JOIN lead_province ON lead_province.id =lead_management.state_pro
            LEFT OUTER JOIN  lead_contact_methods ON lead_contact_methods.id=lead_management.contact_method
            LEFT OUTER JOIN  lead_agents_list ON lead_agents_list.id=lead_management.agent_name
            LEFT OUTER JOIN  asms_m_programs ON asms_m_programs.id=lead_management.programe
            LEFT OUTER JOIN  asms_m_batch_intakes ON asms_m_batch_intakes.id=lead_management.batch_id
            LEFT OUTER JOIN  asms_m_intakes_list ON asms_m_intakes_list.id=asms_m_batch_intakes.intake_list_id
            LEFT OUTER JOIN  asms_m_batches ON asms_m_batches.id=asms_m_batch_intakes.batch_id
            LEFT OUTER JOIN asms_lead_school_list ON asms_lead_school_list.id = lead_management.al_school
            LEFT OUTER JOIN asms_lead_interest_level ON asms_lead_interest_level.id = lead_management.int_level
            LEFT OUTER JOIN lead_al_streams ON lead_al_streams.id = lead_management.al_stream
            LEFT OUTER JOIN lead_work_experience_skls_hos ON lead_work_experience_skls_hos.id = lead_management.ex_type
             WHERE lead_management.id='$id'");
        return $query->row();
    }
    public function view_pref_con($id)
    {
        $query = $this->db->query("SELECT  lead_contact_methods.contact_name as pref_contact
        FROM lead_management
        LEFT OUTER JOIN lead_contact_methods  ON lead_contact_methods.id =lead_management.pref_contact_method 
        WHERE lead_management.id='$id'");
        return $query->row();
    }

    public function view_lead_changes_history($id)
    {
        $query = $this->db->query("SELECT  asms_lead_changes_histories.lead_status,asms_lead_changes_histories.follow_up_remarks,asms_lead_changes_histories.last_contacted_date,
        asms_lead_changes_histories.next_contact_date,asms_lead_changes_histories.next_time,lead_management.lead_id_code,asms_users_info.name as lead_owner,
        asms_lead_interest_level.name as interest_level,lead_follow_up_activities.name as follow_up_name
        FROM asms_lead_changes_histories
        LEFT OUTER JOIN lead_management  ON asms_lead_changes_histories.lead_id =lead_management.id 
        LEFT OUTER JOIN asms_users_info ON asms_users_info.id = lead_management.lead_owner
        LEFT OUTER JOIN asms_lead_interest_level ON asms_lead_interest_level.id = asms_lead_changes_histories.inter_level
        LEFT OUTER JOIN lead_follow_up_activities ON lead_follow_up_activities.id = asms_lead_changes_histories.follow_up
        WHERE asms_lead_changes_histories.lead_id='$id'");
        return $query->result();
    }

    public function view_lead_source($id)
    {
        $query = $this->db->query("SELECT  asms_m_lead_source.source_title
        FROM lead_inserted_lead_source
        LEFT OUTER JOIN asms_m_lead_source  ON asms_m_lead_source.id =lead_inserted_lead_source.l_source 
        WHERE lead_inserted_lead_source.lead_management_tb_id='$id'");
        return $query->result();
    }

    public function view_int_other_pro($id)
    {
        $query = $this->db->query("SELECT  asms_m_programs.name as cname
        FROM lead_inserted_other_inter_programs
        LEFT OUTER JOIN asms_m_programs  ON asms_m_programs.id =lead_inserted_other_inter_programs.other_program 
        WHERE lead_inserted_other_inter_programs.lead_management_tb_id='$id'");
        return $query->result();
    }
















    //bulk lead

    //title-parent,student
    function get_title($code)
    {
        $q = $this->db->query("SELECT * FROM asms_m_lead_title where code='$code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    //country
    function get_country($code)
    {
        $q = $this->db->query("SELECT * FROM asms_m_countries where code='$code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    //province
    function get_province_pre($code)
    {
        $q = $this->db->query("SELECT * FROM lead_province where code='$code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    //lead source

    function get_l_source($code)
    {
        // var_dump($code);
        //       die();
        $q = $this->db->query("SELECT * FROM asms_m_lead_source where code='$code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    //con method

    function get_contacted_method($code)
    {
        $q = $this->db->query("SELECT * FROM lead_contact_methods where code='$code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }


    //program
    function get_program($code)
    {
        $q = $this->db->query("SELECT * FROM asms_m_programs where code='$code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    //agents
    // function get_agent($code)
    // {
    //     $q = $this->db->query("SELECT * FROM lead_agents_list where agent_code='$code'");
    //     if ($q->num_rows() > 0) {
    //         return $q->row();
    //     } else {
    //         return $q->row();
    //     }
    // }


    //batch_intake

    function get_batch_intake($batch_code, $intake_name)
    {



        $current_date = date('Y-m-d');
        $q = $this->db->query("SELECT asms_m_batch_intakes.id 
        FROM asms_m_batch_intakes 
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id =asms_m_batch_intakes.batch_id 
        where asms_m_batch_intakes.year='$intake_name' AND asms_m_batch_intakes.end_date >= '$current_date' AND asms_m_batches.batch_code='$batch_code'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    //experience Type

    // function get_ex_type($code)
    // {
    //     $q = $this->db->query("SELECT * FROM lead_work_experience_skls_hos where code='$code'");
    //     if ($q->num_rows() > 0) {
    //         return $q->row();
    //     } else {
    //         return $q->row();
    //     }
    // }


    //al_streams

    // function get_al_stream_pre($code)
    // {
    //     $q = $this->db->query("SELECT * FROM lead_al_streams where code='$code'");
    //     if ($q->num_rows() > 0) {
    //         return $q->row();
    //     } else {
    //         return $q->row();
    //     }
    // }

    // //interest Level
    // function get_interest($code)
    // {
    //     $q = $this->db->query("SELECT * FROM asms_lead_interest_level where code='$code'");
    //     if ($q->num_rows() > 0) {
    //         return $q->row();
    //     } else {
    //         return $q->row();
    //     }
    // }




    function get_phone_count_pre($stu_phone)
    {
        // var_dump($stu_phone);
        // die();
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone'");
        return $query->num_rows();
    }

    function get_phone2_count_pre($stu_phone_2)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2'");
        return $query->num_rows();
    }


    function get_nic_count_pre($stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }

    function get_pass_count_pre($stu_passport)
    {

        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }

    function get_email_count_pre($stu_email)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_email = '$stu_email'");
        return $query->num_rows();
    }

    function get_count1($stu_phone, $stu_phone_2)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_email = '$stu_email'");
        return $query->num_rows();
    }
    function get_count2($stu_phone, $stu_email)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_email = '$stu_email'");
        return $query->num_rows();
    }
    function get_count3($stu_phone, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count4($stu_phone, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }
    function get_count5($stu_phone_2, $stu_email)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email'");
        return $query->num_rows();
    }
    function get_count6($stu_phone_2, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count7($stu_phone_2, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }

    function get_count9($stu_email, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_email = '$stu_email' AND  lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count10($stu_email, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }
    function get_count11($stu_phone, $stu_phone_2, $stu_email)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email'");
        return $query->num_rows();
    }
    function get_count12($stu_phone, $stu_phone_2, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_phone_2 = '$stu_phone_2'  AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count13($stu_phone, $stu_phone_2, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_phone_2 = '$stu_phone_2'  AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }
    function get_count14($stu_phone, $stu_email, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count15($stu_phone, $stu_email, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone'  AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }
    function get_count16($stu_phone_2, $stu_email, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count17($stu_phone_2, $stu_email, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }
    function get_count18($stu_email, $stu_nic, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count19($stu_phone, $stu_phone_2, $stu_email, $stu_nic)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count20($stu_phone, $stu_phone_2, $stu_email, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport'");
        return $query->num_rows();
    }
    function get_count21($stu_phone, $stu_email, $stu_nic, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count22($stu_phone_2, $stu_email, $stu_nic, $stu_passport)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }
    function get_count23($stu_email, $stu_nic, $stu_passport, $stu_phone, $stu_phone_2)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_phone = '$stu_phone' AND lead_management_pre.l_phone_2 = '$stu_phone_2' AND lead_management_pre.l_email = '$stu_email' AND lead_management_pre.passport_div = '$stu_passport' AND lead_management_pre.nic_div = '$stu_nic'");
        return $query->num_rows();
    }

    function get_fname($stu_f_name)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.f_name = '$stu_f_name'");
        return $query->num_rows();
    }

    function get_midname($stu_mid_name)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.mid_name = '$stu_mid_name'");
        return $query->num_rows();
    }

    function get_lname($stu_l_name)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.l_name = '$stu_l_name'");
        return $query->num_rows();
    }

    function get_parent_name($stu_parent_name)
    {
        $query = $this->db->query("SELECT * FROM lead_management_pre
        WHERE lead_management_pre.parent_name = '$stu_parent_name'");
        return $query->num_rows();
    }



    function get_pre_lead_data()
    {

        $company = COMPANY_ID;
        // $user = USER_ID;
        $groups_1 = array('lead_manager', 'admin');


        if ($this->ion_auth->in_group($groups_1)) {

            if ($company == "1") {

                $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
        p_title.name as p_title,lead_management_pre.f_name,
        lead_management_pre.l_name,
        s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
        lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
        asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
        FROM lead_management_pre
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
        LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
        WHERE lead_management_pre.lead_status='Pre Lead'");
                return $query->result();
            } else {
                $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
                p_title.name as p_title,lead_management_pre.f_name,
                lead_management_pre.l_name,
                s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
                lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
                asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
                FROM lead_management_pre
                LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
                LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
                LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
                LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
                LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
                LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
                LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
                WHERE lead_management_pre.lead_status='Pre Lead' AND lead_management_pre.company_id='$company'");
                return $query->result();
            }
        }
    }

    function get_prev_data_bulk($id)
    {
        $this->db->select('lead_management_pre.*,asms_users_info.name as lead_owner_name');
        $this->db->from('lead_management_pre');
        $this->db->join('asms_users_info', 'asms_users_info.id=lead_management_pre.lead_owner', 'left');
        $this->db->where('lead_management_pre.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_inserted_l_source_pre($id)
    {
        $this->db->select('*');
        $this->db->from('lead_inserted_lead_source_pre');
        $this->db->where(array('lead_management_pre_tb_id' => $id));
        $q = $this->db->get();

        $data = array();

        foreach ($q->result() as $row) {
            $data[] = $row->l_source;
        }
        return ($data);
    }

    function check_target_lead($year1, $year2, $course)
    {
        $query = $this->db->query("SELECT * FROM asms_lead_target
        WHERE asms_lead_target.from_year = '$year1' AND asms_lead_target.to_year = '$year2' AND asms_lead_target.program = '$course'");
        return $query->num_rows();
    }

    public function check_monthly_target_lead($year1, $year2, $course_id, $batch)
    {


        $query = $this->db->query("SELECT * FROM asms_lead_target_monthly
        WHERE asms_lead_target_monthly.finance_from = '$year1' AND asms_lead_target_monthly.finance_to = '$year2' AND asms_lead_target_monthly.program = '$course_id' AND asms_lead_target_monthly.batch='$batch'");
        return $query->num_rows();
    }

    function get_course_data()
    {
        $this->db->select('*');
        $this->db->from('asms_m_programs');
        $query = $this->db->get();
        return $query->result();
    }


    function get_past_students_data()
    {
        $query = $this->db->query("SELECT * 
        FROM asms_students_register 
        WHERE asms_students_register.status='1' AND asms_students_register.stu_status='3' AND asms_students_register.st_qualified_status='YES' AND asms_students_register.qualified_date !=''");
        return $query->result();
    }



    public function get_traget_data_to_edit($id)
    {

        $this->db->select('asms_lead_target_intakes.*');
        $this->db->from('asms_lead_target_intakes');
        // $this->db->join('asms_m_lead_title','lead_management.salutation=asms_m_lead_title.id','left');
        $this->db->where('asms_lead_target_intakes.lead_target_tb_id', $id);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_target_mon_intake_data($id)
    {


        $this->db->select('asms_lead_target_monthly.finance_from,asms_lead_target_monthly.finance_to,asms_lead_target_monthly.program');
        $this->db->from('asms_lead_target_monthly');
        $this->db->where('asms_lead_target_monthly.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    // public function get_yr_program($id)
    // {
    //     $query = $this->db->query("SELECT * FROM asms_lead_target
    //     WHERE asms_lead_target.year = '$year' AND asms_lead_target.program = '$course'");
    //    return $query->result();
    // }


    public function get_all_batch_by_year_program($year, $program)
    {


        $current_date = date('Y-m-d');
        $query = $this->db->query("SELECT asms_m_batch_intakes.id,asms_m_programs.code as c_code,asms_m_batches.name as bt_name,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_batch_intakes.id as bi_id,asms_m_batch_intakes.close_date
        FROM asms_m_batches
        LEFT OUTER JOIN asms_m_programs
        ON asms_m_programs.id = asms_m_batches.program_id
        LEFT OUTER JOIN asms_m_batch_intakes
        ON asms_m_batch_intakes.batch_id = asms_m_batches.id
        LEFT OUTER JOIN asms_m_intakes_list
        ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        WHERE asms_m_programs.id='$program' AND asms_m_batch_intakes.end_date >= '$current_date' AND asms_m_batch_intakes.year='$year'
        ORDER BY asms_m_batch_intakes.id DESC ");
        return $query->result();
    }


    public function get_batches($year1, $year2, $course)
    {
        $query = $this->db->query("SELECT asms_lead_target_intakes.batch_id,asms_lead_target_intakes.target,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,asms_m_programs.code
         FROM asms_lead_target
        LEFT OUTER JOIN asms_lead_target_intakes
        ON asms_lead_target_intakes.lead_target_tb_id = asms_lead_target.id
        LEFT OUTER JOIN asms_m_batch_intakes
        ON asms_m_batch_intakes.id =asms_lead_target_intakes.batch_id
        LEFT OUTER JOIN asms_m_batches
        ON asms_m_batches.id =asms_m_batch_intakes.batch_id
        LEFT OUTER JOIN asms_m_programs
        ON asms_m_programs.id = asms_m_batches.program_id
        LEFT OUTER JOIN asms_m_intakes_list
        ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        WHERE asms_lead_target.program='$course' AND asms_lead_target.from_year='$year1' AND asms_lead_target.to_year='$year2' AND  asms_lead_target_intakes.target != 0 AND target_status = 'no'");
        return $query->result();
    }


    public function get_targets($batch_id)
    {


        $query = $this->db->query("SELECT asms_lead_target_intakes.target,asms_m_batch_intakes.close_date  
            FROM asms_lead_target_intakes
            LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = asms_lead_target_intakes.batch_id WHERE asms_lead_target_intakes.batch_id='$batch_id'");
        return $query->row();

        // $query=$this->db->query("SELECT asms_lead_target_intakes.target
        // FROM asms_lead_target_intakes
        // WHERE asms_lead_target_intakes.batch_id = '$batch'");
        // return $query->row();
    }

    // public function get_application_close_date($batch_id)
    // {
    //     $query = $this->db->query("SELECT asms_lead_target_intakes.target,asms_m_batch_intakes.close_date  
    //     FROM asms_lead_target_intakes
    //     LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = asms_lead_target_intakes.batch_id

    //     WHERE asms_m_batch_intakes.id='$batch_id'");
    //         return $query->row();
    // }




    public function get_traget_tb_id($program_id, $yr1, $yr2)
    {



        $query = $this->db->query("SELECT asms_lead_target_intakes.target
        FROM asms_lead_target_intakes
        LEFT OUTER JOIN asms_lead_target ON asms_lead_target_intakes.lead_target_tb_id = asms_lead_target.id
        WHERE asms_lead_target.from_year = '$yr1' AND asms_lead_target.to_year = '$yr2' AND asms_lead_target.program = '$program_id'");

        return $query->result();
    }

    public function get_duplicate_bulk()
    {
        $query = $this->db->query("SELECT lead_management_pre_duplicate.id,lead_management_pre_duplicate.inq_by,p_title.name as p_title,lead_management_pre_duplicate.parent_name,s_title.name as s_title,lead_management_pre_duplicate.f_name,lead_management_pre_duplicate.mid_name,lead_management_pre_duplicate.l_name,lead_management_pre_duplicate.l_phone,lead_management_pre_duplicate.l_phone_2
        ,lead_management_pre_duplicate.nic_div,lead_management_pre_duplicate.passport_div,lead_management_pre_duplicate.l_email,lead_management_pre_duplicate.address1,lead_management_pre_duplicate.address2,asms_m_countries.name as country,lead_province.name as pro,lead_management_pre_duplicate.city,lead_management_pre_duplicate.zip_pos,contact.contact_name,asms_m_programs.name as cname,asms_m_batch_intakes.year,asms_m_intakes_list.intake_name,batch_pro.code as ccode,pref.contact_name as pref_con,lead_management_pre_duplicate.con_box
        FROM lead_management_pre_duplicate
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre_duplicate.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre_duplicate.salutation
        LEFT OUTER JOIN asms_m_countries ON asms_m_countries.id = lead_management_pre_duplicate.country
        LEFT OUTER JOIN lead_province ON lead_province.id = lead_management_pre_duplicate.state_pro
        LEFT OUTER JOIN lead_contact_methods as contact ON contact.id  = lead_management_pre_duplicate.contact_method
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre_duplicate.programe
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre_duplicate.batch
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_batch_intakes.intake_list_id = asms_m_intakes_list.id
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
        LEFT OUTER JOIN asms_m_programs as batch_pro ON batch_pro.id = asms_m_batches.program_id
        LEFT OUTER JOIN lead_contact_methods as pref ON pref.id = lead_management_pre_duplicate.pref_contact_method
        ");

        return $query->result();
    }

    public function get_target_data_mon($id)
    {
        $query = $this->db->query("SELECT asms_lead_target_intakes_monthly.sub_target
        FROM asms_lead_target_intakes_monthly
        WHERE asms_lead_target_intakes_monthly.lead_target_monthly_tb_id = '$id'");

        return $query->result();
    }

    /////////////////////////////////////////
    ///////////////////////////////////////////

    public function get_end_date()
    {
        $query = $this->db->query("SELECT finance_inq_num_code_tb.to_date,finance_inq_num_code_tb.id as finance_tb_id
        FROM finance_inq_num_code_tb
        ORDER BY finance_inq_num_code_tb.id DESC limit 1");

        return $query->row();
    }

    public function get_end_date_pre()
    {
        $query = $this->db->query("SELECT finance_inq_num_code_tb_pre.to_date,finance_inq_num_code_tb_pre.id as finance_tb_id_pre
        FROM finance_inq_num_code_tb_pre
        ORDER BY finance_inq_num_code_tb_pre.id DESC limit 1");

        return $query->row();
    }


    public function get_transfer_details($program_id, $batch_id)
    {
        $company = COMPANY_ID;
        // $user = USER_ID;
        $groups_1 = array('lead_manager', 'admin');


        if ($this->ion_auth->in_group($groups_1)) {

            if ($company == "1") {

                if ($program_id == "" && $batch_id == "") {
                    $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
        p_title.name as p_title,lead_management_pre.f_name,
        lead_management_pre.l_name,
        s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
        lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
        asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
        FROM lead_management_pre
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
        LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
        WHERE lead_management_pre.lead_status='Pre Lead' ");
                    return $query->result();
                } else if ($program_id != "" &&  $batch_id == "") {

                    $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
        p_title.name as p_title,lead_management_pre.f_name,
        lead_management_pre.l_name,
        s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
        lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
        asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
        FROM lead_management_pre
        LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
        LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
        LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
        LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
        LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
        WHERE lead_management_pre.lead_status='Pre Lead' AND asms_m_programs.id='$program_id' ");
                    return $query->result();
                } else if ($program_id != "" &&  $batch_id != "") {



                    $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
                    p_title.name as p_title,lead_management_pre.f_name,
                    lead_management_pre.l_name,
                    s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
                    lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
                    asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
                    FROM lead_management_pre
                    LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
                    LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
                    LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
                    LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
                    LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
                    LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
                    LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
                    WHERE lead_management_pre.lead_status='Pre Lead' AND asms_m_programs.id='$program_id' AND  lead_management_pre.batch='$batch_id'");
                    return $query->result();
                }
            } else {

                if ($program_id == "" && $batch_id == "") {

                    $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
                p_title.name as p_title,lead_management_pre.f_name,
                lead_management_pre.l_name,
                s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
                lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
                asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
                FROM lead_management_pre
                LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
                LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
                LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
                LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
                LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
                LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
                LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
                WHERE lead_management_pre.lead_status='Pre Lead' AND lead_management_pre.company_id='$company'  ");
                    return $query->result();
                } else if ($program_id != "" && $batch_id == "") {
                    $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
                p_title.name as p_title,lead_management_pre.f_name,
                lead_management_pre.l_name,
                s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
                lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
                asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
                FROM lead_management_pre
                LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
                LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
                LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
                LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
                LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
                LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
                LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
                WHERE lead_management_pre.lead_status='Pre Lead' AND lead_management_pre.company_id='$company' AND asms_m_programs.id='$program_id' ");
                    return $query->result();
                } else if ($program_id != "" && $batch_id != "") {


                    $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
            p_title.name as p_title,lead_management_pre.f_name,
            lead_management_pre.l_name,
            s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
            lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
            asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
            FROM lead_management_pre
            LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
            LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
            LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
            LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
            LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
            LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
            LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
            WHERE lead_management_pre.lead_status='Pre Lead' AND lead_management_pre.company_id='$company' AND asms_m_programs.id='$program_id' AND  lead_management_pre.batch='$batch_id' ");
                    return $query->result();
                }
            }
        }
    }

    public function get_transfer_details_by_bt($program_id, $batch_id)
    {
        $company = COMPANY_ID;
        // $user = USER_ID;
        $groups_1 = array('lead_manager', 'admin');


        if ($this->ion_auth->in_group($groups_1)) {

            if ($company == "1") {



                $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
    p_title.name as p_title,lead_management_pre.f_name,
    lead_management_pre.l_name,
    s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
    lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
    asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
    FROM lead_management_pre
    LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
    LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
    LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
    LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
    LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
    LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
    LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
    WHERE lead_management_pre.lead_status='Pre Lead' AND asms_m_programs.id='$program_id' AND lead_management_pre.batch='$batch_id' ");
                return $query->result();
            } else {


                $query = $this->db->query("SELECT lead_management_pre.lead_temp_id,lead_management_pre.id as lead_pre_tb_id,lead_management_pre.inq_by,lead_management_pre.parent_name,
            p_title.name as p_title,lead_management_pre.f_name,
            lead_management_pre.l_name,
            s_title.name as s_title,lead_management_pre.l_phone,lead_management_pre.l_phone_2,lead_management_pre.nic_div,
            lead_management_pre.passport_div,lead_management_pre.l_email,asms_m_programs.name as cname,bt_pro.code as ccode,
            asms_m_intakes_list.intake_name,asms_m_batch_intakes.year,lead_management_pre.lead_status,lead_management_pre.created_date,lead_management_pre.batch
            FROM lead_management_pre
            LEFT OUTER JOIN asms_m_lead_title as p_title ON p_title.id = lead_management_pre.parent_salutation
            LEFT OUTER JOIN asms_m_lead_title as s_title ON s_title.id = lead_management_pre.salutation
            LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management_pre.programe
            LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management_pre.batch
            LEFT OUTER JOIN asms_m_intakes_list ON asms_m_intakes_list.id = asms_m_batch_intakes.intake_list_id
            LEFT OUTER JOIN asms_m_batches ON asms_m_batches.id = asms_m_batch_intakes.batch_id
            LEFT OUTER JOIN asms_m_programs as bt_pro ON bt_pro.id = asms_m_batches.program_id
            WHERE lead_management_pre.lead_status='Pre Lead' AND lead_management_pre.company_id='$company' AND asms_m_programs.id='$program_id'  AND lead_management_pre.batch='$batch_id'");
                return $query->result();
            }
        }
    }
    public function get_lead_data($get_lead_tb_id)
    {

        $query = $this->db->query("SELECT lead_management.*,asms_m_countries.name as country_name,lead_province.name as province_name,asms_lead_school_list.name as al_scl,asms_m_batch_intakes.batch_id as bt_id,lead_management.batch_id as in_id
        FROM lead_management
        LEFT OUTER JOIN asms_m_countries ON asms_m_countries.id = lead_management.country
        LEFT OUTER JOIN lead_province ON lead_province.id = lead_management.state_pro
        LEFT OUTER JOIN asms_lead_school_list ON asms_lead_school_list.id = lead_management.al_school
        LEFT OUTER JOIN asms_m_batch_intakes ON asms_m_batch_intakes.id = lead_management.batch_id
        where lead_management.id='$get_lead_tb_id'");

        return $query->row();
    }

    public function get_stu_comission_data($id)
    {
        $query = $this->db->query("SELECT  lead_past_stu_commission.*,asms_m_program_type.name as course_type_name
        FROM lead_past_stu_commission
        LEFT OUTER JOIN asms_m_program_type ON asms_m_program_type.id=lead_past_stu_commission.course_type
        where  lead_past_stu_commission.id='$id'");

        return $query->row();
    }


    public function get_count_agent2($edu_agent_com_email)
    {
        $query = $this->db->query("SELECT * FROM asms_education_agent_company
        WHERE asms_education_agent_company.company_email_id = '$edu_agent_com_email'");
        return $query->num_rows();
    }

    public function get_count_agent3($edu_agent_com_phone)
    {
        $query = $this->db->query("SELECT * FROM asms_education_agent_company
        WHERE asms_education_agent_company.company_contact_number = '$edu_agent_com_phone'");
        return $query->num_rows();
    }


    public function get_edu_agent_company_data($id)
    {
        $query = $this->db->query("SELECT * FROM asms_education_agent_company
        WHERE asms_education_agent_company.id = '$id'");
        return $query->row();
    }


    public function get_edu_agent_company_data_com($id)
    {
        $query = $this->db->query("SELECT *,asms_m_program_type.name as course_type FROM asms_education_agent_company_commission
         LEFT OUTER JOIN asms_m_program_type ON asms_m_program_type.id=asms_education_agent_company_commission.company_course_type
        WHERE asms_education_agent_company_commission.asms_education_agent_company_id = '$id'");
        return $query->result();
    }

    public function get_edu_agent_com($id)
    {
        $query = $this->db->query("SELECT *,asms_m_program_type.name as course_type FROM agent_commission
         LEFT OUTER JOIN asms_m_program_type ON asms_m_program_type.id=agent_commission.course_type
        WHERE agent_commission.agent_id = '$id'");
        return $query->result();
    }

    public function get_additional_course_type($id)
    {


        $query = $this->db->query("SELECT asms_m_program_type.id,asms_m_program_type.name
      FROM asms_m_program_type
      WHERE asms_m_program_type.id
      NOT IN(SELECT asms_education_agent_company_commission.company_course_type
            FROM asms_education_agent_company_commission WHERE asms_education_agent_company_commission.asms_education_agent_company_id='$id')");
        return $query->result();
    }

    public function get_additional_course_type_agent($id)
    {
        $query = $this->db->query("SELECT asms_m_program_type.id,asms_m_program_type.name
        FROM asms_m_program_type
        WHERE asms_m_program_type.id
        NOT IN(SELECT agent_commission.course_type
              FROM agent_commission WHERE agent_commission.agent_id='$id')");
        return $query->result();
    }

    public function get_count_agent4($id, $edu_agent_com_email)
    {
        $query = $this->db->query("SELECT * FROM asms_education_agent_company
        WHERE asms_education_agent_company.id !='$id' AND asms_education_agent_company.company_email_id = '$edu_agent_com_email'");
        return $query->num_rows();
    }

    public function get_count_agent5($id, $edu_agent_com_phone)
    {
        $query = $this->db->query("SELECT * FROM asms_education_agent_company
        WHERE asms_education_agent_company.id !='$id' AND asms_education_agent_company.company_contact_number = '$edu_agent_com_phone'");
        return $query->num_rows();
    }


    public function get_count_agent_nic($nic)
    {
        $query = $this->db->query("SELECT * FROM lead_agents_list
        WHERE lead_agents_list.nic ='$nic'");
        return $query->num_rows();
    }

    public function get_count_agent_pass($pass)
    {
        $query = $this->db->query("SELECT * FROM lead_agents_list
        WHERE lead_agents_list.pass ='$pass'");
        return $query->num_rows();
    }

    public function get_count_agent_nic4($id, $nic)
    {
        $query = $this->db->query("SELECT * FROM lead_agents_list
        WHERE lead_agents_list.nic ='$nic' AND lead_agents_list.id !='$id'");
        return $query->num_rows();
    }

    public function get_count_agent_pass5($id, $pass)
    {
        $query = $this->db->query("SELECT * FROM lead_agents_list
        WHERE lead_agents_list.pass ='$pass' AND lead_agents_list.id !='$id'");
        return $query->num_rows();
    }

    public function get_agent_data($id)
    {
        $query = $this->db->query("SELECT * FROM lead_agents_list
        WHERE lead_agents_list.id = '$id'");
        return $query->row();
    }


    public function get_view_company_data($id)
    {

        $query = $this->db->query("SELECT *,asms_m_countries.name as country,lead_province.name as pro
         FROM asms_education_agent_company
         LEFT OUTER JOIN asms_m_countries ON asms_m_countries.id=asms_education_agent_company.company_country
         LEFT OUTER JOIN lead_province ON lead_province.id=asms_education_agent_company.company_pro
        WHERE asms_education_agent_company.id = '$id'");
        return $query->row();
    }


    public function get_view_commission_data($id)
    {
        $query = $this->db->query("SELECT *,asms_m_program_type.name as course_type,asms_education_agent_company_commission.company_commission FROM asms_education_agent_company_commission
        LEFT OUTER JOIN asms_m_program_type ON asms_m_program_type.id=asms_education_agent_company_commission.company_course_type
       WHERE asms_education_agent_company_commission.asms_education_agent_company_id = '$id'");
        return $query->result();
    }




    // public function get_commission_data($from_yr,$to_yr,$agent_company)
    // {

    // }


    //counsellor

    public function get_company_data($from_date, $to_date, $agent_company)
    {
        //   var_dump($from_yr,$to_yr);
        //   die();
        if ($from_date == "" && $to_date == "" && $agent_company == "") {
            echo ("Invalid Input");
            die();
        } else if ($from_date != "" && $to_date != "" && $agent_company == "") {
            $query = $this->db->query("SELECT asms_education_agent_company.company_name,asms_education_agent_company.agent_com_code,asms_education_agent_company.id
        FROM asms_education_agent_company 
        LEFT OUTER JOIN asms_users_info ON asms_users_info.company_id = asms_education_agent_company.id
        LEFT OUTER JOIN lead_management ON lead_management.lead_owner = asms_users_info.id
         LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        WHERE lead_management.status_option='Enrolled' AND  lead_management.lead_owner_commission_payment_status='Unpaid' AND auth_groups.id='12' AND lead_management.enrolled_date BETWEEN '$from_date' AND '$to_date'
        GROUP BY asms_education_agent_company.id ");
            return $query->result();
        } else if ($from_date != "" && $to_date != "" && $agent_company != "") {
            $query = $this->db->query("SELECT asms_education_agent_company.company_name,asms_education_agent_company.agent_com_code,asms_education_agent_company.id
            FROM asms_education_agent_company 
            LEFT OUTER JOIN asms_users_info ON asms_users_info.company_id = asms_education_agent_company.id
            LEFT OUTER JOIN lead_management ON lead_management.lead_owner = asms_users_info.id
             LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
            LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
            WHERE lead_management.status_option='Enrolled' AND  lead_management.lead_owner_commission_payment_status='Unpaid' AND auth_groups.id='12' AND lead_management.enrolled_date BETWEEN '$from_date' AND '$to_date' AND asms_education_agent_company.id='$agent_company'
            GROUP BY asms_education_agent_company.id ");
            return $query->result();
        }
    }

    //counsellor
    public function get_counsellor_data($company_id)
    {
        $query = $this->db->query("SELECT asms_users_info.name as counsellor,asms_users_info.id as counsellor_id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        LEFT OUTER JOIN lead_management ON lead_management.lead_owner = asms_users_info.id
        WHERE auth_groups.id='12' AND asms_users_info.company_id='$company_id' AND lead_management.status_option='Enrolled' AND  lead_management.lead_owner_commission_payment_status='Unpaid'
        GROUP BY asms_users_info.id ");
        return $query->result();
    }
    //counsellor
    public function get_total_lead_count_for_company($company_id)
    {
        $query = $this->db->query("SELECT asms_users_info.name as counsellor,asms_users_info.id as counsellor_id
        FROM asms_users_info
        LEFT OUTER JOIN auth_users_groups ON auth_users_groups.user_id = asms_users_info.id
        LEFT OUTER JOIN auth_groups ON auth_groups.id = auth_users_groups.group_id
        LEFT OUTER JOIN lead_management ON lead_management.lead_owner = asms_users_info.id
        WHERE auth_groups.id='12' AND asms_users_info.company_id='$company_id' AND lead_management.status_option='Enrolled' AND  lead_management.lead_owner_commission_payment_status='Unpaid'
        GROUP BY lead_management.id ");
        return $query->result();
    }


    //counsellor
    public function get_counsellor_lead_count($counsellor_id)
    {
        $query = $this->db->query("SELECT lead_management.*
        FROM lead_management
        WHERE lead_management.lead_owner='$counsellor_id' AND lead_management.status_option='Enrolled' AND  lead_management.lead_owner_commission_payment_status='Unpaid'");

        return $query->result();
    }
    //counsellor
    public function get_all_lead_data($counsellor_id)
    {
        $query = $this->db->query("SELECT lead_management.*,asms_m_programs.code as ccode
        FROM lead_management
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        WHERE lead_management.lead_owner='$counsellor_id' AND lead_management.status_option='Enrolled' AND  lead_management.lead_owner_commission_payment_status='Unpaid'");

        return $query->result();
    }
    //counsellor
    public function get_commission_data($company_id, $programe)
    {
        $query = $this->db->query("SELECT asms_m_programs.code,asms_education_agent_company_commission.company_commission,asms_education_agent_company.company_curren
        FROM asms_education_agent_company_commission
        LEFT OUTER JOIN asms_education_agent_company ON asms_education_agent_company_commission.asms_education_agent_company_id = asms_education_agent_company.id
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.program_type_id=asms_education_agent_company_commission.company_course_type
        WHERE asms_education_agent_company.id='$company_id' AND asms_m_programs.id='$programe'");

        return $query->row();
    }

    //counsellor
    public function get_total_commission($counsellor_id, $company_id)
    {
        $query = $this->db->query("SELECT lead_management.lead_id_code,asms_m_programs.code,asms_education_agent_company_commission.company_course_type,asms_education_agent_company_commission.company_commission,asms_m_programs.program_type_id as course_type_id,asms_education_agent_company_commission.asms_education_agent_company_id
        FROM lead_management 
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        LEFT OUTER JOIN asms_education_agent_company_commission On  asms_education_agent_company_commission.company_course_type = asms_m_programs.program_type_id
        WHERE lead_management.lead_owner='$counsellor_id' AND asms_education_agent_company_commission.asms_education_agent_company_id='$company_id'");

        return $query->result();
    }







    //agent

    public function get_agent_details($from_ag_date, $to_ag_date, $agent)
    {
        if ($from_ag_date == "" && $to_ag_date == "" && $agent == "") {
            echo ("Invalid Input");
            die();
        } else if ($from_ag_date != "" && $to_ag_date != "" && $agent == "") {
            $query = $this->db->query("SELECT lead_agents_list.name as ag_name,lead_agents_list.agent_code,lead_agents_list.id
    FROM lead_agents_list 
    LEFT OUTER JOIN lead_management ON lead_management.agent_name = lead_agents_list.id
    WHERE lead_management.status_option='Enrolled' AND  lead_management.agent_commission_payment_status='Unpaid'  AND lead_management.enrolled_date BETWEEN '$from_ag_date' AND '$to_ag_date'
    GROUP BY lead_agents_list.id ");
            return $query->result();
        } else if ($from_ag_date != "" && $to_ag_date != "" && $agent != "") {
            $query = $this->db->query("SELECT lead_agents_list.name as ag_name,lead_agents_list.agent_code,lead_agents_list.id
        FROM lead_agents_list 
        LEFT OUTER JOIN lead_management ON lead_management.agent_name = lead_agents_list.id
        WHERE lead_management.status_option='Enrolled'  AND  lead_management.agent_commission_payment_status='Unpaid' AND lead_management.enrolled_date BETWEEN '$from_ag_date' AND '$to_ag_date' AND lead_agents_list.id='$agent'
        GROUP BY lead_agents_list.id ");
            return $query->result();
        }
    }


    //agent

    public function get_total_leads_per_agent($agent_id)
    {
        $query = $this->db->query("SELECT lead_management.id as lead_id,lead_agents_list.name as ag_name,lead_agents_list.agent_code,lead_agents_list.id,lead_management.lead_id_code,lead_management.enrolled_date,asms_m_programs.code as ccode,lead_management.programe
        FROM lead_agents_list 
        LEFT OUTER JOIN lead_management ON lead_management.agent_name = lead_agents_list.id
        LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
        WHERE lead_management.status_option='Enrolled'  AND  lead_management.agent_commission_payment_status='Unpaid' AND lead_agents_list.id='$agent_id'");
        return $query->result();
    }


    //agent

    public function get_commission_agent_data($agent_id, $programe)
    {
        $query = $this->db->query("SELECT asms_m_programs.code,agent_commission.commission,lead_agents_list.curren
    FROM agent_commission
    LEFT OUTER JOIN lead_agents_list ON agent_commission.agent_id = lead_agents_list.id
    LEFT OUTER JOIN asms_m_programs ON asms_m_programs.program_type_id=agent_commission.course_type
    WHERE lead_agents_list.id='$agent_id' AND asms_m_programs.id='$programe'");

        return $query->row();
    }


    /////past student


    public function get_past_stu_details($from_st_date, $to_st_date, $p_stu)
    {
        if ($from_st_date == "" && $to_st_date == "" && $p_stu == "") {
            echo ("Invalid Input");
            die();
        } else if ($from_st_date != "" && $to_st_date != "" && $p_stu == "") {
            $query = $this->db->query("SELECT asms_students_register.student_id,asms_students_register.st_f_name,asms_students_register.st_l_name,asms_students_register.id,asms_students_register.st_nic_num
    FROM asms_students_register 
    LEFT OUTER JOIN lead_management ON lead_management.ref_nic = asms_students_register.id
    WHERE lead_management.status_option='Enrolled' AND  lead_management.past_stu_commission_payment_status='Unpaid'  AND lead_management.enrolled_date BETWEEN '$from_st_date' AND '$to_st_date'
    GROUP BY asms_students_register.id ");
            return $query->result();
        } else if ($from_st_date != "" && $to_st_date != "" && $p_stu != "") {
            $query = $this->db->query("SELECT asms_students_register.student_id,asms_students_register.st_f_name,asms_students_register.st_l_name,asms_students_register.id,asms_students_register.st_nic_num
    FROM asms_students_register 
    LEFT OUTER JOIN lead_management ON lead_management.ref_nic = asms_students_register.id
    WHERE lead_management.status_option='Enrolled' AND  lead_management.past_stu_commission_payment_status='Unpaid'  AND asms_students_register.id='$p_stu' AND lead_management.enrolled_date BETWEEN '$from_st_date' AND '$to_st_date'
    GROUP BY asms_students_register.id ");
            return $query->result();
        }
    }


    //past student

    public function get_total_leads_per_student($past_id)

    {
        $query = $this->db->query("SELECT lead_management.id as lead_id,asms_students_register.st_f_name,asms_students_register.st_l_name,asms_students_register.student_id,asms_students_register.id,lead_management.lead_id_code,lead_management.enrolled_date,asms_m_programs.code as ccode,lead_management.programe
    FROM asms_students_register 
    LEFT OUTER JOIN lead_management ON lead_management.ref_nic = asms_students_register.id
    LEFT OUTER JOIN asms_m_programs ON asms_m_programs.id = lead_management.programe
    WHERE lead_management.status_option='Enrolled'  AND  lead_management.past_stu_commission_payment_status='Unpaid' AND asms_students_register.id='$past_id'");
        return $query->result();
    }


    //past student


    public function get_commission_stu_data($programe)
    {
        $query = $this->db->query("SELECT asms_m_programs.code,lead_past_stu_commission.commission,lead_past_stu_commission.currency
    FROM lead_past_stu_commission
    LEFT OUTER JOIN asms_m_programs ON asms_m_programs.program_type_id=lead_past_stu_commission.course_type
    WHERE asms_m_programs.id='$programe'");

        return $query->row();
    }
}
