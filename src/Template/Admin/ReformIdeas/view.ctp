<div class="main_page_content" id="reform_view">
    <div class="row">
        <div class="col-xl-4">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__body">
                    <div class="m-widget3">
                        <h3 class="m-portlet__head-text">
                            <h5>Created By
                                : <?php echo $reformIdea->user->first_name . ' ' . $reformIdea->user->last_name; ?></h5>
                            Date : <span style="font-size: 12px"><?php echo $reformIdea->created; ?></span>
                        </h3>
                        <div class="m--space-20"></div>
                        <div class="m-widget2__item">
                            <div class="m-widget2__desc">
                                <span class="m-widget2__text">
                                    <?php echo $this->Html->image('/Users/show_image/' . $reformIdea->user_id . '/' . $reformIdea->user->avatar_name, array(
                                        'class' => 'story-img', 'height' => 100, 'width' => 150)); ?>
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
                                            if ($k == $reformIdea->status) {
                                                $status = $v;
                                            }
                                            if ($reformIdea->status == 1) {
                                                $newStatus = 2;
                                                $statusMake = 'Make Inactive';
                                            } else if ($reformIdea->status == 2) {
                                                $newStatus = 1;
                                                $statusMake = 'Make Active';
                                            } else if ($reformIdea->status == 3) {
                                                $newStatus = 1;
                                                $statusMake = 'Make Active';
                                            }
                                        }
                                        ?>
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">
                            </div>
                        </div>
                        <div>
                            <h5><?php echo 'Agency: '.$reformIdea->agency->name . ' (<span style="font-size: 12px" >' . $status . '</span>) '; ?>
                            <br>
                            <?php echo $this->Html->link(__($statusMake), ['controller' => 'ReformIdeas', 'action' => 'change_status', 'prefix' => 'admin', $reformIdea->id, $newStatus]) ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="m-portlet m-portlet--full-height ">
                <div class="m-portlet__body">
                    <?php
                    echo $this->Form->control('reform_id', ['type' => 'hidden', 'value' => $reformIdea->id, 'id' => 'reformId']);

                    ?>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_widget2_tab1_content">
                            <div class="m-widget2">
                                <h3>Description:</h3>
                                <div class="m-widget3__item">
                                    <?php echo $this->Text->autoParagraph(h(strip_tags($reformIdea->idea))); ?>
                                </div>
                            </div>
                            <!--<div class="m-widget2">
                                <h3><span>Related Reform Idea</span></h3>
                                <?php /*echo $this->element('Reform/related'); */?>
                            </div>-->
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
            if(isset($reformIdea->story->id) && $reformIdea->story->id){
                echo $this->Html->link(__('View Story'), ['controller' => 'Stories', 'action' => 'view', $reformIdea->story->id]);
            }
            ?>
        </h3>
    </div>

    <?php echo $this->element('Admin/Stories/comment', array('commentsTotalPaginationPages' => $commentsTotalPaginationPages)); ?>
</div>

<style>
    img {
        vertical-align: middle;
        border-style: none;
        border-radius: 5% !important;
    }

    .story-
</style>







