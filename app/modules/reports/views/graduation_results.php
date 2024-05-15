
<?php
ini_set('display_errors', 0);

$this->load->model('Student_dropout_mod','drop');

?>

<style>
    /* table {
        font-family: arial, sans-serif !important;
        border-collapse: collapse;
        width: 100%;
        text-align:left;
        align: center;
    }
    th {
        font-weight: bolder !important;
        border: 1px solid #132675 !important;
        background-color: #132675 !important;
        text-align: left;
        padding: 10px !important;
        font-size: inherit;
    }
    td {
        border: 1px solid #dddddd !important;
        background-color: #ffffff !important;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd !important;
    } */
    /* #students {
        font-family: arial, sans-serif !important;
        border-collapse: collapse;
        width: 100%;
        text-align:left;
        align: center;
    }
    #students td, #students th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #students tr:nth-child(even){background-color: #f2f2f2;}
    #students tr:hover {background-color: #ddd;}
    #students th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #132675;
        color: white;
    } */

</style>
<div class="row">
                <div class="col-sm-4 col-lg-3">
                    <div class="form-group">
                        <button onclick="grad()" class="btn btn-success"><i class="icon-process"></i> Process Graduation</button>
                    </div>
                </div>
                
            </div>

<table align="center" id="gender_table" class="table table-striped table-bordered dt-responsive "
       style="width:100%" cellspacing="0">
    <thead>
    <tr>
        <th style="width: 290px;">Student Name</th>
        <th>Program</th>
        <th>GPA</th>
        <th>Finance Comment</th>
        <th>Library Comment</th>
        <th>Academic Comment</th>
        <th>Action <input type="checkbox" id="select-all"> </th>
    </tr>

    </thead>
    <tbody>
    <?php
    foreach ($student_data as $data) {
       $comment= $this->drop->view_drop_result($data->std_ref);
     //  var_dump($test);
        //var_dump($data);
        ?>
        <tr>
        <td><?php echo $data->name; ?></td>
            <td><?php echo $data->Programme; ?></td>
            <td>4.1</td>


            <td>All Paid</td>
            <td>Returned all the library books</td>
            <td>test academic Comment</td>

            <td><a href="javascript:;" onclick="pass_id(<?php echo $data->std_ref; ?>)"><i
                            class="fa fa-edit" title="Edit_comment"></i></a>
                            <input type="checkbox" id="" name="" value="">      
                        </td>
                 
        </tr>

        <?php
    }
    ?>
    </tbody>

</table>
<script>

function grad() {

bootbox.alert("Graduation Process Completed"); 
}


document.getElementById('select-all').onclick = function() {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}

    function pass_id(id) {

        $('#ref_id').val(id);

        $.ajax({



            url: "<?php echo base_url('reports/Student_dropout_con/check_ref_id');?>",
            type: "POST",
            dataType: "html",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                id:id
            },
            success: function(data) {

                // console.log(data);



                $('#view_result_model .modal-title').text("Graduation Comments");
                $('#view_result_model').modal({
                    backdrop: 'static',
                    keyboard: false
                });

                $('#load_edu_results').html(data);


            }
        });


    }

    function drop_id(id) {

        $('#drop_ref_id').val(id);

        $('#drop_view_result_model .modal-title').text("Student Dropout");
            $('#drop_view_result_model').modal({
                backdrop: 'static',
                keyboard: false
            });
    }

    function drop_id(id) {

        $('#drop_ref_id').val(id);

        $('#drop_view_result_model .modal-title').text("Student Dropout");
            $('#drop_view_result_model').modal({
                backdrop: 'static',
                keyboard: false
            });
    }

    function dropout_status(id) {

        bootbox.alert("Student Dropout Successfully !");
        $('#drop_view_result_model').modal('hide');
    }

    function save_comment() {
        var finance = document.getElementById("finance").value;
        var marketing = document.getElementById("marketing").value;
        var academic = document.getElementById("academic").value;
        var id = document.getElementById("ref_id").value;

        $.ajax({

            url: "<?php echo base_url('reports/Student_dropout_con/view_dropout_result');?>",
            type: "POST",
            dataType: "html",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>",
                id:id,
                "finance": finance,
                "marketing": marketing,
                "academic": academic

            },
            success: function(data) {

                // console.log(data);

                if(data.status==true){

                    bootbox.alert({message: '<b style="text-align:center;color:green">Comment Submited!!</b>'});

                }



            }
        });


    }
</script>


<div class="modal fade" id="drop_view_result_model" role="dialog">



    <div class="modal-dialog modal-full" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="modal-title bold uppercase" id="select_exam_modal_head" style="height:10px"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                 
            </div>

            <div class="modal-footer">
                <button type="button" onclick="dropout_status()" class="btn btn-primary">Dropout</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="view_result_model" role="dialog">
  <div class="modal-dialog modal-full" style="max-width: 50%;">
        <div class="modal-content">
            <div class="modal-header bg-blue-steel bg-font-blue-steel">
                <h4 class="modal-title bold uppercase" id="select_exam_modal_head" style="height:10px"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="edit_student_comments" name="student_marks" class="form-horizontal">
                    <div class='row' style="display:none;">
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Student ID : </b></label>
                        <div class='col-md-8'>
                            <input name="ref_id" id="ref_id" class="form-control selectpicker" data-live-search="true">


                            <span class="error-block"></span>
                        </div>
                    </div>
                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Finance : </b></label>
                        <div class='col-md-8'>
                            <input name="finance" id="finance" class="form-control selectpicker" data-live-search="true">
                            <span class="error-block"></span>
                        </div>
                    </div>
                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Library : </b></label>
                        <div class='col-md-8'>
                            <input name="marketing" id="marketing" class="form-control selectpicker" data-live-search="true">
                            <span class="error-block"></span>
                        </div>
                    </div>
                    <div class='row'>
                        <label class='control-label col-md-4' style='text-align: right;color:black;'><b> Academic : </b></label>
                        <div class='col-md-8'>
                            <input name="academic" id="academic" class="form-control selectpicker" data-live-search="true">
                            <span class="error-block"></span>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" onclick="save_comment()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div>
    </div>
</div>