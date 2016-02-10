<?php 
//echo '<pre>';
//var_dump($info);
//echo '</pre>';

?>

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
                                    <?php if(count($info) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">All Courses</h3>                                       
                                    </div>                                   
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>                                       
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Program Name</th>
                                                <th>Course Name</th>
                                                <th>Semester</th>                                                                                                                                        
                                                <th>Session</th>                                                                                                                                        
                                                <th>Course Section</th>                                                                                                                                        
                                                <th>Action</th>                                                                                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php        
                                        $coiunt = count($info);
                                        for($i=0; $i < $coiunt ; $i++){
                                            
                                                $check_data     =   array(
                                                                        'teacher_id'            =>  $info[$i]['teacher_id'],
                                                                        'program_id'            =>  $info[$i]['program_id'],
                                                                        'course_id'             =>  $info[$i]['course_id'],
                                                                        'section'               =>  $info[$i]['course_section'],
                                                                        'session_id'            =>  $info[$i]['session_id']                                           
                                                                        );
                                                $res            =   $this->Teachers2_model->CheckMidResult($check_data);
                                                $res2           =   $this->Teachers2_model->CheckFinalResult($check_data);
                                                
//                                                echo '<pre>';var_dump($check_data);echo '</pre>';
//                                                echo '<pre>';var_dump($res);echo '</pre>';
                                                
                                                
                                            
                                            ?>
                                           
                                             <tr style="font-size: 10px">
                                                    <td><?php echo $i+1; ?></td>
                                                    <td><?php echo $info[$i]['program_name']; ?></td>
                                                    <td><?php echo $info[$i]['course_name']; ?></td>                                                                                                                        
                                                    <td><?php echo $info[$i]['semester']; ?></td>                                                                                                                        
                                                    <td><?php echo $info[$i]['session']; ?></td>
                                                    <td><?php echo $info[$i]['course_section']; ?></td>
                                                    <td>
                                                       <?php

                                                       if( $info[$i]['course_type']  == 'Lab' or $info[$i]['credit_hours']  == '1'){  ?>
                                                        <?php if($res2 < 1){?>

                                                                 <a  href="<?php echo base_url();?>teachers/students_list_for_final/?teacher_id=<?php echo $info[$i]['teacher_id'];?>&course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                      Add Final                                                                    
                                                                 </a>

                                                             <?php }else{?>   

                                                                 <a  href="<?php echo base_url();?>teachers/view_final_result/?teacher_id=<?php echo $info[$i]['teacher_id'];?>&course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                      View Final
                                                                 </a>

                                                             <?php } ?>


                                                       <?php } else{  ?>
                                                                    <?php if($res < 1){?>

                                                                     <a  href="<?php echo base_url();?>teachers/students_list_for_mid/?teacher_id=<?php echo $info[$i]['teacher_id'];?>&course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                        Add Mid                                                                    
                                                                     </a>

                                                             <?php }else{?>

                                                                     <a  href="<?php echo base_url();?>teachers/view_mid_result/?teacher_id=<?php echo $info[$i]['teacher_id'];?>&course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                        View Mid                                                                    
                                                                     </a>

                                                             <?php }?>                                                                
                                                             | 
                                                             <?php if($res2 < 1){?>

                                                                 <a  href="<?php echo base_url();?>teachers/students_list_for_final/?teacher_id=<?php echo $info[$i]['teacher_id'];?>&course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                      Add Final                                                                    
                                                                 </a>

                                                             <?php }else{?>   

                                                                 <a  href="<?php echo base_url();?>teachers/view_final_result/?teacher_id=<?php echo $info[$i]['teacher_id'];?>&course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                      View Final
                                                                 </a>

                                                             <?php } ?>



                                                       <?php } ?>
                                                             
                                                           

                                                    </td>                                                            
                                               </tr>                                            
                                        <?php }?>                                            
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
