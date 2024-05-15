<?php
$this->load->model('dash_mod');
 ?>
<script>
    $(document).ready(function(){
        $("[rel=tooltip]").tooltip({ placement: 'right'});
    });
</script>
<div class="card">
    <div class="card-body">
      <!--   <h5 class="card-title">Agent Detail Report 
            <span style="color: #2c1765"><?php echo $from_date; ?> to <?php echo $to_date; ?> </span></h5> -->
        <table id="report_1" class="" style="border-collapse: collapse; text-align:center" width="100%" cellspacing="0" bordercolor="#000000" border="1" >
            <thead>
            <tr>
                <th height="20">#</th>
          
                <th>User</th>  
                <th>IP Address</th> 
                <th>Date & Time</th>  
                <th>Action</th> 
                <th>Status</th>            
                <th>Message</th>                
            </tr>
            </thead>
            <tbody>
                <?php   

                $count=1;

            foreach ($AgentFullDetails as $value) {

             //  $color_code = $this->dash_mod->get_code_code($value['agent_type'])->color_code;

             ?>
            <tr >
                    <td><?php echo $count; ?></td>
             
                    <td><?php echo $value['username']; ?></td>
                    <td><?php echo $value['ip_address']; ?></td>
                    <td><?php echo $value['date_time']; ?></td>
                    <td><?php echo $value['action']; ?></td>
                    <td><?php echo $value['status']?></td>
                    <td><?php echo $value['log_message']?></td>
                                            
      
                </tr>
                <?php
                $count++;
            }
            ?>           
            </tbody>
           
        </table>
    </div>
</div>



