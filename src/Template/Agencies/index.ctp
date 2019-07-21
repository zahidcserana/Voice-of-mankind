<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Agency[]|\Cake\Collection\CollectionInterface $agencies
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Agency'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Stories'), ['controller' => 'Stories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Story'), ['controller' => 'Stories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="agencies index large-9 medium-8 columns content">
    <h3><?= __('Agencies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('address') ?></th>
                <th scope="col"><?= $this->Paginator->sort('city') ?></th>
                <th scope="col"><?= $this->Paginator->sort('state_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('zip_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('website') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($agencies as $agency): ?>
            <tr>
                <td><?= $agency->has('user') ? $this->Html->link($agency->user->id, ['controller' => 'Users', 'action' => 'view', $agency->user->id]) : '' ?></td>
                <td><?= h($agencyTypes[$agency->type]) ?></td>
                <td><?= h($agency->name) ?></td>
                <td><?= h($agency->email) ?></td>
                <td><?= h($agency->phone) ?></td>
                <td><?= h($agency->address) ?></td>
                <td><?= h($agency->city) ?></td>
                <td><?= $agency->has('state') ? $this->Html->link($agency->state->name, ['controller' => 'States', 'action' => 'view', $agency->state->id]) : '' ?></td>
                <td><?= h($agency->zip_code) ?></td>
                <td><?= h($agency->website) ?></td>
                <td><?= h($agency->is_active) ?></td>
                <td><?= h($agency->created) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $agency->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $agency->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $agency->id], ['confirm' => __('Are you sure you want to delete # {0}?', $agency->id)]) ?>
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
