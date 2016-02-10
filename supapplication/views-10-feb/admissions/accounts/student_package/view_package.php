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
                                          
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php 
                                    
                                    if($no_of_installments > 0){
                                    ?> 
                                    
                                    
                                    <div class="table-header">
                                       <h3>Student Installments
                                       <a style="color: White; margin-left: 360px;" href="<?php echo base_url()?>accounts_de/installments/?student_id=<?php echo $std_package[0]['student_id']; ?>"> Add Installments</a>
                                       </h3>
                                       
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Challan No</th>
                                                <th>Amount</th>
                                                <th>Session</th>
                                                <th>Due Date</th>                                            
                                                <th>Status</th>                                            
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
                                                    <a style="cursor: pointer" target="_blank" href="<?php echo base_url()?>accounts_de/show_challan/?student_id=<?php echo $std_package[0]['student_id']; ?>&challan_id=<?php echo $row['challan_id']; ?>" >
                                                    <?php echo $row['challan_id'].'c'; ?>
                                                    </a>
                                                    </td>
                                                    
                                                <td><?php echo $row['payable']; ?></td>
                                                <td><?php echo $row['session']; ?></td>
                                                <td><?php echo(date("d-M-Y",strtotime($row['due_date']))); ?></td>
                                                <td>
                                                <?php if($row['status'] == 0){ echo 'Unpaid'; ?> 
                                                <?php }else{ echo 'Paid'; } ?>
                                                
                                                </td>                                                
                                                <td>
                                              
                                                                                                                                                 
                                                <a style="cursor: pointer" onClick="window.open('<?php echo base_url()."accounts_de/print_challan/?challan_id=".$row['challan_id']."&student_id=".$std_package[0]['student_id']; ?>&print=yes','Print Voucher','width=638,height=400')">Print Voucher</a>
                                                
                                                
                                                </td>
                                             </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <?php }else{ ?>
                                         <div class="table-header">
                                             <h3>  <a style="color: White" href="<?php echo base_url()?>accounts_de/installments/?student_id=<?php echo $std_package[0]['student_id']; ?>"> Add Installments</a>
                                    </div>
                                    <?php }?>
                                    
                                </div>
                            </div>
                        </div>                
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


    <!--inline scripts related to this page-->

    <script type="text/javascript">
      $(function() {
        var oTable1 = $('#sample-table-2').dataTable( {
          "aoColumns": [
            { "bSortable": true },
            null,null,null,null,null,
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
 