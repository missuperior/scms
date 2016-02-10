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
                Generate Advisor Login
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
                                <h4 class="lighter">Add New Advisor</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/add_advisor_login" enctype="multipart/form-data" />
                                               
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="teacher">Teacher</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="teacher" id="teacher">
                                                                <?php foreach($teachers as $o => $r){ ?>
                                                                    <option value="<?php echo $r['emp_id']; ?>"><?php echo $r['employee_name'].' <=> '.$r['designation_title'].' <=> '.$r['department_name']; ?> </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="username">User Name</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="text" name="username" id="username" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="password">Password</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input type="password" name="password" id="password" >
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
            
    <?php /*
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
            
     * */
     
           
        </script>