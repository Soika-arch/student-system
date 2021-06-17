<?php

$sql = "SELECT cipher FROM groups";
$Data["groups"] = db_query($sql);

if (isset($_POST["add_student"])) {
	$sql = "INSERT INTO `students` (`id_group`, `surname`, `name`, `patronymic`,  `gender`, `date_of_birth`, `form_of_education`, 
			`refill`, `address`, `phone_number_student`, `phone_number_parent`, `remark`)
		VALUES ({$_POST['studentGroup']}, '{$_POST['surname_student']}', '{$_POST['name_student']}', '{$_POST['patronymic_student']}',
			 	'{$_POST['gender']}', '{$_POST['dateBirth_student']}', '{$_POST['form_of_education']}', '{$_POST['refill']}',  
			 	'{$_POST['address_student']}', '{$_POST['phone_number_student']}', '{$_POST['phone_number_parent']}',
			 	'{$_POST['remark']}');";
	$res = db_query($sql);

	if ($res === []) {
		$_SESSION["user"]["userMessages"][] = "Студент додан";
		header("Location: ". WWW ."/add_student");
		exit();
	} 
	else {
		$_SESSION["user"]["userMessages"][] = "Помилка: студент не додан";
		header("Location: ". WWW ."/add_student");
		exit();
	}
}

require(View ."/add_student.php");