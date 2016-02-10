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
                <input style="width: 200px;"  type="text"placeholder="Search ..." class="input-small nav-search-input" id="nav-search-input" autocomplete="off" />
                <i class="icon-search nav-search-icon"></i>
            </span>
            </form>
        </div><!--#nav-search-->
    </div>

    <div class="page-content">
        <div class="page-header position-relative">
            <h1>
                ADD USER FORM
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
                <!--PAGE CONTENT BEGINS-->

                <h4 class="lighter">                    
                    <a href="#modal-wizard" data-toggle="modal" class="pink"> 
                        <?php echo validation_errors(); ?>
                        <?php
                        echo $this->session->userdata('error_msg');

                        $this->session->unset_userdata('msg');
                        ?> </a>

                    <?php $this->session->unset_userdata('error_msg'); ?> 
                    <?php
                    echo $this->session->userdata('success_msg');
                    $this->session->unset_userdata('success_msg');
                    ?> </a>

                </h4>

                <div class="hr hr-18 hr-double dotted"></div>

                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-box">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="lighter">ADD USER</h4>                               
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">

                                    <div class="row-fluid">


                                        <form class="form-horizontal" name="userform" id="userform" method="POST" action="<?php echo base_url(); ?>admission_r/add_user_data" enctype="multipart/form-data" />

                                        <div class="control-group">
                                            <label class="control-label" for="form-field-2">Select Campus</label>

                                            <div class="controls">
                                                <select style="width: 200px;" id="campus" name="campus" class="select2" data-placeholder="Click to Choose...">                                                                
                                                    <option selected>Select Campus</option>    
                                                <?php foreach ($campus as $row) { ?>
                                                        <option onclick="get_campus_employes(this.value)" value="<?php echo $row['campus_id'] ?>"><?php echo $row['campus_name'] ?></option> 
<?php } ?>																			
                                                </select>

                                            </div>
                                        </div>
                                        <div id="employee_data">
                                            
                                            
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


<script type="text/javascript">
    
  function set_acc_role(role_id){
      $("#acc_role_id").val(role_id);
  }
   
    // get program list shift wise
    function get_campus_employes(camp_id)
    {
        if(camp_id!=""){
            $.ajax({
                type: "POST",
                data:{
                    'campus_id':camp_id,
                },
                url: "<?php echo base_url(); ?>admission_r/get_campus_employess",
                    
                success:function(data){
                    $("#employee_data").html(data);
                },
                error: function(){
                    alert('Some Error Occured, Please Try Again');
                }
            });
               
        }else{
            alert('Please Select Campus');
        }            
              
    }
    
    $('#userform').validate({
        errorElement: 'span',
        errorClass: 'help-inline',
        focusInvalid: false,
        rules: {
            campus: {
                required: true
            },
            user_name: {
                required: true
            },
            password: {
                required: true
            },           
            
            gender: 'required',
            agree: 'required'
        },
     
        highlight: function(e) {
            $(e).closest('.control-group').removeClass('info').addClass('error');
        },
        submitHandler: function(form) {
            document.validationForm.action = "<?php echo base_url(); ?>admission_r/add_user_data";
            document.validationForm.submit();
        },
        invalidHandler: function(form) {
        }

    });

   

</script>
