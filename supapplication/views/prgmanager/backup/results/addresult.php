<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Examination </a>
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
                 Add Result  
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Add Result</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form class="form-horizontal" name="searchChallan" id="searchChallan" method="POST" action="<?php echo  base_url()?>programmanagers/add_result" enctype="multipart/form-data" />
                                                              
                                <div class="row-fluid" style="float:left; width:250px">
                                    <label>Courses</label>

                                    <select class="chzn-select" name="course" id="form-field-select-3" data-placeholder="Choose a Course">                                      
                                        <?php foreach ($courses as $row) { ?>
                                      <option  value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                                        <?php } ?>  
                                    </select>
                                </div>
                                
                                <div class="row-fluid" style="float:left; width:150px">
                                    <label>Term</label>

                                    <select onchange="submitForm();" style="width:150px" name="term" class="chzn-select" id="form-field-select-3" data-placeholder="Choose batch">
                                        <option value=""> -- Select Term --</option>
                                        <option <?php if($term == '1'){echo 'selected="selected"';}?>value="1"> Mid Term</option>
                                        <option <?php if($term == '2'){echo 'selected="selected"';}?>value="2"> Final Term</option>
                                    </select>
                                </div>
                               
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
                                     
                                
                                    <div class="table-header">
                                       <h3>All Students</h3>
                                    </div>
                                  
                                    <table id="sample-table" class="table table-striped table-bordered table-hover">
                                        <?php if($term == 1){ ?>
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Name</th>
                                                <th>Roll No</th>
                                                <?php if($structure[0]['mid_title_1'] != ''){  ?>
                                                <th><?php echo $structure[0]['mid_title_1'] .' | '.$structure[0]['mid_value_1']; ?></th>
                                                <?php } if($structure[0]['mid_title_2'] != ''){ ?>
                                                <th><?php echo $structure[0]['mid_title_2'] .' | '.$structure[0]['mid_value_2']; ?></th>
                                                <?php }if($structure[0]['mid_title_3'] != ''){ ?>
                                                <th><?php echo $structure[0]['mid_title_3'].' | '.$structure[0]['mid_value_3']; ?></th>                                            
                                                <?php } ?>                                            
                                               
                                              </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                        $i=1;
                                        foreach($students AS $row){ ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <?php if($structure[0]['mid_title_1'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks1" id="marks1" maxlength="2" class="numeric" /></td>                                                
                                                <?php }if($structure[0]['mid_title_2'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks2" id="marks2" maxlength="2" class="numeric"/></td>                                                
                                                <?php } if($structure[0]['mid_title_3'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks3" id="marks3" maxlength="2" class="numeric"/></td>                                                                                                                                               
                                                <?php } ?>
                                             </tr>
                                        <?php $i++; } ?>                           
                                        </tbody>
                                        
                                        <?php }else{?>
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Name</th>
                                                <th>Roll No</th>
                                                <?php if($structure[0]['final_title_1'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_1'].' | '.$structure[0]['final_value_1']; ?></th>
                                                <?php } if($structure[0]['final_title_2'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_2'].' | '.$structure[0]['final_value_2']; ?></th>
                                                <?php } if($structure[0]['final_title_3'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_3'].' | '.$structure[0]['final_value_3']; ?></th>                                            
                                                <?php }if($structure[0]['final_title_4'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_4'].' | '.$structure[0]['final_value_4']; ?></th>                                            
                                                <?php } if($structure[0]['final_title_5'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_5'].' | '.$structure[0]['final_value_5']; ?></th>                                            
                                                <?php } if($structure[0]['final_title_6'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_6'].' | '.$structure[0]['final_value_6']; ?></th>                                            
                                                <?php } if($structure[0]['final_title_7'] != ''){  ?>
                                                <th><?php echo $structure[0]['final_title_7'].' | '.$structure[0]['final_value_7']; ?></th>                                            
                                                <?php } ?>
                                              </tr>
                                        </thead>
                                                                                
                                        <tbody>
                                        <?php 
                                        $i=1;
                                        foreach($students AS $row){ ?>
                                            
                                            <tr>                                                                                        
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <?php if($structure[0]['final_title_1'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks1" id="marks1" maxlength="2" class="numeric" /></td>                                                
                                                <?php }  if($structure[0]['final_title_2'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks2" id="marks2" maxlength="2" class="numeric"/></td>                                                
                                                <?php }  if($structure[0]['final_title_3'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks3" id="marks3" maxlength="2" class="numeric"/></td>                                                                                                                                               
                                                <?php }  if($structure[0]['final_title_4'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks4" id="marks4" maxlength="2" class="numeric"/></td>                                                                                                                                               
                                                <?php }  if($structure[0]['final_title_5'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks5" id="marks5" maxlength="2" class="numeric"/></td>                                                                                                                                               
                                                <?php }  if($structure[0]['final_title_6'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks6" id="marks6" maxlength="2" class="numeric"/></td>                                                                                                                                               
                                                <?php }  if($structure[0]['final_title_7'] != ''){  ?>
                                                <td><input style="width: 100px;" type="text" name="marks7" id="marks7" maxlength="2" class="numeric"/></td>                                                                                                                                               
                                                <?php } ?>
                                             </tr>
                                        <?php $i++; } ?>                           
                                        </tbody>
                                        
                                        <?php } ?>
                                    </table>
                                   
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
            null,null,null,null,
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
      
      $('.numeric').keyup(function () {  
                  this.value = this.value.replace(/[^0-9\.]/g,''); 
            });
      
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


function submitForm()
{
    $("#searchChallan").submit();
}
</script>
  