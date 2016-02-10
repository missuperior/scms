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
                 Challan      
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Challan</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form class="form-horizontal" name="searchChallan" id="searchChallan" method="POST" action="<?php echo  base_url()?>accounts_de/post_challan_form" enctype="multipart/form-data" />
                                                              
                                <div class="row-fluid" style="float:left; width:250px">
                                    <label>Program</label>

                                    <select class="chzn-select" name="program" id="form-field-select-3" data-placeholder="Choose a Country...">
                                       <?php foreach ($programs as $row) { ?>
                                      <option <?php if ($program_id == $row['program_id']){echo 'selected="selected"';}  ?>
                                          value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                        <?php } ?>  
                                    </select>
                                </div>
                                
                                <div class="row-fluid" style="float:left; width:150px">
                                    <label>Batch</label>

                                    <select style="width:150px" name="batch" class="chzn-select" id="form-field-select-3" data-placeholder="Choose batch">
                                        <?php foreach ($batches as $row) { ?>
                                        <option <?php if ($batch_id == $row['batch_id'])echo 'selected="selected"'; ?>
                                        value="<?php echo $row['batch_id'] ?>"><?php echo $row['batch'] . ' - ' . $row['batch_type'] ?></option> 
                                        <?php } ?>	


                                    </select>
                                </div>

                                <div class="row-fluid" style="width:225px; float: left; margin-left: 20px;">
                                    <label for="id-date-range-picker-1">Date Range Picker</label>
                                    <div class="row-fluid input-prepend">
                                        <span class="add-on">
                                            <i class="icon-calendar"></i>
                                        </span>

                                        <input class="span10" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                                    </div>
                                </div>
                                
                                <button class="btn btn-purple btn-small" style="margin-top:24px" >
                                    Search
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
        </div>
        
        
     
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
                                     
                                  <?php 
                                    $challans =  count($challan);
                                    if($challans > 0){
                                    ?>  
                                   
                                    <div class="table-header">
                                       <h3>Post Challan</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Name</th>
                                                <th>Program</th>
                                                <th>Challan No</th>
                                                <th>Amount</th>                                                                                           
                                                <th>Due Date</th>                                            
                                                <th>Post Date</th>                                            
                                                <th>Status</th> 
                                                <th>Action</th> 
                                                
                                              </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                             $i = 0;
                                             foreach ($challan as $row){
                                                 if($row['status'] == 0){
                                         ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['program_name']; ?></td>
                                                <td><?php echo $row['challan_id']; ?></td>
                                                <td><?php echo $row['payable']; ?></td>                                                
                                                <td><?php echo(date("d-M-Y",strtotime($row['due_date']))); ?></td>
                                                <td>
                                                    <form name="postChallan" id="postChallan" action="<?php echo  base_url()?>accounts_de/post_challan" method="post" enctype="multipart/form-data">
                                                        <input style="width: 100px;" type="text" name="post_date" id="post_date" class="span6 date-picker" data-date-format="yyyy-mm-dd" />
                                                        <input type="hidden" name="challan_id" value="<?php echo $row['challan_id']; ?>" />
                                                    </form>
                                                </td>
                                                <td> <?php if($row['status'] == 0) {echo "Unpaid";}else{echo "Paid";}; ?> </td>                                                
                                                <td>                                              
                                                    <a style="cursor:pointer" id="post_challan" class="green" >
                                                            Post Challan
                                                </a> 
                                                </td>
                                             </tr>
                                             <?php $i++;}} ?>                                    
                                        </tbody>
                                    </table>
                                   
                                    <?php }else{ ?>
                                         <div class="table-header">
                                             <h3>  Record Not Found. Please Try Again! </h3>
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
            null,null,null,null,null,null,null,
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
        
        // for chosen and date range
        
                                $(".chzn-select").chosen(); 
				
				$('#id-date-range-picker-1').daterangepicker().prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
        
        
      })
    </script>
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

</script>
  