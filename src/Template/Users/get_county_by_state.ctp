<label for="register-form-email">County:</label>
<?php
echo $this->Form->control('county_id', ['label' => false, 'empty' => '-- Select a County --', 'options' => $counties, 'class' => 'form-control input-form']);
?>



