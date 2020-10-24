<?php
class ReviewController
{
	// public static function actionShowPage($place_id, $page) {
	// 	$reviews = Review::getReviewsPage($place_id, $page, 5);
	// 	require_once (ROOT . '/views/review/indexAjax.php');
	// }

	public static function actionAdd()
	{
		$options = array(
			'name' => $_POST['name'],
			'email' => $_POST['email'],
			'text' => $_POST['text'],
			'author_id' => $_SESSION['user']['id'],
			'status' => 'hidden',
		);
		$errorFlag = false;
		if (!Review::add($options)) {
			$errorFlag = true;
		}

		if ($errorFlag === true) {
			ErrorHandle::printMessage('Ошибка БД');
		} else {
			echo 'success';
			exit();
		}

		return true;
	}
}
