<div style="width: 100%; float: left; margin-bottom: 15px; " class="control-group">
    <label style="width: 160px;" class="control-label" for="email">Rooms :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 180px;">
        <div class="span12">
            <select onchange="getCapacity(this.value)"  style="width: 188px;" id="rooms" name="rooms" class="select2" data-placeholder="Click to Choose...">                                                                
                <option value="">Select Room</option>
                <?php foreach ($rooms as $row) { ?>
                    <option <?php if($room_id == $row['room_id'])echo 'selected="selected"';?> value="<?php echo $row['room_id'] ?>"><?php echo $row['room_name'] ?></option> 
                <?php } ?>																			
            </select>
            <input style="width: 75px;" type="text" name="capacity" value="<?php echo $capacity - $room_allocated; ?>" id="capacity" class="span5" />
        </div>
    </div>
</div>
<div style="margin-left: 180px;  color: green"> 
    <label style="font-size: 10px" > Capacity : <?php echo $capacity; ?>  </label>
    <label style="font-size: 10px"> Allocated : <?php echo $room_allocated; ?>  </label>
    <label style="font-size: 10px"> Remaining : <?php echo $capacity - $room_allocated; ?></label>
</div>