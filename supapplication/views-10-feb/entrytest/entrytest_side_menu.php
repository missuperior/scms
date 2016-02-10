
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
        
        <li <?php  if($this->uri->segment(1) == 'entrytest' && $methd == 'add_room_form' || $methd == 'allocate_room_form' || $methd == 'add_entrytest_result_form' || $methd == 'view_allocated' || $methd == 'view_rooms' || $methd == 'add_test_form' || $methd == 'view_tests' ) {echo  'class="active open"' ;}?> > 

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
                            <a href="<?php echo base_url()?>entrytest/add_room_form">
                                <i class="icon-leaf"></i>
                                Add New Room
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'view_rooms' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/view_rooms">
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
                            <a href="<?php echo base_url()?>entrytest/add_test_form">
                                <i class="icon-leaf"></i>
                                Add New Test
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'view_tests' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/view_tests">
                                <i class="icon-leaf"></i>
                                View All Tests
                            </a>  
                        </li> 
                    </ul>
                </li>         
                
                <!--                for room allocation -->
                
                <li <?php  if($controller == 'entrytest' && $methd == 'allocate_room_form' || $methd == 'view_allocated' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Room Allocation
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'allocate_room_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/allocate_room_form">
                                <i class="icon-leaf"></i>
                                Allocate Room
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'view_allocated' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/view_allocated">
                                <i class="icon-leaf"></i>
                                View Allocated Rooms
                            </a>  
                        </li> 
                    </ul>
                </li>         
                
                
                <!--                for entry test reports  -->
                
                <li <?php  if($controller == 'entrytest' && $methd == 'program_room_report_form' || $methd == 'students_list_form' || $methd == 'award_list_form' || $methd == 'attendance_form'  ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Entry Test Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                
                         <li <?php echo $methd == 'program_room_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/program_room_report_form">
                                <i class="icon-leaf"></i>
                                Room Report (Program)
                            </a>
                        </li>   
                        
                         <li <?php echo $methd == 'students_list_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/students_list_form">
                                <i class="icon-leaf"></i>
                                Room Wise Students List
                            </a>
                        </li>   
                         <li <?php echo $methd == 'attendance_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/attendance_form">
                                <i class="icon-leaf"></i>
                                Student Attendance
                            </a>
                        </li>   
<!--                         <li <?php echo $methd == 'award_list_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/award_list_form">
                                <i class="icon-leaf"></i>
                                Award List
                            </a>
                        </li>   -->
                       
                    </ul>
                   
                                            
                     
                </li>         
                
                
                <li <?php  if($controller == 'entrytest' && $methd == 'add_entrytest_result_form' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Data Entry
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                
                         <li <?php echo $methd == 'add_entrytest_result_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>entrytest/add_entrytest_result_form">
                                <i class="icon-leaf"></i>
                                Add Result
                            </a>
                        </li> 
                    </ul>
                </li>         
                
                
                
            </ul>
            
        
            
        </li> 
        
        
        
        
        
        <!--  *****     END ENTRY TEST    *****  -->
        
        
        
        
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>