<div class="main_page_content" id="reform_idea">
    <!-- <div class="heading-block center">
         <h4>Reform Idea</h4>
     </div>-->
    <div class="container topmargin">
        <div class="row">
            <?php if($storyId!=''){ echo $this->element('Global' . DS . 'steps',['id'=>$storyId]);} ?>
            <?php echo $this->Flash->render(); ?>
            <div class="col_full create-strory-area">
                <?= $this->Form->create('reformIdeas', ['name' => 'form-add-reform']) ?>
                <!--<div class="col-sm-6 col-xs-12 create-left-side">
                        <div class="heading-block center">
                            <h4>Set Location</h4>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <div class="col-md-9" style="padding-left: 0!important;">
                                <label for="exampleInputEmail1">ZIP</label>
                                <?php
                /*                                echo $this->Form->control('zipcode', ['label' => false,'type' => 'text', 'value' => empty($story->zip_code)==true?'':$story->zip_code, 'class' => 'form-control input-form']);
                                                */ ?>
                            </div>
                            <div class="col-md-3" style="margin-top: 3%;">
                                <a id="zipCode" class="button comnt-btn defualt-btn pull-right">Save <i
                                            class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">State</label>
                            <?php
                /*                            echo $this->Form->control('state_id', ['label' => false,'type' => 'select', 'options' => $states, 'id' => 'selectState',
                                                'default' => empty($story->state_id)==true?'':$story->state_id, 'empty' => '-- Select State --', 'class' => 'form-control input-form']);
                                            */ ?>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">County</label>
                            <?php
                /*                            echo $this->Form->control('id', ['type' => 'hidden', 'value' => empty($story->id)==true?'':$story->id, 'name' => 'story_id']);
                                            echo $this->Form->control('county_id', ['label' => false,'required' => 'true', 'options' => $counties, 'id' => 'selectCountry',
                                                'default' => empty($story->county_id)==true?'':$story->county_id, 'empty' => '-- Select Country --', 'class' => 'form-control input-form']);
                                            */ ?>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label for="exampleInputEmail1">City</label>
                            <?php
                /*                            echo $this->Form->control('city_id', ['label' => false,'required' => 'true', 'options' => $cities, 'default' => empty($story->city)==true?'':$story->city, 'empty' => '-- Select City --', 'class' => 'form-control input-form']);
                                            */ ?>
                        </div>
                    </div>-->
                <!-- Create stroy left side -->
                <div class="col-sm-1 col-xs-12 create-right-side">
                </div>
                <div class="col-sm-8 col-xs-12">
                    <?php if(!isset($storyId)){ ?>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Select Agency Type</label>
                        <?php
                        echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => isset($storyId)? $storyId : '']);
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
                    <div class="form-group">
                        <label for="exampleInputEmail1">Select Government Agencies</label>
                        <?php echo $this->Form->control('agency_id', [
                            'empty' => '-- Select Agency --', 'id' => 'selectAgency',
                            'class' => 'selectpicker form-control input-form',
                            'label' => false]); ?>

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


