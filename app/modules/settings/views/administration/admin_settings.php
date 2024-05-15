<link href="<?php echo base_url(); ?>assets/node_modules/MiniColors/jquery.minicolors.css" rel="stylesheet">

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Admin Settings</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Admin Settings</h4>
                <button class="btn btn-success pull-right" onclick="save();"><i class="fa fa-save"></i> Save All </button>
            </div>
            <div class="element-box">
                <form action="#" id="admin_settings_form" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="notify_expiry">Main Theme Color</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[color_theme]" id="color_theme" class="form-control colorpicker" placeholder="" value="<?php echo $this->administration_mod->setting('color_theme'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="notify_expiry">Secondary Theme Color</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[dt_bt_color]" id="dt_bt_color" class="form-control colorpicker" placeholder="" value="<?php echo $this->administration_mod->setting('dt_bt_color'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="notify_expiry">Menu Color</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[menu_h_color]" id="menu_h_color" class="form-control colorpicker" placeholder="" value="<?php echo $this->administration_mod->setting('menu_h_color'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="notify_expiry">Login Background</label>
                                    <?php if ($this->administration_mod->setting('background_logo')) { ?>
                                        <img src="<?php echo base_url(); ?>uploads/bg/<?php echo $this->administration_mod->setting('background_logo'); ?>" height="100px"><br>
                                        <?php echo anchor('settings/administration/remove_bg/background', 'Remove Background'); ?><br>
                                    <?php } ?>
                                    <input type="file" id="background_logo" name="background_logo" size="40" class="input-sm form-control"/>
                                    <span>use over 1200x800px resolution image</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/node_modules/MiniColors/jquery.minicolors.min.js"></script>

<script>

    $(document).ready(function(){

        $(".colorpicker").minicolors();

        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });
        $("textarea").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });
        $("select").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });

        $("form :input:not(.input-optional, .input-hidden)").each(function(){
            $(this).siblings('label').append("<span class='required-mark' style='color: #c90054;'>*</span>");
        });
    });

    function save()
    {
        var formData = new FormData();
        //var file = $('#admin_settings_form #company_logo')[0].files[0];
        var file_2 = $('#admin_settings_form #background_logo')[0].files[0];
        //formData.append("company_logo", file);
        formData.append("background_logo", file_2);
        formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", "<?php echo $this->security->get_csrf_hash(); ?>");
        var other_data = $("#admin_settings_form").serializeArray();
        $.each(other_data,function(key,input){
            formData.append(input.name,input.value);
        });


        var url = "<?php echo site_url('settings/administration/save_admin_settings')?>";
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
                    window.location = "<?php echo base_url('settings/administration/hr_admin_settings')?>";
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

