<?php if (!empty($comments)): ?>
    <div class="heading-block">
        <h3>Comments</h3>
    </div>
    <?php foreach ($comments as $comment): ?>
        <div class="ri-cmnt-area">
            <div class="comment-wrap first-comment" id="comment-row-<?php echo $comment->id; ?>">
                <div class="photo">
                    <?php echo $this->Html->image('/Users/show_image/' . $comment->user_id . '/' . $comment->user->avatar_name, array(
                        'class' => 'img-responsive')); ?>
                </div>
                <div class="comment-block">
                    <div class="top-comment">
                        <ul class="list-inline">
                            <li>
                                <a href="#"><b><?php echo $comment->user->first_name . ' ' . $comment->user->last_name; ?></b></a>
                            </li>
                            <li><span><?php echo $comment->created; ?></span></li>
                        </ul>
                    </div>
                    <p class="comment-text">
                        <?php
                        $descr = strip_tags($comment->comment);
                        echo $this->Text->autoParagraph(h($descr));
                        ?>
                    </p>
                    <div class="bottom-comment">
                        <ul class="list-inline play_navigation">
                            <li><a id="reform_1_<?php echo $comment->id; ?>" href="#"> <i class="fas fa-thumbs-up"></i>
                                    <span><?php echo $comment->total_like; ?></span></a></li>
                            <li><a id="reform_0_<?php echo $comment->id; ?>" href="#"> <i
                                            class="fas fa-thumbs-down"></i>
                                    <span><?php echo $comment->total_dislike; ?></span></a></li>
                            <li><a id="reform_2_<?php echo $comment->id; ?>" href="#"> Reply</a></li>
                        </ul>

                    </div>
                    <!-- Reply cmnt text area -->
                    <div id="reply_<?php echo $comment->id; ?>" class="add-comment-area" style="display: none">
                        <div class="reply-cmnt-photo">
                            <?php echo $this->Html->image('/Users/show_image/' . $comment->user_id . '/' . $comment->user->avatar_name, array(
                                'class' => 'img-responsive')); ?>
                        </div>
                        <div class="cmnt-textarea">
                            <form name="reply-form" id="reply-form_<?php echo $comment->id; ?>" class="reply-form">
                                <input type="hidden" name="parent_id" value="<?php echo $comment->id; ?>">
                                <input type="hidden" name="content_type" value="<?php echo $comment->content_type; ?>">
                                <textarea name="comment" class="form-control ri-textarea"
                                          placeholder="Add Reply..."></textarea>
                                <button class="defualt-btn btn-pad-sm pull-right reply-btn">Reply</button>
                            </form>
                            <button id="cancel_<?php echo $comment->id; ?>"
                                    class="defualt-btn btn-pad-sm pull-right cancel-btn">Cancel
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <button class="button button-mini tright delete-btn" id="<?php echo 'delete-' . $comment->id; ?>">
                        Delete
                    </button>
                </div>
            </div>

            <div class="reply-cmnt-area">
                <?php if (count($comment->children) > 0){ ?>
                <a id="view-reply-btn_<?php echo $comment->id; ?>" class="view-reply-btn" href="javascript:void(0);">View Reply <i class="fas fa-angle-down"></i></a>
                <div id="all_reply_<?php echo $comment->id; ?>" style="display: none">
                    <?php foreach ($comment->children as $child) { ?>
                        <div class="comment-wrap second-comment">
                            <div class="photo">
                                <?php echo $this->Html->image('/Users/show_image/' . $child->user_id . '/' . $child->user->avatar_name, array(
                                    'class' => 'img-responsive')); ?>
                            </div>
                            <div class="comment-block">
                                <div class="top-comment">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="#"><b><?php echo $child->user->first_name . ' ' . $child->user->last_name; ?></b></a>
                                        </li>
                                        <li><span><?php echo $child->created; ?></span></li>
                                    </ul>
                                </div>
                                <p class="comment-text">
                                    <?php
                                    $descr = strip_tags($child->comment);
                                    echo $this->Text->autoParagraph(h($descr));
                                    ?>
                                </p>
                                <div class="bottom-comment">
                                    <ul class="list-inline play_navigation">
                                        <li><a id="reform_1_<?php echo $child->id; ?>" href="#"> <i class="fas fa-thumbs-up"></i>
                                                <span><?php echo $child->total_like; ?></span></a></li>
                                        <li><a id="reform_0_<?php echo $child->id; ?>" href="#"> <i
                                                        class="fas fa-thumbs-down"></i>
                                                <span><?php echo $child->total_dislike; ?></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            </div>

        </div>

        <?php
    endforeach;
endif;
?>