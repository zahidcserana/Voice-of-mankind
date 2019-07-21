<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
use Cake\Core\Configure;

$demoServerUrl = 'http://demo.leapinglogic.com/vom/';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $demoServerUrl;?>css/vendor-canvas.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $demoServerUrl;?>css/bs-rating.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $demoServerUrl;?>css/components/bs-switches.css" type="text/css" />

    <!-- Radio Checkbox Plugin -->
    <link rel="stylesheet" href="<?php echo $demoServerUrl;?>css/components/radio-checkbox.css" type="text/css" />
    <!-- Bootstrap Select CSS -->
    <link rel="stylesheet" href="<?php echo $demoServerUrl;?>css/components/bs-select.css" type="text/css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $demoServerUrl;?>scss/style.css" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans|Ubuntu" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">

    <?= $this->Html->css('base.css') ?>


    <?= $this->Html->css('dropzone.css') ?>
    <?= $this->Html->css('select2.min.css') ?>

    <script type="text/javascript" src="<?php echo $demoServerUrl;?>js/plugins.js"></script>

    <!-- Canvas Scripts
	============================================= -->
    <script type="text/javascript" src="<?php echo $demoServerUrl;?>js/functions.js"></script>
    <!-- Bootstrap Select Plugin -->
    <script type="text/javascript" src="<?php echo $demoServerUrl;?>js/bs-select.js"></script>

    <!-- Select Splitter Plugin -->
    <script type="text/javascript" src="<?php echo $demoServerUrl;?>js/selectsplitter.js"></script>
    <!-- Bootstrap Switch Plugin -->
    <script type="text/javascript" src="<?php echo $demoServerUrl;?>js/components/bs-switches.js"></script>

    <?= $this->Html->script('jquery-3.3.1.min.js') ?>
    <?= $this->Html->script('dropzone.js') ?>
    <?= $this->Html->script('my-custom.js') ?>
    <?= $this->Html->script('jquery.validate.min.js');?>
    <?= $this->Html->script('select2.min.js') ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li><a target="_blank" href="https://book.cakephp.org/3.0/">Documentation</a></li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
    <script>
        var baseUrl = '<?php echo Configure::read("baseUrl");?>';
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myCarousel').carousel({
                interval: 10000
            })
        });
    </script>
    <script type="text/javascript">

        $('.selectsplitter').selectsplitter();

    </script>
    <script>

        jQuery(".bt-switch").bootstrapSwitch();

    </script>

</body>
</html>
