<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
						
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
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">                       
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>							
                <div class="row-fluid">
                    <div class="span12">                                                                     
                            <div class="row-fluid">                                             
                                   
                                    <div class="table-header">                                        
                                        <h3 id="title">All Courses</h3>                                       
                                    </div>                                   
                                   
                                <form target="_blank" class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>teachers/add_single_student_result" enctype="multipart/form-data" />
                                                
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
                                                    <label class="control-label" for="batch">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch"  >
                                                                <option value="0">Select Batch</option>
                                                                <?php  foreach( $batches as $k => $pp){  ?>
                                                                    <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' <=> '.$pp["batch_type"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    
                                    
                                                <div class="control-group">
                                                    <label class="control-label" for="batch">Program:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select onchange="getRollNo(this.value);" name="program" id="program"  >
                                                                <option value="0">Select Program</option>
                                                                <?php  foreach( $programs as $k => $pp){  ?>
                                                                    <option value="<?php echo $pp["program_id"];?>"><?php echo $pp["program_name"]; ?> </option>
                                                                <?php  } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                <div id="rollno">
                                                    
                                                </div> 
                                    
                                    
                                            <div class="row-fluid wizard-actions">
                                                <button data-last="Finish " class="btn btn-success btn-next">
                                                    View Courses
                                                </button>
                                            </div>
                                
                            </form>
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
    $('#batch').val(0);
    $('#session').val(0);
});


      // get courses list program wise
   function getRollNo(program_id)
   {      
      
       var batch       =   $("#batch").val();
       var session     =   $("#session").val();
       
       if(program_id!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'program_id':program_id,
                        'batch_id':batch,
                        'session_id':session,
                         },
                    url: "<?php echo base_url();?>teachers/get_Students_list",
                    
                    success:function(data){
                        $("#rollno").html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Program');
              }            
              
   }

</script>