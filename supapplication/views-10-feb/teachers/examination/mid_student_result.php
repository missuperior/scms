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
                                    <?php if(count($students) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                                          
                                                <h3 id="title">Mid Result </h3>     
                                            
                                    </div>   
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>                                            
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>Program</th>
                                                <th>Course</th>                                                                                            
                                                <th>Section</th>                                                                                            
                                                <!--<th>Action</th>-->                                                                                             
                                                <th><?php echo $mid->mid_title_1.'('.$mid->mid_value_1.')';?></th>
                                                <th><?php echo $mid->mid_title_2.'('.$mid->mid_value_2.')';?></th>
                                                <th><?php echo $mid->mid_title_3.'('.$mid->mid_value_3.')';?></th>
                                                
                                                <?php $total = $mid->mid_value_1 +$mid->mid_value_2 +$mid->mid_value_3; ?>
                                                
                                                <th>Total <?php echo '('.$total.')';?></th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php          
                                        $count_std = count($students);
                                        for($i=0; $i < $count_std; $i++){ 
                                            
                                                    $data   =   array(
                                                                        'teacher_id'    =>  $teacher_id,
                                                                        'student_id'    =>  $students[$i]['student_id'],
                                                                        'session_id'    =>  $session_id,
                                                                        'course_id'     =>  $course_id
                                                                     );
                                                    
                                                    $mid_result     =   $this->Teachers2_model->getMidResult($data);
                                            ?>
                                           
                                                    <tr style="font-size: 10px">

                                                        <td><?php echo $i+1; ?></td>
                                                        <td><?php echo $students[$i]['student_name']; ?></td>
                                                        <td><?php echo $students[$i]['roll_no']; ?></td>                                                                                                                        
                                                        <td><?php echo $students[$i]['program_name']; ?></td>
                                                        <td><?php echo $students[$i]['course_name']; ?></td>                                                            
                                                        <td><?php echo $students[$i]['course_section']; ?></td>                                                            

                                                        <td><?php echo $mid_result->mid_value_1;?></td>
                                                        <td><?php echo $mid_result->mid_value_2;?></td>
                                                        <td><?php echo $mid_result->mid_value_3;?></td>
                                                        <td><?php echo $mid_result->mid_value_1 + $mid_result->mid_value_2 + $mid_result->mid_value_3;?></td>
                                                        <td><?php echo $mid_result->status;?></td>
                                                   </tr>                                            
                                        <?php }?>                                                         
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="12">Powered By : Superior Solutionz</td></tr>                                        
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
