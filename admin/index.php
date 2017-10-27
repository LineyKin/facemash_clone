<?php

require_once "../connectivity.php";

$projects = \Admin::getAllProjects();
$defaultProjectCode = $projects[0]['code'];

$defaultProject = new Project($defaultProjectCode);
$defaultList = $defaultProject->getPlayersOrderByName(); //_p($_SERVER);


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>admin</title>

    <!--BOOTSTRAP-->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!--/BOOTSTRAP-->

    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="../_js/jquery.min.js"></script>
</head>
<body>
<div class="block" id="add_project">
    <h2>Добавить проект</h2>
    <form>
        <table>
            <tr>
                <td>название проекта</td>
                <td><input id="project" type="text"></td>
            </tr>
        </table>
        <input id="add_project_button" type="button" value="Добавить">
    </form>
</div>

<hr>


<div class="block" id="settings">
    <h2>Настройки проекта</h2>

    <table>
        <tr>
            <td>проект</td>
            <td>
                <select name="project" id="project_list">
                    <?php
                    foreach ($projects as $key => $project) {
                        $code = $project['code'];
                        $name = $project['proj_name'];
                        echo "<option data-code=".$code.">".$name."</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>

    <div class="col-md-4">
        <h3>Добавить участника</h3>
        <form>
            <table>
                <tr>
                    <td>имя участника</td>
                    <td><input id="name" type="text"></td>
                </tr>
                <tr>
                    <td>фото участника</td>
                    <td><input id="playerPhoto" name="'playerPhoto" type="file"></td>
                </tr>
            </table>
            <input id="add_player_button" type="button" value="Добавить">
        </form>
    </div>

    <div class="col-md-4">
        <h3>Список участников</h3>
        <div id="list_wrapper">
            <table id="list">
                <?php
                    foreach ($defaultList as $playerKey => $info) {
                        $id = $info['id'];
                        $player = new Player(
                            $id,
                            $info['project'],
                            $info['code'],
                            $info['name'],
                            $info['rating'],
                            $info['wins'],
                            $info['fails'],
                            $info['fails']
                        );
                ?>
                        <tr>
                            <td>
                                <div class="img_wrapper">
                                    <img
                                            src="<?php echo $player->imgSrc; ?>"
                                            alt="<?php echo $player->name; ?>"
                                    >
                                </div>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $player->name; ?>">
                            </td>
                            <td>
                                <button class="delete_button" data-id="<?php echo $id; ?>">удалить</button>
                            </td>
                        </tr>
                <?php } ?>
            </table>
        </div>
    </div>


</div>

<script type="text/javascript" src="script.js"></script>

</body>
</html>