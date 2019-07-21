<header id="header" class="transparent-header header dark no-sticky">
    <div id="header-wrap">
        <div class="container clearfix">
            <div id="mySidenav" class="sidenav-menu">
                <div class="menu-close-bar">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                </div>
                <div class="sidemenu">
                    <ul>
                        <li class="current"><?php echo $this->Html->link(__('Home'), ['controller' => 'Home', 'action' => 'index']); ?></li>
                        <li>
                            <?php
                            echo $this->Html->link(__('Stories'), [
                                'controller' => 'stories', 'action' => 'index',
                                '?' => ['state_id' => isset($_COOKIE['userState']) == true ? $_COOKIE['userState'] : 10, 'county_id' => isset($_COOKIE['userCounty']) == true ? $_COOKIE['userCounty'] : 657]]);
                            ?>
                        </li>
                        <li><?php echo $this->Html->link(__('Create Story'), ['controller' => 'stories', 'action' => 'add']); ?></li>
                        <li>
                            <?php
                            echo $this->Html->link(__('Reform Ideas'), [
                                'controller' => 'reform-ideas', 'action' => 'index',
                                '?' => ['state_id' => isset($_COOKIE['userState']) == true ? $_COOKIE['userState'] : 10, 'county_id' => isset($_COOKIE['userCounty']) == true ? $_COOKIE['userCounty'] : 657]]);
                            ?>
                        </li>
                        <li><?php echo $this->Html->link(__('About Us'), ['controller' => 'home', 'action' => 'about']); ?></li>
                        <li><?php echo $this->Html->link(__('Contact Us'), ['controller' => 'pages', 'action' => 'contact-us']); ?></li>
                        <?php
                        if (isset($loggedinUser)) { ?>
                            <li>
                                <?php
                                echo $this->Html->link(__('My Account'), ['controller' => 'users', 'action' => 'my-profile']);
                                ?>
                            </li>
                            <li>
                                <?php
                                echo $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout']);
                                ?>
                            </li>
                            <?php
                        } else { ?>
                            <li>
                                <?php
                                echo $this->Html->link(__('Login'), ['controller' => 'users', 'action' => 'login']);
                                ?>
                            </li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
            <!-- Side bar menu open-->
            <span class="sidemenubar" onclick="openNav()">
                        <i class="fa fa-bars"></i>
                    </span>

            <!-- Logo -->
            <div id="logo">
                <a href="/" class="logo-area">
                    <img src="/img/new-logo.png" alt="voice Logo">
                </a>
            </div>
            <!-- / logo end -->

            <!--  Navigation -->
            <nav id="primary-menu">
                <ul>
                    <li class="current"><?php echo $this->Html->link(__('Home'), ['controller' => 'Home', 'action' => 'index']); ?></li>
                    <li>
                        <?php
                        echo $this->Html->link(__('Stories'), [
                            'controller' => 'stories', 'action' => 'index',
                            '?' => ['state_id' => isset($_COOKIE['userState']) == true ? $_COOKIE['userState'] : 10, 'county_id' => isset($_COOKIE['userCounty']) == true ? $_COOKIE['userCounty'] : 657]]);
                        ?>
                    </li>
                    <li><?php echo $this->Html->link(__('Create Story'), ['controller' => 'stories', 'action' => 'add']); ?></li>
                    <li>
                        <?php
                        echo $this->Html->link(__('Reform Ideas'), [
                            'controller' => 'reform-ideas', 'action' => 'index',
                            '?' => ['state_id' => isset($_COOKIE['userState']) == true ? $_COOKIE['userState'] : 10, 'county_id' => isset($_COOKIE['userCounty']) == true ? $_COOKIE['userCounty'] : 657]]);
                        ?>
                    </li>
                    <li><?php echo $this->Html->link(__('About Us'), ['controller' => 'home', 'action' => 'about']); ?></li>
                    <!--<li><?php /*echo $this->Html->link(__('Our Mission'), ['controller' => 'pages', 'action' => 'our-mission']); */ ?></li>-->
                    <li><?php echo $this->Html->link(__('Contact Us'), ['controller' => 'pages', 'action' => 'contact-us']); ?></li>
                    <?php
                    if (isset($loggedinUser)) { ?>
                        <li>
                            <?php
                            echo $this->Html->link(__('My Account'), ['controller' => 'users', 'action' => 'my-profile']);
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout']);
                            ?>
                        </li>
                        <?php
                    } else { ?>
                        <li>
                            <?php
                            echo $this->Html->link(__('Login'), ['controller' => 'users', 'action' => 'login']);
                            ?>
                        </li>
                    <?php }
                    ?>
                </ul>
            </nav>

        </div>

    </div>

</header>
<!-- #header end -->

