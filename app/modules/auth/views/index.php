

    <div class="page-content">
        <!-- BEGIN BREADCRUMBS -->
        <div class="breadcrumbs">
            <div class="row" style="background: #e2eeec; padding: 4px;">
                <div class="col-md-6">
                    <h1><?php echo lang('index_heading');?></h1>
                    <p style="clear: both; margin: 0px;"> <?php echo lang('index_subheading');?><?php echo $message;?> </p>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMBS -->
        <!-- BEGIN PAGE BASE CONTENT -->
        <div class="row widget-row">
            <a  class="btn" onclick='add_user();'>Add New User</a>

            <table id="sample_1" class="table table-striped table-bordered table-hover order-column" cellpadding=0 cellspacing=10>
                <thead>
                <tr>
                    <th><?php echo lang('index_fname_th');?></th>
                    <th><?php echo lang('index_lname_th');?></th>
                    <th><?php echo lang('index_email_th');?></th>
                    <th><?php echo lang('index_groups_th');?></th>
                    <th><?php echo lang('index_status_th');?></th>
                    <th><?php echo lang('index_action_th');?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user):?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
                        <td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
                        <td>
                            <?php foreach ($user->groups as $group):?>
                                <?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
                            <?php endforeach?>
                        </td>
                        <td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
                        <td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>

            <p><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> | <?php echo anchor('auth/create_group', lang('index_create_group_link'))?></p>
        </div>
        <!-- END PAGE BASE CONTENT -->
    </div>




    <div class="modal fade bs-example-modal-lg in" id="user_modal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg"  style="min-width: 500px; max-width: 1000px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title" id="userModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <?php
/*                    $attributes = array('class' => 'form-body', 'id' => 'myform');
                    echo form_open("auth/create_user",$attributes);*/?>
                    <form id="user_form" class="form-horizontal" role="form">

                    <div class="row">
                        <div class="col-md-6">
                            User Information
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="first_name">First Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="first_name" name="first_name" value="" />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="last_name">Last Name</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="last_name" name="last_name" value="" />
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
                                <label class="control-label col-md-3 required" for="phone">Phone</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="text" id="phone" name="phone" value="" />
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
                                <label class="control-label col-md-3 required" for="branches">Branch</label>
                                <div class="col-md-6">
                                    <select name="branches" id="branches" class="form-control branches_data">
                                    </select>
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="password">Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password" name="password" value="" />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="password_confirm">Confirm Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password_confirm" name="password_confirm" value="" />
                                    <span class="error-block"></span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="group">User Group</label>
                                <div class="col-md-6">
                                    <select name="group" id="group" class="form-control group_data">
                                        <option value="">...</option>
                                        <?php foreach ($groups as $group):?>
                                            <option value="<?php echo $group['id'];?>"><?php echo $group['name'];?></option>
                                        <?php endforeach?>
                                    </select>

                                    <span class="error-block"></span>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
                            Branch Level Access
                            <?php foreach ($branches as $branch):?>
                                <label class="checkbox">
                                    <input type="checkbox" name="groups[]" value="<?php echo $branch['id'];?>"/>
                                    <?php echo $branch['name'];?>
                                </label>
                            <?php endforeach?>

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


<script>
    $(document).ready(function() {
        if(!$(".branches_data").children('option').length)
        {
            $.ajax({
                url: "<?php echo site_url('auth/ajax_get_branches'); ?>",
                data: {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                type: 'POST',
                dataType: 'JSON',
                async: false,
                success: function(data){
                    if(data.status)
                    {
                        //$("#groups").selectpicker();
                        var html = "<option value=''>Select..</option>";
                        $.each(data.branches, function(key, val){
                            html += "<option value='" + val.id + "'>" + val.name + "</option>";
                        });
                        $(".branches_data").html(html);
                    }
                    else
                    {
                        bootbox.alert(data.message);
                    }
                },
                error: function(jqXHR, textStatus, errorMessage){
                    bootbox.alert("Error retrieving data.");
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorMessage);
                }
            });
        }
    });

    $(document).keydown(function(e) {
        $('input').keyup(function (e) {
            if (e.which == 39) { // right arrow
                $(this).closest('form-group').next().find('input').focus();

            } else if (e.which == 37) { // left arrow
                $(this).closest('form-group').prev().find('input').focus();

            } else if (e.which == 40) { // down arrow
                $(this).closest('tr').next().find('td:eq(' + $(this).closest('td').index() + ')').find('input').focus();

            } else if (e.which == 38) { // up arrow
                $(this).closest('tr').prev().find('td:eq(' + $(this).closest('td').index() + ')').find('input').focus();
            }
        });
    });
