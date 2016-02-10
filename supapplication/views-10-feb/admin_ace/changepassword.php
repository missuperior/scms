<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">CHANGE PASSWORD </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">                       
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">                               
                                <h4 class="lighter">CHANGE YOUR PASSWORD</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                
                                                 <?php $controller = $this->uri->segment(1);
                                                        if($controller == 'admission_reports')
                                                        {
                                                            $controller = 'admission_r';
                                                        }
                                                    ?>
                                                
                                                <form class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url().$controller?>/change_password" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label style="width:185px" class="control-label" for="email">OLD PASSWORD : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 200px">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="password" name="old_pass" id="old_pass" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="control-group">
                                                    <label style="width:185px" class="control-label" for="email">NEW PASSWORD : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 200px">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="password" name="new_pass" id="new_pass" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label style="width:185px" class="control-label" for="email">CONFIRM PASSWORD : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 200px">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="password" name="cnfrm_pass" id="cnfrm_pass" class="span5" />
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


        <script type="text/javascript">
            $('#batchform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    old_pass: {
                        required: true
                    },
                    new_pass: {
                        required: true,
			minlength: 5                   
                    },
                    cnfrm_pass: {
                        required: true,
                        minlength: 5,
                        equalTo: "#new_pass"
                    }
                },
                
                messages: {						
                                    new_pass: {
							required: "Please specify a password.",
							minlength: "Please specify a secure password."
						},
						
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