<?php

class Main extends CoreModel {

	public static $table = 'header_img';
	public static $table2 = 'main_pages';

	public static function getById($id) {

		global $pdo;
		$query = "SELECT * FROM " . static::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();
		return $blogs = $q->fetch();
	}

	public static function getHeaderSlider() {
		global $pdo;
		$query = "SELECT * FROM " . self::$table;

		$q = $pdo->prepare($query);
		$q->execute();
		return $header_slider = $q->fetchAll();
	}

	public static function getAll($limit = 0) {
		global $pdo;
		$query = "SELECT * FROM " . static::$table . " WHERE limit = :limit";

		$q = $pdo->prepare($query);
		$q->bindValue(':limit', $limit);
		$q->execute();
		return $blogs = $q->fetchAll();
	}

	public static function getMainPageById($id)
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table2 . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();

		return $blog = $q->fetch();
	}

	// возвращает главную страницу
	public static function getMainPages() {
		global $pdo;
		$query = "SELECT * FROM " . static::$table2;

		$q = $pdo->prepare($query);
		$q->execute();
		return $maim_pages = $q->fetch();
	}

	// возвращает столбец advantages
	public static function getAdvantages() {
		global $pdo;
		$query = "SELECT advantages FROM " . static::$table2;

		$q = $pdo->prepare($query);
		$q->execute();
		return $advantages = $q->fetchAll();
	}

	// изменение данных в таблице main_pages 
	public static function updateDataTable($id, $data) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "UPDATE " . self::$table2 . " SET ";

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

	// изменение колонки advantages в таблице main_pages (не работает)
	public static function updateAdvantages($data) {
		global $pdo;		 
 		if (isset($data)&&!empty($data)) {  
			$query = "UPDATE " . self::$table2 . " SET ";
			$i = 1;
			foreach ($data as $field => $value) {
				$query .= 'advantages ' . ' = :' . $field . ', ';
				$i++;
			}
			 
			$query = substr($query, 0, -2);
			$query .= " WHERE id=$i";
			$q = $pdo->prepare($query);

			foreach ($data as $field => $value) {
				$q->bindValue(':' . $field, $value);
			}

			return $q->execute();
	    }
	}

	// возвращает путь к изображению или путь к заглушке секция trainer
	public static function getImage($images) {
		
		// название изображения заглушки
		$noImage = 'no_image.jpg';

		// путь к папке с картинками
		$path = '/public/images/';

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
		$query = "UPDATE " . self::$table2 . " SET " . $name_key . " = :img WHERE id = :id";
	
       $q = $pdo->prepare($query);

		$q->bindValue(':img', $img);

		$q->bindValue(':id', $id);

		return $q->execute();
	}

	
	
}
