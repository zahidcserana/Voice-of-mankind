<?php /*<div id="page-menu" class="">
    <div id="page-menu-wrap">
        <div class="container clearfix">
            <nav class="one-page-menu">
                <ul>
                    <li>
                        <a href="#"><div>My Account</div></a>
                    </li>
                    <li class=""><a href="#"><div>My Stories</div></a></li>
                    <li class=""><a href="#"><div>My Reform Ideas</div></a></li>
                    <li><a href="#"><div>My Comments</div></a></li>
                    <li><a href="#"><div>My Helpful Links</div></a></li>
                </ul>
            </nav>
            <div id="page-submenu-trigger"><i class="icon-reorder"></i></div>

        </div>
    </div>
</div>
*/ ?>
<div class="main_page_content" id="my_profile">
    <section id="content">
        <div class="container topmargin">
            <div class="row">
                <?php echo $this->Flash->render(); ?>
                <div class="col-sm-12 account-area">
                    <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                        <?php echo $this->element('my_account_left_panel'); ?>

                        <div class="tab-container">
                            <div class="clearfix" id="account">
                                <ul id="myTab2" class="nav account-tab nav-pills boot-tabs">
                                    <li class="active"><?php echo $this->Html->link(__('My Profile'), ['controller' => 'users', 'action' => 'my-profile']); ?></li>
                                    <li><?php echo $this->Html->link(__('Change Password'), ['controller' => 'users', 'action' => 'change-password']); ?></li>
                                    <li><?php echo $this->Html->link(__('Change Avatar'), ['controller' => 'users', 'action' => 'change-avatar']); ?></li>
                                </ul>
                                <div id="myTabContent2" class="tab-content">
                                    <?= $this->Form->create($user, ['class' => 'nobottommargin', 'type' => 'post', 'id' => 'register-form', 'name' => 'profile-update-form']) ?>
                                    <div class="tab-pane fade in active" id="profile">
                                        <div class="col_half">
                                            <label for="register-form-name">First Name:</label>
                                            <?php echo $this->Form->control('first_name', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'First Name']); ?>
                                        </div>
                                        <div class="col_half col_last">
                                            <label for="register-form-email">Last Name:</label>
                                            <?php echo $this->Form->control('last_name', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Last Name']); ?>
                                        </div>
                                        <div class="col_half">
                                            <label for="register-form-email">Email Address:</label>
                                            <?php echo $this->Form->control('email', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Email Address']); ?>
                                        </div>
                                        <div class="col_half col_last">
                                            <div style="display: none" id="zip-code-msg" class="alert alert-danger">
                                                Please Enter A Valid Zip
                                                Code
                                            </div>
                                            <label for="register-form-email">Zipcode: <?php echo $user->zip_code ?></label>
                                            <input type="hidden" name="zip_code" id="zip_code"
                                                   value="<?php echo $user->zip_code ?>">
                                            <?php echo $this->Form->input('zip_value', array('type' => 'select', 'id' => 'selectZip', 'class' => 'form-control input-form', 'label' => false)); ?>
                                        </div>
                                        <div id="userLocation">
                                            <div class="col_half">
                                                <label for="register-form-email">State:</label>
                                                <?php echo $this->Form->control('state_id', ['label' => false, 'class' => 'form-control input-form',
                                                    'type' => 'select', 'options' => $states, 'empty' => '-- Select State --']); ?>
                                            </div>
                                            <div class="col_half col_last" id="countyList">
                                                <label for="register-form-email">County:</label>
                                                <?php echo $this->Form->control('county_id', ['label' => false, 'class' => 'form-control input-form', 'options' => $counties]); ?>
                                            </div>
                                            <div class="col_half" id="cityList">
                                                <label for="register-form-email">City:</label>
                                                <?php echo $this->Form->control('city_id', ['label' => false, 'class' => 'form-control input-form', 'options' => $cities]); ?>
                                            </div>
                                        </div>
                                        <div class="col_half col_last">
                                            <label for="register-form-name">Address:</label>
                                            <?php echo $this->Form->control('address', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Address']); ?>
                                        </div>
                                        <div class="col_full">
                                            <label for="register-form-email">About me:</label>
                                            <?php echo $this->Form->textarea('about_me', ['label' => false, 'class' => 'form-control input-form account-textarea', 'placeholder' => 'About Me']); ?>
                                        </div>
                                        <div class="col_full nobottommargin">
                                            <button class="button defualt-btn" id="submit" value="register"
                                                    type="submit">Submit
                                            </button>
                                        </div>
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
