<?php
/**
 * Created by kasun de mel
 * User: kasun
 * Date: 10-Mar-17
 * Time: 10:08 AM
 */
?>
<style>
    @media print {
        #view_ids_barcode {
            display:table-column-group;
            width: 100%;
        }
    }
    .modal-header{
        height:50px;
        margin-bottom: 30px;
    }
    .form-control{
        height: 25px;
        padding: 0px;
        margin: 0px;
        border: solid 1px rgba(83, 97, 105, 0.84);
    }
    .modal-title{
        padding:2px;
        margin-bottom: 2px;
        height: 30px;
    }

    .control-label{
        color: #000000;
        height: 20px;
    }

    .form-group{
        padding: 0px;
        margin: 0px;
    }
</style>

<div class="page-content-wrapper">
<!-- BEGIN CONTENT BODY -->
<div class="page-content">

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?php echo site_url('dashboard'); ?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Print Permanent IDs</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            <ul class="dropdown-menu pull-right" role="menu">
                <li>
                </li>
                <li>
                </li>
                <li>
                    <a href="#">
                        <i class="icon-user"></i>
                    </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a href="#">
                        <i class="icon-bag"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<h6 class="page-title">
    <small>Print Permanent IDs</small>
</h6>
<div class="box">
    <div class="box-header">
        <div class="col-md-12">

        </div>
    </div>
    <div class="box-body box-bordered">
        <table id="temp_student_info_table" class="table" cellspacing="1" width="100%">
            <thead>
            <tr>
                <th>batch</th>
                <th>Number Of Students</th>
                <th style="width:100px;">Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>

    var table,
        save_method,
        current_data_table;
    $(document).ready(function(){

        var fixedHeaderOffset = 0;
        if (App.getViewPort().width < App.getResponsiveBreakpoint('md')) {
            if ($('.page-header').hasClass('page-header-fixed-mobile')) {
                fixedHeaderOffset = $('.page-header').outerHeight(true);
            }
        } else if ($('.page-header').hasClass('navbar-fixed-top')) {
            fixedHeaderOffset = $('.page-header').outerHeight(true);
        }

        table = $('#temp_student_info_table').DataTable({
            "processing": true,
            "serverSide": true,

            "ajax": {
                "data": {
                    "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
                },
                "url": "<?=base_url()?>print_permanent_ids/list_permanent_index_data",
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
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found"
            },
            buttons: [
                { extend: 'print', className: 'btn dark btn-fill' },
                { extend: 'copy', className: 'btn red btn-fill' },
                { extend: 'pdf', className: 'btn blue btn-fill' },
                { extend: 'excel', className: 'btn yellow btn-fill ' },
                { extend: 'csv', className: 'btn purple btn-fill ' },
                { extend: 'colvis', className: 'btn dark btn-fill', text: 'Columns'}
            ],

            responsive: true,

            fixedHeader: {
                header: true,
                headerOffset: fixedHeaderOffset
            },
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

        //set input/textarea/select event when change value, remove class error and remove text help block
        $("input").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });

        $("textarea").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });
        $("select").change(function(){
            $(this).parent().removeClass('has-error');
            $(this).next("span").empty();
        });

        $("form :input:not(.input-optional, .input-hidden)").each(function(){
            $(this).siblings('label').append("<span class='required-mark' style='color: #c90054;'>*</span>");
        });

        $("form.form").each(function(){
            var form_id = $(this).prop('id');
            if($("#" + form_id + " div.form-group").size() > 4)
            {
                var divide_after = Math.ceil((jQuery("#" + form_id + " div.form-group").size() - 1)/2);
                var html = "</div><div class='col-md-6'>";
                $("#" + form_id + " div.form-group:gt(" + divide_after + ")").detach().wrapAll("<div class='col-md-6'></div>").parent().insertAfter(jQuery("#" + form_id + " div.form-group:eq(" + divide_after + ")").parent());
            }
            $("#" + form_id + " input.input-hidden").parent().hide();
            $("#" + form_id + " input.date-input").datepicker();
        });

        $("#Permission_color").prop("type", "color");

        $('.modal').on('hidden.bs.modal', function (e) {
            $(this).find("form")[0].reset();
            if($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
            }
        });

        $(".portlet.box .dataTables_wrapper .dt-buttons").css({"margin-top": "-78px"});

    });

    //retrieve intake
    $.ajax({
        url : "<?php echo site_url('intake/intake_list'); ?>",
        type: "POST",
        data:{"<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"},
        dataType: "JSON",
        success: function(data)
        {
            //console.log(data);
            $.each(data, function(key, val){
                $('#intake').append('<option value="'+key+'">'+ val + '</option>');
            });
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error retrieve Batch Name');
        }
    });

    $('#intake').on('click',function(){
        console.log($('#intake').val());
        $.ajax({
            url:"<?php echo site_url('view_temp_index_no/'); ?>",
            dataType:"JSON",
            type:"POST",
            data:{
                id : $('#intake').val(),
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            success:function(data){
                console.log(data);
            },
            error:function(){
                alert("error ");
            }
        });

    });

</script>

