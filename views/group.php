<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>

<h3>Загальна інформація про студентів групи <?php echo $Data["students"][0]["cipher"] ." (". $Data["students"][0]["course"] ." курс) | Куратор: ". $Data["students"][0]["surname_teacher"] ." ". $Data["students"][0]["name_teacher"] ." ". $Data["students"][0]["patronymic_teacher"]; ?></h3>
<div class="change-data">
	<a href="">Змінити курс</a>
	<a href="">Змінити куратора</a>
</div>

<div class="student-table">
	<table class="table">
		<thead class="thead-light">
			<tr>
				<th scope="col"></th>
				<th scope="col">#</th>
				<th scope="col">Прізвище</th>
				<th scope="col">Ім'я</th>
				<th scope="col">По батькові</th>
				<th scope="col">Форма навчання</th>
				<th scope="col">Телефон</th>
				<th scope="col">Примітка</th>				
			</tr>
		</thead>
		<tbody>
			<?php foreach ($Data["students"] as $key => $students) { ?>
				<tr>
					<td>Видалити</td>
					<th scope="row"><?php echo ($key+1) ?></th>
					<?php  
						$u = WWW ."/student-info?id=". $students["id"];
						echo "<td><a href='{$u}'>". $students["surname"] ."</a></td>";
					?>
					<td><?php echo $students["name"] ?></td>
					<td><?php echo $students["patronymic"] ?></td>
					<td>
						<?php 
							if ($students["form_of_education"] == "b") {
								echo " ";
							}
							elseif ($students["form_of_education"] == "c") {
								echo "К";
							}
						?>
					<td><?php echo $students["phone_number_student"] ?></td>
					<td><?php echo $students["remark"] ?></td>
				</tr>
			<?php } ?>			
		</tbody>
	</table>
</div>

