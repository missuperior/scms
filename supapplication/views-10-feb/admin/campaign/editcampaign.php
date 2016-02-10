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
                Campaign Module           
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
                                <h4 class="lighter">Edit Campaign</h4>

                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <form class="form-horizontal" id="campaignform" method="POST" action="<?php echo base_url()?>admin/update_campaign" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="email">Campaign Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="campaign_name" id="campaign_name"  value="<?php echo $campaign[0]['campaign_name'];?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Campaign Code:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="campaign_code" id="campaign_code" value="<?php echo $campaign[0]['campaign_code'];?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Campaign Type:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="campaign_type" id="campaign_type" value="<?php echo $campaign[0]['campaign_type'];?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Status:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select style="width: 201px;" id="status" name="status" class="select2" data-placeholder="Click to Choose...">
                                                               <option <?php if($campaign[0]['status'] == 'open'){echo 'selected="selected"';}?> value="open">Open</option> 
                                                               <option <?php if($campaign[0]['status'] == 'closed'){echo 'selected="selected"';}?> value="closed">Closed</option>                                        																			
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Remarks:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                             <input style="width: 200px;" type="text" name="remarks" id="remarks"  value="<?php echo $campaign[0]['remarks'];?>"  class="span5" />
                                                            <input type="hidden" name="campaign_id" value="<?php echo $campaign[0]['campaign_id'];?>"  class="input-xlarge">
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>

                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <button class="btn btn-success btn-next" data-last="Finish ">
                                                    Update
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
            $('#campaignform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    campaign_name: {
                        required: true
                    },
                    campaign_code: {
                        required: true
                    },
                    campaign_type: {
                        required: true
                    },
                    remarks: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/update_campaign";
                    document.validationForm.submit();
                }
            });

        </script>   