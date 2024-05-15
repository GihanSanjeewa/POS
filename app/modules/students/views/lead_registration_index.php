<link rel="stylesheet"
    href="<?php echo base_url('assets/plugins/intl-tel-input-master/build/css/intlTelInput.css'); ?>" />
<style>
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
<script type="text/javascript"> 
// function display_c(){
// var refresh=1000; // Refresh rate in milli seconds
// mytime=setTimeout('display_ct()',refresh)
// }

// function display_ct() {
// var today = new Date()
// var x = today.getMinutes(10) + ":" + today.getSeconds();
// document.getElementById('ct').innerHTML = x;
// display_c();
//  }
</script>

<script src="<?php echo base_url('assets/plugins/intl-tel-input-master/build/js/intlTelInput.min.js'); ?>"></script>
<div class="row">
    <div class="col-md-12">

        <div class="element-wrapper">

            <div  class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Student Management - Registration ID :- <?php echo $registration_id;?><span id='ct' ></span></h4>
            </div>

            <div class="element-box">
                <form id="student_form" class="form-material" enctype="multipart/form-data">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="hidden" name="std_id" id="std_id">
                    <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
                    <input type="hidden" name="registration_id" id="registration_id" value="<?php echo $registration_id;?>">
                    
                    <fieldset>
                                <legend>PROGRAM INFORMATION</legend>
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <input type="hidden" name="application_id" id="application_id" value="">
                                            <label for="">Program :</label>
                                            <select name="program" id="program" class="selectpicker"  data-live-search="true"   data-parsley-group="block0" required  data-parsley-required data-parsley-errors-container="#programError" data-container="body"  data-parsley-error-message="Program is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                                <option value="">-- Select --</option>
                                                
                                            </select>
                                            <span id="programError" class="error"></span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Batch & Intake :</label>
                                            <select name="batch" id="batch" class=" selectpicker"  data-live-search="true" data-parsley-group="block0" required  data-parsley-required data-parsley-errors-container="#batchError" data-container="body"  data-parsley-error-message="Batch is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            </select>
                                            <span id="batchError" class="error"></span>
                                        </div>
                                    </div>
                                </div> -->
                                <hr>
                                <div class="row">
                                    <!-- <div class="col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">University :</label>
                                            <select name="university" id="university" class=" selectpicker"  data-live-search="true" data-parsley-group="block0" required  data-parsley-required data-parsley-errors-container="#universityError" data-container="body"  data-parsley-error-message="University is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                            </select>
                                            <span id="universityError" class="error"></span>
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-sm-6 col-lg-6">
                                        <div id="uni_path_data" class="form-group" style="display: none">
                                            <label for="">Study Years ( Local ) : - Minimum Years <span id="min_years_local"><strong></strong></span></label>
                                            <div id="sty_local_data">

                                            </div>

                                            
                                        </div>
                                    </div> -->

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
                                                <input type="text" class="form-control" value="<?php echo $registration_data->f_name;?>" name="st_f_name" id="st_f_name" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-4">
                                            <div class="form-group">
                                                <label for="">Middle Name:</label>
                                                <input type="text" class="form-control" value="<?php echo $registration_data->mid_name;?>" name="st_m_name" id="st_m_name">
                                                <span class="error"></span>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="">Last Name:</label>
                                                <input type="text" class="form-control" value="<?php echo $registration_data->l_name;?>" name="st_l_name" id="st_l_name" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$">
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
                                                <input type="text" class="form-control" value="<?php echo $registration_data->nic_div;?>" name="st_nic_num" id="st_nic_num">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="">Passport Number:</label>
                                                <input type="text" class="form-control" value="<?php echo $registration_data->passport_div;?>" name="st_passport_num" id="st_passport_num">
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
                                                <textarea rows="1" class="form-control"   name="st_current_address" id="st_current_address" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-error-message="Permanent Address is required" data-parsley-trigger-after-failure="focusout changed.bs.select"><?php echo $registration_data->address1;?>,<?php echo $registration_data->address2;?>,<?php echo $registration_data->city;?>,<?php echo $registration_data->state_pro;?>,<?php echo $registration_data->zip_pos;?></textarea>
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="">Telephone No. (Mobile):</label>
                                                <br>
                                                <input type="number" class="form-control" style="width: 428px;" value="<?php echo $registration_data->l_phone;?>" name="st_phone_no" id="st_phone_no" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-type="digits" >
                                                <span class="error"></span>
                                                <div class="alert alert-info_ag" style="display: none"></div>
                                                <div class="alert alert-error_ag" style="display: none;font-size:9px;color:red;"></div>
                                            </div>
                                        </div>
                                                

                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="">Telephone No. (Residence):</label>
                                                <input type="number" class="form-control" style="width: 428px;" value="<?php echo $registration_data->l_phone_2;?>" name="st_home_no" id="st_home_no" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-type="digits" >
                                                <span class="error"></span>
                                                <div class="alert alert-info_ag_home" style="display: none"></div>
                                                <div class="alert alert-error_ag_home" style="display: none;font-size:9px;color:red;"></div>
                                            </div>
                                        </div>

                                        <script>
                                                var phoneInputField_ag = document.querySelector("#st_phone_no");
                                                var phoneInput_ag = window.intlTelInput(phoneInputField_ag, {
                                                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                                                });

                                                var info_ag = document.querySelector(".alert-info_ag");
                                                var error_ag = document.querySelector(".alert-error_ag");

                                                var phoneInputField_ag_home = document.querySelector("#st_home_no");
                                                var phoneInput_ag_home = window.intlTelInput(phoneInputField_ag_home, {
                                                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                                                });

                                                var info_ag_home = document.querySelector(".alert-info_ag_home");
                                                var error_ag_home = document.querySelector(".alert-error_ag_home");
                                                </script>

                                        <div class="col-sm-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="">Personal Email:</label>
                                                <input type="email" class="form-control" value="<?php echo $registration_data->l_email;?>" name="st_email" id="st_email" data-parsley-group="block1" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select">
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-6 col-lg-3">
                                            <div class="form-group">
                                                <label for="">School Email:</label>
                                                <input type="email" class="form-control" name="st_email_school" id="st_email_school">
                                                <span class="error"></span>
                                            </div>
                                        </div> -->
                                        
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
                                            
                                                <select name="st_country_of_birth" id="st_country_of_birth" class="form-control selectpicker"  data-live-search="true" data-parsley-group="block2" required data-parsley-required data-parsley-errors-container="#countryOfBirthError" data-container="body"  data-parsley-error-message="Country of Birth is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                                <option value="">-- Select --</option>
                                                        <?php
                                                        foreach ($countries as $country) {
                                                            echo '<option value="' . $country->id . '">' . $country->name . '</option>';
                                                        }
                                                        ?>
                                                </select>
                                                <span class="error"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="">Citizenship:</label>
                                                <select name="st_citizenship" id="st_citizenship" class="form-control selectpicker"  data-live-search="true" data-parsley-group="block2" required data-parsley-required data-parsley-errors-container="#citizenshipError" data-container="body"  data-parsley-error-message="Citizenship is required" data-parsley-trigger-after-failure="focusout changed.bs.select">
                                                <option value="">-- Select --</option>
                                                        <?php
                                                        foreach ($citizenships as $citizenship) {
                                                            echo '<option value="' . $citizenship->id . '">' . $citizenship->name . '</option>';
                                                        }
                                                        ?>
                                                </select>
                                                <!-- <input type="text" class="form-control" name="" id="" data-parsley-group="block2" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-pattern="^[a-zA-Z\s]*$"> -->
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
                                        <label for="">Workplace:</label>
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
                                        <br>
                                        <input type="number" class="form-control" style="width: 888px;" name="st_emp_office_phone" id="st_emp_office_phone" data-parsley-group="block3"  data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10">
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
                                        <input type="number" name="st_emergency_r_no" style="width: 580px;" id="st_emergency_r_no" class="form-control"  data-parsley-group="block5" required data-parsley-required data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select" data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10" >
                                        <span class="error"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="">Office Contact No</label>
                                        <input type="number" name="st_emergency_r_off_no" style="width: 580px;" id="st_emergency_r_off_no" class="form-control" data-parsley-group="block5"  data-container="body"  data-parsley-trigger-after-failure="focusout changed.bs.select"  data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="10">
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
                                <!-- <div class="col-sm-12 col-lg-12">
                                    <div class="form-group" >
                                        <label for="">Counselor's Remarks:
                                        </label>
                                        <textarea rows="3" class="form-control" name="st_fs_remarks" id="st_fs_remarks"></textarea>
                                        <span class="error"></span>
                                    </div>
                                </div> -->
                            </div>
                        
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
        </div>
    </div>
