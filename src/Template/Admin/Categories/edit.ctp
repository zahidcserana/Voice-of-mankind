<div class="main_page_content" id="category_form">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($category, array('name' => 'category-form','class'=>'m-form m-form--fit m-form--label-align-right')); ?>
    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Parent
            </label>
            <div class="col-8">
                <?php echo $this->Form->control('parent_id', ['label'=>false,'class'=>'form-control m-input','options' => $categories, 'empty' => '-- Select Parent --']);
                ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Title
            </label>
            <div class="col-8">
                <?php echo $this->Form->control('title',array('label'=>false,'class'=>'form-control m-input','placeholder'=>'Enter Title'));?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Type
            </label>
            <div class="col-8">
                <?php echo $this->Form->control('type', ['label'=>false,'class'=>'form-control m-input','options' => $categoryTypes, 'empty' => '-- Select Type --']);
                ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Status
            </label>
            <div class="col-8">
                <?php
                echo $this->Form->control('status', array('class' => 'form-control m-input', 'label' => false, 'div' => false,'options'=>\Cake\Core\Configure::read('Status')));
                ?>
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
                    <a href="/admin/categories" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>

