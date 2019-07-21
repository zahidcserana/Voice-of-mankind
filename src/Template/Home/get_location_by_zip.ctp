<div class="col_half">
    <label for="register-form-email">State:</label>
    <?php echo $this->Form->input('state_id', array('class' => 'form-control input-form', 'label' => false, 'value'=>$locationData->state_id, 'options' => $states)); ?>
</div>

<div class="col_half col_last" id="county-div">
    <label for="register-form-email">County:</label>
    <?php echo $this->Form->input('county_id', array('class' => 'form-control input-form', 'label' => false, 'value'=>$locationData->county_id, 'options' => $counties)); ?>
</div>

<div class="col_half" id="city-div">
    <label for="register-form-email">City:</label>
    <?php echo $this->Form->input('city_id', array('class' => 'form-control input-form', 'label' => false, 'value'=>$locationData->city_id, 'options' => $cities)); ?>
</div>