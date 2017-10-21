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

      <script type="text/javascript" src="../_js/jquery.min.js"></script>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript" src="script.js"></script>
  </head>
  <body>
    <div data-player_code="<?php echo $playerID; ?>" id="rating_graph" style="width: 900px; height: 500px"></div>
  </body>
</html>