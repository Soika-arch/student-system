<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>

<?php 
	$sql = "SELECT id, cipher FROM groups ORDER BY id";
	$Data["groups"] = db_query($sql);
?>

<h3>Перегляд академічної успішності студентів групи <?php echo $Data["groups"][0]["cipher"]; ?></h3>

<header>
	<nav class="dws-menu">
		<ul>
			<li><a href="<?php echo addGetParam($Data["url"], "control", "atestatsiyi"); ?>">Атестації</a></li>
			<li><a href="<?php echo addGetParam($Data["url"], "control", "zaliky"); ?>">Заліки</a></li>
			<li><a href="<?php echo addGetParam($Data["url"], "control", "ispyty"); ?>">Іспити</a></li>
			<li><a href="<?php echo addGetParam($Data["url"], "control", "praktyka"); ?>">Практика</a></li>
		</ul>
	</nav>
</header>

<h3>Оберіть дату</h3>

<form action="<?php echo $Data["url"]; ?>" method="POST" class="date-select">
	<div class="form-group row">
		<div class="form-group col-md-2">
			<select name="month" class="form-control">
				<?php 
				if (isset($_POST["select_date"])) {
					foreach ($Data["session_months"] as $key => $date) {
						$n = $date["m"] - 1;
						if ($date["m"] == $_POST["month"]) {
							echo "<option value='{$date["m"]}' selected>{$Data["ua_months"][$n]}</option>";
						}
						else {
							echo "<option value='{$date["m"]}'>{$Data["ua_months"][$n]}</option>";
						}
					}
				}
				else {
				?>
				<?php 
				foreach ($Data["ua_months"] as $key => $month) {
					if (($key + 1) == $Data["month"]) {
						echo "<option value=". ($key + 1) ." selected>{$month}</option>";
					}
					else {
						echo "<option value=". ($key + 1) .">{$month}</option>";
					}
				}
				?>
				<?php } // конец else ?>
			</select>
			<select name="year" class="form-control">
				<?php 
				foreach ($Data["session_years"] as $key => $year) {
					if ($year["y"] == $Data["year"]) {
						echo "<option selected>{$year["y"]}</option>";
					}
					else {
						echo "<option>{$year["y"]}</option>";
					}
				}
				?>
			</select>
		</div>
	</div>
	<input type="submit" name="select_date" value="Обрати">
	<?php echo "<a href='". WWW ."/academic-performance?id=". $_GET["id"] ."' class='submit-button'>Сброс</a>"; ?>
</form>

<?php if (isset($_GET["control"])) { ?>
<div class="academic-table">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col" width="3%" rowspan="2">#</th>
				<th scope="col" width="10%" rowspan="2">Прізвище</th>
				<th colspan="<?php echo count($Data["group_disciplines"]); ?>">Дисципліни</th>
			</tr>
			<tr>
				<?php
				foreach ($Data["group_disciplines"] as $key => $discipline) {
					echo "<th>{$discipline["name"]}</th>";
				}
				?>
			</tr>
		</thead>
		<tbody>
			<?php
			// Обход всех студентов с их оценками.
			foreach ($Data["student_points"] as $key => $studentPoints) { ?>
				<tr>
					<td scope="row"><?php echo ($key+1) ?></td>
					<?php
					$student = $studentPoints["student"];
					$points = $studentPoints["points"];
					$url = WWW ."/academic-student?id=". $student["id_student"] .
						"&year=". $Data["year"] ."&month=". $Data["month"];
					echo "<td><a href='{$url}'>". $student["surname"] ."</a></td>";
					for ($i = 0; $i < count($Data["group_disciplines"]); $i++) {
						// Обход ячеек дисциплин.

						foreach ($points as $k => $point) {
							// Если для ячейки текущей дисциплины есть оценка в $point["id_discipline"] - вывод оценки
							// иначе вывод пустой ячейки.

							$content = false;
							if ($point["id_discipline"] == $Data["group_disciplines"][$i]["id"]) {
								echo "<td>{$point['point']}</td>";
								// Найдена оценка. Выход из цикла.
								$content = true;
								break;
							}
						}
						if (!$content) {
							// $content == false - оценка не найдена. Вывод пустой ячейки.
							echo "<td></td>";
						}
					}
					?>
				</tr>
			<?php } ?>			
		</tbody>
	</table>
</div>
<?php } // конец if. ?>
