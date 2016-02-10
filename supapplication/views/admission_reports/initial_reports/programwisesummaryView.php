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
                                    
                                    <?php if(count($initial_report) > 0 ){?>
                                    
                                    <div class="table-header">
                                        
                                        <h3 id="title">Program Wise Summary Initial Report</h3>
                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                             <td colspan="2"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="2"><h2 style="text-align:right">Program Wise Summary Initial Report</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                
                                               <td><b>Campus : <?php echo $initial_report[0]['campus_name']; ?></b></td>
                                                <td><b>Campaign : <?php echo $initial_report[0]['campaign_name']; ?></b></td>
                                                <td><b>From Date : <?php echo $start; ?></b></td>
                                                <td><b>To Date : <?php echo $end; ?></b></td>
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th colspan="2">Program</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                                   $j = 0;                            
                                        for($i=0; $i<count($initial_report);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td colspan="2"><?php echo $initial_report[$i]['program_name']; ?></td>
                                                <td><?php echo $x = $initial_report[$i]['campus_count'] ?></td>
                                           </tr>
                                            
                                            <?php $j = $j + $x; } ?> 
                                           <tr>
                                             <td colspan="3" style="text-align: right;"><b>Total</b></td>
                                             <td><?php echo $j;?></td>
                                           </tr>
                                        
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
