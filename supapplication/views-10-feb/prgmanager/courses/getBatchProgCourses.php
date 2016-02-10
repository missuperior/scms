
        
     
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
                                       <h3>All Courses Added</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Course Name</th>
                                                <th>Course Code</th>
                                                <th>Course Type</th>
                                                <th>Credit Hours</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php $i = 0;
                                                foreach ($courses as $row) { 
                                            ?>
                                            <tr>
                                                <td><label  class="checkbox" style="width: 100%;"><input style="opacity: 1;" type="checkbox" name="allcourses[]"  value="<?php echo $row["course_id"];?>"></label></td>
                                                <td><?php echo $row['course_name'] ?></td>
                                                <td><?php echo $row['course_code'] ?></td>
                                                <td><?php echo $row['course_type'] ?></td>
                                                <td><?php echo $row['credit_hours'] ?></td>
<!--                                                <td ><a target="_blank" style="cursor: pointer" href="<?php echo base_url()?>programmanagers/sectionStudents/?program_id=<?php echo $program_id;?>&section=<?php echo $row['program_section']; ?>&cur_session=<?php echo $cur_session_id;?>">View</a></td>-->
                                            </tr>
                                           <?php $i++; }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                
                </div><!--/.span-->
            </div><!--/.row-fluid-->

