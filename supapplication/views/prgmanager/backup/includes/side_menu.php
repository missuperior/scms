
<div class="sidebar" id="sidebar">

    <?php $controller =  $this->uri->segment(1); ?>
    <?php $methd      =  $this->uri->segment(2); ?>

    
    <ul class="nav nav-list">
        <li <?php echo $methd == 'dashboard' ? 'class="active" ' : ''; ?> > 
            <a href="<?php echo base_url(); ?>admin/dashboard">
                <i class="icon-dashboard"></i>
                <span class="menu-text"> Dashboard</span>
            </a>
        </li>

      <?php if ($this->session->userdata('account_role_id') == 6) {

       ?>  
        
        
        <li <?php if($controller == 'programmanagers')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Prog Manager </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
              
              
                <li <?php  if($methd == 'sub_dashboard') echo  'class="active open" ' ;?> > 
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Course Structure
                        <b class="arrow icon-angle-down"></b>
                    </a>

                    <ul class="submenu">
                                                                   
                        
                        <li <?php if($methd == 'sub_dashboard') echo  'class="active" '; ?> > 
                            <a href="<?php echo base_url()?>programmanagers/sub_dashboard">
                                <i class="icon-leaf"></i>
                                Define Structure
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