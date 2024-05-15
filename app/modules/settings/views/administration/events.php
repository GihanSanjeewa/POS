
<style>
    .modal .select2-container {
        min-width: 100% !important;
    }
</style>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Events & Announcements</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Events & Announcements</h4>
                <button class="btn btn-success pull-right" onclick="add_new()"><i class="fa fa-plus-circle"></i> Add New Event</button>
            </div>
            <div class="element-box">
                <div id="events">
                    <div class="tools"> </div>
                    <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="eventsTable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="all">#</th>
                            <th class="desktop">Date</th>
                            <th class="desktop">Event Type</th>
                            <th class="desktop">Event Title</th>
                            <th class="all text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap modal -->
<div class="modal fade" id="event_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Event</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="event_form" class="form-horizontal" role="form">
                    <div class="form-body">
                        <input type="hidden" name="event_id" id="event_id" value="">
                        <div class="form-group">
                            <label class="control-label col-md-4">Date & Time</label>
                            <div class="col-md-8">
                                <input type="text" name="datetime" id="datetime" class="form-control datetime" >
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4">Employees</label>
                            <div class="col-md-8">
                                <select name="employee[]" id="employee" class="select2" multiple style="width: 100%">
                                    <option value="">(---)</option>
                                    <?php foreach ($employees as $emp){ ?>
                                        <option value="<?php echo $emp->id;?>"><?php echo $emp->employee_id." - ".$emp->initials." ".$emp->last_name; ?></option>

                                    <?php }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Departments</label>
                                <div class="col-md-8">
                                    <select name="department[]" id="department" class="select2" multiple>
                                        <option value="">(---)</option>
                                        <?php foreach ($emp_departments as $emp_department){ ?>
                                            <option value="<?php echo $emp_department->id;?>"><?php echo $emp_department->desc ; ?></option>

                                        <?php }?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Event Type</label>
                                <div class="col-md-8">
                                    <select name="event_type" id="event_type" class="">
                                        <option value="">(---)</option>
                                        <?php foreach ($event_types as $event_type){ ?>
                                            <option value="<?php echo $event_type->id;?>"><?php echo $event_type->type ; ?></option>

                                        <?php }?>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Event Title</label>
                                <div class="col-md-8">
                                    <input name="event_title" id="event_title" class="form-control">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Event Details</label>
                                <div class="col-md-8">
                                    <textarea name="event_details" id="event_details" class="form-control input-optional"></textarea>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Notify From</label>
                                <div class="col-md-8">
                                    <input type="text" name="event_from" id="event_from" class="form-control form-control-inline input-medium date-pick" data-date-format="yyyy-mm-dd">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-4">Notify To</label>
                                <div class="col-md-8">
                                    <input type="text" name="event_to" id="event_to" class="form-control form-control-inline input-medium date-pick" data-date-format="yyyy-mm-dd">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-12">
                                    <input id="send_email" name="send_email" type="checkbox" value="1"> Send Email</label>
                                <span class="help-block"></span>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div>
</div>

