<?php

$Data["url"] = WWW ."/academic-performance?id=". $_GET["id"];
$Data["year"] = isset($_POST["year"]) ? $_POST["year"] : date("Y");
$Data["month"] = isset($_POST["month"]) ? $_POST["month"] : date("m");
$Data["day"] = isset($_POST["day"]) ? $_POST["day"] : date("d");

$Data["days_in_month"] = cal_days_in_month(CAL_GREGORIAN, $Data["month"], $Data["year"]);
$Data["missing_for_days"] = [];
$Data["ua_months"] = ["Січень", "Лютий", "Березень", "Квітень", "Травень", "Червень", "Липень",
		"Серпень", "Вересень", "Жовтень", "Листопад", "Грудень"];

$sql = "
SELECT DISTINCT
	YEAR(session.date_session) y
FROM
	session
";

$Data["session_years"] = db_query($sql);

$sql = "
SELECT 
	students.id id_student,
	students.surname
FROM
	students
WHERE 
	students.id_group = {$_GET["id"]}";

$Data["students"] = db_query($sql);
// debug($Data["students"], __FILE__, __LINE__, 1);

if (isset($_POST["year"])) {
	$sql = "
	SELECT DISTINCT
		MONTH(session.date_session) m
	FROM
		session
	WHERE
		YEAR(session.date_session) = {$_POST["year"]}
	";


	$Data["session_months"] = db_query($sql);
	// debug($Data["session_months"], __FILE__, __LINE__, 1);
}

$sql = "
SELECT DISTINCT
	disciplines.id,
	disciplines.name
FROM
	disciplines
JOIN
	disciplines_group
ON
	disciplines_group.id_discipline = disciplines.id
JOIN
	groups
WHERE
	disciplines_group.id_group = {$_GET["id"]}
";

$Data["group_disciplines"] = db_query($sql);
// debug($Data["students"], __FILE__, __LINE__, 1);
foreach ($Data["students"] as $key => $student) {
	$sql = "
	SELECT
		students.id id_student,
		disciplines.id id_discipline,
		disciplines.name,
		session.point,
		session.date_session,
		DAYOFMONTH(session.date_session) num_day,
		type_of_control.control
	FROM
		students
	JOIN
		session
	ON
		session.id_student = students.id
	JOIN
		disciplines
	ON
		disciplines.id = session.id_discipline
	JOIN
		type_of_control
	ON
		type_of_control.id = session.id_type_of_control
	WHERE 
		students.id = {$student['id_student']}
		AND session.date_session >= '{$Data['year']}-{$Data['month']}-1'
		AND session.date_session < '{$Data['year']}-". ($Data['month']+1) ."-1'
		AND type_of_control.control = '{$_GET['control']}'";
	// debug($sql, __FILE__, __LINE__, 1);

	$Data["student_points"][$key]["student"] = $student;
	$Data["student_points"][$key]["points"] = db_query($sql);
}
// debug($Data["student_points"], __FILE__, __LINE__, 1);

require(View ."/academic_performance.php");