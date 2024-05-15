<?php
    
    $this->load->model('Lead_follow_up_mod','follow');
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

            
            <style>
 
table{
    overflow-x:auto;
    border-collapse:collapse;
    width:100%;
    margin-top:30px;

 }
 th,td{
    font-size:25px;
    border:2px solid black;
    padding:15px;
  

 }
</style>
            <table align="center" id="gender_table" class="table table-striped table-bordered dt-responsive "
                style="width:100%" cellspacing="0">


                <thead>
                    <tr>

                        <th rowspan="2">Student's Counsellor</th>
                        <th rowspan="2">Course</th>
                        <th rowspan="2">Total Leads</th>
                        <!-- <th>Lead ID</th> -->
                        <th rowspan="2">Contacted</th>
                        <th rowspan="2">Not Contacted</th>
                        <th rowspan="2">Total</th>
                        <?php
                             foreach($interest_level  as $in){
                                // var_dump('hello',$in);

                                if($in->name == "Positive")
                                {
                                    echo '<th colspan="2" style="background-color:green;text-align:center;">Positive</th> ';
                                    
                                }else if($in->name == "Moderate")
                                {
                                    echo '<th colspan="2" style="background-color:#1C86EE;text-align:center;">Moderate</th> ';                                    
                                   
                                }else if($in->name == "Low")
                                {
                                    echo '<th colspan="2" style="background-color:red;text-align:center;">Low</th> ';
                    
                                }else if($in->name == "Not Interest")
                                {
                                    echo '<th colspan="2" style="background-color:#707070;text-align:center;">Not Interest</th> ';
                                    
                                }

                        ?>
                        
                      <!-- <th colspan="2"><?php echo $in->name; ?></th> -->
                        <?php
                             }
                             ?>


                    </tr>


                    <tr>

                       
                      
                        <?php
                             foreach($interest_level  as $in){

 ?>




<th style="background-color:white;color:black;">Contacted</th>
<th style="background-color:white;color:black;">Not Contacted</th>
                        
                      
                        <?php
                             }
                             ?>
                         


                    </tr>
                </thead>
                <tbody>
                    <?php
                           foreach($coun_Data as $coun){
                            $course_data = $this->follow->course_data($coun->lead_owner);
                            $count_couse_data =count($course_data);
                            $all_leads_by_owner =$this->follow->all_leads_by_owner($coun->lead_owner);
                            $count_all_leads_by_owner=count($all_leads_by_owner);
                             
                            

                             
 
                            
                    ?>

                    <tr>

                        <td rowspan="<?php echo $count_couse_data; ?>"><?php echo $coun->l_coun; ?></td>

                        <?php
                   foreach($course_data as $c_data){
                        $lead_data = $this->follow->lead_data($coun->lead_owner,$c_data->cid);
                        $count_lead_data =count($lead_data);
                        // $sep_contact_count =$this->follow->sep_contact_count($c_data->ld_tb_id,$from_date,$to_date);

 
                        $count=0;
                            foreach($sep_contact_count as $sep)
                            {
                                $count = $count + $sep->id;
                            }





     
?>


                        <td><?php echo $c_data->ccode; ?></td>


                        <td><?php echo $count_lead_data; ?></td>
                        




                        <?php
                        $count=0;
                        $count2=0;
                   foreach($lead_data as $l_data){

                    $sep_contact_count =$this->follow->sep_contact_count($l_data->id,$from_date,$to_date);
                    $sep_not_contact_count =$this->follow->sep_not_contact_count($l_data->id,$from_date,$to_date);
                    $sep_not_contact_count =$this->follow->sep_not_contact_count($l_data->id,$from_date,$to_date);
 
     
                           $count = $count + $sep_contact_count;
                           $count2 = $count2 + $sep_not_contact_count;

 }
 ?>

<td><?php echo $count; ?></td>
<td><?php echo $count2; ?></td>
<td><?php echo $count+$count2; ?></td>
<?php
foreach($interest_level  as $in){

$lead_status_conected= $this->follow->int_contact_count($coun->lead_owner,$c_data->cid,$from_date,$to_date,$in->int_id);
$lead_status_not_conected= $this->follow->int_not_contact_count($coun->lead_owner,$c_data->cid,$from_date,$to_date,$in->int_id);

?>

<td><?php echo $lead_status_conected; ?></td>
<td><?php echo $lead_status_not_conected; ?></td>

<?php
}
?>













</tr>
                    <?php
                           }
                        ?>








                    <?php
                           }
                           ?>

                </tbody>
            </table>
        </div>
    </div>
</div>