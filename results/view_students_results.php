<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 8/22/2018
 * Time: 12:33 PM
 */
?>

<!DOCTYPE html>
<html lang="en">

<?php
$base_url="http://ww2.earrow.net/aq_agri/";
//$base_url="http://localhost/agriculture/";
?>

<link href="<?php echo $base_url.'assets/css/custom.css'; ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url; ?>assets/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url; ?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url; ?>assets/node_modules/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/node_modules/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/node_modules/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $base_url; ?>assets/node_modules/bootstrap-duallistbox-4/dist/bootstrap-duallistbox.min.css" rel="stylesheet" type="text/css" />
<!--V2-->
<link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
<link href="<?php echo $base_url; ?>assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/plugins/dropzone/dist/dropzone.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/plugins/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/plugins/slick-carousel/slick/slick.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/icon_fonts_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/icon_fonts_assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/icon_fonts_assets/dripicons/webfont.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/icon_fonts_assets/picons-thin/style.css" rel="stylesheet">
<link href="<?php echo $base_url; ?>assets/css/main.css" rel="stylesheet">

<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>


<script src="<?php echo $base_url; ?>assets/plugins/jquery/dist/jquery.min.js"></script>

<style>
    #book_info_table tbody td {
        padding: 5px 5px;
    }
    #book_info_table .btn {
        margin-left: 0;
        margin-right: 5px;
        padding: 5px 5px;
    }

    body:before {
        background: linear-gradient(to bottom right, #ffffff, #ffffff);
    }

    .table {
        width: 70%;
        max-width: 70%;
        margin-left: 15%;
    }

    th{
        background-color: #3882ad;
        color: white;
    }
</style>

<body>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <h4 style="text-align: center;">Department of Agriculture</h4>
        <h5 style="text-align: center;">Students Results</h5>
        <div class="form">
            <form action="#" id="add_new_book_form" class="form-horizontal">
                <div class="form-body">
                    <div class="form-group" style="max-width: 300px; margin: 0 auto;">
                        <label class="control-label" for="book_name" style="text-align: center;display: block;width: 55%;">ENTER STUDENT ID/NIC</label>
                        <input type="text" name="index_number" id="index_number" maxlength="15" class="form-control">
                        <p id="index_number_alert" class="error" style="color: red"></p>
                        <input type="button" id="btn_search1"  class="btn btn-success" value="SUBMIT" style=" margin: 0 auto; display: block">
                    </div>
                    <div style="max-width: 300px; margin-left:47%;margin-top:10px;" id="loading_div">
                        <img src="http://122.255.11.150/esms/assets/global/img/loading.gif">
                    </div>
                </div>
            </form>
        </div>
        <div style="text-align: center;display: none" class="box-body box-bordered" id="index_status_div_box_1">
            <div style="text-align: center" id="index_status_div_1">

            </div>
        </div>
    </div>
</div>
</body>
</html>

<!-- BEGIN CORE PLUGINS -->
<script src="<?php echo $base_url; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo $base_url; ?>assets/plugins/tether/dist/js/tether.min.js"></script>
<script src="<?php echo $base_url; ?>assets/plugins/slick-carousel/slick/slick.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/main.js"></script>

<!--V1 -->
<script src="<?php echo $base_url; ?>assets/node_modules/popper/popper.min.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/waves.js"></script>
<script src="<?php echo $base_url; ?>assets/js/sidebarmenu.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo $base_url; ?>assets/js/custom.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/dataTables.buttons.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/buttons.flash.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/jszip.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/pdfmake.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/vfs_fonts.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/buttons.html5.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/dt/buttons.print.min.js"></script>
<script src="<?php echo $base_url; ?>assets/js/jquery.dataTables.yadcf.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/moment/moment.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url; ?>assets/node_modules/bootstrap-duallistbox-4/dist/jquery.bootstrap-duallistbox.min.js" type="text/javascript"></script>
<script type="text/javascript">

    $('#loading_div').css('display','none');

    $('#btn_search1').on('click',function(){

        $('#index_status_div_box_1').css('display','none');
        $('#index_status_div_box_2').css('display','none');
        var index_id=$('#index_number').val();

        if(index_id==""){
            $('#index_number_alert').text("Please Enter Student ID/NIC");
        }
        else{

            $('#loading_div').show();

            $('#index_number_alert').text("");
            $('#index_status_div_1').html('');

            $.ajax({
                // please replace web_auth_results.php with request_from_web.php
                url:"<?php echo $base_url; ?>agriculture_results/web_auth_results.php",
                //please replace GET with POST
                type: "GET",
                dataType: "HTML",
                data: {
                    id:index_id,
                },
                success:function(data){

                    $('#loading_div').css('display','none');

                    $('#index_status_div_box_1').html(data);

                    $('#index_status_div_box_1').show();

                },
                error: function () {
                    $('#index_number_alert').text('No Results Found !');
                }
            });
        }

        $('#index_number').on('click',function(){
            $('#index_number_alert').text("");
        });
    });

</script>
