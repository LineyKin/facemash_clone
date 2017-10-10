<?php

require_once "../functions.php";
require_once "../classes.php";
require_once "../conf.php";

if (!$_GET['code']) {
    die("project is not defined");
}

$projectCode = $_GET['code'];

$project = new Project($projectCode);

$list = $project->getPlayersOrderByRating();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>List</title>
    <link rel="stylesheet" href="../style/list.css">

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

<h2 id="h1_title" class="page-header">Рейтинг проекта "<?php echo $project->name; ?>"</h2>

<table id="menu">
    <tr>
        <td><a href="../project/?code=<?php echo $projectCode?>">К выборам</a></td>
        <td><a href="../../dvastula/">На главную</a></td>
    </tr>
</table>

<div id="list" >
        <?php
        $count = 0;
        foreach ($list as $playerKey => $info) {
            $player = new PlayerWithEloRating(
                $info['id'],
                $info['project'],
                $info['code'],
                $info['name'],
                $info['rating'],
                $info['wins'],
                $info['fails']
            );
            $count++;
            ?>

            <table>
                <tr>
                    <td class="number_cell" rowspan="2">
                        <span><?php echo $count; ?></span>
                    </td>
                    <td rowspan="2">
                        <div class="img_wrapper">
                            <img src=<?php echo $player->getImgSrc('../'.IMG_DIR.$projectCode.'/')?> >
                        </div>
                    </td>
                    <td class="name_cell"><span><?php echo $player->name?></span></td>
                    <td><span>Доля побед: <?echo $player->getShareOfWins(); ?></span></td>
                </tr>
                <tr>
                    <td><span>Рейтинг <?php echo $player->rating?></span></td>
                    <td><span>+ <?echo $player->wins?> - <?echo $player->fails?></span></td>
                </tr>
            </table>

        <?php } ?>
</div>





</body>
</html>



