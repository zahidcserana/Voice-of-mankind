<!DOCTYPE html>
<html lang="en" >
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>
        Voice of Mankind | Dashboard
    </title>
    <meta name="description" content="Leaping Login Api">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700", "Asap+Condensed:500"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="/admin/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/css/custom.css" rel="stylesheet" type="text/css"/>

    <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<?php echo $this->element('Admin'. DS .'Global' . DS . 'loader'); ?>
<div class="m-grid m-grid--hor m-grid--root m-page">
    <?php echo $this->element('Admin'. DS .'Global' . DS . 'header'); ?>
    <?php echo $this->element('Admin' . DS .'Global' . DS . 'css'); ?>
    <div class="m-grid__item m-grid__item--fluid  m-grid m-grid--ver-desktop m-grid--desktop m-page__container m-body">
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-content">

                <?php echo $this->fetch('content'); ?>

            </div>
        </div>
    </div>
    <?php echo $this->element('Admin' . DS .'Global' . DS . 'footer'); ?>
</div>
<?php echo $this->element('Admin' . DS .'Global' . DS . 'quick_sidebard'); ?>
<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
     data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>

<script src="/admin/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/admin/js/scripts.bundle.js" type="text/javascript"></script>
<?= $this->Html->script('jquery.validate.min.js');?>
<?= $this->Html->script('select2.js') ?>
<?php echo $this->element('Admin' . DS .'Global' . DS . 'js'); ?>

<script src="/admin/js/my-custom.js"></script>

<!--<script src="/js/data-ajax.js" type="text/javascript"></script>-->
<script>
    $(window).on('load', function () {
        $('body').removeClass('m-page--loading');
    });
</script>

<style>
    .error {
        color: red;
    }
</style>
</body>
</html>
