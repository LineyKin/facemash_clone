<?php

require_once "functions.php";
require_once "classes.php";

$projects = \Admin::getAllProjects();

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>admin</title>
    <script type="text/javascript" src="scripts/lib/jquery.min.js"></script>
</head>
<body>
<div id="add_project">
    <h2>добавить проект</h2>
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


<div id="add_player">
    <h2>добавить участника</h2>
    <form>
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

<script type="text/javascript" src="scripts/admin.js"></script>

</body>
</html>