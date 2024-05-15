<style>
    .square_div{
        border: 1px solid black;
        width: auto;
    }

    input, select, textarea{
        color: #ff0000;
    }

    table, th, td{
        text-align: center;
    }

    #module_list label {
        padding-top: 0px !important;
        font-size: 11px!important;
    }
    #BranchSubStore_list label {
        padding-top: 0px !important;
        font-size: 11px!important;
        margin-bottom: 0px !important;
    }
    #table_user_branches label {
        width: auto!important;}

    #table_system_users th, #table_system_users td{
        text-align: left !important;
    }
</style>



<style>

    ul, li {
        margin:0;
        padding:0;
        list-style-type:none;
    }

    form ul li {
        margin:10px 20px;

    }

    .invalid {
        background:url(<?php echo base_url('assets/images/cross.jpg') ?>) no-repeat 0 50%;
        padding-left:22px;
        line-height:24px;
        color:#ec3f41;
    }
    .valid {
        background:url(<?php echo base_url('assets/images/right.jpg') ?>) no-repeat 0 50%;
        padding-left:22px;
        line-height:24px;
        color:#3a7d34;
    }
    #pswd_info {
        display:none;
    }
</style>


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">System Users</li>
            </ol>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">
            </div>
            <!--<h6 class="element-header">

            </h6>-->
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block">System Users</h4>
                <button type="button" class="btn btn-success pull-right" onclick='add_user();' ><i class="fa fa-plus-circle"></i> Add New User</button>
            </div>
            <div class="element-box">
                <table id="table_system_users"  class="table table-bordered">
                    <thead>
                    <tr>
                        <th>System ID</th>
                        <th style="text-align: left">Employee ID</th>
                        <th style="text-align: left">Username</th>
                        <th style="text-align: left">Name</th>
                        <th style="text-align: left">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg in" id="sys_u_bs_modal" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"  style="width:100%; min-width: 400px; max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="ubsModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sys_u_bs_form" class="form-horizontal" role="form">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" name="sys_u_bs_id" id="sys_u_bs_id" value="" />

                    <div class="Insert" style=" background-color:white; display: block; float: none;">
                                <div id="BranchSubStore_list" class="row">

                                </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_save_ubs">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bs-example-modal-lg in" id="sys_u_p_modal" role="dialog" aria-hidden="true" style="display: none;">
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



<div class="modal fade bs-example-modal-lg in" id="user_modal" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg"  style="min-width: 500px; max-width: 1000px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="userModalLabel"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                /*                    $attributes = array('class' => 'form-body', 'id' => 'myform');
                                    echo form_open("auth/create_user",$attributes);*/?>
                <form id="user_form" class="form-horizontal" role="form">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <input type="hidden" id="user_id" name="user_id" value="" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" id="emp_div">
                                <label class="control-label col-md-3 required" for="employee">Employee</label>
                                <div class="col-md-6">
                                    <select name="employee" id="employee" class="select2" style="\&quot;max-width:200px;\&quot;">

                                        <option value="">(--)</option>
                                        <?php foreach($AllEmployees as $emp){ ?>
                                            <option value="<?php echo $emp->id ?>"><?php echo $emp->employee_id ?> - <?php echo $emp->first_name." ".$emp->last_name; ?></option>
                                        <?php } ?>
                                    </select>

                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="employee">User Group</label>
                                <div class="col-md-6">
                                    <select name="user_group[]" id="user_group" class="select2" style="\&quot;max-width:200px;\&quot;" multiple>

                                        <option value="">(--)</option>
                                        <?php foreach($AllGroups as $group){ ?>
                                            <option value="<?php echo $group->id ?>"><?php echo $group->description ?></option>
                                        <?php } ?>
                                    </select>

                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="email">Email</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="email" name="email" value="" />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="username">User Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="username" name="username" value="" />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="password">Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password" name="password" value="" />
                                    <span class="error-block"></span>
                                </div>

                                <div id="pswd_info">
                                    <p style="margin-left: 20px;">Password must meet the following requirements:</p>
                                    <ul>
                                        <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                        <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                        <li id="number" class="invalid">At least <strong>one number</strong></li>
                                        <li id="spchar" class="invalid">At least <strong>one special character</strong></li>
                                        <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>

                                    </ul>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="password_confirm">Confirm Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password_confirm" name="password_confirm" value="" />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--<p><?php /*echo form_submit('submit', lang('create_user_submit_btn'));*/?></p>-->

                    <?php /*echo form_close();*/?>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="btn_save_user">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table_system_users;
    $(document).ready(function() {
        table_system_users = $('#table_system_users').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?php echo site_url('hr_payroll/system_users/ajax_list_users')?>",
                "type": "POST"
            },
            "columnDefs": [
                {
                    "targets": [-1],
                    "orderable": [
                        [0, 'desc']
                    ],
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
                [0, 'desc']
            ],
            "lengthMenu": [
                [5, 10, 15, 20, -1],
                [5, 10, 15, 20, "All"]
            ],
            "pageLength": 20,
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
        });
        yadcf.init(table_system_users, [{
                filter_type: "text",
                filter_delay: 500,
                column_number: 0
            }, {
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
            }],
            {
                cumulative_filtering: false
            });


        $(".data_container").hide();
        $("#site_securities_container").fadeIn();
    });

    function reload_table(table)
    {
        if(typeof table !== "undefined")
        {
            table.ajax.reload(null,false);
        }
    }

