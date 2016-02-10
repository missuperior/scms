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
                                
                                    <a  href="<?php echo base_url(); ?>examination/view_mid_result_summary_cr_print/<?php echo $program_id;?>/<?php echo $section;?>/<?php echo $batch_id;?>/<?php echo $session_id;?>">
                                        <img src="<?php echo base_url(); ?>assets/images/print.png" border="0" style="float: left; margin-left: 27px" />
                                    </a>
                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>
                                           <tr style="font-size: 10px">
                                             <td colspan="5"><img width="60" src="<?php echo base_url();?>assets/images/logo1.png" /><b style="  font-size: 20px;    margin-left: 10px;">Superior Group Of Colleges</b></td>
                                               <td colspan="6"><h3 style="text-align:right">Class Wise Report</h3></td>
                                           </tr>
                                           <tr style="font-size: 10px">
                                               <td colspan="2"><b><?php  echo $students[0]['campus_name']; ?></b></td>
                                               <td colspan="2"><b><?php echo $students[0]['batch_type'].' '.$students[0]['batch']; ?></b></td>
                                               <td colspan="4"><b><?php  echo $students[0]['program_name']; ?></b></td>
                                               <td colspan="4"><b>Exam Type : <?php echo 'Mid'; ?></b></td>
                                           </tr>
                                         
                                            <tr style="font-size: 10px">
                                                <th>Roll No</th>
                                                <th>Student Name</th>
                                                <?php 
                                                  $student_id =   $students[0]['student_id'];
                                                  $totall=0;
                                                  $mid_marks = 0;
                                                    for($i=0; $i < count($students); $i++)
                                                    {
                                                        if($student_id == $students[$i]['student_id']){
                                                ?>      
                                                
                                                <th><?php 
                                                    
                                                    $mid_marks   =  $this->Examination_model->getMidTotal_cr($program_id,$students[$i]['course_id'],$section,$batch_id,$session_id);        
                                                    
                                                    $total_marks = $mid_marks;
                                                    $totall = $totall+$total_marks;
                                                    echo $students[$i]['course_name'].'('.$total_marks.')';?></th>
                                                    <?php }} ?>
                                                <th>G.P.A</th>
                                                <th>Obtained</th>
                                                <th>Total</th>
                                            </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $id = 0;
                                        for($c=0; $c < count($students); $c++){                                            
                                            if($id != $students[$c]['student_id']){
                                            ?>
                                          <tr>
                                            <td><?php echo $students[$c]['roll_no']; ?></td>
                                            <td><?php echo $students[$c]['student_name']; ?></td>
                                            
                                             <?php 
                                                $totall_obtained = 0;
                                                  $reg_id =   $students[$c]['student_id'];
                                                  $count = 0;
                                                  $gpa = 0;
                                                  
                                                    for($i=$c; $i < count($students); $i++)
                                                    {
                                                        if($reg_id == $students[$i]['student_id']){
                                                            $count++;
                                                ?>      
                                                
                                                <td><?php 
                                                      
                                                            $totall_obtained = $totall_obtained + $students[$i]['obtained'];                                                            
                                                            echo $students[$i]['obtained'];    
                                                            $res    = $this->Examination_model->calculateGpa($students[$i]['obtained'],$mid_marks,$exam_type);
                                                            $gpa    =   $gpa + $res; 
                                                        
                                                        ?>
                                                </td>
                                                
                                            <?php } }
                                            $cgpa = $gpa/$count;
                                              ?>
                                                
                                            <td><?php echo number_format("$cgpa",2);?></td>
                                            <td><?php echo $totall_obtained;?></td>
                                            <td><?php echo $totall;?></td>
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