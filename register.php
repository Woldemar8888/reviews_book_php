<?php require_once 'header.php';?>
   <form action="registerHandler.php" id="register-form" method="post">
    <label for="name">Имя</label>
    <input type="text" name="name" id="name">
    <label for="phone">Телефон</label>
    <input type="phone" name="phone" id="phone">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="login">Логин</label>
    <input type="text" name="login" id="login">
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password">
    <label for="dpassword">Повторить пароль</label>
    <input type="pussword" name="dpassword" id="dpassword">
    <input type="submit">
</form>
<?php require_once 'footer.php';