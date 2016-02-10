<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="#">Home</a>

                <span class="divider">
                    <i class="icon-angle-right arrow-icon"></i>
                </span>
            </li>
            <li class="active">Admission Dashboard</li>
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
                Admission Dashboard
                <small>
                    <i class="icon-double-angle-right"></i>
                    overview &amp; stats
                </small>
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
                    
                    <?php } 
                    
//                    $inquiry_without_pros       = $inquiries - $inquiry_without_pros;
//                    $pros_without_initial       = $prospectus - $pros_without_initial;
//                    $initial_without_detail     = $initial - $initial_without_detail;
//                    $forms_without_student      = $detailed - $forms_without_student;
                    
                    ?>
                    
                </div>

                <div class="space-6"></div>

                <div class="row-fluid">
                    <div class="span7 infobox-container">
                        <div class="infobox infobox-green  ">
                            <div class="infobox-icon">
                                <i class="icon-file-text"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $inquiries; ?></span>
                                <div class="infobox-content">Inquiries</div>
                            </div>
                            
                        </div>

                        <div class="infobox infobox-blue  ">
                            <div class="infobox-icon">
                                <i class="icon-envelope"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $prospectus; ?></span>
                                <div class="infobox-content">Prospectus Sale</div>
                            </div>

                        </div>

                        <div class="infobox infobox-pink  ">
                            <div class="infobox-icon">
                                <i class="icon-copy"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $initial; ?></span>
                                <div class="infobox-content">Initial Forms</div>
                            </div>
                            
                        </div>

                        <div class="infobox infobox-red  ">
                            <div class="infobox-icon">
                                <i class="icon-table"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $detailed; ?></span>
                                <div class="infobox-content">Forms</div>
                            </div>
                        </div>

                        <div class="infobox infobox-orange2  ">
                            <div class="infobox-icon">
                                <i class="icon-user"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $student; ?></span>
                                <div class="infobox-content">Students</div>
                            </div>

                        </div>
                        
                        
                         <div class="infobox infobox-green  ">
                            <div class="infobox-icon">
                                <i class="icon-file-text"></i>
                            </div>

                            <div class="infobox-data">
                                <span class="infobox-data-number"><?php echo $online; ?></span>
                                <div class="infobox-content">Online Inquiries</div>
                            </div>
                            
                        </div>

                        

                        <div class="space-6"></div>

                    </div>

                    <div class="vspace"></div>
                </div><!--/row-->

               

                <!--PAGE CONTENT ENDS-->
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->
    <script>
    
                    
            // get program list shift wise
   function setSearchValue(value)
   {
       $(".type").val(value);              
   }
       
    
    </script>   
    
    

</div><!--/.main-content-->
	<script type="text/javascript">
            
       
</script>


