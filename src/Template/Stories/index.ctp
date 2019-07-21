

<div class="main_page_content" id="stories_index">
    <section id="content">
        <div class="container topmargin">
            <?php echo $this->Flash->render(); ?>
            <div class="row">
                <!-- stories right side -->
                <div class="col-md-3 col-sm-12 col-xs-12 stories-right-side stories-xs-leftside">
                    <?php echo $this->element('ads', ['size' => 'Top Right (270px x 270px)']);?>
                    <?php echo $this->element('search'); ?>
                    
                    <div class="toogle-div">
                        <i class="fa fa-angle-down"></i>
                    </div>
                    <div class="rightbar-hidden">
                        <?php echo $this->element('story_cat_list'); ?>
                        <?php echo $this->element('archive'); ?>                        
                    </div>
                </div>

                <div id="posts" class="col-md-9 col-sm-12 col-xs-12 stories-left-side small-thumbs stories-xs-rightside">
                    <?php
                    if (!empty($stories) && count($stories) > 0) {
                        
                        $count = 1;

                        foreach ($stories as $story):
                            ?>
                            <div class="entry clearfix striese-blog-area">
                                <?php
                                if (!empty($story['Media'])) {
                                    $mimeType = $story['Media']['mime_type'];
                                    if (strpos($mimeType, 'image') !== false) {
                                        ?>
                                        <div class="entry-image">
                                            <?php
                                            echo $this->Html->link($this->Html->image('/Media/show_image/' . $story['Media']['id'] . '/' . urlencode($story->_matchingData['Users']->id) . '/' . $story['Media']['file_name'], array(
                                                        'class' => 'img-responsive')), ['controller' => 'stories', 'action' => 'view', $story->id], ['escape' => false]);
                                            ?>
                                        </div>
                                    <?php }
                                }
                                ?>
                                <div class="entry-c blog-body">
                                    <div class="entry-title">
                                        <h2><?php echo $this->Html->link(__($story->title), ['controller' => 'stories', 'action' => 'view', $story->id]); ?></h2>
                                    </div>
                                    <ul class="entry-meta clearfix">
                                        <li><i class="fa fa-list"></i>
                                            <?php
                                            if (isset($story->_matchingData['Categories']) && !empty($story->_matchingData['Categories'])) {
                                                echo $this->Html->link(__('Category : ' . $story->_matchingData['Categories']->title), ['controller' => 'stories',
                                                    'action' => 'story-by-category', $story->_matchingData['Categories']->id]);
                                            } else {
                                                echo 'Not Found';
                                            }
                                            ?>
                                        </li>
                                        <li><i class="fa fa-th-large"></i>
                                            <?php
                                            if (isset($story->_matchingData['Referrals']) && !empty($story->_matchingData['Referrals'])) {
                                                echo 'Referral : ' . $story->_matchingData['Referrals']->name;
                                            } else {
                                                echo $this->Html->link(__('Add Referral'), ['controller' => 'stories', 'action' => 'add-referral', $story->id]);
                                            }
                                            ?>
                                        </li>
                                        <li><i class="fa fa-plus-square"></i><?php echo $story->created; ?></li>
                                    </ul>
                                    <div class="entry-content">
                                        <p>
                                            <?php
                                            $descr = strip_tags($story->description);
                                            $descr = substr($descr, 0, 200);
                                            echo wordwrap($descr, 50).' ...';
                                            ?>
                                        </p>

                                        <div class="redeamore-div">
        <?php echo $this->Html->link(__('Read More'), ['controller' => 'stories', 'action' => 'view', $story->id], ['class' => 'more-link btn-radius btn-shadow']); ?>
                                        </div>
                                        <div class="reting-div">
                                            <input id="input-11" type="number" value="<?php echo $story->rating_average ? $story->rating_average : ''; ?>" class="rating form-control hide" max="5" data-size="sm" data-glyphicon="false" data-rating-class="fontawesome-icon" data-disabled="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if($count % 3 == 0 && $count > 0){
                                echo $this->element('ads', ['size' => 'Page Middle Banner (845px x 200px)']);
                            }
                            $count++;
                        endforeach;
                        $hasPages = $this->Paginator->numbers();
                        //checking whether the pagination div needed or not
                        if ($hasPages) {
                            ?>
                            <div class="paginator">
                                <ul class="pagination">
                                    <?= $this->Paginator->first('<< ' . __('First')) ?>
                                    <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                                    <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('Next') . ' >') ?>
        <?= $this->Paginator->last(__('Last') . ' >>') ?>
                                </ul>
                                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<h2>No Story found!</h2>';
                    }
                    ?>
                </div>
                
            </div>
        </div>
    </section>
</div>

<!-- mobile right bar hidden click show js -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script> 
$(document).ready(function(){
    $(".toogle-div").click(function(){
        $(".rightbar-hidden").slideToggle("slow");
    });
});
</script>
