<?php

require_once "functions.php";
require_once "classes.php";
require_once "conf.php";

$projects = \Admin::getAllProjects();
//_p($projects);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Main</title>
    <link rel="stylesheet" href="style/main.css">

    <!--BOOTSTRAP-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!--/BOOTSTRAP-->

</head>
<body>

<h1 id="h1_title" class="page-header">DVA STULA</h1>

<div style="margin: 10px" class="row">
    <div class="col-md-4">
        <h3>Что всё это такое?</h3>
        <p>
            <b>DVA STULA</b> - рейтинговый механизм для некоторой группы (людей, персонажей
            книг, городов, да чего угодно),
            основанный на череде выборов из двух случайно предоставленных объектов группы.
            Математическая основа всего этого безобразия -
            <a target="_blank" href="https://en.wikipedia.org/wiki/Elo_rating_system">
                Рейтинг Эло для шахматистов</a>. Вдохновился проектом Facemash
            <a target="_blank" href="https://www.facebook.com/zuck">Марка Цукерберга</a>, о котором повествуется
            в самом начале фильма
            <a target="_blank" href="https://www.kinopoisk.ru/film/socialnaya-set-2010-427198/">Социальная сеть (2010)</a>.
        </p>
    </div>
    <div class="col-md-4">
        <h3>Проекты:</h3>
        <table style="width: 100%" class="table table-bordered table-hover table-striped">
            <?php

            foreach ($projects as $number => $project) {
                echo "<tr><td>";
                if (!$project['active']) {
                    echo "<a class='not_active_proj' title='Проект в разработке' href='project/?code=".$project['code']."' >".$project['proj_name']."</a>";
                }
                else {
                    echo "<a href='project/?code=".$project['code']."' >".$project['proj_name']."</a>";
                }
                echo "</td></tr>";
            }

            ?>
        </table>
    </div>
    <div class="col-md-4">
        <h3>Зачем всё это?</h3>
        <p>
            Целей у меня несколько
            <ol>
                <li>Интересна техническая реализация подобной задачи</li>
                <li>Нужна статистика для некоторых исследований</li>
                <li>В конце концов это просто развлечение</li>
            </ol>
        </p>
    </div>
</div>






</body>
</html>


