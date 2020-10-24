<?php
class BlogDetailController {
	public static $page = 'blog-detail';
	public static function actionIndex($blog_id) {
		$title = 'Детально об этой статье';
		$description = 'Эта статья написана нашими сотрудниками для общего обозрения';
		// $main_manu = CoreController::getMainMenu();

		// заносит в бд количество просморов
		$vievs = Blog::viewsUpdate($blog_id);
		$blogs = Blog::getById($blog_id);
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/blog/blog-detail.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>