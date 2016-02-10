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
                Program Module          
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
                                <h4 class="lighter">Edit Program</h4>

                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                      <form class="form-horizontal" id="bankform" method="POST" action="<?php echo base_url()?>admin/update_program" enctype="multipart/form-data" />
                                              
                                      <input type="hidden" id="prog_id" name="prog_id" value="<?php echo $program[0]['program_id'] ?>" />
                                                <div class="control-group">
                                                    <label class="control-label" for="prog_name">Program Name :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="prog_name" id="prog_name" value="<?php echo $program[0]['program_name'] ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div> 
                                      
                                      
                                                 <div class="control-group">
                                                    <label class="control-label" for="prog_code">Program Code :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                          <input style="width: 188px;" type="text" name="prog_code" id="prog_code" value="<?php echo $program[0]['program_code'] ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div> 
                                                                                                                   
                                                 <div class="control-group">
                                                    <label class="control-label" for="no_of_sessions">No. of Sessions :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="no_of_sessions" id="no_of_sessions" value="<?php echo $program[0]['no_of_sessions'] ?>" class="span5" />
                                                        </div>
                                                    </div>
                                                </div> 
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="prog_type">Program Type:</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select style="width:188px" id="prog_type" name="prog_type" class="select2" data-placeholder="Click to Choose...">
                                                                 <option <?php if($program[0]['program_type'] == 'Morning')echo "selected='selected'";?> value="Morning">Morning</option>																			
                                                                <option <?php if($program[0]['program_type'] == 'Evening')echo "selected='selected'";?> value="Evening">Evening</option>																			
                                                                <option <?php if($program[0]['program_type'] == 'Weekends')echo "selected='selected'";?>  value="Weekends">Weekends</option>      																		
                                                           </select>
                                                        </span>
                                                    </div>
                                                </div>
                                      
                                                <div class="control-group">
                                                    <label class="control-label" for="state">Program Department :</label>

                                                    <div class="controls">
                                                        <span class="span12">
                                                            <select id="prog_dept" name="prog_dept" class="select2" data-placeholder="Click to Choose..." style="width: 350px;">
                                                               <?php foreach($prog_dept as $row){ ?>
                                                                <option <?php if($program[0]['program_department_id'] == $row['program_department_id']) echo 'selected="selected"'; ?> value="<?php echo $row['program_department_id']?>"><?php echo $row['program_department_name'];?></option> 
                                                               <?php } ?>																			
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
                    prog_name: {
                        required: true
                    },
                    prog_code: {
                        required: true
                    },
                    no_of_sessions: {
                        required: true,
                        maxlength: 2,
                        digits: true
                    },
                    prog_type: {
                        required: true
                    },
                    prog_dept: {
                        required: true
                    }
                    
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/update_program";
                    document.validationForm.submit();
                }
            });

        </script>   

