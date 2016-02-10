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
                 Students
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Student</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form class="form-horizontal" name="searchStudents" id="searchStudents" method="POST" action="<?php echo  base_url()?>examination_de/view_students" enctype="multipart/form-data" />
                                                              
                                <div class="row-fluid" style="float:left; width:250px">
                                    <label>Program</label>

                                    <select class="chzn-select" name="program" id="form-field-select-3" data-placeholder="Choose a Country...">
                                       <?php foreach ($programs as $row) { ?>
                                      <option <?php if ($program_id == $row['program_id']){echo 'selected="selected"';}  ?>
                                          value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                        <?php } ?>  
                                    </select>
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
                                    $std =  count($students);
                                    if($std > 0){
                                    ?>  
                                   
                                    <div class="table-header">
                                       <h3>Students Info</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Name</th>                                                
                                                <th>Roll No</th>
                                                <th>Program</th>                                                
                                                <th>Actions</th>                                                 
                                              </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                             $i = 0;
                                             foreach ($students as $row){

                                         ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['program_name']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url()?>examination_de/add_result_form/?student_id=<?php echo $row['student_id'] ?>"> Add Result </a>                                                    
                                                    | <a href="<?php echo base_url()?>examination_de/view_result/?student_id=<?php echo $row['student_id'] ?>"> View Result </a>                                                    
                                                </td>
                                             
                                             </tr>
                                             <?php $i++; } ?>                                    
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
<!--    <script src="<?php echo base_url();?>assets/js/date-time/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/date-time/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/date-time/daterangepicker.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.autosize-min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.maskedinput.min.js"></script>-->
		

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
        
      })
    </script>
    
