<?php
//Обратная связь
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback_send'])){

    $email = $_POST['email'];
    $message = $_POST['message'];
   
    $mes = "E-mail: $email \nТекст: $message";
    $send = mail('info@sshop.com', 'Письмо с сайта SShop',$mes);
?>
<?php if ($send == 'true'): ?>
   <script type="text/javascript">alert("Сообщение отправлено");</script>
<?php else: ?>
    <script type="text/javascript">alert("Ой, что-то пошло не так");</script>
<?php endif; }?>