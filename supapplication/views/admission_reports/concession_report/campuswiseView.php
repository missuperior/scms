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
                                    <?php if(count($concession_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title"> Campus Wise Concession Report</h3>                                       
                                    </div>                                                                    
                                    <table id="receiveable" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="9"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="7"><h3 style="text-align:right">Campus Wise Concession Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="9"><b>Campus : <?php  echo $concession_report[0]['campus_name'];?></b></td>
                                               <td colspan="7"><b>Campaign : <?php echo $concession_report[0]['campaign_name']; ?></b></td>
                                           </tr>                                           
                                            <tr style="font-size: 10px">
                                                <th>Sr#</th>
                                                <th>Program Name</th>
                                                <th>CTA</th>
                                                <th>100%</th>
                                                <th>90%</th>
                                                <th>80%</th>
                                                <th>75%</th>
                                                <th>50%</th>
                                                <th>40%</th>
                                                <th>35%</th>
                                                <th>30%</th>
                                                <th>25%</th>
                                                <th>20%</th>
                                                <th>10%</th>
                                                <th>Full Paid</th>
                                                <th>Total</th>
                                            </tr>
                                            <tr><th colspan="16" style="text-align: center;"> Morning </th></tr>
                                        </thead>
                                        
                                        <tbody>
                                            
                                          <?php $prg_id=0; $sr=1; $row_total=0; $ten=0; $a=0; $b=0; $c=0; $d=0; $e=0; $f=0; $g=0; $h=0; $i=0; $j=0; $k=0; $l=0;
                                          foreach($concession_report as $row){
                                            if($row['program_id'] != $prg_id){
                                          ?>
                                          <tr>
                                            <td><?php echo $sr;?></td>
                                            <td><?php echo $row['program_name'];?></td>
                                            
                                            <td><?php $t_ten = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                  $t_ten = $t_ten + $v['total_ten'];
                                              }
                                            }
                                            echo $t_ten;                                                
                                            ?></td>
                                            
                                            <td><?php $hu = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=100 && $v['percentage']>90){
                                                  $hu = $hu + $v['total'];
                                                }
                                              }
                                            }
                                            echo $hu;                                                
                                            ?></td>
                                            
                                            <td><?php $n = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=90 && $v['percentage']>80){
                                                  $n = $n + $v['total'];
                                                }
                                              }
                                            }
                                            echo $n;                                                
                                            ?></td>
                                            
                                            <td><?php $ei = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=80 && $v['percentage']>75){
                                                  $ei = $ei + $v['total'];
                                                }
                                              }
                                            }
                                            echo $ei;                                                
                                            ?></td>
                                            
                                            <td><?php $s = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=75 && $v['percentage']>50){
                                                  $s = $s + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $s; 
                                            ?></td>
                                            
                                            <td><?php $fi = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=50 && $v['percentage']>40){
                                                  $fi = $fi + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $fi; 
                                            ?></td>
                                            
                                            <td><?php $fo = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=40 && $v['percentage']>35){
                                                  $fo = $fo + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $fo; 
                                            ?></td>
                                            
                                            <td><?php $tf = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=35 && $v['percentage']>30){
                                                  $tf = $tf + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $tf; 
                                            ?></td>
                                            
                                            <td><?php $twf = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=30 && $v['percentage']>25){
                                                  $twf = $twf + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $twf; 
                                            ?></td>
                                            
                                            <td><?php $tw = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=25 && $v['percentage']>20){
                                                  $tw = $tw + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $tw; 
                                            ?></td>
                                            
                                            <td><?php $t = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=20 && $v['percentage']>10){
                                                  $t = $t + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                            <td><?php $te = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=10 && $v['percentage']>0){
                                                  $te = $te + $v['total'];
                                                }
                                              }
                                            }
                                            echo $te; 
                                            ?></td>
                                            
                                            <td><?php $full = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']==0){
                                                  $full = $full + $v['total'] - $v['total_ten'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $full; 
                                            ?></td>
                                            
                                            <th><?php
                                            echo $row_total = $t_ten+$hu+$n+$ei+$s+$fi+$fo+$tf+$twf+$tw+$t+$te+$full;
                                            ?></th>
                                            
                                          </tr>                                     
                                          <?php $sr++; 
                                          $prg_id = $row['program_id'];
                                          $ten = $ten + $t_ten;
                                          $a = $a + $hu;
                                          $b = $b + $n;
                                          $c = $c + $ei;
                                          $d = $d + $s;
                                          $e = $e + $fi;
                                          $f = $f + $fo;
                                          $g = $g + $tf;
                                          $h = $h + $twf;
                                          $i = $i + $tw;
                                          $j = $j + $t;
                                          $k = $k + $te;
                                          $l = $l + $full;
                                          $row_total = 0;
                                          }  } 
                                          ?>
                                         
                                        </tbody>
                                        <tr>
                                          <th colspan="2">Total</th>
                                          <th><?php echo $ten; ?></th>
                                          <th><?php echo $a; ?></th>
                                          <th><?php echo $b; ?></th>
                                          <th><?php echo $c; ?></th>
                                          <th><?php echo $d; ?></th>
                                          <th><?php echo $e; ?></th>
                                          <th><?php echo $f; ?></th>
                                          <th><?php echo $g; ?></th>
                                          <th><?php echo $h; ?></th>
                                          <th><?php echo $i; ?></th>
                                          <th><?php echo $j; ?></th>
                                          <th><?php echo $k; ?></th>
                                          <th colspan="2"><?php echo $l; ?></th>
                                        </tr>                                        
                                        <!-- *** Morning End **** -->
                                        
                                        
                                        
                                        
                                        
                                                                                
                                        <tr><td style="text-align: right" colspan="16">Powered By : Superior Solutionz</td></tr>                                        
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