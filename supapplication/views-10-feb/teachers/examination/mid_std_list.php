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
                                    <?php 
                                    $count = count($students);
                                    if($count  > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">All Students</h3>                                       
                                    </div>   
                                
                                    <form name="postChallan" id="postChallan" onsubmit="return confirm('Are you sure ?');" action="<?php echo  base_url()?>teachers/add_mid_result" method="post" enctype="multipart/form-data">
                                    <table id="example11" class="table table-striped table-bordered table-hover">
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
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                            <input type="hidden" id="batch_id" name="batch_id" value="<?php echo $batch_id; ?>" />
                                            <input type="hidden" id="session_id" name="session_id" value="<?php echo $session_id; ?>" />                                                                   
                                            <input type="hidden" id="program_id" name="program_id" value="<?php echo $program_id; ?>" />                                                                   
                                            <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>" />
                                            <input type="hidden" id="teacher_id" name="teacher_id" value="<?php echo $teacher_id; ?>" />
                                            <input type="hidden" id="course_section" name="course_section" value="<?php echo $students[0]['course_section']; ?>" />
                                        <?php   
                                        
                                         $line1_tab = 1;
                                        $line2_tab = 301;
                                        $line3_tab = 601;
                                        $line4_tab = 1000;
                                        
                                        $jj = 1;
                                        for($i=0; $i < $count;$i++){ 
                                            
                                        ?>
                                           
                                             <tr style="font-size: 10px">

                                                            <td>
                                                                   <?php echo $jj; ?>
                                                                   <input type="hidden" id="student_id" name="student_id[]" value="<?php echo $students[$i]['student_id']; ?>" />
                                                                   <input type="hidden" id="semester" name="semester" value="<?php echo $students[$i]['semester']; ?>" />
                                                                   
                                                            </td>
                                                            <td><?php echo $students[$i]['student_name']; ?></td>
                                                            <td><?php echo $students[$i]['roll_no']; ?></td>                                                                                                                        
                                                            <td><?php echo $students[$i]['program_name']; ?></td>
                                                            <td><?php echo $students[$i]['course_name']; ?></td>                                                            
                                                            <td><?php echo $students[$i]['course_section']; ?></td>                                                            
<!--                                                            <td>
                                                                <?php 
//                                                                    $check_data              =       array(
//                                                                                                        'student_id'            =>  $students[$i]['student_id'],
//                                                                                                        'session_id'            =>  $session_id,
//                                                                                                        'course_id'             =>  $course_id,
//                                                                                                        'teacher_id'            =>  $teacher_id                                           
//                                                                                                        );
//                                                                    $result_added = $this->Teachers_model->CheckMidResult($check_data);
//                                                                
//                                                                    if($result_added){
                                                                ?>
                                                                        <a  href="<?php echo base_url();?>teachers/view_mid_result/?course_id=<?php echo $students[$i]['course_id'];?>&program_id=<?php echo $students[$i]['program_id'];?>&semester=<?php echo $students[$i]['semester'];?>&course_section=<?php echo $students[$i]['course_section'];?>&student_id=<?php echo $students[$i]['student_id'];?>&session_id=<?php echo $session_id;?>">     
                                                                                   View Mid Result                                                                    
                                                                        </a>
                                                                <?php // } else{?>
                                                                            <a  href="<?php echo base_url();?>teachers/add_mid_result_form/?course_id=<?php echo $students[$i]['course_id'];?>&program_id=<?php echo $students[$i]['program_id'];?>&semester=<?php echo $students[$i]['semester'];?>&course_section=<?php echo $students[$i]['course_section'];?>&student_id=<?php echo $students[$i]['student_id'];?>&session_id=<?php echo $session_id;?>">     
                                                                                       Add Mid Result                                                                    
                                                                            </a>
                                                                <?php // } ?>
                                                            </td>                                                            -->
                                                            <input style="width:50px" name="title1" type="hidden" value="<?php echo $mid->mid_title_1;?>" class="span6">
                                                            <input style="width:50px" name="title2" type="hidden" value="<?php echo $mid->mid_title_2;?>" class="span6">
                                                            <input style="width:50px" name="title3" type="hidden" value="<?php echo $mid->mid_title_3;?>" class="span6">
                                                            
                                                            
                                                            <td><input style="width:50px" tabindex="<?php echo $line1_tab;?>"  name="o_marks1[]" type="text" id="a<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" tabindex="<?php echo $line2_tab;?>"  name="o_marks2[]" type="text" id="b<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" tabindex="<?php echo $line3_tab;?>"  name="o_marks3[]" type="text" id="c<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td>
                                                                <select tabindex="<?php echo $line4_tab;?>"  name="status[]" style="width:50px">
                                                                    <option value="P">P</option>
                                                                    <option value="A">A</option>                                                                        
                                                                </select>
                                                            </td>
                                                            
                                                            <input type="hidden" id="ta<?php echo $i;?>" value="<?php echo $mid->mid_value_1;?>" class="span6">
                                                            <input type="hidden" id="tb<?php echo $i;?>" value="<?php echo $mid->mid_value_2;?>" class="span6">
                                                            <input type="hidden" id="tc<?php echo $i;?>" value="<?php echo $mid->mid_value_3;?>" class="span6">
                                                            
                                                       </tr>                                            
                                        <?php 
                                          $line1_tab++;
                                        $line2_tab++;
                                        $line3_tab++;                                        
                                        $line4_tab++;   
                                        $jj++;
                                        } ?>                                                         
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="12">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                    <br/>
<!--                                     <button class="btn" onclick="validate()">Post</button>-->
                                     <input type="button" value="Submit" onclick="validate()" class="btn btn-purple btn-small" style="float: left; margin-top: 15px;" >
                                    </form>
                                
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
<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
<script type="text/javascript">
        // for chosen and date range
        $(".chzn-select").chosen(); 
	
</script>

<script type="text/javascript">
  
  // for validte only numeric value
           $('.span6').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });
            
            
   function validate_obtained_marks(id,obtained)
           {            
               var total_marks = $("#t"+id).val();
              
               if(parseInt(obtained) > parseInt(total_marks)){
                   alert('Obtained Marks not greater than total marks');                  
                   $("#"+id).val('');
               }
           }
 function validate()
  {         
      var r = confirm("Are you sure ?");
        if (r == true) {
            document.postChallan.submit();
        } 
   }

</script>