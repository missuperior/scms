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

    
    <?php
       /* echo '<pre>';
        var_dump($final);
        echo '<br>';
        echo '<pre>';
        var_dump($final);die;
    */
    ?>

    <div class="page-content">

        <div class="page-header position-relative">
            <h1>
                Course Allocation   
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
                
                           
                                        <!-- *****   Define  Mid term structure   ***** -->          
                                        <div class="row-fluid">                                    
                                            <div class="table-header" id="final-header">
                                                <h3>Update Final Term Structure</h3>
                                            </div>

                                      <div class="row-fluid" id="final" >
                                           <div class="span4" style="width:57.8%; min-height: 560px; height: auto;">
                                               <div class="widget-box" style="min-height: 560px; height: auto;">
                                                   <div class="widget-header">
                                                       <h4 style="color:#003d43">Drop Here</h4>
                                                   </div>

                                                   <div class="widget-body" style="min-height: 560px; height: auto;">

                                                       <form name="finaltermform" id="finaltermform" method="post" action="<?php echo base_url()?>programmanagers/update_final_term_structure" enctype="multipart/form-data">

                                                           <div class="widget-main" id="div1" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 560px; height: auto;">

                                                               <input type="hidden" name="final_id" id="final_id" value="<?php echo $final[0]['final_course_structure_id']; ?>" class="span5" />
                                                               <input type="hidden" name="course_allocation_id" id="course_allocation_id" value="<?php echo $id; ?>" class="span5" />
                                                               
                                                               <?php if($final[0]['final_title_1'] != '') {?>
                                                                 <div draggable="true" ondragstart="drag(event)" id="d1">  
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_1'];?>" type="text" class="span8" id="ftitle1" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_1'];?>" id="fvalue1" name="fvalue[]"   placeholder="Marks">
                                                               </div>
                                                               <?php } if($final[0]['final_title_2'] != ''){ ?>
                                                                  <div draggable="true" ondragstart="drag(event)" id="d2">             
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_2'];?>" type="text" class="span8" id="ftitle2" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_2'];?>" id="fvalue2" name="fvalue[]"   placeholder="Marks">
                                                                  </div>          
                                                               <?php } if($final[0]['final_title_3'] != ''){ ?>
                                                                  <div draggable="true" ondragstart="drag(event)" id="d3">             
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_3'];?>" type="text" class="span8" id="ftitle3" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_3'];?>" id="fvalue3" name="fvalue[]"   placeholder="Marks">
                                                                 </div>           
                                                               <?php } if($final[0]['final_title_4'] != ''){ ?>
                                                                   <div draggable="true" ondragstart="drag(event)" id="d4">            
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_4'];?>" type="text" class="span8" id="ftitle4" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_4'];?>" id="fvalue4" name="fvalue[]"   placeholder="Marks">
                                                                   </div>         
                                                               <?php } if($final[0]['final_title_5'] != ''){ ?>
                                                                    <div draggable="true" ondragstart="drag(event)" id="d5">           
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_5'];?>" type="text" class="span8" id="ftitle5" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_5'];?>" id="fvalue5" name="fvalue[]"   placeholder="Marks">
                                                                    </div>        
                                                               <?php } if($final[0]['final_title_6'] != ''){ ?>
                                                                    <div draggable="true" ondragstart="drag(event)" id="d6">           
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_6'];?>" type="text" class="span8" id="ftitle6" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_6'];?>" id="fvalue6" name="fvalue[]"   placeholder="Marks">
                                                                    </div>        
                                                               <?php } if($final[0]['final_title_7'] != ''){ ?>
                                                                    <div draggable="true" ondragstart="drag(event)" id="d7">           
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" value="<?php echo $final[0]['final_title_7'];?>" type="text" class="span8" id="ftitle7" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" value="<?php echo $final[0]['final_value_7'];?>" id="fvalue7" name="fvalue[]"   placeholder="Marks">
                                                                   </div>         
                                                               <?php } ?>

                                                           </div>

                                                           <div class="form-actions center">
                                                               <input type="submit" value="Update" class="btn btn-small btn-success" >

                                                               </input>
                                                           </div>
                                                       </form> 
                                                   </div>

                                               </div>
                                           </div><!--/span-->

                                           <div class="span4" style="width:40%; min-height: 663px; height: auto;">
                                               <div class="widget-box" style="min-height: 663px; height: auto;">
                                                   <div class="widget-header">
                                                       <h4 style="color:#003d43">Dropable</h4>
                                                   </div>

                                                   <div class="widget-body" style="min-height: 663px; height: auto;">
                                                       <div class="widget-main" id="div2" ondrop="drop(event)" ondragover="allowDrop(event)" style="min-height: 663px; height: auto;">
                                                                
                                                                <?php if($final[0]['final_title_1'] == '') {?>
                                                                     <div draggable="true" ondragstart="drag(event)" id="d1">  
                                                                            <input style="margin-left:20px; background-color:#f4f4f4"  type="text" class="span8" id="ftitle1" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8"  id="fvalue1" name="fvalue[]"   placeholder="Marks">
                                                                     </div>
                                                               <?php } if($final[0]['final_title_2'] == ''){ ?>
                                                                      <div draggable="true" ondragstart="drag(event)" id="d2">         
                                                                            <input style="margin-left:20px; background-color:#f4f4f4"  type="text" class="span8" id="ftitle2" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8"  id="fvalue2" name="fvalue[]"   placeholder="Marks">
                                                                       </div>     
                                                               <?php } if($final[0]['final_title_3'] == ''){ ?>
                                                                       <div draggable="true" ondragstart="drag(event)" id="d3">     
                                                                            <input style="margin-left:20px; background-color:#f4f4f4"  type="text" class="span8" id="ftitle3" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8"  id="fvalue3" name="fvalue[]"   placeholder="Marks">
                                                                        </div>    
                                                               <?php } if($final[0]['final_title_4'] == ''){ ?>
                                                                        <div draggable="true" ondragstart="drag(event)" id="d4">       
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle4" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" id="fvalue4" name="fvalue[]"   placeholder="Marks">
                                                                        </div>    
                                                               <?php } if($final[0]['final_title_5'] == ''){ ?>
                                                                        <div draggable="true" ondragstart="drag(event)" id="d5">       
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle5" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" id="fvalue5" name="fvalue[]"   placeholder="Marks">
                                                                        </div>    
                                                               <?php } if($final[0]['final_title_6'] == ''){ ?>
                                                                        <div draggable="true" ondragstart="drag(event)" id="d6">       
                                                                            <input style="margin-left:20px; background-color:#f4f4f4" type="text" class="span8" id="ftitle6" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8" id="fvalue6" name="fvalue[]"   placeholder="Marks">
                                                                       </div>     
                                                               <?php } if($final[0]['final_title_7'] == ''){ ?>
                                                                        <div draggable="true" ondragstart="drag(event)" id="d7">       
                                                                            <input style="margin-left:20px; background-color:#f4f4f4"  type="text" class="span8" id="ftitle7" name="ftitle[]"   placeholder="Title">
                                                                            <input style="margin-left:20px" type="text" class="span8"  id="fvalue7" name="fvalue[]"   placeholder="Marks">
                                                                        </div>    
                                                               <?php } ?>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div><!--/span-->

                                       </div><!--/row-->
                                


      </div>
            </div>
        </div> 
    </div><!--/.page-content-->

</div><!--/.main-content-->
</div><!--/.main-container--> 


<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.js"></script>

<script>
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
                                            var oTable1 = $('#sampe-table-2').dataTable({
                                                "aoColumns": [
                                                    {"bSortable": true},
                                                    null, null, 
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
