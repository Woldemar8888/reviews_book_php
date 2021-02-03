<?php require_once 'header.php';?>
   <form action="loginHandler.php" id="login-form" method="post">
    <label for="login">Логин</label>
    <input type="text" name="login" id="login">
    <label for="password">Пароль</label>
    <input type="password" name="password" id="password">
    <input type="submit">
</form>
<?php require_once 'footer.php';