<?php
    
    foreach($agentDetail as $agent){
        $appId =$agent->lead_temp_code;
    }

?>
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h6 class="text-themecolor">Dashboard & Statistics</h6>
    </div>
    <div class="col-md-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
  
</div>


<div id="hr">
    <div class="row">
         <div class="col-md-12" >

                    <div class="element-wrapper" >
                        <div class="element-actions">
                        </div>
                        <div class="card-header bg-primary">
                            <h4 class="card-title  text-white" style="display: inline-block"> Agent Profile</h4>
                        </div>
                        <div class="element-box"> 

                            <div class="row">
  <div class="col-sm-4">
    <div class="user-profile compact">
      <div class="up-head-w" style="background-image:url(img/profile_bg1.jpg)">
        <div class="up-social">
         <!--  <a href="#"><i class="os-icon os-icon-twitter"></i></a><a href="#"><i class="os-icon os-icon-facebook"></i></a> -->
        </div>
        <div class="up-main-info">
          <h2 class="up-header">
            <?php echo $agent->f_name.' '.$agent->l_name;?>
          </h2>
          <h6 class="up-sub-header">
            Lead Agent
          </h6>
        </div>
        <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
      </div>

         <div class="up-controls">
        <div class="row">
          <div class="col-sm-6">
            <div class="value-pair">
              <div class="label">
                Status:
              </div>
              <div class="value badge badge-pill badge-success">
                Active
              </div>
            </div>
          </div>
         <!--  <div class="col-sm-6 text-right">
            <a class="btn btn-primary btn-sm" href=""><i class="os-icon os-icon-link-3"></i><span>Add to Friends</span></a>
          </div> -->
        </div>
      </div>

      <div class="up-contents">
        <div class="m-b">
          <div class="row m-b">
            <div class="col-sm-4 b-r b-b">
              <div class="el-tablo centered padded-v">
                <div class="value">
                  25
                </div>
                <div class="label">
                  Copleted Leads
                </div>
              </div>
            </div>
             <div class="col-sm-4 b-r b-b">
              <div class="el-tablo centered padded-v">
                <div class="value">
                  25
                </div>
                <div class="label">
                  Cancelled Leads
                </div>
              </div>
            </div>
            <div class="col-sm-4 b-b">
              <div class="el-tablo centered padded-v">
                <div class="value">
                  315
                </div>
                <div class="label">
                  Pre Leads
                </div>
              </div>
            </div>           
          </div>
          <div class="padded">
            <div class="os-progress-bar primary">
              <div class="bar-labels">
                <div class="bar-label-left">
                  <span>Target Lead</span>
                <!--   <span class="positive">+10</span> -->
                </div>
                <div class="bar-label-right">
                  <span class="info">72/100</span>
                </div>
              </div>
              <div class="bar-level-1" style="width: 100%">
                <div class="bar-level-2" style="width: 80%">
                  <div class="bar-level-3" style="width: 30%"></div>
                </div>
              </div>
            </div>
            <div class="os-progress-bar primary">
              <div class="bar-labels">
                <div class="bar-label-left">
                  <span>Currunt Month Achivement</span>
              <!--     <span class="positive">+5</span> -->
                </div>
                <div class="bar-label-right">
                  <span class="info">45/100</span>
                </div>
              </div>
              <div class="bar-level-1" style="width: 100%">
                <div class="bar-level-2" style="width: 30%">
                  <div class="bar-level-3" style="width: 10%"></div>
                </div>
              </div>
            </div>
            <div class="os-progress-bar primary">
              <div class="bar-labels">
                <div class="bar-label-left">
                  <span>Last Month Achivement</span>
          <!--         <span class="negative">-12</span> -->
                </div>
                <div class="bar-label-right">
                  <span class="info">74/100</span>
                </div>
              </div>
              <div class="bar-level-1" style="width: 100%">
                <div class="bar-level-2" style="width: 80%">
                  <div class="bar-level-3" style="width: 60%"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
          <div class="element-wrapper">
                <h6 class="element-header">
                  User Account Status
                </h6>
                <div class="element-box-tp">
               
                  <div class="users-list-w">
                    <div class="user-w with-status status-red">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar1.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          Lead Manager
                        </h6>
                        <div class="user-role">
                          Max Account 1
                        </div>
                      </div>
                      <a class="user-action" href="<?php echo base_url('settings/System_users_agent/index'); ?>"> 
                        <div class="icon-user"><span style="color: #21cf0c;">&nbsp;<?php echo  ($l_m_count != '') ? $l_m_count : 0; ?></span></div>
                      </a>
                    </div>
                    <div class="user-w with-status status-red">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar2.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          Lead Assistant Manager
                        </h6>
                        <div class="user-role">
                          Max Account 2
                        </div>
                      </div>
                      <a class="user-action"  href="<?php echo base_url('settings/System_users_agent/index'); ?>">
                       <div class="icon-user"><span style="color: #21cf0c;">&nbsp;<?php echo  ($l_am_count != '') ? $l_am_count : 0; ?></span></div>
                      </a>
                    </div>
                    <div class="user-w with-status status-red">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar3.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          Lead Agent
                        </h6>
                        <div class="user-role">
                          Max Account 5
                        </div>
                      </div>
                      <a class="user-action"  href="<?php echo base_url('settings/System_users_agent/index'); ?>">
                        <div class="icon-user"><span style="color: #21cf0c;">&nbsp;<?php echo  ($l_ag_count != '') ? $l_ag_count : 0; ?></span></div>
                      </a>
                    </div>
                   
                  </div>
                </div>
              </div>
     <div class="element-wrapper">
                <h6 class="element-header">
                  Commision Details
                </h6>
                <div class="element-box-tp">

                  <div class="col-md-12">
                      <table align="center" id="module_table" style="width:80%;" class="responstable"  style="margin-top: 20px">
                        <thead>
                          <tr>
                            <th style="border:1px solid gray;">Course Type</th>
                            <th  style="border:1px solid gray;text-align: center;">Commission (%)</th>
                          </tr>
                        </thead>
                        <tbody id="view_commissions_2">
                          <?php

                          foreach($agent_commision_Details as $agent_commision){

                           ?>
                          <tr><td><span class="mr-2 mb-2 btn btn-outline-primary" onclick="view_course_commision(<?php echo $agent_commision->course_type; ?>);"><?php echo $agent_commision->pt_name; ?></span></td><td style="text-align: center;"><span class="mr-2 mb-2 btn btn-outline-success"><?php echo $agent_commision->commission; ?></span></td></tr>
                          <?php } ?>
                        </tbody> 
                      </table>
                  </div>
          
               <!--    <div class="users-list-w">
                    <div class="user-w with-status status-green">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar1.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          John Mayers
                        </h6>
                        <div class="user-role">
                   Lead Developer
                        </div>
                      </div>
                      <div class="user-action">
                        <div class="os-icon os-icon-signs-11"></div>
                      </div>
                    </div>
                    <div class="user-w with-status status-green">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar2.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          Ben Gossman
                        </h6>
                        <div class="user-role">
                     Lead Developer
                        </div>
                      </div>
                      <div class="user-action">
                          <div class="os-icon os-icon-signs-11"></div>
                      </div>
                    </div>
                    <div class="user-w with-status status-red">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar3.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          Phil Nokorin
                        </h6>
                        <div class="user-role">
                     Lead Developer
                        </div>
                      </div>
                      <div class="user-action">
                       <div class="os-icon os-icon-signs-11"></div>
                      </div>
                    </div>
                    <div class="user-w with-status status-green">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar4.jpg">
                        </div>
                      </div>
                      <div class="user-name">
                        <h6 class="user-title">
                          Jenny Miksa
                        </h6>
                        <div class="user-role">
                          Lead Developer
                        </div>
                      </div>
                      <div class="user-action">
                          <div class="os-icon os-icon-signs-11"></div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>

  </div>
  <div class="col-sm-8">
    <div class="element-wrapper">
           
                                   <div class="element-box">

                                       <form id="class_form_agen" class="class_form">
                                            <div class="form-desc"  style="color:black;font-weight: 600;">
                                       Geeral Details : 
                                      </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                          <div class="form-group">
                                             <label for=""> Agent ID</label>
                                        <input class="form-control"  type="text" name="app_id" id="app_id" value="<?php echo $agent->lead_code;?>" readonly>
                                          </div>
                                        </div>
                                        <div class="col-sm-9">
                                          <div class="form-group">
                                             <label for=""> Company Name </label>
                                        <input class="form-control" placeholder="Company Name" name="com_name" id="com_name" type="text" value="<?php echo $agent->copany_name;?>">
                                        <span class="error-block"></span>
                                          </div>
                                        </div>
                                      </div>

                                          <div class="form-desc">
                                      </div>

                                       <div class="row">
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                      
                                            <label for="">Title</label>
                                      
                                            <input class="form-control"  name="title_name" id="title_name" type="text" value="<?php echo $agent->title;?>">
                                            <span class="error-block"></span>
                                          </div>                                         
                                        </div>
                                        <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Managing principal’s Name:</label>
                                                <input class="form-control" name="princ_name" id="princ_name" placeholder="Managing principal’s Name" type="text" value="<?php echo $agent->f_name;?>">
                                                <span class="error-block"></span>
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> Middle Name:</label>
                                                <input class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name"  type="text" value="<?php echo $agent->m_name;?>">
                                          </div>
                                        </div>
                                         <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Last Name:</label>
                                                <input class="form-control" name="last_name" id="last_name" placeholder="Last Name"  type="text" value="<?php echo $agent->l_name;?>">
                                          </div>
                                        </div>
                                      </div>

                                <!--       <div class="form-desc" style="color:black !important;">
                                       Preferred Contact Method (Select one): <span style="color: red">*</span>
                                      </div> -->

                                      <div class="form-desc">
                                      </div>

                                    <div class="row">
                                         <div class="col-sm-3">
                                          <div class="form-radio">
                                            <label class="form-radio-label"> Contact Deatils: </label>
                                          </div>  
                                          <span class="error-block"></span>                                      
                                        </div>
                                        <!-- <div class="col-sm-1">
                                          <div class="form-radio">
                                            <input class="form-radio-input" name="radio_1" id="radio_1" type="radio" value="email"><label class="form-radio-label">Email</label>
                                          </div>                                        
                                        </div>
                                        <div class="col-sm-1">
                                         <div class="form-radio">
                                            <input class="form-radio-input" name="radio_1" id="radio_1" type="radio" value="phone"><label class="form-radio-label">Phone</label>
                                          </div>
                                        </div>  -->
                                        <div class="col-sm-4" id="email">
                                         <div class="form-group">
                                             <label for=""> Email:</label>
                                                <input class="form-control" name="contact_email" id="contact_email" placeholder="Email"  type="text" value="<?php echo $agent->email;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-3" id="phone">
                                         <div class="form-group">
                                             <label for=""> Phone - Agent:</label>
                                                <input class="form-control" name="contact_phone" id="contact_phone" placeholder="Phone"  type="text" value="<?php echo $agent->phone;?>">
                                          </div>
                                        </div>                                        
                                      </div>

                                    <div class="form-desc"  style="color:black;font-weight: 600;">
                                       Company Address : 
                                      </div>

                                    <div class="row">                                  
                                        <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Address 01:</label>
                                                <input class="form-control" name="address1" id="address1"  placeholder="Address 01" type="text" value="<?php echo $agent->address_1;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Address 02:</label>
                                               <input class="form-control" name="address2" id="address2" placeholder="Address 02" type="text" value="<?php echo $agent->address_2;?>">
                                          </div>
                                        </div>
                                         <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Address 03:</label>
                                               <input class="form-control" name="address3" id="address3" placeholder="Address 03" type="text" value="<?php echo $agent->address_3;?>">
                                          </div>
                                        </div>
                                      </div>

                                    <div class="form-desc"></div>

                                    <div class="row">                                  
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> City:</label>
                                                <input class="form-control" name="city" id="city" placeholder="City" type="text" value="<?php echo $agent->city;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> State/Region/Province:</label>
                                               <input class="form-control" name="state" id="state"  placeholder="State/Region/Province" type="text" value="<?php echo $agent->s_r_p;?>">
                                          </div>
                                        </div>
                                         <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> Postal/Zip Code:</label>
                                               <input class="form-control" name="postal" id="postal" placeholder="Postal/Zip Code" type="text" value="<?php echo $agent->postal;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> Country:</label>
                                             <input class="form-control" name="country_name" id="country_name" type="text" value="<?php echo $agent->name;?>">
                                          </div>
                                        </div>
                                      </div>

                                      <div class="form-desc"></div>
                                    <div class="row">                                  
                                        <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Company website:</label>
                                                <input class="form-control" name="web" id="web"  placeholder="Company Website" type="text" value="<?php echo $agent->website;?>">
                                          </div>
                                        </div>
                                        <!-- <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Company logo:</label>
                                               <input class="form-control" name="com_logo" id="com_logo"  type="file" id="myfile" name="myfile" >
                                          </div>
                                        </div> -->
                                         <div class="col-sm-4">
                                         <div class="form-group">
                                             <label for=""> Phone Number:</label>
                                               <input class="form-control" name="com_phone" id="com_phone"  placeholder="Phone Number" type="text" value="<?php echo $agent->phone_numebr;?>">
                                               <span class="error-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                           <div class="form-desc"></div>

                                    <div class="row">                                  
                                        <div class="col-sm-6">
                                         <div class="form-group">
                                             <label for=""> Company linked in profile:</label>
                                                <input class="form-control" name="com_linkedIn" id="com_linkedIn"  placeholder="linked in" type="text" value="<?php echo $agent->link_in;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-6">
                                         <div class="form-group">
                                             <label for=""> Company Facebook page:</label>
                                               <input class="form-control" name="com_fb" id="com_fb"  placeholder="Facebook" type="text" value="<?php echo $agent->facebook;?>">
                                          </div>
                                        </div>
                                         
                                      </div>

                                       <div class="form-desc"></div>

                                        <div class="form-desc" style="color:black;font-weight: 600;">Bank Details:</div>

                                    <div class="row">                                  
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> Bank Account Name:</label>
                                                <input class="form-control" name="bank_ac_name" id="bank_ac_name" placeholder="Account Name" type="text" value="<?php echo $agent->bank_account_name;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> Bank name:</label>
                                               <input class="form-control" name="bank_name" id="bank_name" placeholder="Bank name" type="text" value="<?php echo $agent->bank_name;?>">
                                          </div>
                                        </div>
                                         <div class="col-sm-6">
                                         <div class="form-group">
                                             <label for=""> Bank branch address:</label>
                                               <input class="form-control" name="bank_branch" id="bank_branch" placeholder="Branch address" type="text" value="<?php echo $agent->branch_address;?>">
                                          </div>
                                        </div>
                                      </div>

                                        <div class="row">                                  
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> BSB:</label>
                                                <input class="form-control" name="bank_bsb" id="bank_bsb" placeholder="BSB" type="text" value="<?php echo $agent->bsb;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> Bank account number:</label>
                                               <input class="form-control" name="bank_num" id="bank_num" placeholder="Account number" type="text" value="<?php echo $agent->bank_acc;?>">
                                          </div>
                                        </div>
                                         <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> SWIFT Code:</label>
                                               <input class="form-control" name="bank_swift" id="bank_swift"  placeholder="SWIFT Code" type="text" value="<?php echo $agent->swift_code;?>">
                                          </div>
                                        </div>
                                        <div class="col-sm-3">
                                         <div class="form-group">
                                             <label for=""> IBAN:</label>
                                               <input class="form-control" name="bank_iban" id="bank_iban" placeholder="IBAN" type="text" value="<?php echo $agent->iban;?>">
                                          </div>
                                        </div>
                                      </div>

                                                                               <div class="form-desc"></div>

                                <div class="form-desc" style="color:black;font-weight: 600;">Key Staff Details:</div>

                                      <div class="row"> 

                                        <table width="90%">
                                            <tr>
                                            <td colspan="2"><label>Key Staff member 1</label></td>
                                            <td colspan="2"><label>Key Staff member 2</label></td>
                                            </tr>
                                            <tr>
                                                <td><label for=""> Title:</label></td>
                                                <td>
                                                  <input class="form-control"  name="email1" id="email1" type="text" value="<?php echo $agent->agnt_title_1;?>">
                                                </td>
                                                <td><label for=""> Title:</label></td>
                                                <td>
                                                    <input class="form-control"   name="email1" id="email1" type="text" value="<?php echo $agent->agnt_title_2;?>">
                                                </td>
                                              
                                            </tr>
                                             <tr>
                                                 <td><label for=""> Name:</label></td>
                                                <td><input class="form-control" name="email1" id="email1" type="text" value="<?php echo $agent->agnt_name_1;?>"></td>
                                                 <td><label for=""> Name:</label></td>
                                                <td><input class="form-control" name="email1" id="email1" type="text" value="<?php echo $agent->agnt_name_2;?>"></td>
                                              
                                            </tr>
                                            <tr>
                                                <td><label for=""> Email:</label></td>
                                                <td><input class="form-control"  placeholder="Email" name="email1" id="email1" type="text" value="<?php echo $agent->agnt_email_1;?>"></td>
                                                <td><label for=""> Email:</label></td>
                                                <td><input class="form-control"  placeholder="Email" name="email2" id="email2" type="text" value="<?php echo $agent->agnt_email_2;?>"></td>
                                            </tr>
                                            <tr>
                                                <td><label for=""> Phone:</label></td>
                                                <td><input class="form-control"  placeholder="Phone" name="phone1" id="phone1" type="text" value="<?php echo $agent->agnt_phone_1;?>"></td>
                                                <td><label for=""> Phone:</label></td>
                                                <td><input class="form-control"  placeholder="Phone" name="phone2" id="phone2" type="text" value="<?php echo $agent->agnt_phone_2;?>"></td>
                                            </tr>
                                        </table> 
                                    </div>

                        </form>

                                     <!-- <div class="row">                                  
                                        <div class="col-sm-12" style="text-align: center;">
                                            <button type="button" id="arrangeBtn" onclick="save()"
                                        class="btn btn-primary">Save</button>
                                        </div>
                                      </div> -->

                                
                                   
                                  </div>
    </div>
  </div>
