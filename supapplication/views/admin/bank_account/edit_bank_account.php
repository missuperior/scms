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
                Bank Account Module          
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
                                <h4 class="lighter">Edit Bank Account</h4>

                                <?php // echo '<pre>';
                                    //var_dump($account);die;?>
                                
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                    <hr />
    
                                       <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

   <form class="form-horizontal" id="bankform" method="POST" action="<?php echo base_url()?>admin/update_bank_account" enctype="multipart/form-data" />
 
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Bank Account #:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                             <input style="width: 200px;" type="text" name="account_no" id="account_no" value="<?php echo $account[0]['account_no'];?>" class="span5" />
                                                            <input type="hidden" name="bank_account_id" id="bank_account_id" value="<?php echo $account[0]['bank_account_id'];?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Account Type:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select id="account_type" name="account_type" class="select2" data-placeholder="Click to Choose...">
                                                                <option <?php if($account[0]['account_type'] == 'Current')echo "selected='selected'";?> value="Current">Current</option>																			
                                                                <option <?php if($account[0]['account_type'] == 'Saving')echo "selected='selected'";?> value="Saving">Saving</option>																			
                                                                <option <?php if($account[0]['account_type'] == 'Salary')echo "selected='selected'";?>  value="Salary">Salary</option>      																		
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Bank:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                          <select id="bank" name="bank" class="select2" data-placeholder="Click to Choose..." style="width: 350px;">
                                                               <?php                                                               
                                                               foreach ($bank as $row){?>
                                                              
                                                                <option <?php if($account[0]['bank_id'] == $row['bank_id']) echo 'selected="selected"'; ?> value="<?php echo $row['bank_id']?>"><?php echo $row['bank_name'].' --- '.$row['bank_address'];?></option> 
                                                                
                                                                <?php }?>																			
                                                            </select>
                                                        </span>
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
            $('#bankform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    account_no: {
                        required: true,
                        digits: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/update_bank_account";
                    document.validationForm.submit();
                }
            });

        </script>   