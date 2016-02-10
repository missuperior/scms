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
                                <h4 class="lighter">Define Fine Structure</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                    <form class="form-horizontal" id="cityform" method="POST" action="<?php echo base_url()?>examination/define_final_structure" enctype="multipart/form-data" />

                                                <h3 style="margin-left: 185px; color: #006E6F"> Final Total Marks : <?php echo 100-$mid_total;?> </h3>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">1 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title1" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks1" class="span6" />
                                                        </div>
                                                    </div>
                                                </div>
                                                                        
                                                <input type="hidden" name="program_id" value="<?php echo $program_id; ?>" class="span5" />
                                                <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" class="span5" />
                                                <input type="hidden" name="campaign_id" value="<?php echo $campaign_id; ?>" class="span5" />
                                                <input type="hidden" name="final_total_marks" value="<?php echo 100-$mid_total; ?>" class="span5" />
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">2 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title2" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks2" class="span6" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">3 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title3" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks3" class="span6" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">4 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title4" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks4" class="span6" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">5 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title5" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks5" class="span6" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">6 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title6" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks6" class="span6" />
                                                        </div>
                                                    </div>
                                                </div>
                        
                        
                                                <div class="control-group">
                                                    <label class="control-label" for="city">7 :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 150px;" placeholder="Title" type="text" name="title[]" id="title7" class="span5" /> - 
                                                            <input style="width: 100px;" placeholder="Marks" type="text" name="marks[]" id="marks7" class="span6" />
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
            
             $('.span6').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });
           
        </script>   