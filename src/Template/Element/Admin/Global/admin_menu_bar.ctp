<?php
$page = $this->request->params['controller'] . '_' . $this->request->params['action'];
$default = 'm-menu__link';
$active = 'btn btn-accent m-btn m-btn--icon m-btn--pill';
$create = 'btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill';
?>
<div class="m-header__bottom">
    <div class="m-container m-container--fluid m-container--full-height m-page__container">
        <div class="m-stack m-stack--ver m-stack--desktop">
            <!-- begin::Horizontal Menu -->
            <div class="m-stack__item m-stack__item--fluid m-header-menu-wrapper">
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-light "
                        id="m_aside_header_menu_mobile_close_btn">
                    <i class="la la-close"></i>
                </button>
                <div id="m_header_menu"
                     class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-light m-aside-header-menu-mobile--submenu-skin-light ">
                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Home' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/home/index" class="m-menu__link">
                                <span class="m-menu__link-text"> Dashboard </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/home/index"
                                           class="<?php echo $page == 'Home_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> Dshboard </span>
                                        </a>
                                    </li>
                                    <!--<li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="#" class="<?php /*echo $page == 'Home_reports' ? $active : $default; */?>">
                                            <span><i class="la la-file-pdf-o"></i><span> Reports </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="#"
                                           class="<?php /*echo $page == 'Home_userReports' ? $active : $default; */?>">
                                            <span><i class="la la-file-text-o"></i><span> User Reports </span></span>
                                        </a>
                                    </li>-->
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Users' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/users/index" class="m-menu__link">
                                <span class="m-menu__link-text"> Users </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/users/index"
                                           class="<?php echo $page == 'Users_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> View All </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/users/todays-user"
                                           class="<?php echo $page == 'Users_todaysUser' ? $active : $default; ?>">
                                            <span><i class="fa fa-plus"></i><span> Registered Today </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/users/inactive-user"
                                           class="<?php echo $page == 'Users_inactiveUsers' ? $active : $default; ?>">
                                            <span><i class="la la-user"></i><span> Inactive/Blocked Users </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/users/add"
                                           class="<?php echo $page == 'Users_add' ? $active : $create; ?>">
                                            <span><i class="fa fa-plus"></i><span> New </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Stories' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/stories/index" class="m-menu__link">
                                <span class="m-menu__link-text">
                                        Stories
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/stories/index"
                                           class="<?php echo $page == 'Stories_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> View All </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/stories/todays"
                                           class="<?php echo $page == 'Stories_todays' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> Todays Stories </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/stories/pending"
                                           class="<?php echo $page == 'Stories_pending' ? $active : $default; ?>">
                                            <span><i class="la la-newspaper-o"></i><span> Pending Stories </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/stories/stories-by-category"
                                           class="<?php echo $page == 'Stories_storiesByCategory' ? $active : $default; ?>">
                                            <span><i class="la fa-hacker-news"></i><span> Stories By Category </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/stories/all-story"
                                           class="<?php echo $page == 'Stories_allStory' ? $active : $default; ?>">
                                            <span><i class="fa fa-history"></i><span> Story Comments</span></span>
                                        </a>
                                    </li>
                                    <!-- <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="javascript:void(0);" class="<?php /*echo $page=='Stories_advancedSearch'?$active:$default; */ ?>">
                                            <span><i class="fa fa-search"></i><span> Advanced Search</span></span>
                                        </a>
                                    </li>-->
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/stories/add"
                                           class="<?php echo $page == 'Stories_add' ? $active : $create; ?>">
                                            <span><i class="fa fa-plus"></i><span> New </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'ReformIdeas' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/reform-ideas/index" class="m-menu__link">
                                <span class="m-menu__link-text">
                                        Reform Ideas
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/reform-ideas/index"
                                           class="<?php echo $page == 'ReformIdeas_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> View All </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/reform-ideas/add"
                                           class="<?php echo $page == 'ReformIdeas_add' ? $active : $create; ?>">
                                            <span><i class="fa fa-plus"></i><span> New </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Agencies' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/agencies/index" class="m-menu__link">
                                <span class="m-menu__link-text">
                                        Agencies
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/agencies/index"
                                           class="<?php echo $page == 'Agencies_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> View All </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/agencies/add"
                                           class="<?php echo $page == 'Agencies_add' ? $active : $create; ?>">
                                            <span><i class="fa fa-plus"></i><span> New </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Categories' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/categories/index" class="m-menu__link">
                                <span class="m-menu__link-text">
                                        Category
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/categories/index"
                                           class="<?php echo $page == 'Categories_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> Stories Categories </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/categories/list_categories"
                                           class="<?php echo $page == 'Categories_listCategories' ? $active : $default; ?>">
                                            <span><i class="la la-list"></i><span> User List Categories</span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/categories/add"
                                           class="<?php echo $page == 'Categories_add' ? $active : 'btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill'; ?>">
                                            <span><i class="fa fa-plus"></i><span> New</span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Ads' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/Ads/index" class="m-menu__link">
                                <span class="m-menu__link-text">
                                        Ad Manager
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/Ads/index"
                                           class="<?php echo $page == 'Ads_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list">View All</span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/Ads/add"
                                           class="<?php echo $page == 'Ads_add' ? $active : 'btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill'; ?>">
                                            <span><i class="fa fa-plus"></i><span> New </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php echo $this->request->params['controller'] == 'Referrals' ? 'm-menu__item--open-dropdown m-menu__item--hover' : ""; ?>"
                            data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/referrals/index" class="m-menu__link">
                                <span class="m-menu__link-text">
                                        Referrals
                                </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i>
                                <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/referrals/index"
                                           class="<?php echo $page == 'Referrals_index' ? $active : $default; ?>">
                                            <span><i class="m-menu__link-icon flaticon-graphic-2"></i>
                                            <span class="m-menu__link-list"> View All </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/referrals/todays_referrals"
                                           class="<?php echo $page == 'Referrals_todays_referrals' ? $active : $default; ?>">
                                            <span><span> Todays Referrals </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/referrals/add"
                                           class="<?php echo $page == 'Referrals_add' ? $active : $create; ?>">
                                            <span><i class="fa fa-plus"></i><span> New </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <?php $locationArr = array('States', 'Counties', 'Cities', 'Statezips', 'Zipcodes');
                        $controller = $this->request->params['controller'];
                        ?>
                        <li class="m-menu__item  m-menu__item--submenu m-menu__item--tabs <?php if (in_array($controller, $locationArr)) {
                            echo 'm-menu__item--open-dropdown m-menu__item--hover';
                        } ?>" data-menu-submenu-toggle="tab" aria-haspopup="true">
                            <a href="/admin/statezips/index" class="m-menu__link"><span class="m-menu__link-text"> Locations </span>
                                <i class="m-menu__hor-arrow la la-angle-down"></i> <i class="m-menu__ver-arrow la la-angle-right"></i>
                            </a>
                            <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left m-menu__submenu--tabs">
                                <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                                <ul class="m-menu__subnav">
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/statezips/index"
                                           class="<?php echo $page == 'Statezips_index' ? $active : $create; ?>">
                                            <span><i class="la la-rocket"></i><span> StateZips </span></span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/states/index"
                                           class="<?php echo $page == 'States_index' ? $active : $create; ?>">
                                            <span><i class="la la-rocket"></i><span><span> States </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/counties/index"
                                           class="<?php echo $page == 'Counties_index' ? $active : $create; ?>">
                                            <span><i class="la la-rocket"></i><span><span> counties </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/cities/index"
                                           class="<?php echo $page == 'Cities_index' ? $active : $create; ?>">
                                            <span><i class="la la-rocket"></i><span><span> Cities </span>
                                        </a>
                                    </li>
                                    <li class="m-menu__item " data-redirect="true" aria-haspopup="true">
                                        <a href="/admin/zipcodes/index"
                                           class="<?php echo $page == 'Zipcodes_index' ? $active : $create; ?>">
                                            <span><i class="la la-rocket"></i><span> Zipcodes </span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end::Horizontal Menu -->
        </div>
    </div>
</div>