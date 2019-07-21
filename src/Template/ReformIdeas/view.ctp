<div class="main_page_content" id="reform_view">
    <section id="content">
        <div class="container topmargin">

            <div class="row">
                <div class="col-md-9 col-sm-12 col-xs-12 stories-right-side story-pragraph">
                    <div class="col_full create-gov-agency">

                        <div class="col_half">
                            <h3><?php echo $reformIdea->user->first_name . ' ' . $reformIdea->user->last_name; ?></h3>
                            <span><?php echo $reformIdea->created; ?></span>
                        </div>

                        <div class="col_half col_last gov-agency">
                            <h4 class="nomargin"><?php echo 'Agency: '.$reformIdea->agency->name; ?></h4>
                        </div>
                        <div class="divider">
                            <i class="icon-circle"></i>
                        </div>
                    </div>
                    <div class="col_full details-pragraph">
                        <p><?php echo $this->Text->autoParagraph(h(strip_tags($reformIdea->idea))); ?></p>
                    </div>
                </div>

                <div class="col-md-3 col-xs-12 stories-right-side nopadding xs-addpadding">
                    <div class="col_full widget clearfix">

                        <!--<div class="stories-right-title">
                            <h3> <span>Related Reform Idea</span></h3>
                        </div>
                        <div id="post-list-footer">
                            <?php /*echo $this->element('Reform/related'); */?>
                        </div>-->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 stories-details-comment-area nopadding">
                    <div class="heading">
                        <h3>
                        <?php 
                            if(isset($reformIdea->story->id) && $reformIdea->story->id){
                                echo $this->Html->link(__('View Story'), ['controller' => 'Stories', 'action' => 'view', $reformIdea->story->id]);
                            }
                        ?>
                        </h3>
                    </div>
                    
                    <div class="heading-block">
                        <h3>Comment</h3>
                    </div>
                    <?php
                    echo $this->Form->create('Comment', ['name' => 'comment-add-form']);
                    echo $this->Form->control('reform_id', ['type' => 'hidden', 'value' => $reformIdea->id, 'id' => 'reformId']);
                    echo $this->Form->control('comment', ['type' => 'textarea', 'id' => 'commentDetails', 'label' => false,
                        'class' => 'form-control comnt-box', 'placeholder' => 'Comment Here...', 'required' => 'required']);
                    echo $this->Form->button(__('Submit'), ['id' => 'addComment', 'class' => 'button button-smalllarge tright comnt-btn']);
                    ?>
                </div>

                <div class="col-sm-12 stories-details-comment-show nopadding">
                    <div id="contain-comment">
                        <input type="hidden" id="commentsTotalPages" value="<?php echo $commentsTotalPaginationPages; ?>"/>
                    </div>
                    <ul id="pagination-demo" class="pagination-sm"></ul>
                </div>
            </div>
        </div>
    </section>
</div>