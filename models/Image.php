<?php 
class Image {

    public static $table = 'gallery';

    // возвращает в footer последние добавленные фото в галерею
    public static function getImagesFooter($limit = 100000, $order = 'DESC') // ASC - первые
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " ORDER BY id " . $order . " LIMIT " . $limit;

		$q = $pdo->prepare($query);
		$q->execute();

		return $blog = $q->fetchAll();
	}

	// получаю изображение по id
	public static function getById($id)
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();

		return $blog = $q->fetch();
	}

	// получаю исе изображения
	public static function getGallery() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $service = $q->fetchAll();
	}

	// возвращает путь к изображению или путь к заглушке секция trainer
	public static function getImage($images) {
		
		// название изображения заглушки
		$noImage = 'no_image.jpg';

		// путь к папке с картинками
		$path = '/public/images/gallery/';

		// путь к изображению 
		$pathToImage = $path . $images;

		// проверяем есть ли по этому пути изображение
		if(file_exists($_SERVER['DOCUMENT_ROOT'].$pathToImage)) {
		
			// если по этому адресу файл есть возвращаем его путь
			
			return $pathToImage;
		} else {
			// возвращаем путь к изображению с заглушкой
			return $path . $noImage;
		}
	}

	// изменение данных в таблице gallery 
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

		// сохранение изображения в папку
		public static function saveImage($image, $id, $url_img, $name_img) {
			// путь к временной папке
			$tmpName = $image['tmp_name'];
			// формирую название файла
			$name = $name_img . "-" . $id . ".jpg";
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
	public static function updateImageTable($img, $id, $name_key){
		global $pdo;
		$query = "UPDATE " . self::$table . " SET " . $name_key . " = :img WHERE id = :id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':img', $img);

		$q->bindValue(':id', $id);

		return $q->execute();
	}

	// удаление по id
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


	
	
}
