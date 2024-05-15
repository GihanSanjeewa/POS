<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/4/2019
 * Time: 3:47 PM
 */
?>

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
        width: 315px !important;
        height: 35px !important;
    }
    .modal-body {
        /*max-height: calc(200vh - 250px);
        overflow-y: auto;*/
    }
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
                <li class="breadcrumb-item"><a href="javascript:;">Class Management</a></li>
                <li class="breadcrumb-item active"> Registered Student</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">
            </div>
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Registered Student</h4>
            </div>
            <div class="element-box">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
<!--                    <li class="nav-item"><a class="nav-link active" role="tab" href="#filter" data-toggle="tab"> New Qualified Students</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link active" role="tab" href="#allocation" data-toggle="tab"> Qualified List</a></li>-->
<!--                    <li class="nav-item"><a class="nav-link" role="tab" href="#none" data-toggle="tab"> Non Qualified List</a></li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane p-20 " role="tabpanel" id="filter">
                        <form id="filter_form">
                            <table class="tool" id="tools" style="position: static; visibility: visible;margin-top: 10px;">
                                <tbody>
                                <tr>
                                    <td>Batch</td>
                                    <td>
                                        <select name="filter_batch" id="filter_batch" class="select2">
                                            <option value="">(---)</option>
                                            <?php foreach($batches as $batch){ ?>
                                                <option value="<?php echo $batch->id;?>"><?php echo $batch->name." - ".$batch->description; ?></option>
                                            <?php }?>
                                        </select>
                                        <span class="error-block"></span>
                                    </td>
                                    <td>
                                        <div style="text-align: center">
                                            <img style="width: 24px; height: 24px; display: none;" id="loader_1" src="<?php echo base_url('assets/images/loading-spinner-blue.gif') ?>" >
                                        </div>
                                    </td>
                                    <td>
                                        <a name="btnFilter" id="btnFilter" class="btn btn-success" style="color: #fff" onclick="get_search()"><i class="ti-search"></i> Search </a>
                                    </td>
                                    <td id="process_td" style="display:none;">
                                        <a name="btnProcess" id="btnProcess" class="btn btn-success" style="color: #fff" onclick="process()" href="javascript:;"><i class="fa fa-"></i> Process </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div id="view_students" class="box-body box-bordered" style="margin-top: 20px;">
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane p-20 active" role="tabpanel" id="allocation">
                        <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="QualifiedInfo" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="all" style="width: 30px">#</th>
                                <th class="all">University ID</th>
                                <th class="all">Course ID</th>
                                <th class="all">BATCH & Intake</th>
                                <th class="all">Program</th>
                                <th class="all">Name</th>
                                <th class="all">NIC Number/Passport</th>
                                <th class="all">Join Date</th>
                                <th class="all">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
<!--                    <div class="tab-pane p-20" role="tabpanel" id="none">-->
<!--                        <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="NonQualifiedInfo" cellspacing="0" width="100%">-->
<!--                            <thead>-->
<!--                            <tr>-->
<!--                                <th class="all" style="width: 30px">#</th>-->
<!--                                <th class="all">Course ID</th>-->
<!--                                <th class="all">Name</th>-->
<!--                                <th class="all">NIC Number/Passport</th>-->
<!--                                <th class="all">Gender</th>-->
<!--                                <th class="all">Created Date</th>-->
<!--                                <th class="all">Updated Date</th>-->
<!--                                <th class="all">Action</th>-->
<!--                            </tr>-->
<!--                            </thead>-->
<!--                            <tbody>-->
<!--                            </tbody>-->
<!--                        </table>-->
<!--                    </div>-->
                    <!-- Bootstrap modal -->
                    <div class="modal fade" id="class_modal" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                    <h6 id="class_modal_title"></h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body form">
                                    <form action="#" id="class_form" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="">
                                                <input type="hidden" name="arrangement_id" id="arrangement_id">
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="class_type" style='text-align: right;color:black;'><b>Batch :</b></label>
                                                    <div class="col-md-6">
                                                        <select name="batch" id="batch" class="form-control select2">
                                                            <option></option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="class_type" style='text-align: right;color:black;'><b>Semester :</b></label>
                                                    <div class="col-md-6">
                                                        <select name="semester" id="semester" class="form-control select2">
                                                            <option></option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="subject" style='text-align: right;color:black;'><b>Subject :</b></label>
                                                    <div class="col-md-6">
                                                        <select name="subject" id="subject" class="form-control select2">
                                                            <option></option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="hall" style='text-align: right;color:black;'><b>Hall :</b></label>
                                                    <div class="col-md-6">
                                                        <select name="hall" id="hall" class="form-control select2">
                                                            <option></option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="class" style='text-align: right;color:black;'><b>Class :</b></label>
                                                    <div class="col-md-6">
                                                        <select name="class" id="class" class="form-control select2">
                                                            <option></option>
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="class" style='text-align: right;color:black;'><b>Change Seat Capacity :</b></label>
                                                    <div class="col-md-6">
                                                        <input type="text" id="seat_capacity" name="seat_capacity" class="form-control numeric">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="save()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade bs-example-modal-lg in" id="view_modal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg"  style="min-width: 100px; max-width: 800px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="udModalLabel"></h4>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive"  cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th class="all" style="width: 30px">#ID</th>
                                            <th class="all">Program</th>
                                            <th class="all">Batch No</th>
                                            <th class="all">Payment Plan</th>
                                            <th class="all">Created At</th>
                                            <th class="all">Updated At</th>
                                            <th class="all">Status</th>

                                        </tr>
                                        </thead>
                                        <tbody id="qualified_view_id">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer" style="margin-top: 20px;margin:5px">
                                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">

                        var save_method;
                        var QualifiedInfo;
                        // var NonQualifiedInfo;

                        $(document).ready(function(){

                            $('#process_td').css('display','none');
                            $('#view_students').html('');

                            $(".modal :input").change(function(){
                                $(this).siblings("span.error-block").html("").hide();
                                $("span.help-inline").hide();
                            });

                            $('.modal').on('hidden.bs.modal', function(){

                                $("form :input").siblings("span.error-block").html("").hide();
                                $("span.help-inline").hide();

                            });

                            <?php if($this->session->flashdata('message')){?>

                            bootbox.alert({
                                message: "<b style='text-align:center'><?php echo $this->session->flashdata('message')?></b>",
                                size: 'small'
                            });

                            <?php } ?>

                            QualifiedInfo = $('#QualifiedInfo').DataTable({

                                "processing": true, //Feature control the processing indicator.
                                "serverSide": true, //Feature control DataTables' server-side processing mode.
                                // Load data for the table's content from an Ajax source
                                "ajax": {
                                    "data": {
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    "url": "<?php echo base_url()?>students/Qualified_students_con/qualified_list/",
                                    "type": "POST"
                                },
                                "columnDefs": [
                                    {
                                        "targets": [ -2 ], //last column
                                        "orderable": false //set not orderable
                                    }
                                ],"aoColumns": [
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    null,
                                    { "bSortable": false,"bSearchable": false }
                                ],
                                rowCallback: function(row, data, index){

                                    // if(data[5] == "Not Allocated"){
                                    //     $(row).find('td:eq(5)').html('<span style="background-color: red;color: white;border-radius: 5px">&nbsp;&nbsp;Not Allocated&nbsp;&nbsp;</span>');
                                    // }else {
                                    //     $(row).find('td:eq(5)').html('<span style="background-color: green;color: white;border-radius: 5px">&nbsp;&nbsp;Allocated&nbsp;&nbsp;</span>');
                                    // }

                                },
                                "language": {
                                    "aria": {
                                        "sortAscending": ": activate to sort column ascending",
                                        "sortDescending": ": activate to sort column descending"
                                    },
                                    "emptyTable": "No data available in table",
                                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                                    "infoEmpty": "No entries found",
                                    "infoFiltered": "(filtered1 from _MAX_ total entries)",
                                    "lengthMenu": "_MENU_ entries",
                                    "search": "Search:",
                                    "zeroRecords": "No matching records found"
                                },
                                "buttons": [
                                        { extend: 'print', 
                                        text: '<i class="fa fa-print"></i>',
                                        titleAttr: 'Print', 
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5 ], orthogonal: 'export'
                                        }
                                        },

                                        {
                                        extend:    'copyHtml5',
                                        text:      '<i class="fa fa-files-o"></i>',
                                        titleAttr: 'Copy',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5]
                                        }
                                        },
                                        {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"></i>',
                                        titleAttr: 'Excel',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5 ]
                                        }
                                        },
                                        {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"></i>',
                                        titleAttr: 'CSV',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5]
                                        }
                                        },
                                        {
                                        extend:    'pdfHtml5',
                                        text:      '<i class="fa fa-file-pdf-o"></i>',
                                        titleAttr: 'PDF',
                                        exportOptions: {
                                        columns: [ 0,1,2,3,4,5 ]
                                        }
                                        }
                                        ],
                                responsive: true,
                                "order": [
                                    [0, 'asc']
                                ],
                                "lengthMenu": [
                                    [5, 10, 15, 20, -1],
                                    [5, 10, 15, 20, "All"] // change per page values here
                                ],
                                "pageLength": 20,
                                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
                            });

                            QualifiedInfo.on('order.dt search.dt', function () {
                                QualifiedInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            }).draw();

                            yadcf.init(QualifiedInfo, [{
                                    filter_type: "text",
                                    filter_delay: 500,
                                    column_number: 1
                                },{
                                    filter_type: "text",
                                    filter_delay: 500,
                                    column_number: 2
                                },{
                                    filter_type: "text",
                                    filter_delay: 500,
                                    column_number: 3
                                },{
                                    filter_type: "text",
                                    filter_delay: 500,
                                    column_number: 4
                                },{
                                    filter_type: "text",
                                    filter_delay: 500,
                                    column_number: 5
                                },{
                                    filter_type: "text",
                                    filter_delay: 500,
                                    column_number: 6
                                }],
                                {
                                    cumulative_filtering: false
                                });


                            //NonQualifiedInfo = $('#NonQualifiedInfo').DataTable({
                            //
                            //    "processing": true, //Feature control the processing indicator.
                            //    "serverSide": true, //Feature control DataTables' server-side processing mode.
                            //    // Load data for the table's content from an Ajax source
                            //    "ajax": {
                            //        "data": {
                            //            "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
                            //        },
                            //        "url": "<?php //echo base_url()?>//students/Qualified_students_con/non_qualified_list/",
                            //        "type": "POST"
                            //    },
                            //    "columnDefs": [
                            //        {
                            //            "targets": [ -2 ], //last column
                            //            "orderable": false //set not orderable
                            //        }
                            //    ],"aoColumns": [
                            //        null,
                            //        null,
                            //        null,
                            //        null,
                            //        null,
                            //        null,
                            //        null,
                            //        { "bSortable": false,"bSearchable": false }
                            //    ],
                            //
                            //    "language": {
                            //        "aria": {
                            //            "sortAscending": ": activate to sort column ascending",
                            //            "sortDescending": ": activate to sort column descending"
                            //        },
                            //        "emptyTable": "No data available in table",
                            //        "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                            //        "infoEmpty": "No entries found",
                            //        "infoFiltered": "(filtered1 from _MAX_ total entries)",
                            //        "lengthMenu": "_MENU_ entries",
                            //        "search": "Search:",
                            //        "zeroRecords": "No matching records found"
                            //    },
                            //    "buttons": [
                            //        { extend: 'print', text:      '<i class="fa fa-print"></i>',
                            //            titleAttr: 'Print' },
                            //        {
                            //            extend:    'copyHtml5',
                            //            text:      '<i class="fa fa-files-o"></i>',
                            //            titleAttr: 'Copy'
                            //        },
                            //        {
                            //            extend:    'excelHtml5',
                            //            text:      '<i class="fa fa-file-excel-o"></i>',
                            //            titleAttr: 'Excel'
                            //        },
                            //        {
                            //            extend:    'csvHtml5',
                            //            text:      '<i class="fa fa-file-text-o"></i>',
                            //            titleAttr: 'CSV'
                            //        },
                            //        {
                            //            extend:    'pdfHtml5',
                            //            text:      '<i class="fa fa-file-pdf-o"></i>',
                            //            titleAttr: 'PDF'
                            //        }
                            //    ],
                            //    responsive: true,
                            //    "order": [
                            //        [0, 'asc']
                            //    ],
                            //    "lengthMenu": [
                            //        [5, 10, 15, 20, -1],
                            //        [5, 10, 15, 20, "All"] // change per page values here
                            //    ],
                            //    "pageLength": 20,
                            //    "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
                            //});
                            //
                            //NonQualifiedInfo.on('order.dt search.dt', function () {
                            //    NonQualifiedInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                            //        cell.innerHTML = i + 1;
                            //    });
                            //}).draw();
                            //
                            //yadcf.init(NonQualifiedInfo, [{
                            //        filter_type: "text",
                            //        filter_delay: 500,
                            //        column_number: 1
                            //    },{
                            //        filter_type: "text",
                            //        filter_delay: 500,
                            //        column_number: 2
                            //    },{
                            //        filter_type: "text",
                            //        filter_delay: 500,
                            //        column_number: 3
                            //    },{
                            //        filter_type: "text",
                            //        filter_delay: 500,
                            //        column_number: 4
                            //    },{
                            //        filter_type: "text",
                            //        filter_delay: 500,
                            //        column_number: 5
                            //    }],
                            //    {
                            //        cumulative_filtering: false
                            //    });

                        });

                        function reload_table(table)
                        {

                            if(typeof table !== "undefined")
                            {
                                table.ajax.reload(null,false);
                            }

                        }

                    </script>


                    <!-- program enrollment modal -->
                    <div class="modal fade" id="program_enrollment_modal" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 900px">
                            <div class="modal-content">
                                <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                    <h6 style="color: white;" id="program_enrollment_title">ENROLL PROGRAM</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body form">
                                    <form action="#" id="program_enrollment_form" class="form-horizontal">
                                        <div class="form-body">
                                            <div class='row'>
                                                <div class='col-md-12'>
                                                    <input type="hidden" name="program_enrollment_student" id="program_enrollment_student">
                                                    <input type="hidden" name="enrolling_program" id="enrolling_program">
                                                    <input type="hidden" name="program_enrollment_batch" id="program_enrollment_batch">
                                                    <input type="hidden" name="program_enrollment_intake" id="program_enrollment_intake">
