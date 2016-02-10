<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">Admission Reports</a>                
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
        <div class="page-header position-relative">
            <h1>
                Status Report
            </h1>
        </div><!--/.page-header-->

        
        <div class="row-fluid" >
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> </a>
                </h4>
        
        <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Form</h5>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <form style="margin-bottom: 20px" class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission_reports/search_inquiry_no" enctype="multipart/form-data" />
                                <input style="width: 188px;" type="text" name="inquiry_no" id="inquiry_no" value="<?php echo $inquiry_no; ?>" style="width: 300px;" class="input-medium search-query" placeholder="Enter Inquiry No"/>                                
                                <button class="btn btn-purple btn-small" >
                                    Search
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                                </form>
                                
                                <form class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission_reports/search_form_no" enctype="multipart/form-data" />
                                <input style="width: 188px;" type="text" name="form_no" id="form_no" value="<?php echo $form_no; ?>" style="width: 300px;" class="input-medium search-query" placeholder="Enter Form No"/>                                
                                <button class="btn btn-purple btn-small" >
                                    Search
                                    <i class="icon-search icon-on-right bigger-110"></i>
                                </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        
        
    </div><!--/.page-content-->  
</div><!--/.main-content-->
							

                <div class="row-fluid" style="margin-bottom: 60px; margin-top: 50px">
                    <div class="span12">                                                                     


                                <div class="row-fluid">         
                                                                                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           
                                            <tr style="font-size: 10px">                                                
                                                <th colspan="10" style="color: #045454; font-size: 20px;">Inquiry Information</th>                                                
                                            </tr>
                                            <tr style="font-size: 12px;     color: #4C4747;">                                                
                                                <th>Inq #</th>
                                                <th>Name</th>
                                                <th>Contact</th>
                                                <th>Program</th>                                                
                                                <th>Shift</th>
                                                <th>Qualification</th>                                                
                                                <th>Reference</th>
                                                <th>Institute</th>                                                
                                                <th>Date</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                          <?php if(count($inquiry) > 0){?>            
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $inquiry[0]['inquiry_no']?></td>
                                                <td><?php echo $inquiry[0]['name']?></td>
                                                <td><?php echo $inquiry[0]['contact']?></td>
                                                <td><?php echo $inquiry[0]['program_name']?></td>
                                                <td><?php echo $inquiry[0]['shift']?></td>
                                                <td><?php echo $inquiry[0]['qualification']?></td>
                                                <td><?php echo $inquiry[0]['reference_source']?></td>
                                                <td><?php echo $inquiry[0]['institute_name']?></td>
                                                <td><?php echo(date("d-M-Y",@strtotime($inquiry[0]['inquiry_date']))); ?></td>
                                                <td><?php echo $inquiry[0]['sub_login']?></td>
                                                
                                           </tr>
                                          <?php } ?>
                                           
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                        </div>  



<div class="row-fluid" style="margin-bottom: 60px">
                    <div class="span12">                                                                     


                                <div class="row-fluid">         
                                                                                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           
                                            <tr style="font-size: 10px">                                                
                                                <th colspan="5" style="color: #045454; font-size: 20px;">Prospectus Information</th>                                                
                                            </tr>
                                            <tr style="font-size: 12px;    color: #4C4747; ">                                                
                                                
                                                <th>Name</th>                                                
                                                <th>Product</th>                                                
                                                <th>Price</th>                                                
                                                <th>Sale Date</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                            <?php if(count($prospectus) > 0){?>           
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $prospectus[0]['name']?></td>
                                                <td><?php echo $prospectus[0]['product_name']?></td>
                                                <td><?php echo $prospectus[0]['price']?></td>
                                                <td><?php echo(date("d-M-Y",@strtotime($prospectus[0]['sale_date']))); ?></td>
                                                <td><?php echo $prospectus[0]['sub_login']?></td>
                                                                                                
                                           </tr>
                                            <?php } ?>
                                           
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                        </div>  


<div class="row-fluid" style="margin-bottom: 60px">
                    <div class="span12">                                                                     


                                <div class="row-fluid">         
                                                                                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           
                                            <tr style="font-size: 10px;">                                                
                                                <th colspan="5" style="color: #045454; font-size: 20px;">Initial Form Information</th>                                                
                                            </tr>
                                            <tr style="font-size: 12px;     color: #4C4747;">                                                
                                                <th>Form No</th>
                                                <th>Name</th>
                                                <th>Program</th>                                                                                                
                                                <th>Date</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                          <?php if(count($initial) > 0){?>             
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $initial[0]['form_no']?></td>
                                                <td><?php echo $initial[0]['student_name']?></td>
                                                <td><?php echo $initial[0]['program_name']?></td>
                                                <td><?php echo(date("d-M-Y",@strtotime($initial[0]['created_date']))); ?></td>
                                                <td><?php echo $initial[0]['sub_login']?></td>
                                            
                                           </tr>
                                           <?php } ?>
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                        </div>  


<div class="row-fluid" style="margin-bottom: 60px">
                    <div class="span12">                                                                     


                                <div class="row-fluid">         
                                                                                                
                                    <table id="example" class="table table-striped table-bordered table-hover">
                                        <thead> 
                                           
                                            <tr style="font-size: 10px">                                                
                                                <th colspan="10" style="color: #045454; font-size: 20px;">Detailed Form Information</th>                                                
                                            </tr>
                                            <tr style="font-size: 12px;     color: #4C4747; " >                                                
                                                
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>Program</th>                                                
                                                <th>Gender</th>
                                                <th>Form Date</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                        
                                          <?php if(count($detailed) > 0){?>             
                                            <tr style="font-size: 10px">
                                                
                                                <td><?php echo $detailed[0]['student_name']?></td>
                                                <td><?php echo $detailed[0]['father_name']?></td>
                                                <td><?php echo $detailed[0]['program_name']?></td>
                                                <td><?php echo $detailed[0]['gender']?></td>
                                                <td><?php echo(date("d-M-Y",@strtotime($detailed[0]['form_submit_date']))); ?></td>                                                
                                                <td><?php echo $detailed[0]['sub_login']?></td>
                                                
                                           </tr>
                                          <?php } ?>
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                            </div>
                        </div>  
                



<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#initialform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    inquiry_no: {
                        required: true
                    }
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }
                
            });

        </script>   