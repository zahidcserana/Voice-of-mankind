<div class="main_page_content" id="stories_edit">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($story, array('name' => 'stories-edit-form','class'=>'m-form m-form--fit m-form--label-align-right')); ?>
    <div class="m-portlet__body">
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Title
            </label>
            <div class="col-8">
                <?php echo $this->Form->control('title',array('label'=>false,'class'=>'form-control m-input','placeholder'=>'Enter Title'));?>
            </div>
        </div>
        <div class="m-form__group form-group row">
            <label class="col-2 col-form-label">
                Agency Type
            </label>
            <div class="m-radio-list">
                <?php foreach ($agencyTypes as $row) {
                    $checked = '';
                    if($story->agency->type==$row['value']){
                        $checked = 'checked';
                    }
                    ?>
                <label class="m-radio">
                    <input type="radio" name="agency_type" id="agency_type" value="<?php echo $row['value']?>" <?php echo $checked;?>>
                    <?php echo $row['text']?>
                    <span></span>
                </label>
                <?php } ?>
            </div>
        </div>
        <div class="form-group m-form__group row">
            <label class="col-2 col-form-label">
                Agency Name:
            </label>
            <div class="col-8">
                <input type="hidden" id="currentAgencyId" value="<?php echo $story->agency->id;?>">
                <input type="hidden" id="currentAgencyName" value="<?php echo $story->agency->name;?>">
                <?php  echo $this->Form->control('agency_id', ['label'=>false,'class'=>'form-control m-input','empty' => '-- Select Agency --', 'id' => 'selectAgency']);
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
                        Next
                    </button>
                    <a href="/admin/stories" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->Form->end(); ?>
</div>




