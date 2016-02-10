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
                                    <?php if(count($challan) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Challan Issue</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="3"><h3 style="text-align:right">Challan Issue</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="2"><b>Campus : <?php  if($campus_id == 0) { echo 'All';}else{ echo $challan[0]['campus_name'];} ?></b></td>
                                                <td colspan="2"><b>Campaign : <?php echo $challan[0]['campaign_name']; ?></b></td>
                                                <td colspan="1"><b>Program : <?php echo $challan[0]['program_name']; ?></b></td>                                                
                                                <td colspan="1" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($s_date))).'  To  '.(date("d-M-Y",strtotime($e_date))); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Roll #</th>
                                                <th>Name #</th>
                                                <th>Payable</th>
                                                <th>Due Date</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php   
                                        $total = 0;
                                        foreach($challan as $row => $value){  ?>
                                            <tr style="font-size: 10px">                                                
                                                <td><?php echo $row + 1; ?></td>
                                                <td><?php echo $value['roll_no']; ?></td>
                                                <td><?php echo $value['student_name']; ?></td>
                                                <td><?php echo number_format($value['payable']); ?></td>
                                                <td><?php echo $value['due_date']; ?></td>
                                                <td></td>
                                           </tr>
                                           <?php 
                                           $total = $total + $value['payable'];
                                           
                                        } ?>  
                                        </tbody>
                                        
                                        <tr style="font-size: 10px">
                                                
                                               <td colspan="3"><b><?php echo 'Total'; ?></b></td>                                               
                                               <td colspan="3"><b><?php echo $total; ?></b></td>
                                                
                                           </tr>
                                        
                                        <tr><td style="text-align: right" colspan="5">Powered By : Superior Solutionz</td></tr>                                        
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