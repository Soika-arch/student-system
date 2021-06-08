<?php

$Data["year"] = isset($_POST["year"]) ? $_POST["year"] : date("Y");
$Data["month"] = isset($_POST["month"]) ? $_POST["month"] : date("m");
$Data["day"] = isset($_POST["day"]) ? $_POST["day"] : date("d");
$Data["days_in_month"] = cal_days_in_month(CAL_GREGORIAN, $Data["month"], $Data["year"]);
$Data["missing_for_days"] = [];

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
	groups.id = {$_GET["id"]}";

$Data["group_students"] = db_query($sql);

foreach ($Data["group_students"] as $key => $student) {
	$sql = "
	SELECT
		missing.id,
		missing.hours,
		missing.date_missing,
		DAYOFMONTH(missing.date_missing) as num_day
	FROM
		missing
	WHERE 
		missing.id_student = {$student["id"]}
		AND missing.date_missing >= '{$Data["year"]}-{$Data["month"]}-1'
		AND missing.date_missing < '{$Data["year"]}-". ($Data["month"]+1) ."-1'";

	$Data["attendance"][$student["surname"]] = db_query($sql);
}

// debug($Data["attendance"], __FILE__, __LINE__);

require(View ."/attendance.php");