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
                                <h4 class="lighter">Students List Room Wise</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                        <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <form target="_BLANK" class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url() ?>programmanagers/award_list" enctype="multipart/form-data" />


                                            <div style="width: 100%; float: left; margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Tests :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select  style="width: 188px;" id="test" name="test" class="select2" data-placeholder="Click to Choose...">                                                                
                                                                <option value="">Select Test</option>
                                                                <?php foreach ($tests as $row) { ?>
                                                                    <option value="<?php echo $row['test_id'] ?>"><?php echo $row['test_no'] ?></option> 
                                                                 <?php } ?>																			
                                                            </select>
                                                            
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 100%; float: left; margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 160px;" class="control-label" for="email">Rooms :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 180px;">
                                                        <div class="span12">
                                                            <select  style="width: 188px;" id="rooms" name="rooms" class="select2" data-placeholder="Click to Choose...">                                                                
                                                                <option value="">Select Room</option>
                                                                <?php foreach ($rooms as $row) { ?>
                                                                    <option value="<?php echo $row['room_id'] ?>"><?php echo $row['room_name'] ?></option> 
<?php } ?>																			
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



        <script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-timepicker.min.js"></script>

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
                    changeMonth: true,
                    changeYear: true
                });
                $('.date-picker').on('changeDate', function(ev) {
                    $(this).datepicker('hide');
                });

            });



            $('#batchform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    rooms: {
                        required: true
                    },
                    test:{
                        required:true
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