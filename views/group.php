<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>

<h3>Загальна інформація про студентів групи <?php echo $Data["students"][0]["cipher"] ." (". $Data["students"][0]["course"] ." курс) | Куратор: ". $Data["students"][0]["surname_teacher"] ." ". $Data["students"][0]["name_teacher"] ." ". $Data["students"][0]["patronymic_teacher"]; ?></h3>

<div class="student-table">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col">#</th>
				<th scope="col">Прізвище</th>
				<th scope="col">Ім'я</th>
				<th scope="col">По батькові</th>
				<th scope="col">Дата народження</th>
				<th scope="col">Адреса</th>
				<th scope="col">Номер телефону</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($Data["students"] as $key => $students) { ?>
				<tr>
					<th scope="row"><?php echo ($key+1) ?></th>
					<td><?php echo $students["surname"] ?></td>
					<td><?php echo $students["name"] ?></td>
					<td><?php echo $students["patronymic"] ?></td>
					<td><?php echo $students["date_of_birth"] ?></td>
					<td><?php echo $students["address"] ?></td>
					<td><?php echo $students["phone_number"] ?></td>
				</tr>
			<?php } ?>			
		</tbody>
	</table>
</div>