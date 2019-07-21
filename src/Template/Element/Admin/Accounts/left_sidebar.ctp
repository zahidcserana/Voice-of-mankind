<?php
$active = isset($active) ? $active : '';

?>
<div class="left-sidebar panel">
    <div class="text-center" style="padding-bottom: 10px;">
        <?php $profileImage = $this->Image->user($user); ?>
        <img src="<?php echo $user['image'] == '' ? '/img/avator.png' : $profileImage ?>" id="base_image" alt="..."
             style="max-width: 100%; max-height: 150px;display: inline-block;">
        <!--<img src="<?php /*echo $user['image']==''?'/img/avator.png':'/img/upload/profile/'.$user['image']*/ ?>" id="base_image" alt="..." style="max-width: 100%; max-height: 150px;display: inline-block;">-->

        <h2 class="theme-color" style="margin-bottom: 0px ;padding: 10px 10px 5px;">
            <?= $user['name'] ?>
        </h2>
        <?php if ($user['user_type_id'] == 4) { ?>
            <small class="label label-xs label-success">Sponsor</small>
        <?php } ?>
    </div>


    <ul class="nav nav-pills nav-stacked">
        <li class=" <?= $active == 'profile' ? 'active' : '' ?>">
            <a href="/accounts/profile/<?php echo $user['id'] ?>" class="list-group-item clearfix">Overview <i
                        class="icon-user pull-right"></i></a>
        </li>
        <li class=" <?= $active == 'settings' ? 'active' : '' ?>">
            <a href="/accounts/edit" class="list-group-item clearfix">Update Profile <i
                        class="icon-settings pull-right"></i></a>
        </li>
        <?php if ($user['user_type_id'] == 4) { ?>
        <li class="<?= $active=='sponsor_info'?'active':''?>">
            <a href="/accounts/sponsor_info" class="list-group-item clearfix">Sponsor Info<i
                    class="icon-info pull-right"></i></a>

        </li>
        <?php } ?>
        <?php
        if ($user->user_type_id == 4) {
            ?>
            <li class=" <?//= $active == 'teams' ? 'active' : '' ?>">
                <a href="/accounts/teams" class="list-group-item clearfix">My Teams <i
                            class="icon-users pull-right"></i></a>
            </li>
<!--            <li class="--><?//= $active == 'sponsors_payment' ? 'active' : '' ?><!--">-->
<!--                <a href="/accounts/teams" class="list-group-item clearfix ">Sponsors Payment <i-->
<!--                            class="icon-users pull-right"></i></a>-->
<!--            </li>-->

            <li>
                <a href="/tickets/assign-available" class="list-group-item clearfix ">Get Sponsor Tickets <i
                            class="icon-users pull-right"></i></a>
            </li>
            <?php
        }

        ?>

        <li class=" <?= $active == 'tickets' ? 'active' : '' ?>">
            <a href="/accounts/tickets" class="list-group-item clearfix">Tickets<i
                        class="icon-ticket pull-right"></i></a>
        </li>

        <li class=" <?= $active == 'votes' ? 'active' : '' ?>">
            <a href="/accounts/votes" class="list-group-item clearfix">Votes<i
                        class="icon-thumbs-up pull-right"></i></a>
        </li>
        <li class=" <?= $active == 'payment_history' ? 'active' : '' ?>">
            <a href="/accounts/payment_history" class="list-group-item clearfix">Payment History <i
                        class="icon-money pull-right"></i></a>
        </li>
        <li>

            <a href="/accounts/logout" class="list-group-item clearfix ">Logout <i
                        class="icon-line2-logout pull-right"></i></a>
        </li>
    </ul>
</div>


<style>
    .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
        background-color: #00a4b5;
    }

    .theme-color {
        color: #00a4b5;
    }

    .bg-theme {
        background-color: #00a4b5;
    }

    .profile-desc-text {
        margin-bottom: 20px;
        display: inline-block;
        width: 100%;
    }
</style>