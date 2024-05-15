<link rel="stylesheet"
    href="<?php echo base_url('assets/plugins/intl-tel-input-master/build/css/intlTelInput.css'); ?>" />
<style>

    #datatable1 tbody td {
        padding: 2px 5px;
    }
    #datatable1 .btn {
        margin-left: 0;
        margin-right: 5px;
        padding: 2px 5px;
    }
    ul, li {
        margin:0;
        padding:0;
        list-style-type:none;
    }

    form ul li {
        margin: 10px 20px;
    }

    .nav-tabs .nav-item {
        margin-bottom: 20px;
        margin-right: 0.4rem;
    }
    .error{
        color:#dc3545
    }
    .nav.smaller.nav-tabs .nav-link {
        padding: 0.2em 0.3em;
        font-size: 12px;
    }
    .sf-nav-subtext{
        display: none !important;
    }
    /* On Invalid */
    .selectpicker.is-invalid~.dropdown-toggle {
        border-color: #dc3545 !important;
        color: #dc3545 !important;
        outline: none !important;
    }

    .selectpicker.is-invalid~.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }

    /* On valid */
    .selectpicker.is-valid~.dropdown-toggle {
        border:2px solid #24b314 !important;
        color: #24b314 !important;
        outline: none !important;
    }

    .selectpicker.is-valid~.dropdown-toggle:focus {
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }

    .text-muted {
        text-transform: uppercase;
    }
    /*.modal-body {
        max-height: calc(200vh - 150px);
        overflow-y: scroll;
    }*/
    h4.sub-head {
        color: #fff;
        font-size: 14px;
        font-weight: 400;
        text-transform: uppercase;
        background: #ea252f;
        padding: 5px 10px;
    }
    .form-control{
        border: 2px solid #5a6ac4 !important;
    }
    .bootstrap-select > .dropdown-toggle {
        border: none;
    }
    .td_head_reg{
        background: #2c1765 !important;
        color: #fff !important;
    }
    .acc_head{
        border-bottom: 1px dashed;
        margin-top: 15px;
        background: #978b8b;
        padding: 5px;
        display: inline-block;
        color: #fff;
    }
    .acc_head_2 {
        border-bottom: 1px dashed;
        margin-top: 15px;
        background: #eaeaea;
        padding: 5px;
        color: #000;
    }
    .file-upload-wrapper {
        position: relative;
        width: 100%;
        height: 37px;
        border: 2px solid #5a6ac4;
    }
    .file-upload-wrapper:after {
        content: attr(data-text);
        font-size: 14px;
        position: absolute;
        top: 0;
        left: 0;
        background: #fff;
        padding: 4px 5px;
        display: block;
        width: calc(100% - 40px);
        pointer-events: none;
        z-index: 20;
        height: 33px;
        line-height: 33px;
        color: #999;
        border-radius: 5px 10px 10px 5px;
        font-weight: 300;
    }
    .file-upload-wrapper:before {
        content: 'Select        ';
        position: absolute;
        top: 0;
        right: 0;
        display: inline-block;
        height: 33px;
        background: #6a34af;
        color: #fff;
        font-weight: 700;
        z-index: 25;
        font-size: 12px;
        line-height: 33px;
        padding: 0 15px;
        text-transform: uppercase;
        pointer-events: none;
        border-radius: 0 5px 5px 0;
    }
    .file-upload-wrapper:hover:before {
        background: #4a368c;
    }
    .file-upload-wrapper input {
        opacity: 0;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 99;
        height: 33px;
        margin: 0;
        padding: 0;
        display: block;
        cursor: pointer;
        width: 100%;
    }




    .inputGroup {
        background-color: #fff;
        display: block;
        margin: 10px 0;
        position: relative;
    }
    .inputGroup label {
        padding: 4px 10px;
        width: 100%;
        display: block;
        text-align: left;
        color: #3c454c;
        cursor: pointer;
        position: relative;
        z-index: 2;
        -webkit-transition: color 200ms ease-in;
        transition: color 200ms ease-in;
        overflow: hidden;
    }
    .inputGroup label:before {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        content: "";
        background-color: #5562eb;
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%) scale3d(1, 1, 1);
        transform: translate(-50%, -50%) scale3d(1, 1, 1);
        -webkit-transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        transition: all 300ms cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0;
        z-index: -1;
    }
    .inputGroup label:after {
        width: 22px;
        height: 22px;
        content: "";
        border: 2px solid #d1d7dc;
        background-color: #fff;
        background-image: url("data:image/svg+xml,%3Csvg width='22' height='22' viewBox='0 0 22 22' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M5.414 11L4 12.414l5.414 5.414L20.828 6.414 19.414 5l-10 10z' fill='%23fff' fill-rule='nonzero'/%3E%3C/svg%3E ");
        background-repeat: no-repeat;
        background-position: 0px;
        border-radius: 50%;
        z-index: 2;
        position: absolute;
        right: 20px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        cursor: pointer;
        -webkit-transition: all 200ms ease-in;
        transition: all 200ms ease-in;
    }
    .inputGroup input:checked ~ label {
        color: #fff;
    }
    .inputGroup input:checked ~ label:before {
        -webkit-transform: translate(-50%, -50%) scale3d(56, 56, 1);
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
    }
    .inputGroup input:checked ~ label:after {
        background-color: #54e0c7;
        border-color: #54e0c7;
    }
    .inputGroup input {
        width: 22px;
        height: 22px;
        -webkit-box-ordinal-group: 2;
        order: 1;
        z-index: 2;
        position: absolute;
        right: 20px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        cursor: pointer;
        visibility: hidden;
    }
</style>
<script src="<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/intlTelInput.min.js'); ?>"></script>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Student</a></li>
                <li class="breadcrumb-item active">Student Details</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="element-wrapper">

            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Student Management</h4>
                <button href="javascript:;" type="button" class="btn btn-success pull-right" onclick="add_student()"><i class="fa fa-plus-circle"></i> Add New Student</button>
            </div>

            <div class="element-box">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" role="tab" href="#tab_r_1" data-toggle="tab"> Reject Students </a></li>
                    <li class="nav-item"><a class="nav-link" role="tab" href="#tab_r_2" data-toggle="tab"> Pending Students </a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane p-20 active" role="tabpanel" id="tab_r_1">
                        <div style="overflow-x: scroll">
                            <table id="student_reject_datatable" class="table table-striped table-bordered dt-responsive " style="width: 100%" cellspacing="0">
                                <thead style="background-color: #0e7eff;color: white;">
                                <tr>
                                    <th data-priority="0">#</th>
                                    <th data-priority="3">BATCH & Intake</th>
                                    <th data-priority="4">Program</th>
                                    <th data-priority="1">Course ID</th>
                                    <th data-priority="5">TITLE</th>
                                    <th data-priority="2">NAME</th>
                                    <th data-priority="8">ADDRESS</th>
                                    <th data-priority="6">PHONE</th>
                                    <th data-priority="7">NIC NUMBER</th>
                                    <th data-priority="8">Reject Note</th>
                                    <th style="width:200px">ACTION</th>
                                </tr>
                                <tr>
                                    <th data-priority="0"></th>
                                    <th data-priority="3"></th>
                                    <th data-priority="4"></th>
                                    <th data-priority="1"></th>
                                    <th data-priority="5"></th>
                                    <th data-priority="2"></th>
                                    <th data-priority="8"></th>
                                    <th data-priority="6"></th>
                                    <th data-priority="7"></th>
                                    <th data-priority="8"></th>
                                    <th style="width:200px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane p-20" role="tabpanel" id="tab_r_2">
                        <div style="overflow-x: scroll">
                            <table id="student_pending_datatable" class="table table-striped table-bordered dt-responsive " style="width: 100%" cellspacing="0">
                                <thead style="background-color: #0e7eff;color: white;">
                                <tr>
                                    <th data-priority="0">#</th>
                                    <th data-priority="3">BATCH & Intake</th>
                                    <th data-priority="4">Program</th>
                                    <th data-priority="1">Course ID</th>
                                    <th data-priority="5">TITLE</th>
                                    <th data-priority="2">NAME</th>
                                    <th data-priority="8">ADDRESS</th>
                                    <th data-priority="6">PHONE</th>
                                    <th data-priority="7">NIC NUMBER</th>
                                    <th style="width:200px">ACTION</th>
                                </tr>
                                <tr>
                                    <th data-priority="0"></th>
                                    <th data-priority="3"></th>
                                    <th data-priority="4"></th>
                                    <th data-priority="1"></th>
                                    <th data-priority="5"></th>
                                    <th data-priority="2"></th>
                                    <th data-priority="8"></th>
                                    <th data-priority="6"></th>
                                    <th data-priority="7"></th>
                                    <th style="width:200px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>

<!-- #################################################### Student Mangement ################################## -->
<!-- Photo Upload modal -->
<div class="modal fade" id="photo_upload_modal" role="dialog" style="z-index: 9999999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="photo-upload-title" style="color:#fff">Upload Student Photo</h4>
            </div>
            <div class="modal-body form">
                <div id="photo_upload_div" style="display: none">
                    <div class="alert alert-success fade in col-md-12">
                        <p class="success_message"></p>
                    </div>
                    <form action="" id="photo-upload-form" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div id="image_preview" class="col-md-offset-2 col-md-6">
                                <img style="text-align: center" id="previewing" src="<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>" class="img-responsive img-thumbnail" width="140px" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-body">
                                <div class="form-group" id="selectImage">
                                    <label class="col-md-12 col-md-offset-1">Select Student's photo</label>
                                    <div class="col-md-6" id="photoInput">
                                        <input name="photo" id="stuPhoto" class="form-control input-optional" type="file">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="photo_message"></div>
            </div>
            <div class="modal-footer custom-modal-footer">
                <button type="button" id="btnUploadPhoto" class="btn btn-success">Upload</button>
                <button type="button" id="btnExitModal" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<!-- View modal -->
<div class="modal fade " id="student_view_modal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 1350px!important;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h3 class="modal-title bold uppercase">Student Info</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2" style="">

                     
                        <div id="profile_picture_preview" class="thumbnail" style="width: 200px;">
                            <div id="profile_picture_div"></div>
                            <img id="profile_picture" class="img-responsive img-thumbnail" src="" style="width: 155px;"/>
                            <input type="hidden" id="stu_profile_picture_id" value="">
                        </div>
                      
                        <input type="button" value="Change Profile Picture" style="color: white;background-color: #8686b6;border: none;padding: 2px;margin-top: 4px;" onclick="open_photo_upload_modal(true,false)"> <br/>
                       
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="student_id" id="student_id" class="student_id">
                                <small class="text-muted">BATCH</small>
                                <h6 class="text-info-hr view_batch"></h6>
                                <small class="text-muted">Course ID</small>
                                <h6 class="text-info-hr view_student_id"></h6>
                                <small class="text-muted">NIC NUMBER</small>
                                <h6 class="text-info-hr view_st_nic_num"></h6>
                                <small class="text-muted">PASSPORT</small>
                                <h6 class="text-info-hr view_st_passport_num"></h6>
                                <small class="text-muted p-t-30 db">GENDER</small>
                                <h6 class="text-info-hr view_st_gender"></h6>
                                <small class="text-muted p-t-30 db">CIVIL STATUS</small>
                                <h6 class="text-info-hr view_st_marital_status"></h6>
                                <small class="text-muted p-t-30 db">AGE</small>
                                <h6 class="text-info-hr view_st_age"></h6>
                                <small class="text-muted p-t-30 db">BIRTHDAY</small>
                                <h6 class="text-info-hr view_st_birthday"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10" style="">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" role="tab" href="#personal_info" data-toggle="tab"> PERSONAL </a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" href="#academic_info" data-toggle="tab"> ACADEMIC </a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" href="#documents_info" data-toggle="tab"> DOCUMENTS </a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane p-20 active" role="tabpanel" id="personal_info">
                                <div class="card-body" style="margin-top: 20px">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3 b-r"><strong class="text-muted">TITLE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_title"></h6>
                                        </div>
                                        <div class="col-md-6 col-lg-9"><strong class="text-muted">FULL NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_full_name"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <strong class="text-muted">FIRST NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_f_name"></h6>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <strong class="text-muted">MIDDLE NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_m_name"></h6>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <strong class="text-muted">LAST NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_l_name"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">ADDRESS</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_current_address"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 "><strong class="text-muted">MOBILE PHONE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_phone_no"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 "><strong class="text-muted">HOME PHONE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_home_no"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">EMAIL</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_email"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">COUNTRY OF BIRTH:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_country_of_birth"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">CITIZENSHIP:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_citizenship"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">Sri Lankan Visa</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_valid_sl_visa"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">Type of Visa:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_visa_type"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">Visa expiry date:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_visa_exp_date"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 style="font-size: 16px; text-decoration: underline">EMPLOYMENT DETAILS</h5>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Designation:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_designation"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Official Address:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_office_address"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Telephone:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_office_phone"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">E-mail:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_office_email " ></h6>
                                        </div>
                                    </div>
                                    <hr>

                                    <h5 style="font-size: 16px; text-decoration: underline">COURSE DETAILS</h5>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Programe:</strong>
                                            <br>
                                            <h6 class="text-info-hr " id="view_programe"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r" ><strong class="text-muted">Batch Intake:</strong>
                                            <br>
                                            <h6 class="text-info-hr "  id="view_batch"></h6>
                                        </div>
 

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">University:</strong>
                                            <br>
                                            <h6 class="text-info-hr " id="view_university"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r" ><strong class="text-muted">Local Study Years:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_min_years_local"  id=""></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" role="tabpanel" id="academic_info">
                                <div class="tab-content tabcontent-border">
                                    <ul class="nav nav-tabs smaller" >
                                        <li class="nav-item gce_ol">
                                            <a class="nav-link active" data-toggle="tab" href="#tab_view_ol" >
                                                G.C.E. Ordinary Level
                                            </a>
                                        </li>
                                        <li class="nav-item gce_al" >
                                            <a class="nav-link" data-toggle="tab" href="#tab_view_al">
                                                G.C.E. Advanced Level
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab_view_hepq">
                                                Higher Education / Professional Qualifications
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab_view_ceq">
                                                Current Educational Qualification
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active gce_ol" id="tab_view_ol">
                                            <div class="row">


                                                <div class="col-sm-12 col-lg-12">
                                                    <table id="VIEW_ST_OL_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg">#</th>
                                                            <th class="td_head_reg">Year</th>
                                                            <th class="td_head_reg">School</th>
                                                            <th class="td_head_reg">Type</th>
                                                            <th class="td_head_reg">SUBJECT</th>
                                                            <th class="td_head_reg">GRADE</th>
                                                            <th class="td_head_reg"></th>
                                                        </thead>
                                                        <tbody id="VIEW_ST_OL_Table_tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane gce_al" id="tab_view_al">
                                            <div class="row">

                                                <div class="col-sm-12 col-lg-12">
                                                    <table id="VIEW_ST_AL_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg">#</th>
                                                            <th class="td_head_reg">Year</th>
                                                            <th class="td_head_reg">School</th>
                                                            <th class="td_head_reg">Type</th>
                                                            <th class="td_head_reg">SUBJECT</th>
                                                            <th class="td_head_reg">GRADE</th>
                                                            <th class="td_head_reg"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="VIEW_ST_AL_Table_tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_view_hepq">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <table id="VIEW_ST_HEPQ_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                            <th class="td_head_reg" style="width: 30%">Name of the University / Professional Body</th>
                                                            <th class="td_head_reg" style="width: 30%">Degree / Diploma Awarded</th>
                                                            <th class="td_head_reg" style="width: 15%">From</th>
                                                            <th class="td_head_reg" style="width: 15%">To</th>
                                                            <th class="td_head_reg"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="VIEW_ST_HEPQ_Table_tbody">
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_view_ceq">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">

                                                    <table id="VIEW_ST_CEQ_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                            <th class="td_head_reg" style="width: 30%">Name of the University / Professional Body</th>
                                                            <th class="td_head_reg" style="width: 30%">Degree / Diploma Awarding</th>
                                                            <th class="td_head_reg" style="width: 15%">From</th>
                                                            <th class="td_head_reg" style="width: 15%">To</th>
                                                            <th class="td_head_reg"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="VIEW_ST_CEQ_Table_tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" role="tabpanel" id="documents_info">
                                <div class="tab-content tabcontent-border">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12">

                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">
                                                    Copy of National Identity Card / Passport
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_nic_pp_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Copy of the Student Visa (For International Students only)
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_visa_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Copy of the Birth Certificate
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_bc_update" class="view_file_update_block"  style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row gce_ol">
                                                <label class="col-sm-6 col-form-label">Copy of the O/L Certificate

                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_ol_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div> -->

                                            <!-- <div class="form-group row gce_al">
                                                <label class="col-sm-6 col-form-label">Copy of the A/L Certificate
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_al_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Copies of the O/L Certificates </p>
                                            <table id="VIEW_ST_OL_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Documents</th>
                                                    <!-- <th class="td_head_reg"></th> -->
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_OL_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Copies of the A/L Certificates </p>
                                            <table id="VIEW_ST_AL_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Documents</th>
                                                    <!-- <th class="td_head_reg"></th> -->
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_AL_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Higher Education / Professional Qualification Files </p>
                                            <table id="VIEW_ST_HEPQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Documents</th>
                                                    <!-- <th class="td_head_reg"></th> -->
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_HEPQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Current Educational Qualification Files </p>
                                            <table id="VIEW_ST_CEQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Documents</th>
                                                    <!-- <th class="td_head_reg"></th> -->
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_CEQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="discount_register_model" role="dialog">
    <div class="modal-dialog modal-full" style="max-width: 500px">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="modal-title bold uppercase" style="height:10px"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="salary_advance" class="form-horizontal">
                    <input type="hidden" id="dis_student_id" name="dis_student_id"/>
                    <input type="hidden" id="max_discount" name="max_discount"/>
                    <div class="form-body" style="padding: 0px 10px;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label col-md-4" >Max Discount:</label>
                                   <label class="form-control  col-md-8" id="dis_amount" style="text-align: right"></label>
                                    <input type="hidden" id="max_dis_amount">
                                    <input type="hidden" id="total_dis_amount">
                                    <input type="hidden" id="paid_total_marketing_discount">
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4" >Discount Amount:</label>
                                    <input type="text" id="discount_amount" class="form-control col-md-8" style="text-align: right">
                                    <span class="error-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap modal -->
