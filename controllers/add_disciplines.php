<?php

$sql = "SELECT cipher FROM `groups`";
$Data["groups"] = db_query($sql);
// debug($_POST, __FILE__, __LINE__,1);
if (isset($_POST["add_disciplines"])) {
	$sql = "INSERT INTO `disciplines` (`name`) VALUES ('{$_POST['name_discipline']}');";
	$res = db_query($sql);

	$sql2 = "SELECT MAX(`id`) AS id FROM `disciplines`";
	$last_id = db_query($sql2);

	$t = $last_id[0]["id"];

	foreach ($_POST["id_gr"] as $key => $value) {
		$sql3 = "INSERT INTO `disciplines_group` (id_discipline, id_group) VALUES ($t, {$value});";
		$res3 = db_query($sql3);
	}

	if ($res3 === []) {
		$_SESSION["user"]["userMessages"][] = "Дисципліна додана";
		header("Location: ". WWW ."/add-disciplines");
		exit();
	} 
	else {
		$_SESSION["user"]["userMessages"][] = "Помилка: дисципліна не додана";
		header("Location: ". WWW ."/add-disciplines");
		exit();
	}







}


require(View ."/add_disciplines.php");