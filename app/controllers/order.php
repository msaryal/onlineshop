<?php
include_once SITE_ROOT . '/app/database/db.php';

if (!$_SESSION){
    header('location: ' . BASE_URL . 'log.php');
}

$id = '';
$fio = '';
$email = '';
$phone = '';
$address = '';
$content = '';
$errMsg = '';

$orderForAdm = selectAll('orders');

global $pdo;
$i = 1;
$sql="SELECT * FROM goods WHERE id IN ("; 
foreach($_SESSION['cart'] as $id => $value) { 
    if($i === 0){
        $sql.=$id;
    }else{
        $sql.=$id.",";
    }
    $i++;  
}

$sql=substr($sql, 0, -1).")"; 
$query = $pdo->prepare($sql);
$query->execute(); 
$totalprice=0; 
while($row = $query -> fetch()){ 
    $subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price']; 
    $totalprice+=$subtotal;
}

//Оформление закза
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_REQUEST['button-order'])){
    $fio = trim($_REQUEST['fio']);
    $email = trim($_REQUEST['email']);
    $phone = trim($_REQUEST['phone']);
    $address = trim($_REQUEST['address']);
    $content = array2string($_SESSION['cart']);
    if ($fio === '' || $phone === '' || $address === ''){
      $errMsg = "Заполните все поля.";
    }else{
        $order = [
            'name' => $fio,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'content' => $content
        ];
        $id = insert('orders', $order);
        $order = selectOne('orders', ['id' => $id]);
        if($id){
            $errMsg = "Ваша заявка с номером №$id принята.";
        }
    }
}else{
    $fio = '';
    $email = '';
    $phone = '';
    $address = '';
}

//Удаление заказа в админке
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('orders', $id);
    header('location: ' . BASE_URL . 'admin/orders/index.php');
  }
  