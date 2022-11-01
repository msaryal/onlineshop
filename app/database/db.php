<?php

session_start();
require 'connect.php';

function tt($value){
  echo '<pre>';
  print_r($value);
  echo'</pre>';
  exit();
}

function tte($value){
  echo '<pre>';
  print_r($value);
  echo'</pre>';
}

//Проверка выполнения запроса к БД
function dbCheckError($query){
  $errInfo = $query->errorInfo();
  if ($errInfo[0] !== PDO::ERR_NONE){
    echo $errInfo[2];
    exit();
  }
  return true;
}

//Запрос на получение данных c одной таблицы
function selectAll($table, $param = []){
  global $pdo;
  $sql = "SELECT * FROM $table";

  if (!empty($param)){
    $i = 0;
    foreach($param as $key => $value){
      if (!is_numeric($value)){
        $value = "'".$value."'";
      }
      if ($i === 0){
        $sql = $sql . " WHERE $key=$value";
      }else{
        $sql = $sql . " AND $key=$value";
      }
      $i++;
    }
  }

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetchAll();
}

//Запрос на получение одной строки с выбранной таблицы
function selectOne($table, $param = []){
  global $pdo;
  $sql = "SELECT * FROM $table";

  if (!empty($param)){
    $i = 0;
    foreach($param as $key => $value){
      if (!is_numeric($value)){
        $value = "'".$value."'";
      }
      if ($i === 0){
        $sql = $sql . " WHERE $key=$value";
      }else{
        $sql = $sql . " AND $key=$value";
      }
      $i++;
    }
  }
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetch();
}

//Запись в таблицу БД
function insert($table, $param){
  global $pdo;
  $i = 0;
  $col = '';
  $mask = '';
  foreach ($param as $key => $value){
    if($i === 0){
      $col = $col . "$key";
    $mask = $mask . "'" ."$value" . "'";
    }else{
    $col = $col . ", $key";
    $mask = $mask . ", '" . "$value" . "'";
    }
    $i++;
  }
  
  $sql = "INSERT INTO $table ($col) VALUES ($mask)";

  $query = $pdo->prepare($sql);
  $query->execute($param);
  dbCheckError($query);
  return $pdo->lastInsertId();
}

//Обновление строки в таблице
function update($table, $id, $param){
  global $pdo;
  $i = 0;
  $str = '';
  foreach ($param as $key => $value){
    if($i === 0){
      $str = $str . $key . " = '" . $value . "'";
    }else{
      $str = $str .", " . $key . " = '" . $value . "'";
    }
    $i++;
  }
  
  $sql = "UPDATE $table SET $str WHERE id = $id";
  $query = $pdo->prepare($sql);
  $query->execute($param);
  dbCheckError($query);
}

//Удаление строки в таблице
function delete($table, $id){
  global $pdo;
  
  $sql = "DELETE FROM $table WHERE id = $id";
  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
}

//Выборка товаров (posts) с автором в админку
function selectAllFromPostsWithUsers($table1, $table2){
  global $pdo;

  $sql = "SELECT 
  t1.id, 
  t1.title, 
  t1.img, 
  t1.content, 
  t1.status, 
  t1.id_topic, 
  t1.created_date, 
  t2.user_name
  FROM $table1 AS t1 JOIN $table2 AS t2 ON t1.id_user = t2.id";

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetchAll();
}

//Выборка товаров (posts) с автором на главную
function selectAllFromPostsWithUsersOnIndex($table1, $table2, $limit, $offset){
  global $pdo;

  $sql = "SELECT p.*, u.user_name FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.status=1
  LIMIT $limit OFFSET $offset";

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetchAll();
}

//Выборка товаров (posts) в карусель на главную
function selectTopTopicFromPostsOnIndex($table1){
  global $pdo;

  $sql = "SELECT * FROM $table1 WHERE id_topic = 9";

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetchAll();
}

//Поиск по заголовкам и содержимому
function search($text, $table1, $table2){
  $text = trim(strip_tags(stripcslashes(htmlspecialchars($text))));
  global $pdo;

  $sql = "SELECT 
  p.*, u.user_name 
  FROM $table1 AS p 
  JOIN $table2 AS u 
  ON p.id_user = u.id 
  WHERE p.status=1
  AND p.title LIKE '%$text%' OR p.content LIKE '%$text%'";

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetchAll();
}

//Выборка товаров (posts) с автором для single
function selectPostFromPostsWithUsersOnSingle($table1, $table2, $id){
  global $pdo;

  $sql = "SELECT p.*, u.user_name FROM $table1 AS p JOIN $table2 AS u ON p.id_user = u.id WHERE p.id = $id";

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetch();
}

//Подсчет строк в таблице
function countRow($table1){
  global $pdo;

  $sql = "SELECT COUNT(*) FROM $table1 WHERE status = 1";

  $query = $pdo->prepare($sql);
  $query->execute();
  dbCheckError($query);
  return $query->fetchColumn();
}

//Создание строки из массива для вывода в order.content
function array2string($data){
  $log_a = "";
  foreach ($data as $key => $value) {
      if(is_array($value))    $log_a .= "[".$key."]=>(". array2string($value). ")";
      else                    $log_a .= "[".$key."]=>".$value."\n";
  }
  return $log_a;
}