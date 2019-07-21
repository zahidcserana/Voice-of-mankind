<div class="tab-pane active" id="tab_1_1">
    <?php echo $this->Form->create($user); ?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Name</label>

                <?php echo $this->Form->control('name', array('placeholder' => 'Name', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Email</label>
                <?php echo $this->Form->control('email', array('placeholder' => 'Email', 'class' => 'form-control', 'type' => 'email', 'label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">User Type</label>
                <?php echo $this->Form->control('user_type_id', array('class' => 'form-control', 'label' => false, 'options' => $userTypes, 'value' => $user->user_type_id,'disabled'=>true)); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Postal Code</label>
                <?php echo $this->Form->control('zipcode', array('class' => 'form-control', "placeholder" => "Post Code", 'label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">City</label>
                <?php echo $this->Form->control('city', array('class' => 'form-control', "placeholder" => "City", 'label' => false, 'div' => false)); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">State</label>
                <?php echo $this->Form->control('state', array('class' => 'form-control', "placeholder" => "State", 'label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Country</label>
                <?php $country_id = empty($user->country)? 840 : $user->country;?>
                <?php echo $this->Form->control('country', array('label' => false, 'class' => 'form-control', 'options' => $countries,'value'=>$country_id)); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Address</label>
        <?php echo $this->Form->control('address', array('type'=>'textarea', 'class' => 'form-control', "placeholder" => "Address", 'label' => false, 'div' => false)); ?>
    </div>
    <div class="form-group">
        <label class="control-label">Phone</label>
        <?php echo $this->Form->control('phone', array('class' => 'form-control', 'type' => 'text', 'placeholder' => '+1 646 580 DEMO (6284)', 'label' => false, 'div' => false)); ?>
    </div>
    <div class="form-group">
        <label class="control-label">Website</label>
        <?php echo $this->Form->control('website', array('class' => 'form-control', 'placeholder' => 'Website', 'label' => false, 'div' => false)); ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Facebook</label>
                <?php echo $this->Form->control('facebook', array('class' => 'form-control', 'placeholder' => 'Facebook User name', 'label' => false, 'div' => false)); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">Twitter</label>
                <?php echo $this->Form->control('twitter', array('class' => 'form-control', 'placeholder' => 'Twitter User name', 'label' => false, 'div' => false)); ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Bio</label>
        <?php
        echo $this->Form->control('bio', [
            'label' => false,
            'class' => 'form-control editor',
            'type' => 'textarea',
            'placeholder' => 'Bio',
            'id'=>' editor'
        ]);

        ?>

    </div>

    <div class="margin-top-10">
        <button class="button bg-theme button-rounded ">Save Changes</button>

        <?php echo $this->Html->link('Cancel', "accounts/profile", array('class' => 'button  button-border button-rounded')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
</div>