<?php

require_once "../connectivity.php";

$projectID = $_GET['id'];
$project = new Project($projectID);
$pair = $project->getRandomPairOfPlayers();

if (!$pair) {
    die("in developing...");
}

$l_player = new Player($pair["left"]);
$r_player = new Player($pair["right"]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = 'utf-8'>
    <title><?php echo $project->name; ?></title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../_styles/nav.css">
    <script type="text/javascript" src="../_js/jquery.min.js"></script>
</head>
<body>

<div id="menu">
    <table>
        <tr>
            <td><a href="../../dvastula/">На главную</a></td>
            <td><a href="../list/?id=<?php echo $projectID?>">К рейтингам</a></td>
        </tr>
    </table>
</div>

<div id="center">

    <table id="ring">
        <tr>
            <td>
                <div class="img_wrapper">
                    <img
                            id="l_img"
                            rating=<?php echo $l_player->rating?>
                            playerID=<?php echo $l_player->id?>
                            src=<?php echo $l_player->imgSrc; ?>
                    >
                </div>
            </td>
            <td>
                <div class="img_wrapper">
                    <img
                            id="r_img"
                            rating=<?php echo $r_player->rating?>
                            playerID=<?php echo $r_player->id?>
                            src=<?php echo $r_player->imgSrc; ?>

                    >
                </div>
            </td>
        </tr>
        <tr>
            <td class="player_name" id="l_name">
                <a href="../player/?code=<?php echo $l_player->id; ?>">
                    <?php echo $l_player->name?>
                </a>
            </td>
            <td class="player_name" id="r_name">
                <a href="../player/?code=<?php echo $r_player->id; ?>">
                    <?php echo $r_player->name?>
                </a>
            </td>
        </tr>
    </table>

</div>

<script type="text/javascript" src="script.js"></script>

</body>
</html>