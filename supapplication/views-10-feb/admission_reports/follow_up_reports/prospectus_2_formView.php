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
                                        <h3 id="title">Prospectus To Form  Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="4"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="4"><h2 style="font-size: 20px">Prospectus To Form  Report</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="3"><b>Campus : <?php echo $inquiry_report[0]['campus_name']; ?></b></td>
                                                <td colspan="3"><b>Campaign : <?php echo $inquiry_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="2"><b>Dated : <?php echo date('d-M-Y'); ?></b></td>                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Inquiry No</th>                                                
                                                <th>Name</th>
                                                <th>Program</th>
                                                <th>Mobile</th>                                                
                                                <th>Phone</th>                                                
                                                <th>Inquiry Date</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php                                                                                 
                                        for($i=0; $i<count($inquiry_report);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                
                                                    <td><?php echo $i+1; ?></td>                                                
                                                    <td><?php echo $inquiry_report[$i]['inquiry_no']; ?></td>                                                
                                                    <td><?php echo $inquiry_report[$i]['name']; ?></td>
                                                    <td><?php echo $inquiry_report[$i]['program_name']; ?></td>
                                                    <td><?php echo $inquiry_report[$i]['contact']; ?></td>
                                                    <td><?php echo $inquiry_report[$i]['phone']; ?></td>
                                                    <td><?php echo(date("d-M-Y",@strtotime($inquiry_report[$i]['inquiry_date']))); ?></td>
                                                    <td><?php  echo $inquiry_report[$i]['user_name'];?></td>
                                                
                                           </tr>                                            
                                            <?php } ?>                                            
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="12">Powered By : Superior Solutionz</td></tr>                                        
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