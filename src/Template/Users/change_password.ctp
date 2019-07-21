<div class="main_page_content" id="change_password">
<section id="content">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render();?>
            <!-- Accout Content Area -->
            <div class="col-sm-12 account-area">
                <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                    <ul class="tab-nav clearfix">
                        <li><?php echo $this->Html->link(__('My Account'), ['controller' => 'users', 'action' => 'my-profile']);?></li>
                        <li><?php echo $this->Html->link(__('My Stories'), ['controller' => 'users', 'action' => 'my-stories']);?></li>
                        <li><?php echo $this->Html->link(__('My Comments'), ['controller' => 'users', 'action' => 'my-comments']);?></li>
                        <li><?php echo $this->Html->link(__('My List'), ['controller' => 'users', 'action' => 'my-list']);?></li>
                    </ul>

                    <div class="tab-container">
                        <!-- My Account area start -->
                        <div class="clearfix" id="account">
                            <ul id="myTab2" class="nav account-tab nav-pills boot-tabs">
                                <!--                                <li class="active"><a href="#profile" data-toggle="tab">My Profile</a></li>-->
                                <li><?php echo $this->Html->link(__('My Profile'), ['controller' => 'users', 'action' => 'my-profile']);?></li>
                                <li class="active"><?php echo $this->Html->link(__('Change Password'), ['controller' => 'users', 'action' => 'change-password']);?></li>
                                <li><?php echo $this->Html->link(__('Change Avatar'), ['controller' => 'users', 'action' => 'change-avatar']);?></li>
                            </ul>
                            <div class="tab-content">
                                <!-- Change Password -->
                                <div class="cp-content">
                                    <?= $this->Form->create($user, ['class' => 'nobottommargin', 'type' => 'post', 'id' => 'register-form', 'name' => 'change-password']) ?>
<!--                                    <form id="register-form" name="register-form" class="nobottommargin" action="#" method="post">-->
                                        <div class="col-md-6 col-sm-7 col-xs-12">
                                            <div class="col_full">
                                                <label for="register-form-name">Old Password:</label>
                                                <?php echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control input-form',
                                                    'placeholder' => 'Old Password', 'label' => false, 'required' => true, 'value' => '']);?>
                                            </div>
                                            <div class="col_full">
                                                <label for="register-form-name">New Password:</label>
                                                <?php echo $this->Form->control('new_password', ['type' => 'password', 'class' => 'form-control input-form',
                                                    'placeholder' => 'New Password', 'label' => false, 'required' => true]);?>
                                            </div>
                                            <div class="col_full">
                                                <label for="register-form-name">Confirm Password:</label>
                                                <?php echo $this->Form->control('confirm_password', ['type' => 'password', 'class' => 'form-control input-form',
                                                    'placeholder' => 'Confirm Password', 'label' => false, 'required' => true]);?>
                                            </div>
                                            <div class="col_full nobottommargin">
                                                <button class="button defualt-btn" id="submit" value="register">Submit</button>
                                            </div>
                                        </div>
                                    <?php echo $this->Form->end();?>
                                </div>
                                <!-- / Change Password -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
</div>