<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>
<?php require(View ."/user_sys_messages.php"); ?>

<h3>Додати до бази нового студента: </h3>
<form action="<?php echo WWW ."/add-student" ?>" method="POST" class="add-student">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Оберіть групу</label>
		<div class="col-sm-2">
			<select name="studentGroup" class="form-control">
				<?php foreach ($Data["groups"] as $key => $groups) { ?>
				<option value="<?php echo $groups["id"]; ?>"><?php echo $groups["cipher"]; ?></option>
				<?php } ?>
			</select>
		</div>	
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Прізвище</label>
		<div class="col-sm-2">
			<input type="text" name="surname_student" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Ім'я</label>
		<div class="col-sm-2">
			<input type="text" name="name_student" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">По батькові</label>
		<div class="col-sm-2">
			<input type="text" name="patronymic_student" required class="form-control" placeholder="">
		</div>
	</div>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Стать</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="m" required>
					<label class="form-check-label" for="gridRadios1">Ч</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="w">
					<label class="form-check-label" for="gridRadios2">Ж</label>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Форма навчання</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="form_of_education" id="gridRadios1" value="b" required>
					<label class="form-check-label" for="gridRadios1">Бюджетна</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="form_of_education" id="gridRadios2" value="c">
					<label class="form-check-label" for="gridRadios2">Контрактна</label>
				</div>
			</div>
		</div>
	</fieldset>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">9/11 клас</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="refill" id="gridRadios1" value="9" required>
					<label class="form-check-label" for="gridRadios1">9</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="refill" id="gridRadios2" value="11">
					<label class="form-check-label" for="gridRadios2">11</label>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-group row">
		<label for="example-date-input" class="col-sm-2 col-form-label">Дата народження</label>
		<div class="col-sm-2">
			<input name="dateBirth_student" required class="form-control" type="date" value="" id="example-date-input">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Адреса</label>
		<div class="col-sm-2">
			<input type="text" name="address_student" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Номер телефону студента</label>
		<div class="col-sm-2">
			<input type="text" name="phone_number_student" required class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Номер телефону батьків</label>
		<div class="col-sm-2">
			<input type="text" name="phone_number_parent" class="form-control" placeholder="">
		</div>
	</div>
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Примітка</label>
		<div class="col-sm-2">
			<input type="text" name="remark" class="form-control">
		</div>
	</div>

	<button type="submit" name="add_student" class="btn-add">Додати</button>
</form>


