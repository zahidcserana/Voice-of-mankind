<div class="main_page_content" id="reset_password">
    <?php echo $this->Flash->render(); ?>
    <?php if (!empty($user)) { ?>
        <h2 class="big-title">Passwore Reset</h2>

        <?php echo $this->Form->create('Users', array('name' => 'reset_password-form')); ?>
        <?php echo $this->Form->input('activation_code', array('type' => 'hidden', 'value' => $activation_code)); ?>
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label for="npassword" class="col-2 col-form-label">New Password</label>
                <div class="col-8">
                    <input type="password" class="form-control m-input" name="npassword" id="npassword"
                           placeholder="Enter your password">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label for="cpassword" class="col-2 col-form-label">Re-type New Password</label>
                <div class="col-8">
                    <input type="password" class="form-control m-input" name="cpassword" id="cpassword"
                           placeholder="Enter Confirm password">
                </div>
            </div>
        </div>

        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success">
                            Next
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $this->Form->end(); ?>
    <?php } ?>
</div>