<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Accounts </a>
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
                            <h5 class="lighter">Search Students</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main" style="min-height: 100px">
                                <form class="form-horizontal" name="searchChallan" id="searchChallan" method="POST" action="<?php echo  base_url()?>accounts/freeze_left_view" enctype="multipart/form-data" />
                                                    
                                <div class="control-group" style=" float: left;margin-top: 22px;  width: 400px;">
                                    <label style="width: 130px;" class="control-label" for="email">Campaign:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                    <div class="controls" style="margin-left: 140px;">
                                        <div class="span12">
                                            <select style="width: 200px;" id="campaign" name="campaign" class="chzn-select" data-placeholder="Click to Choose...">                                               
                                                <?php foreach ($campaign as $row) { ?>
                                                    <option <?php if (set_value('campaign') == $row['campaign_id']) echo '"selected=selected"' ?> value="<?php echo $row['campaign_id'] ?>"><?php echo $row['campaign_name'] ?></option> 
                                                <?php } ?>																			
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="control-group" style=" float: left;margin-top: 22px;  width: 400px;">
                                    <label style="width: 130px;" class="control-label" for="email">Program:<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

                                    <div class="controls" style="margin-left: 140px;">
                                        <div class="span12">
                                            <select onchange="proSection(this.value)" style="width: 200px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">                                                
                                                <?php foreach ($programs as $row) { ?>
                                                    <option <?php if (set_value('program') == $row['program_id'])
                                                    echo '"selected=selected"'
                                                        ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
                                                    <?php } ?>																	
                                                <option value="0">All</option>								
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
                   </a>
                </h4>							
            
              <?php if(count($form_data) > 0 ){ ?>
                <div class="row-fluid">
                    <div class="span12">                                                                     

                                <div class="row-fluid">                                    
                                    <div class="table-header">
                                       <h3>All Forms</h3>
                                    </div>
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Form #</th>
                                                <th>Student Name</th>
                                                <th>Roll No</th>
                                                <th>Batch</th>                                                                                            
                                                <th>Date</th> 
                                                <th>Status</th> 
                                                <th>Actions</th> 
                                                
                                              </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                             $i = 0;
                                             foreach ($form_data as $row){
                                                 
                                                 $this->load->model('Admission_r_model');
                                                 $result    = $this->Accounts_model->checkPackage($row['student_id']);
                                                 
                                                 ?>
                                            <tr>                                                                                        
                                                <td><?php echo $i+1;  ?></td>
                                                <td><?php echo $row['form_no']; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>
                                                <td><?php echo $row['roll_no']; ?></td>
                                                <td><?php echo $row['batch']; ?></td>                                               
                                                <td><?php echo(date("d-M-Y",strtotime($row['form_submit_date']))); ?></td>
                                                <td><?php echo $row['status']; ?></td>
                                                <td>
                                                
                                                 <?php if ($row['status'] == 'ok'){?>   
                                                    <a onclick="return confirm('Are You Sure ?');" class="green" href="<?php echo base_url()?>accounts/freeze_left/?student_id=<?php echo $row['student_id']; ?>&status=left">
                                                            Left
                                                    </a> |
                                                    <a onclick="return confirm('Are You Sure ?');" class="green" href="<?php echo base_url()?>accounts/freeze_left/?student_id=<?php echo $row['student_id']; ?>&status=freeze">
                                                            Freeze
                                                    </a>
                                                  <?php }else{?>                                                    
                                                        <a onclick="return confirm('Are You Sure ?');" class="green" href="<?php echo base_url()?>accounts/freeze_left/?student_id=<?php echo $row['student_id']; ?>&status=ok">
                                                            Active
                                                        </a>                                                    
                                                  <?php }?>
                     
                                                </td>
                                             </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>   
              <?php }else{?>
                        <div class="table-header">
                              <h3>Record Not Found, Please try again.</h3>
                        </div>
              <?php } ?>
                
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
      });
      
     
    </script>