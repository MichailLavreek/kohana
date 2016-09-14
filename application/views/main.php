<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>" />

    <link href="<?php echo URL::base(); ?>public/css/main.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>
<div class="layer">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1>Логотип</h1>
            </div>
        </div>

        <div class="panel panel-default left">
            <div class="panel-body">
                <h3>Меню</h3>
                <br />
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="<?php echo URL::site(); ?>">Главная</a></li>
                    <li><a href="<?php echo URL::site('about'); ?>">О сайте</a></li>
                    <li><a href="<?php echo URL::site('contacts'); ?>">Мои контакты</a></li>
                    <li><a href="<?php echo URL::site('articles'); ?>">Статьи</a></li>
                    <li><a href="<?php echo URL::site('add-article'); ?>">Добавить статью</a></li>
                </ul>
            </div>
        </div>

        <div class="panel panel-default content">
            <div class="panel-body">
                <?php echo $content; ?>
            </div>
        </div>
        <div class="clearing"></div>
        <div class="panel panel-default">
            <div class="panel-body">
                2016 Все права защищены
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>