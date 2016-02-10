<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">Examination</a>                
            </li>            
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
                                <h4 class="lighter">Upload Student Marks</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>examination/upload_marks" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                
                                                <div class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Campaign:</label>
                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                          <select style="width: 220px;" id="campaign" name="campaign" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campaign --</option>
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo 'selected="selected"'; ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                              
                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Programs :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                      <!--<select class="chzn-select" name="program" id="program" onchange="getCourses(this.value);" data-placeholder="Choose a Program...">-->
                                                      <select class="chzn-select" name="program" id="program"  data-placeholder="Choose a Program...">
                                                        <?php foreach ($programs as $row) { ?>
                                                          <option value="<?php echo $row['program_id']; ?>"><?php echo $row['program_name']; ?></option>
                                                        <?php } ?>                    
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                
                                                <div id="courses" style="margin-left: 40px">
                                                    
                                                </div>
                                                
                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Semester :</label>

                                                  <div class="controls">
                                                   <div class="span12">
                                                      <select  style="width: 220px;" id="semester" name="semester" class="chzn-select" data-placeholder="Click to Choose...">
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
                                                  <label class="control-label" for="coursecode">Exam Type :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                        <select name="exam_type" id="exam_type" class="chzn-select" data-placeholder="Choose Type...">
                                                        <option value="">-- Select Type --</option>
                                                        <option value="Mid">Mid</option>
                                                        <option value="Final">Final</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Upload Marks                                          
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

<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(function() {
    $('.date-picker').datepicker({
      changeMonth:true,
      changeYear:true
    });  
    $('.date-picker').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
  });
</script>
<!-- *******  End for Date picker  *******-->

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
                    semester: {
                        required: true
                    },
                    exam_type: {
                        required: true
                    }
                },                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }                
            });
            
         
        </script>   
        
        <script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
	
    <!--inline scripts related to this page-->

    <script type="text/javascript"> 
      
      $(function() {
       
       $(".chzn-select").chosen(); 
        
      })
            
    </script>

<script type="text/javascript">
 
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
  
  function search_result()
  {
    var pid     = $('#program').val();
    var section = $('#section').val();
    var subject = $('#subject').val();
    
    $.ajax({
        type: "POST",
        data:{
          'prog':pid,
          'section':section,
          'subject':subject
        },
        url: "<?php echo base_url(); ?>examination/get_students",
                    
        success:function(data){
          if(data!=''){ 
            $('#students').html(data);          
          }else{
            $('#exist').text('No Section Made');
          }
        }
      });      
  }
  
  
</script>  