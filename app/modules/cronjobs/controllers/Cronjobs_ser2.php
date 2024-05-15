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
                $time = $val_data->time;

                $day_type = date('l', strtotime($att_date));
                $date_month = date('Y-m', strtotime($att_date));

                if($EmpCatData = $this->cronjobs_mod->getEmpCatDatabyEmp($emp_Data->emp_category)){
//                    if($shift_data = $this->cronjobs_mod->get_emp_cate_shift_schedule($emp_Data->emp_category)){
//
//                        $work_week_data = $this->cronjobs_mod->check_work_week_shift($day_type,$shift_data->s_id);
//
//                        $work_hour_head = $shift_data->schedule_work_hours;
//                        $work_hour_halfday= $shift_data->schedule_half_work_hours;
//                        $start_time_hed = $shift_data->schedule_start_time;
//                        $end_time = $shift_data->schedule_end_time;
//                        $late_time_hed = $shift_data->late_time_LA;
//                        $late_time_er = $shift_data->late_time_EL;
//                        $halfday_time_mo = $shift_data->halfday_time_mo;
//                        $halfday_time_ev = $shift_data->halfday_time_ev;
//                        $halfday_work_end = $shift_data->halfday_time_mo_end;
//
//                        //start holiday morning end, early late and evening start,late
//                        $start_time_hed_hol = holiday_evening_start;
//                        $end_time_hol = holiday_morning_end;
//                        $late_time_hed_hol = holiday_evening_late;
//                        $late_time_er_hol = holiday_morning_er_late;
//                        //end holiday morning end, early late and evening start,late
//                    } else {
//
//                        $work_week_data = $this->cronjobs_mod->check_work_week($day_type);
//
//                        $work_hour_head = $this->cronjobs_mod->getATTSettingsData('work_hours')->setting_value;
//                        $work_hour_halfday = $this->cronjobs_mod->getATTSettingsData('work_hours_half')->setting_value;
//                        $start_time_hed = $this->cronjobs_mod->getATTSettingsData('start_time')->setting_value;
//                        $end_time = $this->cronjobs_mod->getATTSettingsData('end_time')->setting_value;
//                        $late_time_hed = $this->cronjobs_mod->getATTSettingsData('late_time_LA')->setting_value;
//                        $late_time_er = $this->cronjobs_mod->getATTSettingsData('late_time_EL')->setting_value;
//                        $halfday_time_mo = $this->cronjobs_mod->getATTSettingsData('halfday_time_mo')->setting_value;
//                        $halfday_time_ev = $this->cronjobs_mod->getATTSettingsData('halfday_time_ev')->setting_value;
//                        $halfday_work_end = $this->cronjobs_mod->getATTSettingsData('halfday_time_mo_end')->setting_value;
//
//                        //saturday
//                        $end_time_sat = $this->cronjobs_mod->getATTSettingsData('saturday_end_end')->setting_value;
//                        $work_hour_sat = $this->cronjobs_mod->getATTSettingsData('satur_wo_ho')->setting_value;
//
//                        //start holiday morning end, early late and evening start,late
//                        $start_time_hed_hol = $this->cronjobs_mod->getATTSettingsData('holiday_evening_start')->setting_value;
//                        $end_time_hol = $this->cronjobs_mod->getATTSettingsData('holiday_morning_end')->setting_value;
//                        $late_time_hed_hol = $this->cronjobs_mod->getATTSettingsData('holiday_evening_late')->setting_value;
//                        $late_time_er_hol = $this->cronjobs_mod->getATTSettingsData('holiday_morning_er_late')->setting_value;
//                        //end holiday morning end, early late and evening start,late
//                    }


                    if($EmpCatData->fingerprint_status=="YES" || $EmpCatData->show_att=="YES") {
//                        $att_date = $val_data->Date;
//                        $time = $val_data->time;
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
//                        $day_type = date('l', strtotime($att_date));
//                        $date_month = date('Y-m', strtotime($att_date));


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
                                        $work_week_data = $this->cronjobs_mod->check_work_week_shift($day_type,$shift_new_data->s_id);
                                        if ($emp_Data->emp_category == 3) {

                                            if (($shift_new_data->schedule_start_time == '08:00') && (($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '08:00')) || ($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '14:30')))) {

                                                $new_in_time_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_start_time); // start time
                                                $temp_data_date_time_end = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_end_time); // end time
                                                $temp_data_date_time_late_er = strtotime($new_in_time[0] . ' ' . $shift_new_data->late_time_EL); // late time early

                                                $new_halfday_time_mo_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_mo); //halfday time morning
                                                $new_halfday_time_ev_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_ev); //halfday time evining
                                                $work_hour_head = $shift_new_data->schedule_work_hours;
                                                $halfday_work_end = $shift_new_data->halfday_time_mo_end;

                                            } elseif (($shift_new_data->schedule_start_time == '16:00') && ($att_new_in_time > strtotime($new_in_time[0] . ' ' . '14:30')) && (($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '16:00'))||($att_new_in_time <= strtotime($new_in_time[0] . ' ' . '19:00')))) {

                                                $new_in_time_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_start_time); // start time
                                                $temp_data_date_time_end = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_end_time); // end time
                                                $temp_data_date_time_late_er = strtotime($new_in_time[0] . ' ' . $shift_new_data->late_time_EL); // late time early

                                                $new_halfday_time_mo_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_mo); //halfday time morning
                                                $new_halfday_time_ev_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_ev); //halfday time evining
                                                $work_hour_head = $shift_new_data->schedule_work_hours;
                                                $halfday_work_end = $shift_new_data->halfday_time_mo_end;

                                            }

                                        } else {

                                            $new_in_time_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_start_time); // start time
                                            $temp_data_date_time_end = strtotime($new_in_time[0] . ' ' . $shift_new_data->schedule_end_time); // end time
                                            $temp_data_date_time_late_er = strtotime($new_in_time[0] . ' ' . $shift_new_data->late_time_EL); // late time early

                                            $new_halfday_time_mo_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_mo); //halfday time morning
                                            $new_halfday_time_ev_date_time = strtotime($new_in_time[0] . ' ' . $shift_new_data->halfday_time_ev); //halfday time evining
                                            $work_hour_head = $shift_new_data->schedule_work_hours;
                                            $halfday_work_end = $shift_new_data->halfday_time_mo_end;
                                        }
                                    }
                                }else {

                                    $work_week_data = $this->cronjobs_mod->check_work_week($day_type);

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
                                    $new_halfday_time_mo_date_time = strtotime($new_in_time[0].' '.$halfday_time_mo);
                                    $new_halfday_time_ev_date_time = strtotime($new_in_time[0].' '.$halfday_time_ev);
                                }

