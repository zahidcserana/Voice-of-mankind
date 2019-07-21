<?php echo $this->Flash->render(); ?>
<div align="center" class="alert alert-danger" id="msg-error" style="display: none;width: 40%;
    margin: 0 25%;">
</div>
<div class="main_page_content" id="statezips_index">
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
        <div class="col-md-8">
            <div style="float: left" class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
                <table class="m-datatable__table" id="StatezipsTable" style="display: block; min-height: 300px; overflow-x: auto;" width="100%">
                    <thead class="m-datatable__head">
                    <tr>
                        <th style="width: 15% !important;">Zipcode</th>
                        <th style="width: 15% !important;">State</th>
                        <th style="width: 15% !important;">County</th>
                        <th style="width: 15% !important;">City</th>
                        <th style="width: 15% !important;" class="t-header">Action</th>
                    </tr>
                    </thead>

                    <tbody class="m-datatable__body">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <?php echo $this->Form->create($statezip, array('name' => 'statezips-form', 'class' => 'm-form m-form--fit m-form--label-align-right')); ?>
                <div class="m-portlet__body">
                  <div class="form-group m-form__group">
                      <label class="col-2 col-form-label">
                        State
                      </label>
                      <div class="col-8" >
                        <?php echo $this->Form->control('state_id', array('options' =>$states, 'empty' => 'Select State', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false)); ?>
                        </div>
                  </div>
                  <div class="form-group m-form__group" >
                      <label class="col-2 col-form-label">
                        County
                      </label>
                      <div class="col-8" id="countyList">
                        <?php echo $this->Form->control('county_id', ['label' => false, 'class' => 'form-control input-form','options'=>$counties]);?>
                        </div>
                  </div>
                  <div class="form-group m-form__group" >
                      <label class="col-2 col-form-label">
                        City
                      </label>
                      <div class="col-8" id="cityList">
                        <?php echo $this->Form->control('city_id', ['label' => false, 'class' => 'form-control input-form']);?>
                        </div>
                  </div>
                  <div class="form-group m-form__group">
                      <label class="col-2 col-form-label">
                        Zipcode
                      </label>
                      <div class="col-8" >
                        <?php echo $this->Form->control('zip_id', array('options' =>$zipcodes, 'empty' => 'Select Zipcode', 'class' => 'form-control form-filter input-sm', 'div' => false, 'label' => false,'value'=>empty($statezip->zipcode['id'])==true?'':$statezip->zipcode['id'])); ?>
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
