<style>
    #datatable1 tbody td {
        padding: 2px 5px;
    }
    #datatable1 .btn {
        margin-left: 0;
        margin-right: 5px;
        padding: 2px 5px;
    }
    .dataTables_filter{
        text-align: right;
        margin-top: 5px;
    }
    .btn-sm {
        padding: 2px !important;
    }
    .new-react-version {
        padding: 20px 20px;
        border: 1px solid #eee;
        border-radius: 20px;
        box-shadow: 0 2px 12px 0 rgba(0,0,0,0.1);

        text-align: center;
        font-size: 14px;
        line-height: 1.7;
    }
    .new-react-version .react-svg-logo{

        text-align: center;
        max-width: 60px;
        margin: 20px auto;
        margin-top: 0;

    }

    .rating-stars ul {

        list-style-type:none;
        padding:0;

        -moz-user-select:none;
        -webkit-user-select:none;

    }
    .rating-stars ul > li.star {
        display:inline-block;

    }

    /* Idle State of the stars */
    .rating-stars ul > li.star > i.fa {
        font-size:2.0em; /* Change the size of the stars */
        color:#ccc; /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul > li.star.hover > i.fa {
        color:#FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul > li.star.selected > i.fa {
        color: #0a0a0a;
    }

    .nav-tabs .nav-link.active{

    }

</style>

<style>

    ul, li {
        margin:0;
        padding:0;
        list-style-type:none;
    }

    form ul li {
        margin:5px 5px;

    }

    .invalid {
        background:url(<?php echo base_url('assets/images/cross.jpg') ?>) no-repeat 0 50%;
        padding-left:25px;
        line-height:12px;
        font-size: 11px;
        color:#ec3f41;
    }
    .valid {
        background:url(<?php echo base_url('assets/images/right.jpg') ?>) no-repeat 0 50%;
        padding-left:25px;
        font-size: 11px;
        line-height:12px;
        color:#3a7d34;
    }
    #pswd_info {
        display:none;
    }
    .modal-body {
        /*max-height: calc(400vh - 250px);
        overflow-y: auto;*/
        overflow-x:scroll;
    }
</style>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Lead User</a></li>
                <li class="breadcrumb-item active">Lead User Details</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block">User Lead Management</h4>
                <button href="javascript:;" type="button" class="btn btn-success pull-right" onclick="add_user()"><i class="fa fa-plus-circle"></i> Add New Lead User</button>
            </div>
            <div class="element-box">

                <table id="user_datatable" class="table" cellspacing="0" width="100%">
                    <thead style="background-color: #0e7eff;color: white;">
                    <tr>
                        <th>#</th>
                        <th style="text-align: left">Username</th>
                        <th>USER ID</th>
                        <th>TITLE</th>
                        <th>NAME</th>
                        
                        <th>PHONE</th>
                        <th>NIC NUMBER/PASSPORT</th>
                        <th style="width:250px">ACTION</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<hr>

<!-- #################################################### Employee Mangement ################################## -->
<!-- Photo Upload modal -->
<div class="modal fade" id="photo_upload_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="photo-upload-title">Upload User Photo</h4>
            </div>
            <div class="modal-body form">
                <div id="photo_upload_div" style="display: none">
                    <div class="alert alert-success fade in col-md-12">
                        <p class="success_message"></p>
                    </div>
                    <form action="" id="photo-upload-form" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div id="image_preview" class="col-md-offset-2 col-md-6">
                                <img style="text-align: center" id="previewing" src="<?php echo base_url('uploads/user_photos/noprofile-pic.jpg')?>" class="img-responsive img-thumbnail" width="140px" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-body">
                                <div class="form-group" id="selectImage">
                                    <label class="col-md-12 col-md-offset-1">Select User's photo</label>
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

