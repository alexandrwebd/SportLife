<?php
class Blog extends CoreModel
{
	public static $table = 'blogs';

	public static function getById($id)
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();

		return $blog = $q->fetch();
	}

	public static function getBlogs($limit = 100000, $order = 'ASC') // DESC - последние
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " ORDER BY id " . $order . " LIMIT " . $limit;

		$q = $pdo->prepare($query);
		$q->execute();

		return $blog = $q->fetchAll();
	}
	public static function getBlogsFooter($limit = 100000, $order = 'DESC') // ASC - первые
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " ORDER BY id " . $order . " LIMIT " . $limit;

		$q = $pdo->prepare($query);
		$q->execute();

		return $blog = $q->fetchAll();
	}

	// Апдейт количества просмотров статьи по ее id
	public static function viewsUpdate($id)
	{
		global $pdo;

		$pdo->query("UPDATE blogs SET counter = counter + 1 WHERE id = $id");
	}
	// Постраничная пагинация

	public static function getCountBlogs()
	{
		global $pdo;
		$query = "SELECT COUNT(*) as count FROM " . self::$table . " WHERE visible = '1'";

		$q = $pdo->prepare($query);
		$q->execute();

		return $blog = $q->fetch();
	}

	// Получить все блоги с условием для пагинации
	public static function getBlog($query_start_num)
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE visible = '1' ORDER BY id " . $query_start_num;

		$q = $pdo->prepare($query);
		$q->execute();

		return $result = $q->fetchAll();
	}

	public static function getAllBlogs()
	{
		try {
			global $pdo;
			$query = "SELECT * FROM " . self::$table;

			$q = $pdo->prepare($query);
			$q->execute();
		} catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}
		return $result = $q->fetchAll();
	}

	public static function deleteById($id)
	{
		try {
			global $pdo;
			$query = "DELETE FROM " . self::$table . " WHERE id = :id";
			$q = $pdo->prepare($query);
			$q->bindValue(':id', $id);
			$q->execute();
		} catch (PDOException $e) {
			ErrorHandle::printMessage($e->getMessage());
			exit();
		}
	}

	// изменение данных в любой таблице 
	public static function updateDataTable($id, $data) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "UPDATE " . self::$table . " SET ";

			foreach ($data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}
			 
			$query = substr($query, 0, -2);			 
			$query .= " WHERE id=$id ";
			
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}
	
	// изменение изображения по id
	public static function updateImageTable($img, $id){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET img = :img WHERE id = :id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':img', $img);

		$q->bindValue(':id', $id);

		return $q->execute();
	}

	// добавление новых данных в любую таблицу
	public static function insertDataTable($data) {
		
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "INSERT INTO " . self::$table . " SET ";

			foreach ($data as $field => $value) {
				$query .= $field . ' = :' . $field . ', ';
			}

			$query = substr($query, 0, -2);
			$query .= ";";
			
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}
			 
			if ($q->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $pdo->lastInsertId();
            }
	        // Иначе возвращаем 0
	        return 0;
	    }
	}

	// удаление строки из любой таблицы
	public static function deleteStringById($table, $name_col, $id){
        global $pdo;         
        $sql = "DELETE FROM $table WHERE $name_col = :id";         
        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
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

	// возвращает путь к изображению или путь к заглушке
	public static function getImage($id) {
		
		// название изображения заглушки
		$noImage = 'no_image.jpg';

		// путь к папке с картинками
		$path = '/public/images/blogs/blogs-';

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
