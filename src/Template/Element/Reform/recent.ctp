<div id="post-list-footer">
    <?php
    if (isset($recentReform) && !empty($recentReform)) {
        foreach ($recentReform as $reform) {
            ?>
            <div class="spost clearfix">
                <div class="entry-image related-img">
                    <?php echo $this->Html->image('/Users/show_image/' . $reform->user_id . '/' . $reform->user->avatar_name, array(
                        'class' => 'img-responsive', 'height' => 70, 'width' => 70)); ?>
                </div>
                <div class="entry-c related-body">
                    <div class="entry-title">
                        <?php
                        $descr = strip_tags($reform->idea);
                        $descr = substr($descr, 0, 50);
                        $idea = wordwrap($descr, 50).' ...';
                        ?>
                        <h4><a href="/reform-ideas/view/<?php echo $reform->id; ?>"><?php echo $idea; ?></a></h4>
                    </div>
                    <ul class="entry-meta">
                        <li>
                            <a href="/reform-ideas?user_id=<?php echo $reform->user_id;?>"><?php echo $reform->user->first_name.' '.$reform->user->last_name;?></a>
                        </li>
                        <li><?php echo $reform->created;?></li>
                    </ul>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
