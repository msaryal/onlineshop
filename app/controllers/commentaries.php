<?php
include_once SITE_ROOT . '/app/database/db.php';

$commentsForAdm = selectAll('comments');

$page = $_GET['post'];
$email = '';
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];

//Код для формы создания отзыва
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){
    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);

    if ($email === '' || $comment === ''){
        array_push($errMsg, "Заполните все поля.");
    } elseif(mb_strlen($comment, 'UTF8') < 10){
        array_push($errMsg, "Содержание отзыва должно быть более 10-ти символов.");
    } else{
        $user = selectOne('users', ['email' => $email]);
        if($user['email'] == $email){
            $status = 1;
        }

        $comment = [
        'status' => $status,
        'page' => $page,
        'email' => $email,
        'comment' => $comment
      ];
  
      $comment = insert('comments', $comment);
      $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
    }
}else{
    $email = '';
    $comment = '';
    $comments = selectAll('comments', ['page' => $page, 'status' => 1]);
}

//Обновление отзыва
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $oneComment = selectOne('comments', ['id' => $_GET['id']]);

    $id = $oneComment['id'];
    $email = $oneComment['email'];
    $text1 = $oneComment['comment'];
    $pub = $oneComment['status'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])){
    $id = $_POST['id'];
    $text = trim($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if ($text === ''){
        array_push($errMsg, "Отзыв не имеет содержимого текста.");
    } elseif(mb_strlen($text, 'UTF8') < 20){
        array_push($errMsg, "Отзыв должен быть более 20-ти символов.");
    } else{
      $comm = [
        'comment' => $text,
        'status' => $publish
      ];
  
      $comment = update('comments', $id, $comm);
      header('location: ' . BASE_URL . 'admin/comments/index.php');
    }
}else{
    $text = trim($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0;
}

//Статус выставить или снять
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $publish =  $_GET['publish'];

    $postId = update('comments', $id, ['status' => $publish]);
    header('location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}

//Удаление отзыва
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('comments', $id);
    header('location: ' . BASE_URL . 'admin/comments/index.php');
}
?>