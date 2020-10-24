<?php
class CabinetController
{
	public static function actionIndex()
	{
		// проверяем залогинен ли пользователь
		if (User::isAuth()) {
			// получаем id с сесии
			$userId = $_SESSION['user']['id'];
			// получаем usera по id
			$user = User::getUserById($userId);
			$name = $user['name'];
			$password = $user['pass_hash'];

			$footer_blogs = Blog::getBlogsFooter(3);
			include_once ROOT . '/views/cabinet/cabinet.php';
		} else {
			header("Location: /");
		}
	}

	// Добавление фото профиля пользователя
	public static function actionAdd()
	{
		// получаем id с сесии
		$userId = $_SESSION['user']['id'];
		$user = User::getUserById($userId);

		$user_img = $user['profile_img'];

		$result = false;

		if (isset($_POST['submit'])) {

			// добавление изобрпжения пользователя
			if (!$result) {
				try {
					// Проверяем загрузилось ли через форму изображение
					if (is_uploaded_file($_FILES['image']['tmp_name'])) {

						$tmp_img = $_FILES['image']['tmp_name'];
						$error_img = $_FILES['image']['error'];
						$size_img = $_FILES['image']['size'];
						$url_img = '/public/images/profile/';
						//Проверяем значение ошибки и не превышен ли допустимый размер	 
						if ($error_img !== true && $size_img <= 3000000) {
							// если загрузилось переносим его в новую папку и даем новое имя
							$name_file = User::saveImage($_FILES['image'], $userId, $url_img);
							// добавляем новый выйл в базу данных
							$flag = User::updateImageTable($name_file, $userId);
						} else {
							$error_messages[] = "Ошибка при загрузке фото!";
						}
					}
				} catch (PDOException $e) {
					ErrorHandle::printMessage($e->getMessage());
					exit();
				}
			};
		}

		include_once ROOT . '/views/cabinet/edit.php';
	}

	// Редактировать данные пользователя
	public static function actionEdit()
	{
		$userId = $_SESSION['user']['id'];
		// получаю данные usera по id
		$user = User::getUserById($userId);
		$login = $user['login'];
		$password = $user['pass_hash'];
		$user_img = $user['profile_img'];

		$result = false;

		if (isset($_POST['submit'])) {
			$login = $_POST['login'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$error_messages = false;

			if (strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30) {

				$error_messages = "Логин должен быть не меньше 3-х символов и не больше 30";
				// header('Location: /registration');
				// exit;
			}

			// обновление данных пользователя
			if ($error_messages == false) {
				$result = User::edit($userId, $login, $password);
			}

			// добавление изобрпжения пользователя
			if ($result) {
				try {
					// Проверяем загрузилось ли через форму изображение
					if (is_uploaded_file($_FILES['image']['tmp_name'])) {

						$tmp_img = $_FILES['image']['tmp_name'];
						$error_img = $_FILES['image']['error'];
						$size_img = $_FILES['image']['size'];
						$url_img = '/public/images/profile/';
						//Проверяем значение ошибки и не превышен ли допустимый размер	 
						if ($error_img !== true && $size_img <= 3000000) {
							// если загрузилось переносим его в новую папку и даем новое имя
							$name_file = User::saveImage($_FILES['image'], $userId, $url_img);
							// добавляем новый выйл в базу данных
							$flag = User::updateImageTable($name_file, $userId);

							// если изображение в базе обновилось
							if ($flag) {
								// удаляем файл с диска
								$delit = unlink($_SERVER['DOCUMENT_ROOT'] . $url_img . $user_img);
							} else {
								$error_messages[] = "Ошибка при обновлении изображения!";
							}
						} else {
							$error_messages[] = "Ошибка при загрузке фото!";
						}
					}
				} catch (PDOException $e) {
					ErrorHandle::printMessage($e->getMessage());
					exit();
				}
			};
		}

		include_once ROOT . '/views/cabinet/edit.php';
	}

	public static function actionMail()
	{
		// проверяем залогинен ли пользователь
		if (User::isAuth()) {
			// получаем id с сесии
			$userId = $_SESSION['user']['id'];
			// получаем usera по id
			$user = User::getUserById($userId);
			$name = $user['name'];
			$email = $user['email'];
			$email = $user['email'];

			

			if (isset($_POST['submit']) && !empty($_POST['text'])) {
				$text = $_POST['text'];

				$error_messages = false;

				 //если проверки пройдены формирую письмо
				 $to  = 'sportlife.best@gmail.com';
				 $message_theme = "Сообщение с кабинета";
				 $message = "Пользователь: {$name} с email: {$email}, отправил вам сообщение:" . "\r\n" . $text;
				 $subject = '=?utf-8?b?' . base64_encode($message_theme) . '?=';
				 $fromMail = $email;
				 $fromName = $name;
				 $date = date(DATE_RFC2822);
				 $messageId = '<' . time() . '-' . md5($fromMail . $to) . '@' . $_SERVER['SERVER_NAME'] . '>';
				 $headers  = 'MIME-Version: 1.0' . "\r\n";
				 $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
				 $headers .= "From: " . $fromName . " <" . $fromMail . "> \r\n";
				 $headers .= "Date: " . $date . " \r\n";
				 $headers .= "Message-ID: " . $messageId . " \r\n";
 
				 // отправка письма
				 $success = mail($to, $subject, $message, $headers);
				 // если успех возвращаем сообщение 
				 if($success){
					$error_messages[] = 'Спасибо, ваше сообщение отправлено. Мы свяжемся с Вами.';
				 } else {
					$error_messages[] = 'Ошибка отправки сообщения';
				 }
	
			} 
		
			include_once ROOT . '/views/cabinet/mail.php';
		} else {
			header("Location: /");
		}
	}
}