</div>
                                                                                                                                                                                                                      
                        </div>

                    </div>
                </div>

    </div>
</div>

</div>
</div>


                    <div class="modal fade" id="grn_details" role="dialog">
                        <div class="modal-dialog modal-full" style="max-width: 700px">
                            <div class="modal-content">
                                <div class="modal-header bg-blue-steel bg-font-blue-steel">
                                    <h6 id="grn_title" class="modal-title" ></h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body form" id="grn_details_title">
                                   
                                </div>
                                <div class="modal-footer">
                          <!--           <button id="save_btn" type="button" onclick="update_statsu()" class="btn btn-primary">Save</button> -->
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>

<script src="<?php echo base_url(); ?>assets/js/charts/chart.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/chart.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/charts/chart.PieceLabel.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {

        var myChartMData1 = {
            type: 'bar',
            data: {
                labels: [<?php echo $batch_name; ?>],
                datasets: [
                    {
                        label: 'Students',
                        data: [<?php echo $student_count; ?>],
                        fill: false,
                        backgroundColor: [<?php echo $batch_color; ?>],
                        borderColor: [<?php echo $batch_color; ?>],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Student Count'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Count In Batch'
                }
            }
        };

        document.getElementById("chartContainer1").innerHTML = '&nbsp;';
        document.getElementById("chartContainer1").innerHTML = '<canvas id="PieChart1"></canvas>';
        var ctx1 = document.getElementById("PieChart1").getContext('2d');
        window.myBarCM = new Chart(ctx1, myChartMData1);


        var myChartMData = {
            type: 'bar',
            data: {
                labels: [<?php echo $dates; ?>],
                datasets: [
                    {
                        label: 'Present',
                        data: [<?php echo $present; ?>],
                        fill: false,
                        backgroundColor: '#96d277',
                        borderColor: '#96d277',
                        borderWidth: 1
                    },
                    {
                        label: 'Absent',
                        data: [<?php echo $absent; ?>],
                        fill: false,
                        backgroundColor: '#f71b14',
                        borderColor: '#f7202b',
                        borderWidth: 1
                    },
                    {
                        label: 'Medical',
                        data: [<?php echo $medical; ?>],
                        fill: false,
                        backgroundColor: '#1d8af7',
                        borderColor: '#288bf7',
                        borderWidth: 1
                    },
                    {
                        label: 'Other',
                        data: [<?php echo $other; ?>],
                        fill: false,
                        backgroundColor: '#f740e5',
                        borderColor: '#e33bf7',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Student Count'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Attendance Chart'
                }
            }
        };

        document.getElementById("chartContainer2").innerHTML = '&nbsp;';
        document.getElementById("chartContainer2").innerHTML = '<canvas id="PieChart2"></canvas>';
        var ctx = document.getElementById("PieChart2").getContext('2d');
        window.myBarCM = new Chart(ctx, myChartMData);


        var myChartMData3 = {
            type: 'bar',
            data: {
                labels: [<?php echo $classes_str; ?>],
                datasets: [
                    {
                        label: 'Actual Capacity',
                        data: [<?php echo $actual_capacity; ?>],
                        fill: false,
                        backgroundColor: '#96d277',
                        borderColor: '#96d277',
                        borderWidth: 1
                    },
                    {
                        label: 'Available Capacity',
                        data: [<?php echo $available_capacity; ?>],
                        fill: false,
                        backgroundColor: '#42ccf7',
                        borderColor: '#3dbff7',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Date'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Class Allocation'
                        },
                        ticks: {
                            beginAtZero: true,
                            userCallback: function (label, index, labels) {
                                if (Math.floor(label) === label) {
                                    return label;
                                }

                            },
                        }
                    }]
                },
                responsive: true,
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Student Attendance Chart'
                }
            }
        };

        document.getElementById("chartContainer3").innerHTML = '&nbsp;';
        document.getElementById("chartContainer3").innerHTML = '<canvas id="PieChart3"></canvas>';
        var ctx = document.getElementById("PieChart3").getContext('2d');
        window.myBarCM = new Chart(ctx, myChartMData3);

    });

                        
                        function view_course_commision(id){    

                           $('#grn_details_title').html(''); 
                            
                            $.ajax({
                                url: "<?php echo base_url('dashboard/view_course_details'); ?>",
                                type: "POST",
                                dataType: "html",
                                data: {
                                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                                    "id":id,
                                },
                                success: function (data) {

                                    $('#grn_details_title').html(data);
                                    $('#grn_title').html("Course Details");  
                                    $('#grn_details').modal({backdrop: 'static', keyboard: false});      
                                        
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    bootbox.alert(textStatus + " : " + errorThrown);
                                    console.log(jqXHR);
                                    console.log(textStatus);
                                    console.log(errorThrown);
                                }

                            });
                            
                        }


</script>