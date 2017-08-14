<!DOCTYPE html>
<html>
<head>
    <meta charset = 'utf-8'>
    <title>add</title>
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
                    <select id="project_list">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>имя участника</td>
                <td><input id="name" type="text"></td>
            </tr>
        </table>
        <input id="add_player_button" type="button" value="Добавить">
    </form>
</div>

<script type="text/javascript" src="scripts/add_content.js"></script>

</body>
</html>