<?php 
include 'path.php';
include 'app/controllers/topics.php';
include 'app/controllers/users.php';
include 'app/controllers/cart.php';
include 'app/controllers/order.php';

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

<title>Оформление заказа</title>
</head>
<body>

<!-- HEADER START -->
<?php include 'app/include/header.php';?>
<!-- HEADER END -->

  <!-- FORM START -->
<div class="container reg_form">
    <form class="row justify-content-center"  method="post" action="#">
        <h2>Оформление заказа</h2>
        <div class="mb-3 col-12 col-md-4 err">
            <p><?=$errMsg?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">ФИО</label>
            <input name="fio" value="<?=$_REQUEST['fio'] ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Фамилия Имя Отчество">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputEmail1" class="form-label">Электронная почта</label>
            <input name="email" value="<?=$_REQUEST['email']?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Почта">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Телефон</label>
            <input name="phone" value="<?=$_REQUEST['phone'] ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Номер телефона">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Адрес</label>
            <input name="address" value="<?=$_REQUEST['address'] ?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Адрес доставки">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-2">
        <button type="submit" class="btn btn-secondary" name="button-order">Оформить заказ</button>
        </div>
    </form>
</div>
<!-- FORM END -->

<!-- FOOTER START -->
<?php include 'app/include/footer.php';?>
<!-- FOOTER END -->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>