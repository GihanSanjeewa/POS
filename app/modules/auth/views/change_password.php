<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">User</li>
</ul>


<div class="row">
    <div class="col-md-6">
        <div class="element-wrapper">
            <!--<h6 class="element-header">
            </h6>-->
            <div class="element-box">
                <?php echo form_open("auth/change_password");?>
                    <h5 class="form-header">
                        Change Password
                    </h5>
                    <div class="form-desc">
                    </div>

                    <div class="form-group row ">
                        <label class="col-md-6" for=""> Current Password</label>
                        <div class="col-md-6" >
                            <?php echo form_input($old_password);?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6" for="">Password</label>
                        <div class="col-md-6" >
                            <?php echo form_input($new_password);?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-6" for="">Confirm Password</label>
                        <div class="col-md-6" >
                        <?php echo form_input($new_password_confirm);?>
                        </div>
                    </div>

                    <div class="form-buttons-w">
                        <?php echo form_input($user_id);?>
                        <?php echo form_submit('submit', lang('change_password_submit_btn'));?>
                        <!--<button class="btn btn-primary" type="submit"> Submit</button>-->
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>





