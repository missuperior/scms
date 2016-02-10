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
                Campus Module           
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
                                <h4 class="lighter">Add New Campus</h4>

                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <form class="form-horizontal" id="campusform" method="POST" action="<?php echo base_url()?>admin/update_campus" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="email">Campus Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="campus_name" id="campus_name" value="<?php echo $campus[0]['campus_name'];?>"  class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Campus Code:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="campus_code" id="campus_code" value="<?php echo $campus[0]['campus_code'];?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="state">City:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                          <select style="width: 201px;" id="cities" name="cities" class="select2" data-placeholder="Click to Choose...">
                                                              <?php foreach ($cities as $row){?>
                                                                <option <?php if($campus[0]['city_id'] == $row['city_id']) echo 'selected="selected"'; ?> value="<?php echo $row['city_id']?>"><?php echo $row['city_name']?></option> 
                                                                <?php }?>																			
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="campus_id" value="<?php echo $campus[0]['campus_id'];?>"  class="input-xlarge">
                                                                                                                                                
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
            $('#campusform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    campus_name: {
                        required: true
                    },
                    campus_code: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/update_campus";
                    document.validationForm.submit();
                }
            });

        </script>   