<?php 
include 'path.php';
include 'app/controllers/topics.php';
include 'app/controllers/cart.php';

$posts = selectAll('goods');
?>

<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Font Awesome-->
<script src="https://kit.fontawesome.com/830df78596.js" crossorigin="anonymous"></script>

    <!-- Custom Styling-->
<link rel="stylesheet" href="../../assets/css/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<title>Корзина</title>
</head>
<body>

<!-- HEADER START -->
<?php include 'app/include/header.php';?>
<!-- HEADER END -->

<!-- Main block START-->
<div id="main" class="container">
    <h1>Корзина</h1> 
        <form method="post" action="cart.php"> 
        <table>
            <tr>
                <th></th>
                <th>Название</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Всего</th>
            </tr>
            <?php 
            global $pdo;
            $i = 1;
            $sql="SELECT * FROM goods WHERE id IN ("; 
            if($_SESSION['cart']){
            foreach($_SESSION['cart'] as $id => $value){ 
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
                ?> 
                <tr> 
                    <td><img src="<?=BASE_URL . 'assets/img/posts/' . $row['img'] ?>" alt="<?=$posts['title'] ?>" class="img-thumbnail"></td>
                    <td><?php echo $row['title'] ?></td> 
                    <td><input type="text" name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td> 
                    <td><?php echo $row['price'] ?></td> 
                    <td><?php echo $_SESSION['cart'][$row['id']]['quantity']*$row['price'] ?></td> 
                </tr> 
                <?php 
                }
                }else{
                    echo "Ваша корзина пуста.";
                }
                ?> 
                <tr> 
                    <td colspan="6">Итого: <?php echo $totalprice ?></td> 
                </tr> 
        </table>
        <br /> 
        <button class="btn btn-secondary" type="submit" name="submit">Пересчитать</button>  
        </form> 
        <div class="order col">
            <form method="post" action="order.php">
                <button class="btn btn-secondary" type="submit" name="order">Оформить заказ</button>
            </form>
        </div>
<br /> 
<p>Чтобы удалить предмет, укажите количество 0. </p>
</div>
<!-- Main block END-->

<!-- FOOTER START -->
<?php include 'app/include/footer.php';?>
<!-- FOOTER END -->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>