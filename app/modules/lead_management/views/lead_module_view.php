<link rel="stylesheet" href="<?php echo base_url('assets/plugins/intl-tel-input-master/build/css/intlTelInput.css'); ?>" />

<style>
    #datatable1 tbody td {
        padding: 2px 5px;
    }

    #datatable1 .btn {
        margin-left: 0;
        margin-right: 5px;
        padding: 2px 5px;
    }

    .iti {
        position: relative;
        display: inline-block;
        width: 360px;
    }

    ul,
    li {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }

    form ul li {
        margin: 10px 20px;
    }

    .nav-tabs .nav-item {
        margin-bottom: 20px;
        margin-right: 0.4rem;
    }

    .error {
        color: #dc3545
    }

    .nav.smaller.nav-tabs .nav-link {
        padding: 0.2em 0.3em;
        font-size: 12px;
    }

    .sf-nav-subtext {
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
        border: 2px solid #24b314 !important;
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

    .form-control {
        border: 2px solid #5a6ac4 !important;
    }

    .bootstrap-select>.dropdown-toggle {
        border: none;
    }

    .td_head_reg {
        background: #2c1765 !important;
        color: #fff !important;
    }

    .acc_head {
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

    .inputGroup input:checked~label {
        color: #fff;
    }

    .inputGroup input:checked~label:before {
        -webkit-transform: translate(-50%, -50%) scale3d(56, 56, 1);
        transform: translate(-50%, -50%) scale3d(56, 56, 1);
        opacity: 1;
    }

    .inputGroup input:checked~label:after {
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


    .alert {
        position: relative;
        padding: 0;
        margin-bottom: 0;
        border: 2px solid transparent;
        border-radius: 6px;
    }
</style>




<link rel="stylesheet" href="<?php echo base_url('assets/test_plugin/intl-tel-input-master/build/css/intlTelInput.css'); ?>" />
<script src="<?php echo base_url('assets/test_plugin/intl-tel-input-master/build/js/intlTelInput.min.js'); ?>">
</script>


<link href="<?php echo base_url('assets/plugins/Material-Time-Picker-Plugin-jQuery-MDTimePicker/mdtimepicker.css'); ?>" rel="stylesheet">


<script src="<?php echo base_url('assets/plugins/Material-Time-Picker-Plugin-jQuery-MDTimePicker/mdtimepicker.js'); ?>">
</script>


<script>
    $(document).ready(function() {




        $('#next_contact_time').val("9:00 AM");
        $('#next_contact_time').mdtimepicker();


        // $('#next_time').val("9:00 AM");
        $('#next_time').mdtimepicker();


    });

    $('#next_contact_time').mdtimepicker({

        // format of the time value (data-time attribute)
        timeFormat: 'hh:mm:ss.000',

        // format of the input value
        format: 'h:mm tt',

        // theme of the timepicker
        // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
        theme: 'blue',

        // determines if input is readonly
        readOnly: true,

        // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
        hourPadding: false,

        // determines if clear button is visible  
        clearBtn: false

    });

    $('#timepicker').mdtimepicker().on('timechanged', function(e) {
        console.log(e.value);
        console.log(e.time);
    });

    // setting the value
    $('#next_contact_time').mdtimepicker('setValue', '3:30 PM');

    // calling the `show` and `hide` functions
    $('#next_contact_time').mdtimepicker('show');
    $('#next_contact_time').mdtimepicker('hide');

    // destroying the timepicker
    $('#next_contact_time').mdtimepicker('destroy');


    ///////////////////////////////////////

    $('#next_time').mdtimepicker({

        // format of the time value (data-time attribute)
        timeFormat: 'hh:mm:ss.000',

        // format of the input value
        format: 'h:mm tt',

        // theme of the timepicker
        // 'red', 'purple', 'indigo', 'teal', 'green', 'dark'
        theme: 'blue',

        // determines if input is readonly
        readOnly: true,

        // determines if display value has zero padding for hour value less than 10 (i.e. 05:30 PM); 24-hour format has padding by default
        hourPadding: false,

        // determines if clear button is visible  
        clearBtn: false

    });

    $('#timepicker').mdtimepicker().on('timechanged', function(e) {
        console.log(e.value);
        console.log(e.time);
    });

    // setting the value
    $('#next_time').mdtimepicker('setValue', '3:30 PM');

    // calling the `show` and `hide` functions
    $('#next_time').mdtimepicker('show');
    $('#next_time').mdtimepicker('hide');

    // destroying the timepicker
    $('#next_time').mdtimepicker('destroy');
</script>


<?php
/**
 * Created by Earrow.
 * User:Gihan Sanjeewa
 * Email:gihan@earrow.net
 * Date: 5/13/2024
 */
?>
<style>
    .embedded-daterangepicker .daterangepicker::before,
    .embedded-daterangepicker .daterangepicker::after {
        display: none;
    }

    .embedded-daterangepicker .daterangepicker {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        float: left;
        width: 100%;
        margin-top: 0;
    }

    .embedded-daterangepicker .daterangepicker .drp-calendar {
        width: 48% !important;
        max-width: 50%;
    }

    .select2-container .select2-selection--single {
        width: 315px !important;
        height: 35px !important;
    }

    .modal-body {
        /*max-height: calc(200vh - 250px);
        overflow-y: auto;*/
    }

    #classesInfo_filter {
        display: none;
    }

    .toggle {
        background-color: #ebebeb;
        border-color: #adadad;
    }

    .toggle.btn {

        min-width: 96px !important;
        min-height: 34px !important;

    }

    .table td .btn {
        padding: 8px 1px !important;
    }

    select.form-control:not([size]):not([]) {
        height: calc(1.5rem + 4px);
    }

    /* modal backdrop fix */



    label {
        font-size: 12px;
        color: black;
    }

    input {
        font-size: 12px;
    }

    .container-info {
        /* margin-top: 10px; */
        display: inline-block;
        position: relative;
        width: 100%;
        min-height: 490px;
        /* text-transform: uppercase; */
        font-size: 12px;
        /* background-color: red; */
    }

    @media (min-width: 768px) {
        .container-info {
            padding: 10px;
            float: left;
            /*position: fixed;*/
            left: 0;
            top: 0;
            height: 50%;
            font-size: 12px;
            width: 50%;
            border-right: 1px solid gray;
            /* text-transform: uppercase; */
        }
    }



    .container-main {
        /* margin-top: 10px; */
        display: inline-block;
        position: relative;
        width: 100%;
        min-height: 490px;
        font-size: 12px;

        /* background-color: grey; */
    }

    .container-main label {
        text-transform: uppercase;
    }


    @media (min-width: 768px) {
        .container-main {
            padding: 10px;
            float: right;
            /*position: fixed;*/
            right: 0;
            top: 0;
            height: 50%;
            font-size: 12px;
            width: 50%;
            /* text-transform: uppercase; */
        }
    }

    .modal-body .container-info form {
        height: 40%;
    }
</style>
<style>
    hr.new5 {
        border: 2px solid gray;

    }

    /* modal backdrop fix */

    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place front is invalid - may break your css so removed */
        padding-top: 100px;
        /* Location of the box - don't know what this does?  If it is to move your modal down by 100px, then just change top below to 100px and remove this*/
        left: 0;
        right: 0;
        /* Full width (left and right 0) */
        top: 0;
        bottom: 0;
        /* Full height top and bottom 0 */
        overflow: auto;
        /* Enable scroll if needed */

        z-index: 9999;
        /* Sit on top - higher than any other z-index in your site*/
    }
</style>

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Lead Management</a></li>
                <li class="breadcrumb-item active">Lead Details</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">
            </div>
            <div class="element-box">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" role="tab" href="#arrangement" data-toggle="tab">Lead Details</a></li>
                </ul>


                <br><br>
                <!-- Tab panes -->

                <div class="tab-content tabcontent-border">
                    <!--------tab1 - lead detils----------------------------------------------------->
                    <div class="tab-pane p-20 active" role="tabpanel" id="arrangement">

                        <div class="card-header bg-info page-head-title-wrap">
                            <h4 class="page-head-title card-title  text-white" style="display: inline-block">Lead
                                Details Report
                            </h4>

                            <?php $groups = array('admin', 'contact_centre_staff', 'student_counsellors', 'lead_manager', 'education_agents', 'lead_gent');
                            if ($this->ion_auth->in_group($groups)) { ?>
                                <button type="button" onclick="add_arrangement()" class="btn btn-primary pull-right" style="margin-right: -10px;"><i class="fa fa-plus"></i> Add New Lead</button>&nbsp;
                            <?php
                            }
                            ?>
                        </div>

                        <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                            <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="classesInfo" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="all" style="width: 30px">#</th>
                                        <th class="all">Customer Name</th>
                                        <th class="all">Email</th>
                                        <th class="all">Mobile </th>
                                        <th class="all">Lead Source</th>
                                        <th class="all">Industry</th>
                                        <th class="all">Deal</th>
                                        <th class="all">Product</th>
                                        <th class="all">Lead Type</th>
                                        <th class="all">Company Address</th>
                                        <th class="all">Associate Company</th>
                                        <th class="all">Bussiness Discription</th>
                                        <th class="all">Lead Status</th>
                                        <th class="all">Created At</th>
                                        <th class="all">Updated At</th>

                                        <th class="all text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <!-- Bootstrap modal -->
                <div class="modal fade" id="class_modal" role="dialog">
                    <div class="modal-dialog modal-full" style="max-width:60%">
                        <div class="modal-content">
                            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                <h6 id="class_modal_title" class="modal-title"></h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <form action="#" id="class_form" class="form-horizontal" role="form" method="post">

                                    <input type="hidden" name="inq_id" id="inq_id">
                                    <ul class="nav nav-tabs" role="tablist" id="myTabs">
                                        <li class="nav-item"><a class="nav-link active" role="tab" href="#inquiry" data-toggle="tab">Add Lead Module </a></li>
                                    </ul>


                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane p-20 active" role="tabpanel" id="inquiry">


                                            <div class="col-md-12 table-responsive" style="overflow-x:auto;">

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Customer's Title:<span style="color:red;">*</span></label>
                                                            <select class="form-control selectpicker" data-live-search="true" name="title" id="title">
                                                                <option value="">--Select--</option>
                                                                <?php
                                                                foreach ($title as $title) { ?>

                                                                    <option value="<?php echo $title->id; ?>">
                                                                        <?php echo $title->name; ?></option>

                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label>Customer's
                                                            First Name:<span style="color:red;">*</span></label>
                                                        <input type="text" name="f_name" id="f_name" class="form-control" size="16" required>
                                                        <span class="error-block"></span>
                                                        <p id="assign_date_alert" class="error" style="color: red">
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label>Customer's
                                                            Last Name:</label>
                                                        <input type="text" name="l_name" id="l_name" class="form-control" required>
                                                        <span class="error-block"></span>
                                                        <p id="assign_date_alert" class="error" style="color: red">
                                                        </p>

                                                    </div>

                                                    <div class="col-sm-6">
                                                        <label>Customer's Email:<span style="color:red;">*</span></label>

                                                        <input type="text" name="filter_email" id="filter_email" class="form-control" required>

                                                        <span class="error-block"></span>
                                                        <span id="result"></span>
                                                    </div>

                                                    <div class="col-sm-6" style="margin-top: 10px;">
                                                        <label>Industry :</label>
                                                        <select name="industry" id='industry' data-live-search="true" class="form-control selectpicker" required>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($industry as $other) { ?>
                                                                <option value="<?php echo $other->id; ?>">
                                                                    (<?php echo $other->code ?>)<?php echo $other->name ?>
                                                                </option>
                                                            <?php  }
                                                            ?>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>

                                                    <div class="col-sm-6" style="margin-top: 10px;">
                                                        <label>Deal :</label>
                                                        <select name="deal" id='deal' data-live-search="true" class="form-control selectpicker" required>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($deal as $other) { ?>
                                                                <option value="<?php echo $other->id; ?>">
                                                                    (<?php echo $other->code ?>)<?php echo $other->name ?>
                                                                </option>
                                                            <?php  }
                                                            ?>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>

                                                    <div class="col-sm-6" style="margin-top: 10px;">
                                                        <label>Product :</label>
                                                        <select name="product" id='product' data-live-search="true" class="form-control selectpicker" required>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($product as $other) { ?>
                                                                <option value="<?php echo $other->id; ?>">
                                                                    (<?php echo $other->code ?>)<?php echo $other->name ?>
                                                                </option>
                                                            <?php  }
                                                            ?>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>


                                                    <div class="col-sm-6">
                                                        <label>Customer's Mobile
                                                            Number:<span style="color:red;">*</span></label>
                                                        <input type="tel" name="filter_mobile" id="filter_mobile" class="form-control" style="width:100%; float: right;" maxlength="15" required>
                                                        <span class="error-block"></span>

                                                        <div class="alert alert-info1" style="display: none"></div>
                                                        <div class="alert alert-error1" style="display: none;font-size:9px;color:red;"></div>
                                                        <div id="load_student_data"></div>


                                                        <script>
                                                            var phoneInputField1 = document.querySelector("#filter_mobile");
                                                            var phoneInput = window.intlTelInput(phoneInputField1, {
                                                                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                                                            });

                                                            var info1 = document.querySelector(".alert-info1");
                                                            var error1 = document.querySelector(".alert-error1");
                                                        </script>




                                                        <input type="hidden" name="update_nw_id" id="update_nw_id" value="">
                                                        <input type="hidden" name="bulk_id" id="bulk_id" value="">

                                                    </div>


                                                    <div class="col-sm-6" style="margin-top:10px;">
                                                        <label>Lead Source:<span style="color:red;">*</span></label>

                                                        <select name="l_source" id='l_source' data-live-search="true" class="form-control selectpicker" required>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($lead_source as $source_nw) { ?>
                                                                <option value="<?php echo $source_nw->id; ?>">
                                                                    <?php echo $source_nw->source_title; ?></option>
                                                            <?php  }
                                                            ?>
                                                        </select>
                                                        <p id="course_name_alert" class="error" style="color: red">
                                                        </p>
                                                        <span class="error-block"></span>

                                                    </div>

                                                    <div class="col-sm-6" style="margin-top:10px;">
                                                        <div class="form-group">
                                                            <label>Compnay Address:</label>
                                                            <textarea name="address" id='address' class="form-control " required></textarea>
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6" style="margin-top: 10px;">
                                                        <label>Associate Company: </label>

                                                        <input type="text" name="company" id="company" class="form-control" required>

                                                        <span class="error-block"></span>
                                                    </div>


                                                    <div class="col-sm-6" style="margin-top:10px;">
                                                        <label>Lead Type :<span style="color:red;">*</span></label>
                                                        <select name="lead_type" id='lead_type' class="form-control selectpicker" data-live-search="true" required>
                                                            <option value="">--Select--</option>
                                                            <?php
                                                            foreach ($lead_type as $con) { ?>
                                                                <option data-livemember="<?php echo $con->id; ?>" value="<?php echo $con->id; ?>">
                                                                    <?php echo $con->name ?></option>
                                                            <?php  }
                                                            ?>
                                                        </select>
                                                        <span class="error-block"></span>
                                                        <p id="course_name_alert" class="error" style="color: red">
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-6" style="margin-top:10px;">
                                                        <div class="form-group">
                                                            <label>Bussiness Discription :</label>
                                                            <textarea name="discription" id='discription' class="form-control " required></textarea>
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>



                                                </div>

                                            </div>
                                            <!-- </form> -->
                                            <div class="modal-footer">
                                                <button type="button" id="arrangeBtn_1" onclick="save_information()" class="btn btn-primary">Save</button>
                                                <button type="button" class="btn btn-danger" onclick="cancel()" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!----------------------------------------------view lead details modal-------------------------------->

                <div class="modal fade" id="history_modal" role="dialog">
                    <div class="modal-dialog modal-full" style="max-width: 1400px">
                        <div class="modal-content">
                            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                <h6 style="color: white;" id="history_modal_title"></h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body form">

                                <input type="hidden" name="lead_history_id" id="lead_history_id">

                                <div>
                                    <div style="float: right;">
                                        <input type="hidden" name="partial_payment_id" id="partial_payment_id">
                                    </div>

                                    <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="all">#</th>
                                                <th class="all">Lead Status</th>
                                                <th class="all">Next contact date</th>
                                                <th class="all">Next contact Time</th>
                                                <th class="all">Modified By</th>
                                                <th class="all">Follow up Remarks</th>
                                                <th class="all">Created At</th>
                                                <th class="all">Updated At</th>

                                            </tr>
                                        </thead>
                                        <tbody id="module_data_id">
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!---------------------------------------------- lead status modal-------------------------------->

                <div class="modal fade" id="lead_modal" role="dialog">
                    <div class="modal-dialog modal-full" style="max-width: 600px">
                        <div class="modal-content">
                            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                <h6 id="lead_modal_title" class="modal-title"></h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body form">
                                <form action="#" id="status_update" class="form-horizontal">
                                    <div class="form-body">

                                        <div class="">
                                            <div class="form-group row">
                                                <label class="control-label col-md-4">Status:</label>
                                                <div class="col-md-6">
                                                    <input type="hidden" name="update_id" id="update_id" value="">
                                                    <select name="lead_status" id='lead_status' class="form-control selectpicker" data-live-search="true" required>
                                                        <option value="">--Select--</option>
                                                        <?php
                                                        foreach ($lead_update_status as $leads) {
                                                        ?>
                                                            <option value="<?php echo $leads->id; ?>"><?php echo $leads->name; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span class="error-block"></span>
                                                    <p id="course_name_alert" class="error" style="color: red">
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="form-group row" id="next3">
                                                <label class="control-label col-md-4">Next Contact Date:</label>
                                                <div class="col-md-6">

                                                    <input type="text" name="next_date" id="next_date" class="form-control date date-pick" size="16" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d'); ?>" required>
                                                    <span class="error-block"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row" id="next4">
                                                <label class="control-label col-md-4">Next Contact Time:</label>
                                                <div class="col-md-6">
                                                    <input type="type" name="next_time" id="next_time" value="<?php echo date('g:i A'); ?>" class="form-control" size="16" required>
                                                    <span>Time Format HH:MM(09:30 AM)</span>
                                                    <span class="error-block"></span>

                                                </div>
                                            </div>

                                            <div class="form-group row" id="next5">
                                                <label class="control-label col-md-4">follow-up Remarks:</label>
                                                <div class="col-md-6">
                                                    <textarea rows="3" cols="50" name="remarks" id="remarks" class="form-control" required></textarea>
                                                    <span class="error-block"></span>
                                                    <p id="assign_date_alert" class="error" style="color: red">
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="leadBtn" onclick="save_lead()" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>






                <script>
                    var save_method;

                    function add_arrangement() {
                        $('#searching').show();
                        save_method = 'add';
                        $('.selectpicker').selectpicker('refresh');
                        $('#class_form')[0].reset();
                        $('#arrangeBtn').show();
                        $('#class_modal_title').html('Add New Lead Details');
                        $('#class_modal').modal({
                            backdrop: 'static',
                            keyboard: false
                        });

                    }
                </script>

                <script>
                    var classesInfo;

                    $(document).ready(function() {

                        <?php if ($this->session->flashdata('message')) { ?>

                            bootbox.alert({
                                message: "<b style='text-align:center'><?php echo $this->session->flashdata('message') ?></b>",
                                size: 'small'
                            });

                        <?php } ?>

                        classesInfo = $('#classesInfo').DataTable({

                            "processing": true,
                            "serverSide": true,
                            "ajax": {
                                "data": {
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                "url": "<?php echo base_url() ?>lead_management/Lead_module_con/get_all_leads",
                                "type": "POST"
                            },

                            "columnDefs": [{
                                "targets": [-2], //last column
                                "orderable": false //set not orderable
                            }],
                            "aoColumns": [
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                null,
                                {
                                    "bSortable": false,
                                    "bSearchable": false
                                }
                            ],
                            rowCallback: function(row, data, index) {

                                    

                                if (data[12] == "Open (0%)") {
                                    $(row).find('td:eq(12)').html('<span style="background-color: blue;color: white;border-radius: 5px">&nbsp;&nbsp;' + data[12] + '&nbsp;&nbsp;</span>');
                                } else {
                                    $(row).find('td:eq(12)').html('<span style="background-color: green;color: white;border-radius: 5px">&nbsp;&nbsp;' + data[12] + '&nbsp;&nbsp;</span>');
                                }
                            },
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
                            "buttons": [{
                                    extend: 'print',
                                    text: '<i class="fa fa-print"></i>',
                                    titleAttr: 'Print',
                                    exportOptions: {
                                        columns: [0, 1, 2],
                                        orthogonal: 'export'
                                    }
                                },

                                {
                                    extend: 'copyHtml5',
                                    text: '<i class="fa fa-files-o"></i>',
                                    titleAttr: 'Copy',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: '<i class="fa fa-file-excel-o"></i>',
                                    titleAttr: 'Excel',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    }
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: '<i class="fa fa-file-text-o"></i>',
                                    titleAttr: 'CSV',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    text: '<i class="fa fa-file-pdf-o"></i>',
                                    titleAttr: 'PDF',
                                    exportOptions: {
                                        columns: [0, 1, 2]
                                    }
                                }
                            ],
                            responsive: true,
                            "order": [
                                [0, 'asc']
                            ],
                            "lengthMenu": [
                                [5, 10, 15, 20, -1],
                                [5, 10, 15, 20, "All"] // change per page values here
                            ],
                            "pageLength": 20,
                            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
                        });

                        classesInfo.on('order.dt search.dt', function() {
                            classesInfo.column(0, {
                                search: 'applied',
                                order: 'applied'
                            }).nodes().each(function(cell, i) {
                                cell.innerHTML = i + 1;
                            });
                        }).draw();

                        yadcf.init(classesInfo, [{
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 1
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 2
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 3
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 4
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 5
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 6
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 7
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 8
                        }, {
                            filter_type: "text",
                            filter_delay: 500,
                            column_number: 12
                        }], {
                            cumulative_filtering: false
                        });

                    });

                    function reload_table(table) {

                        if (typeof table !== "undefined") {
                            table.ajax.reload(null, false);
                        }

                    }

                    function save_information() {
                        $('.error-block').empty();
                        var url;
                        if (save_method == 'add') {
                            url = "<?php echo base_url('lead_management/Lead_module_con/save'); ?>";
                        } else {
                            url = "<?php echo base_url('lead_management/Lead_module_con/update'); ?>";
                        }

                        $.ajax({

                            url: url,
                            dataType: "JSON",
                            type: "POST",
                            data: $('#class_form').serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                            success: function(data) {

                                if (data.input_error) {
                                    for (var i = 0; i < data.input_error.length; i++) {
                                        // $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                                        $('[name="' + data.input_error[i] + '"]').parent().siblings("span.error-block").html(data.error_string[i]).show();
                                        $('[name="' + data.input_error[i] + '"]').siblings("span.error-block").html(data.error_string[i]).show();
                                    }
                                } else if (data.status == true) {

                                    reload_table(classesInfo);
                                    $('#class_modal').modal('hide');
                                    bootbox.alert({
                                        message: "<b style='text-align:center'>" + data.message + "</b>"
                                    });

                                } else {

                                    reload_table(classesInfo);
                                    $('#class_modal').modal('hide');
                                    bootbox.alert({
                                        message: "<b style='text-align:center;color: red'>" + data.message + "</b>"
                                    });
                                }
                            },
                            error: function() {
                                reload_table(classesInfo);
                                bootbox.alert({
                                    message: "<b style='text-align:center;color: red'>" + data.message + "</b>"
                                });
                            }

                        });

                    }

                    function save_lead(id) {

                        $('.error-block').empty();
                        $.ajax({

                            url: "<?php echo base_url('lead_management/Lead_module_con/update_status'); ?>",
                            dataType: "JSON",
                            type: "POST",
                            data: $('#status_update').serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                            // data: $('#status_update').serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",

                            success: function(data) {
                                console.log(data);
                                if (data.input_error) {
                                    for (var i = 0; i < data.input_error.length; i++) {
                                        $('[name="' + data.input_error[i] + '"]').parent().siblings(
                                            "span.error-block").html(data.error_string[i]).show();
                                        $('[name="' + data.input_error[i] + '"]').siblings(
                                            "span.error-block").html(data.error_string[i]).show();
                                    }
                                } else if (data.status == true) {
                                    reload_table(classesInfo);
                                    $('#lead_modal').modal('hide');
                                    bootbox.alert({
                                        message: "<b style='text-align:center'>" + data.message +
                                            "</b>"
                                    });
                                } else {

                                    reload_table(classesInfo);

                                    bootbox.alert({
                                        message: "<b style='text-align:center'>" + data.message +
                                            "</b>"
                                    });
                                }
                            },
                            error: function() {
                                // $('#leadBtn').attr('disabled', false);
                                reload_table(classesInfo);
                                reload_table(allocationInfo);
                            }

                        });

                    }


                    function edit_lead(id) {
                        $('.error-block').empty();
                        save_method = 'update';
                        $('#class_form')[0].reset();

                        $.ajax({

                            url: "<?php echo base_url('lead_management/Lead_module_con/get_lead'); ?>",
                            dataType: "JSON",
                            type: "POST",
                            data: {
                                id: id,
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },
                            success: function(data) {

                                $('#inq_id').val(data.lead.id);

                                $('#title').val(data.lead.title);
                                $('#f_name').val(data.lead.f_name);
                                $('#l_name').val(data.lead.l_name);
                                $('#filter_email').val(data.lead.filter_email);
                                $('#industry').val(data.lead.industry);
                                $('#deal').val(data.lead.deal);
                                $('#product').val(data.lead.product);
                                $('#filter_mobile').val(data.lead.filter_mobile);
                                $('#l_source').val(data.lead.l_source);
                                $('#address').val(data.lead.address);
                                $('#company').val(data.lead.company);
                                $('#lead_type').val(data.lead.lead_type);
                                $('#discription').val(data.lead.discription);
                                $('.selectpicker').selectpicker('refresh');


                                $('#lead_modal_title').html('Edit lead Info ' + data.lead.source_title);
                                $('#class_modal').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });

                            },
                            error: function() {
                                alert("error retrieve pending lead info");
                            }
                        });

                    }
                </script>


                <script>
                    function view_lead(id) {

                        $('#module_data_id').html("");
                        $('.error-block').empty();
                        $.ajax({

                            url: "<?php echo base_url('lead_management/Lead_module_con/view_history'); ?>/" + id,
                            type: "POST",
                            dataType: "JSON",
                            data: {
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },

                            success: function(data) {

                                var x = 1;
                                for (var i = 0; i < data.histories.length; i++) {

                                    const Lead_status_details = data.histories[i].Lead_status_details ? data.histories[i].Lead_status_details : "";
                                    const next_contact_date = data.histories[i].next_contact_date ? data.histories[i].next_contact_date : "";
                                    const next_contact_time = data.histories[i].next_contact_time ? data.histories[i].next_contact_time : "";
                                    const full_name = data.histories[i].full_name ? data.histories[i].full_name : "";
                                    const remarks = data.histories[i].remarks ? data.histories[i].remarks : "";
                                    const updated_at = data.histories[i].updated_at ? data.histories[i].updated_at : "";
                                    const created_at = data.histories[i].created_at ? data.histories[i].created_at : "";

                                    $('#module_data_id').append('<tr>' +
                                        '<td style=>' + x + '</td>' +
                                        '<td style=>' + Lead_status_details + '</td>' +
                                        '<td>' + next_contact_date + '</td>' +
                                        '<td>' + next_contact_time + '</td>' +
                                        '<td>' + full_name + '</td>' +
                                        '<td>' + remarks + '</td>' +
                                        '<td>' + created_at + '</td>' +
                                        '<td>' + updated_at + '</td>' +

                                        '</tr>');

                                    x++;
                                }
                                // $('#history_modal_title').text(' Update Status Info');
                                $('#history_modal').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });

                            },
                            error: function(jqXHR, textStatus, errorThrown) {

                                console.log(jqXHR);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }

                        });

                    }

                    function update_lead_status(id) {
                        // $('#lead_modal').modal('show');
                        $('#lead_modal_title').html('Update Lead Status');
                        $('#status_update')[0].reset();
                        $.ajax({
                            url: "<?php echo base_url('lead_management/Lead_module_con/get_lead_status_data'); ?>/" + id,
                            dataType: "JSON",
                            type: "POST",
                            data: {
                                id: id,
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },

                            success: function(data) {


                                $('#update_id').val(id);
                                $('#lead_status').val(data.lead_status.lead_status);
                                // $('#get_data').val(data.lead_status.deal);
                                $('.selectpicker').selectpicker('refresh');
                                $('#lead_modal').modal({
                                    backdrop: 'static',
                                    keyboard: false
                                });

                            },
                            error: function() {
                                alert("error retrieve pending lead info");
                            }
                        });
                    }
                </script>