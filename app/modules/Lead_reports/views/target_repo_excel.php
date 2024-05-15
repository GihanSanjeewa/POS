<!-- <style>

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
 </style> -->
<?php
$this->load->model('Target_repo_mod', 'target');
?>

<?php






$start = new DateTime($yr1_start);
$interval = new DateInterval('P1M');
$end = new DateTime($yr2_end);
$period = new DatePeriod($start, $interval, $end);

?>

<!-- <img src="<?php echo base_url('assets/images/iihs_repo.jpg'); ?>" class="light-logo" alt="logo"
    style="width:100%;height:350px; display: block" /> -->
<div class="row" id="target_div">

    <h6 style="font-size:20px;">Lead Target Report For - |<?php echo $yr1_start; ?> - <?php echo $yr2_end; ?>|</h6>
    <table align="center" id="gender_table" class="table table-striped table-bordered dt-responsive " style="width:100%"
    cellspacing="0">

    <thead>
        <tr>
            <th style="font-size:18px;border:1px solid black;text-align:center;padding:70px;" rowspan="2">Program</th>


            <?php
 $intake_plan = $this->target->get_intake_plan($yr1_start,$yr2_end);


 
foreach ($period as $dt) {
    $yr = $dt->format('Y') . PHP_EOL;
    $month_id  = $dt->format('m') . PHP_EOL;
    $days=cal_days_in_month(CAL_GREGORIAN,$month_id,$yr);

     $weeks =5;
?>
            <th style="font-size:18px;background-color:#00008B;text-align:center;border:1px solid black;color:white;"
                colspan="<?php echo 2*($weeks) +2; ?>"><?php echo $dt->format('F   (Y-m-d)') . PHP_EOL;  ?></th>


            <?php   
            
         
            

}
            ?>


<?php
if($intake_plan)
{
    ?>
     <th colspan="<?php echo count($intake_plan);?>"
                style="font-size:18px;background-color:#00008B;text-align:center;border:1px solid black;color:white;">Intake Plan
            </th>

    <?php
}
?>
           
        </tr>

        <tr>
            <!-- <th></th> -->
            <?php
foreach ($period as $dt) {
    $yr = $dt->format('Y');
    $month_id  = $dt->format('m');
    $days=cal_days_in_month(CAL_GREGORIAN,$month_id,$yr);

     $weeks =5;
      
      $date = $dt->format('Y-m-d');
      


      
    
      
?>
            <th style="font-size:18px;background-color:#C0C0C0;color:black;text-align:center;border:1px solid black;">
                Monthly Target</th>
            <th style="font-size:18px;background-color:#808080;color:black;text-align:center;border:1px solid black;">
                Monthly Actual Target</th>
            <?php
                    //   for($i=1; $i<= $weeks; $i++)
                    //   {
                          ?>




            <?php
$month = $month_id;
$year = $yr;           
$week = date("W", strtotime($year . "-" . $month ."-01"));

$str='';
$str .= date("Y-m-d", strtotime($year . "-" . $month ."-01")) ."to";
$unix = strtotime($year."W".$week ."+1 week");
while(date("m", $unix) == $month){
 $str .= date("Y-m-d", $unix-86400) . "|";
 $str .= date("Y-m-d", $unix) ."to"; 
 $unix = $unix + (86400*7);
}
$str .= date("Y-m-d", strtotime("last day of ".$year . "-" . $month));

$weeks_ar = explode('|',$str);

for($k=0;$k<5;$k++)
{
    // echo '<pre>'; print_r($weeks_ar[$k]);
?>
            <th style="font-size:18px;text-align:center;border:1px solid black;"><?php echo $k+1; ?>.T</th>
            <th style="font-size:18px;text-align:center;border:1px solid black;"><?php echo $k+1; ?>.A</th>
            <?php
    // var_dump($weeks_ar[$k]);
    // die();
}

 ?>
            <!-- <th style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $i; ?>.A</th> -->
            <?php
                    //   }
            ?>



            <?php
}
?>
            <?php
