<?php //echo '<pre>';var_dump($all_list);echo '</pre>';exit;?>

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Advisors Allocated to Sections</a>
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
                Allocated Advisors List for Course Sections
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							

                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Advisor to Courses List Form</h3>
                                    </div>
                                    <form enctype="multipart/form-data" action="<?php echo site_url();?>programmanagers/advisor_section_course_settings_list" method="POST" id="courseform" class="form-horizontal" novalidate="novalidate">

                                    
                                    <div class="control-group">
                                        <label class="control-label" for="session">Session:</label>

                                        <div class="controls">
                                            <div class="span12">
                                                <select name="session" id="session" >
                                                    <option value="0">Select Session</option>
                                                    <?php 
                                                      foreach( $all_session as $g => $a){
                                                    ?>
                                                        <option value="<?php echo $a["session_id"];?>"><?php echo $a["session"]; ?> </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="control-group">
                                        <label class="control-label" for="all_batches">Batch:</label>

                                        <div class="controls">
                                            <div class="span12">
                                                <select name="batch" id="batch" >
                                                    <option value="0">Select Batch</option>
                                                    <?php 
                                                      foreach( $all_batches as $k => $pp){
                                                    ?>
                                                      <option value="<?php echo $pp['batch_id'] ; ?>">
                                                          <?php echo $pp['batch'] .' <==> '.$pp['batch_type']; ?> 
                                                      </option>
                                                    <?php  } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="row-fluid wizard-actions">
                                                <button data-last="Finish " class="btn btn-success btn-next">
                                                    View
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
      })
    </script>