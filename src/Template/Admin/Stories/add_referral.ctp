<div class="main_page_content" id="stories_add_referral">
    <div class="stories form large-9 medium-8 columns content">
        <?php echo $this->Flash->render(); ?>
        <?= $this->Form->create($story, array('name' => 'form-add-referral', 'class' => 'm-form m-form--fit m-form--label-align-right')) ?>
        <div class="m-portlet__body">
            <div class="row">
                <div class="col-md-12">
                    <h4>Was there any professional who could help you in the story and deserves to be recognized?<br/>
                        Please refer him below.</h4>
                </div>
            </div>
            <div class="row">
                <h5>Search Referral By Profession and Name</h5>
                <div class="col-md-12">
                    <div class="form-group m-form__group row">
                        <?php
                        echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id]);
                        ?>
                        <label class="col-2 col-form-label">Profession</label><br/>
                        <div class="col-8">
                            <?php
                            echo $this->Form->control('referral.profession_id', ['type' => 'select', 'label' => false,
                                'class' => 'form-control m-input', 'id' => 'referralProfession', 'default' => $selectedProfessionId,
                                'options' => $professions, 'empty' => '-- Select Profession --']);
                            ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-2 col-form-label">Referral</label>
                        <div class="col-8">
                            <?php
                            echo $this->Form->control('referrals._ids[]', ['options' => $referrals,
                                'empty' => '-- Referral Name --', 'default' => $selectedReferralId, 'style' => 'opacity: 1;',
                                'class' => 'form-control m-select2', 'id' => 'selectReferral', 'label' => false]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="m-subheader__title ">OR<br/></h4>
            <h4 class="m-subheader__title ">Create New</h4><br/>
            <div class="row">
                <div class="col-md-6">
                    <h4>Personal Info:</h4>
                    <div class="form-group m-form__group row">
                        <label class="col-2 col-form-label">
                            Name
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('referral.is_active', ['type' => 'hidden', 'value' => 0]); ?>
                            <?php echo $this->Form->control('referral.name', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Name')); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-2 col-form-label">
                            Email address
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('referral.email', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Valid Email')); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group row">
                        <label class="col-2 col-form-label">
                            Phone
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('referral.phone', array('label' => false, 'class' => 'form-control m-input', 'Placeholder' => 'Phone')); ?>
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
                            Next
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>

