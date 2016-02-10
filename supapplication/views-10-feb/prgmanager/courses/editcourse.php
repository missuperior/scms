<?php 
    $parent_course_id = $course[0]['parent_course_id'];
    $parent_course .= '<select name="parent_course"><option value="">Course Name -- Course Code</option>'; 
        foreach( $allcourses as $kk => $pp){
            
            $selected44 = ( $pp["course_id"] == $parent_course_id )  ? 'selected="selected"' : '';
            $parent_course .='<option '.$selected44.' value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
        }
    $parent_course .= '</select>'; 
?>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">Admissions </a>
            </li>						
        </ul><!--.breadcrumb-->
    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>Courses Module</h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php    
                            $error_msg   = $this->session->userdata('error_msg');
                            $success_msg = $this->session->userdata('success_msg');
                            echo $ms = $error_msg.' '.$success_msg;
                            //echo $this->session->userdata('error_msg'); 
                            $this->session->unset_userdata('success_msg'); 
                            $this->session->unset_userdata('error_msg'); 
                        ?>
                    </a>
                </h4>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Edit Course</h4>

                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url()?>programmanagers/update_course" enctype="multipart/form-data" />

                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Select Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="programs" id="programs"> 
                                                                <option value="0" >Select Program</option>
                                                            <?php foreach($all_programs as $p){ ?> 
                                                                <option <?php  echo $course[0]['program_id'] ==  $p['program_id'] ? 'selected="selected"' : ''; ?> value="<?php echo $p['program_id'];?>" ><?php echo $p['program_name'].'=='.$p['program_code'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Select Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch"> 
                                                                <option value="0" >Select batch</option>
                                                            <?php foreach($all_batches as $p){ ?> 
                                                                <option <?php  echo $course[0]['batch_id'] ==  $p['batch_id'] ?  'selected="selected"' : ''; ?> value="<?php echo $p['batch_id'];?>" ><?php echo $p['batch_type'].'=='.$p['batch'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="course">Course Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="course_name" id="course_name" value="<?php echo $course[0]['course_name'];?>" class="span5" />
                                                            <input type="hidden" name="course_id" value="<?php echo $course[0]['course_id'];?>"  class="input-xlarge">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Course Code:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="course_code" id="course_code" class="span5" value="<?php echo $course[0]['course_code'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Credit Hours:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="credit_hours" id="course_code" class="span5" value="<?php echo $course[0]['credit_hours'];?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                               
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Course type:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="course_type" id="course_type">
                                                                <option  <?php echo $course[0]['course_type'] == 'Theory' ? 'selected="selected"':''; ?> value="Theory">Theory</option>
                                                                <option  <?php echo $course[0]['course_type'] == 'Lab' ? 'selected="selected"':''; ?> value="Lab">Lab</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <input type="hidden" name="hidden_flag" id="hidden_flag" <?php echo $course[0]['course_type']; ?> />
                                                 <div id="pre_req_holding" style="display: <?php echo $course[0]['course_type'] == 'Lab' ? 'none':'block'; ?>">
                                                    <div class="control-group" id="PrGoup">
                                                        <label class="control-label" for="courseprereq">Add Course Pre Requisite:</label>

                                                        <div class="controls">
                                                            <div class="span12" id="rere"  >
                                                            <input type="button" style="width: 188px;" type="text" name="addpre_req"  class="span5" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="clonedInput2">
                                                        
                                                        <?php 
                                                            if($total_prerq_size > 0 ){
                                                                for($i = 0 ; $i < $total_prerq_size ; $i++){
                                                                    
                                                                    $added_pre_req_id  = $allprereqcourses[$i]['course_pre_req_id'];
                                                                    
                                                            ?>      
                                                                <div id="file-<?php echo $i;?>">
                                                                    <div class="control-group">
                                                                        <label class="control-label" for="coursecode">
                                                                            Pre-requisite Courses
                                                                        </label>
                                                                            <div class="controls">
                                                                                <div class="span12"> 
                                                                                    <select name="pre_reqs[]">
                                                                                            <option value="">Course Name -- Course Code</option>
                                                                                            <?php
                                                                                                foreach( $allcourses as $kk => $pp){
                                                                                                    
                                                                                                    //echo $pp["course_id"]. '==' .$added_pre_req_id.'<br/>' ;
                                                                                                    $selected = ( $pp["course_id"] == $added_pre_req_id )  ? 'selected="selected"' : '';
                                                                                                    echo '<option  '.$selected.' value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                                                                                                }
                                                                                            ?>
                                                                                    </select>
                                                                                </div>
                                                                                <div onclick="removeElement('file-<?php echo  $i;  ?>');" style="cursor:pointer;">Remove</div>
                                                                            </div>
                                                                        </div>
                                                                </div>
                                                                <?php
                                                                }
                                                            }   
                                                        ?>
                                                            </div>
                                                        </div>
                                                 
                                                        <div id="parent_course_div" style="display:<?php echo $course[0]['course_type'] == 'Lab' ? 'block':'none'; ?>;" >
                                                            <div class="control-group">
                                                                <label class="control-label" for="coursecode">Parent Course:</label>
                                                                <div class="controls">
                                                                    <div class="span12">
                                                                      <?php echo $parent_course; ?>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                    
                                                    <?php // foreach for the exiting courses added start  ?>
                                                    <?php //foreach( $preq_array as $pk => $kl){
                                                        
                                                    //}?>
                                                    <?php // foreach for the exiting courses added end ?>
                                                </div>    
                                                
                                            </div>
                                            
                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <button class="btn btn-success btn-next" data-last="Finish ">
                                                    Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!--/.span-->
                    </div><!--/.row-fluid-->
                </div><!--/.page-content-->

            </div><!--/.main-content-->
        </div><!--/.main-container-->    

        <script type="text/javascript">
            
            $('#course_type').change(function(){
                    var selectedvalue = this.value; 
                    
                    if(selectedvalue  == 'Lab'){
                        
                        // lets change the html 
                        $('#parent_course_div').show();
                        $('#pre_req_holding').hide();
                        $('#hidden_flag').val('Lab');
                    }
                    if(selectedvalue  == 'Theory'){
                        $('#parent_course_div').hide();
                        $('#pre_req_holding').show();
                        $('#hidden_flag').val('Theory');
                    }
                    
            });
            
            $('#courseform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    city: {
                        required: true,
                        lettersonly: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/update_city";
                    document.validationForm.submit();
                }
            });
            
            var fileId = <?php echo $total_prerq_size; ?>; // used by the addFile() function to keep track of IDs
            var selct = '<?php echo $dropdown; ?>';
            $("#rere").click(function() {
                //alert('ssssss');
                var file_handle = 'onclick="removeElement(\'file-'+fileId+'\');"';
                //var file_handle = 'id="removeElement(\"file-'+fileId+'\");"';
                //<div id="removeElement("file-'+fileId+'");">Remove</div>
                var html = '<div class="control-group">\n\
                      <label class="control-label" for="coursecode">Pre Requisite Course:</label>\n\
                      <div class="controls">\n\
                          <div class="span12">\n\
                              '+selct+'\n\
                          </div>\n\
                          <div '+file_handle+' style="cursor:pointer;">Remove</div>\n\
                      </div>\n\
                  </div>';
                addElement('clonedInput2', 'div', 'file-'+fileId, html);
                fileId++;
            }); 
            

        </script>   