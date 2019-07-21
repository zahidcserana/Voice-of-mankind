<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pageTitle = isset($pageTitle) ? ' | ' . $pageTitle : ''; ?>
    <title>Voice of Mankind<?php echo $pageTitle ?></title>
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>

    <?php echo $this->Html->css(array('vendor', 'style', 'select2.min')); ?>
    <?php echo $this->Html->css('bs-select.css') ?>
    <?php echo $this->element('Global' . DS . 'css'); ?>
</head>

<body class="stretched no-transition">
<?php echo $this->element('Global' . DS . 'user_tracker'); ?>
<input type="hidden" id="latitude">
<input type="hidden" id="longitude">

<?php echo $this->element('Global' . DS . 'header_inner'); ?>
<?php echo $this->element('Global' . DS . 'banner_inner'); ?>
<?php echo $this->element('Global' . DS . 'user_location'); ?>
<?php //echo $this->element('Global' . DS . 'share_location'); ?>
<section id="content">
    <div class="content-wrap">
        <?php echo $this->fetch('content') ?>
    </div>
</section>
<?php echo $this->element('Global' . DS . 'footer'); ?>

</div>
<div id="gotoTop" class="icon-angle-up"></div>

<?php echo $this->Html->script(array('vendor', 'select2.min', 'functions')) ?>
<?php echo $this->element('Global' . DS . 'js'); ?>
<?= $this->Html->script('my-custom.js') ?>
<?= $this->Html->script('location.js') ?>
</body>
</html>







