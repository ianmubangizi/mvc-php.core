<?php $app = Mubangizi\Application::instance(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/svg" sizes="32x32" href="/public/img/logo-icon-gold.svg">
    <link rel="icon" type="image/svg" sizes="16x16" href="/public/img/logo-icon-gold.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/main.css" rel="stylesheet">
    <title><?php echo get_title() ?></title>
</head>

<body class="toolbar-enabled">
    <?php
    include_once('header.php');
    include_once($app->page->view);
    include_once('footer.php');
    ?>
    <script src="/public/js/popper.min.js"></script>
    <script src="/public/js/bootstrap.bundle.min.js"></script>
</body>

</html>