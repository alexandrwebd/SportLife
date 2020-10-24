<?php 
class CoreController {
	public static function getMainMenu() {
		$menu = array(
			array(
				'text' => '',
				'href' => '/main',
				'page' => 'main'
				),
			array(
				'text' => 'О клубе',
				'href' => '/about',
				'page' => 'about'
				),
			array(
				'text' => 'Услуги',
				'href' => '/service',
				'page' => 'service'
				),
			array(
				'text' => 'Цены',
				'href' => '/prices',
				'page' => 'prices'
				),
			array(
				'text' => 'Команда',
				'href' => '/team',
				'page' => 'team'
				),
			array(
				'text' => 'Галерея',
				'href' => '/gallery',
				'page' => 'gallery'
				),
			array(
				'text' => 'Блог',
				'href' => '/blog',
				'page' => 'blog'
				),
			array(
				'text' => 'Контакты',
				'href' => '/contacts',
				'page' => 'contacts'
				),

		);
		return $menu;
	}	
}
?>