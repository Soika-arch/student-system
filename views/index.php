<?php require_once(View ."/header.php"); ?>


	<div class="authorization">
		<h1>Вітаємо!</h1>

		<div class="authorization_container">
			<section id="content">
				<form action="<?php echo WWW; ?>" method='POST'>
					<h1>Авторизація</h1>
					<div>
						<input type="text" name="login" placeholder="Логін" required="" id="username" />
					</div>
					<div>
						<input type="password" name="password" placeholder="Пароль" required="" id="password" />
					</div>
					<div>
						<input type="submit" name="loginOk" value="Увійти" />
					</div>
				</form>	
			</section>
		</div>
	</div>





