<?php
require_once 'bd.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link)); 
     
$query ="SELECT * FROM users";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 


    $emparray = array();
    $data = array(); 
    while($row =mysqli_fetch_assoc($result)) 
    { $emparray[] = $row; 
    } $fp = fopen('menue.json', 'w'); 
    fwrite($fp, json_encode($emparray)); 
    fclose($fp); 
    //$data[1] = encode("["+JSON.stringify({ x1:data[`${i}`]['x1'], x2:data[`${i}`]['x2'], x3:data[`${i}`]['x3'], x4:data[`${i}`]['x4'],x5:'1',},null,4));
    $rows = mysqli_num_rows($result); // количество полученных строк
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        if ($i == 0) {
            echo json_decode($emparray[$i]['login']),",";
        } elseif ($i == strlen($rows)) {
            echo json_decode($emparray[$i]['login']);
        } else {
            echo json_decode($emparray[$i]['login']),",";
        }

    //echo json_decode($emparray[$i]['login']);

    }



/*
if($result)
{
    $rows = mysqli_num_rows($result); // количество полученных строк
    //select json_agg(tablename) from tablename;
    
    echo "<table><tr><th>Id</th><th>UID</th></tr>";
    for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        echo "<tr>";
            for ($j = 0 ; $j < 3 ; ++$j) echo "<td>$row[$j]</td>";
        echo "</tr>";
    }
    echo "</table>";
     

    echo htmlspecialchars($_GET["id"]);
   
    
    // очищаем результат
    
}*/
mysqli_free_result($result);
mysqli_close($link);
?>