<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Referral[]|\Cake\Collection\CollectionInterface $referrals
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Referral'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stories'), ['controller' => 'Stories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Story'), ['controller' => 'Stories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="referrals index large-9 medium-8 columns content">
    <h3><?= __('Referrals') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($referrals as $referral): ?>
            <tr>
                <td><?= h($referral->name) ?></td>
                <td><?= h($referral->email) ?></td>
                <td><?= h($referral->phone) ?></td>
                <td><?= h($referral->address) ?></td>
                <td><?= h($referral->city) ?></td>
                <td><?= $referral->has('state') ? $this->Html->link($referral->state->name, ['controller' => 'States', 'action' => 'view', $referral->state->id]) : '' ?></td>
                <td><?= h($referral->zip_code) ?></td>
                <td><?= h($referral->is_active) ?></td>
                <td><?= h($referral->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $referral->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $referral->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $referral->id], ['confirm' => __('Are you sure you want to delete # {0}?', $referral->id)]) ?>
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
