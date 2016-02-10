<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">examination</a>                
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
        <div class="page-header position-relative">
            <h1>
                Examination Report
            </h1>
        </div><!--/.page-header-->
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
                                <h4 class="lighter">Class Failure Report Form</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form target="_blank" class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>examination/class_failure_report" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                  
                                                <?php if($this->session->userdata('role') == 'SP'){ ?>
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campus:</label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                          <select style="width: 200px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campus --</option>
                                                                <?php foreach ($campus as $row) { ?>
                                                                    <option <?php if (set_value('campus') == $row['campus_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                <?php } ?>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px; margin-left: 30px;" class="control-label" for="email">Campaign:</label>
                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select id="campaign" name="campaign" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campaign --</option>
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
<?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div> 
                                              
                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Session :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                      <select name="session" id="session">
                                                        <option value="">-- Select Session --</option>                                
                                                        <option value="1">Part I</option>                                
                                                        <option value="2">Part II</option>                                
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div> 
                                              
                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Programs :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                      <select class="chzn-select" name="program" id="program" onchange="proSection(this.value); getSubject()" data-placeholder="Choose a Program...">
                                                        <?php foreach ($programs as $row) { ?>
                                                          <option value="<?php echo $row['program_id']; ?>"><?php echo $row['program_name']; ?></option>
                                                        <?php } ?>                    
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>

                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Section :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                        <select name="section" id="section" data-placeholder="Choose Section...">

                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>                                                
                                              
                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Subject :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                        <select name="subject" id="subject" data-placeholder="Choose Section...">

                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                              
                                                <div class="control-group">
                                                  <label class="control-label" for="coursecode">Exam Type :</label>

                                                  <div class="controls">
                                                    <div class="span12">
                                                      <select name="exam_type" id="exam_type" data-placeholder="Choose Type...">
                                                        <option value="">-- Select Type --</option>
                                                        <option value="Monthly">Monthly</option>
                                                        <option value="Pre Send-up">Pre Send-up</option>
                                                        <option value="Send-up">Send-up</option>
                                                        <option value="Pre-Board">Pre-Board</option>
                                                        <option value="Phase Test">Phase Test</option>
                                                        <option value="Pre-Board/Uni">Pre-Board/Uni</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 130px;  margin-left: 30px;" class="control-label" for="id-date-picker-1">Date:</label>
                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="date" id="date" value="<?php echo set_value('s_date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
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
                    s_date: {
                        required: true
                    },
                    e_date: {
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
            
            
            // get program list shift wise
   function getSection(value)
   {      
       if(value!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'program':value,
                         },
                    url: "<?php echo base_url();?>examination/get_section_info",
                    
                    success:function(data){
                        //alert(data);
                        $("#section").html(data);
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
	
    <!--inline scripts related to this page-->

    <script type="text/javascript"> 
      
      $(function() {
       
       $(".chzn-select").chosen(); 
        
      })
            
    </script>

<script type="text/javascript">
  
  function proSection(pid)
  {
    $.ajax({
        type: "POST",
        data:{
          'prog':pid
        },
        url: "<?php echo base_url(); ?>examination/get_result_sections",
                    
        success:function(data){
          if(data!=''){ 
            $('#section').html(data);          
          }else{
            $('#exist').text('No Section Made');
          }
        }
      });      
  }
  
  
  function getSubject()
  {
//    var sec = $('#section').val();
    var pid = $('#program').val();
    $.ajax({
        type: "POST",
        data:{
          'prog':pid
//          'section':sec
        },
        url: "<?php echo base_url(); ?>examination/get_subjects/1",
                    
        success:function(data){
          if(data!=''){ 
            $('#subject').html(data);          
          }else{
            $('#exist').text('No Record Found');
          }
        }
      });      
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