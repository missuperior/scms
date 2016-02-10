<div class="main-content" style="margin: 0px;">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="" style="text-decoration: none">Student List For Registered Courses </a>
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
                                    <?php //if(count($students) > 0 ){ ?>
                                    <div class="table-header">
                                        <h3 id="title">Registered Courses List</h3>
                                    </div>
                                
                                    <a  href="javascript:void(0);">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Roll No</th>
                                                <th>Student Name</th>
<!--                                                <th>Course</th>
                                                <th>Date</th>-->
                                            </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                            $i = 0;
                                            foreach ($stus as $row){?>
                                            <tr>
                                                                                        
                                                <td><?php echo $i+1;  ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
<!--                                                <td><?php echo $row['course_name'].'=='.$row['course_code']; ?></td>
                                                <td><?php echo $row['course_added_date']; ?></td>-->
                                            </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                    <?php //}else{?>
<!--                                    <div class="table-header">
                                       <h3>Record Not Found</h3>
                                    </div>-->
                                    <?php //} ?>
                                </div>
                            </div>
                        </div>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
    </div><!--/.main-content-->
</div><!--/.main-container-->
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.tableTools.js"></script>
