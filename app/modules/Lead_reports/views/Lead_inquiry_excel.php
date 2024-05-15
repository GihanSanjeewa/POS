<?php
    
    $this->load->model('Lead_inquiry_con','inq');
?>



<div id="pay_excel1">

    <style type="text/css" media="print">
    @page {
        size: A4 landscape;
        margin-top: 0;
        /* this affects the margin in the printer settings */
        margin-bottom: 0;
        orientation: landscape
    }



    table {
        overflow-x: auto;
        border-collapse: collapse;
        width: 100%;
        margin-top: 30px;

    }

    th,
    td {
        font-size: 30px;
        border: 2px solid #ddd;
        padding: 15px;


    }
    </style>

    
    <img src="<?php echo base_url('assets/images/iihs_repo.jpg'); ?>" class="light-logo" alt="logo"
        style="width:100%;height:350px; display: block" />
    <div class="row">
        
        <h1 style="text-align:center;"><u>Lead Inquiry Report</u></h1>

        <br><br>
        <table>
            <tr>
                <th style="font-size:40px;text-align:right;border:none;" colspan="10">
                    <?php  echo date("m/d/Y , h:i A"); ?></th>
            </tr>
        </table id="tblStocks" cellpadding="0" cellspacing="0">
        
            <b style="font-size: 30px;"> Lead Data for - | <?php echo $from_date; ?> - <?php echo $to_date; ?></b>

            <br><br>

            <table>

            <thead>
                    <tr>

                        <th>INQ No</th>
                        <th>Lead Creation Date</th>

                        <!-- added--->
                        <th>Inquired By</th>
                        <th>Parent's Title</th>
                        <th>Parent's Full Name</th>
                        <th>Student's Title</th>
                        <!-- end Added -->

                        <th>Student's Name</th>
                        <th>Mobile No</th>


                        <!--added-->
                        <th>Fixed Mobile No</th>
                        <th>NIC</th>
                        <th>Passport</th>
                        <!--end added-->


                        <th>Email ID</th>


                        <!--added-->
                        <th>Address</th>
                        <th>Country</th>
                        <!--end added-->

                        <th>Student's Counsellor</th>
                        <th>Contacted Method</th>
                        <th>Lead Source</th>

                        <!--added-->
                        <th>Reffered</th>
                        <th>Refferal Type</th>
                        <th>Agent Name</th>
                        <th>Reffered NIC</th>
                        <th>Remarks</th>
                        <!--end added-->

                        <th>Interested Program</th>
                        <th>Batch</th>

                        <!--added-->
                        <th>Other Interested Program</th>
                        <th>Pref. Study Method</th>

                        <!--end added-->

                        <th>Acedemic Qualifications</th>
                        <th>Professional Qualifications</th>

                        <!--added-->
                        <th>Education Loan Required</th>
                        <th>Preffered Contact Method</th>
                        <th>Preffered Contact ID/Number</th>
                        <!--end added-->

                        <th>Interest Level</th>


                        <th>Remark</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                           foreach($lead_inq_Data as $inq){
                    ?>

                    <tr>

                        <td><?php echo $inq->lead_id_code; ?></td>
                        <td><?php echo $inq->lead_created_date; ?></td>
                        <!-- added--->
                        <td><?php echo $inq->inq_by; ?></td>
                        <td><?php echo $inq->p_title; ?></td>
                        <td><?php echo $inq->parent_name; ?></td>
                        <td><?php echo $inq->s_title; ?></td>
                        <!--end  Added -->
                        <td><?php echo $inq->f_name; ?> <?php echo $inq->l_name; ?></td>
                        <td><?php echo $inq->l_phone; ?></td>
                        <!--added-->
                        <td><?php echo $inq->l_phone_2; ?></td>
                        <td><?php echo $inq->nic_div; ?></td>
                        <td><?php echo $inq->passport_div; ?></td>
                        <!-- end added-->
                        <td><?php echo $inq->l_email; ?></td>
                        <!--added-->
                        <?php
                              if($inq->address1 != NULL || $inq->address2 !=NULL || $inq->city != NULL || $inq->pro != NULL || $inq->zip_pos != NULL)
                        ?>
                        <td><?php echo $inq->address1; ?><br><?php echo $inq->address2; ?><br><?php echo $inq->city; ?><br><?php echo $inq->pro; ?><br><?php echo $inq->zip_pos; ?>
                        </td>
                        <?php

                        ?>
                        <td><?php echo $inq->country; ?></td>
                        <!--end added-->
                        <td><?php echo $inq->l_coun; ?></td>
                        <td><?php echo $inq->contact_name; ?></td>

                        <?php 
$lead_source_data = $this->inq->get_lead_source($inq->lead_tb);
 

                        ?>


                        <td>
                            <?php
                       foreach($lead_source_data as $l_s){ 
                        ?>
                            *<?php echo $l_s->source_title; ?><br>
                            <?php

}
?>


                        </td>



                        <!--added-->
                        <td><?php echo $inq->reffered; ?></td>
                        <td><?php echo $inq->refferal_type; ?></td>
                        <td><?php echo $inq->agent_name; ?></td>
                        <td><?php echo $inq->ref_nic; ?></td>
                        <td><?php echo $inq->ref_remarks;?></td>
                        <!--end added-->

                        <td>(<?php echo $inq->ccode; ?>)<?php echo $inq->c_name; ?></td>
                        <td>(<?php echo $inq->ccode; ?>)<?php echo $inq->year; ?>-<?php echo $inq->intake_name; ?></td>


                        <!--added-->
                        <?php 
$lead_other_pro_data = $this->inq->get_lead_pro($inq->lead_tb);
 

                        ?>
                        <td>
                            <?php
                       foreach($lead_other_pro_data as $other_pro){ 
                        ?>
                            *(<?php echo $other_pro->code; ?>)<?php echo $other_pro->cname; ?><br>
                            <?php

}
?>


                        </td>
                        <td><?php echo $inq->study_method; ?></td>

                        <!--end added-->

                        <td>

                            <p>O/L Result :<span><?php echo $inq->ol_res; ?></span></p>
                            <p>O/L Year :<span><?php echo $inq->ol_year; ?></span></p>
                            <p>A/L School :<span><?php echo $inq->skl; ?></span></p>
                            <p>A/L Stream :<span><?php echo $inq->stream; ?></span></p>
                            <p>A/L Year :<span><?php echo $inq->al_year; ?></span></p>
                            <p>Other :<span><?php echo $inq->other_edu; ?></span></p>


                        </td>
                        <td>
                            <p>NTS/Working Hospital :<span><?php echo $inq->hos; ?></span></p>
                            <p>Years :<span><?php echo $inq->ex_years; ?></span></p>
                            <p>Months :<span><?php echo $inq->ex_months; ?></span></p>
                        </td>

                        <!--added-->
                        <td><?php echo $inq->loan_info; ?></td>
                        <td><?php echo $inq->contact_name; ?></td>
                        <td><?php echo $inq->con_box; ?></td>
                        <!--end added-->
                        <td><?php echo $inq->interest_level; ?></td>


                        <td><?php echo $inq->remarks; ?></td>



                    </tr>
                    <?php
                           }
                           ?>

                </tbody>
            </table>
            
    </div>



