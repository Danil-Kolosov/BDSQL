<?php
//Подключение к БД
    $conn = new mysqli('localhost', 'root', 'Ammon Dgerro', 'bd4');
    if($conn->connect_error)
    {
        die("Error:".$conn->connect_error);
    }
    $tableName1=$_POST["tableName1"];
    $tableName2=$_POST["tableName2"];
    $keyCol1=$_POST["condition1"];
    $keyCol2=$_POST["condition2"];
    $columnTable1Numbers=$_POST["columnTable1Numbers"];
    $columnTable2Numbers=$_POST["columnTable2Numbers"];
    $sqlCommand="SELECT ";
    $name = "colT1N1";
    $sqlCommand = $sqlCommand ."{$tableName1}.{$_POST["{$name}"]}";
    for($i = 2; $i <= $columnTable1Numbers; $i++){
         
        $name = "colT1N".$i;
        $sqlCommand = $sqlCommand .","." {$tableName1}.{$_POST["{$name}"]}";
    }
    $name = "colT2N1";
    $sqlCommand = $sqlCommand .", {$tableName2}.{$_POST["{$name}"]}";
    for($i = 2; $i <= $columnTable2Numbers; $i++){
         
        $name = "colT2N".$i;
        $sqlCommand = $sqlCommand ."," ;
        $sqlCommand = $sqlCommand ."{$tableName2}.{$_POST["{$name}"]}";
    }
    $sqlCommand= $sqlCommand ." FROM {$tableName1} JOIN {$tableName2} ON {$tableName2}.{$keyCol2} = {$tableName1}.{$keyCol1};";
    $result = $conn->query("SELECT EXISTS(
        SELECT *
        FROM INFORMATION_SCHEMA.TABLES 
        WHERE TABLE_SCHEMA = 'BD4'
        AND TABLE_NAME = '{$tableName1}'
        ) AS table_exists;");
    if($result->fetch_assoc()['table_exists']==0)
    {  
        echo "<h3>Такая таблица не существует</h3>"; 
    }
    else{
    $query = $conn->query($sqlCommand);

    echo "<h3>Операция успешно выполнена</h3>"; 
        //ВЫВОД
        $tableName="Результат";
        $data_set = $query;
        $dataQ = [];
        while($row = $data_set->fetch_assoc())
        {
            $dataQ[] = $row;
        }
        $dataCol =[];
        for($i = 1; $i <= $columnTable1Numbers; $i++){
         
            $name = "colT1N".$i;
            $dataCol[] = "{$_POST["{$name}"]}";
           
        }
        for($i = 1; $i <= $columnTable2Numbers; $i++){
         
            $name = "colT2N".$i;
            $dataCol[] = "{$_POST["{$name}"]}";
        }
        
        $data = [];
    $i=0;
    $dataHead=[];
    for($i = 0; $i < count($dataCol);  $i++){
        $dataHead[]=$dataCol[$i];
        
    }
    $data[]=$dataHead;
    for ($i = 0; $i < count($dataQ);  $i++) {
        $dataTemp=[];
            for($j=0;$j < count($dataCol);$j++){
                $dataTemp[]=$dataQ[$i][$dataCol[$j]];}
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
    $data_set->close();

}
$conn->close();
?>