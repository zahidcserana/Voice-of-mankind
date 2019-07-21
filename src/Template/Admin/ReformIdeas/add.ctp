<div class="main_page_content" id="reform_idea">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create('reformIdeas', array('name' => 'form-add-reform','class'=>'m-form m-form--fit m-form--label-align-right')); ?>
    <div class="m-portlet__body">
        <?php if(!isset($storyId)){ ?>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Agency Type
            </label>
            <div class="col-8">
                <?php
                echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $session['Auth']['User']['id']]);
                $i = 1;//to differentiate the radios
                foreach ($agencyTypes as $agencyType):
                    ?>
                    <div class="radio-btn">
                        <input id="radio-<?php echo $i; ?>" class="radio-style" name="agency_type" type="radio"
                               value="<?php echo $agencyType['value']; ?>">
                        <label for="radio-<?php echo $i; ?>"
                               class="radio-style-1-label"><?php echo $agencyType['text'] ?></label>
                    </div>
                    <?php
                    $i++;
                endforeach; ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Agency
            </label>
            <div class="col-8">
                <?php  echo $this->Form->control('agency_id', ['label'=>false,'class'=>'form-control m-input ','empty' => '-- Select Agency --', 'id' => 'selectAgency']);
                ?>
            </div>
        </div>
        <?php } ?>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Description
            </label>
            <div class="col-8">
                <?php
                echo $this->Form->textarea('idea', ['required' => 'true', 'class' => 'form-control input-form', 'id' => 'summernote', 'label' => false]);
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
                    <a href="/admin/reform-ideas" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>
