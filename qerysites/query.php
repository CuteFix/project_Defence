<?php

$user="root";  
$password="";  
$host = "qerysites";
$database = "reg"; 

$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
    
    $uid=$_REQUEST["uid"];
    if($uid){

$query ="SELECT * FROM users WHERE uid=$uid;";
$if = "SELECT * FROM users WHERE uid=$uid AND status='На роботі'";
$ifresult = mysqli_query($link, $if) or die("Ошибка " . mysqli_error($link)); 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 

$row=mysqli_fetch_assoc($result);
$ror=mysqli_fetch_assoc($ifresult);
if(!$row){
    echo 0;
}else{
    
    if(!$ror){
        $query3 = "UPDATE users SET created=NOW(), status='На роботі' WHERE uid=$uid AND status='Не на роботі'";
        $result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));  
        echo 1;
    }else{
    $query2 = "UPDATE users SET modified=NOW(), status='Не на роботі' WHERE uid=$uid AND status='На роботі'";
    $result2 = mysqli_query($link, $query2); //or die("Ошибка " . mysqli_error($link)); 
    echo 1;
}
}

mysqli_free_result($result);

mysqli_close($link);
}
else
echo 0;
?>
