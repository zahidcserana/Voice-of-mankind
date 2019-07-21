<h4 class="nomargin">Referrals: <?php echo $referral->name; ?>
    <a data-toggle="modal" data-target="#referralModal"
       data-whatever="@getbootstrap">
        <i class="la la-pencil"></i>
    </a>
</h4>
Email: <?php echo $referral->email; ?> <br>
Phone: <?php echo $referral->phone; ?> <br>
City: <?php echo $referral->city; ?> <br>
Address: <?php echo $referral->address; ?> <br>

<!-- Referral modal -->
<!--<div class="modal fade" id="referralModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Referral Update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php /*echo $this->Form->create($story, array('name' => 'referral-form', 'id' => 'referral-form')) */?>
            <div class="modal-body">
                <div align="center" class="alert alert-warning" id="msg-referral" style="display: none"></div>
                <?php
/*                $selectedReferralId = empty($story->referrals) ? '' : $story->referrals[0]->id;
                echo $this->Form->control('story_id', ['type' => 'hidden', 'value' => $story->id]);
                */?>
                <div class="form-group">
                    <label for="description" class="form-control-label">Referral:</label>
                    <?php /*echo $this->Form->control('referrals._ids[]', array('label' => false, 'class' => 'form-control m-input', 'options' => $referrals, 'empty' => '-- Select Referral --', 'default' => $selectedReferralId, 'id' => 'selectReferral'));
                    */?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
                <div id="referral-loader" class="m-loader m-loader--brand" style="width: 30px; display: none;"></div>
            </div>
            <?/*= $this->Form->end() */?>
        </div>
    </div>
</div>-->

<div class="modal fade strories-modal" id="referralModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-view">
        <div class="modal-body">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div align="center" class="alert alert-warning" id="msg-referral" style="display: none"></div>
                    <div class="span12">
                        <div class="">
                            <div id="myCarousel" class="carousel slide">
                                <div class="carousel-inner" id="divSrc">
                                    <div class="stories form large-9 medium-8 columns content">
                                        <?= $this->Form->create($story, array('name' => 'ajax-add-referral','id' => 'ajax-add-referral', 'class' => 'm-form m-form--fit m-form--label-align-right')) ?>
                                        <div class="m-portlet__body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Was there any professional who could help you in the story and deserves to be recognized?<br/>
                                                        Please refer him below.</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <h5>Search Referral By Profession and Name</h5>
                                                <div class="col-md-12">
                                                    <div class="form-group m-form__group row">
                                                        <?php
                                                        echo $this->Form->control('id', ['type' => 'hidden', 'value' => $story->id]);
                                                        ?>
                                                        <label class="col-2 col-form-label">Profession</label><br/>
                                                        <div class="col-8">
                                                            <?php
                                                            echo $this->Form->control('referral.profession_id', ['type' => 'select', 'label' => false,
                                                                'class' => 'form-control m-input', 'id' => 'referralProfession', 'default' => $selectedProfessionId,
                                                                'options' => $professions, 'empty' => '-- Select Profession --']);
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label">Referral</label>
                                                        <div class="col-8">
                                                            <?php
                                                            echo $this->Form->control('referrals._ids[]', ['options' => $referrals,
                                                                'empty' => '-- Referral Name --', 'default' => $selectedReferralId, 'style' => 'opacity: 1;',
                                                                'class' => 'form-control m-select2', 'id' => 'selectReferral', 'label' => false]);
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4 class="m-subheader__title ">OR<br/></h4>
                                            <h4 class="m-subheader__title ">Create New</h4><br/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h4>Personal Info:</h4>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label">
                                                            Name
                                                        </label>
                                                        <div class="col-8">
                                                            <?php echo $this->Form->control('referral.is_active', ['type' => 'hidden', 'value' => 0]); ?>
                                                            <?php echo $this->Form->control('referral.name', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Enter Name')); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label">
                                                            Email address
                                                        </label>
                                                        <div class="col-8">
                                                            <?php echo $this->Form->control('referral.email', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'Valid Email')); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label">
                                                            Phone
                                                        </label>
                                                        <div class="col-8">
                                                            <?php echo $this->Form->control('referral.phone', array('label' => false, 'class' => 'form-control m-input', 'Placeholder' => 'Phone')); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <h4>Address:</h4>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label">
                                                            Zipcode
                                                        </label>
                                                        <div class="col-8" style="padding-left: 24%;">
                                                            <input type="hidden" name="zip_code" id="zip_code">
                                                            <?php echo $this->Form->input('zip_value', array('type' => 'select', 'id' => 'selectZip', 'class' => 'form-control input-form select2', 'label' => false)); ?>
                                                        </div>
                                                    </div>
                                                    <div id="userLocation">
                                                        <div class="form-group m-form__group row">
                                                            <label class="col-2 col-form-label">
                                                                State
                                                            </label>
                                                            <div class="col-8" id="stateDiv">
                                                                <?php echo $this->Form->control('state_id', array('label' => false, 'empty' => '-- Select a County --', 'class' => 'form-control m-input', 'options' => $states)); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" id="countyDiv">
                                                            <label class="col-2 col-form-label">
                                                                County
                                                            </label>
                                                            <div class="col-8">
                                                                <?php echo $this->Form->control('county_id', array('label' => false, 'class' => 'form-control m-input')); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group m-form__group row" id="cityDiv">
                                                            <label class="col-2 col-form-label">
                                                                City
                                                            </label>
                                                            <div class="col-8">
                                                                <?php echo $this->Form->control('city_id', array('label' => false, 'class' => 'form-control m-input', 'placeholder' => 'City')); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        </fieldset>
                                        <div class="m-portlet__foot m-portlet__foot--fit">
                                            <div class="m-form__actions">
                                                <div class="row">

                                                    <div class="col-10">
                                                        <button type="submit" class="btn btn-success">
                                                            Next
                                                        </button>

                                                </div>
                                                    <div class="col-2">
                                                        <div id="referral-loader" class="m-loader m-loader--brand" style="width: 30px;display: none"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?= $this->Form->end() ?>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-angle-left"></i>  </a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-angle-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


