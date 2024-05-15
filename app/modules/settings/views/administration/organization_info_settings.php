<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Organization Info Settings</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Organization Info Settings</h4>
                <a class="btn btn-success pull-right" href="<?php echo base_url('settings/administration/view_hr_org_details')?>" style="color: #fff;margin-right: 10px;"><i class="fa fa-eye"></i> View </a>
                <button class="btn btn-success pull-right" onclick="save();" style="margin-right: 10px;"><i class="fa fa-save"></i> Save All </button>
            </div>
            <div class="element-box">
                <form action="#" id="admin_settings_form" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">

                                    <div class="col-md-4">
                                        <label class="control-label">Logo</label>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if ($this->administration_mod->setting('company_logo')) { ?>
                                            <img src="<?php echo base_url(); ?>uploads/logo/<?php echo $this->administration_mod->setting('company_logo'); ?>" height="70px"><br>
                                            <?php echo anchor('settings/administration/remove_logo/company', 'Remove Logo'); ?><br>
                                        <?php } ?>
                                        <input type="file" id="company_logo" name="company_logo" size="40" class="input-sm form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Organization Name</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[company_name]" id="company_name" class="form-control" placeholder="" value="<?php echo $this->administration_mod->setting('company_name'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Organization Address</label>
                                    <div class="col-md-6">
                                        <textarea name="settings[company_address]" id="company_address"  class="form-control"><?php echo $this->administration_mod->setting('company_address'); ?></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Organization Started On </label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[company_start_date]" id="company_start_date" class="form-control date-pick" placeholder="" value="<?php echo $this->administration_mod->setting('company_start_date'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Website</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[company_website]" id="company_website" class="form-control" placeholder="" value="<?php echo $this->administration_mod->setting('company_website'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Total Employees</label>
                                    <div class="col-md-6">

                                        <select name="settings[company_tot_emp]" id="company_tot_emp">

                                            <option value="">--</option>
                                            <?php
                                            $tot_emp = $this->administration_mod->setting('company_tot_emp');
                                            if (empty($tot_emp)) { ?>
                                                <option value="20-50">20-50</option>
                                                <option value="51-100">51-100</option>
                                                <option value="101-500">101-500</option>
                                                <option value="501 -1000">501 -1000</option>
                                                <option value="> 1000">&gt; 1000</option>
                                            <?php } else { ?>
                                                <option value="20-50" <?php echo $tot_emp == '20-50' ? 'selected' : '' ?>>20-50</option>
                                                <option value="51-100" <?php echo $tot_emp == '51-100' ? 'selected' : '' ?>>51-100</option>
                                                <option value="101-500" <?php echo $tot_emp == '101-500' ? 'selected' : '' ?>>101-500</option>
                                                <option value="501 -1000"<?php echo $tot_emp == '501-1000' ? 'selected' : '' ?>>501-1000</option>
                                                <option value="> 1000" <?php echo $tot_emp == '> 1000' ? 'selected' : '' ?>>> 1000</option> <?php } ?>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-4">Primary Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[company_phone_1]" id="company_phone_1" class="form-control" placeholder="" value="<?php echo $this->administration_mod->setting('company_phone_1'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">
                                        Secondary Phone Number</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[company_phone_2]" id="company_phone_2" class="form-control" placeholder="" value="<?php echo $this->administration_mod->setting('company_phone_2'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Organization Description</label>
                                    <div class="col-md-6">
                                        <textarea name="settings[company_description]" id="company_description"  class="form-control"><?php echo $this->administration_mod->setting('company_description'); ?></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-4">Organization Description</label>
                                    <div class="col-md-6">
                                        <select name="settings[company_domain]" id="company_domain" class="form-control select2">
                                            <option value="">--</option>
                                            <?php
                                            $company_domain = $this->administration_mod->setting('company_domain');
                                            if (empty($company_domain)) { ?>
                                                <option value="Automotive">Automotive</option>
                                                <option value="Construction">Construction</option>
                                                <option value="Consulting">Consulting</option>
                                                <option value="Education">Education</option>
                                                <option value="Engineering">Engineering</option>
                                                <option value="Government">Government</option>
                                                <option value="Healthcare">Healthcare</option>
                                                <option value="Hospitality">Hospitality</option>
                                                <option value="Insurance/Finance">Insurance/Finance</option>
                                                <option value="Manufacturing">Manufacturing</option>
                                                <option value="Marketing/PR">Marketing/PR</option>
                                                <option value="Media">Media</option>
                                                <option value="Not for profit">Not for profit</option>
                                                <option value="Oil/Gas/Utilities">Oil/Gas/Utilities</option>
                                                <option value="Pharmaceutical">Pharmaceutical</option>
                                                <option value="Real Estate">Real Estate</option>
                                                <option value="Retail and Consumer">Retail and Consumer</option>
                                                <option value="Technology">Technology</option>
                                                <option value="Telecommunications">Telecommunications</option>
                                                <option value="Travel and Leisure">Travel and Leisure</option>
                                                <option value="Other">Other</option>
                                            <?php } else { ?>

                                                <option value="Automotive" <?php echo $company_domain == 'Automotive' ? 'selected' : '' ?>>Automotive</option>
                                                <option value="Construction" <?php echo $company_domain == 'Construction' ? 'selected' : '' ?>>Construction</option>
                                                <option value="Consulting" <?php echo $company_domain == 'Consulting' ? 'selected' : '' ?>>Consulting</option>
                                                <option value="Education" <?php echo $company_domain == 'Education' ? 'selected' : '' ?>>Education</option>
                                                <option value="Engineering" <?php echo $company_domain == 'Engineering' ? 'selected' : '' ?>>Engineering</option>
                                                <option value="Government" <?php echo $company_domain == 'Government' ? 'selected' : '' ?>>Government</option>
                                                <option value="Healthcare" <?php echo $company_domain == 'Healthcare' ? 'selected' : '' ?>>Healthcare</option>
                                                <option value="Hospitality" <?php echo $company_domain == 'Hospitality' ? 'selected' : '' ?>>Hospitality</option>
                                                <option value="Insurance/Finance" <?php echo $company_domain == 'Insurance/Finance' ? 'selected' : '' ?>>Insurance/Finance</option>
                                                <option value="Manufacturing" <?php echo $company_domain == 'Manufacturing' ? 'selected' : '' ?>>Manufacturing</option>
                                                <option value="Marketing/PR" <?php echo $company_domain == 'Marketing/PR' ? 'selected' : '' ?>>Marketing/PR</option>
                                                <option value="Media" <?php echo $company_domain == 'Media' ? 'selected' : '' ?>>Media</option>
                                                <option value="Not for profit" <?php echo $company_domain == 'Not for profit' ? 'selected' : '' ?>>Not for profit</option>
                                                <option value="Oil/Gas/Utilities" <?php echo $company_domain == 'Oil/Gas/Utilities' ? 'selected' : '' ?>>Oil/Gas/Utilities</option>
                                                <option value="Pharmaceutical" <?php echo $company_domain == 'Pharmaceutical' ? 'selected' : '' ?>>Pharmaceutical</option>
                                                <option value="Real Estate" <?php echo $company_domain == 'Real Estate' ? 'selected' : '' ?>>Real Estate</option>
                                                <option value="Retail and Consumer" <?php echo $company_domain == 'Retail and Consumer' ? 'selected' : '' ?>>Retail and Consumer</option>
                                                <option value="Technology" <?php echo $company_domain == 'Technology' ? 'selected' : '' ?>>Technology</option>
                                                <option value="Telecommunications" <?php echo $company_domain == 'Telecommunications' ? 'selected' : '' ?>>Telecommunications</option>
                                                <option value="Travel and Leisure" <?php echo $company_domain == 'Travel and Leisure' ? 'selected' : '' ?>>Travel and Leisure</option>
                                                <option value="Other" <?php echo $company_domain == 'Other' ? 'selected' : '' ?>>Other</option>
                                            <?php } ?>

                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/jquery.inputmask.bundle.min.js" type="text/javascript"></script>


<script>

    $(document).ready(function(){
        $("#company_phone_1").inputmask("(999) 999-999");
        $("#company_phone_2").inputmask("(999) 999-999");

        //$(".select2-main").select2({allowClear: true,placeholder: "Select a value"});
        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });
        $("textarea").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });
        /*$("select").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });*/

        $("form :input:not(.input-optional, .input-hidden)").each(function(){
            $(this).siblings('label').append("<span class='required-mark' style='color: #c90054;'>*</span>");
        });
    });

    function save()
    {
        var formData = new FormData();
        var file = $('#admin_settings_form #company_logo')[0].files[0];
        //var file_2 = $('#admin_settings_form #background_logo')[0].files[0];
        formData.append("company_logo", file);
        //formData.append("background_logo", file_2);
        formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", "<?php echo $this->security->get_csrf_hash(); ?>");
        var other_data = $("#admin_settings_form").serializeArray();
        $.each(other_data,function(key,input){
            formData.append(input.name,input.value);
        });


        var url = "<?php echo site_url('settings/administration/save_org_settings')?>";
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    //reload_table(allowance_datatable);
                    window.location = "<?php echo base_url('settings/administration/hr_org_settings')?>";
                }
                else {
                    if (data.message) {
                        bootbox.alert(data.message);
                    }
                    if(data.error)
                    {
                        for (var l = 0; l < data.inputerror.length; l++)
                        {
                            $('[name="'+data.inputerror[l]+'"]').siblings("span.error-block").html(data.error_string[l]).show();
                        }
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

</script>

