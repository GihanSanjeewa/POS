<style>
    /* Styles for verification */
    #password_warp #pswd_info {
        position:absolute;
        bottom: -130px;
        right:-250px;
        width:250px;
        padding:15px;
        background:#fefefe;
        font-size:.875em;
        border-radius:5px;
        box-shadow:0 1px 3px #ccc;
        border:1px solid #ddd;
        display:none;
        z-index: 999999;
    }
    #password_warp #pswd_info::before {
        content: "\25C0";
        position:absolute;
        top:25%;
        left:-12px;
        font-size:14px;
        line-height:14px;
        color:#ddd;
        text-shadow:none;
        display:block;
    }
    #password_warp #pswd_info h4 {
        margin:0 0 10px 0;
        padding:0;
        font-weight:normal;
    }

    .invalid {
        /*background:url(images/invalid.png) no-repeat 0 50%;*/
        font-family: "FontAwesome";
        content: "\f057";
        padding-left:22px;
        line-height:24px;
        color:#ec3f41;
    }
    .valid {
        /*background:url(images/valid.png) no-repeat 0 50%;*/
        font-family: "FontAwesome";
        content: "\f058";
        padding-left:22px;
        line-height:24px;
        color:#3a7d34;
    }
</style>
<ul class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">User</li>
</ul>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Change Password</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Change Password</h4>
            </div>
            <div class="element-box">
                <form id="change_password_form" class="form-horizontal" role="form" autocomplete="off">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" />
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="old_password">Current Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="old_password" name="old_password" value="" autcomplete="false" required="required"  />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="password">New Password</label>
                                <div id="password_warp" class="col-md-6">
                                    <input class="form-control" type="password" id="password" name="password" value="" autcomplete="false" required="required"   />
                                    <span class="error-block"></span>
                                    <div id="pswd_info">
                                        <p style="margin-left: 20px;">Password must meet the following requirements:</p>
                                        <ul>
                                            <li id="letter" class="invalid">At least <strong>one letter</strong></li>
                                            <li id="capital" class="invalid">At least <strong>one capital letter</strong></li>
                                            <li id="number" class="invalid">At least <strong>one number</strong></li>
                                            <li id="length" class="invalid">Be at least <strong>8 characters</strong></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 required" for="password_confirm">Confirm Password</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="password" id="password_confirm" name="password_confirm" value=""  autcomplete="false" required="required" />
                                    <span class="error-block"></span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="btnSave">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
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
        $("#btnSave").off('click');
        $("#btnSave").on('click', function(e){
            e.preventDefault();
            if (chlength == 1 && number == 1 && capital == 1 && letter == 1) {
                $('#pswd_info').hide();
                save();
            } else {
                $('#pswd_info').show();
            }
        });
    });

    function save()
    {
        var url = "<?php echo site_url('auth/save_change_password'); ?>";
        $.ajax({
            url: url,
            data: $("#change_password_form").serialize(),
            type: "POST",
            dataType: "JSON",
            cache: false,
            success: function(data){

                if(data.status) {
                    bootbox.alert(data.message);
                    window.location.reload(true);
                } else {
                    if(data.message) {
                        bootbox.alert(data.message);
                    }
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




