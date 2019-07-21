<div class="main_page_content" id="reform_idea">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render(); ?>
            <div class="col_full create-strory-area">
                <?= $this->Form->create($reformIdea, ['name' => 'form-add-referral']) ?>
                <div class="col-sm-1 col-xs-12 create-right-side">
                </div>
                <div class="col-sm-8 col-xs-12">
                    <?php if(!$reformIdea->story_id){ ?>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Select Type</label>
                        <?php                        
                        echo $this->Form->control('agency_type', ['type' => 'hidden']);
                        $i = 1;//to differentiate the radios
                        foreach ($agencyTypes as $agencyType):
                            $checked = '';
                            if ($reformIdea->agency['type'] == $agencyType['value']) {
                                $checked = 'checked';
                            }
                            ?>
                            <div class="radio-btn">
                                <input id="radio-<?php echo $i; ?>" class="radio-style" name="agency_type" type="radio"
                                       value="<?php echo $agencyType['value']; ?>" <?php echo $checked ?>>
                                <label for="radio-<?php echo $i; ?>" class="radio-style-1-label"><?php echo $agencyType['text'] ?></label>
                            </div>
                            <?php
                            $i++;
                        endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Agency</label>
                        <?php echo $this->Form->control('agency_id', [
                            'empty' => '-- Select Agency --', 'id' => 'selectAgency',
                            'class' => 'selectpicker form-control',
                            'label' => false]);
                        ?>
                    </div>
                    <?php }?>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <div class="white-section">
                            <?php
                            echo $this->Form->textarea('idea', ['required' => 'true', 'class' => 'form-control input-form', 'id' => 'summernote', 'label' => false]); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="white-section">
                            <button type="submit" class="button comnt-btn defualt-btn">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-12 create-right-side">
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


