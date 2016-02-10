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
                INITIAL FORM
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
                                <h4 class="lighter">ADD INITIAL INFORMATION</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                   
                                    <div class="row-fluid">
                            <form class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission/update_initial_form" enctype="multipart/form-data" />
                            
                            <input type="hidden" name="initial_form_id" value="<?php echo $initial[0]['initial_form_id']; ?>" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                                                                                    

<!-- *************************************    Start Personal Information  *************************************************** -->
                                                
<hr/>
<!--                                                <h3 style="margin-top: 20px" class="lighter block green">FORM INFORMATION</h3>   -->
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Form # : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="form_no" id="form_no" value="<?php echo $initial[0]['form_no']; ?>" style="width: 300px;" class="span10" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Inquiry :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="inquiry" name="inquiry" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Inquiry --</option>
                                                                <?php foreach ($inquiry as $row){?>
                                                                <option <?php if($initial[0]['inquiry_id']==$row['inquiry_id']) echo 'selected="selected"'; ?> value="<?php echo $row['inquiry_id']?>"><?php echo $row['inquiry_no']?></option> 
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
                                                                <?php foreach ($campus as $row){?>
                                                                <option <?php if($initial[0]['campus_id']==$row['campus_id']) echo 'selected="selected"'; ?> value="<?php echo $row['campus_id']?>"><?php echo $row['campus_name']?></option> 
                                                                <?php }?>																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">Submit Date : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="date" id="date" value="<?php echo$initial[0]['submit_date']; ?>" style="width: 188px;" class="span10 date-picker" data-date-format="yyyy-mm-dd" />

                                                        </div>
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
                    form_no: {
                        required: true
                    },
                    inquiry: {
                        required: true
                    },
                    campus: {
                        required: true
                    },
                    date: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission/update_initial_form";
                    document.validationForm.submit();                }
                
            });

        </script>   