</script>

    <script>
        var save_method;
        $(document).ready(function(){
            $("#btn_save_user").off('click');
            $("#btn_save_user").on('click', function(e){
                e.preventDefault();
                save_user(save_method);
            });
            
            $("#user_form :input").change(function(){
                $(this).siblings("span.error-block").html("").hide();
                $("span.help-inline").hide();
            });

            $('#user_modal').on('hidden.bs.modal', function() {
                $("#user_form :input").siblings("span.error-block").html("").hide();
                $("span.help-inline").hide();
            });
        });


        function add_user()
        {
            save_method = 'add';
            $("#user_form")[0].reset();
            $("#username").parent().parent().show();
            $("#userModalLabel").html('Add New User');
            $("#user_modal").modal('show');
        }

        function edit_user(user_id)
        {
            save_method = 'edit';
            var url = "<?php echo site_url('admin/ajax/get_user_details'); ?>";
            $("#user_form")[0].reset();
            $("#username").parent().parent().hide();
            $(".usrname").hide();
            $(".groups_d").hide();
            $.ajax({
                url: url,
                data: {
                    user_id: user_id,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                type: 'post',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.status)
                    {

                        $("#user_id").val(user_id);
                        //$("#username").val(data.otp_user.username);
                        $("#name").val(data.user_details.username);
                        $("#groups").val(data.user_details.groupname);
                        $("#userModalLabel").html('Edit User (ID: ' + user_id + ')');
                        $("#user_modal").modal('show');
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


        function save_user(save_method)
        {
            var is_valid = true;

            $("#user_form :input").siblings("span.error-block").hide().html("");

            if(save_method == "add")
            {
                if($("#username").val().length == 0)
                {
                    is_valid = false;
                    $("#username").siblings("span.error-block").show().html("username cannot be empty!");
                }
                else
                {
                    $("#username").siblings("span.error-block").hide().html("");
                }

                if($("#password").val().length == 0)
                {
                    is_valid = false;
                    $("#password").siblings("span.error-block").show().html("Password cannot be empty!");
                }
                else
                {
                    $("#password").siblings("span.error-block").hide().html("");
                }

                if($("#pass_confirm").val().length == 0)
                {
                    is_valid = false;
                    $("#pass_confirm").siblings("span.error-block").show().html("Password (again) cannot be empty!");
                }
                else
                {
                    $("#pass_confirm").siblings("span.error-block").hide().html("");
                }
            }


            if(!is_valid){return false;}

            var url = "<?php echo site_url('admin/ajax/save_user_batches'); ?>/" + save_method;
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
                    if(data.status)
                    {
                        var tr_html = "";
                        for(var i=0; i<data.users.length; i++)
                        {
                            var modified_on = data.users[i].modified_on == null ? "<span class='btn btn-sm btn-default'>Not Modified</span>" : data.users[i].modified_on;
                            tr_html += "<tr id='tr_" + data.users[i].id + "'>" +
                                "<td>" + data.users[i].id + "</td>" +
                                "<td>" + data.users[i].batch_name + "</td>" +
                                "<td>" + data.users[i].added_by + "</td>" +
                                "<td>" + data.users[i].created_on + "</td>" +
                                "<td>" + modified_on + "</td>" +
                                "<td>" +
                                "<button id='change_userdetails_btn_"+ data.users[i].id +"' class='btn btn-sm btn-default btn_user_details' title='User Details' onclick='view_user_details(" + data.users[i].id + ")'><i class='glyphicon glyphicon-pencil'></i></button>" +
                                "<button id='delete_btn_"+ data.users[i].id +"' class='btn btn-sm btn-danger btn_otp_user_delete_user' title='Delete User' onclick='delete_user(" + data.users[i].id + ")'><i class='glyphicon glyphicon-trash'></i></button>" +
                                "</td>" +
                                "</tr>";
                        }
                        $("#otp_users tbody").html(tr_html);
                        $("#user_modal").modal('hide');
                    }
                    else
                    {
                        if(data.error)
                        {
                            for (var l = 0; l < data.inputerror.length; l++)
                            {
                                $('[name="'+data.inputerror[l]+'"]').siblings("span.error-block").html(data.error_string[l]).show(); //select parent twice to select div form-group class and add has-error class
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

        function delete_user(user_id)
        {
            bootbox.dialog({
                message: "Are you sure that you want to delete this user - (User ID: " + user_id + ")?",
                title: "Alert!",
                buttons: {
                    success: {
                        label: "Yes",
                        className: "btn-primary",
                        callback: function() {
                            var url = "<?php echo site_url('admin/ajax/delete_user'); ?>";
                            $.ajax({
                                url: url,
                                data: {
                                    user_id: user_id,
                                    bank_id: $("#bank_id").val(),
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                type: "POST",
                                dataType: "JSON",
                                cache: false,
                                success: function(data){
                                    bootbox.alert(data.message);
                                    if(data.status)
                                    {
                                        var tr_html = "";
                                        for(var i=0; i<data.users.length; i++)
                                        {
                                            var modified_on = data.users[i].modified_on == null ? "<span class='btn btn-sm btn-default'>Not Modified</span>" : data.users[i].modified_on;
                                            tr_html += "<tr id='tr_" + data.users[i].user_id + "'>" +
                                                "<td>" + data.users[i].user_id + "</td>" +
                                                "<input type='hidden' class='otp_user_id' value='" + data.users[i].user_id + "'>" +
                                                "<td>" + data.users[i].username + "</td>" +
                                                "<input type='hidden' class='otp_user_username' value='" + data.users[i].username + "'>" +
                                                "<td>" + data.users[i].groupname + "</td>" +
                                                "<td>" + data.users[i].bank_name + "</td>" +
                                                "<td>" + data.users[i].added_by + "</td>" +
                                                "<td>" + data.users[i].created_on + "</td>" +
                                                "<td>" + modified_on + "</td>" +
                                                "<td>" +
                                                "<button id='change_userdetails_btn_"+ data.users[i].user_id +"' class='btn btn-sm btn-default btn_user_details' title='User Details' onclick='view_user_details(" + data.users[i].user_id + ")'><i class='glyphicon glyphicon-pencil'></i></button>" +
                                                "<button id='change_group_btn_"+ data.users[i].user_id +"' class='btn btn-sm btn-default btn_user_change_group' title='Change Group' onclick='change_user_group(" + data.users[i].user_id + ")'><i class='glyphicon glyphicon-pencil'></i></button>" +
                                                "<button id='change_pwd_btn_"+ data.users[i].user_id +"' class='btn btn-sm btn-default btn_otp_user_change_pwd' title='Change Password' onclick='edit_user(" + data.users[i].user_id + ")'><i class='glyphicon glyphicon-pencil'></i></button>" +
                                                "<button id='delete_btn_"+ data.users[i].user_id +"' class='btn btn-sm btn-danger btn_otp_user_delete_user' title='Delete User' onclick='delete_user(" + data.users[i].user_id + ")'><i class='glyphicon glyphicon-trash'></i></button>" +
                                                "</td>" +
                                                "</tr>";
                                        }
                                        $("#otp_users tbody").html(tr_html);
                                        $("#user_modal").modal('hide');
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
                    },
                    danger: {
                        label: "Cancel",
                        className: "btn-danger"
                    }
                }
            });
        }

        function view_user_details(id)
        {
            //save_method = 'view';
            var url = "<?php echo site_url('admin/ajax/get_user_bulk_details'); ?>";
            //$("#user_form")[0].reset();
            //$("#username").parent().parent().hide();
            //$(".usrname").hide();
            //$(".groups_d").hide();
            $.ajax({
                url: url,
                data: {
                    id: id,
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                type: 'post',
                dataType: 'json',
                success: function(data){
                    console.log(data);
                    if(data.status)
                    {
                        var html_data = "";
                        //$("#groups").selectpicker();
                        $.each(data.user_details, function(key, val){
                            html_data += "<tr>" +
                                "<td>" + val.id + "</td>" +
                                "<td>" + val.username + "</td>" +
                                "<td>" + val.value + "</td>" +
                                "</tr>";
                        });

                        $("#user_data tbody").html(html_data);


                        $("#user_id").val(id);
                        //$("#username").val(data.otp_user.username);
                        $("#name").val(data.user_details.username);
                        $("#groups").val(data.user_details.groupname);
                        $("#ListUserDetailsModalLabel").html('View Batch Users (ID: ' + id + ')');
                        $("#list_user_details_modal").modal('show');
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

    </script>