<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Accounts </a>
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
                 Student Info      
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
                  
                   <?php $total =  count($info); 
                        $total_amount = 0;
                   ?> 
                    
                    <a target="_blank"  href="<?php echo base_url(); ?>accounts/printStudentCoursesInfo/<?php echo $info[0]['student_id'];?>/<?php echo $info[0]['current_session_id']?>/<?php echo $info[0]['program_id']?>">
                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                    </a>
                    
                    <div class="span12">                                                                     

                                <div>
                                    <?php if($total > 0){  ?> 
                                    
                                    <div class="table-header">                                      
                                       <h3>Student Info   </h3>
                                                
                                    </div>

                                    
                                    
                                    <table class="table table-striped table-bordered table-hover">
                                       
                                        
                                        <tbody>
                                        
                                            <tr>                                                                        
                                                <th>Name</th>
                                                <td><?php echo $info[0]['student_name'];?></td>                                        
                                                
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Roll No</th>
                                                <td><?php echo $info[0]['roll_no'];?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Program</th>
                                                <td><?php echo $info[0]['program_name'];?></td>                                        
                                            </tr>
                                                                                     
                                            <tr>                                                                        
                                                <th>Session</th>
                                                <td><?php echo $info[0]['session'];?></td>                                                                         
                                            </tr>
                                          
                                             
                                        </tbody>
                                    </table>
                                    
                                    <?php 
                                    }
                                    if($total > 0){
                                    ?> 
                                    
                                    
                                    <div class="table-header">
                                       <h3>Registered Courses </h3>
                                       
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Course Name</th>
                                                <th>Course Fee</th>                                                
                                              </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                            
                                             foreach ($info as $row){
                                         ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i+1;  ?></td>                                               
                                                <td><?php echo $row['course_name']; ?></td>
                                                <td>
                                                    <?php 
                                                        $result   =   $this->Accounts_model->getResult($row['course_id'],$row['student_id'],$row['current_session_id']); 
                                                        if($result > 0){
                                                            echo $original_fpc;
                                                            $total_amount = $total_amount + $original_fpc;
                                                        }else{
                                                            echo $discounted_fpc;
                                                            $total_amount = $total_amount + $discounted_fpc;
                                                        }
                                                    
                                                    ?>
                                                </td>
                                             </tr>
                                           <?php $i++; }?>
                                             
                                              <tr>                                                                                        
                                                  <td colspan="2">Total </td>                                               
                                                  <td><b><?php echo $total_amount; ?></b></td>                                                
                                             </tr>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php }else{?>
                                         <div class="table-header">
                                             <h3>Courses Not Registered</h3>
                                    </div>
                                    <?php }?>
                                    
                                </div>
                            </div>                                        
                        </div>   
                <?php if($total > 0){  ?>  
                
                <div class="widget-box" style="margin-top: 50px">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Add Student Fee</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form class="form-horizontal" name="searchChallan" id="searchChallan" method="POST" action="<?php echo  base_url()?>accounts/add_submitted_fee" enctype="multipart/form-data" />
                                                              
                               
                                <div class="row-fluid" style="width:500px">
                                    <label>Installment 1</label>
                                    <input style="float:left" id="ins1" type="number" min="1" required="required" value="<?php echo $total_amount/2;?>" name="installment_amount[]" placeholder="Enter Fee" />
                                    <input style="width: 125px; float:left" required="required" type="text" name="due_date[]" id="<?php echo "due_date".$i; ?>" value="<?php echo date('Y-m-d'); ?>"  class="span10 date-picker" placeholder="Due Date" data-date-format="yyyy-mm-dd" readonly />
                                    
                                    <input type="hidden" value="<?php echo $info[0]['current_session_id']?>" name="session" />
                                    <input type="hidden" value="<?php echo $info[0]['student_id']?>" name="student_id" />
                                    <input type="hidden" value="<?php echo $program_id; ?>" name="program" />
                                    <input type="hidden" value="<?php echo $total_amount; ?>" name="total_amount" id="total_amount" />
                                </div>
                                
                                <div class="row-fluid" style="width:500px">
                                    <label>Installment 2</label>
                                    <input style="float:left" id="ins2" type="number" required="required" value="<?php echo $total_amount/2;?>" readonly name="installment_amount[]" placeholder="Enter Fee" />
                                    <input style="width: 125px; float:left" required="required" type="text" name="due_date[]" id="<?php echo "due_date".$i; ?>" value="<?php echo date('Y-m-d'); ?>"  class="span10 date-picker" placeholder="Due Date" data-date-format="yyyy-mm-dd" readonly />                                </div>
                                
                               
                                <button class="btn btn-purple btn-small" style="margin-top:22px" >
                                    Submit
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                                </form>
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
        
      $("#ins1").keyup(function() {  
      
      var total = $("#total_amount").val();
      var fee1  = $("#ins1").val();
      var fee2  = parseInt(total - fee1);
            
      if(parseInt(fee1) > parseInt(total)){
          alert('Installment amount should be equal to Total Amount.');
          $("#ins1").val('');
          $("#ins2").val(total);
      }else{
            $("#ins2").val(fee2);
        }
      
  });
        
        
        
      $(function() {
        var oTable1 = $('#sample-table-2').dataTable( {
          "aoColumns": [
            { "bSortable": true },
            null,null,null,null,null,null,null,null,
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
  
 