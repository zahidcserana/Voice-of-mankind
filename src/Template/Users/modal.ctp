<div class="main_page_content" id="User_register">
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <ul id="" class="nav nav-tabs">
                        <li class="nav-item register"><a href="" data-target="#register" data-toggle="tab"
                                                         class="nav-link small text-uppercase active"><?php echo __('modal_reg'); ?></a></li>
                        <li class="nav-item login"><a href="" data-target="#login" data-toggle="tab"
                                                      class="nav-link small text-uppercase"><?php echo __('modal_login'); ?></a></li>
                    </ul>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span> <img src="/img/close-icon.png" width="35px"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div id="tabsJustifiedContent" class="tab-content">
                            <div class="alert alert-danger" style="display: none" id="err-msg"> </div>
                            <div class="alert alert-success" style="display: none" id="success-msg"></div>

                            <div id="register" class="tab-pane fade active show">
                                <form id="regForm" method="get" action="">
                                    <input type="hidden" id="application" value="0">
                                    <div id="apply_candidate" style="display: none">
                                        <label  class="control-label"><?php echo  __('apply_for').' '.'Candidate';?></label><br><br>
                                        <input type="hidden" name="group_id" value="3">
                                    </div>
                                    <div id="apply_researcher" style="display: none">
                                        <label  class="control-label"><?php echo  __('apply_for').' '.'Researcher';?></label><br><br>
                                        <input type="hidden" name="group_id" value="2">
                                    </div>
                                    <div class="form-group required" id="apply_both">
                                        <label  class="control-label"><?php echo  __('apply_for');?></label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="group_id"
                                                       id="researcher" value="2"><?php echo  __('researcher');?>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <label class="form-check-label">
                                                <input class="form-check-input" type="radio" name="group_id"
                                                       id="candidate" value="3" checked><?php echo  __('candidate');?>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                <label for="name" class="control-label"><?php echo  __('first_name');?></label>
                                                <input type="text" id="fname" name="first_name" placeholder="Enter First Name"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                <label for="name" class="control-label"><?php echo  __('last_name');?></label>
                                                <input type="text" id="lname" name="last_name" placeholder="Enter Last Name"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                <label for="email" class="control-label"><?php echo  __('email');?></label>
                                                <input type="email" id="user_email" name="email" placeholder="Enter Email"
                                                       class="form-control required email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                <label for="sex" class="control-label"><?php echo  __('sex');?></label>
                                                <br>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input checked class="form-check-input" type="radio" name="gender" id="male"
                                                               value="Man"> <?php echo  __('male');?>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input class="form-check-input" type="radio" name="gender" id="female"
                                                               value="Kvinna"> <?php echo  __('female');?>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group required">
                                            <label for="dob" class="control-label"><?php echo  __('birthdate');?></label>
                                            <br>
                                            <select name="year" id="ApplicantBirthdateYear">
                                                <?php for ($i=date('Y');$i>date('Y')-100;$i--) { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>
                                            -
                                            <select name="month" id="ApplicantBirthdateMonth">
                                                <?php foreach (\Cake\Core\Configure::read('month') as $i=>$value) { ?>
                                                    <option value="<?php echo $i;?>"><?php echo $value;?></option>
                                                <?php } ?>
                                            </select>
                                            -
                                            <select name="day" id="ApplicantBirthdateDay">
                                                <?php for ($i=1;$i<32;$i++) { ?>
                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                <?php } ?>
                                            </select>

                                            <!--<input type="text" class="form-control datepicker" name="birthdate" id="birthdate" placeholder="Enter Date of Birth" required>-->
                                        </div>



                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                <label class="control-label" for="password"><?php echo  __('password');?></label>
                                                <?php echo $this->Form->control('password',array('label'=>false,'id'=> 'password','class'=>'form-control','placeholder'=>'Enter Password' , 'required','type'=>'password'));?>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group required">
                                                <label class="control-label" for="password"><?php echo  __('cpassword');?></label>
                                                <?php echo $this->Form->control('cpassword',array('label'=>false,'id'=> 'cpassword','class'=>'form-control','placeholder'=>'Confirm Password' , 'required','type'=>'password'));?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group required" id="location">
                                        <label class="control-label" for="location"><?php echo  __('location');?></label>
                                        <div class="row city_interest">
                                            <?php $t=0;
                                            $cities = \Cake\Core\Configure::read('cities');
                                            $count = count($cities);
                                                foreach ($cities as $key=>$value){?>
                                                    <div class="form-check col-md-6">
                                                        <label class="form-check-label">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="interestedCity[]"   value="<?php echo $key?>"> <?php echo $value?>
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>

                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <ul id="trigger" class="nav nav-tabs">
                                            <input type="hidden" value="2" name="status" />
                                            <input class="submit btn btn-full-orange" type="submit" id="reg-submit"
                                                   value="<?php echo __('modal_reg') ?>">

                                          <!--  <li class="nav-item" style="position: fixed; top: 100000px; right: 100000px; opacity: 0"><a
                                                        href="" data-target="#next" data-toggle="tab"
                                                        class="btn btn-primary">Register</a>
                                            </li>-->
                                            <div id="loading_reg" style="display: none;text-align: center;">
                                                <i class="fa fa-refresh fa-spin fa-2x fa-fw" ></i>
                                                <br><?php echo __('sidebar_13'); ?>...
                                                <!-- <span class="sr-only">Loading...</span> -->
                                            </div>
                                        </ul>
                                    </div>
                                </form>
                            </div>

                            <div id="next" class="tab-pane fade">
                               <!-- <div id="loading_apply" style="display: none;text-align: center;">
                                    <i class="fa fa-refresh fa-spin fa-5x fa-fw" ></i>
                                    <br>Loading...
                                </div>
                                <div class="alert alert-danger" style="display: none" id="apply_err-msg"> </div>
                                <div class="alert alert-success" style="display: none" id="apply_success-msg"></div>
                                <form id="applyNow" method="get" action="">
                                    <input type="hidden" id="study_id" value="<?php /*echo $research['id']*/?>">
                                    <div class="form-group">
                                        <label for="name"><?php /*echo  __('message');*/?></label>
                                        <br>
                                        <input type="textarea" name="message" id="message" class="form-control col-12">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" class="checkbox" id="subscribe" name="subscribe"
                                               required>
                                        Jag vill bli meddelad på min email när det kommer en ny studie
                                    </div>

                                    <div class="row justify-content-center">
                                        <button class="btn btn-full-orange" id="tearm-submit" type="submit">Submit
                                        </button>
                                    </div>
                                </form>-->
                            </div>

                            <div id="login" class="tab-pane fade">

                                <div id="msg_div" class="alert alert-warning" style="display: none">

                                </div>
                                <form id="login-form" method="get" action="">
                                    <div class="form-group required">
                                        <label class="control-label" for="email"><?php echo  __('email');?></label>
                                            <?php echo $this->Form->control('email', array('label' => false ,'id'=>"email_login", 'class' => 'form-control' ,'placeholder'=>"Enter Email",'required','type'=>'text')); ?>
                                    </div>
                                    <div class="form-group required">
                                        <label class="control-label" for="password"><?php echo  __('password');?></label>
                                        <?php echo $this->Form->control('password',array('label'=>false,'id'=>'password_login','class'=>'form-control','placeholder'=>'Enter Password' , 'required'));?>
                                    </div>
                                    <div class="row justify-content-center">
                                        <button class="btn btn-full-orange" id="login-submit" type="submit"><?php echo __('modal_login'); ?>
                                        </button>
                                        <a style="padding-left: 26%;padding-top: 3%;" href="/users/forgetpassword"><?php echo  __('forget_password');?></a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
