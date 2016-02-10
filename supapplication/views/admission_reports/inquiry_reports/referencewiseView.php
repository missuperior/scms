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
                                    
                                    <?php if(count($inquiry_report) > 0 ){?>
                                    
                                    <div class="table-header">
                                        
                                        <h3 id="title">Reference Wise Inquiry Report</h3>
                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="5"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="6"><h2 style="text-align:right">Reference Wise Inquiry Report</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                
                                               <td colspan="4"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $inquiry_report[0]['campus_name'];}?></b></td>
                                                <td colspan="4"><b>Campaign : <?php echo $inquiry_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="3" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Inquiry No</th>
                                                <th>Inquiry Type</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Program</th>
                                                <th>Shift</th>
                                                <th>Reference</th>
                                                <th>Institute</th>
                                                <th>Date</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                                                               
                                        for($i=0; $i<count($inquiry_report);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $inquiry_report[$i]['inquiry_no']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['inquiry_type']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['name']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['contact']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['program_name']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['shift']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['reference_source']; ?></td>
                                                <td><?php echo $inquiry_report[$i]['institute_name']; ?></td>
                                                <td><?php echo(date("d-M-Y",@strtotime($inquiry_report[$i]['inquiry_date']))); ?></td>
                                               <td><?php echo $inquiry_report[$i]['user_name']; ?></td>
                                           </tr>
                                            
                                            <?php } ?> 
                                        
                                        </tbody>
                                   
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
