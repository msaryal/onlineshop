<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h1>
                    <a href="<?php echo BASE_URL . 'admin/posts/index.php'?>">SShop</a>
                </h1>
            </div>
            <nav class="col-10">
                <ul>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-address-book"></i>
                            <?php echo $_SESSION['login']; ?>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL . 'logout.php'; ?>">Выход</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>