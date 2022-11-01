<?php
include_once SITE_ROOT . '/app/database/db.php';

//Добавление товара в корзину
if (isset($_GET['action']) && $_GET['action'] == "add"){
    global $pdo;
    $id = intval($_GET['id']); 
    if(isset($_SESSION['cart'][$id])){ 
        $_SESSION['cart'][$id]['quantity']++;     
    } else{ 
        $sql_s = "SELECT * FROM goods WHERE id = $id"; 
        $query_s = $pdo -> prepare($sql_s);
        $query_s -> execute(); 
        $cnt = $query_s -> rowCount();
        if($cnt != 0){ 
            $row_s = $query_s -> fetch(); 
            $_SESSION['cart'][$row_s['id']] = array( 
                    "quantity" => 1, 
                    "price" => $row_s['price'] 
            ); 
        }else{ 
            $message = "Такого товара нет."; 
        }  
} 
} 

//Кнопка для обновления корзины
if(isset($_POST['submit'])){    
    foreach($_POST['quantity'] as $key => $val) { 
        if($val==0) { 
            unset($_SESSION['cart'][$key]); 
        }else{ 
            $_SESSION['cart'][$key]['quantity']=$val; 
        } 
    }
} 