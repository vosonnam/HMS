<?php
header("charset=utf-8");
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = "hms1";
$conn = mysqli_connect($hostname, $username, $password,$dbname);
if (!$conn) {
 die('Không thể kết nối: ' . mysqli_error($conn));
 exit();
}
// echo 'Kết nối thành công';
mysqli_set_charset($conn,'UTF8');
?>
