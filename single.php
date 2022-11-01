<?php
include 'path.php';
include 'app/controllers/topics.php';

$post = selectPostFromPostsWithUsersOnSingle('goods', 'users', $_GET['post']);
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

<!-- Main block START-->
<div class="container">
    <div class="content row">
        <!-- Main Content-->
        <div class="main-content col-md-9 col-12">
            <h2><?php echo $post['title']; ?></h2>
            <div class="single_post row">
                <div class="img col-12">
                    <img src="<?=BASE_URL . 'assets/img/posts/' . $post['img'] ?>" alt="<?=$post['title'] ?>" class="img-thumbnail">
                </div>
                <div class="info">
                    <i class="fa-solid fa-ruble-sign"> <?=$post['price'] ?></i>
                    <a href="catalog.php?action=add&id=<?php echo $post['id'];?>">В корзину</a>
                </div>
                <div class="single_post_text col-12">
                    <?=$post['content'] ?>
                </div>
            <!-- Подключение отзывы на товар-->
            <?php include 'app/include/comments.php';?>
            </div>
        </div>
        <!-- Sidebar Content-->
        <div class="sidebar col-md-3 col-12">    
            <div class="section search">
                <h3>Поиск</h3>
                <form action="/" method="post">
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

<!-- Footer START-->
<?php include 'app/include/footer.php';?>
<!-- Footer END-->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>