<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">ADMISSIONS</a>                
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
                Prospectus
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?> 
                        <?php echo $this->session->userdata('success_msg'); $this->session->unset_userdata('success_msg'); ?> </a>
                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="table-header">
                                       <h3>Student Inquiry Info</h3>
                                    </div>

                                    
                                    <table class="table table-striped table-bordered table-hover">
                                       
                                        <tbody>
                                        
                                            <tr>                                                                        
                                                <th>Name</th>
                                                <td><?php echo $inquiry->name;?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Qualification</th>
                                                <td><?php echo $inquiry->qualification;?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Program</th>
                                                <td><?php echo $inquiry->program_name;?></td>                                        
                                            </tr>
                                          
                                            <tr>                                                                        
                                                <th>Contact</th>
                                                <td><?php echo $inquiry->contact;?></td>                                        
                                            </tr>
                                                                                    
                                            <tr>                                                                        
                                                <th>Inquiry Date</th>
                                               <td><?php echo $inquiry->inquiry_date;?></td>                                                                                
                                            </tr>
                                          
                                            
                                        </tbody>
                                    </table>
                
                
                
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">ADD Prospectus INFORMATION</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                   
                                    <div class="row-fluid">
                            <form class="form-horizontal" id="initialform" method="POST" action="<?php echo  base_url()?>admission_r/add_prospectus" enctype="multipart/form-data" />

                                    <div class="step-content row-fluid position-relative" id="step-container">
                                            <div class="step-pane active" id="step1">
                                                                                                                                                                    

<!-- *************************************    Start Personal Information  *************************************************** -->
                                                
<hr/>
<!--                                                <h3 style="margin-top: 20px" class="lighter block green">FORM INFORMATION</h3>   -->
                                                 <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Inquiry # : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="inquiry_no" id="inquiry_no" value="<?php if(set_value('inquiry_no')){echo set_value('inquiry_no');}else{ echo $inquiry->inquiry_no;} ?>" style="width: 300px;" class="span10" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Product:<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="product" name="product" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Product --</option>
                                                                <?php foreach ($products as $row){?>
                                                                <option <?php if(set_value('product')==$row['product_id']) echo '"selected=selected"';?> value="<?php echo $row['product_id']?>"><?php echo $row['product_name']?></option> 
                                                                <?php }?>																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>

                                                  <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Quantity  : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="quantity" id="quantity" value="<?php if(set_value('quantity') == ''){echo 1;}else{ echo set_value('quantity'); } ?>" style="width: 300px;" class="span10" />
                                                        </div>
                                                    </div>
                                                </div>
                                                                                                                                                
                                                  <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Price : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="price" id="price" value="<?php echo set_value('price'); ?>" style="width: 300px;" class="span10" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                                                                                                                
                                                  <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Total Price : <img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <input style="width: 188px;" type="text" name="total_price" id="total_price" value="<?php echo set_value('total_price'); ?>" style="width: 300px;" class="span10" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                  

                                                <?php if($this->session->userdata('role') == 'HOD'){?>
                                                <div class="control-group">
                                                    <label style="width: 130px;" class="control-label" for="email">Campus :<img src="<?php echo base_url()?>assets/img/star.jpg" width="6"/></label>

                                                    <div class="controls" style="margin-left: 140px;">
                                                        <div class="span12">
                                                            <select style="width: 188px;" id="campus" name="campus" class="chzn-select" data-placeholder="Click to Choose...">
                                                                <option value="">-- Select Campus --</option>
                                                                <?php foreach ($campus as $row){?>
                                                                <option <?php if($inquiry->campus_id == $row['campus_id']) {echo 'selected="selected"';}else if($inquiry->campus_id == $row['campus_id']){echo 'selected="selected"';}?> value="<?php echo $row['campus_id']?>"><?php echo $row['campus_name']?></option> 
                                                                <?php }?>																				
                                                            </select>
                                                        </div>
                                                    </div>
                                                  </div>

                                                <?php } ?>
                                                
                                            </div>
                                        </div>

                                        <hr />
                                        <div class="row-fluid wizard-actions">
                                               <button class="btn btn-success btn-next" data-last="Finish ">
                                                Save                                            
                                            </button>
                                        </div>
                                     </form>
                                    </div>
                                </div><!--/widget-main-->
                            </div><!--/widget-body-->
                        </div>
                    </div>
                </div>
               
            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->  
</div><!--/.main-content-->


                <!-- *******  Start for Date picker  *******-->
			
		<script type="text/javascript">
			$("#product").change(function(){

                            var pro      = $("#product").val();
                            
                            if(product != ''){
                              
                                                $.ajax({
                                                    type: "GET",
                                                    url:  "<?php echo base_url();?>admission_r/get_price/?product_id="+pro,
                                                  
                                                    data: {},
                                                    success: function(data){
                                                        
                                                        $('#price' ).val(data);
                                                        $('#total_price' ).val(data);
                                                        $('#quantity').val('1');

                                                    }
                                                });
                                            }else{

                                                alert('Please Select Product');
                                            }
       
                         });
                         
                         $("#quantity").keyup(function(){
                            
                            var quantity = $("#quantity").val();
                            var price    = $("#price").val();
                            var total    = parseInt(quantity) * parseInt(price);
                            $("#total_price").val(total);
                         });
                            
		</script>
                <!-- *******  End for Date picker  *******-->





<!-- *******************************   Form Validations   ****************************** -->

 <script type="text/javascript">
            $('#initialform').validate({
                errorElement: 'span',
                errorClass: 'help-inline',
                focusInvalid: false,
                rules: {
                    inquiry_no: {
                        required: true
                    },
                    product: {
                        required: true
                    },
                    quantity: {
                        required: true
                    },
                    campus: {
                        required: true
                    }
                },
                
                highlight: function(e) {
                    $(e).closest('.control-group').removeClass('info').addClass('error');
                },
                submitHandler: function(form) {
                    document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_initial_form_data";
                    document.validationForm.submit();                }
                
            });

        </script>