<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">ACCOUNTS REPORTS</a>                
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
                Bank/Cash Report
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
                                <h4 class="lighter">Program Wise Bank/Cash Report Form</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                   
                                    <div class="row-fluid">
                                        <form target="_blank" class="form-horizontal" id="initialform" method="POST" action="<?php echo base_url()?>account_reports/program_wise_bank_cash_report" enctype="multipart/form-data" />

                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                                                                                    

                                                <?php if($this->session->userdata('role') == 'HOD' || $this->session->userdata('campus_id') == 31){ ?>
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campus:<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                          <select style="width: 200px;" id="campus" name="campus" class="chzn-select" data-placeholder="Click to Choose...">
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
                                                            <select style="width: 200px;" id="campaign" name="campaign" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campaign --</option>
                                                                <?php foreach ($campaign as $row) { ?>
                                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
                                                                 <?php } ?>	
                                                                 <option value="0">All</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Shift :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="shift" name="shift" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Shift --</option>
                                                                <option value="Morning">Morning</option>
                                                                <option value="Evening">Evening</option>
                                                                <option value="Weekends">Weekends</option>                                                                																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                
                                                <div class="control-group">
                                                  <label style="width: 130px;" class="control-label" for="email">Program:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                  <div class="controls" style="margin-left: 140px;">
                                                    <div class="span12">
                                                      <select onchange="proSection(this.value)" style="width: 200px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">
                                                        <option value="">-- Select Program --</option>
                                                        <?php foreach ($program as $row) { ?>
                                                          <option <?php if (set_value('program') == $row['program_id'])
                                                          echo '"selected=selected"' ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                        <?php } ?>																	
                                                        <option value="0">All</option>								
                                                      </select>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                
                                                
                                                 <div style="width: 100%;margin-bottom: 25px; float: left" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Semester:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 200px;" id="session" name="session" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="0">All</option>
                                                                <?php foreach($sessions As $row){?>
                                                                <option value="<?php echo $row['session_id'];?>"><?php echo $row['session'];?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                              
                                              <div class="control-group">
                                                  <label style="width: 130px;" class="control-label" for="email">Type:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                  <div class="controls" style="margin-left: 140px;">
                                                    <div class="span12">
                                                      <select style="width: 200px;" id="type" name="type" class="chzn-select" data-placeholder="Click to Choose...">
                                                        <option value="">-- Select Type --</option>
                                                        <option value="Bank">Bank
                                                        <option value="Bank - 00020081079384021">Bank Al-Habib
                                                        <option value="Bank - 50097900192755">Bank HBL
                                                        <option value="Cash">Cash                                             							
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
                    program: {
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
                    },
                    session:{
                        required:true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }
                
            });
            
  function proSection(pid)
  {
    var campaign = $('#campaign').val();
    if(campaign == ''){
      $('#campaign').css('border-color', 'red');      
    }else{
      
    $.ajax({
        type: "POST",
        data:{
          'prog':pid,
          'camp':campaign
        },
        url: "<?php echo base_url(); ?>accounts/get_multi_sections",
                    
        success:function(data){
          if(data!=''){            
            $('#section').html(data);          
          }else{
            $('#exist').text('No Section Made');
          }
        }
      }); 
    }      
  }

        </script>   