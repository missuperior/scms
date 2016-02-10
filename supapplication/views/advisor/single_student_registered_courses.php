<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Student Registered Courses</a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">

        <div class="page-header position-relative">
            <h1>
                Registered Courses Of a Student
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">
                    <a href="" style="text-decoration: none" class="pink">

                        <?php echo $this->session->userdata('success_msg');
                        $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							

                <div class="row-fluid">
                    <div class="span12">                                                                     

                        <div class="row-fluid">                                    
                            <div class="table-header"> 
                                <h3>All Courses of <b><i><?php echo $student_data[0]['student_name'];?></i></b></h3>
                            </div>

                            <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Course Name</th>
                                        <th>Course Code</th>
                                        <th>Course Section</th>
                                        <th>Update Section</th>
                                        <th>Added Date</th>
                                        <th style="width: 26px;">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $i = 1 ;
                                    foreach ($RegisteredCourse as  $k => $row) {
                                        ?>
                                        <tr id="r<?php echo $i;?>">

                                            <td ><?php echo $k+1; ?></td>
                                            <td><?php echo $row['course_name']; ?></td>
                                            <td><?php echo $row['course_code']; ?></td>
                                            <td id="<?php echo $i.'_oldsection'?>" ><?php echo $row['course_section']; ?></td>
                                            <td id="<?php echo $i.'_newsection'?>" >
                                                
                                                
                                                <select name="newsection" id="dropdown_<?php echo $i; ?>" onchange="update_section('<?php echo $i; ?>','<?php echo $row['student_id']; ?>' , '<?php echo $row['current_session_id']; ?>', '<?php echo $row['program_id']; ?>', '<?php echo $row['batch_id']; ?>', '<?php echo $row['course_section']; ?>', '<?php echo $row['course_id']; ?>' )  ;">
                                                    <option value="0">Update Section1</option>
                                                    <option <?php echo $row['course_section'] =='A' ? 'selected = "selected"' : ''; ?> value="A">A</option>
                                                    <option <?php echo $row['course_section'] =='B' ? 'selected = "selected"' : ''; ?> value="B">B</option>
                                                    <option <?php echo $row['course_section'] =='C' ? 'selected = "selected"' : ''; ?> value="C">C</option>
                                                    <option <?php echo $row['course_section'] =='D' ? 'selected = "selected"' : ''; ?> value="D">D</option>
                                                    <option <?php echo $row['course_section'] =='E' ? 'selected = "selected"' : ''; ?> value="E">E</option>
                                                </select>
                                            </td>
                                            <td><?php echo $row['course_added_date']; ?></td>

                                            <td class="td-actions">
                                                <div class="hidden-phone visible-desktop action-buttons">
<!--                                                    <a class="green" href="javascript:void(0);" onclick="update_section('<?php echo $i; ?>','<?php echo $row['student_id']; ?>' , '<?php echo $row['current_session_id']; ?>', '<?php echo $row['program_id']; ?>', '<?php echo $row['batch_id']; ?>', '<?php echo $row['course_section']; ?>', '<?php echo $row['course_id']; ?>')  ;">
                                                        Update Section
                                                    </a>-->
                                                    <a class="green" href="javascript:void(0);" onclick="rock1('<?php echo $i; ?>','<?php echo $row['student_id']; ?>' , '<?php echo $row['current_session_id']; ?>', '<?php echo $row['program_id']; ?>', '<?php echo $row['batch_id']; ?>', '<?php echo $row['course_section']; ?>', '<?php echo $row['course_id']; ?>')  ;">
                                                        Delete
                                                    </a>                                                       
                                                </div>                                                   
                                            </td>                                                 
                                        </tr>
                                    <?php 
                                        $i++; } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->

</div><!--/.main-content-->
<script type="text/javascript">
    
    
    function rock1(row , student_id , session_id ,program_id , batch_id, section ,course_id){
        $.ajax({
            type:'get',
            data:{
                'student_id'   :student_id,
                'session_id'   :session_id,
                'section'      :section,
                'batch_id'     :batch_id,
                'program_id'   :program_id,
                'course_id'   :course_id
            },
            //url: "<?php echo base_url();?>programmanagers/getofferedProgCourses",
            url: "<?php echo base_url();?>advisor/dstudent_course",
            success:function(data){$("#r"+row).remove();},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
    //function update_section(row , student_id , session_id ,program_id , batch_id, section ,course_id , new_section){
    function update_section(row , student_id , session_id ,program_id , batch_id, section ,course_id ){
        
        var new_section;
        
        new_section = $("#dropdown_"+row).val();
        //alert(new_section);
        $.ajax({
            
            
            type:'get',
            data:{
                'student_id'   :student_id,
                'session_id'   :session_id,
                'section'      :section,
                'batch_id'     :batch_id,
                'program_id'   :program_id,
                'course_id'    :course_id,
                'new_section'  :new_section
            },
            //url: "<?php echo base_url();?>programmanagers/getofferedProgCourses",
            url: "<?php echo base_url();?>advisor/upstudent_course",
            success:function(data){$("#"+row+'_oldsection').html(new_section);},
            error: function(){alert('Some Error Occured, Please Try Again');}
        });
    }
</script>