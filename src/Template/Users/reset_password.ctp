<div class="main_page_content" id="reset_password">
    <div class="container clearfix">
        <div class="col_half col-md-offset-2  bottommargin-lg">
            <h3>RESET YOUR PASSWORD</h3>
            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Form->create('Users', array('type' => 'post', 'name' => 'reset_password-form', 'url' => '/users/reset-password')); ?>

            <div class="col_full">
                <label for="login-form-username">Enter New Password:</label>
                <?php
                echo $this->Form->control('password', ['type' => 'password', 'class' => 'form-control input-form',
                    'label' => false, 'placeholder' => 'New Password']);
                if (isset($this->request->pass[0]) && !empty($this->request->pass[0])) {
                    echo $this->Form->control('access_token', ['type' => 'hidden', 'value' => $this->request->pass[0]]);
                }
                ?>
            </div>
            <div class="col_full">
                <label for="login-form-username">Confirm New Password:</label>
                <?php
                echo $this->Form->control('confirm_password', ['type' => 'password', 'class' => 'form-control input-form',
                    'label' => false, 'placeholder' => 'Confirm New Password']);
                ?>
            </div>
            <div class="col_full nobottommargin">
                <button class="button button-3d button-rounded button-white button-light" id="submit" value="register">
                    Update Password
                </button>
            </div>

            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>