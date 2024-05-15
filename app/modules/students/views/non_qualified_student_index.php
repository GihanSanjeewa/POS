 

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
                                                    <div id="marketing_row">
                                                    <div class='row'>
                                                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount (Marketing) : </b></label>
                                                        <div class='col-md-8'>
                                                            <input type="number" readonly name="marketing_team_discount" id="marketing_team_discount" class="form-control">
                                                            <span class="error-block"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <br>
                                                    <div id="program_enrollment_full_payment">
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Plan List(s) : </b></label>
                                                            <div class='col-md-8'>
                                                                <select name="program_enrollment_full_plan[]" id="program_enrollment_full_plan" class="form-control selectpicker" data-live-search="true" multiple>
                                                                </select>
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <input type="hidden" name="program_full_fee_id" id="program_full_fee_id">
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Installment(s) Total : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_full_enrollment_total_amount" id="program_full_enrollment_total_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Payment Register Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_full_register_amount" id="program_full_register_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div id="finance_row">
                                                            <div  class='row'>
                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Finance Discount (<label id="finan_dis"></label>%) : </b></label>
                                                                <div class='col-md-8'>
                                                                    <input type="number" pattern="^[0-9]*$" readonly min="0" name="finance_team_discount" id="finance_team_discount" class="form-control">
                                                                    <input type="hidden" name="max_finance_team_discount" id="max_finance_team_discount" class="form-control">
                                                                    <span class="error-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Discount Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="full_program_discount" value="0" id="full_program_discount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Discounted Installment(s) Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="full_program_discounted_amount" id="full_program_discounted_amount" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Total Amount : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="program_full_final_price" id="program_full_final_price" class="form-control readonlycolor">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                    </div>

                                                    <div id="program_enrollment_custom" style="padding: 4px; border: 2px solid #ffc1c1;">
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
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Full Program Fee : </b></label>
                                                            <div class='col-md-8'>

                                                                <input type="text" readonly name="program_total_amount" id="program_total_amount" class="form-control numeric">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> New Full Program Fee : </b></label>
                                                            <div class='col-md-8'>

                                                                <input type="text" readonly name="add_program_total_amount" id="add_program_total_amount" class="form-control numeric">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Registration Fee : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="register_amount" id="register_amount" class="form-control numeric">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b>Registration Due Date : </b></label>
                                                            <div class='col-md-8'>
                                                                <input type="text" readonly name="register_due_date"  id="register_due_date" class="form-control form-control-inline input-medium date-pick" size="16" data-date-format="yyyy-mm-dd">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class='row'>
                                                            <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance for Installments : </b></label>
                                                            <div class='col-md-8'>

                                                                <input type="text" readonly name="balance_installments" id="balance_installments" class="form-control numeric">
                                                                <span class="error-block"></span>
                                                            </div>
                                                        </div>
                                                        <br>
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
                                                                        <input type="hidden" name="late_a" id="late_a" class="form-control" value="200.00">
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
<!--                                                                <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Balance to add : </b></label>-->
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
                        function clear_fields(){
                            $('#note').val('');
                            $('#program_full_enrollment_total_amount').val('');
                            $('#program_full_register_amount').val('');
                            // $('#program_full_register_amount').val('');
                            $('#full_program_discount').val('');
                            $('#full_program_discounted_amount').val('');
                            $('#program_full_final_price').val('');
                        }

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
                                    $('[name="marketing_team_discount"]').val(data.student[0].mak_disc);
                                    var mac=data.student[0].mak_disc;
                                    load_payment_plans(data.student[0].programe,mac,data.student[0].batch);
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
                        function load_payment_plans(program_id,mac,batch) {
                            if (mac==null){
                                document.getElementById('marketing_row').style.display = 'none';
                                document.getElementById('finance_row').style.display = 'none';
                                $.ajax({
                                    url: "<?php echo base_url('payments/Program_fee/get_payment_plan_info_withoutCustom');?>",
                                    type: "POST",
                                    dataType: "JSON",
                                    data:{
                                        "batch":batch,
                                        "program_id":program_id,
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    success:function(data){

                                        $('#program_enrollment_plan').html('<option value="">--Select Payment Plan--</option>');
                                        for(var i=0;i<data.plans.length;i++){
                                            $('#program_enrollment_plan').append('<option value="'+data.plans[i].id+','+data.plans[i].custom_plan+','+data.plans[i].currency_id+'">'+data.plans[i].dynamic_name+' ('+data.plans[i].symbol+' )</option>');
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
                            }else{
                                $.ajax({
                                    url: "<?php echo base_url('payments/Program_fee/get_payment_plan_info_onlyCustom');?>",
                                    type: "POST",
                                    dataType: "JSON",
                                    data:{
                                        "batch":batch,
                                        "program_id":program_id,
                                        "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                                    },
                                    success:function(data){

                                        $('#program_enrollment_plan').html('<option value="">--Select Payment Plan--</option>');
                                        for(var i=0;i<data.plans.length;i++){
                                            $('#program_enrollment_plan').append('<option value="'+data.plans[i].id+','+data.plans[i].custom_plan+','+data.plans[i].currency_id+'">'+data.plans[i].dynamic_name+' ('+data.plans[i].symbol+' )</option>');
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
                        $('#program_enrollment_plan').change(function(){
                            clear_fields();
                            var program_enrollment_student = document.getElementById("program_enrollment_student").value;
                            var program_id = document.getElementById("enrolling_program").value;
                            var batch_id = document.getElementById("program_enrollment_batch").value;

                            $.ajax({
                                url: "<?php echo base_url('payments/Program_fee/get_already_enrollment');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                    "student_id":program_enrollment_student,
                                    "program_id":program_id,
                                    "batch_id":batch_id,
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

                            var plan_id =$(this).val();
                            var enro= plan_id.split(",");
                            var program_fee = enro[0];
                            var custom_plan_type = enro[1];
                            var currency_id = enro[2];
                            $.ajax({
                                url: "<?php echo base_url('payments/Program_fee/get_finance_info');?>",
                                type: "POST",
                                dataType: "JSON",
                                data:{
                                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                    "batch_id":batch_id,
                                    "program_id":program_id,
                                    "currency_id":currency_id,
                                },
                                success:function(data){
                                    var discount_price;
                                    var balance_installments;
                                    var marketing_dis=document.getElementById("marketing_team_discount").value;
                                    var full_price=data.finance[0].full_program_fee;
                                    discount_price=full_price-marketing_dis;
                                    var balance_installments=discount_price-data.finance[0].register_amount;
                                    //$('[name="marketing_team_discount"]').val(data.finance[0].max_marketing_discount);
                                    // $('[name="finance_team_discount"]').val(data.finance[0].max_finance_discount);
                                    // $('#finan_dis').text(data.finance[0].max_finance_discount);
                                    // $('[name="max_finance_team_discount"]').val(data.finance[0].max_finance_discount);
                                    $('[name="program_total_amount"]').val(data.finance[0].full_program_fee);
                                    $('[name="add_program_total_amount"]').val(discount_price);
                                    $('[name="balance_installments"]').val(balance_installments);
                                    $('[name="register_amount"]').val(data.finance[0].register_amount);
                                    $('[name="register_due_date"]').val(data.finance[0].register_due_date);
                                    $('[name="already_saved_currency_id"]').val(data.finance[0].currency_id);
                                    $('[name="already_saved_currency"]').val(data.finance[0].currency_type);
                                    $('[name="program_enrollment_id"]').val(data.finance[0].id);

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }
                            });


                            switch (custom_plan_type) {
                                case "1":
                                    document.getElementById('finance_row').style.display = 'none';
                                    document.getElementById('marketing_row').style.display = 'block';
                                    program_enrollment_custom.style.display = "block";
                                    program_enrollment_full_payment.style.display = "none";


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

                                    program_enrollment_full_payment.style.display = "block";
                                    program_enrollment_custom.style.display = "none";
                                    //program fee details details
                                    $.ajax({
                                        url: "<?php echo base_url('payments/Program_fee/get_payment_fee_info');?>",
                                        type: "POST",
                                        dataType: "JSON",
                                        data:{
                                            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                            "id":program_fee
                                        },
                                        success:function(data){
                                            $('#program_enrollment_full_plan').html('<option disabled value="">--Select Payment Plan(s)--</option>');
                                            for(var i=0;i<data.plans.length;i++){
                                                $('#program_enrollment_full_plan').append('<option value="'+data.plans[i].installment_id+','+data.plans[i].amount+','+data.plans[i].installment_type+','+data.plans[i].currency_id+','+data.plans[i].program_fee_id+','+data.plans[i].dis+','+i+','+data.plans[i].due_date+'">'+data.plans[i].installment+' - '+data.plans[i].price+'</option>');
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

                                        // var fdc = document.getElementById("finance_team_discount").value;
                                        // var mfdc = document.getElementById("max_finance_team_discount").value;
                                         var payment_date = document.getElementById("program_enrollment_date").value;
                                        // if (mfdc < fdc){
                                        //     alert("Maximum Discount Rate Exceeded");
                                        //     $('#finance_team_discount').val(mfdc);
                                        // }else{
                                        //
                                        // }
                                        var full_plan_details =$(this).val();
                                        var tot_val=0;
                                        var reg_val=0;
                                        var count_a="";
                                        var count_b="";
                                        var type_val="";
                                        var split_val;
                                        var ins_count_for_discount=0;
                                        for(var j=0; j<full_plan_details.length; j++){
                                            //calculating total without registration fee
                                            split_val = full_plan_details[j].split(",");
                                            var program_fee_id=split_val[4];
                                            var def_discount=split_val[5];
                                            if (split_val[2]=="1"){
                                                reg_val=reg_val+parseFloat(split_val[1]);
                                            }else {
                                                tot_val = tot_val+parseFloat(split_val[1]);
                                            }

                                            // check
                                            count_b=count_b+j;
                                             count_a = count_a+split_val[6];

                                        }
                                        $.ajax({
                                            url: "<?php echo base_url('payments/Program_fee/installment_discount');?>",
                                            type: "POST",
                                            dataType: "JSON",
                                            data:{
                                                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                                                "due_date":split_val[7],
                                                "today_date":payment_date,
                                            },
                                            success:function(data){
                                                var dis_rate=0;
                                                if (data.discount!=0){
                                                    // var max_finance = document.getElementById("max_finance_team_discount").value;
                                                    document.getElementById('finance_row').style.display = 'block';
                                                    $('#finan_dis').text(data.discount.ins_rate);
                                                    $('#max_finance_team_discount').val(data.discount.ins_rate);
                                                    $('#finance_team_discount').val(data.discount.ins_rate);
                                                    dis_rate=data.discount.ins_rate;
                                                }else{
                                                    document.getElementById('finance_row').style.display = 'none';
                                                    dis_rate=0;
                                                }
                                                if (tot_val==0){
                                                    var full_program_discounted_amount=tot_val;
                                                }else{
                                                    var full_program_discounted_amount=tot_val-(tot_val*dis_rate/100);
                                                }
                                                $('[name="full_program_discount"]').val(tot_val*dis_rate/100);
                                                $('[name="program_full_register_amount"]').val(reg_val);
                                                $('[name="program_full_enrollment_total_amount"]').val(tot_val);
                                                $('[name="full_program_discounted_amount"]').val(full_program_discounted_amount);
                                                $('[name="program_full_fee_id"]').val(program_fee_id);
                                                $('[name="program_full_final_price"]').val(full_program_discounted_amount+reg_val);

                                                if (count_b==count_a){

                                                }else{

                                                    bootbox.alert("Incorrect Installment Selection");

                                                    $('#program_enrollment_full_plan').val(0);
                                                    $('#full_program_discount').val(0);
                                                    $('#program_full_register_amount').val(0);
                                                    $('#program_full_enrollment_total_amount').val(0);
                                                    $('#full_program_discounted_amount').val(0);
                                                    $('#program_full_final_price').val(0);
                                                    $('.selectpicker').selectpicker('refresh');
                                                }

                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                                                bootbox.alert(textStatus + " : " + errorThrown);
                                                console.log(jqXHR);
                                                console.log(textStatus);
                                                console.log(errorThrown);
                                            }
                                        });

                                        split_val = "";

                                    });
                            }
                        });


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
                        var program_enrollment_custom = document.getElementById("program_enrollment_custom");
                        var program_enrollment_discount = document.getElementById("program_enrollment_custom");

                        var bnk_id = document.getElementById("bnk_id");

                        program_enrollment_full_payment.style.display = "none";
                        program_enrollment_custom.style.display = "none";
                        bnk_id.style.display = "none";



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
                                                '<td>' + (data.students[i].st_nic_num ? data.students[i].st_nic_num  : "No NIC") + '</td>' +
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

                                        $('#program_enrollment_form')[0].reset();
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



                        // bootbox alert moving.
                        $(document).on('hidden.bs.modal', '.bootbox.modal', function (e) {
                            if($(".modal").hasClass('show')) {
                                $('body').addClass('modal-open');
                            }
                        })
                    </script>






