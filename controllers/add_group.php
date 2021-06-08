<?php

if (isset($_POST["add_group"])) {
	$sql = "insert into groups(cipher, course, id_teacher) values {$_POST["cipher"]}), {$_POST["course"]}),
	{$_POST["teacherGroup"]})";
	$res = db_query($sql);
}

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


require(View ."/add_group.php");




