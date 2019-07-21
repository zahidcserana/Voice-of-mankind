<section id="content">
    <div class="main_page_content" id="stories_add_details">
        <div class="container topmargin">
            <div class="row">
                <?php echo $this->Flash->render(); ?>
                <?php echo $this->element('Global' . DS . 'steps'); ?>
                <div class="col_full create-strory-area">
                    <div class="col-sm-10 col-sm-offset-1 col-xs-12 create-details-area">
                        <div class="heading-block center">
                            <h4>Details of Your Story</h4>
                        </div>
                        <?= $this->Form->create($story, ['name' => 'add-details-form']) ?>
                        <?php
                        $isPublic = $story->is_public;
                        echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
                        ?>
                        <div class="form-group col-xs-12 nopadding">
                            <?php echo $this->Form->textarea('description', ['required' => 'true', 'id' => 'summernote', 'label' => false]); ?>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <label class="col-sm-12" for="exampleInputEmail1">Is Public</label>
                            <div class="col-sm-2 nopadding">
                                <?php
                                    $checked = '';
                                    if ($isPublic == 1){
                                        $checked = 'checked';
                                    }
                                ?>
                                <input id="radio-4" class="radio-style" name="is_public" value="public" type="radio" <?php echo $checked?>>
                                <label for="radio-4" class="radio-style-3-label">Public</label>
                            </div>
                            <div class="col-sm-2 nopadding">
                                <?php
                                $checked = '';
                                if ($isPublic == 0){
                                    $checked = 'checked';
                                }
                                ?>
                                <input id="radio-5" class="radio-style" name="is_public" value="private" type="radio" <?php echo $checked?>>
                                <label for="radio-5" class="radio-style-3-label">Private</label>
                            </div>
                        </div>
                        <div class="form-group col-xs-6 nopadding1">
                            <label for="exampleInputEmail1">Select Category</label>
                            <?php echo $this->Form->control('categories._ids[]', ['options' => $categories, 'empty' => '-- Select Category --',
                                'required' => true, 'class' => 'form-control input-form', 'label' => false]); ?>
                        </div>

                        <div class="form-group col-xs-12 nopadding">
                            <label class="col-sm-12 nopadding" for="exampleInputEmail1">Adding Media</label>
                            <?php
                            $i = 13;//for different radio id
                            foreach ($r_mediaTypes as $mediaType):?>
                                <div class="col-sm-2 nopadding">
                                    <input id="radio-<?php echo $i; ?>" class="radio-style" name="media_type"
                                           type="radio" value="<?php echo $mediaType['value']; ?>"/>
                                    <label for="radio-<?php echo $i; ?>"
                                           class="radio-style-3-label"><?php echo $mediaType['text']; ?></label>
                                </div>
                                <?php $i++;
                            endforeach; ?>
                        </div>
                        <div class="form-group col-xs-12 nopadding">
                            <div class="dropzone dz-clickable" id="form-file-uploader">
                                <div class="fallback">
                                </div>
                            </div>
                            <div class="form-group col-xs-12 nopadding" id="div-youtube-link" style="display: none">
                                <?php echo $this->Form->control('youtube_link', ['type' => 'text', 'class' => 'form-control input-form youtube-link', 'label' => 'Youtube Link', 'placeholder' => 'Youtube URL']); ?>
                            </div>
                            <div class="form-group col-xs-12 nopadding">
                                <button type="submit" class="button comnt-btn defualt-btn pull-right">Next <i
                                            class="fa fa-angle-double-right"></i></button>
                            </div>
                        </div>

                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col_full">
                    <?php
                    if (!empty($story->media)) { ?>
                    <h3>Story Media:</h3>
                    <hr>
                    
                        <div class="clearfix">
                            <?php
                            $totalMedia = count($story->media);
                            $flippedMediaTypes = array_flip($mediaTypes);
                            for ($i = 0; $i < $totalMedia; $i++) {
                                ?>
                            <div class="col-sm-2 text-center">
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
                                <button class="defualt-btn btn-pad-sm deleteMedia" id="<?php echo $story->media[$i]->id?>">Delete</button>
                            </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    } ?>
                    <div class="col-md-5 col-sm-12 col-xs-12 stories-thumbal-slide nopadding">
                        <div class="col_full modal-list">

                            <div class="modal fade strories-modal" tabindex="-1" role="dialog"
                                 aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-view">
                                    <div class="modal-body">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-hidden="true">&times;
                                                </button>
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

                                                            <a class="left carousel-control" href="#myCarousel"
                                                               data-slide="prev"><i class="fa fa-angle-left"></i> </a>
                                                            <a class="right carousel-control" href="#myCarousel"
                                                               data-slide="next"><i class="fa fa-angle-right"></i> </a>
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
            </div>
        </div>
    </div>
</section>