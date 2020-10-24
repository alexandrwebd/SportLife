<?php
class Order extends CoreModel
{

    public static $table = 'orders';

	public static function getOrderById($id)
	{
		global $pdo;
		$query = "SELECT * FROM " . self::$table . " WHERE id = :id";

		$q = $pdo->prepare($query);
		$q->bindValue(':id', $id);
		$q->execute();

		return $blog = $q->fetch();
    }
    
    // меняет статус с цыфры на понятный вид
	public static function getStatusText($status)
	{
		switch($status){
            case '1':
                return 'Новый заказ';
            break;
            case '2`':
                return 'В обработке';
            break;
            case '3':
                return 'Заморожен';
            break;
            case '4':
                return 'Закрыт';
            break;
        }
	}

    




}