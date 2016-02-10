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
                                    
                                    <?php if(count($address_report) > 0 ){?>
                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Address Wise Roll No Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="5"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="3"><h2 style="text-align:left; font-size:23px">Address Wise Roll No Report</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                
                                               <td colspan="3"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $address_report[0]['campus_name'];}?></b></td>
                                               <td colspan="2"><b>Program : <?php  echo $address_report[0]['program_name'];?></b></td>
                                                <td colspan="3"><b>Campaign : <?php echo $address_report[0]['campaign_name']; ?></b></td>                                                
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Form No</th>
                                                <th>Roll No</th>
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>Mobile</th>                                                
                                                <th>Status</th>                                                
                                                <th>Address</th>                                                                                             
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                                                                                                                                   
                                        for($i=0; $i<count($address_report);$i++){  ?>
                                            
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $address_report[$i]['form_no']; ?></td>
                                                <td><?php echo $address_report[$i]['roll_no']; ?></td>
                                                <td><?php echo $address_report[$i]['student_name'];?></td>
                                                <td><?php echo $address_report[$i]['father_name']; ?></td>
                                                <td><?php echo $address_report[$i]['mobile']; ?></td>
                                                <td>
                                                    <?php 
                                                        if($address_report[$i]['status'] == 'ok')
                                                        { echo 'Active';}
                                                        else{
                                                            echo $address_report[$i]['status']; 
                                                        }
                                                        ?>
                                                </td>                                               
                                                <td><?php echo $address_report[$i]['present_address']; ?></td>                                               
                                               
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