<div class="modal fade" id="sys_u_p_modal" role="dialog">
    <div class="modal-dialog modal-lg"  style="width:100%; min-width: 400px; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sysModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sys_u_p_form" class="form-horizontal" role="form">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="sys_u_p_id" id="sys_u_p_id" value="" />

                    <div class="Insert" style=" background-color:white; display: block; float: none;">
                        <div id="module_list" class="row">

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_save_sys">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Emp View modal -->
<div class="modal fade " id="user_view_modal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 1350px!important;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h3 class="modal-title bold uppercase">Employee Info</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2" style="">

                        <!--                        <form action="" enctype="multipart/form-data" method="post">-->
                        <div id="profile_picture_preview" class="thumbnail" style="width: 200px;">
                            <div id="profile_picture_div"></div>
                            <img id="profile_picture" class="img-responsive img-thumbnail" src="" style="width: 155px;"/>
                            <input type="hidden" id="stu_profile_picture_id" value="">
                        </div>
                        <!--                            <input type="file" name="file"><br/>-->
                        <input type="button" value="Change Profile Picture" style="color: white;background-color: #8686b6;border: none;padding: 2px;margin-top: 4px;" onclick="open_photo_upload_modal(true,false)"> <br/>
                        <!--                        </form>-->
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="user_id" id="user_id" class="user_id">
                                <small class="text-muted">USER ID</small>
                                <h6 class="text-info-hr view_user_id"></h6>
                                <small class="text-muted">NAME</small>
                                <h6 class="text-info-hr view_name"></h6>
                                <small class="text-muted">NIC NUMBER</small>
                                <h6 class="text-info-hr view_nic_number"></h6>
                                <small class="text-muted p-t-30 db">GENDER</small>
                                <h6 class="text-info-hr view_gender"></h6>
                                <small class="text-muted p-t-30 db">BIRTHDAY</small>
                                <h6 class="text-info-hr view_birthday"></h6>
                                <small class="text-muted p-t-30 db">ADDRESS</small>
                                <h6 class="text-info-hr view_address"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10" style="">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" role="tab" href="#personal_info" data-toggle="tab"> PERSONAL </a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane p-20 active" role="tabpanel" id="personal_info">
                                <div class="card-body" style="margin-top: 20px">
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">TITLE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_title"></h6>
                                        </div>
                                        <div class="col-md-6 col-xs-6 b-r"><strong class="text-muted">NAME WITH INITIALS</strong>
                                            <br>
                                            <h6 class="text-info-hr view_name"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12"><strong class="text-muted">FULL NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_full_name"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">ADDRESS</strong>
                                            <br>
                                            <h6 class="text-info-hr view_address"></h6>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">GENDER</strong>
                                            <br>
                                            <h6 class="text-info-hr view_gender"></h6>
                                        </div>
                                        <div class="col-md-3 col-xs-6"><strong class="text-muted">PHONE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_phone"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">OCCUPATION</strong>
                                            <br>
                                            <h6 class="text-info-hr view_occupation"></h6>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">DATE OF BIRTH</strong>
                                            <br>
                                            <h6 class="text-info-hr view_birthday"></h6>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">RACE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_race" ></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">RELIGION</strong>
                                            <br>
                                            <h6 class="text-info-hr view_religion"></h6>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"><strong class="text-muted">NIC NUMBER</strong>
                                            <br>
                                            <h6 class="text-info-hr view_nic_number"></h6>
                                        </div>
                                    </div>
                                    <hr>
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

<!--Employee Add/Edit modal -->
<div class="modal fade" id="user_form_modal" role="dialog">
    <div class="modal-dialog modal-full"  style="max-width: 1030px!important;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="modal-title bold uppercase"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form id="user_form" class="form-material">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content tabcontent-border">
                                            <h4  class="sub-head">System Access Information</h4>
                                            <span id="user_id_span" style="width: 100%;margin-bottom:5px;color: white;background-color: #2e466b;padding: 3px;border-radius: 5px;"></span>
                                            <input type="hidden" id="sys_user_id" name="sys_user_id" value="">
                                            <table class="df col-md-12 table" style="margin-top: 10px;width: 900px !important;">
                                                <tbody>
                                                <tr>
