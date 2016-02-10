<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>							
                <a href="" style="text-decoration: none">Program Manager Dashboard </a>
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
                Course Structure
            </h1>
        </div><!--/.page-header-->

        <h4 class="lighter">
                   <a href="" style="text-decoration: none" class="pink">
                        <?php echo $this->session->userdata('success'); $this->session->unset_userdata('success'); ?>
                        <?php echo $this->session->userdata('error'); $this->session->unset_userdata('error'); ?>
                   </a>
      </h4>

        <div class="row-fluid">
            <div class="span12">                                                                     

           <!-- *****   View Mid term structure   ***** -->     
                         <div class="table-header">
                                       <h3>Mid Term Structure</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-1" class="table table-striped table-bordered table-hover">
                                      
                                        <?php
                                             $i = 0;
                                             foreach ($mid as $row){
                                         ?>
                                        
                                        <thead>
                                            <tr>
                                                <th>#</th> 
                                                <th>Program</th> 
                                                <th>Session</th> 
                                                <th>Course</th> 
                                                
                                                <?php if($row['mid_title_1'] != ''){?>                                          
                                                        <th><?php echo $row['mid_title_1']; ?></th>
                                                <?php } if($row['mid_title_2'] != ''){?>     
                                                        <th><?php echo $row['mid_title_2']; ?></th>
                                                <?php } if($row['mid_title_3'] != ''){?>     
                                                        <th><?php  echo $row['mid_title_3']; ?></th>
                                                <?php } ?>     
                        
                                                <th>Total</th> 
                                                <th>Actions</th> 
                                                
                                              </tr>
                                        </thead>

                                        <tbody>
                                         
                                            <tr>                                                                                        
                                                
                                                <td><?php echo $i+1; ?></td>
                                                <td><?php echo $row['program_name']; ?></td>
                                                <td><?php echo $row['session']; ?></td>
                                                <td><?php echo $row['course_name']; ?></td>
                                                
                                                
                                                
                                                <?php if($row['mid_title_1'] != ''){?>
                                                        <td><?php echo $row['mid_value_1']; ?></td>                                               
                                                <?php } if($row['mid_title_2'] != ''){?>
                                                        <td><?php echo $row['mid_value_2']; ?></td>                                               
                                                <?php } if($row['mid_title_3'] != ''){?>
                                                        <td><?php echo $row['mid_value_3']; ?></td>
                                                <?php }?>
                                                
                                                <td><?php echo $row['mid_value_3']+$row['mid_value_2']+$row['mid_value_1']; ?></td>
                                                
                                                                                    
                                                <td>
                                                    <a style="cursor: pointer" href="<?php echo base_url()?>examination_de/edit_mid_term/?mid_course_structure_de_id=<?php echo $row['mid_course_structure_de_id'];?>">Edit</a>
                                                </td>
                                             </tr>
                                           <?php $i++; }?>
                                            
                                        </tbody>
                                    </table>
                                    
                                      
                                       
<!-- *****   View Final term structure   ***** -->     
            
<div class="table-header" id="table-header">
                                       <h3>Final Term Structure</h3>
                                    </div>
                                    
                                    
                                    
                                    <table id="sample-table-2" class="table table-striped table-bordered table-hover">
                                      
                                        <?php
                                             $j = 0;
                                             foreach ($final as $row){
                                         ?>
                                        
                                        <thead>
                                            <tr>
                                                
                                                <th>#</th> 
                                                <th>Program</th> 
                                                <th>Session</th> 
                                                <th>Course</th> 
                                                
                                                <?php if($row['final_title_1'] != ''){?>                                            
                                                <th style="width:50px"><?php echo $row['final_title_1']; ?></th>
                                                <?php } if($row['final_title_2'] != ''){?>  
                                                        <th><?php echo $row['final_title_2']; ?></th>
                                                <?php } if($row['final_title_3'] != ''){?>  
                                                        <th><?php echo $row['final_title_3']; ?></th>                                                                                                                                    
                                                <?php } if($row['final_title_4'] != ''){?>  
                                                        <th><?php echo $row['final_title_4']; ?></th>                                                                                                                                    
                                                <?php } if($row['final_title_5'] != ''){?>  
                                                        <th><?php echo $row['final_title_5']; ?></th>                                                                                                                                    
                                                <?php } if($row['final_title_6'] != ''){?>  
                                                        <th><?php echo $row['final_title_6']; ?></th>                                                                                                                                    
                                                <?php } if($row['final_title_7'] != ''){?>  
                                                        <th><?php echo $row['final_title_7']; ?></th> 
                                                <?php }?>  
                        
                                                <th>Total</th> 
                                                <th>Actions</th> 
                                                
                                              </tr>
                                        </thead>

                                        <tbody>
                                         
                                            <tr>                                                                                        
                                                
                                                <td><?php echo $j+1; ?></td>
                                                <td><?php echo $row['program_name']; ?></td>
                                                <td><?php echo $row['session']; ?></td>
                                                <td><?php echo $row['course_name']; ?></td>
                                                
                                                <?php if($row['final_value_1'] != ''){?>
                                                        <td style="width:50px"><?php echo $row['final_value_1']; ?></td>                                               
                                                <?php } if($row['final_value_2'] != ''){?>  
                                                        <td><?php echo $row['final_value_2']; ?></td>                                               
                                                <?php } if($row['final_value_3'] != ''){?>
                                                        <td><?php echo $row['final_value_3']; ?></td>                                               
                                                <?php } if($row['final_value_4'] != ''){?>
                                                        <td><?php echo $row['final_value_4']; ?></td>                                               
                                                <?php } if($row['final_value_5'] != ''){?>
                                                        <td><?php echo $row['final_value_5']; ?></td>                                               
                                                <?php } if($row['final_value_6'] != ''){?>
                                                        <td><?php echo $row['final_value_6']; ?></td>                                               
                                                <?php } if($row['final_value_7'] != ''){?>
                                                        <td><?php echo $row['final_value_7']; ?></td>                                               
                                                <?php } ?>
                                                
                                                <td><?php echo $row['final_value_1']+$row['final_value_2']+$row['final_value_3']+$row['final_value_4']+$row['final_value_5']+$row['final_value_6']+$row['final_value_7']; ?></td>                                               
                                                                          
                                                <td>
                                                    <a style="cursor: pointer" href="<?php echo base_url()?>examination_de/edit_final_term/?final_course_structure_de_id=<?php echo $row['final_course_structure_de_id'];?>">Edit</a>
                                                </td>
                                             </tr>
                                           <?php $j++; }?>
                                            
                                        </tbody>
                                    </table>
                                
      </div>
            </div>
        </div> 
    </div><!--/.page-content-->

