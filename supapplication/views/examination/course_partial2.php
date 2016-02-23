<div class="control-group">
    <label style="width: 130px;" class="control-label" for="email">Course :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <select multiple="" style="width: 400px;" id="course" name="course[]" class="chzn-select" data-placeholder="Click to Choose...">
                <option value="">-- Select Course --</option>
                <?php foreach ($courses as $row) { ?>
                    <option  value="<?php echo $row['course_id'] ?>"><?php echo $row['course_name'] ?></option> 
                <?php } ?>																			
            </select>
        </div>
    </div>
</div>  
<script src="<?php echo base_url();?>assets/js/chosen.jquery.min.js"></script>
	
    <!--inline scripts related to this page-->

    <script type="text/javascript"> 
      
      $(function() {
       
       $(".chzn-select").chosen(); 
        
      })
            
    </script>