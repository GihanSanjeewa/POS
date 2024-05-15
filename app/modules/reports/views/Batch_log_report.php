<style>
    .embedded-daterangepicker .daterangepicker::before,
    .embedded-daterangepicker .daterangepicker::after {
        display: none;
    }
    .embedded-daterangepicker .daterangepicker {
        position: relative !important;
        top: auto !important;
        left: auto !important;
        float: left;
        width: 100%;
        margin-top: 0;
    }
    .embedded-daterangepicker .daterangepicker .drp-calendar {
        width: 48% !important;
        max-width: 50%;
    }
    .select2-container .select2-selection--single {
        width: 400px !important;
        height: 35px !important;
    }
    .penalty{
        background-color: #fbd8ff !important;
    }
    .optioncolor{
        color: red;
    }
    /*.modal-body {
        max-height: calc(200vh - 250px);
        overflow-y: auto;
    }*/
</style>
<?php
date_default_timezone_set("Asia/Colombo");
$date=date("yy-m-d");
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active">Reports</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">

            </div>
            <div class="row">
                <div class="col-sm-5 col-lg-3">
                    <div class="form-group">
                        <label><b>Branch : </b></label>
                        <select name="filter_branches" id="filter_branches" class="form-control selectpicker"
                                data-live-search="true">
                            <option value=""></option>


                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>
                <div class="col-sm-5 col-lg-3">
                    <div class="form-group">
                        <label><b>Course : </b></label>
                        <select name="filter_courses" id="filter_courses" class="form-control selectpicker"
                                data-live-search="true">
                            <option value=""></option>

                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>
               <!-- <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <label><b>Intake : </b></label>
                        <select name="intake" id="intake" class="form-control selectpicker" data-live-search="true">
                            <option value="">Select Intake</option>
                            <?php
                            foreach ($intakes as $intake) {
                                echo '<option value="' . $intake->id . '">'.$intake->intake_name.'-'.$intake->year.'</option>';
                            }
                            ?>
                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>-->
                <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <label><b>Batch : </b></label>
                        <select name="filter_batches" id="filter_batches" class="form-control selectpicker"
                                data-live-search="true">
                            <option value=""></option>

                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-3" style="padding-top: 22px;">
                    <div class="form-group">
                        <button onclick="loadStudent()" class="btn btn-success"><i class="icon-magnifier"></i> Search</button>
                    </div>
                </div>
            </div>
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Batch-Logs-Report</h4>
            </div>
            <div class="element-box">


                <div class="tab-content tabcontent-border">

                    <a class="dt-button buttons-excel buttons-html5" href="#" title="Excel"  onClick="javascript:fnExcelReport();"><span><i class="fa fa-file-excel-o"></i></span></a>
                    <a class="dt-button buttons-csv buttons-html5" href="#" title="Preview"  onClick="javascript:PrintPreview();"><span><i class="fa fa-search-plus"></i></span></a>
                    <a class="dt-button buttons-print buttons-html5" onClick="javascript:PrintDiv();" href="#"><span><i style="width: 200px;" class="fa fa-print"></i></span></a>
                    <div id="report_body" class="box-body box-bordered" ">
                    </div>

            </div>
            <script>
                $(document).ready(function() {


                    // students

                    // $('#tab_r_2').hide();
                    // $('#tab_r_1').show();

                    get_filter_data_set_cutoff();

                    //added--------
                    get_filter_data_course();
                    //---------------
                });
                //added----------------------
                $('#filter_branches').change(function() {


                    get_filter_data_course();
                    get_pf_filter_batch_branch_data_set();



                });
                function loadStudent() {
                    $('#view_data').empty();
                    var branch = $('#filter_branches').val();
                    var batch = $('#filter_batches').val();
                    var course = $('#filter_courses').val();

                    //alert(course,level,discipline,curculem);

                    $.ajax({
                        type: "post",
                        async: false,
                        url:"<?php echo base_url('reports/Batch_logs_con/checkPayemnt');?>",
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash()?>",
                            batch: batch,
                            branch:branch,
                            course:course,

                        },
                        dataType: "html",
                        success: function (data) {

                            console.log(data);


                            //  $('#loading').hide();
                            //console.log(data);
                            $('#report_body').html(data);

                        }
                    });

                }
                //branch->course->batch
                $('#filter_courses').change(function() {
                    get_pf_filter_batch_branch_data_set($(this).val());
                });
                function get_pf_filter_batch_branch_data_set(course) {


                    $('#filter_batches').html('');
                    var branch = $('#filter_branches').val();


                    $.ajax({
                        url: "<?php echo base_url('reports/Batch_logs_con/get_batch_by_branch'); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            branch: branch,
                            course: course,
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                        },
                        success: function(data) {


                            $('#filter_batches').html('<option value="">-- Select--</option>');
                            for (var i = 0; i < data.batches.length; i++) {
                                $('#filter_batches').append('<option value="' + data.batches[i].id + '">' + data
                                        .batches[i].batch_code + '</option>');
                            }

                            $('.selectpicker').selectpicker('refresh');

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                }
                function get_filter_data_course() {



                    // $('#filter_branches').html('');
                    $('#filter_courses').html('');
                    $.ajax({
                        url: "<?php echo base_url('reports/Batch_logs_con/get_process_course_filter_data'); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                        },
                        success: function(data) {







                            // $('#filter_branches').html('<option value="">-- Select--</option>');
                            // for (var i = 0; i < data.branches.length; i++) {
                            //     $('#filter_branches').append('<option value="' + data.branches[i].id + '">' + data
                            //         .branches[i].name + '</option>');
                            // }






                            $('#filter_courses').html('<option value="">-- Select--</option>');
                            for (var i = 0; i < data.courses.length; i++) {
                                $('#filter_courses').append('<option value="' + data.courses[i].id + '">' +
                                    data.courses[
                                        i].name + '</option>');
                            }
                            //refresh the select box


                            $('.selectpicker').selectpicker('refresh');

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                }
                function get_filter_data_set_cutoff() {



                    $('#filter_branches').html('');
                    // $('#filter_courses').html('');
                    $.ajax({
                        url: "<?php echo base_url('reports/Batch_logs_con/get_process_branch_course_filter_data'); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                        },
                        success: function(data) {







                            $('#filter_branches').html('<option value="">-- Select--</option>');
                            for (var i = 0; i < data.branches.length; i++) {
                                $('#filter_branches').append('<option value="' + data.branches[i].id +
                                    '">' + data
                                        .branches[i].name + '</option>');
                            }



                            $('.selectpicker').selectpicker('refresh');

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                }

                function fnExcelReport() {
                 var file = new Blob([$('#report_body').html()], {type:"application/vnd.ms-excel"});
                 var url = URL.createObjectURL(file);
                 var a = $("<a />", { href: url, download: "Arrow_HRMS_Export.xls"}).appendTo("body").get(0).click();
                 e.preventDefault();
             }

             function PrintDiv() {
                 var divToPrint = document.getElementById('report_body');
                 var popupWin = window.open('', '_blank', 'width=1000,height=1000');
                 popupWin.document.open();
                 popupWin.document.write('<html><head><title>Print</title><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default_print.css" media="screen"/></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                 popupWin.document.close();
             }

             function PrintPreview() {
                 var toPrint = document.getElementById('report_body');
                 var popupWin = window.open('', '_blank', 'width=1000,height=800,location=no,left=1000px');
                 popupWin.document.open();
                 popupWin.document.write('<html><head><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default_print.css" media="screen"/></head><body">');
                 popupWin.document.write(toPrint.innerHTML);
                 popupWin.document.write('</html>');
                 popupWin.document.close();
             }

            </script>





        </div>
    </div>
</div>