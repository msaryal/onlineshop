<?php
include '../../path.php';
include '../../app/controllers/order.php';
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
<link rel="stylesheet" href="../../assets/css/admin.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<title>Управление заказами</title>
</head>
<body>

<!-- HEADER START -->
<?php include '../../app/include/header_admin.php';?>
<!-- HEADER END -->

<div class="container">
<?php include '../../app/include/sidebar_admin.php'?> 
        <div class="posts col-9">
            <div class="row title-table">
                <h2>Управление заказами</h2>
                <div class="mb-12 col-12 col-md-12 err">
                    <p><?=$_SESSION['error']; ?></p>
                </div>
                <div class="col-1">ID</div>
                <div class="col-3">Содержание заказа</div>
                <div class="col-2">Заказчик</div>
                <div class="col-2">Телефон</div>
                <div class="col-2">Адрес</div>
                <div class="col-1">Управление</div>
            </div>
            <?php foreach($orderForAdm as $key => $order): ?>
                <div class="row post">
                    <div class="id col-1"><?= $order['id']; ?></div>
                    <div class="title col-3"><?=$order['content'] ?></div>
                    <div class="author col-2"><?= $order['name']; ?></div>
                    <div class="phone col-2"><?= $order['phone']; ?></div>
                    <div class="address col-2"><?= $order['address']; ?></div>
                    <div class="del col-1"><a href="index.php?delete_id=<?=$order['id']; ?>">delete</a></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- FOOTER START -->
<?php include '../../app/include/footer.php';?>
<!-- FOOTER END -->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>