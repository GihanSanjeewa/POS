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

<!-- <td><?php echo date("Y-m-d", strtotime("last day of ".$year . "-" . $month)); ?></td> -->
<?php
// $month = 04;
// $year = 2021;           
// $week = date("W", strtotime($year . "-" . $month ."-01"));

// $str='';
// $str .= date("Y-m-d", strtotime($year . "-" . $month ."-01")) ."to";
// $unix = strtotime($year."W".$week ."+1 week");
// while(date("m", $unix) == $month){
//  $str .= date("Y-m-d", $unix-86400) . "|";
//  $str .= date("Y-m-d", $unix) ."to"; 
//  $unix = $unix + (86400*7);
// }
// $str .= date("Y-m-d", strtotime("last day of ".$year . "-" . $month));

// $weeks_ar = explode('|',$str);

// for($k=0;$k<5;$k++)
// {
//     // echo '<pre>'; print_r($weeks_ar[$k]);

//     var_dump($weeks_ar[$k]);
//     die();
// }

 ?>

<?php
 

 
    
$start = new DateTime($yr1_start);
$interval = new DateInterval('P1M');
$end = new DateTime($yr2_end);
$period = new DatePeriod($start, $interval, $end);


    



// var_dump($yr1_start);
// die();



?>


<div class="tab-content tabcontent-border">




    <a class="dt-button buttons-excel buttons-html5" href="#" title="Excel"
        onClick="javascript:fnExcelReport();"><span><i class="fa fa-file-excel-o"></i></span></a>

    <!-- <a class="dt-button buttons-print buttons-html5" onClick="javascript:PrintDiv();" href="#" title="Print"><span><i
                class="fa fa-print"></i></span></a> -->
    <!-- <a class="dt-button buttons-csv buttons-html5" onClick="javascript:exportTableToCSV('Gender_Report_Export.csv');" href="#" title="CSV"><span><i
                class="fa fa-file-text-o"></i></span></a> -->
    <!-- <a class="dt-button buttons-csv buttons-html5" href="#" title="Preview"
        onClick="javascript:PrintPreview();"><span><i class="fa fa-search-plus"></i></span></a> -->


</div>

<h6>Lead Target Report For - | <?php echo $yr1_start; ?> - <?php echo $yr2_end; ?> |</h6>
<table align="center" id="gender_table" class="table table-striped table-bordered dt-responsive " style="width:100%"
    cellspacing="0">

    <thead>
        <tr>
            <th style="font-size:12px;border:1px solid black;text-align:center;padding:70px;" rowspan="2">Program</th>


            <?php
 $intake_plan = $this->target->get_intake_plan($yr1_start,$yr2_end);


 
foreach ($period as $dt) {
    $yr = $dt->format('Y') . PHP_EOL;
    $month_id  = $dt->format('m') . PHP_EOL;
    $days=cal_days_in_month(CAL_GREGORIAN,$month_id,$yr);

     $weeks =5;
?>
            <th style="font-size:12px;background-color:#00008B;text-align:center;border:1px solid black;"
                colspan="<?php echo 2*($weeks) +2; ?>"><?php echo $dt->format('F   (Y-m-d)') . PHP_EOL;  ?></th>


            <?php   
            
         
            

}
            ?>
<?php
if($intake_plan)
{
    ?>
            <th colspan="<?php echo count($intake_plan);?>"
                style="font-size:12px;background-color:#00008B;text-align:center;border:1px solid black;">Intake Plan
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
            <th style="font-size:12px;background-color:#C0C0C0;color:black;text-align:center;border:1px solid black;">
                Monthly Target</th>
            <th style="font-size:12px;background-color:#808080;color:black;text-align:center;border:1px solid black;">
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
            <th style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $k+1; ?>.T</th>
            <th style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $k+1; ?>.A</th>
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
            <th style="font-size:12px;border:1px solid black;text-align:center;padding:70px;">
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
            <td style="font-size:12px;background-color:#ADD8E6;color:black;padding:70px;"><?php echo $pro->name ?></td>
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
            <td style="font-size:12px;text-align:center;border:1px solid black;">
                <?php echo $monthly_targets->month_target_sum; ?></td>
            <?php
              }else{
                  ?>
            <td style="font-size:12px;text-align:center;border:1px solid black;"></td>
            <?php
              }
                ?>
            <td style="font-size:12px;text-align:center;border:1px solid black;">
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
            <td style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $weekly_targets + $div; ?>
            </td>
            <?php

                        }else{
                            ?>
            <td style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $weekly_targets; ?></td>
            <?php
                        }

                        $date_rg = (explode("to",$weeks_ar[$k]));
                        $date1 = $date_rg[0];
                        $date2=$date_rg[1];

                        $weekly_actual_targets = $this->target->get_weekly_actual_targets($pro->id,$date1,$date2);

                        // var_dump($weekly_actual_targets->lead_count_weekly);
                        // die();
                        
                          ?>
             
            <td style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $weekly_actual_targets->lead_count_weekly; ?></td>
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


            <td style="font-size:12px;text-align:center;border:1px solid black;"><?php echo $intake_targets->target; ?>
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