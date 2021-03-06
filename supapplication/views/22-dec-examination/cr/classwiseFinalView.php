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
                                        <h3 id="title">Class Summary Report</h3>
                                    </div>
                                
                                    <a  href="<?php echo base_url(); ?>examination/view_final_result_summary_cr_print/<?php echo $program_id;?>/<?php echo $section;?>/<?php echo $batch_id;?>/<?php echo $session_id;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="6"><img width="60" src="<?php echo base_url();?>assets/images/logo1.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group Of Colleges</b></td>
                                               <td colspan="6"><h3 style="text-align:right">Class Wise Report</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="3"><b><?php  echo $students[0]['campus_name']; ?></b></td>
                                               <td colspan="2"><b><?php echo $students[0]['batch_type'].' '.$students[0]['batch']; ?></b></td>
                                               <td colspan="4"><b><?php  echo $students[0]['program_name']; ?></b></td>
                                               <td colspan="4"><b>Exam Type : <?php echo 'Final'; ?></b></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Roll No</th>
                                                <th>Student Name</th>
                                                <?php 
                                                  $student_id =   $students[0]['student_id'];
                                                  $totall=0;
                                                  $final_marks = 0;
                                                    for($i=0; $i < count($students); $i++)
                                                    {
                                                        if($student_id == $students[$i]['student_id']){
                                                ?>      
                                                
                                                <th><?php    
                                                
                                                            $data                       =   array('program_id'=>$program_id, 'course_id'=>$students[$i]['final_course'], 'section'=>$section, 'batch_id'=>$batch_id, 'session_id'=>$session_id);
                                                            $mid                        =   $this->Examination_model->getMidStructure($data);
                                                            $final                      =   $this->Examination_model->getFinalStructure($data);

                                                            $total_marks           =   $mid->mid_value_1+$mid->mid_value_2+$mid->mid_value_3+$final->final_value_1+$final->final_value_2+$final->final_value_3+$final->final_value_4+$final->final_value_5+$final->final_value_6+$final->final_value_7;
                                                            
                                                           $lab_marks   =   $this->Examination_model->getLabMarksStructure($program_id , $batch_id,$students[$i]['final_course']  ,$session_id);
                                                           $total_marks =   $total_marks + $lab_marks;
                                                            $totall = $totall+$total_marks;
                                                            echo $students[$i]['course_name'].'('.$total_marks.')';?></th>
                                                    <?php }} ?>
                                                <th>G.P.A</th>
                                                <th>Obtained</th>
                                                <th>Total</th>
                                                <th>CGPA</th>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $id = 0;
                                       
                                        for($c=0; $c < count($students); $c++){   
                                            
                                            
                                            if($id != $students[$c]['student_id']){
                                                $fail_subjects  =   $this->Examination_model->getFailSubjectsCR($students[$c]['student_id'],$batch_id);
                                            
                                            ?>
                                          <tr>
                                            <td><?php echo $students[$c]['roll_no']; ?></td>
                                            <td><?php echo $students[$c]['student_name']; ?></td>
                                            
                                             <?php 
                                                $totall_obtained = 0;
                                                  $reg_id =   $students[$c]['student_id'];
                                                  $count = 0;
                                                  $gpa = 0;
                                                   $marks=0;
                                                  
                                                    for($i=$c; $i < count($students); $i++)
                                                    {
                                                        if($reg_id == $students[$i]['student_id']){
                                                            $count++;
                                                ?>      
                                                
                                                <td><?php 
                                                            $labi = 0;
                                                            // hceck lab
                                                            $labi       =  $this->Examination_model->getLabMarks($students[$c]['student_id'],$batch_id,$students[$i]['final_course'], $session_id);
                                                            
                                                            if(count($labi) > 0){
                                                                                $totall_obtained = $students[$i]['obtained']+$labi[0]['final_value_1'];
                                                            }else{
                                                                                $totall_obtained = $students[$i]['obtained'];
                                                            }
                                                          
                                                                                                                                                                                      
                                                            $res    = $this->Examination_model->calculateGpa($totall_obtained,0,'final');
                                                            $gpa    =   $gpa + $res; 
                                                            $t_marks = $totall_obtained;
                                                            if($t_marks < 50 ){ echo $t_marks.' (F)';$marks++;}else{ echo $totall_obtained;}   
                                                        
                                                        ?>
                                                </td>
                                                
                                            <?php } }
                                                        $gpaa = $gpa/$count;
                                                        
                                                        if($session_id > $students[$c]['enrolled_session_id']){                                                        
                                                            $cgpa   =   $this->Examination_model->getLastGpa($students[$c]['student_id'],$gpaa);           
                                                        }else{
                                                            $cgpa = $gpaa;
                                                        }
                                              ?>
                                                
                                            <td><?php if($marks > 0){echo 'Fail';}else{echo number_format("$gpaa",2);}?></td>
                                            <td><?php echo $totall_obtained;?></td>
                                            <td><?php echo $totall;?></td>
                                            <td><?php if($fail_subjects > 0){echo 'Fail';}else{echo number_format("$cgpa",2);}?></td>
                                          </tr>
                                        <?php } 
                                            $id = $students[$c]['student_id'];
                                                        }?>
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="118">Powered By : Superior Solutionz</td></tr>
                                        
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