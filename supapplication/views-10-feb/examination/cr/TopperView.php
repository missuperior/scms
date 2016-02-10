<?php //echo '<pre>'; print_r($toppers);die;?>
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
                                    <?php if(count($toppers) > 0 ){?>
                                    <div class="table-header">
                                        <h3 id="title">Topper List</h3>
                                    </div>
                                
<!--                                    <a  href="<?php echo base_url(); ?>examination/class_wise_report_print/<?php echo $campaign_id;?>/<?php echo $program_id;?>/<?php echo $exam_type;?>/<?php echo $semester;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>-->
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/images/logo1.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group Of Colleges</b></td>
                                               <td colspan="4"><h3 style="text-align:left">Toppers List</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="3"><b><?php  echo 'Session '.$session_id; ?></b></td>
                                               <td colspan="4"><b><?php  echo $toppers[0]->program_name; ?></b></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Sr #</th>
                                                <th>Roll No</th>
                                                <th>Student Name</th>
                                                <th>GPA</th>                                               
                                                <th>Obt Marks</th>                                               
                                                <th>Total Marks</th>                                               
                                                <th>Position</th>                                               
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $total = count($toppers);
                                        $count = 0;
                                        for($c=0; $c < $total; $c++){ 
                                                $fail_subjects  =   $this->Examination_model->getFailSubjectsCR($toppers[$c]->student_id,$batch_id,$session_id);
                                                if($fail_subjects == 0){                                                    
                                                   if($count == 3) break;
                                                   
                                                   // for calculating total obtained marks
                                                   
                                                   $marks              =   $this->Examination_model->getTotalMarks_cr($toppers[$c]->student_id,$session_id,$batch_id);
                                                   $labmarks           =   $this->Examination_model->getTotalMarks_crLab($toppers[$c]->student_id,$session_id,$batch_id);
                                                   
                                                   $total_marks =   0;
                                                   $total_lab_marks =   0;
                                                   $total_subjects = 0;
                                                   
                                                   foreach($marks AS $row){
                                                       $total_marks = $total_marks + $row['marks'];
                                                       $total_subjects++;
                                                   }
                                                   
                                                   foreach($labmarks AS $row){
                                                       $total_lab_marks = $total_lab_marks + $row['labmarks'];
                                                   }
                                                   
                                                   $totalMarks  =   $total_lab_marks + $total_marks;
                                            ?>                                                                                     
                                          <tr>
                                            <td><?php echo $c+1; ?></td>
                                            <td><?php echo $toppers[$c]->roll_no; ?></td>
                                            <td><?php echo $toppers[$c]->student_name; ?></td>
                                            <td><?php 
                                            $gpa  = $toppers[$c]->gpa;
                                            echo number_format("$gpa",2);
                                            ?></td>
                                            <td><?php echo $totalMarks;?></td>
                                            <td><?php echo 100*$total_subjects;?></td>
                                            <td>
                                                <?php 
                                                    if($c==0){echo 'First'; }
                                                    if($c==1){echo 'Second'; }
                                                    if($c==2){echo 'Third'; }
                                                ?>
                                            </td>
                                          </tr> 
                                        <?php   $count++; } } ?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="7">Powered By : Superior Solutionz</td></tr>
                                        
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