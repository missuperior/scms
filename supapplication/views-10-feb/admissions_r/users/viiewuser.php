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
                User Management                
            </h1>
        </div><!--/.page-header-->
        
        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                 <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                       
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?>
                    </a>
                </h4>							

                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>All Users</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size: 10px">
                                                
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th class="hidden-phone">Campus </th>
                                                <th class="hidden-480">City</th> 
                                                <th class="hidden-phone">Created Date </th>
                                                 <th class="hidden-480">Status</th> 
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php  
                                           
                                        for($i=0; $i<count($users);$i++){ 
                                            ?>
                                            <tr style="font-size:10px">                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $users[$i]['employee_name']; ?></td>
                                                <td><?php echo ucfirst($users[$i]['campus_name']); ?></td>
                                                <td class="hidden-480"><?php echo $users[$i]['campus_code']; ?></td>
                                                <td class="hidden-phone"><?php echo $users[$i]['created_date']; ?></td>
                                                <td class="hidden-phone"><?php if($users[$i]['sub_status'] == '1') 
                                                                                    { echo "Active"; }
                                                                                        else { echo "In-Active"; } ?></td>
                                                <td class="td-actions">
                                                           <div class="hidden-phone visible-desktop action-buttons">
                                                       
                                                        <a class="green" href="<?php echo base_url()?>admission_r/edit_user/<?php echo $users[$i]['employee_id']; ?>">
                                                            <i class="icon-pencil bigger-130"></i>
                                                        </a>
                                                        
                                                    </div>
                                                </td>
                                                  
                                            </tr>

                                            <?php } ?>
                                            
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
       
      });

    </script>
		
		
		

		<!--ace scripts-->
    
    