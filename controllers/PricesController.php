<?php
class PricesController {
	public static $page = 'prices';
	public static function actionIndex() {
		$title = 'Цены в Спорт Лайф Чернигов';
		$description = 'Мы порадуем вас доступными ценами на абонимент и интерестними акциями.';
		$razmetca = '{
			"@context": "http://www.schema.org",
			"@type": "WebSite",
			"name": "Тренажерный зал Sport Life цены",
			"url": "http://sport-life.fun/prices"
	  }';
		// $main_manu = CoreController::getMainMenu();
		$prices = Prices::getPrices();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . "/views/prices/prices.php";
		include_once ROOT . '/views/layout/footer.php';
	}
}
