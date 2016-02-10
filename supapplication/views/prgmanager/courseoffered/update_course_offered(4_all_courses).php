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
                Courses Offered
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
                                <h4 class="lighter">Add New Course Offered</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/update_course_offered" enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="sessions" id="sessions">
                                                                <?php 
                                                                  foreach( $sessions as $g => $a){
                                                                ?>
                                                                  <option value="<?php echo $a["session_id"];?>"><?php echo $a["session"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            <div class="control-group">
                                                    <label class="control-label" for="session">Choose Courses</label>
                                            </div>
                                                
                                            <?php 
                                                foreach( $all_courses as $k => $pp){
                                            ?>
                                                <div style="width: 50%; float: left;">
                                                    <label class="checkbox" style="width: 100%;">
                                                        <input type="checkbox" name="allcourses[]" id="<?php echo $pp["course_id"];?>" value="<?php echo $pp["course_id"];?>" />
                                                            <span class="lbl"><?php echo $pp["course_name"].' -- '.$pp["course_code"]; ?></span>
                                                    </label>
                                                </div>

                                            <?php  } ?>
                                                
                                                
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
            
            $(document).ready(function() {
                <?php
                    foreach($offered_courses as $e => $k ){
                ?>
                        $(document).ready(function(){
                            //$('input:checkbox[id^="someid_"]:checked')
                            $('input:checkbox#<?php echo $k['course_id']; ?>').attr('checked','checked');
                        });
                 <?php 
                    }
                ?>
            });
            
        </script>