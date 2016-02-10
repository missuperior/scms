<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            
            <a href="<?php echo base_url(); ?>audit/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>
        
        
        
        
        
        <!--  ***********************       Admission Reports Start     *****************************-->
        
        
          <li <?php  if($this->uri->segment(1) == 'admission_reports' ) {echo  'class="active open"' ;}?> > 

            <a href="#" class="dropdown-toggle">
                <i class="icon-th-list"></i>
                <span class="menu-text"> Admission Reports</span>

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
                <li <?php  if($methd == 'analysis_report_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Admission Analysis Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'analysis_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/analysis_report_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li> 
                    </ul>
                </li>
                <!-- status Reports Ends-->
                
                
                <!-- Initial report Start -->
                <li <?php  if($methd == 'concession_report_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Concession Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'concession_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/concession_report_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li> 
                    
                        <li <?php echo $methd == 'program_wise_concession_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/program_wise_concession_report_form">
                                <i class="icon-leaf"></i>
                                Program Wise
                            </a>
                        </li> 
                    </ul>
                    
                </li>
                <!-- status Reports Ends-->
                
                
                <!-- Initial report Start -->
                <li <?php  if($methd == 'reference_report_form') echo  'class="active open" ' ;?>>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>

                        Reference  Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                        <li <?php echo $methd == 'reference_report_form' ? 'class="active" ' : ''; ?>>
                            <a href="<?php echo base_url()?>admission_reports/reference_report_form">
                                <i class="icon-leaf"></i>
                                Campus Wise
                            </a>
                        </li> 
                    </ul>
                </li>
                <!-- status Reports Ends-->
                
            </ul>
        </li> 
        
        
        <!--  ***********************       Admission Reports ENd     *****************************-->

        
        <!-- ***  For Audit Reports  *** -->
          <li <?php if($controller == 'account_reports' || $controller == 'audit')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-th-list"></i>
                <span class="menu-text"> Audit Reports </span>

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
                
                   <li <?php  if($methd == 'all_ins_report_form'|| $methd == 'paid_ins_report_form' || $method == 'ins_sum_form' ) echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Student Installment Reports
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'all_ins_report_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>audit/all_ins_report_form">
                                <i class="icon-leaf"></i>
                                All Installments 
                            </a>
                        </li>
                   
                    
                         
                        <li <?php if($methd == 'paid_ins_report_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>audit/paid_ins_report_form">
                                <i class="icon-leaf"></i>
                                Paid Installments
                            </a>
                        </li>
                    
                         
                        <li <?php if($methd == 'ins_sum_form') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>audit/ins_sum_form">
                                <i class="icon-leaf"></i>
                                 Installments Summary
                            </a>
                        </li>
                        
                     </ul>
                    
                </li>
                
           
               
            </ul>
        </li> 
    
        
        <!-- ***  For Audit Reports ENd   *** -->
        
        
        
    
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>