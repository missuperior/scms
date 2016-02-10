<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none"> </a>
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
                Examination Module           
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                       
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							

                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>Mid Structure</h3>
                                    </div>

                                  <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                       <thead>
                                            <tr>                                                
                                                <th>Title 1</th>
                                                <th>Marks</th>
                                                <th>Title 2</th>
                                                <th>Marks</th>
                                                <th>Title 3</th>
                                                <th>Marks</th>
                                                <th style="width: 26px;">Action</th>
                                              </tr>
                                        </thead>

                                        <tbody>
                                        
                                            <tr>                                                                                                                                       
                                                <td><?php echo $mid->mid_title_1; ?></td>
                                                <td><?php if($mid->mid_value_1 > 0)echo $mid->mid_value_1; ?></td>
                                                <td><?php echo $mid->mid_title_2; ?></td>
                                                <td><?php if($mid->mid_value_2 > 0)echo $mid->mid_value_2; ?></td>
                                                <td><?php echo $mid->mid_title_3; ?></td>
                                                <td><?php if($mid->mid_value_3 > 0)echo $mid->mid_value_3; ?></td>
                                                
                                                <td class="td-actions">
                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                       <?php //if($check_final == 0){?>
                                                        <a class="green" href="<?php echo base_url()?>teachers/edit_mid_structure/?mid_structure_id=<?php echo $mid->mid_course_structure_id; ?>">
                                                            <i class="icon-pencil bigger-130"></i>
                                                        </a>                      
                                                       <?php //}  ?>
                                                    </div>                                                   
                                                </td>                                                 
                                            </tr>
                                           
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


    <!--inline scripts related to this page-->

    <script type="text/javascript">
      $(function() {
        var oTable1 = $('#sample-table-').dataTable( {
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
 