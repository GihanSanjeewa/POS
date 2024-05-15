<style>
    label {
        margin-bottom: 0px;
        color: #000;
        font-weight: 500;
    }
    table.df th {
        padding: 4px;
        min-width: 30px;
    }
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
        background: #4e4c80;
        padding: 5px;
        color: #fff;
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
</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">HOME</a></li>
                <li class="breadcrumb-item active">ENROLLMENT</li>
            </ol>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">
            </div>
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Student Register</h4>
            </div>
            <div class="element-box">
                <form action="#" id="add_temp_stu_form" class="form-horizontal" role="form" method="post">
                    <div class="form-body" style="margin: 15px">
                        <div id="intake_here_div"></div>
                        <input type="hidden" name="id" id="id">
                        <h3 class="text-center">INTERNATIONAL INSTITUTE OF HEALTH SCIENCES</h3>
                        <h5 class="text-center " style="text-decoration: underline; ">GENERAL APPLICATION FORM</h5>
                        <p style="font-style: italic">Please note that you are advised to provide accurate and detailed information as required.</p>
                        <h4  class="sub-head" style="width: 100%">Course Info</h4>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Course:</label>
                                    <select name="course" id="course" class="form-control selectpicker"  data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        foreach ($courses as $course) {
                                            echo '<option value="' . $course->id . '">' . $course->name . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Year:</label>
                                    <input type="text" name="ol_year" id="ol_year" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for=""></label>
                                    <input type="text" name="ol_year" id="ol_year" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4  class="sub-head" style="width: 100%">PART A: PERSONAL INFORMATION</h4>
                        <div class="row">
                            <div class="col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">Title:</label>
                                    <select name="title" id="title" class="form-control selectpicker" data-live-search="true">
                                        <option value=""></option>
                                        <option value="Rev">Rev</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Ms">Miss.</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Full Name (as per NIC/ Passport):</label>
                                    <input type="text" class="form-control" name="temp_name" id="temp_name">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">Gender:</label>
                                    <select name="temp_gender" id='temp_gender' class="form-control  selectpicker"  required>
                                        <option></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">Age:</label>
                                    <input type="text" class="form-control" name="temp_age" id="temp_age">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">NIC Number:</label>
                                    <input type="text" class="form-control" name="temp_nic_num" id="temp_nic_num">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Passport Number:</label>
                                    <input type="text" class="form-control" name="temp_passport_num" id="temp_passport_num">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Birthday:</label>
                                    <input type="text" class="form-control date-pick date" placeholder="Date" data-date-format="yyyy-mm-dd" name="temp_birthday" id="temp_birthday">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Civil Status:</label>
                                    <select name="marital_status" id="marital_status" class="form-control selectpicker">
                                        <option value=""></option>
                                        <option value="Married">Married</option>
                                        <option value="Single">Single</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Permanent Address:</label>
                                    <textarea rows="1" class="form-control" name="temp_current_address" id="temp_current_address"></textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Telephone No. (Residence):</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Telephone No. (Mobile):</label>
                                    <input type="text" class="form-control" name="temp_home_no" id="temp_home_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <label for="">Email:</label>
                                    <input type="text" class="form-control" name="temp_current_email" id="temp_current_email" >
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART B: RESIDENCY AND OTHER DETAILS</h4>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Country of Birth:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Citizenship:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <p style="border-bottom: 1px solid #2c1765;">For International Students</p>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group row">
                                    <label class="col-sm-9 col-form-label">Do you hold a valid Sri Lankan Visa:</label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label"><input class="form-check-input" onclick="javascript:yesnoCheck();" name="optionsRadios" type="radio" id="option_yes" value="option_yes">YES</label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label"><input class="form-check-input" onclick="javascript:yesnoCheck();"  name="optionsRadios" type="radio" id="option_no"  value="option_no">NO</label>
                                        </div>
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group type_visa" style="display: none"  >
                                    <label for="">Type of Visa:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group type_visa" style="display: none" >
                                    <label for="">Visa expiry date:</label>
                                    <input type="text"  name="inst_to_4" id="inst_to_4" class="form-control date-pick date" placeholder="Date" data-date-format="yyyy-mm-dd">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART C: EMPLOYMENT DETAILS</h4>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Designation:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Official Address:</label>
                                    <textarea rows="1" class="form-control" name="temp_current_address" id="temp_current_address"></textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Telephone:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">E-mail:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>


                        <hr>

                        <h4 class="sub-head">PART D: ACADEMIC QUALIFICATION</h4>

                        <p class="acc_head">G.C.E. Ordinary Level</p>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label for="">School Attended:
                                    </label>
                                    <input type="text" name="ol_year" id="ol_year" class="form-control" >
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Year</label>
                                    <input type="text" name="ol_year" id="ol_year" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="marital_status" id="marital_status" class="form-control selectpicker">
                                        <option value=""></option>
                                        <option value="1">Local - Sinhala</option>
                                        <option value="1">Local - English</option>
                                        <option value="1">Local - Tamil</option>
                                        <option value="2">London - Cambridge</option>
                                        <option value="2">London - Edexel</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <table class="df" style="width: 100%">
                                    <tr>
                                        <th class="td_head_reg" style="width: 30px !important;">#</th>
                                        <th class="td_head_reg" style="width: 85% !important;">Subject</th>
                                        <th class="td_head_reg" style="width: 10% !important;">Grade</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control" name="ol_subject_1" id="ol_subject_1" value="Sinhala"></td>
                                        <td><input type="text" class="form-control" name="ol_result_1" id="ol_result_1"></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><input type="text" class="form-control" name="ol_subject_2" id="ol_subject_2" value="English"></td>
                                        <td><input type="text" class="form-control" name="ol_result_2" id="ol_result_2" ></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td><input type="text" class="form-control" name="ol_subject_3" id="ol_subject_3" value="Mathematics"></td>
                                        <td><input type="text" class="form-control" name="ol_result_3" id="ol_result_3" ></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td><input type="text" class="form-control" name="ol_subject_4" id="ol_subject_4" value="History"></td>
                                        <td><input type="text" class="form-control" name="ol_result_4" id="ol_result_4" ></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td><input type="text" class="form-control" name="ol_subject_5" id="ol_subject_5" value="Science"></td>
                                        <td><input type="text" class="form-control" name="ol_result_5" id="ol_result_5" ></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td><input type="text" class="form-control" name="ol_subject_6" id="ol_subject_6" value="Religion"></td>
                                        <td><input type="text" class="form-control" name="ol_result_6" id="ol_result_6" ></td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td><input type="text" class="form-control" name="ol_subject_7" id="ol_subject_7"></td>
                                        <td><input type="text" class="form-control" name="ol_result_7" id="ol_result_7" ></td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td><input type="text" class="form-control" name="ol_subject_8" id="ol_subject_8"></td>
                                        <td><input type="text" class="form-control" name="ol_result_8" id="ol_result_8" ></td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td><input type="text" class="form-control" name="ol_subject_9" id="ol_subject_9"></td>
                                        <td><input type="text" class="form-control" name="ol_result_9" id="ol_result_9" ></td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td><input type="text" class="form-control" name="ol_subject_10" id="ol_subject_10"></td>
                                        <td><input type="text" class="form-control" name="ol_result_10" id="ol_result_10" ></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <p  class="acc_head">G.C.E. Advanced Level </p>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Year</label>
                                    <input type="text" name="al_year" id="al_year" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">Type</label>
                                    <select name="marital_status" id="marital_status" class="form-control selectpicker">
                                        <option value=""></option>
                                        <option value="1">Local - Sinhala</option>
                                        <option value="1">Local - English</option>
                                        <option value="1">Local - Tamil</option>
                                        <option value="2">London - Cambridge</option>
                                        <option value="2">London - Edexel</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <table class="df" style="width: 100%">
                                    <tr>
                                        <th class="td_head_reg" style="width: 30px !important;">#</th>
                                        <th class="td_head_reg" style="width: 85% !important;">Subject</th>
                                        <th class="td_head_reg" style="width: 10% !important;">Result</th>
                                    </tr>
                                    <tr>
                                        <td> 1 </td>
                                        <td><input type="text" class="form-control" name="al_subject_1" id="al_subject_1" value="General English"></td>
                                        <td><input type="text" class="form-control" name="al_result_1" id="al_result_1"></td>
                                    </tr>
                                    <tr>
                                        <td> 2 </td>
                                        <td><input type="text" class="form-control" name="al_subject_2" id="al_subject_2"></td>
                                        <td><input type="text" class="form-control" name="al_result_2" id="al_result_2" ></td>
                                    </tr>
                                    <tr>
                                        <td> 3 </td>
                                        <td><input type="text" class="form-control" name="al_subject_3" id="al_subject_3"></td>
                                        <td><input type="text" class="form-control" name="al_result_3" id="al_result_3" ></td>
                                    </tr>
                                    <tr>
                                        <td> 4 </td>
                                        <td><input type="text" class="form-control" name="al_subject_4" id="al_subject_4"></td>
                                        <td><input type="text" class="form-control" name="al_result_4" id="al_result_4" ></td>
                                    </tr>
                                    <tr>
                                        <td> 5 </td>
                                        <td><input type="text" class="form-control" name="al_subject_5" id="al_subject_5"></td>
                                        <td><input type="text" class="form-control" name="al_result_5" id="al_result_5" ></td>
                                    </tr>
                                    <tr>
                                        <td> 6 </td>
                                        <td><input type="text" class="form-control" name="al_subject_6" id="al_subject_6"></td>
                                        <td><input type="text" class="form-control" name="al_result_6" id="al_result_6" ></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <p  class="acc_head">Higher Education / Professional Qualifications</p>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <table class="df table" style="width: 100%">
                                    <tr>
                                        <th class="td_head_reg" style="width: 30px !important;">#</th>
                                        <th class="td_head_reg" style="width: 30%" colspan="3">Name of the University / Professional Body</th>
                                        <th class="td_head_reg" style="width: 30%" colspan="3">Degree / Diploma Awarded</th>
                                        <th class="td_head_reg" style="width: 15%">From</th>
                                        <th class="td_head_reg" style="width: 15%" >To</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(i)</td>
                                        <td colspan="3"><input name="inst_1" id="inst_1" class="form-control"></td>
                                        <td colspan="3"><input name="inst_1" id="inst_1" class="form-control"></td>
                                        <td><input name="inst_from_1" id="inst_from_1" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_1" id="inst_to_1" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(ii)</td>
                                        <td colspan="3"><input name="inst_2" id="inst_2" class="form-control"></td>
                                        <td colspan="3"><input name="inst_2" id="inst_2" class="form-control"></td>
                                        <td><input name="inst_from_2" id="inst_from_2" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_2" id="inst_to_2" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(iii)</td>
                                        <td colspan="3"><input name="inst_3" id="inst_3" class="form-control"></td>
                                        <td colspan="3"><input name="inst_3" id="inst_3" class="form-control"></td>
                                        <td><input name="inst_from_3" id="inst_from_3" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_3" id="inst_to_3" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(iv)</td>
                                        <td colspan="3"><input name="inst_4" id="inst_4" class="form-control"></td>
                                        <td colspan="3"><input name="inst_4" id="inst_4" class="form-control"></td>
                                        <td><input name="inst_from_4" id="inst_from_4" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_4" id="inst_to_4" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(v)</td>
                                        <td colspan="3"><input name="inst_5" id="inst_5" class="form-control"></td>
                                        <td colspan="3"><input name="inst_5" id="inst_5" class="form-control"></td>
                                        <td><input name="inst_from_5" id="inst_from_5" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_5" id="inst_to_5" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <p  class="acc_head">Current Educational Qualification</p>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <table class="df table" style="width: 100%">
                                    <tr>
                                        <th class="td_head_reg" style="width: 30px !important;">#</th>
                                        <th class="td_head_reg" style="width: 30%" colspan="3">Name of the University / Professional Body</th>
                                        <th class="td_head_reg" style="width: 30%" colspan="3">Degree / Diploma Awarding</th>
                                        <th class="td_head_reg" style="width: 15%">From</th>
                                        <th class="td_head_reg" style="width: 15%" >To</th>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(i)</td>
                                        <td colspan="3"><input name="inst_1" id="inst_1" class="form-control"></td>
                                        <td colspan="3"><input name="inst_1" id="inst_1" class="form-control"></td>
                                        <td><input name="inst_from_1" id="inst_from_1" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_1" id="inst_to_1" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(ii)</td>
                                        <td colspan="3"><input name="inst_2" id="inst_2" class="form-control"></td>
                                        <td colspan="3"><input name="inst_2" id="inst_2" class="form-control"></td>
                                        <td><input name="inst_from_2" id="inst_from_2" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_2" id="inst_to_2" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 30px !important;">(iii)</td>
                                        <td colspan="3"><input name="inst_3" id="inst_3" class="form-control"></td>
                                        <td colspan="3"><input name="inst_3" id="inst_3" class="form-control"></td>
                                        <td><input name="inst_from_3" id="inst_from_3" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                        <td><input name="inst_to_3" id="inst_to_3" class="form-control year-pick date" placeholder="Year" data-date-format="yyyy"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART E: PERSON TO BE CONTACTED IN A CASE OF EMERGENCY</h4>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="">Name of Respondent</label>
                                    <input type="text" name="respondent_name" id="respondent_name" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="">Relationship with Respondent</label>
                                    <select name="relation_respondent" id="relation_respondent" class="form-control selectpicker">
                                        <option value="">-- Select --</option>
                                        <option value="mother">Mother</option>
                                        <option value="father">Father</option>
                                        <option value="sister">Sister</option>
                                        <option value="brother">Brother</option>
                                        <option value="other">Other</option>
                                    </select>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="">Occupation of Respondent</label>
                                    <input type="text" name="occupation_respondent" id="occupation_respondent" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="">Contact Number</label>
                                    <input type="number" name="respondent_no" id="respondent_no" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="">Office Contact No</label>
                                    <input type="number" name="respondent_off_no" id="respondent_off_no" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="text" name="respondent_email" id="respondent_email" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART F: AWARENESS ON IIHS PROGRAMMES</h4>
                        <div class="row">
                            <div class="col-sm-6 col-lg-6">
                                <div class="form-group">
                                    <label for="">How did you get to know about our Programmes? (Select from the followings)</label>
                                    <select  onclick="javascript:knowProgrammes();" name="know_programmes" id="know_programmes" class="form-control selectpicker"  data-live-search="true">
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
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-6">
                                <div id="other_know" class="form-group" style="display: none"  >
                                    <label for="">If others, please specify:</label>
                                    <input type="text" class="form-control" name="temp_phone_no" id="temp_phone_no">
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART G: PREVIOUS VISA APPLICATION</h4>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-9 col-form-label">Have you / your spouse ever applied for any type of visa/for PR in another country?</label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label"><input class="form-check-input" onclick="javascript:yesnoCheck1();" name="optionsRadios" type="radio" id="option_yes_1" value="option_yes_1">YES</label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label"><input class="form-check-input" onclick="javascript:yesnoCheck1();"  name="optionsRadios" type="radio" id="option_no_1"  value="option_no_1">NO</label>
                                        </div>
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="type_visa_1" style="display: none"  >
                                    <table class="df table" style="width: 100%">
                                        <tr>
                                            <th class="td_head_reg" style="width: 30px !important;">#</th>
                                            <th class="td_head_reg" style="width: 18%">Name of the Applicant</th>
                                            <th class="td_head_reg" style="width: 18%">Country</th>
                                            <th class="td_head_reg" style="width: 18%">Year</th>
                                            <th class="td_head_reg" style="width: 18%" >Type of Visa (PR/ Student/Visit/Work)</th>
                                            <th class="td_head_reg" style="width: 18%" >Granted/Refused/Pending</th>
                                        </tr>
                                        <tr>
                                            <td style="width: 30px !important;">(i)</td>
                                            <td ><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30px !important;">(ii)</td>
                                            <td ><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30px !important;">(iii)</td>
                                            <td ><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                            <td><input name="inst_1" id="inst_1" class="form-control"></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group type_visa_1" style="display: none" >
                                    <label for="">If your / your spouse's visa / PR application has been refused before, please indicate the reasons for that.
                                    </label>
                                    <textarea rows="3" class="form-control" name="temp_current_address" id="temp_current_address"></textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART H: FINANCIAL SUPPORT</h4>

                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group row">
                                    <label class="col-sm-9 col-form-label">Are you and your sponsors aware of the visa regulations and funding requirements for the program in concern?
                                    </label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label"><input class="form-check-input" name="optionsRadios" type="radio" id="option_yes_2" value="option_yes_2">YES</label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label"><input class="form-check-input" name="optionsRadios" type="radio" id="option_no_2"  value="option_no_2">NO</label>
                                        </div>
                                        <span class="error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group type_visa_1" style="display: none" >
                                    <label for="">Who will be providing you the financial support?
                                    </label>
                                    <input name="inst_1" id="inst_1" class="form-control">
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group" >
                                    <label for="">Please provide a summary of your financial support for the duration of studies in the local as well as international context (Applicable for the Pathway Programs only)
                                    </label>
                                    <textarea rows="3" class="form-control" name="temp_current_address" id="temp_current_address"></textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <div class="form-group" >
                                    <label for="">Counselor's Remarks:
                                    </label>
                                    <textarea rows="3" class="form-control" name="temp_current_address" id="temp_current_address"></textarea>
                                    <span class="error"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">Documentation Checklist for Registration</h4>
                        <div class="row">
                            <div class="col-sm-12 col-lg-4">
                                <!--                        <form action="" enctype="multipart/form-data" method="post">-->
                                <div id="profile_picture_preview" class="thumbnail" style="width: 200px;">
                                    <div id="profile_picture_div"></div>
                                    <img id="profile_picture" class="img-responsive img-thumbnail" src="<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>" style="width: 155px;"/>
                                    <input type="hidden" id="stu_profile_picture_id" value="">
                                </div>
                                <!--                            <input type="file" name="file"><br/>-->
                                <input type="button" value="Attach your Photo here" style="color: white;background-color: #8686b6;border: none;padding: 2px;margin-top: 4px;" onclick="open_photo_upload_modal(true,false)"><input name="photo" id="stuPhoto" class="form-control input-optional" type="file"> <br/>
                                <!--                        </form>-->
                                <div class="row">
                                <div class="col-sm-12 col-lg-12">
                                    <p  class="acc_head_2">Copy of the Birth Certificate </p>
                                    <div class="form-group" >
                                        <div class="file-upload-wrapper" data-text="Select your file!">
                                            <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                        </div>
                                        <span class="error"></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-8">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-12">
                                        <p  class="acc_head_2">Copy of National Identity Card / Passport </p>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-2">
                                                <div class="form-group">
                                                    <label>Valid Until</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="valid_until" id="valid_until" class="form-control date-pick" data-date-format="yyyy-mm-dd">
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group" >
                                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                                    </div>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-12">
                                        <p  class="acc_head_2">Copy of the Student Visa (For International Students only) </p>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-2">
                                                <div class="form-group">
                                                    <label>Valid Until</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-4">
                                                <div class="form-group">
                                                    <input type="text" name="valid_until" id="valid_until" class="form-control date-pick" data-date-format="yyyy-mm-dd">
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group" >
                                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                                    </div>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <p  class="acc_head_2">Copy of the A/L Certificate </p>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group" >

                                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                                    </div>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-6">
                                        <p  class="acc_head_2">Copy of the A/L Certificate </p>
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group" >
                                                    <div class="file-upload-wrapper" data-text="Select your file!">
                                                        <input name="file-upload-field" type="file" class="file-upload-field" value="">
                                                    </div>
                                                    <span class="error"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-lg-12">
                                <div class="portlet box green">
                                    <div class="portlet-body">
                                        <p s class="acc_head_2">Relevant Professional Qualifications <button class="btn btm-sm btn-success pull-right" onclick="add_file()" style="padding: 2px;font-size: 12px;"><i class="fa fa-plus"></i> Add Document</button> </p>

                                        <table class="table table-striped table-bordered" id="file_table" cellspacing="0" width="100%">
                                            <thead>
                                            <tr>
                                                <th class="all">Document Name</th>
                                                <th class="desktop">Document Type</th>
                                                <th class="none">File Size</th>
                                                <th class="desktop">Valid Until</th>
                                                <th class="desktop">Details</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td class="all">1</td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                            </tr>
                                            <tr>
                                                <td class="all">2</td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                            </tr>
                                            <tr>
                                                <td class="all">3</td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                            </tr>
                                            <tr>
                                                <td class="all">4</td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                                <td class="all"></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <h4 class="sub-head">PART I: STUDENT DECLARATION</h4>
                        <p>
                            1. I declare that the information supplied in this application and the supporting documentation is true and complete.<br><br>
                            2. I acknowledge that the provision of incorrect information or withholding of relevant information relating to my application, including academic transcripts might invalidate my application and that IIHS may withdraw an offer of a place or cancel my enrolment in consequence.<br><br>
                            3. I recognize that it is my responsibility to provide all necessary documentation to support my application and I authorize IIHS to obtain further relevant documentation where necessary.4. I agree that I have read and understood the Payment plan, Refund Policy, Visa Regulations and Application Procedure for pathway programmes.<br><br>
                            5. I confirm that I have received and read a copy of the Course Information form and fully understand the requirements of the selected course. <br><br>
                            6. I agree with the IIHS's policies and guidelines which are in the Student Handbook.<br><br>
                            7. I agree that the foreign academic program's acceptance, selection and fees structure are totally at the discretion of the respective foreign university.<br><br>
                            8. I agree to abide by the statutes, regulations and policies of IIHS.<br><br>
                            9. I understand that IIHS as an Educational Institute is not responsible for guaranteeing a student visa and the fact that the student visa requirements can be changed according to the immigration policies relevant to student visas in respective countries. However the college will guide and assist the students in the process of obtaining student visas. The information on this form is primarily used to assess your application for entry to IIHS. It is also used to create an enrolment record on the application management system and the student database, and to prepare statistical analysis.<br><br>
                        </p>
                        <p>
                            Personal information could be collected from, or disclosed to, relevant bodies for verification of your previous qualifications, and it may be disclosed to government agencies, as required by legislation for your visa application and to IIHS for assessment of your application.<br><br>
                           <strong>I certify that I have read and understood the above information and that the information I have disclosed is complete and accurate to the best of my knowledge. Also I understand that withholding information or giving false information will make me ineligible to enroll in IIHS and may warrant my immediate dismissal.</strong>
                        </p>
                    </div>
                </form>
                <button type="button" id="btnSave" onclick="save_tmp_student()" class="btn btn-success">Submit</button>
            </div>
            <!-- END PAGE BASE CONTENT -->
        </div>

        <div class="modal fade" id="file_upload_modal" role="dialog" style="z-index: 9999999;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-blue-steel bg-font-blue-steel">
                        <h3 class="file-upload-title modal-title">Upload File</h3>
                    </div>
                    <div class="modal-body form">
                        <div id="file_upload_div">
                            <form action="" id="file-upload-form" class="form-horizontal" enctype="multipart/form-data">
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="document_type">Document Type</label>
                                        <div class="col-md-6">
                                            <input name="inst_1" id="inst_1" class="form-control">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="valid_until">Valid Until</label>
                                        <div class="col-md-6">
                                            <input type="text" name="valid_until" id="valid_until" class="form-control form-control-inline input-medium date-pick" size="16" data-date-format="yyyy-mm-dd">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-4" for="details">Details</label>
                                        <div class="col-md-6">
                                            <textarea name="details" id="details" class="form-control"></textarea>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                    <div class="form-group" id="selectDocument">
                                        <label class="control-label col-md-4" for="file">Select Document</label><br/>
                                        <div class="col-md-6" id="fileInput">
                                            <input type="file" name="file" id="empFile" class="form-control">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div id="attachment_preview"></div>
                        </div>
                        <div id="alert-message"></div>
                    </div>
                    <div class="modal-footer custom-modal-footer">
                        <button type="button" id="btnSaveFile" class="btn btn-success">Add</button>
                        <button type="button" id="btnExitFileUploadModal" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function yesnoCheck() {
                if ($("#option_yes").is(':checked')) {
                    $(".type_visa").css('display', 'block');
                } else if ($("#option_no").is(':checked')) {
                    $(".type_visa").css('display','none');
                }
            }

            function yesnoCheck1() {
                if ($("#option_yes_1").is(':checked')) {
                    $(".type_visa_1").css('display', 'block');
                } else if ($("#option_no_1").is(':checked')) {
                    $(".type_visa_1").css('display','none');
                }
            }

            $('#know_programmes').change(function(){
                if ( $("#know_programmes").val() == "Others") {
                    $("#other_know").show();
                } else {
                    $("#other_know").hide();
                }
            });


            function add_file()
            {
                save_method = 'add_file';
                $('#file-upload-form')[0].reset();
                $("#file_upload_div").show();
                //$("#alert-message").empty().hide();
                //$("#existingFile").remove();
                //$("#override_file").remove();
                //$("#btnSaveFile").show().attr('disabled', false).text('Save');
                //$("#btnExitFileUploadModal").show().attr('disabled', false).text("Cancel");
                $('#file_upload_modal').modal({backdrop: 'static', keyboard: false});
            }

            $("form").on("change", ".file-upload-field", function(){
                $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
            });

            var save_method='';
            function save() {
                var url = '';
                if (save_method == "add") {
                    url = "<?php echo base_url('student/students_con/save'); ?>";
                }
                else if (save_method == "update") {
                    url = "<?php echo base_url('student/students_con/update'); ?>";
                }

                $.ajax({

                    url: url,
                    dataType: "JSON",
                    type: "POST",
                    data: $('#student_form').serialize(),
                    success: function (data) {

                        if (data.input_error) {

                            for (var i = 0; i < data.input_error.length; i++) {

                                $('[name="' + data.input_error[i] + '"]').siblings("span.error-block").html(data.error_string[i]).show();
                            }

                        }
                        else{
                            reload_table(table);
                            $('#add_new_modal').modal('hide');
                        }
                    },
                    error: function () {
                        console.log("error");
                    }
                });
            }
        </script>