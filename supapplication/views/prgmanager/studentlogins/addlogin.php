<script type="text/javascript">

    


    

</script>

<?php //echo $dropdown;exit;?>


<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">Logins </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>
                Loign Module           
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none;" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php //echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Generate Logins For the First Semester Programs</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/generate_student_logins" enctype="multipart/form-data" />

                                           
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="programs">Programs:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program">
                                                                <?php 
                                                                  foreach( $programms as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
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
                        $parent_course .= '<select name="parent_course"><option value="">Course Name -- Course Code</option>'; 
                            foreach( $allcourses as $kk => $pp){
                                //$html .='<option value="">Course Name -- Course Code</option>';
                                $parent_course .='<option value='.$pp["course_id"].'>'.$pp["course_name"].' -- '.$pp["course_code"].'</option>';
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