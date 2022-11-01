<?php 
include 'path.php';
include 'app/controllers/users.php';
;?>

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
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<title>Войти</title>
</head>
<body>

<!-- HEADER START -->
<?php include 'app/include/header.php';?>
<!-- HEADER END -->

<!-- FORM START -->
<div class="container log_form">
    <form class="row justify-content-center"  method="post" action="log.php">
        <h2 class="col-12">Авторизация</h2>
        <div class="mb-3 col-12 col-md-4 err">
                    <!-- Вывод массива с ошибками -->
                <?php include 'app/helps/errorInfo.php';?>
        </div>
        <!--<div class="mb-3 col-12 col-md-4 err">
            <p><//?=$errMsg?></p>
        </div>-->
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Ваша почта</label>
            <input name="email" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите Вашу почту...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите Ваш пароль...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
        <button type="submit" name="button-log" class="btn btn-secondary">Войти</button>
        <a href="reg.php">Зарегистрироваться</a>
        </div>
    </form>
</div>
<!-- FORM END -->

<!-- Footer START-->
<?php include 'app/include/footer.php';?>
<!-- Footer END-->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>