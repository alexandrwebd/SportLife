<?php
class AdminGalleryController
{

    //        ********* отображение всей галереи ***********

    public static function actionIndex()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем галерею
        $images = Image::getGallery();

        include_once ROOT . '/views/admin/gallery/gallery.php';
    }



    //       ********* добавление изображения **********

    public static function actionAdd()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        if (isset($_POST['submit']) && $_POST['formSend'] == 'imageAdd') {
            //   Если форма отправлена формируем массив с опциями
            // $options['images'] = $_POST['image'];
            $options['images_alt'] = $_POST['img_alt'];
            // $options['date_add'] = date('Y-m-d');


            // Флаг ошибок к форме
            $error_messages = false;
        }

        if (!isset($options['images_alt']) && empty($options['images_alt'])) {
            $error_messages[] = 'Заполните поля';
        }

        if ($error_messages == false) {
            // если ошибок нет добавляем запись
            $id = Image::insertDataTable($options);

            if ($id) {
                try {
                    // Проверяем загрузилось ли через форму изображение
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

                        // $total_files = count($_FILES['image']['name']);

                        // for ($i = 0; $i < $total_files; $i++) {

                            // if (
                            //     isset($_FILES['image']['name'])
                            //     && $_FILES['image']['size'] > 0
                            // ) {

                                $file_name = $_FILES['image']['name'];
                                $tmp_img = $_FILES['image']['tmp_name'];
                                $error_img = $_FILES['image']['error'];
                                $size_img = $_FILES['image']['size'];
                                $url_img = '/public/images/gallery/';

                                // $target = $url_img . basename($file_name);

                                // название ячейки с изображением
                                $name_key = 'images';
                                // как хочу назвать img
                                $name_img = 'photo';

                                //Проверяем значение ошибки и не превышен ли допустимый размер	 
                                if ($error_img !== true && $size_img <= 3000000) {
                                    // если загрузилось переносим его в новую папку и даем новое имя
                                    $name_file = Image::saveImage($_FILES['image'], $id, $url_img, $name_img);

                                    // move_uploaded_file($tmp_img, $target);
                                    // добавляем новый выйл в базу данных
                                    $flag = Image::updateImageTable($name_file, $id, $name_key);
                                } else {
                                    $error_messages[] = "Ошибка при загрузке фото!";
                                }
                            // }
                        // }
                    }
                } catch (PDOException $e) {
                    ErrorHandle::printMessage($e->getMessage());
                    exit();
                }
            };

            // Перенаправляю на страницу редактирования
            header('Location: /admin/gallery');
            exit;
        }

        include_once ROOT . '/views/admin/gallery/galleryAdd.php';
    }


    //         ****  изменение изображения  ****

    public static function actionEdit($id)
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем данные о конкретном изображении
        $image = Image::getById($id);

        if (isset($_POST['submit']) && $_POST['formSend'] == 'galleryEdit') {
            //   Если форма отправлена формируем массив с опциями

            $options['images'] = $_POST['images'];
            $options['images_alt'] = $_POST['images_alt'];

            // Сохраняем изменения
            if (Image::updateDataTable($id, $options)) {

                // Если запись изменена

                try {
                    // Проверяем загрузилось ли через форму изображение
                    if (is_uploaded_file($_FILES['image']['tmp_name'])) {

                        $tmp_img = $_FILES['image']['tmp_name'];
                        $error_img = $_FILES['image']['error'];
                        $size_img = $_FILES['image']['size'];
                        $url_img = '/public/images/gallery/';
                        // название ячейки с изображением
                        $name_key = 'images';
                        // как хочу назвать img
                        $name_img = 'photo';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = Image::saveImage($_FILES['image'], $id, $url_img, $name_img);
                            // добавляем новый выйл в базу данных
                            $flag = Image::updateImageTable($name_file, $id, $name_key);

                            // если изображение в базе обновилось
                            if ($flag) {
                                // удаляем файл с диска
                                $delit = unlink($_SERVER['DOCUMENT_ROOT'] . $url_img . $image['images']);
                            } else {
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
            header('Location: /admin/gallery');
            exit;
        }

        include_once ROOT . '/views/admin/gallery/galleryEdit.php';
    }


    //         ******** удаление изображения *********

    public static function actionDelete($id)
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();
        if (isset($_POST['submit']) && $_POST['form_send'] == 1) {

            $success = Image::deleteById($id);

            // Перенаправляю на страницу редактирования
            header('Location: /admin/gallery');
            exit;
        }

        include_once ROOT . '/views/admin/gallery/galleryDelete.php';
    }
}
