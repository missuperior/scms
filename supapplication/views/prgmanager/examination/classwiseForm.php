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
                Class Wise Report
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
                                <h4 class="lighter">Class Summary Report Form</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form target="_blank" class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>programmanagers/class_wise_report" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                               
                                                 <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program_id">
                                                                <option value="0">Select Program </option>
                                                                <?php 
                                                                  foreach( $programms as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch_id" >
                                                                <option value="0">Select Batch</option>
                                                                <?php 
                                                                  foreach( $all_batches as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' <==> '.$pp["batch_type"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="all_session" id="session_id" >
                                                                <option value="0">Select Session</option>
                                                                <?php 
                                                                  foreach( $all_session as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["session_id"];?>"><?php echo $pp["session"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="section">Section:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="section" id="section"  onchange="getAllSubject();" />
                                                                <option value="0">Select Section</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select>
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
                    program: {
                        required: true
                    },
                    subject: {
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
    
   