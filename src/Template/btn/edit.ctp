<div class="main_page_content" id="reform_idea">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render(); ?>
            <div class="col_full create-strory-area">
                <?= $this->Form->create('reformIdeas', ['name' => 'form-add-referral']) ?>
                <div class="col-sm-2 col-xs-12 create-right-side">
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Select Type</label>
                        <?php
                        echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => empty($story->id) == true ? '' : $story->id]);
                        echo $this->Form->control('user_id', ['type' => 'hidden', 'value' => $session['Auth']['User']['id']]);
                        $i = 1;//to differentiate the radios
                        foreach ($agencyTypes as $agencyType):
                            ?>
                            <div class="radio-btn">
                                <input id="radio-<?php echo $i; ?>" class="radio-style" name="agency_type" type="radio"
                                       value="<?php echo $agencyType['value']; ?>">
                                <label for="radio-<?php echo $i; ?>" class="radio-style-1-label"><?php echo $agencyType['text'] ?></label>
                            </div>
                            <?php
                            $i++;
                        endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Government Agencies</label>
                        <?php echo $this->Form->control('agency_id', [
                            'empty' => '-- Select Agency --', 'id' => 'selectAgency',
                            'class' => 'selectpicker form-control input-form',
                            'label' => false]);
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <div class="white-section">
                            <?php
                            echo $this->Form->textarea('idea', ['required' => 'true', 'class' => 'form-control input-form', 'id' => 'summernote', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="white-section">
                            <button type="submit" class="button comnt-btn defualt-btn pull-right">Save <i class="fa fa-angle-double-right"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 create-right-side">
                    <div class="add-area bottommargin-sm center">
                        <img src="\img\add-img.png" class="img-responsive">
                    </div>
                    <div class="add-area bottommargin-sm center">
                        <img src="\img\add-img.png" class="img-responsive">
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>


