<?php
class RecoverController {
	public static $page = 'recover';
	public static function actionIndex() {
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = $_POST['email'];
			echo $email;
			$message = '';
			$result_email = User::getByEmail($email);

			if ($result_email['email'] === $email) { //Если email с бд совпадает
				$random_pas = random_int(100, 999);
				$hash = password_hash($random_pas, PASSWORD_BCRYPT);
				$pattern = '/[\/]+/';//Обрезаю слеш с хеша пароля если сформируеться
				$pass_hash = preg_replace($pattern, '$1', $hash);
					//Записываю в recover_hesh в бд
				$result_hash = User::savePassHash($pass_hash, $email);
				
				if ($result_hash === true) {
					$message = 'Перейдите на почту для востановления пароля.';

					// правильная отправка почты не в спам
					$to  = $email;    
					$message_theme = "Восстановление пароля";  
					$email_message = "<a href='http://sport-life.fun/restore?recover_hash={$pass_hash}'>Перейдите по ссылке для восстановления пароля</a>";

					$subject = '=?utf-8?b?'. base64_encode($message_theme) .'?=';
					$fromMail = 'sportlife.best@gmail.com';
					$fromName = 'sport-life.fun';
					$date = date(DATE_RFC2822);
					$messageId='<'.time().'-'.md5($fromMail.$to).'@'.$_SERVER['SERVER_NAME'].'>';
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= "Content-type: text/html; charset=utf-8". "\r\n";
					$headers .= "From: ". $fromName ." <". $fromMail ."> \r\n";
					$headers .= "Date: ". $date ." \r\n";
					$headers .= "Message-ID: ". $messageId ." \r\n";

					$result_mail = mail($to , $subject, $email_message, $headers);
					
				}else{
					$message = 'Возникла ошибка с созданием временного пароля.';
				}
			} else {
				$message = 'Пользователь с таким Email не зарегестрирован.';
			}
			
		}

		$footer_blogs = Blog::getBlogsFooter(3);
		$footer_images = Image::getImagesFooter(12);
		include_once ROOT . '/views/layout/header-top.php';
		include_once ROOT . '/views/user/recover.php';
		include_once ROOT . '/views/layout/footer.php';
	}
}