</div>




<div id="pay_excel2">

<style>
        #tblStocks {
          font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
          border-collapse: collapse;
          width: 100%;
        }
 
        #tblStocks td, #tblStocks th {
          border: 1px solid #ddd;
          padding: 8px;
        }
 
        #tblStocks tr:nth-child(even){background-color: #f2f2f2;}
 
        #tblStocks tr:hover {background-color: #ddd;}
 
        #tblStocks th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #294c67;;
            color: white;
          }
    </style>
            <b style="font-size: 30px;"> Lead Data for - | <?php echo $from_date; ?> - <?php echo $to_date; ?></b>

            <br><br>

            <table id="tblStocks">

            <thead>
                    <tr>

                        <th>INQ No</th>
                        <th>Lead Creation Date</th>

                        <!-- added--->
                        <th>Inquired By</th>
                        <th>Parent's Title</th>
                        <th>Parent's Full Name</th>
                        <th>Student's Title</th>
                        <!-- end Added -->

                        <th>Student's Name</th>
                        <th>Mobile No</th>


                        <!--added-->
                        <th>Fixed Mobile No</th>
                        <th>NIC</th>
                        <th>Passport</th>
                        <!--end added-->


                        <th>Email ID</th>


                        <!--added-->
                        <th>Address</th>
                        <th>Country</th>
                        <!--end added-->

                        <th>Student's Counsellor</th>
                        <th>Contacted Method</th>
                        <th>Lead Source</th>

                        <!--added-->
                        <th>Reffered</th>
                        <th>Refferal Type</th>
                        <th>Agent Name</th>
                        <th>Reffered NIC</th>
                        <th>Remarks</th>
                        <!--end added-->

                        <th>Interested Program</th>
                        <th>Batch</th>

                        <!--added-->
                        <th>Other Interested Program</th>
                        <th>Pref. Study Method</th>

                        <!--end added-->

                        <th>Acedemic Qualifications</th>
                        <th>Professional Qualifications</th>

                        <!--added-->
                        <th>Education Loan Required</th>
                        <th>Preffered Contact Method</th>
                        <th>Preffered Contact ID/Number</th>
                        <!--end added-->

                        <th>Interest Level</th>


                        <th>Remark</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                           foreach($lead_inq_Data as $inq){
                    ?>

                    <tr>

                        <td><?php echo $inq->lead_id_code; ?></td>
                        <td><?php echo $inq->lead_created_date; ?></td>
                        <!-- added--->
                        <td><?php echo $inq->inq_by; ?></td>
                        <td><?php echo $inq->p_title; ?></td>
                        <td><?php echo $inq->parent_name; ?></td>
                        <td><?php echo $inq->s_title; ?></td>
                        <!--end  Added -->
                        <td><?php echo $inq->f_name; ?> <?php echo $inq->l_name; ?></td>
                        <td><?php echo $inq->l_phone; ?></td>
                        <!--added-->
                        <td><?php echo $inq->l_phone_2; ?></td>
                        <td><?php echo $inq->nic_div; ?></td>
                        <td><?php echo $inq->passport_div; ?></td>
                        <!-- end added-->
                        <td><?php echo $inq->l_email; ?></td>
                        <!--added-->
                        <?php
                              if($inq->address1 != NULL || $inq->address2 !=NULL || $inq->city != NULL || $inq->pro != NULL || $inq->zip_pos != NULL)
                        ?>
                        <td><?php echo $inq->address1; ?><br><?php echo $inq->address2; ?><br><?php echo $inq->city; ?><br><?php echo $inq->pro; ?><br><?php echo $inq->zip_pos; ?>
                        </td>
                        <?php

                        ?>
                        <td><?php echo $inq->country; ?></td>
                        <!--end added-->
                        <td><?php echo $inq->l_coun; ?></td>
                        <td><?php echo $inq->contact_name; ?></td>

                        <?php 
$lead_source_data = $this->inq->get_lead_source($inq->lead_tb);
 

                        ?>


                        <td>
                            <?php
                       foreach($lead_source_data as $l_s){ 
                        ?>
                            *<?php echo $l_s->source_title; ?><br>
                            <?php

}
?>


                        </td>



                        <!--added-->
                        <td><?php echo $inq->reffered; ?></td>
                        <td><?php echo $inq->refferal_type; ?></td>
                        <td><?php echo $inq->agent_name; ?></td>
                        <td><?php echo $inq->ref_nic; ?></td>
                        <td><?php echo $inq->ref_remarks;?></td>
                        <!--end added-->

                        <td>(<?php echo $inq->ccode; ?>)<?php echo $inq->c_name; ?></td>
                        <td>(<?php echo $inq->ccode; ?>)<?php echo $inq->year; ?>-<?php echo $inq->intake_name; ?></td>


                        <!--added-->
                        <?php 
$lead_other_pro_data = $this->inq->get_lead_pro($inq->lead_tb);
 

                        ?>
                        <td>
                            <?php
                       foreach($lead_other_pro_data as $other_pro){ 
                        ?>
                            *(<?php echo $other_pro->code; ?>)<?php echo $other_pro->cname; ?><br>
                            <?php

}
?>


                        </td>
                        <td><?php echo $inq->study_method; ?></td>

                        <!--end added-->

                        <td>

                            <p>O/L Result :<span><?php echo $inq->ol_res; ?></span></p>
                            <p>O/L Year :<span><?php echo $inq->ol_year; ?></span></p>
                            <p>A/L School :<span><?php echo $inq->skl; ?></span></p>
                            <p>A/L Stream :<span><?php echo $inq->stream; ?></span></p>
                            <p>A/L Year :<span><?php echo $inq->al_year; ?></span></p>
                            <p>Other :<span><?php echo $inq->other_edu; ?></span></p>


                        </td>
                        <td>
                            <p>NTS/Working Hospital :<span><?php echo $inq->hos; ?></span></p>
                            <p>Years :<span><?php echo $inq->ex_years; ?></span></p>
                            <p>Months :<span><?php echo $inq->ex_months; ?></span></p>
                        </td>

                        <!--added-->
                        <td><?php echo $inq->loan_info; ?></td>
                        <td><?php echo $inq->contact_name; ?></td>
                        <td><?php echo $inq->con_box; ?></td>
                        <!--end added-->
                        <td><?php echo $inq->interest_level; ?></td>


                        <td><?php echo $inq->remarks; ?></td>



                    </tr>
                    <?php
                           }
                           ?>

                </tbody>
            </table>
            </div>


