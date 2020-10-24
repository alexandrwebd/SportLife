<?php
class AdminBlogsController
{

                                         //        ********* отображение всех статтей ***********

    public static function actionIndex()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем список блогов
        $blogsList = Blog::getAllBlogs();

        include_once ROOT . '/views/admin/blog/blogs.php';
    }

                                      //         ******** удаление статьи *********

    public static function actionDelete($id)
    {
        Admin::checkAdminAccess();
        if (isset($_POST['submit']) && $_POST['form_send'] == 1) {

            $success = Blog::deleteById($id);

            // Перенаправляю на страницу редактирования
            header('Location: /admin/blogs');
            exit;
        }

        include_once ROOT . '/views/admin/blog/blogDelete.php';
    }

                                     //       ********* добавление статьи **********

    public static function actionAdd()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        if (isset($_POST['submit']) && $_POST['formSend'] == 'placeAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['title'] = $_POST['title'];
            $options['description'] = $_POST['description'];
            $options['img'] = $_POST['image'];
            $options['img_alt'] = $_POST['img_alt'];
            $options['date_add'] = date('Y-m-d');


            // Флаг ошибок к форме
            $error_messages = false;
        }

        if (!isset($options['title']) && empty($options['title'])) {
            $error_messages[] = 'Заполните поля';
        }

        if ($error_messages == false) {
            // если ошибок нет добавляем запись
            $id = Blog::insertDataTable($options);

            if ($id) {
                try {
                    // Проверяем загрузилось ли через форму изображение
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

                        $tmp_img = $_FILES['image']['tmp_name'];
                        $error_img = $_FILES['image']['error'];
                        $size_img = $_FILES['image']['size'];
                        $url_img = '/public/images/blogs/';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = Blog::saveImage($_FILES['image'], $id, $url_img);
                            // добавляем новый выйл в базу данных
                            $flag = Blog::updateImageTable($name_file, $id);
                        } else {
                            $error_messages[] = "Ошибка при загрузке фото!";
                        }
                    }
                } catch (PDOException $e) {
                    ErrorHandle::printMessage($e->getMessage());
                    exit();
                }
            };

            // Перенаправляю на страницу редактирования
            header('Location: /admin/blogs');
            exit;
        }

        include_once ROOT . '/views/admin/blog/blogAdd.php';
    }

                                         //         ****  изменение статьи  ****

    public static function actionEdit($id)
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем данные о конкретной статье
        $blog = Blog::getById($id);

        if (isset($_POST['submit']) && $_POST['formSend'] == 'placeAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['title'] = $_POST['title'];
            $options['description'] = $_POST['description'];
            $options['img'] = $_POST['image'];
            $options['img_alt'] = $_POST['img_alt'];
            $options['date_add'] = date('Y-m-d');

            // Сохраняем изменения
            if (Blog::updateDataTable($id, $options)) {

                // Если запись изменена

                try {
                    // Проверяем загрузилось ли через форму изображение
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

                        $tmp_img = $_FILES['image']['tmp_name'];
                        $error_img = $_FILES['image']['error'];
                        $size_img = $_FILES['image']['size'];
                        $url_img = '/public/images/blogs/';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = Blog::saveImage($_FILES['image'], $id, $url_img);
                            // добавляем новый выйл в базу данных
                            $flag = Blog::updateImageTable($name_file, $id);

                            // если изображение в базе обновилось
                            if($flag){
                                // удаляем файл с диска
                                $delit = unlink ($_SERVER['DOCUMENT_ROOT'] . $url_img . $blog['img']);
                            }else{
                                $error_messages[] = "Ошибка при обновлении изображения!";
                            }
                            
                        } else {
                            $error_messages[] = "Ошибка при загрузке фото!";
                        }
                    }
                } catch (PDOException $e) {
                    ErrorHandle::printMessage($e->getMessage());
                    exit();
                }
            }
            // Перенаправляю на страницу редактирования
            header('Location: /admin/blogs');
            exit;
        }

        include_once ROOT . '/views/admin/blog/blogEdit.php';
    }
}
