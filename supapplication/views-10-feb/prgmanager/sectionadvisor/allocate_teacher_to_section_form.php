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
                        <?php //echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Students Section </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/allocate_teacher_to_section" enctype="multipart/form-data" />
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="all_session">Sessions:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session" id="session"  >

                                                                <option value="0">Select Session</option>
                                                                <?php  foreach( $sessions as $k => $pp){  ?>
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
                                                                <?php  foreach( $batches as $k => $pp){  ?>
                                                                    <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' <=> '.$pp["batch_type"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div id="seccc">
                                                    <div class="control-group" >
                                                        <label class="control-label" for="section">Section:</label>
                                                        <div class="controls">
                                                            <div class="span12">
                                                                <select name="section" id="section">
                                                                      <option value="A">A</option>
                                                                      <option value="B">B</option>
                                                                      <option value="D">D</option>
                                                                      <option value="E">E</option>
                                                                      <option value="F">F</option>
                                                                      <option value="G">G</option>
                                                                      <option value="H">H</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="control-group">
                                                        <label class="control-label" for="section">Teacher Course:</label>
                                                        <div class="controls">
                                                            <div class="span12">
                                                                <select name="teachercourse" id="teachercourse">
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
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

        $(document).ready(function(){
             $('#session').val(0);    
             $('#batch').val(0);    
             $('#program').val(0);   
         }); 
            
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