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
                PACKAGE INSTALLMENTS FORM
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12" >
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter" >                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 

                        <?php echo $this->session->userdata('error_msg');

                        $this->session->unset_userdata('error_msg');
                        ?> </a>


                    <?php echo $this->session->userdata('success_msg');
                    $this->session->unset_userdata('success_msg');
                    ?> </a>

                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">ADD INSTALLMENTS</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">

                                    <div class="row-fluid">

                                        <form class="form-horizontal" id="installmentform" method="POST" action="<?php echo base_url(); ?>accounts_de/add_installments" enctype="multipart/form-data" onsubmit="return chk_installments()"/>

                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <div  class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Student Package: </label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
<!--                                                            <input style="width: 188px; " type="text" name="package" id="package" value="50000" class="span6" readonly/> -->
                                                            <input style="width: 188px; " type="text" name="package" id="package" value="<?php echo $package;?>" class="span6" readonly/> 
                                                            <input style="width: 188px; " type="hidden" name="package_r" id="package_r" value="0"/> 
                                                            <input style="width: 188px; " type="hidden" name="student_id" id="student_id" value="<?php echo $student_id;?>"/> 
                                                            <input style="width: 188px; " type="hidden" name="program_id" id="program_id" value="<?php echo $program_id;?>"/> 
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Session :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="session" name="session" class="select2" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Session --</option>
                                                                 <?php foreach ($sessions AS $row){
                                                                    if($row['session_id'] >= $session_id){
                                                                    ?>
                                                                <option value="<?php echo $row['session_id'];?>"><?php echo $row['session'];?></option>
                                                                <?php } }?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php for($i=1; $i <= 4; $i++){?>
                                                
                                                <div  class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Installment <?php echo $i; ?> : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 100px; " type="text" name="installment_amount[]" id="<?php echo "installment_amount".$i; ?>" value="" class="span6"  onchange="check_package(this.value, this.id, package.value)"/> - 
                                                            <input style="width: 100px;" type="text" name="fine[]" id="<?php echo "fine".$i; ?>" value="" class="span6"  placeholder="Fine" /> - 
                                                            <input style="width: 100px;" type="text" name="discount[]" id="<?php echo "discount".$i; ?>" value="" class="span6"   placeholder="Discount"  />% - 
                                                            <input style="width: 100px;" type="text" name="payable[]" id="<?php echo "payable".$i; ?>" value="" class="span6" placeholder="Payable"  readonly/> -
                                                            <input style="width: 100px;" type="text" name="due_date[]" id="<?php echo "due_date".$i; ?>" value="<?php echo set_value('date'); ?>"  class="span10 date-picker" placeholder="Due Date" data-date-format="yyyy-mm-dd" />
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php } ?>
                                                
                                                <!-- *************************************    End Student table Information  *************************************************** -->

                                            </div>

                                        </div>

                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                            <button class="btn btn-success btn-next" data-last="Finish "  >
                                                Save                                            
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
            $('#installmentform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    session: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                }             
            });
            
            $('.span6').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });

        </script>  

<script type="text/javascript">
    
    // For INstallment 1

    $("#installment_amount1").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount1").val();       
        
            $("#payable1").val(amount);
      
     });

    $("#fine1").keyup(function() {
        
        var amount       = $("#installment_amount1").val();
        var fine         = $("#fine1").val();
        var payable      = +amount + +fine ;               
            $("#payable1").val(payable);
               
     });

    $("#discount1").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount1").val();
        var fine         = $("#fine1").val();
        var discount     = $("#discount1").val();
        var payable       = +amount + +fine - +discount;
       
            $("#payable1").val(payable);
        
     });
     
        // For INstallment 2

    $("#installment_amount2").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount2").val();       
        
            $("#payable2").val(amount);
      
     });

    $("#fine2").keyup(function() {
        
        var amount       = $("#installment_amount2").val();
        var fine         = $("#fine2").val();
        var payable      = +amount + +fine ;               
            $("#payable2").val(payable);
               
     });

    $("#discount2").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount2").val();
        var fine         = $("#fine2").val();
        var discount     = $("#discount2").val();
        var payable       = +amount + +fine - +discount;
       
            $("#payable2").val(payable);
        
     });

 // For INstallment 3

    $("#installment_amount3").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount3").val();       
        
            $("#payable3").val(amount);
      
     });

    $("#fine3").keyup(function() {
        
        var amount       = $("#installment_amount3").val();
        var fine         = $("#fine3").val();
        var payable      = +amount + +fine ;               
            $("#payable3").val(payable);
               
     });

    $("#discount3").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount3").val();
        var fine         = $("#fine3").val();
        var discount     = $("#discount3").val();
        var payable       = +amount + +fine - +discount;
       
            $("#payable3").val(payable);
        
     });
     
     
 // For INstallment 4

    $("#installment_amount4").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount4").val();       
        
            $("#payable4").val(amount);
      
     });

    $("#fine4").keyup(function() {
        
        var amount       = $("#installment_amount4").val();
        var fine         = $("#fine4").val();
        var payable      = +amount + +fine ;               
            $("#payable4").val(payable);
               
     });

    $("#discount4").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount4").val();
        var fine         = $("#fine4").val();
        var discount     = $("#discount4").val();
        var payable       = +amount + +fine - +discount;
       
            $("#payable4").val(payable);
        
     });
     
     
     $("#installment_amount2").keyup(function() {
        var installment1      = $("#installment_amount1").val();        
        if(installment1 == '')
        {
            alert('Please fill the previous Installment First');
            $("#installment_amount2").val('');
            $("#installment_amount1").focus();
        }       
     }); 
     $("#installment_amount3").keyup(function() {
        var installment2      = $("#installment_amount2").val();        
        if(installment2 == '')
        {
            alert('Please fill the previous Installment First');
            $("#installment_amount3").val('');
            $("#installment_amount2").focus();
        }       
     }); 
     $("#installment_amount4").keyup(function() {
        var installment3      = $("#installment_amount3").val();        
        if(installment3 == '')
        {
            alert('Please fill the previous Installment First');
            $("#installment_amount4").val('');
            $("#installment_amount3").focus();
        }       
     }); 
     
     function check_package(installment_v, installment_id, package){
         var total       = $('#package_r').val();
       
         if(parseInt(installment_v) > parseInt(package) ){
             alert("installment can not be greater");
             $('#'+installment_id).val('');
             $('#'+installment_id).focus();
         }else if(parseInt(installment_v) < parseInt(package)){
              
             total           = parseInt(total) + parseInt(installment_v);
             if(parseInt(total) > parseInt(package) ){
                   alert("installments total can not be greater");
                   $('#'+installment_id).val('');
                   $('#'+installment_id).focus();
             }else{
                     $('#package_r').val(total);                      
             
             }
         }else if(parseInt(installment_v) == parseInt(package))
         {
             total           = parseInt(total) + parseInt(installment_v);
             if(parseInt(total) > parseInt(package) ){
                   alert("installments total can not be greater");
                   $('#'+installment_id).val('');
                   $('#'+installment_id).focus();
             }else{
                     $('#package_r').val(total);                      
             
             }
         }
     }
     
    function chk_installments(package, installments_total)
     {
            var pack = document.getElementById("package").value;
            var pack_r = document.getElementById("package_r").value;
            
            if(pack != pack_r)
            {
                alert('Please Complete the Installmenst');
    //             event.preventDefault();
                return false;
            }
           else
             {
               document.installmentform.submit();
             }
        
     }
     
</script>
<!-- *******  End for Date picker  *******-->
