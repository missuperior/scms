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
                INSTALLMENTS FORM
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink">                        
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> </a>                    
                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">EDIT INSTALLMENT INFORMATION</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                   
                                    <div class="row-fluid">
                                       
                            <form class="form-horizontal" id="installmentform" method="POST" action="<?php echo  base_url()?>admin/update_installment" enctype="multipart/form-data" />

                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                                                                                    

                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Program :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select id="program" name="program" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Program --</option>
                                                                <?php foreach ($programs as $row){?>
                                                                <option <?php if($installment[0]['program_id'] == $row['program_id']) echo 'selected="selected"'; ?> value="<?php echo $row['program_id']?>"><?php echo $row['program_name']?></option> 
                                                                <?php }?>																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Session :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select  id="session" name="session" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Session --</option>
                                                                <?php foreach ($sessions as $row){?>
                                                                <option <?php if($installment[0]['session_id']==$row['session_id']){ echo 'selected="selected"';}?> value="<?php echo $row['session_id']?>"><?php echo $row['session']?></option> 
                                                                <?php }?>																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Student :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select id="student" name="student" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Student --</option>
                                                                <option <?php if($installment[0]['student_id']== 1 ) echo 'selected="selected"';?> value="1">Tariq Mayo </option>
                                                                <option <?php if($installment[0]['student_id']== 2 ) echo 'selected="selected"';?> value="2">Zohaib Yunis</option>                                                                																			
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>
                                                
                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Fee : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="fee" id="fee" value="<?php echo $installment[0]['fee']; ?>"  class="span4" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Fine : </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="fine" id="fine" value="<?php echo $installment[0]['fine']; ?>" class="span4" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;  font-size: 13px;" class="control-label" for="email">Additional Discount : </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="discount" id="discount" value="<?php echo $installment[0]['additional_discount']; ?>"  class="span4" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Payable : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                          <input type="text" name="payable" id="payable" value="<?php echo $installment[0]['payable']; ?>" readonly="readonly" class="span4" />
                                                        </div>
                                                    </div>
                                                </div>
                                                                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="id-date-picker-1">Due Date : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input type="text" name="duedate" id="duedate" value="<?php echo $installment[0]['due_date']; ?>"  class="span4 date-picker" data-date-format="yyyy-mm-dd" />
                                                            <input type="hidden" name="installment_id" value="<?php echo $installment[0]['installment_id']; ?>"  class="span4 date-picker" data-date-format="yyyy-mm-dd" />

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Update                                         
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

		<script src="<?php echo base_url();?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
	
		<script type="text/javascript">
		
                    // for date picker
    
                        $(function() {
				$('.date-picker').datepicker({
                                    changeMonth:true,
                                    changeYear:true
                                });
                                			
			});
                        
                        
                   // for auto calculate payable amount
                 
                  $("#payable").click(function () {
                                                    
                                                    var fee         = $("#fee").val();
                                                    var fine        = $("#fine").val();
                                                    var discount    = $("#discount").val();
                                                    var payable     = +fee + +fine - +discount;
                                                   
                                                    $("#payable").val(payable);
                                                });

		</script>
                
                
                
                <!-- *******  End for Date picker  *******-->





<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#installmentform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    program: {
                        required: true
                    },
                    session: {
                        required: true
                    },
                    student: {
                        required: true
                    },
                    fee: {
                        required: true,
                        number:true
                    },
                    payable: {
                        required: true,
                        number:true
                    },
                    duedate: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>forms/add_initial_form_data";
                    document.validationForm.submit();                }
                
            });

        </script>   