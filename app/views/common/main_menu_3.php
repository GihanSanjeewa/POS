<?php
$this->load->model('permissions_mod');
$current_user = $this->session->userdata('user_id');
?>
<?php
$currentURL = current_url();
$baseURL = base_url();
?>
<ul id="sidebarnav" class="main-menu">
    <li class="">
        <a href="<?php echo base_url('dashboard'); ?>">
            <div class="icon-w">
                <div class="icon-speedometer"></div>
            </div>
            <span>Dashboard</span>
        </a>
    </li>
    <?php $groups=array('admin','department','master','lead'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-user-follow"></div>
                </div>
                <span>Lead</span></a>
            <div class="sub-menu-w" >
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <?php $path = "Lead_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Lead_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/index'); ?>">
                                    <i class="fa fa-sitemap"></i>Add Lead</a>
                            </li>
                        <?php } ?>

                         <?php $path = "Lead_con/trns_lead";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "trns_lead") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/trns_lead'); ?>">
                                    <i class="fa fa-sitemap"></i>Lead Transfer</a>
                            </li>
                        <?php } ?>

                         <?php $path = "Lead_con/trns_his";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "trns_his") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/trns_his'); ?>">
                                    <i class="fa fa-sitemap"></i>Lead Transfer Details</a>
                            </li>
                        <?php } ?>
                        <!--  <?php $path = "Assignment_con/ass_view";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "ass_view") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Assignment_con/ass_view'); ?>">
                                    <i class="fa fa-sitemap"></i>Followup Reports</a>
                            </li>
                        <?php } ?>
                         <?php $path = "class_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "class_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Assignment_con/ass_view'); ?>">
                                    <i class="fa fa-sitemap"></i>Transfer lead</a>
                            </li>
                        <?php } ?>
                         <?php $path = "class_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "class_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Assignment_con/ass_view'); ?>">
                                    <i class="fa fa-sitemap"></i>Lead Complete</a>
                            </li>
                        <?php } ?> -->
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>
    <?php $groups=array('admin','dataentry','department'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class="has-arrow has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-people"></div>
                </div>
                <span>Student Management</span></a>
            <div class="sub-menu-w">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <?php
                        $path = "Students_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Students_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/Students_con/index'); ?>">
                                    <i class="fa fa-address-book"></i> Pending / Rejected Applications
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        $path = "Qualified_students_con/index_two";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "index_two") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/Qualified_students_con/index_two');?>">

                                    <i class="fa fa-address-card"></i> Registration Payments
                                </a>
                            </li>
                        <?php } ?>

                        <?php $path = "students_con/registrar_index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "registrar_index") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/students_con/registrar_index'); ?>">
                                    <i class="fa fa-child"></i> Registrar Validation </a>
                            </li>
                        <?php } ?>


                        

                        <?php
                        $path = "Qualified_students_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Qualified_students_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/Qualified_students_con/index');?>">

                                    <i class="fa fa-address-card"></i> Qualified Students
                                </a>
                            </li>
                        <?php } ?>

                        <?php
                        $path = "Dropout_students_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Dropout_students_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/Dropout_students_con/index');?>">

                                    <i class="fa fa-address-card"></i> Dropout Students
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        $path = "Dropout_students_con/index_two";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Dropout_students_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/Dropout_students_con/index_two');?>">

                                    <i class="fa fa-address-card"></i> Re-join Students
                                </a>
                            </li>
                        <?php } ?>
                        <?php
                        $path = "enrolled_students_ids_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "enrolled_students_ids_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('students/enrolled_students_ids_con/index');?>">

                                    <i class="fa fa-address-card"></i> Student IDs
                                </a>
                            </li>
                        <?php } ?>


