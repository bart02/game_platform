<?php
$regtime = 1476946800;
$time = 1476950400;
function check_password($vvod) //вывод имени команды по паролю
{
	//header("Content-Type: text/html; charset=Windows-1251");
	$arr = file('baza/u.csv');
	unset($arr[0]);
	foreach($arr as & $value){
		$value = explode(";", $value);
	}
	unset($value);
	for($i = 1; $i <= count($arr); $i++){
		$pass[$i] = trim($arr[$i][11]);
	}
	$i = 0;
	$ret = 0;
	foreach($pass as & $value){
		$i++;
		if(md5($vvod) == $value){
			$ret = 1;
			break;
		}
	}
	if($ret == 1){
		return $arr[$i][0];
	} else {
		return 'FALSE';
	}
}



function file_download($file, $name) //для скачивания файлов
{
	if(file_exists($file)){
		// сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
		// если этого не сделать файл будет читаться в память полностью!
		if(ob_get_level()){
			ob_end_clean();
		}
		// заставляем браузер показать окно сохранения файла
		header('Content-Description: File Transfer');
		header('Content-Type: application/pdf');
		header('Content-Disposition: attachment; filename=' . translit($name) . '.pdf');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file));
		// читаем файл и отправляем его пользователю
		if($fd = fopen($file, 'rb')){
			while(!feof($fd)){
				print fread($fd, 1024);
			}
			fclose($fd);
		}
		exit;
	}
}



  function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
  }
  //echo translit("Всем привет!");

?>
