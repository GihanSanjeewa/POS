
<?php

$this->load->model('administration_mod');
?>

<link href="<?php echo base_url(); ?>assets/node_modules/OrgChart/dist/css/jquery.orgchart.min.css" rel="stylesheet">
<style type="text/css">
    #ul-data {
        position: relative;
        top: -60px;
        display: inline-block;
        margin-left: 10%;
        width: 30%;
        margin-right: 6%;
    }
    #chart-container {
        display: inline-block;
        width: 100%;
        font-family: Arial;
        height: 420px;
        border: 2px dashed #aaa;
        border-radius: 5px;
        overflow: auto;
        text-align: center;
    }

    .orgchart {
        background: #fff;
    }

    #ul-data li { font-size: 32px; }
</style>

<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor"></h4>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Organization Info</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="element-wrapper">
            <div class="element-actions">
            </div>
            <!--<h6 class="element-header">

            </h6>-->
            <div class="card-header bg-info page-head-title-wrap">
                <h4 class="page-head-title card-title  text-white" style="display: inline-block"> Organization Info</h4>
                <a class="btn btn-success pull-right" href="<?php echo base_url('settings/administration/hr_org_settings')?>" style="color: #fff;"><i class="fa fa-edit"></i> EDIT </a>
            </div>
            <div class="element-box">
                <div class="company-info-block">
                    <div class="organisation-info-block">
                        <div class="organisation-logo">
                            <?php if ($this->administration_mod->setting('company_logo')) { ?>
                                <img src="<?php echo base_url(); ?>uploads/logo/<?php echo $this->administration_mod->setting('company_logo'); ?>" class="imgbrdr"  height="70px" align="middle"><br>
                                <?php echo anchor('settings/administration/remove_logo/company', 'Remove Logo'); ?><br>
                            <?php } ?>
                        </div>
                        <div class="organisation-text">
                            <?php if ($this->administration_mod->setting('company_description')) { ?>
                                <?php echo $this->administration_mod->setting('company_description'); ?>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="org-address-block">
                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                            <tr>
                                <td class="td-1" valign="top" align="left">
                                    <div class="company-info"><label>Organization<b>:</b></label><span> <?php echo $this->administration_mod->setting('company_name'); ?></span>
                                    </div>
                                    <div class="company-info alter-div"><label>Business Domain <b>:</b></label>
                                        <span><?php echo $this->administration_mod->setting('company_domain'); ?></span>
                                    </div>
                                    <div class="company-info"><label>Website <b>:</b></label><span><a
                                                    href="http://<?php echo $this->administration_mod->setting('company_website'); ?>"
                                                    target="new"><?php echo $this->administration_mod->setting('company_website'); ?></a></span></div>
                                    <div class="company-info alter-div">
                                        <label>Total Employees <b>:</b></label>
                                        <span><?php echo $this->administration_mod->setting('company_tot_emp'); ?></span>
                                    </div>
                                    <div class="company-info">
                                        <label> Started On <b>:</b></label>
                                        <span><?php echo $this->administration_mod->setting('company_start_date'); ?></span>
                                    </div>
                                    <div class="company-info alter-div"><label>Primary Phone <b>:</b></label><span><?php echo $this->administration_mod->setting('company_phone_1'); ?></span>
                                    </div>
                                    <div class="company-info"><label>Secondary Phone
                                            <b>:</b></label><span><?php echo $this->administration_mod->setting('company_phone_2'); ?></span>
                                    </div>
                                    <div class="company-info">
                                        <label> Address <b>:</b></label>
                                        <span><?php echo $this->administration_mod->setting('company_address'); ?></span>
                                    </div>
                                </td>
                                <td class="td-2" style="position: relative;" valign="top" align="left">
                                    <div class="address-map-total">
                                        <!--<div class="address-hide-show"><span id="addtwo" onclick="showAddress(2);"class="">Map</span><span id="addone"onclick="showAddress(1);" class="add-main">Address</span></div>-->
                                    </div>
                                    <ul id="ul-data" style="display: none;">
                                        <li><?php echo $this->administration_mod->setting('company_name'); ?>
                                            <ul>
                                                <?php
                                                foreach($departments as $department){
                                                    echo '<li>';
                                                    echo $department->desc;
                                                    echo '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                    </ul>
                                    <div id="chart-container"></div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/node_modules/OrgChart/dist/js/jquery.orgchart.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js" type="text/javascript"></script>

<script>

    $(document).ready(function(){
        $.ajax({
            url : "<?php echo site_url('settings/administration/ajax_get_departments')?>/",
            type: "POST",
            "data": {
                "<?php echo $this->security->get_csrf_token_name(); ?>": "<?php echo $this->security->get_csrf_hash(); ?>"
            },
            dataType: "JSON",
            success: function(data)
            {
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                console.log('Error retrieve data from ajax');
            }
        });

        $('#chart-container').orgchart({
            'data' : $('#ul-data'),
            exportButton: true
        });
    });

</script>


