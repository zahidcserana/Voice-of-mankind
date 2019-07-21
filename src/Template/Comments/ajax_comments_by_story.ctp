<?php if (!empty($comments)): ?>
    <div class="heading-block">
        <h3>Comments</h3>
    </div>
    <?php foreach ($comments as $comment): ?>
        <div class="panel panel-default" id="comment-row-<?php echo $comment->id; ?>">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $comment->user->first_name . ' ' . $comment->user->last_name; ?>
                    <span><?php echo $comment->created; ?></span></h3>
            </div>
            <div class="panel-body">
                <div class="col-sm-10 comnt-left-side nobottommargin">
                    <div class="author-image">
                        <?php echo $this->Html->image('/Users/show_image/' . $comment->user_id . '/' . $comment->user->avatar_name, array(
                            'class' => 'img-responsive', 'height' => 70, 'width' => 70)); ?>
                    </div>
                    <p>
                        <?php
                        $descr = strip_tags($comment->comment);
                        echo $this->Text->autoParagraph(h($descr));
                        ?>
                    </p>
                </div>
                <div class="col-sm-2 comnt-right-side">
                    <button class="button button-mini tright delete-btn" id="<?php echo 'delete-' . $comment->id; ?>">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    <?php
    endforeach;
endif;
?>