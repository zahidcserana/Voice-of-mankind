<section id="content">
    <div class="container topmargin">
        <div class="row">
            <!-- Accout Content Area -->
            <div class="col-sm-12 account-area">
                <div class="tabs side-tabs tabs-bordered clearfix" id="tab-5">

                    <ul class="tab-nav clearfix">
                        <li><a href="#account"> My Account</a></li>
                        <li><a href="#mystories">My Stories</a></li>
                        <li><a href="#mycomment">My Comments</a></li>
                        <li><a href="#mylist">My List</a></li>
                    </ul>

                    <div class="tab-container">
                        <!-- My Account area start -->
                        <div class="tab-content clearfix" id="account">
                            <ul id="myTab2" class="nav account-tab nav-pills boot-tabs">
                                <li class="active"><a href="#profile" data-toggle="tab">My Profile</a></li>
                                <li><a href="#password" data-toggle="tab">Change Password</a></li>
                                <li><a href="#avatar" data-toggle="tab">Change Avatar</a></li>
                            </ul>
                            <div id="myTabContent2" class="tab-content">
                                <!-- My Profile Form-->
                                <div class="tab-pane fade in active" id="profile">
                                    <?= $this->Form->create($user, ['class' => 'button defualt-btn', 'type' => 'post']) ?>

                                    <div class="col_half">
                                        <label for="register-form-name">First Name:</label>
                                        <!--                                            <input type="text" placeholder="Name" value="" class="form-control input-form" />-->
                                        <?php echo $this->Form->control('first_name', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'First Name']);?>
                                    </div>
                                    <div class="col_half col_last">
                                        <label for="register-form-email">Last Name:</label>
                                        <!--                                            <input type="email" id="" class="form-control input-form" placeholder="Email Address" />-->
                                        <?php echo $this->Form->control('last_name', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Last Name']);?>
                                    </div>
                                    <div class="col_half">
                                        <label for="register-form-email">Email Address:</label>
                                        <!--                                            <input type="email" id="" class="form-control input-form" placeholder="Email Address" />-->
                                        <?php echo $this->Form->control('email', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Email Address']);?>
                                    </div>
                                    <div class="col_half col_last">
                                        <label for="register-form-email">City:</label>
                                        <!--                                            <input type="text" id="city" value="" class="form-control input-form" placeholder="City" />-->
                                        <?php echo $this->Form->control('city', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'City']);?>
                                    </div>
                                    <div class="col_half">
                                        <label for="register-form-email">Country:</label>
                                        <!--                                            <input type="text" id="country" value="" class="form-control input-form" placeholder="Country" />-->
                                        <?php echo $this->Form->control('country_id', ['label' => false, 'class' => 'form-control input-form','type' => 'select',
                                            'placeholder' => 'Country', 'options' => $countries, 'empty' => '-- Select Country --']);?>
                                    </div>
                                    <div class="col_half col_last">
                                        <label for="register-form-email">State:</label>
                                        <!--                                            <input type="text" id="state" value="" class="form-control input-form" placeholder="State" />-->
                                        <?php echo $this->Form->control('state_id', ['label' => false, 'class' => 'form-control input-form',
                                            'type' => 'select', 'options' => $states, 'empty' => '-- Select State --']);?>
                                    </div>
                                    <div class="col_half">
                                        <label for="register-form-email">Zipcode:</label>
                                        <!--                                            <input type="text" id="zipcode" value="" class="form-control input-form" placeholder="Zipcode" />-->
                                        <?php echo $this->Form->control('zip_code', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Zip Code']);?>
                                    </div>
                                    <div class="col_half col_last">
                                        <label for="register-form-name">Address:</label>
                                        <!--                                            <input type="text" placeholder="Address" value="" class="form-control input-form" />-->
                                        <?php echo $this->Form->control('address', ['label' => false, 'class' => 'form-control input-form', 'placeholder' => 'Address']);?>
                                    </div>
                                    <div class="col_full col_last">
                                        <label for="register-form-email">About me:</label>
                                        <!--                                            <textarea class="form-control input-form account-textarea" placeholder="About me">-->
                                        <!--                                                    </textarea>-->
                                        <?php echo $this->Form->control('about_me', ['type' => 'textarea', 'label' => false, 'class' => 'form-control input-form', 'placeholder' => 'About Me']);?>
                                    </div>
                                    <div class="col_full nobottommargin">
                                        <button class="button defualt-btn" id="submit" value="register" type="submit">Submit</button>
                                    </div>
                                    <?php echo $this->Form->end();?>
                                </div>
                                <!-- / My Profile -->

                                <!-- Change Password -->
                                <div class="tab-pane fade" id="password">
                                    <form id="register-form" name="register-form" class="nobottommargin" action="#" method="post">
                                        <div class="col-md-6 col-sm-7 col-xs-12">
                                            <div class="col_full">
                                                <label for="register-form-name">Old Password:</label>
                                                <input type="password" placeholder="Old Password" id="name" value="" class="form-control input-form" />
                                            </div>
                                            <div class="col_full">
                                                <label for="register-form-name">New Password:</label>
                                                <input type="password" placeholder="New Password" id="name" class="form-control input-form" />
                                            </div>
                                            <div class="col_full">
                                                <label for="register-form-name">Confirm Password:</label>
                                                <input type="password" placeholder="Confirm Password" id="name" class="form-control input-form" />
                                            </div>
                                            <div class="col_full nobottommargin">
                                                <button class="button defualt-btn" id="submit" value="register">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- / Change Password -->

                                <!-- Change Avatar -->
                                <div class="tab-pane fade" id="avatar">
                                    <form>
                                        <div class="form-group col-xs-12 nopadding">
                                            <input type="file" name="file-1[]" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
                                            <label for="file-1">
                                                <span>Change Your Image</span>
                                            </label>
                                        </div>
                                        <div class="form-group col-xs-12 nopadding">
                                            <a href="#" class="button comnt-btn defualt-btn pull-right">Submit </a>
                                        </div>
                                    </form>
                                </div>
                                <!-- / Change Avatar -->
                            </div>
                        </div>
                        <!-- / My Account area End -->

                        <!-- My Stories -->
                        <div class="tab-content clearfix" id="mystories">
                            <!-- create new button area -->
                            <a href="#" class="button comnt-btn defualt-btn pull-right create-btn">Create New Story </a>

                            <div id="posts" class="col_full stories-left-side small-thumbs">
                                <!-- Account strories blog box -->
                                <div class="entry clearfix striese-blog-area">
                                    <div class="entry-image">
                                        <a href="img/17.jpg" data-lightbox="image"><img class="image_fade" src="img/blog3.jpeg" alt="Standard Post with Image"></a>
                                    </div>
                                    <div class="entry-c blog-body">
                                        <div class="entry-title">
                                            <h2><a href="#">The standard chunk of Lorem Ipsum </a></h2>
                                        </div>
                                        <ul class="entry-meta clearfix">
                                            <li><i class="fa fa-list"></i> Category</li>
                                            <li><i class="fa fa-th-large"></i> Referred To </li>
                                            <li><i class="fa fa-plus-square"></i> Created add</li>
                                        </ul>
                                        <div class="entry-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt,</p>
                                            <a href="blog-single.html"class="more-link">Read More</a>
                                            <span>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- / Account strories blog box -->

                                <!-- Account strories blog box -->
                                <div class="entry clearfix striese-blog-area">
                                    <div class="entry-image">
                                        <a href="img/17.jpg" data-lightbox="image"><img class="image_fade" src="img/blog3.jpeg" alt="Standard Post with Image"></a>
                                    </div>
                                    <div class="entry-c blog-body">
                                        <div class="entry-title">
                                            <h2><a href="#">The standard chunk of Lorem Ipsum </a></h2>
                                        </div>
                                        <ul class="entry-meta clearfix">
                                            <li><i class="fa fa-list"></i> Category</li>
                                            <li><i class="fa fa-th-large"></i> Referred To </li>
                                            <li><i class="fa fa-plus-square"></i> Created add</li>
                                        </ul>
                                        <div class="entry-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt,</p>
                                            <a href="blog-single.html"class="more-link">Read More</a>
                                            <span>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- / Account strories blog box -->
                                <!-- Account strories blog box -->
                                <div class="entry clearfix striese-blog-area">
                                    <div class="entry-image">
                                        <a href="img/17.jpg" data-lightbox="image"><img class="image_fade" src="img/blog3.jpeg" alt="Standard Post with Image"></a>
                                    </div>
                                    <div class="entry-c blog-body">
                                        <div class="entry-title">
                                            <h2><a href="#">The standard chunk of Lorem Ipsum </a></h2>
                                        </div>
                                        <ul class="entry-meta clearfix">
                                            <li><i class="fa fa-list"></i> Category</li>
                                            <li><i class="fa fa-th-large"></i> Referred To </li>
                                            <li><i class="fa fa-plus-square"></i> Created add</li>
                                        </ul>
                                        <div class="entry-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, asperiores quod est tenetur in. Eligendi, deserunt,</p>
                                            <a href="blog-single.html"class="more-link">Read More</a>
                                            <span>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                    <i class="icon-star3"></i>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Account strories blog box -->
                            </div>
                        </div>
                        <!-- / My Stories -->

                        <!-- My Comments Area-->
                        <div class="tab-content clearfix" id="mycomment">
                            <div class="row">

                                <!-- Comment Textarea area box -->
                                <div class="col-sm-12 stories-details-comment-area nopadding">
                                    <div class="heading-block">
                                        <h3>Comment</h3>
                                    </div>
                                    <form>
                                        <textarea name="comment" class="form-control comnt-box" placeholder="Comment Here...."></textarea>
                                        <a href="#" class="button button-xlarge tright comnt-btn">Submit</a>
                                    </form>
                                </div>

                                <!-- Comment Show Area -->
                                <div class="col-sm-12 stories-details-comment-show nopadding">
                                    <div class="heading-block">
                                        <h3>4 Comment</h3>
                                    </div>
                                    <!-- Comment box show -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">John Stive <span>Jan 3rd, 2018</span></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-9 comnt-left-side nobottommargin">
                                                <div class="author-image">
                                                    <img src="img/people1.png" alt="" class="">
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eveniet, eligendi et nobis neque minus mollitia sit repudiandae ad repellendus recusandae blanditiis praesentium vitae fugit.
                                                </p>
                                            </div>
                                            <div class="col-sm-3 comnt-right-side">
                                                <a href="#" class="button button-mini tright delete-btn">Delete</a>
                                                <a href="#" class="button button-mini tright delete-btn">Edit</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Comment box show -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">John Stive <span>Jan 3rd, 2018</span></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-9 comnt-left-side nobottommargin">
                                                <div class="author-image">
                                                    <img src="img/people1.png" alt="" class="">
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eveniet, eligendi et nobis neque minus mollitia sit repudiandae ad repellendus recusandae blanditiis praesentium vitae fugit.
                                                </p>
                                            </div>
                                            <div class="col-sm-3 comnt-right-side">
                                                <a href="#" class="button button-mini tright delete-btn">Delete</a>
                                                <a href="#" class="button button-mini tright delete-btn">Edit</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Comment box show -->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">John Stive <span>Jan 3rd, 2018</span></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-sm-9 comnt-left-side nobottommargin">
                                                <div class="author-image">
                                                    <img src="img/people1.png" alt="" class="">
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores, eveniet, eligendi et nobis neque minus mollitia sit repudiandae ad repellendus recusandae blanditiis praesentium vitae fugit.
                                                </p>
                                            </div>
                                            <div class="col-sm-3 comnt-right-side">
                                                <a href="#" class="button button-mini tright delete-btn">Delete</a>
                                                <a href="#" class="button button-mini tright delete-btn">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- / My Comments -->

                        <!-- My List Start -->
                        <div class="tab-content clearfix" id="mylist">
                            <a href="#" class="button comnt-btn defualt-btn pull-right create-btn"> Add New </a>
                            <table class="table table-bordered" style="clear: both">
                                <tbody>
                                <div class="heading-block heading-area">
                                    <h3>Category Name</h3>
                                </div>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List2</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List2</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List3</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List3</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List4</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List4</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered" style="clear: both">
                                <tbody>
                                <div class="heading-block heading-area">
                                    <h3>Category Name</h3>
                                </div>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter Category list">Category List</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List2</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List2</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List3</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List3</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List4</a>
                                    </td>
                                    <td>
                                        <a href="#" class="bt-editable" data-type="text" data-placement="right" data-pk="1" data-title="Enter username">Category List4</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- / My List -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
