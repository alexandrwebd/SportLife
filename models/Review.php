<?php 
class Review {

	public static $table = 'reviews';
	public static $table2 = 'users';

	// добавление отзыва
	public static function add($options) {
		try {
			global $pdo;
			$query = "INSERT INTO " . self::$table . " SET name = :name, email = :email, text = :text, author_id = :author_id, status = :status, date_add = CURRENT_DATE()";
			$q = $pdo->prepare($query);
			$q->bindValue(':name', $options['name']);
			$q->bindValue(':email', $options['email']);
			$q->bindValue(':text', $options['text']);
			$q->bindValue(':author_id', $options['author_id']);
			$q->bindValue(':status', $options['status']);
			// return $dbc->lastInsertId();
			return $q->execute();
		} 
		catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}
	}

	// получить отзыв по id 
	public static function getReviewById($id) {
		try {
			global $pdo;
			$query = "SELECT * FROM " . self::$table . " WHERE id = :id";
			$q = $pdo->prepare($query);
			$q->bindValue(':id', $id);
			$q->execute();
	
		} 
		catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}
		return $review = $q->fetch();
	}

	// получить все отзывы
	public static function getAllReviews() {
		try {
			global $pdo;
			$query = "SELECT * FROM " . self::$table;
			$q = $pdo->prepare($query);
			$q->execute();
		} 
		catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}

		return $reviews = $q->fetchAll();
	}

	// // получить все отзывы со статусом "published"
	// public static function getReviewsByStatus($status = 'published') {
	// 	try {
	// 		global $pdo;
	// 		$query = "SELECT * FROM " . self::$table . " WHERE status = :status";
	// 		$q = $pdo->prepare($query);
	// 		$q->bindValue(':status', $status);
	// 		$q->execute();
	// 	} 
	// 	catch (PDOException $e) {
	// 		ErrorHandle::printMessage($e->getMessage());
	// 		exit();
	// 	}

	// 	return $reviews = $q->fetchAll();
	// }
	// получить все отзывы со статусом "published"
	public static function getReviewsByStatus($limit = 100000, $order = 'DESC', $status = 'published') {
		try {
			global $pdo;
			$query = "SELECT reviews.id, reviews.name, reviews.text, reviews.author_id, reviews.status, reviews.date_add, users.id, users.profile_img FROM " . self::$table . " INNER JOIN " . self::$table2 . " ON " . self::$table .".author_id = " . self::$table2 . ".id " . " WHERE " . self::$table . ".status = :status ORDER BY date_add " . $order . " LIMIT " . $limit;
			$q = $pdo->prepare($query);
			$q->bindValue(':status', $status);
			$q->execute();
		} 
		catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}

		return $reviews = $q->fetchAll();
	}

	
	// public static function getReviewsByPlace($place_id){
	// 		try {
	// 			$dbc = Db::connect();
	// 			$query = $dbc->prepare("SELECT * FROM `reviews` WHERE `place_id` = :place_id");
	// 			$query->bindValue(':place_id', $place_id);
	// 			$query->execute();
	// 		} 
	// 		catch (PDOException $e) {
	// 			ErrorHandle::printMessage($e->getMessage());
	// 			exit();
	// 		}

	// 		return $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
	// }
	// public static function getReviewsByAuthor($author_id) {
	// 		try {
	// 			$dbc = Db::connect();
	// 			$query = $dbc->prepare("SELECT * FROM `reviews` WHERE `author_id` = :author_id");
	// 			$query->bindValue(':author_id', $author_id);
	// 			$query->execute();
	// 		} 
	// 		catch (PDOException $e) {
	// 			ErrorHandle::printMessage($e->getMessage());
	// 			exit();
	// 		}

	// 		return $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
	// }

	// public static function edit($options) {
	// 	try {
	// 		$dbc = Db::connect();
	// 		$query = $dbc->prepare("UPDATE `reviews` SET `text` = :text, `place_id` = :place_id, `type` = :type, `status` = :status WHERE `id` = :id");
	// 		$query->bindValue(':id', $options['id']);
	// 		$query->bindValue(':text', $options['text']);
	// 		$query->bindValue(':place_id', $options['place_id']);
	// 		$query->bindValue(':type', $options['type']);
	// 		$query->bindValue(':status', $options['status']);
	// 		return $query->execute();			
	// 	}
	// 	catch (PDOException $e) {
	// 		ErrorHandle::printMessage($e->getMessage());
	// 		exit();
	// 	}		
	// }

	// public static function getStatuses() {
	// 	return array('hidden' =>'Прихований',
	// 				'published' => 'Опублікований',
	// 				'draft' => 'Чорновик'
	// 				);
	// }

	// public static function getTypes() {
	// 	return array('neutral' => 'Нейтральний',
	// 				'positive' => 'Позитивний',
	// 				'negative' =>'Негативний'
	// 				);
	// }
	// public static function getReviewsCountByType($place_id, $type) {
	// 	try {
	// 		$dbc = Db::connect();
	// 		$query = $dbc->prepare("SELECT COUNT(id) FROM `reviews` WHERE `type` = :type AND `place_id` = :place_id");
	// 		$query->bindValue(':type', $type, PDO::PARAM_STR);
	// 		$query->bindValue(':place_id', $place_id, PDO::PARAM_STR);
	// 		$query->execute();
	// 	} 
	// 	catch (PDOException $e) {
	// 		ErrorHandle::printMessage($e->getMessage());
	// 		exit();
	// 	}
	// 	$count = $query->fetch();
	// 	return $count[0];
	// }
	// public static function getReviewsCountByPlace($place_id) {
	// 	try {
	// 		$dbc = Db::connect();
	// 		$query = $dbc->prepare("SELECT COUNT(id) FROM `reviews` WHERE `place_id` = :place_id");
	// 		$query->bindValue(':place_id', $place_id, PDO::PARAM_INT);
	// 		$query->execute();
	// 	} 
	// 	catch (PDOException $e) {
	// 		ErrorHandle::printMessage($e->getMessage());
	// 		exit();
	// 	}
	// 	$count = $query->fetch();
	// 	return $count[0];
	// }

	// public static function getReviewsPage($place_id, $page, $limit) {
	// 	$offset = ($page - 1) * $limit;
	// 	try {
	// 		$dbc = Db::connect();
	// 		$query = $dbc->prepare("SELECT * FROM `reviews` WHERE `status`= 'published' AND `place_id` = :place_id ORDER BY `id` ASC LIMIT :limit OFFSET :offset");
	// 		$query->bindValue(':place_id', $place_id, PDO::PARAM_INT);
	// 		$query->bindValue(':limit', $limit, PDO::PARAM_INT);
	// 		$query->bindValue(':offset', $offset, PDO::PARAM_INT);
	// 		$query->execute();
	// 	}
	// 	catch (PDOException $e) {
	// 		ErrorHandle::printMessage($e->getMessage());
	// 		exit();
	// 	}
	// 	return $reviews = $query->fetchAll(PDO::FETCH_ASSOC);
	// }

	// public static function deleteById($id) {
	// 	try {
	// 		$dbc = Db::connect();
	// 		$query = $dbc->prepare("DELETE FROM `reviews` WHERE `id` = :id");
	// 		$query->bindValue(':id', $id);		
	// 		return $query->execute();			
	// 	}
	// 	catch (PDOException $e) {
	// 		ErrorHandle::printMessage($e->getMessage());
	// 		exit();
	// 	}
	// }
}
?>