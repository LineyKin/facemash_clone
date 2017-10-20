<?php

require_once "../classes.php";
require_once "../conf.php";

$projectCode = $_POST['code'];

$project = new Project($projectCode);

$list = $project->getPlayersOrderByRating();

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
        <td>
            <span>
                <span class="plus">+ <?echo $player->wins?></span>
                <span class="minus">- <?echo $player->fails?></span>
            </span>
        </td>
    </tr>
</table>
<?php } ?>