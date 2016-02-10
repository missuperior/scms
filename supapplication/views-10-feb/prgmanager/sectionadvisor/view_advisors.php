<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">Advisors List </a>
            </li>						
        </ul><!--.breadcrumb-->
    </div>

    <div class="page-content">	
        
        <div class="page-header position-relative">
            <h1>Advisors List</h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none;" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Advisors List</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
<!--                                                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>programmanagers/view_student_sections" enctype="multipart/form-data" />-->
                                                
                                                
                                                <div id="seccc">
                                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Login Name</th>
                                                                <th>Employee Name</th>
                                                                <th>Role</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                         <?php
                                                             $i = 0;
                                                             foreach ($advisors as $row){?>
                                                            <tr>
                                                                <td><?php echo $i+1;  ?></td>
                                                                <td><?php echo $row['sub_login']; ?></td>
                                                                <td><?php echo $row['employee_name']; ?></td>
                                                                <td><?php echo $row['role']; ?></td>


                                                                <td class="td-actions">
                                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                                        <!--<a class="green" href="<?php echo base_url();?>programmanagers/update_course_offered/<?php echo $row['prg_manager_id']; ?>/<?php echo $row['course_id']; ?>">
                                                                        <a class="green" href="<?php echo base_url();?>programmanagers/update_course_offered/<?php echo $row['prg_manager_id']; ?>">-->
<!--                                                                            <i class="icon-pencil bigger-130"></i>-->
                                                                       <!-- </a>-->
                                                                    </div>                                                   
                                                                </td>                                                 
                                                            </tr>
                                                           <?php $i++; }?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>

                                            <hr />
                                            <div class="row-fluid wizard-actions">
<!--                                                <button class="btn btn-success btn-next" data-last="Finish">
                                                    Save
                                                </button>-->
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
        
       