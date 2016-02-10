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
                                    <div class="table-header">                                        
                                        <h3 id="title">Month Closing Report</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="2"><h3 style="text-align:right">Month Closing Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="3"><b>Campus : <?php  echo $campus_name;?></b></td>
                                                <td><b>Campaign : <?php echo $campaign_name; ?></b></td>
                                                <td><b style="color: maroon;"><?php echo date('d M Y', strtotime($start_date)).' - '.date('d M Y', strtotime($end_date)); ?></b></td>
                                           </tr>
                                           <tr>                                             
                                              <th>Month Name</th>
                                              <th>Month Receivable</th>
                                              <th>Total Receivable</th>
                                              <th>Month Received</th>
                                              <th>Defaulter</th>
                                           </tr>
                                        </thead>                                       
                                        
                                        <tbody>  
                                          <tr>
                                          <?php 
                                          $date1 = $start_date;
                                          $date2 = $end_date;
                                          
                                          $ts1 = strtotime($date1);
                                          $ts2 = strtotime($date2);

                                          $year1 = date('Y', $ts1);
                                          $year2 = date('Y', $ts2);

                                          $month1 = date('m', $ts1);
                                          $month2 = date('m', $ts2);

                                          $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                                          
                                          $g_total = 0;
                                          $def = 0;
                                          for($i=0; $i<=$diff; $i++){
                                             
                                            if($i==0){
                                              $s_date = $start_date;
                                              $e_date = $year1.'-'.$month1.'-31';
                                            }else if($i == $diff){
                                              $s_date = $year2.'-'.$month2.'-01'; 
                                              $e_date = $end_date; 
                                            }else{
                                            $new = date("Y-m-d", strtotime("+".$i." month", $ts1));
                                              $s_date = date("Y-m", strtotime($new)).'-01';
                                              $e_date = date("Y-m", strtotime($new)).'-31';
                                            }
                                            
                                           //for($j=1; $j<4; $j++){
                                           $rec_able = $this->Account_reports_model->getReceivable($campaign_id, $campus_id, $s_date, $e_date);
                                           //echo '<pre>'; var_dump($rec_able);
                                           $rec_ed   = $this->Account_reports_model->getReceived($campaign_id, $campus_id, $s_date, $e_date);
                                          // echo '<br><pre>'; var_dump($rec_ed);
                                           if($rec_able->rcvable != ''){?>
                                                                                      
                                            <td><?php echo date('M,Y', strtotime($rec_able->due_date)); ?></td>
                                            <td><?php echo number_format($rec_able->rcvable); ?> </td>
                                            <td><?php 
                                            $total_rec_able = $rec_able->rcvable + $def;
                                            echo number_format($total_rec_able);
                                            $def = $total_rec_able - $rec_ed->rced;
                                            //$def_rcvble = $rec_able->rcvable + $def;
                                            ?></td>
                                            <td><?php echo number_format($rec_ed->rced); ?> </td>
                                            <td><?php echo number_format($def); ?></td>                                                                                       
                                            </tr>
                                          <?php
                                          }                                          
                                          $recable_total = $recable_total + $rec_able->rcvable;
                                          $rcv_def_total = $recable_total + $def_rcvble;
                                          $def_total     = $def_total + $rec_able->defaulter;
                                          $g_total       = $g_total + $rec_ed->rced;                                           
                                          //$def = 0;
                                              
                                          //}
                                          }
                                          ?>
                                             
                                        </tbody>
                                        <tr>
                                          <td colspan="1" style="font-weight: bold;">Total:</td>
                                          <td><?php echo number_format($recable_total); ?></td>
                                          <td><?php echo number_format($rcv_def_total); ?></td>
                                          <td><?php echo number_format($g_total); ?></td>
                                          <td><?php echo number_format($def_total); ?></td>
                                        </tr>                                      
                                        <tr><td style="text-align: right" colspan="5">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                                                 
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