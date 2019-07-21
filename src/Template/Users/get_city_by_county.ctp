<label for="register-form-email">City:</label>
<?php
echo $this->Form->control('city_id', ['label' => false, 'empty' => '-- Select a City --', 'options' => $cities, 'class' => 'form-control input-form']);
?>



