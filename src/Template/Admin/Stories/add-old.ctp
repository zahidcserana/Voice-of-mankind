<div class="main_page_content" id="story_add">
    <?php echo $this->Flash->render(); ?>
    <?php echo $this->Form->create($story, array('name' => 'add-story','class'=>'m-form m-form--fit m-form--label-align-right')); ?>
        <div class="m-portlet__body">
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Agency
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('agency_id',array('label'=>false,'class'=>'form-control m-input','options'=>$agencies));?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Title
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('title',array('label'=>false,'class'=>'form-control m-input','placeholder'=>'Enter Title'));?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Description
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('description', array('type'=>'textarea', 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Public
                </label>
                <div class="col-8">
                    <?php $is_public = array(1=>'Yes',0=>'No');
                echo $this->Form->control('is_public',array('label'=>false,'class'=>'form-control m-input','options'=>$is_public)); ?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Average Rating
                </label>
                <div class="col-8">
                    <?php echo $this->Form->control('rating_average',array('label'=>false,'class'=>'form-control m-input','placeholder'=>'Average Rating'));?>
                </div>
            </div>
            <div class="form-group m-form__group row">
                <label class="col-2 col-form-label">
                    Status
                </label>
                <div class="col-8">
                    <?php
                echo $this->Form->control('status', array('class' => 'form-control m-input', 'label' => false, 'div' => false,'options'=>\Cake\Core\Configure::read('Status'))); ?>
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
                        <button type="reset" class="btn btn-secondary">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>
<!--<div class="main_page_content" id="story_add">
    <?php /*echo $this->Flash->render(); */?>
    <?php /*echo $this->Form->create($story, array('name' => 'add-story','class'=>'m-form m-form--fit m-form--label-align-right')); */?>
    <div class="m-portlet__body">
        <div class="form-group m-form__group">
            <label>
                Agency
            </label>
            <?php
/*            echo $this->Form->control('agency_id',array('label'=>false,'class'=>'form-control m-input m-input--solid','options'=>$agencies));*/?>
        </div>
        <div class="form-group m-form__group">
            <label for="exampleInputEmail1">
                Title
            </label>
            <?php /*echo $this->Form->control('title',array('label'=>false,'class'=>'form-control m-input m-input--solid','placeholder'=>'Enter Title'));*/?>

        </div>
        <div class="form-group m-form__group">
            <label for="exampleTextarea">
                Description
            </label>
            <?php /*echo $this->Form->control('description', array('type'=>'textarea', 'class' => 'form-control m-input m-input--solid', 'label' => false, 'div' => false)); */?>
        </div>
        <div class="form-group m-form__group">
            <label for="exampleSelect1">
                Public
            </label>
            <?php /*$is_public = array(1=>'Yes',2=>'No');
            echo $this->Form->control('is_public',array('label'=>false,'class'=>'form-control m-input m-input--solid','options'=>$is_public)); */?>
        </div>
        <div class="form-group m-form__group">
            <label for="exampleInputEmail1">
                Average Rating
            </label>
            <?php /*echo $this->Form->control('rating_average',array('label'=>false,'class'=>'form-control m-input m-input--solid','placeholder'=>'Average Rating'));*/?>
        </div>
        <div class="form-group m-form__group">
            <label for="exampleInputEmail1">
                Status
            </label>
            <?php
/*            $status = [1=>'Active',2=>'Inactive'];
            echo $this->Form->control('status', array('class' => 'form-control m-input', 'label' => false, 'div' => false,'options'=>$status)); */?>
        </div>
    </div>
    <div class="m-portlet__foot m-portlet__foot--fit">
        <div class="m-form__actions">
            <button type="submit" class="btn btn-success">
                Submit
            </button>
            <button type="reset" class="btn btn-secondary">
                Cancel
            </button>
        </div>
    </div>
    <?php /*echo $this->Form->end(); */?>
</div>-->



