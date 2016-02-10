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
                                    
                                    <?php if(count($prospectus_report) > 0 ){?>
                                    
                                    <div class="table-header">
                                        
                                        <h3 id="title">Shift Wise Prospectus Report</h3>
                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="6"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="5"><h2 style="text-align:left; font-size:23px">Shift Wise Prospectus Report</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                
                                               <td colspan="3"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $prospectus_report[0]['campus_name'];}?></b></td>
                                                <td colspan="2"><b>Campaign : <?php echo $prospectus_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="3"><b style="font-size: 12px; color: #553333">Shift : <?php if($shift == '0'){echo 'All';}else{ echo $shift; } ?></b></td>
                                                <td colspan="3" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Name</th>
                                                <th>Inquiry No</th>
                                                <th>Sale Date</th>                                                                                                
                                                <th>Program</th>                                                
                                                <th>Reference</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Total</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                        $quantity=0;                                   
                                        $total=0;                                   
                                        for($i=0; $i<count($prospectus_report);$i++){  
                                            $total      = $total    + $prospectus_report[$i]['total_price'];
                                            $quantity   = $quantity + $prospectus_report[$i]['quantity'];
                                            
                                            ?>
                                            
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $prospectus_report[$i]['name']; ?></td>
                                                <td><?php echo $prospectus_report[$i]['inquiry_no']; ?></td>
                                                <td><?php echo(date("d-M-Y",@strtotime($prospectus_report[$i]['sale_date']))); ?></td>                                                
                                                <td><?php echo $prospectus_report[$i]['program_name']; ?></td>
                                                <td><?php echo $prospectus_report[$i]['reference_source']; ?></td>
                                                <td><?php echo $prospectus_report[$i]['product_name']; ?></td>
                                                <td><?php echo $prospectus_report[$i]['quantity']; ?></td>
                                                <td><?php echo $prospectus_report[$i]['price']; ?></td>
                                                <td><?php echo $prospectus_report[$i]['total_price']; ?></td>
                                                
                                                <td><?php echo $prospectus_report[$i]['user_name']; ?></td>
                                           </tr>
                                            
                                            <?php } ?> 
                                                                                      
                                        </tbody>
                                        
                                        <tr style="font-size: 10px">
                                                
                                               <td colspan="8"><b><?php echo 'Grand Total'; ?></b></td>
                                               <td colspan="2"><b><?php echo $quantity; ?></b></td>
                                               <td colspan="2"><b><?php echo $total; ?></b></td>
                                                
                                           </tr>
                                        
                                           <tr><td style="text-align: right" colspan="12"><img width="100" src="<?php echo base_url();?>assets/avatars/ss.png" /></td></tr>
                                        
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
