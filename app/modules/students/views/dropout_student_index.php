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
                <li class="breadcrumb-item active"> Dropout Students</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Dropout Students</h4>
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

                    <div class="tab-pane p-20 active" role="tabpanel" id="allocation">
                        <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="QualifiedInfo" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="all" style="width: 30px">#</th>
                                <th class="all">Course ID</th>
                                <th class="all">BATCH & Intake</th>
                                <th class="all">Program</th>
                                <th class="all">Name</th>
                                <th class="all">NIC Number/Passport</th>
                                <th class="all">Dropout Date</th>
                                <th class="all">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <script type="text/javascript">

                        var save_method;
                        var QualifiedInfo;
                        // var NonQualifiedInfo;

                        $(document).ready(function(){

                            QualifiedInfo = $('#QualifiedInfo').DataTable({

                                "processing": true, //Feature control the processing indicator.
                                "serverSide": true, //Feature control DataTables' server-side processing mode.
                                // Load data for the table's content from an Ajax source
                                "ajax": {
                                    "data": {
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    "url": "<?php echo base_url()?>students/Dropout_students_con/dropout_list/",
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


                    <!-- Bootstrap modal -->
                    <div class="modal fade" id="transfer_modal" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 1300px">
                            <div class="modal-content">
                                <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                    <h6 style="color: white;" id="transfer_modal_title"></h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>

                                <div class="modal-body form">
                                    <form action="#" id="transfer_form" class="form-horizontal">
                                        <div class="form-body">
                                            <input type="hidden" id="add_pay_id" name="add_pay_id">
                                            <input type="hidden" id="add_plan_type_id" name="add_plan_type_id">
                                            <input type="hidden" id="student_id_number" name="student_id_number">


                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" role="tab" href="#tab_1" data-toggle="tab"> General Details </a></li>
                                                <li class="nav-item"><a class="nav-link " role="tab" href="#tab_2" data-toggle="tab"> Current Installments Details </a></li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content tabcontent-border">
                                                <div class="tab-pane p-20 active" role="tabpanel" id="tab_1">
                                                    <div  style="padding: 4px; border: 2px solid #ffc1c1;">
                                                        <h4 style="font-size: 14px;border-bottom: 2px solid #f9860c;">General Details</h4>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Current Program : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" name="current_program"  id="current_program" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Current Batch & Intake : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="current_batch_intake" id="current_batch_intake" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Current Payment Plan : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="current_payment_plan" id="current_payment_plan" class="form-control">
                                                                <input type="hidden" readonly name="current_payment_plan_id" id="current_payment_plan_id" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Program Amount : </b></label>
                                                            <div class='col-md-8'>

                                                                <input type="text" readonly name="total_amount_2"  id="total_amount_2" class="form-control">
                                                                <input type="hidden" readonly name="total_amount"  id="total_amount" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Paid Total Amount : </b></label>
                                                            <div class='col-md-8'>

                                                                <input type="text" readonly name="paid_total_amount_2"  id="paid_total_amount_2" class="form-control">
                                                                <input type="hidden" readonly name="paid_total_amount"  id="paid_total_amount" class="form-control">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                </div>
                                                <div class="tab-pane p-20" role="tabpanel" id="tab_2">
                                                    <div  style="padding: 4px; border: 2px solid #ffc1c1;">
                                                        <h4 style="font-size: 14px;border-bottom: 2px solid #f9860c;">Current Installments Details</h4>
                                                        <div class="row">
                                                            <div class="col-sm-12 col-lg-6">
                                                                <label for="">Completed Installments</label>
                                                                <table class="table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Installment</th>
                                                                        <th>Amount</th>
                                                                        <th>Due Date</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="complete_CyTable_tbody">
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="col-sm-12 col-lg-6">
                                                                <label for="">Pending Installments</label>
                                                                <table class="table-bordered table-hover" width="100%">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Installment</th>
                                                                        <th>Amount</th>
                                                                        <th>Due Date</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody id="pending_CyTable_tbody">
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label><b> Program : </b></label>
                                                        <select name="program" id="program" class="form-control selectpicker" data-live-search="true">
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label><b> Currency : </b></label>
                                                        <select name="new_currency" id="new_currency" class="form-control selectpicker" data-live-search="true">
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label><b> Batch : </b></label>
                                                        <select name="batch" id="batch" class="form-control selectpicker" data-live-search="true">
                                                        </select>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class='control-label col-md-4'><b> Currency : </b></label>
                                                        <input type="text" readonly name="already_saved_currency" id="already_saved_currency" class="form-control">
                                                        <input type="hidden" id="already_saved_currency_id" name="already_saved_currency_id">
                                                        <input type="hidden" id="program_enrollment_id" name="program_enrollment_id">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class='control-label col-md-4'><b>Total Amount : </b></label>
                                                        <input type="text" readonly name="program_total_amount" id="program_total_amount" class="form-control numeric">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class='control-label col-md-4'><b>New Amount : </b></label>
                                                        <input type="text" readonly name="new_program_total_amount" id="new_program_total_amount" class="form-control numeric">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class='control-label col-md-4'><b>Installments Balance : </b></label>
                                                        <input type="text" readonly name="balance_installments" id="balance_installments" class="form-control numeric">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class='control-label col-md-4'><b>New Mobile Number : </b></label>
                                                        <input type="text" name="new_number" id="new_number" class="form-control numeric">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class='control-label col-md-4'><b>Reason For Transfer : </b></label>
                                                        <textarea class="form-control" name="reason_for_transfer" id="reason_for_transfer"></textarea>
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label for="">Installments</label>
                                                        <input type="number" name="installment_c" id="installment_c" class="form-control" maxlength="2" max="48" min="1" minlength="1">
                                                        <span class="error-block"></span>
                                                    </div>
                                                    <div class="col-sm-6 col-lg-3">
                                                        <div class="form-group">
                                                            <input type="hidden" name="due_d" id="due_d" class="form-control date-pick" data-date-format="yyyy-mm-dd">
                                                            <input type="hidden" name="installment_a" id="installment_a" class="form-control">
                                                            <input type="hidden" name="late_a" id="late_a" class="form-control" value="200.00">
                                                            <a id="monthly_addButton" href="#" class="btn btn-success form-control"><i class="fa fa-plus"></i> Add</a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class='row'>
                                                    <div class='col-md-8'>
                                                        <input type="hidden" readonly name="bal_amount_to_add" id="bal_amount_to_add" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" style="text-align: center;">
                                                    <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive"  cellspacing="0" width="100%">
                                                        <thead>
                                                        <tr>
                                                            <th class="all" style="width: 30px">#ID</th>
                                                            <th class="all">Custom Installment</th>
                                                            <th class="all">Due Date</th>
                                                            <th class="all">Amount</th>
                                                            <th class="all">Late Levy</th>
                                                            <th style="width: 20px;"><!--<a  id="monthly_addButton" name="add_row"><i class="icon-plus" style="color:#ff9c20; background-color:#fff"></i></a>--></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="monthly_load_list">
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="save_new()" class="btn btn-primary">Save</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        function student_freeze(id){
                            $('#monthly_load_list').empty();
                            $('#complete_CyTable_tbody').empty();
                            $('#pending_CyTable_tbody').empty();

                            $('#transfer_form')[0].reset();
                            $('.selectpicker').selectpicker('refresh');
                            $('.error-block').empty();
                            save_method='add';
                            $.ajax({
                                url: "<?php echo base_url('students/Dropout_students_con/student_data');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "id":id,
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){
                                    var st_id=data.student.id;
                                    var batch=data.student.batch;
                                    var intake=data.student.intake;
                                    var program=data.student.programe;
                                    load_current_plan_data(st_id,batch,intake,program);
                                    $('#student_id_number').val(st_id);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                            $('#transfer_modal_title').html('Student Freeze Form');
                            $('#transfer_modal').modal({backdrop: 'static', keyboard: false});
                        }
                        // load student Data

                        function load_current_plan_data(st_id,batch,intake,program) {
                            var student_id= st_id;
                            var batch_id= batch;
                            var intake_id= intake;
                            var program_id= program;

                            student_data(student_id,program_id);
                            current_program_fee(student_id,program_id,batch_id,intake_id);
                            current_payment_plans(student_id,program_id,batch_id,intake_id);
                        }
                        function student_data(student_id,program_id) {
                            $.ajax({
                                url: "<?php echo base_url('master/Master_student_details_transfer_con/get_student_data');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "id":student_id,
                                    "program_id":program_id,
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){
                                    $('#current_program').val(data.student_data.program_name);
                                    $('#current_batch_intake').val(data.student_data.batch_intake);
                                    $('#paid_total_amount_2').val(data.payment_data.paid_amount_2);
                                    $('#paid_total_amount').val(data.payment_data.paid_amount);

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                        }
                        function current_program_fee(student_id,program_id,batch_id,intake_id) {
                            $.ajax({
                                url: "<?php echo base_url('master/Master_student_details_transfer_con/current_program_fee');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "id":student_id,
                                    "program_id":program_id,
                                    "batch_id":batch_id,
                                    "intake_id":intake_id,
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){
                                    var p_nm="";
                                    if (data.payment_data.payment_plan_name==null){
                                        p_nm="Custom Plan";
                                    }else{
                                        p_nm=data.payment_data.payment_plan_name;
                                    }
                                    $('#total_amount_2').val(data.payment_data.amount_2);
                                    $('#total_amount').val(data.payment_data.amount);
                                    $('#current_payment_plan').val(p_nm);
                                    $('#current_payment_plan_id').val(data.payment_data.plan_id);
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });
                        }
                        function current_payment_plans(student_id,program_id,batch_id,intake_id) {
                            $.ajax({
                                url: "<?php echo base_url('master/Master_student_details_transfer_con/current_payment_plans');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "id":student_id,
                                    "program_id":program_id,
                                    "batch_id":batch_id,
                                    "intake_id":intake_id,
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){
                                    var counter = 1;
                                    var x=0;
                                    var y=0;
                                    for(var i=0;i<data.pending_list.length;i++){
                                        x=x+1;
                                        $('#pending_CyTable_tbody').append(
                                            '<tr>' +
                                            '<td>' +
                                            x +
                                            '</td>' +
                                            '<td>'+ data.pending_list[i].pay_installment +'</td>' +
                                            '<td>'+ data.pending_list[i].symbol +' '+ data.pending_list[i].amount +'</td>' +
                                            '<td>'+ data.pending_list[i].due_date +'</td>' +
                                            '</td>');
                                    }
                                    for(var i=0;i<data.complete_list.length;i++){
                                        y=y+1;
                                        $('#complete_CyTable_tbody').append(
                                            '<tr>' +
                                            '<td>' +
                                            y +
                                            '</td>' +
                                            '<td>'+ data.complete_list[i].pay_installment +'</td>' +
                                            '<td>'+ data.complete_list[i].symbol +' '+ data.complete_list[i].amount +'</td>' +
                                            '<td>'+ data.complete_list[i].due_date +'</td>' +
                                            '</td>');
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


                        //new details
                        // load program
                        $.ajax({
                            url: "<?php echo base_url('master/Master_student_details_transfer_con/program_data');?>",
                            type: "POST",
                            dataType: "JSON",
                            data:{
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },
                            success:function(data){
                                $('#program').html('<option value="">--Select Program--</option>');
                                for(var i=0;i<data.programs.length;i++){
                                    $('#program').append('<option value="'+data.programs[i].id+'">'+data.programs[i].code+' - '+data.programs[i].name+'</option>');
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
                        $.ajax({
                            url: "<?php echo base_url('master/Master_student_details_transfer_con/currency_data');?>",
                            type: "POST",
                            dataType: "JSON",
                            data:{
                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                            },
                            success:function(data){
                                $('#new_currency').html('<option value="">--Select Currency--</option>');
                                for(var i=0;i<data.currencies.length;i++){
                                    $('#new_currency').append('<option value="'+data.currencies[i].id+'">( '+data.currencies[i].symbol+' ) '+data.currencies[i].currency+'</option>');
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

                        $('#program').change(function(){
                            var program_val=$(this).val();
                            load_batch(program_val);
                        });
                        function  load_batch(program_val) {
                            $.ajax({
                                url: "<?php echo base_url('master/Master_student_details_transfer_con/get_batch_data');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "id":program_val,
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                },
                                success:function(data){
                                    $('#batch').html('<option  value="">--Select Batch--</option>');
                                    for(var i=0;i<data.batches.length;i++){
                                        $('#batch').append('<option value="'+data.batches[i].id+','+data.batches[i].batch_id+'">'+data.batches[i].batch_intake+'</option>');
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
                        $('#new_currency').change(function () {
                            clear_inputs();
                            $('#batch').val('');
                            $('.selectpicker').selectpicker('refresh');
                        });
                        $('#batch').change(function () {
                            clear_inputs();
                            var data= $(this).val().split(",");
                            var batch_id= data[1];
                            var intake_id= data[0];
                            var program = document.getElementById("program").value;
                            var new_currency = document.getElementById("new_currency").value;

                            if (new_currency==""){
                                bootbox.alert("Please Select Currency");
                                $('#batch').val('');
                                $('.selectpicker').selectpicker('refresh');
                            }else{
                                if (batch_id!=""){

                                    // load already saved register amount,max discounts and full program fees
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_finance_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "batch_id":batch_id,
                                            "program_id":program,
                                            "currency_id":new_currency,
                                        },
                                        success:function(data){

                                            if (data.finance==""){

                                                var paid_total_amount = document.getElementById("paid_total_amount").value;
                                                if (paid_total_amount==""){
                                                    $('[name="new_program_total_amount"]').val(parseFloat(0));
                                                    $('[name="balance_installments"]').val(parseFloat(0));
                                                }else{
                                                    $('[name="new_program_total_amount"]').val(parseFloat(0));
                                                    $('[name="balance_installments"]').val(parseFloat(0));
                                                }

                                                $('[name="already_saved_currency"]').val(parseFloat(0));
                                                $('[name="program_enrollment_id"]').val(parseFloat(0));
                                                $('[name="already_saved_currency_id"]').val(parseFloat(0));
                                                $('[name="program_total_amount"]').val(parseFloat(0));
                                                bootbox.alert("No payments records for this currency.please create payment plans before link this currency.")
                                            }else{
                                                var paid_total_amount = document.getElementById("paid_total_amount").value;
                                                if (paid_total_amount==""){
                                                    $('[name="new_program_total_amount"]').val(parseFloat(data.finance[0].full_program_fee)-parseFloat(0));
                                                    $('[name="balance_installments"]').val(parseFloat(data.finance[0].full_program_fee)-parseFloat(0));
                                                }else{
                                                    $('[name="new_program_total_amount"]').val(parseFloat(data.finance[0].full_program_fee)-parseFloat(paid_total_amount));
                                                    $('[name="balance_installments"]').val(parseFloat(data.finance[0].full_program_fee)-parseFloat(paid_total_amount));
                                                }

                                                $('[name="already_saved_currency"]').val(data.finance[0].currency_type);
                                                $('[name="program_enrollment_id"]').val(data.finance[0].id);
                                                $('[name="already_saved_currency_id"]').val(data.finance[0].currency_id);
                                                $('[name="program_total_amount"]').val(data.finance[0].full_program_fee);
                                            }

                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                                }else{
                                    alert("Please Select Batch");
                                }
                            }




                        });

                        function clear_inputs() {
                            // $('#monthly_load_list').empty();
                            $('[name="already_saved_currency"]').val('0');
                            $('[name="program_enrollment_id"]').val('0');
                            $('[name="already_saved_currency_id"]').val('0');
                            $('[name="program_total_amount"]').val('0');
                            $('[name="new_program_total_amount"]').val('0');
                            $('[name="balance_installments"]').val('0');

                        }

                        function save_new(){
                            $('.error-block').empty();
                            var url;
                            if(save_method == 'add'){
                                url="<?php echo base_url('students/Dropout_students_con/add_enrollment'); ?>";
                            }
                            else{
                                url="<?php echo base_url('payments/Program_fee/update_enrollment'); ?>";
                            }

                            $.ajax({

                                url:url,
                                dataType:"JSON",
                                type:"POST",
                                data:$('#transfer_form').serialize()+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
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

                                    if(data.status==true){
                                        reload_table(QualifiedInfo);
                                        $('#transfer_form')[0].reset();
                                        $('.selectpicker').selectpicker('refresh');
                                        $('#transfer_modal').modal('hide');
                                        bootbox.alert({
                                            message: "<b style='text-align:center;color: green;'>"+data.message+"</b>"
                                        });

                                    }
                                    else{
                                        reload_table(QualifiedInfo);
                                        if (data.message!=null){
                                            bootbox.alert({
                                                message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                            });
                                        }

                                    }
                                },
                                error:function(){

                                    bootbox.alert({
                                        message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                    });
                                }

                            });

                        }


                    </script>
                    <script>
                        var monthly_counter;
                        var total_amount_monthly;
                        var tot_amt;
                        var tot_ins_amt;
                        $('#bal_amount_to_add').val();
                        //////RESET ///
                        $(".row_dyn").remove();

                        monthly_counter = 1;
                        total_amount_monthly = 0;
                        tot_amt = 0;
                        tot_ins_amt = 0;
                        $('#bal_amount_to_add').val();


                        $("#monthly_addButton").click(function () {

                            //JE ADDED 2020_05_19
                            //TODO
                            //bugs - bootbox alert issue after modal close and open again.

                            var installment_c = $('#installment_c').val();
                            var due_d = $('#due_d').val('');
                            var installment_a = $('#installment_a').val('');
                            var late_a = $('#late_a').val();

                            tot_ins_amt = parseInt(installment_c)*parseInt(installment_a);

                            var tot_amt_raw = $('#balance_installments').val();
                            tot_amt = $('#balance_installments').val();
                            var reg_amt = $('#register_amount').val();

                            if(monthly_counter>48||installment_c>48){
                                bootbox.alert("Only 48 Installments allowed");
                                return false;
                            }

                            if(tot_amt_raw==0){
                                alert("Please Check Program Fee before add Custom Installments");
                                //bootbox.alert("Please Check Program Fee before add Custom Installments");
                                return false;
                            }else{
                                if(parseInt(tot_amt_raw)<parseInt(reg_amt)){
                                    bootbox.alert("Register fee need to less than Full Amount");
                                    return false;
                                }

                                if(reg_amt!=""||reg_amt==0){
                                    tot_amt = parseInt(tot_amt)-parseInt(reg_amt);
                                }
                                if(total_amount_monthly!=""){
                                    tot_amt = parseInt(tot_amt) - parseInt(total_amount_monthly);
                                }

                                if(tot_amt<tot_ins_amt){
                                    bootbox.alert("Installment need to be less than Full Amount (without Register Fee) ");
                                    return false;
                                }

                                total_amount_monthly += parseInt(tot_ins_amt);
                                console.log(total_amount_monthly);
                                console.log(tot_amt_raw);
                                console.log(tot_amt);

                                var t_tot_ammt =  parseInt(tot_amt_raw)-parseInt(reg_amt);

                                $('#bal_amount_to_add').val(t_tot_ammt-total_amount_monthly);
                            }

                            for (i= 0; i < installment_c; ++i) {
                                var date_next = moment(due_d).add(monthly_counter, 'months');
                                var date_next_f = date_next.format('YYYY-MM-DD');


                                var dyTable = $(document.createElement('tr')).attr("id", 'row_' + monthly_counter).attr("class", 'rowRW row_dyn');
                                dyTable.after().html('<td style="width:40px;"><label id="code'+monthly_counter+'" name="" style="width: 100px;color:black;font-weight:200;" >'+monthly_counter+'</label></td>' +
                                    '<td><input type="text" name="custom_installment[]" value="Custom Installment '+monthly_counter+'" class="form-control" style="width: 300px;"></td>' +
                                    '<td style="width:160px;"><input type="text" value="" name="custom_installment_date[]" class="form-control form-control-inline input-medium date-picker2" size="16" data-date-format="yyyy-mm-dd"></td>' +
                                    '<td><input type="number" placeholder="Amount" class="form-control numeric" min="1" name="custom_amount[]" style="width: 100px;" min="0"  value=""></td>' +
                                    '<td><input type="number" placeholder="Late Levy" class="form-control" name="custom_late[]" min="1" style="width: 100px;" min="0" oninput="validity.valid||(value=\'\');" value="'+late_a+'"></td>' +
                                    '<td>' +
                                    '</td>');
                                dyTable.appendTo("#monthly_load_list");
                                monthly_counter++;

                                $('.select2').select2();

                                $('.date-picker2').datepicker({
                                    orientation: "bottom",
                                    autoclose: true,
                                    dateFormat: 'yy-mm-dd',
                                    todayHighlight: true,
                                    startDate: "today"
                                });
                            }
                            //JE ADDED 2020_05_19 END
                        });
                        $("#monthly_load_list").on("click", '.del', function()
                        {

                            bootbox.dialog({
                                message: "Are you sure want to delete this record?",
                                title: "Alert!",
                                buttons: {
                                    ok: {
                                        label: "Yes",
                                        className: "btn-danger",
                                        callback: function () {
                                            var delID = $(this).attr('id');
                                            var rw_no = delID;

                                            row_id = $("#row_" + delID);
                                            row_id.remove();
                                            //todo after delete calualte & update total amount global
                                            an--;
                                        }
                                    },
                                    cancel: {
                                        label: "No",
                                        className: "btn-default"
                                    }
                                }
                            });


                        });
                    </script>




