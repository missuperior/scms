<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none"></a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
       
        
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
                                <h4 class="lighter">Edit Final Structure</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                        <form class="form-horizontal" id="cityform" method="POST" action="<?php echo base_url()?>examination/update_final_structure" enctype="multipart/form-data" />

                                            <?php $final_total = $final->final_value_1+$final->final_value_2+$final->final_value_3+$final->final_value_4+$final->final_value_5+$final->final_value_6+$final->final_value_7; ?>
                                            <h3 style="margin-left: 185px; color: #006E6F"> Final Total Marks : <?php echo $final_total;?> </h3>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">1 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_1; ?>" id="title1" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_1 > 0) echo $final->final_value_1; ?>" id="marks1" class="span5" />                                                            
                                                        </div>
                                                    </div>
                                                </div>
                        
                                               
                        
                                                <input type="hidden" name="final_structure_id" value="<?php echo $final->final_structure_id; ?>" class="span5" />                                               
                                                <input type="hidden" name="final_total" value="<?php echo $final_total; ?>" class="span5" />                                               
                                                                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">2 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_2; ?>" id="title2" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_2 > 0) echo $final->final_value_2; ?>" id="marks2" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">3 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_3; ?>" id="title3" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_3 > 0) echo $final->final_value_3; ?>" id="marks3" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">4 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_4; ?>" id="title4" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_4 > 0) echo $final->final_value_4; ?>" id="marks4" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <input type="hidden" name="final_course_structure_id" value="<?php echo $final->final_course_structure_id; ?>" class="span5" />
                                                                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">5 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_5; ?>" id="title5" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_5 > 0) echo $final->final_value_5; ?>" id="marks2" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">6 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_6; ?>" id="title6" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_6 > 0) echo $final->final_value_6; ?>" id="marks3" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">7 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" value="<?php echo $final->final_title_7; ?>" id="title7" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" value="<?php if($final->final_value_7 > 0) echo $final->final_value_7; ?>" id="marks3" class="span5" />
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
            $('#cityform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    cat: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_city";
                    document.validationForm.submit();
                }
            });

        </script>   