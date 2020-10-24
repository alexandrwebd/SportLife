<?php
class RegistrationController {
	public static $page = 'registration';
	public static function actionRegisterIndex() {
		// $main_manu = CoreController::getMainMenu();

		if(isset($_POST['form_send']) && $_POST['form_send'] == '1'){

			$error_messages = array();

				if(
					isset($_POST['login']) && !empty($_POST['login']) &&
					isset($_POST['password']) && !empty($_POST['password']) &&
					isset($_POST['email']) && !empty($_POST['email'])
				) {
					
					if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
					{
						$_SESSION['message'] = "Логин может состоять только из букв английского алфавита и цифр";
						header('Location: /registration');
						exit;
					}
					if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
					{
						$_SESSION['message'] = "Логин должен быть не меньше 3-х символов и не больше 30";
						header('Location: /registration');
						exit;
					}

					$user_exists = User::checkExists($_POST['login'], $_POST['email']);
					if($user_exists == 'not_exists') {
						$result = User::save($_POST);
						global $pdo;
						$last_user = $pdo->lastInsertId();
						// $result2 = User::saveUserCategory($arr_category, $last_user);
						if($result === true) {
							header('Location: /authorization?msg=Регистрация прошла успешно');
							exit;
						} else {
							$error_messages[] = "Возникла ошибка при добавлении данных";
						}
					} else {
						if(in_array('login_exists', $user_exists)) {
							$error_messages[] = "Пользователь с таким логином уже существует";
						} 
						if(in_array('email_exists', $user_exists)) {
							$error_messages[] = "Пользователь с таким адрессом электронной почты уже существует";
						}
					}
					
				} else {
					$error_messages[] = "Пропущено обязательное к заполнению поле.";
				}
		}


		
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/user/registration.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}



?>