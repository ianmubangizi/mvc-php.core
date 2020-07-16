<?php

use Mubangizi\Views\Page;

$data = Page::$data;
$content = Page::$file;

include 'src/Layouts/includes/header.php';
?>
<main>
    <?php include $content; ?>
</main>
<?php
include 'src/Layouts/includes/footer.php';
