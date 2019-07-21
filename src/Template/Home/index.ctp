<section class="page-section topmargin-sm bottommargin-sm homepage-section voice-people">
    <div class="container-fluid clearfix">
        <div class="heading-block center shpm-title">
            <h2>We are your Voice</h2>
            <span>We are the voice of working class people</span>
        </div>
        <div class="col_full notopmargin">
            <img src="http://demo.leapinglogic.com/vom/banner.jpg">
        </div>
    </div>
</section>

<section class="home-mission">
    <div class="container clearfix">
        <div class="col_one_third bottommargin-sm topmargin-sm center">
            <img data-animate="fadeInLeft" src="/img/1.jpg" alt="Iphone">
        </div>
        <div class="col_two_third bottommargin-sm col_last">
            <div class="heading-block topmargin-lg">
                <h3>Our Mission </h3>
            </div>
            <p>Provide a platform for citizens to provide feedback on their encounters with government officials.
                Rewarding the good, exposing the bad in order to shape and or reform out current system thereby
                maintaining and insuring justice for all. As a nation we build this website together to document events
                occurring between citizens and government officials. We applaud the officials who sacrifice their lives
                to protect us and uphold our rights with their dutiful actions. We stand against government corruption
                and/or abuse.</p>

            <p>The website is the “Voice of the People”. We have a responsibility to the “truth” we all seek in life I
                order to insure justice in this world and keep it growing. United, we build a system showing the current
                state of our nation while suggesting ways to improve it. Protect our Rights by helping Rights Protection
                Agency and become a Rights’ Protector with us.</p>

            <a href="/about" class="btn-pad-lg defualt-btn button-large topmargin-sm">Learn
                more</a>

        </div>
    </div>
</section>

<!-- ad section -->
<div class="home-add-left">
    <!--    <img src="/img/add.jpg" alt="Iphone">-->
</div>
<div class="home-add-right">
    <!--    <img src="/img/add.jpg" alt="Iphone">-->
</div>

<!-- Devided bar -->
<div class="clear"></div>
<div class="divider divider-short divider-center"><i class="icon-circle-blank"></i></div>

<div class="promo promo-dark promo-flat promo-full bottommargin">
    <div class="container clearfix">
        <h3>Call us today at <span>+91.22.57412541</span> or Email us at <span>support@canvas.com</span></h3>
        <span>We strive to provide Our Customers with Top Notch Support to make their Theme Experience Wonderful</span>
        <a href="/users/login" class="button button-large button-rounded">Start Now</a>
    </div>
</div>

<!-- Devided bar -->
<div class="clear"></div>

<!-- Feature Section -->
<section class="page-section topmargin-lg bottommargin-sm homepage-section">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-8">
                <h2 class="text-left"><?= __('Stories') ?></h2>
                <h5 class="text-left">Agencies</h5>
                <div class="list-group row">
                    <?php foreach ($agencies as $key => $value): ?>
                        <div class="col-xs-6">
                            <a href="/stories?agency_id=<?= $key ?>" class="list-group-item text-left">
                                <?= h($value) ?>
                            </a>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="col-md-4">
                <h2 class="text-left">&nbsp;</h2>
                <h5 class="text-left">Cities</h5>
                <div class="list-group">
                    <?php foreach ($cities as $key => $value): ?>
                        <a href="/reform-ideas?city_id=<?= $key ?>" class="list-group-item text-left">
                            <?= h($value) ?>
                        </a>
                    <?php
                    endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

