<?php
    //Подключение к БД
    $conn = new mysqli('localhost', 'root', 'Ammon Dgerro', 'bd4');
    $tableName=`none`;
    if(isset($_POST["tableName"]))
    {
        $tableName=$_POST["tableName"];
    }
    if($conn->connect_error)
    {
        die("Error:".$conn->connect_error);
    }
    /*В библиотеке pdo для получения данных у объекта PDO вызывается метод query(), в который передается команда SQL. 
    Метод query() возвращает объект PDOStatement, который представляет набор всех полученных из базы данных строк*/
    //выполняемое выражене SQL
    $result = $conn->query("SELECT EXISTS(
        SELECT *
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = 'BD4'
        AND TABLE_NAME = '{$tableName}'
        ) AS table_exists;");
    if($result->fetch_assoc()['table_exists']==1)
    {  
    $data = [];
    $data[]="Такая таблица уже существует";
    $message = "Такая таблица уже существует";
    echo "<h3>Такая таблица уже существует</h3>";
    }
    else
    {   
    $result = $conn->query("CREATE TABLE `{$tableName}` (`id` INTEGER PRIMARY KEY AUTO_INCREMENT)");
    $message = "Таблица успешно создана";
    echo "<h3>Таблица успешно создана</h3>";
    }
    $conn->close();
?>