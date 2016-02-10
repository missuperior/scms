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
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/add_courses_offered" enctype="multipart/form-data" />

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
                                                    <label class="control-label" for="coursename">Course:</label>

                                                    <div class="controls">
                                                        <div class="span12">
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
                                                
                                                
                                                <div id="clonedInput2"> </div>
                                                <div id="pre_req_holding">
                                                    <div class="control-group" id="PrGoup">
                                                        <label class="control-label" for="courseprereq">Add More Course:</label>

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
            var selct = '<?php echo $dropdown; ?>';
            $("#rere").click(function() {
                //alert('ssssss');
                var file_handle = 'onclick="removeElement(\'file-'+fileId+'\');"';
                //var file_handle = 'id="removeElement(\"file-'+fileId+'\");"';
                //<div id="removeElement("file-'+fileId+'");">Remove</div>
                var html = '<div class="control-group">\n\
                      <label class="control-label" for="coursecode">Course:</label>\n\
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

            


        </script>   