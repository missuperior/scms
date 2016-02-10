<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">ADMIN </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>
                User Module           
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
                                <h4 class="lighter">Add New User</h4>

                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <form class="form-horizontal" id="campusform" method="POST" action="<?php echo base_url()?>admin/add_user" enctype="multipart/form-data" />

                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Campus:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select style="width: 201px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                                                               <?php foreach ($campus as $row){?>
                                                                    <option value="<?php echo $row['campus_id']?>"><?php echo $row['campus_name']?></option> 
                                                                <?php }?>																			
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Module:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select style="width: 201px;" id="module" name="module" class="select2" data-placeholder="Click to Choose...">                                                               
                                                                    <option value="">Select Module</option>                                                                 							
                                                                    <option value="3">Admissions</option>                                                                 							
                                                                    <option value="4">Accounts</option>                                                                 							
                                                                    <option value="7">Examination</option>                                                                 							
                                                                    <option value="8">Student Office</option>                                                                 							
                                                            </select>
                                                        </span>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="email">User Name:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="username" id="username" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                               <div class="control-group">
                                                    <label class="control-label" for="state">Role :</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select style="width: 201px;" id="role" name="role" class="select2" data-placeholder="Click to Choose...">                                                               
                                                                    <option value="">Select Role</option>                                                                 							
                                                                    <option value="HOD">HOD (For Uni & Science Campus)</option>                                                                 							
                                                                    <option value="OS">OS (For Out Campus)</option>                                                                 							
                                                            </select>
                                                        </span>
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
            $('#campusform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    username: {
                        required: true
                    },
                    campus: {
                        required: true
                    },
                    role:{
                        required:true
                    },
                    module:{
                        required:true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_campus";
                    document.validationForm.submit();
                }
            });

        </script>   