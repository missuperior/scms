<div class="page-content">
        
        <div class="page-header position-relative">
            <h1>
                Student Sections List
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
                                       <h3>All Sections</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Section </th>
                                                <th>View Students</th>
<!--                                                <th>View Teachers</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php $i = 0;
                                                foreach ($sections as $row) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $i+1;  ?></td>
                                                <td><?php echo $row['program_section'] ?></td>
                                                <td ><a target="_blank" style="cursor: pointer" href="<?php echo base_url()?>programmanagers/sectionStudents/?program_id=<?php echo $program_id;?>&section=<?php echo $row['program_section']; ?>&cur_session=<?php echo $cur_session_id;?>">View</a></td>
<!--                                                <td><a target="_blank" style="cursor: pointer" href="<?php echo base_url()?>programmanagers/sectionTeachers/?program_id=<?php echo $program_id;?>&section=<?php echo $row['program_section']; ?>&cur_session=<?php echo $cur_session_id;?>">View</a></td>-->
                                            </tr>
                                           <?php $i++; }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->

