<div>
	 <section id="page-title" class="page-title-pattern">
        <div class="container clearfix">
            <h1>Login</h1>
        </div>
    </section>
    <section id="content" style="margin-bottom: 0px;">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_third nobottommargin">
						<?=$this->Flash->render();?>
						<div class="well well-lg nobottommargin">
							<form id="login-form" name="login-form" class="nobottommargin" action="/users/login" method="post">

								<h3>Login to your Account</h3>
								<div class="col_full">
									<div class="loginError text-danger" >

									</div>
								</div>
								<div class="col_full">
									<label for="login-form-username">Email:</label>
									<input type="text" id="login-form-username" name="email" value="" class="form-control">
								</div>

								<div class="col_full">
									<label for="login-form-password">Password:</label>
									<input type="password" id="login-form-password" name="password" value="" class="form-control">
								</div>

								<div class="col_full bottommargin">
									<button class="button button-3d nomargin" type="submit" id="login-form-submit" name="login-form-submit" value="login">Login</button>
									<a href="/forgot_password" class="fright">Forgot Password?</a>
								</div>
							</form>
						</div>

					</div>

					<div class="col_two_third col_last nobottommargin">

						<h3>Don't have a Dealer Account? Register Now.</h3>
						<div  class=" register_success col_full">

						</div>
                        <div class="main_page_content" id="user_account">
                            <?php echo $this->Form->create('Users',array('id'=>'add-user','url'=>'/users/signup'));?>
                                <div class="col_half">
                                    <label for="register-form-name">First Name:</label>
                                    <?php echo $this->Form->input('first_name', array( 'type'=>'text','placeholder' => 'Name','class' => 'form-control',
                                        'label' => false, 'div' => false,'id'=>'login-form-first-name')); ?>							    </div>
                                </div>

                                <div class="col_half">
                                    <label for="register-form-name">Last Name:</label>
                                    <?php echo $this->Form->input('last_name', array( 'type'=>'text','placeholder' => 'Name','class' => 'form-control',
                                        'label' => false, 'div' => false,'id'=>'login-form-last-name')); ?>
                                </div>

                                <div class="clear"></div>

                                <div class="col_half">
                                        <label for="register-form-name">Email:</label>
                                        <?php echo $this->Form->input('email', array( 'type'=>'text','placeholder' => 'Email','class' => 'form-control',
                                            'label' => false, 'div' => false,'id'=>'login-form-email')); ?>
                                </div>

                                <div class="col_half">
                                    <label for="register-form-username">Password:</label>
                                    <?php echo $this->Form->input('password', array( 'type'=>'password','class' => 'form-control', 'label' => false, 'div' => false,'id'=>'login-form-password')); ?>
                                </div>

                                <div class="col_half col_last">
                                    <label for="register-form-password">Confirm Password:</label>
                                    <?php echo $this->Form->input('confirm_password', array( 'type'=>'password','class' => 'form-control', 'label' => false, 'div' => false,'id'=>'login-form-confirm-password')); ?>
                                </div>

                                <div class="clear"></div>

                                <div class="col_full nobottommargin">
                                    <button class="button button-3d button-black nomargin" id="login-form-submit" name="login-form-submit" type="submit">Register Now</button>
                                </div>

                            <?php echo $this->Form->end();?>
                        </div>
					</div>

				</div>

			</div>

		</section>
</div>