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
            <td style="font-size:12px;font-weight:bold;padding:0.5em 1em" align="left">
                <?php echo $letter_content;?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
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