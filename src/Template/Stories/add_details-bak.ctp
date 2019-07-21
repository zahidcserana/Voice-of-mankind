<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story $story
 */
use Cake\Core\Configure;
echo $this->Html->css(Configure::read("baseUrl").'plugins/summernote/bootstrap.min.css');
echo $this->Html->css(Configure::read("baseUrl").'plugins/summernote/summernote.css');
echo $this->Html->script(Configure::read("baseUrl").'plugins/summernote/bootstrap.min.js');
echo $this->Html->script(Configure::read("baseUrl").'plugins/summernote/summernote.js');
?>

<div class="main_page_content" id="stories_add_details">
    <div class="stories form large-9 medium-8 columns content">
        <?= $this->Form->create($story, ['name' => 'add-details-form']) ?>
        <fieldset>
            <legend><?= __('Add Details') ?></legend>
            <?php
                $isPublic = property_exists($story, 'is_public')? $story->is_public: 0;
                echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
//                echo $this->Form->textarea('description', ['required' => 'true', 'id' => 'description', 'class' => 'ckeditor']);
                echo $this->Form->textarea('description', ['required' => 'true', 'id' => 'summernote']);
                echo $this->Form->control('is_public', ['checked' => $isPublic]);
                echo $this->Form->control('categories._ids[]', ['options' => $categories, 'empty' => '-- Select Category --', 'required' => true]);
                echo '<h3>Adding Media<br/></h3>';
                echo $this->Form->radio('media_type', $mediaTypes);

//            pr($mediaTypes);

//            echo $this->Form->control('media_type', ['type' => 'hidden']);
            foreach($mediaTypes as $mediaType):
                ?>
<!--                <div class="radio-btn">-->
<!--                    <input id="radio-4" class="radio-style" name="media_type" type="radio" value="--><?php //echo $mediaType['value'];?><!--">-->
<!--                    <label for="radio-4" class="radio-style-1-label">--><?php //echo $mediaType['text']?><!--</label>-->
<!--                </div>-->
            <?php endforeach;?>

        </fieldset>

        <div class="dropzone dz-clickable" id="form-file-uploader">
            <div class="fallback">
            </div>
        </div>
        <div class="youtube-link">
            <?php echo $this->Form->control('youtube_link', ['type' => 'text', 'class' => 'youtube-link', 'label' => 'Youtube Link','placeholder' => 'Youtube URL']);?>
        </div>
        <br/>

        <?= $this->Form->button(__('Next')) ?>
        <?= $this->Form->end() ?>
    </div>


</div>