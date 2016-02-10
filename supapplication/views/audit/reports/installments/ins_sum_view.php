<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">AUDIT </a>
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
                                    <?php if(count($ins_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Installments Summary Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="4"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="4"><h3 style="text-align:right">Installment Summary Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                                <td colspan="2"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $ins_report[0]['campus_name'];} ?></b></td>
                                                <td colspan="2"><b>Campaign : <?php echo $ins_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="2"><b>Semester : <?php echo $session; ?></b></td>
                                                <td colspan="2" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Roll #</th>
                                                <th>Name</th>                                                                                                                                          
                                                <th>Package</th>                                                
                                                <th>Inst Recvable</th>
                                                <th>Inst Received</th>
                                                <th>Remaining</th>                                                
                                                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>  
                                          <?php 
                                          $i=0;
                                          $total_revable  = 0;
                                          $total_reced  = 0;
                                          $total_remaining  = 0;
                                          $package_grand_total  = 0;
                                          foreach($ins_report AS $key => $row){
                                              
                                              if($row['enrolled_session_id'] == $session_id){ $package = $row['admission_fee']+$row['session_fee']+$row['misc_fee'];}
                                              else{$package = $row['session_fee']+$row['misc_fee'];}
                                              
                                              $package_grand_total  =   $package_grand_total+$package;
                                              ?>
                                            <tr>
                                            <td><?php echo $i+1; ?></td>                                            
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['student_name']; ?></td>                                                                                                                                   
                                            <td><?php echo number_format($package);?></td>
                                           
                                            <?php 
                                                $instllments    =   $this->Account_reports_model->getInsSum($row['student_id'],$session_id,$campus_id);
//                                                echo '<pre>'; print_r($instllments);die;
                                                                                               
                                                    $revable    =   $instllments->recable;
                                                    $recvd      =   $instllments->recvd;
                                                    $remaining  =   $revable - $recvd ;
                                                   
                                                    ?>
                                            <td><?php echo number_format($revable); ?></td>
                                            <td><?php echo number_format($recvd); ?></td>
                                                                                      
                                            <td><?php echo number_format($remaining); ?></td> 
                                            
                                            </tr>
                                          <?php
                                          
                                          $total_revable      =   $total_revable + $revable;
                                          $total_reced           =   $total_reced + $recvd;
                                          $total_remaining       =   $total_remaining + $remaining;
                                          $i++;  }?>
                                        </tbody>
                                       
                                        <tr>
                                            <td style="text-align: right" colspan="3">Total Package</td>                                             
                                           <td style="text-align: right" colspan="1"><?php echo number_format($package_grand_total); ?></td>                                                                                        
                                            <td style="text-align: right" colspan="1"><?php echo number_format($total_revable); ?></td>                                            
                                            <td style="text-align: right" colspan="1"><?php echo number_format($total_reced); ?></td>
                                            <td style="text-align: right" colspan="1"><?php echo number_format($total_remaining); ?></td>
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