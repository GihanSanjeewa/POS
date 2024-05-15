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
            <td align="left">Hi <strong style="color:#584adb"><?php echo $user_name;?></strong>,</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="background-color:#584adb;color:#fff;font-size:12px;font-weight:bold;padding:0.5em 1em" align="left">Arrow HRMS <span class="il">One Time Password (O T P) Confirmation</span></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left">Please use the following OTP <strong><?php echo $otp_code;?></strong> to complete your login.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td align="left">Note : This code will expire after 5 Minutes.</td>
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