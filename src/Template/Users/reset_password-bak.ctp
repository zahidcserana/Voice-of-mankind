<section id="content" class="main-content">
    <div class="container topmargin">
        <div class="row">
            <div class="col_full create-story-area">

                <div class="col-md-10 col-md-offset-1 col-xs-12 login-signup-area">

                    <div class="tabs divcenter nobottommargin clearfix">
                        <div class="tab-container">
                            <!-- Signin Form -->
                            <div class=" col-md-6 tab-content clearfix">
                                <div class="heading-block center heading-area">
                                    <h4>Reset Password</h4>
                                </div>
                                <div class="panel panel-default nobottommargin">
                                    <div class="panel-body" style="padding: 20px;">
                                        <?php echo $this->Form->create('Users',array('type' => 'post', 'id'=>'login','url'=>'/users/reset-password'));?>

                                            <div class="col_full">
                                                <label for="login-form-username">Enter New Password:</label>
                                                <?php 
                                                    echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control input-form',
                                                        'label' => false, 'placeholder' => 'New Password', 'required' => true]);
                                                    if(isset($this->request->pass[0]) && !empty($this->request->pass[0])){
                                                        echo $this->Form->control('access_token', ['type' => 'hidden','value' => $this->request->pass[0]]);
                                                    }
                                                ?>
                                            </div>
                                            <div class="col_full">
                                                <label for="login-form-username">Confirm New Password:</label>
                                                <?php
                                                echo $this->Form->control('confirm_password', ['type' => 'password', 'class' => 'form-control input-form',
                                                    'label' => false, 'placeholder' => 'Confirm New Password', 'required' => true]);
                                                ?>
                                            </div>
                                        <div class="col_full nobottommargin">
                                            <button class="button defualt-btn" id="submit" value="register">Update Password</button>
                                        </div>

                                            <?php echo $this->Form->end();?>
                                    </div>
                                </div>
                            </div>
                            <!-- / Signin Form -->
                        </div>
                        <!-- / Tab Container -->
                    </div>
                </div>
            </div>
            <!-- / Sign up Form -->
        </div>
        <!-- / Tab Container -->
    </div>
</section>