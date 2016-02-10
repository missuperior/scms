<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>
<script type="text/javascript"> 

  $(function() {

   $(".chzn-select").chosen(); 

  })

</script>
<label>Roll No</label>
<select style="width: 200px;" id="roll_no" name="roll_no" class="chzn-select" data-placeholder="Click to Choose...">
                                                                           
   <?php foreach ($roll_no as $row) { ?>
    <option value="<?php echo $row['student_id'] ?>"><?php echo $row['roll_no']; ?></option> 
<?php } ?>  

</select> 

          
                                                            