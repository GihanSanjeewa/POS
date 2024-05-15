<?php
    
    $this->load->model('Lead_follow_up_mod','follow');
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

                        <th rowspan="2">Student's Counsellor</th>
                        <th rowspan="2">Course</th>
                        <th rowspan="2">Total Leads</th>
                        <!-- <th>Lead ID</th> -->
                        <th rowspan="2">Contacted</th>
                        <th rowspan="2">Not Contacted</th>
                        <th rowspan="2">Total</th>
                        <?php
                             foreach($interest_level  as $in){


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
             
            <table>
            <tr>
                <th style="font-size:40px;text-align:right;border:none;" colspan="10">
                    <?php  echo date("m/d/Y , h:i A"); ?></th>
            </tr>

        </table>
        
            <b style="font-size: 30px;"> Lead Data for - | <?php echo $from_date; ?> - <?php echo $to_date; ?></b>

            <br><br>

            <table id="tblStocks">

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
        download: "Lead_Follow_up_Export.xls"
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