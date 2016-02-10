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
                                               <td colspan="8"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="6"><h3 style="text-align:right">Campus Wise Concession Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="7"><b>Campus : <?php  echo $concession_report[0]['campus_name'];?></b></td>
                                               <td colspan="7"><b>Campaign : <?php echo $concession_report[0]['campaign_name']; ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Program Name</th>
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
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                          <?php $prg_id = 0; $a=0; $b=0; $c=0; $d=0; $e=0; $f=0; $g=0; $th=0; $i=0; $j=0; $k=0; $l=0;
                                          foreach($concession_report as $row){
                                            if($row['shift'] == 'Morning' && $row['program_id'] != $prg_id){
                                          ?>
                                          <tr>
                                            <td><?php echo $row['program_name'];?></td>
                                            
                                            <td><?php $h = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=100 && $v['percentage']>90){
                                                  $h = $h + $v['total'];
                                                  $a = $a + $v['total'];
                                                }
                                              }
                                            }
                                            echo $h;                                                
                                            ?></td>
                                            
                                            <td><?php $n = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=90 && $v['percentage']>80){
                                                  $n = $n + $v['total'];
                                                  $b = $b + $v['total'];
                                                }
                                              }
                                            }
                                            echo $n;                                                
                                            ?></td>
                                            
                                            <td><?php $e = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=80 && $v['percentage']>75){
                                                  $e = $e + $v['total'];
                                                  $c = $c + $v['total'];
                                                }
                                              }
                                            }
                                            echo $e;                                                
                                            ?></td>
                                            
                                            <td><?php $s = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=75 && $v['percentage']>50){
                                                  $s = $s + $v['total'];
                                                  $d = $d + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $s; 
                                            ?></td>
                                            
                                            <td><?php $f = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=50 && $v['percentage']>40){
                                                  $e = $e + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $f; 
                                            ?></td>
                                            
                                            <td><?php $fo = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=40 && $v['percentage']>35){
                                                  $fo = $fo + $v['total']; 
                                                  $f = $f + $v['total'];                                                                                                
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
                                                  $g = $g + $v['total'];                                                                                                 
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
                                                  $th = $th + $v['total'];                                                                                                 
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
                                                  $i = $i + $v['total'];                                                                                                 
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
                                                  $j = $j + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                            <td><?php $t = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=10 && $v['percentage']>0){
                                                  $t = $t + $v['total']; 
                                                  $k = $k + $v['total'];                                                                                                
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                            <td><?php $t = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<10 && $v['percentage']>=0){
                                                  $t = $t + $v['total'];
                                                  $l = $l + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                          </tr>                                     
                                          <?php }
                                          $prg_id = $row['program_id'];
                                          } ?>
                                         
                                        </tbody>
                                        <tr>
                                          <th>Total</th>
                                          <th><?php echo $a; ?></th>
                                          <th><?php echo $b; ?></th>
                                          <th><?php echo $c; ?></th>
                                          <th><?php echo $d; ?></th>
                                          <th><?php echo $e; ?></th>
                                          <th><?php echo $f; ?></th>
                                          <th><?php echo $g; ?></th>
                                          <th><?php echo $th; ?></th>
                                          <th><?php echo $i; ?></th>
                                          <th><?php echo $j; ?></th>
                                          <th><?php echo $k; ?></th>
                                          <th><?php echo $l; ?></th>
                                        </tr>
                                        
                                        <tbody>
                                          <?php $prg_id = 0; $a=0; $b=0; $c=0; $d=0; $e=0; $f=0; $g=0; $th=0; $i=0; $j=0; $k=0; $l=0;
                                          foreach($concession_report as $row){
                                            if($row['shift'] == 'Evening' && $row['program_id'] != $prg_id){
                                          ?>
                                          <tr>
                                            <td><?php echo $row['program_name'];?></td>
                                            
                                            <td><?php $h = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=100 && $v['percentage']>90){
                                                  $h = $h + $v['total'];
                                                  $a = $a + $v['total'];
                                                }
                                              }
                                            }
                                            echo $h;                                                
                                            ?></td>
                                            
                                            <td><?php $n = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=90 && $v['percentage']>80){
                                                  $n = $n + $v['total'];
                                                  $b = $b + $v['total'];
                                                }
                                              }
                                            }
                                            echo $n;                                                
                                            ?></td>
                                            
                                            <td><?php $e = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=80 && $v['percentage']>75){
                                                  $e = $e + $v['total'];
                                                  $c = $c + $v['total'];
                                                }
                                              }
                                            }
                                            echo $e;                                                
                                            ?></td>
                                            
                                            <td><?php $s = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=75 && $v['percentage']>50){
                                                  $s = $s + $v['total'];
                                                  $d = $d + $v['total'];                                                                                                 
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
                                                  $d = $d + $v['total'];                                                                                                 
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
                                                  $f = $f + $v['total'];                                                                                                
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
                                                  $g = $g + $v['total'];                                                                                                 
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
                                                  $th = $th + $v['total'];                                                                                                 
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
                                                  $i = $i + $v['total'];                                                                                                 
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
                                                  $j = $j + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                            <td><?php $t = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<=10 && $v['percentage']>0){
                                                  $t = $t + $v['total']; 
                                                  $k = $k + $v['total'];                                                                                                
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                            <td><?php $t = 0;
                                            foreach($concession_report as $v){               
                                              if($row['program_id']==$v['program_id']){
                                                if($v['percentage']<10 && $v['percentage']>=0){
                                                  $t = $t + $v['total'];
                                                  $l = $l + $v['total'];                                                                                                 
                                                }
                                              }
                                            }
                                            echo $t; 
                                            ?></td>
                                            
                                          </tr>                                     
                                          <?php }
                                          $prg_id = $row['program_id'];
                                          } ?>
                                         
                                        </tbody>
                                        
                                        <?php print_r(array_count_values($concession_report)); ?>
                                        
                                        <tr>
                                          <th>Total</th>
                                          <th><?php echo $a; ?></th>
                                          <th><?php echo $b; ?></th>
                                          <th><?php echo $c; ?></th>
                                          <th><?php echo $d; ?></th>
                                          <th><?php echo $e; ?></th>
                                          <th><?php echo $f; ?></th>
                                          <th><?php echo $g; ?></th>
                                          <th><?php echo $th; ?></th>
                                          <th><?php echo $i; ?></th>
                                          <th><?php echo $j; ?></th>
                                          <th><?php echo $k; ?></th>
                                          <th><?php echo $l; ?></th>
                                        </tr>
                                        
                                        <tr><td style="text-align: right" colspan="14">Powered By : Superior Solutionz</td></tr>                                        
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