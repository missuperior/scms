<script type="text/javascript">

    


    

</script>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">Courses </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>
                Courses Module           
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none;" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Add New Course</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/add_course" enctype="multipart/form-data" />

                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="programs" id="programs"> 
                                                                <option value="0" >Select Program</option>
                                                            <?php foreach($all_programs as $p){ ?> 
                                                                <option value="<?php echo $p['program_id'];?>" ><?php echo $p['program_name'].'=='.$p['program_code'];?></option>
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
                                                                <option value="<?php echo $p['batch_id'];?>" ><?php echo $p['batch_type'].'=='.$p['batch'];?></option>
                                                            <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursename">Course Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" value="<?php echo set_value('course_name'); ?>" name="course_name" id="course_name" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Course Code:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="course_code" id="coursecode" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Credit Hours:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="credit_hours" id="credit_hours" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Course type:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="course_type" id="course_type">
                                                                <option value="Theory">Theory</option>
                                                                <option value="Lab">Lab</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <input type="hidden" name="hidden_flag" id="hidden_flag" />
                                                <div id="pre_req_holding">
                                                    <div class="control-group" id="PrGoup">
                                                        <label class="control-label" for="courseprereq">Add Course Pre Requisite:</label>

                                                        <div class="controls">
                                                            <div class="span12" id="rere"  >
                                                            <input type="button" style="width: 188px;" type="text" name="addpre_req"  class="span5" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="clonedInput2"> </div>
                                                
                                                </div>
                                                <div id="parent_course_div" style="display: none;"></div>
                                                
                                                <div class="step-pane" id="step4">
                                                    <!--<div class="center">
                                                        <h3 class="green">Congrats!</h3>
                                                        Your product is ready to ship! Click finish to continue!
                                                    </div>-->
                                                </div>
                                            </div>

                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <button class="btn btn-success btn-next" data-last="Finish ">
                                                    Save
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
                        <?php 
                        $parent_course .= '<select name="parent_course"><option value="">Program Name -- Course Name -- Course Code</option>'; 
                            foreach( $allcourses as $kk => $pp){
                                //$html .='<option value="">Course Name -- Course Code</option>';
                                //$parent_course .='<option value='.$pp["course_id"].'>'.$pp["program_name"].' -- '.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                                $parent_course  .='<option value='.$pp["course_id"].'>'.$pp["batch"].'<==>'.$pp["batch_type"].'-- '.$pp["program_name"].' -- '.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
                                //$html .='<option value='.$pp["course_id"].'>'.$pp["course_name"].'</option>';
                            }
                        $parent_course .= '</select>'; 
                        ?>
                                    
                        var selct = '<?php echo $parent_course; ?>';
                        var htmling = '<div class="control-group">\n\
                                        <label class="control-label" for="coursecode">Parent Course:</label>\n\
                                        <div class="controls">\n\
                                            <div class="span12">\n\
                                                '+selct+'\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
                        $('#parent_course_div').html(htmling);
                        $('#parent_course_div').show();
                        $('#pre_req_holding').hide();
                        $('#hidden_flag').val('Lab');
                    }
                    if(selectedvalue  == 'Theory'){
                        $('#parent_course_div').html();
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
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_city";
                    document.validationForm.submit();
                }
            });
            var fileId = 0; // used by the addFile() function to keep track of IDs
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