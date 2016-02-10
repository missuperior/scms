<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Add Offered Courses </a>
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
                Courses Offered Module
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                    <a href="" style="text-decoration: none;" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							
                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/add_courses_offered" enctype="multipart/form-data" />
                <div class="row-fluid">
                    <div class="span12">                                                                     
                                <input name="sessions" type="hidden" value="<?php echo $session_id;?>"/>
                                
                        
                        
                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Offered Courses</h3>
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
                                    
<!--                                    <div class="control-group">
                                                    <label class="control-label" for="session">Session:</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <select name="session" id="session" >
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
                                    -->
                                    
                                    <?php /*?>
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Session</th>
                                                <th>Course Name</th>
                                                <th>Course Code</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                             foreach( $offered_courses as $k => $pp){ ?>
                                            <tr>
                                                <td><label  class="checkbox" style="width: 100%;"><input style="opacity: 1;" type="checkbox" name="allcourses[]"  value="<?php echo $pp["course_id"];?>"></label></td>
                                                <td><?php echo $dispsesson; ?></td>                                        
                                                <td><?php echo $pp["course_name"]; ?></td>
                                                <td><?php echo $pp["course_code"]; ?></td>
                                            </tr>
                                           <?php $i++; }?>
                                        </tbody>
                                    </table> */?>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row-fluid wizard-actions">
                            <button class="btn btn-success btn-next" data-last="Finish ">
                                Save
                            </button>
                        </div>
                    </form>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->

        <div class="ace-settings-container" id="ace-settings-container">
            <div class="btn btn-app btn-mini btn-warning ace-settings-btn" id="ace-settings-btn">
                <i class="icon-cog bigger-150"></i>
            </div>
        </div><!--/#ace-settings-container-->
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
            null, null, 
            { "bSortable": false }
          ] } );
			
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table');
          var off1 = $parent.offset();
          var w1 = $parent.width();
			
          var off2 = $source.offset();
          var w2 = $source.width();
			
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
      })
    </script>