<?php
    
    $this->load->model('Lead_inquiry_con','inq');
?>



<div class="tab-content tabcontent-border">




    <a class="dt-button buttons-excel buttons-html5" href="#" title="Excel"
        onClick="javascript:fnExcelReport();"><span><i class="fa fa-file-excel-o"></i></span></a>

    <a class="dt-button buttons-print buttons-html5" onClick="javascript:PrintDiv();" href="#" title="Print"><span><i
                class="fa fa-print"></i></span></a>
    <!-- <a class="dt-button buttons-csv buttons-html5" onClick="javascript:exportTableToCSV('Gender_Report_Export.csv');" href="#" title="CSV"><span><i
                class="fa fa-file-text-o"></i></span></a> -->
    <a class="dt-button buttons-csv buttons-html5" href="#" title="Preview"
        onClick="javascript:PrintPreview();"><span><i class="fa fa-search-plus"></i></span></a>


</div>
<div class="row">
    <div class="col-md-12 table-responsive" style="overflow-x:auto;">
        <div style="overflow-x:auto;">
            <b> Lead Data for - | <?php echo $from_date; ?> - <?php echo $to_date; ?></b>

            <br><br>

            <table align="center" id="gender_table" class="table table-striped table-bordered dt-responsive "
                style="width:100%" cellspacing="0">

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
                        <td><?php echo $inq->contact_method; ?></td>
                        <!-- need to edit this columns -->

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
</div>