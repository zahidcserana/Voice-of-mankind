<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story $story
 */
?>
<div class="main_page_content" id="stories_edit_location">
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
        <?= $this->Form->create($story, ['name' => 'edit-location-form']) ?>
        <fieldset>
            <legend><?= __('Update Location') ?></legend>
            <?php
            echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id, 'id' => 'storyId']);
            echo $this->Form->control('country_id', ['required' => 'true', 'options' => $countries, 'id' => 'selectCountry',
                'default' => $story->country_id, 'empty' => '-- Select Country --']);
            echo $this->Form->control('state_id', ['type' => 'select', 'options' => $states, 'id' => 'selectState',
                'default' => $story->state_id, 'empty' => '-- Select State --']);
            echo $this->Form->control('city', ['type' => 'text', 'value' => $story->city]);
            echo $this->Form->control('zip_code', ['type' => 'text', 'value' => $story->zip_code]);
            ?>
        </fieldset>
        <br/>

        <?= $this->Form->button(__('Next')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
