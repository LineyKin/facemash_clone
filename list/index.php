<?php

require_once "../connectivity.php";


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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="../_styles/nav.css">

    <script type="text/javascript" src="../_js/jquery.min.js"></script>
</head>
<body>



<div id="menu">
    <table>
        <tr>
            <td><a href="../../dvastula/">На главную</a></td>
            <td><a href="../project/?code=<?php echo $projectCode?>">К выборам</a></td>
        </tr>
    </table>
</div>

<div id="list" data-project="<?php echo $projectCode; ?>">

    <div id="filter">
        <input type="text" placeholder="поиск">
    </div>
        <?php
        $count = 0;
        foreach ($list as $playerKey => $info) {
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
            $count++;
            ?>

            <table>
                <tr>
                    <td class="number_cell" rowspan="2">
                        <span><?php echo $count; ?></span>
                    </td>
                    <td rowspan="2">
                        <div class="img_wrapper">
                            <a href="../player/?code=<?php echo $id; ?>">
                                <img src=<?php echo $player->getImgSrc('../'.IMG_DIR)?> >
                            </a>
                        </div>
                    </td>
                    <td class="name_cell">
                        <span>
                            <a href="../player/?code=<?php echo $id; ?>"><?php echo $player->name?></a>
                        </span>
                    </td>
                    <td><span>Доля побед: <?echo $player->showShareOfWins(); ?></span></td>
                </tr>
                <tr>
                    <td><span>Рейтинг: <?php echo $player->rating?></span></td>
                    <td>
                        <span>
                            <span class="plus">+ <?echo $player->wins?></span>
                            <span class="minus">- <?echo $player->fails?></span>
                        </span>
                    </td>
                </tr>
            </table>

        <?php } ?>
</div>

<script type="text/javascript" src="script.js"></script>
</body>
</html>



