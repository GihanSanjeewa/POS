<?php
class Cronjobs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*ini_set('display_startup_errors',1);
        ini_set('display_errors',1);
        error_reporting(-1);*/
        $this->load->model('cronjobs_mod');
        $this->load->library('system_log');
    }

    function index()
    {
       
    }

    public function ot_notification(){

        if(!$this->input->is_cli_request())
        {
            echo "No Direct Access Allow";
            return;
        }
        print_r('No Direct Access Allow');

        $supervisor=$this->cronjobs_mod->get_supervisors();
        foreach ($supervisor as $sup){
            $sup_details = $this->cronjobs_mod->get_sup_data($sup->supervisor);
            $cr_date = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));
            $ot_days = $this->cronjobs_mod->get_ot_days($sup_details->id,$cr_date)->nw_count;

            if($ot_days){

                $data = array(
                    'sup_name'	=> $sup_details->initials.' '.$sup_details->last_name,
                );

                $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('hr_ot_letter_mail', 'ion_auth'), $data, true);
                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->to($sup_details->office_email);
                $this->email->cc($this->config->item('admin_email','ion_auth'));
                $this->email->subject("Arrow HRMS - NEW OT APPROVAL");
                $this->email->set_mailtype("html");
                $this->email->message($message);

                if ($this->email->send()) {

                    $this->system_log->create_system_log("OT Approval Management", "Success", "New OT Approval Email sent to Supervisor ".$sup_details->employee_id."");
                
                    $data_fp_temp = array(
                        'notification' => 'You have got OT approval on '.$cr_date,
                        'status' => 'Yes',
                        'notify_status' => 0,
                        'view_status' =>0,
                        'user'=>$sup->supervisor,
                        'url'=>'hr_payroll/attendance_con/get_ot_list/'.$cr_date
                        
                    );
                    $this->db->insert('hr_pay_notifications', $data_fp_temp);                     
                  
                }
                echo json_encode(array("status" => TRUE));

            }

        }

    }

    public function nopay_email_list(){

        if(!$this->input->is_cli_request())
        {
            echo "No Direct Access Allow";
            return;
        }
        print_r('No Direct Access Allow');




//        $supervisor=$this->cronjobs_mod->get_supervisors();
//        foreach ($supervisor as $sup){
//            $sup_details = $this->cronjobs_mod->get_sup_data($sup->supervisor);
//            $ot_days = $this->cronjobs_mod->get_ot_days($sup_details->id)->nw_count;
//
//            if($ot_days>0){
//
//                $data = array(
//                    'sup_name'	=> $sup_details->initials.' '.$sup_details->last_name,
//                );
//
//                $message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('hr_ot_letter_mail', 'ion_auth'), $data, true);
//                $this->email->clear();
//                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
//                $this->email->to($sup_details->office_email);
//                $this->email->cc($this->config->item('admin_email','ion_auth'));
//                $this->email->subject("Arrow HRMS - NEW OT APPROVAL");
//                $this->email->set_mailtype("html");
//                $this->email->message($message);
//
//                if ($this->email->send()) {
//
//                    $this->system_log->create_system_log("OT Approval Management", "Success", "New OT Approval Email sent to Supervisor ".$sup_details->employee_id."");
//
//                    $data_fp_temp = array(
//                        'notification' => 'You have got OT approval on'.date('Y-m-d'),
//                        'status' => 'Yes',
//                        'notify_status' => 0,
//                        'view_status' =>0,
//                        'user'=>$sup->supervisor,
//                        'url'=>'hr_payroll/attendance_con/get_ot_list'
//
//                    );
//                    $this->db->insert('hr_pay_notifications', $data_fp_temp);
//
//                }
//                echo json_encode(array("status" => TRUE));
//
//            }
//
//        }

    }

    function data_posting_cron()
    {
        /*ini_set('display_startup_errors',1);
        ini_set('display_errors',1);
        error_reporting(-1);*/
        /*if(!$this->input->is_cli_request())
        {
            echo "No Direct Access Allow";
            return;
        }*/

        //$month = "2019-11";
        $month = date('Y-m');
        $start_date = date('Y-m-01', strtotime($month));
        $end_date = date('Y-m-t', strtotime($month));
        $date_range_start = $start_date ;
        $date_range_end = date('Y-m-d',strtotime("+1 day", strtotime($end_date)));

        $temp_data = $this->cronjobs_mod->getAllAtt_work($date_range_start,$date_range_end);
        if($temp_data) {
            $aryRange = array();
            while (strtotime($start_date) <= strtotime($end_date)) {
                array_push($aryRange, $start_date);
                $start_date = date('Y-m-d', strtotime("+1 day", strtotime($start_date)));
            }
            foreach ($temp_data as $val_data) {
                $id=$val_data->id;
                $emp_id = $val_data->employee_id;
                $emp_Data = $this->cronjobs_mod->getEmployeeById($emp_id);

                $att_date = $val_data->Date;
//                $time = $val_data->time;
//
//                $day_type = date('l', strtotime($att_date));
//                $date_month = date('Y-m', strtotime($att_date));

                if($EmpCatData = $this->cronjobs_mod->getEmpCatDatabyEmp($emp_Data->emp_category)){

                    if($EmpCatData->fingerprint_status=="YES" || $EmpCatData->show_att=="YES") {
                        $att_date = $val_data->Date;
                        $time = $val_data->time;
                        //...update action in emp_att table...//
                        $late_count=0;
                        $short_leave_count=0;
                        $LA_time = 0;
                        $EL_time = 0;
                        $LA = 0;
                        $EL = 0;
                        $NL = 0;
                        $HD = 0;
                        $SLM = 0;
                        $SLE = 0;
                        $ot = 0;
                        //...............//
                        $day_type = date('l', strtotime($att_date));
                        $date_month = date('Y-m', strtotime($att_date));
                        $work_week_data = $this->cronjobs_mod->check_work_week($day_type);

                        //............
                        //$check_date = date('Y-m-d', strtotime($att_date));
                        $temp_gen_data = $this->cronjobs_mod->getAll_gen_data($emp_id,$date_month);

                        if ($temp_gen_data!=NULL) {
                            foreach ($temp_gen_data as $temp_gen) {

                                $temp_gen_emp = $temp_gen->employee_id;
                                $temp_gen_id = $temp_gen->id;
                                $temp_gen_date = $temp_gen->date;
                                $new_in_time = explode(' ', $temp_gen->in_time);

                                $temp_gen_in_time = strtotime($temp_gen->in_time);
                                $temp_data_date_time = strtotime($att_date . ' ' . $time);

                                if($shift_data = $this->cronjobs_mod->get_emp_cate_shift_schedule($emp_Data->emp_category)){

                                    $att_new_in_time = $temp_gen_in_time;  //in time

                                    foreach($shift_data as $shift_new_data) {
                                        if ($emp_Data->emp_category == 3) {

                                            if (($shift_new_data->schedule_start_time == '08:00') && (($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '08:00')) || ($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '14:30')))) {

                                                $new_in_time_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_start_time); // start time
                                                $temp_data_date_time_end = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_end_time); // end time
                                                $temp_data_date_time_late_er = strtotime($new_in_time[0] . ' ' . $shift_new_data->late_time_EL); // late time early

                                                $new_halfday_time_mo_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_mo); //halfday time morning
                                                $new_halfday_time_ev_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_ev); //halfday time evining
                                                $work_hour_head = $shift_new_data->schedule_work_hours;
                                                $halfday_work_end = $shift_new_data->halfday_time_mo_end;


                                                $new_late_time_date_time = strtotime($new_in_time[0].' '.$shift_new_data->late_time_LA);
                                            // $new_halfday_time_mo_date_time = strtotime($new_in_time[0].' '.$shift_new_data->halfday_time_mo);
                                            // $new_halfday_time_ev_date_time = strtotime($new_in_time[0].' '.$shift_new_data->halfday_time_ev);

                                            } elseif (($shift_new_data->schedule_start_time == '16:00') && ($att_new_in_time > strtotime($new_in_time[0] . ' ' . '14:30')) && (($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '16:00'))||($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '19:00')))) {

                                                $new_in_time_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_start_time); // start time
                                                $temp_data_date_time_end = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_end_time); // end time
                                                $temp_data_date_time_late_er = strtotime($new_in_time[0] . ' ' . $shift_new_data->late_time_EL); // late time early

                                                $new_halfday_time_mo_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_mo); //halfday time morning
                                                $new_halfday_time_ev_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_ev); //halfday time evining
                                                $work_hour_head = $shift_new_data->schedule_work_hours;
                                                $halfday_work_end = $shift_new_data->halfday_time_mo_end;


                                                $new_late_time_date_time = strtotime($new_in_time[0].' '.$shift_new_data->late_time_LA);
                                            // $new_halfday_time_mo_date_time = strtotime($new_in_time[0].' '.$shift_new_data->halfday_time_mo);
                                            // $new_halfday_time_ev_date_time = strtotime($new_in_time[0].' '.$shift_new_data->halfday_time_ev);



                                            }

                                        } else {

                                            $new_in_time_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_start_time); // start time
                                            $temp_data_date_time_end = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_end_time); // end time
                                            $temp_data_date_time_late_er = strtotime($new_in_time[0] . ' ' . $shift_new_data->late_time_EL); // late time early

                                            $new_halfday_time_mo_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_mo); //halfday time morning
                                            $new_halfday_time_ev_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_ev); //halfday time evining
                                            $work_hour_head = $shift_new_data->schedule_work_hours;
                                            $halfday_work_end = $shift_new_data->halfday_time_mo_end;

                                            $new_late_time_date_time = strtotime($new_in_time[0].' '.$shift_new_data->late_time_LA);
                                            // $new_halfday_time_mo_date_time = strtotime($new_in_time[0].' '.$shift_new_data->halfday_time_mo);
                                            // $new_halfday_time_ev_date_time = strtotime($new_in_time[0].' '.$shift_new_data->halfday_time_ev);
                                        }
                                    }
                                }else {

                                    $work_hour_head = WORK_HOURS;
                                    $work_hour_halfday = HALF_WORK_HOURS;
                                    $start_time_hed = START_TIME;
                                    $end_time = END_TIME;
                                    $late_time_hed = LATE_LA;
                                    $late_time_er = LATE_EL;
                                    $halfday_time_mo = HALF_D_TIME_MO;
                                    $halfday_time_ev = HALF_D_TIME_EV;
                                    $halfday_work_end = HALF_WORK_STEND;

                                    //start holiday morning end, early late and evening start,late
                                    $start_time_hed_hol = holiday_evening_start;
                                    $end_time_hol = holiday_morning_end;
                                    $late_time_hed_hol = holiday_evening_late;
                                    $late_time_er_hol = holiday_morning_er_late;
                                    //end holiday morning end, early late and evening start,late

                                    //$temp_data_date_time_start = strtotime($att_date . ' ' . $start_time_hed);
                                    $temp_data_date_time_end = strtotime($att_date . ' ' . $end_time);
                                    $temp_data_date_time_late_er = strtotime($att_date . ' ' . $late_time_er);
                                    //$temp_data_date_time_half_time = strtotime($att_date . ' ' . $halfday_time_ev);
                                    $new_in_time_date_time = strtotime($new_in_time[0].' '.$start_time_hed);
                                    //$new_out_time_date_time = strtotime($new_in_time[0].' '.$end_time);

                                    $new_late_time_date_time = strtotime($new_in_time[0].' '.$late_time_hed);
                                   
                                }

                                $att_new_settings_start_time_hol = strtotime($temp_gen_in_time); // start time holiday evening
                                $att_new_settings_end_time_hol = strtotime($new_in_time[0] . ' ' . $end_time_hol); // end time holiday morning
                                $att_new_settings_late_time_hol = strtotime($new_in_time[0] . ' ' . $late_time_hed_hol); // late time holiday
                                $att_new_settings_late_time_el_hol = strtotime($new_in_time[0] . ' ' . $late_time_er_hol); // late time early holiday
