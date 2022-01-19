<?php

require_once __DIR__ . '/Utils/loader.php';

use Models\DbContext;

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

                $dbContext = new DbContext();
                $uncategoriesProgram = $dbContext->GetNonCategoriesPrograms();
                $categories = $dbContext->GetCategories();
                $unifyItem = $dbContext->GetUnifyItem();

                foreach ($uncategoriesProgram as $program)
                {
                    ?>
                    <form class="d-flex flex-column my-2" action="/index.php" method="get">
                        <button class="btn btn-primary" type="submit" name="unifyId" value="<?php echo $program[0] ?>">
                        <?php echo $program[1]?>
                        </button>
                    </form>
                    <?php
                }
                ?>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <form class="d-flex flex-column" action="/save_category.php" method="post">
                            <p class="my-2"><?php if(isset($unifyItem[0]['Name'])) echo $unifyItem[0]['Name'] ?></p>
                            <input class="my-2" type="text" value="<?php
                                if(isset($unifyItem[0]['Name']))
                                {
                                    echo preg_replace('/.\d.*/', '', $unifyItem[0]['Name']);
                                }?>">
                            <button class="btn btn-success" type="submit">Сохранить</button>
                            <div class="my-2">
                                <?php if(isset($unifyItem[0]['Description'])) echo $unifyItem[0]['Description'] ?>
                            </div>
                            <textarea class="my-2" rows="30">
                                <?php if(isset($unifyItem[0]['Description'])) echo $unifyItem[0]['Description'] ?>
                            </textarea>
                        </form>
                    </div>
                    <div class="col non-scroll-list">
                    <?php
                    foreach ($categories as $category)
                    {
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
                                || $category['Name'] == 'Оформление')
                                { ?>
                                    <u><strong><?php echo $category['Name']; ?></strong></u>
                                <?php
                                }
                                else
                                {
                                    echo $category['Name'];                                }
                                ?>
                            </label>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>


            </div>
        </div>



    </div>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>