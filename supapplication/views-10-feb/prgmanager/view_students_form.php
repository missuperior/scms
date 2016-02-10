
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Select Student for the Course in Old Registration</a>
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
            <h1>Select Student</h1>
        </div><!--/.page-header-->
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                    <a href="" style="text-decoration: none;" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							
                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/SaveStudentCourseList" enctype="multipart/form-data" />
                <div class="row-fluid">
                    <div class="span12">  
                        
                        
                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Select Student For Course Registration</h3>
                                    </div>
                                    <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            
                                                            <select name="program" id="program" >
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
                                    
                                    <div class="control-group" onchange="getStudentList();" >
                                                    <label class="control-label" for="bacth">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch"  >
                                                                <option value="0">Select Batch </option>
                                                                <?php 
                                                                  foreach( $all_batches as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' '.$pp["batch_type"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    <div id="seccc"></div>
                                    <br/>
                                    
                                    <div>Select Course</div>
                                              
                                    
                                    
                                    <div class="control-group">
                                        <label class="control-label" for="program2">Select Program:</label>

                                        <div class="controls">
                                            <div class="span12">

                                                <select name="program2" id="program2" >
                                                    <option value="0">Select Program For Course</option>
                                                    <?php 
                                                      foreach( $programms as $k => $pp){
                                                    ?>
                                                      <option value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group"  >
                                        <label class="control-label" for="batch2">Select Batch:</label>

                                        <div class="controls">
                                            <div class="span12">
                                                <select name="batch2" id="batch2"  >
                                                    <option value="0">Select Batch </option>
                                                    <?php 
                                                      foreach( $all_batches as $k => $pp){
                                                    ?>
                                                      <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' '.$pp["batch_type"]; ?> </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group"  >
                                                    <label class="control-label" for="session2"  >Select Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session2" id="session2"  >
                                                                <option value="0">Select Session</option>
                                                                <?php 
                                                                  foreach( $all_session as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["session_id"];?>"><?php echo $pp["session"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    <div class="control-group"  >
                                                    <label class="control-label" for="section"  >Select Section:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="section" id="section" onchange="getCourseSection();"  >
                                                                <option value="0">0</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    <div id="seccc2"></div>
                                    
                                    <hr/>
                                    <div class="row-fluid wizard-actions">
                                                <button data-last="Finish " class="btn btn-success btn-next">
                                                    Save
                                                </button>
                                            </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <hr />
                    </form>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
    </div><!--/.main-content-->
</div><!--/.main-container-->    


<script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
<!--inline scripts related to this page-->
<script type="text/javascript">
        
    function getStudentList() {
        var batch       = $('#batch').val();
        var prog        = $('#program').val();
        //var session_id  = $('#session').val();
        $.ajax({
            type:'post',
            data:{
                'program'       :prog,
                'batch'         :batch
                //'session'       :session_id
            },
            //url: "<?php echo base_url();?>programmanagers/getofferedProgCourses",
            url: "<?php echo base_url();?>programmanagers/getStudentsDropDown",
            success:function(data){$("#seccc").html(data);},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
    function getCourseSection() {
        var batch2       = $('#batch2').val();
        var prog2        = $('#program2').val();
        var session2     = $('#session2').val();
        var section      = $('#section').val();
        //alert(session2     + prog2 + batch2);
        $.ajax({
            type:'post',
            data:{
                'session'       :session2,
                'program'       :prog2,
                'batch'         :batch2,
                'section'         :section
            },
            url: "<?php echo base_url();?>programmanagers/OfferedProgSessionCourses",
            //url: "<?php echo base_url();?>programmanagers/getStudentsDropDown",
            success:function(data){$("#seccc2").html(data);},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
      
    $(function() {
        $('#program').val(0);
        $('#batch').val(0);
        $('#session').val(0);
        $('#seccc').html();
        $('#section').val(0);
        //$('#section').val();
    });
      
      function rmcourse(course_id, session_id , prog, batch , row){
        alert('In it to rock one');
        $.ajax({
            type:'post',
            data:{
                'program'       :prog,
                'batch'         :batch,
                'session'       :session_id,
                'course'        :course_id
            },
            url: "<?php echo base_url();?>advisor/getStudents",
            success:function(data){ alert(data); $("#row"+row).remove(); alert('Deleted Successfully.');},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
   
    </script>