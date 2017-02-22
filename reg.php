<pre>
	<?php
	$school = trim($_GET['school']);
	$teacher= trim($_GET['teacher']);
	$email  = trim($_GET['email']);
	$tel    = trim($_GET['tel']);
	$u1     = trim($_GET['u1']);
	$u2     = trim($_GET['u2']);
	$u3     = trim($_GET['u3']);
	$u4     = trim($_GET['u4']);
	$u5     = trim($_GET['u5']);
	$u6     = trim($_GET['u6']);
	$pass   = generate_password(3);
	$team = 'Команда_' . lines('baza/u.csv');

	$send   = "\n" . $team . ";" . $school . ";" . $teacher . ";" . $email . ";" . $tel . ";" . $u1 . ";" . $u2 . ";" . $u3 . ";" . $u4 . ";" . $u5 . ";" . $u6 . ";" . md5($pass);
	$file   = fopen('baza/u.csv', 'a');
	if( !$file ){
		header('Location: http://flashmob.tom.ru/error.php');
	}
	else
	{
		fputs ($file, mb_convert_encoding($send, 'Windows-1251', 'auto'));
	}
	fclose ($file);




	require 'phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'e-mail';                 // SMTP username
	$mail->Password = '';                           // SMTP password
	$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                                    // TCP port to connect to
	$mail->CharSet = 'utf-8';

	$mail->setFrom('e-mail', 'Оргкомитет "Задача одного дня"');
	$mail->addAddress($email, 'Команда "' . $team . '"');               // Name is optional

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Регистраця пройдена';
	$mail->Body = <<<EOT
<div>Здравствуйте, &quot;$team&quot;,</div>
<div>&nbsp;</div>
<div>Спасибо за регистрацию во флешмобе &quot;Задача одного дня&quot;.</div>
<div>&nbsp;</div>
<div>Ваш пароль - $pass.</div>
<div>&nbsp;</div>
<div>Также напоминаем список участнков вашей команды:</div>
<div>$u1</div>
<div>$u2</div>
<div>$u3</div>
<div>$u4</div>
<div>$u5</div>
<div>$u6</div>
<div>&nbsp;</div>
<div>20 октября (четверг) в 14:00 вы получите задание на указанную почту ($email), после того как решите задание заходите на сайт <a href="http://flashmob.tom.ru">flashmob.tom.ru</a>, вводите ваш пароль и вводите ответ на задачу. Ответ необходимо прислать до 15:00.</div>
<div>&nbsp;</div>
<div>--&nbsp;</div>
<div>C уважением,</div>
<div>Оргкомитет &quot;Задача одного дня&quot;</div>
EOT;
	
	$mail->AltBody = <<<EOT
Здравствуйте, "$team",

Спасибо за регистрацию во флешмобе "Задача одного дня".

Ваш пароль - $pass.

Также напоминаем список участнков вашей команды:
$u1
$u2
$u3
$u4
$u5
$u6

20 октября (четверг) в 14:00 вы получите задание на указанную почту ($email), после того как решите задание заходите на сайт flashmob.tom.ru, вводите ваш пароль и вводите ответ на задачу. Ответ необходимо прислать до 15:00.

-- 
C уважением,
Оргкомитет "Задача одного дня"
EOT;




	if(!$mail->send())
	{
		header('Location: http://flashmob.tom.ru/error.php');
	}
	else
	{
		header('Location: http://flashmob.tom.ru/success.php');
	}






	function generate_password($number)
	{
		$arr = array('a','b','c','d','e','f',
			'g','h','i','j','k','l',
			'm','n','o','p','r','s',
			't','u','v','x','y','z',
			'A','B','C','D','E','F',
			'G','H','I','J','K','L',
			'M','N','O','P','R','S',
			'T','U','V','X','Y','Z',
			'1','2','3','4','5','6',
			'7','8','9','0');
		// Генерируем пароль
		$pass = "";
		for($i = 0; $i < $number; $i++)
		{
			// Вычисляем случайный индекс массива
			$index = rand(0, count($arr) - 1);
			$pass .= $arr[$index];
		}
		return $pass;
	}
	
	
	
	function lines($file) 
{ 
    // в начале ищем сам файл. Может быть, путь к нему был некорректно указан 
    if(!file_exists($file)) header('Location: http://flashmob.tom.ru/error.php');
     
    // рассмотрим файл как массив
    $file_arr = file($file); 
     
    // подсчитываем количество строк в массиве 
    $lines = count($file_arr); 
     
    // вывод результата работы функции 
    return $lines; 
} 
	?>
</pre>