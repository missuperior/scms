
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Change Password</a>
            </li>						
        </ul><!--.breadcrumb-->

        <div class="nav-search" id="nav-search">
            <form class="form-search" />
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search nav-search-icon"></i>
                </span>
            </form>
        </div><!--#nav-search-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>Change password </h1>
        </div><!--/.page-header-->
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                    <a href="" style="text-decoration: none;" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							
                <form class="form-horizontal" id="courseform" method="POST" action="<?php echo base_url();?>advisor/change_password" enctype="multipart/form-data" />
                <div class="row-fluid">
                    <div class="span12">  
                        
                        
                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                        
                                        <div class="control-group">
                                        
                                             <label class="control-label" for="oldpassword">Old Password</label>
                                             <div class="controls">
                                                 <div class="span12"><input type="password" name="oldpassword" id="oldpassword"/></div>
                                             </div>
                                        </div>
                                    
                                
                                        
                                        <div class="control-group">
                                        
                                            <label class="control-label" for="newpassword">New Password</label>
                                            <div class="controls">
                                                <div class="span12"><input type="password" name="newpassword" id="newpassword"/></div>
                                            </div>
                                        </div>

                                        
                                        <div class="control-group">
                                        
                                            <label class="control-label" for="confirmpassword">Confirm Password</label>
                                            <div class="controls">
                                                <div class="span12"><input type="password" name="confirmpassword" id="confirmpassword"/></div>
                                            </div>
                                        </div>
                                        
                                </div>
                                <div class="row-fluid wizard-actions">
                                    <button data-last="Finish " class="btn btn-success btn-next">
                                        Save
                                    </button>
                                </div>
                        </div>
                        <hr />
                    </form>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
    </div><!--/.main-content-->
</div><!--/.main-container-->    

