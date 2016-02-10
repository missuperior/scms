<div class="main-content" style="margin-left: 200px">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">ENTRY TEST MODULE</a>
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
                                    <?php if(count($programslist) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">Students Award List</h3>                                       
                                    </div>  
                                <form class="form-horizontal" id="batchform" method="POST" action="<?php echo base_url() ?>admission_r/add_marks" enctype="multipart/form-data" />
                                    <table id="sample-table" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="4"><b style="  font-size: 22px;    margin-left: 10px;"><?php echo $programslist[0]['room_name'];?></b></td>
                                               <td
                                           </tr>

                                            <tr style="font-size: 10px">                                                
                                                 <th>#</th>
                                                <th>FORM #</th>
                                                <th>Name</th>                                                                                    
                                                <th class="hidden-phone">Program </th>                                                
                                                <th class="hidden-phone">MARKS </th>                                                                                       
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php 
                                        $c = 0;
                                        for($i=0; $i<count($programslist);$i++){  
                                              
                                                $result   = $this->Entrytest_model->getStudents($programslist[$i]['program_id'],$programslist[$i]['start_form_id'],$programslist[$i]['last_form_id']);  
                                                
                                                for($j=0; $j < count($result); $j++){
                                            ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $c+1; ?></td>
                                                <td>
                                                    <?php echo $result[$j]['form_no']; ?>
                                                    <input type="hidden" name="form_no[]" value="<?php echo $result[$j]['form_no'];?>" >
                                                    <input type="hidden" name="room_id[]" value="<?php echo $programslist[0]['room_id'];?>" >
                                                    <input type="hidden" name="test_id[]" value="<?php echo $programslist[0]['test_id'];?>" >
                                                    
                                                    <?php 
                                                         // set the format of mobile num to 923016506016
                                                            $explode_num     =   explode("-",$result[$j]['mobile']);
                                                            $mobile          =   $explode_num[0].$explode_num[1];
                                                            $mobile_trim     =   trim($mobile,'0');
                                                            $number          =   '92'.$mobile_trim;
                                                    ?>
                                                    
                                                    <input type="hidden" name="mobile[]" value="<?php echo $number;?>" >
                                                </td>
                                                <td>
                                                    <?php echo $result[$j]['student_name']; ?>
                                                    <input type="hidden" name="student_name[]" value="<?php echo $result[$j]['student_name'];?>" >
                                                </td>
                                                <td>
                                                    <?php echo $result[$j]['program_name']; ?>
                                                    <input type="hidden" name="program[]" value="<?php echo $result[$j]['program_id'];?>" >
                                                </td>
                                                <td>
                                                    <input type="text" maxlength="2" id="mark" name="marks[]" >
                                                    <input type="hidden" name="form_id[]" value="<?php echo $result[$j]['initial_form_id'];?>" >
                                                </td>
                                                
                                           </tr>                                            
                                                <?php  $c++; } } ?>                                            
                                        </tbody>
                                                   
                                    </table>
                                
                                    <div style="width:100%; text-align: right">                                                
                                        <input  style="width:100px; height: 40px" class="btn btn-success btn-next" type="submit" value="Submit" />
                                    </div>
                                            
                                    </form>
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

 <script type="text/javascript">

//       function checkValidation(){
//           var val = $("#mark").val();
//           if(val == '')
//           {
//               alert('Please Fill All the fields');
//               $("#mark").focus();
//               return false;
//           }
      // }
       
       
       $( "#batchform" ).submit(function( event ) {
        
           var val = $("#mark").val();
           if(val == '')
           {
               alert('Please Fill All the fields');
               event.preventDefault();
               //return false;
           }
        
        });
       
       
        </script>   