<?php
class MainController extends CoreController{
	public static $page = 'main';
   
	public static function actionIndex() {
		$page = 'main';
		$razmetca = ' {
			"@context": "http://www.schema.org",
			"@type": "WebSite",
			"name": "Фитнес клуб Sport Life в Чернигове",
			"url": "http://sport-life.fun"
		  }';
		$title = 'Фитнес клуб Спорт Лайф Чернигов';
		$description = '💪«Sport Life» в Чернигове👈  — это спортивный клуб, который разположен в самом центре города, вмещает в себе фитнес зоны как для тренировок в классических стандартах, так и новые модные тенденции в фитнес индустрии.';
		// $main_manu = CoreController::getMainMenu();
		$services = Service::getServices();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		$header_slider = Main::getHeaderSlider();
		$reviews = Review::getReviewsByStatus(8);
		$maim_pages = Main::getMainPages();
		$advantages = Main::getAdvantages();
		
		require_once ROOT . "/views/main_page/index.php";
		// require_once ROOT . "/views/main_page/sidebar.php";
	}

	public static function actionSitemap() {
		header('Content-type: text/xml');
		header('Content-type: application/xhtml+xml');
		header('Content-type: application/xml');
	 
		  require_once ROOT . "/sitemap.php";
	
	}
}

?>