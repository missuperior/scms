
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
        <li <?php echo $methd == 'change_password_form' ? 'class="active" ' : ''; ?> > 
            <a href="<?php echo base_url().$controller; ?>/change_password_form">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Change Password</span>
            </a>
        </li>

        <li <?php  if(($controller == 'advisor') && $methd != 'dashboard'){echo 'class="active open"';}  ?>>

            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Advisor</span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                 <!-- Courses Addition Starts -->
                <li <?php  if(($controller == 'advisor')  && $methd == 'view_students_form' || $methd == 'view_students' || $methd == 'all_reg_students_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Select Students for Courses Offered
                        <b class="arrow icon-angle-down"></b>
                    </a>
 
                    <ul class="submenu">
                        <li <?php echo $methd == 'view_offered_courses_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>advisor/view_students_form">
                                <i class="icon-leaf"></i>
                                Select Students for Courses 
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        
        
        
        
        
        <li class="active open">
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text">Students Courses</span>
                <b class="arrow icon-angle-down"></b>
            </a>
            
            <ul class="submenu">
                 <!-- Courses Addition Starts -->
                <li <?php  if(($controller == 'advisor')  && $methd == 'all_reg_students_form' || $methd == 'student_registered_courses_form' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Registered Students Courses
                        <b class="arrow icon-angle-down"></b>
                    </a>
 
                    <ul class="submenu">
                        <li <?php echo $methd == 'all_reg_students_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>advisor/all_reg_students_form">
                                <i class="icon-leaf"></i>
                                Registered Students Courses
                            </a>
                        </li>
                        <li <?php echo $methd == 'student_registered_courses_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>advisor/student_registered_courses_form">
                                <i class="icon-leaf"></i>
                                Single Student Registered Courses Form
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </li>
        
        <li <?php echo $methd == 'student_list_export_form' ? 'class="active" ' : ''; ?> > 
            <a href="<?php echo base_url().$controller; ?>/student_list_export_form">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Student List Export</span>
            </a>
        </li>
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>
