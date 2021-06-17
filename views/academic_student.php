<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>

<h3>Перегляд успішності студента <?php echo $Data["academic"][0]["surname"] . ' ' . $Data["academic"][0]["name_student"] . ' ' .
	$Data["academic"][0]["patronymic"]; ?></h3>

<?php debug($_GET, __FILE__, __LINE__, 1); ?>