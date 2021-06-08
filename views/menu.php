<?php 

$sql = "SELECT id, cipher FROM groups ORDER BY id";
$Data["groups"] = db_query($sql);

?>

<header>
	<nav class="dws-menu">
		<ul>
			<li><a href="<?php echo WWW ."/general" ?>"><i class="fas fa-home"></i>Головна</a></li>
			<li><a href=""><i class="fas fa-user-graduate"></i>Студенти</a>
				<ul>
					<?php
					foreach ($Data["groups"] as $key => $group) { 
						$url = WWW ."/group?id=". $group["id"];
						$name = $group["cipher"];
						echo "<li><a href=$url>$name</a></li>";
					} ?>
				</ul>
			</li>
			<li><a href=""><i class="fas fa-clipboard-check"></i>Успішність</a>
				<ul>
				   <li><a href="#"></a></li>
				   <li><a href="#"></a></li>
				   <li><a href="#"></a></li>
				   <li><a href="#"></a></li>
				   <li><a href="#"></a></li>
				</ul>
			</li>
			<li><a href=""><i class="far fa-calendar-alt"></i>Відвідуваність</a>
				<ul>
					<?php
					foreach ($Data["groups"] as $key => $group) { 
						$url = WWW ."/attendance?id=". $group["id"];
						$name = $group["cipher"];
						echo "<li><a href=$url>$name</a></li>";
					} ?>
				</ul>
			</li>
			<li><a href=""><i class="fas fa-edit"></i>Додати</a>
				<ul>
				   <?php echo "<li><a href='". WWW ."/add-group'>Групу</a></li>"; ?>
				   <?php echo "<li><a href='". WWW ."/add-student'>Студента</a></li>"; ?>
				</ul>
			</li>
		</ul>
	</nav>
</header>













