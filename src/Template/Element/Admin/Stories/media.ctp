<h3>Media:</h3>
<div class="row">
    <?php if (isset($story->media[1])) {
        $totalMedia = count($story->media);
        for ($i = 1; $i < $totalMedia; $i++) {
            $media = $story->media[$i];
            if ($media['type'] == 1) {
                ?>
                <div class="col-md-3" style="padding-bottom: 2%">
                    <?php echo $this->Html->image('/Media/show_image/' . $media->id . '/' . urlencode($story->user->id) . '/' . $media->file_name, array('id' => '/Media/show_image/' . $media->id . '/' . urlencode($story->user->id) . '/' . $media->file_name, 'class' => 'story-img', 'height' => 100, 'width' => 150)); ?>

                    <button class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger deleteMedia" id="<?php echo $media->id?>">Delete</button>

                </div>
            <?php } else if ($media['type'] == 2) {
                $embededUrl = str_replace('https://www.youtube.com/watch?v=','https://www.youtube.com/embed/',$story->media[$i]->file_name);
                ?>
                <div class="col-md-3" style="padding-bottom: 2%">
                    <?php echo $this->Html->image('/img/youtube.png', array('id' => $embededUrl, 'class' => 'story-vedio', 'height' => 100, 'width' => 150)); ?>
                    <button class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger deleteMedia" id="<?php echo $media->id?>">Delete</button>

                </div>
                <?php
            } else { ?>
                <div class="col-md-3" style="padding-bottom: 2%">
                    <?php echo $this->Html->image('/img/pdf.jpg', array('id' => '/Media/show_image/' . $media->id . '/' . urlencode($story->user->id) . '/' . $media->file_name, 'class' => 'story-pdf', 'height' => 100, 'width' => 150)); ?>
                    <button class="btn m-btn m-btn--gradient-from-focus m-btn--gradient-to-danger deleteMedia" id="<?php echo $media->id?>">Delete</button>

                </div>
            <?php }
        }
    }
    ?>
</div>

<!--begin::Modal-->
<div class="modal fade strories-modal" id="divModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <div class="carousel-inner" id="divContent">
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
<!--end::Modal-->

<style>
    .btn.m-btn--gradient-from-focus.m-btn--gradient-to-danger {
        background: #9816f4;
        background: -webkit-linear-gradient(135deg, #9816f4 30%, #f4516c 100%);
        background: -o-linear-gradient(135deg, #9816f4 30%, #f4516c 100%);
        background: -moz-linear-gradient(135deg, #9816f4 30%, #f4516c 100%);
        background: linear-gradient(135deg, #9816f4 30%, #f4516c 100%);
        margin-left: 25%;
        margin-top: 2%;
    }
</style>

