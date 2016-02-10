<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>

<!--inline scripts related to this page-->

<script type="text/javascript"> 

  $(function() {

   $(".chzn-select").chosen(); 

  })

</script>
<select style="width: 200px;" id="program" name="program" class="chzn-select" data-placeholder="Click to Choose...">
                                                                           
    <option value="">-- Select Program --</option>
    <?php foreach ($program as $row) { ?>
         <option <?php if (set_value('program_id') == $row['program_id']) echo '"selected=selected"'; ?> value="<?php echo $row['program_id'] ?>"><?php echo $row['program_name'] ?></option> 
    <?php } ?>

</select> 

          
                                                            