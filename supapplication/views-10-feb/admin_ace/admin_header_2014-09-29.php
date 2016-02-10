<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SSERP</title>

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
                
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-timepicker.css" />
        
        
        <!--    *****************   For Reports Datatable         ***************** -->

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/dataTables.tableTools.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/shCore.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/css/demo.css">
	<style type="text/css" class="init">

	</style>
	


<!--    ***************** END  For Reports Datatable         ***************** -->
        
        

        <!-- default.js (own custom js start)-->
        <script type="text/javascript" src="<?php echo base_url();?>assets/customjs/default.js"></script>        
        <!-- default.js (own custom js end)-->
        
        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    

        <!--    *****************   For Reports Datatable         ***************** -->

    <script>
        var base_url = "<?php echo base_url();?>";        
            </script>
        
	<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/dataTables.tableTools.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/shCore.js"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/demo.js"></script>
	<script type="text/javascript" language="javascript" class="init">
            $(document).ready(function() {
                    //$('#example').DataTable( {
                      //      dom: 'T<"clear">lfrtip',
                        //    bJQueryUI: true,
                            //"bSort": TRUE,                                                        
                          //  tableTools: {
                            //        "sRowSelect": "single"
                            //}
                    //} );
            } );
	</script>
	


<!--    ***************** END  For Reports Datatable         ***************** -->
        

        
        
    <style>
      .nav-search{
         display: none !important;
       }
       .ace-settings-container{
         display: none !important;
       }
       .myspan{
           width:13.1%;*width:13.1%
       }

    </style>
        
   </head>         
   
        <body>
        <div class="navbar">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a href="<?php echo base_url().$this->uri->segment(1); ?>/dashboard" class="brand">
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
                                    <?php $controller = $this->uri->segment(1);
                                        if($controller == 'admission_reports')
                                        {
                                            $controller = 'admission_r';
                                        }
                                    ?>
                                    <a href="<?php echo base_url().$controller?>/change_password_form">
                                        <i class="icon-cog"></i>
                                        Change Password
                                    </a>
                                </li>

                               
                                <li class="divider"></li>

                                <li>
                                    <a href="<?php echo base_url(); ?>admin/logout">
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