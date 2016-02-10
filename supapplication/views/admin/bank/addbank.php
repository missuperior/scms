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
                Bank Module          
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
                                <h4 class="lighter">Add New Bank</h4>

                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <form class="form-horizontal" id="bankform" method="POST" action="<?php echo base_url()?>admin/add_bank" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="email">Bank Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                           <input style="width: 200px;" type="text" name="bank_name" id="bank_name" value="<?php echo set_value('bank_name'); ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Bank Address:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                             <input style="width: 200px;" type="text" name="bank_address" id="bank_address" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Bank Phone:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                             <input style="width: 200px;" type="text" name="bank_phone" id="bank_phone" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="state">City:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select style="width: 201px;" id="cities" name="cities" class="select2" data-placeholder="Click to Choose...">
                                                              <option>-- Select City --</option>                                                        
                                                                <?php foreach ($cities as $row){?>
                                                                <option value="<?php echo $row['city_id']?>"><?php echo $row['city_name']?></option> 
                                                                <?php }?>																			
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                 <div class="control-group">
                                                    <label class="control-label" for="email">Challan Title:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                             <input style="width: 200px;" type="text" name="challan_title" id="challan_title" class="span5" />
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
            $('#bankform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    bank_name: {
                        required: true
                    },
                    bank_address: {
                        required: true
                    },
                    bank_phone: {
                        required: true
                    },
                    challan_title: {
                        required: true
                    },
                    cities: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_bank";
                    document.validationForm.submit();
                }
            });
            
            jQuery(function($){
                $("#bank_phone").mask("9999-9999999");
            });
        </script>   

