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
            <h1>Students Except Sections</h1>
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
<!--                                <h4 class="lighter">Make Students Section for first Semester (<?php echo $session_na; ?>)</h4>-->
                                <h4 class="lighter">Remaining Student Sections for first Semester </h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
<!--                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/make_student_section" enctype="multipart/form-data" />-->
                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/remaining_student_sections" enctype="multipart/form-data" />
                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session" id="session">
                                                                <option value="0">Select Session </option>
                                                                <?php 
                                                                  foreach( $sessions as $k => $pp){
                                                                ?>
                                                                  <option value="<?php echo $pp["session_id"];?>"><?php echo $pp["session"]; ?> </option>
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
                                                
                                                
                                                <div class="control-group" style="display: none;" id="stus">
                                                    <label class="control-label" for="students"> Total Students:</label>

                                                    <div class="controls">
                                                        <div class="span12" id="totalstus" style="font-weight: bold; font-size: 20px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group" style="display: none;" id="totalsections">
                                                    <label class="control-label" for="students"> Sections Created So far:</label>

                                                    <div class="controls">
                                                        <div class="span12" id="sections" style="font-weight: bold; font-size: 20px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                
<!--                                                
                                                
                                                <div class="control-group" >
                                                    <label class="control-label" for="students"> Section:</label>

                                                    <div class="controls">
                                                        <div class="span12" >
                                                            <select name="section" id="section" >
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
                                                
                                                
<!--                                                <div class="control-group" >
                                                    <label class="control-label" for=""> No Of Students for Section:</label>

                                                    <div class="controls">
                                                        <div class="span12" >
                                                            <input type="text" name="no_of_students" id="no_of_students" >
                                                        </div>
                                                    </div>
                                                </div>-->
                                                
                                                
                                                
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
            
//        function getAllStus(value)
//        {
//            if(value!=""){
//                $.ajax({
//                    type: "POST",
//                    data:{
//                        'program':value,
//                    },
//                    url: "<?php echo base_url();?>programmanagers/get_program_total_stus",
//
//                    success:function(data){
//                         $("#totalstus").html(data);
//                         $("#stus").show();
//                    },
//                    error: function(){
//                         alert('Some Error Occured, Please Try Again');
//                    }
//                 });
//            }else{
//                alert('Please Select Shift');
//            }            
//        }
        
        
        
        
        
        function getAllStus(value){
        //$('#button').click(function() {
            var requestCallback = new MyRequestsCompleted({
                numRequest: 2,
                singleCallback: function(){
                    //alert( "I'm the callback");
                }
            });
            var session = $('#session').val();
            var batch = $('#batch').val();
            
            $.ajax({
                type: "POST",
                data:{
                    'program':value,
                    'session':session
                },
                url: "<?php echo base_url();?>programmanagers/get_program_total_stus",

                success:function(data){
                     $("#totalstus").html(data);
                     $("#stus").show();
                },
                error: function(){
                     alert('Some Error Occured, Please Try Again');
                }
            });
            $.ajax({
                type: "POST",
                    data:{
                        'program':value,
                        'session':session,
                        'batch':batch
                    },
                    url: "<?php echo base_url();?>programmanagers/Js_all_remaining_student_list",

                    success:function(data){
                         $("#sections").html(data);
                         $("#totalsections").show();
                    },
                    error: function(){
                         alert('Some Error Occured, Please Try Again');
                    }
            });
        }

        var MyRequestsCompleted = (function() {
            var numRequestToComplete, 
                requestsCompleted, 
                callBacks, 
                singleCallBack;

            return function(options) {
                if (!options) options = {};

                numRequestToComplete = options.numRequest || 0;
                requestsCompleted = options.requestsCompleted || 0;
                callBacks = [];
                var fireCallbacks = function () {
                    //alert("we're all complete");
                    for (var i = 0; i < callBacks.length; i++) callBacks[i]();
                };
                if (options.singleCallback) callBacks.push(options.singleCallback);


                this.addCallbackToQueue = function(isComplete, callback) {
                    if (isComplete) requestsCompleted++;
                    if (callback) callBacks.push(callback);
                    if (requestsCompleted == numRequestToComplete) fireCallbacks();
                };
                this.requestComplete = function(isComplete) {
                    if (isComplete) requestsCompleted++;
                    if (requestsCompleted == numRequestToComplete) fireCallbacks();
                };
                this.setCallback = function(callback) {
                    callBacks.push(callBack);
                };
            };
            })();
        
        $(document).ready(function(){
            $('#session').val(0);
            $('#program').val(0);
            $('#batch').val(0);
        });
</script>