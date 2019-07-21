<div class="container clearfix">
    <div class="col_half col-md-offset-2  bottommargin-lg">
        <h3>If Password Forgotten</h3>

        <?php echo $this->Flash->render();?>

        <?php echo $this->Form->create('Users',array('type' => 'post', 'id'=>'login','url'=>'/users/forgot-password'));?>

        <div class="col_full">
            <label for="login-form-username">Enter Your Email Address:</label>
            <?php echo $this->Form->control('email', ['type' => 'text', 'class' => 'form-control input-form',
                'label' => false, 'placeholder' => 'Email Address', 'required' => true]);?>
        </div>
        <div class="col_full nobottommargin">
            <button class="button button-3d button-rounded button-white button-light" id="submit" value="register">Get Password Reset Email</button>
        </div>

        <?php echo $this->Form->end();?>
    </div>
</div>