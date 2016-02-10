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
                                        <h3 id="title">All Students</h3>                                       
                                    </div>   
                                
                                    <form name="postChallan" id="postChallan" onsubmit="return confirm('Are you sure ?');" action="<?php echo  base_url()?>examination/update_final_result_cr" method="post" >
                                    <table id="example22" class="table table-striped table-bordered table-hover">
                                        <thead>                                            
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>Program</th>
                                                <th>Course</th>                                                                                            
                                                <th>Section</th>                                                                                            
                                                <!--<th>Action</th>-->
                                                
                                                <?php 
                                                
                                                $final_value_1 = $final->final_value_1;
                                                $final_value_2 = $final->final_value_2;
                                                $final_value_3 = $final->final_value_3;
                                                $final_value_4 = $final->final_value_4;
                                                $final_value_5 = $final->final_value_5;
                                                $final_value_6 = $final->final_value_6;
                                                $final_value_7 = $final->final_value_7;
                                                
                                                $final_val1    = $final_value_1  == '0'  ? 'disabled="disabled"' : ''; 
                                                $final_val2    = $final_value_2  == '0'  ? 'disabled="disabled"' : ''; 
                                                $final_val3    = $final_value_3  == '0'  ? 'disabled="disabled"' : ''; 
                                                $final_val4    = $final_value_4  == '0'  ? 'disabled="disabled"' : ''; 
                                                $final_val5    = $final_value_5  == '0'  ? 'disabled="disabled"' : ''; 
                                                $final_val6    = $final_value_6  == '0'  ? 'disabled="disabled"' : ''; 
                                                $final_val7    = $final_value_7  == '0'  ? 'disabled="disabled"' : ''; 
                                                
                                                ?>
                                                
                                                <th><?php echo $final->final_title_1.'('.$final->final_value_1.')';?></th>
                                                <th><?php echo $final->final_title_2.'('.$final->final_value_2.')';?></th>
                                                <th><?php echo $final->final_title_3.'('.$final->final_value_3.')';?></th>
                                                <th><?php echo $final->final_title_4.'('.$final->final_value_4.')';?></th>
                                                <th><?php echo $final->final_title_5.'('.$final->final_value_5.')';?></th>
                                                <th><?php echo $final->final_title_6.'('.$final->final_value_6.')';?></th>
                                                <th><?php echo $final->final_title_7.'('.$final->final_value_7.')';?></th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <input type="hidden" id="session_id" name="session_id" value="<?php echo $session_id; ?>" />                                                                   
                                        <input type="hidden" id="batch_id" name="batch_id" value="<?php echo $batch_id; ?>" />
                                        <input type="hidden" id="program_id" name="program_id" value="<?php echo $program_id; ?>" />
                                        <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>" />
                                        <input type="hidden" id="course_section" name="course_section" value="<?php echo $students[0]['course_section']; ?>" />
                                        <input type="hidden" id="course_type" name="course_type" value="<?php echo $students[0]['course_type']; ?>" />
                                        <input type="hidden" id="teacher_id" name="teacher_id" value="<?php echo $students[0]['teacher_id']; ?>" />
                                        
                                        <input style="width:50px" name="title1" type="hidden" value="<?php echo $final->final_title_1;?>" class="span6">
                                        <input style="width:50px" name="title2" type="hidden" value="<?php echo $final->final_title_2;?>" class="span6">
                                        <input style="width:50px" name="title3" type="hidden" value="<?php echo $final->final_title_3;?>" class="span6">
                                        <input style="width:50px" name="title4" type="hidden" value="<?php echo $final->final_title_4;?>" class="span6">
                                        <input style="width:50px" name="title5" type="hidden" value="<?php echo $final->final_title_5;?>" class="span6">
                                        <input style="width:50px" name="title6" type="hidden" value="<?php echo $final->final_title_6;?>" class="span6">
                                        <input style="width:50px" name="title7" type="hidden" value="<?php echo $final->final_title_7;?>" class="span6">
                                        
                                         <?php                      
                                        
                                        $std_lis    = count($students);
                                        $jj         = 0;
                                        for($i=0; $i < $std_lis ;$i++){ 
                                            
                                            $final_result     =   $this->Teachers_model->getFinalResult($students[$i]['student_id'],$session_id,$course_id,$program_id,$batch_id,$section_id);
                                            ?>
                                           
                                             <tr style="font-size: 10px">

                                                            <td>
                                                                   <?php echo $jj+1; ?>
                                                                   <input type="hidden" id="student_id" name="student_id[]" value="<?php echo $students[$i]['student_id']; ?>" />
                                                                   <input type="hidden" name="final_result_id[]" value="<?php echo $final_result->final_result_id;?>" class="span6">
                                                                   
<!--                                                                   <input type="hidden" id="semester" name="semester" value="<?php echo $students[$i]['semester']; ?>" />-->
                                                            </td>
                                                            <td><?php echo $students[$i]['student_name']; ?></td>
                                                            <td><?php echo $students[$i]['roll_no']; ?></td>
                                                            <td><?php echo $students[$i]['program_name']; ?></td>
                                                            <td><?php echo $students[$i]['course_name']; ?></td>
                                                            <td><?php echo $students[$i]['course_section']; ?></td>

                                                            
                                                            
                                                            <td><input style="width:50px" <?php echo $final_val1; ?> name="o_marks1[]" value="<?php echo $final_result->final_value_1;?>" type="text" id="a<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" <?php echo $final_val2; ?> name="o_marks2[]" value="<?php echo $final_result->final_value_2;?>"  type="text" id="b<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" <?php echo $final_val3; ?> name="o_marks3[]" value="<?php echo $final_result->final_value_3;?>"  type="text" id="c<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" <?php echo $final_val4; ?> name="o_marks4[]" value="<?php echo $final_result->final_value_4;?>"  type="text" id="d<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" <?php echo $final_val5; ?> name="o_marks5[]" value="<?php echo $final_result->final_value_5;?>"  type="text" id="e<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" <?php echo $final_val6; ?> name="o_marks6[]" value="<?php echo $final_result->final_value_6;?>"  type="text" id="f<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" <?php echo $final_val7; ?> name="o_marks7[]" value="<?php echo $final_result->final_value_7;?>"  type="text" id="g<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            
                                                            <td>
                                                                <select name="status[]" style="width:50px">
                                                                    <option  <?php if($final_result->status == 'P')echo 'selected="selected"';?>  value="P">P</option>
                                                                    <option  <?php if($final_result->status == 'A')echo 'selected="selected"';?>  value="A">A</option>                                                                 
                                                                </select>
                                                            </td>
                                                            
                                                            <input type="hidden" id="ta<?php echo $i;?>" value="<?php echo $final->final_value_1;?>" class="span6">
                                                            <input type="hidden" id="tb<?php echo $i;?>" value="<?php echo $final->final_value_2;?>" class="span6">
                                                            <input type="hidden" id="tc<?php echo $i;?>" value="<?php echo $final->final_value_3;?>" class="span6">
                                                            <input type="hidden" id="td<?php echo $i;?>" value="<?php echo $final->final_value_4;?>" class="span6">
                                                            <input type="hidden" id="te<?php echo $i;?>" value="<?php echo $final->final_value_5;?>" class="span6">
                                                            <input type="hidden" id="tf<?php echo $i;?>" value="<?php echo $final->final_value_6;?>" class="span6">
                                                            <input type="hidden" id="tg<?php echo $i;?>" value="<?php echo $final->final_value_7;?>" class="span6">
                                                       </tr>                                            
                                        <?php $jj++;  }?>                                                         
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