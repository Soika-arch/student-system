<?php 

$sql = "
SELECT
	students.*,
	groups.id id_group,
	groups.cipher,
	groups.course
FROM
	students
JOIN
	groups
ON 
	groups.id = students.id_group
WHERE 
	students.id = {$_GET["id"]}";

$Data["student"] = db_query($sql);





require(View ."/student_info.php");