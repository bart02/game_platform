<?php
require_once('functions.php');
$team = strtolower(translit(mb_convert_encoding(check_password($_POST['zadpass']), "UTF-8", "Windows-1251")));
if (check_password($_POST['zadpass']) != 'FALSE') file_download('zadanie/zad.pdf', $team); else header('Location: passerror.php');
//echo check_password($_POST['zadpass']);
?>