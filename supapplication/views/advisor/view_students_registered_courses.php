
<?php 

echo '<pre>';
var_dump($RegisteredCourse);
?>
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
                                    
                                    <table id="sample-table-22" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th> Name: <?php echo $student_data[0]['student_name']; ?></th>
                                                <th>Father Name: <?php echo $student_data[0]['father_name']; ?></th>
                                                <th> Roll no: <?php echo $student_data[0]['roll_no']; ?></th>
                                                <th>Courses Session : <?php echo $sessionna; ?></th>
                                            </tr> 
                                        </thead>
                                    </table>
                                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>"/>
                                    <hr/>
                                    
                                    <?php if(!empty($RegisteredCourse)){?>
                        <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Student Already Registered Courses for Session:<?php echo $sessionna;?> </h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name</th>
                                                <th>Program Name</th>
                                                <th>Section</th>
<!--                                                <th style="width: 26px;">Action</th>-->
                                            </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                             
                                             foreach ($RegisteredCourse as $row){?>
                                            <tr>
                                                                                        
                                                <td><?php echo $i+1;  ?></td>
                                                <td><?php echo $row['course_name']; ?></td>
                                                <td><?php echo $row['program_name']; ?></td>
                                                <td><?php echo $row['course_section']; ?></td>
                                                
<!--                                                <td class="td-actions">
                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                       
                                                        <a class="green" href="<?php echo base_url();?>courses/edit_course/?course_id=<?php echo $row['course_id']; ?>">
                                                        <a class="green" href="<?php echo base_url();?>courses/edit_course/<?php echo $row['course_id']; ?>">
                                                            <i class="icon-pencil bigger-130"></i>
                                                        </a>                                                       
                                                    </div>                                                   
                                                </td>                                                 -->
                                            </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <?php } ?>
                                    
                                    <hr/>
                                   
                                    
                                    <div class="table-header">
                                       <h3>All Offered Courses</h3>
                                    </div>
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name</th>
                                                <th>Course Code</th>
                                                <th>Teacher Name</th>
                                                <th>Section</th>
                                                <th>No Of Students Allowed</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <input type="hidden" name="batch_id" value="<?php echo $batch_id; ?>"/>
                                            <input type="hidden" name="program_id" value="<?php echo $program_id; ?>"/>
                                            <input type="hidden" name="session_id" value="<?php echo $session_id; ?>"/>
                                         <?php
                                            if($OfferedCourse != null){
                                             $i = 0;
                                             foreach ($OfferedCourse as $row){
                                                 
                                        ?>
                                            <tr>
                                                <td><input value="<?php echo $row['course_id'].'='.$row['emp_id'].'='.$row['section_name']; ?>" style="opacity: 1;" type="checkbox" id="course_settings[]" name="course_list[]" /></td>
                                                <td><?php echo $row['course_name']; ?></td>
                                                <td><?php echo $row['course_code']; ?></td>
                                                <td><?php echo $row['employee_name']; ?></td>
                                                <td><?php echo $row['section_name']; ?></td>
                                                <td><?php echo $row['no_of_students']; ?></td>
                                            </tr>
                                            
                                            
                                            <?php $i++; }}else{ ?>
                                            <tr><td colspan="7">Not Authorized to Register Courses</td></tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    <div><input type="submit" name="save" value="Save" /></div>
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


<!--    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>-->


    <!--inline scripts related to this page-->

    <script type="text/javascript">
//      $(function() {
//        var oTable1 = $('#sample-table-2').dataTable( {
//          "aoColumns": [
//            { "bSortable": true },
//            null, null, null,
//            { "bSortable": false }
//          ] } );
//			
//        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
//        function tooltip_placement(context, source) {
//          var $source = $(source);
//          var $parent = $source.closest('table')
//          var off1 = $parent.offset();
//          var w1 = $parent.width();
//			
//          var off2 = $source.offset();
//          var w2 = $source.width();
//			
//          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
//          return 'left';
//        }
//      })
    </script>