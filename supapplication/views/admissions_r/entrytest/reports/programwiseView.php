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
                                        
                                        <h3 id="title">Program Wise Detail</h3>
                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="2"><h2 style="text-align:right">Program Wise Detail</h2></td>                                                                                                                                                
                                           </tr>
                                           <tr style="font-size: 10px">
                                                                                             
                                                <td colspan="2"><b>Test:  <?php echo   '('.$result[0]['test_no'].')'; ?></b></td>                                                
                                                <td  colspan="2" style="text-align: center; color: maroon"><b > Date :<?php echo(date("d-M-Y",strtotime($result[0]['test_date']))); ?></b></td>
                                                <td colspan="1"><b>Time : <?php echo $result[0]['test_time']; ?></b></td>                                                
                                                                                                
                                           </tr>
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>                                                                                                
                                                <th>Form No</th>                                                                                                
                                                <th>Name</th>
                                                <th>Score</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                        <?php  
                                                                              
                                        for($i=0; $i<count($result);$i++){     ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>                                                
                                                <td><?php echo $result[$i]['form_no']; ?></td>
                                                <td><?php echo $result[$i]['name']; ?></td>
                                                <td><?php echo $result[$i]['marks']; ?></td>
                                                <td>
                                                    <?php if($result[$i]['marks'] >= 50)
                                                            {   echo 'Pass'; }
                                                            elseif ($result[$i]['marks'] == 'A') {
                                                                 echo 'Absent'; 
                                                            }
                                                            elseif ($result[$i]['marks'] < 50 && $result[$i]['marks']) {
                                                                 echo 'Fail'; 
                                                            }
                                                            
                                                    ?>
                                                </td>
                                                                                                                               
                                                
                                           </tr>
                                            
                                            <?php } ?> 
                                           
                                           
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
