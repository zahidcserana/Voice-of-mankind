<div class="container topmargin main_page_content" id="stories_add">
    <div class="row">
        
        <div class="col_two_third create-strory-area">
            <div class="col-sm-12 col-xs-12 create-left-side">
            <?php echo $this->element('Global' . DS . 'steps',['id'=>'']); ?>
            </div>    
                <?php echo $this->Flash->render(); ?>
                <?= $this->Form->create($story, ['name' => 'stories-add-form']) ?>
                <div class="col-sm-12 col-xs-12 create-left-side">
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
                        <label for="exampleInputEmail1">Select Agency</label>
                        <?php echo $this->Form->control('agency_id', [
                            'empty' => '-- Select Agency --', 'id' => 'selectAgency',
                            'class' => 'selectpicker form-control',
                            'label' => false]); ?>

                    </div>
                </div>
                <div class="col-xs-offset-3 col-xs-6 or-circle">
                    <h4>OR</h4>
                </div>
                <div class="col-sm-12  col-xs-12 create-right-side">
                    <div class="heading-block center">
                        <h4>Create New Agency</h4>
                    </div>
                    <div class="col_full">
                        <label for="exampleInputEmail1">Agency Name</label>
                        <?php
                        echo $this->Form->control('Agency.name', ['type' => 'text', 'label' => false, 'id' => 'agencyName',
                            'class' => 'form-control input-form', 'placeholder' => 'Agency Name']);
                        echo $this->Form->control('Agency.type', ['type' => 'hidden', 'id' => 'agencyType']);
                        ?>
                    </div>
                    <div class="col_half">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <?php echo $this->Form->control('Agency.phone', ['type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Phone Number']); ?>
                    </div>
                    <div class="col_half col_last">
                        <div style="display: none" id="zip-code-msg" class="alert alert-danger">Please Enter A Valid Zip
                            Code
                        </div>
                        <label for="register-form-email">Zipcode:</label>
                        <input type="hidden" name="zip_code" id="zip_code"">
                        <?php echo $this->Form->control('zip_value', array('type' => 'select', 'id' => 'selectZip', 'class' => 'form-control input-form', 'label' => false)); ?>
                    </div>
                    <div id="userLocation">
                        <div class="col_half">
                            <label for="exampleInputEmail1">State</label>
                            <?php echo $this->Form->control('state_id', ['type' => 'select', 'label' => false,
                                'options' => $states, 'empty' => '-- Select State --', 'class' => 'form-control input-form']); ?>
                        </div>
                        <div class="col_half col_last" id="countyList">
                            <label for="exampleInputEmail1">County</label>
                            <?php echo $this->Form->control('county_id', ['type' => 'text', 'label' => false, 'placeholder' => 'County', 'class' => 'form-control input-form']); ?>
                        </div>
                        <div class="col_half" id="cityList">
                            <label for="exampleInputEmail1">City</label>
                            <?php echo $this->Form->control('city_id', ['type' => 'text', 'placeholder' => 'City', 'label' => false, 'class' => 'form-control input-form']); ?>
                        </div>
                    </div>
                    <div class="col_half col_last">
                        <label for="exampleInputEmail1">Address</label>
                        <?php echo $this->Form->control('Agency.address', ['type' => 'text', 'placeholder' => 'Address',
                            'class' => 'form-control input-form', 'label' => false]); ?>
                    </div>
                    <div class="col_full">
                        <label for="exampleInputEmail1">Email</label>
                        <?php echo $this->Form->control('Agency.email', ['type' => 'email', 'label' => false,
                            'placeholder' => 'Email', 'class' => 'form-control input-form']); ?>
                    </div>
                    <div class="form-group col-xs-12 nopadding">
                        <button class="button defualt-btn nomargin" type="submit">Next</button>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            
            
            
            
        </div>
        
         <div class="col_one_third col_last">
                <?php echo $this->element('ads', ['size' => 'Top Right (375px x 250px)']); ?>
                <?php echo $this->element('ads', ['size' => 'Middle Right (375px x 250px)']); ?>
                <?php echo $this->element('ads', ['size' => 'Bottom Right (375px x 250px)']); ?>
            </div>
        
    </div>
</div>
