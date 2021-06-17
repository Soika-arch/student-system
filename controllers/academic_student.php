<?php
$sql = "
SELECT 
	students.surname,
	students.name name_student,
	students.patronymic,
	disciplines.name,
	type_of_control.control,
	session.date_session,
	session.point
FROM
	students
LEFT JOIN
	session
ON 
	session.id_student = students.id
LEFT JOIN
	disciplines
ON 
	disciplines.id = session.id_discipline
LEFT JOIN
	type_of_control
ON 
	type_of_control.id = session.id_type_of_control
WHERE 
	students.id = {$_GET["id"]}
	AND YEAR(session.date_session) = {$_GET["year"]}
	AND MONTH(session.date_session) = {$_GET["month"]}
";

$Data["academic"] = db_query($sql);

// debug($Data["academic"], __FILE__, __LINE__, 1);

require(View ."/academic_student.php");