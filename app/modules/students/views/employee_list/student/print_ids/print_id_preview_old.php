<style>
    @media print {
        #view_ids_barcode {
            display:table-column-group;
            width: 100%;
            height: 100%;
            /*drop-initial-after-adjust:tr;*/
        }
    }
    .cover_cls{
        width: 90%;
        margin-left:5%;
    }
    .print_btn{
        width: 200px;
        height: 40px;
        background-color: #17a2cc;
        color: white;
    }
    #barcode_div {
        background-size: 100% 100%;
        height: 100%;
        position: absolute;
        width: 100%;
    }
    #testing {
  background-color: lightblue;
}
h2 {
  background-color: red;
}

   

    
</style>
<div>
    <a href="javascript:void(0);" class="btn btn-primary col-md-offset-2" id="print_barcode" onclick="print_barcode()"><button class="print_btn">Print ID Card</button></a>
</div>
<br><br>
<div class="row" id="barcode_div">

    <style>
        #barcode_div_wrap{
            width: 86mm;
            height: 54mm;
            margin: 0;
            /*margin: 30mm 45mm 30mm 45mm;*/
            /* change the margins as you want them to be. */
        }

        @media print {
            #barcode_div_wrap{
                width: 86mm;
                height: 54mm;
                margin: 0;
                /*margin: 30mm 45mm 30mm 45mm;*/
                /* change the margins as you want them to be. */
            }
        }
        @media print {
            .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }
    </style>
    <div id="barcode_div_wrap">
        <div  style="height: 54mm !important; width: 86mm !important;">
            <table border="0" style="width:100%;border-collapse: collapse;">
            <tr>
                    <td style="background: #ff0000d4;">
                        <h2 style="background: #ff0000d4;text-align: right;color: white;display: block;font-size: 22px;line-height: 12px;padding-bottom: 5px;margin-bottom: 5px;padding: 5px;">STUDENT ID</h2>
                    </td>
                </tr>
            </table>
            <table border="0" style="width:100%;border-collapse: collapse;">
            
                <tr>
                    <td style="width:80%; padding: 0px; height: 20px;">
                        <p style="font-size: 16px;text-align: right"><?php echo $student_data->st_full_name; ?></p>
                        <p style="font-size: 16px;text-align: right"><strong>REG No</strong> : <?php echo $student_data->student_id; ?></p>
                        <p style="font-size: 16px;text-align: right"><strong>NIC No </strong>: <?php echo $student_data->st_nic_num; ?></p>
                    </td>
                    <td style="width:30%; padding: 0px; height: 20px;text-align: right">
                    <?php
                        
                        if(count($photo_data)==0){
                            ?>
                            <img style="width:100px; margin-right: 10px" src="<?php echo base_url('uploads/student_photos/noprofile-pic.jpg')?>">
                            <?php
                        }else{
                            ?>
                            <img style="width:100px;margin-right: 10px" src="<?php echo base_url();?>uploads/student_photos/<?php echo $photo_data->photo; ?>">
                            <?php
                        }
                        ?>
                        
                         
                    </td>
                </tr>
            </table>
            <img style="width:100%; margin-right: 10px" src="<?php echo base_url('uploads/student_photos/id_footer.png')?>">
        </div>

        <div class="pagebreak"> </div>

        <div style="height: 54mm !important; width: 86mm !important;"><br>
            <table border="0" style="width:100%;height:auto;border-collapse: collapse;">
                <tr>

                    <td style="width:100%">
                        <h4 style="font-size: 14px;line-height: 0;text-align: left; padding: 2px 5px">Student Address</h4>
                        <p style="font-size: 12px;line-height: 0;text-align: justify; padding: 2px 5px"><?php echo $student_data->st_current_address; ?></p>
                    </td>
                </tr>
            </table>

            <?php
            $date = date('Y-m-d');
            $ad=$course_data->no_of_yrs*12;
            $xyr=$ad+3;

            ?>
            <p style="transform-origin: 0 0;text-align: -webkit-right;transform: rotate(-90deg);font-size: 12px; margin-left: 90%;margin-top: 15%;width: 28mm;padding-left: 30px;"><strong>Valid Till : <?php echo date('d/m/Y', strtotime("+ ".$xyr." months", strtotime($date))); ?></strong></p>
            <p style="transform-origin: 0 0;text-align: -webkit-right;transform: rotate(-90deg);font-size: 12px;margin-left: 90%;margin-top: 5%;width: 27mm;"><strong>Date of Issue : <?php echo date('d/m/Y'); ?></strong></p>

            <img style="margin-top: -35%;width:100%;margin-right: 10px" src="<?php echo base_url('uploads/student_photos/id_footer2.png')?>">
        </div>
    </div>
</div>

<script type="text/javascript">

function print_barcode() {

        var prtContent = document.getElementById("barcode_div");
        var WinPrint = window.open('', '', 'left=0,top=0,toolbar=0,scrollbars=0,status=0,width=100%,height=100%');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
        WinPrint.close();

    }
</script>