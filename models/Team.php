<?php
class Team extends CoreModel {
	public static $table = 'trainers';
	// public static function getById($id) {
	// 	global $pdo;
	// 	$query = "SELECT * FROM " . self::$table . " WHERE id = :id";

	// 	$q = $pdo->prepare($query);
	// 	$q->bindValue(':id', $id);
	// 	$q->execute();
	// 	return $service = $q->fetch();
	// }

	public static function getTrainers() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $trainers = $q->fetchAll();
	}



}
?>