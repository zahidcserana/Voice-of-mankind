<?php echo $this->Flash->render(); ?>
<div align="center" class="alert alert-danger" id="msg-error" style="display: none;width: 40%;
    margin: 0 25%;">
</div>
<div class="main_page_content" id="referral_index">
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
        <table>
            <tr>
                <?php echo $this->Form->create('Agency'); ?>
                <td style="padding-left: 1.1%;">
                    <label class="m-checkbox">
                        <input name="story" class="checkbox" id="check-all" type="checkbox">
                        <span></span>
                    </label>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('profession', array('options' =>$professions, 'empty' => '-- Select Profession --', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('name', array('type' => 'text', 'placeholder' => 'Name', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false));
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('phone', array('type' => 'text', 'placeholder' => 'Phone', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
                </td>
                <td>
                    <?php echo $this->Form->input('email', array('type' => 'text', 'placeholder' => 'Email', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false));
                    ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('address', array('type' => 'text', 'placeholder' => 'Address', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('state', array('options' =>$states, 'empty' => '-- Select State --', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
                </td>
                <td>
                    <?php
                    echo $this->Form->control('status', array('class' => 'form-control form-filter input-sm',
                        'options' => \Cake\Core\Configure::read('Status'), 'empty' => 'Select..', 'label' => false, 'div' => false));
                    ?>
                </td>
                <td>&nbsp;</td><td>&nbsp;</td>
                <td>
                    <button class="btn btn-brand" type="button" id="searchButton" name="search">
                        <i class="fa fa-search"></i>
                    </button>
                </td>
                <td>
                    <a href="/admin/referrals/todays_referrals" class="btn btn-primary m-btn m-btn--icon m-btn--icon-only">
                        <i class="fa fa-history"></i>
                    </a>
                </td>
                <?php echo $this->Form->end(); ?>
            </tr>
            </table>
        <table class="m-datatable__table" id="ReferralsTable" style="display: block; min-height: 300px; overflow-x: auto;" width="100%">
            <thead class="m-datatable__head">
            <tr>
                <th style="width: 5% !important;" class="t-header"></th>
                <th style="width: 15% !important;">Profession</th>
                <th style="width: 15% !important;">Name</th>
                <th style="width: 15% !important;">Phone</th>
                <th style="width: 20% !important;">Email</th>
                <th style="width: 20% !important;">Address</th>
                <th style="width: 15% !important;">State</th>
                <th style="width: 15% !important;">Status</th>
                <th style="width: 15% !important;">Communication</th>
                <th style="width: 15% !important;">Related Stories</th>
            </tr>
            </thead>
            
            <tbody class="m-datatable__body">
            </tbody>
        </table>
        
        <div class="modal fade strories-modal" id="divModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-view">
                <div class="modal-body">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="span12">
                                <div class="">
                                    <div id="myCarousel" class="carousel slide">
                                        <div class="carousel-inner" id="relatedStories">                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

<style>
    #ReferralsTable_paginate {
        padding-right: 50%!important;
    }
</style>

