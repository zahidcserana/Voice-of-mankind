<div class="row">
    <div class="col-xl-6 col-lg-12">
        <?php echo $this->Flash->render(); ?>
        <!--Begin::Portlet-->
        <div class="m-portlet  m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Summary
                        </h3>
                    </div>
                </div>
            </div>
            <!--<div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-5 report">
                        <div class="report-div">
                            Total Story <br><h1 class="report-count"><?php /*echo $totalStory;*/ ?></h1>
                        </div>
                    </div>
                    <div class="col-md-5 report">
                        <div class="report-div">
                            Today's Story <br><h1 class="report-count"><?php /*echo $todayStory;*/ ?></h1>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5 report">
                        <div class="report-div">
                            Actaive Users <br><h1 class="report-count"><?php /*echo $activeUser;*/ ?></h1>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="">
                        </div>
                    </div>
                </div>
            </div>-->
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-6">
                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <a href="/admin/stories/index">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        Total Story
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-brand">
				           <?php echo $totalStory; ?>
				                </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width:100%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::New Feedbacks-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <a href="/admin/stories/todays">
                                    <h4 class="m-widget24__title">
                                        Today's Story
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-info">
                                    <?php echo $todayStory; ?>
                                </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end::New Feedbacks-->
                    </div>
                </div>
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-6">
                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <a href="/admin/users/index">
                                    <h4 class="m-widget24__title">
                                        Actaive Users
                                    </h4><br>
                                    <span class="m-widget24__stats m--font-brand">
                                    <?php echo $activeUser; ?>
                                </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: 100%;"
                                             aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <!--end::Total Profit-->
                    </div>
                    <!--<div class="col-md-6">
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">
                                    New Feedbacks
                                </h4><br>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-info" role="progressbar" style="width: 100%;"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>-->
                </div>
            </div>
        </div>
        <!--End::Portlet-->
    </div>
    <div class="col-xl-6 col-lg-12">
        <!--Begin::Portlet-->
        <div class="m-portlet m-portlet--full-height ">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Recent Notifications
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm"
                        role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_widget2_tab1_content"
                               role="tab">
                                Today
                            </a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_widget2_tab2_content"
                               role="tab">
                                Month
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="tab-content">
                    <div class="tab-pane active" id="m_widget2_tab1_content">
                        <!--Begin::Timeline 3 -->
                        <div class="m-timeline-3">
                            <div class="m-timeline-3__items">
                                <div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time">
																09:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit,consectetur eiusmdd tempor
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Bob
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--warning">
															<span class="m-timeline-3__item-time">
																10:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Sean
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time">
																11:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit eiusmdd tempor
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--success">
															<span class="m-timeline-3__item-time">
																12:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--danger">
															<span class="m-timeline-3__item-time">
																14:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit,consectetur eiusmdd
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Derrick
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time">
																15:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit amit,consectetur
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Iman
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time">
																17:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem ipsum dolor sit consectetur eiusmdd tempor
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Aziko
																	</a>
																</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Timeline 3 -->
                    </div>
                    <div class="tab-pane" id="m_widget2_tab2_content">
                        <!--Begin::Timeline 3 -->
                        <div class="m-timeline-3">
                            <div class="m-timeline-3__items">
                                <div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time m--font-focus">
																09:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Contrary to popular belief, Lorem Ipsum is not simply random text.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Bob
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--warning">
															<span class="m-timeline-3__item-time m--font-warning">
																10:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	There are many variations of passages of Lorem Ipsum available.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Sean
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time m--font-primary">
																11:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Contrary to popular belief, Lorem Ipsum is not simply random text.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--success">
															<span class="m-timeline-3__item-time m--font-success">
																12:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	The standard chunk of Lorem Ipsum used since the 1500s is reproduced.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By James
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--danger">
															<span class="m-timeline-3__item-time m--font-warning">
																14:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Latin words, combined with a handful of model sentence structures.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Derrick
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--info">
															<span class="m-timeline-3__item-time m--font-info">
																15:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Contrary to popular belief, Lorem Ipsum is not simply random text.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Iman
																	</a>
																</span>
                                    </div>
                                </div>
                                <div class="m-timeline-3__item m-timeline-3__item--brand">
															<span class="m-timeline-3__item-time m--font-danger">
																17:00
															</span>
                                    <div class="m-timeline-3__item-desc">
																<span class="m-timeline-3__item-text">
																	Lorem Ipsum is therefore always free from repetition, injected humour.
																</span>
                                        <br>
                                        <span class="m-timeline-3__item-user-name">
																	<a href="#"
                                                                       class="m-link m-link--metal m-timeline-3__item-link">
																		By Aziko
																	</a>
																</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End::Timeline 3 -->
                    </div>
                </div>
            </div>
        </div>
        <!--End::Portlet-->
    </div>
</div>

<style>
    .report {
        background-color: #34bfa3;
        height: 150px;
        margin: 2%;
        border-radius: 3%;
    }

    .report .report-div .report-count {
        padding: 2% 0 0 19%;
        font-size: 35px;
    }

    .report .report-div {
        font-size: 20px;
        margin: 15% 0 0 16%;
    }
</style>