
    <div style="padding: 5%;" class="m-portlet__body" id="password_change_form">
        <div class="success">
        </div>
        <?php echo $this->Form->create($user, array('url' => '/admin/users/change_password/' . $user['id'] ,'name'=>'admin-change-password')); ?>
        <div class="form-group">
            <label class="control-label">New Password</label>
            <?php echo $this->Form->input('npassword', array('type' => 'password', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'npassword', 'value' => '')); ?>
        </div>
        <div class="form-group">
            <label class="control-label">Re-type New Password</label>
            <?php echo $this->Form->input('cpassword', array('type' => 'password', 'class' => 'form-control', 'div' => false, 'label' => false, 'id' => 'cpassword', 'value' => '')); ?>
        </div>
        <div class="alert alert-warning password-match" style="display: none;">
            <strong>Warning!</strong> Password doesn't matching.
        </div>
        <div class="margin-top-10">
            <button class="btn btn-brand">Change Password</button>
        </div>
        <?= $this->Form->end()?>
    </div>