<div class="modal fade" id="student_status_model" role="dialog">
    <div class="modal-dialog modal-full" style="max-width: 500px">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="modal-title bold uppercase" style="height:10px"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="student_status_form" class="form-horizontal">
                    <input type="hidden" id="status_student_id" name="status_student_id"/>
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="form-body" style="padding: 0px 10px;">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-6 col-form-label">
                                        Qualified Status
                                    </label>
                                    <div class="col-sm-6">
                                        <div class="form-check inputGroup">
                                            <input class="form-check-input" onclick="javascript:yesnoCheck2();"  name="st_qualified_status" type="radio" id="option_yes_q" value="YES">
                                            <label class="form-check-label" for="option_yes_q">YES</label>
                                        </div>
                                        <div class="form-check  inputGroup">
                                            <input class="form-check-input"  onclick="javascript:yesnoCheck2();"  name="st_qualified_status" type="radio" id="option_no_q"  value="NO">
                                            <label class="form-check-label" for="option_no_q">NO</label>
                                        </div>
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div id="st_qualified_status_yes" style="display: none">

                                </div>
                                <div id="st_qualified_status_no" style="display: none">

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveStuStatus" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!--Student Add/Edit modal -->

<div class="modal fade" id="student_form_modal" role="dialog">
    <div class="modal-dialog modal-full"  style="max-width: 1200px!important;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="modal-title bold uppercase"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form id="student_form" class="form-material" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="std_id" id="std_id">
                            <fieldset>
                                <legend>PROGRAM INFORMATION</legend>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <input type="hidden" name="application_id" id="application_id" value="">
                                            <label for="">Program :</label>
                                            <select name="program" id="program" class="selectpicker"  data-live-search="true"   data-parsley-group="block0" required  data-parsley-required data-parsley-errors-container="#programError" data-container="body"  data-parsley-error-message="Program is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                                <option value="">-- Select --</option>
                                                <?php
                                                foreach ($programs as $program) {
                                                    echo '<option value="' . $program->id . '">' . $program->name . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <span id="programError" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Batch & Intake :</label>
                                            <select name="batch" id="batch" class=" selectpicker"  data-live-search="true" data-parsley-group="block0" required  data-parsley-required data-parsley-errors-container="#batchError" data-container="body"  data-parsley-error-message="Batch is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            </select>
                                            <span id="batchError" class="error"></span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">University :</label>
                                            <select name="university" id="university" class=" selectpicker"  data-live-search="true" data-parsley-group="block0" required  data-parsley-required data-parsley-errors-container="#universityError" data-container="body"  data-parsley-error-message="University is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            </select>
                                            <span id="universityError" class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6">
                                        <div id="uni_path_data" class="form-group" style="display: none">
                                            <label for="">Study Years ( Local ) : - Minimum Years <span id="min_years_local"><strong></strong></span></label>
                                            <div id="sty_local_data">

                                            </div>

                                            <!--<span id="batchError" class="error"></span>-->
                                        </div>
                                    </div>

                                </div>
                            </fieldset>

                    <fieldset>
                        <legend>PART A: PERSONAL INFORMATION</legend>
                        <div  id="personal_details">
                            <div class="row">
                                <div class="col-sm-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Title:</label>
                                        <select name="st_title" id="st_title" class="form-control selectpicker" data-parsley-group="block1" required data-parsley-required data-parsley-errors-container="#titleError" data-container="body"  data-parsley-error-message="Title is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            <option value="">-- Select --</option>
                                            <option value="Rev">Rev</option>
                                            <option value="Mr">Mr.</option>
                                            <option value="Ms">Ms.</option>
                                            <option value="Mrs">Mrs.</option>
                                            <option value="Dr">Dr.</option>
                                        </select>
                                        <span id="titleError" class="error"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">First Name:</label>
                                        <input type="text" class="form-control" name="st_f_name" id="st_f_name" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Middle Name:</label>
                                        <input type="text" class="form-control" name="st_m_name" id="st_m_name">
                                        <span class="error"></span>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Last Name:</label>
                                        <input type="text" class="form-control" name="st_l_name" id="st_l_name" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-sm-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Gender:</label>
                                        <select name="st_gender" id='st_gender' class="form-control  selectpicker" data-parsley-group="block1" required data-parsley-required data-parsley-errors-container="#genderError" data-container="body"  data-parsley-error-message="Gender is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            <option value="">-- Select --</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <span id="genderError" class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-10">
                                    <div class="form-group">
                                        <label for="">Full Name (as per NIC/ Passport):</label>
                                        <input type="text" class="form-control" name="st_full_name" id="st_full_name" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">NIC Number:</label>
                                        <input type="text" class="form-control" name="st_nic_num" id="st_nic_num">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Passport Number:</label>
                                        <input type="text" class="form-control" name="st_passport_num" id="st_passport_num">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Birthday:</label>
                                        <input type="text" class="form-control date" placeholder="Date" data-date-format="yyyy-mm-dd" name="st_birthday" id="st_birthday" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-error-message="Birthday is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Age:</label>
                                         <input type="text" class="form-control" name="st_age" id="st_age" readonly>
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-2">
                                    <div class="form-group">
                                        <label for="">Civil Status:</label>
                                        <select name="st_marital_status" id="st_marital_status" class="form-control selectpicker" data-parsley-group="block1" required data-parsley-required data-parsley-errors-container="#CivilStatusError" data-container="body"  data-parsley-error-message="Civil Status is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            <option value="">-- Select --</option>
                                            <option value="Married">Married</option>
                                            <option value="Single">Single</option>
                                        </select>
                                        <span id="CivilStatusError" class="error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Permanent Address:</label>
                                        <textarea rows="1" class="form-control" name="st_current_address" id="st_current_address" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-error-message="Permanent Address is required" data-parsley-trigger-after-failure="focusout changed.bs.select"></textarea>
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Telephone No. (Mobile):</label>
                                        <input type="number" class="form-control" style="width: 271px;" name="st_phone_no" id="st_phone_no" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-type="digits" >
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Telephone No. (Residence):</label>
                                        <input type="number" class="form-control" style="width: 271px;" name="st_home_no" id="st_home_no" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-type="digits" >
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">Personal Email:</label>
                                        <input type="email" class="form-control" name="st_email" id="st_email" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group">
                                        <label for="">School Email:</label>
                                        <input type="email" class="form-control" name="st_email_school" id="st_email_school">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                 
                            </div>
                        </div>
                    </fieldset>
                    

                    <fieldset>
                        <legend>PART B: RESIDENCY AND OTHER DETAILS</legend>
                        <div  id="residency_info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Country of Birth:</label>
                                        <input type="text" class="form-control" name="st_country_of_birth" id="st_country_of_birth" data-parsley-group="block2" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Citizenship:</label>
                                        <input type="text" class="form-control" name="st_citizenship" id="st_citizenship" data-parsley-group="block2" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                 
                            </div>
                            <p style="border-bottom: 1px solid #2c1765;">For International Students</p>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group row">
                                        <label class="col-sm-6 col-form-label">Do you hold a valid Sri Lankan Visa:</label>
                                        <div class="col-sm-6">
                                            <div class="form-check  inputGroup">
                                                <input class="form-check-input" onclick="javascript:yesnoCheck();" name="st_valid_sl_visa" type="radio" id="option_yes" value="YES">
                                                <label class="form-check-label" for="option_yes">YES</label>
                                            </div>
                                            <div class="form-check  inputGroup">
                                                <input class="form-check-input" onclick="javascript:yesnoCheck();"  name="st_valid_sl_visa" type="radio" id="option_no"  value="NO">
                                                <label class="form-check-label" for="option_no">NO</label>
                                            </div>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group type_visa" style="display: none"  >
                                        <label for="">Type of Visa:</label>
                                        <select name="st_visa_type" id="st_visa_type" class="form-control selectpicker">
                                         <option value="">Select Type of Visa</option>
                                         <option>PR</option>
                                         <option>Student</option>
                                         <option>Visit</option>
                                         <option>Work</option>
                                         </select>
                                        
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group type_visa" style="display: none" >
                                        <label for="">Visa expiry date:</label>
                                        <input type="text"  name="st_visa_exp_date" id="st_visa_exp_date" class="form-control date-pick date" placeholder="Date" data-date-format="yyyy-mm-dd">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>PART C: EMPLOYMENT DETAILS</legend>
                        <div  id="employment_info">
                            <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Company Name:</label>
                                        <input type="text" class="form-control" name="st_emp_company_name" id="st_emp_company_name">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Designation:</label>
                                        <input type="text" class="form-control" name="st_emp_designation" id="st_emp_designation">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Official Address:</label>
                                        <textarea rows="1" class="form-control" name="st_emp_office_address" id="st_emp_office_address"></textarea>
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">Telephone:</label>
                                        <input type="number" class="form-control" style="width: 560px;" name="st_emp_office_phone" id="st_emp_office_phone" data-parsley-group="block3"  data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">E-mail:</label>
                                        <input type="email" class="form-control" name="st_emp_office_email" id="st_emp_office_email" data-parsley-group="block3">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>PART D: ACADEMIC QUALIFICATION</legend>
                        <div  id="academic_info">
                            <ul class="nav nav-tabs smaller">
                                <li class="nav-item gce_ol">
                                    <a class="nav-link active" data-toggle="tab" href="#tab_ol" >
                                        G.C.E. Ordinary Level
                                    </a>
                                </li>
                                <li class="nav-item gce_al" >
                                    <a class="nav-link" data-toggle="tab" href="#tab_al">
                                        G.C.E. Advanced Level
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_hepq">
                                        Higher Education / Professional Qualifications
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tab_ceq">
                                        Current Educational Qualification
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active gce_ol" id="tab_ol">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Year</label>
                                                <input type="text" name="st_ol_year" id="st_ol_year" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">School Attended:
                                                </label>
                                                <input type="text" name="st_attended_school" id="st_attended_school" class="form-control" >
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Type</label>
                                                <select name="st_ol_type" id="st_ol_type" class="form-control selectpicker">
                                                </select>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Subject</label>
                                                <input type="text" name="st_ol_subject" id="st_ol_subject" class="form-control">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Grade</label>
                                                <input type="text" name="st_ol_grade" id="st_ol_grade" class="form-control" >
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <a id="add_ST_OL_Table" style="margin-top: 24px;" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>



                                        <div class="col-sm-12 col-lg-12">
                                            <table id="ST_OL_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg" >#</th>
                                                    <th class="td_head_reg" >School</th>
                                                    <th class="td_head_reg" >Year</th>
                                                    <th class="td_head_reg" >Type</th>
                                                    <th class="td_head_reg" >SUBJECT</th>
                                                    <th class="td_head_reg" >GRADE</th>
                                                    <th class="td_head_reg" ></th>
                                                </tr>
                                                </thead>
                                                <tbody id="ST_OL_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane gce_al" id="tab_al">
                                    <div class="row">

                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Year</label>
                                                <input type="text" name="st_al_year" id="st_al_year" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">School Attended:
                                                </label>
                                                <input type="text" name="al_st_attended_school" id="al_st_attended_school" class="form-control" >
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Type</label>
                                                <select name="st_al_type" id="st_al_type" class="form-control selectpicker">
                                                </select>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Subject</label>
                                                <input type="text" name="f" id="st_al_subject" class="form-control">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Grade</label>
                                                <input type="text" name="st_al_grade" id="st_al_grade" class="form-control" >
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-4">
                                            <div class="form-group">
                                                <a id="add_ST_AL_Table" style="margin-top: 24px;" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-sm-12 col-lg-12">
                                            <table id="ST_AL_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg" >#</th>
                                                    <th class="td_head_reg" >School</th>
                                                    <th class="td_head_reg" >Year</th>
                                                    <th class="td_head_reg" >Type</th>
                                                    <th class="td_head_reg" >SUBJECT</th>
                                                    <th class="td_head_reg" >GRADE</th>
                                                    <th class="td_head_reg" ></th>

                                                </tr>
                                                </thead>
                                                <tbody id="ST_AL_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_hepq">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <table id="ST_HEPQ_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                    <th class="td_head_reg" style="width: 30%">Name of the University / Professional Body</th>
                                                    <th class="td_head_reg" style="width: 30%">Degree / Diploma Awarded</th>
                                                    <th class="td_head_reg" style="width: 15%">From</th>
                                                    <th class="td_head_reg" style="width: 15%">To</th>
                                                    <th class="td_head_reg" ><a id="add_ST_HEPQ_Table" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a></th>
                                                </tr>
                                                </thead>
                                                <tbody id="ST_HEPQ_Table_tbody">
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_ceq">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12">

                                            <table id="ST_CEQ_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                    <th class="td_head_reg" style="width: 30%">Name of the University / Professional Body</th>
                                                    <th class="td_head_reg" style="width: 30%">Degree / Diploma Awarding</th>
                                                    <th class="td_head_reg" style="width: 15%">From</th>
                                                    <th class="td_head_reg" style="width: 15%">To</th>
                                                    <th class="td_head_reg" ><a id="add_ST_CEQ_Table" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a></th>
                                                </tr>
                                                </thead>
                                                <tbody id="ST_CEQ_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>PART E: PERSON TO BE CONTACTED IN A CASE OF EMERGENCY</legend>
                        <div  id="emergency_info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Name of Respondent</label>
                                        <input type="text" name="st_emergency_r_name" id="st_emergency_r_name" class="form-control" data-parsley-group="block5" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select"  data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Relationship with Respondent</label>
                                        <select name="st_emergency_r_relation" id="st_emergency_r_relation" class="form-control selectpicker"  data-parsley-group="block5" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-errors-container="#RwithRError" >
                                            <option value="">-- Select --</option>
                                            <option value="mother">Mother</option>
                                            <option value="father">Father</option>
                                            <option value="sister">Sister</option>
                                            <option value="brother">Brother</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <span id="RwithRError" class="error"></span>
                                    </div>
                                </div>


                                    <div class="col-sm-6 col-lg-4" >
                                        <div class="form-group">
                                            <div id="emergency_others_details">
                                                <label for="">Other Details</label>
                                                <input type="text" name="st_emergency_r_other_details" id="st_emergency_r_other_details" class="form-control"  data-parsley-group="block5"  data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select"  data-parsley-pattern="^[a-zA-Z\s]*$">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Occupation of Respondent</label>
                                        <input type="text" name="st_emergency_r_occupation" id="st_emergency_r_occupation" class="form-control"  data-parsley-group="block5"  data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select"  data-parsley-pattern="^[a-zA-Z\s]*$">
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Contact Number</label>
                                        <input type="number" name="st_emergency_r_no" style="width: 365px;" id="st_emergency_r_no" class="form-control"  data-parsley-group="block5" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10" >
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Office Contact No</label>
                                        <input type="number" name="st_emergency_r_off_no" style="width: 365px;" id="st_emergency_r_off_no" class="form-control" data-parsley-group="block5"  data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select"  data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10">
                                        <span class="error"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Email Address</label>
                                        <input type="email" name="st_emergency_r_email" id="st_emergency_r_email" class="form-control" data-parsley-group="block5"  data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>PART F: AWARENESS ON IIHS PROGRAMMES</legend>
                        <div  id="awareness_info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="">How did you get to know about our Programmes? (Select from the followings)</label>
                                        <select  onclick="javascript:knowProgrammes();" name="st_know_programmes" id="st_know_programmes" class="form-control selectpicker"  data-live-search="true" data-parsley-group="block6" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-errors-container="#KPError" >
                                            <option value=""></option>
                                            <option value="Agent">Agent</option>
                                            <option value="Advertising Boards at IIHS">Advertising Boards at IIHS</option>
                                            <option value="Brochures">Brochures</option>
                                            <option value="Banners/Posters">Banners/Posters</option>
                                            <option value="Education Fair/Exhibition">Education Fair/Exhibition</option>
                                            <option value="E-mail">E-mail</option>
                                            <option value="E-ads">E-ads</option>
                                            <option value="Google">Google</option>
                                            <option value="IIHS Student">IIHS Student</option>
                                            <option value="IIHS Website">IIHS Website</option>
                                            <option value="Newspaper advertisements">Newspaper advertisements</option>
                                            <option value="Radio">Radio</option>
                                            <option value="TV programmes/Commercials">TV programmes/Commercials</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span id="KPError" class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div id="other_know" class="form-group" style="display: none"  >
                                        <label for=other_know"">If others, please specify:</label>
                                        <input type="text" class="form-control" name="st_know_programme_other" id="st_know_programme_other">
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                            <fieldset>
                                <legend>PART G: PREVIOUS VISA APPLICATION</legend>
                                <div  id="visa_application">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-sm-9 col-form-label">Have you / your spouse ever applied for any type of visa/for PR in another country?</label>
                                            <div class="col-sm-3">
                                                <div class="form-check inputGroup">
                                                    <input class="form-check-input" onclick="javascript:yesnoCheck1();" name="st_type_visa_another_country" type="radio" id="option_yes_1" value="YES">
                                                    <label class="form-check-label" for="option_yes_1">YES</label>
                                                </div>
                                                <div class="form-check inputGroup">
                                                    <input class="form-check-input" onclick="javascript:yesnoCheck1();"  name="st_type_visa_another_country" type="radio" id="option_no_1"  value="NO">
                                                    <label class="form-check-label" for="option_no_1">NO</label>
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="type_visa_1" style="display: none"  >

                                            <table id="ST_VAC_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                    <th class="td_head_reg" style="width: 18%">Name of the Applicant</th>
                                                    <th class="td_head_reg" style="width: 18%">Country</th>
                                                    <th class="td_head_reg" style="width: 18%">Year</th>
                                                    <th class="td_head_reg" style="width: 18%" >Type of Visa (PR/ Student/Visit/Work)</th>
                                                    <th class="td_head_reg" style="width: 18%" >Granted/Refused/Pending</th>
                                                    <th class="td_head_reg" ><a id="add_ST_VAC_Table" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a></th>
                                                </tr>
                                                </thead>
                                                <tbody id="ST_VAC_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group type_visa_1" style="display: none" >
                                            <label for="">If your / your spouse's visa / PR application has been refused before, please indicate the reasons for that.
                                            </label>
                                            <textarea rows="3" class="form-control" name="st_visa_r_reason" id="st_visa_r_reason"></textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                            </fieldset>

                            <fieldset>
                                <legend>PART H: FINANCIAL SUPPORT</legend>
                                <div  id="financial_info">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-sm-9 col-form-label">Are you and your sponsors aware of the visa regulations and funding requirements for the program in concern?
                                            </label>
                                            <div class="col-sm-3">
                                                <div class="form-check inputGroup">
                                                    <input class="form-check-input" name="st_fs_aware" type="radio" id="option_yes_2" value="YES">
                                                    <label class="form-check-label" for="option_yes_2">YES</label>
                                                </div>
                                                <div class="form-check inputGroup">
                                                    <input class="form-check-input" name="st_fs_aware" type="radio" id="option_no_2"  value="NO">
                                                    <label class="form-check-label" for="option_no_2">NO</label>
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group type_visa_1" style="display: none" >
                                            <label for="">Who will be providing you the financial support?
                                            </label>
                                            <input name="st_fs_name" id="st_fs_name" class="form-control">
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div id="pathway_option" class="form-group" style="display: none" >
                                            <label for="">Please provide a summary of your financial support for the duration of studies in the local as well as international context (Applicable for the Pathway Programs only)
                                            </label>
                                            <textarea rows="3" class="form-control" name="st_fs_summary_pathway" id="st_fs_summary_pathway"></textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <div class="form-group" >
                                            <label for="">Counselor's Remarks:
                                            </label>
                                            <textarea rows="3" class="form-control" name="st_fs_remarks" id="st_fs_remarks"></textarea>
                                            <span class="error"></span>
                                        </div>
                                    </div>
                                </div>
                                    </
                            </fieldset>

                            <fieldset>
                                <legend>Documentation Checklist for Registration</legend>
                                <div  id="checklist_info">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-4">

                                        <div class="thumbnail" style="width: 200px;">
                                            <img id="student_photo" class="img-responsive img-thumbnail" src="<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>" style="width: 155px;"/>
                                        </div><input type="file" name="st_photo" id="st_photo" class="form-control" >
                                        <span id="st_photo_update" class="file_update_block" style="display: inline-block; width: 100%;"></span>
                                    </div>

                                    <div class="col-sm-12 col-lg-8">

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">
                                                Copy of National Identity Card / Passport
                                            </label>
                                            <div class="col-sm-6">
                                                <span id="st_file_nic_pp_update" class="file_update_block" style="display: inline-block; width: 100%;"></span>
                                                <div class="file-upload-wrapper" data-text="Select your file!">
                                                    <input id="st_file_nic_pp" name="st_file_nic_pp" type="file" class="file-upload-field" value="">
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Copy of the Student Visa (For International Students only)
                                            </label>
                                            <div class="col-sm-6">
                                                <span id="st_file_visa_update" class="file_update_block" style="display: inline-block; width: 100%;"></span>
                                                <div class="file-upload-wrapper" data-text="Select your file!">
                                                    <input id="st_file_visa" name="st_file_visa" type="file" class="file-upload-field" value="">
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-6 col-form-label">Copy of the Birth Certificate

                                            </label>
                                            <div class="col-sm-6">
                                                <span id="st_file_bc_update" class="file_update_block"  style="display: inline-block; width: 100%;"></span>
                                                <div class="file-upload-wrapper" data-text="Select your file!">
                                                    <input id="st_file_bc" name="st_file_bc" type="file" class="file-upload-field" value="">
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group row gce_ol">
                                            <label class="col-sm-6 col-form-label">Copy of the O/L Certificate

                                            </label>
                                            <div class="col-sm-6">
                                                <span id="st_file_ol_update" class="file_update_block" style="display: inline-block; width: 100%;"></span>
                                                <div class="file-upload-wrapper" data-text="Select your file!">
                                                    <input id="st_file_ol" name="st_file_ol" type="file" class="file-upload-field" value="">
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div> -->

                                        <!-- <div class="form-group row gce_al">
                                            <label class="col-sm-6 col-form-label">Copy of the A/L Certificate

                                            </label>
                                            <div class="col-sm-6">
                                                <span id="st_file_al_update" class="file_update_block" style="display: inline-block; width: 100%;"></span>
                                                <div class="file-upload-wrapper" data-text="Select your file!">
                                                    <input id="st_file_al" name="st_file_al" type="file" class="file-upload-field" value="">
                                                </div>
                                                <span class="error"></span>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>

                                <!-- <div class="row">
                                    <div class="col-sm-12 col-lg-12">

                                        <p class="acc_head_2">Relevant Professional Qualifications </p>

                                        <table id="ST_RPQ_Files_Table" class="df"  style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th class="td_head_reg" >#</th>
                                                <th class="td_head_reg" >Document</th>
                                                <th class="td_head_reg" ><a id="add_ST_RPQ_Files_Table" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a></th>
                                            </tr>
                                            </thead>
                                            <tbody id="ST_RPQ_Files_Table_tbody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div> -->
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                    
                                        <p class="acc_head_2"> Copies of the O/L Certificates </p>

                                        <table id="ST_OL_Files_Table" class="df"  style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th class="td_head_reg" >#</th>
                                                <th class="td_head_reg" >Document</th>
                                                <th class="td_head_reg" ><a id="add_ST_OL_Files_Table" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a></th>
                                            </tr>
                                            </thead>
                                            <tbody id="ST_OL_Files_Table_tbody">
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">

                                        <p class="acc_head_2"> Copies of the A/L Certificates </p>

                                        <table id="ST_AL_Files_Table" class="df"  style="width: 100%">
                                            <thead>
                                            <tr>
                                                <th class="td_head_reg" >#</th>
                                                <th class="td_head_reg" >Document</th>
                                                <th class="td_head_reg" ><a id="add_ST_AL_Files_Table" href="#" class="btn btn-success btn-small"><i class="fa fa-plus"></i></a></th>
                                            </tr>
                                            </thead>
                                            <tbody id="ST_AL_Files_Table_tbody">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>




                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Higher Education / Professional Qualification Files </p>
                                            <table id="ST_HEPQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Document</th>
                                                    <th class="td_head_reg"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="ST_HEPQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Current Educational Qualification Files </p>
                                            <table id="ST_CEQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Document</th>
                                                    <th class="td_head_reg"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="ST_CEQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    </div>
                            </fieldset>
                </form>
            </div>

            <!--<div class="modal-footer">
                <button type="button" id="btnSaveStd" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>-->
        </div>
    </div>
</div>
<script>
                    var phoneInputField1 = document.querySelector("#st_phone_no");
                    var phoneInput1 = window.intlTelInput(phoneInputField1, {
                        utilsScript: "<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/utils.js'); ?>",
                    });

                    var phoneInputField1 = document.querySelector("#st_home_no");
                    var phoneInput1 = window.intlTelInput(phoneInputField1, {
                        utilsScript: "<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/utils.js'); ?>",
                    });

                    var phoneInputField1 = document.querySelector("#st_emp_office_phone");
                    var phoneInput1 = window.intlTelInput(phoneInputField1, {
                        utilsScript: "<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/utils.js'); ?>",
                    });

                    var phoneInputField1 = document.querySelector("#st_emergency_r_no");
                    var phoneInput1 = window.intlTelInput(phoneInputField1, {
                        utilsScript: "<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/utils.js'); ?>",
                    });

                    var phoneInputField1 = document.querySelector("#st_emergency_r_off_no");
                    var phoneInput1 = window.intlTelInput(phoneInputField1, {
                        utilsScript: "<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/utils.js'); ?>",
                    });
</script>
<script>
    var emergency_others_details = document.getElementById("emergency_others_details");
    emergency_others_details.style.display = "none";

    $('#st_emergency_r_relation').change(function () {
        var ra = $(this).val();
        if (ra=="other"){
            emergency_others_details.style.display = "block";
        }else{
            emergency_others_details.style.display = "none";
        }
    });
</script>
<script>

    //register
    //commnedted by JE 2020_05_27 for add reg form end
    ///*function validate_data(id)
    //{
    //    $('#dis_student_id').val(id);
    //    $('#dis_amount').html('');
    //
    //    $.ajax({
    //        url: "<?php //echo site_url('students/students_con/get_max_discount');?>//",
    //        type: "POST",
    //        "data": {
    //            "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//",
    //            "student_id": id,
    //        }, dataType: "JSON",
    //        success: function (data) {
    //
    //            $('#dis_amount').html(data.disc_data.max_marketing_discount);
    //            $('#dis_amount').val(parseFloat(data.disc_data.max_marketing_discount));
    //        }
    //    });
    //
    //    $('#discount_register_model').modal({backdrop: 'static', keyboard: false});
    //    $('#discount_register_model .modal-title').text('Assign Discount Amount');
    //}*/

        $("#btnSave").on('click', function(e){
            e.preventDefault();
            var stu_record = $('#dis_student_id').val();
            save_discount(stu_record);
        });

        $("#btnSaveStuStatus").on('click', function(e){
            e.preventDefault();
            save_student_status();
        });



    function save_discount(id)
    {

       var disc_amount=$('#discount_amount').val();
       var max_dis_amount=$('#max_dis_amount').val();
       var total_dis_amount=$('#total_dis_amount').val();
       var paid_total_marketing_discount=$('#paid_total_marketing_discount').val();

        var new_dis_to_be_paid_amount  = parseFloat(disc_amount)+parseFloat(paid_total_marketing_discount);



        if(parseFloat(new_dis_to_be_paid_amount)>=parseFloat(total_dis_amount)) {
            bootbox.alert('Maximum Discount Total Amount Exceed Per Plan');
            return false;
        }

        if(parseFloat(disc_amount)>=parseFloat(max_dis_amount)) {

            bootbox.dialog({
                message: "Are you sure, that you want to Validate this record?",
                title: "Alert!",
                buttons: {
                    ok: {
                        label: "Yes",
                        className: "btn-primary",
                        callback: function () {
                            $.ajax({
                                url: "<?php echo base_url()?>students/students_con/validate_student",
                                type: "POST",
                                data: {
                                    "record_id": id, "disc_amount": disc_amount, "new_dis_to_be_paid_amount": new_dis_to_be_paid_amount,
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                dataType: "JSON",
                                success: function (data) {
                                    $('#discount_register_model').modal('hide');
                                    reload_table(student_reject_datatable);
                                    reload_table(student_pending_datatable);
                                    bootbox.alert(data.message);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                    console.log('Error while Update record');
                                }
                            });
                        }
                    },
                    cancel: {
                        label: "No",
                        className: "btn-default"
                    }
                }
            });
        }else{

            bootbox.alert('Maximum Discount Amount Per Student is Exceed');
        }
    }

</script>

<script type="text/javascript">

    $('#program').change(function () {
        $('#university').empty();
        $('#uni_path_data').hide();
        $('#pathway_option').hide();
        $("#st_min_years_local").empty();
        $("#min_years_local").html('');
        var program_id = $('#program').val();
        var application='';
        //$('#university').html('<option value="">(---)</option>');
        $.ajax({
            async: false,
            url: "<?php echo site_url('students/students_con/get_programe_id'); ?>",
            type: "POST",
            data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash() ?>",
                "program_id": program_id
            },
            dataType: "JSON",
            success: function(data)
            {
                // console.log(data);

                application = data.program_details.application_type;
                $('#application_id').val(data.program_details.application_type);


                $('#batch').html('<option value="">(---)</option>');
                for(var b=0;b<data.batch_details.length;b++){
                    $('#batch').append('<option value="'+data.batch_details[b].id+','+data.batch_details[b].intake_id+'">('+data.batch_details[b].batch_code+') '+data.batch_details[b].intake_name+'-'+data.batch_details[b].year+'</option>');
                }
                $('.selectpicker').selectpicker('refresh');
                $('#university').html('<option value="">(---)</option>');
                for(var i=0;i<data.program_uni_data.length;i++){
                    $('#university').append('<option value="'+data.program_uni_data[i].university_id+'">'+data.program_uni_data[i].name+'</option>');
                }
                $('.selectpicker').selectpicker('refresh');

            }
        });

        if(application==3 || application==6 || application==4){
            $('.gce_ol').hide();
            $('.gce_al').hide();
        }else if(application==5 || application==2){
            $('.gce_ol').hide();
        }
    });


    $('#university').change(function(){
        var program=document.getElementById("program").value;
        console.log(program);
        $.ajax({
            url: "<?php echo base_url('students/students_con/get_university_data_by_uni_id'); ?>",
            type: "POST",
            dataType: "JSON",
            data:{
                university:$(this).val(),
                program:program,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(data){

                if(data.uni_details.uni_type=="Pathway"){
                    $('#uni_path_data').show();
                    $('#pathway_option').show();

                    $('#min_years_local').html(data.uni_details.local_st_val);

                    $('#sty_local_data').html('<input type="number" class="form-control" name="st_min_years_local" id="st_min_years_local" data-parsley-group="block0" required data-parsley-required data-container="body"  min="'+data.uni_details.local_st_val+'" data-parsley-type="digits" data-parsley-maxlength="2"  data-parsley-trigger-after-failure="focusout changed.bs.select" value="" style="width: 80px">');
                }else{
                    // alert(data.uni_details.uni_type);
                }

                // for(var i=0;i<data.uni_details.length;i++){
                //
                // }

            },
            error:function (jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });



    var student_reject_datatable;
    var student_pending_datatable;
    var save_method;
    var sfw;
    var counter_st_ol;
    var counter_st_al;
    var counter_st_hepq;
    var counter_st_ceq;
    var counter_st_vac;
    var counter_st_rpq;


    function academic_types(){
        $.ajax({
            url: "<?php echo base_url('students/students_con/get_academic_types');?>",
            type: "POST",
            dataType: "JSON",
            data:{
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(data){

                $('#st_ol_type').html('<option value="">--Select Type--</option>');
                for(var i=0;i<data.academic_types.length;i++){
                    $('#st_ol_type').append('<option>'+data.academic_types[i].type_name+'</option>');
                }
                $('#st_al_type').html('<option value="">--Select Type--</option>');
                for(var i=0;i<data.academic_types.length;i++){
                    $('#st_al_type').append('<option>'+data.academic_types[i].type_name+'</option>');
                }
                $('.selectpicker').selectpicker('refresh');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                bootbox.alert(textStatus + " : " + errorThrown);
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

    function add_student_status(std_id)
    {
        $('#student_status_form')[0].reset();

        $("#st_qualified_status_yes").css('display','none');
        $("#st_qualified_status_no").css('display','none');

        $("#option_no_q").prop('value','NO');
        $("#option_yes_q").prop('value','YES');

        $.ajax({
            url : "<?php echo site_url('students/students_con/edit_student')?>/" + std_id,
            type: "GET",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {
                $('#status_student_id').val(std_id);

                //TODO get edit values

                $('.selectpicker').selectpicker('refresh');

                if ( data.students_info.st_qualified_status == "YES") {
                    $("#option_yes_q").prop("checked", true);
                    //$("#option_no_q").prop("checked", false);
                    $("#st_qualified_status_yes").css('display', 'block');
                    $("#st_qualified_status_no").css('display', 'none');

                    $('#st_qualified_status_yes').html('<label>RPL Note</label><textarea rows="1" class="form-control" name="st_qualified_status_note" id="st_qualified_status_note" data-parsley-group="block10">'+data.students_info.st_qualified_status_note+'</textarea><hr><label style="font-size: 16px;font-weight: bold;">Custom Plan Discount - </label> <input type="checkbox" id="mak_disc_status" name="mak_disc_status" value="1">');

                    if(data.students_info.mak_disc_status==1){
                        $("#mak_disc_status").prop("checked", true);
                    }

                } else {
                    $("#option_no_q").prop("checked", true);
                    //$("#option_yes_q").prop("checked", false);
                    $("#st_qualified_status_no").css('display', 'block');
                    $("#st_qualified_status_yes").css('display', 'none');

                    $('#st_qualified_status_no').html('<label>Rejected Note</label><textarea rows="1" class="form-control" name="st_qualified_status_note" id="st_qualified_status_note" data-parsley-group="block10" required data-parsley-required data-container="body" data-parsley-trigger-after-failure="focusout changed.bs.select">'+data.students_info.st_qualified_status_note+'</textarea>');
                }


                $('#student_status_model').modal({backdrop: 'static', keyboard: false});
                $('#student_status_model .modal-title').text('Update Student Qualified Status : #' + data.students_info.student_id);
            },
            error: function ()
            {
                console.log('Error while get Student Data');
            }
        });
    }

    function save_student_status()
    {
        $.ajax({
            url: "<?php echo site_url('students/students_con/save_student_status')?>",
            type:"POST",
            data: $('#student_status_form').serialize(),
            dataType: "JSON",
            success: function (data) {
                if (data.status) {

                    $('#student_status_model').modal('hide');
                    $('#student_status_form')[0].reset();

                    reload_table(student_reject_datatable);
                    reload_table(student_pending_datatable);

                    // $.ajax({
                    //     url: "<?php echo site_url('students/students_con/get_max_discount');?>",
                    //     type: "POST",
                    //     "data": {
                    //         "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                    //         "student_id": data.std_id,
                    //     }, dataType: "JSON",
                    //     success: function (data2) {

                    //         console.log(data2.stu_details.mak_disc_status);

                    //         if(data2.stu_details.mak_disc_status=="1"){
                    //             if(data2.disc_data) {
                    //                 $('#dis_amount').html(data2.disc_data.max_marketing_discount);
                    //                 $('#max_dis_amount').val(parseFloat(data2.disc_data.max_marketing_discount));
                    //                 $('#total_dis_amount').val(parseFloat(data2.disc_data.total_marketing_amount));
                    //                 $('#paid_total_marketing_discount').val(parseFloat(data2.disc_data.paid_total_marketing_discount));
                    //                 $('#discount_register_model').modal({
                    //                     backdrop: 'static',
                    //                     keyboard: false
                    //                 });
                    //                 $('#discount_register_model .modal-title').text('Assign Discount Amount');
                    //             }else{
                    //                 bootbox.alert('This Program & Batch Not Available Custom Payment Plan with Marketing Discounts.');
                    //             }
                    //         }
                    //     }
                    // });
                }
                else
                {
                    if(data.message)
                    {
                        bootbox.alert(data.message);
                    }
                    if(data.inputerror)
                    {
                        for (var i = 0; i < data.inputerror.length; i++)
                        {
                            $('[name="'+data.inputerror[i]+'"]').siblings("span.error").html(data.error_string[i]).show();
                        }
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

    function add_student()
    {

        emergency_others_details.style.display = "none";
        $(".row_dyn").remove();
        save_method = 'add';

        sfw.goTo(0);
        $('#student_form')[0].reset();

        $('#student_form').parsley().reset();

        $(".type_visa_1").css('display','none');
        $(".type_visa").css('display','none');
        $("#uni_path_data").css('display','none');
        $("#pathway_option").css('display','none');
        $("#st_min_years_local").empty();
        $("#min_years_local").html('');
        $("#other_know").hide();
       // $('#university').html('<option value="">(---)</option>');

        $("#option_yes").prop('value','YES');
        $("#option_yes_1").prop('value','YES');
        $("#option_yes_2").prop('value','YES');

        $("#option_no").prop('value','NO');
        $("#option_no_1").prop('value','NO');
        $("#option_no_2").prop('value','NO');

        $(".file-upload-wrapper").attr("data-text", '');
        $('#student_photo').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
        $('.selectpicker').selectpicker('refresh');
        $('.error').empty();
        $('.file_update_block').empty();
        academic_types();

        $('#student_form_modal').modal({backdrop: 'static', keyboard: false});
        $('#student_form_modal .modal-title').text('Add New Student');
    }



    function edit_student(id)
    {
        counter_st_ol = 1;
        counter_st_al = 1;
        counter_st_hepq = 1;
        counter_st_ceq = 1;
        counter_st_vac = 1;
        counter_st_rpq = 1;

        sfw.goTo(0);
        $('#student_form')[0].reset();

        $('#student_form').parsley().reset();

        $(".type_visa_1").css('display','none');
        $(".type_visa").css('display','none');
        $("#uni_path_data").css('display','none');
        $("#pathway_option").css('display','none');
        $("#st_min_years_local").empty();
        $("#min_years_local").html('');
        $("#other_know").hide();
       // $('#university').html('<option value="">(---)</option>');


        $("#option_yes").prop('value','YES');
        $("#option_yes_1").prop('value','YES');
        $("#option_yes_2").prop('value','YES');

        $("#option_no").prop('value','NO');
        $("#option_no_1").prop('value','NO');
        $("#option_no_2").prop('value','NO');

        $(".row_dyn").remove();
        $(".file-upload-wrapper").attr("data-text", '');
        $('#student_photo').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
        $('.error').empty();
        $('.file_update_block').empty();

        save_method = 'update';
        $.ajax({
            url : "<?php echo site_url('students/students_con/edit_student')?>/" + id,
            type: "GET",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {
                //$('#student_id_span').html('<b>STUDENT NUMBER : '+data.std_info.student_id+'</b>');

                for(var key in data.students_info)
                {
                    $('[name="' + key + '"]').val(data.students_info[key]);
                }

                $("#option_yes").prop('value','YES');
                $("#option_yes_1").prop('value','YES');
                $("#option_yes_2").prop('value','YES');
                $("#option_yes_q").prop('value','YES');

                $("#option_no").prop('value','NO');
                $("#option_no_1").prop('value','NO');
                $("#option_no_2").prop('value','NO');
                $("#option_no_q").prop('value','NO');

                $('#program').val(data.students_info.programe);
                $('#intake').html('');
                $.ajax({
                    async: false,
                    url: "<?php echo site_url('students/students_con/get_intakes'); ?>",
                    type: "POST",
                    data: {
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash() ?>",
                        "intake_id": data.students_info.intake
                    },
                    dataType: "JSON",
                    success: function(data)
                    {
                        $.each(data, function(id,name)
                        {
                            var opt = $('<option />');
                            opt.val(id);
                            opt.text(name);
                            $('#intake').append(opt);
                        });

                    }
                });

                var program_id = data.students_info.programe;
                $.ajax({
                    async: false,
                    url: "<?php echo site_url('students/students_con/get_programe_id'); ?>",
                    type: "POST",
                    data: {
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash() ?>",
                        "program_id": program_id
                    },
                    dataType: "JSON",
                    success: function(data2)
                    {
                        console.log(data2);

                      //  $('#university').html('<option value="">(---)</option>');
                        for(var i=0;i<data2.program_uni_data.length;i++){
                            if(data2.program_uni_data[i].university_id==data.students_info.university){
                                $('#university').append('<option value="'+data2.program_uni_data[i].university_id+'" selected>'+data2.program_uni_data[i].name+'</option>');
                            } else{
                                $('#university').append('<option value="'+data2.program_uni_data[i].university_id+'">'+data2.program_uni_data[i].name+'</option>');
                            }
                        }
                        $('.selectpicker').selectpicker('refresh');

                    }
                });


                $.ajax({
                    url: "<?php echo base_url('students/students_con/get_university_data_by_uni_id'); ?>",
                    type: "POST",
                    dataType: "JSON",
                    data:{
                        university:data.students_info.university,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success:function(data3){

                        for(var i=0;i<data3.uni_details.length;i++){
                            if(data3.uni_details[i].university_id==data.students_info.university) {
                                if (data3.uni_details[i].uni_type == "Pathway") {
                                    $('#uni_path_data').show();
                                    $('#pathway_option').show();

                                    $('#min_years_local').html(data3.uni_details[i].local_st_val);

                                    $('#sty_local_data').html('<input type="number" class="form-control" name="st_min_years_local" id="st_min_years_local" data-parsley-group="block0" required data-parsley-required data-container="body"  min="' + data3.uni_details[i].local_st_val + '" data-parsley-type="digits" data-parsley-maxlength="2"  data-parsley-trigger-after-failure="focusout changed.bs.select" value="'+data.students_info.st_min_years_local+'" style="width: 80px">');
                                }
                            }
                        }

                    },
                    error:function (jqXHR, textStatus, errorThrown){
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });

                $('#batch').html('<option value="'+data.students_info.intake+','+data.students_info.batch+'">'+data.students_info.batch_data+'</option>');


                if(data.application!=null) {
                    if (data.application == 3 || data.application == 6 || data.application == 4) {
                        $('.gce_ol').hide();
                        $('.gce_al').hide();
                    } else if (data.application == 5 || data.application == 2) {
                        $('.gce_ol').hide();
                    }
                }

                $('#std_id').val(data.students_info.id);

                $('.selectpicker').selectpicker('refresh');

                if ( data.students_info.st_know_programmes == "Others") {
                    $("#other_know").show();
                }

                if ( data.students_info.st_valid_sl_visa == "YES") {
                    $("#option_yes").prop("checked", true);
                    $(".type_visa").css('display', 'block');
                } else {
                    $("#option_no").prop("checked", true);
                }

                if ( data.students_info.st_type_visa_another_country == "YES") {
                    $("#option_yes_1").prop("checked", true);
                    //$("#option_no_1").prop("checked", false);
                    $(".type_visa_1").css('display', 'block');
                } else {
                    $("#option_no_1").prop("checked", true);
                    //$("#option_yes_1").prop("checked", false);
                }

                if ( data.students_info.st_fs_aware == "YES") {
                    $("#option_yes_2").prop("checked", true);
                } else {
                    $("#option_no_2").prop("checked", true);
                }

                academic_types();
                //st_ol_data
                var i;
                if(data.st_ol_data !== null) {
                    for (i = 0; i < data.st_ol_data.length; ++i) {
                        var ST_OL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ol).attr("class", 'row_dyn');
                        var html_data_ol = "";
                        html_data_ol +=
                            '<td>' +
                            '<input type="hidden" name="st_ol_row_ref_id['+counter_st_ol+']" id="st_ol_row_ref_id'+counter_st_ol+'" value="'+ data.st_ol_data[i].st_ol_subject +'">' +
                            ''+counter_st_ol+'</td>' +
                            '<td>' +
                            '<input type="text" name="st_ol_school['+counter_st_ol+']" id="st_ol_school'+counter_st_ol+'" value="'+ data.st_ol_data[i].st_ol_school +'">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_ol_year['+counter_st_ol+']" id="st_ol_year'+counter_st_ol+'" value="'+ data.st_ol_data[i].st_ol_year +'">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_ol_type['+counter_st_ol+']" id="st_ol_type'+counter_st_ol+'" value="'+ data.st_ol_data[i].st_ol_type +'">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_ol_subject['+counter_st_ol+']" id="st_ol_subject'+counter_st_ol+'" value="' + data.st_ol_data[i].st_ol_subject + '">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_ol_grade['+counter_st_ol+']" id="st_ol_grade'+counter_st_ol+'" value="' + data.st_ol_data[i].st_ol_grade + '">' +
                            '</td>' +
                            '<td>' +
                            '<i class="fa fa-trash tip del" id="' + counter_st_ol + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                            '</td>';

                        ST_OL_Table.after().html(html_data_ol);
                        counter_st_ol++;

                        ST_OL_Table.appendTo("#ST_OL_Table tbody");
                    }
                }

                //st_al_data
                var i;
                if(data.st_al_data !== null) {
                    for (i = 0; i < data.st_al_data.length; ++i) {
                        var ST_AL_Table = $(document.createElement('tr')).attr("id", 'row_al_' + counter_st_al).attr("class", 'row_dyn');
                        var html_data_al = "";
                        html_data_al +=
                            '<td>' +
                            '<input type="hidden" name="st_a_row_ref_id['+counter_st_al+']" id="st_al_row_ref_id'+counter_st_al+'" value="'+ data.st_al_data[i].st_al_subject +'">' +
                            ''+counter_st_al+'</td>' +
                            '<td>' +
                            '<input type="text" name="st_al_school['+counter_st_al+']" id="st_al_school'+counter_st_al+'" value="'+ data.st_al_data[i].st_al_school +'">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_al_year['+counter_st_al+']" id="st_al_year'+counter_st_al+'" value="'+ data.st_al_data[i].st_al_year +'">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_al_type['+counter_st_al+']" id="st_al_type'+counter_st_al+'" value="'+ data.st_al_data[i].st_al_type +'">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_al_subject['+counter_st_al+']" id="st_al_subject'+counter_st_al+'" value="'+data.st_al_data[i].st_al_subject + '">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_al_grade['+counter_st_al+']" id="st_al_grade'+counter_st_al+'" value="' + data.st_al_data[i].st_al_grade + '">' +
                            '</td>' +
                            '<td>' +
                            '<i class="fa fa-trash tip del" id="' + counter_st_al + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                            '</td>';

                        ST_AL_Table.after().html(html_data_al);
                        counter_st_al++;

                        ST_AL_Table.appendTo("#ST_AL_Table tbody");
                    }
                }

                //st_hepq_data
                var i;
                if(data.st_hepq_data !== null) {
                    for (i = 0; i < data.st_hepq_data.length; ++i) {
                        var ST_HEPQ_Table = $(document.createElement('tr')).attr("id", 'row_hepq_' + counter_st_hepq).attr("class", 'row_dyn');
                        var html_data_hepq = "";
                        html_data_hepq +=
                            '<td>'+counter_st_hepq+'</td>' +
                            '<td>' +
                            '<input type="text" name="st_hepq_uni['+counter_st_hepq+']" id="st_hepq_uni'+counter_st_hepq+'" value="' + data.st_hepq_data[i].st_hepq_uni + '">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_hepq_type['+counter_st_hepq+']" id="st_hepq_type'+counter_st_hepq+'" value="' + data.st_hepq_data[i].st_hepq_type + '">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_hepq_from['+counter_st_hepq+']" id="st_hepq_from'+counter_st_hepq+'" value="' + data.st_hepq_data[i].st_hepq_from + '" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_hepq_to['+counter_st_hepq+']" id="st_hepq_to'+counter_st_hepq+'" value="' + data.st_hepq_data[i].st_hepq_to + '" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                            '</td>' +
                            '<td>' +
                            '<i class="fa fa-trash tip del" id="' + counter_st_hepq + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                            '</td>';

                        ST_HEPQ_Table.after().html(html_data_hepq);
                        counter_st_hepq++;
                        ST_HEPQ_Table.appendTo("#ST_HEPQ_Table tbody");
                    }
                }

                //st_ceq_data
                var i;
                if(data.st_ceq_data !== null) {
                    for (i = 0; i < data.st_ceq_data.length; ++i) {
                        var ST_CEQ_Table = $(document.createElement('tr')).attr("id", 'row_ceq_' + counter_st_ceq).attr("class", 'row_dyn');
                        var html_data = "";
                        html_data +=
                            '<td>'+counter_st_ceq+'</td>' +
                            '<td>' +
                            '<input type="text" name="st_ceq_uni['+counter_st_ceq+']" id="st_ceq_uni'+counter_st_ceq+'" value="' + data.st_ceq_data[i].st_ceq_uni + '">' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_ceq_type['+counter_st_ceq+']" id="st_ceq_type'+counter_st_ceq+'" value="' + data.st_ceq_data[i].st_ceq_type + '">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_ceq_from['+counter_st_ceq+']" id="st_ceq_from'+counter_st_ceq+'" value="' + data.st_ceq_data[i].st_ceq_from + '" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_ceq_to['+counter_st_ceq+']" id="st_ceq_to'+counter_st_ceq+'" value="' + data.st_ceq_data[i].st_ceq_to + '" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                            '</td>' +
                            '<td>' +
                            '<i class="fa fa-trash tip del" id="' + counter_st_ceq + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                            '</td>';

                        ST_CEQ_Table.after().html(html_data);
                        counter_st_ceq++;
                        ST_CEQ_Table.appendTo("#ST_CEQ_Table tbody");
                    }
                }

                //st_vac_data
                var i;
                if(data.st_vac_data !== null) {
                    for (i = 0; i < data.st_vac_data.length; ++i) {
                        var ST_VAC_Table = $(document.createElement('tr')).attr("id", 'row_vac_' + counter_st_vac).attr("class", 'row_dyn');
                        var html_data = "";
                        html_data +=
                            '<td>'+counter_st_vac+'</td>' +
                            '<td>' +
                            '<input type="text" name="st_vac_name['+counter_st_vac+']" id="st_vac_name'+counter_st_vac+'" value="' + data.st_vac_data[i].st_vac_name + '" >' +
                            '</td>' +
                            '<td>' +
                            '<input type="text" name="st_vac_country['+counter_st_vac+']" id="st_vac_country'+counter_st_vac+'" value="' + data.st_vac_data[i].st_vac_country + '">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_vac_year['+counter_st_vac+']" id="st_vac_year'+counter_st_vac+'" value="' + data.st_vac_data[i].st_vac_year + '" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_vac_type['+counter_st_vac+']" id="st_vac_type'+counter_st_vac+'" value="' + data.st_vac_data[i].st_vac_type + '">' +
                            '</td>' +
                            '<td>'+
                            '<input type="text" name="st_vac_status['+counter_st_vac+']" id="st_vac_status'+counter_st_vac+'" value="' + data.st_vac_data[i].st_vac_status + '">' +
                            '</td>' +
                            '<td>' +
                            '<i class="fa fa-trash tip del" id="' + counter_st_vac + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                            '</td>';

                        ST_VAC_Table.after().html(html_data);
                        counter_st_vac++;
                        ST_VAC_Table.appendTo("#ST_VAC_Table tbody");
                    }
                }

                //TODO files & photo append saved and add new ones
                if (data.student_photo_data) {
                    $('#student_photo').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.student_photo_data.photo);
                    $('#st_photo_update').html("<span style='float: right'><input type='checkbox' name='st_photo_check' value='"+ data.student_photo_data.id+"'/> Delete Photo</span>");
                }

                if (data.student_documents_data) {
                    var doc_url = "<?php echo base_url("uploads/student_documents"); ?>"+ "/" + data.students_info.id + "/";
                    var j;
                    for (j = 0; j < data.student_documents_data.length; ++j) {
                        if(data.student_documents_data[j].document_type == 'st_file_nic_pp'){
                            $('#st_file_nic_pp_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a><span style='float: right'><input type='checkbox' id='st_file_nic_pp_check' name='st_file_nic_pp_check' value='"+ data.student_documents_data[j].id+"'> Delete Document</span>");
                        }
                        if(data.student_documents_data[j].document_type == 'st_file_visa'){
                            $('#st_file_visa_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a><span style='float: right'><input type='checkbox' id='st_file_visa_check' name='st_file_visa_check' value='"+ data.student_documents_data[j].id+"'> Delete Document</span>");
                        }
                        if(data.student_documents_data[j].document_type == 'st_file_bc'){
                            $('#st_file_bc_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a><span style='float: right'><input type='checkbox' id='st_file_bc_check' name='st_file_bc_check' value='"+ data.student_documents_data[j].id+"'> Delete Document</span>");
                        }
                        if(data.student_documents_data[j].document_type == 'st_file_al'){
                            $('#st_file_al_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a><span style='float: right'><input type='checkbox' id='st_file_al_check' name='st_file_al_check' value='"+ data.student_documents_data[j].id+"'> Delete Document</span>");
                        }
                        if(data.student_documents_data[j].document_type == 'st_file_ol'){
                            $('#st_file_ol_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a><span style='float: right'><input type='checkbox' id='st_file_ol_check' name='st_file_ol_check' value='"+ data.student_documents_data[j].id+"'> Delete Document</span>");
                        }


                        if(data.student_documents_data[j].document_type == 'st_rpq_file'){
                            var ST_RPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_rpq_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                '<td>'+counter_st_rpq+'</td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td>' +
                                '<span>' +
                                '<input type="checkbox" class="st_file_rpq_check" name="st_file_rpq_check['+counter_st_rpq+']" value="'+ data.student_documents_data[j].id+'">Delete Document' +
                                '</span>' +
                                '</td>';

                            ST_RPQ_Files_Table.after().html(html_data);
                            counter_st_rpq++;

                            ST_RPQ_Files_Table.appendTo("#ST_RPQ_Files_Table tbody");
                        }


                        if(data.student_documents_data[j].document_type == 'st_hepq_file'){
                            var ST_HEPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_hepq_' + counter_st_hepq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                '<td>'+counter_st_hepq+'</td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td>' +
                                '<span>' +
                                '<input type="checkbox" class="st_file_hepq_check" name="st_file_hepq_check['+counter_st_hepq+']" value="'+ data.student_documents_data[j].id+'">Delete Document' +
                                '</span>' +
                                '</td>';

                            ST_HEPQ_Files_Table.after().html(html_data);
                            counter_st_hepq++;

                            ST_HEPQ_Files_Table.appendTo("#ST_HEPQ_Files_Table tbody");
                        }


                        if(data.student_documents_data[j].document_type == 'st_ceq_file'){
                            var ST_CEQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_ceq_' + counter_st_ceq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                '<td>'+counter_st_ceq+'</td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td>' +
                                '<span>' +
                                '<input type="checkbox" class="st_file_ceq_check" name="st_file_ceq_check['+counter_st_ceq+']" value="'+ data.student_documents_data[j].id+'">Delete Document' +
                                '</span>' +
                                '</td>';

                            ST_CEQ_Files_Table.after().html(html_data);
                            counter_st_ceq++;

                            ST_CEQ_Files_Table.appendTo("#ST_CEQ_Files_Table tbody");
                        }

                    }
                }

                $('#student_form_modal').modal({backdrop: 'static', keyboard: false});
                $('#student_form_modal .modal-title').text('Edit Student: #' + data.students_info.student_id);
            },
            error: function ()
            {
                console.log('Error while get Student Data');
            }
        });

    }



    function view_student(id){
        var j=0;
        $("#VIEW_ST_OL_Files_Table_tbody").empty();
        $("#VIEW_ST_AL_Files_Table_tbody").empty();
        $("#VIEW_ST_HEPQ_Files_Table_tbody").empty();
        $("#VIEW_ST_CEQ_Files_Table_tbody").empty();
        
                        
                        
                            
        $('#photo-upload-form input[type=file]').val("");
        $('#profile_picture').attr('src', '');

        $("#stuEditWizard ul li").first().children("a").click();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#profile_picture').attr('src', '');
        $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");

        $.ajax({
            url : "<?php echo site_url('students/students_con/view_student')?>/" + id,
            type: "POST",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {

                if(data.application!=null) {
                    if (data.application == 3 || data.application == 6 || data.application == 4) {
                        $('.gce_ol').hide();
                        $('.gce_al').hide();
                    } else if (data.application == 5 || data.application == 2) {
                        $('.gce_ol').hide();
                    }
                }

                $('a[href="#personal_info"]').tab('show');

                $.ajax({
                    url:"<?php echo site_url('students/students_con/image_available')?>",
                    dataType:"JSON",
                    type:"POST",
                    data:{
                        id:id,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success:function(data){
                        var d = new Date();
                        var n = d.getTime();

                        if(data.photo)
                        {
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);
                        }
                        else
                        {
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
                        }
                    },
                    error:function(){
                        $('#profile_picture').attr('src', '');
                        console.log("error retrieve image");
                    }
                });

                //get programe
                $.ajax({
                    url:"<?php echo site_url('students/students_con/get_view_programe')?>",
                    dataType:"JSON",
                    type:"POST",
                    data:{
                        'programe_id':data.students_info.programe,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success:function(datapr){

                            $('#view_programe').text(datapr);

                    }
                });

                //get university
                $.ajax({
                    url:"<?php echo site_url('students/students_con/get_view_university')?>",
                    dataType:"JSON",
                    type:"POST",
                    data:{
                        'university_id':data.students_info.university,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success:function(datapr){

                            $('#view_university').text(datapr);

                    }
                });

                //get batch

                $.ajax({
                    url:"<?php echo site_url('students/students_con/get_view_batch')?>",
                    dataType:"JSON",
                    type:"POST",
                    data:{
                        'intake':data.students_info.intake,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success:function(databt){

                            $('#view_batch').text(databt);

                    }
                });


//                //get intake
//
//                $.ajax({
//                    url:"<?php //echo site_url('students/students_con/get_view_batch')?>//",
//                    dataType:"JSON",
//                    type:"POST",
//                    data:{
//                        'intake_id':data.students_info.intake,
//                        "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
//                    },
//                    success:function(datait){
//
//                            $('#view_intake').text(datait);
//
//                    }
//                });



                $('#student_id').val(id);
                //$('.view_student_id').html(data.std_info.student_id);
                //$('.view_batch').html(data.std_info.batch_name);

                for(var key in data.students_info)
                {
                    $('.view_' + key ).html(data.students_info[key] ? data.students_info[key]:"-");
                }


                //st_ol_data
                var i;
                if(data.st_ol_data !== null) {
                    for (i = 0; i < data.st_ol_data.length; ++i) {
                        var VIEW_ST_OL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ol).attr("class", 'row_dyn');
                        var html_data_ol = "";
                        html_data_ol +=
                            '<td>'+counter_st_ol+'</td>' +
                            '<td>' + data.st_ol_data[i].st_ol_year + '</td>' +
                            '<td>' + data.st_ol_data[i].st_ol_school + '</td>' +
                            '<td>' + data.st_ol_data[i].st_ol_type + '</td>' +
                            '<td>' + data.st_ol_data[i].st_ol_subject + '</td>' +
                            '<td>' + data.st_ol_data[i].st_ol_grade + '</td>' +
                            '<td></td>';
                        VIEW_ST_OL_Table.after().html(html_data_ol);
                        counter_st_ol++;
                        VIEW_ST_OL_Table.appendTo("#VIEW_ST_OL_Table tbody");
                    }
                }

                //st_al_data
                var i;
                if(data.st_al_data !== null) {
                    for (i = 0; i < data.st_al_data.length; ++i) {
                        var VIEW_ST_AL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_al).attr("class", 'row_dyn');
                        var html_data_al = "";
                        html_data_al +=
                            '<td>'+counter_st_al+'</td>' +
                            '<td>' + data.st_al_data[i].st_al_year + '</td>' +
                            '<td>' + data.st_al_data[i].st_al_school + '</td>' +
                            '<td>' + data.st_al_data[i].st_al_type + '</td>' +
                            '<td>' + data.st_al_data[i].st_al_subject + '</td>' +
                            '<td>' + data.st_al_data[i].st_al_grade + '</td>' +
                            '<td></td>';
                        VIEW_ST_AL_Table.after().html(html_data_al);
                        counter_st_al++;
                        VIEW_ST_AL_Table.appendTo("#VIEW_ST_AL_Table tbody");
                    }
                }

                //st_hepq_data
                var i=0;
                if(data.st_hepq_data !== null) {
                    for (i = 0; i < data.st_hepq_data.length; ++i) {
                        var VIEW_ST_HEPQ_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_hepq).attr("class", 'row_dyn');
                        var html_data_hepq = "";
                        html_data_hepq +=
                            // '<td>'+counter_st_hepq+'</td>' +
                            '<td></td>' +
                            '<td>' + data.st_hepq_data[i].st_hepq_uni + '</td>' +
                            '<td>' + data.st_hepq_data[i].st_hepq_type + '</td>' +
                            '<td>' + data.st_hepq_data[i].st_hepq_from + '</td>' +
                            '<td>' + data.st_hepq_data[i].st_hepq_to + '</td>' +
                            '<td></td>';
                        VIEW_ST_HEPQ_Table.after().html(html_data_hepq);
                        counter_st_hepq++;
                        VIEW_ST_HEPQ_Table.appendTo("#VIEW_ST_HEPQ_Table tbody");
                    }
                }

                //st_ceq_data
                var i;
                if(data.st_ceq_data !== null) {
                    for (i = 0; i < data.st_ceq_data.length; ++i) {
                        var VIEW_ST_CEQ_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ceq).attr("class", 'row_dyn');
                        var html_data = "";
                        html_data +=
                            // '<td>'+counter_st_hepq+'</td>' +
                             '<td></td>' +
                            '<td>' + data.st_ceq_data[i].st_ceq_uni + '</td>' +
                            '<td>' + data.st_ceq_data[i].st_ceq_type + '</td>' +
                            '<td>' + data.st_ceq_data[i].st_ceq_from + '</td>' +
                            '<td>' + data.st_ceq_data[i].st_ceq_to + '</td>' +
                            '<td></td>';
                        VIEW_ST_CEQ_Table.after().html(html_data);
                        counter_st_ceq++;
                        VIEW_ST_CEQ_Table.appendTo("#VIEW_ST_CEQ_Table tbody");
                    }
                }

                if (data.student_documents_data) {
                    var doc_url = "<?php echo base_url("uploads/student_documents"); ?>"+ "/" + data.students_info.id + "/";
                    var j=0;
                    for (j = 0; j < data.student_documents_data.length; ++j) {
                        if(data.student_documents_data[j].document_type == 'st_file_nic_pp'){
                            $('#view_st_file_nic_pp_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                        }
                        if(data.student_documents_data[j].document_type == 'st_file_visa'){
                            $('#view_st_file_visa_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                        }
                        if(data.student_documents_data[j].document_type == 'st_file_bc'){
                            $('#view_st_file_bc_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                        }
                        // if(data.student_documents_data[j].document_type == 'st_file_al'){
                        //     $('#view_st_file_al_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                        // }
                        // if(data.student_documents_data[j].document_type == 'st_file_ol'){
                        //     $('#view_st_file_ol_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                        // }
                        
                        // if(data.student_documents_data[j].document_type == 'st_rpq_file'){
                        //     var VIEW_ST_RPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                        //     var html_data = "";
                        //     html_data +=
                        //         '<td>'+counter_st_rpq+'</td>' +
                        //         '<td>' +
                        //         '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                        //         '</td>' +
                        //         '<td></td>';
                        //     VIEW_ST_RPQ_Files_Table.after().html(html_data);
                        //     counter_st_rpq++;
                        //     VIEW_ST_RPQ_Files_Table.appendTo("#VIEW_ST_RPQ_Files_Table tbody");
                        // }
                        

                        if(data.student_documents_data[j].document_type == 'st_file_ol'){
                            var VIEW_ST_OL_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_OL_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_OL_Files_Table.appendTo("#VIEW_ST_OL_Files_Table tbody");
                        }

                        if(data.student_documents_data[j].document_type == 'st_file_al'){
                            var VIEW_ST_AL_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_AL_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_AL_Files_Table.appendTo("#VIEW_ST_AL_Files_Table tbody");
                        }


                        if(data.student_documents_data[j].document_type == 'st_hepq_file'){
                            var VIEW_ST_HEPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_HEPQ_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_HEPQ_Files_Table.appendTo("#VIEW_ST_HEPQ_Files_Table tbody");
                        }
                        if(data.student_documents_data[j].document_type == 'st_ceq_file'){
                            var VIEW_ST_CEQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_CEQ_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_CEQ_Files_Table.appendTo("#VIEW_ST_CEQ_Files_Table tbody");
                        }
                    }
                }

                $('#view_title').html('Student Info');
                $('#student_view_modal').modal({backdrop: 'static', keyboard: false});
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Error retrieve view data');
            }
        });

    }

    $(document).ready(function () {

        $('#st_birthday').datepicker({
            format: "yyyy-mm-dd",
            autoclose:true,
            //defaultDate: new Date(1990, 0, 1, 00, 01),
            startView: "decades",
            endDate: '-14y'
            
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            var today = new Date();
            age = new Date(today - minDate).getFullYear() - 1970;
            $('#st_age').val(age);
        });

        student_reject_datatable = $('#student_reject_datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "colReorder": true,
            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?php echo base_url()?>students/students_con/get_all_reject_students",
                "type": "POST"
            },

            "columnDefs": [
                {
                    "targets": [ -1 ],
                    "orderable": false
                }
            ],

            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },
            "buttons": [
                                        { extend: 'print', 
                                        text: '<i class="fa fa-print"></i>',
                                        titleAttr: 'Print', 
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8 ], orthogonal: 'export'
                                        }
                                        },

                                        {
                                        extend:    'copyHtml5',
                                        text:      '<i class="fa fa-files-o"></i>',
                                        titleAttr: 'Copy',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8]
                                        }
                                        },
                                        {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"></i>',
                                        titleAttr: 'Excel',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8 ]
                                        }
                                        },
                                        {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"></i>',
                                        titleAttr: 'CSV',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8]
                                        }
                                        },
                                        {
                                        extend:    'pdfHtml5',
                                        text:      '<i class="fa fa-file-pdf-o"></i>',
                                        titleAttr: 'PDF',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8 ]
                                        }
                                        }
                                        ],

            responsive: true,
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],

            "pageLength": 20,
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
        });

        yadcf.init(student_reject_datatable, [{
                filter_type: "text",
                filter_delay: 100,
                column_number: 0
            }, {
                filter_type: "text",
                filter_delay: 100,
                column_number: 1
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 2
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 3
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 4
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 5
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 6
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 7
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 8
            }],
            {
                cumulative_filtering: false
            });

        student_pending_datatable = $('#student_pending_datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "colReorder": true,
            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?php echo base_url()?>students/students_con/get_all_pending_students",
                "type": "POST"
            },

            "columnDefs": [
                {
                    "targets": [ -1 ],
                    "orderable": false
                }
            ],

            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },
            "buttons": [
                                        { extend: 'print', 
                                        text: '<i class="fa fa-print"></i>',
                                        titleAttr: 'Print', 
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8 ], orthogonal: 'export'
                                        }
                                        },

                                        {
                                        extend:    'copyHtml5',
                                        text:      '<i class="fa fa-files-o"></i>',
                                        titleAttr: 'Copy',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8]
                                        }
                                        },
                                        {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"></i>',
                                        titleAttr: 'Excel',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8 ]
                                        }
                                        },
                                        {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"></i>',
                                        titleAttr: 'CSV',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8]
                                        }
                                        },
                                        {
                                        extend:    'pdfHtml5',
                                        text:      '<i class="fa fa-file-pdf-o"></i>',
                                        titleAttr: 'PDF',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5,6,7,8 ]
                                        }
                                        }
                                        ],

            responsive: true,
            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],

            "pageLength": 20,
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
        });

        yadcf.init(student_pending_datatable, [{
                filter_type: "text",
                filter_delay: 100,
                column_number: 0
            }, {
                filter_type: "text",
                filter_delay: 100,
                column_number: 1
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 2
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 3
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 4
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 5
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 6
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 7
            },{
                filter_type: "text",
                filter_delay: 100,
                column_number: 8
            }],
            {
                cumulative_filtering: false
            });

        $("#st_nic_num").focusout(function() {
            var nic = $(this).val();
            if($(this).val()!=='') {
                $.ajax({
                    url: "<?php echo base_url('students/students_con/check_nic_valid'); ?>",
                    type: "POST",
                    dataType: "JSON",
                    data:{
                        st_nic_num:nic,
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success: function (data) {
                        if (data.status) {
                            sfw.activeNext(true, true);
                        }
                        else
                        {
                            if(data.inputerror)
                            {
                                for (var i = 0; i < data.inputerror.length; i++)
                                {
                                    $('[name="'+data.inputerror[i]+'"]').siblings("span.error").html(data.error_string[i]).show();
                                }
                                sfw.activeNext(false, false);
                            }
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown){
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            }
        });

        $('#student_view_modal').on('hidden.bs.modal', function() {
            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
        });

        $("#student_form_modal :input").change(function(){
            $(this).siblings("span.error").html("").hide();
            $("span.help-inline").hide();
        });

        $('#student_form_modal').on('hidden.bs.modal', function() {
            $("#student_form :input").siblings("span.error").html("").hide();
            $("span.help-inline").hide();
        });

        var url_new = "<?php echo base_url('students/students_con/get_countries'); ?>";
        $('#st_country_of_birth').typeahead({
            source:  function (query, process) {
                return $.get(url_new, { query: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
            
        });

        var url_citi = "<?php echo base_url('students/students_con/get_citizenship'); ?>";
        $('#st_citizenship').typeahead({
            source:  function (query, process) {
                return $.get(url_citi, { query: query }, function (data) {
                   // console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
            
        });

        

        sfw = $("#student_form").stepFormWizard({
            height: '400px',
            theme: 'sun',
            onNext: function(i) {
                var valid = $("#student_form").parsley().validate('block' + i);
                if(i==1){
                    if($('#st_nic_num').val()=="" && $('#st_passport_num').val()==""){
                        bootbox.alert("NIC or Passport Number is Required");
                        valid = false;
                    }

                    if($('#st_nic_num').val()!="" && $('#st_passport_num').val()==""){

                        var nicNumber = $('#st_nic_num').val();
                        var cnic_no_regex = new RegExp('^[0-9+]{9}[vV|xX]$');
                        var new_cnic_no_regex = new RegExp('^[0-9+]{12}$');
                        if (nicNumber.length == 10 && cnic_no_regex.test(nicNumber)) {
                            //alert('true');
                        } else if (nicNumber.length == 12 && new_cnic_no_regex.test(nicNumber)) {
                            //alert('true');
                        } else {
                            bootbox.alert("Invalid NIC Number");
                            valid = false;
                        }
                    }
                    
                        var e_age =  $('#st_age').val();

                        if(parseInt(14)>parseInt(e_age)){
                            bootbox.alert("Your age must be more than 14 Years to Apply to this Course");
                            valid = false;
                        }else{
                            
                        }

                        
                    
                }
                sfw.refresh();
                return valid;
            },
            finishBtn: $('<a class="finish-btn sf-right sf-btn" href="#">Save</a>'),
            onFinish: function(i) {
                var valid = $("#student_form").parsley().validate();
                // if use height: 'auto' call refresh metod after validation, because parsley can change content
                sfw.refresh();
                if (valid){
                    sfw.addSpinner('finish');

                    var url='';
                    if(save_method=='add'){
                        url = "<?php echo base_url('students/students_con/insert'); ?>";
                    }
                    else{
                        url = "<?php echo base_url('students/students_con/update'); ?>";
                    }

                    var fileInputs_ol = $('.st_file_ol');
                   var fileInputs_al = $('.st_file_al');
                   // var fileInputs = $('.st_rpq_file');
                    var fileInputs_hepq = $('.st_hepq_file');
                    var fileInputs_ceq = $('.st_ceq_file');

                    var formData = new FormData();

                    var st_photo = $('#st_photo').prop('files')[0];
                    // var st_file_ol = $('#st_file_ol').prop('files')[0];
                    // var st_file_al = $('#st_file_al').prop('files')[0];
                    var st_file_nic_pp = $('#st_file_nic_pp').prop('files')[0];
                    var st_file_visa = $('#st_file_visa').prop('files')[0];
                    var st_file_bc = $('#st_file_bc').prop('files')[0];
                    formData.append('st_photo', st_photo);
                    // formData.append('st_file_ol', st_file_ol);
                    // formData.append('st_file_al', st_file_al);
                    formData.append('st_file_nic_pp', st_file_nic_pp);
                    formData.append('st_file_visa', st_file_visa);
                    formData.append('st_file_bc', st_file_bc);

                    fields = $("#student_form").serializeArray();
                    $.each( fields, function( i, field ) {
                        formData.append(field.name, field.value);
                    });

                    $.each(fileInputs_ol, function(i,fileInput){
                        if( fileInput.files.length > 0 ){
                            $.each(fileInput.files, function(k,file){
                                formData.append('st_file_ols[]', file);
                            });
                        }
                    });
                    $.each(fileInputs_al, function(i,fileInput){
                        if( fileInput.files.length > 0 ){
                            $.each(fileInput.files, function(k,file){
                                formData.append('st_file_als[]', file);
                            });
                        }
                    });


                    // $.each(fileInputs, function(i,fileInput){
                    //     if( fileInput.files.length > 0 ){
                    //         $.each(fileInput.files, function(k,file){
                    //             formData.append('st_rpq_files[]', file);
                    //         });
                    //     }
                    // });

                    $.each(fileInputs_hepq, function(i,fileInput){
                        if( fileInput.files.length > 0 ){
                            $.each(fileInput.files, function(k,file){
                                formData.append('st_hepq_files[]', file);
                            });
                        }
                    });

                    $.each(fileInputs_ceq, function(i,fileInput){
                        if( fileInput.files.length > 0 ){
                            $.each(fileInput.files, function(k,file){
                                formData.append('st_ceq_files[]', file);
                            });
                        }
                    });

                    if(save_method=='update'){
                        /*st_file_nic_pp_check
                        st_photo_check
                        st_file_visa_check
                        st_file_bc_check
                        st_file_al_check
                        st_file_ol_check
                        st_file_rpq_check[]*/

                        /*var st_file_nic_pp_check = $('#st_file_nic_pp_check:checked').val();
                        formData.append('st_file_nic_pp_check', st_file_nic_pp_check);

                        var st_photo_check = $('#st_photo_check:checked').val();
                        formData.append('st_photo_check', st_photo_check);

                        var st_file_visa_check = $('#st_file_visa_check:checked').val();
                        formData.append('st_file_visa_check', st_file_visa_check);

                        var st_file_bc_check = $('#st_file_bc_check:checked').val();
                        formData.append('st_file_bc_check', st_file_bc_check);

                        var st_file_al_check = $('#st_file_al_check:checked').val();
                        formData.append('st_file_al_check', st_file_al_check);

                        var st_file_ol_check = $('#st_file_ol_check:checked').val();
                        formData.append('st_file_ol_check', st_file_ol_check);

                        var st_file_ol_check = $('#st_file_ol_check:checked').val();
                        formData.append('st_file_ol_check', st_file_ol_check);

                        var st_file_rpq_check = []
                        var checkboxes = document.querySelectorAll('.st_file_rpq_check:checked')
                        for (var i = 0; i < checkboxes.length; i++) {
                            st_file_rpq_check.push(checkboxes[i].value);
                        }
                        formData.append('st_file_rpq_check', st_file_rpq_check);*/
                    }

                    /*$.each($('.st_rpq_file')[0].files, function(i, value) {
                        formData.append('st_rpq_file[' + i + ']', value.files[0]);
                    });*/

                    formData.append('<?php echo $this->security->get_csrf_token_name(); ?>', '<?php echo $this->security->get_csrf_hash(); ?>');

                    $.ajax({
                        url: url,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: "POST",
                        data: formData,
                        dataType: "JSON",
                        success: function (data) {

                            if (data.status) {
                                $('#student_form_modal').modal('hide');
                                $('#student_form')[0].reset();
                                reload_table(student_reject_datatable);
                                reload_table(student_pending_datatable);
                                sfw.addSpinner('finish',false);
                                //bootbox.alert(data.message);

                                bootbox.dialog({
                                    message: data.message,
                                    title: "Sucess!",
                                    buttons: {
                                        ok: {
                                            label: "Yes",
                                            className: "btn-primary",
                                            callback: function () {
                                                $.ajax({
                                                    url: "<?php echo site_url('students/students_con/get_max_discount');?>",
                                                    type: "POST",
                                                    "data": {
                                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                                        "student_id": data.std_id,
                                                    }, dataType: "JSON",
                                                    success: function (data2) {

                                                        console.log(data2.stu_details.mak_disc_status);

                                                        if(data2.stu_details.mak_disc_status=="1"){
                                                            if(data2.disc_data) {
                                                                $('#dis_amount').html(data2.disc_data.max_marketing_discount);
                                                                $('#max_dis_amount').val(parseFloat(data2.disc_data.max_marketing_discount));
                                                                $('#total_dis_amount').val(parseFloat(data2.disc_data.total_marketing_amount));
                                                                $('#paid_total_marketing_discount').val(parseFloat(data2.disc_data.paid_total_marketing_discount));
                                                                $('#discount_register_model').modal({
                                                                    backdrop: 'static',
                                                                    keyboard: false
                                                                });
                                                                $('#discount_register_model .modal-title').text('Assign Discount Amount');
                                                            }else{
                                                                bootbox.alert('This Program & Batch Not Avaialble Custom Payment Plan with Markting Discounts.');
                                                            }
                                                        }
                                                    }
                                                });

                                            }
                                        }
                                    }
                                });
                            }
                            else
                            {       

                                if (data.status) {
                                     
                                    bootbox.alert(data.message);
                                    sfw.addSpinner('finish',false);
                                }
                                else{
                                    if(data.message){
                                        bootbox.alert(data.message);
                                        sfw.goTo(data.step);
                                        sfw.addSpinner('finish',false);
                                    }
                                    if(data.inputerror){      
                                    for (var i = 0; i < data.inputerror.length; i++)
                                    {
                                        $('[name="'+data.inputerror[i]+'"]').siblings("span.error").html(data.error_string[i]).show();
                                    }
                                    var stnum = sfw.getActualStep();
                                    sfw.goTo(stnum);
                                    //$("#" + $('[name="'+data.inputerror[0]+'"]').prop('id')).focus();
                                    //var err_tab_id = $('[name="'+data.inputerror[0]+'"]').parents(".sf-step").prop('id');
                                    //$("a[href='#"+ err_tab_id +"']").click();
                                    sfw.addSpinner('finish',false);
                                }

                                }

                                 
                                
                            }
                        },
                        error: function (jqXHR, textStatus, errorThrown){
                            sfw.addSpinner('finish',false);
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });

                }
                return false;
            }
        });

        ///test
        $('.selectpicker').attr('data-trigger', 'change').attr('data-required', 'true');

        $("#student_form").parsley({
            errorClass: 'is-invalid text-danger',
            successClass: 'is-valid',
            errorsWrapper: '<div class="input-group"></div>',
            errorTemplate: '<small class="form-text text-danger"></small>',
            trigger: 'change',
            triggerAfterFailure: 'focusout changed.bs.select'
        });
        //end test

        //IMG Preview
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#student_photo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#st_photo").change(function(){
            readURL(this);
        });
        //End IMG Preview

        //Upload file name display on nwe style
        $("form").on("change", ".file-upload-field", function(){
            $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
        });
        //end upload file style

        $('#st_know_programmes').change(function(){
            if ( $("#st_know_programmes").val() == "Others") {
                $("#other_know").show();
            } else {
                $("#other_know").hide();
            }
        });


        ///////ST_RPQ_Files_Table Add
        counter_st_rpq = 1;
        $("#add_ST_RPQ_Files_Table").click(function () {
            if(counter_st_rpq>5){
                alert("Only 5 allowed");
                return false;
            }

            var ST_RPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_rpq_' + counter_st_rpq).attr("class", 'row_dyn');
            var html_data = "";
            html_data +=
                '<td>'+counter_st_rpq+'</td>' +
                '<td>' +
                '<input type="file"  id="st_rpq_file'+counter_st_rpq+'" name="st_rpq_file['+counter_st_rpq+']" class="st_rpq_file" value="">' +
                '</td>' +
                '<td>' +
                '<i class="fa fa-trash tip del" id="' + counter_st_rpq + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                '</td>';

            ST_RPQ_Files_Table.after().html(html_data);
            counter_st_rpq++;

            ST_RPQ_Files_Table.appendTo("#ST_RPQ_Files_Table tbody");
        });

        $("table#ST_RPQ_Files_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_rpq_" + delID);
            row_id.remove();
        });
        //////END ST_RPQ_Files_Table


            ///////ST_OL_Files_Table Add
            counter_st_ol_file = 1;
        $("#add_ST_OL_Files_Table").click(function () {
            if(counter_st_ol_file>5){
                alert("Only 5 allowed");
                return false;
            }

            var ST_OL_Files_Table = $(document.createElement('tr')).attr("id", 'row_rpq_' + counter_st_ol_file).attr("class", 'row_dyn');
            var html_data = "";
            html_data +=
                '<td>'+counter_st_ol_file+'</td>' +
                '<td>' +
                '<input type="file"  id="st_file_ol'+counter_st_ol_file+'" name="st_file_ol['+counter_st_ol_file+']" class="st_file_ol" value="">' +
                '</td>' +
                '<td>' +
                '<i class="fa fa-trash tip del" id="' + counter_st_ol_file + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                '</td>';

                ST_OL_Files_Table.after().html(html_data);
                counter_st_ol_file++;

            ST_OL_Files_Table.appendTo("#ST_OL_Files_Table tbody");
        });

        $("table#ST_OL_Files_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_rpq_" + delID);
            row_id.remove();
        });
        //////END ST_OL_Files_Table

        ///////ST_AL_Files_Table Add
        counter_st_al_file = 1;
        $("#add_ST_AL_Files_Table").click(function () {
            if(counter_st_al_file>5){
                alert("Only 5 allowed");
                return false;
            }

            var ST_AL_Files_Table = $(document.createElement('tr')).attr("id", 'row_rpq_' + counter_st_al_file).attr("class", 'row_dyn');
            var html_data = "";
            html_data +=
                '<td>'+counter_st_al_file+'</td>' +
                '<td>' +
                '<input type="file"  id="st_file_al'+counter_st_al_file+'" name="st_file_al['+counter_st_al_file+']" class="st_file_al" value="">' +
                '</td>' +
                '<td>' +
                '<i class="fa fa-trash tip del" id="' + counter_st_al_file + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                '</td>';

                ST_AL_Files_Table.after().html(html_data);
                counter_st_al_file++;

                ST_AL_Files_Table.appendTo("#ST_AL_Files_Table tbody");
        });

        $("table#ST_AL_Files_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_rpq_" + delID);
            row_id.remove();
        });
        //////END ST_AL_Files_Table






        ///////Student OL Add
        counter_st_ol = 1;

        $("#add_ST_OL_Table").click(function () {
                if(counter_st_ol>20){
                    alert("Only 20 allowed");
                    return false;
                }

            var subject = $('#st_ol_subject').val();
            var grade = $('#st_ol_grade').val();
            var ol_typ = $('#st_ol_type').val();
            var ol_typ_text = $('#st_ol_type option:selected').text();
            var school = $('#st_attended_school').val();
            var year = $('#st_ol_year').val();

            if (subject!="" && grade!="" && ol_typ!="" && school!="" && year!=""){


                var ST_OL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ol).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_ol+'</td>' +
                    '<td>' +
                    '<input type="text" name="st_ol_school['+counter_st_ol+']" id="st_ol_school'+counter_st_ol+'" value="'+school+'">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_ol_year['+counter_st_ol+']" id="st_ol_year'+counter_st_ol+'" value="'+year+'">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_ol_type['+counter_st_ol+']" id="st_ol_type'+counter_st_ol+'" value="'+ol_typ_text+'">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_ol_subject['+counter_st_ol+']" id="st_ol_subject'+counter_st_ol+'" value="'+subject+'">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_ol_grade['+counter_st_ol+']" id="st_ol_grade'+counter_st_ol+'" value="'+grade+'">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_ol + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

                ST_OL_Table.after().html(html_data);
                counter_st_ol++;

                ST_OL_Table.appendTo("#ST_OL_Table tbody");
                $('#st_ol_subject').val('');
                $('#st_ol_grade').val('');

            }else{
                bootbox.alert("Can not Add Empty Data");
            }


        });

        $("table#ST_OL_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_" + delID);
            row_id.remove();
        });


        //////END ST OL ADD

        ///////Student AL Add
        counter_st_al = 1;
        $("#add_ST_AL_Table").click(function () {
                if(counter_st_al>20){
                    alert("Only 20 allowed");
                    return false;
                }

            var al_subject = $('#st_al_subject').val();
            var al_grade = $('#st_al_grade').val();
            var al_typ = $('#st_al_type').val();
            var al_typ_text = $('#st_al_type option:selected').text();
            var al_school = $('#al_st_attended_school').val();
            var al_year = $('#st_al_year').val();

            if (al_subject!="" && al_grade!="" && al_typ!="" && al_school!="" && al_year!=""){


                var ST_AL_Table = $(document.createElement('tr')).attr("id", 'row_al_' + counter_st_al).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_ol+'</td>' +
                    '<td>' +
                    '<input type="text" name="st_al_school['+counter_st_al+']" id="st_al_school'+counter_st_al+'" value="'+al_school+'">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_al_year['+counter_st_al+']" id="st_al_year'+counter_st_al+'" value="'+al_year+'">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_al_type['+counter_st_al+']" id="st_al_type'+counter_st_al+'" value="'+al_typ_text+'">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_al_subject['+counter_st_al+']" id="st_al_subject'+counter_st_al+'" value="'+al_subject+'">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_al_grade['+counter_st_al+']" id="st_al_grade'+counter_st_al+'" value="'+al_grade+'">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_al + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

                ST_AL_Table.after().html(html_data);
                counter_st_al++;

                ST_AL_Table.appendTo("#ST_AL_Table tbody");
                $('#st_al_subject').val('');
                $('#st_al_grade').val('');

            }else{
                bootbox.alert("Can not Add Empty Data");
            }









        });




        $("table#ST_AL_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_al_" + delID);
            row_id.remove();
        });
        //////END ST AL ADD

        ///////Student ST_HEPQ_Table Add
        counter_st_hepq = 1;
        $("#add_ST_HEPQ_Table").click(function () {
                if(counter_st_hepq>20){
                    alert("Only 20 allowed");
                    return false;
                }

                var ST_HEPQ_Table = $(document.createElement('tr')).attr("id", 'row_hepq_' + counter_st_hepq).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_hepq+'</td>' +
                    '<td >' +
                    '<input type="text" class="form-control" name="st_hepq_uni['+counter_st_hepq+']" id="st_hepq_uni'+counter_st_hepq+'"  data-parsley-pattern="^[a-zA-Z\s]*$">'+
                    '</td>' +
                    '<td>' +
                    '<select name="st_hepq_type['+counter_st_hepq+']" id="st_hepq_type'+counter_st_hepq+'" class="form-control">'+
                    '<option value="">Select Type of Award</option>'+
                    '<option>DEGREE</option>'+
                    ' <option>DIPLOMA</option>'+
                    '</select>'+
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_hepq_from['+counter_st_hepq+']" id="st_hepq_from'+counter_st_hepq+'" value="" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_hepq_to['+counter_st_hepq+']" id="st_hepq_to'+counter_st_hepq+'" value="" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_hepq + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

            ST_HEPQ_Table.after().html(html_data);

            //JE 2020_05_27
            var ST_HEPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_hepq_file_' + counter_st_hepq).attr("class", 'row_dyn');
            var html_data_files = "";
            html_data_files +=
                '<td>'+counter_st_hepq+'</td>' +
                '<td>' +
                '<input type="file"  id="st_hepq_file'+counter_st_hepq+'" name="st_hepq_file['+counter_st_hepq+']" class="st_hepq_file" value="">' +
                '</td>' +
                '<td>' +
                '' +
                '</td>';
            ST_HEPQ_Files_Table.after().html(html_data_files);

            counter_st_hepq++;
            ST_HEPQ_Files_Table.appendTo("#ST_HEPQ_Files_Table tbody");
            ST_HEPQ_Table.appendTo("#ST_HEPQ_Table tbody");
            $('.date').datepicker({
                format: "yyyy",
                autoclose:true,
                endDate: '-1d'
            });
        });

        $("table#ST_HEPQ_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_hepq_" + delID);
            row_id_2 = $("#row_hepq_file_" + delID);
            row_id.remove();
            row_id_2.remove();
        });
        //////END ST ST_HEPQ_Table ADD

        ///////Student ST_CEQ_Table Add
        counter_st_ceq = 1;
        $("#add_ST_CEQ_Table").click(function () {
                if(counter_st_ceq>20){
                    alert("Only 20 allowed");
                    return false;
                }

                var ST_CEQ_Table = $(document.createElement('tr')).attr("id", 'row_ceq_' + counter_st_ceq).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_ceq+'</td>' +
                    '<td >' +
                    '<input type="text" class="form-control" name="st_ceq_uni['+counter_st_ceq+']" id="st_ceq_uni'+counter_st_ceq+'"  data-parsley-pattern="^[a-zA-Z\s]*$">'+
                    '</td>' +
                    '<td>' +
                    '<select name="st_ceq_type['+counter_st_ceq+']" id="st_ceq_type'+counter_st_ceq+'" class="form-control">'+
                    '<option value="">Select Type of Award</option>'+
                    '<option>DEGREE</option>'+
                    ' <option>DIPLOMA</option>'+
                    '</select>'+
                    '</td>' +
                     
                    '<td>'+
                    '<input type="text" name="st_ceq_from['+counter_st_ceq+']" id="st_ceq_from'+counter_st_ceq+'" value="" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_ceq_to['+counter_st_ceq+']" id="st_ceq_to'+counter_st_ceq+'" value="" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_ceq + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';
            ST_CEQ_Table.after().html(html_data);


            var ST_CEQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_ceq_file_' + counter_st_ceq).attr("class", 'row_dyn');
            var html_data_files = "";
            html_data_files +=
                '<td>'+counter_st_ceq+'</td>' +
                '<td>' +
                '<input type="file"  id="st_ceq_file'+counter_st_ceq+'" name="st_ceq_file['+counter_st_ceq+']" class="st_ceq_file" value="">' +
                '</td>' +
                '<td>' +
                '' +
                '</td>';
            ST_CEQ_Files_Table.after().html(html_data_files);
            counter_st_ceq++;

            ST_CEQ_Files_Table.appendTo("#ST_CEQ_Files_Table tbody");
            ST_CEQ_Table.appendTo("#ST_CEQ_Table tbody");
            $('.date').datepicker({
                format: "yyyy",
                autoclose:true,
                endDate: '-1d'
            });
        });

        $("table#ST_CEQ_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_ceq_" + delID);
            row_id_2 = $("#row_ceq_file_" + delID);
            row_id.remove();
            row_id_2.remove();
        });
        //////END ST ST_CEQ_Table ADD

        ///////Student ST_VAC_Table Add
        counter_st_vac = 1;
        $("#add_ST_VAC_Table").click(function () {
                if(counter_st_vac>20){
                    alert("Only 20 allowed");
                    return false;
                }

                var ST_VAC_Table = $(document.createElement('tr')).attr("id", 'row_vac_' + counter_st_vac).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_vac+'</td>' +
                    '<td>' +
                    '<input type="text" name="st_vac_name['+counter_st_vac+']" id="st_vac_name'+counter_st_vac+'" value="">' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" name="st_vac_country['+counter_st_vac+']" id="st_vac_country'+counter_st_vac+'" value="">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_vac_year['+counter_st_vac+']" id="st_vac_year'+counter_st_vac+'" value="" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_vac_type['+counter_st_vac+']" id="st_vac_type'+counter_st_vac+'" value="">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_vac_status['+counter_st_vac+']" id="st_vac_status'+counter_st_vac+'" value="">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_vac + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

            ST_VAC_Table.after().html(html_data);
            counter_st_vac++;

            ST_VAC_Table.appendTo("#ST_VAC_Table tbody");
        });

        $("table#ST_VAC_Table").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_vac_" + delID);
            row_id.remove();
        });
        //////END ST ST_VAC_Table ADD


    });


    function yesnoCheck() {
        if ($("#option_yes").is(':checked')) {
            $(".type_visa").css('display', 'block');
        } else if ($("#option_no").is(':checked')) {
            $(".type_visa").css('display','none');
        }
    }

    function yesnoCheck1() {
        if ($("#option_yes_1").is(':checked')) {
            console.log($("#option_yes_1").val());
            $(".type_visa_1").css('display', 'block');
        } else if ($("#option_no_1").is(':checked')) {
            console.log($("#option_no_1").val());
            $(".type_visa_1").css('display','none');
        }
    }

    function yesnoCheck2() {
        if ($("#option_yes_q").is(':checked')) {
            $("#st_qualified_status_yes").css('display', 'block');
            $("#st_qualified_status_no").css('display','none');
            $("#st_qualified_status_no").html('');

            $('#st_qualified_status_yes').html('<label>RPL Note</label><textarea rows="1" class="form-control" name="st_qualified_status_note" id="st_qualified_status_note" data-parsley-group="block10" ></textarea><hr><label>Marketing Discount - </label><select class="form-control" name="mak_disc_status" id="mak_disc_status"><option value="">No Discount</option><option value="5">5%</option><option value="10">10%</option></select>');

        } else if ($("#option_no_q").is(':checked')) {
            $("#st_qualified_status_no").css('display','block');
            $("#st_qualified_status_yes").css('display', 'none');
            $("#st_qualified_status_yes").html('');

            $('#st_qualified_status_no').html('<label>Rejected Note</label><textarea rows="1" class="form-control" name="st_qualified_status_note" id="st_qualified_status_note" data-parsley-group="block10" required data-parsley-required data-container="body" data-parsley-trigger-after-failure="focusout changed.bs.select"></textarea>');
        }
    }


    /*$(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });*/


    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }

    function reload_table(table)
    {
        if(typeof table !== "undefined")
        {
            table.ajax.reload(null,false);
        }
    }

    function get_html_for_view_modal_rows(label, key, value)
    {
        return "<div class='row static-info'>" +
            "<div class='col-md-5 name uppercase'>" + label + ": </div>" +
            "<div class='col-md-7 value' id='view-" + key + "'>" +
            value +
            "</div>" +
            "</div>";
    }

    function open_photo_upload_modal(showSuccessMsg,std_id)
    {

        var id= $('#student_id').val();
        $.ajax({
            url: "<?php echo site_url('students/students_con/image_available')?>",
            type: "POST",
            data: {
                id:id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function (data) {
                var d = new Date();
                var n = d.getTime();
                if(data.length == 0)
                {
                    $('#previewing').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
                }
                else
                {
                    $('#previewing').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);
                }
            },
            error: function () {
                console.log('Error getting photo');
            }
        });


        $('#photo-upload-form')[0].reset();
        $("#photo_upload_div").show();
        $("#photo_message").empty().hide();

        $("#btnUploadPhoto").show().attr('disabled',false).text('Upload');
        $("#btnExitModal").show().attr('disabled',false).text("Skip");

        if(showSuccessMsg)
        {
            //$('.success_message').text("Student registration have been saved successfully.It is recommended to upload Student's photo.");
            $('.success_message').parent().show();
        }
        else
        {
            $('.success_message').parent().hide();
        }

        $('#photo_upload_modal').modal({backdrop: 'static', keyboard: false});
        $('#btnUploadPhoto').off('click.btnUploadPhoto');

        $('#btnUploadPhoto').on('click', function(){

            var formData = new FormData();
            var photo = $('#photo-upload-form input[type=file]')[0].files[0];

            if(photo == undefined)
            {
                $("#photo_message").show().html("No photo is selected!");
                $("#photo_message").removeClass('alert-success').addClass('alert alert-danger fade in');
            }
            else
            {
                formData.append("photo", photo);
                formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", "<?php echo $this->security->get_csrf_hash(); ?>");
                var d = new Date();
                var n = d.getTime();

                var idd;
                if(std_id){
                    idd=std_id;
                }
                else{
                    idd=$('#student_id').val();
                }
                var url = "<?php echo site_url('students/students_con/add_photo')?>/"+idd;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function()
                    {
                        $("#btnUploadPhoto").attr('disabled',true).text('Uploading...');
                        $("#btnExitModal").attr('disabled',true);
                    },
                    success: function(data)
                    {
                        $("#photo_message").show().html(data.message);

                        if(data.status)
                        {
                            $("#photo_upload_div").hide();
                            $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                            $("#btnExitModal").attr('disabled',false).text("Close");
                            $("#btnUploadPhoto").hide();
                            $("#photo_message").removeClass('alert-danger').addClass('alert alert-success fade in');
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg'); ?>");
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);
                        }
                        else
                        {
                            $("#btnExitModal").show().attr('disabled',false).text("Skip");
                            $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                            $("#photo_message").removeClass('alert-success').addClass('alert alert-danger fade in');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log('Error uploading data: ' + textStatus + " - " + errorThrown);
                        $("#btnExitModal").text("Skip");
                        $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                    }
                });
            }

        });
    }

    function imageIsLoaded(e) {
        $("#empPhoto").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    }

    function upload(){
        $.ajax({
            url: "<?php echo site_url('hr_payroll/student_list/upload_profile')?>",
            type: "POST",
            data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function (data) {

                $('#previewing').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);

            },
            error: function () {
                console.log('Error getting photo');
            }
        });

    }



