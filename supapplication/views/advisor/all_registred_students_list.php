
<?php 

//echo '<pre>';
//var_dump($RegisteredCourse);
?>
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/dataTables.tableTools.js"></script>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Courses Offered List</a>
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
            <h1>Courses Offered</h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							
                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>advisor/SaveStudentCourseList"/>
                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Student Information</h3>
                                    </div>
 <div class="control-group">
                                        <label class="control-label" for="session"></label>
                                            <div class="span12">
                                                Session In Which Student Will Be Registered:<?php echo $sessionna;?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr/>
                                    
                        <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Registered Students</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>Section</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php
                                             $i = 0;
                                             
                                             foreach ($courses as $row){?>
                                            <tr>
                                                <td><?php echo $i+1;  ?></td>
                                                <td><?php echo $row['course_name']; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['course_section']; ?></td>
                                            </tr>
                                           <?php $i++; }?>
                                        </tbody>
                                    </table>
                                </div>
                                    
                                    <hr/>
                                   
                            </div>
                        </div>
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


    
    <script type="text/javascript">
      $(function() {
          
          $('[data-rel=popover]').popover({html:true});
          
        var oTable1 = $('#sample-table-2').dataTable( {
          "aoColumns": [
            { "bSortable": true },
            null,null,null,
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

    </script>