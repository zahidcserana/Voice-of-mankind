<div class="main_page_content" id="adds_addform">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($ad, array('type'=>'file','name' => 'ad-form','class'=>'m-form m-form--fit m-form--label-align-right','id'=>'ad-form')); ?>
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Referral
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('referral_id', ['label'=>false,'class'=>'form-control m-input','options' => $referrals, 'empty' => '-- Select Referral --']);
                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Ad Page
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('page_name', ['label'=>false,'class'=>'form-control m-input','options' => $pagesForAd, 'empty' => '-- Select Page --','onchange'=> 'getadPostion();' ]);
                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Ad Position
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('ad_position', ['label'=>false,'class'=>'form-control m-input','options' => [], 'empty' => '-- Select Position --']);
                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Ad Type
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('ad_type',array('label'=>false,'class'=>'form-control m-input',
                        'placeholder'=>'Enter Title', 'options' => $adTypes, 'empty' => '-- Select Type --'));?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Select File
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('file_name', ['label'=>false,'type' => 'file', 'class'=>'form-control m-input']);
                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Start Date
                </label>
                <div class="col-8">
                    <input type="text" class="form-control m-input" name="start_date" id="start_date">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    End Date
                </label>
                <div class="col-8">
                    <input type="text" class="form-control m-input" name="end_date" id="end_date">
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Status
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('status',array('label'=>false,'class'=>'form-control m-input',
                        'placeholder'=>'Status', 'options' => ['1'=>'Active','2'=>'Inactive'], 'empty' => '-- Select Status --'));?>
                </div>
            </div>
        </div>
        <div class="m-portlet__foot m-portlet__foot--fit">
            <div class="m-form__actions">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success">
                            Submit
                        </button>
                        <a href="/admin/ads/index" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>