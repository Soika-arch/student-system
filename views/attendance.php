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
		<div class="form-group col-md-2">
			<select name="month" class="form-control">
				<option value="1">Січень</option>
				<option value="2">Лютий</option>
				<option value="3">Березень</option>
				<option value="4">Квітень</option>
				<option value="5">Травень</option>
				<option value="6">Червень</option>
				<option value="7">Липень</option>
				<option value="8">Серпень</option>
				<option value="9">Вересень</option>
				<option value="10">Жовтень</option>
				<option value="11">Листопад</option>
				<option value="12">Грудень</option>
			</select>
			<select name="year" class="form-control">
				<option>2020</option>
				<option selected>2021</option>
			</select>
		</div>
	</div>
	<input type="submit" name="select_date" value="Обрати">
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
							echo "<td>бп</td>";
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

