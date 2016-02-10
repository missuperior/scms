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
                                        <h3 id="title">Month Receivable Report</h3>                                       
                                    </div>                                                                    
                                    
                              <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr>
                                              <th>Campus</th>
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

                                                for($i=0; $i<=$diff; $i++){
                                                  $date = "2014-".$receivable[$i]['mon']."-01";
                                                  $a[] = $receivable[$i]['mon']; 
                                              ?>
                                              <th><?php echo date('M-Y', strtotime($date)); ?></th>                                              
                                              
                                          <?php } ?>
                                            <th>Total</th>
                                           </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php 
                                          $c = 0; $k=0; $inc = $diff;
                                          foreach($receivable as $key => $value){
                                            if($c != $value['campus_id']){
//                                              echo $row['campus_name'];
                                          ?>
                                          
                                          <tr>
                                          
                                            <td><?php echo $value['campus_name']; ?></td>
                                            
                                            <?php $total = 0;
                                            for($z=0; $z<=$diff;$z++){
                                                if($receivable[$k]['mon'] == $a[$z]){
//                                                  for($j=$k; $j<=$diff; $j++){
                                            ?>
                                            
                                            <td><?php echo number_format($receivable[$k]['amount']);
                                                $total  =   $total  + $receivable[$k]['amount'];
                                            ?></td>
                                          
                                            <?php $k++;                                            
                                                }else{
                                                 echo "<td>"."</td>"; 
                                                }
                                            } ?>
                                            <td><?php echo number_format($total); ?></td>
                                         </tr>
                                         
                                         <?php  
//                                         $k = $diff + 1;
//                                         $diff = $k + $inc; 
                                         
                                         $c = $value['campus_id'];                                         
                                          }}?>  
                                        </tbody>
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