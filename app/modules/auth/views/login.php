<!DOCTYPE html>
<html>
<head>
    <title>Higher Education Managed System (HEMS)  | User Login</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="<?php echo base_url(); ?>assets/images/favicon.png" rel="shortcut icon">
    <link href="<?php echo base_url(); ?>assets/images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/plugins/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
</head>
<body class="auth-wrapper">
<?php
$this->load->model('users/administration_mod');
$settings = $this->administration_mod->load_settings();

if($this->administration_mod->setting('background_logo')!="") {
    $bg_logo = "uploads/bg/".$this->administration_mod->setting('background_logo');
} else {
    $bg_logo = "assets/images/background/login-register.jpg";
}
?>
<style>
    body::before {
        background:url(<?php echo base_url().$bg_logo; ?>);
        background-size: cover;
        background-repeat: no-repeat;
    }
    #infoMessage p {
        font-size: 10px;
        padding: 2px;
        margin: 2px;
        color: red;
    }
    .auth-box-w .logo-w {
        text-align: center;
        padding: 5%;
    }
</style>
<div class="all-wrapper menu-side with-pattern">
    <div class="auth-box-w">
        <div class="logo-w">
            <?php

            if($this->administration_mod->setting('')!="") {
                // $logo = "uploads/logo/".$this->administration_mod->setting('company_logo');
            } else {
                // $logo = "assets/images/logo.jpg";
            }
            ?>
            <!-- <a href="#"><img src="<?php echo base_url().$logo; ?>" class="light-logo" alt="homepage" style="width: 120px;"  /></a> -->
            <h4 style="display: block;font-size:1.2em">Point Of Sales</h4>
        </div>
        <h4 class="auth-header">
            Sign In
        </h4>
        <?php
        $attributes = array('class' => 'form-horizontal form-material', 'id' => 'loginform');
        echo form_open('auth/login', $attributes);
        ?>

        <div id="infoMessage">
            <span> <?php echo $message;?> </span>
        </div>
        <div class="form-group">
            <label for="">Username</label>
            <?php
            $u_attributes = array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter your username');
            echo form_input($identity,$u_attributes);
            ?>
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
        </div>
        <div class="form-group">
            <label for="">Password</label>
            <?php
            $p_attributes = array('class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Enter your password');
            echo form_input($password);
            ?>
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
        </div>

        <div class="buttons-w">
            <button class="btn btn-primary" type="submit">Log In</button>
            <!--<div class="form-check-inline">
                <label class="form-check-label"><input class="form-check-input" type="checkbox">Remember Me</label>
            </div>-->
        </div>
        <?php echo form_close();?>
    </div>
</div>
</body>
</html>
