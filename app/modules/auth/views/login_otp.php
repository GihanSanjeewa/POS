<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HRMS | User Login</title>

    <!-- page css -->
    <link href="<?php echo base_url(); ?>assets/css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #infoMessage p {
            font-size: 10px;
            padding: 2px;
            margin: 2px;
            color: red;
        }
    </style>
</head>

<body class="horizontal-nav skin-megna card-no-border">

        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Arrow HRMS</p>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <section id="wrapper">
            <?php
            $this->load->model('hr_payroll/administration_mod');
            $settings = $this->administration_mod->load_settings();

            if($this->administration_mod->setting('background_logo')!="") {
                $bg_logo = "uploads/bg/".$this->administration_mod->setting('background_logo');
            } else {
                $bg_logo = "assets/images/background/login-register.jpg";
            }
            ?>
            <div class="login-register" style="background-image:url(<?php echo base_url().$bg_logo; ?>);">
                <div class="login-box card">
                    <div class="card-body">

                        <?php
                        $attributes = array('class' => 'form-horizontal form-material', 'id' => 'loginform');
                        echo form_open('auth/login_otp', $attributes);
                        ?>
                        <div id="infoMessage">
                            <span> <?php echo $message;?> </span>
                        </div>

                            <h3 class="box-title m-b-20">One Time Password</h3>
                            <p>Please enter one time password token below.</p>
                            <div class="form-group ">
                                <div class="col-xs-12">
                                    <?php echo form_input($token);?>
                                    <?php echo form_hidden($identity);?>
                                    <?php echo form_hidden($remember);?>
                                    <?php echo form_hidden($otp_login_key);?>

                                </div>
                            </div>
                            <div class="form-group text-center">
                                <div class="col-xs-12 p-b-20">
                                    <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Submit</button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>

            </div>
        </section>

        <p style="text-align: right; position: absolute; bottom: 10px; right: 10px;font-size: 10px;color: #fff;">Arrow ERP © <?php echo date("Y"); ?> All Rights Reserved. Authorized personnel only. </p>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->

      <!-- ============================================================== -->
      <!-- All Jquery -->
      <!-- ============================================================== -->
      <script src="<?php echo base_url(); ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
      <!-- Bootstrap tether Core JavaScript -->
      <script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
      <!--Custom JavaScript -->
      <script type="text/javascript">
          $(function() {
              $(".preloader").fadeOut();
          });
          $(function() {
              $('[data-toggle="tooltip"]').tooltip()
          });
          // ==============================================================
          // Login and Recover Password
          // ==============================================================
          $('#to-recover').on("click", function() {
              $("#loginform").slideUp();
              $("#recoverform").fadeIn();
          });
      </script>
</body>

</html>