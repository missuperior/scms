<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
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
                                                                                          
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>examination/add_course" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="coursename">Course Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 250px;" type="text" value="<?php echo set_value('course_name'); ?>" name="course_name" id="course_name" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Course Code:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 250px;" type="text" name="course_code" id="course_code" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Credit Hours:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 250px;" type="text" name="credit_hours" id="credit_hours" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="coursecode">Program :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select style="width: 250px;" name="program_id" class="chzn-select">
                                                                <option value="">SELECT PROGRAM</option>
                                                                <?php foreach($programs AS $row){?>
                                                                <option value="<?php echo $row['program_id'];?>"><?php echo $row['program_name'];?></option>
                                                                <?php }?>
                                                                
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
     
                
            $('#courseform').validate({
               
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    course_name: {
                        required: true
                    },
                    course_code: {
                        required: true
                    },
                    credit_hours: {
                        required: true
                    },
                    program_id: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
               
            });
            

        </script>   
        
            
        <script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
	
    <!--inline scripts related to this page-->

    <script type="text/javascript"> 
      
      $(function() {
       
       $(".chzn-select").chosen(); 
        
      })
            
    </script>