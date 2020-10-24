<?php
class EmailController extends CoreController
{

    // Форма узнать цену
    public static function actionMail()
    {
        // проверяю POST на поля
        if (isset($_POST) && !empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // проверяю коректность email регуляркой функция в components
            if (checkMail($email)) {

                // проверяю коректность телефона регуляркой функция в components
                if (!checkPhone($phone)) {
                    echo 'error_phone';
                    exit;
                }

                //если проверки пройдены формирую письмо
                $to  = 'sportlife.best@gmail.com';
                $message_theme = "Узнать цены";
                $message = "Пользователь: {$name} с email: {$email} телефон: <a href='tel:{$phone}'> {$phone} </ a>";
                $subject = '=?utf-8?b?' . base64_encode($message_theme) . '?=';
                $fromMail = $email;
                $fromName = $name;
                $date = date(DATE_RFC2822);
                $messageId = '<' . time() . '-' . md5($fromMail . $to) . '@' . $_SERVER['SERVER_NAME'] . '>';
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
                $headers .= "From: " . $fromName . " <" . $fromMail . "> \r\n";
                $headers .= "Date: " . $date . " \r\n";
                $headers .= "Message-ID: " . $messageId . " \r\n";

                // отправка письма
                $success = mail($to, $subject, $message, $headers);
                // если успех возвращаем true 
                echo $success;
            } else {
                // или возвращаем ошибку
                echo 'error_email';
            }
        }
    }

    // Форма получить бесплатную тренировку
    public static function actionRequest()
    {
        // проверяю POST на поля
        if (isset($_POST) && !empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $date = $_POST['date'];

            // проверяю коректность email регуляркой функция в components
            if (checkMail($email)) {

                // проверяю коректность телефона регуляркой функция в components
                if (!checkPhone($phone)) {
                    echo 'error_phone';
                    exit;
                }

                // формирую письмо
                $to  = 'sportlife.best@gmail.com';
                $message_theme = "Получить бесплатную тренировку";
                $message = "Пользователь: {$name} дата тренировки: {$date} email: {$email} телефон: <a href='tel:{$phone}'> {$phone} </ a>";
                $subject = '=?utf-8?b?' . base64_encode($message_theme) . '?=';
                $fromMail = $email;
                $fromName = $name;
                $date = date(DATE_RFC2822);
                $messageId = '<' . time() . '-' . md5($fromMail . $to) . '@' . $_SERVER['SERVER_NAME'] . '>';
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
                $headers .= "From: " . $fromName . " <" . $fromMail . "> \r\n";
                $headers .= "Date: " . $date . " \r\n";
                $headers .= "Message-ID: " . $messageId . " \r\n";

                // отправка письма
                $success = mail($to, $subject, $message, $headers);
                echo $success;
            } else {
                echo 'error_email';
            }
        }
    }

    // форма заказать карту (orders)
    public static function actionOrders()
    {
        // проверяю POST на поля
        if (isset($_POST) && !empty($_POST)) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $prices = $_POST['prices'];

            // проверяю коректность email регуляркой функция в components
            if (checkMail($email)) {

                // проверяю коректность телефона регуляркой функция в components
                if (!checkPhone($phone)) {
                    echo 'error_phone';
                    exit;
                }

                //если проверки пройдены формирую письмо
                $to  = 'sportlife.best@gmail.com';
                $message_theme = "Заказать карту";
                $message = "Пользователь: {$name} с email: {$email}, заказал карту: {$prices}, телефон пользователя: <a href='tel:{$phone}'> {$phone} </ a>";
                $subject = '=?utf-8?b?' . base64_encode($message_theme) . '?=';
                $fromMail = $email;
                $fromName = $name;
                $date = date(DATE_RFC2822);
                $messageId = '<' . time() . '-' . md5($fromMail . $to) . '@' . $_SERVER['SERVER_NAME'] . '>';
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=utf-8" . "\r\n";
                $headers .= "From: " . $fromName . " <" . $fromMail . "> \r\n";
                $headers .= "Date: " . $date . " \r\n";
                $headers .= "Message-ID: " . $messageId . " \r\n";

                // отправка письма
                $success = mail($to, $subject, $message, $headers);
                // если успех возвращаем true 
                echo $success;

            } else {
                // или возвращаем ошибку
                echo 'error_email';
            }
        }
    }

    // Форма email рассылки
    public static function actionMailing()
    {
        // проверяю POST
        if (isset($_POST) && !empty($_POST)) {

            $email = $_POST['email'];

            // проверяю коректность email регуляркой функция в components
            if (checkMail($email)) {
                // проверяю email в базе
                $email_exists = Email::checkExistsEmail($email);

                // если в базе такого нету (метод возвращает not_exists)
                if ($email_exists == 'not_exists') {

                    // записываю email в базу
                    $result = Email::addEmail($email);
                    global $pdo;
                    // $last_email = $pdo->lastInsertId();

                    // если email добавлен в базу
                    if ($result === true) {
                        // успех
                        echo 'success';
                        exit;
                    } else {
                        // ошибка
                        echo 'Возникла ошибка при добавлении данных';
                        exit;
                    }
                } else {
                    // если в базе такой есть (метод возвращает email_exists)
                    if (in_array('email_exists', $email_exists)) {
                        echo 'Этот email уже подписан на рассылку';
                        exit;
                    }
                }
            } else {
                // если email не прошел проверку регуляркой
                echo 'Введите коректный email';
                exit;
            }
        } else {
            // если POST не пришол (проверяеться еще в ajax)
            echo 'Введите email';
            exit;
        }
    }
}
