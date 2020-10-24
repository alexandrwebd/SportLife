<?php 
class Admin extends User {
	public static $table = 'users';
	// Проверяет роль по ID с сессии
	public static function checkAdmin() {
		if(isset($_SESSION['user']['id'])) {

			try{
				global $pdo;
				$query = "SELECT `role` FROM " . self::$table . " WHERE `id` = :id";
				$q = $pdo->prepare($query);
				$q->bindValue(':id', $_SESSION['user']['id']);
				$q->execute();
				$result = $q->fetch();
				
			}
			catch (PDOException $e) {
				ErrorHandle::printMessage($e->getMessage());
				exit();
			}
			if($result['role'] === 'admin') {
				return true;
	    	} else {
	    		return false;
	    	}
	    } else {
	    	return false;
	    }
	}
	// Проверяет права доступа в админ панель
	public static function checkAdminAccess() {
		if(Admin::checkAdmin()) {
			return true;
		} else {
			exit('Недостатньо прав доступа');
		}
	}
}

?>