<div id="locationDiv">
    <?php
    if (empty($locationData)) { ?>
        <div class="alert alert-warning">
            <p>Invalid Zip Code</p>
        </div>
    <?php } else { ?>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">State:</label>
            <?php
            echo $this->Form->control('state_id', ['label' => false, 'class' => 'form-control', 'options' => $states]);
            ?>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">County:</label>
            <?php
            echo $this->Form->control('county_id', ['label' => false, 'options' => $counties, 'class' => 'form-control']);
            ?>
        </div>
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">City:</label>
            <?php
            echo $this->Form->control('city_id', ['label' => false, 'options' => $cities, 'class' => 'form-control']);
            ?>
        </div>
    <?php }
    ?>
</div>