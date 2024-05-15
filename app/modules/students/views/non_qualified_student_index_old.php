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
$date=date("Y-m-d");
?>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Payments</a></li>
                <li class="breadcrumb-item active"> Non Qualified Students</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block">Non Qualified Students</h4>
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
                    <div class="tab-pane p-20 active" role="tabpanel" id="none">
                     <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="NonQualifiedInfo" cellspacing="0" width="100%">
                      <thead>
                    <tr>
                        <th class="all" style="width: 30px">#</th>
                        <th class="all">Student ID</th>
                        <th class="all">NIC Number/Passport</th>
                        <th class="all">Name</th>
                        <th class="all">Batch & Intake</th>
                        <th class="all">Program</th>
                        <th class="all">Discount</th>
                        <th class="all">Created Date</th>
                        <th class="all">Updated Date</th>
                        <th class="all">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>



                    <script type="text/javascript">

                        var save_method;

                        var NonQualifiedInfo;

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



                            NonQualifiedInfo = $('#NonQualifiedInfo').DataTable({

                                "processing": true, //Feature control the processing indicator.
                                "serverSide": true, //Feature control DataTables' server-side processing mode.
                                // Load data for the table's content from an Ajax source
                                "ajax": {
                                    "data": {
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    "url": "<?php echo base_url()?>students/Qualified_students_con/non_qualified_list/",
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

                            NonQualifiedInfo.on('order.dt search.dt', function () {
                                NonQualifiedInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
                                    cell.innerHTML = i + 1;
                                });
                            }).draw();

                            yadcf.init(NonQualifiedInfo, [{
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

                    </script>


                    <!-- program enrollment modal -->
                    <div class="modal fade" id="program_enrollment_modal" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 1000px">
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
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Currency : </b></label>
                                                        <div class='col-md-8'>
                                                            <select name="currency_type" id="currency_type" class="form-control selectpicker" data-live-search="true">
                                                                <option value="1">LKR</option>
                                                                <option value="2">USD</option>
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
                                                    <div class='row'>
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Currency (LKR) : </b></label>
                                                        <div class='col-md-8'>
                                                            <input type="text" readonly  class="form-control numeric penalty" name="payable_currency_type" id="payable_currency_type">
                                                            <input type="hidden" name="validation_currency" id="validation_currency">
                                                            <input type="hidden" name="payable_currency_id" id="payable_currency_id">
                                                            <input type="hidden" name="payable_currency_rate" id="payable_currency_rate">
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                    <br>


                                                    <div id="program_enrollment_full_payment">
                                                        <input type="hidden" name="program_full_fee_id" id="program_full_fee_id">
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Full Payment Plan List(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_full_plan[]" id="program_enrollment_full_plan" class="form-control selectpicker" data-live-search="true" multiple>
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <input type="hidden" name="program_full_fee_id" id="program_full_fee_id">
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Full Payment Installment(s) Total : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_full_enrollment_total_amount_show" id="program_full_enrollment_total_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_full_enrollment_total_amount" id="program_full_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Full Payment Register Fee(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_full_register_amount_show" id="program_full_register_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_full_register_amount" id="program_full_register_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                    <div class='row'>
                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Installment(s) Discount Amount : </b></label>
                                        <div class='col-md-8'>
                                            <input type="text" readonly name="full_installment_discount_show" value="0" id="full_installment_discount_show" class="form-control readonlycolor">
                                            <input type="hidden" readonly name="full_installment_discount" value="0" id="full_installment_discount" class="form-control readonlycolor">
                                            <span class="error-block"></span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class='row'>
                                    <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Total Discount Amount : </b></label>
                                    <div class='col-md-8'>
                                    <input type="text" readonly name="full_total_discount_show" value="0" id="full_total_discount_show" class="form-control readonlycolor">
                                        <input type="hidden" readonly name="full_total_discount" value="0" id="full_total_discount" class="form-control readonlycolor">
                                    <span class="error-block"></span>
                                    </div>
                                    </div>
                                    <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Discounted Installment(s) Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="full_program_discounted_amount_show" id="full_program_discounted_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="full_program_discounted_amount" id="full_program_discounted_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_full_final_price_show" id="program_full_final_price_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_full_final_price" id="program_full_final_price" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="real_program_full_final_price" id="real_program_full_final_price" class="form-control readonlycolor">
                                                                <input type="hidden" class="form-control numeric" name="full_card_fee_amount" value="0" id="full_card_fee_amount">
                                                                <span class="error-block"></span>
                                                                <span id="full_card_dis"></span>
                                                            </div>
                                                        </div>
                                        <br>
                            <div class='row'>
                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Pay Amount(Cash Given) :</b></label>
                            <div class='col-md-8'>
                            <input type="text" name="full_cash_given_a" id="full_cash_given_a" class="form-control numeric">
                            <input type="hidden" name="full_cash_given" id="full_cash_given" class="form-control numeric">
                            <span class="error-block"></span>
                            </div>
                            </div>
                                        <br>
                            <div class='row'>
                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance Amount :</b></label>
                            <div class='col-md-8'>
                            <input type="text"  value="0" placeholder="0" name="full_balance_amount" id="full_balance_amount" class="form-control numeric">
                            <span class="error-block"></span>
                            </div>
                            </div>
                                        <br>
                                                    </div>
                                                    <div id="program_enrollment_monthly_payment">
                                                        <input type="hidden" name="program_monthly_fee_id" id="program_monthly_fee_id">
                                                        <input type="hidden" name="monthly_num_rows" id="monthly_num_rows">
                                                        <input type="hidden" value="0" name="per_m_ins_amount" id="per_m_ins_amount">
                                                        <div id="mnthly_ins" style="display: none;">
                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Refer Discount's Per Installment : </b></label>
                        <div class='col-md-8'>
                            <input type="text" value="0" readonly name="per_monthly_intallment" id="per_monthly_intallment" class="form-control readonlycolor">
                            <span class="error-block"></span>
                        </div>
                    </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Monthly Payment Plan List(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_monthly_plan[]" id="program_enrollment_monthly_plan" class="form-control selectpicker" data-live-search="true" multiple>
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Monthly Installment(s) Total : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_monthly_enrollment_total_amount_show" id="program_monthly_enrollment_total_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_monthly_enrollment_total_amount" id="program_monthly_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Monthly Payment Register Fee(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_monthly_register_amount_show" id="program_monthly_register_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_monthly_register_amount" id="program_monthly_register_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
            <div class='row'>
            <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Installment(s) Discount Amount : </b></label>
            <div class='col-md-8'>
            <input type="text" readonly name="total_monthly_enrollment_discount_show" value="0" id="total_monthly_enrollment_discount_show" class="form-control readonlycolor">
                <input type="hidden" readonly name="total_monthly_enrollment_discount" value="0" id="total_monthly_enrollment_discount" class="form-control readonlycolor">
            <span class="error-block"></span>
            </div>
            </div>
            <br>
            <div class='row'>
            <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Total Discount Amount : </b></label>
            <div class='col-md-8'>
            <input type="text" readonly name="monthly_total_discount_show" value="0" id="monthly_total_discount_show" class="form-control readonlycolor">
                <input type="hidden" readonly name="monthly_total_discount" value="0" id="monthly_total_discount" class="form-control readonlycolor">
            <span class="error-block"></span>
            </div>
            </div>
            <br>
            <div class='row'>
        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Discounted Installment(s) Fee : </b></label>
        <div class='col-md-8'>
        <input type="text" readonly name="monthly_program_discounted_amount_show" id="monthly_program_discounted_amount_show" class="form-control readonlycolor">
            <input type="hidden" readonly name="monthly_program_discounted_amount" id="monthly_program_discounted_amount" class="form-control readonlycolor">
        <span class="error-block"></span>
        </div>
        </div>
            <br>
            <div class='row'>
            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Amount : </b></label>
            <div class='col-md-8'>
            <input type="text" readonly name="program_monthly_enrollment_final_price_show" id="program_monthly_enrollment_final_price_show" class="form-control readonlycolor">
            <input type="hidden" readonly name="program_monthly_enrollment_final_price" id="program_monthly_enrollment_final_price" class="form-control readonlycolor">
            <input type="hidden" readonly name="real_program_monthly_enrollment_final_price" id="real_program_monthly_enrollment_final_price" class="form-control readonlycolor">
                <input type="hidden" class="form-control numeric" name="monthly_card_fee_amount" value="0" id="monthly_card_fee_amount">
            <span class="error-block"></span>
                <span id="monthly_card_dis"></span>
            </div>
            </div>






                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Pay Amount(Cash Given) :</b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" name="monthly_cash_given_a" id="monthly_cash_given_a" class="form-control numeric">
                                                                <input type="hidden" name="monthly_cash_given" id="monthly_cash_given" class="form-control numeric">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance Amount :</b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text"  value="0" placeholder="0" name="monthly_balance_amount" id="monthly_balance_amount" class="form-control numeric">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>
                                                    <div id="program_enrollment_semester">
                                                        <input type="hidden" name="program_semester_fee_id" id="program_semester_fee_id">
                                                        <input type="hidden" name="semester_num_rows" id="semester_num_rows">
                                                        <input type="hidden" value="0" name="per_s_ins_amount" id="per_s_ins_amount">
                                                        <div id="semester_ins" style="display: none;">
                                                            <div class='row'>
                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Refer Discount's Per Installment : </b></label>
                                                                <div class='col-md-8'>
                                                                    <input type="text" value="0" readonly name="per_semester_intallment" id="per_semester_intallment" class="form-control readonlycolor">
                                                                    <span class="error-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Semester Installment List(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_semester_plan[]" id="program_enrollment_semester_plan" class="form-control selectpicker" data-live-search="true" multiple>
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Semester Installment(s) Total : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_semester_enrollment_total_amount_show" id="program_semester_enrollment_total_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_semester_enrollment_total_amount" id="program_semester_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Semester Payment Register Fee(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_semester_register_amount_show" id="program_semester_register_amount_show" class="form-control readonlycolor">
                                                                <input type="hidden" readonly name="program_semester_register_amount" id="program_semester_register_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Installment(s) Discount Amount : </b></label>
                        <div class='col-md-8'>
                            <input type="text" readonly name="total_semester_enrollment_discount_show" value="0" id="total_semester_enrollment_discount_show" class="form-control readonlycolor">
                            <input type="hidden" readonly name="total_semester_enrollment_discount" value="0" id="total_semester_enrollment_discount" class="form-control readonlycolor">
                            <span class="error-block"></span>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Total Discount Amount : </b></label>
                        <div class='col-md-8'>
                            <input type="text" readonly name="semester_total_discount_show" value="0" id="semester_total_discount_show" class="form-control readonlycolor">
                            <input type="hidden" readonly name="semester_total_discount" value="0" id="semester_total_discount" class="form-control readonlycolor">
                            <span class="error-block"></span>
                        </div>
                    </div>
                    <br>
                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Discounted Installment(s) Fee : </b></label>
                        <div class='col-md-8'>
                            <input type="text" readonly name="semester_program_discounted_amount_show" id="semester_program_discounted_amount_show" class="form-control readonlycolor">
                            <input type="hidden" readonly name="semester_program_discounted_amount" id="semester_program_discounted_amount" class="form-control readonlycolor">
                            <span class="error-block"></span>
                        </div>
                    </div>
                    <br>
                <div class='row'>
                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Amount : </b></label>
                <div class='col-md-8'>
                <input type="text" readonly name="program_semester_enrollment_final_price_show" id="program_semester_enrollment_final_price_show" class="form-control readonlycolor">
                    <input type="hidden" readonly name="program_semester_enrollment_final_price" id="program_semester_enrollment_final_price" class="form-control readonlycolor">
                    <input type="hidden" readonly name="real_program_semester_enrollment_final_price" id="real_program_semester_enrollment_final_price" class="form-control readonlycolor">
                    <input type="hidden" class="form-control numeric" name="semester_card_fee_amount" value="0" id="semester_card_fee_amount">
                <span class="error-block"></span>
                    <span id="semester_card_dis"></span>
                </div>
                </div>

                <br>
                <div class='row'>
                    <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Pay Amount(Cash Given) :</b></label>
                    <div class='col-md-8'>
                        <input type="text" name="semester_cash_given_a" id="semester_cash_given_a" class="form-control numeric">
                        <input type="hidden" name="semester_cash_given" id="semester_cash_given" class="form-control numeric">
                        <span class="error-block"></span>
                    </div>
                </div>
                <br>
                <div class='row'>
                    <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance Amount :</b></label>
                    <div class='col-md-8'>
                        <input type="text"  value="0" placeholder="0" name="semester_balance_amount" id="semester_balance_amount" class="form-control numeric">
                        <span class="error-block"></span>
                    </div>
                </div>
                <br>
            </div>
                                                    <div id="program_enrollment_custom" style="padding: 4px; border: 2px solid #ffc1c1;">
                                                        <div class='col-md-12'>

                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item"><a class="nav-link active" role="tab" href="#hrmi" data-toggle="tab"> General </a></li>
                                            <li class="nav-item"><a class="nav-link " role="tab" href="#pearson" data-toggle="tab"> Pearson </a></li>
                                        </ul>
                                        <!-- Tab panes -->
                                                            <div class="tab-content tabcontent-border">
                                                                <div class="tab-pane p-20 active" role="tabpanel" id="hrmi">
                                                                    <div  style="padding: 4px; border: 2px solid #ffc1c1;">
                                                                        <h4 style="font-size: 14px;border-bottom: 2px solid #f9860c;">General</h4>
                                    <div class='row'>
                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Currency : </b></label>
                                        <div class='col-md-8'>
                                            <input type="text" readonly name="already_saved_currency" id="already_saved_currency" class="form-control">
                                            <input type="hidden" id="already_saved_currency_id" name="already_saved_currency_id">
                                            <input type="hidden" id="program_enrollment_id" name="program_enrollment_id">
                                            <span class="error-block"></span>
                                        </div>
                                    </div>
                                    <br>
                                <div class='row'>
                                    <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Program Fee : </b></label>
                                    <div class='col-md-8'>
                                        <input type="text" readonly name="add_program_total_amount_show" id="add_program_total_amount_show" class="form-control numeric">
                                        <input type="hidden" readonly name="add_program_total_amount" id="add_program_total_amount" class="form-control numeric" min="1" oninput="validity.valid||(value='');">
                                        <span class="error-block"></span>
                                    </div>
                                </div>
                                <br>
                            <div class='row'>
                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Registration Fee : </b></label>
                                <div class='col-md-8'>
                                <input type="text" readonly name="register_amount_show" id="register_amount_show" class="form-control numeric" min="1">
                                <input type="hidden" readonly name="register_amount" id="register_amount" class="form-control numeric" min="1">
                                <span class="error-block"></span>
                                </div>
                            </div>
                            <br>
                        <div class='row'>
                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Registration Due Date : </b></label>
                            <div class='col-md-8'>
                                <input type="text" readonly name="register_due_date"  id="register_due_date" class="form-control form-control-inline input-medium date-pick" placeholder="(Optional)" size="16" data-date-format="yyyy-mm-dd">
                                <span class="error-block"></span>
                            </div>
                        </div>
                        <br>
                            <div class='row'>
                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Type : </b></label>
                                <div class='col-md-8'>
                                    <select name="discount_type" id="discount_type" class="form-control selectpicker" data-live-search="true">
                                    </select>
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <br>
                        <div class='row'>
                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Amount : </b></label>
                            <div class='col-md-8'>
                                <input type="text" name="discount_amount" id="discount_amount" class="form-control numeric">
                                <span class="error-block"></span>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance for Installments : </b></label>
                            <div class='col-md-8'>
                                <input type="text" readonly name="balance_installments_show" id="balance_installments_show" class="form-control numeric">
                                <input type="hidden" readonly name="balance_installments" id="balance_installments" class="form-control numeric">
                                <span class="error-block"></span>
                            </div>
                        </div>
                        <br>
                        <div class='row'>
                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Pay Amount (LKR) : </b></label>
                            <div class='col-md-8'>
                                <input type="text" readonly name="custom_payable_amount" id="custom_payable_amount" class="form-control numeric">
                                <input type="hidden" readonly name="cus_pay_amount" id="cus_pay_amount" class="form-control numeric">
                                <input type="hidden" readonly name="real_cus_pay_amount" id="real_cus_pay_amount" class="form-control numeric">
                                <input type="hidden" class="form-control numeric" name="custom_card_fee_amount" value="0" id="custom_card_fee_amount">

                                <span class="error-block"></span>
                                <span id="custom_card_dis"></span>
                            </div>
                        </div>

            <br>
            <div class='row'>
                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Pay Amount(Cash Given) :</b></label>
                <div class='col-md-8'>
                    <input type="text" name="custom_cash_given_a" id="custom_cash_given_a" class="form-control numeric">
                    <input type="hidden" name="custom_cash_given" id="custom_cash_given" class="form-control numeric">
                    <span class="error-block"></span>
                </div>
            </div>
            <br>
            <div class='row'>
                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance Amount :</b></label>
                <div class='col-md-8'>
                    <input type="text"  value="0" placeholder="0" name="custom_balance_amount" id="custom_balance_amount" class="form-control numeric">
                    <span class="error-block"></span>
                </div>
            </div>
            <br>
        </div>
                                </div>
                                <div class="tab-pane p-20" role="tabpanel" id="pearson">
                            <div  style="padding: 4px; border: 2px solid #ffc1c1;">
                            <h4 style="font-size: 14px;border-bottom: 2px solid #f9860c;">Pearson</h4>
                            <div class='row'>
                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Pearson E Library Fee : </b></label>
                                <div class='col-md-8'>
                                    <input type="text" readonly name="pearson_e_library_fee_show" id="pearson_e_library_fee_show" class="form-control numeric" min="1" >
                                    <input type="hidden" readonly name="pearson_e_library_fee" id="pearson_e_library_fee" class="form-control numeric" min="1" oninput="validity.valid||(value='');">
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Pearson E Library Due Date : </b></label>
                                <div class='col-md-8'>
                                    <input type="text" readonly name="pearson_e_library_due_date"  id="pearson_e_library_due_date" class="form-control form-control-inline input-medium date-pick" size="16" placeholder="(Optional)" data-date-format="yyyy-mm-dd">
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Pearson Registration Fee : </b></label>
                                <div class='col-md-8'>
                                    <input type="text" readonly name="pearson_registration_fee_show" id="pearson_registration_fee_show" class="form-control numeric" min="1" >
                                    <input type="hidden" name="pearson_registration_fee" id="pearson_registration_fee" class="form-control numeric" min="1" >
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <br>
                            <div class='row'>
                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Pearson Registration Due Date : </b></label>
                                <div class='col-md-8'>
                                    <input type="text" readonly name="pearson_register_due_date"  id="pearson_register_due_date" class="form-control form-control-inline input-medium date-pick" size="16" data-date-format="yyyy-mm-dd">
                                    <span class="error-block"></span>
                                </div>
                            </div>
                            <br>

                            </div>
                            </div>
                                </div>
                            </div>




                <div class="col-sm-6 col-lg-4">
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="checkbox" checked class="custom-control-input" id="customRadio" name="customRadio" onchange="checkAddress()">
                            <label class="custom-control-label" for="customRadio">Registration Fee</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="checkbox" checked class="custom-control-input" id="customRadio3" name="customRadio3" onchange="checkAddress()">
                            <label class="custom-control-label" for="customRadio3">Pearson E Library Fee</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="checkbox" class="custom-control-input" id="customRadio2"  name="customRadio2" onchange="checkAddress()">
                            <label class="custom-control-label" for="customRadio2">Pearson Registration Fee</label>
                        </div>

                    </div>
                </div>
                    <div class="row">
                            <div class="col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for="">Installments</label>
                                    <input type="number" name="installment_c" id="installment_c" class="form-control" maxlength="2" max="48" min="1" minlength="1">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <!--                                                                        <label for="">Due Date (1st of Set)</label>-->
                                    <input type="hidden" name="due_d" id="due_d" class="form-control date-pick" data-date-format="yyyy-mm-dd">
                                    <!--                                                                    <input type="text" name="due_d" id="due_d" class="form-control date-pick" data-date-format="yyyy-mm-dd" maxlength="2" max="31" min="1" minlength="1">-->
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="form-group">
                                    <!--                                                                        <label for="">Installment Amount</label>-->
                                    <input type="hidden" name="installment_a" id="installment_a" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <!--                                                                        <label for="">Late Amount</label>-->
                                    <input type="hidden" name="late_a" id="late_a" class="form-control" value="100.00">
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-2">
                                <div class="form-group">
                                    <label for=""></label>
                                    <a id="monthly_addButton" href="#" class="btn btn-success form-control"><i class="fa fa-plus"></i> Add</a>
                                </div>
                            </div>
                        </div>
                    <div class='row'>
                        <!--  <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance to add : </b></label>-->
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
                                                        <br>
                                                        <div id="online_bnk" style="display: none;">
                                                            <div class='row'>
                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Reference Number : </b></label>
                                                                <div class='col-md-8'>
                                                                    <input type="text" class="form-control numeric" name="online_bank_ref_number" id="online_bank_ref_number" oninput="validity.valid||(value='');">
                                                                    <span class="error-block"></span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>

                                                        <div id="card_no" style="display: none;">
                                                            <div class='row'>
                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Card Last Digits : </b></label>
                                                                <div class='col-md-8'>
                                                                    <input type="text" class="form-control numeric" name="card_payment_digits" placeholder="Enter Last 4 Digits" id="card_payment_digits" oninput="validity.valid||(value='');">
                                                                    <span class="error-block"></span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>

                                                        <div id="check_no" style="display: none;">
                                                            <div class='row'>
                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Cheque number : </b></label>
                                                                <div class='col-md-8'>
                                                                    <input type="text" class="form-control numeric" name="add_cheque_number" placeholder="Enter Cheque Number" id="add_cheque_number" oninput="validity.valid||(value='');">
                                                                    <span class="error-block"></span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                        </div>

                                                        <div id="bnk_date" style="display: none;">
                                                            <div class='row'>
                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Bank Date : </b></label>
                                                                <div class='col-md-8'>
                                                                    <input type="text" name="bank_date" id="bank_date" class="form-control form-control-inline input-medium date-pick" size="16" data-date-format="yyyy-mm-dd">
                                                                    <span class="error-block"></span>
                                                                </div>
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
                        $('#discount_type').change(function () {
                            var discount_type =$(this).val();
                            if (discount_type==""){
                                document.getElementById("discount_amount").readOnly = true;
                                $('#discount_amount').val(0);
                            }else{
                                document.getElementById("discount_amount").readOnly = false;
                            }
                        });
                        function checkAddress()
                        {
                            var e_lib=0;
                            var p_reg=0;
                            var reg=0;
                            var tt=0;
                            var tt_a=0;
                            var cr=1;
                            var cr_a=document.getElementById("payable_currency_rate").value;
                            if(cr_a != '' && cr_a != null){
                                cr=document.getElementById("payable_currency_rate").value;
                            }else{
                                cr=1;
                            }


                            if (customRadio2.checked) {
                                p_reg=document.getElementById("pearson_registration_fee").value;
                            }
                            else{
                                p_reg=0;
                            }
                            if (customRadio3.checked)
                            {
                                e_lib=document.getElementById("pearson_e_library_fee").value;
                            }else{
                                e_lib=0;
                            }
                            if (customRadio.checked) {
                                reg=document.getElementById("register_amount").value;
                            }
                            else{
                                reg=0;
                            }

                            $('#custom_cash_given_a').val(0);
                            $('#custom_cash_given').val(0);
                            $('#custom_balance_amount').val(0);


                            tt=parseFloat(e_lib)+parseFloat(p_reg)+parseFloat(reg);
                            tt_a=parseFloat(tt)*parseFloat(cr);
                            $('#custom_payable_amount').val(thousands_separators(tt_a.toFixed(2)));
                            $('#cus_pay_amount').val(tt_a.toFixed(2));
                            $('#real_cus_pay_amount').val(tt_a.toFixed(2));
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

                            var tot_amt_raw = $('#add_program_total_amount').val();
                            tot_amt = $('#add_program_total_amount').val();
                            var reg_amt = $('#register_amount').val();

                            if(monthly_counter>48||installment_c>48){
                                bootbox.alert("Only 48 Installments allowed");
                                return false;
                            }

                            if(tot_amt_raw==""||tot_amt_raw==0){
                                bootbox.alert("Please Check Program Fee before add Custom Installments");
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
                                    '<td><input type="text" placeholder="Amount" class="form-control" name="custom_amount[]" style="width: 100px;" value=""></td>' +
                                    '<td><input type="text" placeholder="Late Levy" class="form-control" name="custom_late[]" style="width: 100px;" value="'+late_a+'"></td>' +
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
                    <script>
                        function clearInputs(){
                            $('#already_saved_currency').val('');
                            $('#already_saved_currency_id').val('');
                            $('#program_enrollment_id').val('');
                            $('#program_total_amount').val('0');
                            $('#add_program_total_amount').val('0');
                            $('#add_program_total_amount_show').val('0');
                            $('#register_amount').val('0');
                            $('#register_amount_show').val('0');
                            $('#register_due_date').val('');
                            $('#balance_installments').val('0');
                            $('#balance_installments_show').val('0');

                            $('#pearson_e_library_fee').val('0');
                            $('#pearson_e_library_fee_show').val('0');
                            $('#pearson_e_library_due_date').val('0');
                            $('#pearson_registration_fee').val('0');
                            $('#pearson_register_due_date').val('0');

                            $('#discount_amount').val('0');
                            $('#discount_type').val('1');


                            $('#program_full_enrollment_total_amount').val('0');
                            $('#program_full_enrollment_total_amount_show').val('0');
                            $('#program_full_register_amount').val('0');
                            $('#program_full_register_amount_show').val('0');
                            $('#full_installment_discount').val('0');
                            $('#full_installment_discount_show').val('0');
                            $('#full_total_discount').val('0');
                            $('#full_total_discount_show').val('0');
                            $('#full_program_discounted_amount').val('0');
                            $('#full_program_discounted_amount_show').val('0');
                            $('#program_full_final_price').val('0');
                            $('#real_program_full_final_price').val('0');
                            $('#program_full_final_price_show').val('0');
                            $('#full_cash_given').val('0');
                            $('#full_cash_given_a').val('0');
                            $('#full_balance_amount').val('0');
                            $('#program_enrollment_full_plan').val('');
                            $('.selectpicker').selectpicker('refresh');


                            $('#program_monthly_enrollment_total_amount').val('0');
                            $('#program_monthly_enrollment_total_amount_show').val('0');
                            $('#program_monthly_register_amount').val('0');
                            $('#program_monthly_register_amount_show').val('0');
                            $('#monthly_program_discounted_amount').val('0');
                            $('#monthly_program_discounted_amount_show').val('0');
                            $('#monthly_total_discount').val('0');
                            $('#monthly_total_discount_show').val('0');
                            $('#total_monthly_enrollment_discount').val('0');
                            $('#total_monthly_enrollment_discount_show').val('0');
                            $('#program_monthly_enrollment_final_price').val('0');
                            $('#real_program_monthly_enrollment_final_price').val('0');
                            $('#program_monthly_enrollment_final_price_show').val('0');
                            $('#monthly_cash_given').val('0');
                            $('#monthly_cash_given_a').val('0');
                            $('#monthly_balance_amount').val('0');
                            $('#program_enrollment_monthly_plan').val('');
                            $('.selectpicker').selectpicker('refresh');

                            $('#program_semester_enrollment_total_amount').val('0');
                            $('#program_semester_enrollment_total_amount_show').val('0');
                            $('#program_semester_register_amount').val('0');
                            $('#program_semester_register_amount_show').val('0');
                            $('#total_semester_enrollment_discount').val('0');
                            $('#total_semester_enrollment_discount_show').val('0');
                            $('#semester_total_discount').val('0');
                            $('#semester_total_discount_show').val('0');
                            $('#semester_program_discounted_amount').val('0');
                            $('#semester_program_discounted_amount_show').val('0');
                            $('#program_semester_enrollment_final_price').val('0');
                            $('#real_program_semester_enrollment_final_price').val('0');
                            $('#program_semester_enrollment_final_price_show').val('0');
                            $('#semester_cash_given').val('0');
                            $('#semester_cash_given_a').val('0');
                            $('#semester_balance_amount').val('0');
                            $('#program_enrollment_semester_plan').val('');
                            $('.selectpicker').selectpicker('refresh');
                        }


                        $('#currency_type').change(function(){

                            clearInputs();
                            var currency_type =$(this).val();
                            var payable_currency_type = document.getElementById("payable_currency_type").value;
                            var program_enrollment_date = document.getElementById("program_enrollment_date").value;
                            var program_enrollment_plan = document.getElementById("program_enrollment_plan").value;
                            load_currency_data(currency_type,program_enrollment_date);
                            if (currency_type==1){

                                enroll_data(program_enrollment_plan);
                            }else{
                                enroll_data(program_enrollment_plan);
                                // load_currency_data(currency_type,program_enrollment_date);
                                // if (payable_currency_type==""){
                                //     $('[name="validation_currency"]').val('');
                                //     $('[name="currency_type"]').val('1');
                                //     $('.selectpicker').selectpicker('refresh');
                                //     alert("Please Set Current Currency Rate.");
                                // }else{
                                //
                                // }
                            }


                        });

                        function enroll_program(id){
                            $('#payable_currency_type').val('');
                            $('#payable_currency_id').val('');
                            $('#payable_currency_rate').val('');
                            var p_date = document.getElementById("program_enrollment_date").value;
                            document.getElementById("discount_amount").readOnly = true;
                            program_enrollment_custom.style.display = "none";
                            program_enrollment_full_payment.style.display = "none";
                            program_enrollment_monthly_payment.style.display = "none";
                            program_enrollment_semester.style.display = "none";
                            $('#program_enrollment_form')[0].reset();
                            $('.selectpicker').selectpicker('refresh');
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

                                    var program_enrollment_date = document.getElementById("program_enrollment_date").value;
                                    load_currency_data("2",program_enrollment_date);

                                    $('#program_enrollment_date').change(function(){
                                        clearInputs();
                                        $('#payable_currency_type').val('');
                                        $('#payable_currency_id').val('');
                                        $('#payable_currency_rate').val('');
                                        var p_date=$(this).val();
                                        var ep = document.getElementById("enrolling_program").value;
                                        var eb = document.getElementById("program_enrollment_batch").value;
                                        var ei = document.getElementById("program_enrollment_intake").value;
                                        var currency_type = document.getElementById("currency_type").value;

                                        load_currency_data(currency_type,p_date);
                                    });
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
                            $('#program_enrollment_modal').modal({backdrop: 'static', keyboard: false});

                        }

                        function load_currency_data(currency_type,program_enrollment_date){
                            //load convert currency details
                            // $.ajax({
                            //     url: "<?php echo base_url('payments/payments_con/convert_data_for_enrollment');?>",
                            //     type: "POST",
                            //     dataType: "JSON",
                            //     data:{
                            //         "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                            //         "payment_date":program_enrollment_date,
                            //         "currency_id":currency_type,

                            //     },
                            //     success:function(data){

                            //         if (data.past_date==null){
                            //             if (data.convert_data==null){
                            //                 // load_currency_convert(late_currency_id);
                            //                 if (data.currency_id==1){

                            //                     $('[name="validation_currency"]').val(data.currency_id);
                            //                 }else{
                            //                     $('[name="validation_currency"]').val('');
                            //                     alert("Please Set Current Currency Rate.");

                            //                 }

                            //             }
                            //             else {
                            //                 $('[name="validation_currency"]').val(data.currency_id);
                            //                 $('[name="payable_currency_type"]').val("LKR "+data.convert_data.currency_value);
                            //                 $('[name="payable_currency_id"]').val(data.convert_data.id);
                            //                 $('[name="payable_currency_rate"]').val(data.convert_data.currency_value);

                            //                 var currency_value=data.convert_data.currency_value;

                            //                 // var tot=parseFloat(total_late_levy_amount)+parseFloat(late_tot_val)-parseFloat(late_total_dis);
                            //                 // var x=parseFloat(tot)*parseFloat(currency_value);
                            //                 // $('[name="final_late_levy_amount"]').val(thousands_separators(x.toFixed(2)));
                            //             }
                            //         }else{
                            //             $('[name="validation_currency"]').val(data.currency_id);
                            //             $('[name="payable_currency_type"]').val("LKR "+data.past_date.currency_value);
                            //             $('[name="payable_currency_id"]').val(data.past_date.id);
                            //             $('[name="payable_currency_rate"]').val(data.past_date.currency_value);

                            //         }



                            //     },
                            //     error: function (jqXHR, textStatus, errorThrown) {
                            //         bootbox.alert(textStatus + " : " + errorThrown);
                            //         console.log(jqXHR);
                            //         console.log(textStatus);
                            //         console.log(errorThrown);
                            //     }
                            // });
                        }
                        function load_payment_plans(program_id) {
                                // $.ajax({
                                //     url: "<?php echo base_url('payments/Program_fee/get_payment_plan_info_withCustom');?>",
                                //     type: "POST",
                                //     dataType: "JSON",
                                //     data:{
                                //         "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                //     },
                                //     success:function(data){

                                //         $('#program_enrollment_plan').html('<option value="">--Select Payment Plan--</option>');
                                //         for(var i=0;i<data.plans.length;i++){
                                //             $('#program_enrollment_plan').append('<option value="'+data.plans[i].id+','+program_id+'">'+data.plans[i].name+'</option>');
                                //         }

                                //         $('.selectpicker').selectpicker('refresh');
                                //     },
                                //     error: function (jqXHR, textStatus, errorThrown) {
                                //         bootbox.alert(textStatus + " : " + errorThrown);
                                //         console.log(jqXHR);
                                //         console.log(textStatus);
                                //         console.log(errorThrown);
                                //     }
                                // });
                        }
                        $('#program_enrollment_plan').change(function(){
                            $('#program_enrollment_method').val('');
                            enroll_data($(this).val());

                        });
                        function enroll_data(enrol_id){

                            clearInputs();
                            $('#payable_currency_type').val('');
                            $('#payable_currency_id').val('');
                            $('#payable_currency_rate').val('');
                            var p_d=document.getElementById("program_enrollment_date").value;
                            var ep = document.getElementById("enrolling_program").value;
                            var eb = document.getElementById("program_enrollment_batch").value;
                            var ei = document.getElementById("program_enrollment_intake").value;
                            var currency_type = document.getElementById("currency_type").value;
                            load_currency_data(currency_type,p_d);
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

                            var plan_id =enrol_id;
                            var enro= plan_id.split(",");
                            var payment_id = enro[0];
                            var programme = enro[1];

                            switch (payment_id) {
                                case "1":
                                    program_enrollment_custom.style.display = "none";
                                    program_enrollment_full_payment.style.display = "block";
                                    program_enrollment_monthly_payment.style.display = "none";
                                    program_enrollment_semester.style.display = "none";

                                    //load program Full payment details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_full_payment_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":plan_id,
                                            "student":program_enrollment_student,
                                            "currency_id":currency_type,
                                        },
                                        success:function(data){
                                            $('#program_enrollment_full_plan').html('<option disabled value="0">--Select Full Payment Plan(s)--</option>');
                                            for(var i=0;i<data.full.length;i++){
                                                $('#program_enrollment_full_plan').append('<option value="'+data.full[i].installment_id+','+data.full[i].amount+','+data.full[i].installment_type+','+data.full[i].currency_id+','+data.full[i].program_fee_id+','+data.full[i].discount_amount+'">'+data.full[i].installment+' - '+data.full[i].price+'</option>');
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
                                    $('#program_enrollment_full_plan').change(function(){
                                        $('#program_full_final_price').val('0');
                                        $('#real_program_full_final_price').val('0');
                                        $('#program_full_final_price_show').val('0');
                                        $('#full_cash_given').val('0');
                                        $('#full_cash_given_a').val('0');
                                        $('#full_balance_amount').val('0');

                                        var payable_currency_rate=document.getElementById("payable_currency_rate").value;
                                        var full_plan_details =$(this).val();
                                        var tot_val=0;
                                        var reg_val=0;
                                        var dis_val=0;
                                        var type_val="";
                                        var split_val;
                                        for(var j=0; j<full_plan_details.length; j++){
                                            //calculating total without registration fee
                                            split_val = full_plan_details[j].split(",");
                                            var program_fee_id=split_val[4];
                                            var full_currency_id=split_val[3];
                                            var def_discount=split_val[5];
                                            if (split_val[2]!="null"){
                                                reg_val=reg_val+parseFloat(split_val[1]);
                                            }else {
                                                tot_val = tot_val+parseFloat(split_val[1]);
                                                dis_val = dis_val+parseFloat(split_val[5]);
                                            }
                                        }
                                        split_val = "";

                                        var tot_f_dis = parseFloat(dis_val);

                                        var full_program_discounted_amount=parseFloat(tot_val)-parseFloat(tot_f_dis);

                                        var full_currency_rate=1;
                                        if (full_currency_id==1){
                                            full_currency_rate=1;
                                        }else{
                                            full_currency_rate=payable_currency_rate;
                                        }

                                        var pr_full_final_price=parseFloat(full_program_discounted_amount+reg_val)*parseFloat(full_currency_rate);
                                        var f_total_discount=parseFloat(tot_f_dis)*parseFloat(full_currency_rate);
                                        var full_reg_amount=parseFloat(reg_val)*parseFloat(full_currency_rate);
                                        var full_ins_discount=parseFloat(dis_val)*parseFloat(full_currency_rate);
                                        var full_pr_dis_amount=parseFloat(full_program_discounted_amount)*parseFloat(full_currency_rate);
                                        var pr_full_enrollment_tot_amt=parseFloat(tot_val)*parseFloat(full_currency_rate);

                                        $('[name="full_installment_discount"]').val(full_ins_discount.toFixed(2));
                                        $('[name="full_total_discount"]').val(f_total_discount.toFixed(2));
                                        $('[name="program_full_register_amount"]').val(full_reg_amount.toFixed(2));
                                        $('[name="program_full_enrollment_total_amount"]').val(pr_full_enrollment_tot_amt.toFixed(2));
                                        $('[name="full_program_discounted_amount"]').val(full_pr_dis_amount.toFixed(2));
                                        $('[name="program_full_fee_id"]').val(program_fee_id);
                                        $('[name="program_full_final_price"]').val(pr_full_final_price.toFixed(2));
                                        $('[name="real_program_full_final_price"]').val(pr_full_final_price.toFixed(2));

                                        $('[name="full_installment_discount_show"]').val(thousands_separators(full_ins_discount.toFixed(2)));
                                        $('[name="full_total_discount_show"]').val(thousands_separators(f_total_discount.toFixed(2)));
                                        $('[name="program_full_register_amount_show"]').val(thousands_separators(full_reg_amount.toFixed(2)));
                                        $('[name="program_full_enrollment_total_amount_show"]').val(thousands_separators(pr_full_enrollment_tot_amt.toFixed(2)));
                                        $('[name="full_program_discounted_amount_show"]').val(thousands_separators(full_pr_dis_amount.toFixed(2)));
                                        $('[name="program_full_final_price_show"]').val(thousands_separators(pr_full_final_price.toFixed(2)));
                                    });
                                    break;
                                case "2":
                                    program_enrollment_custom.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "block";
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_semester.style.display = "none";

                                    //load program monthly payment details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_monthly_payment_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":plan_id,
                                            "student":program_enrollment_student,
                                            "currency_id":currency_type,
                                        },
                                        success:function(data){
                                            $('#program_enrollment_monthly_plan').html('<option value="0">--Select Monthly Plan--</option>');
                                            for(var i=0;i<data.monthly.length;i++){
                                                $('#program_enrollment_monthly_plan').append('<option value="'+data.monthly[i].installment_id+','+data.monthly[i].amount+','+data.monthly[i].installment_type+','+data.monthly[i].currency_id+','+data.monthly[i].program_fee_id+','+data.monthly[i].discount_amount+'">'+data.monthly[i].installment+' - '+data.monthly[i].price+'</option>');
                                            }

                                            $('.selectpicker').selectpicker('refresh');
                                            $('#monthly_num_rows').val(data.monthly_count);


                                            var per_ins_month=parseFloat(0)/parseFloat(data.monthly_count);
                                            $('#per_monthly_intallment').val(parseFloat(per_ins_month).toFixed(2));

                                            $('#per_m_ins_amount').val(parseFloat(per_ins_month).toFixed(2));





                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                                    $('#program_enrollment_monthly_plan').change(function(){
                                        $('#monthly_cash_given').val('0');
                                        $('#monthly_cash_given_a').val('0');
                                        $('#monthly_balance_amount').val('0');
                                        var payable_monthly_currency_rate=document.getElementById("payable_currency_rate").value;
                                        var monthly_plan_details =$(this).val();
                                        var tot_val=0;
                                        var reg_val=0;
                                        var m_dis_val=0;
                                        var type_val="";
                                        var split_val;
                                        var mnth_ins_c=0;
                                        for(var j=0; j<monthly_plan_details.length; j++){
                                            //calculating total without registration fee
                                            split_val = monthly_plan_details[j].split(",");
                                            var program_fee_id=split_val[4];
                                            var monthly_currency_id=split_val[3];
                                            var def_discount=split_val[5];
                                            if (split_val[2]!="null"){
                                                reg_val=reg_val+parseFloat(split_val[1]);
                                                mnth_ins_c=mnth_ins_c+0;
                                            }else {
                                                tot_val = tot_val+parseFloat(split_val[1]);
                                                m_dis_val = m_dis_val+parseFloat(split_val[5]);
                                                mnth_ins_c=mnth_ins_c+1;
                                            }
                                        }





                                        var tot_m_dis = parseFloat(m_dis_val.toFixed(2));
                                        //var tot_m_dis = parseFloat(m_dis_val);
                                        var monthly_program_discounted_amount=parseFloat(tot_val)-parseFloat(tot_m_dis);

                                        var monthly_currency_rate=1;
                                        if (monthly_currency_id==1){
                                            monthly_currency_rate=1;
                                        }else{
                                            monthly_currency_rate=payable_monthly_currency_rate;
                                        }
                                        split_val = "";
                                        var reg_amt=parseFloat(reg_val)*parseFloat(monthly_currency_rate);
                                        var mn_en_amt=parseFloat(tot_val)*parseFloat(monthly_currency_rate);
                                        var dn_en_amt=parseFloat(m_dis_val.toFixed(2))*parseFloat(monthly_currency_rate);
                                        var tot_dis_amt=parseFloat(tot_m_dis)*parseFloat(monthly_currency_rate);
                                        var mn_dis_amt=parseFloat(monthly_program_discounted_amount.toFixed(2))*parseFloat(monthly_currency_rate);
                                        var final_amt_a=parseFloat(monthly_program_discounted_amount+reg_val)*parseFloat(monthly_currency_rate);
                                        var final_amt=final_amt_a.toFixed(2);

                                        $('[name="program_monthly_register_amount"]').val(reg_amt.toFixed(2));
                                        $('[name="program_monthly_enrollment_total_amount"]').val(mn_en_amt.toFixed(2));
                                        $('[name="total_monthly_enrollment_discount"]').val(dn_en_amt.toFixed(2));
                                        $('[name="monthly_total_discount"]').val(tot_dis_amt.toFixed(2));
                                        $('[name="monthly_program_discounted_amount"]').val(mn_dis_amt.toFixed(2));
                                        $('[name="program_monthly_fee_id"]').val(program_fee_id);
                                        $('[name="program_monthly_enrollment_final_price"]').val(final_amt);
                                        $('[name="real_program_monthly_enrollment_final_price"]').val(final_amt);

                                        $('[name="program_monthly_register_amount_show"]').val(thousands_separators(reg_amt.toFixed(2)));
                                        $('[name="program_monthly_enrollment_total_amount_show"]').val(thousands_separators(mn_en_amt.toFixed(2)));
                                        $('[name="total_monthly_enrollment_discount_show"]').val(thousands_separators(dn_en_amt.toFixed(2)));
                                        $('[name="monthly_total_discount_show"]').val(thousands_separators(tot_dis_amt.toFixed(2)));
                                        $('[name="monthly_program_discounted_amount_show"]').val(thousands_separators(mn_dis_amt.toFixed(2)));
                                        $('[name="program_monthly_enrollment_final_price_show"]').val(thousands_separators(final_amt));
                                    });
                                    break;
                                case "3":
                                    program_enrollment_custom.style.display = "none";
                                    program_enrollment_semester.style.display = "block";
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "none";

                                    //load program semester payment details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_semester_payment_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":plan_id,
                                            "student":program_enrollment_student,
                                            "currency_id":currency_type,
                                        },
                                        success:function(data){
                                            $('#program_enrollment_semester_plan').html('<option disabled value="0">--Select Semester Plan--</option>');
                                            for(var i=0;i<data.semesters.length;i++){
                                                $('#program_enrollment_semester_plan').append('<option value="'+data.semesters[i].installment_id+','+data.semesters[i].amount+','+data.semesters[i].installment_type+','+data.semesters[i].currency_id+','+data.semesters[i].program_fee_id+','+data.semesters[i].discount_amount+'">'+data.semesters[i].installment+' - '+data.semesters[i].price+'</option>');
                                            }

                                            $('.selectpicker').selectpicker('refresh');

                                            $('#semester_num_rows').val(data.semester_count);

                                            var per_ins_semester=parseFloat(0)/parseFloat(data.semester_count);
                                            $('#per_semester_intallment').val(parseFloat(per_ins_semester).toFixed(2));
                                            $('#per_s_ins_amount').val(parseFloat(per_ins_semester).toFixed(2));



                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });

                                    $('#program_enrollment_semester_plan').change(function(){
                                        $('#semester_cash_given').val('0');
                                        $('#semester_cash_given_a').val('0');
                                        $('#semester_balance_amount').val('0');
                                        var payable_sem_currency_rate=document.getElementById("payable_currency_rate").value;
                                        $('#program_semester_enrollment_discount').empty();

                                        var semester_plan_details =$(this).val();
                                        var tot_val=0;
                                        var reg_val=0;
                                        var s_dis_val=0;
                                        var type_val="";
                                        var split_val;
                                        var sem_ins_c=0;
                                        for(var j=0; j<semester_plan_details.length; j++){
                                            //calculating total without registration fee
                                            split_val = semester_plan_details[j].split(",");
                                            var program_fee_id=split_val[4];
                                            var sem_currency_id=split_val[3];
                                            var semester_dis=split_val[5];
                                            if (split_val[2]!="null"){
                                                reg_val=reg_val+parseFloat(split_val[1]);
                                                sem_ins_c=sem_ins_c+0;
                                            }else {
                                                tot_val = tot_val+parseFloat(split_val[1]);
                                                s_dis_val = s_dis_val+parseFloat(split_val[5]);
                                                sem_ins_c=sem_ins_c+1;
                                            }
                                        }

                                        var sem_currency_rate=1;
                                        if (sem_currency_id==1){
                                            sem_currency_rate=1;
                                        }else{
                                            sem_currency_rate=payable_sem_currency_rate;
                                        }

                                        split_val = "";


                                        // var tot_s_dis = parseFloat(s_dis_val);


                                        var reg_amt=parseFloat(reg_val)*parseFloat(sem_currency_rate);
                                        var sm_en_amt=parseFloat(tot_val)*parseFloat(sem_currency_rate);
                                        var tot_s_dis = parseFloat(s_dis_val.toFixed(2))*parseFloat(sem_currency_rate);
                                        var semester_program_discounted_amount=parseFloat(tot_val)*parseFloat(sem_currency_rate)-parseFloat(tot_s_dis);
                                        var final_v=parseFloat(semester_program_discounted_amount+reg_amt);
                                        var final_amt=final_v.toFixed(2);



                                        $('[name="program_semester_register_amount"]').val(reg_amt.toFixed(2));
                                        $('[name="program_semester_enrollment_total_amount"]').val(sm_en_amt.toFixed(2));
                                        $('[name="program_semester_fee_id"]').val(program_fee_id);
                                        $('[name="total_semester_enrollment_discount"]').val(s_dis_val.toFixed(2));
                                        $('[name="semester_total_discount"]').val(tot_s_dis.toFixed(2));
                                        $('[name="semester_program_discounted_amount"]').val(semester_program_discounted_amount.toFixed(2));
                                        $('[name="program_semester_enrollment_final_price"]').val(final_amt);
                                        $('[name="real_program_semester_enrollment_final_price"]').val(final_amt);

                                        $('[name="program_semester_register_amount_show"]').val(thousands_separators(reg_amt.toFixed(2)));
                                        $('[name="program_semester_enrollment_total_amount_show"]').val(thousands_separators(sm_en_amt.toFixed(2)));
                                        $('[name="total_semester_enrollment_discount_show"]').val(thousands_separators(s_dis_val.toFixed(2)));
                                        $('[name="semester_total_discount_show"]').val(thousands_separators(tot_s_dis.toFixed(2)));
                                        $('[name="semester_program_discounted_amount_show"]').val(thousands_separators(semester_program_discounted_amount.toFixed(2)));
                                        $('[name="program_semester_enrollment_final_price_show"]').val(thousands_separators(final_amt));

                                    });
                                    break;
                                case "4":

                                    program_enrollment_custom.style.display = "block";
                                    program_enrollment_semester.style.display = "none";
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "none";

                                    var b = document.getElementById("program_enrollment_batch").value;
                                    var p = document.getElementById("enrolling_program").value;
                                    var i = document.getElementById("program_enrollment_intake").value;

                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_finance_info_for_custom');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "batch_id":b,
                                            "program_id":p,
                                            "intake_id":i,
                                            "currency_id":currency_type,
                                        },
                                        success:function(data){
                                            var payable_cus_currency_rate=document.getElementById("payable_currency_rate").value;
                                            $('[name="program_total_amount"]').val(data.finance[0].full_program_fee);
                                            $('[name="add_program_total_amount"]').val(data.finance[0].full_program_fee);
                                            $('[name="add_program_total_amount_show"]').val(thousands_separators(parseFloat(data.finance[0].full_program_fee)));
                                            $('[name="balance_installments"]').val(parseFloat(data.finance[0].full_program_fee)-parseFloat(data.finance[0].discount_amount));
                                            $('[name="balance_installments_show"]').val(thousands_separators(parseFloat(data.finance[0].full_program_fee)-parseFloat(data.finance[0].discount_amount)));
                                            $('[name="register_amount"]').val(data.finance[0].register_amount);
                                            $('[name="register_amount_show"]').val(thousands_separators(parseFloat(data.finance[0].register_amount)));
                                            $('[name="register_due_date"]').val(data.finance[0].register_due_date);
                                            $('[name="already_saved_currency_id"]').val(data.finance[0].currency_id);
                                            $('[name="already_saved_currency"]').val(data.finance[0].currency_type);
                                            $('[name="program_enrollment_id"]').val(data.finance[0].id);

                                            $('#pearson_e_library_fee').val(data.finance[0].pearson_e_library_fee);
                                            $('#pearson_e_library_fee_show').val(thousands_separators(data.finance[0].pearson_e_library_fee));
                                            $('#pearson_e_library_due_date').val(data.finance[0].pearson_e_library_due_date);
                                            $('#pearson_registration_fee').val(data.finance[0].pearson_registration_fee);
                                            $('#pearson_registration_fee_show').val(thousands_separators(data.finance[0].pearson_registration_fee));


                                            var custom_currency_rate=1;
                                            if (data.finance[0].currency_id ==1){
                                                custom_currency_rate=1;
                                            }else{
                                                custom_currency_rate=payable_cus_currency_rate;
                                            }
                                            var rg=parseFloat(data.finance[0].register_amount)+parseFloat(data.finance[0].pearson_e_library_fee);
                                            $('#custom_payable_amount').val(thousands_separators(parseFloat(rg)*parseFloat(custom_currency_rate)));
                                            $('#cus_pay_amount').val(parseFloat(rg)*parseFloat(custom_currency_rate));
                                            $('#real_cus_pay_amount').val(parseFloat(rg)*parseFloat(custom_currency_rate));

                                            $('#pearson_register_due_date').val(data.finance[0].pearson_register_due_date);

                                            $('#discount_amount').val(data.finance[0].discount_amount);
                                            $('#discount_type').val(data.finance[0].discount_type_id);
                                            $('.selectpicker').selectpicker('refresh');


                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            bootbox.alert(textStatus + " : " + errorThrown);
                                            console.log(jqXHR);
                                            console.log(textStatus);
                                            console.log(errorThrown);
                                        }
                                    });
                                    break;
                                default:
                                    $('#program_enrollment_form')[0].reset();
                                    $('.selectpicker').selectpicker('refresh');
                                    $('#program_enrollment_account').empty();
                                    $('#program_monthly_enrollment_discount').empty();
                                    program_enrollment_full_payment.style.display = "none";
                                    program_enrollment_monthly_payment.style.display = "none";
                                    program_enrollment_semester.style.display = "none";
                                    program_enrollment_custom.style.display = "none";
                            }


                        }


                        // load Discount type
                        // $.ajax({
                        //     url: "<?php echo base_url('payments/Program_fee/get_discount_info');?>",
                        //     type: "POST",
                        //     dataType: "JSON",
                        //     data:{
                        //         "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                        //     },
                        //     success:function(data){

                        //         $('#discount_type').html('<option value="">--Select Discount Type--</option>');
                        //         for(var i=0;i<data.discount.length;i++){
                        //             $('#discount_type').append('<option value="'+data.discount[i].id+'">'+data.discount[i].discount_name+'</option>');
                        //         }
                        //         $('.selectpicker').selectpicker('refresh');
                        //     },
                        //     error: function (jqXHR, textStatus, errorThrown) {
                        //         bootbox.alert(textStatus + " : " + errorThrown);
                        //         console.log(jqXHR);
                        //         console.log(textStatus);
                        //         console.log(errorThrown);
                        //     }
                        // });
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


                        var bnk_id = document.getElementById("bnk_id");

                        program_enrollment_full_payment.style.display = "none";
                        program_enrollment_monthly_payment.style.display = "none";
                        program_enrollment_semester.style.display = "none";
                        program_enrollment_custom.style.display = "none";

                        bnk_id.style.display = "none";



                        $('#program_enrollment_method').change(function(){

                           var type= document.getElementById("program_enrollment_plan").value;
                            var enro= type.split(",");
                            var payment_id = enro[0];

                            var y=0;
                            var main_amount=0;
                            var show_name="";
                            var real_show_name="";
                            var card_name="";
                            var card_fee_amount="";
                            if(payment_id==1){
                                $('#full_card_fee_amount').val(0);
                                main_amount = document.getElementById("program_full_final_price").value;
                                y=parseFloat(main_amount);
                                show_name="program_full_final_price_show";
                                real_show_name="real_program_full_final_price";
                                card_name="full_card_dis";
                                card_fee_amount="full_card_fee_amount";

                            }else if(payment_id==2){
                                $('#monthly_card_fee_amount').val(0);
                                main_amount = document.getElementById("program_monthly_enrollment_final_price").value;
                                y=parseFloat(main_amount);
                                show_name="program_monthly_enrollment_final_price_show";
                                real_show_name="real_program_monthly_enrollment_final_price";
                                card_name="monthly_card_dis";
                                card_fee_amount="monthly_card_fee_amount";

                            }else if(payment_id==3){
                                $('#semester_card_fee_amount').val(0);
                                main_amount = document.getElementById("program_semester_enrollment_final_price").value;
                                y=parseFloat(main_amount);
                                show_name="program_semester_enrollment_final_price_show";
                                real_show_name="real_program_semester_enrollment_final_price";
                                card_name="semester_card_dis";
                                card_fee_amount="semester_card_fee_amount";
                            }else{
                                $('#custom_card_fee_amount').val(0);
                                main_amount = document.getElementById("cus_pay_amount").value;
                                y=parseFloat(main_amount);
                                show_name="custom_payable_amount";
                                real_show_name="real_cus_pay_amount";
                                card_name="custom_card_dis";
                                card_fee_amount="custom_card_fee_amount";
                            }




                            load_banks($(this).val());
                            $('#program_enrollment_account').empty();

                            if ($(this).val()==3){
                                $('[name="'+show_name+'"]').val(thousands_separators(y.toFixed(2)));
                                $('[name="'+real_show_name+'"]').val(y.toFixed(2));
                                $('#'+card_name).empty();

                                $('#online_bnk').show();
                                $('#bnk_date').show();
                                $('#card_no').hide();
                                $('#check_no').hide();
                            }else if ($(this).val()==2){
                                $('[name="'+show_name+'"]').val(thousands_separators(y.toFixed(2)));
                                $('[name="'+real_show_name+'"]').val(y.toFixed(2));
                                $('#'+card_name).empty();

                                $('#bnk_date').show();
                            }
                            else if ($(this).val()==4){
                                $('#online_bnk').hide();
                                $('#bnk_date').hide();
                                $('#check_no').hide();
                                $('#card_no').show();

                                $('#full_cash_given').val('0');
                                $('#full_cash_given_a').val('0');
                                $('#full_balance_amount').val('0');

                                $('#monthly_cash_given').val('0');
                                $('#monthly_cash_given_a').val('0');
                                $('#monthly_balance_amount').val('0');

                                $('#semester_cash_given').val('0');
                                $('#semester_cash_given_a').val('0');
                                $('#semester_balance_amount').val('0');

                                $('#custom_cash_given_a').val('0');
                                $('#custom_cash_given').val('0');
                                $('#custom_balance_amount').val('0');

                                var dis_amount=parseFloat(main_amount)*3/100;
                                var x=parseFloat(main_amount)+parseFloat(dis_amount);
                                $('[name="'+show_name+'"]').val(thousands_separators(x.toFixed(2)));
                                $('[name="'+real_show_name+'"]').val(x.toFixed(2));
                                $('#'+card_fee_amount).val(dis_amount);
                                $('#'+card_name).text("3% Fee Added");



                            }else if ($(this).val()==5){
                                $('[name="'+show_name+'"]').val(thousands_separators(y.toFixed(2)));
                                $('[name="'+real_show_name+'"]').val(y.toFixed(2));
                                $('#'+card_name).empty();

                                $('#online_bnk').hide();
                                $('#card_no').hide();
                                $('#check_no').show();
                                $('#bnk_date').show();
                            }

                            else{
                                $('[name="'+show_name+'"]').val(thousands_separators(y.toFixed(2)));
                                $('[name="'+real_show_name+'"]').val(y.toFixed(2));
                                $('#'+card_name).empty();

                                $('#bnk_date').hide();
                                $('#card_no').hide();
                                $('#online_bnk').hide();
                                $('#check_no').hide();
                                $('#check_bank_date').hide();
                            }

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

                    </script>
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
                                            '<th valign="top">STUDENT ID</th>' +
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
                                                '<td>' + (data.students[i].student_id ? data.students[i].student_id : "No Student ID") + '</td>' +
                                                '<td>' + (data.students[i].name ? data.students[i].name : "No Name") + '</td>' +
                                                '<td>' + (data.students[i].nic_number ? data.students[i].nic_number : "No NIC") + '</td>' +
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

                        function add_enrollment(){
                            var validation_currency=document.getElementById("validation_currency").value;
                            if (validation_currency==""){
                                alert("Can not Proceed,Please Set Currency Rate First");
                            }else{
                                save_enrollment();
                            }


                        }
                        function save_enrollment(){
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

                                    if(data.status==true){
                                        reload_table(NonQualifiedInfo);
                                        $('#monthly_load_list').empty();
                                        document. getElementById("program_enrollment_form"). reset();
                                        monthly_counter=1;
                                        $('#program_enrollment_modal').modal('hide');
                                        bootbox.alert({
                                            message: "<b style='text-align:center;color: green;'>"+data.message+"</b>"
                                        });

                                    }
                                    else{
                                        reload_table(NonQualifiedInfo);

                                        bootbox.alert({
                                            message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                        });
                                    }
                                },
                                error:function(){
                                    reload_table(NonQualifiedInfo);
                                    bootbox.alert({
                                        message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                                    });
                                }

                            });
                        }




                    </script>
                    <script>
                        $('#full_cash_given_a').on('input',function(){
                            var cash_given = $(this).val();
                            var balance_amount=0;
                            var amount= document.getElementById("real_program_full_final_price").value;
                            $('[name="full_cash_given"]').val(parseFloat(cash_given));
                            if ( amount =="" ){
                                balance_amount=0;
                            }else if (cash_given<amount){
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            else{
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            if (Number.isNaN(balance_amount) || balance_amount == "" || balance_amount === null) {
                                $('[name="full_balance_amount"]').val(parseFloat(0));
                            }
                            else {
                                $('[name="full_balance_amount"]').val(numUSD.format(balance_amount));

                                //   var text = new NumericInput(document.getElementById('full_balance_amount', 'en-CA'));
                                var textDe = new NumericInput(document.getElementById('full_cash_given_a', 'de-DE'));
                            }


                        });
                        $('#monthly_cash_given_a').on('input',function(){
                            var cash_given = $(this).val();
                            var balance_amount=0;
                            var amount= document.getElementById("real_program_monthly_enrollment_final_price").value;
                            $('[name="monthly_cash_given"]').val(parseFloat(cash_given));
                            if ( amount =="" ){
                                balance_amount=0;
                            }else if (cash_given<amount){
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            else{
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            if (Number.isNaN(balance_amount) || balance_amount == "" || balance_amount === null) {
                                $('[name="monthly_balance_amount"]').val(parseFloat(0));
                            }
                            else {
                                $('[name="monthly_balance_amount"]').val(numUSD.format(balance_amount));


                                //   var text = new NumericInput(document.getElementById('full_balance_amount', 'en-CA'));
                                var textDe = new NumericInput(document.getElementById('monthly_cash_given_a', 'de-DE'));
                            }



                        });
                        $('#semester_cash_given_a').on('input',function(){
                            var cash_given = $(this).val();
                            var balance_amount=0;
                            var amount= document.getElementById("real_program_semester_enrollment_final_price").value;
                            $('[name="semester_cash_given"]').val(parseFloat(cash_given));
                            if ( amount =="" ){
                                balance_amount=0;
                            }else if (cash_given<amount){
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            else{
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            if (Number.isNaN(balance_amount) || balance_amount == "" || balance_amount === null) {
                                $('[name="semester_balance_amount"]').val(parseFloat(0));
                            }
                            else {
                                $('[name="semester_balance_amount"]').val(numUSD.format(balance_amount));


                                //   var text = new NumericInput(document.getElementById('full_balance_amount', 'en-CA'));
                                var textDe = new NumericInput(document.getElementById('semester_cash_given_a', 'de-DE'));
                            }
                        });
                        $('#custom_cash_given_a').on('input',function(){



                            var cash_given = $(this).val();
                            var balance_amount=0;
                            var amount= document.getElementById("real_cus_pay_amount").value;

                            $('[name="custom_cash_given"]').val(parseFloat(cash_given));
                            if ( amount =="" ){
                                balance_amount=0;
                            }else if (cash_given<amount){
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            else{
                                balance_amount=parseFloat(cash_given)-parseFloat(amount);
                            }
                            if (Number.isNaN(balance_amount) || balance_amount == "" || balance_amount === null) {
                                $('[name="custom_balance_amount"]').val(parseFloat(0));
                            }
                            else {
                                $('[name="custom_balance_amount"]').val(numUSD.format(balance_amount));


                                var textDe = new NumericInput(document.getElementById('custom_cash_given_a', 'de-DE'));
                            }
                        });
                    </script>






