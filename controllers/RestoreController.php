<?php
class RestoreController {
	public static $page = 'restore';
	public static function actionIndex() {
		
		$message = '';
		if(isset($_GET['recover_hash']) && !empty($_GET['recover_hash'])){
			$recover_hash = $_GET['recover_hash'];
			//Получаю данные с бд по recover_hash который пришeл с ссылки через роут
			$result = User::getByPassword($recover_hash);
		}
		
			
			
		if (isset($result) && !empty($result)) { //Если хеши совпадают
			if ($result['recover_hash'] == $recover_hash) {
				//Код вынес в низ потомучто выполняеться не всегда, не пойму почему
				
			} else {
				// exit;
			}
		} 

			 //получаю POST
		if (isset($_POST['submit']) && isset($_POST['new_password']) && !empty($_POST['new_password'])) { // Сверяю введенные пароли
			if ($_POST['new_password'] === $_POST['password']) {
				$new_password = $_POST['new_password'];
				$user_id = $_POST['restore_user_id'];
				//Создаю новый хеш
				$pass_hash = password_hash($new_password, PASSWORD_DEFAULT);
				//Перезаписываю старый хеш
				$result_hash = User::savePass($pass_hash, $user_id);
				if ($result_hash === true) {//Удаляю recover_hash
					$delet_recover_hash = User::deletRecHash($user_id);
					$message = 'Пароль успешно изменен.';
				}
			} else {
				$message = 'Введенные пароли не совпадают.';
			}
		}

		include_once ROOT . '/views/user/restore.php';
	}
}
