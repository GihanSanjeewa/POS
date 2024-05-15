<?php
/**
 * Created by Earrow.
 * User:NIPUN DE SILVA
 * Email:nipun@earrow.net
 * Date: 01/7/2021
 * Time: 3:32 PM
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
    .embedded-daterangepicker .daterangepicker .drp-calendar{
        width: 48% !important;
        max-width: 50%;
    }
    .select2-container .select2-selection--single {
        width: 315px !important;
        height: 35px !important;
    }
    .modal-body {
        max-height: calc(200vh - 250px);
        overflow-y: auto;
    }
</style>


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Administration</a></li>
                <li class="breadcrumb-item active">System Log</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> System Log <small> - Administration</small></h4>
                <input type="date" name="search_date" id="search_date" >
                <input type="button" class="btn btn-success" onclick="load_date_wise()" value="Search">
            </div>
            <div class="element-box">

                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    <div class="tab-pane p-20 active" role="tabpanel" id="pending">
                         
                        <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="HallInfo" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="all" style="width: 30px">#</th>
                                <th class="all">User Details</th>
<!--                                <th class="all">Hall Type</th>-->
                                <th class="all">IP Address</th>
                                <th class="all">Date & Time</th>
<!--                                <th class="all">Capacity</th>-->
                                <th class="all">Module</th>
                                <th class="all">Status</th>
                                <th class="all">Details</th>
                                 
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

  


                    <script type="text/javascript">

                        var save_method;
                        var HallInfo;

                        $(document).ready(function(){

                            


                            HallInfo = $('#HallInfo').DataTable({

                                "processing": true, //Feature control the processing indicator.
                                "serverSide": true, //Feature control DataTables' server-side processing mode.
                                // Load data for the table's content from an Ajax source
                                "ajax": {
                                    "data": {
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    "url": "<?php echo base_url()?>settings/System_log_con/system_log/",
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
                                    { extend: 'print', text:      '<i class="fa fa-print"></i>',
                                        titleAttr: 'Print' },
                                    {
                                        extend:    'copyHtml5',
                                        text:      '<i class="fa fa-files-o"></i>',
                                        titleAttr: 'Copy'
                                    },
                                    {
                                        extend:    'excelHtml5',
                                        text:      '<i class="fa fa-file-excel-o"></i>',
                                        titleAttr: 'Excel'
                                    },
                                    {
                                        extend:    'csvHtml5',
                                        text:      '<i class="fa fa-file-text-o"></i>',
                                        titleAttr: 'CSV'
                                    },
                                    {
                                        extend:    'pdfHtml5',
                                        text:      '<i class="fa fa-file-pdf-o"></i>',
                                        titleAttr: 'PDF'
                                    }
                                ],
                                responsive: true,
                                "order": [
                                    [0, 'asc']
                                ],
                                "lengthMenu": [
                                    [5, 10, 15, 20,100, -1],
                                    [5, 10, 15, 20,100, "All"] // change per page values here
                                ],
                                "pageLength": 100,
                                "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
                            });

                            HallInfo.on('order.dt search.dt', function () {
                                HallInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            }).draw();

                            yadcf.init(HallInfo, [{
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




                        function load_date_wise(){

                            var search_date=$('#search_date').val();

                            if(search_date==""){
                                bootbox.alert("Please Select Date");
                            }else{
                                
                                

                                HallInfo = $('#HallInfo').DataTable({

                                        "processing": true, //Feature control the processing indicator.
                                        "serverSide": true, //Feature control DataTables' server-side processing mode.
                                        // Load data for the table's content from an Ajax source
                                        "ajax": {
                                            "data": {
                                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                            },
                                            "url": "<?php echo base_url()?>settings/System_log_con/system_log_search/"+search_date,
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
                                            { extend: 'print', text:      '<i class="fa fa-print"></i>',
                                                titleAttr: 'Print' },
                                            {
                                                extend:    'copyHtml5',
                                                text:      '<i class="fa fa-files-o"></i>',
                                                titleAttr: 'Copy'
                                            },
                                            {
                                                extend:    'excelHtml5',
                                                text:      '<i class="fa fa-file-excel-o"></i>',
                                                titleAttr: 'Excel'
                                            },
                                            {
                                                extend:    'csvHtml5',
                                                text:      '<i class="fa fa-file-text-o"></i>',
                                                titleAttr: 'CSV'
                                            },
                                            {
                                                extend:    'pdfHtml5',
                                                text:      '<i class="fa fa-file-pdf-o"></i>',
                                                titleAttr: 'PDF'
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

                                        HallInfo.on('order.dt search.dt', function () {
                                        HallInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                            cell.innerHTML = i + 1;
                                        });
                                        }).draw();

                                        yadcf.init(HallInfo, [{
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
                                        }],
                                        {
                                            cumulative_filtering: false
                                        });











                            }
                            
                        }

                    </script>
                    