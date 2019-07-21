<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface[]|\Cake\Collection\CollectionInterface $users
 */
?>
<section id="content">
    <div class="container topmargin">
        <div class="row">
            <!-- Accout Content Area -->
            <div class="col-sm-12 account-area">
                <div class="tabs side-tabs tabs-bordered clearfix" id="tab-5">
                    <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->user_type_id) ?></td>
                            <td><?= h($user->first_name) ?></td>
                            <td><?= h($user->last_name) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->city) ?></td>
                            <td><?= $this->Number->format($user->state_id) ?></td>
                            <td><?= h($user->zip_code) ?></td>
                            <td><?= h($user->avatar_name) ?></td>
                            <td><?= h($user->is_active) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'my_profile', $user->id]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>

                </div>
            </div>
        </div>
    </div>

</section>