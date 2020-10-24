<?php
class TeamController {
	public static $page = 'team';
	public static function actionIndex() {
		$title = 'Команда тренеров в Спорт Лайф Чернигов';
		$description = 'У нас работают провесианальные тренера, мастера спорта, участники многих соревнований.';
		$razmetca = '{
			"@context": "http://www.schema.org",
			"@type": "WebSite",
			"name": "Команда специальстов в фитнес клубе Sport Life",
			"url": "http://sport-life.fun/team"
	  }';
		// $main_manu = CoreController::getMainMenu();

		$trainers = Team::getTrainers();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);

		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/team/team.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}
