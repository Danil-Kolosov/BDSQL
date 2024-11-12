<?php

    //Подключение к БД
    $conn = new mysqli('localhost', 'root', 'Ammon Dgerro', 'bd4');
    if($conn->connect_error)
    {
        die("Error:".$conn->connect_error);
    }
    $tableName=$_POST["tableName"];
    $tableNameNew=$_POST["tableNameNew"];
    $result = $conn->query("SELECT EXISTS(
        SELECT *
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = 'BD4'
        AND TABLE_NAME = '{$tableName}'
        ) AS table_exists;");
    if($result->fetch_assoc()['table_exists']==0)
    {  
        echo "<h3>Такая таблица не существует</h3>"; 
    }
    else{
    $query = $conn->query("RENAME TABLE {$tableName} TO {$tableNameNew}");
    echo "<h3>Таблица успешно переименована</h3>"; 
}
?>