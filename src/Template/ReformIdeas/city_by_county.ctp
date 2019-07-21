
<?php
if (empty($cities)){
    echo $this->Form->control('city_id', ['label' => false, 'empty' => '-- Select a City --', 'class' => 'form-control','disabled'=>true]);
}else{
    echo $this->Form->control('city_id', ['label' => false, 'empty' => '-- Select a City --', 'options' => $cities, 'class' => 'form-control']);
}
?>

