<?php
	require_once('functions.php');
	$minresh = 60;
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
				<div align="center"><font size="6">До окончания регистрации осталось:</font>
				<div id="countdown-1">
				</div></div>
				<form action="reg.php" method="get" >
					<fieldset>
						<legend>
							Контактная информация
						</legend>
						<p>
							<label for="school">
								ОУ:
							</label><input type="text" name="school" id="school" required>
						</p>
						<p>
							<label for="teacher">
								Учитель:
							</label><input type="text" name="teacher" id="teacher" required>
						</p>
						<p>
							<label for="email">
								E-mail:
							</label><input type="email" name="email" id="email" required>
						</p>
						<p>
							<label for="tel">
								Телефон:
							</label><input type="tel" name="tel" id="tel" required>
						</p>
					</fieldset>
					<fieldset>
						<legend>
							ФИ игроков
						</legend>
						<p>
							<label for="u1">
								Игрок 1:
							</label><input type="text" name="u1" id="u1" required>
						</p>
						<p>
							<label for="u2">
								Игрок 2:
							</label><input type="text" name="u2" id="u2" required>
						</p>
						<p>
							<label for="u3">
								Игрок 3:
							</label><input type="text" name="u3" id="u3" required>
						</p>
						<p>
							<label for="u4">
								Игрок 4:
							</label><input type="text" name="u4" id="u4" required>
						</p>
						<p>
							<label for="u5">
								Игрок 5:
							</label><input type="text" name="u5" id="u5" required>
						</p>
						<!--<p>
							<label for="u6">
								Игрок 6:
							</label><input type="text" name="u6" id="u6" required>
						</p>
						<p>Если команда состоит из менее 6 игроков, то в пустых полях впишите "ххх"</p>-->
					</fieldset>
					<p>
						<input type="submit" value="Отправить">
					</p>
				</form>
			</div>

			<div id="clear">
				Чистый
			</div>

			<div id="footer">
				<div style="float:left;"><small><a href="http://school37tomsk.ucoz.ru" target="_blank">Школа 37 г. Томска</a> &copy; 2016</small></div>
				<div style="float:right;"><small>Разработка сайта <a href="https://vk.com/batalov_artem" target="_blank">Баталов Артем</a>.</small></div>
			</div>

		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
		</script>
		<script>
			window.jQuery || document.write('<script src="node_modules/jquery/dist/jquery.min.js"><\/script>')
		</script>
		<script src="timer/jquery.time-to.min.js">
		</script>
		<?php if (time() < $regtime - 2) {?>
		<script>
			$('#countdown-1').timeTo({
				timeTo: new Date(<?php echo $regtime * 1000; ?>),
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
		<?php } else { header('Location: game.php'); } ?>
	</body>
</html>