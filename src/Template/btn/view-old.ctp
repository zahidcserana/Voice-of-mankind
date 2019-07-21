<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ReformIdea $reformIdea
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reform Idea'), ['action' => 'edit', $reformIdea->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reform Idea'), ['action' => 'delete', $reformIdea->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reformIdea->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reform Ideas'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reform Idea'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="reformIdeas view large-9 medium-8 columns content">
    <h3><?= h($reformIdea->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Idea') ?></th>
            <td><?= h($reformIdea->idea) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($reformIdea->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('StatezipId') ?></th>
            <td><?= $this->Number->format($reformIdea->statezipId) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('StoryId Notkey') ?></th>
            <td><?= $this->Number->format($reformIdea->storyId_notkey) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('VisitorId Notkey') ?></th>
            <td><?= $this->Number->format($reformIdea->visitorId_notkey) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($reformIdea->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($reformIdea->modified) ?></td>
        </tr>
    </table>
</div>
