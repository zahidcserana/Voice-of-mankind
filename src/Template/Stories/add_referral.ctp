<div class="main_page_content" id="stories_add_referral">
    <section id="content">
        <div class="container topmargin">
            <div class="row">
                <?php echo $this->element('Global' . DS . 'steps'); ?>
                <h3>Was there any professional who could help you in the story and deserves to be recognized?<br/> Please refer him below.</h3>
            </div>
            <div class="row">
                <?php echo $this->Flash->render(); ?>
                <div class="col_full create-strory-area">
                    <div class="col-sm-5 col-xs-12 create-left-side">
                        <?= $this->Form->create($story, ['name' => 'form-add-referral']) ?>
                        <div class="form-group">
                            <?php
                                echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id]);
                            ?>
                            <h4>Search Referral By Profession and Name</h4>
                            <label for="exampleInputEmail1">Profession</label><br/>
                            <div class="white-section">
                                <?php
                                echo $this->Form->control('referral.profession_id', ['type' => 'select', 'label' => false,
                                'class' => 'form-control input-form', 'id' => 'referralProfession', 'default' => $selectedProfessionId,
                                'options' => $professions, 'empty' => '-- Select Profession --']);
                                ?>
                            </div>
                            <br/>
                            <label for="exampleInputEmail1">Referral</label><br/>
                            <div class="white-section">
                                <input type="hidden" id="referralId" value="<?php echo empty($story->referrals[0]['id'])==true?'':$story->referrals[0]['id'];?>">
                                <input type="hidden" id="referralName" value="<?php echo empty($story->referrals[0]['name'])==true?'':$story->referrals[0]['name']?>">
                                <?php
                                echo $this->Form->control('referrals._ids[]', ['type' => 'select', 'options' => $referrals,
                                    'empty' => '-- Referral Name --', 'default' => $selectedReferralId,
                                    'class' => 'form-control input-form selectpicker', 'id' => 'selectReferral', 'label' => false]);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-12 or-circle">
                        <h4>OR</h4>
                    </div>
                    <div class="col-sm-6 col-xs-12 create-right-side">
                        <div class="heading-block center">
                            <h4>Add Someone</h4>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">Name</label>
                            <?php
                            echo $this->Form->control('referral.is_active', ['type' => 'hidden', 'value' => 0]);
                            echo $this->Form->control('referral.name', ['type' => 'text', 'label' => false,
                                'class' => 'form-control input-form', 'id' => 'referralName', 'required' => false]);
                            ?>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">Profession</label>
                            <?php
                            echo $this->Form->control('referral.profession', ['type' => 'select', 'label' => false,
                                'class' => 'form-control input-form', 'id' => 'referralProfession', 'required' => true,
                                'options' => $professions, 'empty' => '-- Select Profession --']);
                            ?>
                        </div>
<!--                        <div class="row">
                            <div class="form-group col-xs-6 nopadding1">
                                <label for="exampleInputEmail1">City</label>
                                <?php echo $this->Form->control('referral.city', ['type' => '', 'class' => 'form-control input-form',
                                    'placeholder' => 'City', 'label' => false]);
                                ?>
                            </div>
                            <div class="form-group col-xs-6 nopadding2">
                                <label for="exampleInputEmail1">State</label>
                                <?php echo $this->Form->control('referral.state_id', ['type' => 'select', 'options' => $states,
                                    'empty' => '-- Select State --', 'id' => 'selectState', 'class' => 'form-control input-form', 'label' => false]);
                                ?>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">Zip Code</label>
                            <?php echo $this->Form->control('referral.zip_code', ['type' => 'text', 'required' => false,
                                'class' => 'form-control input-form', 'placeholder' => 'Zip Code', 'label' => false]);
                            ?>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">Address</label>
                            <?php echo $this->Form->control('referral.address', ['type' => 'text', 'class' => 'form-control input-form',
                                'placeholder' => 'Address', 'label' => false]);
                            ?>
                        </div>-->
                        <div class="row">
                            <div class="form-group col-xs-6 nopadding1">
                                <label for="exampleInputEmail1">Email</label>
                                <?php echo $this->Form->control('referral.email', ['type' => 'email', 'class' => 'form-control input-form',
                                    'placeholder' => 'Email', 'required' => false, 'label' => false]);
                                ?>
                            </div>
                            <div class="form-group col-xs-6 nopadding2">
                                <label for="exampleInputEmail1">Phone Number</label>
                                <?php echo $this->Form->control('referral.phone', ['type' => 'text', 'required' => false, 'class' => 'form-control input-form',
                                    'placeholder' => 'Phone Number', 'label' => false]);
                                ?>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 nopadding">
                            <button class="button comnt-btn defualt-btn pull-right">Next >></button>
                            <?php ?>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

