<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Story[]|\Cake\Collection\CollectionInterface $stories
 */
?>
<div class="stories index large-9 medium-8 columns content">

    <div class="large-7 medium-6 columns">
        <h3><?= __('My Stories') ?></h3>
        <table cellpadding="0" cellspacing="0">
            <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('agency_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_public') ?></th>
                <th scope="col"><?= $this->Paginator->sort('rating_average') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($stories as $story): ?>
                <tr>
                    <td><?= $story->has('agency') ? $this->Html->link($story->agency->name, ['controller' => 'Agencies', 'action' => 'view', $story->agency->id]) : '' ?></td>
                    <td><?= $this->Html->link($story->title, ['controller' => 'Stories', 'action' => 'view', $story->id]) ?></td>
                    <td><?= h($story->is_public) ?></td>
                    <td><?= $this->Number->format($story->rating_average) ?></td>
                    <td><?= h($storyStatuses[ $story->status ]) ?></td>
                    <td><?= h($story->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $story->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $story->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $story->id], ['confirm' => __('Are you sure you want to delete # {0}?', $story->id)]) ?>
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
    <div class="large-3 medium-3 columns content">
            <?php echo $this->element('search');?>
            <br/><br/>
            <?php echo $this->element('story_cat_list');?>
            <br/><br/>
            <?php echo $this->element('archive');?>
    </div>

</div>

<section id="content">
    <div class="container topmargin">
        <div class="row">
            <!-- Stories left side -->
            <div id="posts" class="col-md-9 col-sm-12 col-xs-12 stories-left-side small-thumbs">
                <!-- Stories Blog Box -->
                <?php foreach ($stories as $story): ?>
                <div class="entry clearfix striese-blog-area">
                    <div class="entry-image">
                        <a href="img/17.jpg" data-lightbox="image"><img class="image_fade" src="img/blog3.jpeg" alt="Standard Post with Image"></a>
                    </div>
                    <div class="entry-c blog-body">
                        <div class="entry-title">
                            <h2><a href="#">The standard chunk of Lorem Ipsum </a></h2>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li><i class="fa fa-list"></i> Category</li>
                            <li><i class="fa fa-th-large"></i> Referred To </li>
                            <li><i class="fa fa-plus-square"></i> Created add</li>
                        </ul>
                        <div class="entry-content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt,</p>
                            <a href="blog-single.html" class="more-link"> Read More </a>
                            <span>
                                        <i class="icon-star3"></i>
                                        <i class="icon-star3"></i>
                                        <i class="icon-star3"></i>
                                        <i class="icon-star3"></i>
                                    </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- / Stories Blog Box -->

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
            <!-- / Stories Left Side -->

            <!-- Stories page right side -->
            <div class="col-md-3 col-sm-12 col-xs-12 stories-right-side">
                <?php echo $this->element('search');?>
                <?php echo $this->element('story_cat_list');?>
                <?php echo $this->element('archive');?>

                <!-- Archive Right Side -->
                <div class="col_full">
                    <div class="add-area bottommargin-sm center">
                        <h4>Add Here</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
