</div>
</div>
</div>
</div>
<div class="display-type"></div>
<footer class="footer" style="width: 100%;display: inline-table;height: 50px;">
    <!--© 2018 Earrow-->
    <p style="text-align: right; position: absolute; bottom: 10px; right: 10px;font-size: 10px;color:#4b59a5;">Earrow © <?php echo date("Y"); ?> All Rights Reserved. Authorized personnel only. </p>
</footer>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<!--auto complete added by vkc de mel-->
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<!--auto complete module added by vkc de mel-->

<script src="<?php echo base_url(); ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/tether/dist/js/tether.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/slick-carousel/slick/slick.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/step-form-wizard/js/step-form-wizard.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/plugins/step-form-wizard/plugins/parsley/parsley.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/main.js"></script>

<!--V1 -->
<script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/toast-master/js/jquery.toast.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/dt/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.yadcf.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap3-typeahead.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/moment/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/clockpicker/dist/jquery-clockpicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap-duallistbox-4/dist/jquery.bootstrap-duallistbox.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/jquery-contextMenu/dist/jquery.contextMenu.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/jquery-contextMenu/dist/jquery.ui.position.min.js" type="text/javascript"></script>
<script>

    $(document).ready(function() {

        //this is user for kreston
        <?php $groups_emp = array('manager');
        if ($this->ion_auth->in_group($groups_emp)) { ?>

        $.ajax({
            url:"<?php echo site_url('hr_payroll/system_users/view_companies'); ?>",
            dataType:"JSON",
            data:{
                "<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>"
            },
            type:"POST",
            success:function(data){
                /* console.log(data);*/

                $('#branch_name').html('');
                for(var i=0;i<data.length;i++){
                    $('#branch_name').append('' +
                        '<li>' +
                        '<a href="<?php echo base_url('hr_payroll/system_users/session_change_company');?>/'+data[i].id+'">'+data[i].name+'</a>' +
                        '</li>' +
                        '');
                }
            },
            error:function(){

            }

        });
        <?php } ?>
        //end modification


        var csrf_token= $.cookie('csrf_earrowhrpay_co');
        $.ajaxSetup({
            data: {
                'csrf_earrowhrpay' : csrf_token
            }
        });

        $('.date-picker').bootstrapMaterialDatePicker({ weekStart: 0, time: false,autoclose: true });
        $('#timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
        $('.datetimep').bootstrapMaterialDatePicker({ format: 'Y-MM-DD hh:mm:a' });
        $('.monthpick').bootstrapMaterialDatePicker({ format: 'Y-MM',monthPicker:true,year:false,time:false });
        $('.datetimepnew').bootstrapMaterialDatePicker({ format: 'Y-MM-DD HH:mm:ss' });
        $('#min-date').bootstrapMaterialDatePicker({ format: 'DD/MM/YYYY HH:mm', minDate: new Date() });
        // $(".select2").select2({allowClear: true,placeholder: "Select a value"});
        $('#check-minutes').click(function(e) {
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
        $(".date-pick").datepicker( {
            format: "yyyy-mm-dd",
            startView: "months",
            //minViewMode: "months",
            autoclose:true
        });
        $(".month-pick").datepicker( {
            format: "yyyy-mm",
            startView: "years",
            minViewMode: "months",
            autoclose:true
        });
        $(".year-pick").datepicker( {
            format: "yyyy",
            startView: "years",
            minViewMode: "years",
            autoclose:true
        });
    });
</script>
</body>
</html>