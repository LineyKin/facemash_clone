<?php

require_once "../connectivity.php";


$playerID = $_GET['code'];

$player = new Player($playerID);

$project = new Project($player->project);

?>

<html>
  <head>
      <meta charset = 'utf-8'>
      <title><?php echo $player->name; ?></title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <link rel="stylesheet" type="text/css" href="../_styles/nav.css">

      <script type="text/javascript" src="../_js/jquery.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


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

  <div id="contetnt">

      <div class="block">

          <div class="img_wrapper">
              <img src=<?php echo $player->getImgSrc('../'.IMG_DIR)?> >
          </div>

          <div class="info_wrapper">
              <h2 class="page_name">
                  <?php echo $player->name; ?>
              </h2>

              <table>
                  <tr>
                      <td>Проект:</td>
                      <td><?php echo $project->name;  ?></td>
                  </tr>
                  <tr>
                      <td>Рейтинг:</td>
                      <td><?php echo  $player->rating; ?></td>
                  </tr>
                  <tr>
                      <td>Число побед:</td>
                      <td><?php echo $player->wins; ?></td>
                  </tr>
                  <tr>
                      <td>Число поражений:</td>
                      <td><?php echo $player->fails; ?></td>
                  </tr>
                  <tr>
                      <td>Индекс победителя:</td>
                      <td><?php echo $player->showShareOfWins(); ?></td>
                  </tr>
              </table>
          </div>

      </div>

      <div class="block">
          <div data-player_code="<?php echo $playerID; ?>" id="rating_graph"></div>
      </div>

  </div>

  </body>
  <script type="text/javascript" src="script.js"></script>
</html>