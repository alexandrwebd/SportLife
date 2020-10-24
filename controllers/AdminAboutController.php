<?php
class AdminAboutController
{


    // отображение главной станицы для редактирования в админ панеле
    public static function actionIndex()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();
        $abouts = About::getAbouts();

        // Получаем заголовки и картинки главной страницы
        // $main_page = Main::getMainPages();
        // $main_advantages = Main::getAdvantages();

        include_once ROOT . '/views/admin/about/about.php';
    }


    // изменение страницы about
    public static function actionEdit($id)
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем данные о конкретной странице
        $abouts = About::getAbouts();

        $error_messages = false;


        // редактировать секцию about 
        if (isset($_POST['submitMainAbout']) && $_POST['formSend'] == 'mainAboutAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['title'] = $_POST['title'];
            $options['subtitle'] = $_POST['subtittle'];
            $options['about-title'] = $_POST['about-title-one'];
            $options['about-description'] = $_POST['about-description'];
            $options['about-img_alt'] = $_POST['about-img_alt'];
            $options['about-title'] .= $_POST['about-title-two'];
            $options['about-description'] .= $_POST['about-description-two'];
            $options['about-img_alt'] .= $_POST['about-img_alt-two'];
            $options['about-title'] .= $_POST['about-title-three'];
            $options['about-description'] .= $_POST['about-description-three'];

            // Сохраняем изменения
            if (About::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                try {
                    // Проверяем загрузилось ли через форму изображение
                    if (is_uploaded_file($_FILES['about-img']['tmp_name'])) {

                        $tmp_img = $_FILES['about-img']['tmp_name'];
                        $error_img = $_FILES['about-img']['error'];
                        $size_img = $_FILES['about-img']['size'];
                        // путь к папке с изображением
                        $url_img = '/public/images/';
                        // название ячейки с изображением
                        $name_key = 'about-img';
                        //    как хочу назвать изображение
                        $name_img = 'about-img';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = About::saveImage($_FILES['about-img'], $id, $url_img, $name_img);
                            // добавляем новый выйл в базу данных
                            $flag = About::updateImageTable($name_file, $id,  $name_key);

                            // если изображение в базе обновилось
                            if ($flag) {
                                // удаляем файл с диска
                                $delit = unlink($_SERVER['DOCUMENT_ROOT'] . $url_img .  $abouts[0]['about-img']);
                                $error_messages[] = "Изображение успешно изменено!";
                            } else {
                                $error_messages[] = "Ошибка при обновлении изображения!";
                            }
                        } else {
                            $error_messages[] = "Ошибка при загрузке фото!";
                        }
                    }
                    // изменение следущего изображения
                    if (is_uploaded_file($_FILES['about-img-2']['tmp_name'])) {

                        $tmp_img = $_FILES['about-img']['tmp_name'];
                        $error_img = $_FILES['about-img']['error'];
                        $size_img = $_FILES['about-img']['size'];
                        // путь к папке с изображением
                        $url_img = '/public/images/';
                        // название ячейки с изображением
                        $name_key = 'about-img';
                        //    как хочу назвать изображение
                        $name_img = 'about-img';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = About::saveImage($_FILES['about-img'], $id, $url_img, $name_img);
                            // добавляем новый выйл в базу данных
                            $flag = About::updateImageTable($name_file, $id,  $name_key);

                            // если изображение в базе обновилось
                            if ($flag) {
                                // удаляем файл с диска
                                $delit = unlink($_SERVER['DOCUMENT_ROOT'] . $url_img .  $abouts[1]['about-img']);
                                $error_messages[] = "Изображение успешно изменено!";
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
            // header('Location: /admin/blogs');
            include_once ROOT . '/views/admin/main-page/main-page.php';
            exit;
        }

        include_once ROOT . '/views/admin/main-page/main-page.php';
    }
}
