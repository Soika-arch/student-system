<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>

<h3>Додаткова особиста інформація про студента </h3></br>

<?php foreach ($Data["student"] as $key => $student) { ?>
	<h2><?php echo $student["surname"] . " " . $student["name"] . " " . $student["patronymic"]; ?></h2>

<div class="student-info-table">
	<table class="table">
		<tbody>
			<tr>
				<td>Група</td>
				<td><?php echo $student["cipher"] ?></td>
				<td>Змінити</td>
			</tr>
			<tr>
				<td>Дата народження</td>
				<td><?php echo $student["date_of_birth"] ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Адреса</td>
				<td><?php echo $student["address"] ?></td>
				<td>Змінити</td>
			</tr>
			<tr>
				<td>Форма навчання</td>
				<td>
				<?php 
					if ($student["form_of_education"] == "b") {
						echo "бюджет";
					}
					elseif ($students["form_of_education"] == "c") {
						echo "контракт";
				}?>
				</td>
				<td>Змінити</td>
			</tr>
			<tr>
				<td>На базі 9/11 класів</td>
				<td><?php echo $student["refill"] ?></td>
				<td></td>
			</tr>
			<tr>
				<td>Телефон студента</td>
				<td><?php echo $student["phone_number_student"] ?></td>
				<td>Змінити</td>
			</tr>
			<tr>
				<td>Телефон батьків</td>
				<td><?php echo $student["phone_number_parent"] ?></td>
				<td>Змінити</td>
			</tr>
			<tr>
				<td>Примітка</td>
				<td><?php echo $student["remark"] ?></td>
				<td>Змінити</td>
			</tr>
		</tbody>
	</table>
</div>
<?php } ?>	


