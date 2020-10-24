<?php
class User {
	public static $table = 'users';
	public static $table2 = 'users_message';

	public static function checkExists ($login, $email) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE login = :login OR email = :email";

		$q = $pdo->prepare($query);
		$q->bindValue(':login', $login);
		$q->bindValue(':email', $email);
		$q->execute();

		$user = $q->fetch();

		if(empty($user)) {
			return 'not_exists';
		} else {
			$exists = array();
			if($user['login'] == $login) {
				 $exists[] = 'login_exists';
			} 
			if($user['email'] == $email) {
				$exists[] = 'email_exists';
			} 
			return $exists;
		}
	}
	public static function login($login, $password) {
		try {
			global $pdo;
			$query = "SELECT * FROM " . self::$table . " WHERE login = :login OR email = :email";
			$q = $pdo->prepare($query);
			$q->bindValue(':login', $login);
			$q->bindValue(':email', $password);
			$q->execute();
			$result = $q->fetch();
		} 
		catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}

		if(password_verify($password, $result['password'])) {
			$_SESSION['user'] = $result;
			return true;
		} else {
			return false;
		}
	}


	public static function savePassHash($recover_hash, $email){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET recover_hash = :recover_hash WHERE email = :email";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':recover_hash', $recover_hash);

		$q->bindValue(':email', $email);

		return $q->execute();
	}

	public static function deletRecHash($user_id){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET recover_hash = NULL WHERE users.id = :user_id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':user_id', $user_id);

		return $q->execute();
	}

	public static function savePass($pass_hash, $user_id){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET pass_hash = :pass_hash WHERE id = :user_id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':pass_hash', $pass_hash);

		$q->bindValue(':user_id', $user_id);

		return $q->execute();
	}

	public static function edit($id, $login, $password){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET login = :login, pass_hash = :password WHERE id = :id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':login', $login);

		$q->bindValue(':password', $password);

		$q->bindValue(':id', $id);

		return $q->execute();
	}

	public static function addMessage($data){
		global $pdo;
		$query = "INSERT INTO " . self::$table2 . " SET email = :email, message = :message";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':email', $data['email']);

		$q->bindValue(':message', $data['message']);

		return $q->execute();
	}


	public static function save($post) {
		global $pdo;
		$user_data = array();
		if(mb_strlen($_POST['login']) > 100) {
			return false;
		} else {
			$user_data['login'] = $_POST['login'];
		}
		if(mb_strlen($_POST['password']) > 100) {
			return false;
		} else {
			$user_data['pass_hash'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}
		if(mb_strlen($_POST['email']) > 100) {
			return false;
		} else {
			$user_data['email'] = $_POST['email'];
		}

		if(isset($_POST['name']) && mb_strlen($_POST['name']) > 255) {
			return false;
		} else {
			$user_data['name'] = $_POST['name'];
		}

		if(isset($_POST['surname']) && mb_strlen($_POST['surname']) > 255) {
			return false;
		} else {
			$user_data['surname'] = $_POST['surname'];
		}

		if(isset($_POST['birth_date']) && preg_match('/[0-9]{4}-[0-9]{2}-[0-9]{2}/', $_POST['birth_date'])) {
			$user_data['date_birth'] = $_POST['birth_date'];
		}

		$query = "INSERT INTO " . self::$table . " SET ";

		foreach ($user_data as $field => $value) {
			$query .= $field . ' = :' . $field . ', ';
		}

		$query = substr($query, 0, -2);
		$query .= ";";
		
		$q = $pdo->prepare($query);

		foreach ($user_data as $field => $value) {
			$q->bindValue(':' . $field, $value);
		}

		return $q->execute();
	}

	public static function authoris($login, $password) {
		$user = self::getByLogin($login);
		if(!empty($user)) {
			$auth = password_verify($password, $user['pass_hash']);
		} else {
			$auth = false;
		}

		if($auth === true) {
			User::resetTries();
			return $user;
		} else {
			return User::badAuth();
		}
	}

	public static function getByLogin($login) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE login = :login";

		$q = $pdo->prepare($query);
		$q->bindValue(':login', $login);
		$q->execute();

		return $user = $q->fetch();
	}

	public static function getUserById($id) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();

		return $user = $q->fetch();
	}

	public static function getByEmail($email) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE email = :email";

		$q = $pdo->prepare($query);
		$q->bindValue(':email', $email);
		$q->execute();

		return $user = $q->fetch();
	}

	public static function getByPassword($recover_hash) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE users.recover_hash = :recover_hash";

		$q = $pdo->prepare($query);
		$q->bindValue(':recover_hash', $recover_hash);
		$q->execute();

		return $user = $q->fetch();
	}

	public static function badAuth() {
		global $settings;
		$ip = $_SERVER['REMOTE_ADDR'];
		$file_url = ROOT . '/logs/' . $ip . '.txt';
		if(file_exists($file_url)) {
			$con = file_get_contents($file_url);
		} else {
			$con = 1;
		}
		
		if($con >= $settings['login_tries']) {
			require_once(ROOT . 'views/access_denied.php');
		} else {
			$con++;
			file_put_contents($file_url, $con);
		}

		return $con;
	}

	public static function resetTries() {
		global $setting;
		$ip = $_SERVER['REMOTE_ADDR'];
		$file_url = ROOT . '/logs/' . $ip . '.txt';
		if(file_exists($file_url)) {
			unlink($file_url);
		}
		
	}

	public static function isAuth() {
		if(isset($_SESSION['user'])) {
			return true;
		} else {
			return false;
		}
	}

	// сохранение изображения в папку
	public static function saveImage($image, $id, $url_img) {
		// путь к временной папке
		$tmpName = $image['tmp_name'];
		// формирую название файла
		$name = self::$table . "-" . $id . ".jpg";
		// путь к папке на диске
		$dirUrl = ROOT . $url_img;
		// полный путь к файлу
		$fullUrl = $dirUrl . $name;

		while(file_exists($fullUrl)) {
			$name = '_' . $name;
			$fullUrl = $dirUrl . $name;
		}
		// перемещение файла
		$file_moved = move_uploaded_file($tmpName, $fullUrl);
		if($file_moved) {

			// полное путь до файла
			// $url = '/public/images/blogs/' . $name;

			// изменяю навание файйла для базы данных
			$url = $name;
			return $url;
		} else {
			return false;
		}
	}

	// изменение изображения по id
	public static function updateImageTable($img, $id){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET profile_img = :profile_img WHERE id = :id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':profile_img', $img);

		$q->bindValue(':id', $id);

		return $q->execute();
	}

	// возвращает путь к изображению или путь к заглушке
	public static function getImage($id) {
		
		// название изображения заглушки
		$noImage = 'no_image.jpg';

		// путь к папке с картинками
		$path = '/public/images/profile/users-';

		// путь к изображению 
		$pathToImage = $path . $id . '.jpg';

		// проверяем есть ли по этому пути изображение
		if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)) {
		
			// если по этому адресу файл есть возвращаем его путь
			
			return $pathToImage;
		} else {
			// возвращаем путь к изображению с заглушкой
			return $path . $noImage;
		}
	}
}


