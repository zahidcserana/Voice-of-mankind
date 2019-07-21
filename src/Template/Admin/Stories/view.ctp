<div class="main_page_content" id="stories_details_view">
    <div class="row">
        <div class="col-xl-4">
            <?php echo $this->Flash->render(); ?>
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__body">
                    <div class="m-widget3">
                        <div class="m-widget2__item">
                            <div class="m-widget2__desc">
                                <span class="m-widget2__text">
                                    <?php
                                    if (!empty($story->media)) {
                                        $firstMedia = $story->media[0];
                                        ?>
                                        <?php
                                        echo $this->Html->image('/Media/show_image/' . $firstMedia->id . '/' . urlencode($story->user->id) . '/' . $firstMedia->file_name, array('id' => '/Media/show_image/' . $firstMedia->id . '/' . urlencode($story->user->id) . '/' . $firstMedia->file_name, 'class' => 'story-img', 'height' => 200, 'width' => 200, 'style' => 'border-radius: 50%!important'));
                                    }else{
                                        echo $this->Html->image('/img/story.png', array('class' => 'story-img', 'height' => 200, 'width' => 200, 'style' => 'border-radius: 50%!important'));

                                    }
                                    ?>
                                </span>
                                <br>
                            </div>
                        </div>
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        <?php
                                        foreach ($storyStatuses as $k => $v) {
                                            if ($k == $story->status) {
                                                $status = $v;
                                            }
                                            if ($story->status == 1) {
                                                $newStatus = 2;
                                                $statusMake = 'Make Inactive';
                                            } else if ($story->status == 2) {
                                                $newStatus = 1;
                                                $statusMake = 'Make Active';
                                            } else if ($story->status == 3) {
                                                $newStatus = 1;
                                                $statusMake = 'Make Active';
                                            }
                                        }
                                        ?>
                                        <?php echo $story['title'] . ' (<span style="font-size: 12px" >' . $status . '</span>) '; ?>
                                        <br>
                                        <?php echo $this->Html->link(__($statusMake), ['controller' => 'Stories', 'action' => 'change_status', 'prefix' => 'admin', $story->id, $newStatus]) ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                            </div>
                        </div>
                        <h3 class="m-portlet__head-text">
                            <h4><?php echo $story->user->first_name . ' ' . $story->user->last_name; ?></h4>
                            <span><?php echo $story->created; ?></span>
                        </h3>
                    </div>
                    <div class="m-widget3" style="padding-top: 5%">
                        <div class="m-widget3__item">
                            <?php echo $this->element('Admin/Stories/agency'); ?>
                        </div>
                        <?php foreach ($story->referrals as $referral) { ?>
                            <div class="m-widget3__item">
                                <?php echo $this->element('Admin/Stories/referral', array('referral' => $referral)); ?>
                            </div>
                        <?php } ?>
                        <div class="m-widget3__item">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__body">
                    <?php
                    echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);

                    ?>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget2_tab1_content">
                            <div class="m-widget2">
                                <div class="m-widget3__item">
                                    <?php echo $this->element('Admin/Stories/description'); ?>
                                </div>
                            </div>
                            <div class="m-widget2">
                                <?php echo $this->element('Admin/Stories/media', array('story' => $story)); ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="m_widget2_tab2_content">

                        </div>
                        <div class="tab-pane" id="m_widget2_tab3_content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="heading">
        <h3>
            <?php
            if(isset($story->reform_idea->id) && $story->reform_idea->id){
                echo $this->Html->link(__('View Reform Idea'), ['controller' => 'ReformIdeas', 'action' => 'view', $story->reform_idea->id]);
            }
            ?>
        </h3>
    </div>

        <?php echo $this->element('Admin/Stories/comment', array('commentsTotalPaginationPages'=>$commentsTotalPaginationPages)); ?>

</div>

<style>
    img {
        vertical-align: middle;
        border-style: none;
        border-radius: 5%!important;
    }
    .story-
</style>







