<?php echo $this->Form->create('User', array('class' => 'login-form')); ?>
<?php echo $this->Flash->render(); ?>
<h3 class="form-title">Sign In</h3>
<div class="alert alert-danger display-hide">
    <button class="close" data-close="alert"></button>
    <span>Enter your email and password.</span>
</div>
<?php
echo $this->Form->input('email', [
    'label' => false,
    'div' => false,
    'class' => 'form-control form-control-solid placeholder-no-fix',
    'type' => 'text',
    'placeholder' => 'Email',
    'templates' => [
        'inputContainer' => '<div class="form-group "><label class="control-label visible-ie8 visible-ie9"> Email</label>{{content}}</div>',
    ]
]);
?>
<?php
echo $this->Form->input('password', [
    'label' => false,
    'div' => false,
    'class' => 'form-control form-control-solid placeholder-no-fix',
    'type' => 'password',
    'placeholder' => 'Password',
    'templates' => [
        'inputContainer' => '<div class="form-group "><label class="control-label visible-ie8 visible-ie9"> Password</label>{{content}}</div>',
    ]
]);
?>
<div class="g-recaptcha" data-sitekey="6LdmPUUUAAAAABE7cr10LOpWRz6YBRB8bBEJsEPE"></div>
<div class="form-actions">
    <button type="submit" class="btn blue btn-block uppercase" name="login" value="login">Login</button>
</div>


</form>

