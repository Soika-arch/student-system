<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>
<?php require(View ."/user_sys_messages.php"); ?>

<h3>Додати до бази нову дисципліну: </h3>

<form action="<?php echo WWW ."/add-disciplines" ?>" method="POST" class="add-disciplines">
	<div class="form-group row">
		<label for="inputEmail3" class="col-sm-2 col-form-label">Назва</label>
		<div class="col-sm-2">
			<input type="text" name="name_discipline" required class="form-control" placeholder="">
		</div>
	</div>
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Оберіть групу</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<?php foreach ($Data["groups"] as $key => $groups) { ?>
					<input type="checkbox" name="id_gr[]" value="<?php echo $groups["id"]; ?>"><?php echo $groups["cipher"]; ?><br>
					<?php } ?>
				</div>
			</div>
		</div>
	</fieldset>
	<button type="submit" name="add_disciplines" class="btn-add">Додати</button>
</form>