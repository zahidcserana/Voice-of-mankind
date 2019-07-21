<ul class="tab-nav clearfix">
    <li class="<?php echo $this->request->params['action']=='myProfile'?'active':'';?>">
        <?php echo $this->Html->link(__('My Account'), ['controller' => 'users', 'action' => 'my-profile']);?>
    </li>
    <li class="<?php echo $this->request->params['action']=='myStories'?'active':'';?>">
        <?php echo $this->Html->link(__('My Stories'), ['controller' => 'users', 'action' => 'my-stories']);?>
    </li>
    <li class="<?php echo $this->request->params['action']=='myReformIdeas'?'active':'';?>">
        <?php echo $this->Html->link(__('My Reform Ideas'), ['controller' => 'ReformIdeas', 'action' => 'my-reform-ideas']);?>
    </li>
    <li class="<?php echo $this->request->params['action']=='myComments'?'active':'';?>">
        <?php echo $this->Html->link(__('My Comments'), ['controller' => 'users', 'action' => 'my-comments']);?>
    </li>
    <li class="<?php echo $this->request->params['action']=='myList'?'active':'';?>">
        <?php echo $this->Html->link(__('My Helpful Links'), ['controller' => 'MyLists', 'action' => 'my-list']);?>
    </li>
    <?php if($this->request->params['action']=='myStories'):?>
    <li>
        <?php echo $this->Html->link('Create New Story', ['controller' => 'stories', 'action' => 'add'], [ 'class' => 'button defualt-btn btn-block1']);?>
    </li>
    <?php endif; ?>
</ul>
