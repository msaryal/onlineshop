<?php 
include 'path.php';
include 'app/controllers/topics.php';
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

<title>О нас</title>
</head>
<body>

<!-- HEADER START -->
<?php include 'app/include/header.php';?>
<!-- HEADER END -->

    <!-- Main block START-->
<div class="about container">
    <div class="content row">
        <!-- Main Content-->
        <div class="main-content col-md-9 col-12">
            <h2>О нас</h2>
            <div class="img col-12">
                    <img src="<?=BASE_URL . 'assets/img/4.jpg'?>" alt="" class="img-thumbnail">
                </div>
            <div class="row">
                <p>Магазин одежды SShop - здесь вы сможете найти одежду на разный вкус и цвет!</p>
            </div>
            <div class="row">
                <p>Интернет всегда на связи, и всегда под рукой. Доступ к вашему интернет-магазину возможен круглосуточно и без выходных. 
                А это значит, что товары в вашем магазине могут быть куплены в любой удобный момент. 
                Наш интернет-магазин заботливо сопроводит покупателя от начала и до конца покупки.</p>
            </div>
            <div class="row">
                <p>На нашем сайте представлены полные данные о товаре — начиная от габаритов и заканчивая информацией о стране, 
                в которой произведена вещь, о чем могут умолчать продавцы в обычных магазинах.</p>
            </div>
            <div class="row">
                <p>В интернет-магазинах продается широкий ассортимент товаров — от предметов одежды и обуви до товаров для детей</p>
            </div>
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