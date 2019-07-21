<div class="m-grid m-grid--hor m-grid--root m-page">
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-5"
         id="m_login" style="background-image: url(/img/bg/3.jpg);">
        <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
            <div class="m-login__container">
                <div class="m-login__logo" style="margin-bottom: 20px;">
                    <a href="#">
                        <img src="/img/logo-new.png" width="300px">
                    </a>
                </div>
                <div class="m-login__signin">
                    <div class="">
                        <h2 class="m-login__title text-center">
                            Sign In To Admin
                        </h2>
                    </div>
                    <div class="main_page_content" id="Admin_login">
                        <?php echo $this->Form->create('User', array('name' => 'Admin_login', 'class' => 'm-login__form m-form')); ?>
                        <?php echo $this->Flash->render(); ?>
                        <div class="alert alert-danger display-hide" style="display: none">
                            <button class="close" data-close="alert"></button>
                            <span>Enter your email and password. </span>
                        </div>

                        <?php
                        echo $this->Form->input('email', [
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control m-input',
                            'type' => 'text',
                            'placeholder' => 'Email',
                            'templates' => [
                                'inputContainer' => '<div class="m-form__group">{{content}}</div>',
                            ]
                        ]);
                        ?>
                        <?php
                        echo $this->Form->input('password', [
                            'label' => false,
                            'div' => false,
                            'class' => 'form-control m-input m-login__form-input--last',
                            'type' => 'password',
                            'placeholder' => 'Password',
                            'templates' => [
                                'inputContainer' => '<div class="m-form__group">{{content}}</div>',
                            ]
                        ]);
                        ?>
                        <div align="center" style="padding-top: 4%;" class="g-recaptcha"
                             data-sitekey="6LfdGEgUAAAAAJ8u1mzup0cN_lbheyPjyvO7zIDa"></div>
                        <!--<div align="center" style="padding-top: 4%;" class="g-recaptcha" data-sitekey="6LdmPUUUAAAAABE7cr10LOpWRz6YBRB8bBEJsEPE"></div>-->
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <!--<label class="m-checkbox  m-checkbox--light">
                                    <input type="checkbox" name="remember">
                                    Remember me
                                    <span></span>
                                </label>-->
                            </div>
                            <!--<div class="col m--align-right m-login__form-right">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Forget Password ?
                                </a>
                            </div>-->
                        </div>
                        <div class="m-login__form-action">
                            <button type="submit"
                                    class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary"
                                    name="login" value="login">
                                Sign In
                            </button>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>

                    <!--<form class="m-login__form m-form" action="">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="row m-login__form-sub">
                            <div class="col m--align-left m-login__form-left">
                                <label class="m-checkbox  m-checkbox--light">
                                    <input type="checkbox" name="remember">
                                    Remember me
                                    <span></span>
                                </label>
                            </div>
                            <div class="col m--align-right m-login__form-right">
                                <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                    Forget Password ?
                                </a>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary">
                                Sign In
                            </button>
                        </div>
                    </form>-->
                </div>
                <!--<div class="m-login__signup">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Sign Up
                        </h3>
                        <div class="m-login__desc">
                            Enter your details to create your account:
                        </div>
                    </div>
                    <form class="m-login__form m-form" action="">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Fullname" name="fullname">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="password" placeholder="Password" name="password">
                        </div>
                        <div class="form-group m-form__group">
                            <input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="rpassword">
                        </div>
                        <div class="row form-group m-form__group m-login__form-sub">
                            <div class="col m--align-left">
                                <label class="m-checkbox m-checkbox--light">
                                    <input type="checkbox" name="agree">
                                    I Agree the
                                    <a href="#" class="m-link m-link--focus">
                                        terms and conditions
                                    </a>
                                    .
                                    <span></span>
                                </label>
                                <span class="m-form__help"></span>
                            </div>
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_signup_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Sign Up
                            </button>
                            &nbsp;&nbsp;
                            <button id="m_login_signup_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
                <div class="m-login__forget-password">
                    <div class="m-login__head">
                        <h3 class="m-login__title">
                            Forgotten Password ?
                        </h3>
                        <div class="m-login__desc">
                            Enter your email to reset your password:
                        </div>
                    </div>
                    <form class="m-login__form m-form" action="">
                        <div class="form-group m-form__group">
                            <input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
                        </div>
                        <div class="m-login__form-action">
                            <button id="m_login_forget_password_submit" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">
                                Request
                            </button>
                            &nbsp;&nbsp;
                            <button id="m_login_forget_password_cancel" class="btn m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn">
                                Cancel
                            </button>
                        </div>
                    </form>

                </div>
                <div class="m-login__account">
                    <span class="m-login__account-msg">
                        Don't have an account yet ?
                    </span>
                    &nbsp;&nbsp;
                    <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                        Sign Up
                    </a>
                </div>-->
            </div>
        </div>
    </div>
</div>
<style>
    .m-login.m-login--2 .m-login__wrapper{padding:4% 2rem 1rem 2rem;}
    .m-login.m-login--2 .m-login__wrapper .m-login__container{
        box-shadow: 1px 1px 6px 2px #ccc;
        padding: 30px 30px 2px 30px;
        /*width: 500px;*/
    }

    .m-login.m-login--2 .m-login__wrapper .m-login__container .m-login__form .m-form__group .form-control{
        border-radius: 10px;border: 1px solid #ebedf2;}
</style>