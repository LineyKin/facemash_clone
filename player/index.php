<?php

require_once "../connectivity.php";


$playerID = $_GET['code'];

$player = new Player($playerID);


?>

<html>
  <head>
      <meta charset = 'utf-8'>
      <title><?php echo $player->name; ?></title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" type="text/css" href="../_styles/nav.css">

      <script type="text/javascript" src="../_js/jquery.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript" src="script.js"></script>
  </head>
  <body>

  <div id="menu">
      <table>
          <tr>
              <td><a href="../project/?code=<?php echo $player->project?>">К выборам</a></td>
              <td><a href="../list/?code=<?php echo $player->project?>">К рейтингам</a></td>
              <td><a href="../../dvastula/">На главную</a></td>
          </tr>
      </table>
  </div>

  <div class="img_wrapper">
      <img src=<?php echo $player->getImgSrc('../'.IMG_DIR)?> >
  </div>

    <div data-player_code="<?php echo $playerID; ?>" id="rating_graph"></div>
  </body>
</html>