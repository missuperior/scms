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
            <h1>Result Report</h1>
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
                                <h4 class="lighter">Exam Report Subject Wise</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/subject_result_report" enctype="multipart/form-data" />
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program_id">
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
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch_id" >
                                                                <option value="0">Select Batch</option>
                                                                <?php 
                                                                  foreach( $all_batches as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' <==> '.$pp["batch_type"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="all_session" id="session_id" >
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
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="section">Section:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="section" id="section"  onchange="getAllSubject();" />
                                                                <option value="0">Select Section</option>
                                                                <option value="A">A</option>
                                                                <option value="B">B</option>
                                                                <option value="C">C</option>
                                                                <option value="D">D</option>
                                                                <option value="E">E</option>
                                                                <option value="F">F</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group" id="courses_results" style="display: none;">
                                                    <label class="control-label" for="Courses">Courses:</label>

                                                    <div class="controls">
                                                        <div class="span12" id="stus"></div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                            
                                            
                                            
                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <button class="btn btn-success btn-next" data-last="Finish">
                                                    View
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
            function getAllSubject()
            {
                
                var program_id  = $('#program_id').val();
                var batch_id    = $('#batch_id').val();
                var session_id  = $('#session_id').val();
                var section  = $('#section').val();
                
                $.ajax({
                    type: "POST",
                    data:{
                        'program'   :program_id,
                        'batch'     :batch_id,
                        'session'   :session_id,
                        'section'   :section
                    },
                    url: "<?php echo base_url();?>programmanagers/courses_results",

                    success:function(data){
                         //alert(data);
                         //$("#stus").val(data);
                         $("#stus").html(data);
                         $("#courses_results").show();
                    },
                    error: function(){
                         alert('Some Error Occured, Please Try Again');
                    }
                 });
            }            
        
        
        function createinputsecs(){
            
        }
        </script>