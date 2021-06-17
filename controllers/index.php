<?php 

$User = new User();

if (isset($_GET["exit"])) {
	$User->logout();
	header("Location: ". WWW ."/general");
}

if ($User->is) {
	header("Location: ". WWW ."/general");
}

if (!empty($_POST)) {
	// var_dump($_POST);
	if ($User->login($_POST["login"], $_POST["password"])) {
		header("Location: ". WWW ."/general");
		exit();
	}
	else {
		$_SESSION["userErrors"][] = "Неправильний логін або пароль";
	}
}

require(View ."/index.php");