</script>



<script>

    var save_method;
    var counter = 1;
    $(document).ready(function(){


        $("#btn_save_sys").off('click');
        $("#btn_save_sys").on('click', function(e){
            e.preventDefault();
            save_permissions();
        });

        $('.modal').on('hidden.bs.modal', function(){
            if ($('select.select2').data('select2')) {
                $('select.select2').select2('destroy');
            }
            $(this).find('form')[0].reset();
            $('.select2').select2();
        });

        $("#sys_u_p_form :input").change(function(){
            $(this).siblings("span.error-block").html("").hide();
            $("span.help-inline").hide();
        });

        $('#sys_u_p_modal').on('hidden.bs.modal', function() {
            $("#sys_u_p_form :input").siblings("span.error-block").html("").hide();
            $("span.help-inline").hide();
        });

        $("#btn_save_ubs").off('click');
        $("#btn_save_ubs").on('click', function(e){
            e.preventDefault();
            save_user_stores();
        });
    });


    function user_permissions(sys_u_p_id)
    {
        $('#module_list').empty();
        $('#sys_u_p_form')[0].reset(); // reset form on modals`
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        var url = "<?php echo site_url('hr_payroll/system_users/ajax_get_system_permissions_details_by_id'); ?>";
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

                                    if (counter == 15 || counter == 30 || counter == 45 || counter == 60 || counter == 75) {
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

                    //console.log(data.u_types);
                    //$("#udModalLabel").html('Edit Group');
                    $('#sys_u_p_modal .modal-title').text('User Permissions');
                    //$('#sys_u_p_modal').modal('show');
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

        var url = "<?php echo site_url('hr_payroll/system_users/save_user_permissions'); ?>/";
        $.ajax({
            url: url,
            data: $("#sys_u_p_form").serialize(),
            type: "POST",
            dataType: "JSON",
            cache: false,
            success: function(data){
                if(data.message)
                {
                    bootbox.alert(data.message);
                }
                if(data.status)
                {
                    /* var tr_html = "";
                     for(var i=0; i<data.pays.length; i++)
                     {

                     }

                     $("#payTable tbody").html(tr_html);
                     */
                    //bootbox.alert('Sucess');
                    $('#sys_u_p_modal').modal('hide');
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



    //USER ADD
//    $(document).ready(function(){
//
//            var chlength = 0;
//            var letter = 0;
//            var capital = 0;
//            var number = 0;
//            var istrue = false;
//
//            var new_pass = $('#password').val();
//            var confirm = $('#password_confirm').val();
//
//            $('#password').keyup(function() {
//                var new_pass = $('#password').val();
//                var confirm = $('#password_confirm').val();
//                var pswd = $(this).val();
//
//                //validate the length
//                if ( pswd.length < 8 ) {
//                    $('#length').removeClass('valid').addClass('invalid');
//                    chlength = 0;
//                } else {
//                    chlength = 1;
//                    $('#length').removeClass('invalid').addClass('valid');
//                }
//
//                //validate letter
//                if ( pswd.match(/[A-z]/) ) {
//                    letter = 1;
//                    $('#letter').removeClass('invalid').addClass('valid');
//                } else {
//                    letter = 0;
//                    $('#letter').removeClass('valid').addClass('invalid');
//                }
//
//                //validate capital letter
//                if ( pswd.match(/[A-Z]/) ) {
//                    capital=1;
//                    $('#capital').removeClass('invalid').addClass('valid');
//                } else {
//                    capital=0;
//                    $('#capital').removeClass('valid').addClass('invalid');
//                }
//
//                //validate number
//                if ( pswd.match(/\d/) ) {
//                    number=1;
//                    $('#number').removeClass('invalid').addClass('valid');
//                } else {
//                    number=0;
//                    $('#number').removeClass('valid').addClass('invalid');
//                }
//
//            });
//
//
//        $("#btn_save_user").off('click');
//        $("#btn_save_user").on('click', function (e) {
//
//            e.preventDefault();
//            if(confirm!='' && new_pass!=''){
//
//                if (chlength == 1 && number == 1 && capital == 1 && letter == 1) {
//                    save_user();
//                }
//            }else {
//                save_user();
//            }
//        });
//
//
//        $("#user_form :input").change(function(){
//            $(this).siblings("span.error-block").html("").hide();
//            $("span.help-inline").hide();
//        });
//
//        $('#user_modal').on('hidden.bs.modal', function() {
//            $("#user_form :input").siblings("span.error-block").html("").hide();
//            $("span.help-inline").hide();
//        });
//
////            $('input[type=password]').focus(function() {
////                // focus code here
////            });
////            $('input[type=password]').blur(function() {
////                // blur code here
////            });
////
////            $('input[type=password]').keyup(function() {
////                // keyup code here
////            }).focus(function() {
////                // focus code here
////            }).blur(function() {
////                // blur code here
////            });
//
//            $('input[type=password]').keyup(function() {
//                // keyup code here
//            }).focus(function() {
//                $('#pswd_info').show();
//            }).blur(function() {
//                $('#pswd_info').hide();
//            });
//
//
//
//
//
//    });

    function add_user()
    {
        save_method = 'add';
        $("#user_form")[0].reset();
        $('#emp_div').show();
        $("#username").parent().parent().show();
        $('#username').attr('readonly', false);
        $('#employee').attr('disabled', false);
        $("#userModalLabel").html('Add New User');
        //$("#user_modal").modal('show');
        $('#user_modal').modal({backdrop: 'static', keyboard: false});
    }


    function edit_user(sys_user_id)
    {
        save_method = 'update';
        $("#user_form")[0].reset();
        $("#username").parent().parent().show();
        var url = "<?php echo site_url('hr_payroll/system_users/ajax_get_system_user_data_by_id'); ?>";
        var sys_user_id = sys_user_id;
        $.ajax({
            url: url,
            data: {
                sys_user_id: sys_user_id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            type: 'post',
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    if ($('select.select2').data('select2')) {
                        $('select.select2').select2('destroy');
                    }

                    $('#user_id').val(data.user_data.id);
                    $('#employee').val(data.user_data.id);
                    $('#emp_div').hide();
                    $('#email').val(data.user_data.email);
                    $('#username').val(data.user_data.username);
                    $('#user_group').val(data.user_group);
                    $('#username').attr('readonly', true);
                    $('#employee').attr('disabled', true);
                    //console.log(data.u_types);
                    //$("#udModalLabel").html('Edit Group');
                    $('.select2').select2();
                    $("#userModalLabel").html('Edit User');
                    //$("#user_modal").modal('show');
                    $('#user_modal').modal({backdrop: 'static', keyboard: false});
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


        $("#user_form :input").change(function(){
            $(this).siblings("span.error-block").html("").hide();
            $("span.help-inline").hide();
        });

        $('#user_modal').on('hidden.bs.modal', function() {
            $("#user_form :input").siblings("span.error-block").html("").hide();
            $("span.help-inline").hide();
        });

//            $('input[type=password]').focus(function() {
//                // focus code here
//            });
//            $('input[type=password]').blur(function() {
//                // blur code here
//            });
//
//            $('input[type=password]').keyup(function() {
//                // keyup code here
//            }).focus(function() {
//                // focus code here
//            }).blur(function() {
//                // blur code here
//            });



    }


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

    });

    $(document).ready(function(){

        $("#btn_save_user").off('click');
        $("#btn_save_user").on('click', function (e) {

            e.preventDefault();
            if( $('#password').val()!='' && $('#password_confirm').val()!=''){

                if (chlength == 1 && number == 1 && capital == 1 && letter == 1) {
                    save_user();
                }
            }else {
                save_user();
            }
        });

    });

    function save_user()
    {
        var url = "<?php echo site_url('hr_payroll/system_users/save_user'); ?>/" + save_method;
        $.ajax({
            url: url,
            data: $("#user_form").serialize(),
            type: "POST",
            dataType: "JSON",
            cache: false,
            success: function(data){
                if(data.message)
                {
                    bootbox.alert(data.message);
                }
                if(data.status) {
                    $("#user_modal").modal('hide');
                    reload_table(table_system_users);
                    //window.location.reload(true);
                } else {
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


    function user_branch_stores(sys_u_bs_id)
    {
        $('#BranchSubStore_list').empty();
        $('#sys_u_bs_form')[0].reset(); // reset form on modals`
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        var url = "<?php echo site_url('hr_payroll/system_users/ajax_get_system_user_branch_stores_details_by_id'); ?>";
        var sys_u_bs_id = sys_u_bs_id;
        $.ajax({
            url: url,
            data: {
                sys_u_bs_id : sys_u_bs_id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            type: 'post',
            dataType: 'json',
            success: function(data){
                if(data.status)
                {
                    $('#sys_u_bs_id').val(sys_u_bs_id);
                    var counter = 1;
                    var tr_html = "<div class='col-md-3'><ul style='list-style:none;'>";
                    for (var j = 0; j < data.list_Branches.length; j++)
                    {
                        if(counter==3||counter==6||counter==9||counter==12||counter==16){
                            tr_html += "</ul></div><div class='col-md-3'><ul style='list-style:none;'>";
                        }
                        tr_html += "<li><label style='width: auto; color: red'>"+  data.list_Branches[j].bname +"</label></li>";
                        for (var l = 0; l < data.list_BranchSubStores.length; l++)
                        {
                            if(data.list_BranchSubStores[l].bid==data.list_Branches[j].bid){
                                tr_html += "<li><label for='vals_"+ data.list_BranchSubStores[l].bst_id +"' style='width: auto'><input type='checkbox' value='"+ data.list_BranchSubStores[l].bst_id +"' id='vals_"+ data.list_BranchSubStores[l].bst_id +"' name='userstores["+ l +"]' style='padding: 5px;'>"+  data.list_BranchSubStores[l].bst_code +" - "+  data.list_BranchSubStores[l].bst_name +"</label></li>";
                            }
                        }
                        counter++;
                    }


                    $('#BranchSubStore_list').append(tr_html);

                    $.each(data.sys_u_bs_data, function(id,store_id)
                    {
                        if(store_id != "")
                        {
                            $('#vals_'+ store_id).prop('checked', true);
                        }
                    });

                    //console.log(data.u_types);
                    //$("#udModalLabel").html('Edit Group');
                    $('#sys_u_bs_modal .modal-title').text('User Branch - Stores');
                    //$('#sys_u_p_modal').modal('show');
                    $('#sys_u_bs_modal').modal('show');
                }
                else
                {
                    bootbox.alert(data.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
                //bootbox.alert(textStatus + " : " + errorThrown);
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }


    function save_user_stores()
    {
        var is_valid = true;

        $("#sys_u_bs_form :input").siblings("span.error-block").hide().html("");


        if(!is_valid){return false;}

        var url = "<?php echo site_url('hr_payroll/system_users/save_user_stores'); ?>/";
        $.ajax({
            url: url,
            data: $("#sys_u_bs_form").serialize(),
            type: "POST",
            dataType: "JSON",
            cache: false,
            success: function(data){
                if(data.message)
                {
                    bootbox.alert(data.message);
                }
                if(data.status)
                {
                    $('#sys_u_bs_modal').modal('hide');
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
