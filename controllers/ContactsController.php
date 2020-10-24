<?php
class ContactsController {
	public static $page = 'contacts';
	public static function actionIndex() {
		$title = 'Контакты клуба Спорт Лайф в Чернигове';
		$description = 'Фитнес клуб Спорт Лайф находиться в центре города Чернигов, по адресу ул. Пятницкая 72';
		$razmetca = '{
			"@context": "http://www.schema.org",
			"@type": "Organization",
			"name": "Фитнес клуб Sport Life в г. Чернигов",
			"url": "http://sport-life.fun/contacts",
			"description": "Клуб находиться в центре Чернигова не далеко от ТРЦ Мегацентр",
			"address": {
			  "@type": "PostalAddress",
			  "streetAddress": "ул. Пятницкая 72",
			  "addressLocality": "Чернигов",
			  "postalCode": "16000"
			},
			"contactPoint": {
			  "@type": "ContactPoint",
			  "telephone": "+3 8(093)745 97 12"
			}
		  }';
		// $razmetca = 
		// $main_manu = CoreController::getMainMenu();
		$contacts = Contacts::getContact();
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/contacts/contacts.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>
