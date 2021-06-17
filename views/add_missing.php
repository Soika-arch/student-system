<?php require_once(View ."/header.php"); ?>
<?php require(View ."/user_info.php"); ?>
<?php require(View ."/menu.php"); ?>
<?php require(View ."/user_sys_messages.php"); ?>

<h3>Додати до бази нові пропуски занять: </h3>

<form action="<?php echo WWW ."/add-missing" ?>" method="POST" class="add-missing">
	<fieldset class="form-group">
		<div class="row">
			<legend class="col-form-label col-sm-2 pt-0">Оберіть групу</legend>
			<div class="col-sm-10">
				<div class="form-check">
					<?php foreach ($Data["groups"] as $key => $groups) { ?>
						<input required class="form-check-input" type="radio" name="groups" id="gridRadios1" 
							value=" <?php echo $groups["id"]; ?>"><?php echo $groups["cipher"]; ?><br>
					<?php } ?>
				</div>
			</div>
		</div>
	</fieldset>
	<input type="submit" name="select_group" class="btn-add" value="Обрати"></input>
</form>

<?php if (isset($_POST["select_group"])) { ?>
	<form action="<?php echo WWW ."/add-missing" ?>" method="POST" class="add-missing">
		<div class="">
			<label for="example-date-input" class="col-2 col-form-label">Дата</label>
			<div>
				<input name="date_missing" class="form-control" type="date" value="" id="example-date-input">
			</div>
		</div>
		<div class="add-mis-table">
			<table class="table">
				<tbody>
					<?php foreach ($Data["group_students"] as $key => $student) { ?>
						<tr>
							<td><?php echo $student["surname"]; ?></td>
							<td>
								<select name="mis_hours">
									<option value="0" selected>0</option>
									<option value="2">2</option>
									<option value="4">4</option>
									<option value="6">6</option>
									<option value="8">8</option>
								</select>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<input type="submit" name="add_missing" class="btn-add" value="Додати"></input>
	</form>
<?php } ?>	


