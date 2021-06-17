<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>
<?php require(View ."/user_sys_messages.php"); ?>

<h3>Додати до бази нового викладача: </h3>

<form action="<?php echo WWW ."/add-teacher" ?>" method="POST" class="add-teacher">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Прізвище</label>
		<div class="col-sm-2">
			<input type="text" name="surname" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Ім'я</label>
		<div class="col-sm-2">
			<input type="text" name="name" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">По батькові</label>
		<div class="col-sm-2">
			<input type="text" name="patronymic" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Номер телефону</label>
		<div class="col-sm-2">
			<input type="text" name="phone_number" class="form-control" placeholder="">
		</div>
	</div>

	<button type="submit" name="add_teacher" class="btn-add">Додати</button>
</form>