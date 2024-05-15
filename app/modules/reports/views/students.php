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
                <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <label><b>Batch : </b></label>
                        <select name="batch" id="batch" class="form-control selectpicker" data-live-search="true">
                            <option value="">Select Batch</option>
                            <?php
                            foreach ($batches as $batch) {
                                echo '<option value="' . $batch->id . '">Batch '.$batch->id.'</option>';
                            }
                            ?>
                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-3">
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
                </div>
                <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <label><b>Program : </b></label>
                        <select name="program" id="program" class="form-control selectpicker" data-live-search="true">
                            <option value="">Select Program</option>
                            <?php
                            foreach ($programs as $program) {
                                echo '<option value="' . $program->id . '">('.$program->code.')'.$program->name.'</option>';
                            }
                            ?>
                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <label><b>University : </b></label>
                        <select name="university" id="university" class="form-control selectpicker" data-live-search="true">
                            <option value="">Select University</option>
                            <?php
                            foreach ($universities as $university) {
                                echo '<option value="' . $university->id . '">('.$university->code.')'.$university->name.'</option>';
                            }
                            ?>
                        </select>
                        <span class="error-block"></span>
                    </div>
                </div>
                <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <button onclick="loadStudent()" class="btn btn-success"><i class="icon-magnifier"></i> Search</button>
                    </div>
                </div>
            </div>
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Students-Report</h4>
            </div>
            <div class="element-box">


                <div class="tab-content tabcontent-border">

                    <a class="dt-button buttons-excel buttons-html5" href="#" title="Excel"  onClick="javascript:fnExcelReport();"><span><i class="fa fa-file-excel-o"></i></span></a>
                    <a class="dt-button buttons-csv buttons-html5" href="#" title="Preview"  onClick="javascript:PrintPreview();"><span><i class="fa fa-search-plus"></i></span></a>
                    <a class="dt-button buttons-print buttons-html5" onClick="javascript:PrintDiv();" href="#"><span><i style="width: 200px;" class="fa fa-print"></i></span></a>
                    <div id="report_body" class="box-body box-bordered">
                    </div>

            </div>
            <script>
             function loadStudent() {
                 $('#view_data').empty();
                 var batch = document.getElementById("batch").value;
                 var intake = document.getElementById("intake").value;
                 var program = document.getElementById("program").value;
                 var university = document.getElementById("university").value;

                 $.ajax({
                     type: "post",
                     async: false,
                     url:"<?php echo base_url('reports/Reports_student_con/checkStudentInfo');?>",
                     data: {
                         "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash()?>",
                         batch:batch,
                         intake:intake,
                         program:program,
                         university:university,
                     },
                     dataType: "html",
                     success: function (data) {
                       //  $('#loading').hide();
                         //console.log(data);
                         $('#report_body').html(data);

                     }
                 });


                 //$.ajax({
                 //    url:"<?php //echo base_url('reports/Reports_student_con/checkStudentInfo');?>//",
                 //    dataType:"JSON",
                 //    type:"POST",
                 //    data:{
                 //        batch:batch,
                 //        intake:intake,
                 //        program:program,
                 //        university:university,
                 //        "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
                 //    },
                 //    success:function(data){
                 //        $('#report_body').html(data);
                 //        // $('#view_data').append('<tr>' +
                 //        //     '<th>Student ID</th>' +
                 //        //     '<th>Student Name</th>' +
                 //        //     '<th>Batch</th>' +
                 //        //     '<th>Intake</th>' +
                 //        //     '<th>Program</th>' +
                 //        //     '<th>Gender</th>' +
                 //        //     '<th>NIC/Passport</th>' +
                 //        //     '</tr>');
                 //        // for(var i=0;i<data.studentData.length;i++){
                 //        //     $('#view_data').append('<tr>' +
                 //        //         '<td style=>'+data.studentData[i].student_id+'</td>' +
                 //        //         '<td>'+data.studentData[i].st_full_name+'</td>' +
                 //        //         '<td>Batch '+data.studentData[i].batch_name+'</td>' +
                 //        //         '<td>'+data.studentData[i].intake_name+'-'+data.studentData[i].year+'</td>' +
                 //        //         '<td>'+data.studentData[i].program_name+'</td>' +
                 //        //         '<td>'+data.studentData[i].st_gender+'</td>' +
                 //        //         '<td>'+data.studentData[i].st_nic_num+'</td>' +
                 //        //         '</tr>');
                 //        // }
                 //
                 //    },
                 //    error:function(){
                 //        alert("error retrieve Student info");
                 //    }
                 //});
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