<div class="main_page_content" id="users_my_stories">
<section id="content" class="main_page_content">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render();?>
            <div class="col-sm-12 account-area">
                <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                    <?php echo $this->element('my_account_left_panel');?>

                    <div class="tab-container">
                        <div class="tab-content clearfix" id="mystories">


                            <div id="posts" class="col-md-12 col-sm-12 col-xs-12 stories-left-side small-thumbs">
                                <?php
                                if(!empty($stories)){
                                    foreach($stories as $story){
                                        ?>
                                        <div class="entry clearfix striese-blog-area">
                                            <?php
                                            if (!empty($story->media)) {
                                                $mimeType = $story->media[0]->mime_type;
                                                if (strpos($mimeType, 'image') !== false) {
                                                    ?>
                                            <style type="text/css">
                                                .striese-blog-area img {
                                                    vertical-align: [top|middle|bottom|baseline|...] !important;
                                                }
                                            </style>

                                                    <div class="entry-image">
                                                        <?php
                                                        echo $this->Html->link($this->Html->image('/Media/show_image/' . $story->media[0]->id . '/' . urlencode($story->user->id) . '/' . $story->media[0]->file_name, array(
                                                                    'class' => 'img-responsive')), ['controller' => 'stories', 'action' => 'view', $story->id], ['escape' => false]);
                                                        ?>
                                                    </div>
                                                <?php }
                                            }
                                            ?>

                                            <div class="entry-c blog-body">
                                                <div class="entry-title">
                                                    <h2><?php echo $this->Html->link(__($story->title), ['controller' => 'stories','action' => 'view', $story->id]); ?></h2>
                                                </div>
                                                <ul class="entry-meta clearfix">
                                                    <li><i class="fa fa-list"></i>
                                                        <?php
                                                        if (isset($story->categories[0]) && !empty($story->categories[0])) {
                                                            echo $this->Html->link(__('Category : ' . $story->categories[0]->title), ['controller' => 'stories',
                                                                'action' => 'story-by-category', $story->categories[0]->id]);
                                                        } else {
                                                            echo 'Not Found';
                                                        }
                                                        ?>
                                                    </li>
                                                    <li><i class="fa fa-th-large"></i>
                                                        <?php
                                                        if (isset($story->referrals[0]) && !empty($story->referrals[0])) {
                                                            echo 'Referral : ' . $story->referrals[0]->name;
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
                                                    <div>
                                                        <?php echo $this->Html->link(__('Read More'), ['controller' => 'stories', 'action' => 'view', $story->id],['class' => 'more-link btn-lgradius btn-shadow']);?>
                                                        <?php echo $this->Html->link(__('Edit'), ['controller' => 'stories', 'action' => 'edit', $story->id],['class' => 'more-link btn-lgradius btn-olive btn-shadow']);?>
                                                        <?php echo $this->Html->link(__('Delete'), ['controller' => 'stories', 'action' => 'delete', $story->id],['class' => 'more-link btn-lgradius btn-red btn-shadow','onclick'=>"return confirm('Are you sure want to delete this Story?');"]);?>
                                                    </div>
                                                    <div class="reting-div">
                                                        <input id="input-11" type="number" value="<?php echo $story->rating_average ? $story->rating_average : ''; ?>" class="rating form-control hide" max="5" data-size="sm" data-glyphicon="false" data-rating-class="fontawesome-icon" data-disabled="true">                                        
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
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
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>