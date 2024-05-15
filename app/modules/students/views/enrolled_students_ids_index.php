

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
                <li class="breadcrumb-item"><a href="javascript:;">Student Management</a></li>
                <li class="breadcrumb-item active"> Course IDs</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Course IDs</h4>
            </div>
            <div class="element-box">


                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                    <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="QualifiedInfo" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th class="all" style="width: 30px">#</th>
                            <th class="all">Course ID</th>
                            <th class="all">BATCH & Intake</th>
                            <th class="all">Program</th>
                            <th class="all">Name</th>
                            <th class="all">NIC Number/Passport</th>
                            <th class="all">Enrolled Date</th>
                            <th class="all">Action</th>
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



<script>
    var QualifiedInfo;
    $(document).ready(function(){

        QualifiedInfo = $('#QualifiedInfo').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?php echo base_url()?>students/enrolled_students_ids_con/qualified_list/",
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
    });
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
                                url: "<?php echo base_url('students/enrolled_students_ids_con/view_program'); ?>/"+id,
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
                    </script>






