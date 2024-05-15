<?php
$this->load->model('permissions_mod');
$current_user = $this->session->userdata('user_id');
?>
<?php
$currentURL = current_url();
$baseURL = base_url();
?>
<ul id="sidebarnav" class="main-menu">
    <li class="">
        <a href="<?php echo base_url('dashboard'); ?>">
            <div class="icon-w">
                <div class="icon-speedometer"></div>
            </div>
            <span>Dashboard</span>
        </a>
    </li>
    <?php $groups = array('admin', 'department', 'master');
    if ($this->ion_auth->in_group($groups)) { ?>

        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-lock"></div>
                </div>
                <span>Sales</span>
            </a>
            <div class="sub-menu-w" style="">
                <div class="sub-menu-i">
                    <ul class="sub-menu" style="min-width: 160px;">
                        <span style="text-align: center;font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Add Lead</span>
                        <?php $path = "Lead_module_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Lead_module_con") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('lead_management/Lead_module_con/index'); ?>">
                                    <i class="fa fa-book"></i>Lead Module</a>
                            </li>
                        <?php } ?> </br>
                    </ul>
                </div>
            </div>
        </li>

        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-lock"></div>
                </div>
                <span>Master Data</span>
            </a>
            <div class="sub-menu-w" style="">
                <div class="sub-menu-i">
                    <ul class="sub-menu" style="min-width: 160px;">
                        <span style="text-align: center;font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Lead Source Management</span>

                        <?php $path = "master_lead_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_lead_con") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('master/master_lead_con/index'); ?>">
                                    <i class="fa fa-book"></i>Grocery Items - Master</a>
                            </li>
                        <?php } ?> </br>

                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Lead type Management </span>

                        <?php $path = "master_lead_type_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_lead_type_con") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('master/master_lead_type_con/index'); ?>">
                                    <i class="fa fa-book"></i>Hardware Items - Master</a>
                            </li>
                        <?php } ?> </br>


                    </ul>

                    <!-- <ul class="sub-menu" style="min-width: 160px; ">
                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Industries Management </span>


                        <?php $path = "master_industry_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_industry_con") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('master/master_industry_con/index'); ?>">
                                    <i class="fa fa-bank"></i>Industries - Master</a>
                            </li>
                        <?php } ?> </br>

                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Products Management </span>
                        <?php $path = "Master_product_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "Master_product_con") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('master/Master_product_con/index'); ?>">
                                    <i class="fa fa-book"></i> Product - Master</a>
                            </li>
                        <?php } ?>

                    </ul>

                    <ul class="sub-menu" style="min-width: 160px;">

                        <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Deal Status Management </span>

                        <?php $path = "master_deal_status_con/index";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(2) == "master_deal_status_con") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('master/master_deal_status_con/index'); ?>">
                                    <i class="fa fa-bookmark"></i> Deal Status - Master </a>
                            </li>
                        <?php } ?> </br>

                    </ul> -->



                </div>
            </div>
        </li>

        <li class=" has-sub-menu">
            <a href="javascript:;">
                <div class="icon-w">
                    <div class="icon-lock"></div>
                </div>
                <span>Administration</span>
            </a>
            <div class="sub-menu-w" style="">
                <div class="sub-menu-i">
                    <ul class="sub-menu" style="min-width: 160px;">
                    
                        <!-- <span style="text-align: center; font-weight: 500;border-bottom: 1px solid #ffffff; text-transform: uppercase;">Administration - Master</span> -->
                        <?php $path = "Dashboard/system_log";
                        if ($this->permissions_mod->chk_module_permisson_data($path, $current_user)) { ?>
                            <li class="<?php if ($this->uri->segment(3) == "Dashboard") {
                                            echo 'active';
                                        } ?>">
                                <a href="<?php echo base_url('settings/Dashboard/system_log'); ?>">
                                    <i class="fa fa-code-fork"></i> System Log
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </li>
    <?php } ?>

</ul>