<html>
<body>
    <table style="font-family:Verdana,sans-serif;font-size:11px;color:#374953;width:550px">
        <tbody>
        <tr>
            <td align="left"><a title="Arrow HRMS" href="<?php echo $baseurl;?>">

                    <?php
                    if(COMPANY_LOGO!="") {
                        $logo = "uploads/logo/".COMPANY_LOGO;
                    } else {
                        $logo = "assets/images/logo.png";
                    }
                    ?>
                    <img src="<?php echo base_url().$logo; ?>" style="border:none; height: 60px" alt="Arrow HRMS" />
                </a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left">Hi <strong style="color:#584adb"><?php echo $employee_name;?></strong>,</td>
        </tr>
        <tr>
            <td>&nbsp;Here is Your Project Assignment - Update</td>
        </tr>
        <tr>
            <td style="font-size:12px;font-weight:bold;padding:0.5em 1em" align="left">

                <table id="report_1" class="" style="border-collapse: collapse; text-align:center" width="100%" cellspacing="0" bordercolor="#000000" border="1">
                    <thead>
                    <tr>
                        <th class="w2">Employee ID</th>
                        <th class="w2">Project Code</th>
                        <th class="w2">Project Name</th>
                        <th class="w2">Sub Type</th>
                        <th class="w2">Sub Description</th>
                        <th class="w2">Status</th>
                        <th class="w2">Assign Date</th>
                        <th class="w2">Expected Date</th>
                        <th class="w2">Completed Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr style="">
                            <td><?php echo $employee_id?></td>
                            <td style="width: auto; text-align: left;  padding: 2px; "><?php echo $project_code?></td>
                            <td style="width: auto; text-align: left;  padding: 2px; "><?php echo $project_name?></td>
                            <td><?php echo $sub_name?></td>
                            <td><?php echo $sub_description?></td>
                            <td><?php echo $project_status?></td>
                            <td><?php echo $assign_date?></td>
                            <td><?php echo $expected_date?></td>
                            <td><?php echo $completed_date?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left">You can login to system via: <a href="<?php echo $baseurl;?>" target="_blank"">Arrow HRMS</a>.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="font-size:10px;border-top:1px solid #d9dade" align="center"><a style="color:#584adb;font-weight:bold;text-decoration:none" href="<?php echo $baseurl;?>" target="_blank"">Arrow ERP © 2018 All Rights Reserved. Authorized personnel only. </a></td>
        </tr>
        </tbody>
    </table>
</body>
</html>