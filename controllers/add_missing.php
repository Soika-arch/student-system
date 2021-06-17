<?php

$sql = "SELECT cipher FROM groups";
$Data["groups"] = db_query($sql);


if (isset($_POST["select_group"])) {
	$sql = "
	SELECT
		students.id,
		students.surname
	FROM
		students
	JOIN
		groups
	ON 
	 	groups.id = students.id_group
	WHERE 
		groups.id = {$_POST["groups"]}";

	$Data["group_students"] = db_query($sql);
}

require(View ."/add_missing.php");


