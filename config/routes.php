<?php
/*
Ключи 
*/
return array(
	// страницы 
	'about' => 'about/index',
	'service' => 'service/index',
	'services-detail/([0-9]+)' => 'servicesDetail/index/$1',
	'prices' => 'prices/index',
	'team' => 'team/index',
	'gallery' => 'gallery/index',
	'blog-detail/([0-9]+)' => 'blogDetail/index/$1',
	'blog(.+)' => 'blog/index/$1',
	'blog' => 'blog/index',
	'contacts' => 'contacts/index',

	//Регистрация авторизация пользователей
	'registration' => 'registration/registerIndex',
	'authorization' => 'authorization/loginIndex',
	'logout' => 'authorization/logoutIndex',
	'authorization(.+)' => 'authorization/loginIndex/$1',

	//Админ-панель
	'admin' => 'admin/index',

	//Личный кабинет
	'cabinet' => 'cabinet/index',
	'cabinet/edit' => 'cabinet/edit',
	'cabinet/add' => 'cabinet/add',
	'cabinet/mail' => 'cabinet/mail',

	// Востановление пароля
	'recover' => 'recover/index',
	'restore(.+)' => 'restore/index/$1',
	'restore' => 'restore/index',

	//Управление блогом
	'admin/blogEdit/blog-([0-9]+)' => 'adminBlogs/edit/$1',
	'admin/blogDelete/blog-([0-9]+)' => 'adminBlogs/delete/$1',
	'admin/blogAdd' => 'adminBlogs/add',
	// 'admin/blogs/category-([0-9]+)' => 'adminBlogs/index/$1',
	'admin/blogs' => 'adminBlogs/index',

	//Управление главной страницей
	'admin/main-page' => 'adminMainPage/index',
	'admin/main-page/edit-([0-9]+)' => 'adminMainPage/edit/$1',

	//Управление страницей о нас
	'admin/about' => 'adminAbout/index',
	'admin/about/edit-([0-9]+)' => 'adminAbout/edit/$1',

	//Управление заказами
	'admin/orderEdit/order-([0-9]+)' => 'adminOrders/edit/$1',
	'admin/orderDelete/order-([0-9]+)' => 'adminOrders/delete/$1',
	'admin/orderView/order-([0-9]+)' => 'adminOrders/view/$1',
	'admin/orderAdd' => 'adminOrders/add',
	'admin/orders' => 'adminOrders/index',

	//Управление галереей
	'admin/gallery' => 'adminGallery/index',
	'admin/galleryEdit/image-([0-9]+)' => 'adminGallery/edit/$1',
	// 'admin/blogEdit/image-([0-9]+)' => 'adminBlogs/edit/$1',
	'admin/galleryDelete/image-([0-9]+)' => 'adminGallery/delete/$1',
	'admin/galleryAdd' => 'adminGallery/add',

	// Форма обратной связи узнать цену
	'email' => 'email/mail',

	// Форма обратной связи записаться на тренировку
	'email/form' => 'email/request',

	// Форма обратной связи заказать карту
	'email/orders' => 'email/orders',
	
	//Отзывы
    'review/show/place-([0-9]+)/page-([0-9]+)' => 'review/showPage/$1/$2',
    'review/add' => 'review/add',

	// Форма рассылки
	'email/mailing' => 'email/mailing',

	// Карта сайта
	'sitemap.xml' => 'Main/sitemap',

	'' => 'Main/index',
	'(^.+$)' => 'Main/index'
);
