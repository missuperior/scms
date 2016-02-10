<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Accounts </a>
            </li>						
        </ul><!--.breadcrumb-->

    </div>

    <div class="page-content">	        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->
                <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                
                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Student Package Info</h3>
                                    </div>

                                    <?php $no_of_installments =  count($std_installments); ?>
                                    
                                    <table class="table table-striped table-bordered table-hover">
                                       
                                        
                                        <tbody>
                                        
                                            <tr>                                                                        
                                                <th>Name</th>
                                                <td><?php echo $std_package[0]['student_name'];?></td>                                        
                                                
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Roll No</th>
                                                <td><?php echo $std_package[0]['roll_no'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Program</th>
                                                <td><?php echo $std_package[0]['program_name'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Batch</th>
                                                <td><?php echo $std_package[0]['batch_type'].' '.$std_package[0]['batch'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Session</th>
                                                <td><?php echo $std_package[0]['session'];?></td>                                                                         
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Admission Fee</th>
                                               <td><?php echo $std_package[0]['admission_fee'];?></td>                                                                                
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Misc Fee</th>
                                               <td><?php echo $std_package[0]['misc_fee'];?></td>                                                                                
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Session Fee</th>
                                               <td><?php echo $std_package[0]['session_fee'];?></td>                                                                                
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Session Package</th>
                                               <td><?php
                                               if($no_of_installments > 0){
                                                        echo $std_package[0]['session_total_package'];
                                               }else{
                                                      echo $std_package[0]['session_total_package']+$std_package[0]['admission_fee'];
                                               }?>
                                               </td>
                                            </tr>
                                            
                                            <tr>                                                                        
                                                <th>Challan Fee</th>
                                               <td><?php echo $installment[0]['payable'];?></td>                                                                                
                                            </tr>
                                          
                                            
                                        </tbody>
                                    </table>                                                               
                                </div>
                            </div>
                        </div>  
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">Add Fine</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div class="row-fluid">													
                                       <hr />
                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                              
                                                <form class="form-horizontal" id="cityform" method="POST" action="<?php echo base_url()?>accounts/add_fine2"  enctype="multipart/form-data" />

                                                <div class="control-group">
                                                    <label class="control-label" for="city">Fine :</label>

                                                    <div class="controls">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="number" name="fine" id="fine" class="span5" />
                                                            <input style="width: 188px;" type="hidden" name="pre_fine" id="pre_fine" class="span5" value="<?php echo $installment[0]['fine'];?>" />
                                                            <input style="width: 188px;" type="hidden" name="payable" value="<?php echo $installment[0]['payable'];?>" id="payable" class="span5" />
                                                            <input style="width: 188px;" type="hidden" name="id" id="id" value="<?php echo $installment[0]['installment_id'];?>"  class="span5" />
                                                            <input style="width: 188px;" type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>"  class="span5" />
                                                        </div>
                                                    </div>
                                                </div> 
                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px; margin-left: 40px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">Due Date: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 190px;" type="text" name="due_date" id="due_date" value="<?php echo $due_date; ?>" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                                
                                                <h3 style="margin-top: 20px" class="lighter block green">FOR CHALLAN POSTING</h3>   
                                
                                
                                                <?php if($this->session->userdata('role') == 'HOD'){?>
                                                 <div class="control-group" style="margin-left: 40px;">
                                                    <label style="width: 130px; " class="control-label" for="email">Type:</label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select onchange="slipNo(this.value);" style="width: 190px;" id="type" name="type" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <option value="Bank - 00020081079384021">Bank Al-Habib
                                                                <option value="Bank - 50097900192755">Bank HBL
                                                                <option value="Cash">Cash
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>  
                                                <?php }else{?>
                                                <div class="control-group" style="margin-left: 40px;">
                                                    <label style="width: 130px; " class="control-label" for="email">Type:</label>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select onchange="slipNo(this.value);" style="width: 190px;" id="type" name="type" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                <option value="Bank">Bank                                                                
                                                                <option value="Cash">Cash
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>  
                                                <?php }?>
                                
                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px; margin-left: 40px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Slip No: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 190px;" type="number" name="slip_no" id="slip"  class="span4"  readonly/>
                                                            <input style="width: 190px;" type="hidden" value="<?php echo $installment[0]['challan_id']; ?>" name="challan_id" id="challan_id"  class="span4"  readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                  
                                
                                
                                                <div style="width: 100%; float: left;margin-bottom: 15px; margin-left: 40px" class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">Post Date: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 190px;" type="text"  name="post_date" id="post_date" value="" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                
                                
                                
                                            </div>

                                            <hr />
                                            <div class="row-fluid wizard-actions">
                                                <input onclick="return confirm('Are You Sure ?');" value="Save" type="submit" name="save" class="btn btn-success btn-next" data-last="Finish ">
                                                    
                                                <input onclick="return validate();"  value="Save & Post" type="submit" name="post" class="btn btn-success btn-next" data-last="Finish ">
                                                    
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!--/.span-->
                    </div><!--/.row-fluid-->
                </div><!--/.page-content-->

            </div><!--/.main-content-->
        </div><!--/.main-container-->    

        
        
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


        <script type="text/javascript">
            $('#cityform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    fine: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admin/add_city";
                    document.validationForm.submit();
                }
            });


            function slipNo(val,id)
            {

                if(val == 'Bank')
                {          
                    $("#slip").prop('readonly', true);
                }
                if(val == 'Cash')
                {          
                    $("#slip").prop('readonly', false);
                }


            }
            
            function validate()
            {
                var post_date = $("#post_date").val();
                if(post_date == '')
                {
                    alert('Please Select The Post Date');
                    return false;
                }else{
                    $("#cityform").submit();
                }
            }
            

        </script>   