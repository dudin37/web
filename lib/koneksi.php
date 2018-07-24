<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_sig_pupuk";

$koneksi = mysqli_connect(
	$db_host,
	$db_user,
	 $db_pass, $db_name);

if (!function_exists('cleanInput'))   {
function cleanInput($text)
{
  //strip tags
  $text = strip_tags($text);
  $text = trim($text);
  return $text;
}
}

if (!function_exists('Is_email'))   {
function Is_email($user)
{
  //If the username input string is an e-mail, return true
  if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
    return true;
  } else {
    return false;
  }
}
}

if (!function_exists('acakangkahuruf'))   {
function acakangkahuruf($panjang)
{
    $karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
}
?>
