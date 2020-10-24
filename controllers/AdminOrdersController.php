<?php
class AdminOrdersController
{

    public static function actionIndex()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем список блогов
        // $blogsList = Blog::getAllBlogs();

        include_once ROOT . '/views/admin/order/orders.php';
    }

    public static function actionView($id)
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // получаем данные о конкретном заказе
        $order = Order::getOrderById($id);
       
        // получить всю информацию о клубной карте
    // $cards = 

        include_once ROOT . '/views/admin/order/orderView.php';
    }




}