<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Generate Logins </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>
                Generate Logins  
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
                                <h4 class="lighter">Add New Login</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                <form class="form-horizontal" id="productform" method="POST" action="<?php echo base_url()?>programmanagers/generate_login_form" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="email">Email :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="sub_login" id="sub_login" value="@superior.edu.pk" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                               
                                               
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Password:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="password" name="sub_password" id="sub_password" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Confirm Password:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="password" name="confim_sub_password" id="confim_sub_password" class="span5" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                 <div class="control-group" >
                                                    <label class="control-label" for="section">Roles:</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="role" id="role">
<!--                                                                <option  value="HOD">HOD</option>
                                                                <option  value="OS">OS</option>-->
                                                                <option  value="Teacher">Teacher</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="control-group" >
                                                    <label class="control-label" for="section">Employer:</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="employer" id="employer">
                                                                <?php 
                                                                foreach($all_emps as $k => $camp){ ?>
                                                                    <option  value="<?php echo $camp['emp_id']; ?>"><?php echo $camp['employee_name'].'--'.$camp['department_name']; ?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="control-group" >
                                                    <label class="control-label" for="section">Campus:</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="campus" id="campus">
                                                                <option  value="3">University</option>
                                                            </select>
                                                            <!-- <select name="campus" id="campus">
                                                                <?php  /*
                                                                foreach($campuses as $k => $camp){ ?>
                                                                    <option  value="<?php echo $camp['campus_id']; ?>"><?php echo $camp['campus_name']; ?></option>
                                                                <?php } */ ?>
                                                            </select> -->
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
            $('#productform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    sub_email: {
                        required: true
                    },
                    sub_password: {
                        required: true
                    }
                    confim_sub_password: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/generate_login_form";
                    document.validationForm.submit();
                }
            });

        </script>   