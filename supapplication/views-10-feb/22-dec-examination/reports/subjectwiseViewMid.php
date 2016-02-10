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
                                    <?php if(count($students) > 0 ){?>
                                    <div class="table-header">
                                        <h3 id="title">Subject Wise Result Report</h3>
                                    </div>
                                
                                    <a target="_blank"  href="<?php echo base_url(); ?>examination/subject_wise_report_print/<?php echo $campaign_id;?>/<?php echo $program_id;?>/<?php echo $course_id;?>/<?php echo $exam_type;?>/<?php echo $semester;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>                                
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                            
                                           <tr style="font-size: 10px">
                                             <td colspan="5"><img width="60" src="<?php echo base_url();?>assets/images/logo1.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group Of Colleges</b></td>
                                               <td colspan="5"><h3 style="text-align:right">Subject Wise Result report</h3></td>
                                           </tr>
                                           
                                           <tr style="font-size: 10px">
                                               <td colspan="1"><b><?php  echo $students[0]['campus_name']; ?></b></td>
                                               <td colspan="1"><b><?php  echo $students[0]['program_name']; ?></b></td>
                                               <td colspan="2"><b><?php echo $students[0]['course_name']; ?></b></td>
                                               <td colspan="1"><b><?php echo '  '.$students[0]['batch_type'].' '.$students[0]['batch']; ?></b></td>
                                               <td colspan="2"><b><?php  echo 'Semester 0'.$students[0]['semester']; ?></b></td>
                                               <td colspan="1"><b>Exam Type : <?php echo 'Mid'; ?></b></td>
                                           </tr>                                           
                                          
                                            <tr style="font-size: 10px">
                                                <th>Roll #</th>
                                                <th>Student Name</th>                                                
                                                <th><?php echo $structure->mid_title_1.'('.$structure->mid_value_1.')';?></th>
                                                <th><?php echo $structure->mid_title_2.'('.$structure->mid_value_2.')';?></th>
                                                <th><?php echo $structure->mid_title_3.'('.$structure->mid_value_3.')';?></th>                                                
                                                <th>Total (<?php echo $total; ?>)</th>
                                                <th>%age</th>
                                                <th>Grade</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody>
                                        <?php foreach($students as $row){ 
                                            
                                            $total_obtained   =   $row['mid_value_1'] + $row['mid_value_2'] + $row['mid_value_3'];                                            
                                            $percentage = $total_obtained/$total*100;
                                            
                                            if($percentage < 50){$grade = 'F';}
                                            if($percentage >= 50 && $percentage < 60){$grade = 'D';}
                                            if($percentage >= 60 && $percentage < 70){$grade = 'C';}
                                            if($percentage >= 70 && $percentage < 80){$grade = 'B';}
                                            if($percentage >= 80 ){$grade = 'A';}
                                            
                                            ?>
                                          <tr>
                                            <td><?php echo $row['roll_no']; ?></td>
                                            <td><?php echo $row['student_name']; ?></td>
                                            <td><?php echo $row['mid_value_1']; ?></td>
                                            <td><?php echo $row['mid_value_2']; ?></td>
                                            <td><?php echo $row['mid_value_3']; ?></td>
                                            <td><?php echo $total_obtained; ?></td>
                                            <td><?php echo number_format("$percentage",2); ?></td>
                                            <td><?php echo $grade; ?></td>
                                          </tr>
                                          <?php } ?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="11">Powered By : Superior Solutionz</td></tr>
                                        
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