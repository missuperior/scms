<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Admission </a>
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
                                    <?php if(count($analysis_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Admission Analysis Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="2"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td ><h3 style="text-align:right">Admissions Analysis Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="2"><h2><?php  echo $analysis_report[0]['campus_name'];?></h2></td>
                                               <td ><h2><?php echo $analysis_report[0]['campaign_name']; ?></h2></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Sr No</th>
                                                <th>Program Name</th>
                                                <th>No of Students</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                          <?php
                                          $total = 0; 
                                          foreach($analysis_report AS $key=>$row){
                                              $total = $total + $row['total_students'];
                                          ?>
                                          <tr>
                                            <td><?php echo $key+1;?></td>
                                            <td><?php echo $row['program_name'];?></td>
                                            <td><?php echo $row['total_students']; ?></td>
                                            
                                          </tr>                                     
                                          <?php } ?>  
                                        </tbody> 
                                         <tr>
                                              <td colspan="2"><b>Total</b></td>
                                              <td><?php echo $total;?></td>                                            
                                          </tr>                                       
                                        <tr><td style="text-align: right" colspan="9">Powered By : Superior Solutionz</td></tr>                                        
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