<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">ACCOUNTS </a>
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
                                    <?php if(count($posted_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Date Wise Bank/Cash Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="4"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior University of Lahore</b></td>
                                               <td colspan="3"><h3 style="text-align:right">Date Wise Bank/Cash Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="2"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $posted_report[0]['campus_name'];} ?></b></td>
                                               <td colspan="3"><b>Program : <?php  if($program == 0) { echo 'All';}else{ echo $posted_report[0]['program_name'];} ?></b></td>
                                                <td colspan="1"><b>Campaign : <?php echo $posted_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="1" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Date</th>
                                                <th>Bank</th>
                                                <th>Bank Amount</th>
                                                <th>Cash</th>
                                                <th>Cash Amount</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php $g_total = 0;
                                            $cash_total = 0;
                                            $cash_no = 0;
                                            $bank_total = 0;
                                            $bank_no = 0;
                                        for($i=0; $i<count($posted_report);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo date('d-M-Y', strtotime($posted_report[$i]['post_date'])); ?></td>
                                                <td><?php echo $posted_report[$i]['bank']; ?></td>
                                                <td><?php echo $posted_report[$i]['bank_total']; ?></td>
                                                <td><?php echo $posted_report[$i]['cash']; ?></td>
                                                <td><?php echo $posted_report[$i]['cash_total']; ?></td>
                                                <td><?php echo number_format($posted_report[$i]['amount']); ?></td>
                                           </tr>
                                          <?php 
                                          $g_total      = $g_total + $posted_report[$i]['amount']; 
                                          $cash_no      = $cash_no + $posted_report[$i]['cash']; 
                                          $cash_total   = $cash_total + $posted_report[$i]['cash_total']; 
                                          $bank_no      = $bank_no + $posted_report[$i]['bank']; 
                                          $bank_total   = $bank_total + $posted_report[$i]['bank_total']; 
                                           } ?>  
                                        </tbody>
                                        <tr>                                          
                                          <td colspan="2"></td>
                                          <td ><?php echo number_format($bank_no); ?></td>
                                          <td ><?php echo number_format($bank_total); ?></td>
                                          <td ><?php echo number_format($cash_no); ?></td>
                                          <td ><?php echo number_format($cash_total); ?></td>                                          
                                          <td ><?php echo number_format($g_total); ?></td>
                                        </tr>
                                        <tr><td style="text-align: right" colspan="7">Powered By : Superior Solutionz</td></tr>                                        
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