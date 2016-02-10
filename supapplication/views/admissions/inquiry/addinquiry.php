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
                <input style="width: 200px;"  type="text"placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                STUDENT INQUIRY FORM
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg');

                        $this->session->unset_userdata('msg');
                        ?> </a>

                    <?php $this->session->unset_userdata('error_msg'); ?> 
                    <?php echo $this->session->userdata('success_msg');
                    $this->session->unset_userdata('success_msg');
                    ?> </a>

                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">ADD STUDENT INQUIRY</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">

                                    <div class="row-fluid">


                                        <form class="form-horizontal" id="inquiryform" method="POST" action="<?php echo base_url(); ?>admission/add_inquiry" enctype="multipart/form-data" />

                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">


                                                <!-- *************************************    Start Student Table Information  *************************************************** -->


                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Inquiry No: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="inquiry_no" id="inquiry_no" class="span5" value="<?php echo set_value('inquiry_no'); ?>" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campaign:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="campaign" name="campaign" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campaign --</option>
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
<?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Name: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Contact: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="contact" id="contact" value="<?php echo set_value('contact'); ?>" class="span5"  placeholder="e.g 0321-1234567"/>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Phone: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" class="span5"  placeholder="e.g 0321-1234567" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Program:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="program" name="program" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Program --</option>
                                                                <?php foreach ($program as $row) { ?>
                                                                    <option <?php if (set_value('program_id') == $row['program_id']) echo '"selected=selected"'; ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
<?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Shift: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="shift" id="shift" value="<?php echo set_value('shift'); ?>" placeholder="e.g. Morning" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%; float: left; margin-bottom: 25px; " class="control-group">
                                                    <label style="width: 130px;" class="control-label">Gender: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                                                    <div  style="margin-left: 140px;" class="controls">
                                                        <span class="span12">
                                                            <label class="blue" style="float: left; width: 100px">
                                                                <input name="gender" value="male" type="radio" checked/>
                                                                <span class="lbl"> Male</span>
                                                            </label>
                                                            <label class="blue"style="float: left; width: 100px">
                                                                <input name="gender" value="female" type="radio"  />
                                                                <span class="lbl"> Female</span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>




                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Qualification: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="qualification" value="<?php echo set_value('qualification'); ?>" id="qualification" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div style="width: 50%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Obtained Marks: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="obtained_marks" id="obtained_marks" value="<?php echo set_value('obtained_marks'); ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Reference:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="reference" name="reference" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Reference --</option>
                                                                <?php foreach ($reference as $row) { ?>
                                                                    <option <?php if (set_value('reference') == $row['reference_id']) echo 'selected="selected"'; ?> value="<?php echo $row['reference_id'] ?>"><?php echo $row['reference_source'] ?></option> 
<?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Inquiry Type:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="inquiry_type" name="inquiry_type" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Type --</option>
                                                                <option value="Physical" <?php if (set_value('inquiry_type') == 'Physical') echo '"selected=selected"'; ?> />Physical
                                                                <option value="Telephonic" <?php if (set_value('inquiry_type') == 'Telephonic') echo '"selected=selected"'; ?> />Telephonic																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Institute:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="institute" name="institute" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Institute --</option>
                                                                <?php foreach ($institute as $row) { ?>
                                                                    <option <?php if (set_value('institute') == $row['institute_id']) echo '"selected=selected"'; ?> value="<?php echo $row['institute_id'] ?>"><?php echo $row['institute_name'] ?></option> 
<?php } ?>																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div style="width: 50%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campus:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campus --</option>
                                                                <?php foreach ($campus as $row) { ?>
                                                                    <option <?php if (set_value('campus') == $row['campus_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> 
<?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div style="width: 100%; float: left;margin-bottom: 25px;" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Remarks: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <textarea style="width:554px; height: 75px" name="remarks" id="remarks" value="<?php echo set_value('remarks'); ?>"></textarea>
                           <!--                               <input style="width: 200px;" type="text" name="remarks" id="remarks" value="<?php echo set_value('remarks'); ?>" class="span5" />-->
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


<script type="text/javascript">
    $('#inquiryform').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            inquiry_no: {
                required: true
            },
            campaign: {
                required: true
            },
            contact: {
                required: true
            },
            name: {
                required: true
            },
            phone: {
                required: true
            },
            program: {
                required: true
            },
            reference: {
                required: true
            },
            inquiry_type: {
                required: true
            },
            shift: {
                required: true
            },
            qualification: {
                required: true
            },
            obtained_marks: {
                required: true
            },
            remarks: {
                required: true
            },
            institute: {
                required: true
            },
            campus: {
                required: true
            },
            gender: 'required',
            agree: 'required'
        },
        messages: {
            email: {
                required: "Please provide a valid email.",
                email: "Please provide a valid email."
            },
            password: {
                required: "Please specify a password.",
                minlength: "Please specify a secure password."
            },
            subscription: "Please choose at least one option",
            gender: "Please choose gender",
            agree: "Please accept our policy"
        },
        highlight: function(e) {
            $(e).closest('.control-group').removeClass('info').addClass('error');
        },
        submitHandler: function(form) {
            document.validationForm.action = "<?php echo base_url(); ?>admission/add_inquiry";
            document.validationForm.submit();
        },
        invalidHandler: function(form) {
        }

    });

    jQuery(function($) {
        $("#contact").mask("9999-9999999");
        $("#phone").mask("9999-9999999");
    });

</script>
