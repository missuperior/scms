<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none"></a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
       
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Add Mid Result</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                        <form class="form-horizontal" id="cityform" method="POST" action="<?php echo base_url()?>teachers/add_mid_result" enctype="multipart/form-data" />

                                               
                                                <div class="control-group">
                                                    <label class="control-label" for="city"></label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <label style="width: 145px; font-weight: bold;" class="span5" /> Title </label> 
                                                            <label style="width: 93px; font-weight: bold;" class="span5" /> Total Marks </label> 
                                                            <label style="width: 150px; font-weight: bold;" class="span5" /> Obtained Marks </label> 
                                                        </div>
                                                    </div>
                                                </div>
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">1 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $mid->mid_title_1; ?>" id="title1" class="span5" readonly/> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="t_marks[]" value="<?php echo $mid->mid_value_1; ?>" id="t_marks1"  class="span5" readonly/>-
                                                            <input style="width: 115px;" placeholder="Obtained Marks" type="text"  name="o_marks[]" id="o_marks1" class="span6" onkeyup="validate_obtained_marks(this.id,this.value)" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                
                                                <input type="hidden" name="program_id" value="<?php echo $program_id; ?>" class="span5" />
                                                <input type="hidden" name="semester" value="<?php echo $semester; ?>" class="span5" />
                                                <input type="hidden" name="course_section" value="<?php echo $course_section; ?>" class="span5" />
                                                <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" class="span5" />
                                                <input type="hidden" name="session_id" value="<?php echo $session_id; ?>" class="span5" />
                                                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" class="span5" />
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">2 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $mid->mid_title_2; ?>" id="title2" class="span5" readonly/> - 
                                                            <input style="width: 100px;" placeholder="Total Marks" type="text" name="t_marks[]" value="<?php echo $mid->mid_value_2; ?>" id="t_marks2" class="span5" readonly/>-
                                                            <input style="width: 115px;" placeholder="Obtained Marks" type="text"  name="o_marks[]" id="o_marks2" class="span6" onkeyup="validate_obtained_marks(this.id,this.value)" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">3 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title3" value="<?php echo $mid->mid_title_3; ?>" class="span5" readonly/> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="t_marks[]" id="t_marks3" value="<?php echo $mid->mid_value_3; ?>" class="span5" readonly/>-
                                                            <input style="width: 115px;" placeholder="Obtained Marks" type="text"  name="o_marks[]" id="o_marks3" class="span6" onkeyup="validate_obtained_marks(this.id,this.value)" />
                                                        </div>
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
            $('#cityform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    cat: {
                        required: true
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
           
           // for validate obtained marks not greater than total
           
           function validate_obtained_marks(id,obtained)
           {               
               // get last character from string
               var lastChar = id.substr(id.length - 1);
               
               var total_marks = $("#t_marks"+lastChar).val();
               
               if(parseInt(obtained) > parseInt(total_marks)){
                   alert('Obtained Marks not greater than total marks');
                   $("#"+id).val('');
               }
           }
           
           
           // for validte only numeric value
           $('.span6').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });

        </script>   