<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReformIdea[]|\Cake\Collection\CollectionInterface $reformIdeas
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reform Idea'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="reformIdeas index large-9 medium-8 columns content">
    <h3><?= __('Reform Ideas') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('statezipId') ?></th>
            <th scope="col"><?= $this->Paginator->sort('storyId_notkey') ?></th>
            <th scope="col"><?= $this->Paginator->sort('visitorId_notkey') ?></th>
            <th scope="col"><?= $this->Paginator->sort('idea') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($reformIdeas as $reformIdea): ?>
            <tr>
                <td><?= $this->Number->format($reformIdea->id) ?></td>
                <td><?= $this->Number->format($reformIdea->statezipId) ?></td>
                <td><?= $this->Number->format($reformIdea->storyId_notkey) ?></td>
                <td><?= $this->Number->format($reformIdea->visitorId_notkey) ?></td>
                <td><?= h($reformIdea->idea) ?></td>
                <td><?= h($reformIdea->created) ?></td>
                <td><?= h($reformIdea->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $reformIdea->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reformIdea->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reformIdea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reformIdea->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
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
