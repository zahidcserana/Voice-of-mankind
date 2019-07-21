<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story $story
 */
?>
<div class="main_page_content" id="stories_edit_location">
    <div class="stories form large-9 medium-8 columns content">
        <?= $this->Form->create($story, ['name' => 'edit-location-form','class'=>'m-form m-form--fit m-form--label-align-right']) ?>
        <div class="m-portlet__body">
        <fieldset>
            <legend><?= __('Update Location') ?></legend>
            <?php
                echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
            ?>

            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Country
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('country_id', ['label' => false, 'class' => 'form-control m-input','required' => 'true', 'options' => $countries, 'id' => 'selectCountry',
                        'default' => $story->country_id, 'empty' => '-- Select Country --']);
                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    State
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('state_id', ['label' => false, 'class' => 'form-control m-input','type' => 'select', 'options' => $states, 'id' => 'selectState',
                        'default' => $story->state_id, 'empty' => '-- Select State --']);

                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    City
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('city', ['label' => false, 'class' => 'form-control m-input','type' => 'text', 'value' => $story->city]);
                    ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Zip code
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('zip_code', ['label' => false, 'class' => 'form-control m-input','type' => 'text', 'value' => $story->zip_code]);
                    ?>
                </div>
            </div>
        </fieldset>
        </div>
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
        <br/>
        <?= $this->Form->end() ?>
    </div>
</div>
