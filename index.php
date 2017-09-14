<?php

require_once "functions.php";
require_once "classes.php";
require_once "conf.php";

$projects = \Admin::getAllProjects();
//_p($projects);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Main</title>
</head>
<body>

<h1>Главная страница</h1>

<?php

foreach ($projects as $number => $project) {
    echo "<a href='project/?code=".$project['code']."' >".$project['proj_name']."</a><br>";
}

?>

</body>
</html>


