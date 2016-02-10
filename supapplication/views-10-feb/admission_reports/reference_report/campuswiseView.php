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
                                    <?php if(count($reference_report) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title"> Campus Wise Reference Report</h3>                                       
                                    </div>                                                                    
                                    <table id="receiveable" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="12"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td colspan="10"><h3 style="text-align:right">Campus Wise Reference Report</h3></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">                                                
                                               <td colspan="11"><b>Campus : <?php  echo $reference_report[0]['campus_name'];?></b></td>
                                               <td colspan="11"><b>Campaign : <?php echo $reference_report[0]['campaign_name']; ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Sr#</th>
                                                <th>Program Name</th>
                                                <th>Jang</th>
                                                <th>Nai Baat</th>
                                                <th>Nawa-iWaqt</th>
                                                <th>Khabrein</th>
                                                <th>Express</th>
                                                <th>The News</th>
                                                <th>SMS</th>
                                                <th>TV/Cable</th>
                                                <th>Email</th>
                                                <th>Internet</th>
                                                <th>Hoardings</th>
                                                <th>Old Student Self</th>
                                                <th>O/S</th>
                                                <th>Freinds/Reletives</th>
                                                <th>Academy/School</th>
                                                <th>Faculty/Staff</th>
                                                <th>Principal</th>
                                                <th>Events</th>
                                                <th>Goodwill/Fame</th>
                                                <th>Others</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php $a=0; $b=0; $c=0; $d=0; $e=0; $f=0; $g=0; $h=0; $i=0; $j=0; $k=0; $l=0; $m=0; $n=0; $o=0; $p=0; $q=0; $r=0; $s=0; $t=0;
                                          $i=0;
                                          foreach($reference_report as $row){
                                            
                                          ?>
                                          <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $row['program_name'];?></td>
                                            <td><?php echo $row['jang'];?></td>
                                            <td><?php echo $row[''];?></td>
                                            <td><?php echo $row['nawai_waqt'];?></td>
                                            <td><?php echo $row['khabrein'];?></td>
                                            <td><?php echo $row['express'];?></td>
                                            <td><?php echo $row['the_news'];?></td>
                                            <td><?php echo $row['sms'];?></td>
                                            <td><?php echo $row['cable'];?></td>
                                            <td><?php echo $row['email'];?></td>
                                            <td><?php echo $row['internet'];?></td>
                                            <td><?php echo $row['hoarding'];?></td>
                                            <td><?php echo $row['old_std'];?></td>
                                            <td><?php echo $row[''];?></td>
                                            <td><?php echo $row['friends'];?></td>
                                            <td><?php echo $row[''];?></td>
                                            <td><?php echo $row['faculty'];?></td>
                                            <td><?php echo $row['principal'];?></td>
                                            <td><?php echo $row[''];?></td>
                                            <td><?php echo $row['goodwill'];?></td>
                                            <td><?php echo $row['others'];?></td>
                                          </tr>                                     
                                          <?php 
                                          $a = $a + $row['jang'];
                                          $b = $b + $row[''];
                                          $c = $c + $row['nawai_waqt'];
                                          $d = $d + $row['khabrein'];
                                          $e = $e + $row['express'];
                                          $f = $f + $row['the_news'];
                                          $g = $g + $row['sms'];
                                          $h = $h + $row['cable'];
                                          $i = $i + $row['email'];
                                          $j = $j + $row['internet'];
                                          $k = $k + $row['hoarding'];
                                          $l = $l + $row['old_std'];
                                          $m = $m + $row[''];
                                          $m = $n + $row['friends'];
                                          $o = $o + $row[''];
                                          $p = $p + $row['faculty'];
                                          $q = $q + $row['principal'];
                                          $r = $r + $row[''];
                                          $s = $s + $row['goodwill'];
                                          $t = $t + $row['others'];
                                          
                                          $i++;
                                          } ?>
                                         
                                        </tbody>
                                        <tr>
                                            <th colspan="2">Total :</th>
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
                                          <th><?php echo $l; ?></th>
                                          <th><?php echo $m; ?></th>
                                          <th><?php echo $n; ?></th>
                                          <th><?php echo $o; ?></th>
                                          <th><?php echo $p; ?></th>
                                          <th><?php echo $q; ?></th>
                                          <th><?php echo $r; ?></th>
                                          <th><?php echo $s; ?></th>
                                          <th><?php echo $t; ?></th>
                                        </tr>
                                        
                                        <tr><td style="text-align: right" colspan="22">Powered By : Superior Solutionz</td></tr>                                        
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