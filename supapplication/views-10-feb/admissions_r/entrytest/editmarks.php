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
                                <h4 class="lighter">Edit Marks</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                        <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <form  class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url() ?>admission_r/update_marks" enctype="multipart/form-data" />

                                                
                                                 
                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Form No: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="form_no" id="form_no" class="span5" value="<?php echo $marks[0]['form_no']; ?>" readonly/>
                                                            <input style="width: 200px;" type="hidden" name="result_id" id="result_id" class="span5" value="<?php echo $marks[0]['entrytest_result_id']; ?>" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Name: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="name" id="name" class="span5" value="<?php echo $marks[0]['name']; ?>" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Program: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="program" id="program" class="span5" value="<?php echo $marks[0]['program_name']; ?>" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Marks: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="marks" id="marks" maxlength="2" class="span5" value="<?php echo $marks[0]['marks']; ?>" />
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
                    marks: {
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