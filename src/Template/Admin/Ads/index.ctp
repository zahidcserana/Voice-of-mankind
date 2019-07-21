<?php echo $this->Flash->render(); ?>
<div align="center" class="alert alert-danger" id="msg-error" style="display: none;width: 40%;
    margin: 0 25%;">
</div>
<div class="main_page_content" id="ads_index">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <?php echo $this->request->params['controller']; ?>
                </h3>
            </div>            
        </div>
    </div>
    <br>
    <div class="m_datatable m-datatable m-datatable--default m-datatable--brand m-datatable--loaded">
        
        <table class="m-datatable__table" id="AdsTable" style="display: block; min-height: 300px; overflow-x: auto;" width="100%">
            <thead class="m-datatable__head">
            <tr>
                <th style="width: 12%;">Created By</th>
                <th style="width: 12%;">Created For</th>
                <th style="width: 12%;">Page Name</th>
                <th style="width: 12%;">Ad Type</th>
                <th style="width: 12%;">Start Date</th>
                <th style="width: 12%;">End Date</th>
                <th style="width: 12%;">Created</th>
                <th style="width: 12%;" class="t-header">Action</th>
            </tr>
            </thead>
            
            <tbody class="m-datatable__body">

            </tbody>
        </table>
    </div>
</div>

<style>
    #AdsTable_paginate {
        padding-right: 50%!important;
    }
</style>


