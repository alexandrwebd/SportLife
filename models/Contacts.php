<?php
class Contacts extends CoreModel {
	public static $table = 'contacts';
	public static function getContact() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $contacts = $q->fetch();
	}

	public static function getContacts() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $contacts = $q->fetchAll();
	}



}
?>