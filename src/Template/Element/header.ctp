<header id="header" class="semi-transparent full-header">
    <div id="header-wrap">
        <nav id="primary-menu" class="style-2">
            <div class="container clearfix">
                <div id="primary-menu-trigger">
                    <i class="icon-reorder"></i>
                </div>
                <ul>
                    <li>
                        <?php echo $this->Html->link(__('Home'), ['controller' => 'stories', 'action' => 'index']);?>
                    </li>
                    <li class="current">
                        <a href="#">
                            <div>Our Mission</div>
                        </a>
                    </li>
                    <li>
                        <?php echo $this->Html->link(__('Stories'), ['controller' => 'stories', 'action' => 'index']);?>
                    </li>
                    <li>
                        <?php echo $this->Html->link(__('Contact Us'), ['controller' => 'stories', 'action' => 'index']);?>
                    </li>
                    <li>
                        <?php echo $this->Html->link(__('Sign Up'), ['controller' => 'users', 'action' => 'signup']);?>
                    </li>
                </ul>

                <div id="top-search">
                    <a href="#" id="top-search-trigger">
                        <i class="icon-search3"></i>
                        <i class="icon-line-cross"></i>
                    </a>
                    <form action="search.html" method="get">
                        <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter..">
                    </form>
                </div>
            </div>

        </nav>
    </div>

</header>