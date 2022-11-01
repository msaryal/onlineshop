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

<title>Редактирование товара</title>
</head>
<body>

<!-- HEADER START -->
<?php include '../../app/include/header_admin.php';?>
<!-- HEADER END -->

<div class="container">
<?php include '../../app/include/sidebar_admin.php'?>
        <div class="posts col-9">
            <div class="row title-table">
                <h2>Редактирование товара</h2>
            </div>
            <div class="row add-post">
                <div class="mb-12 col-12 col-md-12 err">
                    <!-- Вывод массива с ошибками -->
                <?php include '../../app/helps/errorInfo.php';?>
                </div>
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$id; ?>">
                    <div class="col mb-4">
                        <input name="title" value="<?=$post['title']; ?>" type="text" class="form-control" placeholder="Название товара" aria-label="Название товара">
                    </div>
                    <div class="col mb-4">
                        <input name="price" value="<?=$post['price']; ?>" type="text" class="form-control" placeholder="Цена товара" aria-label="Цена товара">
                    </div>
                    <div class="col">
                        <label for="editor" class="form-label">Описание товара</label>
                        <textarea name="content" id="editor" class="form-control" rows="6"><?=$post['content']; ?></textarea>
                    </div>
                    <div class="input-group col mb-4 mt-4">
                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Загрузить</label>
                    </div>
                    <select name="topic" class="form-select mb-4" aria-label="Default select example">
                        <?php foreach($topics as $key => $topic): ?>
                            <option value="<?=$topic['id']; ?>"><?=$topic['name_topic']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-check">
                        <?php if (empty($publish) && $publish == 0): ?>
                            <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                Publish
                            </label>
                        <?php else: ?>
                            <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                Publish
                            </label>
                        <?php endif; ?>
                    </div>
                    <div class="col col-6">
                        <button name="edit_post" class="btn btn-primary" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER START -->
<?php include '../../app/include/footer.php';?>
<!-- FOOTER END -->

    <!-- Optional JavaScript: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Добавление визуального редактора к полю в админке-->
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
 
    <script src="../../assets/js/script.js"></script>
</body>
</html>