<!--                                                    <div class='row'>-->
<!--                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Student : </b></label>-->
<!--                                                        <div class='col-md-8'>-->
<!---->
<!--                                                            <select name="program_enrollment_student" id="program_enrollment_student" class="form-control selectpicker" data-live-search="true">-->
<!--                                                            </select>-->
<!--                                                            <span class="error-block"></span>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <br>-->

<!--                                                    <div class='row'>-->
<!--                                                    <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Batch : </b></label>-->
<!--                                                    <div class='col-md-8'>-->
<!---->
<!--                                                    <select name="program_enrollment_batch" id="program_enrollment_batch" class="form-control selectpicker" data-live-search="true">-->
<!--                                                    </select>-->
<!--                                                    <span class="error-block"></span>-->
<!--                                                    </div>-->
<!--                                                    </div>-->
<!--                                                    <br>-->
<!--                                                    <div class='row'>-->
<!--                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Program : </b></label>-->
<!--                                                        <div class='col-md-8'>-->
<!--                                                            <select name="enrolling_program" id="enrolling_program" class="form-control selectpicker" data-live-search="true">-->
<!--                                                            </select>-->
<!--                                                            <span class="error-block"></span>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                    <br>-->


                                                    <div class='row'>
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Plan : </b></label>
                                                        <div class='col-md-8'>
                                                            <select name="program_enrollment_plan" id="program_enrollment_plan" class="form-control selectpicker" data-live-search="true">
                                                            </select>
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class='row'>
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Date : </b></label>
                                                        <div class='col-md-8'>
                                                            <input type="text" name="program_enrollment_date" value="<?php echo $date;?>" id="program_enrollment_date" class="form-control form-control-inline input-medium date-pick" size="16" data-date-format="yyyy-mm-dd">
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div id="program_enrollment_full_payment">
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Program Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_enrollment_total_amount" id="program_enrollment_total_amount" class="form-control readonlycolor">
                                                                <input type="hidden" name="program_enrollment_total_amount_a" id="program_enrollment_total_amount_a">
                                                                <input type="hidden" name="program_enrollment_program_fee_id" id="program_enrollment_program_fee_id">
                                                                <input type="hidden" name="program_enrollment_installment_id" id="program_enrollment_installment_id">
                                                                <input type="hidden" name="program_enrollment_currency_id" id="program_enrollment_currency_id">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="number" pattern="^[0-9]*$" placeholder="Enter Discount Percentage" name="program_enrollment_discount" id="program_enrollment_discount" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_enrollment_discount_amount" id="program_enrollment_discount_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Program Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_enrollment_final_price" id="program_enrollment_final_price" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div id="program_enrollment_monthly_payment">
                                                        <input type="hidden" name="program_monthly_fee_id" id="program_monthly_fee_id">
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Plan Lists : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_monthly_plan[]" id="program_enrollment_monthly_plan" class="form-control selectpicker" data-live-search="true" multiple>
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Monthly Installments Total : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_monthly_enrollment_total_amount" id="program_monthly_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="number" pattern="^[0-9]*$" placeholder="Enter Discount Percentage" name="program_monthly_enrollment_discount" id="program_monthly_enrollment_discount" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_monthly_enrollment_discount_amount" id="program_monthly_enrollment_discount_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Discount Installment Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_monthly_enrollment_installment_price" id="program_monthly_enrollment_installment_price" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_monthly_enrollment_final_price" id="program_monthly_enrollment_final_price" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div id="program_enrollment_semester">
                                                        <input type="hidden" name="program_semester_fee_id" id="program_semester_fee_id">

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Semester Installment Lists : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_semester_plan[]" id="program_enrollment_semester_plan" class="form-control selectpicker" data-live-search="true" multiple>
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Semester Installments Total : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_semester_enrollment_total_amount" id="program_semester_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="number" pattern="^[0-9]*$" placeholder="Enter Discount Percentage" name="program_semester_enrollment_discount" id="program_semester_enrollment_discount" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_semester_enrollment_discount_amount" id="program_semester_enrollment_discount_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Discount Installment Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_semester_enrollment_installment_price" id="program_semester_enrollment_installment_price" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_semester_enrollment_final_price" id="program_semester_enrollment_final_price" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                                                    </div>
                                                    <div id="program_enrollment_custom">
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Program Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="number" name="program_custom_enrollment_total_amount" id="program_custom_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Currency : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="custom_enrollment_currency" id="custom_enrollment_currency" class="form-control selectpicker" data-live-search="true">
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Registration Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" name="custom_enrollment_register_amount" id="custom_enrollment_register_amount" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Due Date : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" name="custom_enrollment_register_date" id="custom_enrollment_register_date" class="form-control form-control-inline input-medium date-pick" size="16" data-date-format="yyyy-mm-dd">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="col-lg-12" style="text-align: center;">
                                                            <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive"  cellspacing="0" width="100%">
                                                                <thead>
                                                                <tr>
                                                                    <th class="all"></th>
                                                                    <th class="all" style="width: 30px">#ID</th>
                                                                    <th class="all">Custom Installment</th>
                                                                    <th class="all">Due Date</th>
                                                                    <th class="all">Amount</th>
                                                                    <th class="all">Late Levy</th>
                                                                    <th style="width: 20px;"><a  id="program_enrollment_custom_addButton" name="add_row"><i class="icon-plus" style="color:#ff9c20; background-color:#fff"></i></a></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody id="program_enrollment_custom_load_list">
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                    </div>
                                                    <br>
                                                    <div class='row'>
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Method : </b></label>
                                                        <div class='col-md-8'>
                                                            <select name="program_enrollment_method" id="program_enrollment_method" class="form-control selectpicker" data-live-search="true">
                                                            </select>
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div id="bnk_id">
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Account Number : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_account" id="program_enrollment_account" class="form-control selectpicker" data-live-search="true">
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class='row'>
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> #Note : </b></label>
                                                        <div class='col-md-8'>
                                                            <textarea name="note" class="form-control" placeholder="Referance"></textarea>
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="add_enrollment()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.modal -->






                    <script>

                        function save(){

                            var url;
                            if(save_method == 'add'){
                                url="<?php echo base_url('classes/class_con/save'); ?>";
                            }

                            $.ajax({

                                url:url,
                                dataType:"JSON",
                                type:"POST",
                                data:$('#class_form').serialize()+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                                success:function(data){

                                    if(data.input_error)
                                    {
                                        for (var i = 0; i < data.input_error.length; i++)
                                        {
                                            $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                                        }
                                    }
                                    else if(data.status == true){

                                        reload_table(QualifiedInfo);
                                        $('#class_modal').modal('hide');
                                        bootbox.alert({
                                            message: "<b style='text-align:center'>"+data.message+"</b>"
                                        });

                                    }
                                    else{

                                        reload_table(QualifiedInfo);
                                        $('#class_modal').modal('hide');
                                        bootbox.alert({
                                            message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                        });
                                    }
                                },
                                error:function(){
                                    reload_table(QualifiedInfo);
                                }

                            });

                        }

                        function add_arrangement(){

                            $('#batch').select2('destroy');
                            $('#semester').select2('destroy');
                            $('#hall').select2('destroy');
                            $('#class').select2('destroy');
                            $('#subject').select2('destroy');

                            $('.error-block').empty();
                            save_method='add';
                            $('#class_form')[0].reset();

                            //call batch type function
                            get_master();

                            $('#batch').select2();
                            $('#semester').select2();
                            $('#hall').select2();
                            $('#class').select2();
                            $('#subject').select2();

                            $('#class_modal_title').html('Add New Class Arrangement');
                            $('#class_modal').modal({backdrop: 'static', keyboard: false});

                        }

                        $('#batch').change(function(){
                            get_semester($(this).val());
                        });

                        $('#semester').change(function(){
                            get_subject($(this).val());
                        });

                        $('#hall').change(function(){
                            get_class($(this).val());
                        });

                        $('#class').change(function(){
                            $('#seat_capacity').val($(this).val());
                        });

                        function get_master(){

                            $.ajax({

                                url: "<?php echo base_url('classes/class_con/get_master'); ?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){

                                    $('#batch').html('<option value=" ">--Select Batch--</option>');
                                    for(var i=0;i<data.batch.length;i++){
                                        $('#batch').append('<option value="'+data.batch[i].id+'">'+data.batch[i].name+' - '+data.batch[i].description+'</option>');
                                    }

                                    $('#hall').html('<option value=" ">--Select Hall--</option>');
                                    for(var i=0;i<data.hall.length;i++){
                                        $('#hall').append('<option value="'+data.hall[i].id+'">'+data.hall[i].code+' - '+data.hall[i].name+'</option>');
                                    }

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });
                        }

                        function get_semester(id){

                            $.ajax({

                                url: "<?php echo base_url('classes/class_con/get_semester'); ?>/"+id,
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){

                                    $('#semester').html('<option value=" ">--Select Semester--</option>');
                                    for(var i=0;i<data.semester.length;i++){
                                        $('#semester').append('<option value="'+data.semester[i].id+'">'+data.semester[i].name+'</option>');
                                    }

                                },
                                error: function (jqXHR, textStatus, errorThrown) {

                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);

                                }

                            });
                        }

                        function get_subject(id){

                            $.ajax({

                                url: "<?php echo base_url('classes/class_con/get_subject'); ?>/"+id,
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){

                                    $('#subject').html('<option value=" ">--Select Subject--</option>');
                                    for(var i=0;i<data.subject.length;i++){
                                        $('#subject').append('<option value="'+data.subject[i].id+'">'+data.subject[i].code+' - '+data.subject[i].name+'</option>');
                                    }

                                },
                                error: function (jqXHR, textStatus, errorThrown) {

                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });
                        }


                        function get_class(id){

                            $.ajax({

                                url: "<?php echo base_url('classes/class_con/get_classes'); ?>/"+id,
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){

                                    $('#class').html('<option value=" ">--Select Class--</option>');
                                    for(var i=0;i<data.class.length;i++){
                                        $('#class').append('<option value="'+data.class[i].id+'">'+data.class[i].name+' ( Seat capacity : '+data.class[i].seat_capacity+' )</option>');
                                    }

                                },
                                error:function (jqXHR, textStatus, errorThrown){

                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });
                        }


                    </script>
                    <script>

                        function view_program(id){
                            $('#qualified_view_id').html("");
                            $.ajax({
                                url: "<?php echo base_url('students/Qualified_students_con/view_program'); ?>/"+id,
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
                                },
                                success:function(data){
                                    for(var i=0;i<data.program.length;i++) {
                                        $('#qualified_view_id').append('<tr>' +
                                            '<td style=>' + data.program[i].id + '</td>' +
                                            '<td>' + data.program[i].program_name + '</td>' +
                                            '<td>' + data.program[i].batch_name + '</td>' +
                                            '<td>' + data.program[i].payment_plan + '</td>' +
                                            '<td>' + data.program[i].created_at + '</td>' +
                                            '<td>' + data.program[i].updated_at + '</td>' +
                                            '<td>' + data.program[i].stats + '</td>' +
                                            '</tr>');
                                    }

                                    $('#view_modal .modal-title').text("View student Enrolled Program's Info ");
                                    //$('#view_modal .modal-title').text("View student Enrolled Program's Info "+data.class[0].class_name);
                                    $('#view_modal').modal({backdrop:'static',keyboard:false});

                                },
                                error: function(jqXHR, textStatus, errorThrown){
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });
                        }


                        function get_search(){

                            $('#view_students').html('');
                            $('#loader_1').show();

                            $.ajax({

                                url: "<?php echo base_url('students/qualified_student_con/get_search'); ?>",
                                type: "POST",
                                dataType: "JSON",
                                data: $('#filter_form').serialize()+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                                success:function(data){

                                    $('#loader_1').css('display','none');

                                    if(data.input_error)
                                    {
                                        for (var i = 0; i < data.input_error.length; i++)
                                        {
                                            $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                                        }
                                    }
                                    else if(data.status == true){

                                        var html1='';

                                        html1 +='<table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive">' +
                                            '<thead>' +
                                            '<tr>' +
                                            '<th>#</th>'+
                                            '<th>BATCH</th>'+
                                            '<th valign="top">Course ID</th>' +
                                            '<th valign="top">STUDENT NAME</th>' +
                                            '<th valign="top">NIC NUMBER</th>' +
                                            '<th>TOTAL AMOUNT</th>'+
                                            '</tr>' +
                                            '</thead>' +
                                            '<tbody>';

                                        for(var i=0;i<data.students.length;i++) {

                                            html1 += '<tr>' +
                                                '<td>' + (i+1) + '</td>' +
                                                '<td>' +
                                                '' + (data.students[i].batch_name ? data.students[i].batch_name : "No Batch") + '' +
                                                '<input type="hidden" name="std_id[]" value="'+data.students[i].std_id+'">' +
                                                '</td>' +
                                                '<td>' + (data.students[i].student_id ? data.students[i].student_id : "No Course ID") + '</td>' +
                                                '<td>' + (data.students[i].name ? data.students[i].name : "No Name") + '</td>' +
                                                '<td>' + (data.students[i].st_nic_num AS nic_number ? data.students[i].st_nic_num AS nic_number : "No NIC") + '</td>' +
                                                '<td>' + (data.students[i].total_amount ? data.students[i].total_amount : "No Amount") + '</td>' +
                                                '</tr>';
                                        }

                                        html1 +='</tbody></table>';

                                        $('#view_students').html(html1);

                                        $('#process_td').show();

                                    }
                                    else{

                                        bootbox.alert({
                                            message: "<b style='text-align:center'>"+data.message+"</b>"
                                        });
                                    }
                                },
                                error:function(jqXHR, textStatus, errorThrown){

                                    bootbox.alert({
                                        message: "<b style='text-align:center'>"+data.message+"</b>"
                                    });

                                    $('#loader_1').css('display','none');
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });

                        }

                        function process(){

                            $('#loader_1').show();

                            $.ajax({

                                url: "<?php echo base_url('students/qualified_student_con/process'); ?>",
                                type: "POST",
                                dataType: "JSON",
                                data: $('#filter_form').serialize()+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                                success:function(data){

                                    $('#loader_1').css('display','none');

                                    if(data.input_error)
                                    {
                                        for (var i = 0; i < data.input_error.length; i++)
                                        {
                                            $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                                        }
                                    }
                                    else if(data.status == true){

                                        reload_table(NonQualifiedInfo);
                                        reload_table(QualifiedInfo);
                                        $('#view_students').html('');

                                        bootbox.alert({
                                            message: "<b style='text-align:center'>"+data.message+"</b>"
                                        });

                                    }
                                    else{

                                        bootbox.alert({
                                            message: "<b style='text-align:center'>"+data.message+"</b>"
                                        });
                                    }
                                },
                                error:function (jqXHR, textStatus, errorThrown){

                                    bootbox.alert({
                                        message: "<b style='text-align:center'>"+data.message+"</b>"
                                    });

                                    $('#loader_1').css('display','none');
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });
                        }
                    </script>
                    <script>
                        //load students program_enrollment_course
                        $.ajax({
                            url: "<?php echo base_url('payments/Program_fee/get_students_info');?>",
                            type: "POST",
                            dataType: "JSON",
                            data:{
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },
                            success:function(data){

                                $('#program_enrollment_student').html('<option value="">--Select Student--</option>');
                                for(var i=0;i<data.students.length;i++){
                                    $('#program_enrollment_student').append('<option value="'+data.students[i].id+'">'+data.students[i].student_id+' - '+data.students[i].name+'</option>');
                                }
                                $('.selectpicker').selectpicker('refresh');
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                bootbox.alert(textStatus + " : " + errorThrown);
                                console.log(jqXHR);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });

                        //load batch
                        //$.ajax({
                        //    url: "<?php //echo base_url('payments/Program_fee/get_batch_info');?>//",
                        //    type: "POST",
                        //    dataType: "JSON",
                        //    data:{
                        //        "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
                        //    },
                        //    success:function(data){
                        //
                        //        $('#program_enrollment_batch').html('<option disabled value="">--Select Batch--</option>');
                        //        for(var i=0;i<data.batch.length;i++){
                        //            $('#program_enrollment_batch').append('<option value="'+data.batch[i].id+'">'+data.batch[i].batch_name+' - '+data.batch[i].batch_intake+'</option>');
                        //        }
                        //        $('.selectpicker').selectpicker('refresh');
                        //    },
                        //    error: function (jqXHR, textStatus, errorThrown) {
                        //        bootbox.alert(textStatus + " : " + errorThrown);
                        //        console.log(jqXHR);
                        //        console.log(textStatus);
                        //        console.log(errorThrown);
                        //    }
                        //});
                        //load program
                        //$.ajax({
                        //    url: "<?php //echo base_url('payments/Program_fee/get_programs');?>//",
                        //    type: "POST",
                        //    dataType: "JSON",
                        //    data:{
                        //        "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
                        //    },
                        //    success:function(data){
                        //
                        //        $('#add_program').html('<option value="">--Select Program--</option>');
                        //        for(var i=0;i<data.programs.length;i++){
                        //            $('#add_program').append('<option value="'+data.programs[i].id+'">'+data.programs[i].code+' - '+data.programs[i].name+'</option>');
                        //        }
                        //        $('#enrolling_program').html('<option value="">--Select Program--</option>');
                        //        for(var i=0;i<data.programs.length;i++){
                        //            $('#enrolling_program').append('<option value="'+data.programs[i].id+'">'+data.programs[i].code+' - '+data.programs[i].name+'</option>');
                        //        }
                        //        $('.selectpicker').selectpicker('refresh');
                        //    },
                        //    error: function (jqXHR, textStatus, errorThrown) {
                        //        bootbox.alert(textStatus + " : " + errorThrown);
                        //        console.log(jqXHR);
                        //        console.log(textStatus);
                        //        console.log(errorThrown);
                        //    }
                        //});

                        // load Payment Methods
                        $.ajax({
                            url: "<?php echo base_url('payments/payments_con/all_payment_method');?>",
                            type: "POST",
                            dataType: "JSON",
                            data:{
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },
                            success:function(data){
                                for(var i=0;i<data.methods.length;i++){
                                    $('#program_enrollment_method').append('<option value="'+data.methods[i].id+'">'+data.methods[i].name+'</option>');
                                }
                                $('.selectpicker').selectpicker('refresh');
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                bootbox.alert(textStatus + " : " + errorThrown);
                                console.log(jqXHR);
                                console.log(textStatus);
                                console.log(errorThrown);
                            }
                        });
                        var program_enrollment_full_payment = document.getElementById("program_enrollment_full_payment");
                        var program_enrollment_monthly_payment = document.getElementById("program_enrollment_monthly_payment");
                        var program_enrollment_semester = document.getElementById("program_enrollment_semester");
                        var program_enrollment_custom = document.getElementById("program_enrollment_custom");
                        var program_enrollment_discount = document.getElementById("program_enrollment_custom");

                        var bnk_id = document.getElementById("bnk_id");

                        program_enrollment_full_payment.style.display = "none";
                        program_enrollment_monthly_payment.style.display = "none";
                        program_enrollment_semester.style.display = "none";
                        program_enrollment_custom.style.display = "none";
                        bnk_id.style.display = "none";

                        function enroll_program(id){
                            $('#program_enrollment_form')[0].reset();
                            $('[name="program_enrollment_student"]').val(id);
                            $.ajax({
                                url: "<?php echo base_url('payments/Program_fee/get_student_info');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                    "student_id":id
                                },
                                success:function(data){

                                    $('[name="enrolling_program"]').val(data.student[0].programe);
                                    $('[name="program_enrollment_batch"]').val(data.student[0].batch);
                                    $('[name="program_enrollment_intake"]').val(data.student[0].intake);
                                    load_payment_plans(data.student[0].programe);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                            $('.error-block').empty();
                            save_method='add';
                           // $('#program_enrollment_form')[0].reset();
                            $('#program_enrollment_modal').modal({backdrop: 'static', keyboard: false});

                        }
                        $('#program_enrollment_plan').change(function(){
                            var program_enrollment_student = document.getElementById("program_enrollment_student").value;
                            var program_id = document.getElementById("program_enrollment_batch").value;
                            $.ajax({
                                url: "<?php echo base_url('payments/Program_fee/get_already_enrollment');?>/"+program_id,
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                    "student_id":program_enrollment_student
                                },
                                success:function(data_1){
                                    if (data_1==1){
                                        alert("This Student Already Enrolled,Please Select Another Student");
                                        // bootbox.alert({
                                        //     message: "<b style='text-align:center;color: red'>This Student Already Enrolled,Please Select Another Student</b>"
                                        // });
                                    }else{
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });

                            $('#program_enrollment_account').empty();
                            $('#program_monthly_enrollment_discount').empty();

                            var plan_id =$(this).val();
                            var enro= plan_id.split(",");
                            var payment_id = enro[0];
                            var programme = enro[1];
                            switch (payment_id) {
                                case "1":
                                    program_enrollment_full_payment.style.display = "block";
                                    program_enrollment_monthly_payment.style.display = "none";
                                    program_enrollment_semester.style.display = "none";
                                    program_enrollment_custom.style.display = "none";

                                    //load program full payment details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_full_payment_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":plan_id
                                        },
                                        success:function(data){
                                            $('[name="program_enrollment_total_amount"]').val(data[0].total_programme_fee);
                                            $('[name="program_enrollment_total_amount_a"]').val(data[0].total_program_fee);
                                            $('[name="program_enrollment_program_fee_id"]').val(data[0].program_fee_id);
                                            $('[name="program_enrollment_installment_id"]').val(data[0].installment_id);
                                            $('[name="program_enrollment_currency_id"]').val(data[0].currency_id);
                                            $('[name="program_enrollment_discount"]').val(data[0].discount_price);

                                            var program_enrollment_discount=data[0].discount_price;
                                            var program_enrollment_total_amount =data[0].total_program_fee;
                                            var program_enrollment_discount_amount=program_enrollment_total_amount*program_enrollment_discount/100;
                                            var program_enrollment_final_price=program_enrollment_total_amount-program_enrollment_discount_amount;

                                            $('[name="program_enrollment_discount_amount"]').val(program_enrollment_discount_amount);
                                            $('[name="program_enrollment_final_price"]').val(program_enrollment_final_price);
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });


                                    break;
                                case "2":
                                    program_enrollment_monthly_payment.style.display = "block";
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_semester.style.display = "none";
                                    program_enrollment_custom.style.display = "none";
                                    //load program monthly payment details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_monthly_payment_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":plan_id
                                        },
                                        success:function(data){
                                            $('#program_enrollment_monthly_plan').html('<option value="">--Select Monthly Plan--</option>');
                                            for(var i=0;i<data.monthly.length;i++){
                                                $('#program_enrollment_monthly_plan').append('<option value="'+data.monthly[i].installment_id+','+data.monthly[i].amount+','+data.monthly[i].installment_type+','+data.monthly[i].currency_id+','+data.monthly[i].program_fee_id+','+data.monthly[i].dis+'">'+data.monthly[i].installment+' - '+data.monthly[i].price+'</option>');
                                            }

                                            $('.selectpicker').selectpicker('refresh');

                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                                    $('#program_enrollment_monthly_plan').change(function(){
                                        var monthly_plan_details =$(this).val();
                                        var tot_val=0;
                                        var reg_val=0;
                                        var type_val="";
                                        var split_val;
                                        for(var j=0; j<monthly_plan_details.length; j++){
                                            //calculating total without registration fee
                                            split_val = monthly_plan_details[j].split(",");
                                            var program_fee_id=split_val[4];
                                            var def_discount=split_val[5];
                                            if (split_val[2]=="1"){
                                                reg_val=reg_val+parseFloat(split_val[1]);
                                            }else {
                                                tot_val = tot_val+parseFloat(split_val[1]);
                                            }
                                        }
                                        split_val = "";
                                        $('[name="program_monthly_enrollment_total_amount"]').val(tot_val);
                                        $('[name="program_monthly_fee_id"]').val(program_fee_id);
                                        $('[name="program_monthly_enrollment_discount"]').val(def_discount);

                                        var program_monthly_enrollment_discount=def_discount;
                                        var program_enrollment_total_amount = document.getElementById("program_monthly_enrollment_total_amount").value;
                                        var program_enrollment_discount_amount=program_enrollment_total_amount*program_monthly_enrollment_discount/100;
                                        var program_enrollment_final_price=program_enrollment_total_amount-program_enrollment_discount_amount;

                                        $('[name="program_monthly_enrollment_discount_amount"]').val(program_enrollment_discount_amount);
                                        $('[name="program_monthly_enrollment_installment_price"]').val(program_enrollment_final_price);
                                        $('[name="program_monthly_enrollment_final_price"]').val(program_enrollment_final_price+reg_val);


                                        //calculating discount
                                        $('#program_monthly_enrollment_discount').on('input',function(){

                                            var program_monthly_enrollment_discount=$(this).val();
                                            var program_enrollment_total_amount = document.getElementById("program_monthly_enrollment_total_amount").value;
                                            var program_enrollment_discount_amount=program_enrollment_total_amount*program_monthly_enrollment_discount/100;
                                            var program_enrollment_final_price=program_enrollment_total_amount-program_enrollment_discount_amount;

                                            $('[name="program_monthly_enrollment_discount_amount"]').val(program_enrollment_discount_amount);
                                            $('[name="program_monthly_enrollment_installment_price"]').val(program_enrollment_final_price);
                                            $('[name="program_monthly_enrollment_final_price"]').val(program_enrollment_final_price+reg_val);

                                        });

                                    });
                                    break;
                                case "3":
                                    program_enrollment_semester.style.display = "block";
                                    program_enrollment_custom.style.display = "none";
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "none";

                                    //load program semester payment details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_semester_payment_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":plan_id
                                        },
                                        success:function(data){
                                            $('#program_enrollment_semester_plan').html('<option disabled value="">--Select Semester Plan--</option>');
                                            for(var i=0;i<data.semesters.length;i++){
                                                $('#program_enrollment_semester_plan').append('<option value="'+data.semesters[i].installment_id+','+data.semesters[i].amount+','+data.semesters[i].installment_type+','+data.semesters[i].currency_id+','+data.semesters[i].program_fee_id+','+data.semesters[i].dis+'">'+data.semesters[i].installment+' - '+data.semesters[i].price+'</option>');
                                            }

                                            $('.selectpicker').selectpicker('refresh');

                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });

                                    $('#program_enrollment_semester_plan').change(function(){
                                        $('#program_semester_enrollment_discount').empty();

                                        var semester_plan_details =$(this).val();
                                        var tot_val=0;
                                        var reg_val=0;
                                        var type_val="";
                                        var split_val;
                                        for(var j=0; j<semester_plan_details.length; j++){
                                            //calculating total without registration fee
                                            split_val = semester_plan_details[j].split(",");
                                            var program_fee_id=split_val[4];
                                            var semester_dis=split_val[5];
                                            if (split_val[2]=="1"){
                                                reg_val=reg_val+parseFloat(split_val[1]);
                                            }else {
                                                tot_val = tot_val+parseFloat(split_val[1]);
                                            }
                                        }
                                        split_val = "";
                                        $('[name="program_semester_enrollment_total_amount"]').val(tot_val);
                                        $('[name="program_semester_enrollment_total_amount"]').val(tot_val);
                                        $('[name="program_semester_fee_id"]').val(program_fee_id);
                                        $('[name="program_semester_enrollment_discount"]').val(semester_dis);

                                        var program_monthly_enrollment_discount=semester_dis;

                                        var program_enrollment_total_amount = document.getElementById("program_semester_enrollment_total_amount").value;
                                        var program_enrollment_discount_amount=program_enrollment_total_amount*program_monthly_enrollment_discount/100;
                                        var program_enrollment_final_price=program_enrollment_total_amount-program_enrollment_discount_amount;

                                        $('[name="program_semester_enrollment_discount_amount"]').val(program_enrollment_discount_amount);
                                        $('[name="program_semester_enrollment_installment_price"]').val(program_enrollment_final_price);
                                        $('[name="program_semester_enrollment_final_price"]').val(program_enrollment_final_price+reg_val);

                                        //calculating discount
                                        $('#program_semester_enrollment_discount').on('input',function(){

                                            var program_monthly_enrollment_discount=$(this).val();

                                            var program_enrollment_total_amount = document.getElementById("program_semester_enrollment_total_amount").value;
                                            var program_enrollment_discount_amount=program_enrollment_total_amount*program_monthly_enrollment_discount/100;
                                            var program_enrollment_final_price=program_enrollment_total_amount-program_enrollment_discount_amount;

                                            $('[name="program_semester_enrollment_discount_amount"]').val(program_enrollment_discount_amount);
                                            $('[name="program_semester_enrollment_installment_price"]').val(program_enrollment_final_price);
                                            $('[name="program_semester_enrollment_final_price"]').val(program_enrollment_final_price+reg_val);

                                        });



                                    });


                                    break;
                                case "4":
                                    program_enrollment_custom.style.display = "block";
                                    program_enrollment_semester.style.display = "none";
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "none";

                                    var program_enrollment_custom_counter = 1;
                                    $("#program_enrollment_custom_addButton").click(function () {

                                        if(program_enrollment_custom_counter>20){
                                            alert("Only 20 Records allowed");
                                            return false;
                                        }
                                        var xdf=31*program_enrollment_custom_counter;
                                        var formattedDate = new Date();

                                        formattedDate.setDate( formattedDate.getDate() + xdf );
                                        var newDate = formattedDate.toDateString();
                                        var strDate = formattedDate.getFullYear() + "-" + (formattedDate.getMonth()+1) + "-" + formattedDate.getDate();

                                        var dyTable = $(document.createElement('tr')).attr("id", 'row_' + program_enrollment_custom_counter).attr("class", 'rowRW');
                                        dyTable.after().html('<td><input type="checkbox" name="pay_custom[]" class="form-control"></td>' +
                                            '<td style="width:40px;"><label id="code'+program_enrollment_custom_counter+'" name="" style="width: 100px;color:black;font-weight:200;" >'+program_enrollment_custom_counter+'</label></td>' +
                                            '<td><input type="text" required name="installment[]" value="Custom Installment '+program_enrollment_custom_counter+'" class="form-control" style="width: 300px;" required="required"></td>' +
                                            '<td style="width:160px;"><input type="text"  name="installment_date[]" value="'+strDate+'" class="form-control form-control-inline input-medium date-picker2" size="16" data-date-format="yyyy-mm-dd" required="required"></td>' +
                                            '<td><input type="text" placeholder="Amount"  class="form-control" name="amount[]" style="width: 100px;" required="required"></td>' +
                                            '<td><input type="text" placeholder="Late Levy" value="200" class="form-control" name="late[]" style="width: 100px;" required="required"></td>' +
                                            '<td><i class="icon-trash tip del" id="' + program_enrollment_custom_counter + '" title="Remove This Item" style="cursor:pointer;" data-placement="right"></i></td>');
                                        dyTable.appendTo("#program_enrollment_custom_load_list");
                                        program_enrollment_custom_counter++;

                                        $('.select2').select2();

                                        $('.date-picker2').datepicker({
                                            orientation: "bottom",
                                            autoclose: true,
                                            dateFormat: 'yy-mm-dd',
                                            todayHighlight: true,
                                            startDate: "today"
                                        });
                                        $("#program_enrollment_custom_load_list").on("click", '.del', function()
                                        {
                                            var delID = $(this).attr('id');
                                            var rw_no = delID;

                                            row_id = $("#row_" + delID);
                                            row_id.remove();
                                            an--;
                                        });
                                    });




                                    break;
                                default:
                                    $('#program_enrollment_account').empty();
                                    $('#program_monthly_enrollment_discount').empty();

                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "none";
                                    program_enrollment_semester.style.display = "none";
                                    program_enrollment_custom.style.display = "none";
                            }
                        });
                        $('#enrolling_program').change(function(){
                            load_payment_plans($(this).val());
                        });
                        $('#program_enrollment_method').change(function(){
                            load_banks($(this).val());
                            $('#program_enrollment_account').empty();

                        });
                        function load_banks(bank) {
                            if(bank==1){
                                bnk_id.style.display = "none";
                                $('[name="program_enrollment_account"]').val('1');
                            }else{
                                bnk_id.style.display = "block";
                                $.ajax({
                                    url: "<?php echo base_url('payments/Program_fee/get_banks');?>/"+bank,
                                    type: "POST",
                                    dataType: "JSON",
                                    data:{
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    success:function(data){
                                        for(var i=0;i<data.banks.length;i++){
                                            $('#program_enrollment_account').append('<option value="'+data.banks[i].id+'">'+data.banks[i].bank_name+' - '+data.banks[i].account_type+' - '+data.banks[i].account_no+'</option>');
                                        }
                                        $('.selectpicker').selectpicker('refresh');
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        bootbox.alert(textStatus + " : " + errorThrown);
                                        console.log(jqXHR);
                                        console.log(textStatus);
                                        console.log(errorThrown);
                                    }
                                });
                            }
                        }
                        function load_payment_plans(program_id) {
                            $.ajax({
                                url: "<?php echo base_url('payments/Program_fee/get_payment_plan_info');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){

                                    $('#program_enrollment_plan').html('<option value="">--Select Payment Plan--</option>');
                                    for(var i=0;i<data.plans.length;i++){
                                        $('#program_enrollment_plan').append('<option value="'+data.plans[i].id+','+program_id+'">'+data.plans[i].name+'</option>');
                                    }

                                    $('.selectpicker').selectpicker('refresh');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                        }
                        //calculating discount
                        $('#program_enrollment_discount').on('input',function(){
                            var program_enrollment_discount=$(this).val();
                            var program_enrollment_total_amount = document.getElementById("program_enrollment_total_amount_a").value;
                            var program_enrollment_discount_amount=program_enrollment_total_amount*program_enrollment_discount/100;
                            var program_enrollment_final_price=program_enrollment_total_amount-program_enrollment_discount_amount;

                            $('[name="program_enrollment_discount_amount"]').val(program_enrollment_discount_amount);
                            $('[name="program_enrollment_final_price"]').val(program_enrollment_final_price);

                        });
                        function add_enrollment(){
                            $('.error-block').empty();
                            var url;
                            if(save_method == 'add'){
                                url="<?php echo base_url('payments/Program_fee/add_enrollment'); ?>";
                            }
                            else{
                                url="<?php echo base_url('payments/Program_fee/update_enrollment'); ?>";
                            }

                            $.ajax({

                                url:url,
                                dataType:"JSON",
                                type:"POST",
                                data:$('#program_enrollment_form').serialize()+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
                                success:function(data){

                                    if(data.input_error)
                                    {
                                        for (var i = 0; i < data.input_error.length; i++)
                                        {
                                            // $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                                            $('[name="'+data.input_error[i]+'"]').parent().siblings("span.error-block").html(data.error_string[i]).show();
                                            $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                                        }
                                    }
                                    else if(data.status == true){

                                        reload_table(QualifiedInfo);
                                        reload_table(NonQualifiedInfo);
                                        $('#program_enrollment_form')[0].reset();
                                        $('#program_enrollment_modal').modal('hide');
                                        bootbox.alert({
                                            message: "<b style='text-align:center'>"+data.message+"</b>"
                                        });

                                    }
                                    else{

                                        reload_table(QualifiedInfo);
                                        reload_table(NonQualifiedInfo);
                                        $('#program_enrollment_modal').modal('hide');
                                        bootbox.alert({
                                            message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                        });
                                    }
                                },
                                error:function(){
                                    reload_table(QualifiedInfo);
                                    reload_table(NonQualifiedInfo);
                                    bootbox.alert({
                                        message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                    });
                                }

                            });

                        }









        $('#student_view_modal').on('hidden.bs.modal', function() {
        $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
        });


                        function view_student(id){

$('#photo-upload-form input[type=file]').val("");
$('#profile_picture').attr('src', '');

$("#stuEditWizard ul li").first().children("a").click();
$('.form-group').removeClass('has-error');
$('.help-block').empty();
$('#profile_picture').attr('src', '');
$('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
var counter_st_ol=0;
var counter_st_al=0; 
var counter_st_ceq=0;  
var counter_st_hepq=0;
$.ajax({
    url : "<?php echo site_url('students/students_con/view_student')?>/" + id,
    type: "POST",
    "data": {
        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
    },
    dataType: "JSON",
    success: function(data)
    {

        if(data.application!=null) {
            if (data.application == 3 || data.application == 6 || data.application == 4) {
                $('.gce_ol').hide();
                $('.gce_al').hide();
            } else if (data.application == 5 || data.application == 2) {
                $('.gce_ol').hide();
            }
        }

        $('a[href="#personal_info"]').tab('show');

        $.ajax({
            url:"<?php echo site_url('students/students_con/image_available')?>",
            dataType:"JSON",
            type:"POST",
            data:{
                id:id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(data){
                var d = new Date();
                var n = d.getTime();

                if(data.photo)
                {
                    $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);
                }
                else
                {
                    $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
                }
            },
            error:function(){
                $('#profile_picture').attr('src', '');
                console.log("error retrieve image");
            }
        });

        //get programe
        $.ajax({
            url:"<?php echo site_url('students/students_con/get_view_programe')?>",
            dataType:"JSON",
            type:"POST",
            data:{
                'programe_id':data.students_info.programe,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(datapr){

                    $('#view_programe').text(datapr);

            }
        });

        //get university
        $.ajax({
            url:"<?php echo site_url('students/students_con/get_view_university')?>",
            dataType:"JSON",
            type:"POST",
            data:{
                'university_id':data.students_info.university,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(datapr){

                    $('#view_university').text(datapr);

            }
        });

        //get batch

        $.ajax({
            url:"<?php echo site_url('students/students_con/get_view_batch')?>",
            dataType:"JSON",
            type:"POST",
            data:{
                'intake':data.students_info.intake,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(databt){

                    $('#view_batch').text(databt);

            }
        });


//                //get intake
//
//                $.ajax({
//                    url:"<?php //echo site_url('students/students_con/get_view_batch')?>//",
//                    dataType:"JSON",
//                    type:"POST",
//                    data:{
//                        'intake_id':data.students_info.intake,
//                        "<?php //echo $this->security->get_csrf_token_name(); ?>//": "<?php //echo $this->security->get_csrf_hash(); ?>//"
//                    },
//                    success:function(datait){
//
//                            $('#view_intake').text(datait);
//
//                    }
//                });



        $('#student_id').val(id);
        //$('.view_student_id').html(data.std_info.student_id);
        //$('.view_batch').html(data.std_info.batch_name);

        for(var key in data.students_info)
        {
            $('.view_' + key ).html(data.students_info[key] ? data.students_info[key]:"-");
        }


        //st_ol_data
        var i=0;
        
        if(data.st_ol_data !== null) {
            for (i = 0; i < data.st_ol_data.length; ++i) {
                var VIEW_ST_OL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ol).attr("class", 'row_dyn');
                var html_data_ol = "";
                html_data_ol +=
                    '<td>'+counter_st_ol+'</td>' +
                    '<td>' + data.st_ol_data[i].st_ol_year + '</td>' +
                    '<td>' + data.st_ol_data[i].st_ol_school + '</td>' +
                    '<td>' + data.st_ol_data[i].st_ol_type + '</td>' +
                    '<td>' + data.st_ol_data[i].st_ol_subject + '</td>' +
                    '<td>' + data.st_ol_data[i].st_ol_grade + '</td>' +
                    '<td></td>';
                VIEW_ST_OL_Table.after().html(html_data_ol);
                counter_st_ol++;
                VIEW_ST_OL_Table.appendTo("#VIEW_ST_OL_Table tbody");
            }
        }

        //st_al_data
        var i=0;
        if(data.st_al_data !== null) {
            for (i = 0; i < data.st_al_data.length; ++i) {
                var VIEW_ST_AL_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_al).attr("class", 'row_dyn');
                var html_data_al = "";
                html_data_al +=
                    '<td>'+counter_st_al+'</td>' +
                    '<td>' + data.st_al_data[i].st_al_year + '</td>' +
                    '<td>' + data.st_al_data[i].st_al_school + '</td>' +
                    '<td>' + data.st_al_data[i].st_al_type + '</td>' +
                    '<td>' + data.st_al_data[i].st_al_subject + '</td>' +
                    '<td>' + data.st_al_data[i].st_al_grade + '</td>' +
                    '<td></td>';
                VIEW_ST_AL_Table.after().html(html_data_al);
                counter_st_al++;
                VIEW_ST_AL_Table.appendTo("#VIEW_ST_AL_Table tbody");
            }
        }

        //st_hepq_data
        var i=0;
        if(data.st_hepq_data !== null) {
            for (i = 0; i < data.st_hepq_data.length; ++i) {
                var VIEW_ST_HEPQ_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_hepq).attr("class", 'row_dyn');
                var html_data_hepq = "";
                html_data_hepq +=
                    '<td>'+counter_st_hepq+'</td>' +
                    '<td>' + data.st_hepq_data[i].st_hepq_uni + '</td>' +
                    '<td>' + data.st_hepq_data[i].st_hepq_type + '</td>' +
                    '<td>' + data.st_hepq_data[i].st_hepq_from + '</td>' +
                    '<td>' + data.st_hepq_data[i].st_hepq_to + '</td>' +
                    '<td></td>';
                VIEW_ST_HEPQ_Table.after().html(html_data_hepq);
                counter_st_hepq++;
                VIEW_ST_HEPQ_Table.appendTo("#VIEW_ST_HEPQ_Table tbody");
            }
        }

        //st_ceq_data
        var i=0;
        if(data.st_ceq_data !== null) {
            for (i = 0; i < data.st_ceq_data.length; ++i) {
                var VIEW_ST_CEQ_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_ceq).attr("class", 'row_dyn');
                var html_data = "";
                html_data +=
                    '<td>'+counter_st_hepq+'</td>' +
                    '<td>' + data.st_ceq_data[i].st_ceq_uni + '</td>' +
                    '<td>' + data.st_ceq_data[i].st_ceq_type + '</td>' +
                    '<td>' + data.st_ceq_data[i].st_ceq_from + '</td>' +
                    '<td>' + data.st_ceq_data[i].st_ceq_to + '</td>' +
                    '<td></td>';
                VIEW_ST_CEQ_Table.after().html(html_data);
                counter_st_ceq++;
                VIEW_ST_CEQ_Table.appendTo("#VIEW_ST_CEQ_Table tbody");
            }
        }

        if (data.student_documents_data) {
            var doc_url = "<?php echo base_url("uploads/student_documents"); ?>"+ "/" + data.students_info.id + "/";
            var j;
            for (j = 0; j < data.student_documents_data.length; ++j) {
                if(data.student_documents_data[j].document_type == 'st_file_nic_pp'){
                    $('#view_st_file_nic_pp_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                }
                if(data.student_documents_data[j].document_type == 'st_file_visa'){
                    $('#view_st_file_visa_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                }
                if(data.student_documents_data[j].document_type == 'st_file_bc'){
                    $('#view_st_file_bc_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                }
                // if(data.student_documents_data[j].document_type == 'st_file_al'){
                //     $('#view_st_file_al_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                // }
                // if(data.student_documents_data[j].document_type == 'st_file_ol'){
                //     $('#view_st_file_ol_update').html("<a href='"+ doc_url + data.student_documents_data[j].document_name+"' target='_blank' style='font-size: 24px'><i class='fa fa-file-text-o'></i></a>");
                // }

                // if(data.student_documents_data[j].document_type == 'st_rpq_file'){
                //             var VIEW_ST_RPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                //             var html_data = "";
                //             html_data +=
                //                 '<td>'+counter_st_rpq+'</td>' +
                //                 '<td>' +
                //                 '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                //                 '</td>' +
                //                 '<td></td>';
                //             VIEW_ST_RPQ_Files_Table.after().html(html_data);
                //             counter_st_rpq++;
                //             VIEW_ST_RPQ_Files_Table.appendTo("#VIEW_ST_RPQ_Files_Table tbody");
                // }
                        if(data.student_documents_data[j].document_type == 'st_file_ol'){
                            var VIEW_ST_OL_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_OL_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_OL_Files_Table.appendTo("#VIEW_ST_OL_Files_Table tbody");
                        }

                        if(data.student_documents_data[j].document_type == 'st_file_al'){
                            var VIEW_ST_AL_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_AL_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_AL_Files_Table.appendTo("#VIEW_ST_AL_Files_Table tbody");
                        }


                        if(data.student_documents_data[j].document_type == 'st_hepq_file'){
                            var VIEW_ST_HEPQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_HEPQ_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_HEPQ_Files_Table.appendTo("#VIEW_ST_HEPQ_Files_Table tbody");
                        }
                        if(data.student_documents_data[j].document_type == 'st_ceq_file'){
                            var VIEW_ST_CEQ_Files_Table = $(document.createElement('tr')).attr("id", 'row_' + counter_st_rpq).attr("class", 'row_dyn');
                            var html_data = "";
                            html_data +=
                                // '<td>'+counter_st_rpq+'</td>' +
                                '<td></td>' +
                                '<td>' +
                                '<a href="'+ doc_url + data.student_documents_data[j].document_name+'" target="_blank" style="font-size: 24px"><i class="fa fa-file-text-o"></i></a>' +
                                '</td>' +
                                '<td></td>';
                                VIEW_ST_CEQ_Files_Table.after().html(html_data);
                            counter_st_rpq++;
                            VIEW_ST_CEQ_Files_Table.appendTo("#VIEW_ST_CEQ_Files_Table tbody");
                        }
            }
        }

        $('#view_title').html('Student Info');
        $('#student_view_modal').modal({backdrop: 'static', keyboard: false});
    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        console.log('Error retrieve view data');
    }
});

}


function open_photo_upload_modal(showSuccessMsg,std_id)
    {

        var id= $('#student_id').val();
        $.ajax({
            url: "<?php echo site_url('students/students_con/image_available')?>",
            type: "POST",
            data: {
                id:id,
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function (data) {
                var d = new Date();
                var n = d.getTime();
                if(data.length == 0)
                {
                    $('#previewing').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>");
                }
                else
                {
                    $('#previewing').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);
                }
            },
            error: function () {
                console.log('Error getting photo');
            }
        });


        $('#photo-upload-form')[0].reset();
        $("#photo_upload_div").show();
        $("#photo_message").empty().hide();

        $("#btnUploadPhoto").show().attr('disabled',false).text('Upload');
        $("#btnExitModal").show().attr('disabled',false).text("Skip");

        if(showSuccessMsg)
        {
            //$('.success_message').text("Student registration have been saved successfully.It is recommended to upload Student's photo.");
            $('.success_message').parent().show();
        }
        else
        {
            $('.success_message').parent().hide();
        }

        $('#photo_upload_modal').modal({backdrop: 'static', keyboard: false});
        $('#btnUploadPhoto').off('click.btnUploadPhoto');

        $('#btnUploadPhoto').on('click', function(){

            var formData = new FormData();
            var photo = $('#photo-upload-form input[type=file]')[0].files[0];

            if(photo == undefined)
            {
                $("#photo_message").show().html("No photo is selected!");
                $("#photo_message").removeClass('alert-success').addClass('alert alert-danger fade in');
            }
            else
            {
                formData.append("photo", photo);
                formData.append("<?php echo $this->security->get_csrf_token_name(); ?>", "<?php echo $this->security->get_csrf_hash(); ?>");
                var d = new Date();
                var n = d.getTime();

                var idd;
                if(std_id){
                    idd=std_id;
                }
                else{
                    idd=$('#student_id').val();
                }
                var url = "<?php echo site_url('students/students_con/add_photo')?>/"+idd;

                $.ajax({
                    url: url,
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function()
                    {
                        $("#btnUploadPhoto").attr('disabled',true).text('Uploading...');
                        $("#btnExitModal").attr('disabled',true);
                    },
                    success: function(data)
                    {
                        $("#photo_message").show().html(data.message);

                        if(data.status)
                        {
                            $("#photo_upload_div").hide();
                            $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                            $("#btnExitModal").attr('disabled',false).text("Close");
                            $("#btnUploadPhoto").hide();
                            $("#photo_message").removeClass('alert-danger').addClass('alert alert-success fade in');
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos/noprofile-pic.jpg'); ?>");
                            $('#profile_picture').attr("src","<?php echo base_url('uploads/student_photos'); ?>" + "/" + data.photo + "?" + n);
                        }
                        else
                        {
                            $("#btnExitModal").show().attr('disabled',false).text("Skip");
                            $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                            $("#photo_message").removeClass('alert-success').addClass('alert alert-danger fade in');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        console.log('Error uploading data: ' + textStatus + " - " + errorThrown);
                        $("#btnExitModal").text("Skip");
                        $("#btnUploadPhoto").attr('disabled',false).text('Upload');
                    }
                });
            }

        });
    }
    function imageIsLoaded(e) {
        $("#empPhoto").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    }
    

 
                    </script>

<!-- #################################################### Student Mangement ################################## -->
<!-- Photo Upload modal -->
<div class="modal fade" id="photo_upload_modal" role="dialog" style="z-index: 9999999">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="photo-upload-title" style="color:#fff">Upload Student Photo</h4>
            </div>
            <div class="modal-body form">
                <div id="photo_upload_div" style="display: none">
                    <div class="alert alert-success fade in col-md-12">
                        <p class="success_message"></p>
                    </div>
                    <form action="" id="photo-upload-form" class="form-horizontal" enctype="multipart/form-data">
                        <div class="row">
                            <div id="image_preview" class="col-md-offset-2 col-md-6">
                                <img style="text-align: center" id="previewing" src="<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>" class="img-responsive img-thumbnail" width="140px" />
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-body">
                                <div class="form-group" id="selectImage">
                                    <label class="col-md-12 col-md-offset-1">Select Student's photo</label>
                                    <div class="col-md-6" id="photoInput">
                                        <input name="photo" id="stuPhoto" class="form-control input-optional" type="file">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="photo_message"></div>
            </div>
            <div class="modal-footer custom-modal-footer">
                <button type="button" id="btnUploadPhoto" class="btn btn-success">Upload</button>
                <button type="button" id="btnExitModal" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<div class="modal fade " id="student_view_modal" role="dialog">
    <div class="modal-dialog modal-lg" style="max-width: 1350px!important;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h3 class="modal-title bold uppercase">Student Info</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2" style="">

                        <!--                        <form action="" enctype="multipart/form-data" method="post">-->
                        <div id="profile_picture_preview" class="thumbnail" style="width: 200px;">
                            <div id="profile_picture_div"></div>
                            <img id="profile_picture" class="img-responsive img-thumbnail" src="" style="width: 155px;"/>
                            <input type="hidden" id="stu_profile_picture_id" value="">
                        </div>
                        <!--                            <input type="file" name="file"><br/>-->
                        <input type="button" value="Change Profile Picture" style="color: white;background-color: #8686b6;border: none;padding: 2px;margin-top: 4px;" onclick="open_photo_upload_modal(true,false)"> <br/>
                        <!--                        </form>-->
                        <div class="card">
                            <div class="card-body">
                                <input type="hidden" name="student_id" id="student_id" class="student_id">
                                <small class="text-muted">BATCH</small>
                                <h6 class="text-info-hr view_batch"></h6>
                                <small class="text-muted">Course ID</small>
                                <h6 class="text-info-hr view_student_id"></h6>
                                <small class="text-muted">NIC NUMBER</small>
                                <h6 class="text-info-hr view_st_nic_num"></h6>
                                <small class="text-muted">PASSPORT</small>
                                <h6 class="text-info-hr view_st_passport_num"></h6>
                                <small class="text-muted p-t-30 db">GENDER</small>
                                <h6 class="text-info-hr view_st_gender"></h6>
                                <small class="text-muted p-t-30 db">CIVIL STATUS</small>
                                <h6 class="text-info-hr view_st_marital_status"></h6>
                                <small class="text-muted p-t-30 db">AGE</small>
                                <h6 class="text-info-hr view_st_age"></h6>
                                <small class="text-muted p-t-30 db">BIRTHDAY</small>
                                <h6 class="text-info-hr view_st_birthday"></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10" style="">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"><a class="nav-link active" role="tab" href="#personal_info" data-toggle="tab"> PERSONAL </a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" href="#academic_info" data-toggle="tab"> ACADEMIC </a></li>
                            <li class="nav-item"><a class="nav-link" role="tab" href="#documents_info" data-toggle="tab"> DOCUMENTS </a></li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane p-20 active" role="tabpanel" id="personal_info">
                                <div class="card-body" style="margin-top: 20px">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-3 b-r"><strong class="text-muted">TITLE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_title"></h6>
                                        </div>
                                        <div class="col-md-6 col-lg-9"><strong class="text-muted">FULL NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_full_name"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-4">
                                            <strong class="text-muted">FIRST NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_f_name"></h6>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <strong class="text-muted">MIDDLE NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_m_name"></h6>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <strong class="text-muted">LAST NAME</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_l_name"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">ADDRESS</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_current_address"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 "><strong class="text-muted">MOBILE PHONE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_phone_no"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-3 "><strong class="text-muted">HOME PHONE</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_home_no"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">EMAIL</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_email"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">COUNTRY OF BIRTH:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_country_of_birth"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">CITIZENSHIP:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_citizenship"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">School EMAIL</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_email_school"></h6>
                                            <input type="button" class="btn btn-info" onclick="change_school_email()" value=" Change" />
                                        </div>
                                         
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">Sri Lankan Visa</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_valid_sl_visa"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">Type of Visa:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_visa_type"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-4 b-r"><strong class="text-muted">Visa expiry date:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_visa_exp_date"></h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5 style="font-size: 16px; text-decoration: underline">EMPLOYMENT DETAILS</h5>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Designation:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_designation"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Official Address:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_office_address"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Telephone:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_office_phone"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">E-mail:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_emp_office_email " ></h6>
                                        </div>
                                    </div>
                                    <hr>

                                    <h5 style="font-size: 16px; text-decoration: underline">COURSE DETAILS</h5>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">Programe:</strong>
                                            <br>
                                            <h6 class="text-info-hr " id="view_programe"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r" ><strong class="text-muted">Batch Intake:</strong>
                                            <br>
                                            <h6 class="text-info-hr "  id="view_batch"></h6>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-6 b-r"><strong class="text-muted">University:</strong>
                                            <br>
                                            <h6 class="text-info-hr " id="view_university"></h6>
                                        </div>
                                        <div class="col-sm-6 col-lg-6 b-r" ><strong class="text-muted">Local Study Years:</strong>
                                            <br>
                                            <h6 class="text-info-hr view_st_min_years_local"  id=""></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" role="tabpanel" id="academic_info">
                                <div class="tab-content tabcontent-border">
                                    <ul class="nav nav-tabs smaller" >
                                        <li class="nav-item gce_ol">
                                            <a class="nav-link active" data-toggle="tab" href="#tab_view_ol" >
                                                G.C.E. Ordinary Level
                                            </a>
                                        </li>
                                        <li class="nav-item gce_al" >
                                            <a class="nav-link" data-toggle="tab" href="#tab_view_al">
                                                G.C.E. Advanced Level
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab_view_hepq">
                                                Higher Education / Professional Qualifications
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab_view_ceq">
                                                Current Educational Qualification
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active gce_ol" id="tab_view_ol">
                                            <div class="row">
 

                                                <div class="col-sm-12 col-lg-12">
                                                    <table id="VIEW_ST_OL_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg">#</th>
                                                            <th class="td_head_reg">Year</th>
                                                            <th class="td_head_reg">School</th>
                                                            <th class="td_head_reg">Type</th>
                                                            <th class="td_head_reg">SUBJECT</th>
                                                            <th class="td_head_reg">GRADE</th>
                                                            <th class="td_head_reg"></th>
                                                        </thead>
                                                        <tbody id="VIEW_ST_OL_Table_tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane gce_al" id="tab_view_al">
                                            <div class="row">
 
                                                <div class="col-sm-12 col-lg-12">
                                                    <table id="VIEW_ST_AL_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg">#</th>
                                                            <th class="td_head_reg">Year</th>
                                                            <th class="td_head_reg">School</th>
                                                            <th class="td_head_reg">Type</th>
                                                            <th class="td_head_reg">SUBJECT</th>
                                                            <th class="td_head_reg">GRADE</th>
                                                            <th class="td_head_reg"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="VIEW_ST_AL_Table_tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_view_hepq">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">
                                                    <table id="VIEW_ST_HEPQ_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                            <th class="td_head_reg" style="width: 30%">Name of the University / Professional Body</th>
                                                            <th class="td_head_reg" style="width: 30%">Degree / Diploma Awarded</th>
                                                            <th class="td_head_reg" style="width: 15%">From</th>
                                                            <th class="td_head_reg" style="width: 15%">To</th>
                                                            <th class="td_head_reg"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="VIEW_ST_HEPQ_Table_tbody">
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_view_ceq">
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12">

                                                    <table id="VIEW_ST_CEQ_Table" class="df"  style="width: 100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="td_head_reg" style="width: 30px !important;">#</th>
                                                            <th class="td_head_reg" style="width: 30%">Name of the University / Professional Body</th>
                                                            <th class="td_head_reg" style="width: 30%">Degree / Diploma Awarding</th>
                                                            <th class="td_head_reg" style="width: 15%">From</th>
                                                            <th class="td_head_reg" style="width: 15%">To</th>
                                                            <th class="td_head_reg"></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="VIEW_ST_CEQ_Table_tbody">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" role="tabpanel" id="documents_info">
                                <div class="tab-content tabcontent-border">
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-12">

                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">
                                                    Copy of National Identity Card / Passport
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_nic_pp_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Copy of the Student Visa (For International Students only)
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_visa_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-6 col-form-label">Copy of the Birth Certificate
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_bc_update" class="view_file_update_block"  style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group row gce_ol">
                                                <label class="col-sm-6 col-form-label">Copy of the O/L Certificate

                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_ol_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row gce_al">
                                                <label class="col-sm-6 col-form-label">Copy of the A/L Certificate
                                                </label>
                                                <div class="col-sm-6">
                                                    <span id="view_st_file_al_update" class="view_file_update_block" style="display: inline-block; width: 100%;"></span>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Copies of the O/L Certificates </p>
                                            <table id="VIEW_ST_OL_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Documents</th>
                                                    <!-- <th class="td_head_reg"></th> -->
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_OL_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Copies of the A/L Certificates </p>
                                            <table id="VIEW_ST_AL_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Documents</th>
                                                    <!-- <th class="td_head_reg"></th> -->
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_AL_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-sm-12 col-lg-12">
                                            <p class="acc_head_2">Relevant Professional Qualifications </p>
                                            <table id="VIEW_ST_RPQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Document</th>
                                                    <th class="td_head_reg"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_RPQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Higher Education / Professional Qualification Files </p>
                                            <table id="VIEW_ST_HEPQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Document</th>
                                                    <th class="td_head_reg"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_HEPQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 col-lg-6">
                                            <p class="acc_head_2">Current Educational Qualification Files </p>
                                            <table id="VIEW_ST_CEQ_Files_Table" class="df"  style="width: 100%">
                                                <thead>
                                                <tr>
                                                    <th class="td_head_reg">#</th>
                                                    <th class="td_head_reg">Document</th>
                                                    <th class="td_head_reg"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="VIEW_ST_CEQ_Files_Table_tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="change_school_email_modal" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                    <h6 id="change_modal_title" class="modal-title" >Change School Email </h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body form">
                                    <form action="#" id="medium_form" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="">
                                                <input type="hidden" name="change_email_student_id" id="change_email_student_id"> 
                                                <br>
                                                 
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="name" style='text-align: right;color:black;'><b> New School Email  :</b></label>
                                                    <div class="col-md-6">
                                                        <input  type="text" name="change_school_email" id="change_school_email" class="form-control" placeholder="Enter New School Email">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="school_email_update()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

<script>
        function change_school_email(){

            var student_id= $('#student_id').val();
            $('#change_email_student_id').val(student_id); 
            $('#change_school_email').val(''); 
            $('#change_school_email_modal').modal({backdrop: 'static', keyboard: false});
        } 
        function school_email_update(){
                             
            $.ajax({
                    url: "<?php echo base_url('students/Qualified_students_con/school_email_update');?>",
                    type: "POST",
                    dataType: "JSON",
                    data:{
                        "change_email_student_id":$('#change_email_student_id').val(),
                        "change_school_email":$('#change_school_email').val(),
                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                    },
                    success:function(data){
                        
                        
                        if(data.input_error)
                        {
                            for (var i = 0; i < data.input_error.length; i++)
                            {
                                $('[name="'+data.input_error[i]+'"]').parent().siblings("span.error-block").html(data.error_string[i]).show();
                                $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                            }
                        }
                        else if(data.status == true){
                            view_student($('#change_email_student_id').val());
                            $('#change_school_email_modal').modal('hide');
                            bootbox.alert({
                                message: "<b style='text-align:center'>"+data.message+"</b>"
                            });

                        }
                        else{
                            bootbox.alert({
                                message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                            });
                        }  
                     
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        bootbox.alert(textStatus + " : " + errorThrown);
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });

                                                

        }
</script>


