<?php
class ServiceController {
	public static $page = 'service';
	public static function actionIndex() {
		$title = 'Услуги в клубе Спорт Лайф Чернигов';
		$description = 'Весь перечень услуг, предоставляемых нашим клубом, выберите занятие по душе!';
		$razmetca = '{
				"@context": "http://www.schema.org",
				"@type": "WebSite",
				"name": " Услуги предоставляемые клубом Sport Life в Чернигове",
				"url": "http://sport-life.fun/service"
		  }';
		// $main_manu = CoreController::getMainMenu();
		$services = Service::getServices();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . "/views/service/service.php";
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>