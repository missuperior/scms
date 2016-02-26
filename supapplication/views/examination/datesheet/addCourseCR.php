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
                                <h4 class="lighter">Add Course Form</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form  class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>examination/addVenueCourses_cr" enctype="multipart/form-data" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                  
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Courses :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select  style="width: 400px;" id="course" name="course" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Course --</option>
                                                                <?php foreach ($courses as $row) { ?>
                                                                    <option <?php if (set_value('course') == $row['course_id']) echo 'selected="selected"' ?> value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                                                <?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div> 
                                                
                                                <input type="hidden" name="venue_id" value="<?php echo $venue_id; ?>" />
                                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">Test Date :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                      <div class="span12">
                                                        <input style="width: 400px;" type="text" name="date" id="date" value="<?php echo set_value('date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>

                                                      </div>
                                                    </div>
                                               </div>
                                                
                                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="timepicker1">Test Timings :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="control-group" style="float:left; margin-left: 10px">
                                                    <div class="input-append bootstrap-timepicker">
                                                        <input style="width:358px" id="timepicker1" name="time" type="text" value="<?php echo set_value('time'); ?>" class="input-small" />
                                                        <span class="add-on">
                                                            <i class="icon-time"></i>
                                                        </span>
                                                    </div>
                                                </div>
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
                    venue: {
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
                    url: "<?php echo base_url();?>examination/get_Courses_list2",
//                    url: "<?php echo base_url();?>examination/get_Courses_list2",
                    
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
        </script>  
                
        <script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
        
 <script src="<?php echo base_url();?>assets/js/date-time/bootstrap-timepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
	
    <!--inline scripts related to this page-->

    <script type="text/javascript"> 
      
      $(function() {
       
       $(".chzn-select").chosen(); 

        $('#timepicker1').timepicker({
            minuteStep: 1,
//            showSeconds: true,
            showMeridian: false
        });

         $('.date-picker').datepicker({
                  changeMonth:true,
                  changeYear:true
                });
                $('.date-picker').on('changeDate', function(ev){
                $(this).datepicker('hide');
         });
        
      });
      
            
    </script>