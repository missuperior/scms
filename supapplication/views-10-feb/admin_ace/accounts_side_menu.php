<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            
            <a href="<?php echo base_url(); ?>accounts/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>

        <?php if($this->session->userdata('sub_login') == 'asim.masood' || $this->session->userdata('sub_login') == 'asim_os' || $this->session->userdata('sub_login') == 'audit' || $this->session->userdata('sub_login') == 'audit_os' ){?>
        
        
            <?php if($this->session->userdata('sub_login') == 'asim.masood'){?>
        
                <li <?php if($controller == 'accounts' && $methd != 'dashboard')  echo 'class="active open" '; ?> > 
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-money"></i>
                            <span class="menu-text"> Accounts </span>

                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">


                            <li <?php  if($methd == 'view_student_form'|| $methd == 'view_all_student_form'|| $methd == 'installments' || $methd == 'student_package' || $methd == 'search_form') echo  'class="active open" ' ;?> > 
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    Student Forms
                                    <b class="arrow icon-angle-down"></b>
                                </a>

                                <ul class="submenu">


                                    <li <?php if($methd == 'search_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/search_form">
                                            <i class="icon-leaf"></i>
                                            Search Form
                                        </a>
                                    </li>
                                    <li <?php if($methd == 'view_student_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/view_student_form">
                                            <i class="icon-leaf"></i>
                                            View Forms
                                        </a>
                                    </li>
                                    <li <?php if($methd == 'view_all_student_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/view_all_student_form">
                                            <i class="icon-leaf"></i>
                                            View All Forms
                                        </a>
                                    </li>
                                </ul>
                            </li>

                                                      
                            
                            <li <?php  if($methd == 'view_challan'|| $methd == 'post_challan_form' || $methd == 'challan_issue_form' || $methd == 'print_challan_form' || $methd = "due_date_form" ) echo  'class="active open" ' ;?> > 
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

                                    <li <?php if($methd == 'print_challan_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/print_challan_form">
                                            <i class="icon-leaf"></i>
                                            Print All Challan
                                        </a>
                                    </li>

                                    <li <?php if($methd == 'challan_issue_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/challan_issue_form">
                                            <i class="icon-leaf"></i>
                                            Challan Receiving
                                        </a>
                                    </li>

                                    <li <?php if($methd == 'due_date_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/due_date_form">
                                            <i class="icon-leaf"></i>
                                            Change Due Date
                                        </a>
                                    </li>
                                </ul>

                            </li>

                            <?php //if($this->session->userdata('role') != 'OS'){?>
                             <li <?php  if($methd == 'promote_students_form' ) echo  'class="active open" ' ;?> > 
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    Promote Module
                                    <b class="arrow icon-angle-down"></b>
                                </a>

                                <ul class="submenu">


                                    <li <?php if($methd == 'promote_students_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/promote_students_form">
                                            <i class="icon-leaf"></i>
                                            Promote Students
                                        </a>
                                    </li>  

                                    <li <?php if($methd == 'promote_students_form2') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/promote_students_form2">
                                            <i class="icon-leaf"></i>
                                            Promote MBBS
                                        </a>
                                    </li>                                               
                                </ul>

                            </li>

                            <?php// } ?>

                             <li <?php  if($methd == 'freeze_left_view' ) echo  'class="active open" ' ;?> > 
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    Left | Freeze
                                    <b class="arrow icon-angle-down"></b>
                                </a>

                                <ul class="submenu">


                                    <li <?php if($methd == 'freeze_left_view') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/freeze_left_view">
                                            <i class="icon-leaf"></i>
                                            Left | Freeze
                                        </a>
                                    </li>                                               
                                </ul>

                            </li>

                        </ul>
                    </li>       
        
            <?php } ?>
        
        <!-- ***  For Accounts Reports  *** -->
          <li <?php if($controller == 'account_reports')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-th-list"></i>
                <span class="menu-text"> Reports </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              
                <li <?php  if($methd == 'campus_wise_form'|| $methd == 'program_wise_form' || $methd == 'student_package' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Package Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'campus_wise_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/campus_wise_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'program_wise_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/program_wise_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>
                     </ul>
                    
                </li>
               
                <li <?php  if($methd == 'ins_campus_wise_form'|| $methd == 'non_ins_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Bank / Cash Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'date_wise_bank_cash_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/date_wise_bank_cash_form">
                                <i class="icon-leaf"></i>
                                Date Wise
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'program_wise_bank_cash_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/program_wise_bank_cash_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>
                     </ul>
                    
                </li>
               
                <li <?php  if($methd == 'ins_campus_wise_form'|| $methd == 'non_ins_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Installments Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'ins_campus_wise_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/ins_campus_wise_form">
                                <i class="icon-leaf"></i>
                                Campus/Program Wise
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'non_ins_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/non_ins_form">
                                <i class="icon-leaf"></i>
                                Non Installments
                            </a>
                        </li>
                     </ul>
                    
                </li>
               
                
                 <li <?php  if($methd == 'campus_wise_closing_form') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Month Closing Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                             
                        <li <?php if($methd == 'campus_wise_closing_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/campus_wise_closing_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                 
                     </ul>
                    
                </li>
                
                <li <?php  if($methd == 'received_form') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Monthly Received Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                             
                        <li <?php if($methd == 'received_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/received_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                 
                     </ul>
                    
                </li>
               
                
                <li <?php  if($methd == 'receivable_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Monthly Receivable Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                             
                        <li <?php if($methd == 'receivable_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/receivable_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                 
                     </ul>
                    
                </li>
                
                
                 <!-- Defaulter Reports Starts-->
                <li <?php  if($methd  == 'program_wise_defaulter_summary_form'   || $methd == 'campus_wise_defaulter_form' || $methd == 'program_wise_defaulter_form' || $methd=='campus_wise_cell_defaulter_form' || $methd=='program_wise_defaulter_revenue_form') echo 'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Defaulter Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_defaulter_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_cell_defaulter_form">
                                <i class="icon-leaf"></i>
                                Campus Wise (cell)
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_defaulter_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_cell_defaulter_form">
                                <i class="icon-leaf"></i>
                                Program Wise (cell)
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_defaulter_summary_form">
                                <i class="icon-leaf"></i>
                                Program Wise Summary
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <!-- Defaulter Reports Ends-->
               
                 <!-- Defaulter Revenue Reports Starts-->
                <li <?php  if($methd  == 'campus_wise_defaulter_revenue_form'   || $methd == 'program_wise_defaulter_revenue_form' || $methd == 'campus_wise_revenue_summary_form' ) echo 'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Revenue Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_defaulter_revenue_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_defaulter_revenue_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>                      
                       
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_revenue_summary_form">
                                <i class="icon-leaf"></i>
                                Campus Wise Revenue Summary
                            </a>
                        </li>                      
                       
                    </ul>
                </li>
                <!-- Defaulter Revenue Reports Ends-->
               
                
                <li <?php  if($methd == 'address_form'|| $methd == 'section_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Student Info
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'address_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/address_form">
                                <i class="icon-leaf"></i>
                                Address List
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'section_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/section_form">
                                <i class="icon-leaf"></i>
                                Section List
                            </a>
                        </li>
                         
                        <li <?php if($methd == 'status_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/status_form">
                                <i class="icon-leaf"></i>
                                Status Report
                            </a>
                        </li>
                     </ul>
                    
                </li>
                
           
                <li <?php  if($methd == 'analysis_report_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Analysis Report
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'campus_wise_form_analysis' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>account_reports/analysis_report_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li> 
                    </ul>
                </li>
               
            </ul>
        </li> 
        
        <!-- ***  For Accounts Reports ENd   *** -->
        
        <?php }else{?>
        
        <li <?php if($controller == 'accounts')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-money"></i>
                <span class="menu-text"> Accounts </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              
                <li <?php  if($methd == 'view_student_form'|| $methd == 'view_all_student_form'|| $methd == 'installments' || $methd == 'student_package' || $methd == 'search_form') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Student Forms
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'search_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/search_form">
                                <i class="icon-leaf"></i>
                                Search Form
                            </a>
                        </li>
                        <li <?php if($methd == 'view_student_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/view_student_form">
                                <i class="icon-leaf"></i>
                                View Forms
                            </a>
                        </li>
                        <li <?php if($methd == 'view_all_student_form'|| $methd == 'installments' || $methd == 'student_package') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/view_all_student_form">
                                <i class="icon-leaf"></i>
                                View All Forms
                            </a>
                        </li>
                    </ul>
                </li>
                
                  <li <?php  if($methd == 'add_submitted_fee_form' ) echo  'class="active open" ' ;?> > 
                                <a href="#" class="dropdown-toggle">
                                    <i class="icon-double-angle-right"></i>
                                    Course Registration Module
                                    <b class="arrow icon-angle-down"></b>
                                </a>

                                <ul class="submenu">


                                    <li <?php if($methd == 'add_submitted_fee_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>accounts/add_submitted_fee_form">
                                            <i class="icon-leaf"></i>
                                            Add Student Fee
                                        </a>
                                    </li>
                                </ul>

                            </li>
               
                <li <?php  if($methd == 'view_challan'|| $methd == 'post_challan_form' || $methd == 'challan_issue_form' || $methd == 'print_challan_form' || $methd = "due_date_form" ) echo  'class="active open" ' ;?> > 
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
                        
                        <li <?php if($methd == 'print_challan_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/print_challan_form">
                                <i class="icon-leaf"></i>
                                Print All Challan
                            </a>
                        </li>
                        
                        <li <?php if($methd == 'challan_issue_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/challan_issue_form">
                                <i class="icon-leaf"></i>
                                Challan Receiving
                            </a>
                        </li>
                        
                        <li <?php if($methd == 'due_date_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/due_date_form">
                                <i class="icon-leaf"></i>
                                Change Due Date
                            </a>
                        </li>
                    </ul>
                    
                </li>
                
                <?php //if($this->session->userdata('role') != 'OS'){?>
                 <li <?php  if($methd == 'promote_students_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Promote Module
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'promote_students_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/promote_students_form">
                                <i class="icon-leaf"></i>
                                Promote Students
                            </a>
                        </li>  
                        
                        <li <?php if($methd == 'promote_students_form2') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/promote_students_form2">
                                <i class="icon-leaf"></i>
                                Promote MBBS
                            </a>
                        </li>                                               
                    </ul>
                    
                </li>
                
                <?php// } ?>
               
                 <li <?php  if($methd == 'freeze_left_view' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Left | Freeze
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'freeze_left_view') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>accounts/freeze_left_view">
                                <i class="icon-leaf"></i>
                                Left | Freeze
                            </a>
                        </li>                                               
                    </ul>
                    
                </li>
               
            </ul>
        </li>         
        <!-- ***  For Accounts Reports  *** -->
          <li <?php if($controller == 'account_reports')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-th-list"></i>
                <span class="menu-text"> Reports </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              
                <li <?php  if($methd == 'campus_wise_form'|| $methd == 'program_wise_form' || $methd == 'student_package' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Package Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'campus_wise_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/campus_wise_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'program_wise_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/program_wise_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>
                     </ul>
                    
                </li>
               
                <li <?php  if($methd == 'ins_campus_wise_form'|| $methd == 'non_ins_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Bank / Cash Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'date_wise_bank_cash_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/date_wise_bank_cash_form">
                                <i class="icon-leaf"></i>
                                Date Wise
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'program_wise_bank_cash_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/program_wise_bank_cash_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>
                     </ul>
                    
                </li>
               
                <li <?php  if($methd == 'ins_campus_wise_form'|| $methd == 'non_ins_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Installments Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'ins_campus_wise_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/ins_campus_wise_form">
                                <i class="icon-leaf"></i>
                                Campus/Program Wise
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'non_ins_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/non_ins_form">
                                <i class="icon-leaf"></i>
                                Non Installments
                            </a>
                        </li>
                     </ul>
                    
                </li>
               
                
                 <li <?php  if($methd == 'campus_wise_closing_form') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Month Closing Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                             
                        <li <?php if($methd == 'campus_wise_closing_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/campus_wise_closing_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                 
                     </ul>
                    
                </li>
                
                <li <?php  if($methd == 'received_form') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Monthly Received Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                             
                        <li <?php if($methd == 'received_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/received_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                 
                     </ul>
                    
                </li>
               
                
                <li <?php  if($methd == 'receivable_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Monthly Receivable Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">                             
                        <li <?php if($methd == 'receivable_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/receivable_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>                 
                     </ul>
                    
                </li>
                
                
                 <!-- Defaulter Reports Starts-->
                <li <?php  if($methd  == 'program_wise_defaulter_summary_form'   || $methd == 'campus_wise_defaulter_form' || $methd == 'program_wise_defaulter_form' || $methd=='campus_wise_cell_defaulter_form' || $methd=='program_wise_defaulter_revenue_form') echo 'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Defaulter Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_defaulter_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_cell_defaulter_form">
                                <i class="icon-leaf"></i>
                                Campus Wise (cell)
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_defaulter_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_cell_defaulter_form">
                                <i class="icon-leaf"></i>
                                Program Wise (cell)
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_defaulter_summary_form">
                                <i class="icon-leaf"></i>
                                Program Wise Summary
                            </a>
                        </li>
                       
                    </ul>
                </li>
                <!-- Defaulter Reports Ends-->
               
                 <!-- Defaulter Revenue Reports Starts-->
                <li <?php  if($methd  == 'campus_wise_defaulter_revenue_form'   || $methd == 'program_wise_defaulter_revenue_form' ) echo 'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Revenue Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_defaulter_revenue_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo base_url()?>account_reports/program_wise_defaulter_revenue_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li>  
                        
                        <li>
                            <a href="<?php echo base_url()?>account_reports/campus_wise_revenue_summary_form">
                                <i class="icon-leaf"></i>
                                Campus Wise Revenue Summary
                            </a>
                        </li>                      
                       
                       
                    </ul>
                </li>
                <!-- Defaulter Revenue Reports Ends-->
               
                
                <li <?php  if($methd == 'address_form'|| $methd == 'section_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Student Info
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'address_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/address_form">
                                <i class="icon-leaf"></i>
                                Address List
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'section_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/section_form">
                                <i class="icon-leaf"></i>
                                Section List
                            </a>
                        </li>
                         
                        <li <?php if($methd == 'status_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>account_reports/status_form">
                                <i class="icon-leaf"></i>
                                Status Report
                            </a>
                        </li>
                     </ul>
                    
                </li>
                
           
                <li <?php  if($methd == 'analysis_report_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Analysis Report
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'campus_wise_form_analysis' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>account_reports/analysis_report_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li> 
                    </ul>
                </li>
               
            </ul>
        </li> 
        
        <!-- ***  For Accounts Reports ENd   *** -->
       <?php }?>
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>