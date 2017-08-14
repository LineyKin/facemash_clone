<?php

require_once "_connectivity.php";

$project_name = $_POST['project_name'];
$code = \StringConverter::translit($project_name);

$project = [
    "name" => $project_name,
    "code" => $code
];

echo json_encode($project);
