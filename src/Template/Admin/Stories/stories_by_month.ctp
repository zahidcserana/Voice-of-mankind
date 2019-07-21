<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story[]|\Cake\Collection\CollectionInterface $stories
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Story'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Agencies'), ['controller' => 'Agencies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Agency'), ['controller' => 'Agencies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Comments'), ['controller' => 'Comments', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Comment'), ['controller' => 'Comments', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Media'), ['controller' => 'Media', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Media'), ['controller' => 'Media', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Ratings'), ['controller' => 'Ratings', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Rating'), ['controller' => 'Ratings', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Referrals'), ['controller' => 'Referrals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Referral'), ['controller' => 'Referrals', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="stories index large-9 medium-8 columns content">

    <div class="large-7 medium-6 columns">
        <h3><?= __('My Stories') ?></h3>
        <?php
        if(!empty($stories)){
            ?>
            <table cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('agency_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('is_public') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('rating_average') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($stories as $story): ?>
                <tr>
                    <td><?= $story->has('agency') ? $this->Html->link($story->agency->name, ['controller' => 'Agencies', 'action' => 'view', $story->agency->id]) : '' ?></td>
                    <td><?= $this->Html->link($story->title, ['controller' => 'Stories', 'action' => 'view', $story->id]) ?></td>
                    <td><?= h($story->is_public) ?></td>
                    <td><?= $this->Number->format($story->rating_average) ?></td>
                    <td><?= h($storyStatuses[ $story->status ]) ?></td>
                    <td><?= h($story->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $story->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $story->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $story->id], ['confirm' => __('Are you sure you want to delete # {0}?', $story->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php
        }else{
            echo "<h3>No Story found in the selected month</h3>.";
        }
        ?>

        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    </div>
    <div class="large-3 medium-3 columns content">
        <?php echo $this->element('search');?>
        <br/><br/>
        <?php echo $this->element('story_cat_list');?>
        <br/><br/>
        <?php echo $this->element('archive');?>
    </div>



</div>
