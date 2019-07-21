<?php if (count($comments)>0): ?>
    <div class="heading-block">
        <h3>Comments:</h3>
    </div>
    <hr>
    <?php foreach ($comments as $comment): ?>
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
    <div>
        <h3>There has no Comment for the Story</h3>
    </div>
    <?php
endif;
?>