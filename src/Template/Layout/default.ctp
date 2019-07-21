
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $pageTitle = isset($pageTitle)? ' | '.$pageTitle : '';?>
    <title>Voice of Mankind<?php echo $pageTitle?></title>
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon" />
    <?= $this->Html->css('vendor.css') ?>
    <?= $this->Html->css('bs-select.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('select2.min.css') ?>

    <?php echo $this->element('Global' . DS . 'css'); ?>
</head>
<body class="stretched no-transition">
<?php echo $this->element('Global' . DS . 'user_tracker'); ?>
 <div id="wrapper" class="clearfix">
<?php echo $this->element('Global' . DS . 'header'); ?>
<?php echo $this->element('Global' . DS . 'banner'); ?>
<section id="content">
    <div class="content-wrap">
        <?php echo $this->fetch('content'); ?>
    </div>
</section>
<?php echo $this->element('Global'.DS.'footer');?>

</div>
<div id="gotoTop" class="icon-angle-up"></div>

<?= $this->Html->script('vendor.js') ?>
<?= $this->Html->script('select2.min.js') ?>
<?= $this->Html->script('functions.js') ?>
<?php echo $this->element('Global' . DS . 'js'); ?>
<?= $this->Html->script('my-custom.js') ?>
<?= $this->Html->script('location.js') ?>
</body>

</html>