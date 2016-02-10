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
                                    <?php if(count($ref_summary) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title"> Admission Reference Summary Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="1"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="2"><h3 style="text-align:right">Admission Reference Summary Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="2"><b>Campus : <?php  echo $ref_summary[0]['campus_name'];?></b></td>
                                               <td colspan="1"><b>Campaign : <?php if($campaign_id == 0){ echo 'All';}else{ echo $ref_summary[0]['campaign_name'];} ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Sr#</th>
                                                <th>Reference Source</th>
                                                <th>Total Admissions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                         $total = 0;
                                         foreach($ref_summary as $key=>$row){ 
                                         $total     =   $total + $row['total'];     
                                        ?>
                                          <tr>
                                            <td><?php echo $key+1; ?></td>
                                            <?php 
                                            if($campaign_id == 0) $campaign = 0;
                                            else $campaign = $row['campaign_id'];
                                            ?>
                                            <td><a target="_blank" href="<?php echo base_url();?>admission_reports/adm_ref_detail/<?php echo $row['campus_id']; ?>/<?php  echo $campaign; ?>/<?php echo $row['reference_id']; ?>" ><?php echo $row['reference_source'];?></a></td>
                                            <td><?php echo $row['total'];?></td>
                                          </tr>                                     
                                         
                                          <?php  } ?>
                                         
                                        </tbody>
                                       
                                         <tr>
                                             <td colspan="2">Total</td>                                            
                                            <td><?php echo $total;?></td>
                                          </tr> 
                                        <tr><td style="text-align: right" colspan="3">Powered By : Superior Solutionz</td></tr>                                        
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