<div class="main_page_content" id="stories_add">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($story, array('name' => 'stories-add-form', 'class' => 'm-form m-form--fit m-form--label-align-right')); ?>
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Title
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('title', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Title')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Agency Type
                    </label>
                    <div class="col-8">
                        <?php
                        $i = 1;//to differentiate the radios
                        foreach ($agencyTypes as $agencyType):
                            ?>
                            <div class="radio-btn">
                                <input id="radio-<?php echo $i; ?>" class="radio-style" name="agency_type" type="radio"
                                       value="<?php echo $agencyType['value']; ?>">
                                <label for="radio-<?php echo $i; ?>"
                                       class="radio-style-1-label"><?php echo $agencyType['text'] ?></label>
                            </div>
                            <?php
                            $i++;
                        endforeach;
                        ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Agency
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('agency_id', ['label' => false, 'class' => 'form-control m-input ', 'empty' => '-- Select Agency --', 'id' => 'selectAgency']);
                        ?>
                    </div>
                </div>
                <h3 class="m-subheader__title ">OR<br/></h3>
                <h3 class="m-subheader__title ">Create New Agency</h3><br/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Agency Info:</h4>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Name
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('Agency.type', ['type' => 'hidden', 'id' => 'agencyType']); ?>
                        <?php echo $this->Form->control('Agency.name', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Agency Name')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Email
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('Agency.email', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Email')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Phone
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('Agency.phone', array('label' => false, 'class' => 'form-control m-input', 'Placeholder' => 'Phone')); ?>
                    </div>
                </div>
                <div class="form-group m-form__group row">
                    <label class="col-2 col-form-label">
                        Website
                    </label>
                    <div class="col-8">
                        <?php echo $this->Form->control('Agency.website', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Website')); ?>
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
                    <a href="/admin/stories" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>




