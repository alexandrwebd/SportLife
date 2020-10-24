<?php
class AdminMainPageController
{

    
    // отображение главной станицы для редактирования в админ панеле
    public static function actionIndex()
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем заголовки и картинки главной страницы
        $main_page = Main::getMainPages();
        $main_advantages = Main::getAdvantages();

        include_once ROOT . '/views/admin/main-page/main-page.php';
    }

   

    // изменение главной страницы
    public static function actionEdit($id)
    {
        // Проверяем права доступа
        Admin::checkAdminAccess();

        // Получаем данные о конкретной странице
        // $main_page = Main::getMainPageById($id);
        $main_page = Main::getMainPages();
        $main_advantages = Main::getAdvantages();

        $error_messages = false;

        if (isset($_POST['submitMainTitle']) && $_POST['formSend'] == 'mainTitleAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['call_to_action_h1'] = $_POST['main-title'];
            $options['call_to_action_h3'] = $_POST['main-subtitle'];
            

            // Сохраняем изменения
            // $id = 1;
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                // header("Location: /admin/main-page");
                include_once ROOT . '/views/admin/main-page/main-page.php';
                exit;
            } else {
                $error_messages[] = "Ошибка при изменении данных!";
                header("Location: /admin/main-page");
                exit;
            }
           
        }
        // редактировать секцию about 
        if (isset($_POST['submitMainAbout']) && $_POST['formSend'] == 'mainAboutAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['main_about_title'] = $_POST['main_about_title'];
            $options['main_about_subtitle'] = $_POST['main_about_subtitle'];
            $options['main_about_description'] = $_POST['main_about_description'];
            // Сохраняем изменения
            // $id = 1;
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                // header("Location: /admin/main-page");
                include_once ROOT . '/views/admin/main-page/main-page.php';
                exit;
            } else {
                $error_messages[] = "Ошибка при изменении данных!";
                header("Location: /admin/main-page");
                exit;
            }
           
        }

         // редактировать секцию advantages 
         if (isset($_POST['submitMainAdvantages']) && $_POST['formSend'] == 'mainAdvantagesAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options[] = $_POST['main_advantages-1'];
            $options[] .= $_POST['main_advantages-2'];
            $options[] .= $_POST['main_advantages-3'];
            $options[] .= $_POST['main_advantages-4'];
            // Сохраняем изменения
            // $id = 1;
            if (Main::updateAdvantages($options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                // header("Location: /admin/main-page");
                include_once ROOT . '/views/admin/main-page/main-page.php';
                exit;
            } else {
                $error_messages[] = "Ошибка при изменении данных!";
                header("Location: /admin/main-page");
                exit;
            }
           
        }

          // редактировать секцию services
          if (isset($_POST['submitMainServices']) && $_POST['formSend'] == 'mainServicesAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['services_title'] = $_POST['main_services-title'];
            $options['services_description'] = $_POST['main_services-description'];
            // Сохраняем изменения
            // $id = 1;
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                // header("Location: /admin/main-page");
                include_once ROOT . '/views/admin/main-page/main-page.php';
                exit;
            } else {
                $error_messages[] = "Ошибка при изменении данных!";
                header("Location: /admin/main-page");
                exit;
            }
           
        }

        // редактировать секцию trainer
        if (isset($_POST['submitMainTrainer']) && $_POST['formSend'] == 'mainTrainerAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['trainer_title'] = $_POST['trainer_title'];
            // $options['trainer_images'] = $_POST['trainer_images'];

            // Сохраняем изменения
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                try {
                    // Проверяем загрузилось ли через форму изображение
                    if (is_uploaded_file($_FILES['trainer_images']['tmp_name'])) {

                        $tmp_img = $_FILES['trainer_images']['tmp_name'];
                        $error_img = $_FILES['trainer_images']['error'];
                        $size_img = $_FILES['trainer_images']['size'];
                         // путь к папке с изображением
                        $url_img = '/public/images/';
                        // название ячейки с изображением
                        $name_key = 'trainer_images';
                        // как хочу назвать img
                        $name_img = 'trainer';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = Main::saveImage($_FILES['trainer_images'], $id, $url_img, $name_img);
                            // добавляем новый выйл в базу данных
                            $flag = Main::updateImageTable($name_file, $id, $name_key);

                            // если изображение в базе обновилось
                            if($flag){
                                // удаляем файл с диска
                                $delit = unlink ($_SERVER['DOCUMENT_ROOT'] . $url_img . $main_page['trainer_images']);
                                $error_messages[] = "Изображение успешно изменено!";
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
            // header('Location: /admin/blogs');
            include_once ROOT . '/views/admin/main-page/main-page.php';
            exit;
        }

          // редактировать секцию schedule
          if (isset($_POST['submitMainSchedule']) && $_POST['formSend'] == 'mainScheduleAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['schedule_title'] = $_POST['schedule_title'];
            // Сохраняем изменения
            // $id = 1;
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                // header("Location: /admin/main-page");
                include_once ROOT . '/views/admin/main-page/main-page.php';
                exit;
            } else {
                $error_messages[] = "Ошибка при изменении данных!";
                header("Location: /admin/main-page");
                exit;
            }
           
        }

         // редактировать секцию reviews
         if (isset($_POST['submitMainReviews']) && $_POST['formSend'] == 'mainReviewsAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['reviews_title'] = $_POST['reviews_title'];
            // Сохраняем изменения
            // $id = 1;
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                // header("Location: /admin/main-page");
                include_once ROOT . '/views/admin/main-page/main-page.php';
                exit;
            } else {
                $error_messages[] = "Ошибка при изменении данных!";
                header("Location: /admin/main-page");
                exit;
            }
           
        }

         // редактировать секцию сommunication
         if (isset($_POST['submitMainСommunication']) && $_POST['formSend'] == 'mainСommunicationAdd') {
            //   Если форма отправлена формируем массив с опциями
            $options['baner_form_title'] = $_POST['baner_form_title'];
            $options['baner_form_subtitle'] = $_POST['baner_form_subtitle'];
            $options['contacts_form_phone'] = $_POST['contacts_form_phone'];
            $options['contacts_form_subtitle'] = $_POST['contacts_form_subtitle'];

            // Сохраняем изменения
            if (Main::updateDataTable($id, $options)) {

                // Если запись изменена
                $error_messages[] = "Данные успешно изменены!";
                try {
                    // Проверяем загрузилось ли через форму изображение
                    // изменение изображения секции коммуникация форма
                    if (is_uploaded_file($_FILES['baner_form_images']['tmp_name'])) {

                        $tmp_img = $_FILES['baner_form_images']['tmp_name'];
                        $error_img = $_FILES['baner_form_images']['error'];
                        $size_img = $_FILES['baner_form_images']['size'];
                         // путь к папке с изображением
                        $url_img = '/public/images/';
                           // название ячейки с изображением
                           $name_key = 'baner_form_images';
                        //    как хочу назвать изображение
                        $name_img = 'communication-form';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = Main::saveImage($_FILES['baner_form_images'], $id, $url_img, $name_img);
                            // добавляем новый выйл в базу данных
                            $flag = Main::updateImageTable($name_file, $id,  $name_key);

                            // если изображение в базе обновилось
                            if($flag){
                                // удаляем файл с диска
                                $delit = unlink ($_SERVER['DOCUMENT_ROOT'] . $url_img . $main_page['baner_form_images']);
                                $error_messages[] = "Изображение успешно изменено!";
                            }else{
                                $error_messages[] = "Ошибка при обновлении изображения!";
                            }
                            
                        } else {
                            $error_messages[] = "Ошибка при загрузке фото!";
                        }
                    }
                     // изменение изображения секции коммуникация телефон
                    if (is_uploaded_file($_FILES['contacts_form_images']['tmp_name'])) {

                        $tmp_img = $_FILES['contacts_form_images']['tmp_name'];
                        $error_img = $_FILES['contacts_form_images']['error'];
                        $size_img = $_FILES['contacts_form_images']['size'];
                        // путь к папке с изображением
                        $url_img = '/public/images/';
                           // название ячейки с изображением
                           $name_key = 'contacts_form_images';
                        //    как хочу назвать изображение
                        $name_img = 'contacts-form';
                        //Проверяем значение ошибки и не превышен ли допустимый размер	 
                        if ($error_img !== true && $size_img <= 3000000) {
                            // если загрузилось переносим его в новую папку и даем новое имя
                            $name_file = Main::saveImage($_FILES['contacts_form_images'], $id, $url_img, $name_img);
                            // добавляем новый выйл в базу данных
                            $flag = Main::updateImageTable($name_file, $id,  $name_key);

                            // если изображение в базе обновилось
                            if($flag){
                                // удаляем файл с диска
                                $delit = unlink ($_SERVER['DOCUMENT_ROOT'] . $url_img . $main_page['contacts_form_images']);
                                $error_messages[] = "Изображение успешно изменено!";
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
            // header('Location: /admin/blogs');
            include_once ROOT . '/views/admin/main-page/main-page.php';
            exit;
        }

        include_once ROOT . '/views/admin/main-page/main-page.php';
    }
}
