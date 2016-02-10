 <script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>

                <!--inline scripts related to this page-->

                <script type="text/javascript"> 

                  $(function() {

                   $(".chzn-select").chosen(); 

                  })

                </script>
<div style="width: 100%; float: left; margin-bottom: 15px; " class="control-group">
    <label style="width: 160px;" class="control-label" for="email">Rooms :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 180px;">
        <div class="span12">
            <select onchange="getCapacity(this.value)"  style="width: 188px;" id="rooms" name="rooms" class="chzn-select" data-placeholder="Click to Choose...">                                                                
                <option value="">Select Room</option>
                <?php foreach ($rooms as $row) { ?>
                    <option <?php if($room_id == $row['room_id'])echo 'selected="selected"';?> value="<?php echo $row['room_id'] ?>"><?php echo $row['room_name'] ?></option> 
                <?php } ?>																			
            </select>
            <!--<input style="width: 75px;" type="text" name="capacity" value="<?php echo $capacity; ?>" id="capacity" class="span5" />-->
        </div>
    </div>
</div>
<?php
if($room_allocated == ''){ $room_allocated = 0;}
?>
<div style="margin-left: 180px; float: left;  color: #635C5C; width:200px; height: 100px; "> 
    <label style=" width: 100px; text-align: center; float: left; font-size: 12px; font-weight: bold; border: 1px grey solid" > Capacity</label><p style="  font-size: 10px; text-align: center; border: 1px grey solid" ><?php echo $capacity; ?></p>
    <label style=" width: 100px; text-align: center; float: left; font-size: 12px; font-weight: bold; border: 1px grey solid" > Allocated</label><p style=" font-size: 10px; text-align: center; border: 1px grey solid" ><?php echo $room_allocated; ?></p>
    <label style=" width: 100px; text-align: center; float: left; font-size: 12px; font-weight: bold; border: 1px grey solid" > Remaining</label><p style=" font-size: 10px; text-align: center; border: 1px grey solid" ><?php echo $capacity-$room_allocated; ?></p>    
    <input type="hidden" name="capacity" id="capacity" value="<?php echo $capacity-$room_allocated; ?>" />
</div>