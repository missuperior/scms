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
                                    
                                    <?php if(count($prospectus_report) > 0 ){?>
                                    
                                    <div class="table-header">
                                        
                                        <h3 id="title">Prospectus Summary (Prog) Report</h3>
                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                          <thead> 
                                           <tr style="font-size: 10px">  
                                               <?php if(count($prospectus_report) > 1){?>
                                               <td colspan="2"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <?php } else{?>
                                               <td colspan="1"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <?php } ?>
                                               <td colspan="2"><h2 style="text-align:right">Inquiry Summary (Program)</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                
                                               <?php if(count($prospectus_report) > 1){?>
                                               <td colspan="2"><b>Campus : <?php echo $prospectus_report[0]['city_name'].'(<b style="font-size: 10px; color: #553333">Prospectus</b>)'; ?></b></td>
                                               <?php } else{?>
                                               <td colspan=""><b>Campus : <?php echo $prospectus_report[0]['city_name'].'(<b style="font-size: 10px; color: #553333">Prospectus</b>)' ?></b></td>
                                               <?php } ?>
                                                <td colspan="1"><b>Campaign : <?php echo $prospectus_report[0]['campaign_name']; ?></b></td>
                                                
                                                <td colspan="1" style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y",strtotime($start_date))).'  To  '.(date("d-M-Y",strtotime($end_date))); ?></b></td>
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                                                           
                                                <th>Program</th>
                                                <?php for($i=0; $i < count($prospectus_report); $i++){?>
                                                <th><?php echo $prospectus_report[$i]['campus_name']?></th>
                                                <?php } ?>              
                                                <th>Total</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                    
                                            <tr style="font-size: 10px">
                                                
                                               
                                                <td><?php echo $prospectus_report[0]['program_name']; ?></td>
                                               <?php
                                               $totl =0;
                                               for($j=0; $j < count($prospectus_report); $j++){
                                                   $totl    = $totl + $prospectus_report[$j]['total'];
                                                   ?>
                                                <th><?php echo $prospectus_report[$j]['total']?></th>
                                                <?php } ?>  
                                                <td><?php echo $totl; ?></td>
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
