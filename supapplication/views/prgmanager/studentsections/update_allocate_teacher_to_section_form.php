<script type="text/javascript">
</script>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">Program Manager </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>Update Teacher Allocation</h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none;" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php //echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Update Course Section: <?php echo $course_name; ?></h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/update_allocate_teacher_to_section" enctype="multipart/form-data" />
                                                    
                                                <div class="control-group">
                                                    <label class="control-label" for="">Course: </label>
                                                    <div class="controls">
                                                        <div class="span12"><b><?php echo $course_name; ?></b></div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="all_session">Sessions:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <?php  echo $session; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <?php  echo $program; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <?php  echo $batch; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="seccc">
                                                    <div class="control-group" >
                                                        <label class="control-label" for="section">Section:</label>
                                                        <div class="controls">
                                                            <div class="span12">
                                                                      <?php echo  $sel_section ?>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="control-group">
                                                        <label class="control-label" for="section">Teacher Course:</label>
                                                        <div class="controls">
                                                            <div class="span12">
                                                                <select name="teachercourse" id="teachercourse">
                                                                    <?php foreach($teachers as $kk => $pk){ ?>
                                                                    <option <?php echo  $pk['emp_id'] == $sel_teacher_id ? 'selected="selected"' : ''; ?> value="<?php echo $pk['emp_id']; ?>"><?php echo $pk['employee_name'].'<==>'.$pk['designation_title'] ; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="session" value="<?php echo $sel_session; ?>"/>
                                                    <input type="hidden" name="batch" value="<?php echo $sel_batch; ?>"/>
                                                    <input type="hidden" name="program" value="<?php echo $sel_program; ?>"/>
                                                    <input type="hidden" name="section" value="<?php echo $sel_section; ?>"/>
                                                    <input type="hidden" name="course_id" value="<?php echo $sel_course_id; ?>"/>
                                                </div>
                                                
                                            </div>

                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <button class="btn btn-success btn-next" data-last="Finish">
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

        function getSection(value)
        {
            if(value!=""){
                var session = $('#session').val();    
                var program = $('#program').val();    
                   
                //alert(batch);
                $.ajax({
                    type: "POST",
                    data:{
                        'program'   :program,
                        'batch'     :value,
                        'session'   :session
                    },
                    url: "<?php echo base_url();?>programmanagers/get_sections",

                    success:function(data){
                         //$("#section").html(data);
                         $("#seccc").html(data);
                    },
                    error: function(){
                         alert('Some Error Occured, Please Try Again');
                    }
                 });
            }else{
                alert('Please Select Shift');
            }            
        }
        
        </script>