foreach($intake_plan as $in_pl)
{
    ?>
            <th style="font-size:18px;border:1px solid black;text-align:center;padding:70px;">
                (<?php echo $in_pl->c_code; ?>)<?php echo $in_pl->year; ?> - <?php echo $in_pl->intake_name; ?></th>
            <?php
}
?>

        </tr>

    </thead>

    <tbody>
        <?php
        foreach($programs_targets as $pro){

        ?>
        <tr>
            <td style="font-size:18px;background-color:#ADD8E6;color:black;padding:70px;border:1px solid black;"><?php echo $pro->name ?></td>
            <?php
            foreach ($period as $dt) {
                $yr = $dt->format('Y');
                $month_id  = $dt->format('m');
                $days=cal_days_in_month(CAL_GREGORIAN,$month_id,$yr);
            
                 $weeks = 5;
                 $month_start_date = $dt->format('Y-m-d');
                 $month_end_date = $dt->format('Y-m').'-'.$days;
                $monthly_targets = $this->target->get_monthly_targets($pro->id,$dt->format('Y-m'));
                $actual_monthly_targets = $this->target->get_actual_monthly_targets($pro->id,$month_start_date,$month_end_date);

                $weekly_targets = intval($monthly_targets->month_target_sum / 5);
                $number = range($dt->format('d'),$days);
                // var_dump($number);
                // die();
               
                
 
// var_dump($monthly_targets->month_target_sum/5);
// die();
              if($monthly_targets->month_target_sum != "" || $monthly_targets->month_target_sum != 0){
                ?>
            <td style="font-size:18px;text-align:center;border:1px solid black;">
                <?php echo $monthly_targets->month_target_sum; ?></td>
            <?php
              }else{
                  ?>
            <td style="font-size:18px;text-align:center;border:1px solid black;"></td>
            <?php
              }
                ?>
            <td style="font-size:18px;text-align:center;border:1px solid black;">
                <?php echo $actual_monthly_targets->lead_count; ?></td>
            <?php
$month = $month_id;
$year = $yr;           
$week = date("W", strtotime($year . "-" . $month ."-01"));

$str='';
$str .= date("Y-m-d", strtotime($year . "-" . $month ."-01")) ."to";
$unix = strtotime($year."W".$week ."+1 week");
while(date("m", $unix) == $month){
 $str .= date("Y-m-d", $unix-86400) . "|";
 $str .= date("Y-m-d", $unix) ."to"; 
 $unix = $unix + (86400*7);
}
$str .= date("Y-m-d", strtotime("last day of ".$year . "-" . $month));

$weeks_ar = explode('|',$str);


            // var_dump($weeks);
            // die();
                 for($k=0;$k<5;$k++)
                      {
                        if($k == 4 && ($weekly_targets * $weeks < intval($monthly_targets->month_target_sum)))
                        {
                            $div = intval($monthly_targets->month_target_sum) - $weekly_targets * $weeks;

                            ?>
            <td style="font-size:18px;text-align:center;border:1px solid black;"><?php echo $weekly_targets + $div; ?>
            </td>
            <?php

                        }else{
                            ?>
            <td style="font-size:18px;text-align:center;border:1px solid black;"><?php echo $weekly_targets; ?></td>
            <?php
                        }

                        $date_rg = (explode("to",$weeks_ar[$k]));
                        $date1 = $date_rg[0];
                        $date2=$date_rg[1];

                        $weekly_actual_targets = $this->target->get_weekly_actual_targets($pro->id,$date1,$date2);

                        // var_dump($weekly_actual_targets->lead_count_weekly);
                        // die();
                        
                          ?>
             
            <td style="font-size:18px;text-align:center;border:1px solid black;"><?php echo $weekly_actual_targets->lead_count_weekly; ?></td>
            <?php
                      }
                      ?>
            <?php
            }
                ?>
            <?php
                foreach($intake_plan as $in_pl)
{
    $intake_targets = $this->target->get_intake_targets($pro->id,$in_pl->bi_id,$yr1_start,$yr2_end);

//   var_dump($intake_targets);
//   die();
    ?>


            <td style="font-size:18px;text-align:center;border:1px solid black;"><?php echo $intake_targets->target; ?>
            </td>
            <?php
}
                ?>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

</div>


<script>
$(document).ready(function() {
    $('#target_div').hide();

    
});


function fnExcelReport() {
    var file = new Blob([$('#target_div').html()], {
        type: "application/vnd.ms-excel"
    });
    var url = URL.createObjectURL(file);
    var a = $("<a />", {
        href: url,
        download: "Lead_Target_Report_Export.xls"
    }).appendTo("body").get(0).click();
    e.preventDefault();
}

function PrintDiv() {
    var divToPrint = document.getElementById('target_div');
    var popupWin = window.open('', '_blank', 'width=1000,height=1000');
    popupWin.document.open();
    popupWin.document.write(
        '<html><head><title>Print</title></head><body onload="window.print()">' +
        divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}

function PrintPreview() {
    var toPrint = document.getElementById('target_div');
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
    var rows = document.querySelectorAll('#target_div tr');

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