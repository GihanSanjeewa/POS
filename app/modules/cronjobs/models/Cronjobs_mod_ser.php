<?php
class Cronjobs_mod extends CI_Model
{

    public function get_supervisors()
    {
        $sql = $this->db->query("SELECT * FROM hr_pay_employees WHERE supervisor!='' group by supervisor");
        if ($sql->num_rows() > 0) {
            return $sql->result();
        }
    }

    public function get_sup_data($id)
    {
        $sql = $this->db->query("SELECT * FROM hr_pay_employees WHERE id='$id'");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        }
    }

    public function get_ot_days($id)
    {
        $sql = $this->db->query("SELECT count(date) as nw_count FROM hr_pay_attendance_data hpad INNER JOIN hr_pay_employees hpe ON hpe.id=hpad.ref_id LEFT OUTER JOIN hr_pay_employees hped ON hpe.supervisor=hped.id WHERE hped.id='$id' AND hpad.ot_hrs>0 AND hpad.app_status='PENDING'");
        if ($sql->num_rows() > 0) {
            return $sql->row();
        }
    }

   // -------------------------------------------------

    function get_realtime_db_data($from_date,$to_date)
    {
        $fprealtimedb = $this->load->database('second', TRUE);
        $fprealtimedb->select('emp_code,punch_time');
        $fprealtimedb->where('DATE(punch_time) <',$to_date);
        $fprealtimedb->where('DATE(punch_time) >',$from_date);
        $q = $fprealtimedb->get('iclock_transaction');
        if($q->num_rows() > 0 ){
            return $q->result_array();
        }
    }


    function checkSameRecord($date,$time,$epf){
        $q = $this->db->get_where('hr_pay_attendance_raw_data', array('Date' => $date,'time' => $time,'employee_id' => $epf));
        if ($q->num_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    function saveTempAtt($data)
    {
        if ($this->db->insert('hr_pay_attendance_raw_data', $data)) {
            return true;
        } else {
            return false;
        }
    }


    ///Data Posting Cron
    function getATTSettingsData($option)
    {
        $q = $this->db->query("SELECT setting_value FROM hr_pay_admin_settings WHERE setting_key='$option'");
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    function getAllAtt_work($date_range_start,$date_range_end)
    {
        $to_date = date('Y-m-d');
        $this->db->where('action', 0);
        $this->db->where('Date >=', $date_range_start);
        $this->db->where('Date <=', $date_range_end);
        $this->db->where('Date <', $to_date);
        $this->db->order_by('Date');
        $this->db->order_by('employee_id');
        $this->db->order_by('time');
        $q = $this->db->get('hr_pay_attendance_raw_data');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }else{
            return false;
        }
    }

    function getEmployeeById($employee_id){

        $q = $this->db->get_where('hr_pay_employees', array('employee_id' => $employee_id,'status' => 'Active'));
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    public function getEmpCatDatabyEmp($emp_type)
    {
        $q = $this->db->query("SELECT * FROM hr_pay_m_employee_category WHERE id='$emp_type'");
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    function get_emp_cate_shift_schedule($cate){

        $this->db->select('hr_pay_employee_schedule_assignments.id as id,
        hr_pay_employee_schedule_assignments.s_id,
        hr_pay_employee_schedule_assignments.c_id,
        hr_pay_m_shift_schedules.code,
        hr_pay_m_shift_schedules.schedule_name,
        hr_pay_m_shift_schedules.schedule_work_hours,
        hr_pay_m_shift_schedules.schedule_start_time,
        hr_pay_m_shift_schedules.schedule_end_time,
        hr_pay_m_shift_schedules.halfday_time_mo,
        hr_pay_m_shift_schedules.halfday_time_ev,
        hr_pay_m_shift_schedules.late_time_LA,
        hr_pay_m_shift_schedules.late_time_EL');
        $this->db->from('hr_pay_employee_schedule_assignments');
        $this->db->join('hr_pay_m_shift_schedules', 'hr_pay_m_shift_schedules.id=hr_pay_employee_schedule_assignments.s_id', 'left');
        $this->db->where('hr_pay_employee_schedule_assignments.c_id',$cate);
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            return $q->row();
        }
        // $this->db->select('hr_pay_employee_schedule_assignments.id as id,
        // hr_pay_employee_schedule_assignments.s_id,
        // hr_pay_employee_schedule_assignments.c_id,
        // hr_pay_m_shift_schedules.code,
        // hr_pay_m_shift_schedules.schedule_name,
        // hr_pay_m_shift_schedules.schedule_work_hours,
        // hr_pay_m_shift_schedules.schedule_half_work_hours,
        // hr_pay_m_shift_schedules.schedule_start_time,
        // hr_pay_m_shift_schedules.schedule_end_time,
        // hr_pay_m_shift_schedules.halfday_time_mo,
        // hr_pay_m_shift_schedules.halfday_time_mo_end,
        // hr_pay_m_shift_schedules.halfday_time_ev,
        // hr_pay_m_shift_schedules.holiday_evening_start,
        // hr_pay_m_shift_schedules.holiday_morning_end,
        // hr_pay_m_shift_schedules.holiday_evening_late,
        // hr_pay_m_shift_schedules.holiday_morning_er_late,
        // hr_pay_m_shift_schedules.late_time_LA,
        // hr_pay_m_shift_schedules.late_time_EL');
        // $this->db->from('hr_pay_employee_schedule_assignments');
        // $this->db->join('hr_pay_m_shift_schedules', 'hr_pay_m_shift_schedules.id=hr_pay_employee_schedule_assignments.s_id', 'left');
        // $this->db->where('hr_pay_employee_schedule_assignments.c_id',$cate);
        // $q = $this->db->get();
        // if ($q->num_rows() > 0) {
        //     return $q->row();
        // }
    }

    function check_work_week($day_type){
        $this->db->select('status');
        $this->db->where(array('day'=> $day_type));
        $q = $this->db->get('hr_pay_m_work_week');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    function getAll_gen_data($emp_id,$date_month){
        $this->db->where('employee_id', $emp_id);
        $this->db->where('month', $date_month);
        $this->db->where('in_time !=','');
        $this->db->order_by('in_time','DESC');
        $this->db->limit('1');
        $q = $this->db->get('hr_pay_attendance_data');
        if ($q->num_rows() > 0) {
            foreach (($q->result()) as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function update_action($id,$data_action){
        $this->db->where('id',$id);
        $this->db->update('hr_pay_attendance_raw_data',$data_action);
    }

    function check_date($date){
        $this->db->select('sp_category');
        $this->db->where(array('date'=> $date));
        $q = $this->db->get('hr_pay_holidays');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    function search_holiday_1($date)
    {

        $q = $this->db->query("SELECT * FROM hr_pay_holidays where date='$date'");
        if ($q->num_rows() > 0) {
            return $q->row();
        } else {
            return $q->row();
        }
    }

    function update_temp_generate_data($temp_gen_id,$temp_gen_emp,$data_gen_up){
        $this->db->where('id', $temp_gen_id);
        $this->db->where('employee_id', $temp_gen_emp);
        $this->db->update('hr_pay_attendance_data', $data_gen_up);
    }

    function getAll_same_data($emp_id,$att_date){
        $this->db->where(array('employee_id'=>$emp_id,'date'=>$att_date,'in_time'=>'','out_time'=>''));
        $q = $this->db->get('hr_pay_attendance_data');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    function get_check_date_holiday($date){
        $this->db->select('sp_category');
        $this->db->where(array('date'=> $date));
        $q = $this->db->get('hr_pay_holidays');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }

    function save_temp_generate_data($data)
    {
        $this->db->insert('hr_pay_attendance_data', $data);
        return $this->db->insert_id();
    }

    function get_absent_employee($date){
        $sql = "SELECT * FROM hr_pay_employees WHERE hr_pay_employees.status='active' and NOT EXISTS (SELECT * FROM hr_pay_attendance_data WHERE  hr_pay_attendance_data.employee_id = hr_pay_employees.employee_id AND date='$date')";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    function check_work_week_shift($day_type,$shift){
        $this->db->select('status');
        $this->db->where(array('day'=> $day_type,'shift_id'=> $shift));
        $q = $this->db->get('hr_pay_m_work_week_shift');
        if ($q->num_rows() > 0) {
            return $q->row();
        }
    }


}