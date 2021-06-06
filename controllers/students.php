<?php 

$sql = "
SELECT 
	students.*,
	groups.id,
	groups.cipher
FROM
	students
JOIN
	groups
ON 
	groups.id = students.id_group
WHERE 
	groups.id = {$_GET["id"]}";


$Data["students"] = db_query($sql);





require(View ."/students.php");