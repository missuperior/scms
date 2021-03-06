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
                        <?php echo $this->session->userdata('error_msg');
                        $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">                               
                                <h4 class="lighter">ADD GRACE MARKS</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                        <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <form  class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url() ?>admission_r/add_grace_marks" enctype="multipart/form-data" />


                                            <div style="width: 100%; float: left; margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Tests :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select  style="width: 188px;" id="test" name="test" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <option value="">Select Test</option>
                                                                <?php foreach ($tests as $row) { ?>
                                                                    <option value="<?php echo $row['test_id'] ?>"><?php echo $row['test_no'] ?></option> 
                                                                 <?php } ?>																			
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                 <div style="width: 100%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Program :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">
                                                                    <option value="">-- Select Program --</option>
                                                                    <?php foreach ($program as $row) { ?>
                                                                         <option <?php if (set_value('program_id') == $row['program_id']) echo '"selected=selected"'; ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                                    <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 132px;" class="control-label" for="email"> Enter Criteria : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="number" name="criteria" id="criteria" value="<?php echo set_value('name'); ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 138px;" class="control-label" for="email">Number To Add : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="number" name="number" id="number" value="<?php echo set_value('name'); ?>" class="span5" />
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



        <script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-timepicker.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript">

           $('#batchform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    test:{
                        required:true
                    },
                    program:{
                        required:true
                    },
                    criteria:{
                        required:true,
                        number:true
                    },
                    number:{
                        required:true,
                        number:true
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