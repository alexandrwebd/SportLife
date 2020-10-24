<?php

class Email extends CoreModel {

    public static $table = 'email';

    // Проверяет наличие email в базе перед добавлением
public static function checkExistsEmail ($email) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE email = :email";

		$q = $pdo->prepare($query);
		$q->bindValue(':email', $email);
		$q->execute();

		$user = $q->fetch();

		if(empty($user)) {
			return 'not_exists';
		} else {
			$exists = array();
			
			if($user['email'] == $email) {
				$exists[] = 'email_exists';
			} 
			return $exists;
		}
    }

    // Добавляет email в базу
    public static function addEmail($email){
		global $pdo;
		$query = "INSERT INTO " . self::$table . " SET email = :email";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':email', $email);

		return $q->execute();
	}
}


?>