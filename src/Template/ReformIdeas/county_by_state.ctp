
<?php
if (!empty($counties)){
    echo $this->Form->control('county_id', ['label' => false, 'empty' => '-- Select a County --', 'options' => $counties, 'class' => 'form-control']);
} else{
 echo $this->Form->control('county_id', ['label' => false, 'empty' => '-- Select a County --', 'class' => 'form-control','disabled'=>true]);
}
?>

