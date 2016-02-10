<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">ENTRY TEST </a>
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
                                <h4 class="lighter">Add Result Form</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <form class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url()?>entrytest/add_entrytest_result" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label style="width: 160px; float: left;" class="control-label" for="email">Form No :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px; " type="text" name="formno"  id="formno" class="span5" placeholder="Enter Form No" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label style="width: 160px; float: left;" class="control-label" for="email">Name :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="name"  id="name" class="span5" placeholder="Enter Student Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                 <div style="width: 100%; float: left; margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Tests :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

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
                                                
                                                
                                                
                                                <div id="rom">
                                                <div style="width: 100%; float: left; margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Rooms :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="rooms" name="rooms" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <option value="">Select Room</option>
                                                                <?php foreach ($rooms as $row) { ?>
                                                                    <option value="<?php echo $row['room_id'] ?>"><?php echo $row['room_name'] ?></option> 
                                                                 <?php } ?>																			
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                
                                                
                                                 <div style="width: 100%;  margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Programs :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select  style="width: 188px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <option value="">Select Program</option>
                                                                <?php foreach ($program as $row) { ?>
                                                                    <option value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                                 <?php } ?>																			
                                                            </select>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                 </div>
                                                
                                                                                                                                       
                                               
                                                <div class="control-group">
                                                    <label style="width: 160px; float: left;" class="control-label" for="email">Marks :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="number" min="0" max="100" name="marks"  id="marks" class="span5" placeholder="Enter Marks" />
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
           
            
            $('#batchform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    formno: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    rooms: {
                        required: true,
                        number:true
                    },
                    test: {
                        required: true
                    },
                    program:{
                        required:true
                    },
                    marks:{
                        required:true,
                        number :true
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
            
            function resetProgram()
            {
                $("#program").val('');               
                $("#students").val('');               
            }

        </script>   