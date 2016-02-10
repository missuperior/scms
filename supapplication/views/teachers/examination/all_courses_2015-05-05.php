<?php 
//echo '<pre>';
//var_dump($info);
//echo '</pre>';
//exit;
?>
<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
						
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
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>							
                <div class="row-fluid">
                    <div class="span12">                                                                     
                            <div class="row-fluid">                                             
                                    <?php
                                    $count = count($info);
                                    if($count > 0 ){
                                        
                                    ?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">All Courses</h3>                                       
                                    </div>                                   
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead>                                       
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Program Name</th>
                                                <th>Course Name</th>
                                                <!--<th>Semester</th>-->
                                                <th>Session</th>                                                                                                                                        
                                                <th>Course Section</th>                                                                                                                                        
                                                <th>Action</th>                                                                                                                                        
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php     
                                        
                                        
                                        
                                        for($i=0; $i < $count ;$i++){ ?>
                                           
                                             <tr style="font-size: 10px">

                                                            <td><?php echo $i+1; ?></td>
                                                            <td><?php echo $info[$i]['program_name']; ?></td>
                                                            <td><?php echo $info[$i]['course_name']; ?></td>                                                                                                                        
<!--                                                            <td><?php echo $info[$i]['semester']; ?></td>-->
                                                            
                                                            <td><?php echo $info[$i]['session']; ?></td>
                                                            <td><?php echo $info[$i]['course_section']; ?></td>
                                                            <td>
                                                               <?php if($mid[$i] == 0){?>
                                                                
                                                                        <a  href="<?php echo base_url();?>teachers/define_mid_structure_form/?course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                           Define  Mid                                                                    
                                                                        </a>
                                                                
                                                                <?php }else{?>
                                                                
                                                                        <a  href="<?php echo base_url();?>teachers/view_mid_structure/?course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                           View Mid                                                                    
                                                                        </a>
                                                                
                                                                <?php }?>                                                                
                                                                | 
                                                                <?php if($final[$i] == 0){?>
                                                                
                                                                    <a  href="<?php echo base_url();?>teachers/define_final_structure_form/?course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                         Define Final
                                                                    </a>
                                                                
                                                                <?php }else{?>   
                                                                
                                                                    <a  href="<?php echo base_url();?>teachers/view_final_structure/?course_id=<?php echo $info[$i]['course_id'];?>&program_id=<?php echo $info[$i]['program_id'];?>&semester=<?php echo $info[$i]['semester'];?>&course_section=<?php echo $info[$i]['course_section'];?>&batch_id=<?php echo $info[$i]['batch_id'];?>&session_id=<?php echo $info[$i]['current_session_id'];?>">
                                                                         View Final
                                                                    </a>
                                                                
                                                                <?php } ?>
                                                                Structure
                                                            </td>
                                                       </tr>                                       
                                        <?php }?>                                            
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="12">Powered By : Superior Solutionz</td></tr>                                        
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
