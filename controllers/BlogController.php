<?php
class BlogController {
	public static $page = 'blog';
	public static function actionIndex() {
		$title = 'Блог клуба Спорт Лайф в Чернигове';
		$description = 'Тренера Спорт Лайфа публикуют интерестные статьи которые несут очень важную и полезную информацию.';
		$razmetca = '{
			"@context": "http://www.schema.org",
			"@type": "WebSite",
			"name": "Читайте интерестные статьи в блоге Sport Life",
			"url": "http://sport-life.fun/blog"
	  }';
		// $main_manu = CoreController::getMainMenu();
		$num = 9;
		$blogs = Blog::getBlogs($num);
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		$temp = Blog::getCountBlogs();
		
		// способ пагинации по запросам в бд *******************

		// текущая страница
		if (isset($_GET['page'])){
			$page = $_GET['page'];
		}else{
			$page = 1;
		}
		$from = ($page - 1) * $num;
	
		$tempcount = $temp['count']; // общее количество товаров

		if($tempcount > 0){
		// 	// находим общее число страниц с округлением в большую сторону
		// 	$total = (($tempcount - 1) / $num) + 1;
		// 	$total = intval($total); // округление к целому
		 $total = ceil($tempcount / $num);

		// 	if(empty($page) or $page < 0) $page = 1;
		// 		if($page > $total) $page = $total;

		// 		// вычисляем начиная с какого номера следует выводить товары
		// 		$start = $page * $num - $num;

			$query_start_num = " LIMIT $from, $num";
		}

		$result = Blog::getBlog($query_start_num);

		$output = '';
		$output .= '<div class="pagination">';
		if($page != 1){
			$pstr_prev = '<a href="?page='.($page - 1).'">Предыдущая</a>';
			$output .= '<div class="pagination__left">'.$pstr_prev.'</div>';
		}
		

		$output .= '<div class="pagination__mid">';
		// for ($i = 1; $i <= $total; $i++){
		// 	// $output .= "<a href=\"?page=$i\">$i</a>"; // вывод нумерованой пагинации
		// }
		$output .= "<a href=\"?page=$page\">$page</a>";
		$output .= '<span>/</span>';
		$output .= "<a href=\"?page=$total\">$total</a>";
		$output .= '</div>';
		if($page != $total){
			$pstr_next = '<a href="?page='.($page + 1).'">Следующая</a>';
			$output .= '<div class="pagination__right">'.$pstr_next.'</div>';
		}
		$output .= '</div>';

		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/blog/blog.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>