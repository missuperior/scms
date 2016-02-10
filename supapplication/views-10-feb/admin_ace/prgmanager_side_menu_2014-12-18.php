
<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            <a href="<?php echo base_url().$controller; ?>/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>

        <li <?php  if(($controller == 'courses' or $controller == 'programmanagers') && $methd != 'dashboard'){echo 'class="active open"';}  ?>>

            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Program Manager</span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                 <!-- Courses Addition Starts -->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_course_form' || $methd == 'view_courses') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Courses Addition
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_courses_offered_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_course_form">
                                <i class="icon-leaf"></i>
                                Add Course
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_offered_courses' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_courses">
                                <i class="icon-leaf"></i>
                                View Courses
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Courses Addition End -->
                
                 <!-- Program Subject of Study Starts -->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_course_of_study_form' || $methd == 'view_course_of_study_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Program Courses of Study 
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_course_of_study_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_course_of_study_form">
                                <i class="icon-leaf"></i>
                                Select Study Courses
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_course_of_study_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_course_of_study_form">
                                <i class="icon-leaf"></i>
                                View Study Courses 
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Program Subject of Study Ends -->
                
                 <!-- Courses Offered Starts -->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_courses_offered_form' || $methd == 'view_offered_courses') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Courses Offered
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_courses_offered_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_courses_offered_form">
                                <i class="icon-leaf"></i>
                                Add Offered Course
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_offered_courses' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_offered_courses">
                                <i class="icon-leaf"></i>
                                View Offered Courses
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Courses Offered End -->
                
            
                 <!-- Curses Module Starts-->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_course_allocation_form' || $methd == 'view_course_allocation') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Courses Allocation
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_course_allocation_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_course_allocation_form">
                                <i class="icon-leaf"></i>
                                Add Allocation
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_course_allocation' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_course_allocation">
                                <i class="icon-leaf"></i>
                                View Allocations
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Courses Module End -->
                
                 <!-- Student reistation in couses-->
<!--                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_student_course_reg_form' || $methd == 'view_student_course_reg') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Registered Students of Courses
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_student_course_reg_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_student_course_reg_form">
                                <i class="icon-leaf"></i>
                                Register Students in a Course
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_student_course_reg' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_student_course_reg">
                                <i class="icon-leaf"></i>
                                View Students of a Course
                            </a>
                        </li>
                    </ul>
                </li>-->
                <!-- Student reistation in couses-->
                
                 <!-- Result Module Starts-->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_result_form' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Results
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_result_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_result_form">
                                <i class="icon-leaf"></i>
                                Add Result
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Result Module End -->
                
                
                  <!-- Result Module Starts-->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_result_form' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Sections
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_result_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_result_form">
                                <i class="icon-leaf"></i>
                                Add Section
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Result Module End -->
                
                
                 
            </ul>
            
        </li>
        
        
         <!--  *****     START ENTRY TEST    *****  -->
        <?php /* ?>
        <li <?php  if($this->uri->segment(1) == 'programmanagers' && $methd == 'add_room_form' || $methd == 'allocate_room_form' || $methd == 'view_allocated' || $methd == 'view_rooms' || $methd == 'add_test_form' || $methd == 'view_tests' ) {echo  'class="active open"' ;}?> > 

            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Entry Test</span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              <!-- Inquiry Reports Starts-->
                <li <?php  if($methd == 'add_room_form' || $methd == 'view_rooms' || $methd == 'edit_room' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Rooms
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_room_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_room_form">
                                <i class="icon-leaf"></i>
                                Add New Room
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'view_rooms' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_rooms">
                                <i class="icon-leaf"></i>
                                View All Rooms
                            </a>  
                        </li> 
                    </ul>
                </li> 
                
                
                 <!-- Inquiry Reports Starts-->
                <li <?php  if($methd == 'add_test_form' || $methd == 'view_tests' || $methd == 'edit_test' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Entry Test
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_test_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_test_form">
                                <i class="icon-leaf"></i>
                                Add New Test
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'view_tests' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_tests">
                                <i class="icon-leaf"></i>
                                View All Tests
                            </a>  
                        </li> 
                    </ul>
                </li>         
                
                <!--                for room allocation -->
                
                <li <?php  if($controller == 'programmanagers' && $methd == 'allocate_room_form' || $methd == 'view_allocated' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Room Allocation
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'allocate_room_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/allocate_room_form">
                                <i class="icon-leaf"></i>
                                Allocate Room
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'view_allocated' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_allocated">
                                <i class="icon-leaf"></i>
                                View Allocated Rooms
                            </a>  
                        </li> 
                    </ul>
                </li>         
                
                
                <!--                for entry test reports  -->
                
                <li <?php  if($controller == 'programmanagers' && $methd == 'program_room_report_form' || $methd == 'students_list_form' || $methd == 'award_list_form' || $methd == 'attendance_form'  ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Entry Test Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                
                         <li <?php echo $methd == 'program_room_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/program_room_report_form">
                                <i class="icon-leaf"></i>
                                Room Report (Program)
                            </a>
                        </li>   
                        
                         <li <?php echo $methd == 'students_list_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/students_list_form">
                                <i class="icon-leaf"></i>
                                Room Wise Students List
                            </a>
                        </li>   
                         <li <?php echo $methd == 'attendance_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/attendance_form">
                                <i class="icon-leaf"></i>
                                Student Attendance
                            </a>
                        </li>   
                         <li <?php echo $methd == 'award_list_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/award_list_form">
                                <i class="icon-leaf"></i>
                                Award List
                            </a>
                        </li>   
                       
                    </ul>
                </li>         
                
                
                
                
            </ul>
        </li> 
      
        
        
        
        
        <!--  *****     END ENTRY TEST    *****  -->
        <!-- Inquiry Reports Starts-->
        <li <?php  if( $this->uri->segment(1) == 'programmanagers' &&  $methd == 'allocate_teacher_to_section_form' || $methd == 'create_student_sections' || $methd == 'view_student_sections_form'  ) echo  'class="active open" ' ;?>>
            <a href="#" class="dropdown-toggle">
                <i class="icon-double-angle-right"></i>
                Student Sections
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                <li <?php echo $methd == 'view_student_sections_form' ? 'class="active" ' : ''; ?>>
                    <a href="<?php echo base_url()?>programmanagers/view_student_sections_form">
                        <i class="icon-leaf"></i>
                        View Sections
                    </a>
                </li>   
                <li <?php echo $methd == 'program_room_report_form' ? 'class="active" ' : ''; ?>>
                    <a href="<?php echo base_url()?>programmanagers/create_student_sections">
                        <i class="icon-leaf"></i>
                        Create Sections
                    </a>
                </li>   
                <li <?php echo $methd == 'program_room_report_form' ? 'class="active" ' : ''; ?>>
                    <a href="<?php echo base_url()?>programmanagers/allocate_teacher_to_section_form">
                        <i class="icon-leaf"></i>
                        Allocate Sections to Teacher
                    </a>
                </li>   
            </ul>
        </li>         
        
        
        <li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> News</span>
                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
                 <!-- Courses Offered Starts -->
                <li <?php  if(($controller == 'programmanagers')  && $methd == 'add_program_news_form' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        News & Announcements
                        <b class="arrow icon-angle-down"></b>
                    </a>
                    <ul class="submenu">
                        <li <?php echo $methd == 'add_program_news_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/add_program_news_form">
                                <i class="icon-leaf"></i>
                                Add News 
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_news' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>programmanagers/view_news">
                                <i class="icon-leaf"></i>
                                View News 
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>