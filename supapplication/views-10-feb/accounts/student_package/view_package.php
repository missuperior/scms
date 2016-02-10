<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Admissions </a>
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
                 Student Package      
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                   </a>
                </h4>							

                <div class="row-fluid">
                    
                    <a  href="<?php echo base_url(); ?>accounts/printStudentInfo/?student_id=<?php echo $std_package[0]['student_id'];?>">
                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                    </a>
                    
                    <div class="span12">                                                                     

                                <div>
                                    
                                    <div class="table-header">                                      
                                       <h3>Student Package Info
                                            <a style="margin-left: 240px; color:#fff; font-size: 18px; text-decoration: none" href="<?php echo base_url()?>accounts/view_form_student_info/<?php echo $std_package[0]['student_id']; ?>">
                                                 Change Program
                                            </a> |
                                            <!--Package revise on current campaign students-->
                                            <?php if($student_campaign_id == $current_campaign_id || ($this->session->userdata('sub_login') == 'asim.masood' && $this->session->userdata('role') != 'OS')){?>
                                            <a id="revise_package" style="font-size: 18px; color:#fff; text-decoration: none" >
                                                 Revise Package
                                            </a> |
                                            <?php } ?>
                                            <a style="color:#fff; font-size: 18px; text-decoration: none"   href="<?php echo site_url(); ?>accounts/edit_studentform/?student_id=<?php echo $std_package[0]['student_id'];?>">
                                                 Edit
                                            </a> 
                                            |
                                             <?php if ($std_package[0]['status'] == 'ok'){?>   
                                                <a onclick="return confirm('Are You Sure ?');" style="font-size: 18px; color:#fff; text-decoration: none"  href="<?php echo base_url()?>accounts/freeze_left2/<?php echo $std_package[0]['student_id']; ?>/<?php echo $std_package[0]['current_session_id']; ?>/<?php echo $std_package[0]['semester']; ?>/<?php echo $std_package[0]['status']; ?>/left">
                                                        Left
                                                </a> |
                                                <a onclick="return confirm('Are You Sure ?');" style="font-size: 18px; color:#fff; text-decoration: none" href="<?php echo base_url()?>accounts/freeze_left2/<?php echo $std_package[0]['student_id']; ?>/<?php echo $std_package[0]['current_session_id']; ?>/<?php echo $std_package[0]['semester']; ?>/<?php echo $std_package[0]['status']; ?>/freeze">
                                                        Freeze
                                                </a>
                                              <?php }else{?>                                                    
                                                    <a onclick="return confirm('Are You Sure ?');" style="font-size: 18px; color:#fff; text-decoration: none" href="<?php echo base_url()?>accounts/freeze_left2/<?php echo $std_package[0]['student_id']; ?>/<?php echo $std_package[0]['current_session_id']; ?>/<?php echo $std_package[0]['semester']; ?>/<?php echo $std_package[0]['status']; ?>/ok">
                                                        Active
                                                    </a>                                                    
                                              <?php }?>
                                            
                                       </h3>
                                                
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
                                          
                                            <?php $total_fee = $std_package[0]['misc_fee']+ $std_package[0]['session_fee']; ?>
                                            
                                            <tr>                                                                        
                                                <th>Admission Fee</th>
                                               <td><?php echo $std_package[0]['admission_fee'];?></td>                                                                                
                                            </tr>
                                            
                                            <?php if($total_fee >= 100000){?>
                                            <tr>                                                                        
                                                <th>Tax</th>
                                               <td><?php echo $tax  =   5*$total_fee/100;?></td>                                                                                
                                            </tr>
                                            <?php }?>
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
                                                    if($std_package[0]['program_id'] == 53){
                                                        echo $std_package[0]['session_fee']+$tax;
                                                    }else{
                                                        echo $std_package[0]['session_total_package'];
                                                    }
                                               }else{
                                                      echo $std_package[0]['session_total_package']+$std_package[0]['admission_fee'];
                                               }?>
                                               </td>
                                            </tr>
                                            
                                            <tr>                                                                        
                                                <th>Status</th>
                                               <td><?php if($std_package[0]['status'] == 'ok'){echo 'Active'; }else{ echo $std_package[0]['status'];}?></td>                                                                                
                                            </tr>
                                          
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php 
                                    
                                    if($no_of_installments > 0){
                                    ?> 
                                    
                                    
                                    <div class="table-header">
                                       <h3>Student Installments
                                       <a style="color: White; margin-left: 330px;" href="<?php echo base_url()?>accounts/installments/?student_id=<?php echo $std_package[0]['student_id']; ?>"> Add </a>
                                       | <a style="color: White;" href="<?php echo base_url()?>accounts/edit_installments/?student_id=<?php echo $std_package[0]['student_id']; ?>"> Revise Installments</a>
                                       </h3>
                                       
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Challan No</th>
                                                <th>Tution Fee</th>
                                                <th>Fine</th>
                                                <th>Discount</th>
                                                <th>Payable</th>
                                                <th>Session</th>
                                                <th>Due Date</th>                                            
                                                <th>Status</th>                                            
                                                <th>Remarks</th>                                            
                                                <th>Actions</th> 
                                                
                                              </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                             foreach ($std_installments as $row){
                                         ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i+1;  ?></td>
                                               <td>
                                                    <a style="cursor: pointer" target="_blank" href="<?php echo base_url()?>accounts/show_challan/?challan_id=<?php echo $row['challan_id']; ?>&student_id=<?php echo $std_package[0]['student_id']; ?>" >
                                                    <?php echo $row['challan_id'].'c'; ?>
                                                    </a>
                                               </td>
                                                <td><?php echo $row['fee']; ?></td>
                                                <td><?php echo $row['fine']; ?></td>
                                                <td><?php echo $row['additional_discount']; ?></td>
                                                <td><?php echo $row['payable']; ?></td>
                                                <td><?php echo $row['session']; ?></td>
                                                <td><?php echo(date("d-M-Y",strtotime($row['due_date']))); ?></td>
                                                <td>
                                                <?php if($row['status'] == 0){ echo 'Unpaid'; ?> 
                                                <?php }else{ echo 'Paid'; } ?>
                                                
                                                </td>                                                
                                                <td><?php echo $row['remarks'];  ?>
                                                
                                                </td>                                                
                                                <td>
                                              
                                                    <a style="cursor: pointer" onClick="window.open('<?php echo base_url()."accounts/print_challan/?challan_id=".$row['challan_id']."&student_id=".$std_package[0]['student_id']; ?>&print=yes','Print Voucher','width=638,height=400')">Print Voucher</a>
                                                    <?php 
                                                        if($this->session->userdata('sub_login') == 'asim.masood' && $this->session->userdata('role') != 'OS')
                                                            {
                                                                if($row['status'] == 1){ ?>                                                  
                                                                |&nbsp<a onclick="return confirm('Are you want to Unpaid this Challan ?');" href="<?php echo base_url(); ?>accounts/unpaid_challan_status/<?php echo $row['challan_id']; ?>/<?php echo $row['student_id']; ?>">Unpaid</a>                                                  
                                                            <?php }} ?>
                                                
                                                </td>
                                             </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php }else{ ?>
                                         <div class="table-header">
                                             <h3>  <a style="color: White" href="<?php echo base_url()?>accounts/installments/?student_id=<?php echo $std_package[0]['student_id']; ?>"> Add Installments</a>
                                    </div>
                                    <?php }?>
                                    
                                </div>
                            </div>
                        </div>   
                
                
                
                <div class="row-fluid">
                    <div class="span12">                                                                     

                               <div class="row-fluid">                                    
                                     
                                  <?php 
                                    $challans =  count($challan);
                                    if($challans > 0){
                                    ?>  
                                   
                                    <div class="table-header">
                                       <h3>Post Challan</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size:10px">
                                                <th>#</th>                                                
                                                <th>Name</th>
                                                <th>Program</th>
                                                <th>Challan No</th>
                                                <th>Tution Fee</th>
                                                <th>Fine</th>
                                                <th>Amount</th>                                                                                           
                                                <th>Type</th>                                                                                           
                                                <th>Due Date</th>                                            
                                                <th>Post Date</th>                                            
                                                <th>Slip #</th> 
                                                <th>Action</th> 
                                                
                                              </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                             $i = 0;
                                             foreach ($challan as $row){
                                                 if($row['status'] == 0){
                                         ?>
                                            <tr style="font-size:10px">                                                                                        
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['program_name']; ?></td>
                                                <td><?php echo $row['challan_id'].'C'; ?></td>
                                                <td><?php echo $row['fee']; ?></td>                                                
                                                <td><?php echo $row['fine']; ?></td>                                                
                                                <td><?php echo $row['payable']; ?></td>                                                
                                                <form name="postChallan" id="postChallan<?php echo $i;?>" action="<?php echo  base_url()?>accounts/post_challan2" method="post" enctype="multipart/form-data">
                                               
                                            <?php if($this->session->userdata('role') == 'HOD'){?>
                                                <td>                                                    
                                                    <select onchange="slipNo(this.value,this.id);" id="<?php echo $i;?>" name="type" style="width:100px">
                                                        <option value="Bank - 00020081079384021">Bank Al-Habib</option>
                                                        <option value="Bank - 50097900192755">Bank HBL</option>
                                                        <option value="Cash">Cash</option>
                                                    </select>
                                                </td>
                                            <?php }else{?>
                                            
                                                <td>                                                    
                                                    <select onchange="slipNo(this.value,this.id);" id="<?php echo $i;?>" name="type" style="width:100px">
                                                        <option value="Bank">Bank</option>
                                                        <option value="Cash">Cash</option>
                                                    </select>
                                                </td>
                                            <?php }?>
                                                <td><?php echo(date("d-M-Y",strtotime($row['due_date']))); ?></td>
                                                <td>
                                                    
                                                        <input style="width: 100px;" type="text" name="post_date" id="post_date" class="span6 date-picker" data-date-format="yyyy-mm-dd" readonly/>
                                                        <input type="hidden" name="challan_id" value="<?php echo $row['challan_id']; ?>" />
                                                        <input type="hidden" name="student_id" value="<?php echo $std_package[0]['student_id']; ?>" />                                                     
                                                    
                                                </td>
                                                <td> <input class="span12" name="slip_no" id="<?php echo 's'.$i;?>" type="text" readonly/> </td> 
                                                </form>
                                                <td>                                              
                                                    <a style="cursor:pointer" onclick="submitForm(this.id);"  id="<?php echo $i;?>" class="green" >
                                                            Post
                                                    </a> |  
                                                    <a style="cursor:pointer" href="<?php echo base_url()?>accounts/add_fine_form2/?installment_id=<?php echo $row['installment_id']; ?>&student_id=<?php echo $std_package[0]['student_id']; ?>&due_date=<?php echo $row['due_date'];?>" class="green" >
                                                            Add Fine
                                                    </a> 
                                                </td>
                                             </tr>
                                             <?php $i++;}} ?>                                    
                                        </tbody>
                                    </table>
                                   
                                    <?php }else{ ?>
                                         <div class="table-header">
                                             <h3> There are no challan to post! </h3>
                                         </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div> 
                
                 <?php    if($std_package[0]['cr'] = 1){        ?>  
                
                <div class="row-fluid">
                    <div class="span12">                                                                     

                               <div class="row-fluid">                                    
                                     
                                  <?php 
                                    $session =  count($sessions);
                                    if($session > 0){
                                    ?>  
                                   
                                    <div class="table-header">
                                       <h3>View Fee Per Course</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size:10px">
                                                <th>#</th>                                                
                                                <th>Session</th>
                                                <th>Action</th>                                                 
                                              </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                             $i = 0;
                                             foreach ($sessions as $row){
                                         ?>
                                            <tr style="font-size:10px">                                                                                        
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['session']; ?></td>                                          
                                                <td>
                                                    <a target="_blank" href="<?php echo base_url();?>accounts/view_fee_per_course/<?php echo $student_id; ?>/<?php echo $program_id; ?>/<?php echo $campaign_id; ?>/<?php echo $row['session_id']; ?>">
                                                        View Fee
                                                    </a>
                                                </td>
                                             </tr>
                                             <?php $i++;} ?>                                    
                                        </tbody>
                                    </table>
                                   
                                    <?php }else{ ?>
                                         <div class="table-header">
                                             <h3> Record Not Found </h3>
                                         </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div> 
                 <?php } ?>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->

    </div><!--/.main-content-->
</div><!--/.main-container--> 

<script>
    function myFunction()
    {
    window.print();
    }
</script>

    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/date-time/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/date-time/daterangepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.autosize-min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/ace-elements.min.js"></script>

    <!--inline scripts related to this page-->

    <script type="text/javascript">
      $(function() {
        var oTable1 = $('#sample-table-2').dataTable( {
          "aoColumns": [
            { "bSortable": true },
            null,null,null,null,null,null,null,null,null,
            { "bSortable": false }
          ] } );
			
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();
			
          var off2 = $source.offset();
          var w2 = $source.width();
			
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
      })
    </script>
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
  
  $("#post_challan").click(function(){
     
     if (confirm("Are you sure?")) 
     {
          
        var date = $("#post_date").val();        
        if(date == '')
           {
               alert('Please Select The Post date');
               $("#post_date").focus();
           }
        else
           {
               $("#postChallan").submit(); 
           }
           
    }
    return false;

  });
  
   $("#revise_package").click(function(){
     
     if (confirm("Are you sure?")) 
     {
           window.location.assign(base_url+"accounts/revise_package/?student_id="+<?php echo $std_package[0]['student_id']; ?>)        
     }
    return false;

  });
  
  
  function slipNo(val,id)
  {
      
      if(val == 'Bank')
      {          
          $("#s" + id).prop('readonly', true);
      }
      if(val == 'Cash')
      {          
          $("#s" + id).prop('readonly', false);
      }
     
      
  }
  
  function submitForm(id)
  {
      if (confirm("Are you sure?")) 
     {
          
        var date = $("#post_date").val();
        if(date == '')
           {
               alert('Please Select The Post date');
               $("#post_date"+id).focus();
           }
        else
           {
               $("#postChallan"+id).submit(); 
           }
           
    }
    return false;
  }

</script>
  
 