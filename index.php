<?php 
include 'path.php';
include 'app/controllers/topics.php';

$page = isset($_GET['page']) ? $_GET['page'] : 1;//Номер страницы
$limit = 3; //Количество записей на одной странице
$offset = $limit * ($page - 1); //Шаг страниц
$total_pages = ceil(countRow('goods') / $limit); //Количество всех записей(товаров)

$posts = selectAllFromPostsWithUsersOnIndex('goods', 'users', $limit, $offset);
$topTopic = selectAll('goods');
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

<title>SShop</title>
</head>
<body>

<!-- HEADER START -->
<?php include 'app/include/header.php';?>
<!-- HEADER END -->

<!--Carousel block START-->
<div class="container">
    <div class="row">
        <h2 class="slider-title"></h2>
    </div>
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?=BASE_URL . 'assets/img/1.jpg'?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="<?=BASE_URL . 'assets/img/2.jpg'?>" class="d-block w-100" alt="...">
            </div>
                <div class="carousel-item">
            <img src="<?=BASE_URL . 'assets/img/3.jpg'?>" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
</div>
<!--Carousel block END-->

<!-- Main block START-->
<div class="container">
    <div class="content row">
        <!-- Main Content-->
        <div class="main-content col-md-9 col-12">
            <h2>Новинки</h2>
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
            <!-- Подключение навигации -->
            <?php include 'app/include/pagination.php';?>
        </div>
        <!-- Sidebar Content-->
        <div class="sidebar col-md-3 col-12">  
            <div class="section search">
                <h3>Поиск</h3>
                <form action="search.php" method="post">
                    <input type="text" name="search-term" class="text-input" placeholder="Что Вы ищете?">
                </form>
            </div>
            <div class="section topics">
                <h3>Категории</h3>
                <ul>
                    <?php foreach($topics as $key => $topic): ?>
                    <li>
                        <a href="<?=BASE_URL . 'category.php?id=' . $topic['id'];?>"><?=$topic['name_topic'];?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
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