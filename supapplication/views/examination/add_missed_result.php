<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        
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
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> </a>
                </h4>
                <div class="hr hr-18 hr-double dotted"></div>            
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Add Missed / Freeze Students Marks</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form target="_blank" class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>examination/add_missed_result" enctype="multipart/form-data" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                  
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campaigns :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                          <select style="width: 200px;" id="campaign" name="campaign" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campaign --</option>
                                                                <?php foreach ($campaigns as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> <?php } ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                               
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Program :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select onchange="getCourses(this.value)" style="width: 200px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Program --</option>
                                                                <?php foreach ($program as $row) { ?>
                                                                    <option <?php if (set_value('program') == $row['program_id']) echo 'selected="selected"' ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                                <?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>        
                                                
                                                <div id="courses">
                                                    
                                                </div> 
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Semester :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select  style="width: 200px;" id="semester" name="semester" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Semester --</option>
                                                                <option value="1">Semester 1</option>
                                                                <option value="2">Semester 2</option>
                                                                <option value="3">Semester 3</option>
                                                                <option value="4">Semester 4</option>
                                                                <option value="5">Semester 5</option>
                                                                <option value="6">Semester 6</option>
                                                                <option value="7">Semester 7</option>
                                                                <option value="8">Semester 8</option>
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div> 
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Term :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select onchange="getMissedRollNo(this.value);" style="width: 200px;" id="term" name="term" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Term --</option>
                                                                <option value="mid">Mid Term</option>
                                                                <option value="final">Final Term</option>                                                                																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div> 
                                                
                                                 <div id="rollno">
                                                    
                                                 </div> 
                                                
                                               
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Submit                                          
                                            </button>
                                        </div>
                                     </form>
                                    </div>
                                </div><!--/widget-main-->
                            </div><!--/widget-body-->
                        </div>
                    </div>
                </div>               
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->  
</div><!--/.main-content-->
               <!-- *******  Start for Date picker  *******-->

<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#initialform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    campaign: {
                        required: true
                    },
                    program: {
                        required: true
                    },
                    course: {
                        required: true
                    },
                    semester:{
                        required:true
                    },
                    term: {
                        required:true
                    },
                    roll_no:{
                        required:true
                    }
                },                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }                
            });
            
            
            
            // get courses list program wise
   function getCourses(value)
   {      
       if(value!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'program_id':value,
                         },
                    url: "<?php echo base_url();?>examination/get_Courses_list",
                    
                    success:function(data){
                        $("#courses").html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Program');
              }            
              
   }
            
            // get courses list program wise
   function getMissedRollNo(term)
   {      
       var prog     =   $("#program").val();
       var camp     =   $("#campaign").val();
       var cour     =   $("#course").val();
       var sems     =   $("#semester").val();
       
       if(term!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'program_id':prog,
                        'campaign_id':camp,
                        'course_id':cour,
                        'semester':sems,
                        'term':term,
                         },
                    url: "<?php echo base_url();?>examination/get_missedStudents_list",
                    
                    success:function(data){
                        $("#rollno").html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Term');
              }            
              
   }
        </script>  
                
        <script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>

        <!--inline scripts related to this page-->

        <script type="text/javascript"> 
      
          $(function() {
       
           $(".chzn-select").chosen(); 
        
          })
            
        </script>