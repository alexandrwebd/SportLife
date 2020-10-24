<?php
class Service extends CoreModel {
	public static $table = 'services';
	public static function getById($id) {
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		return $service = $q->fetch();
	}

	public static function getServices() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $service = $q->fetchAll();
	}



}
?>