<?php
class AuthorizationController {
	public static $page = 'authorization';
	public static function actionLoginIndex() {
		// $main_manu = CoreController::getMainMenu();

		global $settings;
		
		if(isset( $_GET['msg']) && !empty( $_GET['msg'])){
			$msg = $_GET['msg'];
		}
		
		if(isset($_POST['form_send']) && $_POST['form_send'] == '1'){
			$error_messages = array();
			if(
					isset($_POST['login']) && !empty($_POST['login']) &&
					isset($_POST['password']) && !empty($_POST['password'])
				) {

					$login = $_POST['login'];
					$password = $_POST['password'];

				$auth = User::authoris($_POST['login'], $_POST['password']);
				if(is_array($auth) && isset($auth['id']) && !empty($auth['id'])) {

					$_SESSION['user'] = $auth;
					
					if($_SESSION['user']['is_admin'] == 1){
						header("Location: /admin");
					    exit;
					}else{
						// header("Location: /");
						header("Location: /cabinet");
						exit;
					}
					
				} else {
					$error_messages[] = "Неудачная попытка входа. У Вас осталось " . ($settings['login_tries'] - $auth) . " попыток";
				}
			} else {
				$error_messages[] = "Введены не все данные.";
			}
		}

		
		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/user/authorization.php';
		include_once ROOT . '/views/layout/footer.php';
	}

	public static function actionLogoutIndex() {
		unset($_SESSION['user']);
		setcookie('rememberLogin', '');
		setcookie('rememberPassword', '');
		header('Location: /registration');
		exit();
	}
}
