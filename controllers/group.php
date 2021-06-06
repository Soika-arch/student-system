<?php 

$sql = "
SELECT
	students.*,
	groups.id id_group,
	groups.cipher,
	groups.course,
	teachers.id id_teacher,
	teachers.surname surname_teacher,
	teachers.name name_teacher,
	teachers.patronymic patronymic_teacher,
	teachers.phone_number phone_number_teacher
FROM
	students
JOIN
	groups
ON 
	groups.id = students.id_group
JOIN
	teachers
ON 
	groups.id_teacher = teachers.id
WHERE 
	groups.id = {$_GET["id"]}";

$Data["students"] = db_query($sql);

require(View ."/group.php");