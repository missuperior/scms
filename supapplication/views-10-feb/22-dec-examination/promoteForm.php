<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">ACCOUNTS MODULE</a>                
            </li>            
        </ul><!--.breadcrumb-->
        <div class="nav-search" id="nav-search">
            <form class="form-search" />
            <span class="input-icon">
                <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>
    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                PROMOTE STUDENTS FORM
            </h1>
        </div><!--/.page-header-->
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> </a>
                </h4>
                <div class="hr hr-18 hr-double dotted"></div>            
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Promote Students Form</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>examination/promote_students" enctype="multipart/form-data" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                  
                                                <div class="control-group">
                                                    <label style="width: 200px;" class="control-label" for="email">Campus:<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 240px;">
                                                        <div class="span12">
                                                          <select style="width: 200px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campus --</option>
                                                                <?php foreach ($campus as $row) { ?>
                                                                    <option <?php if (set_value('campus') == $row['campus_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> <?php } ?>
                                                                    <option value="0">All</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>

                                                
                                                <div class="control-group">
                                                    <label style="width: 200px;" class="control-label" for="email">Program :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 240px;">
                                                        <div class="span12">
                                                          <select style="width: 200px;" id="program" name="program" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Program --</option>
                                                                <?php foreach ($programs as $row) { ?>
                                                                    <option value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> <?php } ?>                                                                    
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                
                                                <div class="control-group">
                                                    <label style="width: 200px;" class="control-label" for="email">Semester :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 240px;">
                                                        <div class="span12">
                                                            <select onchange="get" style="width: 200px;" id="semester" name="semester" class="select2" data-placeholder="Click to Choose...">                                                                
                                                                    <option value="1">Semester 1</option> 
                                                                    <option value="2">Semester 2</option> 
                                                                    <option value="3">Semester 3</option> 
                                                                    <option value="4">Semester 4</option> 
                                                                    <option value="5">Semester 5</option> 
                                                                    <option value="6">Semester 6</option> 
                                                                    <option value="7">Semester 7</option> 
                                                                    <option value="8">Semester 8</option> 
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div> 
                                                
                                        </div>
                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Submit                                          
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
<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#initialform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    campus: {
                        required: true
                    },
                    program: {
                        required: true
                    },
                    semester: {
                        required: true
                    }
                    
                },                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }                
            });
            
        </script>   
        
        