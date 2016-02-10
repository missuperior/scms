<!--5571
1660-->
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
                                                                                
                                            <?php if($res_status == 1){?>
                                            <h3 style="width:70%; float:left; margin: 0px;" id="title">Mid Result </h3> 
                                            <h3 >
<!--                                                <a style="text-decoration: none; color: white"  href="<?php echo base_url();?>teachers/edit_mid_result/<?php echo $teacher_id;?>/<?php echo $program_id;?>/<?php echo $course_id;?>/<?php echo $section_id;?>/<?php echo $session_id;?>/<?php echo $batch_id;?>">
                                                    Edit | 
                                                </a> -->
                                                  
<!--                                                <a onclick="return confirm('Are You Sure ?');" style="text-decoration: none; color: white"  href="<?php echo base_url();?>teachers/delete_mid_result/<?php echo $teacher_id;?>/<?php echo $program_id;?>/<?php echo $course_id;?>/<?php echo $section_id;?>/<?php echo $session_id;?>/<?php echo $batch_id;?>">
                                                    Delete 
                                                </a>  |-->

<!--                                                <a onclick="return confirm('Are You Sure ?');" style="text-decoration: none; color: white"  href="<?php echo base_url();?>teachers/post_mid_result/<?php echo $teacher_id;?>/<?php echo $program_id;?>/<?php echo $course_id;?>/<?php echo $section_id;?>/<?php echo $session_id;?>/<?php echo $batch_id;?>">
                                                    Post
                                                </a>                                                 -->
                                            </h3>  
                                            <?php }else{?>
                                                <h3 id="title">Mid Result </h3>     
                                            <?php } ?>
                                            
                                            <hr>
                                            <h3>Program : <?php echo $students[0]['program_name']; ?></h3>
                                            <h3>Course : <?php echo $students[0]['course_name']; ?></h3> 
                                            <h3>Section: <?php echo $students[0]['course_section']; ?></h3> 
                                                
                                    </div>   
                                
                                    
                                
                                <form class="form-horizontal" id="postChallan" onsubmit="return confirm('Are you sure ?');" method="POST" action="<?php echo base_url();?>teachers/update_mid_result" enctype="multipart/form-data" />
                                
                                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>"/>
                                <input type="hidden" name="program_id" value="<?php echo $program_id;?>"/>
                                <input type="hidden" name="batch_id" id="batch_id"  value="<?php echo $batch_id; ?>" />
                                <input type="hidden" name="session_id" id="session_id"  value="<?php echo $session_id; ?>" /> 
                                <input type="hidden" name="session_id" id="session_id"  value="<?php echo $section_id; ?>" /> 
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>                                            
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                                 
                                                <?php 
                                                
                                                $mid_value_1 = $mid->mid_value_1;
                                                $mid_value_2 = $mid->mid_value_2;
                                                $mid_value_3 = $mid->mid_value_3;
                                                
                                                $mid_val1    = $mid_value_1  == '0'  ? 'disabled="disabled"' : ''; 
                                                $mid_val2    = $mid_value_2  == '0'  ? 'disabled="disabled"' : ''; 
                                                $mid_val3    = $mid_value_3  == '0'  ? 'disabled="disabled"' : ''; 
                                                
                                                ?>
                                                
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
                                                                        'teacher_id'    =>  $this->session->userdata('sub_login_id'),
                                                                        'student_id'    =>  $students[$i]['student_id'],
                                                                        'session_id'    =>  $session_id,
                                                                        'course_id'     =>  $course_id,
                                                                        //'course_id'     =>  $course_id,
                                                                     );
                                                    
                                                    $mid_result     =   $this->Teachers_model->getMidResult($data);
                                                      //echo  '<pre>';var_dump($mid_result);$mid_result ; echo  '</pre>'; die;
                                            ?>
                                           
                                                    <tr style="font-size: 10px">

                                                        <td><?php echo $i+1; ?></td>
                                                        <td><?php echo $students[$i]['student_name']; ?></td>
                                                        <td><?php echo $students[$i]['roll_no']; ?></td>    
                                                        
                                                        <input type="hidden" id="student_id" name="student_id[]" value="<?php echo $students[$i]['student_id']; ?>" />
                                                        
                                                        <input name="mid_result_id[]" type="hidden" value="<?php echo $mid_result->mid_result_id;?>" />
                                                        <td><input name="mid_value_1[]" style="width:50px" <?php echo $mid_val1; ?> type="text" value="<?php echo $mid_result->mid_value_1;?>" /></td>
                                                        <td><input name="mid_value_2[]" style="width:50px" <?php echo $mid_val2; ?> type="text" value="<?php echo $mid_result->mid_value_2;?>"  /></td>
                                                        <td><input name="mid_value_3[]" style="width:50px" <?php echo $mid_val3; ?> type="text" value="<?php echo $mid_result->mid_value_3;?>" /></td>
                                                        <td><?php echo $mid_result->mid_value_1 + $mid_result->mid_value_2 + $mid_result->mid_value_3;?></td>
                                                        <td><?php $status = $mid_result->status; ?>
                                                            <select name="status[]" style="width:50px;">
                                                                <option <?php echo $kk = $status =='P' ? 'selected="selected"' : '';  ?> value="P">P</option>
                                                                <option <?php echo $kk = $status =='A' ? 'selected="selected"' : '';  ?> value="A">A</option>
                                                            </select>
                                                        </td>
                                                   </tr>                                            
                                        <?php } ?>                                                         
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="12">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                <input type="submit" value="Submit" onclick="validate();" class="btn btn-purple btn-small" style="float: left; margin-top: 15px;" >
                            </form>
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
<script type="text/javascript">
    function validate()
    {         
        var r = confirm("Are you sure ?");
        if (r == true) { document.postChallan.submit(); } 
    }
</script>