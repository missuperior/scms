<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Examination</a>
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
                 Student Result  
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
     
                                    <div class="table-header">
                                       <h3>Student Result
                                       <a style="color: White; float: right; margin-right:10px;" href="<?php echo base_url()?>examination_de/add_result_form/?student_id=<?php echo $student_id; ?>"> Add Result</a>
                                       </h3>
                                       
                                    </div>
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>                                                
                                                <th>Name</th>
                                                <th>Session</th>
                                                <th>Course</th>
                                                <th>Mid </th>                                                
                                                <th>Final</th>                                               
                                                <th>Obtained</th>                                            
                                                <th>Total</th>                                                 
                                              </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                             foreach ($result as $row){
                                                 $mid_obtained = $row['mid_value_1']+$row['mid_value_2']+$row['mid_value_3'];
                                                 $final_obtained = $row['final_value_1']+$row['final_value_2']+$row['final_value_3']+$row['final_value_4']+$row['final_value_5']+$row['final_value_6']+$row['final_value_7'];;
                                                 $total_obtained = $mid_obtained + $final_obtained;
                                         ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i+1;  ?></td>
                                                <td><?php echo $row['student_name'];  ?></td>
                                                <td><?php echo $row['session'];?></td>
                                                <td><?php echo $row['course_name'];?></td>
                                                <td><?php echo $mid_obtained;?></td>
                                                <td><?php echo $final_obtained;?></td>
                                                <td> <?php echo $total_obtained; ?> </td>                                                
                                                <td>100  </td>
                                             </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                                                       
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
            null,null,null,null,null,null,
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
 