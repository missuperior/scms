<div class="main-content" >
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
                                    <?php if(count($students) > 0 ){?>
                                    <div class="table-header">
                                        <h3 id="title">ATTENDANCE SHEET</h3>
                                    </div>
                                
                                    <a  href="<?php echo base_url(); ?>examination/attendance_sheet_print/<?php echo $campaign_id;?>/<?php echo $program_id;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo2.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior University Lahore</b></td>
                                               <td colspan="3"><h3 style="text-align:left">Attendance Sheet</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="3"><b><?php  echo $students[0]['program_name']; ?></b></td>
                                               <td colspan="3"><b><?php echo $students[0]['batch_type'].' '.$students[0]['batch']; ?></b></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Sr #</th>
                                                <th>Roll No</th>
                                                <th>Student Name</th>                                                
                                                <th>Sheet #</th>
                                                <th>Continuation Sheet</th>
                                                <th>Signature</th>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php 
                                        
                                        for($i=0; $i < count($students); $i++){?>
                                          <tr>
                                            <td><?php echo $i+1; ?></td>
                                            <td><?php echo $students[$i]['roll_no']; ?></td>
                                            <td><?php echo $students[$i]['student_name']; ?></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                          </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="6">Powered By : Superior Solutionz</td></tr>
                                        
                                    </table>
                                    <?php }else{?>
                                    <div class="table-header">
                                       <h3>Record Not Found</h3>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                </div><!--/.span-->
            </div><!--/.row-fluid-->
        </div><!--/.page-content-->
    </div><!--/.main-content-->
</div><!--/.main-container-->
<script src="<?php echo base_url();?>assets/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/js/dataTables.tableTools.js"></script>