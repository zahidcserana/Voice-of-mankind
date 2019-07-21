<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story $story
 */

echo $this->Html->script('jquery.twbsPagination.min.js');
?>
<div class="main_page_content" id="stories_details_view">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('Edit Story'), ['action' => 'edit', $story->id]) ?> </li>
            <li><?= $this->Form->postLink(__('Delete Story'), ['action' => 'delete', $story->id], ['confirm' => __('Are you sure you want to delete # {0}?', $story->id)]) ?> </li>
            <li><?= $this->Html->link(__('List Stories'), ['action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Story'), ['action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Agencies'), ['controller' => 'Agencies', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Agency'), ['controller' => 'Agencies', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Media'), ['controller' => 'Media', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Media'), ['controller' => 'Media', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
            <li><?= $this->Html->link(__('List Referrals'), ['controller' => 'Referrals', 'action' => 'index']) ?> </li>
            <li><?= $this->Html->link(__('New Referral'), ['controller' => 'Referrals', 'action' => 'add']) ?> </li>
        </ul>
    </nav>
    <div class="stories view large-9 medium-8 columns content">
        <h3><?= h($story->title) ?></h3>
        <table class="vertical-table">
            <tr>
                <th scope="row"><?= __('User') ?></th>
                <td><?= $story->has('user') ? $this->Html->link($story->user->id, ['controller' => 'Users', 'action' => 'view', $story->user->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Agency') ?></th>
                <td><?= $story->has('agency') ? $this->Html->link($story->agency->name, ['controller' => 'Agencies', 'action' => 'view', $story->agency->id]) : '' ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Title') ?></th>
                <td><?= h($story->title) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Status') ?></th>
                <td><?= h($story->status) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Id') ?></th>
                <td><?= $this->Number->format($story->id) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Rating Average') ?></th>
                <td><?= $this->Number->format($story->rating_average) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Created') ?></th>
                <td><?= h($story->created) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Modified') ?></th>
                <td><?= h($story->modified) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Is Public') ?></th>
                <td><?= $story->is_public ? __('Yes') : __('No'); ?></td>
            </tr>
        </table>
        <div class="row">
            <h4><?= __('Description') ?></h4>
            <?= $this->Text->autoParagraph(h($story->description)); ?>
        </div>
        <div class="related">
            <h4><?= __('Related Categories') ?></h4>
            <?php if (!empty($story->categories)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Parent Id') ?></th>
                    <th scope="col"><?= __('Lft') ?></th>
                    <th scope="col"><?= __('Rght') ?></th>
                    <th scope="col"><?= __('Title') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($story->categories as $categories): ?>
                <tr>
                    <td><?= h($categories->id) ?></td>
                    <td><?= h($categories->parent_id) ?></td>
                    <td><?= h($categories->lft) ?></td>
                    <td><?= h($categories->rght) ?></td>
                    <td><?= h($categories->title) ?></td>
                    <td><?= h($categories->type) ?></td>
                    <td><?= h($categories->created) ?></td>
                    <td><?= h($categories->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $categories->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $categories->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $categories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categories->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?= __('Related Referrals') ?></h4>
            <?php if (!empty($story->referrals)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Email') ?></th>
                    <th scope="col"><?= __('Phone') ?></th>
                    <th scope="col"><?= __('Address') ?></th>
                    <th scope="col"><?= __('City') ?></th>
                    <th scope="col"><?= __('State Id') ?></th>
                    <th scope="col"><?= __('Zip Code') ?></th>
                    <th scope="col"><?= __('Is Active') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($story->referrals as $referrals): ?>
                <tr>
                    <td><?= h($referrals->id) ?></td>
                    <td><?= h($referrals->name) ?></td>
                    <td><?= h($referrals->email) ?></td>
                    <td><?= h($referrals->phone) ?></td>
                    <td><?= h($referrals->address) ?></td>
                    <td><?= h($referrals->city) ?></td>
                    <td><?= h($referrals->state_id) ?></td>
                    <td><?= h($referrals->zip_code) ?></td>
                    <td><?= h($referrals->is_active) ?></td>
                    <td><?= h($referrals->created) ?></td>
                    <td><?= h($referrals->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Referrals', 'action' => 'view', $referrals->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Referrals', 'action' => 'edit', $referrals->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Referrals', 'action' => 'delete', $referrals->id], ['confirm' => __('Are you sure you want to delete # {0}?', $referrals->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?= __('Related Comments') ?></h4>
            <div id="contain-comment">
            </div>
            <ul id="pagination-demo" class="pagination-sm"></ul>
        </div>
        <div class="related">
            <h4><?= __('Related Media') ?></h4>
            <?php if (!empty($story->media)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Story Id') ?></th>
                    <th scope="col"><?= __('Type') ?></th>
                    <th scope="col"><?= __('Mime Type') ?></th>
                    <th scope="col"><?= __('File Name') ?></th>
                    <th scope="col"><?= __('Is Featured') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($story->media as $media): ?>
                <tr>
                    <td><?= h($media->id) ?></td>
                    <td><?= h($media->story_id) ?></td>
                    <td><?= h($media->type) ?></td>
                    <td><?= h($media->mime_type) ?></td>
                    <td><?php echo $this->Html->image('/Media/show_image/' . $media->id . '/' . urlencode($story->user->id) .'/'. $media->file_name , array('height' => 70, 'width' => 70));?></td>
                    <td><?= h($media->is_featured) ?></td>
                    <td><?= h($media->created) ?></td>
                    <td><?= h($media->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Media', 'action' => 'view', $media->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Media', 'action' => 'edit', $media->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Media', 'action' => 'delete', $media->id], ['confirm' => __('Are you sure you want to delete # {0}?', $media->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>
        <div class="related">
            <h4><?= __('Related Ratings') ?></h4>
            <?php if (!empty($story->ratings)): ?>
            <table cellpadding="0" cellspacing="0">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('User Id') ?></th>
                    <th scope="col"><?= __('Story Id') ?></th>
                    <th scope="col"><?= __('Review') ?></th>
                    <th scope="col"><?= __('Rating') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($story->ratings as $ratings): ?>
                <tr>
                    <td><?= h($ratings->id) ?></td>
                    <td><?= h($ratings->user_id) ?></td>
                    <td><?= h($ratings->story_id) ?></td>
                    <td><?= h($ratings->review) ?></td>
                    <td><?= h($ratings->rating) ?></td>
                    <td><?= h($ratings->created) ?></td>
                    <td><?= h($ratings->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['controller' => 'Ratings', 'action' => 'view', $ratings->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'Ratings', 'action' => 'edit', $ratings->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'Ratings', 'action' => 'delete', $ratings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ratings->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>

        <div class="related">
            <?php
            echo $this->Form->create('Comment', ['name' => 'comment-add-form']);
            echo $this->Form->control('comment', ['type' => 'textarea', 'id' => 'commentDetails', 'required' => 'required']);
            echo $this->Form->control('story_id', ['type' => 'hidden','value' => $story->id, 'id' => 'storyId']);
            echo $this->Form->button(__('Add Comment'), ['id' => 'addComment']);
            ?>
        </div>

    </div>
</div>

<script>
var storyId = '<?php echo $story->id;?>';
var commentsTotalPages = '<?php echo $commentsTotalPaginationPages;?>';

$(document).ready(function(){
    function ajaxFetchComments(pageNo){
        $.ajax({
            url:baseUrl + 'comments/ajaxCommentsByStory/',
            type: 'POST',
            data: {story_id: storyId, page_no: pageNo},
            success: function(response){
                $("#contain-comment").html('');
                $("#contain-comment").append(response);
            }
        });
    }
    ajaxFetchComments(1);
    $('#pagination-demo').twbsPagination({
        totalPages: commentsTotalPages,
        visiblePages: 7,
        onPageClick: function (event, page) {
            ajaxFetchComments(page);
        }
    });
})
</script>