</div>

<hr>
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
<!-- ############################ Student Mangement ################################## -->

<script type="text/javascript">

        $.ajax({
            url: "<?php echo base_url('students/IIHSRegistration/get_programs_data'); ?>",
            type: "POST",
            dataType: "JSON",
            data:{
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(data){

                $('#program').html('<option value="">-- Select--</option>');
                for(var i=0;i<data.courses_list.length;i++){
                    $('#program').append('<option value="'+data.courses_list[i].id+'">'+data.courses_list[i].code+' - '+data.courses_list[i].name+'</option>');
                }
                 if(<?php echo $registration_data->programe?>){
                    $('#program').val(<?php echo $registration_data->programe?>);
                 }
                 $('.selectpicker').selectpicker('refresh');

                 load_batch_data(<?php echo $registration_data->programe?>,<?php echo $registration_data->batch_id?>);


            },
            error:function (jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
$('#program').change(function () {

        

        var program_id = $('#program').val();
       // load_batch_data(program_id,null);

        
    });

    // function load_batch_data(program_id,batch_id){
    //     $('#university').empty();
    //     $('#uni_path_data').hide();
    //     $('#pathway_option').hide();
    //     $("#st_min_years_local").empty();
    //     $("#min_years_local").html('');
    //     var application='';
    //     //$('#university').html('<option value="">(---)</option>');
    //     $.ajax({
    //         async: false,
    //         url: "<?php echo site_url('students/students_con/get_programe_id'); ?>",
    //         type: "POST",
    //         data: {
    //             "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash() ?>",
    //             "program_id": program_id
    //         },
    //         dataType: "JSON",
    //         success: function(data)
    //         {
    //             // console.log(data);

    //             application = data.program_details.application_type;
    //             $('#application_id').val(data.program_details.application_type);


    //             $('#batch').html('<option value="">(---)</option>');
    //             for(var b=0;b<data.batch_details.length;b++){
    //                 $('#batch').append('<option value="'+data.batch_details[b].id+','+data.batch_details[b].intake_id+'">('+data.batch_details[b].batch_code+') '+data.batch_details[b].intake_name+'-'+data.batch_details[b].year+'</option>');
    //             }
    //             if(batch_id){
    //                 alert(batch_id);
    //                 $('#batch').val(batch_id);
    //              }
    //              $('.selectpicker').selectpicker('refresh');

                
    //             $('.selectpicker').selectpicker('refresh');
    //             $('#university').html('<option  value="">(---)</option>');
    //             for(var i=0;i<data.program_uni_data.length;i++){
    //                 $('#university').append('<option value="'+data.program_uni_data[i].university_id+'">'+data.program_uni_data[i].name+'</option>');
    //             }
    //             $('.selectpicker').selectpicker('refresh');

    //         }
    //     });

    //     if(application==3 || application==6 || application==4){
    //         $('.gce_ol').hide();
    //         $('.gce_al').hide();
    //     }else if(application==5 || application==2){
    //         $('.gce_ol').hide();
    //     }


    // }



    $('#university').change(function(){
        var program=document.getElementById("program").value;
        //console.log(program);
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

        $("#st_nic_num").focusout(function() {
            var nic = $(this).val();
            if($(this).val()!=='') {
                $.ajax({
                    url: "<?php echo base_url('students/registration/check_nic_valid'); ?>",
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

        var url_new = "<?php echo base_url('students/registration/get_countries'); ?>";
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

                    // phone number validation
                    var phoneNumber2 = phoneInput_ag.getNumber();
                        var phoneNumber3 = phoneInput_ag_home.getNumber();

                        info_ag.style.display = "none";
                        error_ag.style.display = "none";
                        error_ag_home.style.display = "none";
                        info_ag_home.style.display = "none";
                        
                        if (phoneInput_ag.isValidNumber()) {
                            info_ag.style.display = "";
                          //  info_ag.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber2}</strong>`;
                        } else {
                            error_ag.style.display = "";
                            error_ag.innerHTML = `Invalid phone number.`
                            valid = false;
                        }

                        if (phoneInput_ag_home.isValidNumber()) {
                            info_ag_home.style.display = "";
                           // info_ag_home.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber3}</strong>`;
                        } else {
                            error_ag_home.style.display = "";
                            error_ag_home.innerHTML = `Invalid phone number.`
                            valid = false;
                        }

                        
                        //end phone number validation     

                     
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

                    url = "<?php echo base_url('students/IIHSRegistration/insert'); ?>";

                   // var fileInputs = $('.st_rpq_file');

                   var fileInputs_ol = $('.st_file_ol');
                   var fileInputs_al = $('.st_file_al');

                    var fileInputs_hepq = $('.st_hepq_file');
                    var fileInputs_ceq = $('.st_ceq_file');

                    var formData = new FormData();

                    var st_photo = $('#st_photo').prop('files')[0];
                   // var st_file_ol = $('#st_file_ol').prop('files')[0];
                  //  var st_file_al = $('#st_file_al').prop('files')[0];
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
                    }

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
                                $('#student_form')[0].reset();
                                sfw.addSpinner('finish',false);
                                bootbox.alert(data.message);

                                setTimeout(function(){
                                window.location.href = 'https://iihsciences.edu.lk/';
                                }, 3000);
                                // sfw.goTo(0);
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

                var ST_OL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ol).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_ol+'</td>' +
                    '<td>' +
                    '<input type="text" name="st_ol_subject['+counter_st_ol+']" id="st_ol_subject'+counter_st_ol+'" value="">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_ol_grade['+counter_st_ol+']" id="st_ol_grade'+counter_st_ol+'" value="">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_ol + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

            ST_OL_Table.after().html(html_data);
            counter_st_ol++;

            ST_OL_Table.appendTo("#ST_OL_Table tbody");
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

                var ST_AL_Table = $(document.createElement('tr')).attr("id", 'row_al_' + counter_st_al).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_al+'</td>' +
                    '<td>' +
                    '<input type="text" name="st_al_subject['+counter_st_al+']" id="st_al_subject'+counter_st_al+'" value="">' +
                    '</td>' +
                    '<td>'+
                    '<input type="text" name="st_al_grade['+counter_st_al+']" id="st_al_grade'+counter_st_al+'" value="">' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter_st_al + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

            ST_AL_Table.after().html(html_data);
            counter_st_al++;

            ST_AL_Table.appendTo("#ST_AL_Table tbody");
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
                // 
                        //st_country_of_birth                
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
            
            var url_new = "<?php echo base_url('students/IIHSRegistration/get_countries'); ?>";
        $('#st_hepq_uni'+counter_st_hepq).typeahead({
            source:  function (query, process) {
                return $.get(url_new, { query: query }, function (data) {
                    console.log(data);
                    data = $.parseJSON(data);
                    return process(data);
                });
            }
        });

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

            $('#st_qualified_status_yes').html('<label>RPL Note</label><textarea rows="1" class="form-control" name="st_qualified_status_note" id="st_qualified_status_note" data-parsley-group="block10" ></textarea><hr><label>Marketing Discount - </label> <input type="checkbox" id="mak_disc_status" name="mak_disc_status" value="1">');

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

</script>

