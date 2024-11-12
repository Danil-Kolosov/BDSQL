<?php

    //Подключение к БД
    $conn = new mysqli('localhost', 'root', 'Ammon Dgerro', 'bd4');
    if($conn->connect_error)
    {
        die("Error:".$conn->connect_error);
    }
    /*В библиотеке pdo для получения данных у объекта PDO вызывается метод query(), в который передается команда SQL. 
    Метод query() возвращает объект PDOStatement, который представляет набор всех полученных из базы данных строк*/
    //выполняемое выражене SQL
    $tableName=$_POST["tableName"];
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
        $data_set = $conn->query("SELECT * FROM {$tableName};");
        //Записываем данные в массив
        $dataQ = [];
        while($row = $data_set->fetch_assoc())
        {
            $dataQ[] = $row;
        }
        $colName = $conn->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='$tableName'");
        $dataCol =[];
        while($row = $colName->fetch_assoc())
        {
            $dataCol[] = $row;
        }
        $data = [];
        $i=0;
        $dataHead=[];
        for($i = 0; $i < count($dataCol);  $i++){
            $dataHead[]=$dataCol[$i]['COLUMN_NAME'];
        }
        $data[]=$dataHead;
        for ($i = 0; $i < count($dataQ);  $i++) {
            $dataTemp=[];
                for($j=0;$j < count($dataCol);$j++){
                    $dataTemp[]=$dataQ[$i][$dataCol[$j]['COLUMN_NAME']];}
            $data[]=$dataTemp;
        }
        $output = '';
        $output = $output.'<table>';
        echo "<table style='font-size: 22px;' border=1 cellspacing=5 cellpading=5>";
        for ( $i = 0; $i < count($dataHead); $i++) {
            echo "<th>";
            echo "{$dataHead[$i]}";
            echo "</th>";
            }
        for ( $i = 1; $i < count($data); $i++) {
            $output = $output."<tr>";
            echo "<tr>";
            for($j=0;$j<count($data[$i]);$j++){
                echo "<td>";
                echo "{$data[$i][$j]}";
                echo "</td>";
                $output =$output. "<td>{$data[$i][$j]}</td>";
            }
            $output =$output. "</tr>";
            echo "</tr>";
            }
        echo "</table>";
        $output =$output. `</table>`;
        //echo ($output);
        $data_set->close();
        }
        $conn->close();
?>