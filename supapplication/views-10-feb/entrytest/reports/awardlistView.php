<div class="main-content" style="margin-left: 0px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">ENTRY TEST MODULE</a>
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
                                    <?php if(count($programslist) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Students Award List</h3>                                       
                                    </div>                                                                    
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="4"><b style="  font-size: 22px;    margin-left: 10px;"><?php echo $programslist[0]['room_name'];?></b></td>
                                               <td ><b style="  font-size: 22px;    margin-left: 10px;"><?php echo $programslist[0]['test_no'];?></b></td>
                                           </tr>

                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>                                                
                                                <th>From #</th>
                                                <th>Student Name</th>
                                                <th>Program</th>                                                                                           
                                                <th>Marks</th>                                                                                           
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php 
                                        $c = 0;
                                        for($i=0; $i<count($programslist);$i++){  
                                              
                                                $result   = $this->Manager_model->getStudents($programslist[$i]['program_id'],$programslist[$i]['start_form_id'],$programslist[$i]['last_form_id']);  
                                                
                                                for($j=0; $j < count($result); $j++){
                                            ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $c+1; ?></td>
                                                <td><?php echo $result[$j]['form_no']; ?></td>
                                                <td><?php echo $result[$j]['student_name']; ?></td>
                                                <td><?php echo $result[$j]['program_name']; ?></td>
                                                <td><input type="text" name="marks" ></td>
                                                
                                           </tr>                                            
                                                <?php  $c++; } } ?>                                            
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