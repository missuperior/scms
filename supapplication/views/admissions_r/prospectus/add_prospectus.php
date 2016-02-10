<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">ADMISSIONS</a>                
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
            <h1>
                Prospectus
            </h1>
        </div><!--/.page-header-->

        
        <div class="row-fluid" >
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> </a>
                </h4>
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Inquiry No</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission_r/sale_prospectus_form2" enctype="multipart/form-data" />
                                <input style="width: 188px;" type="text" name="inquiry_no" id="inquiry_no" value="" style="width: 300px;" class="input-medium search-query" placeholder="Enter Inquiry No"/>                                
                                <button class="btn btn-purple btn-small" >
                                    Search
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        
        
    </div><!--/.page-content-->  
</div><!--/.main-content-->




<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#initialform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    inquiry_no: {
                        required: true
                    }
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }
                
            });

        </script>   