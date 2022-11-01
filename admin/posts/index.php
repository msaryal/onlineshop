<?php
include '../../path.php';
include '../../app/controllers/posts.php';
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

<title>Управление товарами</title>
</head>
<body>

<!-- HEADER START -->
<?php include '../../app/include/header_admin.php';?>
<!-- HEADER END -->

<div class="container">
<?php include '../../app/include/sidebar_admin.php'?> 
        <div class="posts col-9">
            <div class="button row">
                <a href="<?php echo BASE_URL . "admin/posts/create.php";?>" class="col-3 btn btn-primary">Создать</a>
                <span class="col-1"></span>
                <a href="<?php echo BASE_URL . "admin/posts/index.php";?>" class="col-3 btn btn-primary">Управление</a>
            </div>
            <div class="row title-table">
                <h2>Управление товарами</h2>
                <div class="mb-12 col-12 col-md-12 err">
                    <p><?=$_SESSION['error']; ?></p>
                </div>
                <div class="col-1">ID</div>
                <div class="col-4">Название</div>
                <div class="col-2">Автор</div>
                <div class="col-2">Управление</div>
                <div class="col-3"></div>
            </div>
            <?php foreach($postsAdm as $key => $post): ?>
                <div class="row post">
                    <div class="id col-1"><?= $post['id']; ?></div>
                    <div class="title col-4"><?=mb_substr($post['title'], 0, 50, 'UTF-8') . '...' ?></div>
                    <div class="author col-2"><?= $post['user_name']; ?></div>
                    <div class="red col-1"><a href="edit.php?id=<?=$post['id']; ?>">edit</a></div>
                    <div class="del col-2"><a href="edit.php?delete_id=<?=$post['id']; ?>">delete</a></div>
                    <?php if($post['status']): ?>
                        <div class="status col-2"><a href="edit.php?publish=0&pub_id=<?=$post['id']; ?>">unpublish</a></div>
                    <?php else: ?>
                        <div class="status col-2"><a href="edit.php?publish=1&pub_id=<?=$post['id']; ?>">publish</a></div>
                    <?php endif; ?>
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