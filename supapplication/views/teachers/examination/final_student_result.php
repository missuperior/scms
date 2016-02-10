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
                                                <th><?php echo $final->final_title_1.'('.$final->final_value_1.')';?></th>
                                                <th><?php echo $final->final_title_2.'('.$final->final_value_2.')';?></th>
                                                <th><?php echo $final->final_title_3.'('.$final->final_value_3.')';?></th>
                                                <th><?php echo $final->final_title_4.'('.$final->final_value_4.')';?></th>
                                                <th><?php echo $final->final_title_5.'('.$final->final_value_5.')';?></th>
                                                <th><?php echo $final->final_title_6.'('.$final->final_value_6.')';?></th>
                                                <th><?php echo $final->final_title_7.'('.$final->final_value_7.')';?></th>
                                                
                                                <?php $total = $final->final_value_1 +$final->final_value_2 +$final->final_value_3 + $final->final_value_4 +$final->final_value_5 +$final->final_value_6 +$final->final_value_7; ?>
                                                
                                                <th>Total <?php echo '('.$total.')';?></th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php                         
                                        $std_list = count($students);
                                        for($i=0; $i < $std_list; $i++){ 
                                            
                                                    $data   =   array(
                                                                        'teacher_id'    =>  $teacher_id,
                                                                        'student_id'    =>  $students[$i]['student_id'],
                                                                        'session_id'    =>  $session_id,
                                                                        'course_id'     =>  $course_id
                                                                     );
                                                    
                                                    $final_result     =   $this->Teachers2_model->getFinalResult($data);
                                            ?>
                                           
                                             <tr style="font-size: 10px">

                                                            <td><?php echo $i+1; ?></td>
                                                            <td><?php echo $students[$i]['student_name']; ?></td>
                                                            <td><?php echo $students[$i]['roll_no']; ?></td>                                                                                                                        
                                                            <td><?php echo $students[$i]['program_name']; ?></td>
                                                            <td><?php echo $students[$i]['course_name']; ?></td>                                                            
                                                            <td><?php echo $students[$i]['course_section']; ?></td>                                                            

                                                            <td><?php echo $final_result->final_value_1;?></td>
                                                            <td><?php echo $final_result->final_value_2;?></td>
                                                            <td><?php echo $final_result->final_value_3;?></td>
                                                            <td><?php echo $final_result->final_value_4;?></td>
                                                            <td><?php echo $final_result->final_value_5;?></td>
                                                            <td><?php echo $final_result->final_value_6;?></td>
                                                            <td><?php echo $final_result->final_value_7;?></td>
                                                            <td><?php echo $final_result->final_value_1 + $final_result->final_value_2 + $final_result->final_value_3 + $final_result->final_value_4 + $final_result->final_value_5 + $final_result->final_value_6 + $final_result->final_value_7;?></td>
                                                            <td><?php echo $final_result->status;?></td>
                                                            
                                                            
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
