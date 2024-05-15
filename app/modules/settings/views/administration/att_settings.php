<link href="<?php echo base_url(); ?>assets/node_modules/clockpicker/dist/bootstrap-clockpicker.min.css" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active">Attendance Settings</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Attendance Settings</h4>
                <button class="btn btn-success pull-right" onclick="save();"><i class="fa fa-save"></i> Save All </button>
            </div>
            <div class="element-box">
                <form action="#" id="att_settings_form" class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Full Day Work Hours</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[work_hours]" id="work_hours" class="form-control" placeholder="" value="<?php echo $this->administration_mod->setting('work_hours'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Half Day Work Hours</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[work_hours_half]" id="work_hours_half" class="form-control" placeholder="" value="<?php echo $this->administration_mod->setting('work_hours_half'); ?>" >
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day - Start Time</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[start_time]" id="start_time" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('start_time'); ?>" readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day - End Time</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[end_time]" id="end_time" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('end_time'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day(Holiday-Evening) - Start Time</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[holiday_evening_start]" id="holiday_evening_start" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('holiday_evening_start'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day(Holiday-Morning) - End Time</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[holiday_morning_end]" id="holiday_morning_end" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('holiday_morning_end'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Half Day - End/Start</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[halfday_time_mo_end]" id="halfday_time_mo_end" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('halfday_time_mo_end'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Short Leave Check - Morning</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[halfday_time_mo]" id="halfday_time_mo" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('halfday_time_mo'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Short Leave Check - Evening</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[halfday_time_ev]" id="halfday_time_ev" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('halfday_time_ev'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day - Late</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[late_time_LA]" id="late_time_LA" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('late_time_LA'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day - Early Leave</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[late_time_EL]" id="late_time_EL" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('late_time_EL'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day (Holiday-Morning) - Early Late</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[holiday_morning_er_late]" id="holiday_morning_er_late" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('holiday_morning_er_late'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4">Work Day (Holiday-Evening) - Late</label>
                                    <div class="col-md-6">
                                        <input type="text" name="settings[holiday_evening_late]" id="holiday_evening_late" class="form-control clockpicker" placeholder="" value="<?php echo $this->administration_mod->setting('holiday_evening_late'); ?>"  readonly>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div style="height: 180px"></div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>

<script>

    $(document).ready(function(){


        $('.clockpicker').clockpicker({
            donetext: 'Done',
            autoclose: true
        });
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
        var url = "<?php echo site_url('hr_payroll/administration/save_att_settings')?>";
        $.ajax({
            url: url,
            type: "POST",
            data: $('#att_settings_form').serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    //reload_table(allowance_datatable);
                    window.location = "<?php echo base_url('hr_payroll/administration/hr_att_settings')?>";
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

