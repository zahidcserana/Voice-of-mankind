<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Pursue $pursue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pursues'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Referrals'), ['controller' => 'Referrals', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Referral'), ['controller' => 'Referrals', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="pursues form large-9 medium-8 columns content">
    <?= $this->Form->create($pursue) ?>
    <fieldset>
        <legend><?= __('Add Pursue') ?></legend>
        <?php
            echo $this->Form->control('referral_id', ['options' => $referrals]);
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('response');
            echo $this->Form->control('pursue_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