<!--                        --><?php //$path = "class_con/index";
//                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
<!--                            <li class="--><?php //if ($this->uri->segment(2) == "class_con") {  echo 'active'; } ?><!--">-->
<!--                                <a href="--><?php //echo base_url('classes/class_con/index'); ?><!--">-->
<!--                                    <i class="fa fa-sitemap"></i> Class Allocation</a>-->
<!--                            </li>-->
<!--                        --><?php //} ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php }?>

    <?php $groups=array('admin','department','attendance'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a  href="javascript:;">
                <div class="icon-w">
                    <div class="icon-calendar"></div>
                </div>
                <span>Attendance</span></a>
            <div class="sub-menu-w">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <?php $path = "file_upload_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "file_upload_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('attendance/file_upload_con'); ?>">
                                    <i class="fa fa-thumbs-up"></i> FP Data Management
                                </a>
                            </li>
                        <?php } ?>
                        <?php $path = "attendance_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "attendance_con") { echo 'active';  } ?>">
                                <a href="<?php echo base_url('attendance/attendance_con'); ?>">
                                    <i class="fa fa-pencil-square-o"></i> Attendance Register
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </li>

    <?php } ?>
     <?php $groups=array('admin','department','exam'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-wallet"></div>
                </div>
                <span>Assessment</span></a>
            <div class="sub-menu-w">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <span style="text-align: center;">Assessment Info</span>
                        <?php $path = "exam_eligible_con/assessment";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(3) == "assessment") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/exam_eligible_con/assessment'); ?>">
                                    <i class="fa fa-upload"></i>Assignment</a>
                            </li>
                        <?php } ?>  
                         <?php $path = "results_upload_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "results_upload_con") { echo 'active';  } ?>">
                                <a href="<?php echo base_url('results/results_upload_con/index'); ?>">
                                    <i class="fa fa-upload"></i> Exam Results
                                </a>
                            </li>
                        <?php } ?>                                      
                    </ul>
                    <ul class="sub-menu">
                        <span style="text-align: center;">Exam Info</span>
                        <?php $path = "exam_eligible_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(2) == "exam_eligible_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/exam_eligible_con/index'); ?>">
                                    <i class="fa fa-frown-o"></i> Eligible Students </a>
                            </li>
                        <?php } ?>
                         <?php $path = "selection_exam/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(2) == "selection_exam") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/selection_exam/'); ?>">
                                     <i class="fa fa-address-card"></i> Exam Registration</a>
                            </li>
                        <?php } ?>

                         <?php $path = "selection_exam/admission_generate";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(3) == "admission_generate") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/selection_exam/admission_generate'); ?>">
                                    <i class="fa fa-gear"></i> Admission Generate - Batch</a>
                            </li>
                        <?php } ?>

                         <?php $path = "selection_exam/admission_generate_intake";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(3) == "admission_generate_intake") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/selection_exam/admission_generate_intake'); ?>">
                                    <i class="fa fa-gear"></i> Admission Generate - Intake</a>
                            </li>
                        <?php } ?>

                           <?php $path = "selection_exam/admission_generate_modue";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(3) == "admission_generate_modue") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/selection_exam/admission_generate_modue'); ?>">
                                    <i class="fa fa-gear"></i> Admission Generate - Module</a>
                            </li>
                        <?php } ?>

                        <?php $path = "selection_exam/admission_generate_student";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(3) == "admission_generate_student") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/selection_exam/admission_generate_student'); ?>">
                                    <i class="fa fa-gear"></i> Admission Generate - Student</a>
                            </li>
                        <?php } ?>


                        
                       <!--  <?php $path = "exam_eligible_approval_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)){ ?>
                            <li class="<?php if ($this->uri->segment(2) == "exam_eligible_approval_con") { echo 'active'; } ?>">
                                <a href="<?php echo base_url('exam/exam_eligible_approval_con/index'); ?>">
                                    <i class="fa fa-gear"></i> Eligible Approval </a>
                            </li>
                        <?php } ?> --> 
                    </ul>                
                    <ul class="sub-menu">
                        <span style="text-align: center;">Results Info</span>
                       
                        <?php $path = "results_publish_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "results_publish_con") { echo 'active';  } ?>">
                                <a href="<?php echo base_url('results/results_publish_con/index'); ?>">
                                    <i class="fa fa-mortar-board"></i> Publish Results
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>
    <?php $groups=array('admin','department','accountant','finance','cashier'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-paypal"></div>
                </div>
                <span>Payments</span></a>
            <div class="sub-menu-w">
                <div class="sub-menu-i">
                    <ul class="sub-menu">

                        <?php $path = "program_fee/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "program_fee") { echo 'active';  } ?>">
                                <a href="<?php echo base_url('payments/program_fee/index'); ?>">
                                    <i class="fa fa-money"></i> Program Payment Plans
                                </a>
                            </li>
                        <?php } ?>

                        <?php $path = "payments_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "payments_con") { echo 'active';  } ?>">
                                <a href="<?php echo base_url('payments/payments_con/index'); ?>">
                                    <i class="fa fa-money"></i> Payments
                                </a>
                            </li>
                        <?php } ?>


                        <?php /*$path = "payments_con/onetime_payment";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { */?><!--
                            <li class="<?php /*if ($this->uri->segment(3) == "onetime_payment") { echo 'active';  } */?>">
                                <a href="<?php /*echo base_url('payments/payments_con/onetime_payment'); */?>">
                                    <i class="fa fa-dollar"></i> One Time Payments
                                </a>
                            </li>
                        --><?php /*} */?>
                    </ul>
                </div>
            </div>
        </li>
    <?php }?>
    <?php $groups=array('admin','department'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-graduation"></div>
                </div>
                <span>Academic</span></a>
            <div class="sub-menu-w" style="left: auto;right: 0;">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <?php $path = "curriculums_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "curriculums_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('curriculums/curriculums_con/index'); ?>">
                                    <i class="fa fa-child"></i> Program Curriculum </a>
                            </li>
                        <?php } ?>
                        <?php $path = "gantt_chart_con/gantt_chart_add";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "gantt_chart_add") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('gantt_charts/gantt_chart_con/gantt_chart_add'); ?>">
                                    <i class="fa fa-child"></i> Gantt Charts </a>
                            </li>
                        <?php } ?>

                        <?php $path = "Gpa_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "index") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('gpa/Gpa_con/index'); ?>">
                                    <i class="fa fa-child"></i> GPA </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>
    <?php $groups=array('admin','department','master'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="fa fa-sitemap"></div>
                </div>
                <span>Class Management</span></a>
            <div class="sub-menu-w" style="left: auto;right: 0;">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <?php $path = "class_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "class_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('classes/class_con/index'); ?>">
                                    <i class="fa fa-sitemap"></i> Class Allocation</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>

    <?php $groups=array('admin','department','master'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-event"></div>
                </div>
                <span>Timetable</span></a>
            <div class="sub-menu-w" style="left: auto;right: 0;">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                   <!--      <?php $path = "Program_days_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "Program_days_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('timetable/Program_days_con/index'); ?>">
                                    <i class="fa fa-sort-alpha-asc"></i> Program Days</a>
                            </li>
                        <?php } ?>      -->  
                        <?php $path = "Assign_teachers/preference";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "preference") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('timetable/Assign_teachers/preference'); ?>">
                                    <i class="fa fa-eye"></i>Teachers Preference</a>
                            </li>
                        <?php } ?>                     

                        <?php $path = "Timetable_create_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "Timetable_create_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('timetable/Timetable_create_con/index'); ?>">
                                    <i class="fa fa-sort-alpha-asc"></i> Create Timetable</a>
                            </li>
                        <?php } ?>

                        <?php $path = "Assign_teachers/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Assign_teachers") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('timetable/Assign_teachers/index'); ?>">
                                    <i class="fa fa-sort-alpha-asc"></i>View Timetable</a>
                            </li>
                        <?php } ?>

                        <?php $path = "Assign_teachers/index2";

                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>

                            <li class="<?php if ($this->uri->segment(2) == "Assign_teachers") {  echo 'active'; } ?>">

                                <a href="<?php echo base_url('timetable/Assign_teachers/index2'); ?>">

                                    <i class="fa fa-sort-alpha-asc"></i>View Timetable - Batch</a>

                            </li>

                        <?php } ?>

                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>
     
    <?php $groups=array('admin','department','master'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-chart"></div>
                </div>
                <span>Reports</span></a>
            <div class="sub-menu-w" style="left: auto;right: 0;">
                <div class="sub-menu-i">
                    <ul class="sub-menu">
                        <?php $path = "Reports_student_con/studentsDetails";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "studentsDetails") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports/Reports_student_con/studentsDetails'); ?>">
                                    <i class="icon-people"></i> Students </a>
                            </li>
                        <?php } ?>
                        <?php $path = "Reports_student_con/studentsPayments";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "studentsPayments") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports/Reports_student_con/studentsPayments'); ?>">
                                    <i class="icon-people"></i> Students-Payments </a>
                            </li>
                        <?php } ?>
                        <?php $path = "Reports_student_con/studentsExam";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "studentsExam") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports/Reports_student_con/studentsExam'); ?>">
                                    <i class="icon-people"></i> Students-Exams </a>
                            </li>
                        <?php } ?>
      

                        <?php $path = "Att_pattern_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "index") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports_iihs/Att_pattern_con/index'); ?>">
                                    <i class="icon-people"></i> Attendance Pattern </a>
                            </li>
                        <?php } ?>


                     

                        <?php $path = "Daily_att_repo_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "index") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports_iihs/Daily_att_repo_con/index'); ?>">
                                    <i class="icon-people"></i> Daily Attendance </a>
                            </li>
                        <?php } ?>


                        <?php $path = "Module_att_repo_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "index") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports_iihs/Module_att_repo_con/index'); ?>">
                                    <i class="icon-people"></i> Moduler Attendance </a>
                            </li>
                        <?php } ?>





                        <!-- <?php $path = "Reports_student_con/studentsDrop";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "studentsDrop") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('reports/Reports_student_con/studentsDrop'); ?>">
                                    <i class="icon-people"></i> Students-Dropouts </a>
                            </li>
                        <?php } ?> -->
                    </ul>
                    <ul class="sub-menu">
                            
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>
    <?php $groups=array('admin','department','master'); if ($this->ion_auth->in_group($groups)) { ?>
        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-lock"></div>
                </div>
                <span>Master Data</span></a>
            <div class="sub-menu-w" style="left: auto;right: 0;">
                <div class="sub-menu-i">
                    <ul class="sub-menu" style="min-width: 160px;">
                        <span style="text-align: center;font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;" >Student Master</span>

                        <?php $path = "master_batches_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_batches_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_batches_con/index'); ?>">
                                    <i class="fa fa-book"></i>Batches</a>
                            </li>
                        <?php } ?>

                        <?php $path = "Master_intakes_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_intakes_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_intakes_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Intakes </a>
                            </li>
                        <?php } ?>
                      <!--   <?php $path = "Master_collaborate_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_collaborate_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_collaborate_con/index'); ?>">
                                    <i class="fa fa-book"></i> Intakes Collaborate </a>
                            </li>
                        <?php } ?>
 -->
                        <?php $path = "Master_student_details_transfer_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_student_details_transfer_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_student_details_transfer_con/index'); ?>">
                                    <i class="fa fa-book"></i> Batch / Program Transfer</a>
                            </li>
                        <?php } ?>
                    </ul>

                    <ul class="sub-menu" style="min-width: 160px; ">
                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Academic - Master</span>


                        <?php $path = "master_university_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_university_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_university_con/index'); ?>">
                                    <i class="fa fa-bank"></i>Partner Universites</a>
                            </li>
                        <?php } ?>

                        <?php $path = "Master_semesters_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_semesters_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_semesters_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Semesters </a>
                            </li>
                        <?php } ?>

                        <?php $path = "master_program_clusters_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_program_clusters_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_program_clusters_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Clusters</a>
                            </li>
                        <?php } ?>

                        <?php $path = "master_program_type_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_program_type_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_program_type_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Type</a>
                            </li>
                        <?php } ?>
                        <?php $path = "master_programs_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_programs_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_programs_con/index'); ?>">
                                    <i class="fa fa-book"></i> Programs</a>
                            </li>
                        <?php } ?>
                        <?php $path = "Assign_teachers/create_assessment";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "create_assessment") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('timetable/Assign_teachers/create_assessment'); ?>">
                                    <i class="fa fa-book"></i>Assessment Types</a>
                            </li>
                        <?php } ?>
                        <?php $path = "master_program_modules_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_program_modules_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_program_modules_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Modules</a>
                            </li>
                        <?php } ?>


                        <?php $path = "master_program_topic_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_program_topic_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_program_topic_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Topics </a>
                            </li>
                        <?php } ?>

                      <!--   <?php $path = "master_program_details_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_program_details_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_program_details_con/index'); ?>">
                                    <i class="fa fa-book"></i> Program Details</a>
                            </li>
                        <?php } ?> -->

                        <?php $path = "Master_grades_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_grades_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_grades_con/index'); ?>">
                                    <i class="fa fa-book"></i> Grades </a>
                            </li>
                        <?php } ?>

                        <?php /*$path = "Master_versions_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { */?><!--
                            <li class="<?php /*if ($this->uri->segment(2) == "Master_versions_con") {  echo 'active'; } */?>">
                                <a href="<?php /*echo base_url('master/Master_versions_con/index'); */?>">
                                    <i class="fa fa-book"></i> Versions</a>
                            </li>
                        --><?php /*} */?>

                        <?php $path = "Master_ganttchart_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_ganttchart_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_ganttchart_con/index'); ?>">
                                    <i class="fa fa-book"></i> Gantt Chart</a>
                            </li>
                        <?php } ?>

                        <?php $path = "Master_academic_types_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_academic_types_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_academic_types_con/index'); ?>">
                                <i class="fa fa-book"></i> Streams</a>
                                    <!-- <i class="fa fa-book"></i> Academic Types</a> -->
                            </li>
                        <?php } ?>
                    </ul>

                    <ul class="sub-menu" style="min-width: 160px;">
                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Payment - Master</span>
                        <?php $path = "Master_otherPayments_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_otherPayments_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_otherPayments_con/index'); ?>">
                                    <i class="fa fa-book"></i> Other Payments</a>
                            </li>
                        <?php } ?>

                        
                        <?php $path = "Master_bank_details_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_bank_details_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_bank_details_con/index'); ?>">
                                    <i class="fa fa-book"></i> Bank Accounts</a>
                            </li>
                        <?php } ?>

                        <?php $path = "Master_installment_discount_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_installment_discount_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_installment_discount_con/index'); ?>">
                                    <i class="fa fa-book"></i> Multiple Installment Discount Rates</a>
                            </li>
                        <?php } ?>
                    </ul>

                    <ul class="sub-menu" style="min-width: 160px;">
                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Timetable - Master</span>

                        <!-- <?php $path = "Master_teacher_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_teacher_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_teacher_con/index'); ?>">
                                    <i class="fa fa-book"></i> Teachers Module </a>
                            </li>
                        <?php } ?>

                        <?php $path = "Master_sessions_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_sessions_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_sessions_con/index'); ?>">
                                    <i class="fa fa-book"></i> Sessions </a>
                            </li>
                        <?php } ?> -->

                        <!--                         --><?php //$path = "Lead_con/create_lead_source";
                        //                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                        <!--                            <li class="--><?php //if ($this->uri->segment(3) == "create_lead_source") {  echo 'active'; } ?><!--">-->
                        <!--                                <a href="--><?php //echo base_url('lead_management/Lead_con/create_lead_source'); ?><!--">-->
                        <!--                                    <i class="fa fa-book"></i> Master - Lead Source </a>-->
                        <!--                            </li>-->
                        <!--                        --><?php //} ?><!--    -->

                    </ul>



                    <ul class="sub-menu" style="min-width: 160px;">
                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Administration - Master</span>

                        <?php $path = "master_branch_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_branch_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_branch_con/index'); ?>">
                                    <i class="fa fa-bookmark"></i> Branches </a>
                            </li>
                        <?php } ?>
                        <?php $path = "master_hall_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_hall_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_hall_con/index'); ?>">
                                    <i class="fa fa-bank"></i> Buildings </a>
                            </li>
                        <?php } ?>
                        <?php $path = "master_class_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_class_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/master_class_con/index'); ?>">
                                    <i class="fa fa-bank"></i> Halls </a>
                            </li>
                        <?php } ?>

                        <?php $path = "Master_departments_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_departments_con") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('master/Master_departments_con/index'); ?>">
                                    <i class="fa fa-bank"></i> Departments </a>
                            </li>
                        <?php } ?>

                        <?php $path = "Lead_con/lead_titles";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "lead_trans_reason") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/lead_titles'); ?>">
                                    <i class="fa fa-book"></i> Master - Lead Titles </a>
                            </li>
                        <?php } ?>

                          <?php $path = "Lead_con/meetup";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "lead_trans_reason") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/meetup'); ?>">
                                    <i class="fa fa-book"></i> Master - Lead Meetup Location </a>
                            </li>
                        <?php } ?>

                        <?php $path = "Lead_con/create_lead_source";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "create_lead_source") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/create_lead_source'); ?>">
                                    <i class="fa fa-book"></i> Lead Sources </a>
                            </li>
                        <?php } ?>   

                        <?php $path = "Lead_con/lead_trans_reason";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "lead_trans_reason") {  echo 'active'; } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_con/lead_trans_reason'); ?>">
                                    <i class="fa fa-book"></i> Master - Lead Transfer Reasons </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>
  <?php $groups=array('admin','department'); if ($this->ion_auth->in_group($groups)) { ?>
       <li class=" has-sub-menu">
           <a href="javascript:;">
               <div class="icon-w">
                   <div class="icon-settings"></div>
               </div>
               <span>Administration</span></a>
           <div class="sub-menu-w" style="left: auto;right: 0;">
               <div class="sub-menu-i">
                   <ul class="sub-menu">
                      <?php $path = "system_users/index";
                       if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                           <li class="<?php if ($this->uri->segment(2) == "system_users") {  echo 'active'; } ?>">
                               <a href="<?php echo base_url('settings/system_users/index'); ?>">
                                   <i class="fa fa-gear"></i> System Users </a>
                           </li>
                      <?php } ?>

                      <?php $path = "administration/hr_org_settings";
                       if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                           <li class="<?php if ($this->uri->segment(3) == "hr_org_settings") {  echo 'active'; } ?>">
                               <a href="<?php echo base_url('settings/administration/hr_org_settings'); ?>">
                                   <i class="fa fa-users"></i> Organization Info </a>
                           </li>
                      <?php } ?>


                      <?php $path = "administration/hr_admin_settings";
                       if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                           <li class="<?php if ($this->uri->segment(3) == "hr_admin_settings") {  echo 'active'; } ?>">
                               <a href="<?php echo base_url('settings/administration/hr_admin_settings'); ?>">
                                   <i class="fa fa-users"></i> Admin Settings </a>
                           </li>
                      <?php } ?>

                   </ul>
               </div>
           </div>
       </li>
  <?php } ?>
</ul>