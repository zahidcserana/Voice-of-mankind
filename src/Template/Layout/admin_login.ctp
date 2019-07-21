<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>
        Voice Of Mankind
    </title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <link href="/admin/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<?php echo $this->fetch('content'); ?>
<script src="/admin/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/admin/js/scripts.bundle.js" type="text/javascript"></script>
<script src="/admin/js/my-custom.js" type="text/javascript"></script>
<script src="/admin/js/login.js" type="text/javascript"></script>
</body>
</html>
