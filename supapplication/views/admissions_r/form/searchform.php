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
                <input style="width: 200px;"  type="text"placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                STUDENT FORM
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php
                        echo $this->session->userdata('error_msg');

                        $this->session->unset_userdata('msg');
                        ?> </a>

                    <?php $this->session->unset_userdata('error_msg'); ?> 
                    <?php
                    echo $this->session->userdata('success_msg');
                    $this->session->unset_userdata('success_msg');
                    ?> </a>

                </h4>


                <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Form No</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form class="form-horizontal" id="studentform" method="POST" action="<?php echo base_url(); ?>admission_r/search_form" enctype="multipart/form-data" />

                                <input style="width: 200px;" type="text" name="form_no" id="form_no" value="<?php echo set_value('form_no'); ?>" class="input-medium search-query" placeholder="Enter Form No" />
                                <button class="btn btn-purple btn-small" >
                                    Search
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->  
</div><!--/.main-content-->

<!-- *******************************   Form Validations   ****************************** -->

<script type="text/javascript">
    $('#studentform').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            form_no: {
                required: true
            }
        },
        highlight: function(e) {
            $(e).closest('.control-group').removeClass('info').addClass('error');
        },
        submitHandler: function(form) {
            document.validationForm.action = "<?php echo base_url(); ?>forms/add_studentform";
            document.validationForm.submit();
        }
    });



</script>   