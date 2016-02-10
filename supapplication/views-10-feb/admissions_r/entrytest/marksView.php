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
                ENTRY TEST MODULE          
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                       
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							

                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>VIEW ENTRY TEST RESULT</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size: 10px">
                                                
                                                <th>#</th>
                                                <th>Form No</th>
                                                <th>Name</th>
                                                <th class="hidden-480">Room</th>                                                
                                                <th class="hidden-phone">Program </th>
                                                <th class="hidden-phone">Marks </th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php  
                                         
                                        for($i=0; $i<count($marks);$i++){ 
                                           // if($marks[$i]['marks'] != 'Z'){
                                            ?>
                                           
                                            
                                            <tr style="font-size:10px">                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $marks[$i]['form_no']; ?></td>
                                                <td><?php echo $marks[$i]['name']; ?></td>
                                                <td><?php echo $marks[$i]['room_name']; ?></td>
                                                <td class="hidden-480"><?php echo $marks[$i]['program_name']; ?></td>
                                                <td class="hidden-phone"><?php echo $marks[$i]['marks']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url()?>admission_r/edit_marks/?result_id=<?php echo $marks[$i]['entrytest_result_id']; ?>"> EDIT </a>                                                                                    
                                                </td>
                                                  
                                            </tr>

                                            <?php } //} ?>
                                            
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

    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.dataTables.bootstrap.js"></script>
    
		
		
		

		<!--ace scripts-->
    
    <script type="text/javascript">
      $(function() {
          
          $('[data-rel=popover]').popover({html:true});
          
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
        
        
      });

    </script>