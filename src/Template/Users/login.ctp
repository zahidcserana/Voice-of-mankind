
<div class="main_page_content" id="usersLogin">
    <div class="container clearfix">
        <?php /*
    <div class="col_half bottommargin-lg">
        <img src="https://drscdn.500px.org/photo/189035543/q%3D80_m%3D2000/v2?user_id=24046873&webp=true&sig=d66b952298dbe31cfa0b4e834f691a8e9fa6249fc28fdcf77d490e9028a8d057"/>
    </div>
*/ ?>


        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 login-new topmargin-lg no-pade bottommargin-lg">
            <div class="col-md-5 col-sm-6 col-xs-12 no-pade loginad-area">
                <?php echo $this->element('ads', ['size' => 'Page Center (550px x 400px)']);?>
            </div>
            <div class="col-md-7 col-sm-6 col-xs-12 new-login-area">
                <div class="heading-block center " style="margin-top: 50px;">
                <h4>Login To Your Account</h4>
                </div>
                <?php echo $this->Flash->render(); ?>
                <?php echo $this->Form->create('Users', array('type' => 'post', 'id' => 'form-login', 'name' => 'form-login', 'url' => '/users/login')); ?>

                <div class="col_full topmargin-sm">
                    <label for="login-form-username">Email:</label>
                    <?php echo $this->Form->control('email', ['type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Email Address']); ?>
                </div>

                <div class="col_full">
                    <label for="login-form-password">Password:</label>
                    <?php echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Password']); ?>
                </div>

                <div class="col_full nobottommargin">
                    <button class="button defualt-btn btn-radius button-blue nomargin" id="login-submit" value="login">
                        Login
                    </button>
                    <a href="/users/forgot-password" class="pull-right forget-password">Forgot Password?</a>
                </div>
                <div class="col_full nobottommargin" style="margin-top: 20px;">
                    <a href="/users/signup" class="button btn-shadow create-btn btn-radius button-aqua button-light"
                       style="width: 100%;text-align: center">Create New Account</a>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>

        <div class="col-md-4 col-md-offset-2 col-sm-12 col-xs-12 login-signup-area bottommargin-md" style="display: none;">
            <?php echo $this->element('ads', ['size' => 'Page Center (550px x 400px)']);?>
        </div>
        <div class="col-md-4 col-md-offset-1 col-sm-12  col-xs-12 login-signup-area bottommargin-lg" style="display: none">
            <div class="heading-block center">
                <h4>Login To Your Account</h4>
            </div>
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Form->create('Users', array('type' => 'post', 'id' => 'form-login', 'name' => 'form-login', 'url' => '/users/login')); ?>

            <div class="col_full">
                <label for="login-form-username">Email:</label>
                <?php echo $this->Form->control('email', ['type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Email Address']); ?>
            </div>

            <div class="col_full">
                <label for="login-form-password">Password:</label>
                <?php echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Password']); ?>
            </div>

            <div class="col_full nobottommargin">
                <button class="button defualt-btn button-blue nomargin" id="login-submit" value="login">
                    Login
                </button>
                <a href="/users/forgot-password" class="pull-right forget-password">Forgot Password?</a>
            </div>
            <div class="col_full nobottommargin" style="margin-top: 20px;">
                <a href="/users/signup" class="button button-3d button-rounded button-aqua button-light"
                   style="width: 100%;text-align: center">Create New Account</a>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>

    </div>
</div>
