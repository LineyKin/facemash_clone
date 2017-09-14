<?php


require_once "../functions.php";
require_once "../classes.php";
require_once "../conf.php";



$pair = GameEngine::getRandomPairOfPlayers('../'.IMG_DIR);


/*$all_pairs = GameEngine::getAllPairs(IMG_DIR);
_p(json_encode($all_pairs));
_p($all_pairs);*/


$l_player = new PlayerWithEloRating($pair["left"]);
$r_player = new PlayerWithEloRating($pair["right"]);


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset = 'utf-8'>
	<title>Имя Росcии</title>
	<link rel="stylesheet" type="text/css" href="../style/index.css">
	<script type="text/javascript" src="../js/lib/jquery.min.js"></script>
</head>
<body>


<div id="center">
	<table id="ring">
		<tr>
			<td>
				<img 
					id="l_img" 
					rating=<?php echo $l_player->rating?> 
					playerID=<?php echo $l_player->id?> 
					src=<?php echo $l_player->getImgSrc('../'.IMG_DIR)?>
				>
			</td>
			<td>
				<img 
					id="r_img" 
					rating=<?php echo $r_player->rating?> 
					playerID=<?php echo $r_player->id?> 
					src=<?php echo $r_player->getImgSrc('../'.IMG_DIR)?>
				>
			</td>
		</tr>
		<tr>
			<td class="candidate_name" id="l_name"><?php echo $l_player->name?></td>
			<td class="candidate_name" id="r_name"><?php echo $r_player->name?></td>
		</tr>
	</table>
</div>

<script type="text/javascript" src="../js/index.js"></script>

</body>
</html>