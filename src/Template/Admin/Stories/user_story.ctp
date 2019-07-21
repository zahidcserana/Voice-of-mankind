<div class="main_page_content m_datatable m-datatable m-datatable--default m-datatable--loaded" id="user_story">
    <h3>Story List:</h3>
    <hr>
    <?php
    if (!empty($stories)){
    foreach ($stories as $story) {
        ?>
        <div class="row" id="story-row-<?php echo $story->id; ?>">
            <div class="col-md-3">
                <a href="/admin/stories/view/<?php echo $story->id?>">
                <?php
                    if(!empty($story->media)){
                        ?>
                        <?php
                        echo $this->Html->image('/media/show_image/' . $story->media[0]->id . '/' . urlencode($story->user->id) .'/'. $story->media[0]->file_name,
                            ['class' => 'image_fade', 'height' => 150, 'width' => 200]);
                        ?>
                    <?php
                    }else{
                        echo '<img class="image_fade" src="'.$baseUrl.'img/blog3.jpeg" alt="Standard Post with Image" height="150" width="200">';
                    }
                    ?>
                </a>
            </div>
            <div class="col-md-3">
                <h5>
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
                    <?php echo $story['title'] . ' (' . $status . ') '; ?>
                </h5>
                <h6>
                    <?php echo $this->Html->link(__($statusMake), ['controller' => 'Stories', 'action' => 'change_status', 'prefix' => 'admin', $story->id, $newStatus]) ?>
                </h6>
                <h5><?php echo $story->user->first_name . ' ' . $story->user->last_name; ?></h5>
                <span><?php echo $story->created; ?></span>
            </div>
            <div class="col-md-5">
                    <?php
                    echo substr($story->description,0,250) . '...';
                    ?>
                <?php echo $this->Html->link(__('Read More'), ['prefix'=>'admin','controller' => 'stories', 'action' => 'view', $story->id],['class' => 'more-link']);?>
            </div>
            <div class="col-md-1 contain-story">
                <button class="btn btn-warning m-btn m-btn--custom m-btn--icon delete-btn" id="<?php echo 'delete-' . $story->id; ?>">
                    Delete
                </button>
            </div>
        </div>
        <br>
    <?php }
    ?>
        <div class="m-datatable__pager m-datatable--paging-loaded clearfix">
            <ul class="m-datatable__pager-nav">
                <?= $this->Paginator->first('<< ' . __('first',['class'=>'m-datatable__pager-link m-datatable__pager-link--prev'])) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    <?php } ?>
</div>

