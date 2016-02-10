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
            <h1>
                Courses Allocation
            </h1>
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
                                <h4 class="lighter">Edit Course Allocation</h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/update_course_allocation" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="offered_courses">Course:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <?php //echo ?>
                                                            <select name="offered_courses" id="offered_courses">
                                                                <?php 
                                                                  foreach( $offered_courses as $k => $pp){
                                                                ?>
                                                                    <option <?php if($allocated_course[0]['course_id'] == $pp["course_id"] ){ ?> <?php echo 'selected="selected"'; } ?> value="<?php echo $pp["course_id"];?>"><?php echo $pp["course_name"].' -- '.$pp["course_code"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program">
                                                                <?php 
                                                                  foreach( $programms as $k => $pp){
                                                                ?>
                                                                  <option <?php if($allocated_course[0]['program_id'] == $pp['program_id'] ){ ?> <?php echo 'selected="selected"'; } ?> value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="sessions" id="sessions">
                                                                <?php 
                                                                  foreach( $sessions as $g => $a){
                                                                ?>
                                                                  <option <?php if($allocated_course[0]['session_id'] == $a['session_id'] ){ ?> <?php echo 'selected="selected"'; } ?> value="<?php echo $a["session_id"];?>"><?php echo $a["session"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="shifts">Shift:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="shifts" id="shifts">
                                                                <option <?php  echo $allocated_course[0]['shift'] == 'Morning' ? 'selected="selected"': '';  ?>  value="Morning">Morning</option>
                                                                <option <?php  echo $allocated_course[0]['shift'] == 'Evening' ?  'selected="selected"' : '';  ?>  value="Evening">Evening</option>
                                                                <option <?php  echo $allocated_course[0]['shift'] == 'Weekend' ? 'selected="selected"' : '';  ?>  value="Weekend">Weekend</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="teacher">Teacher</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="teacher" id="teacher">
                                                                <?php //foreach($teachers as $o => $r){ ?>
                                                                <!--<option value="1"><?php echo $r['employee_name']; ?> </option>-->
                                                                <option value="1">Test Teacher</option>
                                                                <?php //} ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="id" value="<?php echo $allocated_course[0]['course_allocation_id']; ?>" />

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
