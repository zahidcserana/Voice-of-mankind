<div class="main_page_content" id="Account_profile">
    <div class="m-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="m-portlet m-portlet--full-height  ">
                    <div class="m-portlet__body">
                        <div class="m-card-profile">
                            <div class="m-card-profile__title m--hide">
                                Your Profile
                            </div>
                            <div class="m-card-profile__pic">
                                <div class="m-card-profile__pic-wrapper">
                                    <?php
                                    $file = WWW_ROOT . 'img' . DS . $user['email'] . DS . $user['avatar_name'];
                                    if ($user['avatar_name'] != '' && file_exists($file)) {
                                        $imgFile = '/img' . DS . $user['email'] . DS . $user['avatar_name'];
                                    } else {
                                        $imgFile = '/img/users/profile.png';
                                    }
                                    ?>
                                    <img src="<?php echo $imgFile; ?>" alt="">
                                </div>
                            </div>
                            <div class="m-card-profile__details">
                                                    <span class="m-card-profile__name">
                                                        <?php echo $user->first_name.' '.$user->last_name;?>
                                                    </span>
                                <a href="" class="m-card-profile__email m-link">
                                    <?php echo $user->email;?>
                                </a>
                                <br>
                                <?php
                                if ($user->status ==1){ ?><p style="color: #0a6aa1">Active</p><?php }
                                else { ?><p style="color: #FE21BE">Inactive</p><?php }
                                ?>
                            </div>
                        </div>
                        <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                            <li class="m-nav__separator m-nav__separator--fit"></li>
                            <li class="m-nav__section m--hide">
                                                    <span class="m-nav__section-text">
                                                        Section
                                                    </span>
                            </li>
                            <li class="m-nav__item">
                                <a href="javascript:void(0);" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-share"></i>
                                    <span class="m-nav__link-text">
                                        My strories
                                                        </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="javascript:void(0);" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                    <span class="m-nav__link-text">
                                                           Links
                                                        </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="/admin/users/resend_activation/<?php echo $user['id']?>" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-graphic-2"></i>
                                    <span class="m-nav__link-text">
                                                            Send Activation Link
                                                        </span>
                                </a>
                            </li>
                            <li class="m-nav__item">
                                <a href="javascript:void(0);" class="m-nav__link">
                                    <i class="m-nav__link-icon flaticon-time-3"></i>
                                    <span class="m-nav__link-text">
                                                           Comments
                                                        </span>
                                </a>
                            </li>
                        </ul>
                        <div class="m-portlet__body-separator"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <?php echo $this->Flash->render() ?>
                <div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                        <i class="flaticon-share m--hide"></i>
                                        Update Profile
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                        Change Password
                                    </a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                        Change Profile Image
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane active" id="m_user_profile_tab_1">
                            <?php echo $this->Form->create($user, array('name' => 'profile_form','class'=>'m-form m-form--fit m-form--label-align-right')); ?>
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                1. Personal Details
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            First Name
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('first_name', array('placeholder' => 'First Name', 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Last Name
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('last_name', array('placeholder' => 'Last name', 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            About
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('about_me', array('type'=>'textarea', 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <div class="col-10 ml-auto">
                                            <h3 class="m-form__section">
                                                2. Address
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Country
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('country', array('value' => 'USA','disabled'=>true, 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            City
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('city', array('placeholder' => 'City', 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            State
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('state_id', array('class' => 'form-control m-input', 'label' => false, 'div' => false,'options'=>$state_id)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Postcode
                                        </label>
                                        <div class="col-7">
                                            <?php echo $this->Form->control('zip_code', array('placeholder' => 'Postcode', 'class' => 'form-control m-input', 'label' => false, 'div' => false)); ?>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label for="example-text-input" class="col-2 col-form-label">
                                            Status
                                        </label>
                                        <div class="col-7">
                                            <?php
                                            //$status = [1=>'Active',2=>'Inactive'];
                                            echo $this->Form->control('status', array('class' => 'form-control m-input', 'label' => false, 'div' => false,'options'=>\Cake\Core\Configure::read('Status'))); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-7">
                                                <button type="submit" class="btn btn-brand">
                                                    Save changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php echo $this->Form->end(); ?>                    </div>
                        <div class="tab-pane " id="m_user_profile_tab_2">
                            <?php echo $this->element('Accounts/change_password');?>
                        </div>
                        <div style="padding-top: 5%;padding-left: 20%;" class="tab-pane " id="m_user_profile_tab_3">
                            <?php echo $this->element('Accounts/avatar');?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>