<?php
require_once('functions.php');
$pass   = trim($_POST['pass']);
$answer = trim($_POST['answer']);
$team   = mb_convert_encoding(check_password($pass), 'UTF-8', 'Windows-1251');
$right  = 1384;
if($team != 'FALSE' and check_team($team))
{
	if($answer == $right){
		$truth = 1;
	}
	else
	{
		$truth = 0;
	}
	$send = "\n" . $team . ";" . $answer . ";" . $truth;
	//echo $send;
	$file = fopen('baza/a.csv', 'a');
	if( !$file )
	{
		fclose ($file);
		header('Location: error.php');
	}
	else
	{
		fputs ($file, mb_convert_encoding($send, 'Windows-1251', 'auto'));
		fclose ($file);
		if ($truth == 1) header('Location: true.php'); else header('Location: false.php');
	}
	
}
else
{
	header('Location: anserror.php');
}


function check_team($vvod) //вывод имени команды по паролю
{
	//header("Content - Type: text / html; charset = Windows - 1251");
	$vvod = mb_convert_encoding($vvod, 'Windows-1251', 'auto');
	$arr  = file('baza/a.csv');
	unset($arr[0]);
	foreach($arr as & $value){
		$value = explode(";", $value);
	}
	unset($value);
	for($i = 1; $i <= count($arr); $i++){
		$kom[$i] = trim($arr[$i][0]);
	}
	$ret = 0;
	foreach($kom as & $value){
		if($vvod == $value){
			$ret = 1;
			break;
		}
	}
	if($ret == 0){
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
?>