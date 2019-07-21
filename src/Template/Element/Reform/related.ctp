<?php
if (isset($relatedReform) && !empty($relatedReform)) {
    foreach ($relatedReform as $related) {
        ?>
        <div class="spost clearfix">
            <div class="entry-image related-img">
                <?php echo $this->Html->image('/Users/show_image/' . $related->user_id . '/' . $related->user->avatar_name, array(
                    'class' => 'img-responsive', 'height' => 70, 'width' => 70)); ?>
            </div>
            <div class="entry-c related-body">
                <div class="entry-title">
                    <?php
                    $descr = strip_tags($related->idea);
                    $descr = substr($descr, 0, 100);
                    $idea = wordwrap($descr, 100).' ...';
                    ?>
                    <h4><a href="/reform-ideas/view/<?php echo $related->id; ?>"><?php echo $idea; ?></a></h4>
                </div>
                <ul class="entry-meta">
                    <li>
                        <a href="/reform-ideas?user_id=<?php echo $related->user_id;?>"><?php echo $related->user->first_name.' '.$related->user->last_name;?></a>
                    </li>
                    <li><?php echo $related->created;?></li>
                </ul>
            </div>
        </div>
        <?php
    }
}
?>