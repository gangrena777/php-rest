
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db_name = "novalead";

$link = mysqli_connect($host, $user, $pass);
mysqli_select_db( $link,$db_name) or die ("Нет соединения с БД".mysqli_error($link));

mysqli_query($link, "SET NAMES 'utf8'");


?>