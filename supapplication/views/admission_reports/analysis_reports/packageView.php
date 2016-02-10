<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Admissions </a>
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
                                    
                                    <?php if(count($package_report) > 0 ){?>
                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Admission Analysis Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="5"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="6"><h2 style="text-align:left; font-size:23px">Admission Analysis Report</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                <td colspan="3"><b>Campaign : </b><?php echo $package_report[0]['campaign_name']; ?></td>
                                                <td colspan="4"><b>Campus : </b><?php  if($campus_id == 0) { echo 'All';}else{ echo $package_report[0]['campus_name'];}?></td>
                                                <td colspan="4"><b>Program : </b><?php  if($program_id == 0) { echo 'All';}else{ echo $package_report[0]['program_name'];}?></td>
                                                
                                                
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Form No</th>
                                                <th>Name</th>
                                                <th>Program</th>
                                                <th>Shift</th>
                                                <th>Reference</th>
                                                <th>Admission Fee</th>                                                
                                                <th>Misc Fee</th>
                                                <th>Session Fee</th>                                                
                                                <th>Discount</th>                                                
                                                <th>Discount %</th>                                                
                                                <!--<th>Total </th>-->                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                        $quantity=0;                                   
                                        $grand_total=0;                                                                                                              
                                        for($i=0; $i<count($package_report);$i++){  
                                            

                                            $total=0;
                                            
                                            $total            = $package_report[$i]['admission_fee'] + $package_report[$i]['misc_fee'] + $package_report[$i]['session_fee'];
                                            
                                            $grand_total      = $grand_total    + $total; 
                                            
                                            
                                            // calculate discount in percentage 
                                            
                                            $dis_in_percentage  =   $package_report[$i]['discount']/($package_report[$i]['session_fee'] + $package_report[$i]['discount'])*100;
                                            
                                            
                                            
                                            ?>
                                            
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $package_report[$i]['form_no']; ?></td>
                                                <td><?php echo $package_report[$i]['student_name']; ?></td>
                                                <td><?php echo $package_report[$i]['program_name'];?></td>
                                                <td><?php echo $package_report[$i]['shift'];?></td>
                                                <td><?php echo $package_report[$i]['reference'];?></td>
                                                <td><?php echo number_format($package_report[$i]['admission_fee']); ?></td>
                                                <td><?php echo number_format($package_report[$i]['misc_fee']); ?></td>
                                                <td><?php echo number_format($package_report[$i]['session_fee']); ?></td>
                                                <td><?php echo number_format($package_report[$i]['discount']); ?></td>
                                                <td><?php echo number_format($dis_in_percentage,2); ?></td>
                                                <!--<td><?php echo number_format($total); ?></td>-->
                                               
                                           </tr>
                                            
                                            <?php } ?> 

                                        </tbody>
                                        
<!--                                          <tr style="font-size: 10px">                                                
                                               <td colspan="6"><b><?php echo 'Grand Total'; ?></b></td>                                               
                                               <td colspan="2"><b><?php echo number_format($grand_total); ?></b></td>                                                
                                           </tr>
                                           
                                          <tr style="font-size: 10px">                                                
                                               <td colspan="6"><b><?php echo 'Average Student Package'; ?></b></td>                                               
                                               <td colspan="2"><b><?php echo number_format($grand_total / count($package_report)); ?></b></td>                                                
                                           </tr>-->
                                        
                                           <tr><td style="text-align: right" colspan="11"><img width="100" src="<?php echo base_url();?>assets/avatars/ss.png" /></td></tr>
                                        
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
