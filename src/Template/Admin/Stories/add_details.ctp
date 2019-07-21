<div class="main_page_content" id="stories_add_details">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($story, array('name' => 'add-details-form', 'class' => 'm-form m-form--fit m-form--label-align-right')) ?>
    <fieldset>
        <legend><?= __('Add Details') ?></legend>
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Categories
                </label>
                <div class="col-8">
                    <?php
                    echo $this->Form->control('categories._ids[]', array('label' => false, 'class' => 'form-control m-input', 'empty' => '-- Select Category --', 'options' => $categories)); ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Description
                </label>
                <div class="col-8">
                    <?php
                    echo $this->Form->textarea('description', array('label' => false, 'class' => 'form-control m-input', 'required' => 'true', 'id' => 'summernote')); ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Media Type
                </label>
                <div class="col-8">
                    <?php echo $this->Form->radio('media_type', $mediaTypes); ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Is Public
                </label>
                <?php $isPublic = $story->is_public;
                echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
                ?>
                <div class="col-md-4">
                    <?php
                    $checked = '';
                    if ($isPublic == 1){
                        $checked = 'checked';
                    }
                    ?>
                    <input id="radio-4" class="radio-style" name="is_public"  value="public" 
                           type="radio" <?php echo $checked?>>
                    <label for="radio-4" class="radio-style-3-label">Public</label>
                </div>
                <div class="col-md-4">
                    <?php
                    $checked = '';
                    if ($isPublic == 0){
                        $checked = 'checked';
                    }
                    ?>
                    <input id="radio-5" class="radio-style" name="is_public" value="private" 
                           type="radio" <?php echo $checked?>>
                    <label for="radio-5" class="radio-style-3-label">Private</label>
                </div>
            </div>
        </div>
        <?php echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
        ?>
    </fieldset>
    <div class="form-group m-form__group row">
        <label class="col-2 col-form-label">
            Adding Media
        </label>
        <div class="col-8">
            <div class="dropzone dz-clickable" id="form-file-uploader">
                <div class="fallback">
                </div>
            </div>
            <div class="form-group" id="div-youtube-link" style="display: none">
                <?php echo $this->Form->control('youtube_link', ['type' => 'text', 'class' => 'form-control input-form youtube-link', 'label' => 'Youtube Link', 'placeholder' => 'Youtube URL']); ?>
            </div>
        </div>
    </div>
    <br/>

    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <button type="submit" class="btn btn-success">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>
<?php echo $this->element('Admin/Stories/media', array('story' => $story)); ?>
<style>
    .m-form .m-form__group .form-control-label, .m-form .m-form__group label {
        font-weight: 400;
        font-size: 1rem;
        padding-left: 10px;
    }
    input[type="radio"], input[type="checkbox"] {
        box-sizing: border-box;
        margin-right: 5px;
    }
</style>