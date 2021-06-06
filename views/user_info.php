
<div class="user-info">
	<?php 
		if ($_SESSION["user"]["is"]) {
			echo "Користувач: ". $_SESSION["user"]["login"];
	} ?>
</div>

