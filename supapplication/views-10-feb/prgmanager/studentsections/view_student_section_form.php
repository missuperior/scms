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
            <h1>Students Section for first Semester</h1>
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
                                <h4 class="lighter">Students Section for first Semester</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/view_student_sections" enctype="multipart/form-data" />
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="all_session">Sessions:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session" id="session"  >

                                                                <option value="0">Select Session</option>
                                                                <?php  foreach( $all_session as $k => $pp){  ?>
                                                                    <option value="<?php echo $pp["session_id"];?>"><?php echo $pp["session"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program"  >
                                                                <option value="0">Select Program</option>
                                                                <?php  foreach( $programms as $k => $pp){  ?>
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
                                                            <select name="batch" id="batch" onchange="getSection(this.value);" >
                                                                <option value="0">Select Batch</option>
                                                                <?php  foreach( $all_batches as $k => $pp){  ?>
                                                                    <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' = '.$pp["batch_type"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div id="seccc">
                                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Session</th>
                                                                <th>Course Name</th>
                                                                <th>Course Code</th>
                                                                <th style="width: 26px;">Action</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                         <?php
                                                             $i = 0;
                                                             foreach ($CoursestoStudy as $row){?>
                                                            <tr>
                                                                <td><?php echo $i+1;  ?></td>
                                                                <td><?php echo $row['session']; ?></td>                                        
                                                                <td><?php echo $row['course_name']; ?></td>
                                                                <td><?php echo $row['course_code']; ?></td>


                                                                <td class="td-actions">
                                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                                        <!--<a class="green" href="<?php echo base_url();?>programmanagers/update_course_offered/<?php echo $row['prg_manager_id']; ?>/<?php echo $row['course_id']; ?>">
                                                                        <a class="green" href="<?php echo base_url();?>programmanagers/update_course_offered/<?php echo $row['prg_manager_id']; ?>">-->
                                                                            <i class="icon-pencil bigger-130"></i>
                                                                       <!-- </a>-->
                                                                    </div>                                                   
                                                                </td>                                                 
                                                            </tr>
                                                           <?php $i++; }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                    <!--<div class="control-group" >
                                                        <label class="control-label" for="section">Section:</label>
                                                        <div class="controls">
                                                            <div class="span12">
                                                                <select name="section" id="section">
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
                                                    </div>-->


<!--                                                    <div class="control-group">
                                                        <label class="control-label" for="section">Teacher Course:</label>
                                                        <div class="controls">
                                                            <div class="span12">
                                                                <select name="teachercourse" id="teachercourse">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>-->
                                                </div>
                                                
                                            </div>

                                            <hr />
                                            <div class="row-fluid wizard-actions">
<!--                                                <button class="btn btn-success btn-next" data-last="Finish">
                                                    Save
                                                </button>-->
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
            
         $(document).ready(function(){
            $('#session').val(0);
            $('#program').val(0);
            $('#batch').val(0);
            
        });
        
        function getSection(value)
        {
            
            if(value!=""){
                
                var session =  $('#session').val();
                var program =  $('#program').val();
                //var batch   =  $('#batch').val();
                $.ajax({
                    type: "POST",
                    data:{
                        'program':program,
                        'session':session,
                        'batch':value
                    },
                    url: "<?php echo base_url();?>programmanagers/ajax_ist_sections",

                    success:function(data){
                         //$("#section").html(data);
                         $("#seccc").html(data);
                         // setting a hiddend field value for the prigram name
                         //$('select option:selected').text();
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