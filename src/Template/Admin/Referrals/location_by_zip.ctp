<div class="form-group m-form__group row">
    <label class="col-2 col-form-label">
        State
    </label>
    <div class="col-8" id="stateDiv">
        <?php echo $this->Form->control('state_id', array('label' => false, 'class' => 'form-control m-input', 'value'=>$locationData->state_id, 'options' => $states)); ?>
    </div>
</div>
<div class="form-group m-form__group row" id="countyDiv">
    <label class="col-2 col-form-label">
        County
    </label>
    <div class="col-8">
        <?php echo $this->Form->control('county_id', array('label' => false, 'value'=>$locationData->county_id, 'options' => $counties, 'class' => 'form-control m-input')); ?>
    </div>
</div>
<div class="form-group m-form__group row" id="cityDiv">
    <label class="col-2 col-form-label">
        City
    </label>
    <div class="col-8">
        <?php echo $this->Form->control('city_id', array('label' => false, 'value'=>$locationData->city_id, 'class' => 'form-control m-input', 'options' => $cities)); ?>
    </div>
</div>