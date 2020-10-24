<?php
class GalleryController {
	public static $page = 'gallery';
	public static function actionIndex() {
		$page = 'gallery';
		$title = 'Галерея клуба Спорт Лайф в Чернигове';
		$description = 'У нас есть много красивых фотографий с жизни нашего зала, и всех мероприятий.';
		$razmetca = '{
			"@context": "http://www.schema.org",
			"@type": "WebSite",
			"name": "Много красивых фотографий в фитнес клубе Sport Life",
			"url": "http://sport-life.fun/gallery"
	  }';
		// $main_manu = CoreController::getMainMenu();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/gallery/gallery.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>