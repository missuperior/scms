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
                                <h4 class="lighter">Make Students Section for first Semester</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/make_student_section" enctype="multipart/form-data" />
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="program" id="program" onchange="getAllStus(this.value);">
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
                                                
                                                
                                                <div class="control-group" id="totalstus" style="display: none;">
                                                    <label class="control-label" for="program">Total Students:</label>

                                                    <div class="controls">
                                                        <div class="span12" >
                                                            <input id="stus"  type="text" name="" disabled/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="program">No Of Sections Create:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="no_of_section" id="no_of_section" onchange="createinputsecs(this.value);">
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">5</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group" id="totalstus" style="display: none;">
                                                    <label class="control-label" for="program">Total Students:</label>

                                                    <div class="controls">
                                                        <div class="span12" id="stus" >
                                                            
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
            function getAllStus(value)
            {
                if(value!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'program':value,
                    },
                    url: "<?php echo base_url();?>programmanagers/get_program_total_stus",

                    success:function(data){
                         //alert(data);
                         $("#totalstus").show();
                         $("#stus").val(data);
                         // setting a hiddend field value for the prigram name
                         //$('select option:selected').text();
                    },
                    error: function(){
                         alert('Some Error Occured, Please Try Again');
                    }
                 });
            }else{
                alert('Please Select Program');
            }            
        }
        
        
        function createinputsecs(){
            
        }
        </script>