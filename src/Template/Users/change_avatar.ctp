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
                                <li><?php echo $this->Html->link(__('Change Password'), ['controller' => 'users', 'action' => 'change-password']);?></li>
                                <li class="active"><?php echo $this->Html->link(__('Change Avatar'), ['controller' => 'users', 'action' => 'change-avatar']);?></li>
                            </ul>
                            <div id="myTabContent2" class="tab-content">
                                <!-- Change Avatar -->
                                <div class="">
                                    <?= $this->Form->create($user, ['class' => 'nobottommargin', 'type' => 'file', 'id' => 'register-form']) ?>
                                        <div class="form-group col-xs-12 nopadding file-input">
                                            <?php echo $this->Form->control('avatar_name', ['type' => 'file', 'id' => 'abc', 'class' => 'inputfile inputfile-1', 'label' => false]);?>
<!--                                            <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1">-->
                                            <label for="abc" class="avature-fileupload">
                                                <span><i class="icon-upload-alt"></i> Change Your Image</span>
                                            </label>
                                        </div>
                                        <div class="form-group col-xs-12 nopadding">
                                            <button class="button defualt-btn pull-right">Submit </button>
                                        </div>
                                    <?php echo $this->Form->end();?>
                                </div>
                                <!-- / Change Avatar -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>