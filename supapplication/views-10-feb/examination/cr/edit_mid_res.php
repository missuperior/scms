<?php //echo '<pre>'; print_r($mid_r);die;?>
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
                                                                      
                                    <div class="table-header">                                        
                                        <h3 id="title">Enter Mid Marks</h3>                                       
                                    </div>   
                                
                                    <form name="postChallan" id="postChallan" onsubmit="return confirm('Are you sure ?');" action="<?php echo  base_url()?>examination/update_mid_res_cr" method="post" enctype="multipart/form-data">
                                    <table id="example11" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                                
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>                                                                                                                                           
                                                <th><?php echo $mid_s->mid_title_1.'('.$mid_s->mid_value_1.')';?></th>
                                                <th><?php echo $mid_s->mid_title_2.'('.$mid_s->mid_value_2.')';?></th>
                                                <th><?php echo $mid_s->mid_title_3.'('.$mid_s->mid_value_3.')';?></th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                
                                           
                                             <tr style="font-size: 10px">

                                                            <td>
                                                                   <?php echo $i+1; ?>
                                                                   <input type="hidden" id="mid_result_id" name="mid_result_id" value="<?php echo $mid_r->mid_result_id; ?>" />
                                                                   <input type="hidden" id="student_id" name="student_id" value="<?php echo $mid_r->student_id; ?>" />
                                                                   <input type="hidden" id="course_id" name="course_id" value="<?php echo $mid_r->course_id; ?>" />
                                                                   <input type="hidden" id="session_id" name="session_id" value="<?php echo $session_id; ?>" />
                                                                
                                                            </td>
                                                            <td><?php echo $mid_r->student_name; ?></td>
                                                            <td><?php echo $mid_r->roll_no; ?></td>                                                                                                                        

                                                            <input style="width:50px" name="title1" type="hidden" value="<?php echo $mid_r->mid_title_1;?>" class="span6">
                                                            <input style="width:50px" name="title2" type="hidden" value="<?php echo $mid_r->mid_title_2;?>" class="span6">
                                                            <input style="width:50px" name="title3" type="hidden" value="<?php echo $mid_r->mid_title_3;?>" class="span6">
                                                            
                                                            
                                                            <td><input style="width:50px" name="o_marks1" type="text" value="<?php echo $mid_r->mid_value_1;?>"  id="a<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks2" type="text" value="<?php echo $mid_r->mid_value_2;?>"   id="b<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td><input style="width:50px" name="o_marks3" type="text" value="<?php echo $mid_r->mid_value_3;?>"   id="c<?php echo $i;?>" onkeyup="validate_obtained_marks(this.id,this.value)" class="span6"></td>
                                                            <td>
                                                                <select  name="status" style="width:50px">
                                                                        <option <?php if($mid_r->status == 'P')echo 'selected="selected"';?> value="P" >P
                                                                        <option <?php if($mid_r->status == 'A')echo 'selected="selected"';?> value="A" >A                                                                       
                                                                    </select>
                                                            </td>
                                                            
                                                            <input type="hidden" id="ta<?php echo $i;?>" value="<?php echo $mid_s->mid_value_1;?>" name="mid_total_1" class="span6">
                                                            <input type="hidden" id="tb<?php echo $i;?>" value="<?php echo $mid_s->mid_value_2;?>" name="mid_total_2" class="span6">
                                                            <input type="hidden" id="tc<?php echo $i;?>" value="<?php echo $mid_s->mid_value_3;?>" name="mid_total_3" class="span6">
                                                            
                                                       </tr>                                            

                                        </tbody>
                                        <tr><td style="text-align: right" colspan="12">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                    <br/>
<!--                                     <button class="btn" onclick="validate()">Post</button>-->
                                     <input type="button" value="Submit" onclick="validate()" class="btn btn-purple btn-small" style="float: left; margin-top: 15px;" >
                                    </form>
                                
                                                                        
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