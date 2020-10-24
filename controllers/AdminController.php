<?php 
class AdminController {
	// отображение админ панели
	public static function actionIndex() {
		// если пользователь зарегистрирован и статус админ
		if(User::isAuth() && Admin::checkAdminAccess()) {
			// require_once ROOT . '/views/layout/adminHeader.php';	
			require_once ROOT . '/views/admin/index.php';	
		} else {
			header('Location: /authorization');
			exit();
		}
		
	}
	public static function actionLogin() {
		$login = '';
		$password = '';

		$errorFlag = true;
		if(isset($_POST['formSend']) && $_POST['formSend'] == 'admlog') {
			$errorFlag = false;
			$login = $_POST['login'];
			$password = $_POST['password'];
			if(isset($_POST['remember'])) {
				$remember = true;
			} else {
				$remember = false;
			}
			
			if(Admin::login($login, $password)){
				Admin::checkAdminAccess();
				if($remember === true) {
					setcookie('rememberLogin', $login, time() + (2592000));
					setcookie('rememberPassword', $password, time() + (2592000));
				}
				// require_once ROOT . '/views/layout/adminHeader.php';
				require_once ROOT . '/views/admin/index.php';
				exit();
			} else {
				$errorMessages['wrongAuth'] = 'Неправильний логін або пароль';
			}
			
		}

		require_once(ROOT . '/views/admin/login.php');
        return true;
	}
}
?>