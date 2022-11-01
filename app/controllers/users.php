<?php
include_once SITE_ROOT . '/app/database/db.php';

$errMsg = [];

function userAuth($user){
  $_SESSION['id'] = $user['id'];
  $_SESSION['login'] = $user['user_name'];
  $_SESSION['admin'] = $user['admin'];

  if ($_SESSION['admin']){
    header('location: ' . BASE_URL . 'admin/posts/index.php');
  }else{
    header('location: ' . BASE_URL);
  }
}

$users = selectAll('users');

//Код для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])){
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $spass = trim($_POST['subpassword']);

    if ($login === '' || $email === '' || $pass === ''){
      array_push($errMsg, "Заполните все поля.");
    } elseif(mb_strlen($login, 'UTF8') < 2){
      array_push($errMsg, "Логин должен быть более двух символов.");
    } elseif ($pass !== $spass) {
      array_push($errMsg, "Пароли должны соответствовать.");
    } else{
        $existence = selectOne('users', ['email' => $email]); //Проверка электронной почты в БД
      if ($existence['email'] === $email){
        array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован.");
      }else{
      $pas = password_hash($pass, PASSWORD_DEFAULT);
      $user = [
        'admin' => $admin,
        'user_name' => $login,
        'email' => $email,
        'password' => $pas
      ];
      
      $id = insert('users', $user);
      $user = selectOne('users', ['id' => $id]);
      
      userAuth($user);
    }
  }
}else{
  $login = '';
  $email = '';
}

//Код для формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){
  
  $email = trim($_POST['email']);
  $pass = trim($_POST['password']);

  if ($email === '' || $pass === ''){
    array_push($errMsg, "Заполните все поля.");
  } else{
    $existence = selectOne('users', ['email' => $email]); //Проверка электронной почты в БД
    if($existence && password_verify($pass, $existence['password'])){
      userAuth($existence);
    }else{
      array_push($errMsg, "Почта либо пароль введены неверно."); //Чтобы не узнали, что именно неверно
    }
  }
}else{
  $email = '';
}

//Код для добавления пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])){
  $admin = 0;
  $login = trim($_POST['login']);
  $email = trim($_POST['email']);
  $pass = trim($_POST['password']);
  $spass = trim($_POST['subpassword']);

  if ($login === '' || $email === '' || $pass === ''){
    array_push($errMsg, "Заполните все поля.");
  } elseif(mb_strlen($login, 'UTF8') < 2){
    array_push($errMsg, "Логин должен быть более двух символов.");
  } elseif ($pass !== $spass) {
    array_push($errMsg, "Пароли должны соответствовать.");
  } else{
      $existence = selectOne('users', ['email' => $email]); //Проверка электронной почты в БД
    if ($existence['email'] === $email){
      array_push($errMsg, "Пользователь с такой почтой уже зарегистрирован.");
    }else{
    $pas = password_hash($pass, PASSWORD_DEFAULT);
    if (isset($_POST['admin'])) $admin = 1;
    $user = [
      'admin' => $admin,
      'user_name' => $login,
      'email' => $email,
      'password' => $pas
    ];

    $id = insert('users', $user);
    $user = selectOne('users', ['id' => $id]);
    userAuth($user);
  }
}
}else{
$login = '';
$email = '';
}

//Обновление пользователя в админке
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['edit_id'])){
  $user = selectOne('users', ['id' => $_GET['edit_id']]);

  $id = $user['id'];
  $admin = $user['admin'];
  $user_name = $user['user_name'];
  $email = $user['email'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user'])){

  $id = $_POST['id'];
  $email = trim($_POST['email']);
  $login = trim($_POST['login']);
  $pass = trim($_POST['password']);
  $spass = trim($_POST['subpassword']);
  $admin = isset($_POST['admin']) ? 1 : 0;

  if ($login === ''){
    array_push($errMsg, "Заполните все поля.");
  } elseif(mb_strlen($login, 'UTF8') < 2){
      array_push($errMsg, "Логин должен быть более пяти символов.");
  } elseif ($pass !== $spass) {
      array_push($errMsg, "Пароли должны соответствовать.");
  } else{
    $pas = password_hash($pass, PASSWORD_DEFAULT);
    if (isset($_POST['admin'])) $admin = 1;
    $user = [
      'admin' => $admin,
      'user_name' => $login,
      'password' => $pas
    ];

    $user = update('users', $id, $user);
    header('location: ' . BASE_URL . 'admin/users/index.php');
  }
}else{
  $login = '';
  $email = '';
}

//Удаление пользователя в админке
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  delete('users', $id);
  header('location: ' . BASE_URL . 'admin/users/index.php');
}