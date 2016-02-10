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
                                    <?php if(count($result_summary) > 0 ){
                                      $total_subejcts = count($subjects);
                                    ?>
                                    <div class="table-header">
                                        <h3 id="title">Class Result Summary Report</h3>
                                    </div>
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="<?php $c = 2+$total_subejcts; echo $c; ?>"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group of Colleges</b></td>
                                             <td colspan="3"><h3 style="text-align:right">Class Result Summary Report</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="<?php $c = 1+$total_subejcts; echo $c; ?>"><b>Campus : <?php  echo $result_summary[0]['campus_name']; ?></b></td>
                                               <td colspan="2"><b>Campaign : <?php echo $result_summary[0]['campaign_name']; ?></b></td>
                                               <td><b>Session : <?php  echo 'Part '.$result_summary[0]['part']; ?></b></td>
                                               <td style="text-align: center; color: maroon"><b ><?php echo(date("d-M-Y", strtotime($date))); ?></b></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="<?php $c = 1+$total_subejcts; echo $c; ?>"><b>Program : <?php  echo $result_summary[0]['program_name']; ?></b></td>
                                               <td colspan="2"><b>Section : <?php if($section == ''){ echo 'All';}else{echo $result_summary[0]['section'];} ?></b></td>
                                               <td colspan="2"><b><?php echo $result_summary[0]['exam_type']; ?></b></td>
                                           </tr>
                                            <tr style="font-size: 10px">
                                                <th>Roll #</th>
                                                <th>Student Name</th>
                                                <?php $id = $result_summary[0]['student_id'];
                                                foreach($result_summary as $v){ 
                                                  if($v['student_id'] == $id){
//                                                ?>
                                                <th><?php echo $v['subject_name'].' - '.$v['total_marks']; ?></th>
                                                <?php }else{ break; }} ?>
                                                <th>Total Obtained</th>
                                                <th>Total Marks</th>
                                                <th>%age</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $std_id = 0; $total_obt = 0; $total_subjects = 0;
                                            foreach($result_summary as $row){
                                                if($row['student_id'] != $std_id){
                                          ?>
                                          <tr>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['student_name']; ?></td>
                                            <?php
                                              foreach($result_summary as $value){
                                                if($row['student_id'] == $value['student_id']){                                                  
                                             ?>
                                            <td><?php 
                                            $total_obt       = $total_obt + $value['obtained_marks'];
                                            $total_subjects  = $total_subjects + $value['total_marks'];
                                              echo $value['obtained_marks']; ?></td>
                                            <?php
                                              }}
                                            ?>
                                          <td><?php echo $total_obt; ?></td>                                            
                                          <td><?php echo $total_subjects; ?></td>                                            
                                          <td><?php echo number_format($total_obt/$total_subjects*100).' %'; ?></td>                                            
                                          </tr>
                                          <?php }
                                          $std_id = $row['student_id'];
                                          $total_obt = 0;
                                          $total_subjects = 0;
                                          } ?>
                                    </tbody>
                                        <tr>
                                          <td colspan="<?php $c = 6+$total_subejcts; echo $c; ?>">
                                            <div style="float: right; margin-top: 100px; font-weight: bold;">                                                
                                                <hr style="height:1px; border:none; color:#333; background-color:#333;" />
                                                <?php echo ucwords($row['controller_name']); ?><br/>
                                                Controller of Examination
                                              </div>
                                          </td>
                                        </tr>
                                        <tr><td style="text-align: right" colspan="4">Powered By : Superior Solutionz</td></tr>
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