<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ad[]|\Cake\Collection\CollectionInterface $ads
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Ad'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Referrals'), ['controller' => 'Referrals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Referral'), ['controller' => 'Referrals', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="ads index large-9 medium-8 columns content">
    <h3><?= __('Ads') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('referral_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('ad_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('file_name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_view') ?></th>
                <th scope="col"><?= $this->Paginator->sort('total_click') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ads as $ad): ?>
            <tr>
                <td><?= $this->Number->format($ad->id) ?></td>
                <td><?= $ad->has('user') ? $this->Html->link($ad->user->full_name, ['controller' => 'Users', 'action' => 'view', $ad->user->id]) : '' ?></td>
                <td><?= $ad->has('referral') ? $this->Html->link($ad->referral->name, ['controller' => 'Referrals', 'action' => 'view', $ad->referral->id]) : '' ?></td>
                <td><?= h($ad->ad_type) ?></td>
                <td><?= h($ad->file_type) ?></td>
                <td><?= h($ad->file_name) ?></td>
                <td><?= h($ad->start_date) ?></td>
                <td><?= h($ad->end_date) ?></td>
                <td><?= $this->Number->format($ad->total_view) ?></td>
                <td><?= $this->Number->format($ad->total_click) ?></td>
                <td><?= h($ad->created) ?></td>
                <td><?= h($ad->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $ad->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ad->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $ad->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ad->id)]) ?>
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
