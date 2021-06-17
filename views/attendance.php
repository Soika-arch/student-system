<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>

<?php 
	$sql = "SELECT id, cipher FROM groups ORDER BY id";
	$Data["groups"] = db_query($sql);
?>

<h3>Перегляд відвідуваності занять студентами групи <?php echo $Data["groups"][0]["cipher"]; ?></h3>

<form action="<?php echo WWW ."/attendance?id=". $_GET['id']; ?>" method="POST" class="date-select">
	<div class="form-group row">
		<?php // debug($Data["ua_months"], __FILE__, __LINE__, 1); ?>
		<div class="form-group col-md-2">
			<select name="month" class="form-control">
				<?php 
				if (isset($_POST["select_date"])) {
					foreach ($Data["missing_months"] as $key => $date) {
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
				foreach ($Data["missing_years"] as $key => $year) {
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
	<?php echo "<a href='". WWW ."/attendance?id=". $_GET["id"] ."' class='submit-button'>Сброс</a>"; ?>
</form>
<style type="text/css">
	tr, th, td {
		border: solid 1px #000;
	}
	tr th {
		border: solid 1px #000;
	}
</style>
<div class="attendance-table">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Прізвище</th>

				<?php for ($i = 1; $i <= $Data["days_in_month"]; $i++) {
    				echo "<th scope='col'>$i</th>";
				} ?>

				<th scope="col">За місяць</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$n = 1; // Номер строки с фамилией студента.
			$totalHours = 0; // Общее кол-во часов пропуска за месяц всей группы.
			?>
			<?php
			// Каждая итерация берет все пропуски одного студента за месяц.
			foreach ($Data["attendance"] as $surname => $missing) { ?>
				<?php
				$studentTotalHours = 0; // Общее кол-во часов пропуска за месяц для каждого студента.
				?>
				<tr>
					<th scope="col"><?php echo ($n); $n++ ?></th>
					<td><?php echo $surname ?></td>

					<?php
					// Каждая итерация - один календарный день выбранного месяца.
					for ($d = 1; $d <= $Data["days_in_month"]; $d++) {
						$currentMissing = []; // Найденный пропуск за текущий день цикла.
						// Поиск в массиве пропусков $missing текущего дня цикла.
						for ($j = 0; $j < count($missing); $j++) {
							if ($missing[$j]["num_day"] == $d) {
								$totalHours = $totalHours + $missing[$j]["hours"];
								$studentTotalHours = $studentTotalHours + $missing[$j]["hours"];
								$currentMissing = $missing[$j];
								$j = count($missing);
							}
						}

						if ($currentMissing !== []) {
							echo "<td>". $currentMissing["hours"] ."</td>";
							if (isset($Data["missing_for_days"][$d])) {
								$Data["missing_for_days"][$d] = $Data["missing_for_days"][$d] + $currentMissing["hours"];
							}
							else {
								$Data["missing_for_days"][$d] = $currentMissing["hours"];
							}
						}
						else {
							echo "<td></td>";
						}
					}
					?>
					<td><?php echo $studentTotalHours ?></td>

				</tr>
			<?php } ?>
				<tr>
					<td colspan="2">Всього за день:</td>
					<?php 
					// Вывод суммы пропусков за каждый день.
					for ($i = 1; $i <= $Data["days_in_month"]; $i++) {
						if (array_key_exists($i, $Data["missing_for_days"])) {
							echo "<td>". $Data["missing_for_days"][$i] ."</td>";
						}
						else {
							echo "<td></td>";
						}
					}
					echo "<td><b>$totalHours</b></td>";
					?>
				</tr>			
		</tbody>
	</table>
</div>

