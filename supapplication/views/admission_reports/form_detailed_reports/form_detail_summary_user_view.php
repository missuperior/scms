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
                                
                                    <?php if(count($detail_from_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Detail Form Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                                <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                                <td colspan="3"><h2 style="font-size: 20px">Program Address Wise Detail Report</h2></td>
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                                <td colspan="2"><b>Campaign : <?php echo $detail_from_report[0]['campaign_name']; ?></b></td>
                                                <td colspan="2"><b>Campus : <?php echo $detail_from_report[0]['campus_name']; ?></b></td>
                                                <td colspan="2"><b>Date : <?php echo date('d-M-Y'); ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th colspan="2">User</th>
                                                <th colspan="2">Program</th>
                                                <th colspan="2">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php                                                                                 
                                        for($i=0; $i<count($detail_from_report);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                <td colspan="2"><?php echo $detail_from_report[$i]['sub_login']; ?></td>
                                                <td colspan="2"><?php echo $detail_from_report[$i]['program_name']; ?></td>
                                                <td colspan="2"><?php  echo $detail_from_report[$i]['counter'];?></td>
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