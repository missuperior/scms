<div class="main-content" style="margin-left: 0px;margin-left: 200px;">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none;">CONDUCTED INTERVIEW LISTING </a>
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
                                    <?php //echo '<pre>';var_dump($all_listings);echo '</pre>';exit;
                                    
                                    if(count($all_listings) > 0 ){?>                                    
                                    <div class="table-header">                                        
                                        <h3 id="title">View Interview Listings</h3>                                       
                                    </div>        
                                
                                <form  class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission_r/save_interview_list" enctype="multipart/form-data" />
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           <tr style="font-size: 10px">                                               
                                               <td colspan="3"><img width="60" src="<?php echo base_url();?>assets/avatars/challan_logo.png" /><b style="  font-size: 22px;    margin-left: 10px;">Superior University</b></td>
                                               <td colspan="3"><h2 style="text-align:right">View Interview Listings</h2></td>
                                           </tr>
                                           <!--<tr style="font-size: 10px">                                                
                                               <td colspan="2"><b>Campus : <?php echo $all_listings[0]['campus_name']; ?></b></td>
                                                <td colspan="2"><b>Campaign : <?php echo $all_listings[0]['campaign_name']; ?></b></td>
                                                <td colspan="2" style="text-align: center; color: maroon"><b >Date: <?php echo date("d-M-Y"); ?></b></td>
                                           </tr>-->
                                            <tr style="font-size: 10px">                                                
                                                <th>Sr #</th>
                                                <th>Form no</th>
                                                <th>Name</th>
                                                <th>Program Name</th>
                                                <th>Conduct date</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                        <?php                                                                                 
                                        for($i=0; $i<count($all_listings);$i++){  ?>
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td> <?php echo $all_listings[$i]['form_no']; ?></td>
                                                <td><?php echo $all_listings[$i]['name']; ?></td>
                                                <td><?php echo $all_listings[$i]['program_name']; ?></td>
                                                <td><?php echo $all_listings[$i]['interview_datetime']; ?></td>
                                           </tr>                                            
                                            <?php } ?>                                            
                                        </tbody>
                                        <tr><td style="text-align: right" colspan="6">Powered By : Superior Solutionz</td></tr>                                        
                                    </table>
                                    <div class="row-fluid wizard-actions">
<!--                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Submit                                          
                                            </button>-->
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
//    function save_intrevirew(form_id,form_no,name,program_id,opertaor_id,date,entrytest_result_id){
//        //alert(form_id+form_no+'=>'+name+'=>'+program_id+'==>'+opertaor_id+'==>'+date+'=>'+entrytest_result_id);
//        
//        $.ajax({
//            type: "POST",
//            data:{
//                form_id     : form_id,
//                form_no     : form_no,
//                name        : name,
//                program_id  : program_id,
//                opertaor_id : opertaor_id,
//                date: date,
//                entrytest_result_id: entrytest_result_id
//            },
//            url: "<?php echo base_url();?>admission_r/SinfoInter",
//            success:function(data){
//                if(data == 'Already exists'){
//                    alert('Already exists');
//                }
//                else{
//                    alert('Saved');
//                }
//            },
//            error: function(){
//                alert('Some Error Occured, Please Try Again');
//            }
//        });
    }

</script>
    