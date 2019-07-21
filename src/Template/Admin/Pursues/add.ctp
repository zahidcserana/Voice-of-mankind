<div class="main_page_content" id="pursues_add">
    <?php echo $this->Flash->render(); ?>
    <?= $this->Form->create($pursue) ?>
    <?php echo $this->Form->control('referral_id', ['type' => 'hidden', 'value' => $referralId]); ?>
    <div class="m-portlet__body">
        <div class="row">
            <div class="col-md-6">
                <h3>Communication Summary</h3>
                <?php echo $this->Form->control('response', ['label' => false, 'cols' => '50']); ?>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-6">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
                <a href="/admin/pursues" class="btn btn-secondary">
                    Cancel
                </a>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>