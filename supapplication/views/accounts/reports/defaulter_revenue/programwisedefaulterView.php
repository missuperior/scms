<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Accounts </a>
            </li>						
        </ul><!--.breadcrumb-->
        <div class="nav-search" id="nav-search">
            <form class="form-search" />
            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>
    <div class="page-content"> 
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">                       
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							
                <div class="row-fluid">
                    <div class="span12">                                                                     
                            <div class="row-fluid">                                             
                                    <?php if(count($defaulter_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Program Wise Revenue Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="4"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="4"><h3 style="text-align:right">Program Wise Revenue Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="3"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $defaulter_report[0]['campus_name'];} ?></b></td>
                                                <td colspan="2"><b>Campaign : <?php echo $defaulter_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="3" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Program</th>
                                                <th>Total Students</th>
                                                <th>Total Receivable</th>
                                                <th>Left Students</th>
                                                <th>Left Students Amount</th>
                                                <th>Received</th>
                                                <th>Remaining</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php 
                                        $able_total = 0;                                                                                
                                        $left_total = 0;                                                                                
                                        $ed_total   = 0; 
                                        $row_rem    = 0;
                                        for($i=0; $i<count($defaulter_report);$i++){  
                                          $row_rem  = $defaulter_report[$i]['rec_able'] - $defaulter_report[$i]['left_amount'] - $defaulter_report[$i]['rec_ed'];
                                        ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $defaulter_report[$i]['program_name']; ?></td>
                                                <td><?php echo $defaulter_report[$i]['std_total']; ?></td>
                                                <td><?php echo number_format($defaulter_report[$i]['rec_able']); ?></td>
                                                <td><?php echo $defaulter_report[$i]['std_left']; ?></td>
                                                <td><?php echo number_format($defaulter_report[$i]['left_amount']); ?></td>
                                                <td><?php echo number_format($defaulter_report[$i]['rec_ed']); ?></td>
                                                <td><?php echo number_format($row_rem);  ?></td>
                                            </tr>
                                          <?php
                                            $able_total = $able_total + $defaulter_report[$i]['rec_able']; 
                                            $left_total = $left_total + $defaulter_report[$i]['left_amount']; 
                                            $ed_total   = $ed_total + $defaulter_report[$i]['rec_ed']; 
                                           } 
                                           $rem_amount = $able_total - $left_total - $ed_total;
                                           $rem_amount = str_replace("-", "", $rem_amount);
                                           ?>  
                                        </tbody>
                                        <tr>
                                          <td colspan="3"></td>
                                          <td><b><?php echo number_format($able_total); ?></b></td>
                                          <td></td>
                                          <td><b><?php echo number_format($left_total); ?></b></td>
                                          <td><b><?php echo number_format($ed_total); ?></b></td>
                                          <td></td>                                          
                                        </tr>
                                        <tr>
                                          <td><b>Remaining Amount :</b></td>
                                          <td colspan="7"><?php echo number_format($rem_amount); ?></td>
                                        </tr>
                                        <tr><td style="text-align: right" colspan="8">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                    <?php }else{?>
                                    <div class="table-header">
                                       <h3>Record Not Found</h3>                                       
                                    </div>
                                    <?php } ?>                                    
                                </div>
                            </div>
                        </div>                
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
    </div><!--/.main-content-->
</div><!--/.main-container-->    
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.tableTools.js"></script>