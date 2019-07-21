<div class="main_page_content" id="reform_idea_index">
    <section id="content">
        <div class="container topmargin">
            <?php echo $this->Flash->render(); ?>            
            <div class="row">
                <?php echo $this->Flash->render();?>
                <div class="col-sm-12 account-area">
                    <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                        <?php echo $this->element('my_account_left_panel');?>

                        <div class="tab-container">
                            <div class="tab-content clearfix" id="mystories">
                                <div id="posts" class="col-md-9 col-sm-12 col-xs-12 stories-left-side small-thumbs">

                                    <?php
                                    if (!empty($reformIdeas) && count($reformIdeas) > 0) {

                                        foreach ($reformIdeas as $row):
                                            ?>
                                            <div class="entry clearfix striese-blog-area">
                                                <div class="entry-c blog-body">
                                                    <div class="entry-title">
                                                        <h2><?php echo $this->Html->link(__($row->agency['name']), ['controller' => 'reform-ideas', 'action' => 'view', $row->id]); ?></h2>
                                                    </div>
                                                   <h5><?php echo $row->user->first_name . ' ' . $row->user->last_name.', '.$row->created; ?>
                                                    </h5>
                                                    <div class="entry-content">
                                                        <p>
                                                            <?php
                                                            $descr = strip_tags($row->idea);
                                                            $descr = substr($descr, 0, 400);
                                                            echo wordwrap($descr, 400).' ...';
                                                            ?>
                                                        </p>

                                                        <div>
                                                            <?php echo $this->Html->link(__('Read More'), ['controller' => 'reform-ideas', 'action' => 'view', $row->id], ['class' => 'more-link btn-lgradius btn-shadow ']); ?>
                                                            <?php echo $this->Html->link(__('Edit'), ['controller' => 'reform-ideas ', 'action' => 'edit', $row->id],['class' => 'more-link btn-olive btn-lgradius btn-shadow ']);?>
                                                            <?php echo $this->Html->link(__('Delete'), ['controller' => 'reform-ideas', 'action' => 'delete', $row->id],['class' => 'more-link btn-red btn-lgradius btn-shadow','onclick'=>"return confirm('Are you sure want to delete this Reform Idea?');"]);?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                        endforeach;
                                        $hasPages = $this->Paginator->numbers();
                                        //checking whether the pagination div needed or not
                                        if ($hasPages) {
                                            ?>
                                            <div class="paginator">
                                                <ul class="pagination">
                                                    <?= $this->Paginator->first('<< ' . __('First')) ?>
                                                    <?= $this->Paginator->prev('< ' . __('Previous')) ?>
                                                    <?= $this->Paginator->numbers() ?>
                                                    <?= $this->Paginator->next(__('Next') . ' >') ?>
                                                    <?= $this->Paginator->last(__('Last') . ' >>') ?>
                                                </ul>
                                                <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        echo '<h2>No Reform Idea found!</h2>';
                                    }
                                    ?>
                                </div>
                                <div class="col-md-3 col-sm-12 col-xs-12 stories-right-side">
                                    <a href="/reform-ideas/add" class="button btn-primary defualt-btn btn-lgradius">Create Reform Idea</a>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
