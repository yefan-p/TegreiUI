<?php

require_once __DIR__ . '/Utils/loader.php';

use Controllers\SelectCategoryController;

$controller = new SelectCategoryController();

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


    <div class="row">
        <div class="col-2">
            <?php

            foreach ($controller->GetNonCategoriesProgram() as $program)
            {
                ?>
                <form class="d-flex flex-column my-2" action="/index.php" method="get">
                    <button class="btn btn-primary" type="submit" name="unifyId" value="<?php echo $program[0] ?>">
                        <?php echo $program[1] ?>
                    </button>
                </form>
                <?php
            }
            ?>
        </div>
        <div class="col">
            <form action="/save_category.php" method="post">
                <div class="row">
                    <div class="col d-flex flex-column">
                        <p class="my-2"><?php echo $controller->GetFullName() ?></p>
                        <input class="my-2" type="text" value="<?php echo $controller->GetShortName(); ?>">
                        <?php if($controller->IsMapAlreadyExists())
                        {?>
                            <div class="alert alert-danger" role="alert">Map already exists!<br>
                                <?php
                                echo 'Id: ' . $controller->GetExistsMaps()[0]['Id'];
                                echo '; Map: ' . $controller->GetExistsMaps()[0]['Map'] . ';';
                                ?>
                            </div>
                        <?php
                        }?>
                        <button class="btn btn-success" type="submit">Сохранить</button>
                        <div class="my-2">
                            <?php echo $controller->GetDescription() ?>
                        </div>
                        <textarea class="my-2" rows="30">
                            <?php echo $controller->GetDescription() ?>
                        </textarea>
                    </div>
                    <div class="col non-scroll-list">
                        <?php
                        foreach ($controller->GetCategories() as $category) {
                            ?>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="<?php echo $category['Id'] ?>">
                                <label class="form-check-label" for="<?php echo $category['Id'] ?>">
                                    <?php
                                    if ($category['Name'] == 'OC'
                                        || $category['Name'] == 'Антивирусы'
                                        || $category['Name'] == 'Интернет'
                                        || $category['Name'] == 'Системныеутилиты'
                                        || $category['Name'] == 'Драйвера'
                                        || $category['Name'] == 'Графика'
                                        || $category['Name'] == 'Мультимедиа'
                                        || $category['Name'] == 'CD/DVD'
                                        || $category['Name'] == 'Офис'
                                        || $category['Name'] == 'Оформление') { ?>
                                        <u><strong><?php echo $category['Name']; ?></strong></u>
                                        <?php
                                    } else {
                                        echo $category['Name'];
                                    }
                                    ?>
                                </label>
                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>
            </form>

        </div>
    </div>


</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>