<script>
$(document).ready(function() {
    $('#pay_excel1').hide();
    $('#pay_excel2').hide();
});



function fnExcelReport() {
    var file = new Blob([$('#pay_excel2').html()], {
        type: "application/vnd.ms-excel"
    });
    var url = URL.createObjectURL(file);
    var a = $("<a />", {
        href: url,
        download: "Lead_Inquiry_Report_Export.xls"
    }).appendTo("body").get(0).click();
    e.preventDefault();
}

function PrintDiv() {
    var divToPrint = document.getElementById('pay_excel1');
    var popupWin = window.open('', '_blank', 'width=1000,height=1000');
    popupWin.document.open();
    popupWin.document.write(
        '<html><head><title>Print</title></head><body onload="window.print()">' +
        divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}

function PrintPreview() {
    var toPrint = document.getElementById('pay_excel1');
    var popupWin = window.open('', '_blank', 'width=1000,height=800,location=no,left=1000px');
    popupWin.document.open();
    popupWin.document.write(
        '<html><head><title>::Print Preview::</title><link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/default_print.css" media="screen"/></head><body">'
    );
    popupWin.document.write(toPrint.innerHTML);
    popupWin.document.write('</html>');
    popupWin.document.close();
}

function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {
        type: "text/csv"
    });

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportTableToCSV(filename) {

    var csv = [];
    var rows = document.querySelectorAll('#pay_excel tr');

    for (var i = 0; i < rows.length; i++) {
        var row = [],
            cols = rows[i].querySelectorAll("td, th");

        for (var j = 0; j < cols.length; j++)
            row.push(cols[j].innerText);

        csv.push(row.join(","));
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
</script>