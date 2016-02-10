<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Admissions </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>
                Entry Test Module        
            </h1>
        </div><!--/.page-header-->
        
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
                                <h4 class="lighter">Add New Test</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <form class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url()?>entrytest/add_test" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="text">Test Number :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="number" id="number" value="<?php echo set_value('number'); ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div style="width: 100%;margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Campaign :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="campaign" name="campaign" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo 'selected="selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
                                                                 <?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                
                                                
                                               <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="id-date-picker-1">Test Date :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                      <div class="span12">
                                                        <input style="width: 188px;" type="text" name="date" id="date" value="<?php echo set_value('date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>

                                                      </div>
                                                    </div>
                                               </div>
                                                
                                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="timepicker1">Test Timings :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="control-group" style="float:left; margin-left: 20px">
                                                    <div class="input-append bootstrap-timepicker">
                                                        <input style="width:147px" id="timepicker1" name="time" type="text" value="<?php echo set_value('time'); ?>" class="input-small" />
                                                        <span class="add-on">
                                                            <i class="icon-time"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                               </div>
                                               
                                                
                                                                                           
                                               
                                                <div class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Test Venue :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="venue" value="<?php echo set_value('venue'); ?>" id="venue" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div style="width: 100%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Status :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="status" name="status" value="<?php echo set_value('status'); ?>" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <option value="In Process"> In Process </option>
                                                                <option value="Completed"> Completed </option>
                                                                 
                                                            </select>
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

        

 <script src="<?php echo base_url();?>assets/js/date-time/bootstrap-timepicker.min.js"></script>

<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript">
            
             $(function() {
                

                $('#timepicker1').timepicker({
                    minuteStep: 1,
                    showSeconds: true,
                    showMeridian: false
                })

                
          });
            
            
            $(function() {
                $('.date-picker').datepicker({
                  changeMonth:true,
                  changeYear:true
                });
                $('.date-picker').on('changeDate', function(ev){
                $(this).datepicker('hide');
                });

              });
            
            
            
            $('#batchform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    number: {
                        required: true
                    },
                    campaign: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    time: {
                        required: true
                    },
                    venue: {
                        required: true
                    },
                    status: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_batch";
                    document.validationForm.submit();
                }
            });

        </script>   