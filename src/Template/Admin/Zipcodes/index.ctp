<?php echo $this->Flash->render(); ?>
<div align="center" class="alert alert-danger" id="msg-error" style="display: none;width: 40%;
    margin: 0 25%;">
</div>
<div class="main_page_content" id="zipcode_index">
    <?php echo $this->Flash->render(); ?>
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
    <div class="row">
        <div class="col-md-6">
            <div style="float: left" class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                <table class="m-datatable__table" id="ZipcodesTable" style="display: block; min-height: 300px; overflow-x: auto;" width="60%">
                    <thead class="m-datatable__head">
                    <tr>
                        <th style="width: 15% !important;">Name</th>
                        <th style="width: 5% !important;">Latitude</th>
                        <th style="width: 5% !important;">Longitude</th>
                        <th style="width: 15% !important;" class="t-header">Action</th>
                    </tr>
                    </thead>

                    <tbody class="m-datatable__body">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div style="float: right">
                <?php echo $this->Form->create($zipcode, array('name' => 'zipcode-form', 'class' => 'm-form m-form--fit m-form--label-align-right')); ?>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <label class="col-2 col-form-label">
                            Name
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('zip', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Name')); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-2 col-form-label">
                            Latitude
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('latitude', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Latitude')); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-2 col-form-label">
                            Longitude
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('longitude', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Longitude')); ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label class="col-2 col-form-label">
                            Population
                        </label>
                        <div class="col-8">
                            <?php echo $this->Form->control('population', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Population')); ?>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-10">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<style>
    #StatesTable_paginate {
        padding-right: 50%!important;
    }
</style>