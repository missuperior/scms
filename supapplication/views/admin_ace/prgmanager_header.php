<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SCMS</title>

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/ajax.jquery.min.js"></script>
        
        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!--basic styles-->
<!--        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datepicker.css" />-->
        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css" />

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/chosen.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/daterangepicker.css" />

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/datepicker.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ace-skins.min.css" />

        <!-- default.js (own custom js start)-->
        <script type="text/javascript" src="<?php echo base_url();?>assets/customjs/default.js"></script>        
        <!-- default.js (own custom js end)-->
        
        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    

    <style>
      .nav-search{
         display: none !important;
       }
       .ace-settings-container{
         display: none !important;
       }

    </style>
        
   </head>         
   
        <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="#" class="brand">
                        <b>Superior University Lahore</b>
                    </a><!--/.brand-->

                    <ul class="nav ace-nav pull-right">
                       
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                                <img class="nav-user-photo" src="<?php echo base_url();?>assets/avatars/logo.jpg" />
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?php if($this->session->userdata('sub_login'))
                                        {
                                        echo $this->session->userdata('sub_login');
                                        }else{ 
                                            echo $this->session->userdata('username');                                            
                                        } ?>
                                </span>

                                <i class="icon-caret-down"></i>
                            </a>

                            <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">

                                <li>
                                    <a href="<?php echo base_url(); ?>programmanagers/logout">
                                        <i class="icon-off"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul><!--/.ace-nav-->
                </div><!--/.container-fluid-->
            </div><!--/.navbar-inner-->
        </div>

        <div class="main-container container-fluid">
            <a class="menu-toggler" id="menu-toggler" href="#">
                <span class="menu-text"></span>
            </a>
          
                    <!--[if !IE]>-->
                    
<!--        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>-->

        <script src="<?php echo base_url(); ?>assets/js/jquery-2.0.3.min.js"></script>



        <script type="text/javascript">
            window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
        </script>
        
        <script type="text/javascript">
            if ("ontouchend" in document)
                document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>

        <!--page specific plugin scripts-->

        <script src="<?php echo base_url(); ?>assets/js/fuelux/fuelux.wizard.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/additional-methods.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>