<?php
/**
 * Created by Earrow.
 * User:Kasun De Mel
 * Email:kasun@earrow.net
 * Date: 10/15/2019
 * Time: 6:46 PM
 */


$connection = mysqli_connect('aqagri.db.9417633.f0c.hostedresource.net', 'aqagri', 'E76SjY@gRrFZp', 'aqagri');
//$connection = mysqli_connect('localhost', 'root', '', 'agriculture_db');

if(mysqli_connect_error()){

    die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
}


$arr1 = array();
$arr2 = array();
$arr3 = array();

//please replace the post to get when upload the live
if(isset($_GET) & !empty($_GET)) {

    $html='';
    $html_exam_type='';
    $html_result='';

    $id = $_GET['id'];
    $sql1 = "SELECT std.id,std.student_id,std.name,std.nic_number FROM asms_students_info std WHERE (std.student_id='$id' OR std.nic_number='$id')";
    $res1 = mysqli_query($connection, $sql1);


    if (!$res1) {
        $html.='<b style="color: red">No Results Found !</b>';
    } else {

        if ($student = mysqli_fetch_array($res1)) {

            $sql2 = "SELECT semester,subject,semester_name,subject_name FROM asms_student_publish_results WHERE student=" . $student['id'] . " GROUP BY semester ORDER BY semester ASC";
            $res2 = mysqli_query($connection, $sql2);

            $html .= '<table class="table" style="margin-top: 10px;width: 50%;margin-left: 20%;border-top: 0px;">
<tr>
<td style="text-align: left;"><label>Name</label></td>
<td><label>:</label></td>
<td style="text-align: left">' . $student['name'] . '</td>
</tr>
<tr>
<td style="text-align: left"><label>Student ID</label></td>
<td><label>:</label></td>
<td style="text-align: left">' . $student['student_id'] . '</td>
</tr>
<tr>
<td style="text-align: left"><label>NIC</label></td>
<td><label>:</label></td>
<td style="text-align: left">' . $student['nic_number'] . '</td>
</tr>
</table>';

            $x = 1;
            if ($semesters = mysqli_fetch_assoc($res2)) {

                $html .= '<table border="" class="table">';
                foreach ($semesters as $key2 => $sem) {
                    $html .= '<tr>
<th>
<b>' . $sem[2] . '</b>
</th>
</tr>
<tr>
<td>';
                    $sql3 = "SELECT semester,subject,subject_name,result,exam_type,created_at FROM asms_student_publish_results WHERE student=" . $student['id'] . " AND semester=" . $sem[0] . " GROUP BY subject,exam_type ORDER BY subject ASC";
                    $res3 = mysqli_query($connection, $sql3);
                    if ($subjects = mysqli_fetch_row($res3)) {

                        $html .= '<table style="border-width: 1px;text-align: center;margin: 0px auto;border-color: #3882ad;border-width: 1px;width: 100%;" border="1"><tr>
<th style="height: 10px;width:5px;">#</th>
<th style="height: 10px">Subject Name</th>
<th style="height: 10px;width: 10px;">Result</th>
<th  style="height: 10px;width: 10px;" title="Repeat/Re-Repeat...">R/RR/RR</th>
<th  style="height: 10px;width: 10px;">Year</th>
</tr>';
                        foreach ($subjects as $key3 => $sub) {
                            $html .= '<tr>
                            <td>' . $x . '</td>
                            <td style="text-align: left">' . $sub[2] . '</td>';

                            if($sub[3] == "Pass"){
                                $html_result='<span style="background-color: #31cc7d;color: white;border-radius: 5px">&nbsp;&nbsp;Pass&nbsp;&nbsp;</span>';
                            }
                            else if($sub[3] == "Fail"){
                                $html_result='<span style="background-color: #cc1020;color: white;border-radius: 5px">&nbsp;&nbsp;Fail&nbsp;&nbsp;</span>';
                            }
                            else if($sub[3] == "Absent"){
                                $html_result= '<span style="background-color: #cc6832;color: white;border-radius: 5px">&nbsp;&nbsp;Absent&nbsp;&nbsp;</span>';
                            }

                            $html.='<td>' . $html_result . '</td>';
                            $exam_type = "";
                            if ($sub[4] == "N") {
                                if($sub[3] == "Pass"){
                                    $html_exam_type = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
                                }
                                else{
                                    $html_exam_type = '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                }
                            } else if ($sub[4] == "R"){
                                $html_exam_type = '<span style="background-color: #ff8545;color: white;border-radius: 5px">&nbsp;&nbsp;R&nbsp;&nbsp;</span>';
                            } else if ($sub[4] == "RR") {
                                $html_exam_type = '<span style="background-color: #cc4c42;color: white;border-radius: 5px">&nbsp;&nbsp;Repeat&nbsp;&nbsp;</span>';
                            } else if ($sub[4] == "RRR") {
                                $html_exam_type = '<span style="background-color: #cc1020;color: white;border-radius: 5px">&nbsp;&nbsp;Re-Repeat&nbsp;&nbsp;</span>';
                            }
                            $html .= '<td>' . $html_exam_type . '</td>
                            <td>'.date("Y",strtotime($sub[5])).'</td></tr>';
                            $x++;
                        }

                        $html .= '</table></td></tr>';

                    }
                }

                $html .= '</table>';
            }
        }
    }
    print_r($html);
    die();
}

