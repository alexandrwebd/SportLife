<?php include_once ROOT . '/views/layout/adminHeader.php' ?>

		<section id="main-content" class="column column-offset-20">
			<div class="row grid-responsive content__admin">
				<div class="column page-heading">
					<div class="large-card">
						<h1>Админ панель</h1>
						<h4>Привет <?= $_SESSION['user']['name'] ?> <?= $_SESSION['user']['surname'] ?></h4>
						<p class="text-large">В админ панеле вы можете добавлять данные на сайт, редактировать и удалять данные.</p>
						<p>Также здесь вы можите управлять данными пользователей <em>и своим профилем</em></p>
						<a class="button">Редактировать профиль</a>
					</div>
				</div>
			</div>
			
			
			
			
			<?php include_once ROOT . '/views/layout/adminFooter.php' ?>		
		