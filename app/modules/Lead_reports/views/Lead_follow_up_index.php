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

                 <div class="col-sm-4 col-lg-3">
                     <div class="form-group">
                         <label><b>Date : </b></label>

                         <input type="hidden" id="from_date" name="from_date">
                         <input type="hidden" id="to_date" name="to_date">
                         <div id="dashboard-report-range" class="btn btn-sm" data-container="body"
                             data-placement="bottom" data-original-title="Change dashboard date range"
                             style=" background: #d46c20;color: #fff; margin-top: -5px;">
                             <i class="icon-calendar"></i>Period :
                             <span class="new thin uppercase hidden-xs"></span>&nbsp;
                             <i class="fa fa-angle-down"></i>
                         </div>

                         <span class="error-block"></span>
                     </div>
                 </div>


                 <?php

$groups_2=array('student_counsellors'); 

$groups=array('student_counsellors','lead_manager','admin'); if ($this->ion_auth->in_group($groups)) {

$groups_1=array('lead_manager','admin'); if ($this->ion_auth->in_group($groups_1)) {
?>




                 <div class="col-sm-5 col-lg-3">
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
                 </div>

                 <?php
} elseif($this->ion_auth->in_group($groups_2)) {
?>


                 <div class="col-sm-5 col-lg-3">
                     <div class="form-group">
                         <label><b>Student's Counsellor : </b></label>
                         <input type="text" value="<?php echo $log_user->name; ?>" class="form-control"
                             id="counsellor_name" readonly>
                         <input type="hidden" value="<?php echo $log_user->id; ?>" class="form-control"
                             id="counsellor_id">
                         <span class="error-block"></span>
                     </div>
                 </div>



                 <?php
}
}
                                    ?>
             </div>

             <div class="row">
                 <div class="col-sm-4 col-lg-3">
                     <div class="form-group">
                         <button onclick="filter_follow_up_report()" class="btn btn-success"><i
                                 class="icon-magnifier"></i>
                             Search</button>
                     </div>
                 </div>
             </div>



             <div class="card-header bg-info page-head-title-wrap">
                 <h4 class="page-head-title card-title  text-white" style="display: inline-block">Lead Follow up Report
                 </h4>
             </div>





             <div id="report_body" class="box-body box-bordered"></div>

         </div>
     </div>
 </div>





 <script>
$(document).ready(function() {


    $('#date_select').datepicker({
        uiLibrary: 'bootstrap'
    });
    $('#dashboard-report-range').daterangepicker({
        "maxSpan": {
            "days": 31
        },
        "ranges": {
            'Last Month': [moment().subtract('month', 1).startOf('month'), moment()
                .subtract('month', 1).endOf('month')
            ],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'This Year': [moment().startOf('year'), moment().endOf('year')]
        },
        "opens": "right"
    }, function(start, end, label) {
        var start_date = start.format('YYYY-MM-DD'),
            end_date = end.format('YYYY-MM-DD');
        $('#dashboard-report-range span').html(start_date + ' - ' + end_date);
        $('#from_date').val(start_date);
        $('#to_date').val(end_date);
    });


});



function filter_follow_up_report() {



    var from_filter = $('#from_date').val();
    var to_filter = $('#to_date').val();
    var counsellor_filter = $('#filter_counsellor').val();
    var counsellor_id = $('#counsellor_id').val();



    $('#report_body').html('');


    $.ajax({
        url: '<?php echo base_url('Lead_reports/Lead_follow_up_con/view_follow_up_table'); ?>',
        type: 'post',
        dataType: 'html',
        data: {
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
            "from": from_filter,
            "to": to_filter,
            "counsellor": counsellor_filter,
            "counsellor_id":counsellor_id,


        },
        success: function(data) {


            $('#report_body').html(data);

        }
    });
}
 </script>