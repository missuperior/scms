<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            
            <a href="<?php echo base_url(); ?>examination/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>
        <?php if($this->session->userdata('role') == 'VIEW'){ ?>
            
            
        <li <?php if ($controller == 'examination') { echo 'class="active open" '; }?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Reports </span>

                <b class="arrow icon-angle-down"></b>
            </a>  
            <ul class="submenu">                                               
                <li <?php if ($methd == 'attendance_sheet_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/attendance_sheet_form" >
                        Attendance Sheet
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                <li <?php if ($methd == 'award_list_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/award_list_form" >
                        Award Sheet
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                          
                                                        
                <li <?php if ($methd == 'search_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/search_result" >
                        Single Student Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>   
                
                <li <?php if ($methd == 'req_search_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/req_search_result" >
                        Required Single Semester Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                
                <li <?php if ($methd == 'rang_search_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/rang_search_result" >
                        Required Semesters Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                
                <li <?php if ($methd == 'subject_wise_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/subject_wise_form" >
                        Subject Wise Report
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                <li <?php if ($methd == 'class_wise_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/class_wise_form" >
                        Class Wise Report
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                          
                <li <?php if ($methd == 'topper_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/topper_form" >
                        Toppers List
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                          
                <li <?php if ($methd == 'failure_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/failure_form" >
                        Failure List
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                          
            </ul>
        </li>
      <?php  }elseif($this->session->userdata('role') == 'VIEW_ACCOUNT'){?>
        
            <li <?php  if($methd == 'view_all_venues') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        (Semester) Date Sheet Module 
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                        
                        <li <?php echo $methd == 'print_rollno_slips_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>examination/print_rollno_slips_form">
                                <i class="icon-leaf"></i>
                                Print Roll No Slips
                            </a>
                        </li>                       
                    </ul>
                </li>
                
                
            <li <?php  if($methd == 'view_all_venues') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        (CR) Date Sheet Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                <ul class="submenu">                        
                        <li <?php if ($methd == 'class_wise_form_cr') echo 'class="active" '; ?> > 
                            <a href="<?php echo base_url(); ?>examination/class_wise_form_cr" >
                                Print Roll No Slips
                                <b class="arrow icon-angle-down"></b>
                            </a>                                      
                        </li>                       
                    </ul>
                </li>
                
               

                
      <?php  }else{?>
        <!-- ***  For Accounts Reports  *** -->
          <li <?php if($controller == 'examination')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-th-list"></i>
                <span class="menu-text"> Examination </span>

                <b class="arrow icon-angle-down"></b>
            </a>
              
            <ul class="submenu">  
                
                <li <?php  if($methd == 'add_course_form' || $methd == 'view_courses') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Course Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_course_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>examination/add_course_form">
                                <i class="icon-leaf"></i>
                                Add Course
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_courses' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>examination/view_courses">
                                <i class="icon-leaf"></i>
                                View Courses
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                <li <?php if ($methd == 'define_structure_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/define_structure_form" >
                        Define Structure
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>               
                <li <?php if ($methd == 'view_structure_form'  ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/view_structure_form" >
                        View Structure
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>               
                <li <?php if ($methd == 'add_result_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/add_result_form" >
                        Add Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>
                
                <li <?php if ($methd == 'add_missed_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/add_missed_form" >
                        Missed / Freeze Result Entry
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>               
                
                <li <?php if ($methd == 'view_result_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/view_result_form" >
                        View Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>               
                           
                <li <?php if ($methd == 'upload_marks_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/upload_marks_form" >
                        Upload Marks
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li> 
            <?php if($this->session->userdata('role') == 'HODD'){?>     
                 <li <?php if ($methd == 'res_search_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/res_search_form" >
                            Edit Single Student Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li> 
            <?php } ?>
                
                 
                <li <?php  if($methd == 'add_datesheet_venue_form' || $methd == 'print_rollno_slips_form' || $methd == 'view_all_venues') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Date Sheet Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_datesheet_venue_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>examination/add_datesheet_venue_form">
                                <i class="icon-leaf"></i>
                                Add Venue
                            </a>
                        </li>                       
                        
                        <li <?php echo $methd == 'view_all_venues' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>examination/view_all_venues">
                                <i class="icon-leaf"></i>
                                View All Venues
                            </a>
                        </li>                       
                        
                        <li <?php echo $methd == 'print_rollno_slips_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>examination/print_rollno_slips_form">
                                <i class="icon-leaf"></i>
                                Print Roll No Slips
                            </a>
                        </li>                       
                    </ul>
                </li>
                           
            </ul>
        </li> 
        
        
        <li <?php if ($controller == 'examination') { echo 'class="active open" '; }?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Reports </span>

                <b class="arrow icon-angle-down"></b>
            </a>  
            <ul class="submenu">                                               
                <li <?php if ($methd == 'attendance_sheet_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/attendance_sheet_form" >
                        Attendance Sheet
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                <li <?php if ($methd == 'award_list_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/award_list_form" >
                        Award Sheet
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                                                                        
                <li <?php if ($methd == 'search_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/search_result" >
                        Single Student Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>   
                
                <li <?php if ($methd == 'req_search_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/req_search_result" >
                        Required Single Semester Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                
                <li <?php if ($methd == 'rang_search_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/rang_search_result" >
                        Required Semesters Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                
                <li <?php if ($methd == 'subject_wise_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/subject_wise_form" >
                        Subject Wise Report
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
                <li <?php if ($methd == 'class_wise_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/class_wise_form" >
                        Class Wise Report
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>  
                
                          
                <li <?php if ($methd == 'topper_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/topper_form" >
                        Toppers List
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>  
                
                           
                <li <?php if ($methd == 'failure_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/failure_form" >
                        Failure List
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>  
                          
            </ul>
        </li>
             
        
        
        
         <li <?php if($controller == 'examination' || $controller == 'teachers' )  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-th-list"></i>
                <span class="menu-text"> CS Examination </span>
                <b class="arrow icon-angle-down"></b>
            </a>
             <ul class="submenu">   
                
                  <li <?php if ($methd == 'all_courses_form' || $methd == 'all_courses' || $methd == 'define_structure_form' || $methd == 'view_structure_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>teachers/all_courses_form" >
                        Define Structure
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>               
                <li <?php if ($methd == 'add_view_result' || $methd == 'add_mid_result_form' || $methd == 'add_final_result_form' || $methd == 'view_mid_result' || $methd == 'view_final_result' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>teachers/add_view_result_form" >
                        Add | View Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li> 
                
                
                <li <?php if ($methd == 'add_single_student_result_form' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>teachers/add_single_student_result_form" >
                        Add Single Student Result
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li> 
                
                
                 
                <li <?php if ($methd == 'cr_search_result_all' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/cr_search_result_all" >
                        Single Student Result (All Subjects)
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>   
                
                <li <?php if ($methd == 'cr_search_result_pass' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/cr_search_result_pass" >
                        Single Student Result (Pass Subjects)
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li> 
            <?php if($this->session->userdata('role') == 'HODD'){?> 
                <li <?php if ($methd == 'res_search_form_cr' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/res_search_form_cr" >
                            Edit Single Student Result (CR)
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>
                
                
                <li <?php if ($methd == 'add_view_result_form_cr' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/add_view_result_form_cr" >
                            Edit / Delete Result Sheet(CR)
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>
                
                
            <?php } ?>
                <li <?php if ($methd == 'class_wise_form_cr' ) echo 'class="active" '; ?> > 
                    <a href="<?php echo base_url();?>examination/class_wise_form_cr" >
                        Class Summary Section Wise
                        <b class="arrow icon-angle-down"></b>
                    </a>                                      
                </li>     
            </ul>
         </li>
        <?php }?>
        
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>