<section id="content" class="main-content">
    <div class="container topmargin">
        <div class="row">
            <div class="col_full create-story-area">

                <div class="col-md-10 col-md-offset-1 col-xs-12 login-signup-area">

                    <div class="tabs divcenter nobottommargin clearfix">
                        <div class="tab-container">
                            <div class=" col-md-6 tab-content clearfix">
                                <div class="heading-block center heading-area">
                                    <h4>Forgot Password</h4>
                                </div>
                                <div class="panel panel-default nobottommargin">
                                    <div class="panel-body" style="padding: 20px;">
                                        <?php echo $this->Form->create('Users',array('type' => 'post', 'id'=>'login','url'=>'/users/forgot-password'));?>

                                            <div class="col_full">
                                                <label for="login-form-username">Enter Your Email Address:</label>
                                                <?php echo $this->Form->control('email', ['type' => 'text', 'class' => 'form-control input-form',
                                                    'label' => false, 'placeholder' => 'Email Address', 'required' => true]);?>
                                            </div>
                                        <div class="col_full nobottommargin">
                                            <button class="button defualt-btn" id="submit" value="register">Get Password Reset Email</button>
                                        </div>

                                            <?php echo $this->Form->end();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>