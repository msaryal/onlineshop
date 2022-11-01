<?php
include_once SITE_ROOT . '/app/database/db.php';

if (!$_SESSION){
    header('location: ' . BASE_URL . 'log.php');
}

$errMsg = [];
$id = '';
$title = '';
$price = '';
$content = '';
$img = '';
$topic = '';

$topics = selectAll('topics');
$posts = selectAll('goods');
$postsAdm = selectAllFromPostsWithUsers('goods', 'users');

//Создание товара
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){
    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTempName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;

        if (strpos($fileType, 'image') === false){
            array_push($errMsg, "Можно загружать только изображения.");
        }else{
            $result = move_uploaded_file($fileTempName, $destination);
        
        if ($result){
            $_POST['img'] = $imgName;
        }else{
            array_push($errMsg, "Ошибка загрузки изображения.");
        }
        }
    }else{
        array_push($errMsg, "Ошибка получения изображения.");
    }

    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if ($title === '' || $price === '' || $content === '' || $topic === ''){
      array_push($errMsg, "Заполните все поля.");
    } elseif(mb_strlen($title, 'UTF8') < 5){
        array_push($errMsg, "Название товара должно быть более пяти символов.");
    } else{
      $post = [
        'id_user' => $_SESSION['id'],
        'title' => $title,
        'price' => $price,
        'content' => $content,
        'img' => $_POST['img'],
        'status' => $publish,
        'id_topic' => $topic
      ];
  
      $post = insert('goods', $post);
      $post = selectOne('goods', ['id' => $id]);
      header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $id = '';
    $title = '';
    $price = '';
    $content = '';
    $publish = '';
    $topic = '';
}

//Обновление товара
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $post = selectOne('goods', ['id' => $_GET['id']]);
    
    $id = $post['id'];
    $title = $post['title'];
    $price = $post['price'];
    $content = $post['content'];
    $topic = $post['id_topic'];
    $publish = $post['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $price = trim($_POST['price']);
    $content = trim($_POST['content']);
    $topic = trim($_POST['topic']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if (!empty($_FILES['img']['name'])){
        $imgName = time() . "_" . $_FILES['img']['name'];
        $fileTempName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;

        if (strpos($fileType, 'image') === false){
            array_push($errMsg, "Можно загружать только изображения.");
        }else{
            $result = move_uploaded_file($fileTempName, $destination);
        
        if ($result){
            $_POST['img'] = $imgName;
        }else{
            array_push($errMsg, "Ошибка загрузки изображения.");
        }
        }
    }else{
        array_push($errMsg, "Ошибка получения изображения.");
    }

    if ($title === '' || $price === '' || $content === '' || $topic === ''){
      array_push($errMsg, "Заполните все поля.");
    } elseif(mb_strlen($title, 'UTF8') < 5){
        array_push($errMsg, "Название товара должно быть более пяти символов.");
    } else{
      $post = [
        'id_user' => $_SESSION['id'],
        'title' => $title,
        'price' => $price,
        'content' => $content,
        'img' => $_POST['img'],
        'status' => $publish,
        'id_topic' => $topic
      ];
  
      $post = update('goods', $id, $post);
      header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else{
    $title = $_POST['title'];
    $price = $_POST['price'];
    $content = $_POST['content'];
    $publish = isset($_POST['publish']) ? 1 : 0;
    $topic = $_POST['id_topic'];
}
//Статус выставить или снять
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $publish =  $_GET['publish'];

    $postId = update('goods', $id, ['status' => $publish]);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
    exit();
}

//Удаление товара
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('goods', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}
?>