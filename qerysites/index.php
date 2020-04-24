<?php
require_once 'bd.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
    
    $uid=$_REQUEST["uid"];
    if($uid){

$query ="SELECT * FROM users WHERE uid=$uid;";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$row=mysqli_fetch_assoc($result);
if(!$row){
    echo 0;
}else{
    echo 1;
}
mysqli_free_result($result);
mysqli_close($link);
}
else
echo 0;
?>
