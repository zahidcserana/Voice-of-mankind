<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pursue[]|\Cake\Collection\CollectionInterface $pursues
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Pursue'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Referrals'), ['controller' => 'Referrals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Referral'), ['controller' => 'Referrals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pursues index large-9 medium-8 columns content">
    <h3><?= __('Pursues') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('referral_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('pursue_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pursues as $pursue): ?>
            <tr>
                <td><?= $this->Number->format($pursue->id) ?></td>
                <td><?= $pursue->has('referral') ? $this->Html->link($pursue->referral->name, ['controller' => 'Referrals', 'action' => 'view', $pursue->referral->id]) : '' ?></td>
                <td><?= $pursue->has('user') ? $this->Html->link($pursue->user->full_name, ['controller' => 'Users', 'action' => 'view', $pursue->user->id]) : '' ?></td>
                <td><?= h($pursue->pursue_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $pursue->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $pursue->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $pursue->id], ['confirm' => __('Are you sure you want to delete # {0}?', $pursue->id)]) ?>
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
