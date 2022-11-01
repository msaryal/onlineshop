<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h1>
                    <a href="<?php echo BASE_URL ?>">SShop</a>
                </h1>
            </div>
            <nav class="col-10">
                <ul>
                    <li><a href="<?php echo BASE_URL ?>">Главная</a></li>
                    <li><a href="<?php echo BASE_URL . 'catalog.php'; ?>"><i class="fa-solid fa-clothes-hanger"></i>Каталог</a></li>
                    <li><a href="<?php echo BASE_URL . 'about.php'; ?>"><i class="fa-solid fa-phone"></i>О нас</a></li>
                    <li>
                        <?php if (isset($_SESSION['id'])):?>
                            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i>Корзина</a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if (isset($_SESSION['id'])):?>
                            <a href="#"><i class="fa-solid fa-address-book"></i><?php echo $_SESSION['login']; ?></a>
                        <ul>
                            <?php if ($_SESSION['admin']):?>
                            <li><a href="#">Админ панель</a></li>
                            <?php endif; ?>
                            <li><a href="<?php echo BASE_URL . 'logout.php'; ?>">Выход</a></li>
                        </ul>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL . 'log.php'; ?>"><i class="fa-solid fa-address-book"></i>Войти</a>
                            <ul>
                                <li><a href="<?php echo BASE_URL . 'reg.php'; ?>">Регистрация</a></li>
                            </ul>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>