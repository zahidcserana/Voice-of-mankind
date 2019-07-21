<div class="main_page_content" id="my_list_add">
    <section id="content">
        <div class="container topmargin">
            <div class="row">
                <div class="col-sm-12 account-area">
                    <div class="side-tabs tabs-bordered clearfix" id="tab-5">

                        <?php echo $this->element('my_account_left_panel');?>

                        <div class="tab-container">
                            <div class="tab-content clearfix" id="add-new-list">
                                <?php echo $this->Html->link(__('Back'), ['controller' => 'users', 'action' => 'my-list'], ['class' => 'btn-pad-lg defualt-btn pull-right bake-btn']); ?>
                                <div class="add-new-area">
                                    <div class="heading-block heading-area">
                                        <h3>New List</h3>
                                    </div>
                                    <?php echo $this->Form->create($myList, ['type' => 'post', 'class' => 'nobottommargin',
                                        'id' => 'register-form', 'name' => 'my-list-add']); ?>
                                    <div class="col_half">
                                        <label for="register-form-name">List Name:</label>
                                        <?php echo $this->Form->control('name', ['type' => 'text', 'placeholder' => 'Name',
                                            'class' => 'form-control input-form', 'required' => true, 'label' => false]);
                                        ?>
                                    </div>
                                    <div class="col_half">
                                        <label for="register-form-name">Url:</label>
                                        <?php echo $this->Form->control('value', ['type' => 'text', 'placeholder' => 'Url',
                                            'class' => 'form-control input-form', 'required' => true, 'label' => false]);
                                        ?>
                                    </div>

                                    <div class="col_half">
                                        <label for="exampleInputEmail1">Select Category</label>
<?php echo $this->Form->control('categories._ids[]', ['type' => 'select', 'options' => $categories,
    'class' => 'form-control input-form', 'label' => false, 'required' => true, 'empty' => '-- Select Category --']);
?>
                                    </div>
                                    <!--                                    <div class="col_half">
                                                                            <a href="#">Add new Category</a>
                                                                        </div>-->
                                    <div class="col_full nobottommargin">
                                        <button class="btn-pad-lg defualt-btn" id="register-form-submit" name="submit" value="register">Submit</button>
                                    </div>
<?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>