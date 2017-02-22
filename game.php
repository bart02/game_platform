<?php
	require_once('functions.php');
	if (time() < $regtime) header('Location: /'); else //send();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Главная - Задача одного дня
		</title>
		<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
		<LINK href="style.css" TYPE="text/css" rel="stylesheet">
		<!--[if lt IE 9]>
		<script>
		document.createElement('figure');
		document.createElement('figcaption');
		</script>
		<![endif]-->
		<link href="timer/timeTo.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>

		<div id="container">

			<div id="header">
			</div>

			<div id="top_menu">
			</div>

			<div id="content">
				<div align="center"><font size="6">До окончания тура осталось:</font>
				<div id="countdown-1">
				</div></div>
				<form action="zadanie.php" method="post" >
					<fieldset>
						<legend>
							Получить задание
						</legend>
						<p>
							<label for="zadpass">
								Пароль:
							</label><input type="password" name="zadpass" id="zadpass" required pattern="[A-Za-z0-9-]{3}">
						</p>
							<input type="submit" value="Отправить">
					</fieldset>
				</form>
				<form action="answer.php" method="post" >
					<fieldset>
						<legend>
							Отправить ответ
						</legend>
						<p>
							<label for="pass">
								Пароль:
							</label><input type="password" name="pass" id="pass" required pattern="[A-Za-z0-9-]{3}">
						</p>
						<p>
							<label for="answer">
								Ответ (целое число):
							</label><input type="number" name="answer" id="answer" required >
						</p>
							<input type="submit" value="Отправить">
					</fieldset>
					<br>
				</form>
			</div>

			<div id="clear">
				Чистый
			</div>

			<div id="footer">
				<div style="float:left;"><small><a href="http://school37tomsk.ucoz.ru" target="_blank">Школа 37 г. Томска</a> &copy; 2016</small></div>
				<div style="float:right;"><small>Разработка сайта</small></div>
			</div>

		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
		</script>
		<script>
			window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.min.js"><\/script>')
		</script>
		<script src="timer/jquery.time-to.min.js">
		</script>
		<?php if (time() < $time) {?>
		<script>
			$('#countdown-1').timeTo({
				timeTo: new Date(<?php echo $time * 1000; ?>),
				lang: 'ru',
				displayCaptions: true,
				fontSize: 48,
				captionSize: 14,
				callback: function()
				{
					setTimeout(function(){location.reload()}, 1000);
				}
				});
		</script>
		<?php } else { header('Location: end.php'); } ?>
	</body>
</html>
<?php function send(){
if (!file_exists('sendm')) {
	require_once 'phpmailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	//echo 'noexist';
	$arr = file('baza/u.csv');
	unset($arr[0]);
	foreach($arr as & $value){
		$value = explode(";", $value);
	}
	unset($value);
	for($i = 1; $i <= count($arr); $i++){
		$pass[$i] = trim($arr[$i][3]);
	}
	foreach($pass as & $value){
		$mail->addAddress($value);
	}	
	


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
	//$mail->addAddress($emails);
	$mail->addBCC('e-mail');

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Как получить задания?';
	$mail->Body = <<<EOT
<div>Здравствуйте,</div>
<div>&nbsp;</div>
<div>Вы получили это письмо, так как зарегистрированы во флешмобе &quot;Задача одного дня&quot;.</div>
<div>&nbsp;</div>
<div>Задание вы можете получить зайдя на сайт <a href="http://flashmob.tom.ru">flashmob.tom.ru</a> и ввести Ваш пароль. Для введения ответа в графе ниже введите Ваш пароль и ответ на задачу. Ответ необходимо прислать до 15:00.</div>
<div>&nbsp;</div>
<div>--</div>
<div>C уважением,</div>
<div>Оргкомитет &quot;Задача одного дня&quot;</div>
EOT;
	
	$mail->AltBody = <<<EOT
Здравствуйте,

Вы получили это письмо, так как зарегистрированы во флешмобе "Задача одного дня".

Задание вы можете получить зайдя на сайт flashmob.tom.ru и ввести Ваш пароль. Для введения ответа в графе ниже введите Ваш пароль и ответ на задачу. Ответ необходимо прислать до 15:00.

--
C уважением,
Оргкомитет "Задача одного дня"
EOT;




	if(!$mail->send())
	{
		//header('Location: http://flashmob.tom.ru/error.php');
	}
	else
	{
		//header('Location: http://flashmob.tom.ru/success.php');
		$file   = fopen('sendm', 'a'); fclose ($file);
	}
	}
}
?>