<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story $story
 */


?>
<div class="main_page_content" id="stories_add_referral">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <ul class="side-nav">
            <li class="heading"><?= __('Actions') ?></li>
            <li><?= $this->Html->link(__('List Stories'), ['action' => 'index']) ?></li>
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
    <div class="stories form large-9 medium-8 columns content">
        <?= $this->Form->create($story, ['name' => 'form-add-referral']) ?>
        <fieldset>
            <legend><?= __('Add Referral') ?></legend>
            <?php
                $selectedReferralId = empty($story->referrals)? '' : $story->referrals[0]->id;//when updating
                echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id]);
                echo $this->Form->control('referral_id', ['type' => 'select', 'options' => $referrals,
                    'empty' => '-- Select Referral --', 'label' => 'Referral', 'default' => $selectedReferralId, 'id' => 'selectReferral']);
            ?>
            <h2>OR<br/></h2>
            <h3>Add New</h3><br/>
            <?php
                echo $this->Form->control('referrals.is_active', ['type' => 'hidden', 'value' => 0]);
                echo $this->Form->control('referrals.name', ['type' => 'text', 'label' => 'Name', 'id' => 'referralName', 'required' => false]);
                echo $this->Form->control('referrals.city', ['type' => '']);
                echo $this->Form->control('referrals.state_id', ['type' => 'select', 'options' => $states,
                    'empty' => '-- Select State --', 'id' => 'selectState']);
                echo $this->Form->control('referrals.zip_code', ['type' => 'text', 'required' => false]);
                echo $this->Form->control('referrals.address', ['type' => 'text']);
                echo $this->Form->control('referrals.phone', ['type' => 'text', 'required' => false]);
                echo $this->Form->control('referrals.email', ['type' => 'email', 'required' => false]);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Next')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>

