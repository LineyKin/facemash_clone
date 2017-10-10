<?php


require_once "../functions.php";
require_once "../classes.php";
require_once "../conf.php";


$projectCode = $_GET['code'];

$project = new Project($projectCode);

$pair = $project->getRandomPairOfPlayers();

if (!$pair) {
    die("in developing...");
}

$l_player = new PlayerWithEloRating($pair["left"]);
$r_player = new PlayerWithEloRating($pair["right"]);



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = 'utf-8'>
    <title><?php echo $project->name; ?></title>
    <link rel="stylesheet" type="text/css" href="../style/project.css">
    <script type="text/javascript" src="../js/lib/jquery.min.js"></script>
</head>
<body>


<div id="center">

    <table id="ring">
        <tr>
            <td>
                <div class="img_wrapper">
                    <img
                            id="l_img"
                            rating=<?php echo $l_player->rating?>
                            playerID=<?php echo $l_player->id?>
                            src=<?php echo $l_player->getImgSrc('../'.IMG_DIR.$projectCode.'/')?>
                    >
                </div>
            </td>
            <td>
                <div class="img_wrapper">
                    <img
                            id="r_img"
                            rating=<?php echo $r_player->rating?>
                            playerID=<?php echo $r_player->id?>
                            src=<?php echo $r_player->getImgSrc('../'.IMG_DIR.$projectCode.'/')?>

                    >
                </div>
            </td>
        </tr>
        <tr>
            <td class="candidate_name" id="l_name"><?php echo $l_player->name?></td>
            <td class="candidate_name" id="r_name"><?php echo $r_player->name?></td>
        </tr>
    </table>
</div>

<div style="text-align: center"><a href="../list/?code=<?echo $projectCode;?>">list</a></div>


<script type="text/javascript" src="../js/index.js"></script>

</body>
</html>