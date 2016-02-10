
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

    
        
        <li <?php if($controller == 'examination' && $methd != 'dashboard')  echo 'class="active open" '; ?> > 
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> Examination </span>

                <b class="arrow icon-angle-down"></b>
            </a>
          
            <ul class="submenu">
                            
                <li <?php  if($methd == 'view_students')echo  'class="active" ' ;?> > 
                    <a href="<?php base_url()?>view_students" class="dropdown-toggle">
                        <i class="icon-double-angle-right"></i>
                        Add Result
                        <b class="arrow icon-angle-down"></b>
                    </a>

                              
                </li>
               
            </ul>
        </li> 
       
        
    </ul><!--/.nav-list-->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left"></i>
    </div>
</div>