<tr>
                                                    <th class="title_head">Company<span style="color: red">*</span></th>
                                                    <th colspan="8">
                                                        <select name="user_company" id="user_company" class="selectpicker"  data-live-search="true" data-width="100%">
                                                            <option value="">(--)</option>
                                                            <?php foreach($company as $com){ ?>
                                                                <option value="<?php echo $com->id; ?>"><?php echo $com->company_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>
                                                   
                                                    <th class="title_head">User Group<span style="color: red">*</span></th>
                                                    <th colspan="8">
                                                        <select name="user_group[]" id="user_group" class="selectpicker"  data-live-search="true" data-width="100%"  style="width:100%!important;" multiple>
                                                            <option value="">(--)</option>
                                                            <?php foreach($AllGroups as $group){ ?>
                                                                <option value="<?php echo $group->id ?>"><?php echo $group->description ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>
                                                
                                                <tr>
                                                    <th class="title_head">Email</th>
                                                    <th>
                                                        <input class="form-control" type="text" id="email" name="email" value="" />
                                                        <span class="error-block"></span>
                                                    </th>
                                                    <th class="title_head">Username <span style="color: red">*</span></th>
                                                    <th>
                                                        <input class="form-control" type="text" id="username" name="username" value="" />
                                                        <span class="error-block"></span>
                                                    </th>
                                                    <th class="title_head">Password  <span style="color: red">*</span></th>
                                                    <th>
                                                        <input class="form-control" type="password" id="password" name="password" value="" />
                                                        <span class="error-block"></span>

                                                    </th>
                                                    <th>
                                                        <div id="pswd_info" style="position: absolute;z-index: 9999;background:rgb(255, 250, 237) none repeat scroll 0% 0%;border: 2px solid;padding:5px;">
                                                            <p style="margin-left: 10px;">Password must meet the following requirements:</p>
                                                            <ul>
                                                                <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                                                <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                                                <li id="number" class="invalid">At least <strong>one number</strong></li>
                                                                <li id="spchar" class="invalid">At least <strong>one special character</strong></li>
                                                                <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>

                                                            </ul>
                                                        </div>
                                                    </th>
                                                    <th class="title_head">Confirm Password<span style="color: red">*</span></th>
                                                    <th>
                                                        <input class="form-control" type="password" id="password_confirm" name="password_confirm" value="" />
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <h4  class="sub-head">Personal Information</h4>
                                            <table class="df col-md-12 table" style="margin-top: 10px;width: 900px !important;">
                                                <input type="hidden" name="std_id">
                                                <tbody>
                                                <tr>
                                                    <th class="title_head">Title <span style="color: red">*</span></th>
                                                    <th>
                                                        <select name="title" id="title" class="form-control nOselect2">
                                                            <option value=""></option>
                                                            <option value="Rev">Rev</option>
                                                            <option value="Mr">Mr.</option>
                                                            <option value="Mrs">Mrs.</option>
                                                            <option value="Ms">Miss.</option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </th><th class="title_head">NIC/PASSPORT No <span style="color: red">*</span></th>
                                                    <th>
                                                        <input type="text" name="nic_number" class="form-control" placeholder="NIC/PASSPORT No">
                                                        <span class="error-block"></span>
                                                    </th>

                                                </tr>
                                                <tr>
                                                    <th class="title_head">Name with initials<span style="color: red">*</span></th>
                                                    <th colspan="3">
                                                        <input type="text" name="name" class="form-control" placeholder="Name With Initials">
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="title_head">Full Name<span style="color: red">*</span></th>
                                                    <th colspan="3">
                                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name">
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>
                                                
                                                <tr>
                                                    <th class="title_head">Gender <span style="color: red">*</span></th>
                                                    <th>
                                                        <select name="gender" class="form-control">
                                                            <option value=""></option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </th>
                                                    <th class="title_head">Phone <span style="color: red">*</span></th>
                                                    <th>
                                                        <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    
                                                    <th class="title_head">Designation(If any)</th>
                                                    <th>
                                                        <textarea name="occupation" class="form-control" placeholder="Designation"></textarea>
                                                        <span class="error-block"></span>
                                                    </th>
                                                </tr>



                                                
                                              
                                             
                                                </tbody>
                                            </table>
                                        </div>
<!--                                        <div class="tab-content tabcontent-border" id="academic" style="display: none;">-->
<!--                                            <h4  class="sub-head">Academic Information</h4>-->
<!---->
<!--                                            <table class="df col-md-12 table" style="margin-top: 10px;width: 900px !important;">-->
<!--                                                <tbody>-->
<!--                                                <tr>-->
<!--                                                    <th class="title_head">Program <span style="color: red">*</span></th>-->
<!--                                                    <th>-->
<!--                                                <select name="program_id" id="program_id" class="form-control selectpicker"  data-live-search="true" data-style="btn-primary">-->
<!--                                                </select>-->
<!--                                                        <span class="error-block"></span>-->
<!--                                                    </th><th class="title_head">Module <span style="color: red">*</span></th>-->
<!--                                                    <th>-->
<!--                                                <select name="module_id" id="module_id" class="form-control selectpicker"  data-live-search="true" multiple data-selected-text-format="count" data-style="btn-info" >-->
<!--                                                </select>-->
<!---->
<!--                                                        <span class="error-block"></span>-->
<!--                                                    </th>-->
<!--                                                </tr>-->
<!--                                                </tbody>-->
<!--                                            </table>-->
<!--                                            <div class="col-sm-6 col-lg-1">-->
<!--                                                <div class="form-group">-->
<!--                                                    <label for=""></label>-->
<!--                                                    <a id="addTable" href="#" class="btn btn-success form-control"><i class="fa fa-plus"></i> Add</a>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                            <table id="CyTable" class="table-bordered table-hover" width="100%">-->
<!--                                                <thead>-->
<!--                                                <tr>-->
<!--                                                    <th>#</th>-->
<!--                                                    <th>Program</th>-->
<!--                                                    <th>Modules</th>-->
<!--                                                    <th>-</th>-->
<!--                                                </tr>-->
<!--                                                </thead>-->
<!--                                                <tbody id="CyTable_tbody">-->
<!--                                                </tbody>-->
<!--                                            </table>-->
<!--                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSaveStd" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!--nipun-->
<script>

    // $('#user_group').change(function() {
    //
    //     var id_menu = $('#user_group').val();
    //
    //
    //     var abc=[];
    //
    //     for (var j=0; j<id_menu.length; j++){
    //         // console.log(id_menu[j]);
    //
    //         abc.push(id_menu[j])
    //     }
    //
    //     if ( abc.indexOf('4') > -1 ) {
    //
    //         document.getElementById("academic").style.display = "block";
    //
    //     } else {
    //         document.getElementById("academic").style.display = "none";
    //     }
    //
    //
    //
    //     //id_menu is an array
    //     // var split_item=0;
    //     // id_menu.forEach(function(item, index) {
    //     //      split_item  = item.split('-');
    //     //
    //     // });
    //     // if(split_item==4){
    //     //     document.getElementById("academic").style.display = "block";
    //     // }else{
    //     //     document.getElementById("academic").style.display = "none";
    //     // }
    //
    // });


    var counter = 0;
    $.ajax({
        url: "<?php echo base_url('settings/system_users/load_programs'); ?>",
        type: "POST",
        dataType: "JSON",
        data:{
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        success:function(data){
            $('#program_id').html('<option value="">Select Program</option>');
            for(var i=0;i<data.program.length;i++){
                $('#program_id').append('<option value="'+data.program[i].id+'">( '+data.program[i].code+' )'+data.program[i].name+' </option>');
            }
            $('.selectpicker').selectpicker('refresh');
        },
        error:function (jqXHR, textStatus, errorThrown){

            console.log(jqXHR);
            console.log(textStatus);
            console.log(errorThrown);
        }
    });
    $('#program_id').change(function(){
        var program = $(this).val();
        $.ajax({
            url: "<?php echo base_url('settings/system_users/load_programs_module'); ?>",
            type: "POST",
            dataType: "JSON",
            data:{
                "program_id":program,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(data){
                $('#module_id').html('<option disabled value="">Select Module</option>');
                for(var i=0;i<data.module.length;i++){
                    $('#module_id').append('<option value="'+data.module[i].id+'">( '+data.module[i].code+' )'+data.module[i].name+' </option>');
                }
                $('.selectpicker').selectpicker('refresh');
            },
            error:function (jqXHR, textStatus, errorThrown){

                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    });

    $(document).ready(function() {

        $("#addTable").click(function () {


            var program = $('#program_id').val();
            var program_text = $('#program_id option:selected').text();
            var module = $('#module_id').val();
            var module_text = $('#module_id option:selected').text();

            var is_valid = true;

            var $tbody2 = $('#CyTable tbody');
            var iss = 1;
            $tbody2.find('tr').each(function(){
                var prg = getCell("#CyTable", iss, 2);
                var modt = getCell("#CyTable", iss, 3);

                if( program_text==prg){
                // if( program_text==prg && module_text==modt){
                    bootbox.alert({message: '<b style="text-align:center;color: red;">Already Added to List</b>'});
                    is_valid = false;
                    return false;
                }
                iss++;
            });

            if(!is_valid){return false;}

            if(program!="" ){

                if(counter>1000){
                    alert("Only 1000 textboxes allowed");
                    return false;
                }

                var CyTable = $(document.createElement('tr')).attr("id", 'row_' + counter).attr("class", 'row_dyn');

                var html_data = "";
                html_data +=
                    '<td>' +
                    '<input type="hidden" name="programs_id['+counter+']" id="programs_id'+counter+'" value="'+ program +'">' +
                    '<input type="hidden" name="module_c_id['+counter+']" id="module_c_id'+counter+'" value="'+ module +'">' +
                    '</td>' +
                    '<td>'+
                    '<label>'+ program_text +'</label>' +
                    '</td>' +
                    '<td>'+
                    '<label>'+ module_text +'</label>' +
                    '</td>' +
                    '<td>' +
                    '<i class="fa fa-trash tip del" id="' + counter + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                    '</td>';

                //TODO need to validate

                CyTable.after().html(html_data);
                counter++;
                CyTable.appendTo("#CyTable tbody");


                var $tbody = $('#CyTable tbody');
                $tbody.find('tr').sort(function(a,b){
                    var tda = $(a).find('td:eq(1)').text(); // can replace 1 with the column you want to sort on
                    var tdb = $(b).find('td:eq(1)').text(); // this will sort on the second column
                    // if a < b return 1
                    return tda > tdb ? 1
                        // else if a > b return -1
                        : tda < tdb ? -1
                            // else they are equal - return 0
                            : 0;
                }).appendTo($tbody);
            } else {
                bootbox.alert({message: '<b style="text-align:center">Before add, Please select relevant Program And module</b>'});
            }
        });

        $("table#CyTable").on("click", '.del', function()
        {
            var delID = $(this).attr('id');
            row_id = $("#row_" + delID);
            row_id.remove();
        });
    });

    function getCell( idTab, row, col ) {
        var idCel =idTab + " tbody tr:nth-child(" + row + ") td:nth-child(" + col + ")";
        return $(idCel).text();
    }

</script>
<!--end nipun-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.formnavigation.js"></script>
<script type="text/javascript">
    var chlength = 0;
    var letter = 0;
    var capital = 0;
    var number = 0;
    var istrue = false;
    $(document).ready(function() {
        //you have to use keyup, because keydown will not catch the currently entered value
        $('#password').keyup(function() {

            var pswd = $(this).val();
            //validate the length
            if ( pswd.length < 8 ) {
                $('#length').removeClass('valid').addClass('invalid');
                chlength = 0;
            } else {
                chlength = 1;
                $('#length').removeClass('invalid').addClass('valid');
            }

            //validate letter
            if ( pswd.match(/[A-z]/) ) {
                letter = 1;
                $('#letter').removeClass('invalid').addClass('valid');
            } else {
                letter = 0;
                $('#letter').removeClass('valid').addClass('invalid');
            }

            // at least 1 special character in password {
            if ( pswd.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))  {
                score =1;
                $('#spchar').removeClass('invalid').addClass('valid');
            } else {
                score =0;
                $('#spchar').removeClass('valid').addClass('invalid');
            }

            //validate capital letter
            if ( pswd.match(/[A-Z]/) ) {
                capital=1;
                $('#capital').removeClass('invalid').addClass('valid');
            } else {
                capital=0;
                $('#capital').removeClass('valid').addClass('invalid');
            }

            //validate number
            if ( pswd.match(/\d/) ) {
                number=1;
                $('#number').removeClass('invalid').addClass('valid');
            } else {
                number=0;
                $('#number').removeClass('valid').addClass('invalid');
            }

        }).focus(function() {
            $('#pswd_info').show();
        }).blur(function() {
            $('#pswd_info').hide();
        });

        $("#btn_save_sys").off('click');
        $("#btn_save_sys").on('click', function(e){
            e.preventDefault();
            save_permissions();
        });

    });



    function responseMessage(msg) {
        $('.success-box').fadeIn(200);
        $('.success-box div.text-message').html("<span>" + msg + "</span>");
    }

    $(document).on('show.bs.modal', '.modal', function (event) {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });

    var save_method;
    var user_table;
    var file_table;
    var user_id_for_file;
    var password_check;

    $(document).ready(function() {

        user_table = $('#user_datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "colReorder": true,
            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?php echo base_url()?>settings/Lead_users/get_all_users",
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
                { extend: 'print', text:      '<i class="fa fa-print"></i>',
                    titleAttr: 'Print' },
                {
                    extend:    'copyHtml5',
                    text:      '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy'
                },
                {
                    extend:    'excelHtml5',
                    text:      '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel'
                },
                {
                    extend:    'csvHtml5',
                    text:      '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV'
                },
                {
                    extend:    'pdfHtml5',
                    text:      '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF'
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

        /*user_table.on('order.dt search.dt', function () {
            user_table.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();*/

        yadcf.init(user_table, [{
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
            }],
            {
                cumulative_filtering: false
            });


        $('#user_view_modal').on('hidden.bs.modal', function() {
            $('#profile_picture').attr("src","<?php echo base_url('uploads/user_photos/noprofile-pic.jpg')?>");

        });


        $("#btnSaveEmp").off('click');
        $("#btnSaveEmp").on('click', function(e){
            e.preventDefault();
            if( $('#password').val()!='' && $('#password_confirm').val()!=''){

                if (chlength == 1 && number == 1 && capital == 1 && letter == 1) {
                    save(save_method);
                }
            }else {
                save(save_method);
            }
        });

        $("#user_form :input").change(function(){
            $(this).siblings("span.error-block").html("").hide();
            $("span.help-inline").hide();
        });

        $('#user_modal').on('hidden.bs.modal', function() {
            $("#user_form :input").siblings("span.error-block").html("").hide();
            $("span.help-inline").hide();
        });

        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            //$(this).next().empty();
        });
    });


    function reload_table(table)
    {
        if(typeof table !== "undefined")
        {
            table.ajax.reload(null,false);
        }
    }

    function add_user()
    {
        $('.table').formNavigation();
        $.ajax({
            url: "<?php echo base_url('settings/system_users/get_last_user_number'); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success: function (data) {
                $('#user_id_span').html('<b>USER ID : '+data.user_id+'</b>');
                $('#sys_user_id').val(data.user_id)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                bootbox.alert(textStatus + " : " + errorThrown);
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });

        $("#validation_div").hide();
        $('#more_work').html('');
        $('#more_promotion').html('');
        $('#more_probation').html('');
        $(".row_dyn").remove();
        save_method = 'add';
        $('#user_form')[0].reset();
        $('.selectpicker').selectpicker('refresh');
        $('#user_form_modal').modal({backdrop: 'static', keyboard: false});
        $('#user_form_modal .modal-title').text('Add New User');
    }

    function edit_user(id)
    {
        $("#CyTable tbody").empty();
        $('#user_form')[0].reset();
        save_method = 'update';
        $('.error-block').empty();

        $.ajax({
            url : "<?php echo site_url('settings/Lead_users/edit_user')?>/" + id,
            type: "GET",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {
                $('#user_id_span').html('<b>USER NUMBER : '+data.std_info.user_id+'</b>');
                $('[name="std_id"]').val(id);
                $('[name="username"]').val(data.std_info.username);
                $('[name="email"]').val(data.std_info.email);
                 
                
                $('#user_company').val(data.std_info.company_id);
                $('#user_group').val(data.user_group);
                
             
                $('[name="title"]').val(data.std_info.title);
                $('[name="name"]').val(data.std_info.name);
                // $('[name="branch"]').val(data.std_info.branch_id);
                $('[name="full_name"]').val(data.std_info.full_name);
                // $('[name="address"]').val(data.std_info.address);
                $('[name="phone"]').val(data.std_info.phone);
                $('[name="occupation"]').val(data.std_info.occupation);
                // $('[name="birthday"]').val(data.std_info.birthday);
                // $('[name="religion"]').val(data.std_info.religion);
                $('[name="nic_number"]').val(data.std_info.nic_number);
                $('[name="gender"]').val(data.std_info.gender);
                // $('.selectpicker').selectpicker('refresh');

                var i;

                // if(data.lec_details != null){
                //     document.getElementById("academic").style.display = "block";
                //     for (i= 0; i< data.lec_details.length; ++i) {
                //
                //         var CyTable = $(document.createElement('tr')).attr("id", 'row_' + counter).attr("class", 'row_dyn');
                //         var html_data = "";
                //         html_data +=
                //             '<td>' +
                //             '<input type="hidden" name="programs_id['+counter+']" id="programs_id'+counter+'" value="'+ data.lec_details[i].program_id +'">' +
                //             '<input type="hidden" name="module_c_id['+counter+']" id="module_c_id'+counter+'" value="'+ data.lec_details[i].modules +'">' +
                //             '</td>' +
                //             '<td>'+
                //             '<label>'+ data.lec_details[i].program_name +'</label>' +
                //             '</td>' +
                //             '<td>'+
                //             '<label>'+ data.lec_details[i].name +'</label>' +
                //             '</td>' +
                //             '<td>' +
                //             '<i class="fa fa-trash tip del" id="' + counter + '" title="Remove" style="cursor:pointer;" data-placement="right"></i>' +
                //             '</td>';
                //
                //         CyTable.after().html(html_data);
                //
                //         counter++;
                //
                //         CyTable.appendTo("#CyTable tbody");
                //     }
                //
                //     var $tbody = $('#CyTable tbody');
                //     $tbody.find('tr').sort(function(a,b){
                //         var tda = $(a).find('td:eq(1)').text(); // can replace 1 with the column you want to sort on
                //         var tdb = $(b).find('td:eq(1)').text(); // this will sort on the second column
                //         // if a < b return 1
                //         return tda > tdb ? 1
                //             // else if a > b return -1
                //             : tda < tdb ? -1
                //                 // else they are equal - return 0
                //                 : 0;
                //     }).appendTo($tbody);
                // }
                // else{
                //     document.getElementById("academic").style.display = "none";
                // }
                $('.selectpicker').selectpicker('refresh');
                $('#user_form_modal').modal({backdrop: 'static', keyboard: false});
                $('#user_form_modal .modal-title').text('Edit User: #' + data.std_info.user_id);
            },
            error: function ()
            {
                console.log('Error get Edit EMP Data');
            }
        });

    }

    function view_user(id){

        $('#photo-upload-form input[type=file]').val("");
        $('#profile_picture').attr('src', '');

        $("#stuEditWizard ul li").first().children("a").click();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#profile_picture').attr('src', '');
        $('#profile_picture').attr("src","<?php echo base_url('uploads/user_photos/noprofile-pic.jpg')?>");

        $.ajax({

            url : "<?php echo site_url('settings/system_users/view_user')?>/" + id,
            type: "POST",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {

                $('a[href="#personal_info"]').tab('show');
                $.ajax({
                    url:"<?php echo site_url('settings/system_users/image_available')?>",
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
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/user_photos'); ?>" + "/" + data.photo + "?" + n);
                        }
                        else
                        {
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/user_photos/noprofile-pic.jpg')?>");
                        }
                    },
                    error:function(){
                        $('#profile_picture').attr('src', '');
                        console.log("error retrieve image");
                    }
                });


                $('#user_id').val(id);
                $('.view_user_id').html(data.std_info.user_id);
                $('.view_title').html(data.std_info.title);
                $('.view_name').html(data.std_info.name);
                $('.view_full_name').html(data.std_info.full_name);
                $('.view_address').html(data.std_info.address);
                $('.view_phone').html(data.std_info.phone);
                $('.view_occupation').html(data.std_info.occupation ? data.std_info.occupation:"NO");
                $('.view_birthday').html(data.std_info.birthday ? data.std_info.birthday:"NO");
                $('.view_religion').html(data.std_info.religion ? data.std_info.religion:"NO");
                $('.view_nic_number').html(data.std_info.nic_number ? data.std_info.nic_number:"NO");
                $('.view_gender').html(data.std_info.gender ? data.std_info.gender:"NO");

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Error retrieve data from ajax');
            }
        });

        $('#view_title').html('User Info');
        $('#user_view_modal').modal({backdrop: 'static', keyboard: false});

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

        var id= $('#user_id').val();
        $.ajax({
            url:"<?php echo site_url('settings/system_users/image_available')?>",
            type: "POST",
            data: {
                id:id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function (data){

                var d = new Date();
                var n = d.getTime();
                if(data.length == 0){
                    $('#previewing').attr("src","<?php echo base_url('uploads/user_photos/noprofile-pic.jpg')?>");
                }
                else{
                    $('#previewing').attr("src","<?php echo base_url('uploads/user_photos'); ?>" + "/" + data.photo + "?" + n);
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
            $('.success_message').text("User registration have been saved successfully.It is recommended to upload User's photo.");
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
                    idd=$('#user_id').val();
                }
                var url = "<?php echo site_url('settings/system_users/add_photo')?>/"+idd;

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
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/user_photos/noprofile-pic.jpg'); ?>");
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/user_photos'); ?>" + "/" + data.photo + "?" + n);
                        }
                        else
                        {
                            $("#btnExitModal").show().attr('disabled',false).text("Skip");
                            $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                            $("#photo_message").removeClass('alert-success').addClass('alert alert-danger fade in');
                        }

//                        $('#photo_upload_modal').modal('hide');
//                    window.location = "<?php //echo base_url('hr_payroll/user_list/index')?>//";
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

    function save()
    {
        $('#btnSaveStd').text('saving...');
        $('#btnSaveStd').attr('disabled', true);
        var url='';
        if(save_method=='add'){
            url = "<?php echo base_url('settings/Lead_users/save'); ?>";
        }
        else{
            url = "<?php echo base_url('settings/Lead_users/update'); ?>";
        }
        $.ajax({
            url: url,
            type: "POST",
            data: $('#user_form').serialize(),
            dataType: "JSON",
            success: function (data) {
                $('#btnSaveStd').text('save');
                $('#btnSaveStd').attr('disabled',false);
                if (data.status) {
                    reload_table(user_table);
                    bootbox.alert(data.message);
                    $('#user_form_modal').modal('hide');
                    $('#user_form')[0].reset();
                    //open_photo_upload_modal(true,data.std_id);
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
                            $('[name="'+data.inputerror[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                        }
                        $("#" + $('[name="'+data.inputerror[0]+'"]').prop('id')).focus();
                        var err_tab_id = $('[name="'+data.inputerror[0]+'"]').parents("[role='tabpanel']").prop('id');
                        $("a[href='#"+ err_tab_id +"']").click();
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                $('#btnSaveStd').text('save');
                $('#btnSaveStd').attr('disabled',false);
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
            url: "<?php echo site_url('settings/system_users/upload_profile')?>",
            type: "POST",
            data: {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function (data) {

                $('#previewing').attr("src","<?php echo base_url('uploads/user_photos'); ?>" + "/" + data.photo + "?" + n);

            },
            error: function () {
                console.log('Error getting photo');
            }
        });

    }


    function user_permissions(sys_u_p_id)
    {
        $('#module_list').empty();
        $('#sys_u_p_form')[0].reset(); // reset form on modals`
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        var url = "<?php echo site_url('settings/Lead_users/ajax_get_system_permissions_details_by_id'); ?>";
        //document.getElementById(".row_dyn").remove();
        var sys_u_p_id = sys_u_p_id;
        $.ajax({
            url: url,
            data: {
                sys_u_p_id : sys_u_p_id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            type: 'post',
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $('#sys_u_p_id').val(sys_u_p_id);
                    var counter = 1;
                    var tr_html = "<div class='col-md-3'><ul style='list-style:none;'>";


                    for(var i=0; i<data.list_sections.length; i++) {
                        tr_html += "<li><span style='width: auto;background: #1b8de1;color: #fff;display: block;padding: 2px;'>" + data.list_sections[i].title + "</span></li>";
                        //$.each(data.list_modules, function(id,name,section) {
                        for(var j=0; j<data.list_modules.length; j++) {
                            if(data.list_modules[j].section===data.list_sections[i].id) {

                                if (counter == 10 || counter == 20 || counter == 30 || counter == 40 || counter == 50) {
                                    tr_html += "</ul></div><div class='col-md-3'><ul style='list-style:none;'>";
                                }

                                tr_html += "<li><label for='val_" + data.list_modules[j].id + "' style='width: auto'><input type='checkbox' value='" + data.list_modules[j].id + "' id='val_" + data.list_modules[j].id + "' name='userpermissions[" + counter + "]' style='padding: 5px;'> " + data.list_modules[j].name + "</label></li>";

                                /*if(counter==0||counter==10||counter==20){
                                    tr_html += "</ul>";
                                }*/

                                counter++;
                            }
                        }
                        //});

                    }


                    $('#module_list').append(tr_html);

                    $.each(data.sys_u_p_data, function(id,module_id)
                    {
                        if(module_id != "")
                        {
                            $('#val_'+ module_id).prop('checked', true);
                        }
                    });

                    $('#sys_u_p_modal .modal-title').text('User Permissions');
                    $('#sys_u_p_modal').modal({backdrop: 'static', keyboard: false});
                }
                else
                {
                    bootbox.alert(data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                bootbox.alert(textStatus + " : " + errorThrown);
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

    function save_permissions()
    {
        var is_valid = true;

        $("#gen_pass").html("");
        $("#sys_u_p_form :input").siblings("span.error-block").hide().html("");


        if(!is_valid){return false;}

        var url = "<?php echo site_url('settings/system_users/save_user_permissions'); ?>/";
        $.ajax({
            url: url,
            data: $("#sys_u_p_form").serialize(),
            type: "POST",
            dataType: "JSON",
            cache: false,
            success: function(data){
                if(data.status)
                {
                    $('#sys_u_p_modal').modal('hide');
                    bootbox.alert(data.message);
                    reload_table(table_system_users);
                }
                else
                {
                    if(data.error)
                    {
                        for (var l = 0; l < data.inputerror.length; l++)
                        {
                            $('[name="'+data.inputerror[l]+'"]').siblings("span.error-block").html(data.error_string[l]).show();
                            //select parent twice to select div form-group class and add has-error class
                        }
                    }
                }
            },
            error: function(jqXHR, textStatus, errorThrown ){
                bootbox.alert(textStatus + " : " + errorThrown);
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }
</script>