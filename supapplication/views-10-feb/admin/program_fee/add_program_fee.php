<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">ADMISSIONS</a>                
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
                Program Fee Form
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> </a>
                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">ADD PROGRAM FEE INFORMATION</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                   
                                    <div class="row-fluid">
                            <form class="form-horizontal" id="programfeeform" method="POST" action="<?php echo  base_url()?>admin/add_program_fee" enctype="multipart/form-data" />

                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                                                                                    

<!-- *************************************    Start Personal Information  *************************************************** -->
                                                
<hr/>
<!--                                                <h3 style="margin-top: 20px" class="lighter block green">FORM INFORMATION</h3>   -->

                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Pragram :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select multiple="" name="program[]" id="program" class="chzn-select" data-placeholder="Choose Program...">
                                                
                                                            <option value="">-- Select Program --</option>                                                        
                                                            <?php foreach ($program as $row){?>
                                                                <option <?php if(set_value('program')==$row['program_id']) echo '"selected=selected"';?> value="<?php echo $row['program_id']?>"><?php echo $row['program_name']?></option> 
                                                                <?php }?>																		
                                                        </select> 
                                                        </div>
                                                    </div>
                                                </div>
                                           
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campus :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                             <select style="width: 188px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campus --</option>
                                                                <?php foreach ($campus as $row) { ?>
                                                                    <option <?php if (set_value('campus') == $row['campus_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                  
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campaign :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                             <select style="width: 188px;" id="campaign" name="campaign" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campaing --</option>
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                  
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">No of Sessions : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="no_of_sessions" id="no_of_sessions" value="<?php echo set_value('no_of_sessions'); ?>" style="width: 188px;" class="span10" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Admission Fee : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="admission_fee" id="admission_fee" value="<?php echo set_value('admission_fee'); ?>" style="width: 188px;" class="span10" />
                                                        </div>
                                                    </div>
                                                </div>


                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Session Fee : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="session_fee" id="session_fee" value="<?php echo set_value('session_fee'); ?>" style="width: 188px;" class="span10" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                                                                                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Misc Fee : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="misc_fee" id="misc_fee" value="<?php echo set_value('misc_fee'); ?>" style="width: 188px;" class="span10" />
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Type :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                             <select style="width: 188px;" id="type" name="type" class="select2" data-placeholder="Click to Choose...">                                                               
                                                                 <option value="Semester">Semester</option>
                                                                 <option value="Annual">Annual</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                                                                                                                
                                                
                                                
<!--                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1"> Date : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="year_date" id="year_date" value="<?php echo set_value('year_date'); ?>" style="width: 188px;" class="span10 date-picker" data-date-format="yyyy-mm-dd" />

                                                        </div>
                                                    </div>
                                                </div>-->
                                            </div>
                                        </div>

                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Save                                            
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

		<script src="<?php echo base_url();?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
	
		<script type="text/javascript">
			$(function() {
				$('.date-picker').datepicker({
                                    changeMonth:true,
                                    changeYear:true
                                });
                                			
			});
		</script>
                <!-- *******  End for Date picker  *******-->





<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
     $(function() {
	$(".chzn-select").chosen(); 
	});
     
            $('#programfeeform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    program: {
                        required: true
                    },
                    no_of_sessions: {
                        required: true
                    },
                    admission_fee: {
                        required: true
                    },
                    session_fee: {
                        required: true
                    },
                    misc_fee: {
                        required: true
                    }
//                    year_date: {
//                        required: true
//                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_program_fee";
                    document.validationForm.submit();                }
                
            });

        </script>   