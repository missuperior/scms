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
                                    <?php if(count($ins_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Campus Program Wise Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="8"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="9"><h3 style="text-align:right">Campus Program Wise Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="6"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $ins_report[0]['campus_name'];} ?></b></td>
                                                <td colspan="6"><b>Campaign : <?php echo $ins_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="5" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Form #</th>
                                                <th>Roll #</th>
                                                <th>Name</th>
                                                <th>Program</th>
                                                <th>Package</th>
                                                
                                                <th>Inst 1</th>
                                                <th>Due</th>
                                                <th>Inst 2</th>
                                                <th>Due</th>
                                                <th>Inst 3</th>
                                                <th>Due</th>
                                                <th>Inst 4</th>                                                
                                                <th>Due</th>
                                                <th>Total</th>
                                                <th>Fine</th>
                                                <th>Discount</th>
                                                
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
                                              
                                              if($row['semester'] == 1){ $package = $row['admission_fee']+$row['session_total_package'];}
                                              else{$package = $row['session_total_package'];}
                                              
                                              $package_grand_total  =   $package_grand_total+$package;
                                              ?>
                                            <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $row['form_no']; ?></td>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['student_name']; ?></td>
                                            <td><?php echo $row['program_name']; ?></td>
                                            <td><?php echo number_format($package);?></td>
                                           
                                            <?php 
                                                $instllments    =   $this->Account_reports_model->getInstallments($row['student_id']);
                                                //echo '<pre>';var_dump($instllments);
                                                
                                                $ins_total      =   0;
                                                $fine           =   0;
                                                $discount       =   0;
                                                for($j=0; $j < 4; $j++){
                                                
                                                    $fine       =   $fine + $instllments[$j]['fine'];
                                                    $discount       =   $discount + $instllments[$j]['additional_discount'];
                                                $ins_total      =   $ins_total + $instllments[$j]['payable'];
                                            ?>
                                            <td><?php if($instllments[$j]['payable'] != ''){echo $instllments[$j]['payable']; }else{echo '';}?></td>
                                            <td><?php if($instllments[$j]['due_date'] != ''){echo $instllments[$j]['due_date']; }else{echo '';}?></td>
                                            <?php }?>                                            
                                            <td><?php echo number_format($ins_total); ?></td> 
                                            <td><?php echo number_format($fine); ?></td> 
                                            <td><?php echo number_format($discount); ?></td> 
                                            </tr>
                                          <?php
                                          
                                          $ins_grand_total      =   $ins_grand_total + $ins_total;
                                          $fine_total           =   $fine_total + $fine;
                                          $discount_total       =   $discount_total + $discount;
                                          $i++;  }?>
                                        </tbody>
                                       
                                        <tr>
                                            <td style="text-align: right" colspan="5">Package Total</td>
                                            <td style="text-align: right" colspan="1"><?php echo number_format($package_grand_total); ?></td>
                                            <td style="text-align: right" colspan="8">Installments Total</td>
                                            <td style="text-align: right" colspan="1"><?php echo number_format($ins_grand_total); ?></td>
                                            <td style="text-align: right" colspan="1"><?php echo number_format($fine_total); ?></td>
                                            <td style="text-align: right" colspan="1"><?php echo number_format($discount_total); ?></td>
                                        </tr>      
                                        <tr><td style="text-align: right" colspan="17">Powered By : Superior Solutionz</td></tr>                                        
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