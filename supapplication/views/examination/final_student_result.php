<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
						
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
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>							
                <div class="row-fluid">
                    <div class="span12">                                                                     
                            <div class="row-fluid">                                             
                                    <?php if(count($final_result) > 0 ){?>                                    
                                   <div class="table-header" style="height:40px; line-height: 40px;">                                        
                                        <h3 style="width:70%; float:left; margin: 0px;" >Final Result </h3>                                       
                                        <h3 >
                                            <?php if($this->session->userdata('role') == 'HODD'){?>
                                            
                                                <?php if($res_status == 1){?>
                                                    <a style="text-decoration: none; color: white"  href="<?php echo base_url();?>examination/edit_final_result/<?php echo $campaign_id;?>/<?php echo $program_id;?>/<?php echo $course_id;?>/<?php echo $semester;?>">
                                                        Edit
                                                    </a> |   
                                                    <a onclick="return confirm('Are You Sure ?');" style="text-decoration: none; color: white"  href="<?php echo base_url();?>examination/delete_final_result/<?php echo $campaign_id;?>/<?php echo $program_id;?>/<?php echo $course_id;?>/<?php echo $semester;?>">
                                                        Delete 
                                                    </a>  

                                            <?php }} ?>
                                        </h3>                                       
                                    </div>                                    
                                    <table id="example-" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size: 10px">                                                
                                                <th colspan="6" style="color:#006E6F; font-size: 16px;"><b>Program : </b><?php echo $final_result[0]['program_name']; ?></th>                                                
                                                <th colspan="7" style="color:#006E6F; font-size: 16px;"><b>Course : </b><?php echo $final_result[0]['course_name']; ?></th>                                                
                                            </tr>
                                            
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>                                                                                                                                       
                                                <th>Semester</th>                                                                                            
                                                <!--<th>Action</th>-->                                                                                             
                                                <th><?php echo $final_structure->final_title_1.'('.$final_structure->final_value_1.')';?></th>
                                                <th><?php echo $final_structure->final_title_2.'('.$final_structure->final_value_2.')';?></th>
                                                <th><?php echo $final_structure->final_title_3.'('.$final_structure->final_value_3.')';?></th>
                                                <th><?php echo $final_structure->final_title_4.'('.$final_structure->final_value_4.')';?></th>
                                                <th><?php echo $final_structure->final_title_5.'('.$final_structure->final_value_5.')';?></th>
                                                <th><?php echo $final_structure->final_title_6.'('.$final_structure->final_value_6.')';?></th>
                                                <th><?php echo $final_structure->final_title_7.'('.$final_structure->final_value_7.')';?></th>
                                                
                                                <?php $total = $final_structure->final_value_1 +$final_structure->final_value_2 +$final_structure->final_value_3 + $final_structure->final_value_4 +$final_structure->final_value_5 +$final_structure->final_value_6 +$final_structure->final_value_7; ?>
                                                
                                                <th>Total <?php echo '('.$total.')';?></th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php                                                                                 
                                        for($i=0; $i<count($final_result);$i++){ ?>
                                           
                                             <tr style="font-size: 10px">

                                                            <td><?php echo $i+1; ?></td>
                                                            <td><?php echo $final_result[$i]['student_name']; ?></td>
                                                            <td><?php echo $final_result[$i]['roll_no']; ?></td>                                                                                                                                                                                                                                          
                                                            <td><?php echo $final_result[$i]['semester']; ?></td>                                                            

                                                            <td><?php echo $final_result[$i]['final_value_1'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_2'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_3'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_4'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_5'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_6'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_7'];?></td>
                                                            <td><?php echo $final_result[$i]['final_value_1'] + $final_result[$i]['final_value_2'] + $final_result[$i]['final_value_3'] + $final_result[$i]['final_value_4'] + $final_result[$i]['final_value_5'] + $final_result[$i]['final_value_6'] + $final_result[$i]['final_value_7'];?></td>
                                                            <td><?php echo $final_result[$i]['status'];?></td>
                                                            
                                                            
                                                       </tr>                                            
                                        <?php }?>                                                         
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="15">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                    <br/>
                                
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
