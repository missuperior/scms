<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">ACCOUNTS</a>                
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
                Print Challan Module
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
          <div class="span12">
            
        <h4 class="lighter">
          <a href="" style="text-decoration: none" class="pink">                       
            <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
          </a>
        </h4>
            <div class="widget-box">
              <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">Print Challan Form</h4>
              </div>

              <div class="widget-body">
                <div class="widget-main">
                  <div class="row-fluid">													
                    <hr />
                    <div class="step-content row-fluid position-relative" id="step-container">
                      <div class="step-pane active" id="step1">

                     <form  class="form-horizontal" id="rollnoForm" method="POST" action="<?php echo base_url(); ?>accounts/print_all_challans" />
                      
                      <?php if($this->session->userdata('role')  == 'HOD'){?>
                        <div class="control-group">
                          <label class="control-label" for="coursecode">Campus :</label>

                          <div class="controls">
                            <div class="span12">
                              <select name="campus" id="campus">                               
                                <?php foreach($campus as $row){ ?>
                                  <option value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                        
                        <div class="control-group">
                          <label class="control-label" for="coursecode">Campaign :</label>

                          <div class="controls">
                            <div class="span12">
                              <select name="campaign" id="campaign">                               
                                <?php foreach($campaign as $row){ ?>
                                  <option value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        
                        <div class="control-group">
                          <label class="control-label" for="coursecode">Shift :</label>

                          <div class="controls">
                            <div class="span12">
                              <select onchange="getProgram(this.value)" style="width: 220px;" id="shift" name="shift" class="chzn-select" data-placeholder="Click to Choose...">                                
                                <option value="">Select</option>
                                <option value="Morning">Morning</option>
                                <option value="Evening">Evening</option>
                                <option value="Weekends">Weekends</option>
                              </select>
                            </div>
                          </div>
                        </div>
                                                
                        <div class="control-group">
                          <label class="control-label" for="coursecode">Program :</label>

                          <div class="controls">
                              <div class="span12" id="prog">
                              <select onchange="proSection(this.value)" name="program" id="program">
                                <option value="">-- Select Program --</option>                                
                              </select>
                            </div>
                          </div>
                        </div>  
                        
                        <div id="section"></div>
                        
<!--                        <div class="control-group">
                          <label class="control-label" for="coursecode">Status :</label>

                          <div class="controls">
                            <div class="span12">
                              <select name="status" id="status">
                                <option value="">-- Select Status --</option> 
                                <option value="1">Paid</option>
                                <option value="0">Unpaid</option>
                                <option value="all">All</option>
                              </select>
                            </div>
                          </div>
                        </div>-->


                        <div class="control-group">
                          <label class="control-label" for="coursecode">Session :</label>

                          <div class="controls">
                            <div class="span12">
                              <select name="session" id="session">                               
                                <?php foreach($sessions as $row){ ?>
                                  <option <?php if($row['active'] == 1)echo 'selected="selected"';?> value="<?php echo $row['session_id'] ?>"><?php echo $row['session'] ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>
                        </div>


                        <div style="width: 100%; float: left;margin-bottom: 15px; margin-left: 30px;" class="control-group">
                            <label style="width: 130px;" class="control-label" for="id-date-picker-1">From Date :</label>

                            <div class="controls" style="margin-left: 150px;">
                                <div class="span12">
                                    <input style="width: 220px;" type="text" name="start_date" id="start_date" value="<?php echo set_value('start_date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                </div>
                            </div>
                        </div>

                        <div style="width: 100%; float: left;margin-bottom: 15px; margin-left: 30px;" class="control-group">
                            <label style="width: 130px;" class="control-label" for="id-date-picker-1">To Date :</label>

                            <div class="controls" style="margin-left: 150px;">
                                <div class="span12">
                                    <input style="width: 220px;" type="text" name="end_date" id="end_date" value="<?php echo set_value('end_date'); ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                </div>
                            </div>
                        </div>

                      <hr />
                      <div class="row-fluid wizard-actions">
                        <button class="btn btn-success btn-next" data-last="Finish ">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div><!--/.span-->
          </div><!--/.row-fluid-->
        </div><!--/.page-content-->

      </div><!--/.main-content-->
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
   
   $(document).ready(function(){
     $('#std_total').hide();
   });
   
            $('#rollnoForm').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    shift: {
                        required: true
                    },
                    program: {
                        required: true
                    },
                    start_date: {
                        required: true
                    },
                    end_date: {
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
            
            
      // get program list shift wise
  function getProgram(value)
  {
    if(value!=""){
      $.ajax({
        type: "POST",
        data:{
          'type':value
        },
        url: "<?php echo base_url(); ?>accounts/get_program_info",
                    
        success:function(data){
          $("#prog").html(data);
          $("#program_to").html(data);
        },
        error: function(){
          alert('Some Error Occured, Please Try Again');
        }
      });
               
    }else{
      alert('Please Select Shift');
    }            
              
  }
  
  function getProgramCode(value)
  {
    var campaign = $('#campaign').val();
    var type = $('#type').val();
    if(campaign == ''){
      $('#campaign').css('border-color', 'red');      
    }else{
    
      $.ajax({
        type: "POST",
        data:{
          'p_id':value,
          'camp':campaign,
          'type':type
        },
        url: "<?php echo base_url(); ?>accounts/get_program_code",
                    
        success:function(data){
          var x = $.parseJSON(data);
          
          $("#p_code").val(x.code);
          $("#std_total").show();
          $("#std_total").val(x.total);
          $("#p_code").val(x.code);
        }
      });           
    }         
  }
  
  function std_roll_no(sec)
  {
    var p_id = $('#program').val();
    
    $.ajax({
        type: "POST",
        data:{
          'prog':p_id,
          'sec':sec
        },
        url: "<?php echo base_url(); ?>accounts/section_existance",
                    
        success:function(data){
          if(data!=''){
            $('#exist').text('Already Exist');
          }else{
            $('#exist').text('');
            var roll_no;
            var str = new Date().getFullYear()+'';
            str= str.match(/\d{2}$/);
            var y = parseInt(str)+1;

            roll_no = y + sec + '01';

            $("#roll_no").val(roll_no);
          }
        }
      });     
  }
  
  function proSection(pid)
  {
    var campaign = $('#campaign').val();
    var campus   = $('#campus').val();
    if(campaign == ''){
      $('#campaign').css('border-color', 'red');      
    }else{
      
    $.ajax({
        type: "POST",
        data:{
          'prog':pid,
          'camp':campaign,
          'campus':campus
        },
        url: "<?php echo base_url(); ?>accounts/get_sections",
                    
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
 
 
 function std_roll_no(sec)
  {
    var pid  = $('#program').val();
    
      $.ajax({
        type: "POST",
        data:{
          'section':sec,
          'prog':pid
        },
        url: "<?php echo base_url(); ?>accounts/get_code_max_roll_no",
                    
        success:function(data){
          $('#roll_no').val(data); 
        }
      });           
              
  }

</script>   