<div class="modal fade" id="view_modal" role="dialog">
    <div class="modal-dialog" >
        <div class="modal-content" style="width: 800px">
            <div class="modal-header">
                <h3>Event</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <div class="form-body">
                    <div class="row" style="margin-right:5px;margin-left: 5px;margin-top: 10px">
                        <div class="col-md-12 col-sm-12">
                            <table style="width:100%" class="st-lumi-table" cellspacing="2" cellpadding="5" border="0">
                                <tbody id="view_event_info">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row" style="margin-right:5px;margin-left: 5px;margin-top: 10px">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                            <tr>
                                <td>
                                    <table class="st-lumi-table table-bordered table-hover" width="100%">
                                        <thead>
                                        <th style="text-align:center;" align="center" scope="col">#</th>
                                        <th style="text-align:center;" align="center" scope="col">EMPLOYEE</th>
                                        <th style="text-align:center;" align="center" scope="col">DEPARTMENT</th>
                                        </thead>
                                        <tbody id="view_employee_div">
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function(){
        $(".datetime").datetimepicker({
            format: "yyyy-mm-dd hh:ii",
            showMeridian: true,
            autoclose: true
        });
    });

    $('#department').change(function(){
        var department=$('#department').val();
        if(department !=""){
            $('#employee').attr('disabled',true)
        }
        else{
            $('#employee').attr('disabled',false)
        }
    });

    $('#employee').change(function(){
        var emp=$('#employee').val();
        if(emp !=""){
            $('#department').attr('disabled',true)
        }
        else{
            $('#department').attr('disabled',false)
        }
    });


    var save_method;
    var eventsTable;

    $(document).ready(function() {

        $("#btnSave").off('click');
        $("#btnSave").on('click', function(e){
            e.preventDefault();
            save_event(save_method);
        });

        eventsTable = $('#eventsTable').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?php echo base_url()?>hr_payroll/events/get_events_data",
                "type": "POST"
            },

            "columnDefs": [
                {
                    "targets": [ -1 ],
                    "orderable": false
                }
            ],

            "language": {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "allowancetyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoallowancety": "No entries found",
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
                [5, 10, 15, 20, "All"]
            ],

            "pageLength": 20,
            "dom": "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>" // horizobtal scrollable datatable
        });

    });


    function add_new()
    {

        $('#employee').val('');
        $('#department').val('');
        $('#event_form')[0].reset();

        save_method = 'add';
        $('#event_modal').modal({backdrop: 'static', keyboard: false});
        $('#event_modal .modal-title').text('Add New Event');

    }

    function save_event(save_method)
    {
        var url = "<?php echo site_url('hr_payroll/events/save_event')?>/"+save_method;
        $.ajax({
            url: url,
            type: "POST",
            data: $('#event_form').serialize() + "&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
            dataType: "JSON",
            success: function (data) {
                if (data.status) {
                    $('#event_modal').modal('hide');
                    $('#event_form')[0].reset();
                    reload_table(eventsTable);
                }
                else {
                    for (var l = 0; l < data.inputerror.length; l++) {
                        $('[name="'+data.inputerror[l]+'"]').siblings("span.error-block").html(data.error_string[l]).show();
                    }
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }

    function reload_table(table)
    {
        if(typeof table !== "undefined")
        {
            table.ajax.reload(null,false);
        }
    }

    function edit_event(id)
    {
        $('#event_form')[0].reset();
        save_method = 'edit';
        $("#event_id").val(id);
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('hr_payroll/events/get_event_data_by_id/')?>" + id,
            type: "GET",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {
                if ($('select.select2').data('select2')) {
                    $('select.select2').select2('destroy');
                }

                $('#datetime').val(data.events.datetime);

                if(data.events.emp_department == 1){
                    $('#employee').val(data.employees);
                }
                else if(data.events.emp_department == 2){
                    $('#department').val(data.departments);
                }

                $('#event_type').val(data.events.event_type);
                $('#event_title').val(data.events.event_title);
                $('#event_details').val(data.events.event_details);
                $('#event_from').val(data.events.from_date);
                $('#event_to').val(data.events.to_date);

                $('.select2').select2({dropdownParent: $("#event_modal")});
            },
            error: function ()
            {
                console.log('Error get event data');
            }
        });

        $('#event_modal').modal({backdrop: 'static', keyboard: false});
        $('#event_modal .modal-title').text('Edit Event ' + id);
    }


    function delete_event(id)
    {
        if (confirm('Are you sure you want to Delete this Event')) {

            $.ajax({
                url: "<?php echo site_url('hr_payroll/events/delete_event_data');?>",
                type: "POST",
                data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash()?>",
                    "id":id},
                dataType: "JSON",
                success:function (data) {

                    if (data.status) {
                        reload_table(eventsTable);
                    }
                }
                ,
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });

        } else {
            // Do nothing!
        }
    }


    function view_event(id)
    {

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('hr_payroll/events/get_event_view_by_id/')?>" + id,
            type: "POST",
            "data":{
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {

                $('#view_event_info').html('<tr>' +
                    '<td valign="top"><label>DATE & TIME</label></td>' +
                    '<td>' +
                    '<span>'+data.events.datetime+'</span>'+
                    '</td>' +
                    '</tr>' +
                    '<tr>' +
                    '<td valign="top"><label>EVENT TYPE</label></td>'+
                    '<td>'+
                    '<span>'+data.events.event_type_name+'</span>'+
                    '</td>'+
                    '</tr>'+
                    '<tr>' +
                    '<td valign="top"><label>EVENT TITLE</label></td>'+
                    '<td>'+
                    '<span>'+data.events.event_title+'</span>'+
                    '</td>'+
                    '</tr>'+
                    '<tr>' +
                    '<td valign="top"><label>EVENT DETAILS</label></td>'+
                    '<td>'+
                    '<span>'+data.events.event_details+'</span>'+
                    '</td>'+
                    '</tr>'+
                    '<tr>'+
                    '<td valign="top"><label>NOTIFY DATE</label></td>'+
                    '<td>' +
                    '<span>FROM '+data.events.from_date+' TO '+data.events.to_date+'</span>' +
                    '</td>' +
                    '</tr>' +
                    '');

                var html1='';

                if(data.lists){

                    for(var i=0;i<data.lists.length;i++){

                        html1 +='' +
                            '<tr>' +
                            '<td>'+(i+1)+'</td>' +
                            '<td>'+data.lists[i].full_name+'</td>'+
                            '<td style="text-align: left">'+data.lists[i].department_name+'</td>' +
                            '</tr>';
                    }

                    $('#view_employee_div').html(html1);

                }

                $('#view_modal').modal({backdrop: 'static', keyboard: false});

            },
            error: function ()
            {
                console.log('Error get event data');
            }
        });
    }
</script>

