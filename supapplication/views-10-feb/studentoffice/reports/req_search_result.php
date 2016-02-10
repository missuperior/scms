<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <a href="#">EXAMINATIONS</a>                
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
                REQUIRED SINGLE SEMESTER RESULT
            </h1>
        </div><!--/.page-header-->

        <div class="row-fluid">
            <div class="span12">
              <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo validation_errors(); ?>
                        <?php echo $this->session->userdata('error_msg'); $this->session->unset_userdata('error_msg'); ?>
                    </a>
                </h4>
                <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-header widget-header-small">
                            <h5 class="lighter">Search Form</h5>
                        </div>
                        <div class="widget-body">
                            <div class="widget-main">
                                <form target="_blank" class="form-horizontal" id="studentform"  method="POST" action="<?php echo base_url(); ?>studentoffice/req_student_result" />
                                        
                                <input style="width: 200px;" type="text" name="roll_no" required="required" id="roll_no"  class="input-medium search-query" placeholder="Enter Roll No" />                                
                                        
                                                            <select  style="width: 200px;" id="semester" name="semester" class="chzn-select" data-placeholder="Click to Choose...">                                                               
                                                                <option value="1">Semester 1</option>
                                                                <option value="2">Semester 2</option>
                                                                <option value="3">Semester 3</option>
                                                                <option value="4">Semester 4</option>
                                                                <option value="5">Semester 5</option>
                                                                <option value="6">Semester 6</option>
                                                                <option value="7">Semester 7</option>
                                                                <option value="8">Semester 8</option>
                                                                
                                                            </select>   
                                
                                                            <select name="print_type">
                                                                <option value="0">Simple</option>
                                                                <option value="1">Letter Head</option>
                                                            </select>
                                        
                                        
                                        <button class="btn btn-purple btn-small" >
                                            Search
                                            <i class="icon-search icon-on-right bigger-110"></i>
                                        </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--/.span-->
        </div><!--/.row-fluid-->
    </div><!--/.page-content-->  
</div><!--/.main-content-->
