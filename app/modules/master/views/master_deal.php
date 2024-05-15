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
        /*max-height: calc(200vh - 250px);
        overflow-y: auto;*/
    }
</style>


<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Master</a></li>
                <li class="breadcrumb-item active">Deal</li>
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
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Deal <small> - Master</small></h4>
            </div>
            <div class="element-box">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item"><a class="nav-link active" role="tab" href="#pending" data-toggle="tab"> Deal</a></li>
                    
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabcontent-border">
                <div class="tab-pane p-20 active" role="tabpanel" id="pending">
                        <button type="button" onclick="add_deal()" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Deal</button>
                        <table class="table table-striped table-bordered table-hover table-header-fixed dt-responsive" id="DealInfo" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="all" style="width: 30px">#</th>
                                <th class="all">Code</th>
                                <th class="all">Name</th>
                                <!-- <th class="all">Created at</th>
                                <th class="all">Updated at</th> -->

                                <th class="all text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    

                 <!-- Bootstrap new deal modal -->
                 <div class="modal fade" id="deal_modal" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                    <h6 id="deal_modal_title"></h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body form">
                                    <form action="#" id="deal_form" class="form-horizontal">
                                        <div class="form-body">
                                            <div class="">
                                                <input type="hidden" name="id" id="id">
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="code" style='text-align: right;color:black;'><b>Code :</b></label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter Code">
                                                        <span class="error-block"></span>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <label class="control-label col-md-4" for="name" style='text-align: right;color:black;'><b>Name :</b></label>
                                                    <div class="col-md-6">
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
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
                        <div class="modal-dialog modal-lg"  style="min-width: 100px; max-width: 600px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="udModalLabel"></h6>
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row" style="margin-right:5px;margin-left: 5px;margin-top: 10px">
                                        <!-- <h4  class="sub-head">Deal Information</h4> -->
                                        <div class="col-md-12 col-sm-12">
                                            <table style="width:100%" class="st-lumi-table" cellspacing="2" cellpadding="5" border="1" id="view_deal">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer" style="margin-top: 20px;margin:5px">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                

<script type="text/javascript">

var save_method;
var DealInfo;

$(document).ready(function(){

    <?php if($this->session->flashdata('message')){?>

    bootbox.alert({
        message: "<b style='text-align:center'><?php echo $this->session->flashdata('message')?></b>",
        size: 'small'
    });

    <?php } ?>

    DealInfo = $('#DealInfo').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
        "ajax": {
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            "url": "<?php echo base_url()?>master/Master_deal_status_con/industries_list/",
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
                { extend: 'print', 
                text: '<i class="fa fa-print"></i>',
                titleAttr: 'Print', 
                exportOptions: {
                columns: [ 0,1,2 ], orthogonal: 'export'
                }
                },

                {
                extend:    'copyHtml5',
                text:      '<i class="fa fa-files-o"></i>',
                titleAttr: 'Copy',
                exportOptions: {
                columns: [ 0,1,2]
                }
                },
                {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel',
                exportOptions: {
                columns: [ 0,1,2 ]
                }
                },
                {
                extend:    'csvHtml5',
                text:      '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'CSV',
                exportOptions: {
                columns: [ 0,1,2]
                }
                },
                {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF',
                exportOptions: {
                columns: [ 0,1,2 ]
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

    DealInfo.on('order.dt search.dt', function () {
        DealInfo.column(0, {search: 'applied', order: 'applied'}).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();

    yadcf.init(DealInfo, [{
            filter_type: "text",
            filter_delay: 500,
            column_number: 1
        },{
            filter_type: "text",
            filter_delay: 500,
            column_number: 2
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

<script>

function edit_deal(id){

    $('.error-block').empty();
    save_method='update';
    $('#deal_form')[0].reset();

    $.ajax({

        url:"<?php echo base_url('master/master_deal_status_con/get_deal');?>",
        dataType:"JSON",
        type:"POST",
        data:{
            id:id,
            "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
        },
        success:function(data){

            $('[name="id"]').val(data.deal.id);
            $('[name="code"]').val(data.deal.code);
            $('[name="name"]').val(data.deal.name);
            


            $('#deal_modal_title').html('Edit deal Info '+data.deal.name);
            $('#deal_modal').modal({backdrop: 'static', keyboard: false});

        },
        error:function(){
            alert("error retrieve pending deal info");
        }
    });

}


function save(){
    $('.error-block').empty();
    var url;
    if(save_method == 'add'){
        url="<?php echo base_url('master/Master_deal_status_con/save'); ?>";
    }
    else{
        url="<?php echo base_url('master/Master_deal_status_con/update'); ?>";
    }

    $.ajax({

        url:url,
        dataType:"JSON",
        type:"POST",
        data:$('#deal_form').serialize()+"&<?php echo $this->security->get_csrf_token_name(); ?>=<?php echo $this->security->get_csrf_hash(); ?>",
        success:function(data){

            if(data.input_error)
            {
                for (var i = 0; i < data.input_error.length; i++)
                {
                    $('[name="'+data.input_error[i]+'"]').siblings("span.error-block").html(data.error_string[i]).show();
                }
            }
            else if(data.status == true){

                reload_table(DealInfo);
                $('#deal_modal').modal('hide');
                bootbox.alert({
                    message: "<b style='text-align:center'>"+data.message+"</b>"
                });

            }
            else{

                reload_table(DealInfo);
                $('#deal_modal').modal('hide');
                bootbox.alert({
                    message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
                });
            }
        },
        error:function(){
            reload_table(DealInfo);
            bootbox.alert({
                message: "<b style='text-align:center;color: red'>"+data.message+"</b>"
            });
        }

    });

}


function add_deal(){

    $('.error-block').empty();
    save_method='add';
    $('#deal_form')[0].reset();

    $('#deal_modal_title').html('Add New deal');
    $('#deal_modal').modal({backdrop: 'static', keyboard: false});

}

</script>


<script>

function view_deal(id){

    $.ajax({

        url: "<?php echo base_url('master/master_deal_status_con/view_deal'); ?>/"+id,
        type: "POST",
        dataType: "JSON",
        data:{
            '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
        },
        success:function(data){

            var html='';

            html +='</td>'+
                '</tr>' +
                '<tr>' +
                '<td><label>Code</label></td>' +
                '<td>'+(data.deal.code ? data.deal.code:"No Code")+'</td>'+
                '</tr>' +
                '<tr>' +
                '<td valign="top"><label>Name</label></td>' +
                '<td>' +(data.deal.name ? data.deal.name:"Name")+'</td>' +
                '</tr>' +
                '</tbody>';

            $('#view_deal').html(html);

            $('#view_modal .modal-title').text("deal Info ");
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

</script>


                    

                    