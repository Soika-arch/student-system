<?php

// Старт сесії
session_start();

require_once("../config.php");

// Підключення класів
require_once(Classes ."/User.php");

$User = new User();

if (StrQuery === "") {
	$controller = "index";
}
else {
	$controller = StrQuery;
}

$controller = str_replace("-", "_", $controller);

require_once(Controller ."/". $controller .".php");