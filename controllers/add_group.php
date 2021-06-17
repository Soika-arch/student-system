<?php

$sql = "SELECT teachers.id, teachers.surname FROM teachers";
$Data["teachers"] = db_query($sql);


if (isset($_POST["add_group"])) {
	$sql = "INSERT INTO `groups` (`cipher`, `course`, `id_teacher`) VALUES ('{$_POST['cipher']}', {$_POST['course']},
		{$_POST['teacherGroup']});";
	$res = db_query($sql);

	if ($res === []) {
		$_SESSION["user"]["userMessages"][] = "Група додана";
		header("Location: ". WWW ."/add-group");
		exit();
	} 
	else {
		$_SESSION["user"]["userMessages"][] = "Помилка: група не додана";
		header("Location: ". WWW ."/add-group");
		exit();
	}
}



require(View ."/add_group.php");




