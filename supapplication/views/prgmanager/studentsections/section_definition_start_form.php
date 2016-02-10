<script type="text/javascript"></script>

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
            <h1>Section Definition for Courses</h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none;" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
<!--                                <h4 class="lighter">Make Students Section for first Semester (<?php echo $session_na; ?>)</h4>-->
                                <h4 class="lighter">Section Definition for Courses</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
<!--                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/make_student_section" enctype="multipart/form-data" />-->
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/section_definition_save" enctype="multipart/form-data" />
                                                
<!--                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <b><i><?php echo $session; ?></i></b>
                                                            <input type="hidden" name="session" id="session" value="<?php echo $session_id; ?>" />
                                                        </div>
                                                    </div>
                                                </div>-->
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session" id="session" >
                                                                <option value="0">Select Session</option>
                                                                <?php 
                                                                  foreach( $all_session as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["session_id"];?>">
                                                                      <?php echo $pp["session"]; ?> 
                                                                  </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch" >
                                                                <option value="0">Select Batch</option>
                                                                <?php 
                                                                  foreach( $batches as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["batch_id"];?>">
                                                                      <?php echo $pp["batch"] .'<=>'.$pp["batch_type"]; ?> 
                                                                  </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program" onchange="get_course_list();">
                                                                <option value="0">Select Program </option>
                                                                <?php 
                                                                  foreach( $programms as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group" style="display: none;" id="offered_corses_div">
                                                    <label class="control-label" for="offered_courses">Course:</label>

                                                    <div class="controls">
                                                        <div class="span12" id="offered_courses_spn">
                                                            <select name="offered_courses" id="offered_courses">
                                                                <?php 
                                                                  foreach( $offered_courses as $k => $pp){
                                                                ?>
                                                                    <option value="<?php echo $pp["course_id"];?>"><?php echo $pp["course_name"].' -- '.$pp["course_code"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                
                                                
                                                <div class="control-group" >
                                                    <label class="control-label" for="students"> Section:</label>
                                                    <div class="controls">
                                                        <div class="span12" >
                                                            <select name="section[]" id="section" style="width: 62px;" >
                                                                  <option value="A">A</option>
                                                                  <option value="B">B</option>
                                                                  <option value="C">C</option>
                                                                  <option value="D">D</option>
                                                                  <option value="E">E</option>
                                                                  <option value="F">F</option>
                                                                  <option value="G">G</option>
                                                                  <option value="H">H</option>
                                                                  <option value="I">I</option>
                                                                  <option value="J">J</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <label class="control-label" for="students"> No of Students:</label>
                                                    <div class="controls">
                                                        <div class="span12" >
                                                            <input style="width:46px;" type="text" name="no_of_students[]" id="no_of_students" >
                                                        </div>
                                                    </div>
                                                </div>


                                                <div id="clonedInput2"> </div>
                                                
                                                <div id="rere"> 
                                                    <div class="control-group" >
                                                    <label class="control-label"> </label>
                                                    <div class="controls">
                                                        <div class="span12" style="cursor: pointer;" >Add More Sections</span>
                                                    </div>
                                                </div>
        
                                                <div id="parent_course_div" style="display: none;"></div>
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
            
        
        
        // offered courses list
        function get_course_list (){
            var program;
            var batch;
            var session;
            program = $("#program").val();
            batch   = $("#batch").val();
            session = $("#session").val();

            $.ajax({
                type:'post',
                data:{
                    'program'       :program,
                    'batch'         :batch,
                    'session'       :session
                },
                url: "<?php echo base_url();?>programmanagers/SesionPrgBthOfferedCourses",
                success:function(data){ $("#offered_courses_spn").html(data); $("#offered_corses_div").show();},
                error: function(){alert('Some Error Occured, Please Try Again');}
            });
        }

        $(document).ready(function(){
            $('#program').val(0);
            $('#batch').val(0);
        });
        
        
        var fileId;
        fileId = 0;
        
        
        $("#rere").click(function() {
                //alert('ssssss');
                var file_handle = 'onclick="removeElement(\'file-'+fileId+'\');"';
                //var file_handle = 'id="removeElement(\"file-'+fileId+'\");"';
                //<div id="removeElement("file-'+fileId+'");">Remove</div>
                var html = '<div class="control-group" >\n\
                                                    <label class="control-label" for="students"> Section:</label>\n\
                                                    <div class="controls">\n\
                                                        <div class="span12" >\n\
                                                            <select name="section[]" id="section" style="width: 62px;" >\n\
                                                                  <option value="A">A</option>\n\
                                                                  <option value="B">B</option>\n\
                                                                  <option value="C">C</option>\n\
                                                                  <option value="D">D</option>\n\
                                                                  <option value="E">E</option>\n\
                                                                  <option value="F">F</option>\n\
                                                                  <option value="G">G</option>\n\
                                                                  <option value="H">H</option>\n\
                                                                  <option value="I">I</option>\n\
                                                                  <option value="J">J</option>\n\
                                                            </select>\n\
                                                        </div>\n\
                                                    </div>\n\
                                                    <label class="control-label" for="students"> No of Students:</label>\n\
                                                    <div class="controls">\n\
                                                        <div class="span12" >\n\
                                                            <input style="width:46px;" type="text" name="no_of_students[]" id="no_of_students" >\n\
                                                        </div>\n\
                                                    </div>\n\
                                                </div>\n\
                                                <div class="control-group" >\n\
                                                    <label class="control-label" for="students"> </label>\n\
                                                    <div class="controls">\n\
                                                        <div '+file_handle+' style="cursor:pointer;">Remove</div>\n\
                                                    </div>\n\
                                                </div>\n\
                                        </div>\n\
                                    </div>';
                addElement('clonedInput2', 'div', 'file-'+fileId, html);
                fileId++;
            }); 

        
        </script>