<div class="container topmargin main_page_content" id="stories_edit_location">
    <div class="row">
        <div class="col_full create-strory-area">
            <div class="col-sm-3 col-xs-12 create-left-side"></div>
            <div class="col-sm-6 col-xs-12 create-right-side">
                <div class="heading-block center">
                    <h4>Update Location</h4>
                </div>
                <?= $this->Form->create($story, ['name' => 'edit-location-form']) ?>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">Country</label>
                    <?php
                    echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
                    echo $this->Form->control('country_id', ['label' => false,'required' => 'true', 'options' => $countries, 'id' => 'selectCountry',
                        'default' => $story->country_id, 'empty' => '-- Select Country --', 'class' => 'form-control input-form']);
                    ?>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">State</label>
                    <?php
                    echo $this->Form->control('state_id', ['label' => false,'type' => 'select', 'options' => $states, 'id' => 'selectState',
                        'default' => $story->state_id, 'empty' => '-- Select State --', 'class' => 'form-control input-form']);
                    ?>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">City</label>
                    <?php
                    echo $this->Form->control('city', ['label' => false,'type' => 'text', 'value' => $story->city, 'class' => 'form-control input-form']);
                    ?>
                </div>
                <div class="form-group col-xs-12 nopadding">
                    <label for="exampleInputEmail1">ZIP</label>
                    <?php
                    echo $this->Form->control('zip_code', ['label' => false,'type' => 'text', 'value' => $story->zip_code, 'class' => 'form-control input-form']);
                    ?>
                </div>

                <div class="form-group col-xs-12 nopadding">
                    <button class="button button-3d button-blue button-rounded nomargin" type="submit">Next</button>                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
            <div class="col-sm-3 col-xs-12 create-left-side"></div>
        </div>
    </div>
</div>