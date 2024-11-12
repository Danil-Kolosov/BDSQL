<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LittleSite</title>
</head>
<body>
    <div class="container">
        <div class="container-header"><h1>Лабораторая работа по БД №4</h1></div>
        <div class="container-comands">
            <div class="container-ddl">	     
                <h2>DDL</h2>
                <form action="index.php" method="post"> 
                    <div>
                    <div>Имя таблицы:    <input type="text" name="tableName" id="tableName"/></div>
                    <div><br><input type="submit" name="fetchButton1" value="Создать таблицу" id ="fetchButton1" />
                    <input type="submit" name="fetchButton2" value="Удалить таблицу" id="fetchButton2"/>
                    
                    
                    <input type="submit" name="fetchButton5" value="Очистить таблицу (удалить все записи)" /></div><br>

                    <div>Новое имя таблицы:    <input type="text" name="tableNameNew" id="tableNameNew"/>
                    <input type="submit" name="fetchButton3" value="Переименовать таблицу" id="fetchButton3"/></div><br>

                    </div>
                    <div>                    
                    Имя столбца:<input type="text" name="colName" id="colName"/>                    
                    Тип данных столбца:<input type="text"  name="typesCol" list="typesCol" />
                    <datalist id="typesCol">
                        <option value="CHAR">
                        <option value="TEXT">
                        <option value="DATE">
                        <option value="INT">
                        <option value="FLOAT">
                    </datalist>
                    <input type="submit" name="fetchButton6" value="Добавить столбец" />
                    <input type="submit" name="fetchButton10" value="Удалить столбец" />
                    </div>
                
            </div>
            <div class="container-dml">	
                <h2>DML</h2>
                    <div><input type="submit" name="fetchButton4" method = "POST" value="Вывести таблицу"/></div><br>
                    <div>
                    Данные:    <input type="text" name="data" id="data"/>
                    ID:    <input type="text" name="id" id="id"/></div><br>
                    <div>
                        <input type="submit" name="fetchButton7" value="Добавить запись" />                    
                        <input type="submit" name="fetchButton8" value="Обновить запись" />
                        <input type="submit" name="fetchButton9" value="Удалить запись" />
                    </div>
                    
                
            </div>     
            <div class="container-injoin">	
                <h2>Inner join</h2>
                    
                    <div>Кол-во столбцов 1 таблицы:    <input type="text" name="columnTable1Numbers" id="columnTable1Numbers"/>
                    Кол-во столбцов 2 таблицы:    <input type="text" name="columnTable2Numbers" id="columnTable2Numbers"/></div>
                    <input type="submit" name="fetchButton11" value="Меню inner join" />
                    
            
    
            </div>
        </div>
        <div id="container-message"><h2>Message</h2></div>
    </div>

</body>
</html>


<?php
if(isset($_POST['fetchButton3'])){
    include ("renameTable.php");
}
if(isset($_POST['fetchButton4'])){
    include ("outTable.php");
}
if(isset($_POST['fetchButton1'])){
    include ("createTable.php");
}
if(isset($_POST['fetchButton2'])){
    include ("delateTable.php");
}
if(isset($_POST['fetchButton5'])){
    include ("cleanTable.php");
}
if(isset($_POST['fetchButton6'])){
    include ("addColumn.php");
}
if(isset($_POST['fetchButton7'])){
    include ("addData.php");
}
if(isset($_POST['fetchButton8'])){
    include ("updateData.php");
}
if(isset($_POST['fetchButton9'])){
    include ("deleteData.php");
}
if(isset($_POST['fetchButton10'])){
    include ("deleteColumn.php");
}
if(isset($_POST["fetchButton11"])){
    ?><input type="submit" name="fetchButton12" value="Объединить таблицы" />
                    <?php
                        $columnTable1Numbers=5;
                        $columnTable2Numbers=5;
                        if(isset($_POST["columnTable1Numbers"])){$columnTable1Numbers=$_POST["columnTable1Numbers"];}
                        if(isset($_POST["columnTable2Numbers"])){$columnTable2Numbers=$_POST["columnTable2Numbers"];}
                    ?>
    <div>
        <div>Первая таблица таблица соединяется со второй </div>
        <div>Имя таблицы1:    <input type="text" name="tableName1" id="tableName1"/></div><br>
        <div></div>Имя таблицы2:    <input type="text" name="tableName2" id="tableName2"/></div><br>
        <div>Столбец для соединения в 1 таблице (запсиси в котором в 2 таблицах должны совпадать):    <input type="text" name="condition1" id="condition1"/></div><br>
        <div>Столбец для соединения во 2 таблице (запсиси в котором в 2 таблицах должны совпадать):    <input type="text" name="condition2" id="condition2"/></div><br>
    </div>

    Столбцы 1 таблицы:
    
    <?php
    
    for($i = 1; $i <= $columnTable1Numbers; $i++)
    {
    ?>
         
        <?php 
            $name = "colT1N".$i; 
        ?>
        <div><input type="text" name="<?=$name?>"/></div>
    
        <?php
    }
        ?>
        <br>
    Столбцы 2 таблицы: 
    <?php
    for($i = 1; $i <= $columnTable2Numbers; $i++){
        ?>
            <?php $name = "colT2N".$i; ?>
           <div><input type="text" name="<?=$name?>"/></div>
        
        <?php
    }   ?>

    <br>
    <?php
}
if(isset($_POST['fetchButton12']))
    {
        include ("innerJoin.php");
    }

?>

