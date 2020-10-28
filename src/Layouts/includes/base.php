<?php $app = Mubangizi\Application::instance(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg" sizes="32x32" href="/public/img/logo-icon-gold.svg">
    <link rel="icon" type="image/svg" sizes="16x16" href="/public/img/logo-icon-gold.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/simple-bar.min.css">
    <link rel="stylesheet" href="/public/css/tiny-slider.css">
    <link rel="stylesheet" href="/public/css/ui-slider.min.css">
    <link rel="stylesheet" href="/public/css/keyframes.css" />
    <link rel="stylesheet" href="/public/css/theme.min.css">
    <title><?php echo get_title() ?></title>
</head>

<body class="toolbar-enabled">
    <?php
    include_once('header.php');
    include_once($app->page->view);
    include_once('footer.php');
    ?>
    <script src="/public/js/jquery.slim.min.js"></script>
    <script src="/public/js/bootstrap.bundle.min.js"></script>
    <script src="/public/js/file-input.min.js"></script>
    <script src="/public/js/simple-bar.min.js"></script>
    <script src="/public/js/tiny-slider.js"></script>
    <script src="/public/js/ui-slider.min.js"></script>
    <script src="/public/js/drift.min.js"></script>
    <script src="/public/js/smooth-scroll.polyfills.min.js"></script>
    <script src="/public/js/functions.min.js"></script>
</body>

</html>