<div class="main_page_content" id="users_my_comments">
<section id="content">
    <div class="container topmargin">
        <div class="row">
            <?php echo $this->Flash->render();?>
            <div class="col-sm-12 account-area">
                <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                    <?php echo $this->element('my_account_left_panel');?>

                    <div class="tab-container">
                        <div class="tab-content clearfix" id="mycomment">
                            <div class="row">                               

                                <?php if(!empty($comments)):?>

                                <div class="col-sm-12 stories-details-comment-show nopadding">
                                    <div class="heading-block">
                                        <h3><?php echo count($comments->toArray()).' ';?> Comment</h3>
                                    </div>
                                    <?php foreach($comments as $comment): ?>
                                    <div class="panel panel-default" id="comment-row-<?php echo $comment->id;?>">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><?php echo $comment->user->first_name.' '.$comment->user->last_name;?> <span><?php echo $comment->created;?></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-9 comnt-left-side nobottommargin">
                                                <div class="author-image">
                                                    <?php echo $this->Html->image('/Users/show_image/' . $comment->user_id . '/' . $comment->user->avatar_name , array(
                                                        'class' => 'img-responsive', 'height' => 70, 'width' => 70));?>
                                                </div>
                                                <p><?php echo $this->Text->autoParagraph(h($comment->comment));?></p>
                                            </div>
                                            <div class="col-sm-3 comnt-right-side">
                                                <button class="button btn-shadow button-mini tright btn-red delete-btn btn-lgradius" id="<?php echo 'delete-'.$comment->id;?>">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
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
                                        endif;
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>