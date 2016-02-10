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

                                <div class="row-fluid">                                    
                        
                                    <?php 
                                    $paid = count($std_installments);
                                    
                                    if($paid > 0){
                                    ?> 
                                    
                                    
                                    <div class="table-header">
                                       <h3>Paid Installments</h3>                                       
                                    </div>
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Challan No</th>
                                                <th>Fee</th>
                                                <th>Fine</th>
                                                <th>Additional Discount</th>
                                                <th>Payable</th>
                                                <th>Session</th>
                                                <th>Due Date</th>                                            
                                                <th>Status</th>                                                
                                              </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                             $payable = 0; $pkg =0; $count = 0; $unpaid = 0;
                                             foreach ($std_installments as $row){
                                               if($row['status'] == 0){ 
                                                   $pkg = $pkg + $row['fee'];
                                                   $count++;
                                               }else{
                                                 $unpaid++; 
                                                  
                                         ?>
                                            <tr>                                                                                        
                                               <td><?php echo $i+1;  ?></td>
                                               <td> <?php echo $row['challan_id'].'c'; ?></td>
                                                <td><?php echo $row['fee']; ?></td>
                                                <td><?php echo $row['fine']; ?></td>
                                                <td><?php echo $row['additional_discount']; ?></td>
                                                <td><?php echo $row['payable']; ?></td>
                                                <td><?php echo $row['session']; ?></td>
                                                <td><?php echo(date("d-M-Y",strtotime($row['due_date']))); ?></td>
                                                <td>
                                                <?php echo 'Paid';?>
                                                
                                                </td>                                                                                              
                                             </tr>
                                           <?php $i++; }}?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php }                                      
                                    ?>
                                         
                                </div>
                            </div>
                  
                    
                    
                    
                    
                    <div class="span12" style="margin:0px;">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">ADD INSTALLMENTS</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">

                                    <div class="row-fluid">

                                        <form class="form-horizontal" id="installmentform" method="POST" action="<?php echo base_url(); ?>accounts/update_installments" enctype="multipart/form-data" />

                                        <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">

                                                <div  class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Student Package: </label>
                                                    <?php if($payable){
                                                        $payablepackage = $package - $payable;
                                                         }else{
                                                             $payablepackage = $package;
                                                         }?>
                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
<!--                                                            <input style="width: 188px; " type="text" name="package" id="package" value="50000" class="span6" readonly/> -->
                                                            <input style="width: 188px; " type="text" name="package" id="package" value="<?php echo $pkg;?>" class="span6" readonly/> 
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
                                                            <select style="width: 188px;" id="session" name="session" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                                 <?php foreach ($sessions AS $row){
                                                                    if($row['session_id'] == $active_session_id){
                                                                    ?>
                                                                <option  value="<?php echo $row['session_id'];?>"><?php echo $row['session'];?></option>
                                                                <?php } }?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <?php 
                                                $j=3;                                                
                                                for($i=0; $i <= $j-$unpaid; $i++){
                                                    if($std_installments[$i]['status'] == 0){
                                                    ?>
                                                
                                                <div  class="control-group" id="div_<?php echo $std_installments[$i]['installment_id']; ?>" >
                                                    
                                                    <label style="width: 130px;" class="control-label" for="email">Installment <?php echo $i; ?> : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 100px; " type="text" name="installment_amount[]" id="<?php echo "installment_amount".$i; ?>" value="<?php echo $std_installments[$i]['fee']; ?>" class="span6" /> - 
                                                            <input style="width: 100px;" type="text" name="fine[]" id="<?php echo "fine".$i; ?>" value="<?php echo $std_installments[$i]['fine']; ?>" class="span6"  placeholder="Fine" /> - 
                                                            <input style="width: 100px;" type="text" name="discount[]" id="<?php echo "discount".$i; ?>" value="<?php echo $std_installments[$i]['fee_discount']; ?>" class="span6"   placeholder="Discount"  />% - 
                                                            <input style="width: 100px;" type="text" name="payable[]" id="<?php echo "payable".$i; ?>" value="<?php echo $std_installments[$i]['payable']; ?>" class="span6" placeholder="Payable"  readonly/> -
                                                            <input style="width: 100px;" type="text" name="due_date[]" id="<?php echo "due_date".$i; ?>" value=""  class="span10 date-picker" placeholder="Due Date" data-date-format="yyyy-mm-dd" readonly />
                                                            <input style="width: 100px;" type="hidden" name="installment_no[]" value="<?php if($std_installments[$i]['installment_no'] == ''){ echo $std_installments[$i-1]['installment_no']+1;}else{ echo $std_installments[$i]['installment_no'];} ?>"  class="span10 date-picker"  />
                                                            
<!--                                                            <a class="red" href="javascript:void(0);" onclick="remove_instl(<?php echo $std_installments[$i]['installment_id']; ?>)">
                                                                    <i class="icon-remove" title="Increment"></i>
                                                             </a>-->
                                                            
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php }else{ $j++; }}?>
                                                
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

            function remove_instl(inst_id){
              //alert(inst_id);
              $("#div_"+inst_id).remove();
              
            }

        </script>  

<script type="text/javascript">
    
    // For INstallment 1

    $("#installment_amount0").keyup(function() {
      //  alert('ajsdklf');
        var packag      = $("#package").val();
        var amount       = $("#installment_amount0").val();       
        
            $("#payable0").val(amount);
      
     });

    $("#fine0").keyup(function() {
        
        var amount       = $("#installment_amount0").val();
        var fine         = $("#fine0").val();
        var payable      = +amount + +fine ;               
            $("#payable0").val(payable);
               
     });

    $("#discount0").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount0").val();
        var fine         = $("#fine1").val();
        var discount     = $("#discount0").val();
        var payable       = +amount + +fine - +discount;
       
            $("#payable0").val(payable);
        
     });
     
        // For INstallment 2

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

 // For INstallment 3

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
     
     
 // For INstallment 4

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
     
 // For INstallment 5

    $("#installment_amount5").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount5").val();       
        
            $("#payable5").val(amount);
      
     });

    $("#fine5").keyup(function() {
        
        var amount       = $("#installment_amount5").val();
        var fine         = $("#fine5").val();
        var payable      = +amount + +fine ;               
            $("#payable5").val(payable);
               
     });

    $("#discount5").keyup(function() {

        var packag      = $("#package").val();
        var amount       = $("#installment_amount5").val();
        var fine         = $("#fine5").val();
        var discount     = $("#discount5").val();
        var payable       = +amount + +fine - +discount;
       
            $("#payable5").val(payable);
        
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
     $("#installment_amount5").keyup(function() {
        var installment4      = $("#installment_amount4").val();        
        if(installment4 == '')
        {
            alert('Please fill the previous Installment First');
            $("#installment_amount5").val('');
            $("#installment_amount4").focus();
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
     
    function chk_installments()
     {
            var pack = document.getElementById("package").value;
//            var pack_r = document.getElementById("package_r").value;
            if($('#installment_amount1').val() !=''){
              
            }
            var ins1 = $('#installment_amount1').val();
            var ins2 = $('#installment_amount2').val();
            
            var pack_r = parseInt(ins1)+parseInt(ins2);
            
            alert(parseInt(pack_r));
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
