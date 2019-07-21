<label class="col-2 col-form-label" id="countyDiv">
    County
</label>
<div class="col-8">
    <?php
    if (empty($counties)){
        echo $this->Form->control('county_id', ['label' => false, 'disabled' => true, 'class' => 'form-control m-input']);
    }
    else{
        echo $this->Form->control('county_id', ['label' => false, 'empty' => '-- Select a County --', 'options' => $counties, 'class' => 'form-control m-input']);
    }
    ?>
</div>
