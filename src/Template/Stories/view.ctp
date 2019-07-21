<div class="main_page_content" id="stories_details_view">
    <section id="content">
        <div class="container topmargin">

            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12 stories-right-side story-pragraph">
                    <div class="col_full create-gov-agency">

                        <div class="col_half">
                            <h3><?php echo $story->user->first_name . ' ' . $story->user->last_name; ?></h3>
                            <span><?php echo $story->created; ?></span>
                        </div>

                        <div class="col_half col_last gov-agency">
                            <h4 class="nomargin"><?php echo 'Agency: '.$story->agency->name; ?></h4>
                        </div>
                        <div class="divider">
                            <i class="icon-circle"></i>
                        </div>
                    </div>
                    <div class="col_full details-pragraph">
                        <p><?php echo $this->Text->autoParagraph(h(strip_tags($story->description))); ?></p>
                    </div>

                    <div class="col_full">
                        <div class="masonry-thumbs col-6 clearfix">
                            <?php
                            if (!empty($story->media)) {
                                $totalMedia = count($story->media);
                                $flippedMediaTypes = array_flip($mediaTypes);
                                for ($i = 0; $i < $totalMedia; $i++) {
                                    ?>
                            <a href="#" data-toggle="modal" data-target=".strories-modal" class="story-details-modal">
                                        <?php
                                        $mimeType = $story->media[$i]->mime_type;
                                        if (strpos($mimeType, 'image') !== false) {
                                            echo $this->Html->image('/Media/show_image/' . $story->media[$i]->id . '/' . urlencode($story->user->id) . '/' . $story->media[$i]->file_name, array(
                                                'class' => 'img-responsive', 'height' => 70, 'width' => 70));
                                            echo '<div class="overlay"><div class="overlay-wrap"><i class="fa fa-image"></i></div></div>';
                                        } else if (strpos($mimeType, 'youtube') !== false) {
                                            echo '<img src="/img/youtube.jpg"/>';
                                            echo '<div class="overlay"><div class="overlay-wrap"><i class=" icon-play"></i></div></div>';
                                        } else if (strpos($mimeType, 'pdf') !== false) {
                                            echo '<img src="/img/pdf-icon.png"/>';
                                            echo '<div class="overlay"><div class="overlay-wrap"><i class="fa fa-file"></i></div></div>';
                                        }else{
                                            echo $this->Html->link($this->Html->image('/img/download-icon.png'), ['controller' => 'Media', 'action' => 'download', $story->user->id, $story->media[$i]->file_name], ['escape' => false]);
                                        }
                                        ?>
                                    </a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                        <div class="col-md-5 col-sm-12 col-xs-12 stories-thumbal-slide nopadding">
                            <div class="col_full modal-list">

                                <div class="modal fade strories-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-view">
                                        <div class="modal-body">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="span12">
                                                        <div class="">
                                                            <div id="myCarousel" class="carousel slide">
                                                                <div class="carousel-inner">
                                                                    <?php
                                                                    if (!empty($story->media)) {
                                                                        $totalMedia = count($story->media);
                                                                        for ($i = 0; $i < $totalMedia; $i++) {
                                                                            ?>
                                                                            <div class="item <?php echo $i == 0 ? 'active' : ''; ?>">
                                                                                <div class="row-fluid">
                                                                                    <div class="col-sm-12 nopadding">
                                                                                        <a href="#x">
                                                                                            <?php
                                                                                            $mimeType = $story->media[$i]->mime_type;
                                                                                            if (strpos($mimeType, 'image') !== false) {
                                                                                                echo $this->Html->image('/Media/show_image/' . $story->media[$i]->id . '/' . urlencode($story->user->id) . '/' . $story->media[$i]->file_name, array());
                                                                                            } else if (strpos($mimeType, 'youtube') !== false) {
                                                                                                $embededUrl = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $story->media[$i]->file_name);
                                                                                                //string after the & sign should be removed
                                                                                                if( strpos($embededUrl, '&')!==false){
                                                                                                    $embededUrl = substr($embededUrl, 0, strpos($embededUrl, '&'));
                                                                                                }
                                                                                                echo '​<iframe width="560" height="315" src="' . $embededUrl . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
                                                                                                echo '<input type="hidden" id="for-youtube" value="youtube"/>';
                                                                                            } else if (strpos($mimeType, 'pdf') !== false) {
                                                                                                if ($story->media[$i]->mime_type == 'application/pdf') {
                                                                                                    ?>
                                                                                                    <object data="/img/stories/<?php echo urlencode($story->user->id) . '/' . $story->media[$i]->file_name; ?>" type="application/pdf" width="750px" height="560px">
                                                                                                        <embed src="/img/stories/<?php echo urlencode($story->user->id) . '/' . $story->media[$i]->file_name; ?>" type="application/pdf">
                                                                                                        </embed>
                                                                                                    </object>
                                                                                                    <?php
                                                                                                    echo '<input type="hidden" id="for-pdf" value="pdf"/>';
                                                                                                }
                                                                                            }else{
                                                                                                echo $this->Html->link($this->Html->image('/img/download-icon.png'), ['controller' => 'Media', 'action' => 'download', $story->user->id, $story->media[$i]->file_name], ['escape' => false]);
                                                                                            }
                                                                                            ?>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i>  </a>
                                                                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i> </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <?php echo $this->element('ads', ['size' => 'Bottom Banner (1170px x 200px)']);?>
                </div>               
                

                <div class="col-md-3 col-xs-12 stories-right-side nopadding xs-addpadding">
                    <div class="col_full widget clearfix">
                        
                        <?php echo $this->element('ads', ['size' => 'Top Right (270px x 270px)']);?>

                        <div class="stories-right-title">
                            <h3> <span>Related Story</span></h3>
                        </div>
                        <div id="post-list-footer">
                            <?php
                            if (isset($relatedStories) && !empty($relatedStories)) {
                                foreach ($relatedStories as $related) {
                                    ?>
                                    <div class="spost clearfix">
                                        <?php if (!empty($related->media)) { ?>                                                            
                                            <div class="entry-image related-img">
                                                <a href="/Stories/view/<?php echo $related->id; ?>" class="nobg">
                                                    <?php
                                                    $mimeType = $related->media[0]->mime_type;
                                                    if (strpos($mimeType, 'image') !== false) {
                                                        echo $this->Html->image('/Media/show_image/' . $related->media[0]->id . '/' . urlencode($related->user->id) . '/' . $related->media[0]->file_name, array());
                                                    } else if (strpos($mimeType, 'youtube') !== false) {
                                                        echo '<img src="/img/youtube.jpg" />';
                                                    } else if (strpos($mimeType, 'pdf') !== false) {
                                                        echo '<img src="/img/pdf-icon.png" />';
                                                    }
                                                    ?>                                                    
                                                </a>
                                            </div>
                                        <?php } ?>
                                        <div class="entry-c related-body">
                                            <div class="entry-title">
                                                <h4><a href="/Stories/view/<?php echo $related->id; ?>"><?php echo $related->title; ?></a></h4>
                                            </div>
                                            <ul class="entry-meta">
                                                <li><?php echo $this->Html->link(__($related->user->first_name.' '.$related->user->last_name), []); ?></li>
                                                <li><?php echo $related->created;?></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
<!--                <div class="col-sm-12 stories-details-ads-area center xs-addpadding">
                    <?php // echo $this->element('ads', ['size' => 'Bottom Banner (1170px x 200px)']);?>
                </div>-->
                
                <div class="heading">
                    <h3>
                    <?php 
                        if(isset($story->reform_idea->id) && $story->reform_idea->id){
                            echo $this->Html->link(__('View Reform Idea'), ['controller' => 'ReformIdeas', 'action' => 'view', $story->reform_idea->id]);
                        }
                    ?>
                    </h3>
                </div>

                <div class="col-sm-12 stories-details-comment-area nopadding">

                    <?php if (isset($loggedinUser) && !empty($loggedinUser)) { ?>
                        <div id="rating-notification-message" data-notify-position="top-right" data-notify-type="info" data-notify-msg="Message"></div>
                        <input id="input-11" type="number" value="<?php echo $story->rating_average ? $story->rating_average : ''; ?>" class="rating form-control hide" max="5" data-size="sm" data-glyphicon="false" data-rating-class="fontawesome-icon">
<?php
} else {
    echo $this->Html->link(__('To Rate Login first'), ['controller' => 'users', 'action' => 'login']);
    ?>

                        <input id="input-11" type="number" value="<?php echo $story->rating_average ? $story->rating_average : ''; ?>" class="rating form-control hide" max="5" data-size="sm" data-glyphicon="false" data-rating-class="fontawesome-icon" data-disabled="true">
                    <?php } ?>

                    <div class="heading-block">
                        <h3>Comment</h3>
                    </div>
                    <?php
                    echo $this->Form->create('Comment', ['name' => 'comment-add-form']);
                    echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
                    echo $this->Form->control('comment', ['type' => 'textarea', 'id' => 'commentDetails', 'label' => false,
                        'class' => 'form-control comnt-box', 'placeholder' => 'Comment Here...', 'required' => 'required']);
                    echo $this->Form->button(__('Submit'), ['id' => 'addComment', 'class' => 'button button-smalllarge tright comnt-btn']);
                    ?>
                </div>

                <div class="col-sm-12 stories-details-comment-show nopadding">
                    <div id="contain-comment">
<!--                        <div class="alert alert-danger" id="err-msg"></div>-->
                        <input type="hidden" id="commentsTotalPages" value="<?php echo $commentsTotalPaginationPages; ?>"/>
                    </div>
                    <ul id="pagination-demo" class="pagination-sm"></ul>
                </div>
            </div>
        </div>
    </section>
</div>