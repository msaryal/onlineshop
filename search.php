<?php 
include 'path.php';
include SITE_ROOT . '/app/database/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])){
    $posts = search($_POST['search-term'], 'goods', 'users');
}

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
<link rel="stylesheet" href="assets/css/styles.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<title>Результаты поиска</title>
</head>
<body>

<!-- HEADER START -->
<?php include 'app/include/header.php';?>
<!-- HEADER END -->

<!-- Main block START-->
<div class="container">
    <div class="content row">
        <!-- Main Content-->
        <div class="main-content col-12">
            <h2>Результаты поиска</h2>
            <?php foreach ($posts as $post): ?>
            <div class="post row">
                <div class="img col-md-4 col-12">
                    <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'] ?>" alt="<?=$post['title'] ?>" class="img-thumbnail">
                </div>
                <div class="post-text col-md-8 col-12">
                    <h3>
                        <a href="<?=BASE_URL . 'single.php?post=' . $post['id']; ?>"><?=$post['title']?></a>
                    </h3>
                    <i class="fa-solid fa-ruble-sign"> <?=$post['price'] ?></i>
                    <p class="preview-text">
                        <?=mb_substr($post['content'], 0, 150, 'UTF-8') . '...' ?>
                    </p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Main block END-->

<!-- FOOTER START -->
<?php include 'app/include/footer.php';?>
<!-- FOOTER END -->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>