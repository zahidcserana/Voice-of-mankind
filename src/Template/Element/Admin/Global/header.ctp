<header class="m-grid__item	m-header " data-minimize="minimize" data-minimize-mobile="minimize"
        data-minimize-offset="10" data-minimize-mobile-offset="10">
    <div class="m-header__top">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-brand m-stack__item--left">
                    <div class="m-stack m-stack--ver m-stack--general m-stack--inline">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="/admin/home" class="m-brand__logo-wrapper">
                                <img alt="" src="/img/logo.png"
                                     class="m-brand__logo-desktop" height="70"/>
                                <img alt="" src="/img/logo_mini.png"
                                     class="m-brand__logo-mobile" width="30px" height="30px"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="m-stack__item m-stack__item--right m-header-head" id="m_header_nav">
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">
                                <li class="
	m-nav__item m-nav__item--focus m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light"
                                    data-dropdown-toggle="click" data-dropdown-persistent="true" id="m_quicksearch"
                                    data-search-type="dropdown">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
													<span class="m-nav__link-icon">
														<span class="m-nav__link-icon-wrapper">
															<i class="flaticon-search-1"></i>
														</span>
													</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                        <div class="m-dropdown__inner ">
                                            <div class="m-dropdown__header">
                                                <form class="m-list-search__form">
                                                    <div class="m-list-search__form-wrapper">
																	<span class="m-list-search__form-input-wrapper">
																		<input id="m_quicksearch_input"
                                                                               autocomplete="off" type="text" name="q"
                                                                               class="m-list-search__form-input"
                                                                               value="" placeholder="Search...">
																	</span>
                                                        <span class="m-list-search__form-icon-close"
                                                              id="m_quicksearch_close">
																		<i class="la la-remove"></i>
																	</span>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__scrollable m-scrollable"
                                                     data-max-height="300" data-mobile-max-height="200">
                                                    <div class="m-dropdown__content"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>


                                <li id="m_quick_sidebar_toggle"
                                    class="m-nav__item m-nav__item--info m-nav__item--qs">
                                    <a title="logout" href="/users/logout" class="m-nav__link m-dropdown__toggle">
													<span class="m-nav__link-icon m-nav__link-icon-alt">
														<span class="m-nav__link-icon-wrapper">
															<i class="flaticon-logout"></i>
														</span>
													</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end::Topbar -->
            </div>
        </div>
    </div>
    <?php echo $this->element('Admin' . DS . 'Global' . DS . 'admin_menu_bar'); ?>
</header>