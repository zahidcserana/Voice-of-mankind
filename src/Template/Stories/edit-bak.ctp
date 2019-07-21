<div class="main_page_content" id="stories_edit">
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
        <?= $this->Form->create($story, ['name' => 'stories-edit-form']) ?>
        <fieldset>
            <legend><?= __('Update Story') ?></legend>
            <?php
            $selectedAgencyType = empty($story->agency)?'':$story->agency->type;
            echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id]);
            echo $this->Form->control('title', ['required' => 'true']);
            echo $this->Form->radio('agency_type', $agencyTypes, ['default' => $selectedAgencyType]);
            echo $this->Form->control('agency_id', ['empty' => '-- Select Agency --', 'id' => 'selectAgency',
                'options' => $agencies, 'default' => $story->agency_id]);
            ?>
            <h2>OR<br/></h2>
            <h3>Create New</h3><br/>
            <?php
            echo $this->Form->control('Agency.name', ['type' => 'text', 'label' => 'Agency Name', 'id' => 'agencyName']);
            echo $this->Form->control('Agency.type', ['type' => 'hidden', 'id' => 'agencyType']);
            echo $this->Form->control('Agency.city', ['type' => '']);
            echo $this->Form->control('Agency.state_id', ['type' => 'select', 'options' => $states, 'empty' => '-- Select State --']);
            echo $this->Form->control('Agency.zip_code', ['type' => 'text']);
            echo $this->Form->control('Agency.address', ['type' => 'text']);
            echo $this->Form->control('Agency.phone', ['type' => 'text']);
            echo $this->Form->control('Agency.email', ['type' => 'email']);
            ?>
        </fieldset>
        <?= $this->Form->button(__('Next')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>