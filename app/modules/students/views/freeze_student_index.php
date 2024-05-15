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
                <li class="breadcrumb-item active"> Re-join Students</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Re-join Students</h4>
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
                                <th class="all">Re-join Date</th>

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
                                    "url": "<?php echo base_url()?>students/Dropout_students_con/freeze_list/",
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




                        });

                        function reload_table(table)
                        {

                            if(typeof table !== "undefined")
                            {
                                table.ajax.reload(null,false);
                            }

                        }

                    </script>







