<div class="control-group">
    <label style="width: 130px;" class="control-label" for="email">Roll No :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>
    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <select style="width: 200px;" id="roll_no" name="roll_no" class="chzn-select" data-placeholder="Click to Choose...">
                <option value="">-- Select Roll No --</option>
                <?php foreach ($rollno as $row) { ?>
                    <option  value="<?php echo $row['student_id'].','.$row['roll_no'].','.$row['student_name'] ?>"><?php echo $row['roll_no'] ?></option> 
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