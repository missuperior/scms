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
                                        <h3 id="title">All Students For Final</h3>                                       
                                    </div>   
                                
                                    <form name="postChallan" id="postChallan" onsubmit="return confirm('Are you sure ?');" action="<?php echo  base_url()?>examination/add_final_result" method="post" enctype="multipart/form-data">
                                    <table id="example11" class="table table-striped table-bordered table-hover">
                                        <thead>  
                                            
                                             <tr style="font-size: 10px">                                                
                                                <th colspan="4" style="color:#006E6F; font-size: 16px;"><b>Campaign : </b><?php echo $students[0]['campaign_name']; ?></th>
                                                <th colspan="7" style="color:#006E6F; font-size: 16px;"><b>Program : </b><?php echo $students[0]['program_name']; ?></th>                                                
                                            </tr>
                                            
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>                                                                                                                                          
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
                                        <?php
                                        $line1_tab = 1;
                                        $line2_tab = 301;
                                        $line3_tab = 601;
                                        $line4_tab = 901;                                                                                                                         
                                        $line5_tab = 1201;
                                        $line6_tab = 1501;
                                        $line7_tab = 1801;
                                        $line8_tab = 2500;                                                                                                                         
                                        for($i=0; $i<count($students);$i++){  ?>
                                           
                                             <tr style="font-size: 10px">

                                                            <td>
                                                                   <?php echo $i+1; ?>
                                                                   <input type="hidden" id="reg_id" name="student_id[]" value="<?php echo $students[$i]['student_id']; ?>" />
                                                                   <input type="hidden" id="program_id" name="program_id" value="<?php echo $program_id; ?>" />                                                                   
                                                                   <input type="hidden" id="course_id" name="course_id" value="<?php echo $course_id; ?>" /> 
                                                                   <input type="hidden" id="campus_id" name="campaign_id" value="<?php echo $campaign_id; ?>" />
                                                                   <input type="hidden" id="semester" name="semester" value="<?php echo $semester; ?>" />
                                                            </td>
                                                            <td><?php echo $students[$i]['student_name']; ?></td>
                                                            <td><?php echo $students[$i]['roll_no']; ?></td> 
                                                            
                                                            <input style="width:50px" name="title1" type="hidden" value="<?php echo $final->final_title_1;?>" class="span6">
                                                            <input style="width:50px" name="title2" type="hidden" value="<?php echo $final->final_title_2;?>" class="span6">
                                                            <input style="width:50px" name="title3" type="hidden" value="<?php echo $final->final_title_3;?>" class="span6">
                                                            <input style="width:50px" name="title4" type="hidden" value="<?php echo $final->final_title_4;?>" class="span6">
                                                            <input style="width:50px" name="title5" type="hidden" value="<?php echo $final->final_title_5;?>" class="span6">
                                                            <input style="width:50px" name="title6" type="hidden" value="<?php echo $final->final_title_6;?>" class="span6">
                                                            <input style="width:50px" name="title7" type="hidden" value="<?php echo $final->final_title_7;?>" class="span6">
                                                            
                                                            
                                                            <td><input style="width:50px" name="o_marks1[]" type="text" tabindex="<?php echo $line1_tab;?>"  id="a<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks2[]" type="text" tabindex="<?php echo $line2_tab;?>"  id="b<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks3[]" type="text" tabindex="<?php echo $line3_tab;?>" id="c<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks4[]" type="text" tabindex="<?php echo $line4_tab;?>" id="d<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks5[]" type="text" tabindex="<?php echo $line5_tab;?>"  id="e<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks6[]" type="text" tabindex="<?php echo $line6_tab;?>"  id="f<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks7[]" type="text" tabindex="<?php echo $line7_tab;?>"  id="g<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            
                                                            <td>
                                                                <select tabindex="<?php echo $line8_tab;?>"  name="status[]" style="width:50px">
                                                                        <option value="P" >P
                                                                        <option value="A" >A                                                                        
                                                                    </select>
                                                            </td>
                                                            
                                                            <input type="hidden" id="ta<?php echo $i;?>" value="<?php echo $final->final_value_1;?>" name="final_total_1"  class="span6">
                                                            <input type="hidden" id="tb<?php echo $i;?>" value="<?php echo $final->final_value_2;?>" name="final_total_2"   class="span6">
                                                            <input type="hidden" id="tc<?php echo $i;?>" value="<?php echo $final->final_value_3;?>" name="final_total_3"   class="span6">
                                                            <input type="hidden" id="td<?php echo $i;?>" value="<?php echo $final->final_value_4;?>" name="final_total_4"   class="span6">
                                                            <input type="hidden" id="te<?php echo $i;?>" value="<?php echo $final->final_value_5;?>" name="final_total_5"   class="span6">
                                                            <input type="hidden" id="tf<?php echo $i;?>" value="<?php echo $final->final_value_6;?>" name="final_total_6"   class="span6">
                                                            <input type="hidden" id="tg<?php echo $i;?>" value="<?php echo $final->final_value_7;?>" name="final_total_7"   class="span6">
                                                            
                                                       </tr>                                            
                                         <?php 
                                                    $line1_tab++;
                                                    $line2_tab++;
                                                    $line3_tab++;                                        
                                                    $line4_tab++;                                        
                                                    $line5_tab++;
                                                    $line6_tab++;
                                                    $line7_tab++;                                        
                                                    $line8_tab++;                                        
                                        }?>                                                           
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