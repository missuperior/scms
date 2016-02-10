<div style="width: 50%; float: left;margin-bottom: 15px" class="control-group">
    <label style="width: 130px;" class="control-label" for="email">Address :<img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <input style="width: 200px;" type="text" name="permanent_address" id="permanent_address" value="<?php echo $address_info['address']; ?>" class="span6" placeholder="Permanent Address"/>
        </div>
    </div>
</div>

<div style="width: 50%; float: left; margin-bottom: 35px;" class="control-group">
    <label style="width: 130px;" class="control-label" for="email">City : <img src="<?php echo base_url() ?>assets/img/star.jpg" width="6"/></label>

    <div class="controls" style="margin-left: 140px;">
        <div class="span12">
            <select  style="width: 201px;" id="permanent_city" name="permanent_city" class="chzn-select" data-placeholder="Click to Choose...">

                <option value="">-- Select Permanent City --</option>
                <?php foreach ($cities as $row) { ?>
                    <option <?php if ($address_info['city'] == $row['city_id']) echo 'selected="selected"';  ?> value="<?php echo $row['city_id'] ?>"><?php echo $row['city_name']; ?></option> 
                <?php } ?>																			
            </select>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/chosen.jquery.min.js"></script>

                <!--inline scripts related to this page-->

                <script type="text/javascript"> 

                  $(function() {

                   $(".chzn-select").chosen(); 

                  })

                </script>