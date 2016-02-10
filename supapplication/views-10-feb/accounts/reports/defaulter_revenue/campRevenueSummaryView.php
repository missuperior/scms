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
                                    <?php if(count($data) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Campus Revenue Summary Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="6"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="5"><h3 style="text-align:right">Campus Revenue Summary Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                                <td colspan="4"><b>Campus : <?php echo $data[0]['campus_name']; ?></b></td>
                                                <td colspan="4"><b>Campaign : <?php echo $data[0]['campaign_name']; ?></b></td>
                                                <td colspan="3"><b>Status : <?php if($status == 0){echo 'All';} if($status == 1){echo 'Active';}if($status == 2){echo 'Freeze/Left';} ?></b></td>                                               
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Program</th>                                                
                                                <th>Total Students</th>
                                                <th>Admission</th>
                                                <th>Session</th>
                                                <th>Misc</th>
                                                <th>Tax</th>
                                                <th>Total Without Admission</th>
                                                <th>Total With Admission</th>
                                                <th>Avg Without Admission</th>
                                                <th>Avg With Admission</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php                                         
                                        for($i=0; $i<count($data);$i++){
                                            
                                            if($data[$i]['program_name'] == 'MBBS'){
                                                $tax    =   ($data[$i]['total_session_fee']+$data[$i]['misc_fee'])*5/100;
                                                $total_wo_adm   =   $data[$i]['total_session_fee']+$tax;
                                                $total_w_adm   =   $data[$i]['total_adm_fee']+$data[$i]['total_session_fee']+$tax;
                                            }else{
                                                $tax = 0;
                                                $total_wo_adm   =   $data[$i]['total_wo_adm'];
                                                $total_w_adm   =   $data[$i]['total_w_adm'];
                                            }
                                        ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $data[$i]['program_name']; ?></td> 
                                                <td><?php echo $data[$i]['total_students']; ?></td>                                                
                                                <td><?php echo number_format($data[$i]['total_adm_fee']);?></td>
                                                <td><?php echo number_format($data[$i]['total_session_fee']);?></td>
                                                <td><?php echo number_format($data[$i]['total_misc_fee']);?></td>
                                                <td><?php echo number_format($tax);?></td>
                                                <td><?php echo number_format($total_wo_adm);?></td>
                                                <td><?php echo number_format($total_w_adm);?></td>
                                                <td><?php echo number_format($total_wo_adm/$data[$i]['total_students']);?></td>
                                                <td><?php echo number_format($total_w_adm/$data[$i]['total_students']);?></td>
                                                
                                            </tr>
                                        <?php } ?> 
                                        </tbody>
                                        
                                        <tr><td style="text-align: right" colspan="11">Powered By : Superior Solutionz</td></tr>                                        
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