<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="users index large-9 medium-8 columns content">
    <?php echo $this->Flash->render(); ?>
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
        <tr role="row" class="heading">
            <th width="5%"><?= $this->Paginator->sort('id') ?></th>
            <th width="10%"><?= $this->Paginator->sort('first_name') ?></th>
            <th width="10%"><?= $this->Paginator->sort('last_name') ?></th>
            <th width="20%"><?= $this->Paginator->sort('email') ?></th>
            <th width="13%"> <?= $this->Paginator->sort('status') ?> </th>
            <th width="22%">Actions</th>
        </tr>
        <tr role="row" class="filter">
            <?php echo $this->Form->create('User', ['url' => '/admin/users/index']); ?>
            <td><input type="text" class="form-control form-filter input-sm" name="id" value=""></td>

            <td>
                <?php echo $this->Form->input('first_name', array('type' => 'text', 'placeholder' => 'First Name', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
            </td>
            <td>
                <?php echo $this->Form->input('last_name', array('type' => 'text', 'placeholder' => 'Last Name', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
            </td>
            <td>
                <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
            </td>

            <td>
                <?php
                echo $this->Form->input('status', array('class' => 'form-control form-filter input-sm',
                    'options' => array(1 => 'Active', 2 => "Inactive"), 'empty' => 'Select..', 'label' => false, 'div' => false));
                ?>
            </td>

            <td>

                <button class="btn btn-brand" type="submit" name="search" value="submit"><i class="fa fa-search"></i>
                    Search
                </button>&nbsp;
                <button class="btn btn-accent m-btn m-btn--icon m-btn--pill" onclick="reset();" type="submit"
                        name="reset" value="reset"><i class="fa fa-times"></i> Reset
                </button>
            </td>
            <?php echo $this->Form->end(); ?>
        </tr>
        </form>

        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= h($user->id) ?></td>
                <td><?= h($user->first_name) ?></td>
                <td><?= h($user->last_name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?php
                    if ($user->status == 1)
                        echo 'Active';
                    elseif ($user->status == 2)
                        echo 'Inactive';
                    ?>
                </td>

                <td class="actions">
                    <?= $this->Html->link('View', ['action' => 'edit', $user->id, 'escape' => false], ['class' => 'btn btn-outline btn-circle btn-xs purple', 'escape' => false]) ?>
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
