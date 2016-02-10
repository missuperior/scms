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
                                    
                                    <?php if(count($result) > 0 ){?>
                                    
                                    <div class="table-header">
                                        
                                        <h3 id="title">Result Summary (Program Wise)</h3>
                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="4"><h2 style="text-align:right">Result Summary (Program Wise)</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                                                             
                                                <td colspan="3"><b>Test:  <?php echo   '('.$result[0]['test_no'].')'; ?></b></td>                                                
                                                <td  colspan="2" style="text-align: center; color: maroon"><b > Date :<?php echo(date("d-M-Y",strtotime($result[0]['test_date']))); ?></b></td>
                                                <td colspan="2"><b>Time : <?php echo $result[0]['test_time']; ?></b></td>                                                
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>                                                                                                
                                                <th>Program</th>                                                                                                
                                                <th>Total</th>
                                                <th>Pass</th>
                                                <th>Fail</th>
                                                <th>Absent</th>
                                                <th>Room </th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                        $t_appear = 0;                                   
                                        $t_pass = 0;                                   
                                        $t_fail = 0;                                   
                                        $t_absent = 0;                                   
                                        for($i=0; $i<count($result);$i++){   
                                            
                                            $t_appear = $t_appear + $result[$i]['total'];
                                            $t_pass   = $t_pass + $result[$i]['pass'];
                                            $t_fail   = $t_fail + $result[$i]['fail'];
                                            $t_absent = $t_absent + $result[$i]['absent'];
                                            
                                            ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>                                                
                                                <td><?php echo $result[$i]['program_name']; ?></td>
                                                <td><?php echo $result[$i]['total']; ?></td>
                                                <td><?php echo $result[$i]['pass']; ?></td>
                                                <td><?php echo $result[$i]['fail']; ?></td>  
                                                <td><?php echo $result[$i]['absent']; ?></td>                                                
                                                                                              
                                                <td><?php echo $result[$i]['room_name']; ?></td>                                                                                                
                                                
                                           </tr>
                                            
                                            <?php } ?> 
                                           
                                        </tbody>
                                        
                                            <tr style="font-size: 10px">
                                                
                                                <td colspan="2">Grand Total</td>                                               
                                                <td><?php echo $t_appear; ?></td>
                                                <td><?php echo $t_pass; ?></td>
                                                <td><?php echo $t_fail; ?></td>
                                                <td colspan="2"><?php echo $t_absent; ?></td>                                                
                                                
                                           </tr>
                                        
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
