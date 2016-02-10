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
                Prospectus Module                
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
                                       <h3>All Sold Prospectuses</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size:10px">
                                                
                                                <th>#</th>
                                                <th>Inquiry No</th>
                                                <th>Name</th>
                                                <th class="hidden-phone">Program </th>
                                                <th class="hidden-phone">Product</th>
                                                <th class="hidden-phone">Quantity </th>
                                                <th class="hidden-phone">Total Price </th>
                                                <th class="hidden-phone">Stage</th>
                                                <th class="hidden-phone">Sale Date </th>
                                                <th class="hidden-phone">Action </th>
                                                 
                 
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php  
                                           
                                        for($i=0; $i<count($prospectus);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $prospectus[$i]['inquiry_no']; ?></td>
                                                <td><?php echo ucfirst($prospectus[$i]['name']); ?></td>
<!--                                                <td class="hidden-480"><?php echo $prospectus[$i]['contact']; ?></td>-->
                                                <td class="hidden-phone"><?php echo $prospectus[$i]['program_name']; ?></td>
                                                <td class="hidden-phone"><?php echo $prospectus[$i]['product_name']; ?></td>
                                                <td class="hidden-phone"><?php echo $prospectus[$i]['quantity']; ?></td>
                                                <td class="hidden-phone"><?php echo $prospectus[$i]['total_price']; ?></td>
                                                <td class="hidden-phone"><?php
                                                if($prospectus[$i]['admission_stage'] == 0)
                                                    {
                                                        echo 'Inquiry'; 
                                                    }
                                                elseif ($prospectus[$i]['admission_stage'] == 1) 
                                                    {
                                                        echo 'Initial Form'; 
                                                    }
                                                elseif ($prospectus[$i]['admission_stage'] == 2) 
                                                    {
                                                        echo 'Accounts'; 
                                                    }
                                                elseif ($prospectus[$i]['admission_stage'] == 3) 
                                                    {
                                                        echo 'Admission Completed'; 
                                                    }
                                                ?></td>       
                                                <td class="hidden-phone"><?php echo(date("d-M-Y",@strtotime($prospectus[$i]['sale_date']))); ?></td>
                                  
                                                <td class="td-actions">
                                                    
                                                    <?php if($prospectus[$i]['admission_stage'] == 0)
                                                    {                                           
                                                    ?>
                                                    
                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                       
                                                        <a class="green" href="<?php echo base_url()?>admission_r/add_initial_form/?inquiry_id=<?php echo $prospectus[$i]['inquiry_id']; ?>">
                                                            Initial Form
                                                        </a>                                                       
                                                    </div> 
                                                    <?php }elseif($prospectus[$i]['admission_stage'] == 3){ ?>
                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                        <p class="green">
                                                            Completed
                                                        </p>
                                                    </div>          
                                                    <?php }else{ ?>
                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                        <p class="green">
                                                            In Progress
                                                        </p>
                                                    </div>
                                                        <?php } ?>
                                                    
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
      })
    </script>