//                                $temp_data_date_time_end = strtotime($att_date . ' ' . $end_time);
//                                $temp_data_date_time_late_er = strtotime($att_date . ' ' . $late_time_er);
//
//                                $new_in_time_date_time = strtotime($new_in_time[0].' '.$start_time_hed);
//                                //$new_out_time_date_time = strtotime($new_in_time[0].' '.$end_time);
//                                $new_late_time_date_time = strtotime($new_in_time[0].' '.$late_time_hed);
//                                $new_halfday_time_mo_date_time = strtotime($new_in_time[0].' '.$halfday_time_mo);
//                                $new_halfday_time_ev_date_time = strtotime($new_in_time[0].' '.$halfday_time_ev);

                                $att_new_settings_start_time_hol = strtotime($temp_gen_in_time); // start time holiday evening
                                $att_new_settings_end_time_hol = strtotime($new_in_time[0] . ' ' . $end_time_hol); // end time holiday morning
                                $att_new_settings_late_time_hol = strtotime($new_in_time[0] . ' ' . $late_time_hed_hol); // late time holiday
                                $att_new_settings_late_time_el_hol = strtotime($new_in_time[0] . ' ' . $late_time_er_hol); // late time early holiday

                                $halfday_check_time = strtotime($new_in_time[0] . ' ' . $halfday_work_end);

                                $morning_halfday_count = ($halfday_check_time - $temp_gen_in_time)/3600;
                                $evening_halfday_count = ($temp_data_date_time - $halfday_check_time)/3600;

                                if (($emp_id == $temp_gen_emp) && ($att_date == $new_in_time[0])) {

                                    $data_action=array(
                                        'action'=>1,
                                        'update_time'=>date('Y-m-d h:i:s')
                                    );
                                    $this->cronjobs_mod->update_action($id,$data_action);

                                    $diff = explode('.',($temp_data_date_time-$new_in_time_date_time)/3600);
                                    $diff1 = ($temp_data_date_time-$new_in_time_date_time)/3600;
                                    $diff2 = ($temp_data_date_time_end-$temp_gen_in_time)/3600;
                                    $min = explode('.',(($temp_data_date_time-$new_in_time_date_time)%3600)/60);

                                    $working_hour = ($temp_data_date_time-$temp_gen_in_time)/3600;

                                    if($work_week_data->status=="Full Day" || $work_week_data->status=="Half Day" ) {

                                        if (!$this->cronjobs_mod->check_date($att_date)){

                                            if($work_week_data->status=="Full Day") {
                                                if ((($temp_gen_in_time > $new_in_time_date_time) && ($temp_gen_in_time > $new_halfday_time_mo_date_time))) {
                                                    //                                        if(($temp_gen_in_time>$new_in_time_date_time)&&($temp_gen_in_time>$new_halfday_time_mo_date_time)){
                                                    //HalfDay MO
                                                    $HD_M = 1;
                                                }
                                                if ((($temp_data_date_time < $temp_data_date_time_end) && ($temp_data_date_time < $new_halfday_time_ev_date_time) && ($temp_data_date_time > $new_halfday_time_mo_date_time))) {
                                                    //                                        if(($temp_data_date_time<$temp_data_date_time_end)&&($temp_data_date_time<$new_halfday_time_ev_date_time)){
                                                    //HalfDay EV
                                                    $HD_E = 1;
                                                }
                                                if (($temp_gen_in_time > $new_in_time_date_time) && ($temp_gen_in_time <= $new_halfday_time_mo_date_time) && ($temp_gen_in_time > $new_late_time_date_time)) {
                                                    //                                        if(($temp_gen_in_time>$new_in_time_date_time)&&($temp_gen_in_time<$new_halfday_time_mo_date_time)&&($temp_gen_in_time>$new_late_time_date_time)){
                                                    //SHORT LEAVE MO
                                                    $SLM = "1";
                                                }
                                                if (($temp_data_date_time < $temp_data_date_time_end) && ($temp_data_date_time > $new_halfday_time_ev_date_time) && ($temp_data_date_time < $temp_data_date_time_late_er)) {
                                                    //                                        if(($temp_data_date_time<$temp_data_date_time_end)&&($temp_data_date_time>$new_halfday_time_ev_date_time)&&($temp_data_date_time<$temp_data_date_time_late_er)){
                                                    //SHORT LEAVE EV
                                                    $SLE = "1";
                                                }
                                                if (($temp_gen_in_time > $new_in_time_date_time) && ($temp_gen_in_time <= $new_late_time_date_time)) {
                                                    //Late MO
                                                    $LA_time += (($temp_gen_in_time - $new_in_time_date_time) % 3600) / 60;
                                                    $LA = '1';
                                                    $late_count++;
                                                }

                                                if (($temp_data_date_time < $temp_data_date_time_end) && ($temp_data_date_time >= $temp_data_date_time_late_er)) {
                                                    //Late EV
                                                    $EL_time += (($temp_data_date_time_end - $temp_data_date_time) % 3600) / 60;
                                                    $EL = '1';
                                                    $late_count++;
                                                }

                                            }elseif ($work_week_data->status=="Half Day"){
//
//                                                if ((($temp_gen_in_time > $new_in_time_date_time) && ($temp_gen_in_time > $new_halfday_time_mo_date_time))) {
//                                                    //                                        if(($temp_gen_in_time>$new_in_time_date_time)&&($temp_gen_in_time>$new_halfday_time_mo_date_time)){
//                                                    //HalfDay MO
//                                                    $HD_M = 1;
//                                                }
//                                                if ((($temp_data_date_time < $temp_data_date_time_end) && ($temp_data_date_time < $new_halfday_time_ev_date_time) && ($temp_data_date_time > $new_halfday_time_mo_date_time))) {
//                                                    //                                        if(($temp_data_date_time<$temp_data_date_time_end)&&($temp_data_date_time<$new_halfday_time_ev_date_time)){
//                                                    //HalfDay EV
//                                                    $HD_E = 1;
//                                                }
//                                                if (($temp_gen_in_time > $new_in_time_date_time) && ($temp_gen_in_time <= $new_halfday_time_mo_date_time) && ($temp_gen_in_time > $new_late_time_date_time)) {
//                                                    //                                        if(($temp_gen_in_time>$new_in_time_date_time)&&($temp_gen_in_time<$new_halfday_time_mo_date_time)&&($temp_gen_in_time>$new_late_time_date_time)){
//                                                    //SHORT LEAVE MO
//                                                    $SLM = "1";
//                                                }
//                                                if (($temp_data_date_time < $temp_data_date_time_end) && ($temp_data_date_time > $new_halfday_time_ev_date_time) && ($temp_data_date_time < $temp_data_date_time_late_er)) {
//                                                    //                                        if(($temp_data_date_time<$temp_data_date_time_end)&&($temp_data_date_time>$new_halfday_time_ev_date_time)&&($temp_data_date_time<$temp_data_date_time_late_er)){
//                                                    //SHORT LEAVE EV
//                                                    $SLE = "1";
//                                                }
                                                if (($temp_gen_in_time > $new_in_time_date_time) && ($temp_gen_in_time <= $new_late_time_date_time)) {
                                                    //Late MO
                                                    $LA_time += (($temp_gen_in_time - $new_in_time_date_time) % 3600) / 60;
                                                    $LA = '1';
                                                    $late_count++;
                                                }

//                                                if (($temp_data_date_time < $temp_data_date_time_end) && ($temp_data_date_time >= $temp_data_date_time_late_er)) {
//                                                    //Late EV
//                                                    $EL_time += (($temp_data_date_time_end - $temp_data_date_time) % 3600) / 60;
//                                                    $EL = '1';
//                                                    $late_count++;
//                                                }

                                            }

                                            //                                        if ((float)$diff1 >= $work_hour_head) {
                                            if ((float)$working_hour >= $work_hour_head && $diff2>$work_hour_head) {

                                                //OT
                                                if($EmpCatData->ot_applicable=="YES"  || $day_type=='Saturday' || $day_type=='Sunday') {
                                                    if ($min[0] >= 30) {
                                                        if (((float)($diff[0] + 0.5) - $work_hour_head) >= 1) {
                                                            $ot = ((float)($diff[0] + 0.5) - $work_hour_head);
                                                        } else if (((float)($diff[0] + 0.5) - $work_hour_head) >= 0.5) {
                                                            $ot = 0.5;
                                                        } else {
                                                            $ot = 0;
                                                        }
                                                    } else {
                                                        if (((float)($diff[0]) - $work_hour_head) >= 1) {
                                                            $ot = ((float)($diff[0]) - $work_hour_head);
                                                        } elseif (((float)($diff[0]) - $work_hour_head) >= 0.5) {
                                                            $ot = 0.5;
                                                        } else {
                                                            $ot = 0;
                                                        }
                                                    }
                                                }

                                                if (($temp_gen_in_time<$new_late_time_date_time) && ($new_in_time_date_time>$temp_data_date_time_late_er)) {
                                                    $wd = 1;
                                                    $NL = '1';
                                                }else{

                                                    if (($HD_M == 1 || $HD_E == 1) && ($SLM != 1 || $SLE != 1)) {
                                                        $wd = 0.5;
                                                        $NL = '1';
                                                    } elseif ($SLM == 1 && $SLE == 1) {
                                                        $wd = 0.5;
                                                        $NL = '1';
                                                    } elseif (($SLM == 1 || $SLE == 1) && ($LA == 1 || $EL == 1)) {
                                                        $wd = 0.5;
                                                        $NL = '1';
                                                    } elseif ($LA == 0 && $EL == 0 && $HD_M == 0 && $HD_E == 0 && ($SLM == 1 || $SLE == 1)) {
                                                        $wd = 1;
                                                        $NL = '1';
                                                    } elseif (($LA == 1 || $EL == 1) && $HD_M == 0 &&  $HD_E == 0 && $SLM == 0 && $SLE == 0) {
                                                        $wd = 1;
                                                        $NL = '1';
                                                    } else if($LA == 0 && $EL ==0 && $HD_M == 0 &&  $HD_E == 0  && $SLM == 0 && $SLE == 0) {
                                                        $wd = 1;
                                                        $NL = '1';
                                                    } else {
                                                        $wd = 0;
                                                    }
                                                }
                                                //                                        } else {
                                            } else if((float)$working_hour >= $work_hour_halfday) {
                                                if($EmpCatData->ot_applicable=="YES") {
                                                    $ot = 0;
                                                }
                                                if(!empty($temp_data_date_time)) {
                                                    if($work_week_data->status=="Half Day") {

                                                        if (($LA == 1) && (float)$working_hour>=$work_hour_sat-0.25) {
                                                            $wd = 1;
                                                            $NL = '1';
                                                        } elseif ($LA == 0 && (float)$working_hour>=$work_hour_sat) {
                                                            $wd = 1;
                                                            $NL = '1';
                                                        } else {
                                                            $wd = 0;
                                                        }

                                                        if((float)$working_hour>$work_hour_sat) {
                                                            if ($EmpCatData->ot_applicable == "YES"  || $day_type=='Saturday' || $day_type=='Sunday') {
                                                                if ($min[0] >= 30) {
                                                                    if (((float)($diff[0] + 0.5) - $work_hour_sat) >= 1) {
                                                                        $ot = ((float)($diff[0] + 0.5) - $work_hour_sat);
                                                                    } else if (((float)($diff[0] + 0.5) - $work_hour_sat) >= 0.5) {
                                                                        $ot = 0.5;
                                                                    } else {
                                                                        $ot = 0;
                                                                    }
                                                                } else {
                                                                    if (((float)($diff[0]) - $work_hour_sat) >= 1) {
                                                                        $ot = ((float)($diff[0]) - $work_hour_sat);
                                                                    } elseif (((float)($diff[0]) - $work_hour_sat) >= 0.5) {
                                                                        $ot = 0.5;
                                                                    } else {
                                                                        $ot = 0;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                    } elseif($HD_M==1 && $HD_E!=1) {

                                                        if($diff2 >= $evening_halfday_count) {
                                                            if ($HD_M == 1 && ($SLM != 1 || $SLE != 1)) {
                                                                $wd = 0.5;
                                                                $NL = '1';
                                                            } elseif ($SLM == 1 && $SLE == 1) {
                                                                $wd = 0.5;
                                                                $NL = '1';
                                                            } elseif (($SLM == 1 || $SLE == 1) && ($LA == 1 || $EL == 1)) {
                                                                $wd = 0.5;
                                                                $NL = '1';
                                                            } elseif ($LA == 0 && $EL == 0 && $HD_M == 0 && ($SLM == 1 || $SLE == 1)) {
                                                                $wd = 1;
                                                                $NL = '1';
                                                            } elseif (($LA == 1 || $EL == 1) && $HD_M == 0 && $SLM == 0 && $SLE == 0) {
                                                                $wd = 1;
                                                                $NL = '1';
                                                            } else if($LA == 0 && $EL ==0 && $HD_M == 0 && $SLM == 0 && $SLE == 0) {
                                                                $wd = 1;
                                                                $NL = '1';
                                                            } else {
                                                                $wd = 0;
                                                            }
                                                        }else{
                                                            $wd = 0;
                                                        }

                                                    }else{
                                                        if((float)$diff1 >= $morning_halfday_count) {

                                                            if ($HD_E == 1 && ($SLM != 1 || $SLE != 1)) {
                                                                $wd = 0.5;
                                                                $NL = '1';
                                                            } elseif ($SLM == 1 && $SLE == 1) {
                                                                $wd = 0.5;
                                                                $NL = '1';
                                                            } elseif (($SLM == 1 || $SLE == 1) && ($LA == 1 || $EL == 1)) {
                                                                $wd = 0.5;
                                                                $NL = '1';
                                                            } elseif ($LA == 0 && $EL == 0 && $HD_E == 0 && ($SLM == 1 || $SLE == 1)) {
                                                                $wd = 1;
                                                                $NL = '1';
                                                            } elseif (($LA == 1 || $EL == 1) && $HD_E == 0 && $SLM == 0 && $SLE == 0) {
                                                                $wd = 1;
                                                                $NL = '1';
                                                            } else if($LA == 0 && $EL ==0 && $HD_E == 0 && $SLM == 0 && $SLE == 0) {
                                                                $wd = 1;
                                                                $NL = '1';
                                                            } else {
                                                                $wd = 0;
                                                            }
                                                        }else{
                                                            $wd = 0;
                                                        }
                                                    }

                                                }else{
                                                    $wd = 0;
                                                }
                                            }else{
                                                $wd = 0;
                                            }
                                        }
                                        else{

                                            $temp_gen_in_time = strtotime($temp_gen->in_time);
                                            $temp_data_date_time = strtotime($att_date . ' ' . $time);

                                            $holiday = $this->cronjobs_mod->search_holiday_1($new_in_time[0]);
                                            if ($holiday->status=='Half Day Morning'){
                                                $ot = 0;
                                                if(!empty($temp_data_date_time)){
                                                    if(($temp_gen_in_time>$att_new_settings_start_time_hol)&&($temp_gen_in_time<$att_new_settings_late_time_hol)){
                                                        //Late MO
                                                        $LA_time += (($temp_gen_in_time-$att_new_settings_start_time_hol)%3600)/60;
                                                        $LA = '1';
                                                        $late_count++;
                                                    }
                                                    if(($temp_data_date_time<$temp_data_date_time_end)&&($temp_data_date_time>$temp_data_date_time_late_er)){
                                                        //Late EV
                                                        $EL_time += (($temp_data_date_time_end-$temp_data_date_time)%3600)/60;
                                                        $EL = '1';
                                                        $late_count++;
                                                    }
                                                    if(($diff.'.'.$diff1)>=$morning_halfday_count){
                                                        $wd = 0.5;
                                                        if(($diff.'.'.$diff1)>$morning_halfday_count) {
                                                            if ($EmpCatData->ot_applicable == "YES") {
                                                                if ($min[0] >= 30) {
                                                                    if (((float)($diff[0] + 0.5) - $morning_halfday_count) >= 1) {
                                                                        $ot = ((float)($diff[0] + 0.5) - $morning_halfday_count);
                                                                    } else if (((float)($diff[0] + 0.5) - $morning_halfday_count) >= 0.5) {
                                                                        $ot = 0.5;
                                                                    } else {
                                                                        $ot = 0;
                                                                    }
                                                                } else {
                                                                    if (((float)($diff[0]) - $morning_halfday_count) >= 1) {
                                                                        $ot = ((float)($diff[0]) - $morning_halfday_count);
                                                                    } elseif (((float)($diff[0]) - $morning_halfday_count) >= 0.5) {
                                                                        $ot = 0.5;
                                                                    } else {
                                                                        $ot = 0;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        $wd = 0;
                                                    }
                                                }else{
                                                    $wd = 0;
                                                }
                                            }elseif ($holiday->status=='Half Day Evening'){
                                                $ot = 0;
                                                if(!empty($data_app[3])){
                                                    if(($temp_data_date_time<$att_new_settings_end_time_hol)&&($temp_data_date_time>$att_new_settings_late_time_el_hol)){
                                                        //Late EV
                                                        $EL_time += (($att_new_settings_end_time_hol-$temp_data_date_time)%3600)/60;
                                                        $EL = '1';
                                                        $late_count++;
                                                    }
                                                    if(($temp_gen_in_time>$new_in_time_date_time)&&($temp_gen_in_time<$new_late_time_date_time)){
                                                        //Late MO
                                                        $LA_time += (($temp_gen_in_time-$new_in_time_date_time)%3600)/60;
                                                        $LA = '1';
                                                        $late_count++;
                                                    }
                                                    if(($diff[0].'.'.$diff1)>=$evening_halfday_count){

                                                        $wd = 0.5;
                                                        if(($diff[0].'.'.$diff1)>$evening_halfday_count) {

                                                            if ($EmpCatData->ot_applicable == "YES") {
                                                                if ($min[0] >= 30) {
                                                                    if (((float)($diff[0] + 0.5) - $evening_halfday_count) >= 1) {
                                                                        $ot = ((float)($diff[0] + 0.5) - $evening_halfday_count);
                                                                    } else if (((float)($diff[0] + 0.5) - $evening_halfday_count) >= 0.5) {
                                                                        $ot = 0.5;
                                                                    } else {
                                                                        $ot = 0;
                                                                    }
                                                                } else {
                                                                    if (((float)($diff[0]) - $evening_halfday_count) >= 1) {
                                                                        $ot = ((float)($diff[0]) - $evening_halfday_count);
                                                                    } elseif (((float)($diff[0]) - $evening_halfday_count) >= 0.5) {
                                                                        $ot = 0.5;
                                                                    } else {
                                                                        $ot = 0;
                                                                    }
                                                                }
                                                            }
                                                        }

                                                    }else{
                                                        $wd = 0;
                                                    }
                                                }else{
                                                    $wd = 0;
                                                }
                                            }
                                        }
                                    }

                                    if(date('D',strtotime($att_date))=='Sun'){
                                        if($working_hour>=4 && $working_hour<8){
                                            $liu_count = 0.5;
                                        }elseif ($working_hour>=8){
                                            $liu_count = 1;
                                        }else{
                                            $liu_count = 0;
                                        }
                                    }else{
                                        $liu_count = 0;
                                    }

                                    $data_gen_up = array(
                                        'out_time' => $att_date . ' ' . $time,
                                        'out_update_time'=>date('Y-m-d h:i:s'),
                                        'ot_hrs' =>  $ot,
                                        'app_ot' => $ot,
                                        "late_count"=>($wd==0)?0:$late_count,
                                        "LA_time"=>($wd==0)?0:$LA_time,
                                        "EL_time"=>($wd==0)?0:$EL_time,
                                        'work_day'=>$wd,
                                        'SLM'=>($wd==0)?0:$SLM,
                                        'SLE'=>($wd==0)?0:$SLE,
                                        'LA'=>($wd==0)?0:$LA,
                                        'EL'=>($wd==0)?0:$EL,
                                        'NL'=>($wd==0)?0:$NL,
                                        'liu_leave'=>(date('D',strtotime($att_date))=='Sun')?1:0,
                                        'liu_status'=>(date('D',strtotime($att_date))=='Sun')?1:0,
                                        'liu_count'=>$liu_count
                                    );

                                    $LA_time = 0;
                                    $EL_time = 0;
                                    $LA = 0;
                                    $EL = 0;
                                    $NL = 0;
                                    $SLM = 0;
                                    $SLE = 0;
                                    $HD_M= 0;
                                    $HD_E =0;
                                    $wd =0;
                                    $this->cronjobs_mod->update_temp_generate_data($temp_gen_id,$temp_gen_emp,  $data_gen_up);
                                } else {

                                    $data_action=array(
                                        'action'=>1,
                                        'update_time'=>date('Y-m-d h:i:s')
                                    );
                                    $this->cronjobs_mod->update_action($id,$data_action);

                                    if(!$this->cronjobs_mod->getAll_same_data($emp_id,$att_date)){
                                        if($this->cronjobs_mod->check_date($att_date)){
                                            $sp_cat = $this->cronjobs_mod->get_check_date_holiday($att_date)->sp_category;
                                        }else{
                                            $sp_cat = 'WD';
                                        }
                                        $data_gen = array(
                                            'ref_id' => $this->cronjobs_mod->getEmployeeById($emp_id)->id,
                                            'employee_id' => $emp_id,
                                            'name' => $this->cronjobs_mod->getEmployeeById($emp_id)->initials,
                                            'day_type' => date('D', strtotime($att_date)),
                                            'date' => $att_date,
                                            'month' => date('Y-m', strtotime($att_date)),
                                            'in_time' => $att_date . ' ' . $time,
                                            "late_count"=>$late_count,
                                            'out_time' => '',
                                            'ot_hrs' => '',
                                            'app_ot' => '',
                                            'day_cat'=>$sp_cat,
                                            'in_updated_time'=>date('Y-m-d h:i:s')
                                        );
                                        $this->cronjobs_mod->save_temp_generate_data($data_gen);
                                    } else{
                                        //echo $emp_id." ".$att_date." Before <br>";
                                        $data_new = $this->cronjobs_mod->getAll_same_data($emp_id,$att_date);
                                        $data_gen = array(
                                            'in_time' => $att_date . ' ' . $time,
                                            'in_updated_time'=>date('Y-m-d h:i:s')
                                        );

                                        $this->cronjobs_mod->update_temp_generate_data($data_new->id,$emp_id,$data_gen);
                                    }
                                }
                            }
                        } else {
                            $data_action=array(
                                'action'=>1,
                                'update_time'=>date('Y-m-d h:i:s')
                            );
                            $this->cronjobs_mod->update_action($id,$data_action);

                            if(!$this->cronjobs_mod->getAll_same_data($emp_id,$att_date)) {
                                if($this->cronjobs_mod->check_date($att_date)){
                                    $sp_cat = $this->cronjobs_mod->get_check_date_holiday($att_date)->sp_category;
                                }else{
                                    $sp_cat = 'WD';
                                }
                                $data_gen = array(
                                    'ref_id' => $this->cronjobs_mod->getEmployeeById($emp_id)->id,
                                    'employee_id' => $emp_id,
                                    'name' => $this->cronjobs_mod->getEmployeeById($emp_id)->initials,
                                    'day_type' => date('D', strtotime($att_date)),
                                    'date' => $att_date,
                                    'month' => date('Y-m', strtotime($att_date)),
                                    'in_time' => $att_date . ' ' . $time,
                                    "late_count"=>$late_count,
                                    'out_time' => '',
                                    'ot_hrs' => '',
                                    'app_ot' => '',
                                    'day_cat'=>$sp_cat,
                                    'in_updated_time'=>date('Y-m-d h:i:s')
                                );
                                $this->cronjobs_mod->save_temp_generate_data($data_gen);
                            }else{
                                $data_new = $this->cronjobs_mod->getAll_same_data($emp_id,$att_date);
                                $data_gen = array(
                                    'in_time' => $att_date . ' ' . $time,
                                    'in_updated_time'=>date('Y-m-d h:i:s')
                                );
                                $this->cronjobs_mod->update_temp_generate_data($data_new->id,$emp_id,$data_gen);
                            }
                        }
                    }
                }
            }

            foreach ($aryRange as $per_day) {
                $all_abs_employee = $this->cronjobs_mod->get_absent_employee($per_day);
                foreach ($all_abs_employee as $abs_employee) {

                    $em_id = $abs_employee['employee_id'];
                    $emp_Data = $this->cronjobs_mod->getEmployeeById($em_id);
                    if($EmpCatData = $this->cronjobs_mod->getEmpCatDatabyEmp($emp_Data->emp_category)){
                        if($EmpCatData->fingerprint_status=="YES" || $EmpCatData->show_att=="YES") {
                            $timestamp = strtotime($per_day);
                            //                            $day = date('D', $timestamp);
                            $day_type_n = date('l', $timestamp);
                            $work_week_data_n = $this->cronjobs_mod->check_work_week($day_type_n);

//                            if($hdate = $this->cronjobs_mod->check_date($att_date)){
//                                $sp_cat = $hdate->sp_category;
//                            }elseif($work_week_data_n->status=="Non Working Day"){
//                                $sp_cat = 'NWD';
//                            }else{
//                                $sp_cat = 'WD';
//                            }

                            if($hdate = $this->cronjobs_mod->check_date($att_date)){
                                $sp_cat = $hdate->sp_category;
                            }elseif($shift_data = $this->cronjobs_mod->get_emp_cate_shift_schedule($emp_Data->emp_category)){
                                $work_week_data = $this->cronjobs_mod->check_work_week_shift($day_type_n,$shift_data->s_id);
                                if($work_week_data->status=="Full Day" || $work_week_data->status=="Half Day" ){
                                    $sp_cat = 'WD';
                                }     else{
                                    $sp_cat = 'NWD';
                                }
                            }else{
                                $work_week_data = $this->cronjobs_mod->check_work_week($day_type_n);
                                if($work_week_data->status=="Full Day" || $work_week_data->status=="Half Day" ) {
                                    $sp_cat = 'WD';
                                }else{
                                    $sp_cat = 'NWD';
                                }
                            }

                            if(!$this->cronjobs_mod->getAll_same_data($abs_employee['employee_id'],$per_day)) {
                                $data_gen = array(
                                    'ref_id' => $this->cronjobs_mod->getEmployeeById($abs_employee['employee_id'])->id,
                                    'employee_id' => $abs_employee['employee_id'],
                                    'name' => $abs_employee['initials']." ".$abs_employee['last_name'],
                                    'day_type' => date('D', strtotime($per_day)),
                                    'date' => $per_day,
                                    'month' => date('Y-m', strtotime($per_day)),
                                    "late_count"=>'',
                                    'in_time' => '',
                                    'out_time' => '',
                                    'ot_hrs' => '',
                                    'app_ot' => '',
                                    'day_cat'=>$sp_cat
                                );
                                $this->cronjobs_mod->save_temp_generate_data($data_gen);
                            }
                        }
                    }
                }
            }

            $this->system_log->create_system_log("FP File Management", "Success", "Auto FP Data Posting - Cron Job Done for ".$month);
            echo "Auto FP Data Posting - Cron Job Done for ".$month;
        }else{
            echo "No Data Available for Posting";
        }
    }

}
