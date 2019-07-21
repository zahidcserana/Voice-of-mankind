<div class="container topmargin main_page_content" id="stories_add">
    <div class="row">
        
        <div class="col_full create-strory-area">

            <div class="col-sm-5 col-xs-12 create-left-side">
                <?php echo $this->Flash->render(); ?>
                <?= $this->Form->create($story, ['name' => 'stories-add-form', 'type' => 'post']) ?>
                <div class="form-group">
                    <label for="exampleInputEmail1">Story / Complaint</label>
                    <?php echo $this->Form->control('title', ['type' => 'text',
                        'required' => 'true', 'class' => 'form-control input-form', 'placeholder' => 'Story / Complaint', 'label' => false]); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Select Type</label>
                    <?php
                    echo $this->Form->control('agency_type', ['type' => 'hidden']);
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
                    endforeach; ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slect Agency</label>
                    <?php echo $this->Form->control('agency_id', [
                        'empty' => '-- Select Agency --', 'id' => 'selectAgency',
                        'class' => 'selectpicker form-control',
                        'label' => false]); ?>

                </div>
            </div>
            <div class="col-sm-1 col-xs-12 or-circle">
                <h4>OR</h4>
            </div>
            <div class="col-sm-6 col-xs-12 create-right-side">
                <div class="heading-block center">
                    <h4>Create New</h4>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">Agency Name</label>
                    <?php
                    echo $this->Form->control('Agency.name', ['type' => 'text', 'label' => false, 'id' => 'agencyName',
                        'class' => 'form-control input-form', 'placeholder' => 'Agency Name']);
                    echo $this->Form->control('Agency.type', ['type' => 'hidden', 'id' => 'agencyType']);
                    ?>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6 nopadding1">
                        <label for="exampleInputEmail1">City</label>
                        <?php echo $this->Form->control('Agency.city_id', ['type' => 'text', 'placeholder' => 'City', 'label' => false, 'class' => 'form-control input-form']); ?>
                    </div>
                    <div class="form-group col-xs-6 nopadding2">
                        <label for="exampleInputEmail1">State</label>
                        <?php echo $this->Form->control('Agency.state_id', ['type' => 'select', 'label' => false,
                            'options' => $states, 'empty' => '-- Select State --', 'class' => 'form-control input-form']); ?>
                    </div>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">Zip Code</label>
                    <?php echo $this->Form->control('Agency.zip_code', ['type' => 'text', 'label' => false, 'class' => 'form-control input-form',
                        'placeholder' => 'Zip Code']); ?>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">Address</label>
                    <?php echo $this->Form->control('Agency.address', ['type' => 'text', 'placeholder' => 'Address',
                        'class' => 'form-control input-form', 'label' => false]); ?>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6 nopadding1">
                        <label for="exampleInputEmail1">Email</label>
                        <?php echo $this->Form->control('Agency.email', ['type' => 'email', 'label' => false,
                            'placeholder' => 'Email', 'class' => 'form-control input-form']); ?>
                    </div>
                    <div class="form-group col-xs-6 nopadding2">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <?php echo $this->Form->control('Agency.phone', ['type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Phone Number']); ?>
                    </div>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <button class="button defualt-btn nomargin" type="submit">Next</button>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <?php echo $this->element('ads', ['size' => 'Top Right (375px x 250px)']);?>
            <?php echo $this->element('ads', ['size' => 'Middle Right (375px x 250px)']);?>
            <?php echo $this->element('ads', ['size' => 'Bottom Right (375px x 250px)']);?>
        </div>
    </div>
</div>