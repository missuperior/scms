
<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            <?php if($controller == 'admission_reports'){
                $controller = 'admission_r';
            } ?>
            <a href="<?php echo base_url().$controller; ?>/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>

      <?php // if($this->session->userdata('admin_id') == 1){?>  
      <?php if($controller == 'admin' && $this->session->userdata('account_role_id') == 1){?>  
        
        <li <?php  if(($controller == 'courses' or $controller == 'admin') && $methd != 'dashboard'){echo 'class="active open"';}  ?>>

            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Admin </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">
                            
                <li <?php  if($methd == 'add_city_form' || $methd == 'view_cities') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        City Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_city_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_city_form">
                                <i class="icon-leaf"></i>
                                Add City
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_cities' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_cities">
                                <i class="icon-leaf"></i>
                                View Cities
                            </a>
                        </li>
                    </ul>
                </li>
                                
                <li <?php  if($methd == 'add_campus_form' || $methd == 'view_campuses') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Campus Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_campus_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_campus_form">
                                <i class="icon-leaf"></i>
                                Add Campus
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_campuses' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_campuses">
                                <i class="icon-leaf"></i>
                                View Campus
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Campaign Module Starts-->
                <li <?php  if($methd == 'add_campaign_form' || $methd == 'view_campaigns') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i> Campaign Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_campaign_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_campaign_form">
                                <i class="icon-leaf"></i>
                                Add Campaign
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_campaigns' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_campaigns">
                                <i class="icon-leaf"></i>
                                View Campaign
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Campaign Module Ends-->

                                            

                
                
                <!-- Semester Module Starts-->
                <li <?php  if($methd == 'add_session_form' || $methd == 'view_sessions') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Session Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_session_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_session_form">
                                <i class="icon-leaf"></i>
                                Add Session
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_sessions' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_sessions">
                                <i class="icon-leaf"></i>
                                View Session
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Semester Module Ends -->

                
                <!-- Bank Module Starts-->
                <li <?php  if($methd == 'add_bank_form' || $methd == 'view_banks') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Bank Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_bank_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_bank_form">
                                <i class="icon-leaf"></i>
                                Add Bank
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_banks' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_banks">
                                <i class="icon-leaf"></i>
                                View Banks
                            </a>
                        </li>
                        
                    </ul>
                    
                </li>
                <!-- Banks Module Ends -->
                
                
                <!-- Bank Module Starts-->
                <li <?php  if($methd == 'add_bank_account_form' || $methd == 'view_bank_accounts') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Bank Accounts
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                        
                        <li <?php echo $methd == 'add_bank_account_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_bank_account_form">
                                <i class="icon-leaf"></i>
                                Add Bank Account
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_bank_accounts' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_bank_accounts">
                                <i class="icon-leaf"></i>
                                View Bank Accounts
                            </a>
                        </li>
                    </ul>
                    
                </li>
                <!-- Banks Module Ends -->
                
                <!-- Section  Module Starts-->
                <li <?php  if($methd == 'add_section_form' || $methd == 'view_sections') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Section Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_section_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_section_form">
                                <i class="icon-leaf"></i>
                                Add Section
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_sections' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_sections">
                                <i class="icon-leaf"></i>
                                View Section
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Section Module Ends -->
                
                <!-- Session  Module Starts-->
                <li <?php  if($methd == 'add_batch_form' || $methd == 'view_batches') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Batch Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_batch_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_batch_form">
                                <i class="icon-leaf"></i>
                                Add Batch
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_batches' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_batches">
                                <i class="icon-leaf"></i>
                                View Batches
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Session Module Ends -->
                                
                 <!-- Reference Module Starts-->
                <li <?php  if($methd == 'add_reference_form' || $methd == 'view_references') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Reference Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_reference_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_reference_form">
                                <i class="icon-leaf"></i>
                                Add Reference
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_references' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_references">
                                <i class="icon-leaf"></i>
                                View Reference
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Reference Module End -->
                
                
                  <!-- Institute Module Starts-->
                <li <?php  if($methd == 'add_institute_form' || $methd == 'view_institutes') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Institute Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_institute_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_institute_form">
                                <i class="icon-leaf"></i>
                                Add Institute
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_institutes' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_institutes">
                                <i class="icon-leaf"></i>
                                View Institutes
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Institute Module End -->
                
                
                 <!-- Program Departments Module Starts-->
                <li <?php  if($methd == 'add_prog_dept_form' || $methd == 'view_prog_depts') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Program Department Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_prog_dept_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_prog_dept_form">
                                <i class="icon-leaf"></i>
                                Add Program Department
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_prog_depts' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_prog_depts">
                                <i class="icon-leaf"></i>
                                View Program Departments
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Program Departments Module End -->
                
                
                 <!-- Program products Module Starts-->
                <li <?php  if($methd == 'add_product_form' || $methd == 'view_products') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Product Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_product_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_product_form">
                                <i class="icon-leaf"></i>
                                Add Product
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_products' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_products">
                                <i class="icon-leaf"></i>
                                View Products
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Program products Module End -->
                
                
                
                <!-- Programs Module Starts-->
                <li <?php  if($methd == 'add_program_form' || $methd == 'view_programs') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Program Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_program_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_program_form">
                                <i class="icon-leaf"></i>
                                Add Program
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_programs' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_programs">
                                <i class="icon-leaf"></i>
                                View Programs
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Programs Module End -->
                
                
                 <!-- Programs Fee Module Starts-->
                <li <?php  if($methd == 'add_program_fee_form' || $methd == 'view_program_fee') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Program Fee Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_program_fee_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/add_program_fee_form">
                                <i class="icon-leaf"></i>
                                Add Program Fee
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_program_fee' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admin/view_program_fee">
                                <i class="icon-leaf"></i>
                                View Program Fees
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Programs Fee Module End -->
                
                 <!-- Curses Module Starts-->
                <li <?php  if($methd == 'add_course_form' || $methd == 'view_courses') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Courses Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_course_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>courses/add_course_form">
                                <i class="icon-leaf"></i>
                                Add Course
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_courses' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>courses/view_courses">
                                <i class="icon-leaf"></i>
                                View Courses
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Courses Module End -->
                
            </ul>
        </li>

      <?php } 
                elseif ($controller == 'accounts_de' || $controller == 'admission' || $controller == 'examination_de' && $this->session->userdata('account_role_id') == 3) {

       ?>  


        <li <?php echo $controller == 'admission' || $controller == 'examination_de' || $controller == 'accounts_de'  ? 'class="active open" ' : ''; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Admissions DE </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              <!-- Inquiry Module Starts-->
                <li <?php  if($methd == 'add_inquiry_form' || $methd == 'view_inquiries') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Inquiry Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_inquiry_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission/add_inquiry_form">
                                <i class="icon-leaf"></i>
                                Add Inquiry
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_inquiries' ? 'class="active" ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission/view_inquiries">
                                <i class="icon-leaf"></i>
                                View Inquiries
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Inquiry Module Ends-->
                
              
                <li <?php  if($methd == 'add_initial_form' || $methd == 'view_initial_forms') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Initial Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_initial_form' ? 'class="active " ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission/add_initial_form">
                                <i class="icon-leaf"></i>
                                Add Initial Form
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_initial_forms' ? 'class="active" ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission/view_initial_forms">
                                <i class="icon-leaf"></i>
                                View Initial Forms
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                <li <?php  if($methd == 'form' || $methd == 'view_student_form' || $methd == 'installments') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Admissions Form
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'form' ? 'class="active" ' : ''; ?> > 
                            <a href="<?php echo base_url()?>admission/form">
                                <i class="icon-leaf"></i>
                                Add Form
                            </a>
                        </li>                                                                                                                                  
                        <li <?php echo $methd == 'view_student_form' ? 'class="active" ' : ''; ?> > 
                            <a href="<?php echo base_url()?>admission/view_student_form">
                                <i class="icon-leaf"></i>
                                View Forms
                            </a>
                        </li>                                                                                                                                  
                        
                        
                    </a>
                        </li>
                    </ul>
                </li>
                <li <?php if ($controller == 'examination_de' && $methd != 'dashboard') echo 'class="active open" '; ?> > 
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-desktop"></i>
                            <span class="menu-text"> Examination </span>

                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">

                            <li <?php if ($methd == 'view_students') echo 'class="active" '; ?> > 
                                <a href="<?php echo base_url()?>examination_de/view_students" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    View Students
                                    
                                </a>


                            </li>
                            
                            <li <?php if ($methd == 'define_structure') echo 'class="active" '; ?> > 
                                <a href="<?php echo base_url()?>examination_de/define_structure" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    Define Structure                   
                                    
                                </a>
                            </li>

                            <li <?php if ($methd == 'view_structure') echo 'class="active" '; ?> > 
                                <a href="<?php echo base_url()?>examination_de/view_structure" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    View Structure                   
                                    
                                </a>
                            </li>

                        </ul>
                    </li> 
               
            </ul>
        </li>                        
      
        
         <?php } 
                elseif ($controller == 'admission_r' && $this->session->userdata('account_role_id') == 3) {

       ?>  
        
        
        <li <?php  if($controller == 'admission_r' && $methd == 'add_inquiry_form' || $methd == 'view_inquiries' || $methd == 'add_prospectus_form' || $methd == 'view_prospectus' || $methd == 'initial_form' || $methd == 'view_initial_forms' || $methd == 'search_form'|| $methd == 'view_student_form') echo 'class="active open"'; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Admissions Reg </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              <!-- Inquiry Module Starts-->
                <li <?php  if($methd == 'add_inquiry_form' || $methd == 'view_inquiries') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Inquiry Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_inquiry_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/add_inquiry_form">
                                <i class="icon-leaf"></i>
                                Add Inquiry
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_inquiries' ? 'class="active" ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission_r/view_inquiries">
                                <i class="icon-leaf"></i>
                                View Inquiries
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Inquiry Module Ends-->
                
              
              <!-- Prospectus Module Starts-->
                <li <?php  if($methd == 'add_prospectus_form' || $methd == 'view_prospectus' || $methd == 'sale_prospectus_form' || $methd == 'sale_prospectus_form2') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Prospectus
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_prospectus_form' ? 'class="active" ' : '';
                                    echo $methd == 'sale_prospectus_form2' ? 'class="active" ' : '';
                                    echo $methd == 'sale_prospectus_form' ? 'class="active" ' : '';
                        ?>>
                            <a href="<?php echo base_url()?>admission_r/add_prospectus_form">
                                <i class="icon-leaf"></i>
                                Sale Prospectus
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_prospectus' ? 'class="active" ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission_r/view_prospectus">
                                <i class="icon-leaf"></i>
                                View Prospectus
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Prospectus Module Ends-->
                
              
                   <li <?php  if($methd == 'add_initial_form' || $methd == 'search_initial_form' || $methd == 'initial_form' || $methd == 'view_initial_forms') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Initial Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'initial_form' ? 'class="active " ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission_r/initial_form">
                                <i class="icon-leaf"></i>
                                Add Initial Form
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_initial_forms' ? 'class="active" ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission_r/view_initial_forms">
                                <i class="icon-leaf"></i>
                                View Initial Forms
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                <li <?php  if($methd == 'form' ||  $methd == 'view_student_form'|| $methd == 'search_form' || $methd == 'installments') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Complete Form
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'form' ? 'class="active" ' : ''; ?> > 
                            <a href="<?php echo base_url()?>admission_r/search_form">
                                <i class="icon-leaf"></i>
                                Add Form
                            </a>
                        </li>                                                                                                                                    
                        
                        <li <?php echo $methd == 'view_student_form' ? 'class="active" ' : ''; ?> > 
                            <a href="<?php echo base_url()?>admission_r/view_student_form">
                                <i class="icon-leaf"></i>
                                View Student Forms
                            </a>
                        </li>
                    </ul>
                </li>
               
            </ul>
        </li> 
        
        <?php if($this->session->userdata('role') == 'HOD'){?>
<!--        <li <?php  if($controller == 'admission_r' && $methd == 'add_user_form' || $methd == 'view_users' || $methd == 'edit_user') echo  'class="active open" ' ;?>> 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> User Management</span>

                <b class="arrow icon-angle-down"></b>
            </a>
            
            <ul class="submenu">
              
               User Management Starts
                <li <?php  if($methd == 'add_user_form' || $methd == 'view_users' || $methd == 'edit_user') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Users Control
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'add_user_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/add_user_form">
                                <i class="icon-leaf"></i>
                                Add user
                            </a>
                        </li>
                        <li <?php echo $methd == 'view_users' ? 'class="active" ' : ''; ?> >
                            <a href="<?php echo base_url()?>admission_r/view_users">
                                <i class="icon-leaf"></i>
                                View Users
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
          
        </li>-->
        <?php } ?>

        
        
         <li <?php if($methd=='campus_wise_form_initial' || $methd=='program_wise_form_initial'|| $methd=='shift_wise_form_initial' || $methd=='reference_wise_form_initial' || $methd=='institute_wise_form_initial' || $methd=='user_wise_form_initial' || $methd=='program_wise_form_summary_initial' || $methd=='user_wise_form_summary_initial' || $methd=='campus_wise_form_analysis') echo 'class="active open"'; ?> > 

         <li <?php  if($this->uri->segment(1) == 'admission_reports' ) {echo  'class="active open"' ;}?> > 

            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Reports</span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              <!-- Inquiry Reports Starts-->
                <li <?php  if($methd == 'campus_wise_form' || $methd == 'user_wise_summary_form' || $methd == 'shift_wise_form' || $methd == 'user_wise_form' || $methd == 'program_wise_form' || $methd == 'gender_wise_form' || $methd == 'reference_wise_form' || $methd == 'institute_wise_form' ||  $methd == 'program_summary_form'  ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Inquiry Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'campus_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/campus_wise_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'shift_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/shift_wise_form">
                                <i class="icon-leaf"></i>
                                Shift Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'program_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_wise_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'gender_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/gender_wise_form">
                                <i class="icon-leaf"></i>
                                Gender Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'reference_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/reference_wise_form">
                                <i class="icon-leaf"></i>
                                Reference Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'institute_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/institute_wise_form">
                                <i class="icon-leaf"></i>
                                Institute Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'user_wise_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/user_wise_form">
                                <i class="icon-leaf"></i>
                                User Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'user_wise_summary_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/user_wise_summary_form">
                                <i class="icon-leaf"></i>
                                Inquiry Summary (User)
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'program_summary_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_summary_form">
                                <i class="icon-leaf"></i>
                                Inquiry Summary (Prog)
                            </a>
                        </li>                        
                    </ul>
                </li>
                <!-- Inquiry Reports Ends-->
     
                
                
              <!-- Prospectus Reports Starts-->
                <li <?php  if($methd == 'campus_wise_form_pros' || $methd == 'shift_wise_form_pros' || $methd == 'program_wise_form_pros' || $methd == 'gender_wise_form_pros' || $methd == 'reference_wise_form_pros' || $methd == 'user_wise_form_pros' ||  $methd == 'prospectus_summary_form' || $methd == 'user_wise_summary_form_pros' || $methd == 'program_wise_summary_form_pros') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Prospectus Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'campus_wise_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/campus_wise_form_pros">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'program_wise_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_wise_form_pros">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'gender_wise_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/gender_wise_form_pros">
                                <i class="icon-leaf"></i>
                                Gender Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'shift_wise_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/shift_wise_form_pros">
                                <i class="icon-leaf"></i>
                                Shift Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'reference_wise_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/reference_wise_form_pros">
                                <i class="icon-leaf"></i>
                                Reference Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'user_wise_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/user_wise_form_pros">
                                <i class="icon-leaf"></i>
                                User Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'user_wise_summary_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/user_wise_summary_form_pros">
                                <i class="icon-leaf"></i>
                                Prospectus Summary (User)
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'program_wise_summary_form_pros' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_wise_summary_form_pros">
                                <i class="icon-leaf"></i>
                                Prospectus Summary (Prog)
                            </a>
                        </li>                        
                    </ul>
                </li>
                <!-- Prospectus Reports Ends-->
                
                
                
                 <li <?php  if($methd == 'campus_wise_form_initial' || $methd == 'shift_wise_form_initial' || $methd == 'program_wise_form_initial' || $methd == 'reference_wise_form_initial' || $methd == 'institute_wise_form_initial' || $methd == 'user_wise_form_initial' || $methd=='program_wise_form_summary_initial' || $methd=='user_wise_form_summary_initial') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Forms (Initial)
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'campus_wise_form_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/campus_wise_form_initial">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'shift_wise_form_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/shift_wise_form_initial">
                                <i class="icon-leaf"></i>
                                Shift Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'program_wise_form_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_wise_form_initial">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>                           
                        <li <?php echo $methd == 'reference_wise_form_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/reference_wise_form_initial">
                                <i class="icon-leaf"></i>
                                Reference Wise
                            </a>
                        </li>                        
                        <li <?php echo $methd == 'institute_wise_form_initial' ? 'class="active" ' : ''; ?>>
                          <a href="<?php echo base_url()?>admission_reports/institute_wise_form_initial">
                                <i class="icon-leaf"></i>
                                Institute Wise
                            </a>
                        </li>                         
                        <li <?php echo $methd == 'user_wise_form_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/user_wise_form_initial">
                                <i class="icon-leaf"></i>
                                User Wise
                            </a>
                        </li>                          
                        <li <?php echo $methd == 'user_wise_form_summary_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/user_wise_form_summary_initial">
                                <i class="icon-leaf"></i>
                                Summary (User)
                            </a>
                        </li>                           
                        <li <?php echo $methd == 'program_wise_form_summary_initial' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_wise_form_summary_initial">
                                <i class="icon-leaf"></i>
                                Summary (Prog)
                            </a>
                        </li>                      
                    </ul>
                </li>
                <!-- Inquiry Reports Ends-->
                
                

                
                <!-- Form Detail Reports Starts-->
                <li <?php if($methd == 'form_detail_prg_wise_form' || $methd == 'form_detail_prg_wise_view' || $methd == 'form_detail_gender_wise_form') echo  'class="active open" '; ?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Forms (Detailed)
                        <b class="arrow icon-angle-down"></b>
                    </a>
                    <ul class="submenu">
                        <li <?php echo $methd == 'form_detail_prg_wise_from' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_prg_wise_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>   
                        
                        <li <?php echo $methd == 'form_detail_gender_wise_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_gender_wise_form">
                                <i class="icon-leaf"></i>
                                Gender Wise
                            </a>
                        </li>   
                        
                        <li <?php echo $methd == 'form_detail_shift_wise_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_shift_wise_form">
                                <i class="icon-leaf"></i>
                                Shift Wise
                            </a>
                        </li>   
                        
                        <li <?php echo $methd == 'form_detail_user_wise_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_user_wise_form">
                                <i class="icon-leaf"></i>
                                User Wise
                            </a>
                        </li>   
                        <li <?php echo $methd == 'form_detail_program_address_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_program_address_form">
                                <i class="icon-leaf"></i>
                                Program-W-Address
                            </a>
                        </li>   
                        <li <?php echo $methd == 'form_detail_summary_user_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_summary_user_form">
                                <i class="icon-leaf"></i>
                                Forms Summary (Usr) 
                            </a>
                        </li>   
                        <li <?php echo $methd == 'form_detail_summary_program_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_summary_program_form">
                                <i class="icon-leaf"></i>
                                Forms Summary (Prg) 
                            </a>
                        </li>
                    </ul>
                </li>
                
                
                
                
                
              <!-- Follow Up Reports Starts-->
                <li <?php  if($methd == 'inquiry2prospectus_form' || $methd == 'prospectus2form_form' || $methd == 'stagereport_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Follow Up Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'inquiry2prospectus_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/inquiry2prospectus_form">
                                <i class="icon-leaf"></i>
                                Inquiry|Prospectus
                            </a>
                        </li>   
                        
                         <li <?php echo $methd == 'prospectus2form_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/prospectus2form_form">
                                <i class="icon-leaf"></i>
                                Prospectus|Form
                            </a>
                        </li>   
                         <li <?php echo $methd == 'stagereport_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/stagereport_form">
                                <i class="icon-leaf"></i>
                                Stage Report
                            </a>
                        </li>   
                        
                    </ul>
                    
                    
                </li>
                <!-- Follow Up Reports Ends-->
                
                
                
                
                <!-- Follow Up Reports Ends-->
                <?php /*<li <?php if($methd == 'form_detail_prg_wise_form' || $methd == 'form_detail_prg_wise_view' || $methd == 'form_detail_gender_wise_form') echo  'class="active open" '; ?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Summary Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>
                    <ul class="submenu">
                        <li <?php echo $methd == 'form_detail_prg_wise_from' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/form_detail_prg_wise_form">
                                <i class="icon-leaf"></i>
                                Summary
                            </a>
                        </li>   
                        <li <?php echo $methd == 'prospectus2form_form' ? 'class="active" ' : ''; ?>>
                            <a style="font-size: 10px;" href="<?php echo base_url()?>admission_reports/prospectus2form_form">
                                <i class="icon-leaf"></i>
                                Summary Again 
                            </a>
                        </li>   
                    </ul>
                </li> */ ?>
                <!-- Follow Up Reports Ends-->
                <!-- Initial report Start -->
    
                
                
                <!-- Initial report Start -->
                <li <?php  if($methd == 'campus_wise_form_analysis') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Analysis Report
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'campus_wise_form_analysis' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/campus_wise_form_analysis">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li> 
                    </ul>
                </li>
                <!-- status Reports Ends-->
                
                
                <!-- Initial report Start -->
                <li <?php  if($methd == 'status_report_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Status Report
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'status_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/status_report_form">
                                <i class="icon-leaf"></i>
                                Status Report
                            </a>
                        </li> 
                    </ul>
                    
<!--                    <ul class="submenu">
                        <li <?php echo $methd == 'status_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/status_report_form">
                                <i class="icon-leaf"></i>
                                Status Report
                            </a>
                        </li> 
                    </ul>-->
                    
                </li>
                <!-- status Reports Ends-->
                
            </ul>
        </li> 
        
        
        
        
        
           <!--  *****     START ENTRY TEST    *****  -->
        
        
        
        <li <?php  if($this->uri->segment(1) == 'admission_r' && $methd == 'award_list_form'  || $methd == 'award_list' || $methd == 'view_marks' || $methd == 'result_summary_program_form' || $methd == 'add_grace_marks_form' || $methd == 'program_detail_info_form' || $methd == 'program_detail_form') {echo  'class="active open"' ;}?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Entry Test</span>

                <b class="arrow icon-angle-down"></b>
            </a>
            <ul class="submenu">
              <li <?php  if($controller == 'admission_r' && $methd == 'award_list_form' || $methd == 'award_list' || $methd == 'view_marks'  ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Entry Test Result
                        <b class="arrow icon-angle-down"></b>
                    </a>
                   <ul class="submenu">                        
                         <li <?php echo $methd == 'award_list_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/award_list_form">
                                <i class="icon-leaf"></i>
                                Award List
                            </a>
                        </li>                          
                         <li <?php echo $methd == 'view_marks' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/view_marks">
                                <i class="icon-leaf"></i>
                                View Result
                            </a>
                        </li>                          
                    </ul>                   
                </li>    
                
              <li <?php  if($controller == 'admission_r' && $methd == 'result_summary_program_form' || $methd == 'add_grace_marks_form' || $methd == 'program_detail_form' || $methd == 'program_detail_info_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Entry Test Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>
                   <ul class="submenu">                        
                         <li <?php echo $methd == 'result_summary_program_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/result_summary_program_form">
                                <i class="icon-leaf"></i>
                                Result Summary (Program)
                            </a>
                        </li>                          
                                              
                         <li <?php echo $methd == 'program_detail_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/program_detail_form">
                                <i class="icon-leaf"></i>
                                Program Wise Detail
                            </a>
                        </li> 
                        
                         <li <?php echo $methd == 'program_detail_info_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/program_detail_info_form">
                                <i class="icon-leaf"></i>
                                Program Wise Detail (Info)
                            </a>
                        </li>   
                        
                         <li <?php echo $methd == 'add_grace_marks_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/add_grace_marks_form">
                                <i class="icon-leaf"></i>
                                Add Grace Marks
                            </a>
                        </li>                          
                                              
                    </ul>                   
                </li>   
                
                
              <li <?php  if($controller == 'admission_r' && $methd == 'add_interview_form' || $methd == 'conducted_interviews' || $methd == 'program_detail_form' ) echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Interview
                        <b class="arrow icon-angle-down"></b>
                    </a>
                   <ul class="submenu">                        
                         <li <?php echo $methd == 'add_interview_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/add_interview_form">
                                <i class="icon-leaf"></i>
                                Add Interview
                            </a>
                        </li>                          
                                              
                         <li <?php echo $methd == 'conducted_interviews' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_r/conducted_interviews">
                                <i class="icon-leaf"></i>
                                Conducted Interviews
                            </a>
                        </li>   
                        
                                      
                    </ul>                   
                </li>         
           </ul>
        </li> 
        
        
        
        
        
        <!--  *****     END ENTRY TEST    *****  -->
        
        <?php } 
                elseif ($controller == 'accounts' && $this->session->userdata('account_role_id') == 4) {
       ?>  
        
        
        <li <?php if($controller == 'accounts')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Accounts </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              
                <li <?php  if($methd == 'view_student_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Student Forms
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'view_student_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/view_student_form">
                                <i class="icon-leaf"></i>
                                View Forms
                            </a>
                        </li>
                    </ul>
                </li>
               
                <li <?php  if($methd == 'view_challan'|| $methd == 'post_challan_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Challan
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'view_challan') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/view_challan">
                                <i class="icon-leaf"></i>
                                View Challan
                            </a>
                        </li>
                        <li <?php if($methd == 'post_challan_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/post_challan_form">
                                <i class="icon-leaf"></i>
                                Post Challan
                            </a>
                        </li>
                    </ul>
                    
                </li>
               
            </ul>
        </li> 
      

        <?php } ?>  
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>