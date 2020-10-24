<?php
class AboutController {
	public static $page = 'about';
	public static function actionIndex() {
		$title = 'О клубе Спорт Лайф';
		$description = 'Фитнес клуб Спорт Лайф расположен в самом сердце Чернигова по улице Пятницкой.';
		// $main_manu = CoreController::getMainMenu();
		$abouts = About::getAbouts();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . "/views/about/about.php";
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>