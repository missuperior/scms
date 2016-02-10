<?php //echo '<pre>';var_dump($advisors);echo '</pre>';exit;?>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Course Sections Advisor Allocation</a>
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
            <h1>
                Course Sections List for <b><i><?php echo $session;?> </b></i>
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                       
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>							
                
                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/save_course_section_advisor_allocate" enctype="multipart/form-data" />
                
                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>All Course Sections</h3>
                                    </div>

<!--                                    list of all advisors-->
                                    

                                    <div class="control-group">
                                        <label class="control-label" for="session">Advisor:</label>

                                        <div class="controls">
                                            <div class="span12">
                                                <select name="advisor" id="advisor">
                                                    <option value="0">Select Advisor </option>
                                                    <?php 
                                                      foreach ($advisors as $pp){ 
                                                    ?>
                                                      <option value="<?php echo $pp["employee_id"];?>"><?php echo $pp["employee_name"]; ?> </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="session">Session:</label>

                                        <div class="controls">
                                            <div class="span12">
                                                <select name="session" id="session">
                                                    <option value="0">Select Session</option>
                                                    <?php 
                                                      foreach ($all_session as $pp){ 
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
                                                <select name="batch" id="batch" onchange="get_setting_list();">
                                                    <option value="0">Select Batch</option>
                                                    <?php 
                                                      foreach ($all_batches as $pp){ 
                                                    ?>
                                                      <option value="<?php echo $pp["batch_id"];?>"><?php echo $pp["batch"].' <=> '.$pp["batch_type"] ; ?> </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div style="display: none;" id="tttt">
                                        
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
                
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
        
    </div><!--/.main-content-->
</div><!--/.main-container-->    


    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>


    <!--inline scripts related to this page-->

    <script type="text/javascript">
      $(function() {
        var oTable1 = $('#sample-table-2').dataTable( {
          "aoColumns": [
            { "bSortable": true },
                null, null, null,null,null,
            { "bSortable": false }
          ] } );
			
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();
			
          var off2 = $source.offset();
          var w2 = $source.width();
			
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
      });
      
    function get_setting_list(){
        var batch =  $('#batch').val();
        var session  = $('#session').val();
        //alert(prog + batch);
          
        $.ajax({
            type:'POST',
            data:{
                'session':session,
                'batch':batch
            },
            url:"<?php echo base_url();?>programmanagers/course_session_list",
            success:function(data){
                $("#tttt").html(data);
                $("#tttt").show();
            },
            error:function (){
                alert('Some thing went wrong');
            }
          });
      }
      
      $(document).ready(function (){
        $("#batch").val(0);
        $("#session").val(0);
      });
      
      
      
    </script>