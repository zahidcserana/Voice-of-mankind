<div class="main_page_content" id="add_profession">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render(); ?>
            <div class="col_full create-strory-area">
                <?= $this->Form->create($profession) ?>
                
                <div class="col-sm-2 col-xs-12 create-right-side">
                </div>
                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <?= $this->Form->create($profession) ?>
                        <fieldset>
                            <legend><?= __('Add Profession') ?></legend>
                            <?php
                                echo $this->Form->control('title');
                                echo $this->Form->control('profession_code');
                            ?>
                        </fieldset>                        
                    </div>
                    <div class="form-group">
                        <div class="white-section">
                            <button type="submit" class="button comnt-btn defualt-btn pull-right">Save <i
                                        class="fa fa-angle-double-right"></i></button>
                        </div>
                    </div>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>