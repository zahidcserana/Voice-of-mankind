<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Referral $referral
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Referral'), ['action' => 'edit', $referral->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Referral'), ['action' => 'delete', $referral->id], ['confirm' => __('Are you sure you want to delete # {0}?', $referral->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Referrals'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Referral'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List States'), ['controller' => 'States', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New State'), ['controller' => 'States', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Stories'), ['controller' => 'Stories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Story'), ['controller' => 'Stories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="referrals view large-9 medium-8 columns content">
    <h3><?= h($referral->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($referral->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($referral->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($referral->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($referral->address) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('City') ?></th>
            <td><?= h($referral->city) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('State') ?></th>
            <td><?= $referral->has('state') ? $this->Html->link($referral->state->name, ['controller' => 'States', 'action' => 'view', $referral->state->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Zip Code') ?></th>
            <td><?= h($referral->zip_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($referral->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($referral->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($referral->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Active') ?></th>
            <td><?= $referral->is_active ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Stories') ?></h4>
        <?php if (!empty($referral->stories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Agency Id') ?></th>
                <th scope="col"><?= __('Title') ?></th>
                <th scope="col"><?= __('Description') ?></th>
                <th scope="col"><?= __('Is Public') ?></th>
                <th scope="col"><?= __('Rating Average') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($referral->stories as $stories): ?>
            <tr>
                <td><?= h($stories->id) ?></td>
                <td><?= h($stories->user_id) ?></td>
                <td><?= h($stories->agency_id) ?></td>
                <td><?= h($stories->title) ?></td>
                <td><?= h($stories->description) ?></td>
                <td><?= h($stories->is_public) ?></td>
                <td><?= h($stories->rating_average) ?></td>
                <td><?= h($stories->status) ?></td>
                <td><?= h($stories->created) ?></td>
                <td><?= h($stories->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Stories', 'action' => 'view', $stories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Stories', 'action' => 'edit', $stories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Stories', 'action' => 'delete', $stories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $stories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
