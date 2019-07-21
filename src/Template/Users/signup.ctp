<div class="main_page_content main-content" id="usersSignup">
    <div class="container clearfix">
        <div class="row">
            <div class="col-md-6  bottommargin-lg">                
                <?php echo $this->element('ads', ['size' => 'Page Center (550px x 400px)']); ?>
            </div>
            <div class="col-md-6 col-sm-12  col-xs-12 login-signup-area bottommargin-lg">
                <div class="heading-block center">
                    <h4>Register</h4>
                </div>
                <?php echo $this->Flash->render(); ?>
                <?php echo $this->Form->create('Users', array('type' => 'post', 'id' => 'form-register', 'url' => '/users/signup')); ?>

                <div class="col_half">
                    <label for="register-form-name">First Name:</label>
                    <?php echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'class' => 'form-control input-form', 'label' => false)); ?>
                </div>

                <div class="col_half col_last">
                    <label for="register-form-name">Last Name:</label>
                    <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'class' => 'form-control input-form', 'label' => false)); ?>
                </div>

                <div class="col_full">
                    <label for="register-form-email">Email Address:</label>
                    <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email Address', 'class' => 'form-control input-form', 'label' => false)); ?>
                </div>
                <div class="col_half">
                    <label for="register-form-password">Password:</label>
                    <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control input-form',
                        'label' => false)); ?>
                </div>

                <div class="col_half col_last">
                    <label for="register-form-repassword">Confirm Password:</label>
                    <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'class' => 'form-control input-form', 'label' => false)); ?>
                </div>
                <div class="heading-block center">
                    <h5>Personal Information</h5>
                </div>
                <div class="col_half">
                    <label for="register-form-email">Phone Number:</label>
                    <?php echo $this->Form->input('phone', array('type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Phone Number')); ?>
                </div>
                <div class="col_half col_last">
                    <div style="display: none" id="zip-code-msg" class="alert alert-danger">Please Enter A Valid Zip
                        Code
                    </div>
                    <label for="register-form-email">Zipcode:</label>
                    <input type="hidden" name="zip_code" id="zip_code">
                    <?php echo $this->Form->input('zip_value', array('type' => 'select','id' => 'selectZip', 'class' => 'form-control input-form', 'label' => false)); ?>
                </div>
                <div id="userLocation">
                    <div class="col_half">
                        <label for="register-form-email">State:</label>
                        <?php echo $this->Form->input('state_id', array('type' => 'select', 'class' => 'form-control input-form', 'label' => false, 'options' => $states, 'empty' => '-- Select State --')); ?>
                    </div>

                    <div class="col_half col_last" id="countyList">
                        <label for="register-form-email">County:</label>
                        <?php echo $this->Form->input('county_id', array('type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'County')); ?>
                    </div>

                    <div class="col_half" id="cityList">
                        <label for="register-form-email">City:</label>
                        <?php echo $this->Form->input('city_id', array('type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'City')); ?>
                    </div>
                </div>
                <div class="col_half col_last">
                    <label for="register-form-name">Address:</label>
                    <?php echo $this->Form->input('address', array('type' => 'text', 'class' => 'form-control input-form', 'label' => false, 'placeholder' => 'Address')); ?>
                </div>

                <div class="col_full nobottommargin">
                    <div style="padding-bottom: 2%" class="g-recaptcha"
                         data-sitekey="6LfdGEgUAAAAAJ8u1mzup0cN_lbheyPjyvO7zIDa"></div>
                    <button class="button defualt-btn" id="submit" value="register">
                        Register
                        Now
                    </button>
                    <a href="/users/login" class="button button-3d button-rounded button-aqua button-light pull-right">Already
                        Created Account?</a>
                </div>
                <?php echo $this->Form->end(); ?>
                <!--<a href="/users/social/facebook"
                   class="button button-rounded t400 btn-block center si-colored noleftmargin si-facebook">Facebook</a>-->
                <a href="/users/social/google"
                   class="button button-rounded t400 btn-block center si-colored noleftmargin si-gplus">Google</a>
            </div>
        </div>
    </div>
</div>
