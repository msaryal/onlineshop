<?php
include_once SITE_ROOT . '/app/database/db.php';

$errMsg = '';
$id = '';
$name = '';
$description = '';

$topics = selectAll('topics');

//Создание категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-create'])){
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if ($name === '' || $description === ''){
      $errMsg = "Заполните все поля.";
    } elseif(mb_strlen($name, 'UTF8') < 2){
        $errMsg = "Категория должна быть более двух символов.";
    } else{
        $existence = selectOne('topics', ['name_topic' => $name]); //Проверка категории в БД
      if ($existence['name_topic'] === $name){
        $errMsg = "Такая категория уже есть в базе.";
      }else{
      $topic = [
        'name_topic' => $name,
        'description' => $description
      ];
  
      $id = insert('topics', $topic);
      $topic = selectOne('topics', ['id' => $id]);
      header('location: ' . BASE_URL . 'admin/topics/index.php');
    }
  }
}else{
  $name = '';
  $description = '';
}

//Обновление категории
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $id = $_GET['id'];
    $topic = selectOne('topics', ['id' => $id]);
    $id = $topic['id'];
    $name = $topic['name_topic'];
    $description = $topic['description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic-edit'])){
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);

    if ($name === '' || $description === ''){
      $errMsg = "Заполните все поля.";
    } elseif(mb_strlen($name, 'UTF8') < 2){
        $errMsg = "Категория должна быть более двух символов.";
    } else{
      $topic = [
        'name_topic' => $name,
        'description' => $description
      ];
  
      $id = $_POST['id'];
      $topic_id = update('topics', $id, $topic);
      header('location: ' . BASE_URL . 'admin/topics/index.php');
    }
  }

//Удаление категории
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
  
  $id = $_GET['delete_id'];
  delete('topics', $id);
  header('location: ' . BASE_URL . 'admin/topics/index.php');
}
?>
