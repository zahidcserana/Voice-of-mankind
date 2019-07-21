<label for="recipient-name" class="col-form-label">County:</label>
<?php
echo $this->Form->control('county_id', ['label' => false,'onChange'=>'getCity()', 'empty' => '-- Select a County --', 'options' => $counties, 'class' => 'form-control']);
?>