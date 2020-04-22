<?php
require_once 'bd.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
$a =  mysqli_query($link,"SELECT COUNT(1) FROM users");
$b = mysqli_fetch_array( $a );
echo $b[0]; // выведет число строк
?>