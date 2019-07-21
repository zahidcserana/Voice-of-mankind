<?php echo $this->Flash->render(); ?>
<div align="center" class="alert alert-danger" id="msg-error" style="display: none;width: 40%;
    margin: 0 25%;">
</div>
<div class="main_page_content" id="story_index">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    View All Stories
                </h3>
            </div>
            <div>
                <!-- Download Report -->
                <!--
                <div class="m-dropdown m-dropdown--inline m-dropdown--small m-dropdown--arrow m-dropdown--align-left" data-dropdown-toggle="hover" aria-expanded="true" style="float: right;margin-right: 5%;">
                    <a href="javascript::void(0);" class="m-dropdown__toggle btn btn-brand dropdown-toggle">
                        Export
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--left"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first">
									<span class="m-nav__section-text">
										<a class="dropdown-item" href="/admin/stories/pdf_build">PDF</a>
									</span>
                                        </li>
                                        <li class="m-nav__section m-nav__section--first">
									<span class="m-nav__section-text">
										<a class="dropdown-item" href="/admin/stories/csv_file">CSV</a>
									</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->

            </div>
            <button style="float: right;margin-right: 2%;" class="btn btn-danger" name="deleteButton" id="deleteButton">Delete</button>
        </div>
    </div>
    <br>
    <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
        <table class="m-datatable__table" id="StoriesTable" style="display: block; min-height: 300px; overflow-x: auto;" width="100%">
            <thead class="m-datatable__head">
            <tr>
                <th class="th-5 t-header"></th>
                <th class="th-20">Title</th>
                <th class="th-15">Created By</th>
                <th class="th-15">Created</th>
                <th class="th-20">Agency</th>
                <th class="th-10">Status</th>
                <th class="th-15 t-header">Action</th>
            </tr>
            </thead>
            <thead>
            <tr>
                <?php echo $this->Form->create('Story'); ?>
                <td style="padding-left: 1.1%;">
                    <label class="m-checkbox">
                        <input name="story" class="checkbox" id="check-all" type="checkbox">
                        <span></span>
                    </label>
                </td>
                <td>
                    <?php echo $this->Form->control('title', array('type' => 'text', 'placeholder' => 'Title', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('user_id', ['label' => false,'class'=>'form-control form-filter input-sm m-select2','empty' => '-- Select User --', 'id' => 'selectUser','multiple'=>'multiple']);
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('created', array('type' => 'text', 'placeholder' => 'Created', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false,'id'=>'m_datepicker_1','readonly'=>true)); ?>
                </td>
                <td>
                    <?php echo $this->Form->control('agency_type', array('id'=>'agency_type','empty' => '-- Select Agency --', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false,'options'=>$agencyTypes)); ?>
                </td>

                <td>
                    <?php
                    echo $this->Form->control('status', array('class' => 'form-control form-filter input-sm',
                        'options' => \Cake\Core\Configure::read('Status'), 'empty' => 'Select..', 'label' => false, 'div' => false));
                    ?>
                </td>

                <td>
                    <button class="btn btn-brand" type="button" id="searchButton" name="search"><i class="fa fa-search"></i>
                    </button>&nbsp;
                    <a href="/admin/stories/index" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                        <i class="fa fa-history"></i>
                    </a>
                    <?php echo $this->Form->end(); ?>
            </tr>
            </thead>
            <tbody class="m-datatable__body">

            </tbody>
        </table>
    </div>
</div>

<style>
    #StoriesTable_paginate {
        padding-right: 50%!important;
    }

</style>

