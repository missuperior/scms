<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">FORMS (DETAILED) REPORTS</a>                
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
                Program Wise Report
            </h1>
        </div><!--/.page-header-->
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> </a>
                </h4>
                <div class="hr hr-18 hr-double dotted"></div>            
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Detailed: Gender Wise Report</h4>                               
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                  
                                    <div class="row-fluid">
                                        <form target="_blank" class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission_reports/form_detail_gender_wise_view" enctype="multipart/form-data" />
                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                  
                                                <?php if($this->session->userdata('role') == 'HOD'){ ?>
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campus:<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                          <select style="width: 200px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campus --</option>
                                                                
                                                                <?php foreach ($campus as $row) { ?>
                                                                    <option <?php if (set_value('campus') == $row['campus_id']) echo '"selected=selected"'; ?> value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> 
                                                                <?php } ?>
                                                                    <option value="0">All</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                <?php } ?>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campaign:<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="campaign" name="campaign" class="select2" data-placeholder="Click to Choose...">                                                                
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
                                                                <?php } ?>																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Gender:<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="gender" name="gender" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Gender --</option>
                                                                <option  value="male">Male</option> 
                                                                <option  value="female">Female</option> 
                                                                <!--<option <?php if (set_value('program') == $row['program_id']) echo '"selected=selected"' ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                              
                                                <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">Start Date: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="s_date" id="s_date" value="<?php echo set_value('s_date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="width: 100%; float: left;margin-bottom: 15px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">End Date: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 200px;" type="text" name="e_date" id="e_date" value="<?php echo set_value('e_date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                            <button class="btn btn-success btn-next" data-last="Finish ">
                                                Submit                                          
                                            </button>
                                        </div>
                                     </form>
                                    </div>
                                </div><!--/widget-main-->
                            </div><!--/widget-body-->
                        </div>
                    </div>
                </div>               
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->  
</div><!--/.main-content-->
               <!-- *******  Start for Date picker  *******-->

<script src="<?php echo base_url(); ?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $(function() {
    $('.date-picker').datepicker({
      changeMonth:true,
      changeYear:true
    });  
    $('.date-picker').on('changeDate', function(ev){
    $(this).datepicker('hide');
    });
  });
</script>
<!-- *******  End for Date picker  *******-->

<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#initialform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    campaign: {
                        required: true
                    },                    
                    s_date: {
                        required: true
                    },
                    e_date: {
                        required: true
                    },
                    campus: {
                        required: true
                    }
                },                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }                
            });
        </script>   