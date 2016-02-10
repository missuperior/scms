<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <?php $controller =  $this->uri->segment(1); ?>
                <?php $methd      =  $this->uri->segment(2); ?>
                <a href="<?php echo base_url().$controller; ?>/dashboard">
                    Home
                </a>
                <span class="divider">
                    <i class="icon-angle-right arrow-icon"></i>
                </span>
            </li>
            <li class="active">Advisor Dashboard</li>
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
            <h1>
                Advisor Dashboard
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <div class="alert alert-block alert-success">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="icon-remove"></i>
                    </button>
                    <?php if($this->session->userdata('error')){ ?>
                    
                        <h4 style="color:red"><?php echo $this->session->userdata('error'); $this->session->unset_userdata('error');?></h4>
                    
                    <?php }else{ ?>
                    <i class="icon-ok green"></i>

                    Welcome to
                    <strong class="green">
                        SCMS
                        <small>(Superior Content Managment System)</small>
                    </strong>
                    ,
                    Powered By Superior Solutionz.
                    
                    <?php }  ?>
                    
                </div>

                <div class="space-6"></div>


                    <div class="vspace"></div>

                    </div><!--/span-->
                </div><!--/row-->

               

                <!--PAGE CONTENT ENDS-->
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
    
