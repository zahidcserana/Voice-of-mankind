<?php echo $this->Flash->render(); ?>
<div align="center" class="alert alert-danger" id="msg-error" style="display: none;width: 40%;
    margin: 0 25%;">
</div>
<div class="main_page_content" id="user_index">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <?php echo $this->request->params['controller']; ?>
                </h3>
            </div>
            <button style="float: right;margin-right: 2%;" class="btn btn-danger" name="deleteButton" id="deleteButton">Delete</button>
        </div>
    </div>
    <br>
    <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
        <table class="m-datatable__table" id="UsersTable" style="display: block; min-height: 300px; overflow-x: auto;" width="100%">
            <thead class="m-datatable__head">
            <tr>
                <th class="t-header"></th>
                <th>Name</th>
                <th>Email</th>
                <th>Created</th>
                <th>Total Story</th>
                <th>Status</th>
                <th class="t-header">Action</th>
            </tr>
            </thead>
            <thead>
            <?php echo $this->Form->create('Users'); ?>
            <tr>
                <td style="padding-left: 1.1%;">
                    <label class="m-checkbox">
                        <input name="story" class="checkbox" id="check-all" type="checkbox">
                        <span></span>
                    </label>
                </td>
                <td>
                    <?php echo $this->Form->input('username', array('type' => 'text', 'placeholder' => 'Name', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false));
                    ?>
                </td>
                <td>
                    <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false));
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('created', array('type' => 'text', 'placeholder' => 'Created', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false,'id'=>'m_datepicker_1','readonly'=>true)); ?>
                </td>

                <td>
                    <?php
                    echo $this->Form->control('status', array('class' => 'form-control form-filter input-sm',
                        'options' => \Cake\Core\Configure::read('Status'), 'empty' => '- Status -', 'label' => false, 'div' => false));
                    ?>
                </td>

                <td>
                    <button class="btn btn-brand" type="button" id="searchButton" name="search"><i class="fa fa-search"></i> Search
                    </button>&nbsp;
                </td>
                <td> <a class="btn btn-accent m-btn m-btn--icon m-btn--pill" href="/admin/users/index">Reset</a></td>
            </tr>
            <?php echo $this->Form->end(); ?>
            </thead>
            <tbody class="m-datatable__body">

            </tbody>
        </table>
    </div>
</div>
<style>
    #UsersTable_paginate {
        padding-right: 50%!important;
    }
</style>




