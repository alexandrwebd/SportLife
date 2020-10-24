<?php
class ServicesDetailController {
	public static $page = 'services-detail';
	public static function actionIndex($service_id) {
		$title = 'Детально об этой услуге';
		$description = 'Услуга доступна в фитнес клубе Спорт Лайф под контролем квалифицырованых тренеров';
		// $main_manu = CoreController::getMainMenu();
		$services = Service::getById($service_id);
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		// $services = Service::getServices();
		include_once ROOT . "/views/layout/header-top.php";
		include_once ROOT . "/views/service/services-detail.php";
		include_once ROOT . "/views/layout/footer.php";
	}
}



?>