//    //register
//    function validate_data(id)
//    {
////        $('#salary_advance')[0].reset();
//
//       $("#mark_disk").val(id);
//
//        $('.selectpickernew').selectpicker('refresh');
//        $('#gate_pass_register_model').modal({backdrop: 'static', keyboard: false});
//        $('#gate_pass_register_model .modal-title').text('Assign Discount Amount');
//    }

//    function validate_id(id)
//    {
//        bootbox.dialog({
//            message: "Are you sure, that you want to Approve this Details?",
//            title: "Alert!",
//            buttons: {
//                ok: {
//                    label: "Yes",
//                    className: "btn-primary",
//                    callback: function () {
//                        $.ajax({
//                            url : "<?php //echo base_url()?>//students/students_con/approved_record",
//                            type: "POST",
//                            data: {
//                                "record_id": id,
//                                "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
//                            },
//                            dataType: "JSON",
//                            success: function(data)
//                            {
//                                reload_table(gate_pass_register);
//                                bootbox.alert(data.message);
//                                //data.status ? console.log("Delete successful!") : console.log("Delete failed!");
//                            },
//                            error: function (jqXHR, textStatus, errorThrown)
//                            {
//                                console.log(jqXHR);
//                                console.log(textStatus);
//                                console.log(errorThrown);
//                                console.log('Error while Delete Register record');
//                            }
//                        });
//                    }
//                },
//                cancel: {
//                    label: "No",
//                    className: "btn-default"
//                }
//            }
//        });
//
//    }

</script>

