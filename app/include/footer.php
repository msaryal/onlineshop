<?php
include SITE_ROOT . '/app/controllers/post.php';
?>

<div class="footer container-fluid">
    <div class="footer-content container">
        <div class="row">
            <div class="footer-section about col-md-6 col-12">
                <h3 class="logo-text">Магазин одежды</h3>
                <p>
                    Магазин одежды SShop - здесь вы сможете найти одежду
                    на разный вкус и цвет!
                </p>
                <div class="contact">
                    <span><i class="fas fa-phone"></i> &nbsp; 952-395-45-25 </span>
                    <span><i class="fas fa-envelope"></i> &nbsp; info@sshop.com </span>
                </div>
                <div class="socials">
                    <a href="https://vk.com/" target="_blank"><i class="fa-brands fa-vk"></i></a>
                    <a href="https://t.me/" target="_blank"><i class="fa-brands fa-telegram"></i></a>
                    <a href="https://wa.clck.bar/" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-section contact-form col-md-6 col-12">
                <h3>Обратная связь</h3>
                <br>
                <form action="index.php" method="post">
                    <input type="email" name="email" class="text-input contact-input" placeholder="Ваша почта...">
                    <textarea rows="4" name="message" class="text-input contact-input" placeholder="Ваше сообщение..."></textarea>
                    <button name="feedback_send" type="submit" class="btn btn-big contact-btn">
                        <i class="fas fa-envelope"></i>
                        Отправить
                    </button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; sshop | Designed by Saryal Makarov
        </div>
    </div>
</div>