<?php

require_once __DIR__ . '/Utils/loader.php';

use Controllers\SaveCategoryController;

$controller = new SaveCategoryController();

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
    <title>TegreiUI</title>
</head>
<body>
<div class="container-fluid">


    <?php

    if ($controller->IsMapExists())
    {?>
        <div class="alert alert-danger" role="alert">Map already exists!<br>
            <?php
            echo 'Id: ' . $controller->GetExistsMaps()[0]['Id'];
            echo '; Map: ' . $controller->GetExistsMaps()[0]['Map'] . ';';
            ?>
        </div>
        <?php
    }
    else
    {?>
        <div class="alert alert-primary my-2" role="alert">Saved!</div>
        <a class="btn btn-primary" href="/tegrei/index.php" role="button">Go to category list</a>
        <?php
    }
    ?>


</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>