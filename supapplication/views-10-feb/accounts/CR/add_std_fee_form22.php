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
        
         <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo $this->session->userdata('msg'); $this->session->unset_userdata('msg'); ?>
                   </a>
                </h4>	
        
        <div class="page-header position-relative">
            <h1>
                 Course Registration      
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Student</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form target="_blank" class="form-horizontal" name="searchChallan" id="searchChallan" method="POST" action="<?php echo  base_url()?>accounts/add_submitted_fee_form222" enctype="multipart/form-data" />
                                                              
                               
                                <div class="row-fluid" style="width:220px">
                                    <label>Campaign</label>
                                    <select class="chzn-select" name="campaign" id="campaign" data-placeholder="Choose a Country...">
                                        <option value="">Select Campaign</option>
                                      <?php foreach ($campaign as $row) { ?>
                                                    <option <?php if ($campaign_id == $row['campaign_id']) echo 'selected="selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
                                                <?php } ?>
                                    </select>
                                </div>
                                
                                 <div class="row-fluid" style="width:220px">
                                    <label>Program</label>
                                    <select onchange="getRollNo(this.value);" class="chzn-select" name="program" id="form-field-select-3" data-placeholder="Choose a Country...">
                                       <option value="">Select Program</option>
                                       <?php foreach ($programs as $row) { ?>
                                      <option <?php if ($program_id == $row['program_id']){echo 'selected="selected"';}  ?>
                                          value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'].' - '.$row['program_type']; ?></option> 
                                        <?php } ?>  
                                    </select>
                                </div>
                                
                               <div class="row-fluid" style="width:220px" id="roll">
                                    
                                    
                                </div>
                                
                                <div class="row-fluid" style="width:220px">
                                    <label>Sessions</label>
                                    <select  class="chzn-select" name="session" id="form-field-select-3" data-placeholder="Choose a Country...">
                                       <option value="">Select Session</option>
                                       <?php foreach ($sessions as $row) { ?>
                                      <option  value="<?php echo $row['session_id'] ?>"><?php echo $row['session']; ?></option> 
                                        <?php } ?>  
                                    </select>
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
  
  function getRollNo(value)  
   {
       var campaign_id = $("#campaign").val();
       if(value!=""){
                $.ajax({
                    type: "POST",
                    data:{
                        'program_id':value,
                        'campaign_id':campaign_id,
                         },
                    url: "<?php echo base_url();?>accounts/get_students_rollno",
                    
                    success:function(data){
                        $("#roll").html(data);
                    },
                    error: function(){
                        alert('Some Error Occured, Please Try Again');
                    }
                });
               
              }else{
                  alert('Please Select Program');
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
  