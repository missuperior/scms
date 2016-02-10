<?php // 
//    echo  '<pre>'; 
//    var_dump($all_batches);
//    echo  '</pre>'; exit;
?>
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
                                <h4 class="lighter">Add New Course Allocation</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/add_course_allocation" enctype="multipart/form-data" />
                                                
                                                
<!--                                                 <div class="control-group">
                                                    <label class="control-label" for="offered_courses">Semester:</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="semester" id="semester">
                                                                <?php 
                                                                  for($i=1; $i<=8 ;  $i++){
                                                                ?>
                                                                  <option value="<?php echo $i ; ?>">
                                                                      Semester <?php echo $i; ?> 
                                                                  </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>-->

                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program">
                                                                <option value="0">Select Program</option>
                                                                <?php 
                                                                  foreach( $programms as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                 <div class="control-group">
                                                    <label class="control-label" for="all_batches">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch" >
                                                                <option value="0">Select Batch</option>
                                                                <?php 
                                                                  foreach( $all_batches as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp['batch_id'] ; ?>">
                                                                      <?php echo $pp['batch'] .' <==> '.$pp['batch_type']; ?> 
                                                                  </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="sessions" id="sessions" onchange="get_course_list();">
                                                                <option value="0">Select Session</option>
                                                                <?php 
                                                                  foreach( $sessions as $g => $a){
                                                                ?>
                                                                    <option value="<?php echo $a["session_id"];?>"><?php echo $a["session"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group" >
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
                                                
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="shifts">Shift:</label>

                                                    <div class="controls">
                                                        <div class="span12"><b>Morning</b>
                                                            <input type="hidden" value="Morning" name="shifts" id="shifts">
                                                        </div>
                                                    </div>
<!--                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="shifts" id="shifts">
                                                                <option value="Morning">Morning</option>
                                                                <option value="Evening">Evening</option>
                                                                <option value="Weekend">Weekend</option>
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                </div>
                                               
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="teacher">Teacher</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="teacher[]" id="teacher">
                                                                <?php foreach($teachers as $o => $r){ ?>
                                                                    <option value="<?php echo $r['emp_id']; ?>"><?php echo $r['employee_name'].' <=> '.$r['designation_title'].' <=> '.$r['department_name']; ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="clonedInput2"> </div>
                                                
                                                <div id="pre_req_holding">
                                                    <div class="control-group" id="PrGoup">
                                                        <label class="control-label" for="courseprereq">Allocate More Teacher:</label>

                                                        <div class="controls">
                                                            <div class="span12" id="rere"  >
                                                                <input type="button" style="width: 188px;" type="text" name="addpre_req"  class="span5" />
                                                            </div>
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
            var fileId = 0; // used by the addFile() function to keep track of IDs
            
            //var selct = '<select name="teacher[]" id="teacher"><option value="1">Test Teacher</option><option value="2">Test Teacher2</option></select>';
            var selct = ' <select name="teacher[]" id="teacher"><?php foreach($teachers as $o => $r){ ?><option value="<?php echo $r['emp_id']; ?>"><?php echo $r['employee_name'].' <=> '.$r['designation_title'].' <=> '.$r['department_name']; ?> </option><?php } ?></select>';
            
            $("#rere").click(function() {
                //alert('ssssss');
                var file_handle = 'onclick="removeElement(\'file-'+fileId+'\');"';
                var html = '<div class="control-group">\n\
                      <label class="control-label" for="coursecode">Teacher:</label>\n\
                      <div class="controls">\n\
                          <div class="span12">\n\
                              '+selct+'\n\
                          </div>\n\
                          <div '+file_handle+' style="cursor:pointer;">Remove</div>\n\
                      </div>\n\
                  </div>';
                addElement('clonedInput2', 'div', 'file-'+fileId, html);
                fileId++;
            }); 
            
            function get_course_list (){
                var program;
                var batch;
                var session;
                program = $("#program").val();
                batch   = $("#batch").val();
                session = $("#sessions").val();
                
                $.ajax({
                    type:'post',
                    data:{
                        'program'       :program,
                        'batch'         :batch,
                        'session'       :session
                    },
                    url: "<?php echo base_url();?>programmanagers/SesionPrgBthOfferedCourses",
                    success:function(data){ $("#offered_courses_spn").html(data); },
                    error: function(){alert('Some Error Occured, Please Try Again');}
                });
            }
            
            $(function(){
                $("#program").val(0);
                $("#batch").val(0);
                $("#sessions").val(0);
            });
        </script>