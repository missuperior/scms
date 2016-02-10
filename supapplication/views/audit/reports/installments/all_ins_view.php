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
                                        <h3 id="title">All Installments Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="11"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="11"><h3 style="text-align:right">Campus Program Wise Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                                <td colspan="6"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $ins_report[0]['campus_name'];} ?></b></td>
                                                <td colspan="6"><b>Campaign : <?php echo $ins_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="6"><b>Semester : <?php echo $session; ?></b></td>
                                                <td colspan="6" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Roll #</th>
                                                <th>Name</th>
                                                <th>Status</th>
                                                <th>Package</th>
                                                
                                                <th>Inst 1</th>
                                                <th>Fine</th>
                                                <th>Dis</th>                                                
                                                <th>Due</th>
                                                
                                                <th>Inst 2</th>
                                                <th>Fine</th>
                                                <th>Dis</th>
                                                <th>Due</th>
                                                
                                                <th>Inst 3</th>
                                                <th>Fine</th>
                                                <th>Dis</th>
                                                <th>Due</th>
                                                
                                                <th>Inst 4</th>                                                
                                                <th>Fine</th>
                                                <th>Dis</th>
                                                <th>Due</th>
                                                
                                                <th>Total</th>
                                               
                                                
                                            </tr>
                                        </thead>
                                        <tbody>  
                                          <?php 
                                          $i=0;
                                          $ins_grand_total  = 0;
                                          $fine_total  = 0;
                                          $discount_total  = 0;
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
                                            <td><?php echo $row['status']; ?></td>        
                                            <td><?php echo number_format($package);?></td>
                                           
                                            <?php 
                                                $instllments    =   $this->Account_reports_model->getAllInstallments($row['student_id'],$session_id,$campus_id);
                                                //echo '<pre>';var_dump($instllments);
                                                
                                                $ins_total      =   0;
                                                $fine           =   0;
                                                $discount       =   0;
                                                for($j=0; $j < 4; $j++){
                                                
                                                    $fine           =   $fine + $instllments[$j]['fine'];
                                                    $discount       =   $discount + $instllments[$j]['additional_discount'];
                                                    $ins_total      =   $ins_total + $instllments[$j]['payable'];
                                            ?>
                                            <td><?php if($instllments[$j]['payable'] != ''){echo $instllments[$j]['payable']; }else{echo '';}?></td>
                                            <td>
                                                <?php 
                                                        if($instllments[$j]['fine'] != '' &&  $instllments[$j]['fine'] != 0)
                                                        {echo $instllments[$j]['fine']; }else{echo '';}
                                                ?> 
                                            </td>
                                            <td>
                                                 <?php 
                                                        if($instllments[$j]['additional_discount'] != ''  &&  $instllments[$j]['additional_discount'] != 0)
                                                            {echo $instllments[$j]['additional_discount']; }else{echo '';}
                                                ?> 
                                            </td>
                                            <td><?php if($instllments[$j]['due_date'] != ''){echo $instllments[$j]['due_date']; }else{echo '';}?></td>
                                            <?php }?>                                            
                                            <td><?php echo number_format($ins_total); ?></td> 
                                            
                                            </tr>
                                          <?php
                                          
                                          $ins_grand_total      =   $ins_grand_total + $ins_total;
                                          $fine_total           =   $fine_total + $fine;
                                          $discount_total       =   $discount_total + $discount;
                                          $i++;  }?>
                                        </tbody>
                                       
                                        <tr>
                                            <td style="text-align: right" colspan="3">Package Total</td>                                             
                                           <td style="text-align: right" colspan="1"><?php echo number_format($package_grand_total); ?></td>                                            
                                            <td style="text-align: right" colspan="4">Fine Total</td>
                                            <td style="text-align: right" colspan="2"><?php echo number_format($fine_total); ?></td>
                                            <td style="text-align: right" colspan="4">Discount Total</td>
                                            <td style="text-align: right" colspan="2"><?php echo number_format($discount_total); ?></td>
                                            <td style="text-align: right" colspan="4">Installments Total</td>
                                            <td style="text-align: right" colspan="2"><?php echo number_format($ins_grand_total); ?></td>
                                        </tr>      
                                        <tr><td style="text-align: right" colspan="22">Powered By : Superior Solutionz</td></tr>                                        
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