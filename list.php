<?php

require_once __DIR__ . '/Utils/loader.php';

use Views\Layout;

$layout = new Layout();
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/css_just.css" rel="stylesheet">
    <link href="css/extra.css" rel="stylesheet">
    <link href="css/inline.css" rel="stylesheet">
    <link href="css/main.min.css" rel="stylesheet">
    <link href="css/palette.min.css" rel="stylesheet">
    <link href="css/custom_mirror.css" rel="stylesheet">
    <title>Список программ</title>
</head>
<body>
<div class="container-fluid">

    <?php echo $layout->GetHeader(); ?>
    <?php echo $layout->GetNavbar(); ?>


</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>