</div><!--/.main-content-->
</div><!--/.main-container--> 

<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js"></script>


<script>
$("#midtermform").submit(function(){
    var title = document.querySelectorAll("#midtermform input[name='mtitle[]']");
    
    for (i = 0; i < title.length; i++) {
        
        if(title[i].value == '')
        {
            alert("Title Field is required");
            return false;
        }
        
    }
});

$("#midtermform").submit(function(){
    var values = document.querySelectorAll("#midtermform input[name='mvalue[]']");
    
    for (i = 0; i < values.length; i++) {
        
        if(values[i].value == '')
        {
            alert("Value Field is required");
            return false;
        }
        
    }
});

$("#finaltermform").submit(function(){
    var title = document.querySelectorAll("#finaltermform input[name='ftitle[]']");
    
    for (i = 0; i < title.length; i++) {
        
        if(title[i].value == '')
        {
            alert("Title Field is required");
            return false;
        }
        
    }
});

$("#finaltermform").submit(function(){
    var values = document.querySelectorAll("#finaltermform input[name='fvalue[]']");
    
    for (i = 0; i < values.length; i++) {
        
        if(values[i].value == '')
        {
            alert("Value Field is required");
            return false;
        }
        
    }
});


</script>
<!--inline scripts related to this page-->
<script>
// hide and show div

$(document).ready(function(){
        
  $("#mid-header").click(function(){
    $("#mid").toggle();
  });
  $("#final-header").click(function(){
    $("#final").toggle();
  });
});
    
// for drag and drop elements    
    
function allowDrop(ev)
{
ev.preventDefault();
}

function drag(ev)
{
ev.dataTransfer.setData("Text",ev.target.id);
}

function drop(ev)
{
ev.preventDefault();
var data=ev.dataTransfer.getData("Text");
ev.target.appendChild(document.getElementById(data));
}
</script>
<script type="text/javascript">
                                        $(function() {
                                            var oTable1 = $('#sampe-table-1').dataTable({
                                                "aoColumns": [
                                                    {"bSortable": true},
                                                    null,null,null,null,null,null,null,
                                                    {"bSortable": false}
                                                ]});

                                            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                                            function tooltip_placement(context, source) {
                                                var $source = $(source);
                                                var $parent = $source.closest('table')
                                                var off1 = $parent.offset();
                                                var w1 = $parent.width();

                                                var off2 = $source.offset();
                                                var w2 = $source.width();

                                                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                                                    return 'right';
                                                return 'left';
                                            }
                                        })
                                        
                                         $(function() {
                                            var oTable1 = $('#sampe-table-2').dataTable({
                                                "aoColumns": [
                                                    {"bSortable": true},
                                                    null, null,null,null,null,null,
                                                    {"bSortable": false}
                                                ]});

                                            $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
                                            function tooltip_placement(context, source) {
                                                var $source = $(source);
                                                var $parent = $source.closest('table')
                                                var off1 = $parent.offset();
                                                var w1 = $parent.width();

                                                var off2 = $source.offset();
                                                var w2 = $source.width();

                                                if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                                                    return 'right';
                                                return 'left';
                                            }
                                        })
</script>

