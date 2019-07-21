<div class="main_page_content" id="view_comments">
    <div align="center">
        <h3><?php echo ' Created by: '.$data->user->first_name.' '.$data->user->last_name.', <span style="font-size: 16px">'.$data->created;?></span></h3>
    </div>
    <div class="m-widget3__body">
        <div class="col-sm-12 stories-details-comment-show nopadding">
            <div id="contain-comment">
                <?php
                echo $this->Form->control('content_id', ['type' => 'hidden', 'value' => $data->id]);
                echo $this->Form->control('content_type', ['type' => 'hidden', 'value' => $data->comments[0]['content_type']]);
                ?>
                <input type="hidden" id="commentsTotalPages" value="<?php echo $commentsTotalPaginationPages; ?>"/>
            </div>
            <ul id="pagination-demo" class="pagination-sm"></ul>
        </div>
    </div>
</div>