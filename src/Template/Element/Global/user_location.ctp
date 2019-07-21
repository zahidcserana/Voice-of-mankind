<div class="modal fade" id="userLocationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Location Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="display: none" class="alert alert-info"></div>
                <?= $this->Form->create('user', ['name' => 'user-location-form', 'id' => 'user-location-form']) ?>
                <div style="display: none" id="zip-code-msg" class="alert alert-danger">Please Enter A Valid Zip
                    Code
                </div>
                <div class="col_full">
                    <label for="register-form-email">Zipcode:</label>
                    <input type="hidden" name="zip_code" id="user_zip_code">
                    <?php echo $this->Form->input('user_zip_value', array('type' => 'select', 'id' => 'selectZipCode', 'class' => 'form-control input-form', 'label' => false)); ?>
                </div>
                <div id="userLocationDiv">
                    <div class="col_half">
                        <label for="register-form-email">State:</label>
                        <?php echo $this->Form->control('state_id', ['label' => false, 'class' => 'form-control input-form',
                            'type' => 'select', 'options' => $session['allState'], 'empty' => '-- Select State --']); ?>
                    </div>
                    <div class="col_half col_last" id="county-div">
                        <label for="register-form-email">County:</label>
                        <?php echo $this->Form->control('county_id', ['label' => false, 'class' => 'form-control input-form']); ?>
                    </div>
                    <div class="col_half" id="city-div">
                        <label for="register-form-email">City:</label>
                        <?php echo $this->Form->control('city_id', ['label' => false, 'class' => 'form-control input-form']); ?>
                    </div>
                </div>
                <div class="col_half col_last">
                    <label for="register-form-name">Address:</label>
                    <?php echo $this->Form->control('address', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Address']); ?>
                </div>
                <button style="margin-left: 44%!important;border-radius: 5%" type="submit"
                        class="button defualt-btn nomargin">Save
                </button>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>

