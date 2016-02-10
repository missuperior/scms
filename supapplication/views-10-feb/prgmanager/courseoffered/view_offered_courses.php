<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">View Offered Courses</a>
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
            <h1>View Offered Courses</h1>
        </div><!--/.page-header-->
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                    <a href="" style="text-decoration: none;" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							
                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/view_offered_courses" enctype="multipart/form-data" />
                <div class="row-fluid">
                    <div class="span12">                                                                     
                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>View Courses Offered</h3>
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
                                    
                                    <div class="control-group">
                                                    <label class="control-label" for="bacth">Batch:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="batch" id="batch" >
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
                                    <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>
                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session" id="session" onchange="getOfferedCourse();" >
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
                                    <div id="seccc"></div>
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
        
    function getOfferedCourse() {
        var batch       = $('#batch').val();
        var prog        = $('#program').val();
        var session_id  = $('#session').val();
        $.ajax({
            type:'post',
            data:{
                'program'       :prog,
                'batch'         :batch,
                'session'       :session_id
            },
            url: "<?php echo base_url();?>programmanagers/getofferedProgCourses",
            success:function(data){$("#seccc").html(data);},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
      
    $(function() {
        $('#program').val(0);
        $('#batch').val(0);
        $('#session').val(0);
        $('#seccc').html();
      
//        var oTable1 = $('#sample-table-2').dataTable( {
//            "iDisplayLength": 50
//          "aoColumns": [
//            { "bSortable": true },
//            null,  
//            { "bSortable": false }
//          ] } );
//			
//        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
//        function tooltip_placement(context, source) {
//          var $source = $(source);
//          var $parent = $source.closest('table');
//          var off1 = $parent.offset();
//          var w1 = $parent.width();
//			
//          var off2 = $source.offset();
//          var w2 = $source.width();
//			
//          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
//          return 'left';
//        }
 //

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
            url: "<?php echo base_url();?>programmanagers/delofferedCourse",
            success:function(data){ alert(data); $("#row"+row).remove(); alert('Deleted Successfully.');},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
   
    </script>