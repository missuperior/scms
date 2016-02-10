<div class="main-content">
  <div class="breadcrumbs" id="breadcrumbs">
    <ul class="breadcrumb">
      <li>
        <a href="#">ADMISSIONS</a>                
      </li>            
    </ul><!--.breadcrumb-->

    
  </div>

  <div class="page-content">
    <div class="page-header position-relative">
      <h1>
        STUDENT PACKAGE FORM
      </h1>
    </div><!--/.page-header-->

    <div class="row-fluid">
      <div class="span12" >
        <!--PAGE CONTENT BEGINS-->

        <h4 class="lighter" >                    
          <a href="#modal-wizard" data-toggle="modal" class="pink"> 
            
            <?php echo $this->session->userdata('error_msg');

            $this->session->unset_userdata('error_msg'); ?> </a>

           
            <?php echo $this->session->userdata('success_msg');
            $this->session->unset_userdata('success_msg'); ?> </a>

        </h4>

        <div class="hr hr-18 hr-double dotted"></div>

        <div class="row-fluid">
          <div class="span12">
            <div class="widget-box">
                
                <div class="table-header">
                                       <h3>Student Info</h3>
                                    </div>

                                    <table class="table table-striped table-bordered table-hover">
                                       
                                        
                                        <tbody>
                                        
                                            <tr>                                                                        
                                                <th>Name</th>
                                                <td><?php echo $std_info[0]['student_name'];?></td>                                        
                                                
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Roll No</th>
                                                <td><?php echo $std_info[0]['roll_no'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Program</th>
                                                <td><?php echo $std_info[0]['program_name'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Batch</th>
                                                <td><?php echo $std_info[0]['batch_type'].' '.$std_info[0]['batch'];?></td>                                        
                                            </tr>
                                        </tbody>
                                    </table>
                
                
              <?php if(count($package) > 0){?>  
              <div class="widget-header widget-header-blue widget-header-flat">
                <h4 class="lighter">ADD STUDENT PACKAGE</h4>                               
              </div>

              <div class="widget-body">
                <div class="widget-main">

                  <div class="row-fluid">

                    <form class="form-horizontal" id="studentform" method="POST" action="<?php echo base_url(); ?>accounts/add_student_package2" enctype="multipart/form-data" />

                    <div class="step-content row-fluid position-relative" id="step-container">
                      <div class="step-pane active" id="step1">


                        <!-- *************************************    Start Student Table Information  *************************************************** -->
                   

                        <input style="width: 120px; " type="hidden" name="program_id" id="program_id" value="<?php echo $package[0]['program_id'];?>" class="span6"  /> 
                        <input style="width: 120px; " type="hidden" name="student_id" id="student_id" value="<?php echo $package[0]['student_id'];?>" class="span6"  /> 
                        <input style="width: 120px; " type="hidden" name="session_id" id="session_id" value="<?php echo $package[0]['current_session_id'];?>" class="span6"  /> 
                        <input style="width: 120px; " type="hidden" name="campaign_id" id="campaign_id" value="<?php echo $std_info[0]['campaign_id'];?>" class="span6"  /> 
                        
                        <div  class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Admission Fee: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                        <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <input style="width: 120px; " type="text" name="admission_fee" id="admission_fee" value="<?php echo $package[0]['admission_fee'];?>" class="span6"  readonly/> - 
                                <input style="width: 140px;" type="text" name="admission_discount1" id="admission_discount1" value="" class="span6" maxlength="5" placeholder="Discount(e.g 5000)" /> - 
                                <input style="width: 140px;" type="text" name="admission_discount2" id="admission_discount2" value="" class="span6" maxlength="3"  placeholder="Discount(e.g 25%)" readonly />% - 
                                <input style="width: 120px;" type="text" name="admission_payable" id="admission_payable" value="<?php echo $package[0]['admission_fee'];?>" class="span6" placeholder="Payable"  readonly/>
                            </div>
                          </div>
                        </div>
                       
                        <div  class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Session Fee: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                        <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <input style="width: 120px; " type="text" name="session_fee" id="session_fee" value="<?php echo $package[0]['session_fee'];?>" class="span6"  readonly/> - 
                                <input style="width: 140px;" type="text" name="session_discount1" id="session_discount1" value="" class="span6" maxlength="5" placeholder="Discount(e.g 5000)" /> - 
                                <input style="width: 140px;" type="text" name="session_discount2" id="session_discount2" value="" class="span6" maxlength="3" placeholder="Discount(e.g 25%)"  readonly/>% - 
                                <input style="width: 120px;" type="text" name="session_payable" id="session_payable" value="<?php echo $package[0]['session_fee'];?>" class="span6" placeholder="Payable"  readonly/>
                            </div>
                          </div>
                        </div>
                       
                        <div  class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Misc Fee: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                        <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <input style="width: 120px; " type="text" name="misc_fee" id="misc_fee" value="<?php echo $package[0]['misc_fee'];?>" class="span6"  readonly/> - 
                                <input style="width: 140px;" type="text" name="misc_discount1" id="misc_discount1" value="" class="span6" maxlength="5" placeholder="Discount(e.g 5000)" /> - 
                                <input style="width: 140px;" type="text" name="misc_discount2" id="misc_discount2" value="" class="span6" maxlength="3" placeholder="Discount(e.g 25%)" readonly/>% - 
                                <input style="width: 120px;" type="text" name="misc_payable" id="misc_payable" value="<?php echo $package[0]['misc_fee'];?>" class="span6" placeholder="Payable"  readonly/>
                            </div>
                          </div>
                        </div>
                       
                        <div  class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Total Package: <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                          <?php 
                                $total =     $package[0]['admission_fee'] + $package[0]['session_fee'] + $package[0]['misc_fee'] ;
                          
                          ?>
                          
                          
                        <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <input style="width: 120px; " type="text" name="total_package" id="total_package" value="<?php echo $total;?>" class="span6" readonly /> 
                            </div>
                          </div>
                        </div>
                       
                        <div  class="control-group">
                          <label style="width: 130px;" class="control-label" for="email">Remarks: </label>

                        <div class="controls" style="margin-left: 140px;">
                            <div class="span12">
                                <textarea style="width:547px; height: 75px" name="remarks" id="remarks" ></textarea>
                                <input  type="hidden" name="no_of_sessions" id="no_of_sessions" value="<?php echo $package[0]['no_of_sessions'];?>" class="span6"  /> 
                            </div>
                          </div>
                        </div>
                       

                       
                        <!-- *************************************    End Student table Information  *************************************************** -->

                      </div>

                    </div>

                    <hr />
                    <div class="row-fluid wizard-actions">
                      <button class="btn btn-success btn-next" data-last="Finish ">
                        Save                                            
                      </button>
                    </div>
                    </form>
                  </div>
                </div><!--/widget-main-->
              </div><!--/widget-body-->
              <?php }else{?>
                         <div class="widget-header widget-header-blue widget-header-flat">
                            <h4 class="lighter">Package Info Not Added, Please contact Soft Support on 0340-5199388, 0340-5199389</h4>                               
                        </div>
              <?php }?>
              
              
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
  
  
   // for auto calculate discount ON Admission Fee in %
                 
                  $("#admission_discount1").keyup(function () {
                                                    
                      var admissionfee              = $("#admission_fee").val();
                      var discount1                 = $("#admission_discount1").val();
                      
                      var diff                      = +discount1 - +admissionfee;
                      if(diff > 0)
                      {
                          alert('You cannot enter discount greater than fee');
                          $("#admission_discount1").val('');
                          $("#admission_discount1").focus();
                          
                                                    
                      }else
                      {
                            var discount2                 = +discount1 / +admissionfee * +100;
                            var payable                   = +admissionfee - +discount1;

                            discount2 = discount2.toFixed(2);
                            var sessionfee              = $("#session_fee").val();
                            var miscfee                 = $("#misc_fee").val();
                            var total                   = +payable + +sessionfee + +miscfee;

                            $("#admission_discount2").val(discount2);
                            $("#admission_payable").val(payable);
                            $("#total_package").val(total);
                      }
                      
                  });

  
  
   // for auto calculate discount ON Session Fee in %
                 
                  $("#session_discount1").keyup(function () {
                                                    
                      var sessionfee              = $("#session_fee").val();
                      var discount1                 = $("#session_discount1").val();
                      var diff                      = +discount1 - +sessionfee;
                      if(diff > 0)
                      {
                          alert('You cannot enter discount greater than fee');
                          $("#session_discount1").val('');
                                                 
                      }else
                      {
                        
                            var discount2                 = +discount1 / +sessionfee * +100;
                            var payable                   = +sessionfee - +discount1;

                            discount2 = discount2.toFixed(2);
                            
                            //var total = $("#admission_payable").val();
                            var admission               = $("#admission_payable").val();
                            var miscfee                 = $("#misc_fee").val();
                            var total                   = +payable + +admission + +miscfee;                                                        
                            
                            $("#session_discount2").val(discount2);
                            $("#session_payable").val(payable);
                            $("#total_package").val(total);
                      }
                        
                  });

  

  
   // for auto calculate discount ON Misc Fee in %
                 
                  $("#misc_discount1").keyup(function () {
                                                    
                      var miscfee              = $("#misc_fee").val();
                      var discount1                 = $("#misc_discount1").val();
                      var diff                      = +discount1 - +miscfee;
                      if(diff > 0)
                      {
                          alert('You cannot enter discount greater than fee');
                          $("#misc_discount1").val('');
                          $("#misc_discount1").focus();
                          
                                                    
                      }else
                      {
                        
                            var discount2                 = +discount1 / +miscfee * +100;
                            var payable                   = +miscfee - +discount1;

                            discount2    = discount2.toFixed(2);
                            
                            $("#misc_discount2").val(discount2);
                            $("#misc_payable").val(payable);
                            
                            
                            var total1    = $("#admission_payable").val();
                            var total2    = $("#session_payable").val();
                            var total3    = $("#misc_payable").val();
                            
                            total        = +total1 +  +total2 + +total3;
                            
                            $("#total_package").val(total);
                      }
                        
                  });
</script>
<!-- *******  End for Date picker  *******-->
