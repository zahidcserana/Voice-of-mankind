<div class="main_page_content" id="referral_form">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($referral, array('name' => 'referral-form', 'class' => 'm-form m-form--fit m-form--label-align-right')); ?>
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-6">
                <h4>Personal Info:</h4>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Profession
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('profession_id', array('label' => false, 'class' => 'form-control m-input', 'options' => $professions)); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Name
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('name', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Name')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Email
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('email', array('label' => false, 'class' => 'form-control m-input', 'Placeholder' => 'Email')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Phone
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('phone', array('label' => false, 'class' => 'form-control m-input', 'Placeholder' => 'Phone')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Status
                    </label>
                    <div class="col-8">
                        <?php
                        echo $this->Form->control('status', array('class' => 'form-control m-input', 'label' => false, 'div' => false, 'options' => \Cake\Core\Configure::read('Status')));
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Address:</h4>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Zipcode
                    </label>
                    <div class="col-8">
                        <input type="hidden" name="zip_code" id="zip_code">
                        <?php echo $this->Form->input('zip_value', array('type' => 'select', 'id' => 'selectZip', 'class' => 'form-control input-form', 'label' => false)); ?>
                    </div>
                </div>
                <div id="userLocation">
                    <div class="form-group m-form__group row">
                        <label class="col-2 col-form-label">
                            State
                        </label>
                        <div class="col-8" id="stateDiv">
                            <?php echo $this->Form->control('state_id', array('label' => false, 'empty' => '-- Select a County --', 'class' => 'form-control m-input', 'options' => $states)); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" id="countyDiv">
                        <label class="col-2 col-form-label">
                            County
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('county_id', array('label' => false, 'class' => 'form-control m-input')); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group row" id="cityDiv">
                        <label class="col-2 col-form-label">
                            City
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('city_id', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'City')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success">
                        Submit
                    </button>
                    <a href="/admin/referrals" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>