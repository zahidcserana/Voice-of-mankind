<?php
if ($comments->count()>0): ?>
    <div class="heading-block">
        <h3>Comments:
            <a class="btn m-btn--pill btn-outline-warning active btn-sm" style="float: right" href="/admin/comments/view-comments/<?php echo $type.'/'.$storyId?>">View All</a>
        </h3>
    </div>
    <hr>
    <?php foreach ($comments as $comment):?>
        <div class="row" id="comment-row-<?php echo $comment->id; ?>">
            <div class="col-md-2">
                <h5 class="panel-title"><?php echo $comment->user->first_name . ' ' . $comment->user->last_name; ?>
                    </h5>
                <h5><span><?php echo $comment->created; ?></span></h5>
                <div class="author-image">
                    <?php echo $this->Html->image('/Users/show_image/' . $comment->user_id . '/' . $comment->user->avatar_name, array(
                        'class' => 'img-responsive', 'height' => 70, 'width' => 70)); ?>
                </div>
            </div>
            <div class="col-md-8">
                <p>
                    <?php
                    $descr = strip_tags($comment->comment);
                    echo $this->Text->autoParagraph(h($descr));
                    ?>
                </p>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success m-btn m-btn--custom m-btn--icon delete-btn" id="<?php echo 'delete-' . $comment->id; ?>">
                    Delete
                </button>
            </div>
        </div>
        <br>
        <?php
    endforeach;
else: ?>
    <div align="center" style="padding-top: 5%">
        <h3>Empty Comment</h3>
    </div>
    <?php
endif;
?>