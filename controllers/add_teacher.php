<?php
if (isset($_POST["add_teacher"])) {
	$sql = "INSERT INTO `teachers` (`surname`, `name`, `patronymic`, `phone_number`) VALUES ('{$_POST['surname']}', '{$_POST['name']}',
		'{$_POST['patronymic']}', '{$_POST['phone_number']}');";
	$res = db_query($sql);

	if ($res === []) {
		$_SESSION["user"]["userMessages"][] = "Викладач додан";
		header("Location: ". WWW ."/add-teacher");
		exit();
	} 
	else {
		$_SESSION["user"]["userMessages"][] = "Помилка: викладач не додан";
		header("Location: ". WWW ."/add-teacher");
		exit();
	}
}


require(View ."/add_teacher.php");