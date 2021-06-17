<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>
<?php require(View ."/user_sys_messages.php"); ?>



<h3>Додати до бази нову групу: </h3>
<form action="<?php echo WWW ."/add-group" ?>" method="POST" class="add-group">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Шифр групи</label>
		<div class="col-sm-2">
			<input type="text" name="cipher" required class="form-control" placeholder="">
		</div>
	</div>

	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Курс</label>
		<div class="col-sm-2">
			<select name="course" class="form-control">
				<option>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
			</select>
		</div>
	</div>

	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Куратор</label>
		<div class="col-sm-2">
			<select name="teacherGroup" class="form-control">
				<?php foreach ($Data["teachers"] as $key => $teachers) { ?>
				<option value="<?php echo $teachers["id"]; ?>"><?php echo $teachers["surname"]; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<button type="submit" name="add_group" class="btn-add">Додати</button>
</form>



