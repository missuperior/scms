<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            
            <a href="<?php echo base_url(); ?>studentoffice/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>  
           
        
         <li <?php if($controller == 'studentoffice' && $methd != 'dashboard')  echo 'class="active open" '; ?> > 
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-money"></i>
                            <span class="menu-text"> Student Office </span>

                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">

                           <li <?php if($methd == 'search_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>studentoffice/search_form">
                                            <i class="icon-leaf"></i>
                                            Search Student
                                        </a>
                           </li>
                            
                           <li <?php if($methd == 'student_list_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>studentoffice/student_list_form">
                                            <i class="icon-leaf"></i>
                                            Student List (Prog Wise)
                                        </a>
                           </li>
                            
                           <li <?php if($methd == 'fail_std_view') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>studentoffice/fail_std_view">
                                            <i class="icon-leaf"></i>
                                            Fail Students List (Campaign Wise)
                                        </a>
                           </li>
                            
                           <li <?php if($methd == 'print_all_cards_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>studentoffice/print_all_cards_form">
                                            <i class="icon-leaf"></i>
                                            Print Student Cards (Prog Wise)
                                        </a>
                           </li>
                            
                           <li <?php if($methd == 'print_single_std_card_form') echo  'class="active" '; ?> > 
                                        <a href="<?php echo base_url()?>studentoffice/print_single_std_card_form">
                                            <i class="icon-leaf"></i>
                                            Print Student Card (Single Student)
                                        </a>
                           </li>
                            
                         </ul>
        </li> 
        
        
         <li <?php if($controller == 'studentoffice' && $methd != 'dashboard')  echo 'class="active open" '; ?> > 
                        <a href="#" class="dropdown-toggle">
                            <i class="icon-money"></i>
                            <span class="menu-text"> Examination </span>

                            <b class="arrow icon-angle-down"></b>
                        </a>

                        <ul class="submenu">

                            <li <?php if ($methd == 'search_result') echo 'class="active" '; ?> > 
                                <a href="<?php echo base_url(); ?>studentoffice/search_result" >
                                    Single Student Result
                                    <b class="arrow icon-angle-down"></b>
                                </a>                                      
                            </li>   

                            <li <?php if ($methd == 'req_search_result') echo 'class="active" '; ?> > 
                                <a href="<?php echo base_url(); ?>studentoffice/req_search_result" >
                                    Required Single Semester Result
                                    <b class="arrow icon-angle-down"></b>
                                </a>                                      
                            </li>     

                            <li <?php if ($methd == 'rang_search_result') echo 'class="active" '; ?> > 
                                <a href="<?php echo base_url(); ?>studentoffice/rang_search_result" >
                                    Required Semesters Result
                                    <b class="arrow icon-angle-down"></b>
                                </a>                                      
                            </li>     
                            
                         </ul>
        </li> 
        
        
        
    </ul>
    
</div>