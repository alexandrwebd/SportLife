<?php
class Prices extends CoreModel {
	public static $table = 'prices';
	public static function getPrice() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $prices = $q->fetch();
	}

	public static function getPrices() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $prices = $q->fetchAll();
	}



}
?>