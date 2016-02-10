<div class="main-content" style="margin-left: 0px">
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
                                    <?php if(count($failure_result) > 0 ){?>
                                    <div class="table-header">
                                        <h3 id="title">Class Failure Report</h3>
                                    </div>
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                               <td><h3 style="text-align:right">Class Failure Report</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td><b>Campus : <?php  echo $failure_result[0]['campus_name']; ?></b></td>
                                               <td><b>Campaign : <?php echo $failure_result[0]['campaign_name']; ?></b></td>
                                               <td><b>Session : <?php  echo 'Part '.$failure_result[0]['part']; ?></b></td>
                                               <td style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y", strtotime($date))); ?></b></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td><b>Program : <?php  echo $failure_result[0]['program_name']; ?></b></td>
                                               <td><b>Section : <?php if($section == ''){ echo 'All';}else{echo $failure_result[0]['section'];} ?></b></td>
                                               <td><b>Subject : <?php if($subject == ''){ echo 'All';}else{echo $failure_result[0]['subject_name'];} ?></b></td>
                                               <td><b><?php echo $failure_result[0]['exam_type']; ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Roll #</th>
                                                <th>Student Name</th>
                                                <th colspan="2">Subject - Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $std_id = 0; 
                                        foreach($failure_result as $key => $row){
                                          if($row['student_id'] != $std_id){
                                          ?>
                                          <tr>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['student_name']; ?></td>
                                            <td colspan="2"><?php
                                              foreach($failure_result as $k => $v){
                                                if($row['student_id'] == $v['student_id']){
                                                  echo $v['subject_name'].' - '.$v['obtained_marks'].', ';
                                                }
                                              }
                                            ?></td>
                                          </tr>
                                          <?php } $std_id = $row['student_id']; } ?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="4">Powered By : Superior Solutionz</td></tr>
                                       <tr>
                                          <td colspan="6">
                                            <div style="float: right; margin-top: 100px; font-weight: bold;">                                                
                                                <hr style="height:1px; border:none; color:#333; background-color:#333;" />
                                                <?php echo ucwords($row['controller_name']); ?><br/>
                                                Controller of Examination
                                              </div>
                                          </td>
                                        </tr>
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