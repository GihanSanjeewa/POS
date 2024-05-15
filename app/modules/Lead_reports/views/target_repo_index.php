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



 <br>


 <div class="row">
     <div class="col-12">
         <div class="element-wrapper">
             <div class="element-actions">
             </div>

             <div class="row">

                 <div class="col-sm-2">
                     <div class="form-group">
                         <label><b>From (Year) : </b></label>
                         <input type="text" name="targ_yr1" id="targ_yr1" class="form-control" size="16"
                             onkeypress="return onlyNumberKey(event)"  required>
                         <span style="color:red;">April</span>
                         <p id="assign_date_alert" class="error" style="color: red"></p>
                         <span class="error-block"></span>
                     </div>
                 </div>

                 <div class="col-sm-2">
                     <div class="form-group">
                         <label id="hidden_label"><b>To (Year) : </b></label>
                         <input type="text" name="targ_yr2" id="targ_yr2" class="form-control" size="16"
                             onkeypress="return onlyNumberKey(event)"  required>
                         <span style="color:red;">March</span>
                         <p id="assign_date_alert" class="error" style="color: red"></p>
                         <span class="error-block"></span>
                     </div>
                 </div>
                 <script>
                 function onlyNumberKey(evt) {


                     // Only ASCII character in that range allowed
                     var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                     if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                         return false;
                     return true;


                 }
                 </script>


                 <!-- <div class="form-group row">


                     <label class="control-label col-md-4">Year:</label>

                     <div class="col-md-3">

                         <input type="text" name="targ_yr1" id="targ_yr1" class="form-control" size="16"
                             onkeypress="return onlyNumberKey(event)" placeholder="From" required>
                         <span style="color:red;">April</span>
                         <p id="assign_date_alert" class="error" style="color: red"></p>

                         <span class="error-block"></span>
                     </div>

                     <div class="col-md-3">

                         <input type="text" name="targ_yr2" id="targ_yr2" class="form-control" size="16"
                             onkeypress="return onlyNumberKey(event)" placeholder="To" required>
                         <span style="color:red;">March</span>
                         <p id="assign_date_alert" class="error" style="color: red"></p>

                         <span class="error-block"></span>
                     </div>
                     <br>



                 </div> -->


                 <div class="col-sm-5 col-lg-3">
                     <div class="form-group">
                         <label><b>Course : </b></label>
                         <select name="filter_courses" id="filter_courses" class="form-control selectpicker"
                             data-live-search="true">
                             <option value="">--Program Selection--</option>
                             <?php
                                                            foreach ($program as $program_nw) { ?>
                             <option value="<?php echo $program_nw->id;?>">
                                 (<?php echo $program_nw->code ?>)<?php echo $program_nw->name ?>
                             </option>
                             <?php  }
                                                            ?>

                         </select>
                         <span class="error-block"></span>
                     </div>
                 </div>







                 <!-- <div class="col-sm-5 col-lg-3">
                     <div class="form-group">
                         <label><b>Student's Counsellor : </b></label>
                         <select name="filter_counsellor" id="filter_counsellor" class="form-control selectpicker"
                             data-live-search="true">
                             <option value="">--Select--</option>
                             <?php
                                                            foreach ($Counselor as $c) { ?>
                             <option value="<?php echo $c->id;?>">
                                 <?php echo $c->name; ?></option>
                             <?php  }
                                                            ?>

                         </select>
                         <span class="error-block"></span>
                     </div>
                 </div> -->




             </div>

             <div class="row">
                 <div class="col-sm-4 col-lg-3">
                     <div class="form-group">
                         <button onclick="filter_target_report()" class="btn btn-success"><i class="icon-magnifier"></i>
                             Search</button>
                     </div>
                 </div>
             </div>



             <div class="card-header bg-info page-head-title-wrap">
                 <h4 class="page-head-title card-title  text-white" style="display: inline-block">Lead Target Report
                 </h4>
             </div>





             <div id="report_body" class="box-body box-bordered"></div>

         </div>
     </div>
 </div>





 <script>
$(document).ready(function() {
    document.getElementById("hidden_label").style.display = 'block';
    $("#targ_yr1").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
        // $("#targ_course").val("");
    });

    $("#targ_yr2").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
        // $("#targ_course").val("");
    });


});



function filter_target_report() {



    var year1 = $('#targ_yr1').val(),
        year2 = $('#targ_yr2').val(),
        program = $('#filter_courses').val();
   

     





    if (year1 == "") {
        bootbox.alert({
            message: "<b style='text-align:center;color:red;'>The From Year field is required.</b>"
        });



    } else if (year2 == "") {
        bootbox.alert({
            message: "<b style='text-align:center;color:red;'>The To Year field is required.</b>"
        });



    
    
    } else if (year1 == year2) {
        bootbox.alert({
            message: "<b style='text-align:center;color:red;'>From Year & To Year Can't be the same.</b>"
        });
    } else if (year1 > year2) {
        bootbox.alert({
            message: "<b style='text-align:center;color:red;'>Please Enter Valid Year Range.</b>"
        });

    } else if ((year2 - year1) != 1) {
        bootbox.alert({
            message: "<b style='text-align:center;color:red;'>Year Range Difference Should be 1.</b>"
        });

    } else {



    $.ajax({
        url: '<?php echo base_url('Lead_reports/Target_repo_con/view_target_table'); ?>',
        type: 'post',
        dataType: 'html',
        data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            "year1": year1,
            "year2": year2,
            "program": program,

        },
        success: function(data) {


            $('#report_body').html(data);

        }
    });
    }
}
 </script>