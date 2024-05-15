
<div class="row page-titles" xmlns="http://www.w3.org/1999/html">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
               <!--  <li class="breadcrumb-item">Dashboard</li> -->
  <!--               <li class="breadcrumb-item active">Master Detail Report</li> -->
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">
            </div>
            <!--<h6 class="element-header">

            </h6>-->
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block">System Log</h4>

                <div class="pull-right">
                    <div class="dt-buttons">
                        <a class="dt-button buttons-excel buttons-html5 text-white"
                           href="#" title="Excel"  onClick="javascript:fnExcelReport();"><span><i class="fa fa-file-excel-o"></i></span></a><a
                                class="dt-button buttons-csv buttons-html5 text-white" href="#" title="Preview"  onClick="javascript:PrintPreview();"><span><i class="fa fa-search-plus"></i></span></a>
                        <a class="dt-button buttons-print buttons-html5 text-white" onClick="javascript:PrintDiv();" href="#"><span><i class="fa fa-print"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="element-box">
                <div class="row">
                    <div class="col-lg-6 col-md-6 row">
                        <div class="form-group">
                            <label class="control-label" for="" style="width: 100%;margin-left: 50px;">Date</label>
                            <input type="hidden" id="from_date" name="from_date">
                            <input type="hidden" id="to_date" name="to_date">
                            <div id="dashboard-report-range" class="btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range" style=" background: #d46c20;color: #fff;margin-top: 0px;margin-left: 50px;">
                                <i class="icon-calendar"></i>Period :
                                <span class="new thin uppercase hidden-xs"></span>&nbsp;
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </div>
                           <div class="form-group">
                                <label class="control-label" for=""  style="width: 100%"> </label>
                                <input type="button" name="btn_new" id="btn_new" class="btn btn-success" value="Search">
                            </div>
                    </div>
                


                                 
                    
                </div>
             
  <!--               <hr> -->
                <div id="report_body" class="box-body box-bordered" style="width: 100%; max-width:100% !important; overflow: hidden;">
                </div>

            </div>
        </div>
    </div>
</div>

<script>    

      var ItemInfo;

       function reload_table(table)

                        {
                            if(typeof table !== "undefined")

                            {

                                table.ajax.reload(null,false);

                            }

                        }

	 
    $(document).ready(function () {

    	$('#report_default').show();
        $('#dashboard-report-range').daterangepicker({
            "ranges": {
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')],
                'Last Year': [moment().subtract('year', 1).startOf('year'), moment().subtract('year', 1).endOf('year')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'This Month': [moment().startOf('month'), moment().endOf('month')]
            },"showCustomRangeLabel": true
        }, function(start, end, label) {
            var start_date = start.format('YYYY-MM-DD'), end_date = end.format('YYYY-MM-DD');
            $('#dashboard-report-range span').html(start_date + ' - ' + end_date);
            $('#from_date').val(start_date);
            $('#to_date').val(end_date);
            //showBirthdays(start_date, end_date, label);
            //getAttendance(start, end, label, showAttendance);
        });
    });


    $('#btn_new').on('click', gen_report);

    function gen_report() {

        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();

        $('#report_body').html('');
        $('#report_default').hide();
        $('#loading').show();

         $('#report_body').show();
        // if(country != " " && city != " ") {

            $.ajax({
                type: "post",
                async: false,
                url: "<?php echo base_url('settings/dashboard/system_log_details');  ?>",
                data: {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash()?>",
                    "start_date": from_date,
                    "end_date": to_date,
                
                    // "category": category,
                    // "piriven": piriven,
                    // // "order_by": order_by,
                    // "dt_active": dt_active,
                },
                dataType: "html",
                success: function (data) {

                // alert(data);               
                // if(data){
                    $('#loading').hide();
                    //console.log(data);
                    $('#report_body').html(data);
                    // if(dt_active=="DT"){

                        ItemInfo = $('#report_1').DataTable({

                        	"bPaginate": true,
						    "bFilter": true,
						    "bInfo": false,
                            "pageLength": 10,
                            "buttons": [
                                // {
                                //     extend: 'print',
                                //     text:'<i class="fa fa-print"></i>',
                                //     titleAttr: 'Print' },
                                // {
                                //     extend:    'copyHtml5',
                                //     text:      '<i class="fa fa-files-o"></i>',
                                //     titleAttr: 'Copy'
                                // },
                                // {
                                //     extend:    'excelHtml5',
                                //     text:      '<i class="fa fa-file-excel-o"></i>',
                                //     titleAttr: 'Excel'
                                // },
                                // {
                                //     extend:    'csvHtml5',
                                //     text:      '<i class="fa fa-file-text-o"></i>',
                                //     titleAttr: 'CSV'
                                // },
                                // {
                                //     extend:    'pdfHtml5',
                                //     text:      '<i class="fa fa-file-pdf-o"></i>',
                                //     titleAttr: 'PDF'
                                // }
                            ],
                            "lengthMenu": [
                                [5, 10, 15, 20, -1],
                                [5, 10, 15, 20,'All']
                            ],
                            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
                        });


                         ItemInfo.on('order.dt search.dt', function () {

                                ItemInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {

                                    cell.innerHTML = i + 1;

                                });

                            }).draw();

                       yadcf.init(ItemInfo, [{

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
                    // }else{

                    //      reload_table(ItemInfo);
                    // }
                    // }
                }
            });
        // }

        // }else{
        //     bootbox.dialog({
        //         message: 'Please Select Date Range',
        //         title: "Alert!",
        //         buttons: {
        //             cancel: {
        //                 label: "OK",
        //                 className: "btn-default"
        //             }
        //         }
        //     });
        // }
    }

    function fnExcelReport() {
        var file = new Blob([$('#report_body').html()], {type:"application/vnd.ms-excel"});
        var url = URL.createObjectURL(file);
        var a = $("<a />", {
            href: url,
            download: "Arrow_HRMS_Export.xls"}).appendTo("body").get(0).click();
        e.preventDefault();
    }
  
</script>

