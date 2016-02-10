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
                Inquiry Module                
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
                                       <h3>All Inquiries</h3>
                                    </div>

                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr style="font-size: 10px">
                                                
                                                <th>#</th>
                                                <th>Inquiry No</th>
                                                <th>Name</th>
                                                <th class="hidden-480">Contact</th>                                                
                                                <th class="hidden-phone">Program </th>
                                                <th class="hidden-phone">Reference </th>
                                                <th class="hidden-480">Inquiry Type</th> 
                                                <th class="hidden-480">Stage</th>                                                 
                                                <th class="hidden-phone">Inquiry Date </th>
                                               
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        <?php  
                                         $j=1;  
                                        for($i=0; $i<count($inquiries);$i++){ 
                                           
                                            ?>
                                            <tr style="font-size:10px">                                                
                                                <td><?php echo $j; ?></td>
                                                <td><?php echo $inquiries[$i]['inquiry_no']; ?></td>
                                                <td><?php if($inquiries[$i]['inquiry_type'] == 'Online'){ 
                                                    $url    =  $inquiries[$i]['draft'];
                                                    ?>
                                                    <a target="_blank" href="<?php echo $url;?>"> <?php echo ucfirst($inquiries[$i]['name']);?></a>
                                                <?php }else{ echo ucfirst($inquiries[$i]['name']); }?>
                                                </td>
                                                <td class="hidden-480"><?php echo $inquiries[$i]['contact']; ?></td>
                                                <td class="hidden-phone"><?php echo $inquiries[$i]['program_name']; ?></td>
                                                <td class="hidden-phone"><?php echo $inquiries[$i]['reference_source']; ?></td>
                                                <td class="hidden-phone"><?php echo $inquiries[$i]['inquiry_type']; ?></td>
                                                <td class="hidden-phone"><?php
                                                if($inquiries[$i]['admission_stage'] == 0)
                                                    {
                                                        echo 'Inquiry'; 
                                                    }
                                                elseif ($inquiries[$i]['admission_stage'] == 1) 
                                                    {
                                                        echo 'Initial Form'; 
                                                    }
                                                elseif ($inquiries[$i]['admission_stage'] == 2) 
                                                    {
                                                        echo 'Accounts'; 
                                                    }
                                                elseif ($inquiries[$i]['admission_stage'] == 3) 
                                                    {
                                                        echo 'Admission'; 
                                                    }
                                                ?></td>    
                                                
                                                <td class="hidden-phone"><?php echo(date("d-M-Y",@strtotime($inquiries[$i]['inquiry_date']))); ?></td>


                                              
                                                <td class="td-actions">
                                                      <?php if($inquiries[$i]['admission_stage'] == 0)
                                                    {                                           
                                                    ?>
                                                    <div class="hidden-phone visible-desktop action-buttons">
                                                       
                                                        <a class="green" href="<?php echo base_url()?>admission_r/edit_inquiry/?inquiry_id=<?php echo $inquiries[$i]['inquiry_id']; ?>">
                                                            <i class="icon-pencil bigger-130"></i>
                                                        </a>
                                                        |
                                                         <a  data-rel="popover" data-placement="left" title="Remarks" data-content="<?php echo $inquiries[$i]['remarks'];?>">
                                                            <i class="icon-comment-alt"></i>
                                                        </a>
                                                        
                                                        |

                                                        
                                                        <a class="green" href="<?php echo base_url()?>admission_r/sale_prospectus_form/?inquiry_id=<?php echo $inquiries[$i]['inquiry_id']; ?>">
                                                            Sale Prospectus
                                                        </a>
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

                                            <?php $j++; } ?>
                                            
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
        
        
      });

    </script>
      