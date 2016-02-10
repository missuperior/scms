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
                                    <table id="receiveable" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="6"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="3"><h3 style="text-align:right">Admissions Analysis Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="5"><b>Campus : <?php  echo $analysis_report[0][0]['campus_name'];?></b></td>
                                               <td colspan="4"><b>Campaign : <?php echo $analysis_report[0][0]['campaign_name']; ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Program Name</th>
                                                <th>Shift</th>
                                                <th>Telephonic</th>
                                                <th>Physical</th>
                                                <th>Prospectus</th>
                                                <th>Form Submissions</th>
                                                <th>Admissions</th>
                                                <th>Female</th>
                                                <th>Male</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                          <?php $a=0; $b=0; $c=0; $d=0; $e=0; $f=0; $g=0;
                                          for($i=0; $i<count($analysis_report[0]); $i++){
                                          ?>
                                          <tr>
                                            <td><?php echo $analysis_report[0][$i]['program_name'];?></td>
                                            <td><?php echo $analysis_report[0][$i]['shift'];?></td>
                                            <td><?php echo $analysis_report[0][$i]['tele'];?></td>
                                            <td><?php echo $analysis_report[0][$i]['phys'];?></td>
                                            
                                            <?php $pros = 0;
                                            for($j=0; $j<count($analysis_report[3]); $j++){
                                              if($analysis_report[0][$i]['program_id'] == $analysis_report[3][$j]['program_id']){
                                                $pros = $analysis_report[3][$j]['pros'];
                                              }                                             
                                            }
                                            ?>
                                            <td><?php echo $pros; ?></td>                                           
                                                                                       
                                            
                                            <?php $frms = 0;
                                            for($j=0; $j<count($analysis_report[2]); $j++){
                                              if($analysis_report[0][$i]['program_id'] == $analysis_report[2][$j]['program_id']){
                                                $frms = $analysis_report[2][$j]['total_forms'];
                                              }                                             
                                            }
                                            ?>
                                            <td><?php echo $frms; ?></td>                                            
                                            
                                            <?php $adm = 0;
                                            for($j=0; $j<count($analysis_report[1]); $j++){
                                              if($analysis_report[0][$i]['program_id'] == $analysis_report[1][$j]['program_id']){
                                                $adm = $analysis_report[1][$j]['std_roll_no'];
                                              }                                           
                                            }
                                            ?>
                                            <td><?php echo $adm; ?></td>                                            
                                            
                                            <?php $female = 0;
                                            for($j=0; $j<count($analysis_report[1]); $j++){
                                              if($analysis_report[0][$i]['program_id'] == $analysis_report[1][$j]['program_id']){
                                                $female = $analysis_report[1][$j]['female'];
                                              }                                           
                                            }
                                            ?>
                                            <td><?php echo $female; ?></td>                                            
                                                                                      
                                            
                                            <?php $male = 0;
                                            for($j=0; $j<count($analysis_report[1]); $j++){
                                              if($analysis_report[0][$i]['program_id'] == $analysis_report[1][$j]['program_id']){
                                                $male = $analysis_report[1][$j]['male'];
                                              }                                           
                                            }
                                            ?>
                                            <td><?php echo $male; ?></td>
                                            
                                          </tr>                                     
                                          <?php  
                                          $a =  $a + $analysis_report[0][$i]['tele']; 
                                          $b =  $b + $analysis_report[0][$i]['phys']; 
                                          $c =  $c + $analysis_report[3][$i]['pros']; 
                                          $d =  $d + $analysis_report[2][$i]['total_forms']; 
                                          $e =  $e + $analysis_report[1][$i]['std_roll_no']; 
                                          $f =  $f + $analysis_report[1][$i]['female']; 
                                          $g =  $g + $analysis_report[1][$i]['male']; 
                                          } ?>             
                                        <tr>
                                          <th colspan="2">Total :</th>
                                          <th><?php echo $a; ?></th>
                                          <th><?php echo $b; ?></th>
                                          <th><?php echo $c; ?></th>
                                          <th><?php echo $d; ?></th>
                                          <th><?php echo $e; ?></th>
                                          <th><?php echo $f; ?></th>
                                          <th><?php echo $g; ?></th>
                                        </tr>   
                                        
                                        </tbody> 
                                                                               
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