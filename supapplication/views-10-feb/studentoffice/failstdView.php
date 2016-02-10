<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">STUDENT OFFICE </a>
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
                 FAIL STUDENTS      
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">SEARCH STUDENTS</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form class="form-horizontal" name="searchChallan" id="searchChallan" method="POST" action="<?php echo  base_url()?>studentoffice/fail_std_view" enctype="multipart/form-data" />
                                  
                                <div style="width: 45%;margin-bottom: 25px; float: left; margin-top: 23px" class="control-group">
                                    <label style="width: 130px;" class="control-label" for="email">Campaign:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                    <div class="controls" style="margin-left: 140px;">
                                        <div class="span12">
                                            <select style="width: 200px;" id="campaign" name="campaign" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                                                <?php foreach ($campaign as $row) { ?>
                                                    <option <?php if ($campaign_id == $row['campaign_id']) echo 'selected="selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
                                                <?php } ?>																			
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                
                                <button class="btn btn-purple btn-small" style="margin-top:22px" >
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
                                    $total =  count($stdinfo);
                                    if($total > 0){
                                    ?>  
                                   
                                    <div class="table-header">
                                       <h3>FAIL STUDENTS</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size:10px">
                                                <th>#</th>                                                
                                                <th>Form No</th>
                                                <th>Roll No</th>
                                                <th>Name</th>
                                                <th>Marks</th>                                                
                                              </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                             $i = 0;
                                             foreach ($stdinfo as $row){
                                         ?>
                                            <tr style="font-size:10px">                                                                                        
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['form_no']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['marks']; ?></td>
                                             </tr>
                                             <?php $i++;} ?>                                    
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
            null,null,null,
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
          
        var date = $("#post_date"+id).val();
        
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
  