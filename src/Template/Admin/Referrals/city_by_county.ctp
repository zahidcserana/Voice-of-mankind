<label class="col-2 col-form-label" id="cityDiv">
    City
</label>
<div class="col-8">
    <?php
    if (empty($cities)){
        echo $this->Form->control('city_id', array('label' => false, 'class' => 'form-control m-input', 'disabled' => true));
    }
    else{
        echo $this->Form->control('city_id', array('label' => false, 'class' => 'form-control m-input', 'empty' => '-- Select a City --', 'options' => $cities));
    }
     ?>
</div>