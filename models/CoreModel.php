<?php

class CoreModel {

	public static $table = 'blogs';

	public static function getById($id) {

		global $pdo;
		$query = "SELECT * FROM " . static::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		return $blogs = $q->fetch();
	}

	public static function getTable() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $service = $q->fetchAll();
	}

	public static function getAll($limit = 0) {
		global $pdo;
		$query = "SELECT * FROM " . static::$table . " WHERE limit = :limit";

		$q = $pdo->prepare($query);
		$q->bindValue(':limit', $limit);
		$q->execute();
		return $blogs = $q->fetchAll();
	}
}


?>